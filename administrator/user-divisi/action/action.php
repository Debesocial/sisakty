<?php 
@session_start();
include '../../../controller/connection.php';

if ($_GET['action'] == 'user' ) {
	@$nik    	  	= addslashes($_POST['nik']);
	@$password     	= addslashes(base64_encode($_POST['password']));
	@$name    	  	= addslashes($_POST['name']);
	@$birth    	  	= addslashes($_POST['birth']);
	@$phone    	  	= addslashes($_POST['phone']);
	@$email    	  	= addslashes($_POST['email']);
	@$onsite    	= addslashes($_POST['onsite']);
	@$comp   	  	= addslashes($_POST['comp']);	
	@$datalevel = $_POST['level'];    
	@$level  = substr($datalevel, strpos($datalevel, "-") + 1); 
	@$datadept = $_POST['dept'];    
	@$dept  = substr($datadept, strpos($datadept, "-") + 1); 
	@$datadiv = $_POST['divisi'];    
	@$divisi  = substr($datadiv, strpos($datadiv, "-") + 1);
	@$status    	= addslashes($_POST['status']);
	@$pic    	    = addslashes($_POST['pic']);
	if ($pic != '') {
		$pic = 'Y';
	}else {
		$pic = '';
	}

	if($_GET['act'] == 'add') {
		$sql      = "INSERT INTO user (user_nik, user_password, user_name, user_birth, user_phone, user_email, user_onsite, user_level,user_dept, user_divisi, user_comp, user_status, user_pic ) VALUES ('$nik','$password','$name','$birth','$phone','$email','$onsite','$level','$dept','$divisi','$comp','$status','$pic')";
	}elseif($_GET['act'] == 'update') {
		$id 			= $_GET['id'];
		$sql            = "UPDATE user SET 
		user_nik 		= '$nik',
		user_password 	= '$password',
		user_name 		= '$name',
		user_birth 		= '$birth',
		user_phone		= '$phone',
		user_email 		= '$email',
		user_onsite 	= '$onsite',
		user_level 		= '$level',
		user_dept 		= '$dept',
		user_divisi 	= '$divisi',
		user_comp 		= '$comp',
		user_status		= '$status',
		user_pic		= '$pic' WHERE 
		user_id         = '$id'";
	}
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}
	
	// MASTER LEVEL ---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'level' ) {
	@$level     	= addslashes($_POST['level']);
	@$comp          = addslashes($_POST['comp']);

	if($_GET['act'] == 'add') {
		$sql      = "INSERT INTO level (level_name, level_comp) VALUES ('$level','$comp')";
	}elseif($_GET['act'] == 'update') {
		$id 			= $_GET['id'];
		$sql            = "UPDATE level SET 
		level_name 		= '$level', 
		level_comp 		= '$comp' WHERE 
		level_id        = '$id'";
	}
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

	// MASTER DEPARTEMENT ---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'departement' ) {
	@$dept        = addslashes($_POST['departement']);
	@$comp          = addslashes($_POST['comp']);

	if($_GET['act'] == 'add') {
		$sql      = "INSERT INTO departement (dept_name, dept_comp) VALUES ('$dept','$comp')";
	}elseif($_GET['act'] == 'update') {
		$id 			= $_GET['id'];
		$sql            = "UPDATE departement SET 
		dept_name 		= '$dept',
		dept_comp 		= '$comp' WHERE 
		dept_id         = '$id'";
	}
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}	

	// MASTER DIVISI ---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'divisi' ) {
	@$divisi        = addslashes($_POST['divisi']);
	@$comp          = addslashes($_POST['comp']);

	if($_GET['act'] == 'add') {
		$sql        = "INSERT INTO divisi (divisi_name, divisi_comp) VALUES ('$divisi','$comp')";
	}elseif($_GET['act'] == 'update') {
		$id 			= $_GET['id'];
		$sql            = "UPDATE divisi SET 
		divisi_name 	= '$divisi',
		divisi_comp 	= '$comp' WHERE 
		divisi_id       = '$id'";
	}
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

	// MASTER COMPANY ---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'company' ) {
	@$company        = addslashes($_POST['company']);

	if($_GET['act'] == 'add') {
		$sql        = "INSERT INTO company (comp_name) VALUES ('$company')";
	}elseif($_GET['act'] == 'update') {
		$id 			= $_GET['id'];
		$sql            = "UPDATE company SET 
		comp_name    	= '$company' WHERE 
		comp_id         = '$id'";
	}
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

	// MASTER CLASSIFICATION ---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'classification' ) {
	@$classi        = addslashes($_POST['classification']);

	if($_GET['act'] == 'add') {
		$sql        = "INSERT INTO classification (classi_name) VALUES ('$classi')";
	}elseif($_GET['act'] == 'update') {
		$id 			= $_GET['id'];
		$sql            = "UPDATE classification SET 
		classi_name    	= '$classi' WHERE 
		classi_id        = '$id'";
	}
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

	// MASTER LOCATION ---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'location' ) {
	@$loc          = addslashes($_POST['location']);

	if($_GET['act'] == 'add') {
		$sql        = "INSERT INTO location (loc_name) VALUES ('$loc')";
	}elseif($_GET['act'] == 'update') {
		$id 			= $_GET['id'];
		$sql            = "UPDATE location SET 
		loc_name   		= '$loc' WHERE 
		loc_id     		= '$id'";
	}
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

	// MASTER RISK ---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'risk' ) {
	@$risk          = addslashes($_POST['risk']);

	if($_GET['act'] == 'add') {
		$sql        = "INSERT INTO risk (risk_name) VALUES ('$risk')";
	}elseif($_GET['act'] == 'update') {
		$id 			= $_GET['id'];
		$sql            = "UPDATE risk SET 
		risk_name   		= '$risk' WHERE 
		risk_id     		= '$id'";
	}
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

	// MASTER UNIT ---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'unit' ) {
	@$unit          = addslashes($_POST['unit']);

	if($_GET['act'] == 'add') {
		$sql        = "INSERT INTO unit (unit_name) VALUES ('$unit')";
	}elseif($_GET['act'] == 'update') {
		$id 			= $_GET['id'];
		$sql            = "UPDATE unit SET 
		unit_name   		= '$unit' WHERE 
		unit_id     		= '$id'";
	}
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

	// MASTER AREA ---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'area' ) {
	@$area          = addslashes($_POST['area']);

	if($_GET['act'] == 'add') {
		$sql        = "INSERT INTO area (area_name) VALUES ('$area')";
	}elseif($_GET['act'] == 'update') {
		$id 			= $_GET['id'];
		$sql            = "UPDATE area SET 
		area_name   		= '$area' WHERE 
		area_id     		= '$id'";
	}
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

	// MASTER BULLETIN ---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'bulletin' ) {
	@$file_name	= $_FILES['file']['name'];
	@$file_tmp	= $_FILES['file']['tmp_name'];
	@$tgl		= date("His");

	@$name        = addslashes($_POST['name']);
	@$desc        = addslashes($_POST['desc']);

	# IMAGE VALIDATION
	if ( $file_name != '') {
		$filename   = $tgl.'-'.$file_name;
	} else {
		$filename   = '';
	}
	$lokasi 	= '../../assets/bulletin/'.$filename;
	move_uploaded_file($file_tmp, $lokasi);

	if($_GET['act'] == 'add') {
		$sql        = "INSERT INTO bulletin (bulletin_name, bulletin_desc, bulletin_file) VALUES ('$name', '$desc', '$filename')";
	}elseif($_GET['act'] == 'update') {
		if ( $file_name != '') {
			$id 			= $_GET['id'];
			$sql            = "UPDATE bulletin SET 
			bulletin_name 	= '$name',
			bulletin_desc 	= '$desc',
			bulletin_file 	= '$filename' WHERE 
			bulletin_id     = '$id'";
		} else {
			$id 			= $_GET['id'];
			$sql            = "UPDATE bulletin SET 
			bulletin_name 	= '$name',
			bulletin_desc 	= '$desc' WHERE 
			bulletin_id     = '$id'";
		}
	}
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

	// MASTER IUPDATE ---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'iupdate' ) {
	@$file_name_f	= $_FILES['foto']['name'];
	@$file_tmp_f	= $_FILES['foto']['tmp_name'];
	@$file_name		= $_FILES['file']['name'];
	@$file_tmp		= $_FILES['file']['tmp_name'];
	@$tgl			= date("His");

	@$name        = addslashes($_POST['name']);
	@$desc        = addslashes($_POST['desc']);

	# FILE VALIDATION
	if ( $file_name != '') {
		$filename     = $tgl.'-'.$file_name;
	} else {
		$filename   = '';
	}

	# IMAGE VALIDATION
	if ($file_name_f != '') {
		$filename_f   = $tgl.'-'.$file_name_f;
	} else {
		$filename_f   = '';
	}

	$lokasi 	= '../../assets/iupdate/file/'.$filename;
	$lokasi_f 	= '../../assets/iupdate/'.$filename_f;
	move_uploaded_file($file_tmp, $lokasi);
	move_uploaded_file($file_tmp_f, $lokasi_f);

	if($_GET['act'] == 'add') {
		$sql        = "INSERT INTO iupdate (iupdate_name, iupdate_desc, iupdate_file, iupdate_img) VALUES ('$name', '$desc', '$filename', '$filename_f')";
	}elseif($_GET['act'] == 'update') {
		if ($file_name != '' && $file_name_f == '') {
			$id 			= $_GET['id'];
			$sql            = "UPDATE iupdate SET 
			iupdate_name 	= '$name',
			iupdate_desc 	= '$desc',
			iupdate_file 	= '$filename' WHERE 
			iupdate_id      = '$id'";
		} elseif ($file_name == '' && $file_name_f != '') {
			$id 			= $_GET['id'];
			$sql            = "UPDATE iupdate SET 
			iupdate_name 	= '$name',
			iupdate_desc 	= '$desc',
			iupdate_img 	= '$filename_f' WHERE 
			iupdate_id      = '$id'";
		} else {
			$id 			= $_GET['id'];
			$sql            = "UPDATE iupdate SET 
			iupdate_name 	= '$name',
			iupdate_desc 	= '$desc',
			iupdate_file 	= '$filename',
			iupdate_img 	= '$filename_f' WHERE 
			iupdate_id      = '$id'";
		}
	}
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

	// TRANSACT HAZARD---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'hazard' ) {
	@$id 			  = $_GET['id'];
	@$status          = addslashes($_POST['status']);
	@$desc            = addslashes($_POST['desc']);
	@$user            = addslashes($_POST['user']);
	@$file_name		= $_FILES['file']['name'];
	@$file_tmp		= $_FILES['file']['tmp_name'];
	@$tgl			= date("His");

	# IMAGE VALIDATION
	if ( $file_name != '') {
		$filename   = $tgl.'-'.$file_name;
	} else {
		$filename   = '';
	}
	$lokasi 	= '../../assets/hazard/'.$filename;
	move_uploaded_file($file_tmp, $lokasi);

	$percent = 0.5;
	header('Content-Type: image/jpeg');
	list($width, $height, $type) = getimagesize($lokasi);
	$newwidth = $width * $percent;
	$newheight = $height * $percent;
	$type = $list[2];
	echo $type;
	$thumb = imagecreatetruecolor($newwidth, $newheight);
	$source = imagecreatefromjpeg($lokasi);
	imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
	$exif=exif_read_data($lokasi);
	if($exif['Orientation']==3){
		$thumb=imagerotate($thumb,180,0);
	}elseif ($exif['Orientation']==8) {
		$thumb=imagerotate($thumb,90,0);
	} elseif ($exif['Orientation']==6) {
		$thumb=imagerotate($thumb,-90,0);
	}
	imagejpeg($thumb,'../../assets/hazard/thumbnail/'.$filename);

	$sql            = "UPDATE hazard SET
	hazard_status   = '$status' WHERE 
	hazard_id     	= '$id'";

	$status		  = "INSERT INTO hazard_status (hazard_status_hazard, hazard_status_name, hazard_status_desc, hazard_status_user, hazard_status_photo) 
	VALUES ('$id', '$status','$desc','$user','$filename')";

	@$updatestatus   = mysqli_query($conn, $status);
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

		// MASTER PIC---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'pic' ) {
	@$id 			  = $_POST['id'];

	if($_GET['act'] == 'update') {
		$sql            = "UPDATE user SET 
		user_pic   		= 'Y' WHERE 
		user_id     	= '$id'";

	}elseif($_GET['act'] == 'delete') {
		$sql            = "UPDATE user SET 
		user_pic   		= '' WHERE 
		user_id     	= '$id'";
	}
	@$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}
}?>