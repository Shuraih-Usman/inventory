
$(document).ready(function () {
    function initSelect2(id, type, pid ='') {

        var selectID = $("#"+id);
        let ids = '';
        var isID = pid.length > 0;
        if(isID) {
            ids = pid;
        }



        if(selectID) {

            $.ajax({
                type: 'POST',
                url: `${table}/process.php`,
                data: {
                    action : type,
                    type: type,
                    id: ids,
                },
                success: function(html){
                    $('#'+id).html(html);

                },
                error: function (xhr, status, error) {
                    console.error('AJAX Error:', status, error);
                }
            });
        }
    }

    $('#add').on('shown.bs.modal', function () {

        $("#category").select2({
            dropdownParent: $('#add'),
        });

        initSelect2('category', 'category');





    });

    $('#editModal').on('shown.bs.modal', function () {

        $("#category23").select2({
            dropdownParent: $('#editModal'),
        });

        var pid = $('#catID').val();
        initSelect2('category23', 'category', pid);





    });
    $("#pment").select2({
    });


    const dataTable = $("#dataTable");
    var table = dataTable.attr('data-table');






    var Datatable = dataTable.DataTable({
        "processing": true,
        "serverSide": true,
        "stateSave": true,
        "ajax": {
            "url": `${table}/process.php`,
            "type": "POST",
            "data": function (d) {
                d.order = [{ column: d.order[0].column, dir: d.order[0].dir }];
                d.action = "list";
                d.table = table;
                d.filterdata = $("#dataTable").attr('data-filter');
            }
        },
        "columns": null,
        "order": [[0, 'desc']],

        "initComplete": function (settings, json) {
            if (json.columns) {
                this.api().columns().header().to$().each(function (column, idx) {
                    $(column).text(json.columns[idx]);
                });
            }
        },
        responsive: true,
        dom: "Bflrtip",
        select: {
            style: "os",
            selector: "td:nth-child(2)",
        },

        buttons: [
            "selectAll",
            "selectNone",
            {
                text: "Delete",
                className: "btn btn-danger waves-effect waves-light",
                action: function () {
                    var selectedRows = Datatable.rows({ selected: true }).data().toArray();
                    var ids = selectedRows.map(row => row[0]);
                    var count = Datatable.rows({ selected: true }).count();
                    if (count > 0) {
                        ActiontoStatus("deleteAll");
                    } else {
                        Swal.fire("Error", "You did not select any item on" + table, "warning");
                    }
                },
            },
        ],

        createdRow: function (row, data, dataIndex) {
            var selectedRows = Datatable.rows({ selected: true }).data().toArray();
            var ids = selectedRows.map(row => row[0]);
            var count = Datatable.rows({ selected: true }).count();
            if (count > 0) {
                $('td', row).css({'color': 'white', 'background-color': ''});
            } else {
                $('td', row).css({'color': 'black', 'background-color': ''});

            }
        },

    });

    $(document).on("click", ".showAll", function (e) {
        e.preventDefault();
        $(".showingBy").text(`All ${table[0].toUpperCase()+table.slice(1)}`);
        $("#dataTable").attr('data-filter', 'ALL');
        Datatable.ajax.reload();
    });

    $(document).on("click", ".showActive", function (e) {
        e.preventDefault();
        $(".showingBy").text(`Active ${table[0].toUpperCase()+table.slice(1)} `);
        $("#dataTable").attr('data-filter', 'Actived');
        Datatable.ajax.reload();
    });

    $(document).on("click", ".showDraft", function (e) {
        e.preventDefault();
        $(".showingBy").text(`Draft ${table[0].toUpperCase()+table.slice(1)} `);
        $("#dataTable").attr('data-filter', 'Draft');
        Datatable.ajax.reload();
    });

    $(document).on("click", ".activateAll", function (e) {
        e.preventDefault();
        ActiontoStatus("activateAll");
    });


    $(document).on("click", ".draftAll", function (e) {
        e.preventDefault();
        ActiontoStatus("draftAll");
    });

    $(document).on("click", ".draft", function (e) {
        e.preventDefault();
        var rowId = $(this).data('id');
        ActiontoStatus("draft", rowId);
    });

    $(document).on("click", ".activate", function (e) {
        e.preventDefault();
        var rowId = $(this).data('id');
        ActiontoStatus("activate", rowId);
    });

    $(document).on("click", ".delete", function (e) {
        e.preventDefault();
        var rowId = $(this).data('id');
        ActiontoStatus("delete", rowId);
    });

    $(document).on("click", "#generate-code", function (event) {
       event.preventDefault();
       $.ajax({
           url: `${table}/process.php`,
           type : "post",
           data : {
               action: 'generate-code',
           },

           success: function (code) {
               $("#code").val(code);
           },
           error : function (error) {
               console.log(error);
           }
       });
    });

    var cart = [];

    $(document).on('click', '.add-to-cart', function(e) {
       e.preventDefault();
       const clicked = $(this);

        if ($(this).prop('disabled')) {
            return;
        }

        var name = clicked.data('name');
        var code = clicked.data('code');
        var id = clicked.data('id');
        var price = parseFloat(clicked.data('price'));
        var stock = clicked.data('stock');
        var tax = clicked.data('tax');
        var discount = clicked.data('discount');

        console.log(code);

        var discountP = (price  * discount) / 100;
        var taxP = ((price - discountP) * tax) / 100;
        var accumulate_price = 1 * (price - discountP + taxP);

        cart.push({
            name: name,
            id: id,
            price: price,
            stock: stock,
            tax: tax,
            code: code,
            discount: discount,
            totalPrice: accumulate_price
        });

        updateCart();
        $(this).prop('disabled', true);



    });





    $(document).on('click', '#bpay', function (e){
        e.preventDefault();

        var totalPay = 0;
        cart.forEach(function(item) {
            totalPay += item.totalPrice;
        });
        var overlay = $(".overlay2");
        overlay.removeClass("d-none");

        var cname = $("#cname").val();
        var cnumber = $("#cnumber").val();
        var paymentType = $("#pment").val();
        var topay = $('#amtp').val();
        console.log(topay);


        var data = {
            items: formData.items,
            price: totalPay.toFixed(2),
            name: cname,
            number: cnumber,
            payment: paymentType,
            topay: topay,

        };


        $.ajax({
            url: "pos/process.php",
            method: "POST",
            data: {
                    jsData: JSON.stringify(data),
                    action: "pos",
            },

            success: function (data) {
                console.log(data);
                overlay.addClass("d-none");
                if(data.s === 1) {
                    Swal.fire({
                        title: "Success",
                        text: data.m,
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: "Print",
                        denyButtonText: `No`,
                        icon: 'success'
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href = "/print.php?ref="+data.ref;
                        } else if (result.isDenied) {
                            Swal.fire("Changes are not saved", "", "info");
                        }
                    });
                } else {
                    Alert('Warning', data.m, 'warning');
                }
            },

            error: function (error){
                overlay.addClass("d-none");
                Alert('Error', error, 'error');
            }
        });

    });

    const Alert = (title, data, icon) => {
        Swal.fire(title, data, icon);
    }

    var formData = {
        items: []
    };

    function updateCart() {
        var items = $("#content");
        var inputValues = {};


        cart.forEach(function (_, index) {
            inputValues[index] = {};
        });

        $('.item-quantity, .item-discount, .item-tax').each(function () {
            var index = $(this).data('index');
            inputValues[index] = {
                quantity: $('.item-quantity[data-index="'+index+'"]').val(),
                discount: $('.item-discount[data-index="'+index+'"]').val(),
                tax: $('.item-tax[data-index="'+index+'"]').val()
            };
        });


        items.empty();


        formData.items = [];
        cart.forEach(function(item, index) {
            var itemDetails =
                `<div class="row">
            <h5>${item.name}</h5>
            <form id="pos" method="post">
            <div class="col-sm-3">
            <div class="input-group mb-3">
              <span class="input-group-text">Quantity</span>
              <input type="number" class="form-control item-quantity" value="${inputValues[index]?.quantity || 1}" min="1" data-index="${index}">
            </div>
            </div>
            <div class="col-sm-3">

            <div class="input-group mb-3">
              <span class="input-group-text">Discount</span>
              <input type="number" class="form-control item-discount" value="${item.discount || 0}" min="0" data-index="${index}">
            </div>
            </div>
            <div class="col-sm-3">

            <div class="input-group mb-3">
              <span class="input-group-text">Tax</span>
              <input type="number" class="form-control item-tax" value="${item.tax || 0}" min="0" data-index="${index}">
              
                                  <button class="btn btn-danger remove-item" data-index="${index}">Remove</button>
              
            </div>

            </div>
            <div class="col-sm-3">
            
            
                </div>
            </form>
            
          </div>`;

            items.append(itemDetails);

            var existingItemIndex = formData.items.findIndex(existingItem => existingItem.id === item.id);
            if (existingItemIndex !== -1) {
                formData.items[existingItemIndex] = {
                    ...formData.items[existingItemIndex],
                    quantity: item.quantity || 1,
                    discount: item.discount || 0,
                    tax: item.tax || 0,
                    total: item.totalPrice.toFixed(2)
                };
            } else {
                // Add new item
                formData.items.push({
                    name: item.name,
                    id: item.id,
                    code: item.code,
                    quantity: item.quantity || 1,
                    discount: item.discount || 0,
                    tax: item.tax || 0,
                    price: item.price,
                    total: item.totalPrice.toFixed(2)
                });
            }

        });






        $('.remove-item').on('click', function (e) {
            e.preventDefault();
            var indexToRemove = $(this).data('index');
            var yidElement = cart[indexToRemove];

            $('.add-to-cart').each(function() {
                if ($(this).data('id') === yidElement.id) {
                    $(this).prop('disabled', false);
                }
            });
            cart.splice(indexToRemove, 1);
            updateCart();

        });

        updateTotal()
    }





    function updateTotal() {
        var totalPay = 0;
        cart.forEach(function(item) {
            totalPay += item.totalPrice;
        });

        $('#amtp').val(totalPay.toFixed(2));

        $("#totalp").empty();
        $("#totalp").append(`
           <div class="d-flex justify-content-between m-r-3">
           <p id="totalpaying" class="text-xl-center"> ${'N'+totalPay.toFixed(2)}</p>
           <button class="btn btn-primary m-l-3" id="bpay">
        Pay </button>
</div>
        
        `);

    }

    $(document).on('change', '.item-quantity, .item-discount, .item-tax', function (event) {
        event.preventDefault();

        var index = $(this).data('index');
        var discountP = parseInt($('.item-discount[data-index="'+index+'"]').val()) || 0;
        var quantity = parseInt($('.item-quantity[data-index="'+index+'"]').val()) || 1;
        var taxP = parseInt($('.item-tax[data-index="'+index+'"]').val()) || 0;

        cart[index].quantity = quantity;
        cart[index].tax = taxP;
        cart[index].discount = discountP;

        var discount = (cart[index].price * discountP) / 100;
        var tax = ((cart[index].price - discount) * taxP) / 100;
        cart[index].totalPrice = quantity * (cart[index].price - discount + tax);

        // Update the cart without resetting the input
        updateCart();
    });









    let searchMethod = "listing";


    $.ajax({
        url: `pos/process.php`,
        method: "POST",
        data: {
            search: searchMethod,
        },

        success: function (html) {
            $("#product").html(html);
        },
        error: function (error) {
            console.log(error);
        }
    });

    $(document).on("input", "#search", function (event) {
        event.preventDefault();
        const search = $("#search").val();

        if(search.length > 0) {
            searchMethod = 'qsearch';

        } else {
            searchMethod = 'listing';
        }

        $.ajax({
            url: `pos/process.php`,
            method: "POST",
            data: {
                search: searchMethod,
                value: search,
            },

            success: function (html) {
                $("#product").html(html);
            },
            error: function (error) {
                console.log(error);
            }
        });

    });

    $(document).on("click", ".edit", function (event) {
       event.preventDefault();
        var rowId = $(this).data('id');
        const form = $(this).closest('form');
        const editModal = $("#editModal");

        $("#img_preview", editModal).empty();

        $.ajax({
            url: `${table}/process.php`,
            type: 'POST',
            dataType: 'json',
            data: {
                action: "getRow",
                id: rowId
            },
            success: function (data) {
                if(table == 'category') {
                    $("#editname").val(data.name);
                    $("#RowID").val(rowId);
                } else if(table == 'product') {
                    $("#name", editModal).val(data.name);
                    $("#code", editModal).val(data.code);
                    $("#cost-price", editModal).val(data.cost_price);
                    $("#sale_price", editModal).val(data.sell_price);
                    $("#discount", editModal).val(data.discount);
                    $("#stock", editModal).val(data.stock);
                    $("#tax", editModal).val(data.tax);
                    $("#stock", editModal).val(data.stock);
                    $("#rowID", editModal).val(data.id);
                    $("#catID", editModal).val(data.cat_id);

                    var imgElement = $('<img>');
                    imgElement.attr({
                        src: "../../thumb/" + data.image,
                        alt: data.name,
                        width: 100,
                        height: 100,
                    });
                    $("#img_preview").append(imgElement);
                }

                createSwitchElements("status-switch", "status", "status", "Status", data.status);
            },

            error: function (error, status) {
                console.log("Error " + error + "status: " + status);
            }
        })
    });

    function createSwitchElements(containerId, checkboxId, checkboxName, labelText, isChecked) {
        var switchContainer = $("<div>", {
            class: "rkmd-checkbox checkbox-rotate checkbox-ripple"
        });

        var labelContainer = $("<label>", {
            class: "input-checkbox checkbox-success"
        });

        var checkbox = $("<input>", {
            type: "checkbox",
            id: checkboxId,
            name: checkboxName,
        });

        checkbox.prop("checked", isChecked);

        var checkboxSpan = $("<span>", {
            class: "checkbox"
        });

        labelContainer.append(checkbox, checkboxSpan);

        var captionsDiv = $("<div>", {
            class: "captions",
            text: labelText
        });

        switchContainer.append(labelContainer, captionsDiv);

        $("#" + containerId).empty().append(switchContainer);
    }

    function ActiontoStatus(type, rowId = '') {
        let title;

        if (type == "activateAll") {
            title = "Activate";
            var selectedRows = Datatable.rows({ selected: true }).data().toArray();
            var ids = selectedRows.map(row => row[0]);
            var count = Datatable.rows({ selected: true }).count();
        } else if(type == 'deleteAll') {
            var selectedRows = Datatable.rows({ selected: true }).data().toArray();
            var ids = selectedRows.map(row => row[0]);
            var count = Datatable.rows({ selected: true }).count();
            title = "Delete";
        } else if (type == "draftAll") {
            title = "Draft";
            var selectedRows = Datatable.rows({ selected: true }).data().toArray();
            var ids = selectedRows.map(row => row[0]);
            var count = Datatable.rows({ selected: true }).count();
        }else if(type == 'draft') {
            var ids = rowId;
            var count = 1;
            title = "Draft";
        } else if(type == 'activate') {
            var ids = rowId;
            var count = 1;
            title = "Activate";
        } else if(type == 'delete') {
            var ids = rowId;
            var count = 1;
            title = "Delete";
        }

        if (count == 0) {
            Swal.fire("Error", "You Have no Item Selected for " + title, "warning");
            return false;
        }

        Swal.fire(
            {
                title: "Are you sure to " + title + " Total: " + count + " Items? " ,
                type: "warning",
                showCancelButton: true,
                cancelButtonClass: "btn-warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: false,
                showLoaderOnConfirm: true,
            }
        ).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: `${table}/process.php`,
                    data: {
                        ids: ids,
                        type: type,
                        action: 'settingStatus',
                    },
                    success: function (datas) {
                        if (datas.s === 1) {
                            Datatable.draw(false);
                            Swal.fire("Successfully", datas.m, "success");
                        } else {
                            Swal.fire("Warning", datas.m, "warning");
                        }
                    },

                    error: function (xhr, status, error) {
                        Swal.fire("Error", "AJAX Error: " + error, "error");
                    }
                });
            } else {
                Swal.fire.close();
            }
        });


    }

    $('#date-start').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        viewMode: 'days',
        clearButton: true,
        switchOnClick: true
    });

    // Initialize the datetime picker for end date
    $('#date-end').bootstrapMaterialDatePicker({
        format: 'YYYY-MM-DD',
        viewMode: 'days',
        clearButton: true,
        switchOnClick: true
    });

    $(document).on('click', '#get-sale-report', function (event) {
       event.preventDefault();

       var start_date = $("#date-start").val();
       var end_date = $("#date-end").val();
       var overlay = $(".overlay");

       overlay.removeClass("d-none");

       $.ajax({
          url: 'order-report/process.php',
          method: 'post',
          data: {
              end_date : end_date,
              start_date: start_date,
              action: 'sale_report',
          },

           success: function (data) {
              console.log(data);
              overlay.addClass("d-none");
              if(data.s == 1) {
                  Alert('Success', data.m, 'success');
              } else if(data.s == 0) {
                  Alert('Warning', data.m, 'warning');
              }
           },

           error: function (error) {
              overlay.addClass('d-none');
              Alert('Error', error, 'error');
           }
       });

    });


    $(document).on("submit", "#changep", function (event) {
        event.preventDefault();

        const form = this;
        var overlay = $(".overlay");
        overlay.removeClass("d-none");
        const formData = new FormData(form);

        $.ajax({
            url: `setting/process.php`,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                overlay.addClass('d-none');

                if(data.s === 1) {
                    Alert('Success', data.m, 'success');
                    location.reload();
                } else {
                    Alert('Warning', data.m, 'warning');

                }
            },
            error: function (xhr, error) {
                overlay.addClass('d-none');

                Swal.fire('Error', error, 'error');
            }
        });
    });

    $(document).on("submit", "#insert", function (event) {
            event.preventDefault();

            const form = this;
            var overlay = $(".overlay");
            var button = $(form).find("#add-button");
            overlay.removeClass("d-none");
            const formData = new FormData(form);
            button.prop('disabled', true);

            $.ajax({
                url: `${table}/process.php`,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function (data) {
                    overlay.addClass('d-none');

                    if(data.s === 1) {
                        Datatable.draw();
                        Swal.fire('Success', data.m, 'success');
                        $(form).trigger('reset');
                    } else {
                        Swal.fire('Warning', data.m, 'warning');

                    }
                    button.prop('disabled', false);
                },
                error: function (xhr, error) {
                    overlay.addClass('d-none');
                    Swal.fire('Error', error, 'error');
                    button.prop('disabled', false);
                }
            });
        });

    $(document).on("submit", "#edit", function (event) {
        event.preventDefault();

        const form = this;
        var overlay = $(".overlay");
        var button = $(form).find("#add-button");
        overlay.removeClass("d-none");
        const formData = new FormData(form);
        button.prop('disabled', true);

        $.ajax({
            url: `${table}/process.php`,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                overlay.addClass('d-none');
                if(data.s === 1) {
                    Datatable.draw();
                    Swal.fire('Success', data.m + " Edit", 'success');
                } else {
                    Swal.fire('Warning', data.m, 'warning');

                }
                button.prop('disabled', false);
            },
            error: function (xhr, error) {
                overlay.addClass('d-none');
                Swal.fire('Error', error, 'error');
                button.prop('disabled', false);
            }
        });
    });

    $(document).on("submit", "#editpos", function (event) {
        event.preventDefault();

        const form = this;
        var overlay = $(".overlay");
        var button = $(form).find("#add-button");
        overlay.removeClass("d-none");
        const formData = new FormData(form);
        button.prop('disabled', true);

        $.ajax({
            url: `edit-order/process.php`,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                overlay.addClass('d-none');
                if(data.s === 1) {
                    Swal.fire('Success', data.m + " Edit", 'success');
                    location.reload();
                } else {
                    Swal.fire('Warning', data.m, 'warning');

                }
                button.prop('disabled', false);
            },
            error: function (xhr, error) {
                overlay.addClass('d-none');
                Swal.fire('Error', error, 'error');
                button.prop('disabled', false);
            }
        });
    });





});
