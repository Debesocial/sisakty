<div class="row ">
	<!-- ADD DATA classification ----------------------------------------------------------------------------------------------------------------->
	<?php if(@$_GET['act'] == 'add'){?>
		<div class="col-md-5 col-lg-5 col-xl-5">
			<div class="card">
				<div class="card-header">
					<h4>Data Klasifikasi | <i class="fas fa-plus-circle"></i> </h4>
				</div>
				<form id="form-classification-add">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="form-group">
									<label>Klasifikasi</label>
									<input type="text" class="form-control" id="" required placeholder="Klasifikasi" name="classification">
								</div>
								<div class="form-group">
									<label>&nbsp;</label>
									<button type="submit" id="classification-add" name="classification-add" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>

	<!-- UPDATE DATA classification -------------------------------------------------------------------------------------------------------------->
	<?php if(@$_GET['act'] == 'update'){?>
		<div class="col-md-5 col-lg-5 col-xl-5">
			<div class="card">
				<div class="card-header">
					<h4>Data Klasifikasi | <i class="fas fa-edit"></i> </h4>	
				</div>
				<form id="form-classification-update">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<?php 
								@$id = $_GET['id'];
								@$classificationupdate = mysqli_fetch_array($conn->query("SELECT * FROM classification  where  classi_id = '$id'"));?>
								<div class="form-group">
									<label>Klasifikasi</label>
									<input type="text" class="form-control" id="" required placeholder="Klasifikasi" name="classification" 
									value="<?= $classificationupdate['classi_name']?>">
								</div>
								<div class="form-group">
									<label>&nbsp;</label>
									<button type="submit" id="classification-update" name="classification-update" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>

	<!-- VIEW DATA classification ---------------------------------------------------------------------------------------------------------------->
	<div class="col-md-7 col-lg-7 col-xl-7">
		<div class="card">
			<div class="card-header">
				<h4>Data Klasifikasi | <i class="fas fa-list"></i></h4>				
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="save-stage1" style="width:100%;">
						<thead>
							<tr>
								<th>Klasifikasi</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $data = mysqli_query($conn,"SELECT * FROM classification");
							while($row  = mysqli_fetch_array($data)){ ?> 
								<tr>
									<td><?= $row['classi_name']; ?></td>
									<td>
										<a href="home.php?v=mclassification&act=update&id=<?= $row['classi_id']; ?>" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
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

<!-- ADD classification -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-classification-add").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=classification&act=add",
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
						location.href = 'home.php?v=mclassification&act=add';
					});
				}
			});
		});
	});
</script>

<!-- UPDATE classification -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-classification-update").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=classification&act=update&id=<?= $classificationupdate['classi_id'];?>",
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
						location.href = 'home.php?v=mclassification&act=add';
					});
				}
			});
		});
	});
</script>


