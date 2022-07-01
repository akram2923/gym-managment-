<?php

include "sidebar.php";
include "header.php";

if ($_SESSION['Privileges'] != "Admin" ) {
    echo "<script> history.back() </script>";
}

?>


<main class="content">
    <div class="container-fluid p-0">

        <h1 class="h3 mb-3">User Management</h1>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-bottom">
                        <h5 class="card-title mb-0">
                            User Management
                            <button class="btn btn-success float-right" id="new_modal">
                                <i class="fas fa-plus-circle"></i>
                                New User
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
                            <table class="table table-striped" id="tbl_user">
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

<div class="modal fade" id="mdl_user" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New / Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="" id="form_user">
                <div class="modal-body m-1">
                    <div class="alert alert-dismissible" role="alert" style="display: none" id="mdl_alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <div class="alert-message">

                        </div>
                    </div>
                    <input type="hidden" id="user_id" name="user_id">
                    <div class="form-group">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                            placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="text" class="form-control" id="password" name="password"
                            placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="status">Status</label>
                        <select class="form-control" id="status" name="status">
                            <option value="Active">Active</option>
                            <option value="InActive">InActive</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="Privileges">Privileges</label>
                        <select class="form-control" id="Privileges" name="Privileges">
                            <option value="Admin">Admin</option>
                            <option value="User">User</option>
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

<script src="../script/user.js"></script>