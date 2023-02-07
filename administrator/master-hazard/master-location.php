<div class="row ">

	<!-- ADD DATA location ----------------------------------------------------------------------------------------------------------------->
	<?php if(@$_GET['act'] == 'add'){?>
		<div class="col-md-5 col-lg-5 col-xl-5">
			<div class="card">
				<div class="card-header">
					<h4>Data Lokasi | <i class="fas fa-plus-circle"></i> </h4>
				</div>
				<form id="form-location-add">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="form-group">
									<label>Lokasi</label>
									<input type="text" class="form-control" id="" required placeholder="Lokasi" name="location">
								</div>
								<div class="form-group">
									<label>&nbsp;</label>
									<button type="submit" id="location-add" name="location-add" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>

	<!-- UPDATE DATA location -------------------------------------------------------------------------------------------------------------->
	<?php if(@$_GET['act'] == 'update'){?>
		<div class="col-md-5 col-lg-5 col-xl-5">
			<div class="card">
				<div class="card-header">
					<h4>Data Lokasi | <i class="fas fa-edit"></i> </h4>	
				</div>
				<form id="form-location-update">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<?php 
								@$id = $_GET['id'];
								@$locationupdate = mysqli_fetch_array($conn->query("SELECT * FROM location  where  loc_id = '$id'"));?>
								<div class="form-group">
									<label>Lokasi</label>
									<input type="text" class="form-control" id="" required placeholder="Lokasi" name="location" 
									value="<?php echo $locationupdate['loc_name']?>">
								</div>
								<div class="form-group">
									<label>&nbsp;</label>
									<button type="submit" id="location-update" name="location-update" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>

	<!-- VIEW DATA location ---------------------------------------------------------------------------------------------------------------->
	<div class="col-md-7 col-lg-7 col-xl-7">
		<div class="card">
			<div class="card-header">
				<h4>Data Lokasi | <i class="fas fa-list"></i></h4>				
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="save-stage1" style="width:100%;">
						<thead>
							<tr>
								<th>Lokasi</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if(@$_GET['act'] == 'del') {
								$id 	  = $_GET['id'];
								$sql 	  = 'DELETE FROM location WHERE loc_id = '.$id.'';
								$delete   = mysqli_query($conn, $sql);
								if ($delete) {
									echo"
									<script>
									Swal.fire({icon: 'success', title: 'Data berhasil dihapus', showConfirmButton: false, timer: 1500
									}).then(function() {
										location.href = 'home.php?v=mlocation&act=add';
										});
										</script>";
									} else { 
										echo"
										<script>
										Swal.fire({ icon: 'success', title: 'Data gagal dihapus', showConfirmButton: false, timer: 1500
										}).then(function() {
											location.href = 'home.php?v=mlocation&act=add';
											});
											</script>";
										}
									}

									$data = mysqli_query($conn,"SELECT * FROM location");
									while($row  = mysqli_fetch_array($data)){ ?> 
										<tr>
											<td><?php echo $row['loc_name']; ?></td>
											<td>
												<a href="home.php?v=mlocation&act=update&id=<?php echo $row['loc_id']; ?>" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>

												<script>
													$(document).ready(function(){
														$(document).on("click", "#del", function(){
															var id = $(this).attr('data-id');
															var href = '<a style="color:#fff" href="home.php?v=mlocation&act=del&id=';
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
													<!-- <a href="#" data-id="<?php echo $row['loc_id']; ?>" id="del" class="btn btn-sm btn-danger">
														<i class="fas fa-trash"></i>
													</a> -->
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

			<!-- ADD location -->
			<script type="text/javascript">
				$(document).ready(function(){
					$("#form-location-add").on("submit", function(e){
						e.preventDefault();
						var formData = new FormData(this);
						$.ajax({
							url  : "action/action.php?action=location&act=add",
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
									location.href = 'home.php?v=mlocation&act=add';
								});
							}
						});
					});
				});
			</script>

			<!-- UPDATE location -->
			<script type="text/javascript">
				$(document).ready(function(){
					$("#form-location-update").on("submit", function(e){
						e.preventDefault();
						var formData = new FormData(this);
						$.ajax({
							url  : "action/action.php?action=location&act=update&id=<?php echo $locationupdate['loc_id'];?>",
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
									location.href = 'home.php?v=mlocation&act=add';
								});
							}
						});
					});
				});
			</script>


