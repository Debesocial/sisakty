   <!-- Start main_haeder -->
   <header class="main_haeder header-sticky bg-transparent multi_item">
   	<div class="em_side_right">
   		<a class="btn btn__back rounded-circle bg-snow" onclick="history.go(-1)">
   			<i class="tio-chevron_left"></i>
   		</a>
   	</div>
   	<div class="title_page">
   		<h1 class="page_name">
   			Hazard Report
   		</h1>
   	</div>
   	<div class="em_side_right">
   	</div>
   </header>
   <!-- End.main_haeder -->

   <?php if($_login == 'Y') {?>
   	<!-- Start emPage__activities -->
   	<section class="margin-b-20 emPage__CateJobs withOut_colorful padding-l-20 padding-r-20 padding-t-70">
   		<a href="home.php?v=hazard-user&status=all" class="emCategorie_itemJobs _list bg-blue">
   			<div class="icon">
   				<svg id="Iconly_Bulk_Chart" data-name="Iconly/Bulk/Chart" xmlns="http://www.w3.org/2000/svg"
   				width="20" height="20" viewBox="0 0 20 20">
   				<g id="Chart" transform="translate(1.667 1.667)">
   					<path id="Fill_1" data-name="Fill 1"
   					d="M12.23,0H4.444C1.607,0,0,1.607,0,4.444v7.778c0,2.837,1.607,4.444,4.444,4.444H12.23c2.837,0,4.437-1.607,4.437-4.444V4.444C16.667,1.607,15.067,0,12.23,0"
   					fill="#fff" opacity="0.4" />
   					<path id="Fill_4" data-name="Fill 4"
   					d="M.689,0A.694.694,0,0,0,0,.7V6.422a.693.693,0,0,0,1.385,0V.7a.7.7,0,0,0-.7-.7"
   					transform="translate(3.785 6.141)" fill="#fff" />
   					<path id="Fill_6" data-name="Fill 6"
   					d="M.689,0A.694.694,0,0,0,0,.7V9.156a.693.693,0,0,0,1.385,0V.7a.7.7,0,0,0-.7-.7"
   					transform="translate(7.674 3.407)" fill="#fff" />
   					<path id="Fill_8" data-name="Fill 8"
   					d="M.7,0A.7.7,0,0,0,0,.7V3.4a.693.693,0,0,0,1.385,0V.7A.694.694,0,0,0,.7,0"
   					transform="translate(11.504 9.163)" fill="#fff" />
   				</g>
   			</svg>
   		</div>
   		<div class="txt">
   			<h2>Laporan Saya</h2>
   			<p>Riwayat hazard report</p>
   		</div>
   	</a>
   	<?php if($_pic == 'Y') {?>
   		<a href="home.php?v=hazard-pic&status=all" class="emCategorie_itemJobs _list bg-green">
   			<div class="icon">
   				<svg id="Iconly_Bulk_Work" data-name="Iconly/Bulk/Work" xmlns="http://www.w3.org/2000/svg"
   				width="20" height="20" viewBox="0 0 20 20">
   				<g id="Work" transform="translate(1.667 1.667)">
   					<path id="Fill_1" data-name="Fill 1"
   					d="M0,0C.042,1.948.158,5.281.175,5.648A3.876,3.876,0,0,0,1,7.788,3.074,3.074,0,0,0,3.577,8.925c1.547.008,3.252.008,4.907.008s3.276,0,4.638-.008A3.111,3.111,0,0,0,15.7,7.788a3.762,3.762,0,0,0,.812-2.14c.017-.309.1-3.927.15-5.648Z"
   					transform="translate(0 7.565)" fill="#fff" opacity="0.4" />
   					<path id="Fill_4" data-name="Fill 4"
   					d="M0,.625V1.7a.625.625,0,0,0,1.25,0V.625A.625.625,0,0,0,0,.625"
   					transform="translate(7.704 10.528)" fill="#fff" />
   					<path id="Fill_6" data-name="Fill 6"
   					d="M10.394,10.931a.625.625,0,0,1-.606-.47A1.5,1.5,0,0,0,8.325,9.332a1.522,1.522,0,0,0-1.483,1.131.629.629,0,0,1-.6.46.653.653,0,0,1-.084-.006A14.3,14.3,0,0,1,.28,8.734.623.623,0,0,1,0,8.213V5.324A3.181,3.181,0,0,1,3.181,2.151H4.82A2.466,2.466,0,0,1,7.253,0H9.4a2.465,2.465,0,0,1,2.433,2.151h1.648a3.176,3.176,0,0,1,3.173,3.173V8.213a.627.627,0,0,1-.28.522,14.286,14.286,0,0,1-5.9,2.191A.666.666,0,0,1,10.394,10.931ZM7.253,1.25a1.217,1.217,0,0,0-1.169.9h4.49A1.216,1.216,0,0,0,9.4,1.25Z"
   					transform="translate(0 0)" fill="#fff" />
   				</g>
   			</svg>
   		</div>
   		<div class="txt">
   			<h2>Halaman PIC</h2>
   			<p>Halaman untuk mengelola hazard report <br>yang dilaporkan ke Divisi <?= $_divisi?></p>
   		</div>
   	</a>
   <?php } ?>
</section>
<?php } ?>

