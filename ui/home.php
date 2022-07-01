<?php

include "sidebar.php";
include "header.php";

?>


<main class="content">
    <div class="container-fluid p-0">

    
        <h1 class="h3 mb-3">Dashboard</h1>

        <div class="row">
						<div class="col-12 col-sm-6 col-xxl-3 d-flex">
							<div class="card illustration flex-fill">
								<div class="card-body p-0 d-flex flex-fill">
									<div class="row g-0 w-100">
										<div class="col-6">
											<div class="illustration-text p-3 m-1">
												<h4 class="illustration-text">Welcome Back, <span><?php if(isset($_SESSION['username'])) echo $_SESSION['username']; ?></span>!</h4>
												<p class="mb-0">Banadir fitness Dashboard</p>
											</div>
										</div>
										<div class="col-6 align-self-end text-end">
											<img src="../assets/img/avatars/customer-support.png" alt="Customer Support" class="img-fluid illustration-img">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-xxl-3 d-flex">
							<div class="card flex-fill">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Income</h5>
										</div>

										<div class="col-auto">
											<div class="stat stat-sm">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign align-middle text-success"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
											</div>
										</div>
									</div>
									<span class="h1 d-inline-block mt-1 mb-3" id="income"></span>
									<div class="mb-0">
										<span class="text-muted">Since this Year</span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-xxl-3 d-flex">
							<div class="card flex-fill">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Active</h5>
										</div>

										<div class="col-auto">
											<div class="stat stat-sm">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity align-middle"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
											</div>
										</div>
									</div>
									<span class="h1 d-inline-block mt-1 mb-3" id="Active"></span>
									<div class="mb-0">
										<span class="text-muted">Active Customers</span>
									</div>
								</div>
							</div>
						</div>
                        <div class="col-md-6 col-xxl-3 d-flex">
							<div class="card flex-fill">
								<div class="card-body">
									<div class="row">
										<div class="col mt-0">
											<h5 class="card-title">Inactive</h5>
										</div>

										<div class="col-auto">
											<div class="stat stat-sm">
												<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-activity align-middle"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
											</div>
										</div>
									</div>
                                    <span class="h1 d-inline-block mt-1 mb-3" id="Inactive"></span>
									<div class="mb-0">
										<span class="text-muted">Inactive Customers</span>
									</div>
								</div>
							</div>
						</div>
					</div>
    </div>
</main>


<?php

include "footer.php";

?>

<script src="../script/home.js"></script>