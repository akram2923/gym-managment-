<?php

include "sidebar.php";
include "header.php";

?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Customer Payment</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title">Customer Payment</h5>
                    </div>
                    <form id="form_payroll" action="" method="post">
                        <div class="card-body py-0">
                            <div class="row">
                                <div class="col-md-6 border-right">
                                    <div class="alert alert-dismissible mt-4" role="alert" style="display: none"
                                        id="main_alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <div class="alert-message">

                                        </div>
                                    </div>
                                    <div class="form-group my-3">
                                        <label class="form-label" for="employee_id">Customer</label>
                                        <select class="form-control" id="employee_id" name="employee_id"  data-live-search="true" required>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="description">Description</label>
                                        <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label" for="amount">Amount</label>
                                        <input type="text" class="form-control" id="amount" name="amount" required>
                                    </div>
                                    <div class="form-group mb-5">
                                        <label class="form-label" for="invoice_no">Date</label>
                                        <input type="date" class="form-control" id="date" name="date" required
                                            value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>">
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <h4 class="font-weight-bold mt-3">Customer Info</h4>
                                    <table class="table table-borderless" id="tbl_payroll">
                                        <thead>
                                            <tr class="border-bottom">
                                                <th class="font-weight-bold">Type</th>
                                                <th id="type" class="text-right font-weight-bold"></th>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th class="font-weight-bold">Number</th>
                                                <th id="number" class="text-right font-weight-bold"></th>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th class="font-weight-bold">Status</th>
                                                <th id="title" class="text-right font-weight-bold"></th>
                                            </tr>
                                            <tr class="border-bottom">
                                                <th class="font-weight-bold">Fee</th>
                                                <th id="salary" class="text-right font-weight-bold">$0</th>
                                            </tr>
                                            <tr>
                                                <th class="font-weight-bold" colspan="100%"></th>
                                            </tr>
                                            <tr>
                                                <th colspan="100%">
                                                    <h4 class="font-weight-bold mb-0">Recent Payment</h4>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer border-top text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Pay Payment</button>
                            <button type="button" class="btn btn-secondary btn-lg">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php

include "footer.php";

?>

<script src="../script/customer_payment.js"></script>