<!-- End. emPage__activities -->
<div class="emCoureses__grid course__list bg-white"><br><br><br>
	<div class="border-text margin-b-30">
		<div class="lined">
			<span class="text">Hazard Report</span>
		</div>
	</div>

	<div class="input_SaerchDefault">
		<div class="form-group with_icon mb-0" data-toggle="modal" data-target="#mdllFilterJobs">
			<div class="input_group">
				<?php 
				if(isset($_POST["submit"])){?>
					<input type="search" class="form-control h-48" placeholder="PERIODE : <?= $_POST["start"]; ?> s/d <?= $_POST["end"]; ?>" disabled="">
				<?php } else {?>
					<input type="search" class="form-control h-48" placeholder="Search.." disabled="">
				<?php } ?>
				<div class="icon">
					<svg id="Iconly_Two-tone_Search" data-name="Iconly/Two-tone/Search"
					xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
					<g id="Search" transform="translate(2 2)">
						<circle id="Ellipse_739" cx="8.989" cy="8.989" r="8.989"
						transform="translate(0.778 0.778)" fill="none" stroke="#200e32"
						stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
						stroke-width="1.5" />
						<path id="Line_181" d="M0,0,3.524,3.515" transform="translate(16.018 16.485)"
						fill="none" stroke="#200e32" stroke-linecap="round" stroke-linejoin="round"
						stroke-miterlimit="10" stroke-width="1.5" opacity="0.4" />
					</g>
				</svg>
			</div>
			<div class="side_voice">
				<button type="button" class="btn ml-1" data-toggle="modal" data-target="#mdllFilter">
					<svg id="Iconly_Two-tone_Filter" data-name="Iconly/Two-tone/Filter"
					xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
					<g id="Filter" transform="translate(2 2.5)">
						<path id="Stroke_1" data-name="Stroke 1" d="M7.234.588H0"
						transform="translate(0.883 14.898)" fill="none" stroke="#200e32"
						stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
						stroke-width="1.5" opacity="0.4" />
						<path id="Stroke_3" data-name="Stroke 3"
						d="M5.76,2.88A2.88,2.88,0,1,1,2.88,0,2.88,2.88,0,0,1,5.76,2.88Z"
						transform="translate(13.358 12.607)" fill="none" stroke="#200e32"
						stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
						stroke-width="1.5" />
						<path id="Stroke_5" data-name="Stroke 5" d="M0,.588H7.235"
						transform="translate(11.883 3.174)" fill="none" stroke="#200e32"
						stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
						stroke-width="1.5" opacity="0.4" />
						<path id="Stroke_7" data-name="Stroke 7"
						d="M0,2.88A2.88,2.88,0,1,0,2.88,0,2.879,2.879,0,0,0,0,2.88Z"
						transform="translate(0.883 0.882)" fill="none" stroke="#200e32"
						stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="10"
						stroke-width="1.5" />
					</g>
				</svg>
			</button>
		</div>
	</div>
