<?php if($_GET['act'] == 'data'){ ?>
 <!-- Start main_haeder -->
 <header class="main_haeder header-sticky bg-transparent multi_item">
  <div class="em_side_right">
    <a class="btn btn__back rounded-circle bg-snow" onclick="history.go(-1)">
      <i class="tio-chevron_left"></i>
    </a>
  </div>
  <div class="title_page">
    <h1 class="page_name">
      Info Update
    </h1>
  </div>
  <div class="em_side_right">
  </div>
</header>
<!-- End.main_haeder -->

<?php @$iupdate=mysqli_fetch_array($conn->query("SELECT * FROM iupdate WHERE iupdate_id =".base64_decode($_GET['id']).""));?>
<section class="emPage__detailsBlog">
  <div class="emCoureses__grid course__list bg-white">
    <div class="em_bodyCarousel padding-t-20 padding-b-50"><br><br><br>
      <?php
      $sql = mysqli_query($conn,"SELECT * FROM iupdate ORDER BY iupdate_id DESC LIMIT 30"); 
      while(@$row = mysqli_fetch_array($sql)) {?>
        <div class="em_itemCourse_grid list">
          <a href="home.php?v=iupdate&act=detail&id=<?= base64_encode($row['iupdate_id'])?>" class="card">
            <div class="row no-gutters">
              <div class="col-4">
                <div class="cover_card">
                  <?php if($row['iupdate_img'] != ''){
                    echo'<img src="../assets/iupdate/'.$row['iupdate_img'].'" class="card-img-top" alt="img">';
                  } else {
                    echo'<img src="../assets/img/xbanner.png" class="card-img-top" alt="img">';
                  }?>
                </div>
              </div>
              <div class="col-8 my-auto">
                <div class="card-body">
                  <div class="head_card">
                    <span>
                      <?= $row['iupdate_date'];?>
                    </span>
                  </div>
                  <h5 class="card-title">
                   <?= $row['iupdate_name'];?>
                 </h5>
                 <p class="card-text">
                   <?= $row['iupdate_desc'];?>
                 </p>
               </div>
             </div>
           </div>
         </a>
       </div>
     <?php } ?>
   </div>
 </div>
</section>

<?php }elseif($_GET['act'] == 'detail'){ 
  @$iupdate=mysqli_fetch_array($conn->query("SELECT * FROM iupdate WHERE iupdate_id =".base64_decode($_GET['id']).""));
  ?>
  <!-- Start main_haeder -->
  <header class="main_haeder bg-transparent header-sticky multi_item">
    <div class="em_side_right">
      <a class="btn btn__back rounded-circle bg-snow" onclick="history.go(-1)">
        <i class="tio-chevron_left"></i>
      </a>
    </div>
    <div class="title_page">
      <!-- title here -->
    </div>
    <div class="em_side_right">
    <?php if($iupdate['iupdate_file'] != '') {?>
      <a href="../assets/iupdate/file/<?=$iupdate['iupdate_file'];?>" class="btn btn__back rounded-circle share-button" target="_blank">
        <img src="../assets/icon/outline/document-download.svg">
      </a>
    <?php } else { ?>
      <a href="#" class="btn btn__back rounded-circle share-button">
        <img src="../assets/icon/outline/document-download.svg">
      </a>
    <?php } ?>
    </div>
  </header>
  <!-- End.main_haeder -->
  <section class="emPage__detailsBlog">
    <div class="emheader_cover">
      <div class="cover">
        <?php if($iupdate['iupdate_img'] != ''){
          echo '<img src="../assets/iupdate/'.$iupdate['iupdate_img'].'" alt="">';
        } else {
          echo'<img src="../assets/img/xbanner.png" class="card-img-top" alt="img">';
        }?>
      </div>
      <div class="title">
        <h1 class="head_art"><?= $iupdate['iupdate_name'];?></h1>
        <div class="item__auther">
          <div class="item_person">
            <img src="../assets/img/favicons.png" alt="">
            <h2>Sisakty</h2>
          </div>
          <div class="sideRight">
            <span><?= $iupdate['iupdate_date'];?></span>
          </div>
        </div>
      </div>
    </div>
    <div class="embody__content">
      <?= $iupdate['iupdate_desc'];?>
    </div><hr>


    <!-- Start title -->
    <div class="emTitle_co padding-20">
      <h2 class="size-16 weight-500 color-secondary mb-1">Info Update</h2>
      <p class="size-12 color-text m-0">More info updates</p>
    </div>
    <!-- End. title -->

    <div class="emCoureses__grid course__list bg-white">
      <div class="em_bodyCarousel padding-t-20 padding-b-50">
        <?php
        $sql = mysqli_query($conn,"SELECT * FROM iupdate ORDER BY iupdate_id DESC LIMIT 5"); 
        while(@$row = mysqli_fetch_array($sql)) {?>
          <div class="em_itemCourse_grid list">
            <a href="home.php?v=iupdate&act=detail&id=<?= base64_encode($row['iupdate_id'])?>" class="card">
              <div class="row no-gutters">
                <div class="col-4">
                  <div class="cover_card">
                    <?php if($row['iupdate_img'] != ''){
                      echo'<img src="../assets/iupdate/'.$row['iupdate_img'].'" class="card-img-top" alt="img">';
                    } else {
                      echo'<img src="../assets/img/xbanner.png" class="card-img-top" alt="img">';
                    }?>
                  </div>
                </div>
                <div class="col-8 my-auto">
                  <div class="card-body">
                    <div class="head_card">
                      <span>
                        <?= $row['iupdate_date'];?>
                      </span>
                    </div>
                    <h5 class="card-title">
                     <?= $row['iupdate_name'];?>
                   </h5>
                   <p class="card-text">
                     <?= $row['iupdate_desc'];?>
                   </p>
                 </div>
               </div>
             </div>
           </a>
         </div>
       <?php } ?>
     </div>
   </div>
 </section>
 <?php } ?>