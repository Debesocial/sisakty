<!-- Start main_haeder -->
<header class="main_haeder bg-transparent header-sticky multi_item">
  <div class="em_side_right">
    <a class="btn btn__back rounded-circle bg-snow" onclick="history.go(-1)">
      <i class="tio-chevron_left"></i>
    </a>
  </div>
  <div class="title_page">
  </div>

  <div class="em_side_right">
    <a type="button" data-toggle="modal" data-target="#exampleModalCenter">
      <button class="btn btn__back rounded-circle share-button bg-snow">
        <img src="../assets/icon/outline/maximize-3.svg">
      </button>
    </a>
    <?php
    if(@$_GET['u'] == 'Y'){
      @$id                  = base64_decode($_GET['id']);
      @$ids                  = base64_decode($_GET['ids']);
      @$notif                = "UPDATE hazard_status SET 
      hazard_status_notif    = 'Y' WHERE 
      hazard_status_id       = '$ids'";
      $simpan = mysqli_query($conn, $notif);
      if($simpan){
        header('location: home.php?v=hazard-detail&id='.base64_encode($id).'');
      }
    }
    @$detail=mysqli_fetch_array($conn->query("SELECT * FROM hazard   
      LEFT JOIN user on user.user_id = hazard.hazard_user
      LEFT JOIN location on location.loc_id = hazard.hazard_loc
      LEFT JOIN classification on classification.classi_id = hazard.hazard_classi
      LEFT JOIN risk on risk.risk_id = hazard.hazard_risk
      LEFT JOIN divisi on divisi.divisi_id = hazard.hazard_divisi
      LEFT JOIN company on company.comp_id = hazard.hazard_comp
      WHERE hazard.hazard_id =".base64_decode($_GET['id']).""));

    if(@$_login == "Y"){
      @$results=mysqli_fetch_array($conn->query("SELECT * FROM bookmark WHERE book_user = '$_id' AND book_hazard = ".base64_decode($_GET['id']."")));
      if($results != 0){
        echo '
        <a type="button" id="delete" name="delete">
        <button class="btn btn__back rounded-circle share-button bg-snow">
        <img src="../assets/icon/bold/bookmark.svg">
        </button></a>';
      } else {
        echo'
        <a type="button" id="insert" name="insert">
        <button class="btn btn__back rounded-circle share-button bg-snow">
        <img src="../assets/icon/outline/bookmark.svg">
        </button></a>';
      }
      if(@$_id == $detail['hazard_user'] and $detail['hazard_status'] == 'Open'){
        echo'&emsp;
        <a type="button" data-toggle="modal"  href="#hazard-del">
        <button class="btn btn__back rounded-circle share-button bg-red">
        <img src="../assets/icon/outline/trash.svg">
        </button>
        </a>';
      }
    }?>
  </div>
</header>
<!-- End.main_haeder -->

<section class="emPage__detailsBlog">
  <div class="emheader_cover">
    <div class="cover">
      <?php if($detail['hazard_photo'] != ''){
        echo '<img src="../assets/hazard/thumbnail/'.$detail['hazard_photo'].'" alt="">';
      } else {
        echo'<img src="../assets/img/noimage.jpg" class="card-img-top" alt="img">';
      }?>
    </div>
    <div class="title">
      <h1 class="head_art"><?= $detail['hazard_name'];?></h1>
      <div class="item__auther">
        <div class="item_person">
          <img src="../assets/img/favicons.png" alt="">
          <h2>Annonim</h2>
        </div>
        <div class="sideRight">
          <!-- <span><?= $detail['hazard_date'];?></span> -->
        </div>
      </div>
    </div>
  </div>
  <div class="embody__content">
    <table class="table table-striped" width="100%">
      <thead>
        <tr>
          <th scope="col" width="30%" hidden="">#</th>
          <th scope="col" width="70%" hidden="">First</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">ID Harmonis</th>
          <td><?= 'HZ'.str_pad($detail['hazard_id'],5,"0",STR_PAD_LEFT);?></td>
        </tr>
        <tr>
          <th scope="row">Klasifikasi</th>
          <td><?= $detail['classi_name'];?></td>
        </tr>
        <tr>
          <th scope="row">Lokasi</th>
          <td><?= $detail['loc_name'];?></td>
        </tr>
        <tr>
          <th scope="row">Risiko</th>
          <td><?= $detail['risk_name'];?></td>
        </tr>
        <tr>
          <th scope="row">PIC</th>
          <td><?= $detail['divisi_name'];?> - <?= $detail['comp_name'];?></td>
        </tr>
        <tr>
          <th scope="row">Uraian</th>
          <td><?= $detail['hazard_desc'];?></td>
        </tr>
        <tr>
          <th scope="row">Saran</th>
          <td><?= $detail['hazard_solution'];?></td>
        </tr>
      </tbody>
    </table>
  </div>

  <!-- Modal -->
  <div class="modal fade animate__animated animate__flipInY" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <img style="border-radius: 1rem;" width="100%" src="../assets/hazard/thumbnail/<?= $detail['hazard_photo']?>" alt="" data-dismiss="modal" aria-label="Close">
      </div>
    </div>
  </div>

  <!-- TIMELINE -->
  <h6>&emsp;Timeline</h6>
  <div class="timeline">
    <?php 
    $sql = mysqli_query($conn,"SELECT * FROM hazard_status where hazard_status_hazard = ".$detail['hazard_id'].""); 
    while(@$row = mysqli_fetch_array($sql)){
      echo'
      <div class="container left">
      <div class="content">
      <h6>'.$row['hazard_status_name'].'</h6>
      <h6>'.$row['hazard_status_date'].'</h6>
      <p>'.$row['hazard_status_desc'].'</p>';
      if ($row['hazard_status_photo'] != '') {
        echo'<img src="../assets/hazard/thumbnail/'.$row['hazard_status_photo'].'" width="70%">';
      }
      echo'</div>
      </div>';
    }?>
  </div><br>
</section>
</div>


<!-- BOOKMARK SAVE -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#insert").click(function(e){
      var id    = <?= base64_decode($_GET['id'])?>;
      var user  = <?= $_id?>;
      $.ajax({
        url     : 'action.php?action=bookmark&act=save',
        data    : { id:id ,user:user }, 
        type    : 'post',
        success:function(response){
          if(response == 1){
            Swal.fire({
              icon: 'success',
              title: 'Berhasil disimpan!',
              showConfirmButton: false,
              timer: 1000
            }).then(function() {
              location.href = 'home.php?v=hazard-detail&id=<?= $_GET['id']?>';
            });
          }
        }
      });
    });
  });
