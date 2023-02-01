<?php
@session_start();
$timeout = 15;
$logout  = "index.php"; 
$timeout = $timeout * 60;

if(isset($_SESSION['start_session'])){
  $elapsed_time = time()-$_SESSION['start_session'];
  if($elapsed_time >= $timeout){
    session_unset();
    session_destroy();
    header("location:../index.php");
  }
  if (!isset($_SESSION['user_id']) || $_SESSION['loginas'] != 'Resepsionis') {
    session_unset();
    session_destroy();
    header("location:../index.php");
  }
}
$_SESSION['start_session']=time();
function tanggal_indonesia($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );

  $pecahkan = explode('-', $tanggal);
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SISAKTY Application </title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="../../assets/super/css/app.min.css">
  <link rel="stylesheet" href="../../assets/super/bundles/bootstrap-daterangepicker/daterangepicker.css">
  <link rel="stylesheet" href="../../assets/super/bundles/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
  <link rel="stylesheet" href="../../assets/super/bundles/select2/dist/css/select2.min.css">
  <link rel="stylesheet" href="../../assets/super/bundles/jquery-selectric/selectric.css">
  <link rel="stylesheet" href="../../assets/super/bundles/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
  <link rel="stylesheet" href="../../assets/super/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <link rel="stylesheet" href="../../assets/super/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="../../assets/super/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="../../assets/super/css/style.css">
  <link rel="stylesheet" href="../../assets/super/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="../../assets/super/css/custom.css">
  <link rel="shortcut icon" href="../../assets/img/favicons.png">
  <link rel="stylesheet" href="action/timeline.css">
  <!-- sweet alert -->
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script defer src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<!-- BODY -->
<body>
  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar sticky">
        <div class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
             collapse-btn"> <i data-feather="align-justify"></i></a></li>
             <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
              <i data-feather="maximize"></i>
            </a></li>
          </ul>
        </div>

        <!-- NOTIFICATION -->
        <ul class="navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user" style="color: #60686f;"> 
              <?php 
              include '../../controller/connection.php';
              @$comp_admin = mysqli_fetch_array($conn->query("SELECT * FROM company WHERE comp_id = ".$_SESSION['user_comp'].""));
              @$divisi_admin = mysqli_fetch_array($conn->query("SELECT * FROM divisi WHERE divisi_id = ".$_SESSION['user_divisi'].""));?>
              Resepsionis MIP &nbsp;<i class="fas fa-user"></i>
              <span class="d-sm-none d-lg-inline-block"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
              <a class="nav-link count-indicator" style="color: #343a40;" href="home.php?v=setting">
                <i class="fas fa-cog"></i> Pengaturan
              </a>
              <a class="nav-link count-indicator" id="logout" style="color: #343a40;" onclick="logout()" href="" data-toggle="dropdown">
                <i class="fas fa-sign-out-alt"></i> Keluar
              </a>
            </div>
          </li>
        </ul>
      </nav>

      <!-- SIDEBAR -->
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="home.php?v=visitor">
              <img src="../../assets/img/logor.png" width="50%">
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Menu</li>
            <li class="dropdown">
              <a href="home.php?v=visitor">
                <i class="fas fa-id-card-alt"></i><span>Visitor</span>
              </a>
            </li>
            <li class="dropdown">
              <a href="home.php?v=setting">
                <i class="fas fa-cog"></i><span>Pengaturan</span>
              </a>
            </li>
            <li class="dropdown">
              <a id="logout"  onclick="logout()" href="" data-toggle="dropdown">
                <i class="fas fa-sign-out-alt"></i><span>Keluar</span>
              </a>
            </li>
            <br><br><br>
            <br><br><br>
          </ul>
        </aside>
      </div>

      <!-- MAIN -->
      <div class="main-content">
        <style type="text/css">
          .card .card-statistic-4 {
            position: relative;
            color: #3e474f;
            padding: 15px;
            border-radius: 3px;
            overflow: hidden;
          }
        </style>
        <?php 
        include '../../controller/connection.php';
        include 'content.php'; 
        ?>
      </div>
    </div>

    <!-- FOOTER -->
    <footer class="main-footer">
      <div class="footer-centered">
        <small>Copyright Mandiricoal.co.id 2021</small>
      </div>
    </footer>
  </div>
</div>

<!-- General JS Scripts -->
<script src="../../assets/super/js/app.min.js"></script>
<script src="../../assets/super/bundles/cleave-js/dist/cleave.min.js"></script>
<script src="../../assets/super/bundles/cleave-js/dist/addons/cleave-phone.us.js"></script>
<script src="../../assets/super/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
<script src="../../assets/super/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="../../assets/super/bundles/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="../../assets/super/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script src="../../assets/super/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="../../assets/super/bundles/select2/dist/js/select2.full.min.js"></script>
<script src="../../assets/super/bundles/jquery-selectric/jquery.selectric.min.js"></script>
<!-- Datatables -->
<script src="../../assets/super/bundles/datatables/datatables.min.js"></script>
<script src="../../assets/super/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="../../assets/super/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
<script src="../../assets/super/bundles/datatables/export-tables/buttons.flash.min.js"></script>
<script src="../../assets/super/bundles/datatables/export-tables/jszip.min.js"></script>
<script src="../../assets/super//bundles/datatables/export-tables/pdfmake.min.js"></script>
<script src="../../assets/super/bundles/datatables/export-tables/vfs_fonts.js"></script>
<script src="../../assets/super//bundles/datatables/export-tables/buttons.print.min.js"></script>
<script src="../../assets/super/js/page/datatables.js"></script>
<!-- JS Libraies -->
<script src="../../assets/super/bundles/apexcharts/apexcharts.min.js"></script>
<!-- Page Specific JS File -->
<script src="../../assets/super/js/page/index.js"></script>
<!-- Template JS File -->
<script src="../../assets/super/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="../../assets/super/js/custom.js"></script>

<link href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css" rel="stylesheet">
<style type="text/css">
  .buttons-copy  {
    background-color: #828181 !important;
  }
  .buttons-excel  {
    background-color: #828181 !important;
  }
  .buttons-pdf  {
    background-color: #828181 !important;
  }
  .buttons-print  {
    background-color: #828181 !important;
  }
</style>

<!-- Logout -->
<script>
  function logout() {
    Swal.fire({
      title: 'Keluar',
      text: 'Anda yakin ingin keluar ?',
      showDenyButton: true,
      confirmButtonColor: '#FF4747',
      denyButtonColor: '#ced4da',
      confirmButtonText: 'Yes'
    }).then((result) => {  
      if (result.isConfirmed) {
        window.location = "action/logout.php";
      }
    })
  };
</script>
<script type="text/javascript">
  if ( window.history.replaceState ) {
    window.history.replaceState( null, null, window.location.href );
  }
</script>
</body>
</html>