<!-- Start main_haeder -->
<header class="main_haeder bg-transparent header-white header-sticky" style="background-color: #de5562 !important;">
    <div class="em_menu_sidebar">
        <button type="button" class="btn btn_menuSidebar item-show" data-toggle="modal" data-target="#mdllSidebarMenu-background">
            <i class="tio-menu_hamburger"></i>
        </button>
    </div>
    <div class="title_page">
        <span class="page_name"><img src="../assets/img/favicon/logo.png" width="150px"></span>
    </div>
    <div class="em_side_right">
        <?php if($_login == 'Y') {
            echo'
            <a href="#" data-toggle="modal" data-target="#logout" class="size-14 white-onScroll color-blue hover:color-blue">
            Logout
            <div class="ml-1 d-inline-block">
            <img src="../assets/icon/outline/logout.svg" style="-webkit-filter: invert();filter: invert();">
            </div>
            </a>'; 
        } else {
            echo'
            <a href="home.php?v=login" class="size-14 white-onScroll color-blue hover:color-blue">
            Login
            <div class="ml-1 d-inline-block">
            <img src="../assets/icon/outline/login.svg" style="-webkit-filter: invert();filter: invert();">
            </div>
            </a>'; 
        }?>
    </div>
</header>
<!-- End.main_haeder -->

<!-- Start banner__wallet -->
<section class="banner__wallet"></section>
<!-- End. banner__wallet -->

<main class="main_Wallet_index" style="margin-top: -150px;background-color: #f6f6f6;">

    <!-- Start em__bkOperationsWallet -->
    <section class="em__bkOperationsWallet other_option">

        <div class="title_welcome" style="margin-top: -10px;">

            <div class="emhead d-flex align-items-center justify-content-between">
                <span class="color-text size-13">Hi, <?= $_name; ?> 
                <p class="size-18 weight-600 color-secondary mb-0">Welcome <img class="w-20 h-20" src="../assets/img/1f590.png" alt=""></p>
            </span>
            <div class="side__right">
                <a class="nav-link" href="home.php?v=faq">
                    <button type="button" class="btn btn_balance" data-toggle="modal" data-target="#mdllAddBalance">FAQ</button>
                </a>
            </div>
        </div> 
    </div><br>

    <div class="em__actions">
        <a href="home.php?v=hazard" class="btn">
            <div class="icon bg-green bg-opacity-10">
                <img src="../assets/icon/outline/warnings.svg" width="25">
            </div>
            <span>Harmonis</span>
        </a>
        <a onclick="commingsoon()" class="btn" >
            <div class="icon bg-blue bg-opacity-10">
                <img src="../assets/icon/outline/idcard.svg" width="25">
            </div>
            <span>MPermit</span>
        </a>
        <a onclick="commingsoon()" class="btn" >
            <div class="icon bg-red bg-opacity-10">
                <img src="../assets/icon/outline/simcards.svg" width="25">
            </div>
            <span>SIMPER</span>
        </a>
        <?php if($_login == 'Y'){?>
            <a href="home.php?v=achivement" class="btn">
                <div class="icon bg-yellow bg-opacity-10">
                    <img src="../assets/icon/outline/trophy.svg" width="25">
                </div>
                <span>Achive</span>
            </a>
        <?php } else { ?>
            <a href="../controller/logout.php" class="btn">
                <div class="icon bg-yellow bg-opacity-10">
                    <img src="../assets/icon/outline/trophy.svg" width="25">
                </div>
                <span>Achive</span>
            </a>
        <?php } ?>
        <a href="#" data-toggle="modal" data-target="#menu" class="btn" >
            <div class="icon bg-white bg-opacity-10">
                <img src="../assets/icon/bulk/category.svg" width="25">
            </div>
            <span>Lainnya</span>
        </a>
    </div>
</section>
<!-- End. banner_swiper -->
</main>

<!-- Start dividar -->
<section class="padding-20 py-0">
    <div class="dividar"></div>

    <!-- Swiper -->
    <div class="owl-carousel owl-theme em-owlCentred em_owl_swipe margin-t-20">
        <?php 
        $info = mysqli_query($conn, "SELECT * FROM iupdate ORDER BY iupdate_date DESC LIMIT 5"); 
        while(@$row = mysqli_fetch_array($info)) {
            echo'
            <a href="home.php?v=iupdate&act=detail&id='.base64_encode($row['iupdate_id']).'">
            <div class="item em_item">
            <div class="em_cover_img">';
            if ($row['iupdate_img'] != '') {
                echo'<img src="../assets/iupdate/'.$row['iupdate_img'].'" alt="">';
            } else {
                echo'<img src="../assets/img/banner.png" alt="">';
            }
            echo'<div class="em_text">
            <div class="margin-b-10">
            <h2 class="offer_txt">'.$row['iupdate_name'].'</h2>
            <p class="color-snow size-12 mb-0" style="overflow: hidden;display:-webkit-box;-webkit-line-clamp: 1;-webkit-box-orient: vertical;">
            '.$row['iupdate_desc'].'</p>
            <p class="color-snow size-12 mb-0">'.$row['iupdate_date'].'</p>
            </div>
            </div>
            </div>
            </div>
            </a>';
        }?>
    </div>
