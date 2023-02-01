<!-- MASTER DATA departement -->
<section class="section">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fas fa-desktop"></i><b> EHS</b> Apps</a></li>
			<li class="breadcrumb-item"><a href="#"> Master Data</a></li>
			<li class="breadcrumb-item"><a href="#"> Data Departement</a></li>
		</ol>
	</nav>
	<div class="row ">

		<!-- ADD DATA departement ----------------------------------------------------------------------------------------------------------------->
		<?php if(@$_GET['act'] == 'add'){?>
			<div class="col-md-5 col-lg-5 col-xl-5">
				<div class="card">
					<div class="card-header">
						<h4>Data Departement | <i class="fas fa-plus-circle"></i> </h4>
					</div>
					<form id="form-departement-add">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
										<label>Departement</label>
										<input type="text" class="form-control" id="" required placeholder="Departement" name="departement">
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
										<button type="submit" id="departement-add" name="departement-add" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php } ?>

		<!-- UPDATE DATA departement -------------------------------------------------------------------------------------------------------------->
		<?php if(@$_GET['act'] == 'update'){?>
			<div class="col-md-5 col-lg-5 col-xl-5">
				<div class="card">
					<div class="card-header">
						<h4>Data Departement | <i class="fas fa-edit"></i> </h4>	
					</div>
					<form id="form-departement-update">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-lg-12 col-xl-12">
									<?php 
									@$id = $_GET['id'];
									@$departementupdate = mysqli_fetch_array($conn->query("SELECT * FROM departement   
									left join company on company.comp_id = departement.dept_comp
									where  departement.dept_id = '$id'"));?>
									<div class="form-group">
										<label>Departement</label>
										<input type="text" class="form-control" id="" required placeholder="Departement" name="departement" 
										value="<?php echo $departementupdate['dept_name']?>">
									</div>
									<div class="form-group">
										<label>Perusahaan</label>
										<select class="form-control select2" id="" required name="comp">
											<option value="<?php echo $departementupdate['dept_comp']?>"><?php echo $departementupdate['comp_name']?></option>
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
										<button type="submit" id="departement-update" name="departement-update" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php } ?>

		<!-- VIEW DATA departement ---------------------------------------------------------------------------------------------------------------->
		<div class="col-md-7 col-lg-7 col-xl-7">
			<div class="card">
				<div class="card-header">
					<h4>Data Departement | <i class="fas fa-list"></i></h4>				
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="save-md" style="width:100%;">
							<thead>
								<tr>
									<th>Departement</th>
									<th>Perusahaan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								if(@$_GET['act'] == 'del') {
									$id 	  = $_GET['id'];
									$sql 	  = 'DELETE FROM departement WHERE dept_id = '.$id.'';
									$delete   = mysqli_query($conn, $sql);
									if ($delete) {
										echo"
										<script>
										Swal.fire({icon: 'success', title: 'Data berhasil dihapus', showConfirmButton: false, timer: 1500
										}).then(function() {
											location.href = 'home.php?v=mdepartement&act=add';
											});
											</script>";
										} else { 
											echo"
											<script>
											Swal.fire({ icon: 'success', title: 'Data gagal dihapus', showConfirmButton: false, timer: 1500
											}).then(function() {
												location.href = 'home.php?v=mdepartement&act=add';
												});
												</script>";
											}
										}

										$data = mysqli_query($conn,"SELECT * FROM departement");
										while($row  = mysqli_fetch_array($data)){ ?> 
											<tr>
												<td><?php echo $row['dept_name']; ?></td>
													<td>
														<?php 
														@$id = $_GET['id'];
														@$compname = mysqli_fetch_array($conn->query("SELECT * FROM company 
														where comp_id = ". $row['dept_comp']."")); echo $compname['comp_name']?>
														
													</td>
												<td>
													<a href="home.php?v=mdepartement&act=update&id=<?php echo $row['dept_id']; ?>" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>

													<script>
														$(document).ready(function(){
															$(document).on("click", "#del", function(){
																Swal.fire({
																	title: 'Are you sure?',
																	text: "You won't be able to revert this!",
																	icon: 'warning',
																	showCancelButton: true,
																	confirmButtonColor: '#3085d6',
																	cancelButtonColor: '#d33',
																	confirmButtonText: '<a style="color:#fff;text-decoration: none;" href="home.php?v=mdepartement&act=del&id=<?php echo $row['dept_id']; ?>">Yes</a>'
																})
															});
														});
													</script>
													<!-- <a href="#" id="del" class="btn btn-sm btn-danger">
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
		</section>

		<!-- ADD departement -->
		<script type="text/javascript">
			$(document).ready(function(){
				$("#form-departement-add").on("submit", function(e){
					e.preventDefault();
					var formData = new FormData(this);
					$.ajax({
						url  : "action/action.php?action=departement&act=add",
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
								location.href = 'home.php?v=mdepartement&act=add';
							});
						}
					});
				});
			});
		</script>

		<!-- UPDATE departement -->
		<script type="text/javascript">
			$(document).ready(function(){
				$("#form-departement-update").on("submit", function(e){
					e.preventDefault();
					var formData = new FormData(this);
					$.ajax({
						url  : "action/action.php?action=departement&act=update&id=<?php echo $departementupdate['dept_id'];?>",
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
								location.href = 'home.php?v=mdepartement&act=add';
							});
						}
					});
				});
			});
		</script>


