<!-- Header Starts -->


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
                        <li class="breadcrumb-item"><a href="/c/category">Category</a>
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
                        <button type="button" class="btn btn-primary waves-effect waves-light mb-5" style="margin-bottom: 10px;" data-toggle="modal" data-target="#add"><span class="tf-icons mdi mdi-plus me-1 mb-3"></span> Add Category</button>
                        <div style="display: flex;justify-content: space-between;" class="mb-0 d-flex justify-content-around">
                            <h5 class="card-header-text showingBy">All Category</h5>

                            <div class="">
                                <div class="dropdown-primary dropdown">
                                    <button class="btn btn-info dropdown-toggle waves-effect waves-light " type="button" id="dropdown1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdown1" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <a class="dropdown-item waves-light waves-effect activateAll" href="javascript:void(0);">Activate All</a>
                                        <a class="dropdown-item waves-light waves-effect draftAll" href="javascript:void(0);">Draft All</a>
                                    </div>


                                </div>

                                <div class="dropdown-primary dropdown">
                                    <button class="btn btn-info dropdown-toggle waves-effect waves-light " type="button" id="dropdown2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Showing By
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdown2" data-dropdown-in="fadeIn" data-dropdown-out="fadeOut">
                                        <a class="dropdown-item waves-light waves-effect showAll" href="javascript:void(0);">Show All</a>
                                        <a class="dropdown-item waves-light waves-effect showActive" href="javascript:void(0);">Active</a>
                                        <a class="dropdown-item waves-light waves-effect showDraft" href="javascript:void(0);">Draft</a>

                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                    <div class="card-block">
                        <div class="row">
                            <div class="col-sm-12 table-responsive">
                                <table id="dataTable" class="table table-striped table-bordered nowrap reports " width="100%" cellspacing="0" data-table="category" data-filter="ALL">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>



                                    </tbody>
                                </table>
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

<div class="modal fade" id="add" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">Add Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="insert" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Name</label>
                                <input type="text" name="name" class="form-control" id="name" aria-describedby="name" placeholder="Enter Category Name">

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="rkmd-checkbox checkbox-rotate checkbox-ripple">
                                <label class="input-checkbox checkbox-success">
                                    <input type="checkbox" id="status" name="status" checked>
                                    <span class="checkbox"></span>
                                </label>
                                <div class="captions">Status</div>
                            </div>
                        </div>

                        <input type="hidden" name="action" value="add">
                        <div class="col-sm-6">
                            <button type="submit" id="add-button" class="btn btn-success waves-effect waves-light">Submit
                            </button>
                        </div>
                    </div>
                </form>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLabel">Edit Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="insert" method="post">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="form-control-label">Name</label>
                                <input type="text" name="name" class="form-control" id="editname" aria-describedby="name" placeholder="Enter Category Name">

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="status-switch">
                            </div>
                        </div>

                        <input type="hidden" name="action" value="edit">
                        <input type="hidden" id="RowID" name="id">
                        <div class="col-sm-6">
                            <button type="submit" id="add-button" class="btn btn-success waves-effect waves-light">Submit
                            </button>
                        </div>
                    </div>
                </form>



            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<!-- End Bootstrap Modal -->

