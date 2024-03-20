<!-- Header Starts -->


<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Products</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="/c/product">Product</a>
                        </li>

                    </ol>
                </div>
            </div>
        </div>
        <!-- Header end -->


        <div class="row">
            <div class="col-sm-12">
                <!-- Basic Table starts -->
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary waves-effect waves-light mb-5" style="margin-bottom: 10px;" data-toggle="modal" data-target="#add"><span class="tf-icons mdi mdi-plus me-1 mb-3"></span> Add Product</button>
                        <div style="display: flex;justify-content: space-between;" class="mb-0 d-flex justify-content-around">
                            <h5 class="card-header-text showingBy">All Product</h5>

                            <div class="">
                                <div class="dropdown-primary dropdown">
                                    <button class="btn btn-info dropdown-toggle waves-effect waves-light " type="button" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdown1" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <a class="dropdown-item waves-light waves-effect activateAll" href="javascript:void(0);">Activate All</a>
                                        <a class="dropdown-item waves-light waves-effect draftAll" href="javascript:void(0);">Draft All</a>
                                    </div>

                                </div>

                                <div class="dropdown-primary dropdown">
                                    <button class="btn btn-info dropdown-toggle waves-effect waves-light " type="button" id="dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Showing By
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdown2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <a class="dropdown-item waves-light waves-effect showAll" href="javascript:void(0);">Show All</a>
                                        <a class="dropdown-item waves-light waves-effect showActive" href="javascript:void(0);">Active</a>
                                        <a class="dropdown-item waves-light waves-effect showDraft" href="javascript:void(0);">Draft</a>

                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="dataTable" class="table table-striped table-bordered nowrap reports " width="100%" cellspacing="0" data-table="product" data-filter="ALL">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Cost Price</th>
                                        <th>Sell Price</th>
                                        <th>Stock</th>
                                        <th>Tax</th>
                                        <th>Discount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        <th>Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>



                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Basic Table ends -->
            </div>
        </div>


        <div class="overlay">
            <div class="spinner-border text-primary" role="status">
                <span class="loader-shu"></span>
            </div>
        </div>


    </div>
</div>

<div class="modal fade" id="add" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">Add Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="insert" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Product Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Enter Product Name">

                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Product Code</label>
                                <input type="text" name="code" class="form-control" id="code" aria-describedby="name" placeholder="Product Code">

                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Generate Code</label>
                                <button type="button" id="generate-code" class="btn btn-success waves-effect waves-light">Generate
                                </button>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Product Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Cost Price</label>
                                <input type="text" name="cost_price" class="form-control" id="cost-price" aria-describedby="cost-price" placeholder="Enter Product Cost">

                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Sales Price</label>
                                <input type="text" name="sale_price" class="form-control" id="sale_price" aria-describedby="sale_price" placeholder="Enter Product Sale">

                            </div>
                        </div>


                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Product Description</label>
                                <textarea name="discount" class="form-control"></textarea>
                                <small class="text-danger-color">Only if Applicable</small>

                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Category</label>
                                <select class="form-control" id="category" name="category">
                                </select>

                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Product in Stock</label>
                                <input type="text" name="stock" class="form-control" id="stock" aria-describedby="stock" placeholder="Enter Product Quantity">

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Product Tax</label>
                                <input type="text" name="tax" class="form-control" id="tax" aria-describedby="tax" placeholder="Enter Product tax">
                                <small>Only if Applicable</small>

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Sales Discount</label>
                                <input type="text" name="discount" class="form-control" id="discount" aria-describedby="discount" placeholder="Enter Product discount">
                                <small>Only if Applicable</small>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
                                <label class="input-checkbox checkbox-success">
                                    <input type="checkbox" id="status" name="status" checked>
                                    <span class="checkbox"></span>
                                </label>
                                <div class="captions">Status</div>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <input type="hidden" name="action" value="add">
                            <button type="submit" id="add-button" class="btn btn-success waves-effect waves-light">Submit
                            </button>
                        </div>
                    </div>
                </form>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="editModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">Edit Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Product Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Enter Product Name">

                            </div>
                        </div>
                        <div class="col-xs-4">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Product Code</label>
                                <input type="text" name="code" class="form-control" id="code" aria-describedby="name" placeholder="Product Code">

                            </div>
                        </div>
                        <div class="col-xs-2">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Generate Code</label>
                                <button type="button" id="generate-code" class="btn btn-success waves-effect waves-light">Generate
                                </button>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Product Image</label>
                                <input type="file" name="image" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Cost Price</label>
                                <input type="text" name="cost_price" class="form-control" id="cost-price" aria-describedby="cost-price" placeholder="Enter Product Cost">

                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Sales Price</label>
                                <input type="text" name="sale_price" class="form-control" id="sale_price" aria-describedby="sale_price" placeholder="Enter Product Sale">

                            </div>
                        </div>


                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Product Description</label>
                                <textarea id="description" name="desc" class="form-control"> </textarea>
                                <small class="text-danger-color">Only if Applicable</small>

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div id="img_preview"> </div>

                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Category</label>
                                <select class="form-control" id="category23" name="cat_id">
                                </select>

                            </div>
                        </div>


                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Product in Stock</label>
                                <input type="text" name="stock" class="form-control" id="stock" aria-describedby="stock" placeholder="Enter Product Quantity">

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Product Tax</label>
                                <input type="text" name="tax" class="form-control" id="tax" aria-describedby="tax" placeholder="Enter Product tax">
                                <small>Only if Applicable</small>

                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Sales Discount</label>
                                <input type="text" name="discount" class="form-control" id="discount" aria-describedby="discount" placeholder="Enter Product discount">
                                <small>Only if Applicable</small>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
                                <label class="input-checkbox checkbox-success">
                                    <input type="checkbox" id="status" name="status" checked>
                                    <span class="checkbox"></span>
                                </label>
                                <div class="captions">Status</div>
                            </div>
                        </div>


                        <div class="col-sm-6">
                            <input type="hidden" name="action" value="edit">
                            <input id="rowID" type="hidden" name="id">
                            <input id="catID" type="hidden" name="catID">
                            <button type="submit" id="add-button" class="btn btn-success waves-effect waves-light">Submit
                            </button>
                        </div>
                    </div>
                </form>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- End Bootstrap Modal -->

