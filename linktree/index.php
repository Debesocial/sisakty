<?php
@session_start();
$timeout = 15;
$logout  = "home.php?v=login"; 
$timeout = $timeout * 60;
if(@$_SESSION['user_pic'] != 'X'){
	if(isset($_SESSION['start_session'])){
		$elapsed_time = time()-$_SESSION['start_session'];
		if($elapsed_time >= $timeout){
			session_unset();
			session_destroy();
			header("location:home.php?v=login");
		}
	}
	$_SESSION['start_session']=time();
} else {
	session_unset();
	session_destroy();
	header("location:home.php?v=login");
}?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta name="apple-mobile-web-app-status-bar-style" content="default">
	<meta name="format-detection" content="telephone=no">
	<meta name="theme-color" content="#ff3f3f">
	<title>Sisakty - Sistem Informasi & Aplikasi Safety</title>
	<meta name="description" content="eMobile - Multipurpose HTML5 Template">
	<!-- favicon -->
	<link rel="icon" type="image/png" href="../assets/img/favicon/favicon.png" sizes="32x32">
	<link rel="apple-touch-icon" href="../assets/img/favicon/favicon.png">
	<!-- CSS Libraries-->
	<!-- bootstrap v4.6.0 -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<!--  theiconof v3.0 https://www.theiconof.com/search -->
	<link rel="stylesheet" href="../assets/css/icons.css">
	<!-- Swiper 6.4.11 -->
	<link rel="stylesheet" href="../assets/css/swiper-bundle.min.css">
	<!-- Owl Carousel v2.3.4 -->
	<link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
	<!-- Custom styles for this template -->
	<link rel="stylesheet" href="../assets/css/main.css">
	<!-- normalize.css v8.0.1 -->
	<link rel="stylesheet" href="../assets/css/normalize.css">
	<!-- manifest meta -->
	<!-- <link rel="manifest" href="_manifest.json" /> -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
	<!-- sweet alert -->
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body  style="background-color: #f6f6f6;">

	<!-- Loader -->
	<section class="em_loading" id="loaderPage">
		<div class="spinner_flash"></div>
	</section>
	<!-- End Loader -->

	<!-- Content -->
	<div id="wrapper">
		<div id="content">
			<?php 
			@include '../controller/connection.php';
			@$_login 	= $_SESSION['login'];
			@$_email 	= $_SESSION['user_email'];
			@$_phone 	= $_SESSION['user_phone'];
			@$_password = $_SESSION['user_password'];
			@$_id 		= $_SESSION['user_id'];
			@$_nik 		= $_SESSION['user_nik'];
			@$_level 	= $_SESSION['user_level'];
			@$_name 	= $_SESSION['user_name'];
			@$_pic 		= $_SESSION['user_pic'];
			@$_dept 	= $_SESSION['dept_name'];
			@$_divisi 	= $_SESSION['divisi_name'];
			@$_comp 	= $_SESSION['comp_name'];
			@$_pic 		= $_SESSION['user_pic'];
			@$_divisiid = $_SESSION['user_divisi'];
			@$_compid 	= $_SESSION['user_comp'];
			@$result	= mysqli_fetch_array($conn->query("SELECT * FROM user where user_nik = '$_nik'"));
			@include 'dashboard.php';
			@include 'modal.php';
			?>
		</div>
	</div>
	<!-- End Content -->

	<!-- TIMELINE -->
	<style>
		* {
			box-sizing: border-box;
		}

		/* The actual timeline (the vertical ruler) */
		.timeline {
			position: relative;
			max-width: 1200px;
			margin: 0 auto;
		}

		/* The actual timeline (the vertical ruler) */
		.timeline::after {
			content: '';
			position: absolute;
			width: 6px;
			background-color: white;
			top: 0;
			bottom: 0;
			left: 50%;
			margin-left: -3px;
		}

		/* Container around content */
		.container {
			padding: 10px 40px;
			position: relative;
			background-color: inherit;
			width: 50%;
		}

		/* The circles on the timeline */
		.container::after {
			content: '';
			position: absolute;
			width: 25px;
			height: 25px;
			right: -17px;
			background-color: white;
			border: 4px solid #FF9F55;
			top: 15px;
			border-radius: 50%;
			z-index: 1;
		}

		/* Place the container to the left */
		.left {
			left: 0;
		}

		/* Place the container to the right */
		.right {
			left: 50%;
		}

		/* Add arrows to the left container (pointing right) */
		.left::before {
			content: " ";
			height: 0;
			position: absolute;
			top: 22px;
			width: 0;
			z-index: 1;
			right: 30px;
			border: medium solid white;
			border-width: 10px 0 10px 10px;
			border-color: transparent transparent transparent white;
		}

		/* Add arrows to the right container (pointing left) */
		.right::before {
			content: " ";
			height: 0;
			position: absolute;
			top: 22px;
			width: 0;
			z-index: 1;
			left: 30px;
			border: medium solid white;
			border-width: 10px 10px 10px 0;
			border-color: transparent white transparent transparent;
		}

		/* Fix the circle for containers on the right side */
		.right::after {
			left: -16px;
		}

		/* The actual content */
		.content {
			padding: 5px 30px;
			background-color: white;
			position: relative;
			border-radius: 6px;
		}

		/* Media queries - Responsive timeline on screens less than 600px wide */
		@media screen and (max-width: 600px) {
			/* Place the timelime to the left */
			.timeline::after {
				left: 31px;
			}

			/* Full-width containers */
			.container {
				width: 100%;
				padding-left: 70px;
				padding-right: 25px;
			}

			/* Make sure that all arrows are pointing leftwards */
			.container::before {
				left: 60px;
				border: medium solid white;
				border-width: 10px 10px 10px 0;
				border-color: transparent white transparent transparent;
			}

			/* Make sure all circles are at the same spot */
			.left::after, .right::after {
				left: 15px;
			}

			/* Make all right containers behave like the left ones */
			.right {
				left: 0%;
			}
		}
	</style>

	<!-- Alert -->
	<script type="text/javascript">
		function commingsoon() {
			Swal.fire({
				title: 'Coming Soon !',
				icon: 'info',
				focusConfirm: false,
				confirmButtonText:
				'<i class="fa fa-thumbs-up"></i> Oke'
			});
		}
	</script>

	<!-- jquery -->
	<script src="../assets/js/jquery-3.6.0.js"></script>
	<!-- popper.min.js 1.16.1 -->
	<script src="../assets/js/popper.min.js"></script>
	<!-- bootstrap.js v4.6.0 -->
	<script src="../assets/js/bootstrap.min.js"></script>
	<!-- Owl Carousel v2.3.4 -->
	<script src="../assets/js/vendor/owl.carousel.min.js"></script>
	<!-- Swiper 6.4.11 -->
	<script src="../assets/js/vendor/swiper-bundle.min.js"></script>
	<!-- sharer 0.4.0 -->
	<script src="../assets/js/vendor/sharer.js"></script>
	<!-- short-and-sweet v1.0.2 - Accessible character counter for input elements -->
	<script src="../assets/js/vendor/short-and-sweet.min.js"></script>
	<!-- jquery knob -->
	<script src="../assets/js/vendor/jquery.knob.min.js"></script>
	<!-- main.js -->
	<script src="../assets/js/main.js" defer></script>
	<!-- PWA app service registration and works js -->
	<script src="../assets/js/pwa-services.js"></script>
	<!-- indicator tab -->
	<script src="assets/js/indicator-tab.js"></script>
</body>
</html>