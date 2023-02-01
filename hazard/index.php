<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="apple-touch-icon" sizes="76x76" href="css/img/apple-icon.png">
	<link rel="icon" type="image/png" href="../assets/img/favicon.png" sizes="32x32">
	<title>
		Sisakty ( Sistem Informasi & Aplikasi Safety )
	</title>
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<!-- Nucleo Icons -->
	<link href="css/css/nucleo-icons.css" rel="stylesheet" />
	<link href="css/css/nucleo-svg.css" rel="stylesheet" />
	<!-- Font Awesome Icons -->
	<script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
	<link href="css/css/nucleo-svg.css" rel="stylesheet" />
	<!-- CSS Files -->
	<link id="pagestyle" href="css/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="">
	<div class="container position-sticky z-index-sticky top-0">
		<div class="row">
			<div class="col-12">
				<!-- Navbar -->
				<nav class="navbar navbar-expand-lg blur blur-rounded top-0 z-index-3 shadow position-absolute my-3 py-2 start-0 end-0 mx-4">
					<div class="container-fluid">
						<a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 " href="../pages/dashboard.html">
							Sisakty ( Sistem Informasi & Aplikasi Safety )
						</a>
						<button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon mt-2">
								<span class="navbar-toggler-bar bar1"></span>
								<span class="navbar-toggler-bar bar2"></span>
								<span class="navbar-toggler-bar bar3"></span>
							</span>
						</button>
						<div class="collapse navbar-collapse" id="navigation">
							<ul class="navbar-nav mx-auto">
							</ul>
							<ul class="navbar-nav d-lg-block d-none">
								<li class="nav-item">
									<a href="../Sisakty v1.1.apk" class="btn btn-sm btn-round mb-0 me-1 bg-gradient-dark"><i class="fa fa-android" style="font-size: 13px"></i>&nbsp; Download Aplikasi</a>
								</li>
							</ul>
						</div>
					</div>
				</nav>
				<!-- End Navbar -->
			</div>
		</div>
	</div>
	<main class="main-content  mt-0">
		<section>
			<div class="page-header">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-6 col-md-6 d-flex flex-column mx-auto">
							<div class="card card-plain mt-12" style="margin-top: 5rem !important;">
								<div class="card-header pb-0 text-left bg-transparent">
									<img src="css/img/curved-images/logo.png" width="250px">
								</div>
								<div class="card-body">
									<div class="card">
										<div class="card-body">
											<h6 class="mb-3 text-sm">Laporan hazard terbaru ( MIP Site ) :</h6><hr>
											<?php  
											include '../controller/connection.php';
											@$sql = mysqli_query($conn,"SELECT * FROM hazard ORDER BY hazard_id DESC LIMIT 3"); 
											while(@$row = mysqli_fetch_array($sql)){
												?>
												<ul class="list-group">
													<li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
														<div class="d-flex">
															<div>
																<img src="css/img/curved-images/noimage.png" width="70px">
															</div>&emsp;
															<div class="d-flex flex-column">
																<h6 class="mb text-sm"><?= $row['hazard_name'];?></h6>
																<span class="mb text-xs"><?= $row['hazard_desc'];?></span>
															</div>
														</div>
													</li>
												</ul>
												<?php } ?>&emsp;
												<a class="text-body text-sm font-weight-bold mb-0 icon-move-right mt-auto">
													Selengkapnya
													<i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
												</a>
											</div>
										</div>
									</div>
									<div class="card-footer text-center pt-0 px-lg-2 px-1">
										<p class="mb-4 text-sm mx-auto">
											Copyright
											<a href="javascript:;" class="text-info text-gradient font-weight-bold">Mandiricoal.co.id 2021</a>
										</p>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
									<div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('css/img/curved-images/curved6.jpg')"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</main>

		<!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
		<!--   Core JS Files   -->
		<script src="css/js/core/popper.min.js"></script>
		<script src="css/js/core/bootstrap.min.js"></script>
		<script src="css/js/plugins/perfect-scrollbar.min.js"></script>
		<script src="css/js/plugins/smooth-scrollbar.min.js"></script>
		<script>
			var win = navigator.platform.indexOf('Win') > -1;
			if (win && document.querySelector('#sidenav-scrollbar')) {
				var options = {
					damping: '0.5'
				}
				Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
			}
		</script>
		<!-- Github buttons -->
		<script async defer src="https://buttons.github.io/buttons.js"></script>
		<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
		<script src="css/js/soft-ui-dashboard.min.js?v=1.0.3"></script>
	</body>

	</html>