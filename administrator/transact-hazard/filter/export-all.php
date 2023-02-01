<?php
require_once '../../../lib/PHPExcel.php';
require_once '../../../lib/PHPExcel/IOFactory.php';
require_once '../../../controller/connection.php';
$date1 = $_GET['d1'];
$date2 = $_GET['d2'];

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

//=======================================================================================================================================================//
$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'HAZARD REPORT');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'Status');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Tanggal');
$objPHPExcel->getActiveSheet()->setCellValue('D3', 'ID Hazard');
$objPHPExcel->getActiveSheet()->setCellValue('E3', 'Judul');
$objPHPExcel->getActiveSheet()->setCellValue('F3', 'Nama Pelapor');
$objPHPExcel->getActiveSheet()->setCellValue('G3', 'Klasifikasi');
$objPHPExcel->getActiveSheet()->setCellValue('H3', 'Lokasi');
$objPHPExcel->getActiveSheet()->setCellValue('I3', 'Risiko');
$objPHPExcel->getActiveSheet()->setCellValue('J3', 'Uraian');
$objPHPExcel->getActiveSheet()->setCellValue('K3', 'Saran');
$objPHPExcel->getActiveSheet()->setCellValue('L3', 'Divisi PIC');
$objPHPExcel->getActiveSheet()->setCellValue('M3', 'Perusahaan PIC');
$hazard = mysqli_query($conn,"SELECT * FROM hazard 
	LEFT JOIN user on user.user_id = hazard.hazard_user
	LEFT JOIN location on location.loc_id = hazard.hazard_loc
	LEFT JOIN classification on classification.classi_id = hazard.hazard_classi
	LEFT JOIN risk on risk.risk_id = hazard.hazard_risk
	LEFT JOIN divisi on divisi.divisi_id = hazard.hazard_divisi
	LEFT JOIN company on company.comp_id = hazard.hazard_comp
	WHERE DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1'
	AND DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'");
$row = 4;
while($hazard_data = mysqli_fetch_array($hazard))
{
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $hazard_data['hazard_status']);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $hazard_data['hazard_date']);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, 'HZ'.str_pad($hazard_data['hazard_id'],5,"0",STR_PAD_LEFT));
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $hazard_data['hazard_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $hazard_data['user_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $hazard_data['classi_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $hazard_data['loc_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $hazard_data['risk_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('J'.$row, $hazard_data['hazard_desc']);
	$objPHPExcel->getActiveSheet()->setCellValue('K'.$row, $hazard_data['hazard_solution']);
	$objPHPExcel->getActiveSheet()->setCellValue('L'.$row, $hazard_data['divisi_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('M'.$row, $hazard_data['comp_name']);
	$row++;
}
$objPHPExcel->getActiveSheet()->setTitle('Hazard Report');

//=======================================================================================================================================================//
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(1);
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'BERDASARKAN KLASIFIKASI');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'Klasifikasi');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Total');
$classi   = mysqli_query ($conn,"SELECT * FROM classification order by classi_name asc ");
$row = 4;
while($classi_data = mysqli_fetch_array($classi))
{
	$classi_= mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard  
		left join user on user.user_id = hazard.hazard_user
		where  hazard.hazard_classi = ".$classi_data['classi_id']." 
		and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' 
		and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'"));
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $classi_data['classi_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $classi_['total']);
	$row++;
}
//--------------------------------------------------------------------------------------------------
$objPHPExcel->getActiveSheet()->setCellValue('E2', 'BERDASARKAN RISIKO');
$objPHPExcel->getActiveSheet()->setCellValue('E3', 'Risiko');
$objPHPExcel->getActiveSheet()->setCellValue('F3', 'Total');
$risk     = mysqli_query ($conn,"SELECT * FROM risk order by risk_name asc ");
$row = 4;
while($risk_data = mysqli_fetch_array($risk))
{
	$risk_=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
		left join user on user.user_id = hazard.hazard_user
		where hazard.hazard_risk = ".$risk_data['risk_id']." 
		and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' 
		and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'"));
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $risk_data['risk_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $risk_['total']);
	$row++;
}
//--------------------------------------------------------------------------------------------------
$objPHPExcel->getActiveSheet()->setCellValue('H2', 'BERDASARKAN STATUS');
$objPHPExcel->getActiveSheet()->setCellValue('H3', 'Status');
$objPHPExcel->getActiveSheet()->setCellValue('I3', 'Total');
$objPHPExcel->getActiveSheet()->setCellValue('H4', 'Open');
$objPHPExcel->getActiveSheet()->setCellValue('H5', 'Progress');
$objPHPExcel->getActiveSheet()->setCellValue('H6', 'Closed');
$objPHPExcel->getActiveSheet()->setCellValue('H7', 'Reject');
$status = mysqli_fetch_array($conn->query("SELECT 
	COUNT(CASE WHEN hazard_status = 'Open' THEN 1 END) AS `Open`,
	COUNT(CASE WHEN hazard_status = 'Progress' THEN 1 END) AS `Progress`,
	COUNT(CASE WHEN hazard_status = 'Closed' THEN 1 END) AS `Closed`,
	COUNT(CASE WHEN hazard_status = 'Reject' THEN 1 END) AS `Reject`
	FROM hazard
	LEFT JOIN user on user.user_id = hazard.hazard_user
	where  hazard.hazard_approve = 'Y' 
	and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' 
	and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'"));
$objPHPExcel->getActiveSheet()->setCellValue('I4', $status['Open']);
$objPHPExcel->getActiveSheet()->setCellValue('I5', $status['Progress']);
$objPHPExcel->getActiveSheet()->setCellValue('I6', $status['Closed']);
$objPHPExcel->getActiveSheet()->setCellValue('I7', $status['Reject']);
//--------------------------------------------------------------------------------------------------
$objPHPExcel->getActiveSheet()->setCellValue('K2', 'BERDASARKAN LAPORAN TIAP BULAN');
$objPHPExcel->getActiveSheet()->setCellValue('K3', 'Status');
$objPHPExcel->getActiveSheet()->setCellValue('L3', 'Total');
$objPHPExcel->getActiveSheet()->setCellValue('K4', 'Januari');
$objPHPExcel->getActiveSheet()->setCellValue('K5', 'Februari');
$objPHPExcel->getActiveSheet()->setCellValue('K6', 'Maret');
$objPHPExcel->getActiveSheet()->setCellValue('K7', 'April');
$objPHPExcel->getActiveSheet()->setCellValue('K8', 'Mei');
$objPHPExcel->getActiveSheet()->setCellValue('K9', 'Juni');
$objPHPExcel->getActiveSheet()->setCellValue('K10', 'Juli');
$objPHPExcel->getActiveSheet()->setCellValue('K11', 'Agustus');
$objPHPExcel->getActiveSheet()->setCellValue('K12', 'September');
$objPHPExcel->getActiveSheet()->setCellValue('K13', 'Oktober');
$objPHPExcel->getActiveSheet()->setCellValue('K14', 'November');
$objPHPExcel->getActiveSheet()->setCellValue('K15', 'Desember');
$month=mysqli_fetch_array($conn->query("SELECT 
	COUNT(CASE WHEN MONTH( hazard_date ) = '01'  THEN 1 END) AS `jan`,
	COUNT(CASE WHEN MONTH( hazard_date ) = '02'  THEN 1 END) AS `feb`,
	COUNT(CASE WHEN MONTH( hazard_date ) = '03'  THEN 1 END) AS `mar`,
	COUNT(CASE WHEN MONTH( hazard_date ) = '04'  THEN 1 END) AS `apr`,
	COUNT(CASE WHEN MONTH( hazard_date ) = '05'  THEN 1 END) AS `mei`,
	COUNT(CASE WHEN MONTH( hazard_date ) = '06'  THEN 1 END) AS `jun`,
	COUNT(CASE WHEN MONTH( hazard_date ) = '07'  THEN 1 END) AS `jul`,
	COUNT(CASE WHEN MONTH( hazard_date ) = '08'  THEN 1 END) AS `agu`,
	COUNT(CASE WHEN MONTH( hazard_date ) = '09'  THEN 1 END) AS `sep`,
	COUNT(CASE WHEN MONTH( hazard_date ) = '10'  THEN 1 END) AS `okt`,
	COUNT(CASE WHEN MONTH( hazard_date ) = '11'  THEN 1 END) AS `nov`,
	COUNT(CASE WHEN MONTH( hazard_date ) = '12'  THEN 1 END) AS `des`
	FROM hazard  
	LEFT JOIN user on user.user_id = hazard.hazard_user
	where DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' 
	AND DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'"));
$objPHPExcel->getActiveSheet()->setCellValue('L4', $month['jan']);
$objPHPExcel->getActiveSheet()->setCellValue('L5', $month['feb']);
$objPHPExcel->getActiveSheet()->setCellValue('L6', $month['mar']);
$objPHPExcel->getActiveSheet()->setCellValue('L7', $month['apr']);
$objPHPExcel->getActiveSheet()->setCellValue('L8', $month['mei']);
$objPHPExcel->getActiveSheet()->setCellValue('L9', $month['jun']);
$objPHPExcel->getActiveSheet()->setCellValue('L10', $month['jul']);
$objPHPExcel->getActiveSheet()->setCellValue('L11', $month['agu']);
$objPHPExcel->getActiveSheet()->setCellValue('L12', $month['sep']);
$objPHPExcel->getActiveSheet()->setCellValue('L13', $month['okt']);
$objPHPExcel->getActiveSheet()->setCellValue('L14', $month['nov']);
$objPHPExcel->getActiveSheet()->setCellValue('L15', $month['des']);
//--------------------------------------------------------------------------------------------------
$objPHPExcel->getActiveSheet()->setCellValue('N2', 'BERDASARKAN LOKASI');
$objPHPExcel->getActiveSheet()->setCellValue('N3', 'Lokasi');
$objPHPExcel->getActiveSheet()->setCellValue('O3', 'Total');
$loc = mysqli_query ($conn,"SELECT * FROM location order by loc_name asc ");
$row = 4;
while($loc_data = mysqli_fetch_array($loc))
{
	$loc_=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
		LEFT JOIN user on user.user_id = hazard.hazard_user
		where hazard.hazard_loc = ".$loc_data['loc_id']." 
		and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' 
		and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'"));
	$objPHPExcel->getActiveSheet()->setCellValue('N'.$row, $loc_data['loc_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('O'.$row, $loc_['total']);
	$row++;
}
//--------------------------------------------------------------------------------------------------
$objPHPExcel->getActiveSheet()->setTitle('Summary Hazard');

//=======================================================================================================================================================//
$objPHPExcel->createSheet();
$objPHPExcel->setActiveSheetIndex(2);
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'BERDASARKAN NAMA PELAPOR');
$objPHPExcel->getActiveSheet()->setCellValue('B3', 'Nama User');
$objPHPExcel->getActiveSheet()->setCellValue('C3', 'Divisi');
$objPHPExcel->getActiveSheet()->setCellValue('D3', 'Company');
$objPHPExcel->getActiveSheet()->setCellValue('E3', 'Open');
$objPHPExcel->getActiveSheet()->setCellValue('F3', 'Progress');
$objPHPExcel->getActiveSheet()->setCellValue('G3', 'Closed');
$objPHPExcel->getActiveSheet()->setCellValue('H3', 'Reject');
$objPHPExcel->getActiveSheet()->setCellValue('I3', 'Total');
@$user      = mysqli_query ($conn,"SELECT * FROM user 
	LEFT JOIN level ON level.level_id = user.user_level
	LEFT JOIN departement ON departement.dept_id = user.user_dept
	LEFT JOIN divisi ON divisi.divisi_id = user.user_divisi
	LEFT JOIN company ON company.comp_id = user.user_comp 
	WHERE user.user_pic != 'X' ORDER BY user.user_name ASC ");
$row = 4;
while($user_data = mysqli_fetch_array($user))
{
	$muser=mysqli_fetch_array($conn->query("SELECT 
		COUNT(CASE WHEN hazard_status = 'Open'  THEN 1 END) AS `Open`,
		COUNT(CASE WHEN hazard_status = 'Progress'  THEN 1 END) AS `Progress`,
		COUNT(CASE WHEN hazard_status = 'Closed'  THEN 1 END) AS `Closed`,
		COUNT(CASE WHEN hazard_status = 'Reject'  THEN 1 END) AS `Reject`
		FROM hazard  
		where DATE_FORMAT(hazard_date, '%Y-%m-%d') >= '$date1' 
		AND DATE_FORMAT(hazard_date, '%Y-%m-%d') <= '$date2'
		AND hazard_user = ".$user_data['user_id']."
		and hazard_approve = 'Y'"));

	$objPHPExcel->getActiveSheet()->setCellValue('B'.$row, $user_data['user_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$row, $user_data['divisi_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$row, $user_data['comp_name']);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$row, $muser['Open']);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$row, $muser['Progress']);
	$objPHPExcel->getActiveSheet()->setCellValue('G'.$row, $muser['Closed']);
	$objPHPExcel->getActiveSheet()->setCellValue('H'.$row, $muser['Reject']);
	$objPHPExcel->getActiveSheet()->setCellValue('I'.$row, $totalusr =  $muser['Open'] +  $muser['Progress'] + $muser['Closed'] + $muser['Reject']);
	$row++;
}
//--------------------------------------------------------------------------------------------------
$objPHPExcel->getActiveSheet()->setTitle('Berdasarkan Nama Pelapor');
//=======================================================================================================================================================//

$excelname = 'Hazard Report ('.$date1.' to '.$date2.').xls';
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$excelname.'');
header('Cache-Control: max-age=0');
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
?>