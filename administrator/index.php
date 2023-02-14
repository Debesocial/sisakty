<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<title>SISAKTY Application</title>
	<!-- General CSS Files -->
	<link rel="stylesheet" href="../assets/super/css/app.min.css">
	<!-- Template CSS -->
	<link rel="stylesheet" href="../assets/super/css/style.css">
	<link rel="stylesheet" href="../assets/super/css/components.css">
	<!-- Custom style CSS -->
	<link rel="stylesheet" href="../assets/super/css/custom.css">
	<link rel="shortcut icon" href="../assets/img/favicons.png">
	<!-- sweet alert -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body style="line-height: 1.55;color: #33383d;">
	<div class="loader"></div>
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="row">
					<div class="col-12 col-md-10 offset-md-1 col-lg-10 offset-lg-1">
						<div class="login-brand">
							<img src="../assets/img/logor.png" width="30%">
						</div>
						<div class="card card-primary">
							<div class="row m-0">
								<div class="col-12 col-md-12 col-lg-5 p-0"><br>
									<div class="card-body" style="padding-top: 0px;"><br>
										<h3>Welcome to Sisakty, </h3>
										<h6>Sistem Informasi & Aplikasi Safety</h6><br>
										<form id="form-login" method="post" >
											<div class="form-group floating-addon">
												<div class="input-group">
													<select name="loginas" id="loginas"  class="form-control" required="">
														<option value="">- Masuk Sebagai -</option>
														<option value="KTT">Kepala Teknik Tambang (KTT)</option>
														<option value="Administrator">Safety MIP</option>
														<option value="Safety">Safety Mitra Kerja</option>
														<option value="PIC">Admin Divisi</option>
														<option value="Resepsionis">Resepsionis</option>
													</select>
												</div>
											</div>
											<div class="form-group floating-addon">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="far fa-user"></i>
														</div>
													</div>
													<input id="user" type="text" class="form-control" name="user" autofocus placeholder="User ID" required="">
												</div>
											</div>
											<div class="form-group floating-addon">
												<div class="input-group">
													<div class="input-group-prepend">
														<div class="input-group-text">
															<i class="fas fa-lock"></i>
														</div>
													</div>
													<input id="password" type="password" class="form-control" name="password" placeholder="Password" required="">
												</div>
											</div>
											<!-- <br> -->
											<div class="custom-control custom-checkbox">
												<input type="checkbox" class="custom-control-input" id="customCheck1" onclick="myFunction()">
												<label class="custom-control-label" for="customCheck1">Show Password</label>
											</div>
											<br>
											<div class="form-group">
												<button type="submit" id="login" name="login" class=" form-control btn btn-round btn-sm btn-primary">
													Login Now
												</button>
											</div>
											<br>
										</form>
									</div>
								</div>
								<div class="col-12 col-md-12 col-lg-7 p-0">
									<div class="card-body">
										<div style="background-color: #fff7af;color: #34393e;font-size: 10px;" class="alert alert-info alert-dismissible fade show" role="alert">
											<i class="fa fa-info-circle" style="line-height: 2;font-size: 10px;"></i><B> INFORMASI LOGIN</B><br>
											<strong>Kepala Teknik Tambang (KTT) &nbsp;:</strong> &nbsp;Pengguna adalah Kepala Teknik Tambang MIP<br>
											<strong>Safety MIP &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;:</strong> &nbsp;Pengguna adalah Divisi Safety MIP<br>
											<strong>Safety Mitra Kerja &emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;&nbsp;:</strong> &nbsp;Pengguna adalah Divisi Safety Mitra Kerja<br>
											<strong>Admin Divisi &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;:</strong> &nbsp;Pengguna adalah PIC dari masing-masing divisi<br>
											<strong>Resepsionis &emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;:</strong> &nbsp;Pengguna adalah Resepsionis / Security MIP<br>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div id="carouselExampleIndicators3" class="carousel slide" data-ride="carousel">
											<ol class="carousel-indicators">
												<li data-target="#carouselExampleIndicators3" data-slide-to="0" class="active"></li>
												<li data-target="#carouselExampleIndicators3" data-slide-to="1"></li>
												<li data-target="#carouselExampleIndicators3" data-slide-to="2"></li>
											</ol>
											<div class="carousel-inner">
												<div class="carousel-item active">
													<img class="d-block w-100" src="../assets/img/sample/photo/wide1.jpg" alt="First slide">
												</div>
												<div class="carousel-item">
													<img class="d-block w-100" src="../assets/img/sample/photo/wide2.jpg" alt="Second slide">
												</div>
												<div class="carousel-item">
													<img class="d-block w-100" src="../assets/img/sample/photo/wide5.jpg" alt="Third slide">
												</div>
											</div>
											<a class="carousel-control-prev" href="#carouselExampleIndicators3" role="button"
											data-slide="prev">
											<span class="carousel-control-prev-icon" aria-hidden="true"></span>
											<span class="sr-only">Previous</span>
										</a>
										<a class="carousel-control-next" href="#carouselExampleIndicators3" role="button"
										data-slide="next">
										<span class="carousel-control-next-icon" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="simple-footer">
					Copyright Mandiricoal.co.id 2021
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Informasi Login</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				Halaman ini merupakan halaman yang digunakan untuk mengelola laporan hazard dari aplikasi SISAKTY, Informasi login sebagai berikut :
				<table class="table"> 
					<tr>
						<td><b>Administrator</b></td>
						<td> : </td>
						<td>Safety MIP</td>
					</tr>
					<tr>
						<td><b>PIC Safety</b></td>
						<td> : </td>
						<td>User yang dipilih sebagai PIC dari divisi Safety</td>
					</tr>
					<tr>
						<td><b>PIC Divisi</b></td>
						<td> : </td>
						<td>User yang dipilih sebagai PIC dari masing-masing divisi</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
