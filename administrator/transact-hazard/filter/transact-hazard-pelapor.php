<?php 
#HAZARD REPORT
@$data     = mysqli_query ($conn,"SELECT * FROM hazard
	LEFT JOIN user on user.user_id = hazard.hazard_user
	LEFT JOIN location on location.loc_id = hazard.hazard_loc
	LEFT JOIN classification on classification.classi_id = hazard.hazard_classi
	LEFT JOIN risk on risk.risk_id = hazard.hazard_risk
	LEFT JOIN divisi on divisi.divisi_id = hazard.hazard_divisi
	LEFT JOIN company on company.comp_id = hazard.hazard_comp
	where user.user_comp = '$comp'

	and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1'
	and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'");

#BERDASARKAN KLASIFIKASI
@$classi   = mysqli_query ($conn,"SELECT * FROM classification order by classi_name asc ");
#BERDASARKAN RISIKO
@$risk     = mysqli_query ($conn,"SELECT * FROM risk order by risk_name asc ");
#BERDASARKAN LOKASI
@$location = mysqli_query ($conn,"SELECT * FROM location order by loc_name asc ");
#BERDASARKAN DIVISI
@$divisi   = mysqli_query ($conn,"SELECT * FROM divisi where divisi_comp = '$comp' order by divisi_name asc ");
#BERDASARKAN USER / PELAPOR
@$usr      = mysqli_query ($conn,"SELECT * FROM user 
	LEFT JOIN level ON level.level_id = user.user_level
	LEFT JOIN departement ON departement.dept_id = user.user_dept
	LEFT JOIN divisi ON divisi.divisi_id = user.user_divisi
	LEFT JOIN company ON company.comp_id = user.user_comp
	WHERE user.user_comp = '$comp'  
	AND user.user_status = 'STAFF'
	ORDER BY user.user_name ASC ");

#BERDASARKAN STATUS
@$status = mysqli_fetch_array($conn->query("SELECT 
	COUNT(CASE WHEN hazard.hazard_status = 'Open' THEN 1 END) AS `Open`,
	COUNT(CASE WHEN hazard.hazard_status = 'Progress' THEN 1 END) AS `Progress`,
	COUNT(CASE WHEN hazard.hazard_status = 'Closed' THEN 1 END) AS `Closed`,
	COUNT(CASE WHEN hazard.hazard_status = 'Reject' THEN 1 END) AS `Reject`
	FROM hazard
	LEFT JOIN user on user.user_id = hazard.hazard_user
	where hazard.hazard_approve = 'Y' 
	and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' 
	and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'
	AND user.user_comp = ".$comp.""));

#BERDASARKAN BULAN 
@$month=mysqli_fetch_array($conn->query("SELECT 
	COUNT(CASE WHEN MONTH( hazard.hazard_date ) = '01'  THEN 1 END) AS `jan`,
	COUNT(CASE WHEN MONTH( hazard.hazard_date ) = '02'  THEN 1 END) AS `feb`,
	COUNT(CASE WHEN MONTH( hazard.hazard_date ) = '03'  THEN 1 END) AS `mar`,
	COUNT(CASE WHEN MONTH( hazard.hazard_date ) = '04'  THEN 1 END) AS `apr`,
	COUNT(CASE WHEN MONTH( hazard.hazard_date ) = '05'  THEN 1 END) AS `mei`,
	COUNT(CASE WHEN MONTH( hazard.hazard_date ) = '06'  THEN 1 END) AS `jun`,
	COUNT(CASE WHEN MONTH( hazard.hazard_date ) = '07'  THEN 1 END) AS `jul`,
	COUNT(CASE WHEN MONTH( hazard.hazard_date ) = '08'  THEN 1 END) AS `agu`,
	COUNT(CASE WHEN MONTH( hazard.hazard_date ) = '09'  THEN 1 END) AS `sep`,
	COUNT(CASE WHEN MONTH( hazard.hazard_date ) = '10'  THEN 1 END) AS `okt`,
	COUNT(CASE WHEN MONTH( hazard.hazard_date ) = '11'  THEN 1 END) AS `nov`,
	COUNT(CASE WHEN MONTH( hazard.hazard_date ) = '12'  THEN 1 END) AS `des`
	FROM hazard  
	LEFT JOIN user on user.user_id = hazard.hazard_user
	WHERE DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' 
	AND DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'
	AND user.user_comp = ".$comp.""));
	?>

	<div class="tab-content" id="myTabContent">
		<div class="alert alert-light" role="alert"> 
			<center><strong>
				<?php @$tcomp = mysqli_fetch_array($conn->query("SELECT * FROM company where comp_id = '$comp'")); echo $tcomp['comp_name'].' sebagai '.$_POST['sebagai'];?></strong>
				<?php if (@$_POST['date1'] != '') { ?>
					<small><?= '( '. date('d F Y', strtotime($_POST['date1'])).' s/d '.date('d F Y', strtotime($_POST['date2'])).' )';?></small>
				<?php } ?>
			</center>
		</div>
		<div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
			<div class="row ">
				<div class="col-md-12 col-lg-12 col-xl-12">
					<div class="card">
						<div class="card-body">
							<div class="table-responsive">
								<table class="table table-striped table-hover" id="tableExport" style="width:100%;">
									<thead>
										<tr>
											<th>Status</th>
											<th style="min-width: 150px;">Tanggal</th>
											<th style="min-width: 70px;" >ID Harmonis</th>
											<th style="min-width: 70px;" >Judul</th>
											<th style="min-width: 150px;">Nama Pelapor</th>
											<th style="min-width: 150px;">Klasifikasi</th>
											<th style="min-width: 150px;">Lokasi</th>
											<th style="min-width: 100px;">Risiko</th>
											<th style="min-width: 150px;">Uraian</th>
											<th style="min-width: 150px;">Saran/Solusi</th>
											<th style="min-width: 100px;">Divisi (PIC)</th>
											<th style="min-width: 150px;">Perusahaan (PIC)</th>
										</tr>
									</thead>
									<tbody>
										<?php while($row  = mysqli_fetch_array($data)){ ?> 
											<tr>
												<td style="width: 50px;">
													<?php if ($row['hazard_status'] == 'Open') {
														echo'<span class="badge badge-pill badge-warning">&nbsp;&nbsp;&nbsp;Open&nbsp;&nbsp;</span>';
													} elseif ($row['hazard_status'] == 'Progress') {
														echo'<span class="badge badge-pill badge-primary">Progress</span>';
													} elseif ($row['hazard_status'] == 'Closed') {
														echo'<span class="badge badge-pill badge-success">&nbsp;&nbsp;Closed&nbsp;&nbsp;</span>';
													} elseif ($row['hazard_status'] == 'Reject') {
														echo'<span class="badge badge-pill badge-danger">&nbsp;&nbsp;Reject&nbsp;&nbsp;</span>';
													}?>
												</td>
												<td><?= date('d-m-Y H:i:s', strtotime($row['hazard_date']));?></td>
												<td><strong><a href="home.php?v=hazard&act=detail&id=<?= $row['hazard_id']; ?>">
													<?= 'HZ'.str_pad($row['hazard_id'],5,"0",STR_PAD_LEFT);?></a></strong>
												</td>
												<td><?= $row['hazard_name']; ?></td>
												<td><a href="home.php?v=muser&act=detail&id=<?= $row['user_id']; ?>"><?= $row['user_name']; ?></a></td>
												<td><?= $row['classi_name']; ?></td>
												<td><?php if(@$row['hazard_loc_etc'] == '' ) {
													echo @$row['loc_name'];
												} else {
													echo 'Lain-lain ('.$row['hazard_loc_etc'].')';
												}?></td>
												<td><?= $row['risk_name']; ?></td>
												<td style="    max-width: 40px;text-overflow: ellipsis;overflow: hidden;white-space: nowrap;"><?= $row['hazard_desc']; ?></td>
												<td><?= $row['hazard_solution']; ?></td>
												<td><?= $row['divisi_name']; ?></td>
												<td><?= $row['comp_name']; ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="tab-pane fade" id="summary" role="tabpanel" aria-labelledby="summary-tab">
			<a target="_blank" href="transact-hazard/filter/export-pelapor.php?d1=<?= $date1;?>&d2=<?= $date2;?>&comp=<?= $comp;?>">
				<button class="btn btn-outline-success form-control">
					<i class="fas fa-download"></i> Export Summary
				</button>
			</a><br><br>
			<div id="summarys" >
				<div class="row">	
					<div class="col-4 col-sm-4 col-lg-4">
						<div class="card " style="padding-bottom: 0px;">
							<div class="card-header">
								<h4>Berdasarkan Klasifikasi Temuan</h4><br>
							</div>
							<div class="card-body">
								<table class="table table-striped table-sm">
									<thead>
										<tr>
											<th>Klasifikasi</th>
											<th>Jumlah</th>
										</tr>
									</thead>
									<tbody> 
										<?php while($row  = mysqli_fetch_array($classi)){ 
											$classi_g[] = $row['classi_name'];?>
											<tr>
												<td><?= $row['classi_name']?></td>
												<td>
													<?php @$classi_=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard  
														left join user on user.user_id = hazard.hazard_user
														where user.user_comp = '$comp' and hazard_classi = ".$row['classi_id']." and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'"));  $classi_g_[] = $classi_['total']; echo $classi_['total'];?> 
													</td>
												</tr>
											<?php } ?>
										</tbody>
									</table><br><br><br>
								</div>
							</div>
						</div>
						<div class="col-4 col-sm-4 col-lg-4">
							<div class="card " style="padding-bottom: 0px;">
								<div class="card-header">
									<h4>Berdasarkan Risiko Temuan</h4><br>
								</div>
								<div class="card-body">
									<table class="table table-striped table-sm">
										<thead>
											<tr>
												<th>Risiko</th>
												<th>Jumlah</th>
											</tr>
										</thead>
										<tbody>
											<?php while($row  = mysqli_fetch_array($risk)){ 
												$risk_g[] = $row['risk_name'];?>
												<tr>
													<td><?= $row['risk_name']?></td>
													<td>
														<?php @$risk_=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard  
															left join user on user.user_id = hazard.hazard_user
															where user.user_comp = '$comp' and hazard_risk = ".$row['risk_id']." and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'")); $risk_g_[] = $risk_['total']; echo $risk_['total'];?>
														</td>
													</tr>
												<?php } ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-4 col-sm-4 col-lg-4">
								<div class="card">
									<div class="card-header">
										<h4>Berdasarkan Status Temuan</h4><br>
									</div>
									<div class="card-body">
										<table class="table table-striped table-sm">
											<thead>
												<tr>
													<th>Status</th>
													<th>Jumlah</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Open</td>
													<td><?= $status['Open'];?></td>
												</tr>
												<tr>
													<td>Progress</td>
													<td><?= $status['Progress'];?></td>
												</tr>
												<tr>
													<td>Closed</td>
													<td><?= $status['Closed'];?></td>
												</tr>
												<tr>
													<td>Reject</td>
													<td><?= $status['Reject'];?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

						<div class="row ">
							<div class="col-6 col-md-6 col-lg-6">
								<div class="card " style="padding-bottom: 0px;">
									<div class="card-header">
										<h4>Jumlah Lap. Hazob Tiap Bulan</h4><br>
									</div>
									<div class="card-body">
										<table class="table table-striped table-sm" id="tablesum1">
											<thead>
												<tr>
													<th>Bulan</th>
													<th>Jumlah</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Januari</td>
													<td><?= $month['jan'];?></td>
												</tr>
												<tr>
													<td>Februari</td>
													<td><?= $month['feb'];?></td>
												</tr>
												<tr>
													<td>Maret</td>
													<td><?= $month['mar'];?></td>
												</tr>
												<tr>
													<td>April</td>
													<td><?= $month['apr'];?></td>
												</tr>
												<tr>
													<td>Mei</td>
													<td><?= $month['mei'];?></td>
												</tr>
												<tr>
													<td>Juni</td>
													<td><?= $month['jun'];?></td>
												</tr>
												<tr>
													<td>Juli</td>
													<td><?= $month['jul'];?></td>
												</tr>
												<tr>
													<td>Agustus</td>
													<td><?= $month['agu'];?></td>
												</tr>
												<tr>
													<td>September</td>
													<td><?= $month['sep'];?></td>
												</tr>
												<tr>
													<td>Oktober</td>
													<td><?= $month['okt'];?></td>
												</tr>
												<tr>
													<td>November</td>
													<td><?= $month['nov'];?></td>
												</tr>
												<tr>
													<td>Desember</td>
													<td><?= $month['des'];?></td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="col-6 col-md-6 col-lg-6">
								<div class="card ">
									<div class="card-header">
										<h4>Berdasarkan Lokasi Temuan</h4><br>
									</div>
									<div class="card-body">
										<table class="table table-striped table-sm" id="tablesum2">
											<thead>
												<tr>
													<th>Lokasi</th>
													<th>Jumlah</th>
												</tr>
											</thead>
											<tbody>
												<?php while($row  = mysqli_fetch_array($location)){ 
													$location_g[] = $row['loc_name_short'];?>
													<tr>
														<td><?= $row['loc_name']?></td>
														<td>
															<?php @$location_=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard  
																left join user on user.user_id = hazard.hazard_user
																where user.user_comp = '$comp' and hazard_loc = ".$row['loc_id']." and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'")); $location_g_[]= $location_['total']; echo $location_['total'];?>
															</td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="row ">
								<div class="col-12 col-md-12 col-lg-12">
									<div class="card ">
										<div class="card-header">
											<h4>Berdasarkan Divisi Pelapor</h4><br>
										</div>
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-striped table-hover" id="tableExportdivpelsu" style="width:100%;" >
													<thead>
														<tr>
															<th>Divisi</th>
															<th>Pengawas</th>
															<th>Target MTD</th>
															<th>JAN</th>
															<th>FEB</th>
															<th>MAR</th>
															<th>APR</th>
															<th>MEI</th>
															<th>JUN</th>
															<th>JUL</th>
															<th>AGU</th>
															<th>SEP</th>
															<th>OKT</th>
															<th>NOV</th>
															<th>DES</th>
															<th style="background-color:yellow;">Total YTD</th>
															<th style="background-color:yellow;">Target YTD</th>
															<th style="background-color:yellow;">YTD (%)</th>
														</tr>
													</thead>							
													<tbody>
														<?php while($row  = mysqli_fetch_array($divisi)){ 
															$divisi_g[] = $row['divisi_name'];
															$mdiv=mysqli_fetch_array($conn->query("SELECT 
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
																AND DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'
																AND user.user_divisi = ".$row['divisi_id']."
																AND user.user_comp = '$comp'"));
																?>
																<tr>
																	<td>
																		<?= $row['divisi_name']?>
																	</td>
																	<td>
																		<?php @$pengawas=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM user where user_divisi = ".$row['divisi_id']." and user_comp =".$comp."")); echo $pengawas['total'];?> 
																	</td>
																	<td>
																		<?= $targetM = $pengawas['total'] * 2 ;?> 
																	</td>
																	<td><?php 
																	if ($mdiv['jan'] == 0){ echo '-';}
																	else {
																		if ($mdiv['jan']  < $targetM) { 
																			echo '<span class="text-danger">'.$mdiv['jan'].'</span>'; 
																		}else{ 
																			echo $mdiv['jan'];  }
																		}?>
																	</td>	
																	<td><?php 
																	if ($mdiv['feb'] == 0){ echo '-';}
																	else {
																		if ($mdiv['feb']  < $targetM) { 
																			echo '<span class="text-danger">'.$mdiv['feb'].'</span>'; 
																		}else{ 
																			echo $mdiv['feb'];  }
																		}?>
																	</td>	
																	<td><?php 
																	if ($mdiv['mar'] == 0){ echo '-';}
																	else {
																		if ($mdiv['mar']  < $targetM) { 
																			echo '<span class="text-danger">'.$mdiv['mar'].'</span>'; 
																		}else{ 
																			echo $mdiv['mar'];  }
																		}?>
																	</td>	
																	<td><?php 
																	if ($mdiv['apr'] == 0){ echo '-';}
																	else {
																		if ($mdiv['apr']  < $targetM) { 
																			echo '<span class="text-danger">'.$mdiv['apr'].'</span>'; 
																		}else{ 
																			echo $mdiv['apr'];  }
																		}?>
																	</td>	
																	<td><?php 
																	if ($mdiv['mei'] == 0){ echo '-';}
																	else {
																		if ($mdiv['mei']  < $targetM) { 
																			echo '<span class="text-danger">'.$mdiv['mei'].'</span>'; 
																		}else{ 
																			echo $mdiv['mei'];  }
																		}?>
																	</td>	
																	<td><?php 
																	if ($mdiv['jun'] == 0){ echo '-';}
																	else {
																		if ($mdiv['jun']  < $targetM) { 
																			echo '<span class="text-danger">'.$mdiv['jun'].'</span>'; 
																		}else{ 
																			echo $mdiv['jun'];  }
																		}?>
																		</td>																		<td><?php 
																		if ($mdiv['jul'] == 0){ echo '-';}
																		else {
																			if ($mdiv['jul']  < $targetM) { 
																				echo '<span class="text-danger">'.$mdiv['jul'].'</span>'; 
																			}else{ 
																				echo $mdiv['jul'];  }
																			}?>
																		</td>
																		<td><?php 
																		if ($mdiv['agu'] == 0){ echo '-';}
																		else {
																			if ($mdiv['agu']  < $targetM) { 
																				echo '<span class="text-danger">'.$mdiv['agu'].'</span>'; 
																			}else{ 
																				echo $mdiv['agu'];  }
																			}?>
																		</td>
																		<td><?php 
																		if ($mdiv['sep'] == 0){ echo '-';}
																		else {
																			if ($mdiv['sep']  < $targetM) { 
																				echo '<span class="text-danger">'.$mdiv['sep'].'</span>'; 
																			}else{ 
																				echo $mdiv['sep'];  }
																			}?>
																		</td>	
																		<td><?php 
																		if ($mdiv['okt'] == 0){ echo '-';}
																		else {
																			if ($mdiv['okt']  < $targetM) { 
																				echo '<span class="text-danger">'.$mdiv['okt'].'</span>'; 
																			}else{ 
																				echo $mdiv['okt'];  }
																			}?>
																		</td>	
																		<td><?php 
																		if ($mdiv['nov'] == 0){ echo '-';}
																		else {
																			if ($mdiv['nov']  < $targetM) { 
																				echo '<span class="text-danger">'.$mdiv['nov'].'</span>'; 
																			}else{ 
																				echo $mdiv['nov'];  }
																			}?>
																		</td>																	
																		<td><?php 
																		if ($mdiv['des'] == 0){ echo '-';}
																		else {
																			if ($mdiv['des']  < $targetM) { 
																				echo '<span class="text-danger">'.$mdiv['des'].'</span>'; 
																			}else{ 
																				echo $mdiv['des'];  }
																			}?>
																		</td>
																		<td style="background-color:yellow;">
																			<?= $total = $mdiv['jan']+$mdiv['feb']+$mdiv['mar']+$mdiv['apr']+$mdiv['mei']+$mdiv['jun']+$mdiv['jul']+$mdiv['agu']+$mdiv['sep']+$mdiv['okt']+$mdiv['nov']+$mdiv['des']; $divisi_g_[]= $total;?> 
																		</td>
																		<td style="background-color:yellow;">
																			<?= $targetY = $pengawas['total'] * 24 ;?> 
																		</td>
																		<td style="background-color:yellow;">
																			<?php @$acv = $total / $targetY * 100;
																			echo number_format((float)$acv, 2, '.', '') .'%';?> 
																		</td>

																	</tr>
																<?php } ?>
															</tbody>
														</table>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="row ">
									<div class="col-12 col-md-12 col-lg-12">
										<div class="card ">
											<div class="card-header">
												<h4>Berdasarkan Nama Pelapor</h4><br>
											</div>
											<div class="card-body">
												<table class="table table-striped table-hover" id="tableExportnampel" style="width:100%;">
													<thead>
														<tr>
															<th>Nama user</th>
															<th>Divisi</th>
															<th>Open</th>
															<th>Progress</th>
															<th>Closed</th>
															<th>Reject</th>
															<th style="background-color:yellow;">Total</th>
														</tr>
													</thead>
													<tbody>
														<?php while($row  = mysqli_fetch_array($usr)){ 
															$muser=mysqli_fetch_array($conn->query("SELECT 
																COUNT(CASE WHEN hazard_status = 'Open'  THEN 1 END) AS `Open`,
																COUNT(CASE WHEN hazard_status = 'Progress'  THEN 1 END) AS `Progress`,
																COUNT(CASE WHEN hazard_status = 'Closed'  THEN 1 END) AS `Closed`,
																COUNT(CASE WHEN hazard_status = 'Reject'  THEN 1 END) AS `Reject`
																FROM hazard  
																where DATE_FORMAT(hazard_date, '%Y-%m-%d') >= '$date1' 
																AND DATE_FORMAT(hazard_date, '%Y-%m-%d') <= '$date2'
																AND hazard_user = ".$row['user_id']."
																and hazard_approve = 'Y'"));
																?>
																<tr>
																	<td><?= $row['user_name']?></td>
																	<td><?= $row['divisi_name']?></td>
																	<td><?= $muser['Open']?></td>
																	<td><?= $muser['Progress']?></td>
																	<td><?= $muser['Closed']?></td>
																	<td><?= $muser['Reject']?></td>
																	<td style="background-color:yellow;"><?= $$total = $muser['Open']+$muser['Progress']+$muser['Closed']+$muser['Reject']?></td>
																</tr>
															<?php } ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>

								<div class="tab-pane fade" id="grafik" role="tabpanel" aria-labelledby="grafik-tab">
									<button class="btn btn-outline-success form-control" type="submit"  onclick="printDiv()">
										<i class="fas fa-download"></i> Export Grafik
									</button><br><br>
									<div  id="grafiks" >
										<script type="text/javascript" src="../assets/js/chartjs/Chart.js"></script>
										<div class="row ">
											<div class="col-4 col-md-4 col-lg-4">
												<div class="card ">
													<div class="card-header">
														<h4>Berdasarkan Klasifikasi Temuan</h4><br>
													</div>
													<div class="card-body" >
														<div style="width: 300px;height: 250px;">
															<canvas id="myChart1" style="width: 300px;height: 250px;"></canvas>
														</div>
														<script>
															var ctx = document.getElementById("myChart1").getContext('2d');
															var myChart = new Chart(ctx, {
																type: 'bar',
																data: {
																	labels: ['KTA','TTA'],
																	datasets: [{
																		label: '#Klasifikasi',
																		data:  <?= json_encode($classi_g_); ?>,
																		backgroundColor:['rgba(255, 99, 132, 0.2)','rgba(54, 162, 235, 0.2)'],
																		borderColor: ['rgba(255,99,132,1)','rgba(54, 162, 235, 1)'],
																		borderWidth: 1
																	}]
																},
																options: {
																	scales: {
																		yAxes: [{
																			ticks: {
																				beginAtZero:true
																			}
																		}]
																	},
																	legend: {
																		display: false
																	},
																	animation: {
																		duration: 1,
																		onComplete: function () {
																			var chartInstance = this.chart,
																			ctx = chartInstance.ctx;
																			ctx.textAlign = 'center';
																			ctx.fillStyle = "rgba(0, 0, 0, 1)";
																			ctx.textBaseline = 'bottom';
                                                    // Loop through each data in the datasets
                                                    this.data.datasets.forEach(function (dataset, i) {
                                                    	var meta = chartInstance.controller.getDatasetMeta(i);
                                                    	meta.data.forEach(function (bar, index) {
                                                    		var data = dataset.data[index];
                                                    		ctx.fillText(data, bar._model.x, bar._model.y - -7);
                                                    	});
                                                    });
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="col-4 col-md-4 col-lg-4">
                    	<div class="card ">
                    		<div class="card-header">
                    			<h4>Berdasarkan Risiko Temuan</h4><br>
                    		</div>
                    		<div class="card-body" >
                    			<div style="width: 300px;height: 250px;">
                    				<canvas id="myChart3" style="width: 300px;height: 250px;"></canvas>
                    			</div>
                    			<script>
                    				var colors = [
											'rgba(52, 58, 64, 0.2)',        //dark
											'rgba(76, 175, 80, 0.2)', 		//green
											'rgba(0, 140, 186, 0.2)', 		//blue
											'rgba(244, 67, 54, 0.2)', 		//red
											'rgba(108, 117, 125, 0.2)',     //grey
											'rgba(255, 193, 7, 0.2)'		//yellow
											];
											var ctx = document.getElementById("myChart3").getContext('2d');
											var myChart = new Chart(ctx, {
												type: 'bar',
												data: {
													labels: <?= json_encode($risk_g); ?>,
													datasets: [{
														label: '#Risiko',
														data:  <?= json_encode($risk_g_); ?>,
														backgroundColor: colors,
														borderColor: 'rgba(54, 162, 235, 1)',
														borderWidth: 1
													}]
												},
												options: {
													scales: {
														yAxes: [{
															ticks: {
																beginAtZero:true,
															}
														}]
													},
													legend: {
														display: false
													},
													animation: {
														duration: 1,
														onComplete: function () {
															var chartInstance = this.chart,
															ctx = chartInstance.ctx;
															ctx.textAlign = 'center';
															ctx.fillStyle = "rgba(0, 0, 0, 1)";
															ctx.textBaseline = 'bottom';
                                                    // Loop through each data in the datasets
                                                    this.data.datasets.forEach(function (dataset, i) {
                                                    	var meta = chartInstance.controller.getDatasetMeta(i);
                                                    	meta.data.forEach(function (bar, index) {
                                                    		var data = dataset.data[index];
                                                    		ctx.fillText(data, bar._model.x, bar._model.y - -7);
                                                    	});
                                                    });
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-4 col-md-4 col-lg-4">
                    	<div class="card ">
                    		<div class="card-header">
                    			<h4>Berdasarkan Status Temuan</h4><br>
                    		</div>
                    		<div class="card-body">
                    			<div style="width: 300px;height: 250px;">
                    				<canvas id="myChart2" style="width: 300px;height: 250px;"></canvas>
                    			</div>
                    			<script>
                    				var colors = [
											'rgba(255, 193, 7, 0.2)',		//yellow
											'rgba(0, 140, 186, 0.2)', 		//blue
											'rgba(76, 175, 80, 0.2)', 		//green
											'rgba(244, 67, 54, 0.2)', 		//red
											'rgba(52, 58, 64, 0.2)'         //dark
											];
											var ctx = document.getElementById("myChart2").getContext('2d');
											var myChart = new Chart(ctx, {
												type: 'bar',
												data: {
													labels: ['Open','Progress','Closed','Reject'],
													datasets: [{
														label: '#Temuan',
														data: [<?= $status['Open'] ?>, <?= $status['Progress'] ?>, <?= $status['Closed'] ?>, <?= $status['Reject'] ?>],
														backgroundColor: colors,
														borderColor: 'rgba(54, 162, 235, 1)',
														borderWidth: 1
													}]
												},
												options: {
													scales: {
														yAxes: [{
															ticks: {
																beginAtZero:true
															}
														}]
													},
													legend: {
														display: false
													},
													animation: {
														duration: 1,
														onComplete: function () {
															var chartInstance = this.chart,
															ctx = chartInstance.ctx;
															ctx.textAlign = 'center';
															ctx.fillStyle = "rgba(0, 0, 0, 1)";
															ctx.textBaseline = 'bottom';
                                                    // Loop through each data in the datasets
                                                    this.data.datasets.forEach(function (dataset, i) {
                                                    	var meta = chartInstance.controller.getDatasetMeta(i);
                                                    	meta.data.forEach(function (bar, index) {
                                                    		var data = dataset.data[index];
                                                    		ctx.fillText(data, bar._model.x, bar._model.y - -7);
                                                    	});
                                                    });
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-12">
                    	<div class="card ">
                    		<div class="card-header">
                    			<h4>Berdasarkan Lokasi Temuan</h4><br>
                    		</div>
                    		<div class="card-body">
                    			<div>
                    				<canvas id="myChart4" style="width: 1000px;height:300px;"></canvas>
                    			</div>
                    			<script>
                    				var ctx = document.getElementById("myChart4").getContext('2d');
                    				var myChart = new Chart(ctx, {
                    					type: 'bar',
                    					data: {
                    						labels: <?= json_encode($location_g); ?>,
                    						datasets: [{
                    							label: '#Lokasi',
                    							data:  <?= json_encode($location_g_); ?>,
                    							backgroundColor:'rgba(0, 140, 186, 0.2)',
                    							borderColor: 'rgba(0, 140, 186, 1)',
                    							borderWidth: 1
                    						}]
                    					},
                    					options: {
                    						scales: {
                    							yAxes: [{
                    								ticks: {
                    									beginAtZero:true
                    								}
                    							}],
                    							xAxes: [{
                    								ticks: {
                    									fontSize: 10
                    								}
                    							}]
                    						},
                    						legend: {
                    							display: false
                    						},
                    						animation: {
                    							duration: 1,
                    							onComplete: function () {
                    								var chartInstance = this.chart,
                    								ctx = chartInstance.ctx;
                    								ctx.textAlign = 'center';
                    								ctx.fillStyle = "rgba(0, 0, 0, 1)";
                    								ctx.textBaseline = 'bottom';
                                                    // Loop through each data in the datasets
                                                    this.data.datasets.forEach(function (dataset, i) {
                                                    	var meta = chartInstance.controller.getDatasetMeta(i);
                                                    	meta.data.forEach(function (bar, index) {
                                                    		var data = dataset.data[index];
                                                    		ctx.fillText(data, bar._model.x, bar._model.y - -7);
                                                    	});
                                                    });
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 col-md-12 col-lg-12">
                    	<div class="card ">
                    		<div class="card-header">
                    			<h4>Jumlah Lap. Hazob Tiap Bulan</h4><br>
                    		</div>
                    		<div class="card-body">
                    			<div>
                    				<canvas id="myChart5" style="width: 1000px;height:300px;"></canvas>
                    			</div>
                    			<script>
                    				var ctx = document.getElementById("myChart5").getContext('2d');
                    				var myChart = new Chart(ctx, {
                    					type: 'bar',
                    					data: {
                    						labels: ['JAN','FEB','MAR','APR','MEI','JUN','JUL','AGU','SEP','OKT','NOV','DES'],
                    						datasets: [{
                    							label: '#Lokasi',
                    							data: [<?= $month['jan'].','.$month['feb'].','.$month['mar'].','.$month['apr'].','.$month['mei'].','.$month['jun'].','.$month['jul'].','.$month['agu'].','.$month['sep'].','.$month['okt'].','.$month['nov'].','.$month['des'];?>],
                    							backgroundColor:'rgba(76, 175, 80, 0.2)', 		
                    							borderColor: 'rgba(76, 175, 80, 1)', 		
                    							borderWidth: 1
                    						}]
                    					},
                    					options: {
                    						scales: {
                    							yAxes: [{
                    								ticks: {
                    									beginAtZero:true
                    								}
                    							}],
                    							xAxes: [{
                    								ticks: {
                    									fontSize: 10
                    								}
                    							}]
                    						},
                    						legend: {
                    							display: false
                    						},
                    						animation: {
                    							duration: 1,
                    							onComplete: function () {
                    								var chartInstance = this.chart,
                    								ctx = chartInstance.ctx;
                    								ctx.textAlign = 'center';
                    								ctx.fillStyle = "rgba(0, 0, 0, 1)";
                    								ctx.textBaseline = 'bottom';
                                                    // Loop through each data in the datasets
                                                    this.data.datasets.forEach(function (dataset, i) {
                                                    	var meta = chartInstance.controller.getDatasetMeta(i);
                                                    	meta.data.forEach(function (bar, index) {
                                                    		var data = dataset.data[index];
                                                    		ctx.fillText(data, bar._model.x, bar._model.y - -7);
                                                    	});
                                                    });
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-12 col-lg-12">
                    	<div class="card ">
                    		<div class="card-header">
                    			<h4>Berdasarkan Divisi Pelapor</h4><br>
                    		</div>
                    		<div class="card-body">
                    			<div>
                    				<canvas id="myChart6" style="width: 1000px;height:300px;"></canvas>
                    			</div>
                    			<script>
                    				var ctx = document.getElementById("myChart6").getContext('2d');
                    				var myChart = new Chart(ctx, {
                    					type: 'bar',
                    					data: {
                    						labels: <?= json_encode($divisi_g); ?>,
                    						datasets: [{
                    							label: '#Lokasi',
                    							data: <?= json_encode($divisi_g_); ?>,		
                    							backgroundColor:'rgba(244, 67, 54, 0.2)', 		
                    							borderColor: 'rgba(244, 67, 54, 1)', 
                    							borderWidth: 1
                    						}]
                    					},
                    					options: {
                    						scales: {
                    							yAxes: [{
                    								ticks: {
                    									beginAtZero:true
                    								}
                    							}],
                    							xAxes: [{
                    								ticks: {
                    									fontSize: 10
                    								}
                    							}]
                    						},
                    						legend: {
                    							display: false
                    						},
                    						animation: {
                    							duration: 1,
                    							onComplete: function () {
                    								var chartInstance = this.chart,
                    								ctx = chartInstance.ctx;
                    								ctx.textAlign = 'center';
                    								ctx.fillStyle = "rgba(0, 0, 0, 1)";
                    								ctx.textBaseline = 'bottom';
                                                    // Loop through each data in the datasets
                                                    this.data.datasets.forEach(function (dataset, i) {
                                                    	var meta = chartInstance.controller.getDatasetMeta(i);
                                                    	meta.data.forEach(function (bar, index) {
                                                    		var data = dataset.data[index];
                                                    		ctx.fillText(data, bar._model.x, bar._model.y - -7);
                                                    	});
                                                    });
                                                }
                                            }
                                        }
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
        	function printDiv() {
        		var divContents = document.getElementById("grafiks").innerHTML;
        		var a = window.open('', '', 'height=500, width=500');
        		a.document.write('<html>');
        		a.document.write('<body>');
        		a.document.write(divContents);
        		a.document.write('</body></html>');
        		a.document.close();
						// a.print();
					}
				</script>


				<script defer onload="MyStuff.domLoaded();">
					function printDiv2() {
						var divContents = document.getElementById("summarys").innerHTML;
						var a = window.open('', '', 'height=500, width=500');
						a.document.write(' <link defer rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><html>');
						a.document.write('<body>');
						a.document.write(divContents);
						a.document.write('</body></html>');
						a.document.close();
						// a.print();
					}
				</script>

