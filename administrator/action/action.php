<?php 
@session_start();
include '../../controller/connection.php';

// LOGIN -------------------------------------------------------------------------------------------------------------------------------------
if($_GET['action'] == 'login') {

// menangkap data yang dikirim dari form login
	$user 	  = $_POST['user'];
	$password = base64_encode($_POST['password']);

	if($_POST['loginas'] == 'Administrator'){
		$login = mysqli_query($conn,"SELECT * FROM user 
			WHERE user_nik			='$user' 
			AND user_password		='$password' 
			AND user_pic 			= 'STY'");

	}elseif ($_POST['loginas'] == 'Safety') {
		$login = mysqli_query($conn,"SELECT * FROM user 
			LEFT JOIN divisi ON divisi.divisi_id = user.user_divisi
			WHERE user.user_nik		= '$user' 
			AND user.user_password	= '$password' 
			AND user.user_pic 		= 'Y'
			AND divisi.divisi_name  = 'HSE'");

	}elseif ($_POST['loginas'] == 'PIC') {
		$login = mysqli_query($conn,"SELECT * FROM user 
			WHERE user_nik			= '$user' 
			AND user_password		= '$password' 
			AND user_pic 			= 'Y'");

	}elseif ($_POST['loginas'] == 'KTT') {
		$login = mysqli_query($conn,"SELECT * FROM user 
			WHERE user_nik			= '$user' 
			AND user_password		= '$password' 
			AND user_pic 			= 'KTT'");

	}elseif ($_POST['loginas'] == 'Resepsionis') {
		$login = mysqli_query($conn,"SELECT * FROM user 
			WHERE user_nik			= '$user' 
			AND user_password		= '$password' 
			AND user_pic 			= 'RES'");
	}

// menghitung jumlah data yang ditemukan
	$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
	if($cek > 0){
		$data = mysqli_fetch_assoc($login);
		$_SESSION['login'] 	    		= 'Y';
		$_SESSION['loginas'] 	    	= $_POST['loginas'];
		$_SESSION['user_email'] 	    = $email;
		$_SESSION['user_password'] 		= $password;
		$_SESSION['user_id'] 			= $data['user_id'];
		$_SESSION['user_nik'] 			= $data['user_nik'];
		$_SESSION['user_level'] 		= $data['user_level'];
		$_SESSION['user_name'] 			= $data['user_name'];
		$_SESSION['user_pic'] 			= $data['user_pic'];
		$_SESSION['user_divisi'] 		= $data['user_divisi'];
		$_SESSION['user_comp'] 			= $data['user_comp'];
		echo 1;
	}else{
		echo 0;
	}

	// MASTER USER ---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'user' ) {
	@$nik    	  	= addslashes($_POST['nik']);
	@$password     	= addslashes(base64_encode($_POST['password']));
	@$name    	  	= addslashes($_POST['name']);
	@$birth    	  	= addslashes($_POST['birth']);
	@$phone    	  	= addslashes($_POST['phone']);
	@$email    	  	= addslashes($_POST['email']);
	@$onsite    	= addslashes($_POST['onsite']);
	@$comp   	  	= addslashes($_POST['comp']);
	@$access   	  	= addslashes($_POST['access']);

	@$datalevel = $_POST['level'];    
	@$level  = substr($datalevel, strpos($datalevel, "-") + 1); 

	@$datadept = $_POST['dept'];    
	@$dept  = substr($datadept, strpos($datadept, "-") + 1); 

	@$datadiv = $_POST['divisi'];    
	@$divisi  = substr($datadiv, strpos($datadiv, "-") + 1);

	@$status    	= addslashes($_POST['status']);
	@$pic    	    = addslashes($_POST['pic']);

    # User PIC
	// @$loginas    	 = addslashes($_POST['loginas']);
	// if($loginas == 'pic'){
	// 	$sebagai = 'Y';
	// }elseif($loginas == 'resepsionis'){
	// 	$sebagai = 'RES';
	// }elseif($loginas == 'ktt'){
	// 	$sebagai = 'KTT';
	// }

    # User PIC
	if ($pic != '') {
		$pic = 'Y';
	}else {
		$pic = '';
	}
	
    # User PIC
	if ($access != '') {
		$access = 'Y';
	}else {
		$access = '';
	}

	if($_GET['act'] == 'add') {
		$sql      = "INSERT INTO user (user_nik, user_password, user_name, user_birth, user_phone, user_email, user_onsite, user_level,user_dept, user_divisi, user_comp, user_status, user_access, user_pic ) VALUES ('$nik','$password','$name','$birth','$phone','$email','$onsite','$level','$dept','$divisi','$comp','$status','$access','$pic')";
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
		user_access		= '$access',
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

	// TRANSACT HAZARD---------------------------------------------------------------------------------------------------------------------------
}elseif ($_GET['action'] == 'hazard_pic' ) {
	@$id 		    = $_GET['id'];
	@$comp          = addslashes($_POST['comp']);
	@$datadiv 		= $_POST['divisi'];    
	@$divisi 		= substr($datadiv, strpos($datadiv, "-") + 1);

	$sql           = "UPDATE hazard SET
	hazard_comp    = '$comp',
	hazard_divisi  = '$divisi' WHERE 
	hazard_id      = '$id'";

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

}elseif($_GET['action'] == 'visitor' ){
	@$idcard    	= addslashes($_POST['idcard']);
	@$name     		= addslashes($_POST['name']);
	@$company    	= addslashes($_POST['company']);
	@$phone    	  	= addslashes($_POST['phone']);
	@$needs    	  	= addslashes($_POST['needs']);
	@$end    	  	= addslashes($_POST['end']);
	@$tanggal		= date("Y-m-d");
	@$tgl		    = date("His");

	if ($_FILES['ktp']['name'] != ''){
		@$ktp			= $tgl.'-'.$_FILES['ktp']['name'];
		@$ktp_tmp		= $_FILES['ktp']['tmp_name'];
		$ktp_lokasi 		= '../../assets/visitor/KTP/'.$ktp;
		move_uploaded_file($ktp_tmp, $ktp_lokasi);
	}

	if ($_FILES['suratizin']['name'] != ''){
		@$suratizin		= $tgl.'-'.$_FILES['suratizin']['name'];
		@$suratizin_tmp	= $_FILES['suratizin']['tmp_name'];
		$suratizin_lokasi 	= '../../assets/visitor/SURATIJIN/'.$suratizin;
		move_uploaded_file($suratizin_tmp, $suratizin_lokasi);
	}

	if ($_FILES['photo']['name'] != ''){
		@$photo			= $tgl.'-'.$_FILES['photo']['name'];
		@$photo_tmp		= $_FILES['photo']['tmp_name'];
		$photo_lokasi 		= '../../assets/visitor/FOTO/'.$photo;
		move_uploaded_file($photo_tmp, $photo_lokasi);
	}

	if($_GET['act'] == 'add') {
		$sql      = "INSERT INTO visitor (visitor_no, visitor_name, visitor_company, visitor_phone, visitor_needs, visitor_identity, visitor_permission, visitor_photo, visitor_date, visitor_end, visitor_status) VALUES ('$idcard','$name','$company','$phone','$needs','$ktp','$suratizin','$photo','$tanggal','$end', 'Aktif')";

		$sqls            	= "UPDATE visitor_status SET 
		visitor_status_name	= 'Aktif' WHERE 
		visitor_status_no	= '$idcard'";

	}elseif($_GET['act'] == 'nonaktif') {
		$no 				= $_POST['no'];
		$sql            	= "UPDATE visitor_status SET 
		visitor_status_name = 'nonaktif' WHERE 
		visitor_status_no   = '$no'";

		$sqls            	= "UPDATE visitor SET 
		visitor_status    	= 'nonaktif' WHERE 
		visitor_no        	= '$no'";

	}elseif($_GET['act'] == 'edit') {
		$visitor 	= mysqli_fetch_array($conn->query("SELECT * FROM visitor WHERE visitor.visitor_id = ".$_POST['id'].""));
		if ($_FILES['suratizin']['name'] == '') { $suratizin 	= $visitor['visitor_permission']; }
		if ($_FILES['photo']['name'] == '') { $photo 			= $visitor['visitor_photo']; }
		if ($_FILES['ktp']['name'] == '') { $ktp 				= $visitor['visitor_identity']; }

		$sql            	= "UPDATE visitor SET 
		visitor_no 			= '$idcard',
		visitor_name 		= '$name',
		visitor_company 	= '$company',
		visitor_phone 		= '$phone',
		visitor_needs 		= '$needs',
		visitor_identity 	= '$ktp',
		visitor_permission 	= '$suratizin',
		visitor_photo 		= '$photo',
		visitor_end			= '$end' WHERE 
		visitor_id          = ".$_POST['id']."";
	}

	@$simpan   = mysqli_query($conn, $sql);
	@$simpans   = mysqli_query($conn, $sqls);
	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}

} elseif($_GET['action'] == 'mpermit' ){
	@$pic    		= addslashes($_POST['pic']);
	@$user    		= explode("|",$_POST['user']);
	@$user_id    	= $user[0];
	@$status    	= addslashes($_POST['status']);
	@$status_desc   = addslashes($_POST['status_desc']);

	if($_POST['kategori'] == 'Karyawan'){
		$berlaku = '0000-00-00';
	} else {
		@$berlaku= addslashes($_POST['berlaku']);
	}

	@$kategori      = addslashes($_POST['kategori']);
	@$kantor    	= addslashes($_POST['kantor']);
	@$tambang    	= addslashes($_POST['tambang']);
	@$mess    		= addslashes($_POST['mess']);
	@$bengkel    	= addslashes($_POST['bengkel']);
	@$cpp    		= addslashes($_POST['cpp']);
	@$laboratorium  = addslashes($_POST['laboratorium']);
	@$eksplorasi    = addslashes($_POST['eksplorasi']);
	@$pelabuhan    	= addslashes($_POST['pelabuhan']);
	@$tgl		    = date("His");
	@$tanggal    	= date('Y-m-d');
	@$approve_date 	= date('Y-m-d H:i:s');

	if ($_FILES['idcard']['name'] != ''){
		@$idcard		= $tgl.'-'.$_FILES['idcard']['name'];
		@$idcard_tmp	= $_FILES['idcard']['tmp_name'];
		$idcard_lokasi 	= '../../assets/minepermit/KTP/'.$idcard;
		move_uploaded_file($idcard_tmp, $idcard_lokasi);
	} else {
		@$idcard = addslashes($_POST['idcards']);
	}

	if ($_FILES['skd']['name'] != ''){
		@$skd			= $tgl.'-'.$_FILES['skd']['name'];
		@$skd_tmp		= $_FILES['skd']['tmp_name'];
		$skd_lokasi 	= '../../assets/minepermit/SKD/'.$skd;
		move_uploaded_file($skd_tmp, $skd_lokasi);
	} else {
		@$skd = addslashes($_POST['skds']);
	}

	if ($_FILES['foto']['name'] != ''){
		@$foto			= $tgl.'-'.$_FILES['foto']['name'];
		@$foto_tmp		= $_FILES['foto']['tmp_name'];
		$foto_lokasi 		= '../../assets/minepermit/FOTO/'.$foto;
		move_uploaded_file($foto_tmp, $foto_lokasi);
	} else {
		@$foto = addslashes($_POST['fotos']);
	}

	if ($_FILES['suratijin']['name'] != ''){
		@$suratijin			= $tgl.'-'.$_FILES['suratijin']['name'];
		@$suratijin_tmp		= $_FILES['suratijin']['tmp_name'];
		$suratijin_lokasi 	= '../../assets/minepermit/SURATIJIN/'.$suratijin;
		move_uploaded_file($suratijin_tmp, $suratijin_lokasi);
	} else {
		@$suratijin	= addslashes($_POST['suratijins']);
	}

	if ($_FILES['beritaacara']['name'] != ''){
		@$beritaacara			= $tgl.'-'.$_FILES['beritaacara']['name'];
		@$beritaacara_tmp		= $_FILES['beritaacara']['tmp_name'];
		$beritaacara_lokasi 	= '../../assets/minepermit/BERITAACARA/'.$beritaacara;
		move_uploaded_file($beritaacara_tmp, $beritaacara_lokasi);
	} else {
		@$beritaacara = addslashes($_POST['beritaacaras']);
	}

	if($_GET['act'] == 'add') {
		$sql = "INSERT INTO mpermit (
		mpermit_pic, 
		mpermit_user, 
		mpermit_categories, 
		mpermit_status, 
		mpermit_status_desc, 
		mpermit_enddate, 
		mpermit_office, 
		mpermit_mine, 
		mpermit_camp,
		mpermit_workshop, 
		mpermit_cpp, 
		mpermit_lab, 
		mpermit_exploration,
		mpermit_jetty, 
		mpermit_skd,
		mpermit_idcard, 
		mpermit_photo, 
		mpermit_date, 
		mpermit_status_approval, 
		mpermit_suratijin, 
		mpermit_beritaacara, 
		mpermit_approval_safety, 
		mpermit_submitter) 

		VALUES (
		'$pic',
		'$user_id', 
		'$kategori',
		'$status',
		'$status_desc',
		'$berlaku',
		'$kantor',
		'$tambang',
		'$mess',
		'$bengkel',
		'$cpp',
		'$laboratorium', 
		'$eksplorasi', 
		'$pelabuhan', 
		'$skd', 
		'$idcard', 
		'$foto', 
		'$tanggal', 
		'Progress', 
		'$suratijin', 
		'$beritaacara',
		'Approve',
		'Safety MIP')";
		@$simpan   = mysqli_query($conn, $sql);

		$mpermit_id  = mysqli_fetch_array($conn->query("SELECT * FROM mpermit order by mpermit_id desc limit 1"));
		$mpermit_ids = $mpermit_id['mpermit_id'];
		$sqls = "INSERT INTO mpermit_status (mpermit_status_mpermit, mpermit_status_user, mpermit_status_name, mpermit_status_desc) VALUES ('$mpermit_ids','$user_id','Progress','Menunggu Approval KTT')";
		@$simpans   = mysqli_query($conn, $sqls);

	}elseif($_GET['act'] == 'edit') {
		$sql            		= "UPDATE mpermit SET 
		mpermit_status 			= '$status',
		mpermit_categories 		= '$kategori',
		mpermit_status_desc 	= '$status_desc',
		mpermit_enddate		 	= '$berlaku',
		mpermit_office			= '$kantor',
		mpermit_mine 			= '$tambang',
		mpermit_camp			= '$mess',
		mpermit_workshop 		= '$bengkel',
		mpermit_cpp				= '$cpp',
		mpermit_lab				= '$laboratorium',
		mpermit_exploration		= '$eksplorasi',
		mpermit_jetty			= '$pelabuhan',
		mpermit_skd				= '$skd',
		mpermit_idcard			= '$idcard',
		mpermit_photo			= '$foto',
		mpermit_date			= '$tanggal',
		mpermit_suratijin		= '$suratijin',
		mpermit_beritaacara		= '$beritaacara' WHERE 
		mpermit_id              = ".$_POST['id']."";
		@$simpan   = mysqli_query($conn, $sql);

	}elseif($_GET['act'] == 'approve') {
		$id 					= $_POST['id'];
		$sql            		= "UPDATE mpermit SET 
		mpermit_approval_safety = 'Approve',
		mpermit_status_approval = 'Progress',
		mpermit_status_active   = 'Not Verified' WHERE
		mpermit_id         		= '$id'";
		@$simpan   = mysqli_query($conn, $sql);

		$mpermit_id  = mysqli_fetch_array($conn->query("SELECT * FROM mpermit WHERE mpermit_id = '$id'"));
		$sqls = "INSERT INTO mpermit_status (mpermit_status_mpermit, mpermit_status_user, mpermit_status_name, mpermit_status_desc, mpermit_status_by) VALUES ('$id','".$mpermit_id['mpermit_user']."','Progress','Menunggu Approval KTT','Safety MIP')";
		@$simpans   = mysqli_query($conn, $sqls);

	}elseif($_GET['act'] == 'reject') {
		$id 					= $_POST['id'];
		$reason					= $_POST['reason'];
		$sql            		= "UPDATE mpermit SET 
		mpermit_approval_safety = 'Reject',
		mpermit_status_approval = 'Reject' WHERE 
		mpermit_id         		= '$id'";
		@$simpan   = mysqli_query($conn, $sql);

		$mpermit_id  = mysqli_fetch_array($conn->query("SELECT * FROM mpermit WHERE mpermit_id = '$id'"));
		$sqls = "INSERT INTO mpermit_status (mpermit_status_mpermit, mpermit_status_user, mpermit_status_name, mpermit_status_desc, mpermit_status_by) VALUES ('$id','".$mpermit_id['mpermit_user']."','Reject','".$reason."','Safety MIP')";
		@$simpans   = mysqli_query($conn, $sqls);

	}elseif($_GET['act'] == 'cancel') {
		$id 					= $_POST['id'];
		$reason					= $_POST['reason'];
		$sql            		= "UPDATE mpermit SET 
		mpermit_approval_safety = 'Cancel',
		mpermit_status_approval = 'Cancel' WHERE 
		mpermit_id         		= '$id'";
		@$simpan   = mysqli_query($conn, $sql);

		$mpermit_id  = mysqli_fetch_array($conn->query("SELECT * FROM mpermit where mpermit_id = '$id'"));
		$sqls = "INSERT INTO mpermit_status (mpermit_status_mpermit, mpermit_status_user, mpermit_status_name, mpermit_status_desc, mpermit_status_by) VALUES ('".$mpermit_id['mpermit_id']."','".$mpermit_id['mpermit_user']."','Cancel','".$reason."','Safety MIP')";
		@$simpans   = mysqli_query($conn, $sqls);
	}

	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}
}?>