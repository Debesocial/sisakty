<?php
// $conn = mysqli_connect("localhost","root","","sisakty_prod");
$conn = mysqli_connect("mandiricoal.net","mandiricoal","Mandiricoal2022!","sisakty");
// $conn = mysqli_connect("mandiricoal.co.id","mipadmin","S3n0p4t!","sisakty_prod");
date_default_timezone_set('Asia/Jakarta');
if (mysqli_connect_errno()){
	echo "Filed Conncection : " . mysqli_connect_error();
}?>