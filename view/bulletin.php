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
      SHE Bulletin
    </h1>
  </div>
  <div class="em_side_right">
  </div>
</header>
<!-- End.main_haeder -->

<?php @$iupdate=mysqli_fetch_array($conn->query("SELECT * FROM bulletin WHERE bulletin_id =".base64_decode($_GET['id']).""));?>
<section class="emPage__detailsBlog">
  <div class="emCoureses__grid course__list bg-white">
    <div class="em_bodyCarousel padding-t-20 padding-b-50"><br><br><br>
      <?php
      $sql = mysqli_query($conn,"SELECT * FROM bulletin ORDER BY bulletin_id DESC LIMIT 30"); 
      while(@$row = mysqli_fetch_array($sql)) {?>
        <div class="em_itemCourse_grid list">
          <div class="col-12 my-auto card">
            <div class="card-body">
              <h6 class="">
               <?= $row['bulletin_name'];?>
             </h6>
             <p class="text" style="color:#7e848e;">
               <?= $row['bulletin_desc'];?>
             </p>


             <div class="card_footer">
              <div class="card_user">
                <span>
                  <?= $row['bulletin_date'];?>
                </span>
              </div>
              <a href="../assets/bulletin/<?=$row['bulletin_file'];?>" class="btn btn__back rounded-circle share-button" target="_blank">
                <img src="../assets/icon/outline/document-download.svg">
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
</section>
<?php } ?>