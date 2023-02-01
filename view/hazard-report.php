<!-- Start main_haeder -->
<header class="main_haeder header-sticky multi_item">
	<div class="em_side_right">
		<a class="btn btn__back rounded-circle bg-snow" onclick="history.go(-1)">
			<i class="tio-chevron_left"></i>
		</a>
	</div>
	<div class="title_page">
		<h1 class="page_name">
			Hazard Report
		</h1>
	</div>
	<div class="em_side_right">
	</div>
</header>
<!-- End.main_haeder -->

<form action=""  id="form-hazard">
	<section class="em__signTypeOne padding-t-20 components_page padding-b-0" >
		<div class="bg-white padding-30">
			<center><img id="output" width="50%" style="border-width: 4px; border-color: white; border-style:solid;" /></center>
			<div class="form-group"><br>
				<div class="input-wrapper">
					<div class="custom-file">
						<input name="image" type="file" accept="image/*" id="imageUpload" onchange="loadFile(event)">
						<label class="custom-file-label"  for="imageUpload" >Pilih Gambar</label>
						<script>
							var loadFile = function(event) {
								var inputFile = document.getElementById('imageUpload');
								var pathFile = inputFile.value;
								var ekstensiOk = /(\.jpg|\.jpeg)$/i;
								if(!ekstensiOk.exec(pathFile)){
									Swal.fire({ icon: 'error', text: 'Ekstenti file tidak diizinkan !' })
									return false;
								} else {
									var output = document.getElementById('output');
									output.src = URL.createObjectURL(event.target.files[0]);
									output.onload = function() {
										URL.revokeObjectURL(output.src)
									}
								}
							};
						</script>
					</div>
				</div>
			</div>
			<div class="form-group">
				<label>Tanggal</label>
				<div class="input_group">
					<input name="date" type="datetime-local" class="form-control" id="date" placeholder="date" required="" value="<?=date('Y-m-d\TH:i',time()) ?>">
				</div>
			</div>
			<div class="form-group">
				<label>Judul Laporan</label>
				<div class="input_group">
					<input name="title" type="text" class="form-control" id="title" placeholder="Judul Laporan" required="">
				</div>
			</div>
			<div class="form-group">
				<label>Lokasi</label>
				<select name="loc"  id="loc" class="form-control" required  onchange="yesnoCheck_loc(this);">
					<option value="">- Pilih Lokasi -</option>
					<?php $data = mysqli_query($conn,"select * from location order by loc_id desc");
					while($row  = mysqli_fetch_array($data)){
						?> 
						<option value=<?php echo $row['loc_id'];?>> <?php echo $row['loc_name'];}?> 
					</option>
				</select>
			</div>
			<div class="form-group" id="loc_lain" style="display: none;">
				<div class="input-wrapper">
					<label class="label" for="name4">Lokasi Lain</label>
					<textarea name="loc_etc" type="text" class="form-control" placeholder="Lokasi Lain.." rows="6"></textarea>
					<i class="clear-input"><ion-icon name="close-circle"></ion-icon></i>
				</div>
			</div>
			<div class="form-group">
				<label>Klasifikasi</label>
				<select name="classi"  id="classi" class="form-control" required>
					<option value="">- Pilih Klasifikasi -</option>
					<?php $data = mysqli_query($conn,"select * from classification order by classi_name asc");
					while($row  = mysqli_fetch_array($data)){
						?> 
						<option value=<?php echo $row['classi_id'];?>> <?php echo $row['classi_name'];}?> 
					</option>
				</select>
			</div>
			<div class="form-group">
				<label>Risiko</label>
				<select name="risk"  id="risk" class="form-control" required>
					<option value="">- Pilih Risiko -</option>
					<?php $data = mysqli_query($conn,"select * from risk");
					while($row  = mysqli_fetch_array($data)){
						?> 
						<option value=<?php echo $row['risk_id'];?>> <?php echo $row['risk_name'];}?> 
					</option>
				</select>
			</div>
			<div class="form-group">
				<label>Perusahaan</label>
				<select name="comp"  id="comp" class="form-control" required>
					<option value="">- Pilih Perusahaan -</option>
					<?php $data = mysqli_query($conn,"select * from company"); // where comp_id <> 16
					while($row  = mysqli_fetch_array($data)){
						?> 
						<option value=<?php echo $row['comp_id'];?>> <?php echo $row['comp_name'];}?> 
					</option>
				</select>
			</div>
			<div class="form-group">
				<label>PIC</label>
				<select name="divisi"  id="divisi" class="form-control" required>
					<option value="">- Pilih PIC -</option>
                    <?php $data = mysqli_query($conn,"select * from divisi"); // where divisi_id <> 61 and divisi_id <> 63 and divisi_id <> 64
                    while($row  = mysqli_fetch_array($data)){
                    	?> 
                    	<option value=<?php echo $row['divisi_comp'].'-'.$row['divisi_id'];?>> <?php echo $row['divisi_name'];}?> 
                    </option>
                </select>
            </div>
            <div class="form-group">
            	<label>Uraian</label>
            	<textarea name="desc" type="text" class="form-control" id="desc" placeholder="Uraian.." rows="6" required=""></textarea>
            </div>
            <div class="form-group">
            	<label>Solusi / Saran</label>
            	<textarea name="solution" type="text" class="form-control" id="solution" placeholder="Saran.." rows="6" required=""></textarea>
            </div>
            <div class="form-check">
            	<input type="checkbox" class="form-check-input" id="exampleCheck1" name="followup">
            	<label class="form-check-label" for="exampleCheck1">Tindak Lanjut PIC</label>
            </div><br>
        </div>
        <div class="em__footer">
        	<input name="user" type="text" value="<?php echo $_SESSION['user_id'];?>" hidden>
        	<a type="" id="submit-post" name="submit-post" data-toggle="modal" data-target="#modal-post" class="btn bg-primary color-white justify-content-center"><i class="fas fa-sign-in-alt"></i>Submit</a><br>
        </div>
    </section>

    <!-- Modal POST -->
    <div class="modal bttom_show defaultModal mdll_removeStand fade" id="modal-post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    	<div class="modal-dialog modal-dialog-centered">
    		<div class="modal-content">
    			<div class="modal-body">
    				<div class="content__remove">
    					<div class="media">
    						<div class="icon">
    							<img src="../assets/icon/outline/warnings.svg" >
    						</div>
    						<div class="media-body">
    							<div class="txt">
    								<h2>Hazard Report</h2>
    								<p>Pastikan laporan anda sudah sesuai dan dapat dipertanggungjawabkan, Yakin ingin melanjutkan laporan ?</p>
    							</div>
    						</div>
    					</div>
    				</div>
    			</div>
    			<div class="modal-footer">
    				<p id="demo">
    					<button type="button" data-dismiss="modal" class="btn btn__cancel mr-1 size-15 color-text min-w-100 h-40 d-flex align-items-center rounded-8 justify-content-center">Tidak</button>
    					<button  type="submit" id="submit" name="submit" class="btn bg-primary min-w-100 m-0 size-15 color-white h-40 d-flex align-items-center rounded-8 justify-content-center">Iya</button>
    				</p>
    			</div>
    		</div>
    	</div>
    </div>
