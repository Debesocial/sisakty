<!-- Start main_haeder -->
<header class="main_haeder header-sticky bg-transparent multi_item">
    <div class="em_side_right">
        <a class="btn btn__back rounded-circle bg-snow" onclick="history.go(-1)">
            <i class="tio-chevron_left"></i>
        </a>
    </div>
    <div class="title_page">
        <h1 class="page_name">
            Bookmark
        </h1>
    </div>
    <div class="em_side_right">
    </div>
</header>
<!-- End.main_haeder -->

<div class="emCoureses__grid course__list bg-white"><br><br><br>
    <div class="border-text margin-b-30">
        <div class="lined">
            <span class="text">Bookmark list</span>
        </div>
    </div>

    <div class="input_SaerchDefault">
        <div class="form-group with_icon mb-0" data-toggle="modal" data-target="#mdllFilterJobs">
            <div class="input_group">
                <?php 
                if(isset($_POST["submit"])){?>
                    <input type="search" class="form-control h-48" placeholder="PERIODE : <?= $_POST["start"]; ?> s/d <?= $_POST["end"]; ?>" disabled="">
                <?php } else {?>
                    <input type="search" class="form-control h-48" placeholder="Search.." disabled="">
                <?php } ?>
                <div class="icon">
                    <svg id="Iconly_Two-tone_Search" data-name="Iconly/Two-tone/Search"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                    <g id="Search" transform="translate(2 2)">
                        <circle id="Ellipse_739" cx="8.989" cy="8.989" r="8.989"
                        transform="translate(0.778 0.778)" fill="none" stroke="#200e32"
                        stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                        stroke-width="1.5" />
                        <path id="Line_181" d="M0,0,3.524,3.515" transform="translate(16.018 16.485)"
                        fill="none" stroke="#200e32" stroke-linecap="round" stroke-linejoin="round"
                        stroke-miterlimit="10" stroke-width="1.5" opacity="0.4" />
                    </g>
                </svg>
            </div>
            <div class="side_voice">
             <button type="button" class="btn ml-1" data-toggle="modal" data-target="#mdllFilter">
                <svg id="Iconly_Two-tone_Filter" data-name="Iconly/Two-tone/Filter"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                <g id="Filter" transform="translate(2 2.5)">
                    <path id="Stroke_1" data-name="Stroke 1" d="M7.234.588H0"
                    transform="translate(0.883 14.898)" fill="none" stroke="#200e32"
                    stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                    stroke-width="1.5" opacity="0.4" />
                    <path id="Stroke_3" data-name="Stroke 3"
                    d="M5.76,2.88A2.88,2.88,0,1,1,2.88,0,2.88,2.88,0,0,1,5.76,2.88Z"
                    transform="translate(13.358 12.607)" fill="none" stroke="#200e32"
                    stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                    stroke-width="1.5" />
                    <path id="Stroke_5" data-name="Stroke 5" d="M0,.588H7.235"
                    transform="translate(11.883 3.174)" fill="none" stroke="#200e32"
                    stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                    stroke-width="1.5" opacity="0.4" />
                    <path id="Stroke_7" data-name="Stroke 7"
                    d="M0,2.88A2.88,2.88,0,1,0,2.88,0,2.879,2.879,0,0,0,0,2.88Z"
                    transform="translate(0.883 0.882)" fill="none" stroke="#200e32"
                    stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
                    stroke-width="1.5" />
                </g>
            </svg>
        </button>
    </div>
</div>
</div>
</div><br>

<div class="em_bodyCarousel padding-t-0">
<?php //BOOKMARK
if(isset($_POST["submit"])){
    $start = $_POST["start"];
    $end   = $_POST["end"];
    $sql = mysqli_query($conn,"SELECT * FROM hazard  
      LEFT JOIN user ON user.user_id = hazard.hazard_user
      LEFT JOIN location ON location.loc_id = hazard.hazard_loc 
      LEFT JOIN classification ON classification.classi_id = hazard.hazard_classi
      LEFT JOIN bookmark ON bookmark.book_hazard = hazard.hazard_id 
      WHERE bookmark.book_user = ".$_id."
      AND CAST(hazard.hazard_date AS DATE) >= '$start'
      AND CAST(hazard.hazard_date AS DATE) <= '$end' 
      AND hazard.hazard_approve = 'Y' 
      ORDER BY hazard.hazard_id desc"); 
} else {
    $sql = mysqli_query($conn,"SELECT * FROM hazard  
      LEFT JOIN user ON user.user_id = hazard.hazard_user
      LEFT JOIN location ON location.loc_id = hazard.hazard_loc 
      LEFT JOIN classification ON classification.classi_id = hazard.hazard_classi
      LEFT JOIN bookmark ON bookmark.book_hazard = hazard.hazard_id 
      WHERE bookmark.book_user = ".$_id." 
      and hazard.hazard_approve = 'Y' 
      order by hazard.hazard_id desc"); 
}
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
 <span>&nbsp;|&nbsp;'.$row['loc_name'].'</span>
 <span>'.$row['hazard_date'].'</span>
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