</section>

<div class="emCoureses__grid course__list bg-white"><br> 

    <?php //SUMMARY REPORT
    if($_pic == 'Y') {
        @$status = mysqli_fetch_array($conn->query("SELECT 
            COUNT(CASE WHEN hazard.hazard_status = 'Open' THEN 1 END) AS `Open`,
            COUNT(CASE WHEN hazard.hazard_status = 'Progress' THEN 1 END) AS `Progress`
            FROM hazard
            LEFT JOIN company on company.comp_id = hazard.hazard_comp
            LEFT JOIN divisi on divisi.divisi_id = hazard.hazard_divisi
            WHERE hazard.hazard_approve = 'Y'
            AND company.comp_id         = '$_compid'
            AND divisi.divisi_id        = '$_divisiid'")
    );
        echo'                
        <div class="row mb-0" style="border: 0">
        <div class="col bg-snow padding-10 border">
        <div class="group">
        <center>#Harmonis | PIC :  '.$_divisi.'</center>
        </div>
        </div>
        </div>
        <div class="row mb-4" style="border: 0">
        <div class="col bg-snow padding-10 border">
        <div class="group">
        <a href = "home.php?v=hazard-pic&status=open" style="text-decoration:none;">
        <span class="rounded-pill bg-yellow  bg-opacity-80 px-1 color-white min-w-25 h-21 d-flex align-items-center justify-content-center">
        Open : '.$status['Open'].' 
        </span>
        </a>
        </div>
        </div>
        <div class="col bg-snow padding-10 border">
        <div class="group">
        <a href = "home.php?v=hazard-pic&status=progress" style="text-decoration:none;">
        <span class="rounded-pill bg-blue  bg-opacity-80 px-1 color-white min-w-25 h-21 d-flex align-items-center justify-content-center">
        Progress : '.$status['Progress'].'
        </span>
        </a>
        </div>
        </div>
        </div>
        ';
    }?>

    <div class="title d-flex justify-content-between align-items-center padding-b-30">
        <h3 class="size-18 weight-500 color-secondary m-0">Harmonis</h3>
        <a href="home.php?v=hazard"
        class="d-block color-blue size-14 m-0 hover:color-blue">View all</a>
    </div>
    <div class="border-text margin-b-30">
        <div class="lined">
            <span class="text">Last 20 Report</span>
        </div>
    </div>
    <div class="em_bodyCarousel padding-t-0">
        <?php //HAZARD FEED
        $sql = mysqli_query($conn,"SELECT * FROM hazard  
            LEFT JOIN user ON user.user_id = hazard.hazard_user
            LEFT JOIN location ON location.loc_id = hazard.hazard_loc 
            LEFT JOIN classification ON classification.classi_id = hazard.hazard_classi
            WHERE hazard.hazard_approve = 'Y' 
            AND hazard.hazard_loc != ''
            ORDER BY hazard.hazard_id DESC LIMIT 20"); 
        while(@$row = mysqli_fetch_array($sql)) {
            echo'
            <div class="em_itemCourse_grid w-100">
            <a href="home.php?v=hazard-detail&id='.base64_encode($row['hazard_id']).'" class="card margin-b-20">
            <div class="cover_card">';
            if ($row['hazard_photo'] != NULL){
                echo'<img src="../assets/hazard/thumbnail/'.$row['hazard_photo'].'" class="card-img-top" alt="img">';
            } else {
                // echo'<img src="../assets/hazard/noimages.jpg" class="card-img-top" alt="img">';
            }
            echo'
            </div>
            <div class="card-body">
            <div class="head_card mb-1">
            ';
            if ($row['hazard_status'] == 'Open'){
                echo'<span class="badge badge-pill badge-warning" style="color: #ffffff;font-weight: 10;">Open</span> ';
            } elseif ($row['hazard_status'] == 'Progress'){
             echo'<span class="badge badge-pill badge-primary" style="color: #ffffff;font-weight: 10;">Progress</span> ';
         } elseif ($row['hazard_status'] == 'Closed'){
             echo'<span class="badge badge-pill badge-success" style="color: #ffffff;font-weight: 10;">Closed</span> ';
         } elseif ($row['hazard_status'] == 'Reject'){
             echo'<span class="badge badge-pill badge-danger" style="color: #ffffff;font-weight: 10;">Rejected</span> ';
         }
         echo'
         <span style="overflow: hidden;
         white-space: nowrap;
         text-overflow: ellipsis;
         margin: 0;">&nbsp;|&nbsp;'.$row['loc_name'].'</span>
         <span style="overflow: hidden;
         white-space: nowrap;
         text-overflow: ellipsis;
         margin: 0;">'.$row['hazard_date'].'</span>
         </div>
         <h6 class="card-title size-18 weight-600 mb-0" 
         style="overflow: hidden;
         white-space: nowrap;
         text-overflow: ellipsis;
         margin: 0;">
         '.$row['hazard_name'].'
         </h6>
         <p class="card-text size-15">
         '.$row['hazard_desc'].'
         </p>
         </div>
         </a>
         </div>
         ';
     }?>
 </div>
</div>

<!-- Start em_main_footer -->
<footer class="em_main_footer with__text rounded p-0">
 <div class="em_body_navigation -active-links">
    <div class="item_link">
        <a href="home.php?v=dashboard" class="btn btn_navLink">
            <div class="icon_active">
                <img src="../assets/icon/outline/homes.svg" >
            </div>
            <div class="txt__tile">Home</div>
        </a>
    </div>
    <?php if($_login == 'Y'){?>
        <div class="item_link">
            <a href="home.php?v=bookmark" class="btn btn_navLink">
                <div class="icon_current">
                    <img src="../assets/icon/outline/bookmark.svg">
                </div>
                <div class="txt__tile">Bookmark</div>
            </a>
        </div>
        <div class="item_link" >
            <a href="home.php?v=hazard-report" class="btn btn_navLink"  style="width: 100%;">
                <button type="button" class="btn btnCircle_default _lg">
                    <img src="../assets/icon/outline/warnings.svg" style="-webkit-filter: invert(1);filter: invert(1);width: 25px">
                </button>
            </a>
        </div>
        <div class="item_link" >
            <header class="main_haeder" style="font-size: 11px;padding: 0px;">
                <div class="em_side_right" style="text-align: center;">
                    <a href="home.php?v=notification" class="btn justify-content-center relative">
                        <img src="../assets/icon/outline/notification.svg">
                        <?php 
                        @$notif = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard_status 
                            LEFT JOIN hazard ON hazard.hazard_id = hazard_status.hazard_status_hazard
                            LEFT JOIN user ON user.user_id = hazard.hazard_user
                            WHERE user.user_nik = '$_nik' 
                            AND hazard_status.hazard_status_notif = ''"));
                        if (@$notif['total'] != 0 ) {
                           echo ' <span class="flashCircle"></span>';
                       }?>
                   </a>
                   <div class="txt__tile">Notification</div>
               </div>
           </header>
       </div>
       <div class="item_link">
        <a href="home.php?v=profil" class="btn btn_navLink">
            <div class="icon_current">
                <img src="../assets/icon/outline/user.svg" ><span class="flashCircle"></span>
            </div>
            <div class="txt__tile">Profile</div>
        </a>
    </div>
<?php } else { ?>
    <div class="item_link">
        <a href="../controller/logout.php" class="btn btn_navLink">
            <div class="icon_current">
                <img src="../assets/icon/outline/bookmark.svg">
            </div>
            <div class="txt__tile">Bookmark</div>
        </a>
    </div>
    <div class="item_link" >
        <a href="../controller/logout.php" class="btn btn_navLink"  style="width: 100%;">
            <button type="button" class="btn btnCircle_default _lg">
                <img src="../assets/icon/outline/warnings.svg" style="-webkit-filter: invert(1);filter: invert(1);width: 25px">
            </button>
        </a>
    </div>
    <div class="item_link" >
        <a href="../controller/logout.php" class="btn btn_navLink">
            <div class="icon_current">
                <img src="../assets/icon/outline/notification.svg">
            </div>
            <div class="txt__tile">Notification</div>
        </a>
    </div>
    <div class="item_link">
        <a href="../controller/logout.php" class="btn btn_navLink">
            <div class="icon_current">
                <img src="../assets/icon/outline/user.svg" ><span class="flashCircle"></span>
            </div>
            <div class="txt__tile">Profile</div>
        </a>
    </div>
<?php } ?>
</footer>
