<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="Bootlab">

    <title>Banadir fitness - Admin System</title>

    <link rel="preconnect" href="http://fonts.gstatic.com/" crossorigin>

    <!-- PICK ONE OF THE STYLES BELOW -->
    <link href="../assets/css/classic.css" rel="stylesheet">
    <!-- <link href="css/corporate.css" rel="stylesheet"> -->
    <!-- <link href="css/modern.css" rel="stylesheet"> -->

    <!-- BEGIN SETTINGS -->
    <!-- You can remove this after picking a style -->
    <style>
    body {
        opacity: 0;
    }
    </style>
    <!-- END SETTINGS -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-6"></script>
    <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-120946860-6');
    </script>
</head>

<body>
    <main class="main d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row h-100">
                <div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-4">
                            <h1 class="h2">Welcome back, Banadir fitness System</h1>
                            <p class="lead">
                                Sign in to your account to continue
                            </p>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="m-sm-4">
                                    <div class="text-center">
                                        <img src="../assets/img/avatars/login1.png" alt="Bandir"
                                            class="img-fluid rounded-circle" width="132" height="132" />
                                    </div>
                                    <form id="form_login" method="post" action="">
                                        <div class="alert alert-dismissible" role="alert" style="display: none"
                                            id="main_alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                            <div class="alert-message">

                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control form-control-lg" type="text" name="username"
                                                id="username" placeholder="Enter your username" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input class="form-control form-control-lg" type="password" name="password"
                                                id="password" placeholder="Enter your password" />
                                            <small>
                                            </small>
                                        </div>
                                        <div class="text-center mt-3">
                                            <button type="submit" class="btn btn-lg btn-primary">Sign in</button>
                                            <!-- <button type="submit" class="btn btn-lg btn-primary">Sign in</button> -->
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="../assets/js/app.js"></script>
    <script src="../script/login.js"></script>

</body>


</html>