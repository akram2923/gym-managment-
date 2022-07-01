<?php

include "sidebar.php";
include "header.php";

?>

<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">Report Customer Statement</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title">Report Customer Statement</h5>
                    </div>
                    <form id="form_statement" action="" method="post">
                        <div class="card-body">
                            <div class="alert alert-dismissible" role="alert" style="display: none" id="main_alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="alert-message">

                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="customer_id">Customer</label>
                                    <select class="form-control" id="customer_id" name="customer_id" required>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="date_type">Type</label>
                                    <select class="form-control" id="date_type" name="date_type" required>
                                        <option value="All">All Date</option>
                                        <option value="Custom">Custom</option>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="start_date">Start Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required
                                        value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label" for="end_date">End Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" required
                                        value="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                            <br>
                            <div class="text-center">
                                <button type="submit" id="generate" class="btn btn-info btn-lg">Generate</button>
                            </div>
                            <br>
                            
                            <div id="report_area">
                                <h2 align="center"> <b> Report Customer Statement </b> </h2>
                                <br>
                                <table class="table table-bordered" id="tbl_statement" border="1" cellspacing="0" cellpadding="5px" width="100%" style="border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <th> Date </th>
                                            <th> Type </th>
                                            <th> Description </th>
                                            <th> Amount </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer border-top text-center">
                            <button type="button" class="btn btn-success btn-lg" id="print">Print</button>
                            <button type="button" class="btn btn-primary btn-lg" id="export">Export</button>
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

<script src="../script/report_customer_statement.js"></script>