</form>

<script type="text/javascript">
	$(function() {
		var interval = $('#divisi option').clone();
		$('#comp').on('change', function() {
			var val = this.value;
			$("#divisi option").show(); 

			if(val!="")
				$('#divisi').html( 
					interval.filter(function() { 
						return this.value.indexOf( val + '-' ) === 0; 
					})
					);
		})
		.change();
	});
</script>

<script type="text/javascript">
	function yesnoCheck_loc(that) 
	{
		if (that.value == "1") 
		{
			document.getElementById("loc_lain").style.display = "block";
		}
		else
		{
			document.getElementById("loc_lain").style.display = "none";
		}
	}
</script>

<!-- POST HAZARD -->
<script type="text/javascript">
	$('#submit-post').click(function(){
		if($('#date').val() == '' ){
			Swal.fire({ icon: 'error', text: 'Tanggal tidak boleh kosong !' })
			return false;
		}if($('#title').val() == '' ){
			Swal.fire({ icon: 'error', text: 'Judul tidak boleh kosong !' })
			return false;
		}if($('#loc').val() == '' ){
			Swal.fire({ icon: 'error', text: 'Lokasi tidak boleh kosong !' })
			return false;
		}if($('#classi').val() == '' ){
			Swal.fire({ icon: 'error', text: 'Klasifikasi tidak boleh kosong !' })
			return false;
		}if($('#risk').val() == '' ){
			Swal.fire({ icon: 'error', text: 'Risiko tidak boleh kosong !' })
			return false;
		}if($('#divisi').val() == '' ){
			Swal.fire({ icon: 'error', text: 'Divisi tidak boleh kosong !' })
			return false;
		}if($('#comp').val() == '' ){
			Swal.fire({ icon: 'error', text: 'Perusahaan tidak boleh kosong !' })
			return false;
		}if($('#desc').val() == '' ){
			Swal.fire({ icon: 'error', text: 'Uraian tidak boleh kosong !' })
			return false;
		}if($('#solution').val() == '' ){
			Swal.fire({ icon: 'error', text: 'Saran tidak boleh kosong !' })
			return false;
		}
		$('#modal-post').modal('show');
		return false;
	})
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$("#form-hazard").on("submit", function(e){
			e.preventDefault();
			var formData = new FormData(this);
			var user = <?php echo $_SESSION['user_id']; ?>;
			document.getElementById("demo").innerHTML = "<center>Please Wait...<br><img src='../assets/img/loader.gif' width='100'></center>";
			$.ajax({
				url  : "action.php?action=hazard&act=add&user="+user,
				type : "POST",
				cache: false,
				data : formData,
				contentType : false, 
				processData: false,
				success : function(data){
					$.ajax({
						url: 'mail_post.php',
						type: 'post',
						success: function (response) {
							Swal.fire({
								title: 'Berhasil!',
								icon:  'success',
								text:  'Laporan anda berhasil dibuat, buka hazard report untuk melihat progress laporan anda',
								focusConfirm: false,
								confirmButtonText:
								'<i class="fa fa-thumbs-up"></i> Oke'
							}).then(function() {
								location.href = 'home.php?v=dashboard';
							});
						} 
					});
				}
			});
		});
	});
</script>