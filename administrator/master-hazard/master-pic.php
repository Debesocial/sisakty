<!-- MASTER DATA pic -->
<section class="section">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fas fa-desktop"></i><b> EHS</b> Apps</a></li>
			<li class="breadcrumb-item"><a href="#"> Master Data</a></li>
			<li class="breadcrumb-item"><a href="#"> Data PIC</a></li>
		</ol>
	</nav>
	<div class="row ">

		<!-- VIEW DATA PIC ----------------------------------------------------------------------------------------------------------------->
		<?php if(@$_GET['act'] == 'list'){?>
			<div class="col-md-12 col-lg-12 col-xl-12">
				<div class="card">
					<div class="card-header">
						<h4>Data PIC | <i class="fas fa-list"></i> </h4>
						<div class="card-header-form">
							<h4>
								<a href="home.php?v=mpic&act=add" class="btn btn-sm btn-primary "><i class="fas fa-plus-circle"></i> 
									Tambah Data PIC
								</a>
							</h4>			
						</div>				
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-hover" id="save-stage-accident" style="width:100%;">
								<thead>
									<tr>
										<th>Nama</th>
										<th>Divisi</th>
										<th>Perusahaan</th>
										<th>No. Telp</th>
										<th>Email</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if(@$_GET['act'] == 'del') {
										$id 	  = $_GET['id'];
										$sql 	  = 'DELETE FROM user WHERE user_id = '.$id.'';
										$delete   = mysqli_query($conn, $sql);
										if ($delete) {
											echo"
											<script>Swal.fire({icon: 'success', title: 'Data user berhasil dihapus', showConfirmButton: false, timer: 1500
										});</script>";
									} else { 
										echo"
										<script>Swal.fire({ icon: 'success', title: 'Data user gagal dihapus', showConfirmButton: false, timer: 1500
									});</script>";
								}
							}

							$data = mysqli_query($conn,"SELECT * FROM view_user where user_status != 'ADMIN' and user_pic = 'Y'");
							while($row  = mysqli_fetch_array($data)){ ?> 
								<tr>
									<td><?php echo $row['user_name']; ?></td>
									<td><?php echo $row['divisi_name']; ?></td>
									<td><?php echo $row['comp_name']; ?></td>
									<td><?php echo $row['user_phone']; ?></td>
									<td><?php echo $row['user_email']; ?></td>
									<td>
										<form id="form-pic-delete">
											<input type="text" name="id" value="<?php echo $row['user_id']; ?>" hidden>
											<button type="submit" id="hazard-update" name="hazard-update" class="btn btn-sm btn-danger">
												<i class="fas fa-trash"></i>
											</button>
										</form>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
<?php } ?>

<!-- ADD DATA PIC ---------------------------------------------------------------------------------------------------------------->
<?php if(@$_GET['act'] == 'add'){?>
	<div class="col-md-12 col-lg-12 col-xl-12">
		<div class="card">
			<div class="card-header">	
				<h4>Pilih User Sebagai PIC | <i class="fas fa-plus-circle"></i> </h4>			
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="save-stage-spermit" style="width:100%;">
						<thead>
							<tr>
								<th>Nama</th>
								<th>Divisi</th>
								<th>Perusahaan</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if(@$_GET['act'] == 'del') {
								$id 	  = $_GET['id'];
								$sql 	  = 'DELETE FROM user WHERE user_id = '.$id.'';
								$delete   = mysqli_query($conn, $sql);
								if ($delete) {
									echo"
									<script>Swal.fire({icon: 'success', title: 'Data user berhasil dihapus', showConfirmButton: false, timer: 1500
								});</script>";
							} else { 
								echo"
								<script>Swal.fire({ icon: 'success', title: 'Data user gagal dihapus', showConfirmButton: false, timer: 1500
							});</script>";
						}
					}

					$data = mysqli_query($conn,"SELECT * FROM view_user where user_status != 'ADMIN' and user_pic != 'Y'");
					while($row  = mysqli_fetch_array($data)){ ?> 
						<tr>
							<td><?php echo $row['user_name']; ?></td>
							<td><?php echo $row['divisi_name']; ?></td>
							<td><?php echo $row['comp_name']; ?></td>
							<td>
								<form id="form-pic-update">
									<input type="text" name="id" value="<?php echo $row['user_id']; ?>" hidden>
									<button type="submit" id="hazard-update" name="hazard-update" class="btn btn-sm btn-success">
										<i class="fas fa-plus-circle"></i> PIC
									</button>
								</form>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
<?php } ?>
</section>

<!-- UPDATE pic -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-pic-update").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=pic&act=update",
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
						location.href = 'home.php?v=mpic&act=list';
					});
				}
			});
		});
	});
</script>


<!-- UPDATE pic -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-pic-delete").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=pic&act=delete",
				type : "POST",
				cache:false,
				data :formData,
				contentType : false, 
				processData: false,
				success : function(data){
					Swal.fire({
						icon: 'success',
						title: 'Berhasil Hapus!',
						showConfirmButton: false,
						timer: 1000
					}).then(function() {
						location.href = 'home.php?v=mpic&act=list';
					});
				}
			});
		});
	});
</script>