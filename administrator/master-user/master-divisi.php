<div class="row ">
	<!-- ADD DATA divisi ----------------------------------------------------------------------------------------------------------------->
	<?php if(@$_GET['act'] == 'add'){?>
		<div class="col-md-5 col-lg-5 col-xl-5">
			<div class="card">
				<div class="card-header">
					<h4>Data Divisi | <i class="fas fa-plus-circle"></i> </h4>
				</div>
				<form id="form-divisi-add">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="form-group">
									<label>Divisi</label>
									<input type="text" class="form-control" id="" required placeholder="Divisi" name="divisi">
								</div>
								<div class="form-group">
									<label>Perusahaan</label>
									<select class="form-control select2" id="" required name="comp">
										<option value=""> - Pilih Perusahaan -</option>
										<?php $data = mysqli_query($conn,"select * from company order by comp_name asc");
										while($row  = mysqli_fetch_array($data)){ ?> 
											<option value=<?= $row['comp_id'];?>> 
												<?= $row['comp_name'];
											}?> 
										</option>
									</select>
								</div>
								<div class="form-group">
									<label>&nbsp;</label>
									<button type="submit" id="divisi-add" name="divisi-add" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>

	<!-- UPDATE DATA divisi -------------------------------------------------------------------------------------------------------------->
	<?php if(@$_GET['act'] == 'update'){?>
		<div class="col-md-5 col-lg-5 col-xl-5">
			<div class="card">
				<div class="card-header">
					<h4>Data Divisi | <i class="fas fa-edit"></i> </h4>	
				</div>
				<form id="form-divisi-update">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<?php 
								@$id = $_GET['id'];
								@$divisiupdate = mysqli_fetch_array($conn->query("SELECT * FROM divisi  
									left join company on company.comp_id = divisi.divisi_comp
									where  divisi.divisi_id = '$id'")
								);?>
								<div class="form-group">
									<label>Divisi</label>
									<input type="text" class="form-control" id="" required placeholder="Divisi" name="divisi" 
									value="<?= $divisiupdate['divisi_name']?>">
								</div>
								<div class="form-group">
									<label>Perusahaan</label>
									<select class="form-control select2" id="" required name="comp">
										<option value="<?= $divisiupdate['comp_id']?>"><?= $divisiupdate['comp_name']?></option>
										<?php $data = mysqli_query($conn,"select * from company order by comp_name asc");
										while($row  = mysqli_fetch_array($data)){ ?> 
											<option value=<?= $row['comp_id'];?>> 
												<?= $row['comp_name'];
											}?> 
										</option>
									</select>
								</div>
								<div class="form-group">
									<label>&nbsp;</label>
									<button type="submit" id="divisi-update" name="divisi-update" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>

	<!-- VIEW DATA divisi ---------------------------------------------------------------------------------------------------------------->
	<div class="col-md-7 col-lg-7 col-xl-7">
		<div class="card">
			<div class="card-header">
				<h4>Data Divisi | <i class="fas fa-list"></i></h4>				
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="save-md" style="width:100%;">
						<thead>
							<tr>
								<th>Divisi</th>
								<th>Perusahaan</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $data = mysqli_query($conn,"SELECT * FROM divisi");
							while($row  = mysqli_fetch_array($data)){ ?> 
								<tr>
									<td><?= $row['divisi_name']; ?></td>
									<td>
										<?php 
										@$id = $_GET['id'];
										@$compname = mysqli_fetch_array($conn->query("SELECT * FROM company 
										where comp_id = ". $row['divisi_comp']."")); echo $compname['comp_name']?>
									</td>
									<td>
										<a href="home.php?v=mdivisi&act=update&id=<?= $row['divisi_id']; ?>" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
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

<!-- ADD divisi -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-divisi-add").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=divisi&act=add",
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
						location.href = 'home.php?v=mdivisi&act=add';
					});
				}
			});
		});
	});
</script>

<!-- UPDATE divisi -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-divisi-update").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=divisi&act=update&id=<?= $divisiupdate['divisi_id'];?>",
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
						location.href = 'home.php?v=mdivisi&act=add';
					});
				}
			});
		});
	});
</script>


