

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
                        <li class="breadcrumb-item"><a href="/c/pos">Point of Sales</a>
                        </li>

                    </ol>
                </div>
            </div>
        </div>
        <!-- Header end -->






        <div class="row">
            <div class="col-sm-12">
               <div class="card">
                   <div class="card-header d-flex align-items-center">
                       Point Of Sales
                   </div>
                   <div class="card-block">
                           <div class="card">
                               <div class="d-flex justify-content-around">
                                   <div class="input-group m-r-1">
                                       <span class="input-group-text">Customer Name</span>
                                       <input id="cname" type="text" class="form-control" placeholder="Enter customer name">
                                   </div>

                                   <div class="input-group m-r-1">
                                       <span class="input-group-text">Customer Number</span>
                                       <input id="cnumber" type="text" class="form-control" placeholder="Enter customer Number">
                                   </div>

                                   <div class="input-group mb-3">
                                       <span class="input-group-text">Payment Type</span>
                                       <select name="paymentType" id="pment" class="form-control">
                                           <option value="cash">Cash</option>
                                           <option value="pos">POS</option>
                                           <option value="transfer">Transfer</option>
                                       </select>
                                   </div>

                               </div>
                           </div>
                       <div class="row">
                           <div class="col-sm-7">
                               <div class="card shadow">
                                   <div class="card-header">
                                       Pick Products
                                   </div>
                                   <div class="card-block">
                                       <section id="">
                                           <form class="d-flex m-b-3">
                                               <input id="search" class="form-control me-2" type="search" placeholder="Search" aria-label="Search" >

                                           </form>
                                       </section>
                                       <section id="product">

                                       </section>


                                   </div>
                               </div>
                           </div>

                           <div class="col-sm-5 shadow">
                               <div id="items">
                                   <div class="card">
                                       <h3 class="card-header">
                                           Cart
                                       </h3>
                                       <div class="card-block">
                                           <div id="content">
                                           </div>

                                           <hr>

                                           <h4>Total to Pay</h4>
                                           <div class="input-group m-b-1">
                                               <span class="input-group-text">Amount To Pay</span>
                                               <input id="amtp" type="text" class="form-control">
                                           </div>
                                           <div id="totalp">0</div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>





    </div>
</div>

