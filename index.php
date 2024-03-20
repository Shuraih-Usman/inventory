<?php

require_once __DIR__.'/config/init.php';
require_once __DIR__.'/Template/header.php';
?>



    <!-- Header Starts -->


    <div class="content-wrapper">
        <!-- Container-fluid starts -->
        <div class="container-fluid">

            <div class="row">
                <div class="col-sm-12 p-0">
                    <div class="main-header">
                        <h4>Dashboard</h4>
                        <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                            <li class="breadcrumb-item">
                                <a href="/">
                                    <i class="icofont icofont-home"></i>
                                </a>
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

                            <div style="display: flex;justify-content: space-between;" class="mb-0 d-flex justify-content-around">
                                <h5 class="card-header-text showingBy">Stats</h5>


                            </div>

                        </div>
                        <div class="card-block">
                                <div class="row">
                                    <!-- Line Chart start -->
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-header-text">Total Sales</h5>
                                            </div>
                                            <div class="card-block">
                                                <div id="line-example">
                                            </div>
                                        </div>
                                    </div></div>
                                    <!-- Line Chart end -->

                                    <!-- Area Chart start -->
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-header-text">Monthly Stats</h5>
                                            </div>
                                            <div class="card-block">
                                                <div id="area-example">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- Area Chart end -->

                                    <!-- Donut chart start -->
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="card-header-text">Montly Profit and Loss</h5>
                                            </div>
                                            <div class="card-block">
                                                <div id="donut-example"></div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- Donut chart end -->
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









<?php
require_once __DIR__.'/Template/footer.php';

$yearly = $db->get('pos');

$monthly = $db->rawQuery("SELECT * FROM product_order WHERE MONTH(created_at) = ?", array(date('m')));


$totalprice = 0;
$totalprofit = 0;
$totalloss = 0;
$cost = 0;

foreach ($monthly as $row) {
    $discount = ($row['price']  * $row['discount']) / 100;
    $tax = (($row['price'] - $discount) * floatval($row['tax'])) / 100;
    $total = $row['quantity'] * ($row['price'] - $discount + $tax);

    $totalprice += $total;

    $item = $db->where('id', $row['product_id'])->getOne('product');
    $cc = $item['cost_price'] * $row['quantity'];
    $cost += $cc;



}

$totalprofit = $totalprice - $cost;

if($totalprofit < 1) {
    $totalloss += $totalprofit;
}



?>

<script>
    "use strict";
    $(document).ready(function() {

        lineChart();
        areaChart();
        donutChart();

        $(window).resize(function() {
            window.lineChart.redraw();
            window.areaChart.redraw();
            window.donutChart.redraw();
        });
    });

    /*Line chart*/
    function lineChart() {
        window.lineChart = Morris.Line({
            element: 'line-example',
            data: [
                <?php foreach($yearly as $item): ?>
                { y: '<?php echo date('Y/m', strtotime($item['created_at'])) ?>', a: <?php echo $item['total'] ?>, b: <?php echo $item['total'] - $item['amount_paid'] ?> },
                <?php endforeach;?>
            ],
            xkey: 'y',
            redraw: true,
            ykeys: ['a', 'b'],
            labels: ['Total', 'Credit'],
            lineColors :['#2196F3','#ff5252']
        });
    }

    /*Area chart*/
    function areaChart() {
        window.areaChart = Morris.Area({
            element: 'area-example',
            data: [
                <?php foreach($monthly as $row): ?>
                <?php

                $discount = ($row['price']  * $row['discount']) / 100;
                $tax = (($row['price'] - $discount) * floatval($row['tax'])) / 100;
                $total = $row['quantity'] * ($row['price'] - $discount + $tax);




                ?>

                { y: '<?php echo date('d', strtotime($row['created_at'])) ?>', a: <?php echo $total ?>, b: <?php echo $row['quantity'] ?> },
                <?php endforeach;?>
            ],
            xkey: 'y',
            resize: true,
            redraw: true,
            ykeys: ['a', 'b'],
            labels: ['Total', 'Quantity'],
            lineColors :['#40c4ff','#f57c00']
        });
    }

    /*Donut chart*/
    function donutChart() {
        window.areaChart = Morris.Donut({
            element: 'donut-example',
            redraw: true,
            data: [
                {label: "Total Sales", value: <?php echo $totalprice; ?>},
                {label: "Total Profit", value: <?php echo $totalprofit; ?>},
                {label: "Total Loss", value: <?php echo $totalloss; ?>}
            ],
            colors : ['#40c4ff','#ff5252','#4CAF50']
        });
    }






</script>
