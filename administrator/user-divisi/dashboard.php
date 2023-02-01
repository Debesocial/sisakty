<!-- DASHBOARD -->
<div class="alert alert-info alert-dismissible fade show" role="alert" style=" opacity:100;">
	<strong>Hallo !</strong> Selamat datang di halaman administrator aplikasi SISAKTY 
	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
	</button>
</div>

<div class="row ">
	<div class="col-3">
		<h6>INFORMATION</h6>
		<hr>
		<div class="card card-secondary" style="min-height: 315px;">
			<div class="card-statistic-4">
				<div class="align-items-center justify-content-between">
					<div class="card-content">
						<h6>Info Update</h6>
						<?php 
						@$iupdate=mysqli_fetch_array($conn->query("SELECT * FROM iupdate ORDER BY iupdate_id DESC LIMIT 1 "));
						echo $iupdate['iupdate_desc'];?> 
						<br><a target="_blank" href="../../assets/iupdate/<?=$iupdate['iupdate_file']?>">Download Lampiran</a>
					</div>
				</div>
			</div>
			<div class="card-statistic-4">
				<div class="align-items-center justify-content-between">
					<div class="card-content">
						<h6>Bulletin</h6>
						<?php 
						@$bulletin=mysqli_fetch_array($conn->query("SELECT * FROM bulletin ORDER BY bulletin_id DESC LIMIT 1 "));
						echo $bulletin['bulletin_desc'];?> 
						<br><a target="_blank" href="../../assets/bulletin/<?=$bulletin['bulletin_file']?>">Download Lampiran</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-3">
		<h6>MINE PERMIT</h6><hr>
		<div class="card card-warning" style="margin-bottom: 10px;">
			<div class="card-statistic-4" style="padding: 10px;">
				<div class="card-content">
					Menunggu Approval Safety MIP
					<?php 
					@$date1 = date("Y-01-01");
					@$date2 = date("Y-12-31");
					@$new=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM mpermit 
						LEFT JOIN user on user.user_id = mpermit.mpermit_user
						where mpermit.mpermit_status_approval = 'Open'
						and mpermit.mpermit_pic = ".$_SESSION['user_comp']."
						and user.user_divisi = ".$_SESSION['user_divisi'].""));?>
						<form action="home.php?v=mpermit" method="post">
							<button style="padding:0;" type="submit" value="open" name="open" class="btn"><h5 class="font-15" style="color: #6777ef;"><?= $new['total'];?> Pengajuan</h5></button>
						</form>
					</div>
				</div>
			</div>

			<div class="card card-primary" style="margin-bottom: 10px;">
				<div class="card-statistic-4" style="padding: 10px;">
					<div class="card-content">
						Menunggu Approval KTT
						<?php 
						@$date1 = date("Y-01-01");
						@$date2 = date("Y-12-31");
						@$new=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM mpermit
							LEFT JOIN user on user.user_id = mpermit.mpermit_user
							where mpermit.mpermit_status_approval = 'Progress'
							and mpermit.mpermit_pic = ".$_SESSION['user_comp']."
							and user.user_divisi = ".$_SESSION['user_divisi'].""));?>
							<form action="home.php?v=mpermit" method="post">
								<button style="padding:0;" type="submit" value="progress" name="progress" class="btn"><h5 class="font-15" style="color: #6777ef;"><?= $new['total'];?> Pengajuan</h5></button>
							</form>
						</div>
					</div>
				</div>

				<div class="card card-danger" style="margin-bottom: 10px;">
					<div class="card-statistic-4" style="padding: 10px;">
						<div class="align-items-center justify-content-between">
							<div class="card-content">
								<?php
								$hariIni = new DateTime();
								echo 'Mine Permit yang ditolak';?>
								<?php 
								@$VMONTH = DATE('m');
								@$VYEAR = DATE('Y');
								@$new=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM mpermit
									LEFT JOIN user on user.user_id = mpermit.mpermit_user
									where mpermit.mpermit_status_approval = 'Reject'
									and mpermit.mpermit_pic = ".$_SESSION['user_comp']."
									and user.user_divisi = ".$_SESSION['user_divisi'].""));?>
									<form action="home.php?v=mpermit" method="post">
										<button style="padding:0;" type="submit" value="reject" name="reject" class="btn"><h5 class="font-15" style="color: #6777ef;"><?= $new['total'];?> Pengajuan</h5></button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="card card-success" style="margin-bottom: 10px;">
						<div class="card-statistic-4" style="padding: 10px;">
							<div class="align-items-center justify-content-between">
								<div class="card-content">
									<?php
									$hariIni = new DateTime();
									echo 'Mine Permit yang telah di Disetujui';?>
									<?php 
									@$VMONTH = DATE('m');
									@$VYEAR = DATE('Y');
									@$new=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM mpermit
										LEFT JOIN user on user.user_id = mpermit.mpermit_user
										where mpermit.mpermit_status_approval = 'Closed'
										and mpermit.mpermit_pic = ".$_SESSION['user_comp']."
										and user.user_divisi = ".$_SESSION['user_divisi'].""));?>
										<form action="home.php?v=mpermit" method="post">
											<button style="padding:0;" type="submit" value="closed" name="closed" class="btn"><h5 class="font-15" style="color: #6777ef;"><?= $new['total'];?> Pengajuan</h5></button>
										</form>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-6">
						<h6>HAZARD REPORT <small>( Berdasarkan Status Temuan <?=date("Y")?> )</small></h6><hr>

						<?php
						$date1 = date("Y-01-01");
						$date2 = date("Y-12-31");
						@$status_review   = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
							left join company on company.comp_id = hazard.hazard_comp
							where company.comp_id = ".$_SESSION['user_comp']."
							and hazard.hazard_divisi = ".$_SESSION['user_divisi']."
							and hazard.hazard_status = 'Review' 
							and hazard.hazard_approve = '' 
							and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' 
							and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'"));

						@$status_open     = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard
							left join company on company.comp_id = hazard.hazard_comp
							where company.comp_id = ".$_SESSION['user_comp']." 
							and hazard.hazard_divisi = ".$_SESSION['user_divisi']."
							and hazard.hazard_status = 'Open' 
							and hazard.hazard_approve = 'Y' 
							and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' 
							and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'"));

						@$status_progress = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
							left join company on company.comp_id = hazard.hazard_comp
							where company.comp_id = ".$_SESSION['user_comp']."
							and hazard.hazard_divisi = ".$_SESSION['user_divisi']."
							and hazard.hazard_status = 'Progress'
							and hazard.hazard_approve = 'Y' 
							and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' 
							and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'"));

						@$status_closed   = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
							left join company on company.comp_id = hazard.hazard_comp
							where company.comp_id = ".$_SESSION['user_comp']."
							and hazard.hazard_divisi = ".$_SESSION['user_divisi']."
							and hazard.hazard_status = 'Closed' 
							and hazard.hazard_approve = 'Y' 
							and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' 
							and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'"));

						@$status_reject   = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard
							left join company on company.comp_id = hazard.hazard_comp
							where company.comp_id = ".$_SESSION['user_comp']." 
							and hazard.hazard_divisi = ".$_SESSION['user_divisi']."
							and hazard.hazard_status = 'Reject' 
							and hazard.hazard_approve = 'Y' 
							and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1' 
							and DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'"));

							?>

							<script type="text/javascript" src="../../assets/js/chartjs/Chart.js"></script>
							<div class="card ">
								<div class="card-body">
									<canvas id="my" style="width: 300px;height: 150px;"></canvas>
									<script>
										var colors = [
										'rgba(255, 193, 7, 0.2)',		
										'rgba(0, 140, 186, 0.2)', 		
										'rgba(76, 175, 80, 0.2)', 		
										'rgba(244, 67, 54, 0.2)', 		
										'rgba(52, 58, 64, 0.2)'         
										];
										var ctx = document.getElementById("my").getContext('2d');
										var myChart = new Chart(ctx, {
											type: 'bar',
											data: {
												labels: ['Open','Progress','Closed','Reject'],
												datasets: [{
													label: '#Temuan',
													data: [<?php echo $status_open['total'] ?>, <?php echo $status_progress['total'] ?>, <?php echo $status_closed['total'] ?>, <?php echo $status_reject['total'] ?>],
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
											}
										});
									</script>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-6">
							<div class="card ">
								<div class="card-header">
									<h4>Pengajuan Mine Permit Terbaru</h4>
								</div>
								<div class="card-body">
									<div class="row">
										<table class="table table-striped table-sm" width="100%">
											<thead>
												<tr>
													<th width="25%">Status Timeline</th>
													<th>Tanggal Pengajuan</th>
													<th>Nama</th>
												</tr>
											</thead>
											<tbody>
												<?php 
												$data = mysqli_query($conn,"SELECT * FROM mpermit 
													LEFT JOIN user on user.user_id = mpermit.mpermit_user
													LEFT JOIN company on company.comp_id = user.user_comp
													WHERE mpermit.mpermit_pic = ".$_SESSION['user_comp']."
													and user.user_divisi = ".$_SESSION['user_divisi']."
													ORDER BY mpermit.mpermit_id DESC LIMIT 4");
													while($row  = mysqli_fetch_array($data)){?>
														<tr>
															<td style="width: 50px;">
																<?php if ($row['mpermit_status_approval'] == 'Open') {
																	echo'<span class="badge badge-pill badge-warning">&nbsp;&nbsp;&nbsp;Open&nbsp;&nbsp;</span>';
																} elseif ($row['mpermit_status_approval'] == 'Progress') {
																	echo'<span class="badge badge-pill badge-primary">Progress</span>';
																} elseif ($row['mpermit_status_approval'] == 'Closed') {
																	echo'<span class="badge badge-pill badge-success">&nbsp;&nbsp;Closed&nbsp;&nbsp;</span>';
																} elseif ($row['mpermit_status_approval'] == 'Reject') {
																	echo'<span class="badge badge-pill badge-danger">&nbsp;&nbsp;Reject&nbsp;&nbsp;</span>';
																} elseif ($row['mpermit_status_approval'] == 'Cancel') {
																	echo'<span class="badge badge-pill badge-danger">&nbsp;&nbsp;Cancel&nbsp;&nbsp;</span>';
																}?>
															</td>
															<td>Status Pengajuan : <?= $row['mpermit_status']?><br><?= $row['mpermit_date']?></td>
															<td><a href="home.php?v=muser&act=detail&id=<?= $row['user_id']; ?>"><?= $row['user_name']?></a></td>
														</tr>
													<?php } ?>
												</tbody>
											</table>
											<i>* Untuk informasi lebih lengkap dapat di akses pada menu <strong>'MINE PERMIT'</strong>.</i>
										</div>
									</div>
								</div>
							</div>

							<div class="col-6">
								<div class="card ">
									<div class="card-header">
										<h4>Hazard Report Terbaru</h4>
									</div>
									<div class="card-body">
										<div class="row">
											<table class="table table-striped table-sm">
												<thead>
													<tr>
														<th style="width: 20%">Status</th>
														<th style="width: 20%">Tanggal</th>
														<th style="width: 60%">Temuan</th>
													</tr>
												</thead>
												<tbody>
													<?php 
													@$data = mysqli_query($conn,"SELECT * FROM hazard
														ORDER BY hazard.hazard_id DESC LIMIT 4");
														while($row  = mysqli_fetch_array($data)){;?>
															<tr>
																<td>
																	<?php if($row['hazard_status'] == 'Review') {
																		echo'<span class="badge badge-pill badge-secondary">&nbsp;Review&nbsp;&nbsp;</span>';
																	} elseif ($row['hazard_status'] == 'Open') {
																		echo'<span class="badge badge-pill badge-warning">&nbsp;&nbsp;&nbsp;&nbsp;Open&nbsp;&nbsp;</span>';
																	} elseif ($row['hazard_status'] == 'Progress') {
																		echo'<span class="badge badge-pill badge-primary">Progress</span>';
																	} elseif ($row['hazard_status'] == 'Closed') {
																		echo'<span class="badge badge-pill badge-success">&nbsp;&nbsp;Closed&nbsp;&nbsp;</span>';
																	} elseif ($row['hazard_status'] == 'Reject') {
																		echo'<span class="badge badge-pill badge-danger">&nbsp;&nbsp;Reject&nbsp;&nbsp;&nbsp;</span>';
																	}?>
																</td>
																<td><?= date('d-m-Y', strtotime($row['hazard_date']));?><BR>
																	<small><?= date('H:i:s', strtotime($row['hazard_date']));?></small></td>
																	<td><?= 'HZ'.str_pad($row['hazard_id'],5,"0",STR_PAD_LEFT);?><BR>
																		<?= $row['hazard_desc']; ?>
																	</td>
																</tr>
															<?php } ?>
														</tbody>
													</table>
													<i>* Untuk informasi lebih lengkap dapat di akses pada menu <strong>'HAZARD REPORT'</strong>.</i>
												</div>
											</div>
										</div>
									</div>
								</div>
