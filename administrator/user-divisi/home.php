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
  
  if (!isset($_SESSION['user_id']) || $_SESSION['loginas'] != 'PIC') {
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
          <li class="dropdown dropdown-list-toggle">
          </li>

          <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user" style="color: #60686f;"> 
              <?php 
              include '../../controller/connection.php';
              @$comp_admin = mysqli_fetch_array($conn->query("SELECT * FROM company WHERE comp_id = ".$_SESSION['user_comp'].""));
              @$divisi_admin = mysqli_fetch_array($conn->query("SELECT * FROM divisi WHERE divisi_id = ".$_SESSION['user_divisi'].""));?>
              <u>Hallo Admin ( <?php echo $divisi_admin['divisi_name'].' -'.$comp_admin['comp_name']?> )</u>&nbsp;<i class="fas fa-user"></i>
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
            <a href="home.php?v=dashboard">
              <img src="../../assets/img/logor.png" width="50%">
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="dropdown">
              <a href="home.php?v=dashboard" class="nav-link"><i class="fas fa-desktop"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Main Menu</li>
            <li class="dropdown">
              <a href="home.php?v=muser">
                <i class="fas fa-users"></i><span>Data User</span>
              </a>
            </li>
            <li class="dropdown">
              <a href="home.php?v=hazard">
                <i class="fas fa-exclamation-triangle"></i><span>Harmonis</span>
              </a>
            </li>
            <li class="dropdown">
              <a href="home.php?v=mpermit">
                <i class="fas fa-id-card-alt"></i><span>Mine Permit</span>
              </a>
            </li>
            <li class="menu-header">Akun</li>
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
          </li>

          <script>
            function myFunction() {
              Swal.fire({
                icon: 'info',
                title: 'Under Contruction !',
                showConfirmButton: true
              });
            }
          </script>

          <br><br><br>
          <br><br><br>
        </ul>
      </aside>
    </div>

    <!-- MAIN -->
    <div class="main-content">
      <?php 
      include '../../controller/connection.php';
      include 'content.php'; 
      ?>
    </div>

    <!-- LAYOUT SETTING -->
    <div class="settingSidebar">
      <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
      </a>
      <div class="settingSidebar-body ps-container ps-theme-default">
        <div class=" fade show active">
          <div class="setting-panel-header">Setting Panel
          </div>
          <div class="p-15 border-bottom">
            <h6 class="font-medium m-b-10">Select Layout</h6>
            <div class="selectgroup layout-color w-50">
              <label class="selectgroup-item">
                <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout" checked>
                <span class="selectgroup-button">Light</span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
                <span class="selectgroup-button">Dark</span>
              </label>
            </div>
          </div>
          <div class="p-15 border-bottom">
            <h6 class="font-medium m-b-10">Sidebar Color</h6>
            <div class="selectgroup selectgroup-pills sidebar-color">
              <label class="selectgroup-item">
                <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
              </label>
              <label class="selectgroup-item">
                <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar" checked>
                <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
              </label>
            </div>
          </div>
          <div class="p-15 border-bottom">
            <h6 class="font-medium m-b-10">Color Theme</h6>
            <div class="theme-setting-options">
              <ul class="choose-theme list-unstyled mb-0">
                <li title="white" class="active">
                  <div class="white"></div>
                </li>
                <li title="cyan">
                  <div class="cyan"></div>
                </li>
                <li title="black">
                  <div class="black"></div>
                </li>
                <li title="purple">
                  <div class="purple"></div>
                </li>
                <li title="orange">
                  <div class="orange"></div>
                </li>
                <li title="green">
                  <div class="green"></div>
                </li>
                <li title="red">
                  <div class="red"></div>
                </li>
              </ul>
            </div>
          </div>
          <div class="p-15 border-bottom">
            <div class="theme-setting-options">
              <label class="m-b-0">
                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                id="mini_sidebar_setting">
                <span class="custom-switch-indicator"></span>
                <span class="control-label p-l-10">Mini Sidebar</span>
              </label>
            </div>
          </div>
          <div class="p-15 border-bottom">
            <div class="theme-setting-options">
              <label class="m-b-0">
                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                id="sticky_header_setting">
                <span class="custom-switch-indicator"></span>
                <span class="control-label p-l-10">Sticky Header</span>
              </label>
            </div>
          </div>
          <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
            <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
              <i class="fas fa-undo"></i> Restore Default
            </a>
          </div>
        </div>
      </div>
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