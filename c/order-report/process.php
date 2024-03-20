<?php
require_once __DIR__.'/../../config/init.php';
header("Content-Type: application/json");
$action = Input('action');

if($action == 'sale_report') {
    $s = 0;
    $start = Input('start_date');
    $end = Input('end_date');

    $db->where('created_at', array($start . ' 00:00:00', $end . ' 23:59:59'), 'BETWEEN');
    $results = $db->get('pos');

   if(count($results) > 1) {
       $m = "";
       $items = [];
       $items = [["Customer Name", "Customer Number", "Reference", "Invoice", "Total", "Amount Paid", "Tax", "Discount", "Quantity", "Total Items", "Payment Type", "Date"]];
       foreach ($results as $item) {

           $product = $db->where('reference', $item['reference'])->get('product_order');
           $quantity = 0;

           foreach ($product as $pr) {
               $quantity += $pr['quantity'];
           }

           $items[] = [$item['customer_name'], $item['customer_phone'], $item['reference'], $item['id'], $item['total'], $item['amount_paid'], $item['tax'], $item['discount'], $quantity, count($product), $item['payment_type'], $item['created_at'] ];
            }

       $csvname = $start."_to_".$end."_sale_report.csv";
       ob_start();

       $csvfile = fopen('php://output', 'w');

       foreach($items as $row) {
           fputcsv($csvfile, $row);
       }

       fclose($csvfile);
       $content = ob_get_clean();

       header("Content-Type: text/csv");
       header('Content-Disposition: attachment; filename="' . $csvname . '"');
       echo $content;



   } else {
       $csvname = $start."_to_".$end."_sale_report.csv";
       ob_start();

       $csvfile = fopen('php://output', 'w');
       $items= [["No any sale in this date range"]];
       foreach($items as $row) {
           fputcsv($csvfile, $row);
       }

       fclose($csvfile);
       $content = ob_get_clean();

       header("Content-Type: text/csv");
       header('Content-Disposition: attachment; filename="' . $csvname . '"');
       echo $content;
   }


}

