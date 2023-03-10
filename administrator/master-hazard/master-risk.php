<div class="row ">
	<!-- ADD DATA risk ----------------------------------------------------------------------------------------------------------------->
	<?php if(@$_GET['act'] == 'add'){?>
		<div class="col-md-5 col-lg-5 col-xl-5">
			<div class="card">
				<div class="card-header">
					<h4>Data Risiko | <i class="fas fa-plus-circle"></i> </h4>
				</div>
				<form id="form-risk-add">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<div class="form-group">
									<label>Risiko</label>
									<input type="text" class="form-control" id="" required placeholder="Risiko" name="risk">
								</div>
								<div class="form-group">
									<label>&nbsp;</label>
									<button type="submit" id="risk-add" name="risk-add" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>

	<!-- UPDATE DATA risk -------------------------------------------------------------------------------------------------------------->
	<?php if(@$_GET['act'] == 'update'){?>
		<div class="col-md-5 col-lg-5 col-xl-5">
			<div class="card">
				<div class="card-header">
					<h4>Data Risiko | <i class="fas fa-edit"></i> </h4>	
				</div>
				<form id="form-risk-update">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<?php 
								@$id = $_GET['id'];
								@$riskupdate = mysqli_fetch_array($conn->query("SELECT * FROM risk  where  risk_id = '$id'"));?>
								<div class="form-group">
									<label>risk</label>
									<input type="text" class="form-control" id="" required placeholder="Risiko" name="risk" 
									value="<?= $riskupdate['risk_name']?>">
								</div>
								<div class="form-group">
									<label>&nbsp;</label>
									<button type="submit" id="risk-update" name="risk-update" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan</a>
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>

	<!-- VIEW DATA risk ---------------------------------------------------------------------------------------------------------------->
	<div class="col-md-7 col-lg-7 col-xl-7">
		<div class="card">
			<div class="card-header">
				<h4>Data Risiko | <i class="fas fa-list"></i></h4>				
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="save-stage1" style="width:100%;">
						<thead>
							<tr>
								<th>Risiko</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php $data = mysqli_query($conn,"SELECT * FROM risk");
							while($row  = mysqli_fetch_array($data)){ ?> 
								<tr>
									<td><?= $row['risk_name']; ?></td>
									<td>
										<a href="home.php?v=mrisk&act=update&id=<?= $row['risk_id']; ?>" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>
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

<!-- ADD risk -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-risk-add").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=risk&act=add",
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
						location.href = 'home.php?v=mrisk&act=add';
					});
				}
			});
		});
	});
</script>

<!-- UPDATE risk -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-risk-update").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=risk&act=update&id=<?= $riskupdate['risk_id'];?>",
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
						location.href = 'home.php?v=mrisk&act=add';
					});
				}
			});
		});
	});
</script>


