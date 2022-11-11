
		<!-- Navbar -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<!-- <p>Jam Digital: <b><span id="jam" style="font-size:24"></span></b></p> -->
				</li>
				<li class="nav-item d-none d-sm-inline-block">
				<!-- <span id="jam" style="font-size:24"></span> -->
					<a href="#" class="nav-link"><?= date('d/m/Y') ?> <span id="jam" style="font-size:24"></span></a>
				</li>
			</ul>
			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- <li class="nav-item dropdown">
					<a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="nav-link dropdown-toggle"><i class="fa fa-fw fa-user"></i> <?= $this->session->userdata('name') ?></a>
					<ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow" style="left: 0px; right: inherit;">
						<li><a href="<?= base_url()?>myaccount" class="dropdown-item">Ganti Password</a></li>
						<li><a href="#" onclick="logout()" class="dropdown-item">Logout</a></li> -->
					<!-- End Level two -->
					<!-- </ul>
				</li> -->
				<li class="nav-item dropdown user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
						<img src="<?= base_url()?>assets/dist/img/user-128.png" class="user-image img-circle elevation-2" alt="User Image">
						<span class="d-none d-md-inline"><?= $this->session->userdata('name') ?></span>
					</a>
					<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
						<!-- User image -->
						<li class="user-header bg-primary">
							<img src="<?= base_url()?>assets/dist/img/user-128.png" class="img-circle elevation-2" alt="User Image">
							<!-- <i class="fa fa-fw fa-user"></i> -->
							<p>
								<?= $this->session->userdata('name') ?> - <?= $this->session->userdata('user_level') ?>
								<!-- <small>Member since Nov. 2012</small> -->
							</p>
						</li>
						<!-- Menu Body -->
						<!-- <li class="user-body">
							<div class="row">
								<div class="col-4 text-center">
									<a href="#">Followers</a>
								</div>
								<div class="col-4 text-center">
									<a href="#">Sales</a>
								</div>
								<div class="col-4 text-center">
									<a href="#">Friends</a>
								</div>
							</div>
						</li> -->
						<!-- Menu Footer-->
						<li class="user-footer">
							<a href="<?= base_url()?>myaccount" class="btn btn-default btn-flat">Ganti Password</a>
							<a href="#" onclick="logout()" class="btn btn-default btn-flat float-right">Logout</a>
						</li>
					</ul>
				</li>
			</ul>
		</nav>
		<!-- /.navbar -->