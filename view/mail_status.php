<?php
include '../lib/PHPmail/classes/class.phpmailer.php';
include '../controller/connection.php';

@$id = $_GET['id'];
@$hz=mysqli_fetch_array($conn->query("SELECT * FROM view_hazard 
	INNER JOIN hazard ON hazard.hazard_id = view_hazard.hazard_id 
	INNER JOIN hazard_status ON hazard_status.hazard_status_hazard = view_hazard.hazard_id 
	INNER JOIN user ON user.user_id = view_hazard.user_id 
	WHERE view_hazard.hazard_id = '$id'
	ORDER BY  view_hazard.hazard_id DESC LIMIT 1"));
@$divisi = $hz['hazard_divisi'];
@$comp   = $hz['hazard_comp'];
@$userid = $hz['user_id'];
@$usr=mysqli_fetch_array($conn->query("SELECT * FROM user 
	LEFT JOIN level ON level.level_id = user.user_level
	LEFT JOIN departement ON departement.dept_id = user.user_dept
	LEFT JOIN divisi ON divisi.divisi_id = user.user_divisi
	LEFT JOIN company ON company.comp_id = user.user_comp 
	WHERE user.user_id = '$userid' 
	ORDER BY user.user_id DESC LIMIT 1"));

if(@$hz['hazard_loc_etc'] == '' ) {
	$location =  @$hz['loc_name'];
} else {
	$location = 'Lain-lain ('.$hz['hazard_loc_etc'].')';
}

@$mail = new PHPMailer; 
@$mail->IsSMTP();
@$mail->SMTPSecure 	= 'ssl'; 
@$mail->Host 		= "smtp.gmail.com"; 
@$mail->SMTPDebug 	= 2;
@$mail->Port 		= 465;
@$mail->SMTPAuth 	= true;
@$mail->Username 	= "mandiricoalapps@gmail.com"; 
@$mail->Password 	= "eededlbdzyoioycd";
@$mail->SetFrom("mandiricoalapps@gmail.com","Sisakty");
@$mail->Subject 	= "Hazard Report | HZ".str_pad($hz['hazard_id'],5,"0",STR_PAD_LEFT)."";
@$mail->AddAddress($hz['user_email']); 
// @$mail->AddAddress("debesocial@gmail.com"); 

@$mail->MsgHTML("

	<table align='' border='0' cellpadding='0' cellspacing='0' style='width:500px'>
	<tbody>
	<tr>
	<td style='width:553px'><img alt='' src='https://sisakty.mandiricoal.co.id/assets/img/mail.jpg' style='display:block; width:500px' /></td>
	</tr>
	<tr>
	<td style='width:553px'>
	<p>Laporan anda telah diproses oleh PIC, berikut detailnya :</p>

	<table border='0' cellpadding='1' cellspacing='1' style='width:500px'>
	<tbody>
	<tr>
	<td style='width:156px'><strong>Tanggal</strong></td>
	<td style='width:333px'>: ".$hz['hazard_date']."</td>
	</tr>
	<tr>
	<td style='width:156px'><strong>ID Hazard</strong></td>
	<td style='width:333px'>: HZ".str_pad($hz['hazard_id'],5,"0",STR_PAD_LEFT)."</td>
	</tr>
	<tr>
	<td style='width:156px'><strong>Judul</strong></td>
	<td style='width:333px'>: ".$hz['hazard_name']."</td>
	</tr>
	<tr>
	<td style='width:156px'><strong>Klasifikasi</strong></td>
	<td style='width:333px'>: ".$hz['classi_name']."</td>
	</tr>
	<tr>
	<td style='width:156px'><strong>Lokasi</strong></td>
	<td style='width:333px'>: ".$location."</td>
	</tr>
	<tr>
	<td style='width:156px'><strong>Risiko</strong></td>
	<td style='width:333px'>: ".$hz['risk_name']."</td>
	</tr>
	<tr>
	<td style='width:156px'><strong>PIC</strong></td>
	<td style='width:333px'>: ".$hz['divisi_name']." - ".$hz['comp_name']."</td>
	</tr>
	<tr>
	<td style='width:156px'><strong>Uraian</strong></td>
	<td style='width:333px'>: ".$hz['hazard_desc']."</td>
	</tr>
	<tr>
	<td style='width:156px'><strong>Saran</strong></td>
	<td style='width:333px'>: ".$hz['hazard_solution']."</td>
	</tr>
	<tr>
	<td style='width:156px'><strong>Status</strong></td>
	<td style='width:333px'>: <b>".$hz['hazard_status']."</b></td>
	</tr>
	<tr>
	<td style='width:156px'><strong>Deskripsi</strong></td>
	<td style='width:333px'>: <b>".$hz['hazard_status_desc']."</b></td>
	</tr>
	</tbody>
	</table>

	<p>Data Pelapor :</p>

	<table border='0' cellpadding='1' cellspacing='1' style='width:500px'>
	<tbody>
	<tr>
	<td style='width:156px'><strong>Nama</strong></td>
	<td style='width:333px'>: ".$usr['user_name']."</td>
	</tr>
	<tr>
	<td style='width:156px'><strong>Divisi</strong></td>
	<td style='width:333px'>: ".$usr['divisi_name']."</td>
	</tr>
	<tr>
	<td style='width:156px'><strong>Perusahaan</strong></td>
	<td style='width:333px'>: ".$usr['comp_name']."</td>
	</tr>
	</tbody>
	</table>

	<p>Untuk melihat dokumen silahkan login ke aplikasi Sisakty di Mobile Apps</p>

	<p>Salam,<br />
	Tim IT Mandiri Coal</p>
	</td>
	</tr>
	<tr>
	<td>
	<table align='center' border='0' cellpadding='0' cellspacing='0' style='width:500px'>
	<tbody>
	<tr>
	<td style='text-align:center'>
	<hr />
	<p>Ini adalah&nbsp;<em>email</em>&nbsp;otomatis. Mohon untuk tidak membalas&nbsp;<em>email</em>&nbsp;ini.<br />
	Copyright mandiricoal.co.id 2021</p>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>



	");
@$mail->Send()
?>