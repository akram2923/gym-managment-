<?php

include "sidebar.php";
include "header.php";

?>


<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Customer Management</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-0">
                            Customer Management
                            <button class="btn btn-success float-right" id="new_modal">
                                <i class="fas fa-plus-circle"></i>
                                New Customer
                            </button>
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-dismissible" role="alert" style="display: none" id="main_alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="alert-message">

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped" id="tbl_employee">
                                <thead>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<div class="modal fade" id="mdl_employee" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New / Edit Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" id="form_employee">
                <div class="modal-body m-1">
                    <div class="alert alert-dismissible" role="alert" style="display: none" id="mdl_alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="alert-message">

                        </div>
                    </div>
                    <input type="hidden" id="employee_id" name="employee_id">
                    <div class="form-group">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="Number">Number</label>
                        <input type="text" class="form-control" id="Number" name="Number"
                            placeholder="Number">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="status">status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="fee">fee</label>
                        <input type="text" class="form-control" id="fee" name="fee"
                            placeholder="fee">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="type">Type</label>
                        <select class="form-control" id="type" name="type">
                            <option value="Morning">Morning</option>
                            <option value="Afternoon">Afternoon</option>
                            <option value="Night">Night</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="date">Date</label>
                        <input type="date" class="form-control" id="date" name="date" placeholder="Date Register"
                            value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php

include "footer.php";

?>

<script src="../script/customer.js"></script>