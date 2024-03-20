<?php
require_once __DIR__.'/../../config/init.php';

$title = "Edit Order";

$id = Input('id');

$item = $db->where('id', $id)->getOne('pos');

$db->join('product', 'p.product_id=product.id', 'INNER');
$products = $db->where('reference', $item['reference'])->get('product_order p', null, 'p.*, product.name');




require_once $template.'/header.php';
require_once $template.'/edit-order.php';
require_once $template.'/footer.php';