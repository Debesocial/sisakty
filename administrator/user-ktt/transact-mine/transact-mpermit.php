  <?php 
  @$open=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM mpermit
    where mpermit_status_approval = 'Open'"));
  @$progress=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM mpermit
  	where mpermit_status_approval = 'Progress'"));
  @$reject=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM mpermit
    where mpermit_status_approval = 'Reject'"));
  @$closed=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM mpermit
    where mpermit_status_approval = 'Closed'"));

  if (@$_POST['today'] != NULL) {
  	$header = '<strong>'.tanggal_indonesia(date('Y-m-d')).'</strong>';
  	$date1  = date("Y-m-d");
  	$date2  = date("Y-m-d");
  } elseif (@$_POST['month'] != NULL) {
  	$header = '<strong>'.tanggal_indonesia(date('Y-m')).'</strong>';
  	$date1  = date("Y-m-31");
  	$date2  = date("Y-m-01");
  } elseif (@$_POST['year'] != NULL) {
  	$header = '<strong>Tahun'.tanggal_indonesia(date("Y")).'</strong>';
  	$date1  = date("Y-12-31");
  	$date2  = date("Y-01-01");
  } elseif (@$_POST['search'] != NULL) {
  	$header = '<strong>'.tanggal_indonesia($_POST['date1']).' s/d '.tanggal_indonesia($_POST['date2']).'</strong>';
  	$date2  = $_POST['date1'];
  	$date1  = $_POST['date2'];
  	$comp   = $_POST['comp'];
  } elseif(@$_POST['open'] != null) {
    $header = '<strong>Pengajuan yang harus di Approve Safety MIP<small> ( <i>Total : '.$open['total'].'</i>&nbsp; )</small></strong>';
  } elseif(@$_POST['reject'] != null) {
    $header = '<strong>Pengajuan yang direject<small> ( <i>Total : '.$reject['total'].'</i>&nbsp; )</small></strong>';
  } elseif(@$_POST['closed'] != null) {
    $header = '<strong>Pengajuan yang disetujui<small> ( <i>Total : '.$closed['total'].'</i>&nbsp; )</small></strong>';
  } else {
  	$header = '<strong>Pengajuan yang harus di Approve</strong> <small>( <i>Total : '.$progress['total'].'</i></small>&nbsp; )';
    $multi = 'Y';
  }


  @$edit  = mysqli_fetch_array($conn->query("SELECT * FROM mpermit 
  	LEFT JOIN user on user.user_id = mpermit.mpermit_user
  	LEFT JOIN divisi on divisi.divisi_id = user.user_divisi 
  	LEFT JOIN company on company.comp_id = user.user_comp 
  	WHERE mpermit.mpermit_id = ".$_GET['id'].""));

  	if(@$_GET['act'] == 'add'){?>
  		<div class="row">
  			<div class="col-md-8 col-lg-8 col-xl-8">
  				<div class="card">
  					<div class="card-header">
  						<h4>Data Mine Permit | <i class="fas fa-plus-circle"></i> </h4>
  					</div>
  					<div class="card-body">
  						<form id="form-mine-add">

  							<div class="form-group">
  								<label>Kategori</label>
  								<select class="form-control select2" id="kategori" required placeholder="Kategori" name="kategori">
  									<option value=""> - Pilih -</option>
  									<option value="Karyawan"> Karyawan</option>
  									<option value="Visitor"> Visitor</option>
  								</select>
  							</div>

  							<div class="form-group">
  								<label>Pemohon</label>
  								<select class="form-control select2" data-live-search="true" id="user" required name="user" onchange="myChangeFunction(this)"> 
  									<option value="">- Pilih -</option>
  									<?php $data = mysqli_query($conn,"SELECT * FROM user 
  										LEFT JOIN divisi ON divisi.divisi_id = user.user_divisi 
  										LEFT JOIN company ON company.comp_id = user.user_comp");
  										while($row  = mysqli_fetch_array($data)){ ?> 
  											<option value='<?= $row['user_id'].'|'.$row['divisi_name'].'|'.$row['comp_name'].'|'.$row['user_onsite'].'|'.$row['user_birth'].'|'.$row['comp_id'];?>'><?= $row['user_nik']?> - <?= $row['user_name']?>
  										</option>
  									<?php } ?>
  								</select>
  							</div>

  							<div class="form-group">
  								<label>Divisi</label>
  								<input type="text" id="myInput1" class="form-control" disabled="" value="Divisi">
  							</div>

  							<div class="form-group">
  								<label>Perusahaan</label>
  								<input type="text" id="pic" class="form-control" hidden=""  name="pic"/>
  								<input type="text" id="myInput2" class="form-control" disabled="" value="Perusahaan"/>
  							</div>

  							<div class="form-group">
  								<label>Masuk Site</label>
  								<input type="text" id="myInput3" class="form-control" disabled="" value="Masuk Site"/>
  							</div>

  							<div class="form-group">
  								<label>Tanggal Lahir</label>
  								<input type="text" id="myInput4" class="form-control" disabled="" value="Tanggal Lahir"/>
  							</div>

  							<div class="form-group">
  								<label>Status Pengajuan</label>
  								<select class="form-control select2" id="status" required name="status">
  									<option value=""> - Pilih -</option>
  									<option value="Baru">Baru</option>
  									<option value="Penggantian">Penggantian</option>
  									<option value="Perubahan">Perubahan</option>
  								</select>
  							</div>

  							<div class="form-group" id="status_hide" style="display:none;">
  								<label>Alasan Penggantian / Perubahan</label>
  								<textarea name="status_desc" id="status_desc" class="form-control" placeholder="Alasan Penggantian / Perubahan"></textarea>
  							</div>

  							<br><div class="form-group"><h6>Area Kerja</h6></div>

  							<div class="row">
  								<div class="col-md-6 col-lg-6 col-xl-6">
  									<div class="form-group">
  										<label>Kantor (Office)</label>
  										<select class="form-control select2" id="kantor" required name="kantor">
  											<option value=""> - Pilih -</option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>

  									<div class="form-group">
  										<label>Tambang (Mine)</label>
  										<select class="form-control select2" id="tambang" required name="tambang">
  											<option value=""> - Pilih -</option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>

  									<div class="form-group">
  										<label>Mess (Camp)</label>
  										<select class="form-control select2" id="mess" required name="mess">
  											<option value=""> - Pilih -</option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>

  									<div class="form-group">
  										<label>Bengkel (Workshop)</label>
  										<select class="form-control select2" id="bengkel" required name="bengkel">
  											<option value=""> - Pilih -</option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>
  								</div>

  								<div class="col-md-6 col-lg-6 col-xl-6">
  									<div class="form-group">
  										<label>CPP, Washing Plant</label>
  										<select class="form-control select2" id="cpp" required name="cpp">
  											<option value=""> - Pilih -</option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>

  									<div class="form-group">
  										<label>Laboratorium (CPP)</label>
  										<select class="form-control select2" id="laboratorium" required name="laboratorium">
  											<option value=""> - Pilih -</option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>

  									<div class="form-group">
  										<label>Eksplorasi (Exploration)</label>
  										<select class="form-control select2" id="eksplorasi" required name="eksplorasi">
  											<option value=""> - Pilih -</option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>

  									<div class="form-group">
  										<label>Pelabuhan (Jetty, Port)</label>
  										<select class="form-control select2" id="pelabuhan" required name="pelabuhan">
  											<option value=""> - Pilih -</option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>
  								</div>
  							</div>

  							<br><div class="form-group"><h6>Dokumen Pendukung</h6></div>

  							<div class="form-group">
  								<label>Pengesahan Hasil Pemeriksaan Kesehatan</label>
  								<input type="file" class="form-control" id="" required placeholder="skd" name="skd">
  							</div>
  							<div class="form-group">
  								<label>Kartu Identitas</label>
  								<input type="file" class="form-control" id="" required placeholder="idcard" name="idcard">
  							</div>
  							<div class="form-group">
  								<label>Foto, Portrait, size : 4 x 6</label>
  								<input type="file" class="form-control" id="" required placeholder="foto" name="foto">
  							</div>
  							<div class="form-group" id="suratijin">
  								<label>Surat Izin Masuk Site (Optional)</label>
  								<input type="file" class="form-control" id="" placeholder="suratijin" name="suratijin">
  							</div>
  							<div class="form-group" id="beritaacara" style="display:none;">
  								<label>Berita Acara Kehilangan (Optional)</label>
  								<input type="file" class="form-control" id="" placeholder="beritaacara" name="beritaacara">
  							</div>
  							<div class="form-group"><br>
  								<div class="row">
  									<div class="col-md-6 col-lg-6 col-xl-6">
  										<!-- <button type="reset" class="btn btn-outline-basic form-control">Reset</button><br><br> -->
  									</div>
  									<div class="col-md-6 col-lg-6 col-xl-6">
  										<button type="submit" id="mine-add" name="mine-add" class="btn btn-outline-primary form-control"><i class="fas fa-save"></i> Simpan</button><br><br>
  									</div>
  								</div>
  							</div>
  						</form>
  					</div>
  				</div>
  			</div>
  		</div>

  	<?php }elseif(@$_GET['act'] == 'edit'){?>
  		<div class="row">
  			<div class="col-md-8 col-lg-8 col-xl-8">
  				<div class="card">
  					<div class="card-header">
  						<h4>Data Mine Permit | <i class="fas fa-plus-circle"></i></h4>
  					</div>
  					<div class="card-body">
  						<form id="form-mine-edit">
  							<input type="text" name="pic" value="<?= $_SESSION['user_divisi']?>" hidden> 

  							<div class="form-group">
  								<label>Kategori</label>
  								<select class="form-control select2" id="kategori" required placeholder="Kategori" name="kategori">
  									<option value="<?= $edit['mpermit_categories']?>"><?= $edit['mpermit_categories']?></option>
  									<option value="Karyawan"> Karyawan</option>
  									<option value="Visitor"> Visitor</option>
  								</select>
  							</div>

  							<div class="form-group">
  								<label>Pemohon</label>
  								<input type="text" id="myInput1" class="form-control" disabled="" value="<?= $edit['user_name']?>" />
  							</div>

  							<div class="form-group">
  								<label>Divisi</label>
  								<input type="text" id="myInput1" class="form-control" disabled="" value="<?= $edit['divisi_name']?>" />
  							</div>

  							<div class="form-group">
  								<label>Perusahaan</label>
  								<input type="text" id="myInput2" class="form-control" disabled="" value="<?= $edit['comp_name']?>"/>
  							</div>

  							<div class="form-group">
  								<label>Masuk Site</label>
  								<input type="text" id="myInput3" class="form-control" disabled="" value="<?= $edit['user_onsite']?>"/>
  							</div>

  							<div class="form-group">
  								<label>Tanggal Lahir</label>
  								<input type="text" id="myInput4" class="form-control" disabled="" value="<?= $edit['user_birth']?>"/>
  							</div>

  							<div class="form-group">
  								<label>Status Pengajuan</label>
  								<select class="form-control select2" id="status" required name="status">
  									<option value="<?= $edit['mpermit_status']?>"><?= $edit['mpermit_status']?></option>
  									<option value="Baru">Baru</option>
  									<option value="Penggantian">Penggantian</option>
  									<option value="Perubahan">Perubahan</option>
  								</select>
  							</div>

  							<div class="form-group" id="status_hide" style="display:none;">
  								<label>Alasan Penggantian / Perubahan</label>
  								<textarea name="status_desc" id="status_desc" class="form-control" placeholder="Alasan Penggantian / Perubahan"><?= $edit['mpermit_status_desc']?></textarea>
  							</div>

  							<br><div class="form-group"><h6>Area Kerja</h6></div>

  							<div class="row">
  								<div class="col-md-6 col-lg-6 col-xl-6">
  									<div class="form-group">
  										<label>Kantor (Office)</label>
  										<select class="form-control select2" id="kantor" required name="kantor">
  											<option value="<?= $edit['mpermit_office']?>"><?= $edit['mpermit_office']?></option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>

  									<div class="form-group">
  										<label>Tambang (Mine)</label>
  										<select class="form-control select2" id="tambang" required name="tambang">
  											<option value="<?= $edit['mpermit_mine']?>"><?= $edit['mpermit_mine']?></option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>

  									<div class="form-group">
  										<label>Mess (Camp)</label>
  										<select class="form-control select2" id="mess" required name="mess">
  											<option value="<?= $edit['mpermit_camp']?>"><?= $edit['mpermit_camp']?></option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>

  									<div class="form-group">
  										<label>Bengkel (Workshop)</label>
  										<select class="form-control select2" id="bengkel" required name="bengkel">
  											<option value="<?= $edit['mpermit_workshop']?>"><?= $edit['mpermit_workshop']?></option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>
  								</div>

  								<div class="col-md-6 col-lg-6 col-xl-6">
  									<div class="form-group">
  										<label>CPP, Washing Plant</label>
  										<select class="form-control select2" id="cpp" required name="cpp">
  											<option value="<?= $edit['mpermit_cpp']?>"><?= $edit['mpermit_cpp']?></option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>

  									<div class="form-group">
  										<label>Laboratorium (CPP)</label>
  										<select class="form-control select2" id="laboratorium" required name="laboratorium">
  											<option value="<?= $edit['mpermit_lab']?>"><?= $edit['mpermit_lab']?></option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>

  									<div class="form-group">
  										<label>Eksplorasi (Exploration)</label>
  										<select class="form-control select2" id="eksplorasi" required name="eksplorasi">
  											<option value="<?= $edit['mpermit_exploration']?>"><?= $edit['mpermit_exploration']?></option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>

  									<div class="form-group">
  										<label>Pelabuhan (Jetty, Port)</label>
  										<select class="form-control select2" id="pelabuhan" required name="pelabuhan">
  											<option value="<?= $edit['mpermit_jetty']?>"><?= $edit['mpermit_jetty']?></option>
  											<option value="full">Full</option>
  											<option value="rest">Rest</option>
  											<option value="forbidden">Forbiden</option>
  										</select>
  									</div>
  								</div>
  							</div>

  							<br><div class="form-group"><h6>Dokumen Pendukung</h6></div>

  							<div class="form-group">
  								<label>Pengesahan Hasil Pemeriksaan Kesehatan</label><br>
  								<input type="file" id="" placeholder="skd" name="skd" value="<?= $edit['mpermit_skd'] ?>">
  								<label for="files1"><?= $edit['mpermit_skd'] ?></label>
  							</div>

  							<div class="form-group">
  								<label>Kartu Identitas</label><br>
  								<input type="file" id="" placeholder="idcard" name="idcard" value="<?= $edit['mpermit_idcard'] ?>">
  								<label for="files1"><?= $edit['mpermit_idcard'] ?></label>
  							</div>

  							<div class="form-group">
  								<label>Foto, Portrait, size : 4 x 6</label><br>
  								<input type="file" id="" placeholder="foto" name="foto" value="<?= $edit['mpermit_photo'] ?>">
  								<label for="files1"><?= $edit['mpermit_photo'] ?></label>
  							</div>

  							<div class="form-group" id="suratijin">
  								<label>Surat Izin Masuk Site (Optional)</label><br>
  								<input type="file" id="" placeholder="suratijin" name="suratijin" value="<?= $edit['mpermit_suratijin'] ?>">
  								<label for="files1"><?= $edit['mpermit_suratijin'] ?></label>
  							</div>

  							<div class="form-group" id="beritaacara" style="display:none;">
  								<label>Berita Acara Kehilangan (Optional)</label><br>
  								<input type="file" id="" placeholder="beritaacara" name="beritaacara" value="<?= $edit['mpermit_beritaacara'] ?>">
  								<label for="files1"><?= $edit['mpermit_beritaacara'] ?></label>
  							</div>

  							<div class="form-group"><br>
  								<div class="row">
  									<div class="col-md-6 col-lg-6 col-xl-6">
  										<!-- <button type="reset" class="btn btn-outline-basic form-control">Reset</button><br><br> -->
  									</div>
  									<div class="col-md-6 col-lg-6 col-xl-6">
  										<input type="hidden" name="id" value="<?= $edit['mpermit_id'] ?>"/>
  										<button type="submit" id="mine-edit" name="mine-edit" class="btn btn-outline-primary form-control"><i class="fas fa-save"></i> Simpan</button><br><br>
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
  							<select class="form-control select2" id="" required name="comp">
  								<option value=""> - Pilih Perusahaan -</option>
  								<option value="all">Semua Perusahaan</option>
  								<?php $company = mysqli_query($conn,"select * from company ORDER BY comp_name asc");
  								while($row  = mysqli_fetch_array($company)){ ?> 
  									<option value=<?= $row['comp_id'];?>> 
  										<?= $row['comp_name'];
  									}?> 
  								</option>
  							</select>
  						</div>
  						<div class="col-1">
  							<button class="btn btn-primary form-control" type="submit" name="search" value="search">
  								<i class="fas fa-search"></i>
  							</button>
  						</div>
  					</form>

  					<div class="col-1">
  						<form action="" method="post">
  							<button name="today" value="today" class="btn btn-info form-control">TODAY</button>
  						</form>
  					</div>

  					<div class="col-1">
  						<form action="" method="post">
  							<button name="month" value="month" class="btn btn-info form-control"><span style="text-transform: uppercase;"><?= date('M') ?></span></button>
  						</form>
  					</div>

  					<div class="col-1">
  						<form action="" method="post">
  							<button name="year" value="year" class="btn btn-info form-control"><?= date('Y') ?></button>
  						</form>
  					</div>

  					<!-- <div class="col-2">
  						<form action="" method="post">
  							<button name="" value="" class="btn btn-success form-control">APPROVAL</button>
  						</form>
  					</div> -->

  				</div>
  			</center><br>

  			<div class="alert alert-light" role="alert"> 
  				<center><?= $header; ?></center>
  			</div>

  			<div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
  				<div class="row ">               
  					<div class="col-md-12">
  						<div class="card">

  							<div class="card-header">
  								<h4>Mine Permit | <i class="fas fa-list"></i></h4>
  								<div class="card-header-form">
  								</div>    
  							</div>
                
  							<div class="card-body">
  								<div class="table-responsive">
  									<?php
  									if (isset($_POST["submits"])) {
  										if (@count($_POST["ids"]) > 0) {
                        $all = implode(",", $_POST["ids"]);
                        $sql = mysqli_query($conn, "UPDATE mpermit SET 
                          mpermit_approval_ktt    = 'Approve',
                          mpermit_status_approval = 'Closed',
                          mpermit_approval_ktt_date = now(),
                          mpermit_status_approval = 'Closed',
                          mpermit_status_active   = 'Verified' 
                          WHERE mpermit_id in ($all)
                          AND mpermit_status_approval = 'Progress'");
                        if ($sql) {
                          echo'<script>Swal.fire({ icon: "success", text: "Berhasil Diapprove !" }).then((result) => {
                           if (result.isConfirmed) { window.location.href = "home.php?v=mpermit" }})</script>';
                         } else {
                           echo'<script>Swal.fire({ icon: "error", text: "Gagal Diapprove !" }).then((result) => {
                            if (result.isConfirmed) { window.location.href = "home.php?v=mpermit" }})</script>';
                          }
                        } else {
                         echo'<script>Swal.fire({ icon: "warning", text: "Tidak ada data yang dipilih !" }).then((result) => {
                          if (result.isConfirmed) { window.location.href = "home.php?v=mpermit" }})</script>';
                        }
                      }
                      ?>
                      <form name="multipledeletion" method="post">
                       <table class="table table-striped table-hover" id="datatable_export" style="width:100%;">
                        <thead>
                          <?php if(@$multi == 'Y'){?>
                            <tr>
                             <button type="submit" name="submits" class="btn btn-outline-success btn-md pull-left" onClick="return confirm('Are you sure you want to Approve?');"><i class="fas fa-check"></i> Approve yang Dipilih</button>
                           </tr>
                         <?php } ?>
                         <tr>
                           <th><input type="checkbox" id="select_all" /></th>
                           <th width="15%">Status Timeline</th>
                           <th hidden>Datetime</th>
                           <th>Tanggal</th>
                           <th>Status</th>
                           <th>Kategori</th>
                           <th width="20%">User</th>
                           <th>PIC</th>
                           <th style="text-align: center">Action</th>
                         </tr>
                       </thead>
                       <tbody>
                         <?php 
                         if (@$date1 == NULL) {
                          if(@$_POST['open'] != NULL) {
                            $data = mysqli_query($conn,"SELECT * FROM mpermit 
                              LEFT JOIN user on user.user_id = mpermit.mpermit_user
                              LEFT JOIN company on company.comp_id = user.user_comp
                              WHERE mpermit.mpermit_status_approval = 'Open'");
                          } elseif (@$_POST['reject'] != NULL) {
                           $data = mysqli_query($conn,"SELECT * FROM mpermit 
                            LEFT JOIN user on user.user_id = mpermit.mpermit_user
                            LEFT JOIN company on company.comp_id = user.user_comp
                            WHERE mpermit.mpermit_status_approval = 'Reject'");
                         } elseif(@$_POST['closed'] != NULL) {
                           $data = mysqli_query($conn,"SELECT * FROM mpermit 
                            LEFT JOIN user on user.user_id = mpermit.mpermit_user
                            LEFT JOIN company on company.comp_id = user.user_comp
                            WHERE mpermit.mpermit_status_approval = 'Closed'");
                         } else {
                           $data = mysqli_query($conn,"SELECT * FROM mpermit 
                            LEFT JOIN user on user.user_id = mpermit.mpermit_user
                            LEFT JOIN company on company.comp_id = user.user_comp
                            WHERE mpermit.mpermit_status_approval = 'Progress'");
                         }
                       }else{
                        if(@$comp == NULL || @$comp == 'all') {
                         $data = mysqli_query($conn,"SELECT * FROM mpermit 
                          LEFT JOIN user on user.user_id = mpermit.mpermit_user
                          LEFT JOIN company on company.comp_id = user.user_comp
                          WHERE mpermit.mpermit_date <= '$date1'
                          AND mpermit.mpermit_date >= '$date2'");
                       }else{
                         $data = mysqli_query($conn,"SELECT * FROM mpermit 
                          LEFT JOIN user on user.user_id = mpermit.mpermit_user
                          LEFT JOIN company on company.comp_id = user.user_comp
                          WHERE mpermit.mpermit_date <= '$date1'
                          AND mpermit.mpermit_date >= '$date2'
                          AND mpermit.mpermit_pic = '$comp'");
                       }
                     }

                     while($row  = mysqli_fetch_array($data)){ ?> 
                      <tr>
                        <td><input type="checkbox" class="checkbox" name="ids[]" value="<?php echo $row['mpermit_id'];?>"/></td>
                        <td style="width: 50px;">
                          <?php if ($row['mpermit_status_approval'] == 'Open') {
                            echo'<span class="badge badge-pill badge-warning">&nbsp;&nbsp;&nbsp;Open&nbsp;&nbsp;</span>';
                          } elseif ($row['mpermit_status_approval'] == 'Progress') {
                            echo'<span class="badge badge-pill badge-primary">Progress</span>';
                          } elseif ($row['mpermit_status_approval'] == 'Closed') {
                            echo'<span class="badge badge-pill badge-success">&nbsp;&nbsp;Closed&nbsp;&nbsp;</span>';
                          } elseif ($row['mpermit_status_approval'] == 'Reject') {
                            echo'<span class="badge badge-pill badge-danger">Rejected</span>';
                          } elseif ($row['mpermit_status_approval'] == 'Cancel') {
                            echo'<span class="badge badge-pill badge-danger">Canceled</span>';
                          }?>
                        </td>
                        <td hidden=""><?= $row['mpermit_creation_date']?></td>
                        <td><?= $row['mpermit_date']?></td>
                        <td><?= $row['mpermit_status']?></td>
                        <td><?= $row['mpermit_categories']?>
                        <?php if($row['mpermit_categories'] == 'Visitor'){
                          echo '<br>Berlaku Sampai : <br>'.$row['mpermit_enddate'];
                        }?>
                      </td>
                      <td>
                        <a href="home.php?v=muser&act=detail&id=<?= $row['mpermit_user']; ?>"><?= $row['user_name']?></a>
                        <br>NIK : <?= $row['user_nik']?>
                      </td>
                      <td><?= $row['comp_name']?></td>
                      <td style="text-align: center">
                       <?php if(
                        $row['mpermit_approval_ktt']    == 'Approve' ||
                        $row['mpermit_submitter']       == 'System' || 
                        $row['mpermit_status_approval'] == 'Open'    || 
                        $row['mpermit_status_approval'] == 'Reject'  || 
                        $row['mpermit_status_approval'] == 'Cancel') {?>
                          <a class="btn btn-outline-secondary" style="color:#cdd3d8;border-color:#cdd3d8;">&nbsp;<i class="fas fa-check"></i> Approve&nbsp;</a>
                          <a class="btn btn-outline-secondary" style="color:#cdd3d8;border-color:#cdd3d8;">&nbsp;<i class="fas fa-times"></i> Reject&nbsp;</a>
                        <?php } else { ?>
                          <a href="" data-toggle="modal" class="btn btn-outline-success MClick1" data-id="<?= $row['mpermit_id']; ?>" data-target="#approve">&nbsp;<i class="fas fa-check"></i> Approve&nbsp;</a>
                          <a href="" data-toggle="modal" class="btn btn-outline-danger MClick3" data-id="<?= $row['mpermit_id']; ?>" data-target="#reject">&nbsp;<i class="fas fa-times"></i> Reject&nbsp;</a>
                        <?php } ?>
                      </td>
                    </tr>
                  <?php } ?>

                </tbody>
              </table>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#select_all').on('click', function() {
     if (this.checked) {
      $('.checkbox').each(function() {
       this.checked = true;
     });
    } else {
      $('.checkbox').each(function() {
       this.checked = false;
     });
    }
  });
    $('.checkbox').on('click', function() {
     if ($('.checkbox:checked').length == $('.checkbox').length) {
      $('#select_all').prop('checked', true);
    } else {
      $('#select_all').prop('checked', false);
    }
  });
  });
</script>

<!-- CANCEL -->
<div class="modal fade" id="cancel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cancel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-mpermit-cancel">
        <div class="modal-body">Apakah anda yakin akan melakukan Cancel untuk pengajuan ini ?<br><br>
          <input type="text" name="id" id="id" hidden="" />
          <textarea class="form-control" name="reason" required=""></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" id="mpermit-cancel" name="mpermit-cancel" class="btn btn-danger">&nbsp;Ya&nbsp;</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- REJECT -->
<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reject</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="form-mpermit-reject">
        <div class="modal-body">Apakah anda yakin akan melakukan Reject untuk pengajuan ini ?<br><br>
          <input type="text" name="id" id="id" hidden="" />
          <textarea class="form-control" name="reason" required=""></textarea>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" id="mpermit-reject" name="mpermit-reject" class="btn btn-danger">&nbsp;Ya&nbsp;</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- APPROVE -->
<div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Anda yakin akan melakukan Approval untuk pengajuan ini ? 
      </div>
      <div class="modal-footer">
        <form id="form-mpermit-approve">
          <input type="text" name="id" id="id" hidden="" />
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" id="mpermit-approve" name="mpermit-approve" class="btn btn-success">&nbsp;Ya&nbsp;</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- APPROVE ALL-->
<div class="modal fade" id="approveall" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Approve Semua</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Anda yakin akan melakukan Approval untuk semua pengajuan ini ? 
      </div>
      <div class="modal-footer">
        <form id="form-mpermit-approveall">
          <input type="text" name="id" id="id"  />
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" id="mpermit-approveall" name="mpermit-approveall" class="btn btn-primary">&nbsp;Ya&nbsp;</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<!-- SHOW & HIDE INPUT FIELD -->
<script type="text/javascript">
  document.getElementById('status').onchange = e => {
    let beritaacara = document.getElementById('beritaacara')
    e.target.value == 'Penggantian' ?
    beritaacara.style.display = 'block' :
    beritaacara.style.display = 'none'

    let suratijin = document.getElementById('suratijin')
    e.target.value != 'Penggantian' ?
    suratijin.style.display = 'block' :
    suratijin.style.display = 'none'

    let statushide = document.getElementById('status_hide')
    e.target.value != 'Baru' ?
    statushide.style.display = 'block' :
    statushide.style.display = 'none'
  }
</script>

<script type="text/javascript">
  $(".MClick1").click(function () {
    var passedID = $(this).data('id');
    $('input:text').val(passedID);
  });
  $(".MClick2").click(function () {
    var passedID = $(this).data('id');
    $('input:text').val(passedID);
  });
  $(".MClick3").click(function () {
    var passedID = $(this).data('id');
    $('input:text').val(passedID);
  });
  $(".MClick4").click(function () {
    var passedID = $(this).data('id');
    $('input:text').val(passedID);
  });
</script>

<!-- AUTO FIELD -->
<script type="text/javascript">
  function myChangeFunction(input1) {
    let text = input1.value;
    const myArray = text.split("|");
    var input1 = document.getElementById('myInput1');
    var input2 = document.getElementById('myInput2');
    var input3 = document.getElementById('myInput3');
    var input4 = document.getElementById('myInput4');
    var pic    = document.getElementById('pic');
    input1.value = myArray[1];
    input2.value = myArray[2];
    input3.value = myArray[3];
    input4.value = myArray[4];
    pic.value    = myArray[5];
  }
</script>

<!-- ADD MINE -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#form-mine-add").on("submit", function(e){
     e.preventDefault();
     var formData = new FormData(this);
     $.ajax({
      url  : "action/action.php?action=mpermit&act=add",
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
        location.href = 'home.php?v=mpermit';
      });
    }
  });
   });
  });