</div>


<script>
	function myFunction() {
		var x = document.getElementById("password");
		if (x.type === "password") {
			x.type = "text";
		} else {
			x.type = "password";
		}
	}
</script>

<!-- LOGIN -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#login").click(function(e){
			var valid = this.form.checkValidity();
			if (valid) {
				event.preventDefault();
				var loginas = $('#loginas').val();
				var data = $('#form-login').serialize();
				$.ajax({
					type    : 'POST',
					url     : 'action/action.php?action=login',
					data    : data,  
					success:function(response){
						if(response == 0){
							Swal.fire({
								title: 'Gagal!',
								icon:  'error',
								html:  '<small>Masukan User ID dan Password<br> yang sesuai</small>',
								confirmButtonText:
								'<i class="fa fa-thumbs-up"></i> Oke'
							});
						}else{ 
							if (loginas == 'Administrator') {
								window.location = "home.php?v=dashboard";
							} else if (loginas == 'Safety') {
								window.location = "user-mitra/home.php?v=dashboard";
							} else if (loginas == 'PIC') {
								window.location = "user-divisi/home.php?v=dashboard";
							}else if (loginas == 'KTT') {
								window.location = "user-ktt/home.php?v=dashboard";
							}else if (loginas == 'Resepsionis') {
								window.location = "user-resepsionis/home.php?v=visitor";
							}
						}
					}
				});
			}
		});
	});
</script>

<!-- General JS Scripts -->
<script src="../assets/super/js/app.min.js"></script>
<!-- JS Libraies -->
<script src="http://maps.google.com/maps/api/js?key=AIzaSyB55Np3_WsZwUQ9NS7DP-HnneleZLYZDNw&amp;sensor=true"></script>
<script src="../assets/super/bundles/gmaps.js"></script>
<!-- Page Specific JS File -->
<script src="../assets/super/js/page/contact.js"></script>
<!-- Template JS File -->
<script src="../assets/super/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="../assets/super/js/custom.js"></script>
</body>
</html>