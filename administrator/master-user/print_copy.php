<?php
// if (isset($_POST['submit'])) {

include '../../controller/connection.php';
require_once('fpdf/Code39.php');

@$id =  base64_decode($_GET['mP']);
@$minepermit = mysqli_fetch_array($conn->query("SELECT * FROM mpermit 
	LEFT JOIN user on user.user_id = mpermit.mpermit_user
	LEFT JOIN level on level.level_id = user.user_level
	LEFT JOIN company on company.comp_id = user.user_comp
	WHERE mpermit.mpermit_id = ".$id."")); 

$pdf = new FPDF('L', 'mm', array(120, 200));
$pdf->AddPage();
$pdf->SetTextColor(29);
$pdf->SetXY(33, 25);
$pdf->Image('../../assets/images/BACKGROUNDS.jpg', 30, 10, 140, 90);
$pdf->Image('../../assets/minepermit/FOTO/'.$minepermit['mpermit_photo'], $pdf->GetX(), $pdf->GetY(), 15);
$pdf->SetXY(33, 46);
$pdf->SetFont('Arial', 'B', 4);
$pdf->Multicell(15, 3, $minepermit['user_status'], 1, "C");

// HEADER FRONT
$pdf->SetDrawColor(29);
$pdf->SetFont('Arial', 'B', 7);
$pdf->SetXY(48, 12);
$pdf->Cell(44, 7, 'MINE PERMIT CARD', 0, 4, 'L');
$pdf->SetFont('Arial', '', 5);
$pdf->SetXY(48, 14.5);
$pdf->Cell(29.5, 7, 'PT. MANDIRI INTIPERKASA, SITE KRASSI', 0, 4, 'L');
$pdf->SetXY(48, 17);
$pdf->Cell(48, 7, 'SEMBAKUNG - NUNUKAN - KALTARA', 0, 4, 'L');
$pdf->Line(33, 22.5, 84, 22.5);

// DETAIL INFORMATION
$pdf->SetFont('Arial', 'B', 5);
$pdf->SetXY(50, 22);
$pdf->Cell(29.5, 7, 'Nama :', 0, 4, 'L');
$pdf->SetXY(50, 27);
$pdf->Cell(29.5, 7, 'Position :', 0, 4, 'L');
$pdf->SetXY(50, 32);
$pdf->Cell(29.5, 7, 'Company :', 0, 4, 'L');
$pdf->SetXY(50, 37);
$pdf->Cell(29.5, 7, 'Date of Hire :', 0, 4, 'L');
$pdf->SetXY(50, 42);
$pdf->Cell(29.5, 7, 'No. Induk Pegawai :', 0, 4, 'L');

$pdf->SetFont('Arial', '', 5);
$pdf->SetXY(50, 24.5);
$pdf->Cell(29.5, 7, $minepermit['user_name'], 0, 4, 'L');
$pdf->SetXY(50, 29.5);
$pdf->Cell(29.5, 7, $minepermit['level_name'], 0, 4, 'L');
$pdf->SetXY(50, 34.5);
$pdf->Cell(29.5, 7, $minepermit['comp_name'], 0, 4, 'L');
$pdf->SetXY(50, 39.5);
$pdf->Cell(29.5, 7, $minepermit['user_onsite'], 0, 4, 'L');
$pdf->SetXY(50, 44.5);
$pdf->Cell(29.5, 7, $minepermit['user_nik'], 0, 4, 'L');

// TABLE AREAS
$pdf->SetFont('Arial', '', 5);
$pdf->SetDrawColor(0, 29, 29);
$pdf->SetTextColor(29);
$pdf->SetXY(33, 55);
$x = $pdf->GetX();
$pdf->SetFont('Arial', 'B', 5);
$pdf->Cell(20, 5, 'Mine Permit Area', 1, 0);
$pdf->Cell(9, 5, 'Status', 1, 1);
$pdf->SetFont('Arial', '', 5);

#############################################################################################################
if ($minepermit['mpermit_office'] == 'forbiden'){
	$pdf->setFillColor(240,128,128);
}elseif($minepermit['mpermit_office'] == 'rest'){
	$pdf->setFillColor(255,215,0);
}else{
	$pdf->setFillColor(0,250,154);
}
$pdf->SetX($x);
$pdf->Cell(20, 3, 'Office Area', 1, 0);
$pdf->Cell(9, 3, $minepermit['mpermit_office'], 1, 1,'L',TRUE);

#############################################################################################################
if ($minepermit['mpermit_mine'] == 'forbiden'){
	$pdf->setFillColor(240,128,128);
}elseif($minepermit['mpermit_mine'] == 'rest'){
	$pdf->setFillColor(255,215,0);
}else{
	$pdf->setFillColor(0,250,154);
}
$pdf->SetX($x);
$pdf->Cell(20, 3, 'Mine Area', 1, 0);
$pdf->Cell(9, 3, $minepermit['mpermit_mine'], 1, 1,'L',TRUE);

#############################################################################################################
if ($minepermit['mpermit_camp'] == 'forbiden'){
	$pdf->setFillColor(240,128,128);
}elseif($minepermit['mpermit_camp'] == 'rest'){
	$pdf->setFillColor(255,215,0);
}else{
	$pdf->setFillColor(0,250,154);
}
$pdf->SetX($x);
$pdf->Cell(20, 3, 'Camp Area', 1, 0);
$pdf->Cell(9, 3, $minepermit['mpermit_camp'], 1, 1,'L',TRUE);

#############################################################################################################
if ($minepermit['mpermit_workshop'] == 'forbiden'){
	$pdf->setFillColor(240,128,128);
}elseif($minepermit['mpermit_workshop'] == 'rest'){
	$pdf->setFillColor(255,215,0);
}else{
	$pdf->setFillColor(0,250,154);
}
$pdf->SetX($x);
$pdf->Cell(20, 3, 'Workshop Area', 1, 0);
$pdf->Cell(9, 3, $minepermit['mpermit_workshop'], 1, 1,'L',TRUE);

#############################################################################################################
if ($minepermit['mpermit_cpp'] == 'forbiden'){
	$pdf->setFillColor(240,128,128);
}elseif($minepermit['mpermit_cpp'] == 'rest'){
	$pdf->setFillColor(255,215,0);
}else{
	$pdf->setFillColor(0,250,154);
}
$pdf->SetX($x);
$pdf->Cell(20, 3, 'CPP, Washing Area', 1, 0);
$pdf->Cell(9, 3, $minepermit['mpermit_cpp'], 1, 1,'L',TRUE);

#############################################################################################################
if ($minepermit['mpermit_lab'] == 'forbiden'){
	$pdf->setFillColor(240,128,128);
}elseif($minepermit['mpermit_lab'] == 'rest'){
	$pdf->setFillColor(255,215,0);
}else{
	$pdf->setFillColor(0,250,154);
}
$pdf->SetX($x);
$pdf->Cell(20, 3, 'Laboratorium Area', 1, 0);
$pdf->Cell(9, 3, $minepermit['mpermit_lab'], 1, 1,'L',TRUE);

#############################################################################################################
if ($minepermit['mpermit_exploration'] == 'forbiden'){
	$pdf->setFillColor(240,128,128);
}elseif($minepermit['mpermit_exploration'] == 'rest'){
	$pdf->setFillColor(255,215,0);
}else{
	$pdf->setFillColor(0,250,154);
}
$pdf->SetX($x);
$pdf->Cell(20, 3, 'Explorasi Area', 1, 0);
$pdf->Cell(9, 3, $minepermit['mpermit_exploration'], 1, 1,'L',TRUE);

#############################################################################################################
if ($minepermit['mpermit_jetty'] == 'forbiden'){
	$pdf->setFillColor(240,128,128);
}elseif($minepermit['mpermit_jetty'] == 'rest'){
	$pdf->setFillColor(255,215,0);
}else{
	$pdf->setFillColor(0,250,154);
}$pdf->SetX($x);
$pdf->Cell(20, 3, 'Port Area', 1, 0);
$pdf->Cell(9, 3, $minepermit['mpermit_jetty'], 1, 1,'L',TRUE);

// SIGNATURE
$pdf->SetXY(65, 50);
$pdf->Cell(9.5, 7, date('d F Y'), 0, 4, 'L');
$pdf->SetFont('Arial', 'B', 5);
$pdf->SetXY(64, 55);
$pdf->Image('../../assets/images/TTD Pak Robby.png', 64, 50, 22, 22);


$pdf->Multicell(20, 3, "\n\n\n\nM. Robert Boro\n ", 1, "C");
$pdf->SetFont('Arial', '', 4);
$pdf->SetXY(65.5, 67);
$pdf->Cell(9, 7, "Kepala Teknik Tambang", 0, 4, 'L');

// FOOTER
$pdf->SetFont('Arial', 'I', 4);
$pdf->SetXY(41, 90);
$pdf->Cell(31.5, 7, '     *ONLY USED ON COAL MINING AREAS PT. MIP', 0, 4, 'L');

// HEADER BACK
$pdf->SetDrawColor(29);
$pdf->SetTextColor(29);
$pdf->SetFont('Arial', '', 7);
$pdf->SetXY(128, 12);
$pdf->Cell(44, 7, 'KETENTUAN-KETENTUAN', 0, 4, 'L');
$pdf->SetFont('Arial', '', 7);
$pdf->SetXY(131, 15);
$pdf->Cell(44, 7, 'MINE PERMIT CARD', 0, 4, 'L');
$pdf->Line(116.5, 21, 167, 21);

$pdf->SetFont('Arial', '', 4.5);
$pdf->SetXY(122, 22);
$pdf->Cell(9.5, 7, "1. Mine Permit Card berfungsi sebagai Kartu Tanda Pengenal", 0, 4, 'L');
$pdf->SetXY(122, 25);
$pdf->Cell(9.5, 7, "    seluruh karyawan & tamu yang bekerja di Area Tambang", 0, 4, 'L');
$pdf->SetXY(122, 28);
$pdf->Cell(9.5, 7, "    PT. MIP", 0, 4, 'L');

$pdf->SetXY(122, 33);
$pdf->Cell(9.5, 7, "2. Mine Permit Card sekaligus berfungsi sebagai Pass Kartu ", 0, 4, 'L');
$pdf->SetXY(122, 36);
$pdf->Cell(9.5, 7, "    Tanda Masuk Dermaga Krassi, Dermaga Lagub dan Area", 0, 4, 'L');
$pdf->SetXY(122, 39);
$pdf->Cell(9.5, 7, "    tambang PT. MIP", 0, 4, 'L');

$pdf->SetXY(122, 44);
$pdf->Cell(9.5, 7, "3. Mine Permit Card wajib dipakai pada saat berada di Area ", 0, 4, 'L');
$pdf->SetXY(122, 47);
$pdf->Cell(9.5, 7, "    Tambang PT. MIP", 0, 4, 'L');

$pdf->SetXY(122, 52);
$pdf->Cell(9.5, 7, "4. Mine Permit Card tidak boleh dipakai atau dipinjamkan", 0, 4, 'L');
$pdf->SetXY(122, 55);
$pdf->Cell(9.5, 7, "    kepada orang lain selain pemilik yang tercantum namanya ", 0, 4, 'L');
$pdf->SetXY(122, 58);
$pdf->Cell(9.5, 7, "    pada Mine Permit Card Tersebut", 0, 4, 'L');

$pdf->SetXY(122, 63);
$pdf->Cell(9.5, 7, "5. Penyalahgunaan dan ketidak disiplinan terhadap pemakaian ", 0, 4, 'L');
$pdf->SetXY(122, 66);
$pdf->Cell(9.5, 7, "    Mine Permit Card bisa dikenakan sanksi yang tercantum  ", 0, 4, 'L');
$pdf->SetXY(122, 69);
$pdf->Cell(9.5, 7, "    pada Safety Golden Rules PT. MIP", 0, 4, 'L');

$pdf->SetXY(122, 74);
$pdf->Cell(9.5, 7, "6. Apabila Mine Permit Card hilang, maka untuk membuat Mine", 0, 4, 'L');
$pdf->SetXY(122, 77);
$pdf->Cell(9.5, 7, "    Permit Card baru dikenakan biaya sebesar Rp. 100.000,- ", 0, 4, 'L');

$pdf->SetFont('Arial', '', 7);
$pdf->Image('../../assets/images/LOGOX.png', 33, 13, 12, 9);
$pdf->SetFont('Arial', '', 7);
$pdf->Image('../../assets/images/LOGOX.png', 125, 86, 12, 9);
$pdf->SetFont('Arial', '', 7);
$pdf->Image('../../assets/images/BARCODE.png', 138.5, 83, 15, 15);
$pdf->SetFont('Arial', '', 7);
$pdf->Image('../../assets/images/SAFETY.png', 156, 86, 9, 9);

$pdf->Output();
// }
