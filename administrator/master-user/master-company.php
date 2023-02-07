<<<<<<< Updated upstream
<div class="row ">
	<!-- ADD DATA company ----------------------------------------------------------------------------------------------------------------->
	<?php if(@$_GET['act'] == 'add'){?>
		<div class="col-md-5 col-lg-5 col-xl-5">
			<div class="card">
				<div class="card-header">
					<h4>Data Perusahaan | <i class="fas fa-plus-circle"></i> </h4>
				</div>
				<form id="form-company-add">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="form-group">
									<label>Perusahaan</label>
									<input type="text" class="form-control" id="" required placeholder="Perusahaan" name="company">
								</div>
								<div class="form-group">
									<label>&nbsp;</label>
									<button type="submit" id="company-add" name="company-add" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
									</button>
=======
<!-- MASTER DATA company -->
<section class="section">
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fas fa-desktop"></i><b> SISAKTY</b></a></li>
			<li class="breadcrumb-item"><a href="#"> Data Perusahaan</a></li>
		</ol>
	</nav>
	<div class="row ">

		<!-- ADD DATA company ----------------------------------------------------------------------------------------------------------------->
		<?php if(@$_GET['act'] == 'add'){?>
			<div class="col-md-5 col-lg-5 col-xl-5">
				<div class="card">
					<div class="card-header">
						<h4>Data Perusahaan | <i class="fas fa-plus-circle"></i> </h4>
					</div>
					<form id="form-company-add">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-lg-12 col-xl-12">
									<div class="form-group">
										<label>Perusahaan</label>
										<input type="text" class="form-control" id="" required placeholder="Perusahaan" name="company">
									</div>
									<div class="form-group">
										<label>&nbsp;</label>
										<button type="submit" id="company-add" name="company-add" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan
										</button>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		<?php } ?>

		<!-- UPDATE DATA company -------------------------------------------------------------------------------------------------------------->
		<?php if(@$_GET['act'] == 'update'){?>
			<div class="col-md-5 col-lg-5 col-xl-5">
				<div class="card">
					<div class="card-header">
						<h4>Data Perusahaan | <i class="fas fa-edit"></i> </h4>	
					</div>
					<form id="form-company-update">
						<div class="card-body">
							<div class="row">
								<div class="col-md-12 col-lg-12 col-xl-12">
									<?php 
									@$id = $_GET['id'];
									@$companyupdate = mysqli_fetch_array($conn->query("SELECT * FROM company  where  comp_id = '$id'"));?>
									<div class="form-group">
										<label>Perusahaan</label>
										<input type="text" class="form-control" id="" required placeholder="Perusahaan" name="company" 
										value="<?= $companyupdate['comp_name']?>">
									</div>
									<div class="form-group">
										<label>&nbsp;</label>
										<button type="submit" id="company-update" name="company-update" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan
										</button>
									</div>
>>>>>>> Stashed changes
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>

	<!-- UPDATE DATA company -------------------------------------------------------------------------------------------------------------->
	<?php if(@$_GET['act'] == 'update'){?>
		<div class="col-md-5 col-lg-5 col-xl-5">
			<div class="card">
				<div class="card-header">
					<h4>Data Perusahaan | <i class="fas fa-edit"></i> </h4>	
				</div>
<<<<<<< Updated upstream
				<form id="form-company-update">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<?php 
								@$id = $_GET['id'];
								@$companyupdate = mysqli_fetch_array($conn->query("SELECT * FROM company  where  comp_id = '$id'"));?>
								<div class="form-group">
									<label>Perusahaan</label>
									<input type="text" class="form-control" id="" required placeholder="Perusahaan" name="company" 
									value="<?php echo $companyupdate['comp_name']?>">
								</div>
								<div class="form-group">
									<label>&nbsp;</label>
									<button type="submit" id="company-update" name="company-update" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>

	<!-- VIEW DATA company ---------------------------------------------------------------------------------------------------------------->
	<div class="col-md-7 col-lg-7 col-xl-7">
		<div class="card">
			<div class="card-header">
				<h4>Data Perusahaan | <i class="fas fa-list"></i></h4>				
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="save-mdcomp" style="width:100%;">
						<thead>
							<tr>
								<th>Perusahaan</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if(@$_GET['act'] == 'del') {
								$id 	  = $_GET['id'];
								$sql 	  = 'DELETE FROM company WHERE comp_id = '.$id.'';
								$delete   = mysqli_query($conn, $sql);
								if ($delete) {
									echo"
									<script>
									Swal.fire({icon: 'success', title: 'Data berhasil dihapus', showConfirmButton: false, timer: 1500
									}).then(function() {
										location.href = 'home.php?v=mcompany&act=add';
										});
										</script>";
									} else { 
										echo"
										<script>
										Swal.fire({ icon: 'success', title: 'Data gagal dihapus', showConfirmButton: false, timer: 1500
										}).then(function() {
											location.href = 'home.php?v=mcompany&act=add';
											});
											</script>";
										}
									}

									$data = mysqli_query($conn,"SELECT * FROM company");
									while($row  = mysqli_fetch_array($data)){ ?> 
										<tr>
											<td><?php echo $row['comp_name']; ?></td>
											<td>
												<a href="home.php?v=mcompany&act=update&id=<?php echo $row['comp_id']; ?>" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>

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
																confirmButtonText: '<a style="color:#fff;text-decoration: none;" href="home.php?v=mcompany&act=del&id=<?php echo $row['comp_id']; ?>">Yes</a>'
															})
														});
													});
												</script>
													<!-- <a href="#" id="del" class="btn btn-sm btn-danger">
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

			<!-- ADD company -->
			<script type="text/javascript">
				$(document).ready(function(){
					$("#form-company-add").on("submit", function(e){
						e.preventDefault();
						var formData = new FormData(this);
						$.ajax({
							url  : "action/action.php?action=company&act=add",
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
									location.href = 'home.php?v=mcompany&act=add';
								});
							}
						});
					});
				});
			</script>

			<!-- UPDATE company -->
			<script type="text/javascript">
				$(document).ready(function(){
					$("#form-company-update").on("submit", function(e){
						e.preventDefault();
						var formData = new FormData(this);
						$.ajax({
							url  : "action/action.php?action=company&act=update&id=<?php echo $companyupdate['comp_id'];?>",
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
									location.href = 'home.php?v=mcompany&act=add';
								});
							}
						});
					});
				});
			</script>
=======
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-striped table-hover" id="save-mdcomp" style="width:100%;">
							<thead>
								<tr>
									<th>Perusahaan</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $data = mysqli_query($conn,"SELECT * FROM company");
								while($row  = mysqli_fetch_array($data)){ ?> 
									<tr>
										<td><?= $row['comp_name']; ?></td>
										<td>
											<a href="home.php?v=mcompany&act=update&id=<?= $row['comp_id']; ?>" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
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

<!-- ADD company -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-company-add").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=company&act=add",
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
						location.href = 'home.php?v=mcompany&act=add';
					});
				}
			});
		});
	});
</script>

<!-- UPDATE company -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-company-update").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=company&act=update&id=<?= $companyupdate['comp_id'];?>",
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
						location.href = 'home.php?v=mcompany&act=add';
					});
				}
			});
		});
	});
</script>
>>>>>>> Stashed changes


