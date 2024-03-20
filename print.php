<?php

require_once __DIR__.'/config/init.php';
use Dompdf\Dompdf;
$html = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <!-- Favicon icon -->
    <link rel="shortcut icon" href="'.APP_URL.'/assets/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="'.APP_URL.'assets/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="'.APP_URL.'/assets/plugins/bootstrap/css/bootstrap.min.css">
    <title>Print Receipt</title>
    
    <style>
    body {
    font-family: "Roboto Thin";
    margin:2px 2px;
    padding: 2px 2px;
    border: 2px solid #000000;
    }
    
    .line {
    background-color: #000000;
    border: 2px solid #000000;
    margin:5px 5px;
    }
    table {
    width: 100%;
    padding: 5px 5px;
    font-weight: bolder;
    }
    
    td,th {
    border: 1px solid #000;
    padding: 5px 5px;

    }
    b {
    color: #000000;
    }
    
    p, h2, h3, h1, {
    margin-bottom: 2px;
    margin-top: 2px;
    }
    
    h2 {padding-top:2px;
    padding-bottom: 2px;
    }
    
    
</style>
    </head>
    <body>
   

';



$ref = Input('ref');

if(!$ref || !$db->where('reference', $ref)->get('pos')) {
    Redirect('/');
} else {
    $db->join("product u", "p.product_id=u.id", "LEFT");
    $data = $db->where('reference', $ref)->get('product_order p', null, 'p.*, u.name, u.tax as p_tax, u.discount as p_dis');
    $order = $db->where('reference', $ref)->getOne('pos');

    $html .= '<div class="row">
<div class="col-12">
<center style="text-align: center">
<h2 class=""><b>U&U RIMI GLOBAL VENTURE </b></h2>
<h4> <b>AND CLASSY COSMETICS SUPPLY</b></h4>
<div class="line"></div>
<p style="font-size: 18px; margin-bottom: 3px;"><b>Address: </b>'.ADDRESS.'</p>
<p style="font-size: 18px; "><b>Contact: </b>'.NUMBER.'</p>

</center>

<div class="row" style="border: 2px dotted #000000;margin:20px 20px; padding: 10px 10px;">

<p class="col-sm-3" style="float: left; font-size: 18px; "><b>Date: </b>'.date("Y-m-d h:i:s A",  strtotime($order['created_at'])).'</p>
<p class="col-sm-3" style="float: right;font-size: 18px; "><b>Customer Name: </b>'.$order['customer_name'].'</p>
<div style="clear: both;"></div>

<p class="col-sm-3" style="float: left;font-size: 18px; "><b>Reference ID: </b>'.$order['reference'].'</p>
<p class="col-sm-3" style="float: right;font-size: 18px; "><b>Customer Number: </b>'.$order['customer_phone'].'</p>
<div style="clear: both;"></div>
<h3 class="col-sm-12" style="background-color: #000000; color: #FFFFFF; text-align: center; padding: 5px 5px;">
PAYMENT RECEIPT
</h3>

<table class="col-sm-12">
<thead>
<tr>
<th>No.</th>
<th>Name</th>
<th>Code</th>
<th>QTY</th>
<th>Price</th>
<th>Total</th>
</tr>
</thead>
<tbody>';

$s = 1;
$totalAll = 0;

    foreach ($data as $row) {
        $discount = ($row['price']  * $row['discount']) / 100;
        $tax = (($row['price'] - $discount) * floatval($row['tax'])) / 100;
        $total = $row['quantity'] * ($row['price'] - $discount + $tax);
//        $total = $row['quantity'] * $row['price'];
        $html .= '<tr>
        <td>'.$s++.'</td>
        <td>'.$row['name'].'</td>
        <td>'.$row['product_code'].'</td>
        <td>'.$row['quantity'] .'</td>
        <td>N'.$row['price'] .'</td>
        <td>N'.round($total, 2).'</td>
        </tr>';
            }
    $tprice2 = 0;
    $tprice = 0;
    $disc = 0;
    $taxx = 0;
    foreach ($data as $row) {
        $discount = $row['discount'] ?? 0;
        $tax = floatval($row['tax']) ?? 0;

        $disc += $row['discount'];
        $taxx += $tax;

        $discountAmount = ($row['price'] * $discount) / 100;

        $taxAmount = (($row['price'] - $discountAmount) * $tax) / 100;

        // Calculate total price for the item including discount and tax
        $itemTotalPrice = $row['quantity'] * ($row['price'] - $discountAmount + $taxAmount);


        $tprice2 += $itemTotalPrice;
        $tprice += $row['quantity'] * $row['price'];
    }

    $status = (round($tprice2, 2) - $order['amount_paid']) > 0 ? "Not Cleared" : "Paid / Cleared";


 $html .= '</tbody>
</table> <br>';
    $html .= '<table class="col-sm-12">
<tbody>
<tr>
<td><b>Total Items</b></td> <td>'.count($data).'</td> 
<td><b>Total Price</b></td> <td>N'.$tprice.'</td>
<td><b>Discount</b></td>  <td>'.$disc.'</td> 
<td><b>Tax</b></td> <td>'.$taxx.'</td> 
</tr>
</tbody>
</table>
<br>

<table class="col-sm-12">
<tbody>
<tr>
<td><b>Accumulate Price</b></td> <td>N'.round($tprice2, 2).'</td>
<td><b>Amount Paid</b></td> <td>N'.round($order['amount_paid'], 2).'</td>
</tr><tr>
<td><b>Due Remain</b></td> <td>N'.round($tprice2, 2) - $order['amount_paid'].'</td>
<td><b>Status</b></td> <td>'.$status.'</td>
</tr>
</tbody>
</table>

<div style="display: flex; justify-content: space-around; text-align: center;"> 
<p class="col-sm-4 m-t-2" style="float: left; font-size: 18px; padding-left: 5px;"><b>INVOICE NUMBER: </b>'.$order['id'].'</p>
<p class="col-sm-4 m-t-2" style="float: right; font-size: 18px; padding-left: 5px;"><b>Payment Type: </b>'.$order['payment_type'].'</p>
<div style="clear: both;"></div>
<p class="col-sm-4 m-t-2" style=" font-size: 18px; padding-left: 5px;"><b>Signature: </b>______________</p>

</div>
    </div>
    <p style="padding-left: 10px; text-align: center;"> Receive the above goods in good condition, no refund after payment. Goods once sold will not be taken back or exchange</p>
    <p style="padding-left: 10px; text-align: center;"> Thanks for your patronage, come back again.</p>


</div>


                </div>
';





$html .= '


</body>
    </html>';


    $dompdf = new Dompdf();
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $dompdf->stream('example.pdf', array('Attachment' => 0));


}
?>

