<!-- MASTER DATA level -->
<section class="section">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fas fa-desktop"></i><b> EHS</b> Apps</a></li>
			<li class="breadcrumb-item"><a href="#"> Master Data</a></li>
			<li class="breadcrumb-item"><a href="#"> Data Jabatan</a></li>
		</ol>
	</nav>
	<div class="row ">

		<!-- ADD DATA level ----------------------------------------------------------------------------------------------------------------->
		<?php if(@$_GET['act'] == 'add'){?>
			<div class="col-md-5 col-lg-5 col-xl-5">
				<div class="card">
					<div class="card-header">
						<h4>Data Jabatan | <i class="fas fa-plus-circle"></i> </h4>
					</div>
					<form id="form-level-add">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
										<label>Jabatan</label>
										<input type="text" class="form-control" id="" required placeholder="Jabatan" name="level">
									</div>
									<div class="form-group">
										<label>Perusahaan</label>
										<select class="form-control select2" id="" required name="comp">
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
										<label>&nbsp;</label>
										<button type="submit" id="level-add" name="level-add" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php } ?>

		<!-- UPDATE DATA level -------------------------------------------------------------------------------------------------------------->
		<?php if(@$_GET['act'] == 'update'){?>
			<div class="col-md-5 col-lg-5 col-xl-5">
				<div class="card">
					<div class="card-header">
						<h4>Data Jabatan | <i class="fas fa-edit"></i> </h4>	
					</div>
					<form id="form-level-update">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-lg-12 col-xl-12">
									<?php 
									@$id = $_GET['id'];
									@$levelupdate = mysqli_fetch_array($conn->query("SELECT * FROM level  
										left join company on company.comp_id = level.level_comp
										where  level.level_id = '$id'"));?>
										<div class="form-group">
											<label>Jabatan</label>
											<input type="text" class="form-control" id="" required placeholder="Jabatan" name="level" 
											value="<?php echo $levelupdate['level_name']?>">
										</div>
										<div class="form-group">
											<label>Perusahaan</label>
											<select class="form-control select2" id="" required name="comp">
												<option value="<?php echo $levelupdate['comp_id']?>"><?php echo $levelupdate['comp_name']?></option>
												<?php $data = mysqli_query($conn,"select * from company order by comp_name asc");
												while($row  = mysqli_fetch_array($data)){ ?> 
													<option value=<?php echo $row['comp_id'];?>> 
														<?php echo $row['comp_name'];
													}?> 
												</option>
											</select>
										</div>
										<div class="form-group">
											<label>&nbsp;</label>
											<button type="submit" id="level-update" name="level-update" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
											</button>
										</div>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			<?php } ?>

			<!-- VIEW DATA level ---------------------------------------------------------------------------------------------------------------->
			<div class="col-md-7 col-lg-7 col-xl-7">
				<div class="card">
					<div class="card-header">
						<h4>Data Jabatan | <i class="fas fa-list"></i></h4>				
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table table-striped table-hover" id="save-md" style="width:100%;">
								<thead>
									<tr>
										<th>Jabatan</th>
										<th>Perusahaan</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php 
									if(@$_GET['act'] == 'del') {
										$id 	  = $_GET['id'];
										$sql 	  = 'DELETE FROM level WHERE level_id = '.$id.'';
										$delete   = mysqli_query($conn, $sql);
										if ($delete) {
											echo"
											<script>
											Swal.fire({icon: 'success', title: 'Data berhasil dihapus', showConfirmButton: false, timer: 1500
											}).then(function() {
												location.href = 'home.php?v=mlevel&act=add';
												});
												</script>";
											} else { 
												echo"
												<script>
												Swal.fire({ icon: 'success', title: 'Data gagal dihapus', showConfirmButton: false, timer: 1500
												}).then(function() {
													location.href = 'home.php?v=mlevel&act=add';
													});
													</script>";
												}
											}

											$data = mysqli_query($conn,"SELECT * FROM level");
											while($row  = mysqli_fetch_array($data)){ ?> 
												<tr>
													<td><?php echo $row['level_name']; ?></td>
													<td>
														<?php 
														@$id = $_GET['id'];
														@$compname = mysqli_fetch_array($conn->query("SELECT * FROM company 
														where comp_id = ". $row['level_comp']."")); echo $compname['comp_name']?>
														
													</td>
													<td>
														<a href="home.php?v=mlevel&act=update&id=<?php echo $row['level_id']; ?>" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>

														<script>
															$(document).ready(function(){
																$(document).on("click", "#del", function(){
																	var id = $(this).attr('data-id');
																	var href = '<a style="color:#fff;text-decoration: none;" href="home.php?v=mlevel&act=del&id=';
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
														<!-- <a href="#" data-id="<?php echo $row['level_id']; ?>" id="del" class="btn btn-sm btn-danger">
															<i class="fas fa-trash"></i>
														</a>  --> 
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

			<!-- ADD level -->
			<script type="text/javascript">
				$(document).ready(function(){
					$("#form-level-add").on("submit", function(e){
						e.preventDefault();
						var formData = new FormData(this);
						$.ajax({
							url  : "action/action.php?action=level&act=add",
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
									location.href = 'home.php?v=mlevel&act=add';
								});
							}
						});
					});
				});
			</script>

			<!-- UPDATE level -->
			<script type="text/javascript">
				$(document).ready(function(){
					$("#form-level-update").on("submit", function(e){
						e.preventDefault();
						var formData = new FormData(this);
						$.ajax({
							url  : "action/action.php?action=level&act=update&id=<?php echo $levelupdate['level_id'];?>",
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
									location.href = 'home.php?v=mlevel&act=add';
								});
							}
						});
					});
				});
			</script>


