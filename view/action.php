<?php 
@session_start();
include '../controller/connection.php';

# LOGIN --------------------------------------------------------------------------------------------------------------------
if($_GET['action'] == 'login') {

// menangkap data yang dikirim dari form login
	$user 	  = $_POST['user'];
	$password = base64_encode($_POST['password']);

// menyeleksi data user dengan username dan password yang sesuai
	$login = mysqli_query($conn,"select * from user 
		LEFT JOIN level ON level.level_id = user.user_level
		LEFT JOIN departement ON departement.dept_id = user.user_dept
		LEFT JOIN divisi ON divisi.divisi_id = user.user_divisi
		LEFT JOIN company ON company.comp_id = user.user_comp
		where user.user_nik='$user' and user.user_password='$password' and user.user_nik != '0001' and user.user_access = 'Y'");

// menghitung jumlah data yang ditemukan
	$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
	if($cek > 0){
		$data = mysqli_fetch_assoc($login);
		$_SESSION['login'] 	    		= 'Y';
		$_SESSION['user_email'] 	    = $email;
		$_SESSION['user_password'] 		= $password;
		$_SESSION['user_id'] 			= $data['user_id'];
		$_SESSION['user_nik'] 			= $data['user_nik'];
		$_SESSION['user_level'] 		= $data['user_level'];
		$_SESSION['user_name'] 			= $data['user_name'];
		$_SESSION['user_email'] 		= $data['user_email'];
		$_SESSION['user_phone'] 		= $data['user_phone'];
		$_SESSION['user_pic'] 			= $data['user_pic'];
		$_SESSION['dept_name'] 			= $data['dept_name'];
		$_SESSION['divisi_name'] 		= $data['divisi_name'];
		$_SESSION['comp_name'] 			= $data['comp_name'];
		$_SESSION['user_pic'] 			= $data['user_pic'];
		$_SESSION['user_divisi'] 		= $data['user_divisi'];
		$_SESSION['user_comp'] 			= $data['user_comp'];
		echo 1;
	}else{
		echo 0;
	}

# FORGOT PASSWORD ----------------------------------------------------------------------------------------------------------
} elseif($_GET['action'] == 'forpass') {
	$user 	  	= $_POST['user'];
	$email 		= $_POST['email'];
	$pass 		= base64_encode($_POST['pass']);
	$password 	= mysqli_query($conn,"select * from user where user_nik='$user' and user_email='$email' and user_id != '0001'");
	$cek 		= mysqli_num_rows($password);
	if($cek == 1){
		$data 			= mysqli_fetch_assoc($password);
		$id 			= $data['user_id'];
		$sql            = "UPDATE user SET 
		user_password   = '$pass' WHERE 
		user_id         = '$id'";
		$simpan = mysqli_query($conn, $sql);
		echo 1;
	}else{
		echo 0;
	}

# SETTING ------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'setting') {
	$id       = addslashes($_GET['id']);
	$phone    = addslashes($_POST['phone']);
	$email    = addslashes($_POST['email']);
	$sql            = "UPDATE user SET 
	user_phone      = '$phone',  
	user_email      = '$email' WHERE 
	user_id         = '$id'";
	$simpan = mysqli_query($conn, $sql);

}elseif ($_GET['action'] == 'setting_pass') {
	$id      = addslashes($_GET['id']);
	$pass    = addslashes(base64_encode($_POST['password']));
	$sql            = "UPDATE user SET 
	user_password   = '$pass' WHERE 
	user_id         = '$id'";
	$simpan = mysqli_query($conn, $sql);

# STATUS -------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'status') {
	$id       = addslashes($_GET['id']);
	$status   = addslashes($_POST['status']);
	$desc     = addslashes($_POST['desc']);
	$user     = addslashes($_GET['user']);

	// Image Validation
	$file_name	= $_FILES['img']['name'];
	$file_tmp	= $_FILES['img']['tmp_name'];
	$tgl		= date("ymdHis");
	if ( $file_name != '') {
		$filename   = $tgl.'-'.$file_name;
	} else {
		$filename   = '';
	}
	$lokasi 	= '../assets/hazard/'.$filename;
	move_uploaded_file($file_tmp, $lokasi);

	// Compress Image
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
	imagejpeg($thumb,'../assets/hazard/thumbnail/'.$filename);

	// Update Status Hazard
	$sql                = "UPDATE hazard SET 
	hazard_status       = '$status' WHERE 
	hazard_id           = '$id'";
	$simpan = mysqli_query($conn, $sql);

	// Insert Status Hazard
	$sql1		  = "INSERT INTO hazard_status (hazard_status_hazard, hazard_status_name, hazard_status_desc, hazard_status_photo, hazard_status_user) 
	VALUES ('$id', '$status','$desc','$filename','$user')";
	$simpan1      = mysqli_query($conn, $sql1);

# RATTING -------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'ratting') {
	$id       		= addslashes($_GET['id']);
	$ratting   		= addslashes($_POST['star']);
	$ratting_desc   = addslashes($_POST['desc']);

	// Image Validation
	$file_name	= $_FILES['file']['name'];
	$file_tmp	= $_FILES['file']['tmp_name'];
	$tgl		= date("ymdHis");
	if ( $file_name != '') {
		$filename   = $tgl.'-'.$file_name;
	} else {
		$filename   = '';
	}
	$lokasi 	= '../assets/hazard/'.$filename;
	move_uploaded_file($file_tmp, $lokasi);

	// Compress Image
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
	imagejpeg($thumb,'../assets/hazard/thumbnail/'.$filename);

	// Update Ratting Hazard
	$sql                 = "UPDATE hazard SET 
	hazard_ratting       = '$ratting', 
	hazard_ratting_desc  = '$ratting_desc',
	hazard_ratting_photo = '$filename' WHERE 
	hazard_id            = '$id'";
	$simpan = mysqli_query($conn, $sql);

// BOOKMARK ----------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'bookmark' and $_GET['act'] == 'save') {
	// Save Bookmark
	$id       = $_POST['id'];
	$user     = $_POST['user'];
	$sql      = "INSERT INTO bookmark (book_user, book_hazard) VALUES ('$user','$id')";
	$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

	// Delete Bookmark
}elseif ($_GET['action'] == 'bookmark' and $_GET['act'] == 'delete') {
	$id       = $_POST['id'];
	$user     = $_POST['user'];
	$sql	  = "DELETE FROM bookmark WHERE book_user = '$user' and book_hazard = '$id'";
	$simpan   = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

// HAZARD ----------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'hazard' and $_GET['act'] == 'add') {
// 	$disco     	= substr(addslashes($_POST['disco']),2);
// 	$disco_etc 	= addslashes($_POST['disco_etc']);
	$followup   = addslashes($_POST['followup']);
	$user       = addslashes($_GET['user']);
	$date       = addslashes($_POST['date']);
	$title      = addslashes($_POST['title']);
	$loc     	= addslashes($_POST['loc']);
	$loc_etc 	= addslashes($_POST['loc_etc']);
	$classi     = addslashes($_POST['classi']);
	$risk     	= addslashes($_POST['risk']);
	$comp     	= addslashes($_POST['comp']);
	$desc     	= addslashes($_POST['desc']);
	$solution   = addslashes($_POST['solution']);

	$datadiv = $_POST['divisi'];    
	$divisi  = substr($datadiv, strpos($datadiv, "-") + 1);
	$tgl		= date("ymdHis");

	// Followup Validation
	if ( $followup != '') {
		$fup 		  = 'Y';
		$status  	  = 'Open';
		$status_desc  = 'Sedang dilakukan review oleh PIC';
	} else {
		$fup 		  = '';
		$status       = 'Closed';
		$status_desc  = 'Telah diselesaikan langsung oleh pelapor';
	}

	// Image Validation
	$file_name	= $_FILES['image']['name'];
	$file_tmp	= $_FILES['image']['tmp_name'];
	if ( $file_name != '') {
		$filename   = $tgl.'-'.$file_name;
	} else {
		$filename   = '';
	}
	$lokasi 	= '../assets/hazard/'.$filename;
	move_uploaded_file($file_tmp, $lokasi);

	// Compress Image
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
	imagejpeg($thumb,'../assets/hazard/thumbnail/'.$filename);

    if($user != '') {
	// Insert Hazard
	$sql = "INSERT INTO hazard ( hazard_photo, hazard_user, hazard_name, hazard_date, hazard_loc, hazard_loc_etc, hazard_classi, hazard_risk, hazard_divisi, hazard_comp, hazard_desc, hazard_solution, hazard_followup, hazard_status) VALUES ('$filename', '$user', '$title','$date','$loc','$loc_etc','$classi','$risk','$divisi','$comp','$desc','$solution','$fup','$status')";
	$simpan = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}
	// Insert Hazard Status
	$hazard 	  = mysqli_fetch_array($conn->query("SELECT * FROM hazard order by hazard_id desc limit 1"));
	$sql1		  = "INSERT INTO hazard_status (hazard_status_hazard, hazard_status_user, hazard_status_name, hazard_status_desc) 
	VALUES (".$hazard['hazard_id'].", '$user', '$status', '$status_desc')";
	$simpan1      = mysqli_query($conn, $sql1);
    }

} elseif ($_GET['action'] == 'hazard' and $_GET['act'] == 'delete') {
	$id       = $_POST['id'];
	$user     = $_POST['user'];
	$sql	  = "DELETE FROM hazard  WHERE hazard_user = '$user' and hazard_id = '$id'";
	$simpan	  = mysqli_query($conn, $sql);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

	// Delete Hazard
	$sql1		  = "DELETE FROM bookmark WHERE book_user = '$user' and book_hazard = '$id'";
	$simpan1  	  = mysqli_query($conn, $sql1);

	// Delete Hazard Status
	$sql2		  = "DELETE FROM hazard_status WHERE hazard_status_hazard = '$id'";
	$simpan2  	  = mysqli_query($conn, $sql2);
}?>