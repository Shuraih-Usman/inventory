<?php
require_once __DIR__.'/../../config/init.php';
$action = Input('action');
header("Content-Type: application/json");
if($action == 'editpos') {
    $pids = $_POST['p_id'];
    $s =0;
    $total = 0;
    $tax2 = 0;
    $discount2 = 0;
    $accumulate = 0;


    $error = [];
    $db->startTransaction();
    foreach ($pids as $key => $id) {
        $quantity = $_POST['quantity'][$key];
        $discount = $_POST['discount'][$key];
        $tax = $_POST['tax'][$key];
        $price = $_POST['price'][$key];

        if($db->where('id', $id)->update('product_order',['quantity' => $quantity, 'discount' => $discount, 'tax' => $tax])) {

        } else {
            $error = "Error $id ".$db->getLastError();
            $db->rollback();
        }
        $tax2 += $tax;
        $discount2 += $discount;
        $total += $quantity * $price;

        $discountAmount = ($price * $discount) / 100;
        $taxAmount = (($price - $discountAmount) * $tax) / 100;
        $itemTotalPrice = $quantity * ($price - $discountAmount + $taxAmount);
        $accumulate += $itemTotalPrice;
    }

    $posdata = [
        'customer_name' => Input('cname'),
        'customer_phone' => Input('cnumber'),
        'tax' => $tax2,
        'discount' => $discount2,
        'payment_type' => Input('paymentType'),
        'total' => $accumulate,
        'amount_paid' => $db->inc(Input('amount')),
    ];

    if(count($error) < 1) {
        if($db->where('id', Input('id'))->update('pos', $posdata)) {
            $m = "Successfully Edited";
            $s = 1;
            $db->commit();
        } else {
            $m = "Error ".$db->getLastError();
            $db->rollback();
        }
    } else {
        $m = $error[0];
        $db->rollback();
    }



echo json_encode(['m' => $m, 's' => $s]);

}