</div>
</div><br>

<div class="em_bodyCarousel padding-t-0">
        <?php //HAZARD
        if(isset($_POST["submit"])){
        	$start = $_POST["start"];
        	$end   = $_POST["end"];
        	$sql = mysqli_query($conn,"SELECT * FROM hazard  
        		LEFT JOIN user ON user.user_id = hazard.hazard_user
        		LEFT JOIN location ON location.loc_id = hazard.hazard_loc 
        		LEFT JOIN classification ON classification.classi_id = hazard.hazard_classi
        		WHERE hazard.hazard_approve = 'Y' 
        		AND CAST(hazard.hazard_date AS DATE) >= '$start'
        		AND CAST(hazard.hazard_date AS DATE) <= '$end'
        		ORDER BY hazard.hazard_id DESC"); 
        } else {
        	$sql = mysqli_query($conn,"SELECT * FROM hazard  
        		LEFT JOIN user ON user.user_id = hazard.hazard_user
        		LEFT JOIN location ON location.loc_id = hazard.hazard_loc 
        		LEFT JOIN classification ON classification.classi_id = hazard.hazard_classi
        		WHERE hazard.hazard_approve = 'Y' 
        		AND hazard.hazard_loc != ''
        		ORDER BY hazard.hazard_id DESC LIMIT 30"); 
        }
        while(@$row = mysqli_fetch_array($sql)) {
        	echo'
        	<div class="em_itemCourse_grid w-100">
        	<a href="home.php?v=hazard-detail&id='.base64_encode($row['hazard_id']).'" class="card margin-b-20">
        	<div class="cover_card">';
        	if ($row['hazard_photo'] != NULL){
        		echo'<img src="../assets/hazard/thumbnail/'.$row['hazard_photo'].'" class="card-img-top" alt="img">';
        	} else {
                // echo'<img src="../assets/hazard/noimages.jpg" class="card-img-top" alt="img">';
        	}
        	echo'
        	</div>
        	<div class="card-body">
        	<div class="head_card mb-1">
        	';
        	if ($row['hazard_status'] == 'Open'){
        		echo'<span class="badge badge-pill badge-warning" style="color: #ffffff;font-weight: 10;">Open</span> ';
        	} elseif ($row['hazard_status'] == 'Progress'){
        		echo'<span class="badge badge-pill badge-primary" style="color: #ffffff;font-weight: 10;">Progress</span> ';
        	} elseif ($row['hazard_status'] == 'Closed'){
        		echo'<span class="badge badge-pill badge-success" style="color: #ffffff;font-weight: 10;">Closed</span> ';
        	} elseif ($row['hazard_status'] == 'Reject'){
        		echo'<span class="badge badge-pill badge-danger" style="color: #ffffff;font-weight: 10;">Rejected</span> ';
        	}
        	echo'
        	<span style="overflow: hidden;
        	white-space: nowrap;
        	text-overflow: ellipsis;
        	margin: 0;">&nbsp;|&nbsp;'.$row['loc_name'].'</span>
        	<span style="overflow: hidden;
        	white-space: nowrap;
        	text-overflow: ellipsis;
        	margin: 0;">'.$row['hazard_date'].'</span>
        	</div>
        	<h6 class="card-title size-18 weight-600 mb-0" 
        	style="overflow: hidden;
        	white-space: nowrap;
        	text-overflow: ellipsis;
        	margin: 0;">
        	'.$row['hazard_name'].'
        	</h6>
        	<p class="card-text size-15">
        	'.$row['hazard_desc'].'
        	</p>
        	</div>
        	</a>
        	</div>
        	';
        }?>
    </div>
</div>

