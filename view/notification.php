<!-- Start main_haeder -->
<header class="main_haeder header-sticky bg-transparent multi_item">
    <div class="em_side_right">
        <a class="btn btn__back rounded-circle bg-snow" onclick="history.go(-1)">
            <i class="tio-chevron_left"></i>
        </a>
    </div>
    <div class="title_page">
        <h1 class="page_name">
            Notification
        </h1>
    </div>
    <div class="em_side_right">
    </div>
</header>
<!-- End.main_haeder -->

<!-- Start emPage__activities -->
<section class="emPage__activities _classic padding-t-70">
    <nav class="navbar navbar-expand-lg">
        <p style="text-align: right;">Notifikasi Hazard</p>
        <a href="home.php?v=notification&u=Y">
            <p style="text-align: right;">Tandai sudah dibaca</p>
        </a>
    </nav><hr style="margin-top: 0rem;margin-bottom: 0rem;">
    <?php 
    @$sql = $conn->query("SELECT * FROM hazard_status 
        LEFT JOIN hazard ON hazard.hazard_id = hazard_status.hazard_status_hazard 
        LEFT JOIN user ON user.user_id = hazard.hazard_user
        WHERE user.user_nik ='$_nik'
        ORDER BY hazard_status.hazard_status_id DESC LIMIT 30"); 
    while($row = mysqli_fetch_array($sql)){ 
        if(@$_GET['u'] == 'Y'){
            @$id                     = $row['hazard_status_id'];
            $notif                   = "UPDATE hazard_status SET 
            hazard_status_notif      = 'Y' WHERE 
            hazard_status_id         = '$id'";
            $simpan = mysqli_query($conn, $notif);
            if($simpan){
                echo"<script>
                        window.location = 'home.php?v=notification';
                    </script>";
            }
        }?>
        <a style="text-decoration: none;" href="home.php?v=hazard-detail&id=<?= base64_encode($row['hazard_id'])?>&u=Y&ids=<?= base64_encode($row['hazard_status_id'])?>" style="color: #6c757d;">
            <div class="item__activiClassic bg-snow border-b">
                <div class="media">
                    <?php if($row['hazard_status_name'] == 'Open') {
                        echo'<div class="icon bg-yellow">
                        <img src="../assets/icon/outline/warnings.svg" style="-webkit-filter: invert(1);filter: invert(1);width: 25px">
                        </div>';
                    }elseif($row['hazard_status_name'] == 'Progress') {
                        echo'<div class="icon bg-blue">
                        <img src="../assets/icon/outline/warnings.svg" style="-webkit-filter: invert(1);filter: invert(1);width: 25px">
                        </div>';
                    }elseif($row['hazard_status_name'] == 'Closed') {
                        echo'<div class="icon bg-green">
                        <img src="../assets/icon/outline/warnings.svg" style="-webkit-filter: invert(1);filter: invert(1);width: 25px">
                        </div>';
                    }elseif($row['hazard_status_name'] == 'Reject') {
                        echo'<div class="icon bg-red">
                        <img src="../assets/icon/outline/warnings.svg" style="-webkit-filter: invert(1);filter: invert(1);width: 25px">
                        </div>';
                    }?>
                    <div class="media-body">
                        <div class="txt">
                            <h2><?= 'HZ'.str_pad($row['hazard_id'],5,"0",STR_PAD_LEFT);?> | <?= $row['hazard_name'];?></h2>
                            <p><?= $row['hazard_desc'];?></p>
                            <span><b><?= $row['hazard_status_name'];?></b> | <?= $row['hazard_date'];?></span>
                        </div>
                    </div>
                </div>
                <div class="sideRight">
                    <?php if($row['hazard_status_notif'] == '') {
                        echo'<span class="attention"></span>';
                    }?>
                    <i class="tio-chevron_right"></i>
                </div>
            </div>
        </a>
    <?php } ?>
</section>
            <!-- End. emPage__activities -->