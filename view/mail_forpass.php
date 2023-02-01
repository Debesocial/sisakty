<?php
include '../lib/PHPmail/classes/class.phpmailer.php';
include '../controller/connection.php';

@$email = $_POST['email'];
@$pass  = $_POST['pass'];

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
@$mail->Subject 	= "Change Password";
@$mail->AddAddress($email); 
@$mail->MsgHTML('

	<table border="0" cellpadding="1" cellspacing="1" style="width:478px">
	<tbody>
	<tr>
	<td style="width:468px"><img alt="" src="https://sisakty.mandiricoal.co.id/assets/img/mail.jpg" style="display:block; width:500px" /></td>
	</tr>
	<tr>
	<td style="width:468px">
	<p>Hi, Permintaan anda untuk mengubah password telah kami proses,<br />
	berikut password yang dapat anda gunakan untuk login ke aplikasi Sisakty</p>

	<p style="text-align:center"><span style="font-size:24px"><strong>'.$pass.'</strong></span></p>

	<p>Untuk menjaga keamanan akun, anda dapat mengganti password pada menu <em>profile &gt; ganti password</em>. jika ada pertanyaan mengenai aplikasi Sisakty, anda dapat membuka menu FAQ atau dapat menghubungi langsung admin Sisakty (Safety-MIP).</p>

	<p>Salam,<br />
	Tim IT Mandiricoal</p>
	</td>
	</tr>
	<tr>
	<td>
	<table align="center" border="0" cellpadding="0" cellspacing="0" style="width:500px">
	<tbody>
	<tr>
	<td style="text-align:center">
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

	<p>&nbsp;</p>



	');
@$mail->Send()
?>