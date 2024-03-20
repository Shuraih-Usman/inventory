<!-- Header Starts -->


<div class="content-wrapper">
    <!-- Container-fluid starts -->
    <div class="container-fluid">

        <div class="row">
            <div class="col-sm-12 p-0">
                <div class="main-header">
                    <h4>Setting</h4>
                    <ol class="breadcrumb breadcrumb-title breadcrumb-arrow">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i class="icofont icofont-home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="/c/setting">Setting</a>
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
                            <h5 class="card-header-text showingBy">Setting</h5>


                        </div>

                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">


                                <form id="changep" method="post" class="row">
                                <div class="col-md-12 m-b-1">
                                    <div class="form-control-wrapper">
                                        <span class="input-group-text">Username</span>
                                        <input name="username" type="text" id="" class="form-control floating-label" placeholder="" value="<?=$admin['username']?>">
                                    </div>
                                </div>
                                <div class="col-md-4 m-b-1">
                                    <div class="form-control-wrapper">
                                        <span class="input-group-text">Old Password</span>
                                        <input name="oldp" type="password" id="" class="form-control floating-label">
                                    </div>
                                </div>

                                    <div class="col-md-4 m-b-1">
                                        <div class="form-control-wrapper">
                                            <span class="input-group-text">New Password</span>
                                            <input name="newp" type="password" id="" class="form-control floating-label">
                                        </div>
                                    </div>

                                    <div class="col-md-4 m-b-1">
                                        <div class="form-control-wrapper">
                                            <span class="input-group-text">Confirm Password</span>
                                            <input name="confirmp" type="password" id="" class="form-control floating-label">
                                        </div>
                                    </div>

                                    <div class="col-md-12 m-t-1">
                                        <div class="form-control-wrapper">
                                            <input type="hidden" name="action" value="changepassword">
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

