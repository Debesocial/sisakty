<?php 
@session_start();
include '../../../controller/connection.php';

if($_GET['action'] == 'visitor' ){
	@$idcard    	= addslashes($_POST['idcard']);
	@$name     		= addslashes($_POST['name']);
	@$company    	= addslashes($_POST['company']);
	@$phone    	  	= addslashes($_POST['phone']);
	@$needs    	  	= addslashes($_POST['needs']);
	@$end    	  	= addslashes($_POST['end']);
	@$tgl		    = date("His");

	if ($_FILES['ktp']['name'] != ''){
		@$ktp			= $tgl.'-'.$_FILES['ktp']['name'];
		@$ktp_tmp		= $_FILES['ktp']['tmp_name'];
		$ktp_lokasi 		= '../../../assets/visitor/KTP/'.$ktp;
		move_uploaded_file($ktp_tmp, $ktp_lokasi);
	}

	if ($_FILES['suratizin']['name'] != ''){
		@$suratizin		= $tgl.'-'.$_FILES['suratizin']['name'];
		@$suratizin_tmp	= $_FILES['suratizin']['tmp_name'];
		$suratizin_lokasi 	= '../../../assets/visitor/SURATIJIN/'.$suratizin;
		move_uploaded_file($suratizin_tmp, $suratizin_lokasi);
	}

	if ($_FILES['photo']['name'] != ''){
		@$photo			= $tgl.'-'.$_FILES['photo']['name'];
		@$photo_tmp		= $_FILES['photo']['tmp_name'];
		$photo_lokasi 		= '../../../assets/visitor/FOTO/'.$photo;
		move_uploaded_file($photo_tmp, $photo_lokasi);
	}

	if($_GET['act'] == 'add') {
		$sql      = "INSERT INTO visitor (visitor_no, visitor_name, visitor_company, visitor_phone, visitor_needs, visitor_identity, visitor_permission, visitor_photo, visitor_end, visitor_status) VALUES ('$idcard','$name','$company','$phone','$needs','$ktp','$suratizin','$photo','$end', 'Aktif')";

		$sqls            = "UPDATE visitor_status SET 
		visitor_status_name	= 'Aktif' WHERE 
		visitor_status_no		= '$idcard'";

	}elseif($_GET['act'] == 'nonaktif') {
		$no 			= $_POST['no'];
		$sql            = "UPDATE visitor_status SET 
		visitor_status_name    = 'nonaktif' WHERE 
		visitor_status_no        = '$no'";

		$sqls            = "UPDATE visitor SET 
		visitor_status    = 'nonaktif' WHERE 
		visitor_no        = '$no'";

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
	@$tanggal_approve 	= date('Y-m-d H:i:s');

	if($_GET['act'] == 'approve') {
		$id 					= $_POST['id'];
		$sql            		= "UPDATE mpermit SET 
		mpermit_approval_ktt    = 'Approve', 
		mpermit_approval_ktt_date    = '$tanggal_approve',
		mpermit_status_approval = 'Closed',
		mpermit_status_active   = 'Verified' WHERE 
		mpermit_id         		= '$id'";
		@$simpan   = mysqli_query($conn, $sql);
		
		$mpermit_id  = mysqli_fetch_array($conn->query("SELECT * FROM mpermit WHERE mpermit_id = '$id' order by mpermit_id"));
		$sqls = "INSERT INTO mpermit_status (mpermit_status_mpermit, mpermit_status_user, mpermit_status_name, mpermit_status_desc, mpermit_status_by) VALUES ('$id','".$mpermit_id['mpermit_user']."','Closed','Pengajuan Mine Permit Disetujui KTT','KTT')";
		@$simpans   = mysqli_query($conn, $sqls);
		
	}elseif($_GET['act'] == 'reject') {
		$id 					= $_POST['id'];
		$reason					= $_POST['reason'];
		$sql            		= "UPDATE mpermit SET 
		mpermit_approval_ktt    = 'Reject',
		mpermit_approval_ktt_date    = '$tanggal_approve',
		mpermit_status_approval = 'Reject' WHERE 
		mpermit_id         		= '$id'";
		@$simpan   = mysqli_query($conn, $sql);

		$mpermit_id  = mysqli_fetch_array($conn->query("SELECT * FROM mpermit WHERE mpermit_id = '$id' order by mpermit_id"));
		$sqls = "INSERT INTO mpermit_status (mpermit_status_mpermit, mpermit_status_user, mpermit_status_name, mpermit_status_desc, mpermit_status_by) VALUES ('$id','".$mpermit_id['mpermit_user']."','Reject','".$reason."','KTT')";
		@$simpans   = mysqli_query($conn, $sqls);
	}

	if($simpan) {
		echo 1;
	}else{
		echo 0;
	}
}?>