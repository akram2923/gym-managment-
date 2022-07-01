<?php
session_start();

if (!isset($_SESSION['user_id'])) {
	header("Location: login.php");
}

?>

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
	<!-- <link href="../assets/css/modern.css" rel="stylesheet"> -->

	<!-- BEGIN SETTINGS -->
	<!-- You can remove this after picking a style -->
	<style>
		body {
			opacity: 0;
		}
	</style>
	<!-- <script src="../assets/js/settings.js"></script> -->
	<!-- END SETTINGS -->
<!-- Global site tag (gtag.js) - Google Analytics -->
<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-120946860-6"></script> -->
<!-- <script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-120946860-6');
</script> -->
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content ">
				<a class="sidebar-brand" href="index.html">
          <i class="align-middle" data-feather="box"></i>
          <b class="align-middle">Banadir fitness</b>
        </a>

				<ul class="sidebar-nav">
				

				
				

				<li class="sidebar-item">
						<a href="home.php"  class="sidebar-link ">
              <i class="align-middle" data-feather="grid"></i> Home</a>
					</li>
					<?php 
						if ($_SESSION['Privileges'] == "Admin")
						echo '<li class="sidebar-item">
						<a href="#user" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="grid"></i> <span class="align-middle">User</span>
            </a>
						<ul id="user" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="user.php">Manage User</a></li>
						</ul>
					</li>';
					?>

					<li class="sidebar-item">
						<a href="#Customer" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Customer</span>
            </a>
						<ul id="Customer" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="customer.php">Manage Customer</a></li>
						</ul>
					</li>

					<li class="sidebar-item">
						<a href="#payment" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Payment</span>
            </a>
						<ul id="payment" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="customer_payment.php">Customer Payment</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="customer_payment_manage.php">Manage Customer Payment</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="expense.php">Manage Expenses Payment</a></li>
						</ul>
					</li>
					
					
					<li class="sidebar-item">
						<a href="#Report" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="align-middle" data-feather="grid"></i> <span class="align-middle">Report</span>
            </a>
						<ul id="Report" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" href="report_customer_statement.php">Customer Statement Report</a></li>
						</ul>
					</li>
				</ul>
				

			</div>
		</nav>