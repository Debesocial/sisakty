<?php
include "classes/class.phpmailer.php";
@$mail = new PHPMailer; 
@$mail->IsSMTP();
@$mail->SMTPSecure = 'ssl'; 
@$mail->Host = "smtp.gmail.com"; //host masing2 provider email
@$mail->SMTPDebug = 2;
@$mail->Port = 465;
@$mail->SMTPAuth = true;
@$mail->Username = "mandiricoalapps@gmail.com"; //user email
@$mail->Password = "eededlbdzyoioycd"; //password email 
@$mail->SetFrom("mandiricoalapps@gmail.com","PayDay Apps"); //set email pengirim
@$mail->Subject = "Pengajuan Document Approval"; //subyek email
@$mail->AddAddress("andikadebiputra@gmail.com","dika");  //tujuan email
@$mail->MsgHTML("Testing...");
if(@$mail->Send()) 
header('Location: http://office.mandiricoal.co.id');
?>