</script>

<!-- EDIT MINE -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#form-mine-edit").on("submit", function(e){
     e.preventDefault();
     var formData = new FormData(this);
     $.ajax({
      url  : "action/action.php?action=mpermit&act=edit",
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
        location.href = 'home.php?v=mpermit';
      });
    }
  });
   });
  });
</script>

<!-- CANCEL MPERMIT -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#form-mpermit-cancel").on("submit", function(e){
     e.preventDefault();
     var formData = new FormData(this);
     $.ajax({
      url  : "action/action.php?action=mpermit&act=cancel",
      type : "POST",
      cache:false,
      data :formData,
      contentType : false, 
      processData: false,
      success : function(data){
       Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        showConfirmButton: false,
        timer: 1000
      }).then(function() {
        location.href = 'home.php?v=mpermit';
      });
    }
  });
   });
  });
</script>

<!-- APPROVE MPERMIT -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#form-mpermit-approve").on("submit", function(e){
     e.preventDefault();
     var formData = new FormData(this);
     $.ajax({
      url  : "action/action.php?action=mpermit&act=approve",
      type : "POST",
      cache:false,
      data :formData,
      contentType : false, 
      processData: false,
      success : function(data){
       Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        showConfirmButton: false,
        timer: 1000
      }).then(function() {
        location.href = 'home.php?v=mpermit';
      });
    }
  });
   });
  });
