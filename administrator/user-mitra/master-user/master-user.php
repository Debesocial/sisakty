<?php 
@$id = $_GET['id'];
@$userdetail = mysqli_fetch_array($conn->query("SELECT * FROM user 
	LEFT JOIN level ON level.level_id = user.user_level 
	LEFT JOIN departement ON departement.dept_id = user.user_dept 
	LEFT JOIN divisi ON divisi.divisi_id = user.user_divisi 
	LEFT JOIN company ON company.comp_id = user.user_comp 
	WHERE user.user_id = '$id'"));

@$user = mysqli_query($conn,"SELECT * FROM user 
	LEFT JOIN level ON level.level_id = user.user_level
	LEFT JOIN departement ON departement.dept_id = user.user_dept
	LEFT JOIN divisi ON divisi.divisi_id = user.user_divisi
	LEFT JOIN company ON company.comp_id = user.user_comp
	WHERE user.user_pic != 'STY'
	AND user.user_pic != 'RES'
	AND user.user_pic != 'KTT'
	AND user.user_comp  = ".$_SESSION['user_comp']."");

@$pic = mysqli_query($conn,"SELECT * FROM user
	LEFT JOIN level ON level.level_id = user.user_level
	LEFT JOIN departement ON departement.dept_id = user.user_dept
	LEFT JOIN divisi ON divisi.divisi_id = user.user_divisi
	LEFT JOIN company ON company.comp_id = user.user_comp
	WHERE user.user_pic != 'STY' 
	AND user.user_pic = 'Y'
	and user.user_comp  = ".$_SESSION['user_comp']."");

@$area = mysqli_query($conn,"SELECT * FROM area_mpermit 
	INNER JOIN area ON  area.area_id = area_mpermit.area_mpermit_id 
	WHERE area_mpermit_user = '$id'"); 

@$spermit = mysqli_fetch_array($conn->query("SELECT * FROM spermit 
	INNER JOIN user ON spermit.spermit_user = user.user_id
	INNER JOIN company ON user.user_comp = company.comp_id 
	WHERE spermit_user = '$id'"));

@$unit = mysqli_query($conn,"SELECT * FROM unit_spermit 
	INNER JOIN unit ON unit_spermit.unit_spermit_unit = unit.unit_id 
	WHERE unit_spermit_user = '$id'"); 

@$accident = mysqli_query($conn,"SELECT * FROM accident WHERE accident_user = '$id'");

@$offense = mysqli_query($conn,"SELECT * FROM offense where offense_user = '$id'"); 

@$minepermit = mysqli_fetch_array($conn->query("SELECT * FROM mpermit where mpermit_user = '$id' order by mpermit_id desc limit 1"));

@$minepermit_list = mysqli_query($conn,"SELECT * FROM mpermit where mpermit_user = '$id' order by mpermit_id desc");
?>

<!-- MASTER DATA USER -->
<section class="section">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fas fa-desktop"></i><b> SISAKTY</b></a></li>
			<li class="breadcrumb-item"><a href="#">Data User</a></li>
		</ol>
	</nav>
	<div class="row ">

		<!-- ADD DATA USER ----------------------------------------------------------------------------------------------------------------->
		<?php if(@$_GET['act'] == 'add'){?>
			<div class="col-md-12 col-lg-12 col-xl-12">
				<div class="card">
					<div class="card-header">
						<h4>Data User | <i class="fas fa-plus-circle"></i> </h4>
					</div>
					<form id="form-user-add">
						<div class="card-body">
							<div class="row">
								<div class="col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label>NIK</label>
										<input type="number" class="form-control" id="" required placeholder="NIK" name="nik">
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="Password" class="form-control" id="" required placeholder="Password" name="password">
									</div>
									<div class="form-group">
										<label>Nama Lengkap</label>
										<input type="text" class="form-control" id="" required placeholder="Nama Lengkap" name="name">
									</div>
									<div class="form-group">
										<label>Tanggal Lahir</label>
										<input type="date" class="form-control" id=""  placeholder="Tanggal Lahir" name="birth">
									</div>
									<div class="form-group">
										<label>No. Telp</label>
										<input type="number" class="form-control" id="" required placeholder="No. Telp" name="phone">
									</div>
								</div>
								<div class="col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control" id="" required placeholder="Email" name="email">
									</div>
									<div class="form-group">
										<label>Masuk Site</label>
										<input type="date" class="form-control" id="" required placeholder="Masuk Site" name="onsite">
									</div>
									<div class="form-group">
										<label>Status</label>
										<select class="form-control select2" id="" required name="status">
											<option value=""> - Pilih Status -</option>
											<option value="STAFF">STAFF </option>
											<option value="NON STAFF">NON STAFF</option>
										</select>
									</div>
									<div class="form-group">
										<label>Perusahaan</label>
										<select class="form-control select2" id="comp" required name="comp">
											<option value=""> - Pilih Perusahaan -</option>
											<?php $data = mysqli_query($conn,"select * from company order by comp_name asc");
											while($row  = mysqli_fetch_array($data)){ ?> 
												<option value=<?php echo $row['comp_id'];?>> 
													<?php echo $row['comp_name'];
												}?> 
											</option>
										</select>
									</div>
									<div class="form-group">
										<label>Divisi</label>
										<select class="form-control select2" id="divisi" required name="divisi">
											<option value=""> - Pilih Divisi -</option>
											<?php $data = mysqli_query($conn,"select * from divisi order by divisi_name asc");
											while($row  = mysqli_fetch_array($data)){ ?>  
												<option value=<?php echo $row['divisi_comp'].'-'.$row['divisi_id'];?>>
													<?php echo $row['divisi_name'];
												}?> 
											</option>
										</select>
									</div>
								</div>
								<div class="col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label>Departement</label>
										<select class="form-control select2" id="dept" required name="dept">
											<option value=""> - Pilih Departement -</option>
											<?php $data = mysqli_query($conn,"select * from departement order by dept_name asc"); 
											while($row  = mysqli_fetch_array($data)){ ?> 
												<option value=<?php echo $row['dept_comp'].'-'.$row['dept_id'];?>>
													<?php echo $row['dept_name'];
												}?> 
											</option>
										</select>
									</div>
									<div class="form-group">
										<label>Jabatan</label>
										<select class="form-control select2" id="level" required name="level">
											<option value=""> - Pilih Jabatan -</option>
											<?php $data = mysqli_query($conn,"select * from level  order by level_name asc");
											while($row  = mysqli_fetch_array($data)){ ?> 
												<option value=<?php echo $row['level_comp'].'-'.$row['level_id'];?>>
													<?php echo $row['level_name'];
												}?> 
											</option>
										</select>
									</div>
									<div class="form-group">
										<label>Akses Apps</label>
										<select class="form-control select2" id="level" required name="access">
											<option value="Y"> Aktif</option>
											<option value=""> Nonaktif</option>
										</select>
									</div>
									<div class="form-group">
										<label>&nbsp;</label>
										<div class="form-check">
											<input type="checkbox" class="form-check-input" id="exampleCheck1" name="pic" >
											<label class="form-check-label" for="exampleCheck1">Set sebagai PIC</label>
										</div>
									</div>
									<div class="form-group">
										<label>&nbsp;</label>
										<button type="submit" id="user-add" name="user-add" class="btn btn-primary form-control"><i class="fas fa-save"></i> Simpan</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php } ?>

		<!-- UPDATE DATA USER -------------------------------------------------------------------------------------------------------------->
		<?php if(@$_GET['act'] == 'update'){?>
			<div class="col-md-12 col-lg-12 col-xl-12">
				<div class="card">
					<div class="card-header">
						<h4>Data User | <i class="fas fa-edit"></i> </h4>
					</div>
					<form id="form-user-update">
						<div class="card-body">
							<div class="row">
								<div class="col-md-4 col-lg-4 col-xl-4">
									<?php @$id = $_GET['id'];
									@$userupdate = mysqli_fetch_array($conn->query("SELECT * FROM user  where  user_id = '$id'"));?>
									<div class="form-group">
										<label>NIK</label>
										<input type="text" class="form-control" id="" required placeholder="NIK" name="nik" 
										value="<?php echo $userupdate['user_nik']?>">
									</div>
									<div class="form-group">
										<label>Password</label>
										<input type="Password" class="form-control" id="" required placeholder="Password" name="password"
										value="<?php echo base64_decode($userupdate['user_password'])?>">
									</div>
									<div class="form-group">
										<label>Nama Lengkap</label>
										<input type="text" class="form-control" id="" required placeholder="Nama Lengkap" name="name"
										value="<?php echo $userupdate['user_name']?>">
									</div>
									<div class="form-group">
										<label>Tanggal Lahir</label>
										<input type="date" class="form-control" id="" placeholder="Tanggal Lahir" name="birth"
										value="<?php echo $userupdate['user_birth']?>">
									</div>
									<div class="form-group">
										<label>No. Telp</label>
										<input type="number" class="form-control" id="" required placeholder="No. Telp" name="phone"
										value="<?php echo $userupdate['user_phone']?>">
									</div>
								</div>

								<div class="col-md-4 col-lg-4 col-xl-4">
									<div class="form-group">
										<label>Email</label>
										<input type="email" class="form-control" id="" required placeholder="Email" name="email"
										value="<?php echo $userupdate['user_email']?>">
									</div>
									<div class="form-group">
										<label>Masuk Site</label>
										<input type="date" class="form-control" id="" required placeholder="Masuk Site" name="onsite"
										value="<?php echo $userupdate['user_onsite']?>">
									</div>
									<div class="form-group">
										<label>Status</label>
										<select class="form-control select2" id="" required name="status">
											<option value="<?php echo $userupdate['user_status']?>"><?php echo $userupdate['user_status']?></option>
											<option value="STAFF">STAFF</option>
											<option value="NON STAFF">NON STAFF</option>
										</select>
									</div>
									<div class="form-group">
										<label>Perusahaan</label>
										<select class="form-control select2" id="comp" required name="comp">
											<option value="<?php echo $userupdate['user_comp']?>">
												<?php @$dept = mysqli_fetch_array($conn->query("SELECT * FROM company where comp_id = 
												".$userupdate['user_comp']."")); echo $dept['comp_name'];?>
											</option>
											<?php $data = mysqli_query($conn,"select * from company order by comp_name asc");
											while($row  = mysqli_fetch_array($data)){ ?> 
												<option value=<?php echo $row['comp_id'];?>> 
													<?php echo $row['comp_name'];
												}?> 
											</option>
										</select>
									</div>
									<div class="form-group">
										<label>Divisi</label>
										<select class="form-control select2" id="divisi" required name="divisi">
											<option value=<?php echo $userupdate['user_comp'].'-'.$userupdate['user_divisi'];?>>
												<?php @$dept = mysqli_fetch_array($conn->query("SELECT * FROM divisi left join company ON company.comp_id = divisi.divisi_comp where divisi.divisi_id = ".$userupdate['user_divisi']."")); 
												echo $dept['divisi_name'];?>
											</option>
											<?php $data = mysqli_query($conn,"select * from divisi order by divisi_name asc");
											while($row  = mysqli_fetch_array($data)){ ?>  
												<option value=<?php echo $row['divisi_comp'].'-'.$row['divisi_id'];?>>
													<?php echo $row['divisi_name'];
												}?> 
											</option>
										</select>
									</div>
								</div>

								<div class="col-md-4 col-lg-4 col-xl-4">	
									<div class="form-group">
										<label>Departement</label>
										<select class="form-control select2" id="dept" required name="dept">
											<option value=<?php echo $userupdate['user_comp'].'-'.$userupdate['user_dept'];?>>
												<?php @$dept = mysqli_fetch_array($conn->query("SELECT * FROM departement left join company ON company.comp_id = departement.dept_comp where departement.dept_id = ".$userupdate['user_dept']."")); echo $dept['dept_name'];?>
											</option>
											<?php $data = mysqli_query($conn,"select * from departement order by dept_name asc");
											while($row  = mysqli_fetch_array($data)){ ?> 
												<option value=<?php echo $row['dept_comp'].'-'.$row['dept_id'];?>>
													<?php echo $row['dept_name'];
												}?> 
											</option>
										</select>
									</div>
									<div class="form-group">
										<label>Jabatan</label>
										<select class="form-control select2" id="level" required name="level">
											<option value=<?php echo $userupdate['user_comp'].'-'.$userupdate['user_level'];?>>
												<?php @$dept = mysqli_fetch_array($conn->query("SELECT * FROM level left join company ON company.comp_id = level.level_comp where level.level_id = ".$userupdate['user_level']."")); echo $dept['level_name'];?>
											</option>
											<?php $data = mysqli_query($conn,"select * from level order by level_name asc");
											while($row  = mysqli_fetch_array($data)){ ?> 
												<option value=<?php echo $row['level_comp'].'-'.$row['level_id'];?>>
													<?php echo $row['level_name'];
												}?> 
											</option>
										</select>
									</div>
									<div class="form-group">
										<label>Akses Apps</label>
										<select class="form-control select2" id="level" required name="access">
											<?php if ($userupdate['user_access'] == 'Y'){
												echo'<option value="aktif"> Aktif</option>';
											} else {
												echo'<option value="nonaktif"> Nonaktif</option>';
											}?>
											<option value="Y"> Aktif</option>
											<option value=""> Nonaktif</option>
										</select>
									</div>
									<div class="form-group">
										<label>&nbsp;</label>
										<div class="form-check">
											<?php if( $userupdate['user_pic'] == 'Y' ) {?>
												<input type="checkbox" class="form-check-input" id="exampleCheck1" name="pic" Checked>
											<?php } else { ?>
												<input type="checkbox" class="form-check-input" id="exampleCheck1" name="pic" >
											<?php } ?>
											<label class="form-check-label" for="exampleCheck1">Set sebagai PIC</label>
										</div>
									</div>
									<div class="form-group">
										<label>&nbsp;</label>
										<button type="submit" id="user-update" name="user-update" class="btn btn-primary form-control"><i class="fas fa-save"></i> Simpan</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php } ?>

		<!-- DETAIL DATA USER -------------------------------------------------------------------------------------------------------------->
		<?php if(@$_GET['act'] == 'detail'){?>
			<div class="col-12 col-md-12 col-lg-5">
				<div class="card author-box">
					<div class="card-body">
						<div class="author-box-center">

							<?php if($minepermit['mpermit_status_approval'] == 'Closed'){?>
								<img alt="image" src="<?= '../../assets/minepermit/FOTO/'.$minepermit['mpermit_photo']; ?>" width="120" height="150">
							<?php }else{?>
								<img alt="image" src="../../assets/super/img/users/user-1.png" class="rounded-circle author-box-picture">
							<?php } ?>
							<br><br>

							<div class="clearfix"></div>
							<div class="author-box-name">
								<a href="#"><?= $userdetail['user_name']; ?></a>
							</div>
							<div class="author-box-job"><?= $userdetail['user_status'];?><br>
								<?php  
								if($userdetail['user_access'] !='Y'){
									echo' <span class="badge badge-pill badge-secondary">Nonaktif</span>';
								} else {
									echo' <span class="badge badge-pill badge-success">&emsp;Aktif&emsp;</span>';
								}?>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="form-group col-md-4 col-12">
								<label>NIK</label>
							</div>
							<div class="form-group col-md-8 col-12">
								<span class="float-left text-muted">
									<?= $userdetail['user_nik']; ?>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4 col-12">
								<label>Nama Lengkap</label>
							</div>
							<div class="form-group col-md-8 col-12">
								<span class="float-left text-muted">
									<?= $userdetail['user_name']; ?>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4 col-12">
								<label>Tanggal Lahir</label>
							</div>
							<div class="form-group col-md-8 col-12">
								<span class="float-left text-muted">
									<?= $userdetail['user_birth']; ?>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4 col-12">
								<label>No. Handphone</label>
							</div>
							<div class="form-group col-md-8 col-12">
								<span class="float-left text-muted">
									<?= $userdetail['user_phone']; ?>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4 col-12">
								<label>Email</label>
							</div>
							<div class="form-group col-md-8 col-12">
								<span class="float-left text-muted">
									<?= $userdetail['user_email']; ?>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4 col-12">
								<label>Masuk Site</label>
							</div>
							<div class="form-group col-md-8 col-12">
								<span class="float-left text-muted">
									<?= $userdetail['user_onsite']; ?>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4 col-12">
								<label>Jabatan</label>
							</div>
							<div class="form-group col-md-8 col-12">
								<span class="float-left text-muted">
									<?= $userdetail['level_name']; ?>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4 col-12">
								<label>Departement</label>
							</div>
							<div class="form-group col-md-8 col-12">
								<span class="float-left text-muted">
									<?= $userdetail['dept_name']; ?>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4 col-12">
								<label>Divisi</label>
							</div>
							<div class="form-group col-md-8 col-12">
								<span class="float-left text-muted">
									<?= $userdetail['divisi_name']; ?>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-4 col-12">
								<label>Perusahaan</label>
							</div>
							<div class="form-group col-md-8 col-12">
								<span class="float-left text-muted">
									<?= $userdetail['comp_name']; ?>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-12 col-lg-7">
				<div class="card">
					<div class="padding-20">
						<ul class="nav nav-tabs" id="myTab2" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="profile-tab2" data-toggle="tab" href="#mpermit" role="tab"
								aria-selected="true"><b>Mine Permit</b></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" id="profile-tab2" data-toggle="tab" href="#spermit" role="tab"
								aria-selected="false"><b>SIM Permit</b></a>
							</li>
						</ul>

						<div class="tab-content tab-bordered" id="myTab3Content">
							<!-- MINE PERMIT------------------------------------------------------------------------------------------------------>
							<div class="tab-pane fade show active" id="mpermit" role="tabpanel" aria-labelledby="profile-tab2">
								<form method="post" class="needs-validation">
									<div class="card-body">
										<?php if (!empty($minepermit)){?>
											<?php if ($minepermit['mpermit_status_active'] == 'Verified'){?>
												
												<H6>Detail Pengajuan</H6><hr>
												<div class="row">
													<div class="form-group col-5">
														<label>Kategori</label>
													</div>
													<div class="form-group col-7">
														<span class="float-left text-muted">
															<span class="badge badge-pill badge-basic"><?= 'Mine Permit '.$minepermit['mpermit_categories']?></span>
														</span>
													</div>
													<div class="form-group col-5">
														<label>Tanggal Pengajuan</label>
													</div>
													<div class="form-group col-7">
														<span class="float-left text-muted">
															<span class="badge badge-pill badge-basic"><?=$minepermit['mpermit_date'];?></span>
														</span>
													</div>
													<div class="form-group col-5">
														<label>Tanggal Diterbitkan</label>
													</div>
													<div class="form-group col-7">
														<span class="float-left text-muted">
															<span class="badge badge-pill badge-basic"><?=date("Y-m-d", strtotime($minepermit['mpermit_approval_ktt_date']));?></span>
														</span>
													</div>
													<?php if ($minepermit['mpermit_enddate'] != '0000-00-00'){?>
														<div class="form-group col-5">
															<label>Berlaku Sampai Tanggal</label>
														</div>
														<div class="form-group col-7">
															<span class="float-left text-muted">
																<span class="badge badge-pill badge-basic"><?= $minepermit['mpermit_enddate']?></span>
															</span>
														</div>
													<?php } ?>
													<div class="form-group col-5">
														<label>Status Approval</label>
													</div>
													<div class="form-group col-7">
														<span class="float-left text-muted">
															<span class="badge badge-pill badge-basic"><i class="fa fa-check-circle"></i> Approved</span>
														</span>
													</div>
													<div class="form-group col-5">
														<label>Status Pengajuan</label>
													</div>
													<div class="form-group col-7">
														<span class="float-left text-muted">
															<span class="badge badge-pill badge-basic"><?=$minepermit['mpermit_status'];?></span>
														</span>
													</div>

													<?php if($minepermit['mpermit_status'] != 'Baru'){;?>
														<div class="form-group col-5">
															<label>Alasan Penggantian / Perubahan</label>
														</div>
														<div class="form-group col-7">
															<span class="float-left text-muted">
																<span class="badge badge-pill badge-basic"><?=$minepermit['mpermit_status_desc'];?></span>
															</span>
														</div>
													<?php } ?>

													<!-- <hr>
													<div class="form-group col-5">
														<a href="master-user/print.php?mP=<?=base64_encode($minepermit['mpermit_id']);?>"  target="_blank" class="btn btn-sm btn-outline-primary">
															<i class="fa fa-print"></i> Print Mine Permit
														</a>
													</div> -->
												</div><br>
												
											<?php } else { ?>
												<H6>Detail Pengajuan</H6><hr>
												<div class="row">
													<div class="form-group col-5">
														<label>Kategori</label>
													</div>
													<div class="form-group col-7">
														<span class="float-left text-muted">
															<span class="badge badge-pill badge-basic"><?= 'Mine Permit '.$minepermit['mpermit_categories']?></span>
														</span>
													</div>
													<div class="form-group col-5">
														<label>Tanggal Pengajuan</label>
													</div>
													<div class="form-group col-7">
														<span class="float-left text-muted">
															<span class="badge badge-pill badge-basic"><?=$minepermit['mpermit_date'];?></span>
														</span>
													</div>
													<?php if ($minepermit['mpermit_enddate'] != '0000-00-00'){?>
														<div class="form-group col-5">
															<label>Berlaku Sampai Tanggal</label>
														</div>
														<div class="form-group col-7">
															<span class="float-left text-muted">
																<span class="badge badge-pill badge-basic"><?= $minepermit['mpermit_enddate']?></span>
															</span>
														</div>
													<?php } ?>
													<div class="form-group col-5">
														<label>Status Pengajuan</label>
													</div>
													<div class="form-group col-7">
														<span class="float-left text-muted">
															<span class="badge badge-pill badge-basic"><?=$minepermit['mpermit_status'];?></span>
														</span>
													</div>

													<?php if($minepermit['mpermit_status'] != 'Baru'){;?>
														<div class="form-group col-5">
															<label>Alasan Penggantian / Perubahan</label>
														</div>
														<div class="form-group col-7">
															<span class="float-left text-muted">
																<span class="badge badge-pill badge-basic"><?=$minepermit['mpermit_status_desc'];?></span>
															</span>
														</div>
													<?php } ?>
												</div><br>
												<H6>Dokumen Pendukung</H6><hr>
												<div class="row">
													<?php if ($minepermit['mpermit_skd'] != NULL){?>
														<div class="form-group col-5">
															<label>Hasil Pemeriksaan Kesehatan</label>
														</div>
														<div class="form-group col-7">
															<span class="float-left text-muted">
																<a target="_blank" href="<?= '../../assets/minepermit/SKD/'.$minepermit['mpermit_skd']?>" download>
																	<span class="badge badge-pill badge-basic">Download</span>
																</a>
															</span>
														</div>
													<?php } ?>

													<?php if ($minepermit['mpermit_idcard'] != NULL){?>
														<div class="form-group col-5">
															<label>Kartu Identitas</label>
														</div>
														<div class="form-group col-7">
															<span class="float-left text-muted">
																<a target="_blank" href="<?= '../../assets/minepermit/KTP/'.$minepermit['mpermit_idcard']?>" download>
																	<span class="badge badge-pill badge-basic">Download</span>
																</a>
															</span>
														</div>
													<?php } ?>

													<?php if ($minepermit['mpermit_photo'] != NULL){?>
														<div class="form-group col-5">
															<label>Foto</label>
														</div>
														<div class="form-group col-7">
															<span class="float-left text-muted">
																<a target="_blank" href="<?= '../../assets/minepermit/FOTO/'.$minepermit['mpermit_photo']?>" download>
																	<span class="badge badge-pill badge-basic">Download</span>
																</a>
															</span>
														</div>
													<?php } ?>

													<?php if ($minepermit['mpermit_suratijin'] != NULL){?>
														<div class="form-group col-5">
															<label>Surat Izin Masuk Site</label>
														</div>
														<div class="form-group col-7">
															<span class="float-left text-muted">
																<a target="_blank" href="<?= '../../assets/minepermit/SURATIJIN/'.$minepermit['mpermit_suratijin']?>" download>
																	<span class="badge badge-pill badge-basic">Download</span>
																</a>
															</span>
														</div>
													<?php } ?>

													<?php if ($minepermit['mpermit_beritaacara'] != NULL){?>
														<div class="form-group col-5">
															<label>Berita Acara Kehilangan</label>
														</div>
														<div class="form-group col-7">
															<span class="float-left text-muted">
																<a target="_blank" href="<?= '../../assets/minepermit/BERITAACARA/'.$minepermit['mpermit_beritaacara']?>" download>
																	<span class="badge badge-pill badge-basic">Download</span>
																</a>
															</span>
														</div>
													<?php } ?>
												</div>

												<br><H6>Timeline Pengajuan Mine Permit</H6><hr>
												<div class="form-group col-12">
													<small>
														<div id="tracking">
															<div class="tracking-list">
																<?php 
																$sql = mysqli_query($conn,"SELECT * FROM mpermit_status WHERE mpermit_status_mpermit = ".$minepermit['mpermit_id']." order by mpermit_status_id asc"); 
																while(@$row = mysqli_fetch_array($sql)) {?>
																	<div class="tracking-item">
																		<div class="tracking-icon status-intransit">
																			<?php if($row['mpermit_status_name'] == 'Open') {
																				echo '<i class="fas fa-circle" style="color:#ffc107;"></i>';
																			} elseif($row['mpermit_status_name'] == 'Progress') {
																				echo '<i class="fas fa-circle" style="color:#007bff;"></i>';
																			} elseif($row['mpermit_status_name'] == 'Closed') {
																				echo '<i class="fas fa-circle" style="color:#28a745;"></i>';
																			} elseif($row['mpermit_status_name'] == 'Reject') {
																				echo '<i class="fas fa-circle" style="color:#dc3545;"></i>';
																			} elseif($row['mpermit_status_name'] == 'Cancel') {
																				echo '<i class="fas fa-circle" style="color:#dc3545;"></i>';
																			}?>
																		</div>
																		<div class="tracking-date"><?= $row['mpermit_status_date']?></div>
																		<div class="tracking-content"><?= $row['mpermit_status_name']?>
																		<span>
																			<?php if($row['mpermit_status_name'] == 'Reject'){
																				echo 'Telah direject oleh '.$row['mpermit_status_by'].'<BR>';
																			}?><?= $row['mpermit_status_desc']?>
																		</span>
																	</div>
																</div>
															<?php } ?>
														</div>
													</div>
												</small>
											</div><br>
										<?php } ?>

										<H6>Mine Permit Area</H6><hr>
										<div class="table-responsive">
											<table class="table table-striped" width="100%">
												<thead>
													<tr>
														<th scope="col">#</th>
														<th scope="col" width="49%">Area</th>
														<th scope="col">Keterangan</th>
													</tr>
												</thead>
												<tbody>
													<tr><td>1</td>
														<td>Kantor</td>
														<td>
															<?php if($minepermit['mpermit_office'] == 'full'){
																echo'<i style="color:green;" class="fa fa-circle"></i> Full';
															} elseif($minepermit['mpermit_office'] == 'rest'){
																echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
															} elseif($minepermit['mpermit_office'] == 'forbiden'){
																echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
															}?>
														</td>
													</tr>
													<tr><td>2</td>
														<td>Tambang</td>
														<td>
															<?php if($minepermit['mpermit_mine'] == 'full'){
																echo'<i style="color:green;" class="fa fa-circle"></i> Full';
															} elseif($minepermit['mpermit_mine'] == 'rest'){
																echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
															} elseif($minepermit['mpermit_mine'] == 'forbiden'){
																echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
															}?>
														</td>
													</tr>
													<tr><td>3</td>
														<td>Mess</td>
														<td>
															<?php if($minepermit['mpermit_camp'] == 'full'){
																echo'<i style="color:green;" class="fa fa-circle"></i> Full';
															} elseif($minepermit['mpermit_camp'] == 'rest'){
																echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
															} elseif($minepermit['mpermit_camp'] == 'forbiden'){
																echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
															}?>
														</td>
													</tr>
													<tr><td>4</td>
														<td>Bengkel</td>
														<td>
															<?php if($minepermit['mpermit_workshop'] == 'full'){
																echo'<i style="color:green;" class="fa fa-circle"></i> Full';
															} elseif($minepermit['mpermit_workshop'] == 'rest'){
																echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
															} elseif($minepermit['mpermit_workshop'] == 'forbiden'){
																echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
															}?>
														</td>
													</tr>
													<tr><td>5</td>
														<td>CPP, Washing Plant</td>
														<td>
															<?php if($minepermit['mpermit_cpp'] == 'full'){
																echo'<i style="color:green;" class="fa fa-circle"></i> Full';
															} elseif($minepermit['mpermit_cpp'] == 'rest'){
																echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
															} elseif($minepermit['mpermit_cpp'] == 'forbiden'){
																echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
															}?>
														</td>
													</tr>
													<tr><td>6</td>
														<td>Laboratorium CPP</td>
														<td>
															<?php if($minepermit['mpermit_lab'] == 'full'){
																echo'<i style="color:green;" class="fa fa-circle"></i> Full';
															} elseif($minepermit['mpermit_lab'] == 'rest'){
																echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
															} elseif($minepermit['mpermit_lab'] == 'forbiden'){
																echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
															}?>
														</td>
													</tr>
													<tr><td>7</td>
														<td>Eksplorasi</td>
														<td>
															<?php if($minepermit['mpermit_exploration'] == 'full'){
																echo'<i style="color:green;" class="fa fa-circle"></i> Full';
															} elseif($minepermit['mpermit_exploration'] == 'rest'){
																echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
															} elseif($minepermit['mpermit_exploration'] == 'forbiden'){
																echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
															}?>
														</td>
													</tr>
													<tr><td>8</td>
														<td>Pelabuhan</td>
														<td>
															<?php if($minepermit['mpermit_jetty'] == 'full'){
																echo'<i style="color:green;" class="fa fa-circle"></i> Full';
															} elseif($minepermit['mpermit_jetty'] == 'rest'){
																echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
															} elseif($minepermit['mpermit_jetty'] == 'forbiden'){
																echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
															}?>
														</td>
													</tr>
												</tbody>
											</table>
										</div>

										<br><H6>Histori Pengajuan Mine Permit</H6><hr>
										<div class="table-responsive">
											<table class="table table-striped table-hover" id="" style="width:100%;">
												<thead>
													<tr>
														<th width="25%">Status Timeline</th>
														<th>Tanggal Pengajuan</th>
														<th>Status Pengajuan</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													$data = mysqli_query($conn,"SELECT * FROM mpermit LEFT JOIN user on user.user_id = mpermit.mpermit_user LEFT JOIN company on company.comp_id = user.user_comp WHERE mpermit.mpermit_user = ".$id." ORDER BY mpermit.mpermit_id DESC");
													while($row  = mysqli_fetch_array($data)){ ?> 
														<tr>
															<td>
																<?php if ($row['mpermit_status_approval'] == 'Open') {
																	echo'<span class="badge badge-pill badge-warning">&nbsp;&nbsp;&nbsp;Open&nbsp;&nbsp;</span>';
																} elseif ($row['mpermit_status_approval'] == 'Progress') {
																	echo'<span class="badge badge-pill badge-primary">Progress</span>';
																} elseif ($row['mpermit_status_approval'] == 'Closed') {
																	echo'<span class="badge badge-pill badge-success">&nbsp;&nbsp;Closed&nbsp;&nbsp;</span>';
																} elseif ($row['mpermit_status_approval'] == 'Reject') {
																	echo'<span class="badge badge-pill badge-danger">&nbsp;&nbsp;Reject&nbsp;&nbsp;</span>';
																} elseif ($row['mpermit_status_approval'] == 'Cancel') {
																	echo'<span class="badge badge-pill badge-danger">&nbsp;&nbsp;Cancel&nbsp;&nbsp;</span>';
																}?>
															</td>
															<td><?= $row['mpermit_date']?></td>
															<td><?= $row['mpermit_status']?></td>
															<td><a href="home.php?v=muser&act=detailmpermit&id=<?= $row['mpermit_id'] ?>" target='_blank' class="btn btn-outline-primary"><i class="fa fa-eye"></i></a>
															</td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									<?php } else { ?>
										<i>Belum Tersedia</i><hr>
									<?php } ?>
								</div>
							</form>
						</div>


						<!-- SIM PERMIT------------------------------------------------------------------------------------------------------->
						<div class="tab-pane fade" id="spermit" role="tabpanel" aria-labelledby="profile-tab2">
							<form method="post" class="needs-validation">
								<div class="card-body">
									<i>Belum Tersedia</i><hr>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	<?php } elseif($_GET['act'] == 'detailmpermit') {
		@$minepermit_detail = mysqli_fetch_array($conn->query("SELECT * FROM mpermit 
		where mpermit_id = ".$_GET['id'].""));?>
		<!-- DETAILMPERMIT MINE PERMIT-------------------------------------------------------------------------------------------->
		<div class="col-12 col-md-12 col-lg-8">
			<div class="card">
				<div class="padding-20">
					<div class="tab-pane fade show active" id="mpermit" role="tabpanel" aria-labelledby="profile-tab2">
						<form method="post" class="needs-validation">
							<div class="card-body">
								<H6>Detail Pengajuan</H6><hr>
								<div class="row">
									<div class="form-group col-5">
										<label>Kategori</label>
									</div>
									<div class="form-group col-7">
										<span class="float-left text-muted">
											<span class="badge badge-pill badge-basic"><?= 'Mine Permit '.$minepermit_detail['mpermit_categories']?></span>
										</span>
									</div>
									<div class="form-group col-5">
										<label>Tanggal Pengajuan</label>
									</div>
									<div class="form-group col-7">
										<span class="float-left text-muted">
											<span class="badge badge-pill badge-basic"><?= $minepermit_detail['mpermit_date']?></span>
										</span>
									</div>
									<?php if ($minepermit_detail['mpermit_enddate'] != '0000-00-00'){?>
										<div class="form-group col-5">
											<label>Berlaku Sampai Tanggal</label>
										</div>
										<div class="form-group col-7">
											<span class="float-left text-muted">
												<span class="badge badge-pill badge-basic"><?= $minepermit_detail['mpermit_enddate']?></span>
											</span>
										</div>
									<?php } ?>
									<div class="form-group col-5">
										<label>Status Pengajuan</label>
									</div>
									<div class="form-group col-7">
										<span class="float-left text-muted">
											<span class="badge badge-pill badge-basic"><?=$minepermit_detail['mpermit_status'];?></span>
										</span>
									</div>

									<?php if($minepermit_detail['mpermit_status'] != 'Baru'){;?>
										<div class="form-group col-5">
											<label>Alasan Penggantian / Perubahan</label>
										</div>
										<div class="form-group col-7">
											<span class="float-left text-muted">
												<span class="badge badge-pill badge-basic"><?=$minepermit_detail['mpermit_status_desc'];?></span>
											</span>
										</div>
									<?php } ?>
								</div><br>

								<H6>Dokumen Pendukung</H6><hr>
								<div class="row">
									<?php if ($minepermit_detail['mpermit_skd'] != NULL){?>
										<div class="form-group col-5">
											<label>Hasil Pemeriksaan Kesehatan</label>
										</div>
										<div class="form-group col-7">
											<span class="float-left text-muted">
												<a target="_blank" href="<?= '../../assets/minepermit/SKD/'.$minepermit_detail['mpermit_skd']?>" download>
													<span class="badge badge-pill badge-basic">Download</span>
												</a>
											</span>
										</div>
									<?php } ?>

									<?php if ($minepermit_detail['mpermit_idcard'] != NULL){?>
										<div class="form-group col-5">
											<label>Kartu Identitas</label>
										</div>
										<div class="form-group col-7">
											<span class="float-left text-muted">
												<a target="_blank" href="<?= '../../assets/minepermit/KTP/'.$minepermit_detail['mpermit_idcard']?>" download>
													<span class="badge badge-pill badge-basic">Download</span>
												</a>
											</span>
										</div>
									<?php } ?>

									<?php if ($minepermit_detail['mpermit_idcard'] != NULL){?>
										<div class="form-group col-5">
											<label>Foto</label>
										</div>
										<div class="form-group col-7">
											<span class="float-left text-muted">
												<a target="_blank" href="<?= '../../assets/minepermit/FOTO/'.$minepermit_detail['mpermit_photo']?>" download>
													<span class="badge badge-pill badge-basic">Download</span>
												</a>
											</span>
										</div>
									<?php } ?>

									<?php if ($minepermit_detail['mpermit_suratijin'] != NULL){?>
										<div class="form-group col-5">
											<label>Surat Izin Masuk Site</label>
										</div>
										<div class="form-group col-7">
											<span class="float-left text-muted">
												<a target="_blank" href="<?= '../../assets/minepermit/SURATIJIN/'.$minepermit_detail['mpermit_suratijin']?>" download>
													<span class="badge badge-pill badge-basic">Download</span>
												</a>
											</span>
										</div>
									<?php } ?>

									<?php if ($minepermit_detail['mpermit_beritaacara'] != NULL){?>
										<div class="form-group col-5">
											<label>Berita Acara Kehilangan</label>
										</div>
										<div class="form-group col-7">
											<span class="float-left text-muted">
												<a target="_blank" href="<?= '../../assets/minepermit/BERITAACARA/'.$minepermit_detail['mpermit_beritaacara']?>" download>
													<span class="badge badge-pill badge-basic">Download</span>
												</a>
											</span>
										</div>
									<?php } ?>
								</div>

								<br><H6>Timeline Pengajuan Mine Permit</H6><hr>
								<div class="form-group col-12">
									<small>
										<div id="tracking">
											<div class="tracking-list">
												<?php 
												$sql = mysqli_query($conn,"SELECT * FROM mpermit_status WHERE mpermit_status_mpermit = ".$_GET['id']." order by mpermit_status_id asc"); 
												while(@$row = mysqli_fetch_array($sql)) {?>
													<div class="tracking-item">
														<div class="tracking-icon status-intransit">
															<?php if($row['mpermit_status_name'] == 'Open') {
																echo '<i class="fas fa-circle" style="color:#ffc107;"></i>';
															} elseif($row['mpermit_status_name'] == 'Progress') {
																echo '<i class="fas fa-circle" style="color:#007bff;"></i>';
															} elseif($row['mpermit_status_name'] == 'Closed') {
																echo '<i class="fas fa-circle" style="color:#28a745;"></i>';
															} elseif($row['mpermit_status_name'] == 'Reject') {
																echo '<i class="fas fa-circle" style="color:#dc3545;"></i>';
															} elseif($row['mpermit_status_name'] == 'Cancel') {
																echo '<i class="fas fa-circle" style="color:#dc3545;"></i>';
															}?>
														</div>
														<div class="tracking-date"><?= $row['mpermit_status_date']?></div>
														<div class="tracking-content"><?= $row['mpermit_status_name']?>
														<span>
															<?php if($row['mpermit_status_name'] == 'Reject'){
																echo 'Telah direject oleh '.$row['mpermit_status_by'].'<BR>';
															}?><?= $row['mpermit_status_desc']?>
														</span>
													</div>
												</div>

											<?php }
											@$cektimeline = mysqli_fetch_array($conn->query("SELECT * FROM mpermit_status WHERE mpermit_status_mpermit = ".$_GET['id']." AND mpermit_status_name = 'Closed'"));
											if($cektimeline == null && $minepermit_detail['mpermit_status_approval'] == 'Closed'){
												echo'
												<div class="tracking-item">
												<div class="tracking-icon status-intransit">
												<i class="fas fa-circle" style="color:#28a745;"></i>
												</div>
												<div class="tracking-date">'.$minepermit_detail['mpermit_approval_ktt_date'].'</div>
												<div class="tracking-content">Closed <span>Pengajuan Mine Permit Disetujui KTT</span></div>
												</div>';
											}?>
										</div>
									</div>
								</small>
							</div>

							<br><H6>Mine Permit Area</H6><hr>
							<div class="table-responsive">
								<table class="table table-striped" width="100%">
									<thead>
										<tr>
											<th scope="col">#</th>
											<th scope="col" width="40%">Area</th>
											<th scope="col">Keterangan</th>
										</tr>
									</thead>
									<tbody>
										<tr><td>1</td>
											<td>Kantor</td>
											<td>
												<?php if($minepermit_detail['mpermit_office'] == 'full'){
													echo'<i style="color:green;" class="fa fa-circle"></i> Full';
												} elseif($minepermit_detail['mpermit_office'] == 'rest'){
													echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
												} elseif($minepermit_detail['mpermit_office'] == 'forbiden'){
													echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
												}?>
											</td>
										</tr>
										<tr><td>2</td>
											<td>Tambang</td>
											<td>
												<?php if($minepermit_detail['mpermit_mine'] == 'full'){
													echo'<i style="color:green;" class="fa fa-circle"></i> Full';
												} elseif($minepermit_detail['mpermit_mine'] == 'rest'){
													echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
												} elseif($minepermit_detail['mpermit_mine'] == 'forbiden'){
													echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
												}?>
											</td>
										</tr>
										<tr><td>3</td>
											<td>Mess</td>
											<td>
												<?php if($minepermit_detail['mpermit_camp'] == 'full'){
													echo'<i style="color:green;" class="fa fa-circle"></i> Full';
												} elseif($minepermit_detail['mpermit_camp'] == 'rest'){
													echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
												} elseif($minepermit_detail['mpermit_camp'] == 'forbiden'){
													echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
												}?>
											</td>
										</tr>
										<tr><td>4</td>
											<td>Bengkel</td>
											<td>
												<?php if($minepermit_detail['mpermit_workshop'] == 'full'){
													echo'<i style="color:green;" class="fa fa-circle"></i> Full';
												} elseif($minepermit_detail['mpermit_workshop'] == 'rest'){
													echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
												} elseif($minepermit_detail['mpermit_workshop'] == 'forbiden'){
													echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
												}?>
											</td>
										</tr>
										<tr><td>5</td>
											<td>CPP, Washing Plant</td>
											<td>
												<?php if($minepermit_detail['mpermit_cpp'] == 'full'){
													echo'<i style="color:green;" class="fa fa-circle"></i> Full';
												} elseif($minepermit_detail['mpermit_cpp'] == 'rest'){
													echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
												} elseif($minepermit_detail['mpermit_cpp'] == 'forbiden'){
													echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
												}?>
											</td>
										</tr>
										<tr><td>6</td>
											<td>Laboratorium CPP</td>
											<td>
												<?php if($minepermit_detail['mpermit_lab'] == 'full'){
													echo'<i style="color:green;" class="fa fa-circle"></i> Full';
												} elseif($minepermit_detail['mpermit_lab'] == 'rest'){
													echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
												} elseif($minepermit_detail['mpermit_lab'] == 'forbiden'){
													echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
												}?>
											</td>
										</tr>
										<tr><td>7</td>
											<td>Eksplorasi</td>
											<td>
												<?php if($minepermit_detail['mpermit_exploration'] == 'full'){
													echo'<i style="color:green;" class="fa fa-circle"></i> Full';
												} elseif($minepermit_detail['mpermit_exploration'] == 'rest'){
													echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
												} elseif($minepermit_detail['mpermit_exploration'] == 'forbiden'){
													echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
												}?>
											</td>
										</tr>
										<tr><td>8</td>
											<td>Pelabuhan</td>
											<td>
												<?php if($minepermit_detail['mpermit_jetty'] == 'full'){
													echo'<i style="color:green;" class="fa fa-circle"></i> Full';
												} elseif($minepermit_detail['mpermit_jetty'] == 'rest'){
													echo'<i style="color:Yellow;" class="fa fa-circle"></i> Rest';
												} elseif($minepermit_detail['mpermit_jetty'] == 'forbiden'){
													echo'<i style="color:Red;" class="fa fa-circle"></i> Forbiden';
												}?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
<?php } else {?>

	<!-- VIEW DATA USER ---------------------------------------------------------------------------------------------------------------->
	<div class="col-md-12 col-lg-12 col-xl-12">
		<div class="card">
			<div class="card-header">
				<h4>Data User | <i class="fas fa-list"></i> </h4>
				<div class="card-header-form">
					<h4>
								<!-- <a href="home.php?v=muser&act=add" class="btn btn-primary "><i class="fas fa-plus-circle"></i> 
									Tambah Data User
								</a> -->
							</h4>			
						</div>				
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-hover" id="tableExportUser" style="width:100%;">
								<thead>
									<tr>
										<th>Akses Apps</th>
										<th>NIK</th>
										<th>Nama</th>
										<th>Jabatan</th>
										<th>Departement</th>
										<!-- <th>Divisi</th> -->
										<th>Perusahaan</th>
										<th>PIC</th>
										<th>Mine Permit</th>
										<!-- <th>PIC</th>
										<th>Mine Permit</th>
										<th>Action</th> -->
									</tr>
								</thead>
								<tbody>
									<?php 
									if(@$_GET['act'] == 'del') {
										$id 	  = $_GET['id'];
										$sql 	  = 'DELETE FROM user WHERE user_id = '.$id.'';
										$delete   = mysqli_query($conn, $sql);
										if ($delete) {
											echo"<script>Swal.fire({icon: 'success', title: 'Data user berhasil dihapus', showConfirmButton: false, timer: 1500
											}).then(function() {
												location.href = 'home.php?v=muser';
											});;</script>";
										} else { 
											echo"<script>Swal.fire({ icon: 'success', title: 'Data user gagal dihapus', showConfirmButton: false, timer: 1500
											}).then(function() {
												location.href = 'home.php?v=muser';
											});;</script>";
										}
									}
									while($row  = mysqli_fetch_array($user)){
										@$minepermit = mysqli_fetch_array($conn->query("SELECT * FROM mpermit 
										where mpermit_user = ".$row['user_id']." order by mpermit_id desc limit 1"));?> 
										<tr>
											<td>
												<?php if($row['user_access'] !='Y'){
													echo'<span class="badge badge-pill badge-secondary">&nbsp;Nonaktif</span>';
												} else {
													echo'<span class="badge badge-pill badge-success">&emsp;Aktif&emsp;</span>';
												} ?>
											</td>
											<td><?= $row['user_nik']; ?></td>
											<td><a style="text-decoration: none;" href="home.php?v=muser&act=detail&id=<?= $row['user_id']; ?>" class=""><?= $row['user_name']; ?></a></td>
											<td><?= $row['level_name']; ?></td>
											<td><?= $row['dept_name']; ?></td>
											<!-- <td><?= $row['divisi_name']; ?></td> -->
											<td><?= $row['comp_name']; ?></td>
											<td>
												<?php if($row['user_pic'] == 'Y' || $row['user_pic'] == 'Z')
												echo '<i style="color: #28a745;" class="fas fa-check"></i>';
												?>
											</td>
											<td>
												<?php if($minepermit['mpermit_status_approval'] == 'Closed'){
													echo '<i style="color: #28a745;" class="fas fa-check"></i>';
												}?>
											</td>
											<!-- <td>
												<a href="home.php?v=muser&act=update&id=<?php echo $row['user_id']; ?>" class="btn btn-sm btn-outline-success"><i class="fas fa-edit"></i></a>
											</td> -->
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-12 col-lg-12 col-xl-12">
				<div class="card">
					<div class="card-header">
						<h4>Data PIC | <i class="fas fa-list"></i> </h4>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-hover" id="save-stage-accident" style="width:100%;">
								<thead>
									<tr>
										<th>Akses Apps</th>
										<th>NIK</th>
										<th>Nama</th>
										<th>Divisi</th>
										<th>Perusahaan</th>
										<th>No. Telp</th>
										<th>Email</th>
									</tr>
								</thead>
								<tbody>
									<?php while($row  = mysqli_fetch_array($pic)){ ?> 
										<tr>
											<td>
												<?php if($row['user_access'] !='Y'){
													echo'<span class="badge badge-pill badge-secondary">&nbsp;Nonaktif</span>';
												} else {
													echo'<span class="badge badge-pill badge-success">&emsp;Aktif&emsp;</span>';
												} ?>
											</td>
											<td><?= $row['user_nik']; ?></td>
											<td><a href="home.php?v=muser&act=detail&id=<?= $row['user_id']; ?>" class=""><?= $row['user_name']; ?></a></td>
											<td><?= $row['divisi_name']; ?></td>
											<td><?= $row['comp_name']; ?></td>
											<td><?= $row['user_phone']; ?></td>
											<td><?= $row['user_email']; ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
</section>

<!-- ADD USER -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-user-add").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=user&act=add",
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
						location.href = 'home.php?v=muser';
					});
				}
			});
		});
	});
</script>

<!-- UPDATE USER -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-user-update").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=user&act=update&id=<?php echo $userupdate['user_id'];?>",
				type : "POST",
				cache:false,
				data :formData,
				contentType : false, 
				processData: false,
				success : function(data){
					Swal.fire({
						icon: 'success',
						title: 'Berhasil Diubah!',
						showConfirmButton: false,
						timer: 1000
					}).then(function() {
						location.href = 'home.php?v=muser';
					});
				}
			});
		});
	});
