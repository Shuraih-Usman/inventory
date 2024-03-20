<?php
require_once __DIR__.'/../../config/init.php';
$action = Input('action');
$table = 'pos';
$prod = 'product';

if(Input('search')) {
    $action = Input('search');
    $html = '<div id="products" class="row">';
    if($action === 'listing') {

        $results = $db->get('product', 20);

        if($results) {
            foreach ($results as $row) {
                $image = $row['image'] ? APP_URL.'/thumb/'.$row['image'] : APP_URL.'/assets/images/light-box/single-small.jpg';
                $stock = $row['stock'] < 1 ? '<span class="badge bg-warning">Out of Stock</span>' : '<b><small>Stock '. $row['stock'] .'</small></b>';
                $button = $row['stock'] < 1 ? '<button class="btn btn-warning waves-effect waves-light " type="button" disabled>Select</button>' : '<button class="btn btn-info  waves-effect waves-light add-to-cart"  data-id="'.$row['id'].'" data-name="'.$row['name'].'" data-price="'.$row['sell_price'].'" data-tax="'.$row['tax'].'" data-discount="'.$row['discount'].'" data-code="'.$row['code'].'" data-stock="'.$row['stock'].'" type="button" >Select</button>';

                $html .= '
            <!-- Card 1 -->
                                               <div class="col-md-4 mb-2 ">
                                                   <div class="card">
                                                       <img src="'.$image.'" class="card-img-top" alt="Product Image">
                                                       <div class="card-body" style="padding: 10px 5px;">
                                                           <h5 class="card-title ">'.$row['name'].'</h5>
                                                           <p class="card-text ">N'.$row['sell_price'].'</p>
                                                           '.$stock.'
                                                           '.$button.'

                                                       </div>
                                                       
                                                   </div>
                                               </div>
            ';

            }
        } else {
            $html .= '<p> Not Found </p>';
        }

    } else if($action === 'qsearch') {
        $value = Input('value');

        if(is_numeric($value)) {
            $db->where('code', '%' . $value. '%', 'LIKE');
        } else {
            $db->where('name', '%' . $value. '%', 'LIKE');
        }

        $results = $db->where('status', 1)->get('product');

        if($results) {
            foreach ($results as $row) {
                $image = $row['image'] ? APP_URL.'/thumb/'.$row['image'] : APP_URL.'/assets/images/light-box/single-small.jpg';
                $stock = $row['stock'] < 1 ? '<span class="badge bg-warning">Out of Stock</span>' : '<b><small>Stock '. $row['stock'] .'</small></b>';
                $button = $row['stock'] < 1 ? '<button class="btn btn-warning waves-effect waves-light" type="button" disabled>Select</button>' : '<button class="btn btn-info  waves-effect waves-light add-to-cart"  data-id="'.$row['id'].'" data-name="'.$row['name'].'" data-price="'.$row['sell_price'].'" data-tax="'.$row['tax'].'" data-discount="'.$row['discount'].'" data-code="'.$row['code'].'" data-stock="'.$row['stock'].'" type="button" >Select</button>';

                $html .= '
            <!-- Card 1 -->
                                               <div class="col-md-4 ">
                                                   <div class="card">
                                                       <img src="'.$image.'" class="card-img-top" alt="Product Image">
                                                       <div class="card-body" style="padding: 10px 5px;">
                                                           <h5 class="card-title">'.$row['name'].'</h5>
                                                           <p class="card-text">N'.$row['sell_price'].'</p>
                                                           '.$stock.'
                                                           '.$button.'

                                                       </div>
                                                       
                                                   </div>
                                               </div>
            ';

            }
        } else {
            $html .= '<p> Not Found </p>';
        }
    }

    $html .= '</div>';
    echo $html;
}
else if(isset($_POST['action'])) {
    header("Content-Type: application/json");
    $action = isset($_POST['action']);

    if ($_POST['action'] === 'pos') {
        $data = json_decode($_POST['jsData']);
        $item = $data->items;
        $phone = $data->number;
        $name = $data->name;
        $total = $data->price;
        $ptype = $data->payment;
        $topay = $data->topay;

        $uniqueid =  uniqid();

        $refer = $db->where('reference', $uniqueid)->getOne('pos');

        while ($refer) {
            $uniqueid .= rand(0,9);
        }

        $tax = 0;
        $discount = 0;

        $count = 0;
        $error = [];

        $db->startTransaction();
        foreach ($item as $row) {
            $tax += $row->tax;
            $discount += $row->discount;

            $data = [
                'product_id' => $row->id,
                'product_code' => $row->code,
                'price' => $row->price,
                'discount' => $row->discount,
                'tax' => $row->tax,
                'quantity' => $row->quantity,
                'reference' => $uniqueid,
            ];

            if($db->insert('product_order', $data)) {
                $count++;
                $product = $db->where('id', $row->id)->getOne('product');
                $stock = $product['stock'] - $row->quantity;
                $db->where('id', $row->id)->update('product', ['stock' => $stock]);
            } else {
                $error[] = "Error with id {$row->id} :".$db->getLastError();
                $db->rollback();
            }
        }

        if($count > 0) {
            $datas = [
                'customer_name' => $name,
                'customer_phone' => $phone,
                'amount_paid' => $topay,
                'payment_type' => $ptype,
                'tax' => $tax,
                'discount' => $discount,
                'reference' => $uniqueid,
                'total' => round($total, 2),
            ];

            if($db->insert('pos', $datas)) {
                $db->commit();
                $s = 1;
                $m = "Successfully Purchased  product press Print to print receipt";
            } else {
                $db->rollback();
                $m = "Error: ".$db->getLastError();
                $s = 0;
            }
        } else {
            $db->rollback();
            $m = $error[0];
            $s = 0;
        }





        echo json_encode(['s' => $s, 'm' => $m, 'ref' => $uniqueid]);


    }
}