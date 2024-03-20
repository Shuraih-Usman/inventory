<!-- Header Starts -->


<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Sales Report</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="/c/order-report">Sales Report</a>
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
                            <h5 class="card-header-text showingBy">Sales Report</h5>


                        </div>

                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <?php
                                if(isset($s) AND $s == 1) {
                                    echo '<div class="alert alert-success">
'.$m.'
                                </div>';
                                } else if(isset($s) AND $s != 1) {
                                    echo '<div class="alert alert-danger">
'.$m.'
                                </div>';
                                }
                                ?>




                                <form action="order-report/process.php" method="post" class="row">
                                <div class="col-md-4">
                                    <div class="form-control-wrapper">
                                        <span class="input-group-text">Start Date</span>
                                        <input name="start_date" type="text" id="date-start" class="form-control floating-label" placeholder="Start Date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-control-wrapper">
                                        <span class="input-group-text">End Date</span>
                                        <input name="end_date" type="text" id="date-end" class="form-control floating-label" placeholder="End Date">
                                    </div>
                                </div>

                                    <div class="col-md-4">
                                        <div class="form-control-wrapper">
                                            <span class="input-group-text">Download Report</span>
                                            <input type="hidden" name="action" value="sale_report">
                                            <button style="display: block;" class="btn btn-primary" type="submit" id="">Submits</button>
                                        </div>
                                    </div>

                                </form>



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

