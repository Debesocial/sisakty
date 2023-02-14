<div class="row ">
	<!-- ADD SHE Bulletin ----------------------------------------------------------------------------------------------------------------->
	<?php if(@$_GET['act'] == 'add'){?>
		<div class="col-md-4 col-lg-4 col-xl-4">
			<div class="card">
				<div class="card-header">
					<h4>SHE Bulletin | <i class="fas fa-plus-circle"></i> </h4>
				</div>
				<form id="form-bulletin-add"  method="post" enctype="multipart/form-data">
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
									<label>Lampiran (optional)</label>
									<input type="file" class="form-control"  placeholder="Lampiran" name="file">
								</div>
								<div class="form-group">
									<label>&nbsp;</label>
									<button type="submit" id="bulletin-add" name="bulletin-add" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>

	<!-- UPDATE SHE Bulletin -------------------------------------------------------------------------------------------------------------->
	<?php if(@$_GET['act'] == 'update'){?>
		<div class="col-md-4 col-lg-4 col-xl-4">
			<div class="card">
				<div class="card-header">
					<h4>SHE Bulletin | <i class="fas fa-edit"></i> </h4>	
				</div>
				<form id="form-bulletin-update">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-lg-12 col-xl-12">
								<?php 
								@$id = $_GET['id'];
								@$bulletin = mysqli_fetch_array($conn->query("SELECT * FROM bulletin  where  bulletin_id = '$id'"));?>
								<div class="form-group">
									<label>Judul</label>
									<input type="text" class="form-control" id="" required placeholder="Judul" name="name" value="<?= $bulletin['bulletin_name']?>">
								</div>
								<div class="form-group">
									<label>Deskripsi</label>
									<textarea type="text" class="form-control" id="" required placeholder="Deskripsi" name="desc"><?= $bulletin['bulletin_desc']?></textarea>
								</div>
								<div class="form-group">
									<label>Lampiran (optional)</label>
									<input type="file" class="form-control" name="file" value="<?= $bulletin['bulletin_file']?>">
								</div>
								<div class="form-group">
									<label>&nbsp;</label>
									<button type="submit" id="bulletin-update" name="bulletin-update" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan
									</button>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	<?php } ?>

	<!-- VIEW SHE Bulletin ---------------------------------------------------------------------------------------------------------------->
	<div class="col-md-8 col-lg-8 col-xl-8">
		<div class="card">
			<div class="card-header">
				<h4>SHE Bulletin | <i class="fas fa-list"></i></h4>				
			</div>
			<div class="card-body">
				<div class="table-responsive">
					<table class="table table-striped table-hover" id="bulletin" style="width:100%;">
						<thead>
							<tr>
								<th style="min-width: 200px;">Deskripsi</th>
								<th style="min-width: 100px;"><center>Action</center></th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if(@$_GET['act'] == 'del') {
								$id 	  = $_GET['id'];
								$sql 	  = 'DELETE FROM bulletin WHERE bulletin_id = '.$id.'';
								$delete   = mysqli_query($conn, $sql);
								if ($delete) {
									echo" <script> Swal.fire({icon: 'success', title: 'SHE Bulletin berhasil dihapus', showConfirmButton: false, timer: 1500 }).then(function() { location.href = 'home.php?v=mbulletin&act=add'; }); </script>";
								} else { 
									echo"<script> Swal.fire({ icon: 'success', title: 'SHE Bulletin gagal dihapus', showConfirmButton: false, timer: 1500 }).then(function() { location.href = 'home.php?v=mbulletin&act=add'; }); </script>";
								}
							}

							$data = mysqli_query($conn,"SELECT * FROM bulletin");
							while($row  = mysqli_fetch_array($data)){ ?> 
								<tr>
									<td><B><?= $row['bulletin_name']; ?></B><BR><small><u><?= $row['bulletin_date']; ?></u><br><?= $row['bulletin_desc']; ?></small><br><br></td>
									<td>
										<center>
											<?php if ($row['bulletin_file'] == '') {?>
												<a style="pointer-events: none;cursor: default;" class="btn btn-sm btn-outline-success"><i class="fas fa-download"></i></a>
											<?php } else { ?>
												<a href="../assets/bulletin/<?= $row['bulletin_file']; ?>" class="btn btn-outline-success"><i class="fas fa-download"></i></a>
											<?php } ?>
											<a href="home.php?v=mbulletin&act=update&id=<?= $row['bulletin_id']; ?>" class="btn btn-outline-success"><i class="fas fa-edit"></i></a>

											<script>
												$(document).ready(function(){
													$(document).on("click", "#del", function(){
														var id = $(this).attr('data-id');
														var href = '<a style="color:#fff" href="home.php?v=mbulletin&act=del&id=';
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
											<a href="#" data-id="<?= $row['bulletin_id']; ?>" id="del" class="btn btn-outline-danger">
												<i class="fas fa-trash"></i>
											</a> 
										</center>
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

<!-- ADD bulletin -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-bulletin-add").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=bulletin&act=add",
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
						location.href = 'home.php?v=mbulletin&act=add';
					});
				}
			});
		});
	});
</script>

<!-- UPDATE bulletin -->
<script type="text/javascript">
	$(document).ready(function(){
		$("#form-bulletin-update").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			$.ajax({
				url  : "action/action.php?action=bulletin&act=update&id=<?= $bulletin['bulletin_id'];?>",
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
						location.href = 'home.php?v=mbulletin&act=add';
					});
				}
			});
		});
	});
</script>