</script>


<script type="text/javascript">
	$(function() {
		var interval = $('#divisi option').clone();
		$('#comp').on('change', function() {
			var val = this.value;
			$("#divisi option").show(); 

			if(val!="")
				$('#divisi').html( 
					interval.filter(function() { 
						return this.value.indexOf( val + '-' ) === 0; 
					})
					);
		})
		.change();
	});
</script>

<script type="text/javascript">
	$(function() {
		var interval = $('#dept option').clone();
		$('#comp').on('change', function() {
			var val = this.value;
			$("#dept option").show(); 

			if(val!="")
				$('#dept').html( 
					interval.filter(function() { 
						return this.value.indexOf( val + '-' ) === 0; 
					})
					);
		})
		.change();
	});
</script>

<script type="text/javascript">
	$(function() {
		var interval = $('#level option').clone();
		$('#comp').on('change', function() {
			var val = this.value;
			$("#level option").show(); 

			if(val!="")
				$('#level').html( 
					interval.filter(function() { 
						return this.value.indexOf( val + '-' ) === 0; 
					})
					);
		})
		.change();
	});
</script>

<script>
	$(document).ready(function(){
		$(document).on("click", "#del", function(){
			var id = $(this).attr('data-id');
			var href = '<a style="color:#fff;text-decoration: none;" href="home.php?v=muser&act=del&id=';
			var href2 = '">Yes</a>';
			Swal.fire({
				title: 'Are you sure?',
				text: "You won't be able to revert this!",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: href + id + href2
			})
		});
	});
</script>