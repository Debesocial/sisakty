<?php 
if ($_POST['search'] != NULL) {
  $header = tanggal_indonesia($_POST['date1']).' s/d '.tanggal_indonesia($_POST['date2']);
  $date2  = $_POST['date1'];
  $date1  = $_POST['date2'];
}elseif ($_POST['nonaktif'] != NULL) {
 $header = 'Data Visitor Nonaktif';
}elseif ($_POST['aktif'] != NULL) {
 $header = 'Data Visitor Aktif';
} else {
  $header = 'Data Visitor';
}


if(@$_GET['act'] == 'detail'){
  @$detail = mysqli_fetch_array($conn->query("SELECT * FROM visitor WHERE visitor.visitor_id = ".$_GET['id'].""));?>

  <div class="row ">
    <div class="col-md-8 col-lg-8 col-xl-8">
     <div class="card">
      <div class="card-header">
        <h4>Detail Visitor | <i class="fas fa-eye"></i> </h4>
      </div>
      <div class="card-body">
        <center>
          <?php if($detail['visitor_photo'] != ''){?>
            <img alt="image" src="<?= '../../assets/visitor/FOTO/'.$detail['visitor_photo']?>" width="120" height="150">
          <?php }else{?>
            <img alt="image" src="../../assets/super/img/users/user-1.png" class="rounded-circle author-box-picture" width="120" height="120">
          <?php } ?>
        </center>
        <br><br>

        <form id="form-visitor-add">
          <div class="form-group">
            <label>Nomor Visitor</label>
            <input type="text" class="form-control" value="<?= $detail['visitor_no']?>" disabled="">
          </div>

          <div class="form-group">
            <label>Nama Visitor</label>
            <input type="text" class="form-control" value="<?= $detail['visitor_name']?>" disabled="">
          </div>

          <div class="form-group">
            <label>Perusahaan</label>
            <input type="text" class="form-control" value="<?= $detail['visitor_company']?>" disabled="">
          </div>

          <div class="form-group">
            <label>No. Telp</label>
            <input type="text" class="form-control" value="<?= $detail['visitor_phone']?>" disabled="">
          </div>

          <div class="form-group">
            <div class="form-group">
              <label>Keperluan</label>
              <input type="text" class="form-control" value="<?= $detail['visitor_needs']?>" disabled="">
            </div>
          </div>

          <div class="form-group">
            <label>Berlaku Sampai</label>
            <input type="text" class="form-control" value="<?= $detail['visitor_end']?>" disabled="">
          </div><br>

          <div class="form-group">
            <h6>Dokumen Pendukung</h6>
          </div>

          <div class="form-group">
            <label><br>Kartu Identitas (KTP/SIM)</label>
          </div>

          <div class="input-group">
            <input type="text" class="form-control" value="<?= $detail['visitor_identity']?>" disabled="">
            <div class="input-group-append">
              <a target="_blank" href="<?= '../../assets/visitor/KTP/'.$detail['visitor_identity']?>" Download><span class="input-group-text">Download</span></a>
            </div>
          </div>

          <?php if($detail['visitor_permission'] != ''){?>
            <div class="form-group">
              <label><br>Surat Izin Masuk Site</label>
            </div>
            <div class="input-group">
              <input type="text" class="form-control" value="<?= $detail['visitor_permission']?>" disabled="">  
              <div class="input-group-append">
                <a target="_blank" href="<?= '../../assets/visitor/SURATIJIN/'.$detail['visitor_permission']?>" Download><span class="input-group-text">Download</span></a>
              </div>
            </div>
          <?php } ?>
          <br><br>
        </form>
      </div>
    </div>
  </div>
</div>

<?php }elseif(@$_GET['act'] == 'add'){?>
  <div class="row">
    <div class="col-md-8 col-lg-8 col-xl-8">
      <div class="card">
        <div class="card-header">
         <h4>Data Visitor | <i class="fas fa-plus-circle"></i> </h4>
       </div>
       <div class="card-body">
        <form id="form-visitor-add">

          <div class="form-group">
            <label>Nomor Visitor</label>
            <select class="form-control select2" id="" required name="idcard">
              <option value=""> - Pilih -</option>
              <?php $data = mysqli_query($conn,"select * from visitor_status where visitor_status_name != 'Aktif'");
              while($row  = mysqli_fetch_array($data)){ ?> 
                <option value='<?= $row['visitor_status_no'];?>'><?= $row['visitor_status_no'];?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label>Nama Visitor</label>
            <input type="text" class="form-control" id="" required placeholder="Nama Visitor" name="name">
          </div>

          <div class="form-group">
            <label>Perusahaan</label>
            <input type="text" class="form-control" id="" required placeholder="Perusahaan" name="company">
          </div>

          <div class="form-group">
            <label>No. Telp</label>
            <input type="number" class="form-control" id="" required placeholder="No. Telp" name="phone">
          </div>

          <div class="form-group">
            <div class="form-group">
              <label>Keperluan</label>
              <textarea  type="text" class="form-control" id="" required placeholder="Keperluan" name="needs"></textarea>
            </div>
          </div>

          <div class="form-group">
            <label>Berlaku Sampai</label>
            <input type="date" class="form-control" id="backdate" required placeholder="Sampai Tanggal" name="end">
            <script type="text/javascript">
             document.getElementById("backdate").min = new Date().getFullYear() + "-" +  parseInt(new Date().getMonth() + 1 ) + "-" + new Date().getDate()
           </script>
         </div><br>

         <div class="form-group">
          <h6>Dokumen Pendukung</h6>
        </div>

        <div class="form-group">
          <label>Kartu Identitas (KTP/SIM)</label>
          <input type="file" class="form-control" id="" required placeholder="KTP/SIM" name="ktp">
        </div>

        <div class="form-group">
          <label>Surat Izin Masuk Site (Optional)</label>
          <input type="file" class="form-control" id="" placeholder="Surat Izin" name="suratizin">
        </div>

        <div class="form-group">
          <label>Foto (Optional)</label>
          <input type="file" class="form-control" id="" placeholder="Foto" name="photo" accept=".jpg,.jpeg,.png" onchange="validateFileType()">
        </div>

        <div class="form-group"><br>
          <div class="row">
            <div class="col-md-6 col-lg-6 col-xl-6">
              <!-- <button type="reset" class="btn btn-sm btn-basic form-control">Reset</button><br><br> -->
            </div>
            <div class="col-md-6 col-lg-6 col-xl-6">
              <button type="submit" id="visitor-add" name="visitor-add" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</button><br><br>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>

<?php }elseif(@$_GET['act'] == 'edit'){
 @$edit = mysqli_fetch_array($conn->query("SELECT * FROM visitor WHERE visitor.visitor_id = ".$_GET['id'].""));?>

 <div class="row">
  <div class="col-md-8 col-lg-8 col-xl-8">
    <div class="card">
      <div class="card-header">
        <h4>Edit Visitor | <i class="fas fa-edit"></i> </h4>
      </div>
      <div class="card-body">
        <form id="form-visitor-edit">

          <div class="form-group">
            <label>Nomor Visitor</label>
            <input type="text" class="form-control" name="" value="<?= $edit['visitor_no'] ?>" disabled >
            <input type="text" class="form-control" name="idcard" value="<?= $edit['visitor_no'] ?>" hidden >
          </div>

          <div class="form-group">
            <label>Nama Visitor</label>
            <input type="text" class="form-control" id="" required placeholder="Nama Visitor" name="name" value="<?= $edit['visitor_name'] ?>">
          </div>

          <div class="form-group">
            <label>Perusahaan</label>
            <input type="text" class="form-control" id="" required placeholder="Perusahaan" name="company" value="<?= $edit['visitor_company'] ?>">
          </div>

          <div class="form-group">
            <label>No. Telp</label>
            <input type="number" class="form-control" id="" required placeholder="No. Telp" name="phone" value="<?= $edit['visitor_phone'] ?>">
          </div>

          <div class="form-group">
            <div class="form-group">
              <label>Keperluan</label>
              <textarea  type="text" class="form-control" id="" required placeholder="Keperluan" name="needs"><?= $edit['visitor_needs'] ?></textarea>
            </div>
          </div>

          <div class="form-group">
            <label>Berlaku Sampai</label>
            <input type="date" class="form-control" id="" required placeholder="Sampai Tanggal" name="end" value="<?= $edit['visitor_end'] ?>">
          </div><br>

          <div class="form-group">
            <h6>Dokumen Pendukung</h6>
          </div>

          <div class="form-group">
            <label>Kartu Identitas (KTP/SIM)</label><br>
            <input type="file" id="files1" name="ktp" value="<?= $edit['visitor_identity'] ?>">
            <label for="files1"><?= $edit['visitor_identity'] ?></label>
          </div>

          <div class="form-group">
            <label>Surat Izin Masuk Site</label><br>
            <input type="file" id="files2" name="suratizin" value="<?= $edit['visitor_permission'] ?>">
            <label for="files2"><?= $edit['visitor_permission'] ?></label>
          </div>

          <div class="form-group">
            <label>Foto</label><br>
            <input type="file" id="files3" name="photo" value="<?= $edit['visitor_photo'] ?>" class="hidden"/ accept=".jpg,.jpeg,.png" onchange="validateFileType()">
            <label for="files3"><?= $edit['visitor_photo'] ?></label>
          </div>

          <div class="form-group"><br>
            <div class="row">
              <div class="col-12">
                <input type="hidden" name="id" value="<?= $edit['visitor_id'] ?>"/>
                <button type="submit" id="visitor-edit" name="visitor-edit" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</button><br><br>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php } else { ?>
  <center>
    <div class="card-header-form">
      <form method="POST">
        <div class="form-row">
         <div class="col">
          <input name="date1" type="date" class="form-control" required >
        </div>
        <div class="col">
          <input name="date2" type="date" class="form-control" required>
        </div>
        <div class="col">
          <select class="form-control select2" id="" required name="berdasarkan">
            <option value=""> - Cari Berdasarkan -</option>
            <option value="pengajuan"> Tanggal Pengajuan</option>
            <option value="berlaku"> Tanggal Berlaku</option>
          </select>
        </div>
        <div class="col-1">
          <button class="btn btn-primary form-control" type="submit" name="search" value="search">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </form>

      <div class="col-2">
        <form action="" method="post">
          <button class="btn btn-info form-control" type="submit" name="aktif" value="aktif">
            Aktif
          </button>
        </form>
      </div>

      <div class="col-2">
        <form action="" method="post">
          <button class="btn btn-info form-control" type="submit" name="nonaktif" value="nonaktif">
            Nonaktif
          </button>
        </form>
      </div>

    </div>
  </center><br>

  <div class="tab-content" id="myTabContent">
    <div class="alert alert-light" role="alert"> 
      <center><?= '<strong>'.$header.'</strong>'; ?></center>
    </div>
    <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
      <div class="row ">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4>Data Visitor | <i class="fas fa-list"></i></h4>  
              <div class="card-header-form">
                <h4>
                  <a href="home.php?v=visitor&act=add" class="btn btn-sm btn-primary "><i class="fas fa-plus-circle"></i> 
                    Tambah Visitor
                  </a>
                </h4>     
              </div>    
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-striped table-hover" id="datatable_export" style="width:100%;">
                  <thead>
                    <tr>
                     <th>Status</th>
                     <th>Nomor Visitor</th>
                     <th>Tanggal Pengajuan</th>
                     <th>Berlaku Sampai</th>
                     <th>Nama</th>
                     <th>Perusahaan</th>
                     <th>No. Telp</th>
                     <th>Keperluan</th>
                     <th width="20%">Action</th>
                   </tr>
                 </thead>
                 <tbody>
                  <?php
                  if($_POST['berdasarkan'] == 'pengajuan') {
                    $data = mysqli_query($conn,"SELECT * FROM visitor 
                      WHERE visitor_date <= '$date1'
                      AND visitor_date >= '$date2'
                      ORDER BY visitor_id DESC");
                  }elseif($_POST['berdasarkan'] == 'berlaku') {
                    $data = mysqli_query($conn,"SELECT * FROM visitor 
                      WHERE visitor_end <= '$date1'
                      AND visitor_end >= '$date2'
                      ORDER BY visitor_id DESC");
                  }elseif($_POST['aktif'] == 'aktif') {
                    $data = mysqli_query($conn,"SELECT * FROM visitor 
                      WHERE visitor_status = 'Aktif'
                      ORDER BY visitor_id DESC");
                  }elseif($_POST['nonaktif'] == 'nonaktif') {
                    $data = mysqli_query($conn,"SELECT * FROM visitor 
                      WHERE visitor_status = 'Nonaktif'
                      ORDER BY visitor_id DESC");
                  }else{
                    $data = mysqli_query($conn,"SELECT * FROM visitor 
                      ORDER BY visitor_id DESC");
                  }
                  while($row  = mysqli_fetch_array($data)){ ?> 
                    <tr>
                      <td>
                       <?php if($row['visitor_status'] !='Aktif'){
                        echo'<span class="badge badge-pill badge-secondary">Nonaktif</span>';
                      } else {
                        echo'<span class="badge badge-pill badge-success">&emsp;Aktif&emsp;</span>';
                      } ?>
                    </td>
                    <td><?= $row['visitor_no'] ?></td>
                    <td><?= date('d/m/Y',strtotime($row['visitor_date']))?></td>
                    <td><?= date('d/m/Y',strtotime($row['visitor_end']))?></td>
                    <td><a href="home.php?v=visitor&act=detail&id=<?= $row['visitor_id']; ?>"><?= $row['visitor_name'] ?></a></td>
                    <td><?= $row['visitor_company'] ?></td>
                    <td><?= $row['visitor_phone'] ?></td>
                    <td><?= $row['visitor_needs'] ?></td>
                    <td>
                      <?php if($row['visitor_status'] == 'Aktif'){?>
                        <a href="home.php?v=visitor&act=edit&id=<?= $row['visitor_id']; ?>" class="btn btn-outline-success"><i class="fas fa-edit"></i>Edit</a>
                        <a href="" data-toggle="modal" class="btn btn-outline-danger ModalClick" data-id="<?= $row['visitor_no']; ?>" data-target="#myModal"><i class="fas fa-sign-out-alt"></i>Nonaktif</a>
                      <?php } else{ ?>
                        <a href="#" class="btn btn-outline-secondary" style="color:#cdd3d8;border-color:#cdd3d8;"><i class="fas fa-edit"></i>Edit</a>
                        <a href="#"class="btn btn-outline-secondary"  style="color:#cdd3d8;border-color:#cdd3d8;"><i class="fas fa-times"></i>Nonaktif
                        <?php }?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<!-- Nonaktif -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Nonaktif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah anda yakin akan menonaktifkan visitor ini ?
      </div>
      <div class="modal-footer">
        <form id="form-visitor-nonaktif">
          <input type="text" name="no" id="no" hidden="" />
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" id="visitor-nonaktif" name="visitor-nonaktif" class="btn btn-danger">Ya, Nonaktif</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
 if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

<!-- ADD VISITOR -->
<script type="text/javascript">
 $(document).ready(function(){
  $("#form-visitor-add").on("submit", function(e){
   e.preventDefault();
   var formData = new FormData(this);
   $.ajax({
    url  : "action/action.php?action=visitor&act=add",
    type : "POST",
    cache:false,
    data :formData,
    contentType : false, 
    processData: false,
    success : function(data){
     Swal.fire({
      icon: 'success',
      title: 'Berhasil Ditambahkan!',
      showConfirmButton: false,
      timer: 1000
    }).then(function() {
      location.href = 'home.php?v=visitor';
    });
  }
});
 });
});
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $("#form-visitor-edit").on("submit", function(e){
      e.preventDefault();
      var formData = new FormData(this);
      $.ajax({
        url  : "action/action.php?action=visitor&act=edit",
        type : "POST",
        cache:false,
        data :formData,
        contentType : false, 
        processData: false,
        success : function(data){
          Swal.fire({
            icon: 'success',
            title: 'Berhasil Disimpan!',
            showConfirmButton: false,
            timer: 1000
          }).then(function() {
            location.href = 'home.php?v=visitor';
          });
        }
      });
    });
  });
</script>

<!-- NONAKTIF VISITOR -->
<script type="text/javascript">
 $(document).ready(function(){
  $("#form-visitor-nonaktif").on("submit", function(e){
   e.preventDefault();
   var formData = new FormData(this);
   $.ajax({
    url  : "action/action.php?action=visitor&act=nonaktif",
    type : "POST",
    cache:false,
    data :formData,
    contentType : false, 
    processData: false,
    success : function(data){
     Swal.fire({
      icon: 'success',
      title: 'Berhasil dinonaktifkan!',
      showConfirmButton: false,
      timer: 1000
    }).then(function() {
      location.href = 'home.php?v=visitor';
    });
  }
});
 });
});
</script>

<script type="text/javascript">
  $(".ModalClick").click(function () {
    var passedID = $(this).data('id');
    $('input:text').val(passedID);
  });
</script>

<script type="text/javascript">
 let file = document.getElementById("fileName");
 function validateFileType(){
  var fileName = file.value,
  idxDot = fileName.lastIndexOf(".") + 1,
  extFile = fileName.substr(idxDot, fileName.length).toLowerCase();
  if (extFile=="jpg" || extFile=="jpeg" || extFile=="png"){
  }else{
   alert("Only jpg/jpeg and png files are allowed!");
   file.value = "";
 }
}
</script>
