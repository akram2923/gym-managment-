<?php

include "sidebar.php";
include "header.php";

?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Customer Payment Management</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-0">
                        Customer Payment Management
                            <a href="customer_payment.php" class="btn btn-success float-right">
                                <i class="fas fa-plus-circle"></i>
                                New Payment
                            </a>
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
                            <table class="table table-striped" id="tbl_payroll">
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

<div class="modal fade" id="mdl_payroll" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit payment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" id="form_payroll">
                <div class="modal-body m-1">
                    <div class="alert alert-dismissible" role="alert" style="display: none" id="mdl_alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="alert-message">

                        </div>
                    </div>
                    <input type="hidden" id="payroll_id" name="payroll_id">
                    <div class="form-group">
                        <label class="form-label" for="employee_id">Customer</label>
                        <select class="form-control" id="employee_id" name="employee_id" required disabled>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"
                            placeholder="Description"></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="amount">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount"
                            placeholder="Amount">
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

<script src="../script/customer_payment_manage.js"></script>