</script>

<!-- BOOKMARK DELETE -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#delete").click(function(e){
      var id    = <?= base64_decode($_GET['id'])?>;
      var user  = <?= $_id?>;
      $.ajax({
        url     : 'action.php?action=bookmark&act=delete',
        data    : { id:id ,user:user }, 
        type    : 'post',
        success:function(response){
          if(response == 1){
            Swal.fire({
              icon: 'success',
              title: 'Berhasil dihapus!',
              showConfirmButton: false,
              timer: 1000
            }).then(function() {
              location.href = 'home.php?v=hazard-detail&id=<?= $_GET['id']?>';
            });
              // location.replace("home.php?v=dashboard")
            }
          }
        });
    });
  });
</script>

<script type="text/javascript">
    // DELETE HAZARD
    $(document).ready(function(){
      $("#delete-hazard").on("submit", function(e){
        e.preventDefault();
        var id  = $('input[name="id_hazard"]').val();
        var reason  = $('textarea[name="reason"]').val();
        var user  = $('input[name="id_user"]').val();
        document.getElementById("demod").innerHTML = "<center>Please Wait...<br><img src='../assets/img/loader.gif' width='100'></center>";
        $.ajax({
          url  : 'mail_delete.php',
          data : { id:id , reason:reason }, 
          type : 'get',
          success:function(data){
            $.ajax({
              url     : 'action.php?action=hazard&act=delete',
              data    : { id:id ,user:user }, 
              type    : 'post',
              success: function (response) {
                //   location.href = 'home.php?v=dashboard';
                window.history.back();
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil dihapus!',
                  position: 'top',
                  showConfirmButton: false,
                  timer: 1000
                }).then(function() {
                //   location.href = 'home.php?v=dashboard';
                window.history.back();
              });
              } 
            });
          }, error:function(data){
            $.ajax({
              url     : 'action.php?action=hazard&act=delete',
              data    : { id:id ,user:user }, 
              type    : 'post',
              success: function (response) {
                //   location.href = 'home.php?v=dashboard';
                window.history.back();
                Swal.fire({
                  icon: 'success',
                  title: 'Berhasil dihapus!',
                  position: 'top',
                  showConfirmButton: false,
                  timer: 1000
                }).then(function() {
                //   location.href = 'home.php?v=dashboard';
                window.history.back();
              });
              } 
            });
          }
        });
        e.stopImmediatePropagation();
        return false;
      });
    });
  </script>