</script>

<!-- APPROVE MPERMIT -->
                      <!-- <script type="text/javascript">
                      $(document).ready(function(){
                        $("#form-mpermit-approveall").on("submit", function(e){
                         e.preventDefault();
                         var formData = new FormData(this);
                         $.ajax({
                          url  : "action/action.php?action=mpermit&act=approveall",
                          type : "POST",
                          cache:false,
                          data :formData,
                          contentType : false, 
                          processData: false,
                          success : function(data){
                           Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            showConfirmButton: false,
                            timer: 1000
                          }).then(function() {
                            location.href = 'home.php?v=mpermit';
                          });
                        }
                      });
                       });
                      });
                    </script> -->

                    <!-- REJECT MPERMIT -->
                    <script type="text/javascript">
                      $(document).ready(function(){
                        $("#form-mpermit-reject").on("submit", function(e){
                         e.preventDefault();
                         var formData = new FormData(this);
                         $.ajax({
                          url  : "action/action.php?action=mpermit&act=reject",
                          type : "POST",
                          cache:false,
                          data :formData,
                          contentType : false, 
                          processData: false,
                          success : function(data){
                           Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            showConfirmButton: false,
                            timer: 1000
                          }).then(function() {
                            location.href = 'home.php?v=mpermit';
                          });
                        }
                      });
                       });
                      });
                    </script>