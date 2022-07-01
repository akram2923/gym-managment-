

<div class="main">
			<nav class="navbar navbar-expand navbar-light bg-white">
				<a class="sidebar-toggle d-flex mr-2">
          <i class="hamburger align-self-center"></i>
        </a>


				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ml-auto">
					
						
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                <img src="../assets/img/avatars/user1.png" class="avatar img-fluid rounded-circle mr-1" alt="Chris Wood" /> <span class="text-dark"><?php if(isset($_SESSION['name'])) echo $_SESSION['name']; ?></span>
              </a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="logout.php">Sign out</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>