

<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Edit Order</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="/c/edit-order">Edit Order</a>
                        </li>

                    </ol>
                </div>
            </div>
        </div>
        <!-- Header end -->






        <div class="row">
            <div class="col-sm-12">
                <form class="" id="editpos">
               <div class="card">

                   <div class="card-block">
                           <div class="card">
                               <div class="d-flex justify-content-around">
                                   <div class="input-group m-r-1">
                                       <span class="input-group-text">Customer Name</span>
                                       <input name="cname" id="" type="text" class="form-control" placeholder="Enter customer name" value="<?php echo $item['customer_name'] ?>">
                                   </div>

                                   <div class="input-group m-r-1">
                                       <span class="input-group-text">Customer Number</span>
                                       <input name="cnumber" type="text" class="form-control" placeholder="Enter customer Number" value="<?php echo $item['customer_phone'] ?>">
                                   </div>

                                   <div class="input-group mb-3">
                                       <span class="input-group-text">Payment Type</span>
                                       <select name="paymentType" id="pment" class="form-control">

                                           <option value="<?php echo $item['payment_type'] ?>"><?php echo $item['payment_type'] ?></option>
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
                                   <h2 class="card-header">
                                       Products
                                   </h2>
                                   <div class="card-block">

                                       <div class="row p-10">
                                           <?php
                                           foreach ($products as $product) {?>
                                               <h5><?php echo $product['name'] ?></h5>
                                               <input type="hidden" name="p_id[]" value="<?php echo $product['id'] ?>">
                                               <div class="col-sm-3 m-b-1">
                                                   <div class="input-group mb-3">
                                                       <span class="input-group-text">Quantity</span>
                                                       <input name="quantity[]" type="number" class="form-control" value="<?php echo $product['quantity'] ?>">
                                                   </div>
                                               </div>
                                               <div class="col-sm-3 m-b-1">

                                                   <div class="input-group mb-3">
                                                       <span class="input-group-text">Discount</span>
                                                       <input name="discount[]" type="number" class="form-control" value="<?php echo $product['discount'] ?>">
                                                   </div>
                                               </div>
                                               <div class="col-sm-3 m-b-1">

                                                   <div class="input-group mb-3">
                                                       <span class="input-group-text">Tax</span>
                                                       <input name="tax[]" type="number" class="form-control" value="<?php echo $product['tax'] ?>">

                                                   </div>

                                               </div>

                                               <div class="col-sm-3 m-b-1">

                                                   <div class="input-group mb-3">
                                                       <span class="input-group-text">Price</span>
                                                       <input name="price[]" type="number" class="form-control" value="<?php echo $product['price'] ?>">

                                                   </div>

                                               </div>
                                           <?php
                                           }

                                           ?>


                                       </div>


                                   </div>
                               </div>
                           </div>

                           <div class="col-sm-5 shadow">
                               <div id="items">
                                   <div class="card">
                                       <div class="card-block">
                                           <h4>Total to Pay</h4>
                                           <div class="input-group m-b-1 d-flex justify-content-between">
                                               <div class="m-r-2">
                                                   <span class="input-group-text">Total</span>
                                                   <p> <?php echo $item['total'] ?></p>
                                               </div>
                                               <div class="p-r-2">
                                                   <span class="input-group-text">Amount Paid</span>
                                                   <p> <?php echo $item['amount_paid'] ?></p>
                                               </div>
                                               <div>
                                                   <span class="input-group-text">Amount To Pay</span>
                                                   <input name="amount" id="" type="text" class="form-control" value="<?=$item['total'] - $item['amount_paid']?>">
                                               </div>


                                           </div>

                                           <div class="input-group m-b-1">
                                               <input type="hidden" name="action" value="editpos">
                                               <input type="hidden" name="id" value="<?php echo $id; ?>">
                                               <button class="btn btn-primary" type="submit">Update</button>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
                </form>
            </div>
        </div>





    </div>
</div>

