<!-- MASTER Info Update -->
<section class="section">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fas fa-desktop"></i><b> EHS</b> Apps</a></li>
			<li class="breadcrumb-item"><a href="#"> Master Data</a></li>
			<li class="breadcrumb-item"><a href="#"> Info Update</a></li>
		</ol>
	</nav>
	<div class="row ">

		<!-- ADD Info Update ----------------------------------------------------------------------------------------------------------------->
		<?php if(@$_GET['act'] == 'add'){?>
			<div class="col-md-4 col-lg-4 col-xl-4">
				<div class="card">
					<div class="card-header">
						<h4>Info Update | <i class="fas fa-plus-circle"></i> </h4>
					</div>
					<form id="form-iupdate-add"  method="post" enctype="multipart/form-data">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
										<label>Judul</label>
										<input type="text" class="form-control" id="" required placeholder="Judul" name="name">
									</div>
									<div class="form-group">
										<label>Deskripsi</label>
										<textarea type="text" class="form-control" id="" required placeholder="Deskripsi" name="desc"></textarea>
									</div>
									<div class="form-group">
										<label>Foto (optional)</label>
										<input type="file" class="form-control"  placeholder="Lampiran" name="foto">
									</div>
									<div class="form-group">
										<label>Lampiran (optional)</label>
										<input type="file" class="form-control"  placeholder="Lampiran" name="file">
									</div>
									<div class="form-group">
										<label>&nbsp;</label>
										<button type="submit" id="iupdate-add" name="iupdate-add" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php } ?>

		<!-- UPDATE Info Update -------------------------------------------------------------------------------------------------------------->
		<?php if(@$_GET['act'] == 'update'){?>
			<div class="col-md-4 col-lg-4 col-xl-4">
				<div class="card">
					<div class="card-header">
						<h4>Info Update | <i class="fas fa-edit"></i> </h4>	
					</div>
					<form id="form-iupdate-update">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-lg-12 col-xl-12">
									<?php 
									@$id = $_GET['id'];
									@$iupdate = mysqli_fetch_array($conn->query("SELECT * FROM iupdate  where  iupdate_id = '$id'"));?>
									<div class="form-group">
										<label>Judul</label>
										<input type="text" class="form-control" id="" required placeholder="Judul" name="name" value="<?php echo $iupdate['iupdate_name']?>">
									</div>
									<div class="form-group">
										<label>Deskripsi</label>
										<textarea type="text" class="form-control" id="" required placeholder="Deskripsi" name="desc"><?php echo $iupdate['iupdate_desc']?></textarea>
									</div>
									<div class="form-group">
										<label>Foto (optional)</label>
										<input type="file" class="form-control" name="foto" value="<?php echo $iupdate['iupdate_img']?>">
									</div>
									<div class="form-group">
										<label>Lampiran (optional)</label>
										<input type="file" class="form-control" name="file" value="<?php echo $iupdate['iupdate_file']?>">
									</div>
									<div class="form-group">
										<label>&nbsp;</label>
										<button type="submit" id="iupdate-update" name="iupdate-update" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php } ?>

		<!-- VIEW Info Update ---------------------------------------------------------------------------------------------------------------->
		<div class="col-md-8 col-lg-8 col-xl-8">
			<div class="card">
				<div class="card-header">
					<h4>Info Update | <i class="fas fa-list"></i></h4>				
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="bulletin" style="width:100%;">
							<thead>
								<tr>
									<th style="min-width: 150px;">Deskripsi</th>
									<th style="min-width: 150px;"><center>Foto</center></th>
									<th style="min-width: 150px;"><center>Action</center></th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if(@$_GET['act'] == 'del') {
									$id 	  = $_GET['id'];
									$sql 	  = 'DELETE FROM iupdate WHERE iupdate_id = '.$id.'';
									$delete   = mysqli_query($conn, $sql);
									if ($delete) {
										echo"
										<script>
										Swal.fire({icon: 'success', title: 'Info Update berhasil dihapus', showConfirmButton: false, timer: 1500
										}).then(function() {
											location.href = 'home.php?v=miupdate&act=add';
											});
											</script>";
										} else { 
											echo"
											<script>
											Swal.fire({ icon: 'success', title: 'Info Update gagal dihapus', showConfirmButton: false, timer: 1500
											}).then(function() {
												location.href = 'home.php?v=miupdate&act=add';
												});
												</script>";
											}
										}

										$data = mysqli_query($conn,"SELECT * FROM iupdate");
										while($row  = mysqli_fetch_array($data)){ ?> 
											<tr>
												<td><B><?php echo $row['iupdate_name']; ?></B><BR><small><u><?php echo $row['iupdate_date']; ?></u><br><?php echo $row['iupdate_desc']; ?></small><br><br></td>
												<td>
													<?php if ($row['iupdate_img'] != '') {?><img style="border-radius: 10px 0px 10px 0px;" width="150px" src="../assets/iupdate/<?php echo $row['iupdate_img']; ?>">
												<?php }?>
											</td>
											<td><center>
												<?php if ($row['iupdate_file'] == '') {?>
													<a style="pointer-events: none;cursor: default;" class="btn btn-sm btn-outline-success"><i class="fas fa-download"></i></a>
												<?php } else { ?>
													<a href="../assets/iupdate/file/<?php echo $row['iupdate_file']; ?>" class="btn btn-outline-success"><i class="fas fa-download"></i></a>
												<?php } ?>

												<a href="home.php?v=miupdate&act=update&id=<?php echo $row['iupdate_id']; ?>" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>

												<script>
													$(document).ready(function(){
														$(document).on("click", "#del", function(){
															var id = $(this).attr('data-id');
															var href = '<a style="color:#fff" href="home.php?v=miupdate&act=del&id=';
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
												<a href="#" data-id="<?php echo $row['iupdate_id']; ?>" id="del" class="btn btn-outline-danger">
													<i class="fas fa-trash"></i>
												</a> </center>
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
	</section>

	<!-- ADD Info Update -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#form-iupdate-add").on("submit", function(e){
				e.preventDefault();
				var formData = new FormData(this);
				$.ajax({
					url  : "action/action.php?action=iupdate&act=add",
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
							location.href = 'home.php?v=miupdate&act=add';
						});
					}
				});
			});
		});
	</script>

	<!-- UPDATE Info Update -->
	<script type="text/javascript">
		$(document).ready(function(){
			$("#form-iupdate-update").on("submit", function(e){
				e.preventDefault();
				var formData = new FormData(this);
				$.ajax({
					url  : "action/action.php?action=iupdate&act=update&id=<?php echo $iupdate['iupdate_id'];?>",
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
							location.href = 'home.php?v=miupdate&act=add';
						});
					}
				});
			});
		});
	</script>


