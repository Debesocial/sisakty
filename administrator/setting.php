<?php
$user_name    	 	= $_POST['name'];
$user_email    		= $_POST['email'];
$user_nik       	= $_POST['nik'];
$user_password     	= base64_encode($_POST['password']);
if (isset($_POST['submit_password'])){
	$sql           	= "UPDATE user SET 
	user_password  	= '$user_password' WHERE 
	user_nik       	= '$user_nik'";
	$simpan        	= mysqli_query($conn, $sql);
	if ($simpan) {
		echo'<script>Swal.fire({ icon: "success", text: "Password berhasil diubah !" }).then((result) => {
			if (result.isConfirmed) { window.location.href = "index.php" }})</script>';
		} else { 
			echo'<script>Swal.fire({title: "Failed",text: "Data gagal diubah",icon: "error",confirmButtonColor: "#35d3e6"})</script>';
		}
	}?>

	<div class="row">
		<div class="col-md-8 col-lg-8 col-xl-8">
			<div class="card">
				<div class="card-header">
					<h4>Ubah Password | <i class="fas fa-cog"></i> </h4>
				</div>
				<div class="card-body">
					<form role="form" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label>Password Lama</label>
							<input type="text" class="form-control" name="nik" value="<?= $_SESSION['user_nik'];?>" hidden>
							<input type="text" class="form-control" name="password1" id="password1" value="<?= base64_decode($_SESSION['user_password']);?>" hidden>
							<input type="password" class="form-control" name="password2" id="password2" placeholder="Password Lama" required>
						</div>
						<div class="form-group">
							<label>Password Baru</label>
							<input type="password" class="form-control" id="password3" required placeholder="Password Baru" name="confirm"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{12,}" title="Minimum 12 characters, at least one uppercase letter, one lowercase letter and one number (EXAMPLE : Passuser2022)" required>
						</div>
						<div class="form-group">
							<label>Konfirmasi Pasword Baru</label>
							<input type="password" class="form-control" id="password4" required placeholder="Konfirmasi Pasword Baru" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{12,}" title="Minimum 12 characters, at least one uppercase letter, one lowercase letter and one number (EXAMPLE : Passuser2022)" required>
						</div>
						<div class="form-group"><br>
							<div class="row">
								<div class="col-md-6 col-lg-6 col-xl-6"></div>
								<div class="col-md-6 col-lg-6 col-xl-6">
									<button type="submit" id="submit_password" name="submit_password" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Save</button><br><br>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>


	<!-- FORM VALIDATION -->
	<script type="text/javascript">
		document.getElementById("password1").onchange = validatePassword;
		document.getElementById("password2").onchange = validatePassword;
		function validatePassword(){
			var pass2=document.getElementById("password2").value;
			var pass1=document.getElementById("password1").value;
			if(pass1!=pass2)
				document.getElementById("password2").setCustomValidity("Passwords didn't match !");
			else
				document.getElementById("password2").setCustomValidity('');
		}
	</script>

	<script type="text/javascript">
		document.getElementById("password3").onchange = validatePassword;
		document.getElementById("password4").onchange = validatePassword;
		function validatePassword(){
			var pass4=document.getElementById("password4").value;
			var pass3=document.getElementById("password3").value;
			if(pass3!=pass4)
				document.getElementById("password4").setCustomValidity("Passwords didn't match !");
			else
				document.getElementById("password4").setCustomValidity('');
		}
	</script>