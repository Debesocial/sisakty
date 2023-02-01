
<!-- Modal Menu Lainnya -->
<div class="modal transition-bottom -inside screenFull defaultModal mdlladd__rate fade" id="menu" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content rounded-15">

			<div class="modal-header padding-l-20 padding-r-20 py-3 justify-content-center">
				<div class="itemProduct_sm">
					<h1 class="size-13 weight-500 color-comment m-0">Lainnya</h1>
				</div>
			</div>

			<div class="modal-body rounded-15 p-0">
				<section class="em__bkOperationsWallet other_option">
					<div class="em__actions">
						<a href="home.php?v=faq" class="btn">
							<div class="icon bg-green bg-opacity-10">
								<img src="../assets/icon/outline/message-question.svg" width="25">
							</div>
							<span>FAQ</span>
						</a>
						<a href="home.php?v=iupdate&act=data" class="btn">
							<div class="icon bg-blue bg-opacity-10">
								<img src="../assets/icon/outline/info-circle.svg" width="25">
							</div>
							<span>i-Update</span>
						</a>
						<a href="home.php?v=bulletin&act=data" class="btn">
							<div class="icon bg-red bg-opacity-10">
								<img src="../assets/icon/outline/document.svg" width="25">
							</div>
							<span>Bulletin</span>
						</a>
						 <a href="#" data-toggle="modal" data-target="#contact"class="btn">
							<div class="icon bg-yellow bg-opacity-10">
								<img src="../assets/icon/outline/call.svg" width="25">
							</div>
							<span>Contact</span>
						</a>
					</div>
				</section>
			</div>
		</div>
	</div>
</div>

<!-- Modal Contact -->
<div class="modal transition-bottom -inside screenFull defaultModal mdlladd__rate fade" id="contact" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content rounded-15">

			<div class="modal-header padding-l-20 padding-r-20 py-3 justify-content-center">
				<div class="itemProduct_sm">
					<h1 class="size-13 weight-500 color-comment m-0">Contact Center</h1>
				</div>
			</div>

			<div class="modal-body rounded-15 p-0">
				<section class="em__bkOperationsWallet other_option">
					<center>
							<a href="tel:08115993337" class="btn">
								<img src="../assets/icon/outline/shield.svg"  width="15" style="opacity: 0.5;">&nbsp; Safety 08115993337</span>
							</a>
							<a href="tel:081346500119" class="btn">
								<img src="../assets/icon/outline/hospital.svg"  width="15" style="opacity: 0.5;">&nbsp; Klinik 081346500119</span>
							</a>
			    	</center>
				</section>
			</div>
		</div>
	</div>
</div>

<!-- Modal Search / Filter -->
<div class="modal transition-bottom screenFull defaultModal emModal__filters fade" id="mdllFilterJobs" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header border-0 padding-l-20 padding-r-20 justify-content-center">
				<div class="itemProduct_sm">
					<h1 class="size-18 weight-600 color-secondary m-0">Search</h1>
				</div>
				<div class="absolute right-0 padding-r-20">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i class="tio-clear"></i>
					</button>
				</div>
				<div class="absolute left-0 padding-l-20">
					<!-- <span class="color-blue size-14">- Clear</span> -->
				</div>
			</div>
			<div class="modal-body">
				<form action="" method="post">
					<div class="form-group">
						<label>Start Date</label>
						<div class="input_group">
							<input name="start" type="date" class="form-control" id="date" placeholder="date" required="" value="<?=date('Y-m-d') ?>">
						</div>
					</div>
					<div class="form-group">
						<label>End Date</label>
						<div class="input_group">
							<input name="end" type="date" class="form-control" id="date" placeholder="date" required="" value="<?=date('Y-m-d') ?>">
						</div>
					</div>
					<div class="form-group">
						<button type="submit" id="submit" name="submit" class="btn bg-primary form-control" style="color:white;">Search</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal Sidebar -->
<div class="modal sidebarMenu -left -withBackground fade" id="mdllSidebarMenu-background" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-scrollable">
		<div class="modal-content">
			<div class="modal-header">
				<div class="em_profile_user">
					<div class="media">
						<a href="#">
							<img class="_imgUser" src="../assets/img/person.jpg" alt="">
						</a>
						<div class="media-body">
							<div class="txt">
							    <h3>Hi, Welcome</h3>
								<p>SISAKTY Application</p>
							</div>
						</div>
					</div>
				</div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<i class="tio-clear"></i>
				</button>
			</div>
			<div class="modal-body">
				<ul class="nav flex-column -active-links">
					<label class="title__label">Menu</label>
					<li class="nav-item">
						<a class="nav-link" href="home.php?v=hazard">
							<div class="icon_current">
								<img src="../assets/icon/outline/warnings.svg" width="23" style="opacity: 0.5;">
								<span class="title_link">Hazard Report</span>
							</div>

						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"  onclick="commingsoon()">
							<div class="icon_current">
								<img src="../assets/icon/outline/idcard.svg" width="23" style="opacity: 0.5;">
								<span class="title_link">Mine Permit</span>
							</div>

						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#"  onclick="commingsoon()">
							<div class="icon_current">
								<img src="../assets/icon/outline/simcards.svg" width="23" style="opacity: 0.5;">
								<span class="title_link">SIM Permit</span>
							</div>

						</a>
					</li>
					<li class="nav-item">
                    <?php if($_login == 'Y'){?>
						<a class="nav-link" href="home.php?v=achivement">
							<div class="icon_current">
								<img src="../assets/icon/outline/trophy.svg" width="23" style="opacity: 0.5;">
								<span class="title_link">Achivement</span>
							</div>

						</a>
					<?php } else { ?>
						<a class="nav-link" href="../controller/logout.php">
							<div class="icon_current">
								<img src="../assets/icon/outline/trophy.svg" width="23" style="opacity: 0.5;">
								<span class="title_link">Achivement</span>
							</div>

						</a>
					<?php } ?>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="home.php?v=iupdate&act=data">
							<div class="icon_current">
								<img src="../assets/icon/outline/info-circle.svg" width="23" style="opacity: 0.5;">
								<span class="title_link">Info Update</span>
							</div>

						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="home.php?v=bulletin&act=data">
							<div class="icon_current">
								<img src="../assets/icon/outline/document.svg" width="23" style="opacity: 0.5;">
								<span class="title_link">SHE Bulletin</span>
							</div>

						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="home.php?v=faq">
							<div class="icon_current">
								<img src="../assets/icon/outline/message-question.svg" width="23" style="opacity: 0.5;">
								<span class="title_link">FAQ</span>
							</div>

						</a>
					</li>
					<label class="title__label">Personal</label>
                    <?php if($_login == 'Y'){?>
					<li class="nav-item">
						<a class="nav-link" href="home.php?v=profil">
							<div class="icon_current">
								<img src="../assets/icon/outline/user.svg" width="23" style="opacity: 0.5;">
								<span class="title_link">Profil</span>
							</div>

						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="home.php?v=bookmark">
							<div class="icon_current">
								<img src="../assets/icon/outline/bookmark.svg" width="23" style="opacity: 0.5;">
								<span class="title_link">Bookmark</span>
							</div>

						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#" data-toggle="modal" data-target="#logout" >
							<div class="icon_current">
								<img src="../assets/icon/outline/logout.svg" width="23" style="opacity: 0.5;">
								<span class="title_link">Logout</span>
							</div>
						</a>
					</li>
					<?php } else { ?>
					<li class="nav-item">
						<a class="nav-link" href="../controller/logout.php">
							<div class="icon_current">
								<img src="../assets/icon/outline/user.svg" width="23" style="opacity: 0.5;">
								<span class="title_link">Profil</span>
							</div>

						</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="../controller/logout.php">
							<div class="icon_current">
								<img src="../assets/icon/outline/bookmark.svg" width="23" style="opacity: 0.5;">
								<span class="title_link">Bookmark</span>
							</div>

						</a>
					</li>
					<li class="nav-item">
    					<a class="nav-link" href="home.php?v=login">
    						<div class="icon_current">
        							<img src="../assets/icon/outline/login.svg" width="23" style="opacity: 0.5;">
        							<span class="title_link">Login</span>
    						</div>
    					</a>
					</li>
					<?php } ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- Modal Logout -->
<div class="modal bttom_show defaultModal mdll_removeStand fade" id="logout" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<div class="content__remove">
					<div class="media">
						<div class="icon">
							<img src="../assets/icon/outline/logout.svg" >
						</div>
						<div class="media-body">
							<div class="txt">
								<h2>Logout ?</h2>
								<p>Are you sure to logout ?</p>
							</div>
						</div>
					</div>
				</div>

			</div>
			<div class="modal-footer">
				<button type="button" data-dismiss="modal"class="btn btn__cancel mr-1 size-15 color-text min-w-100 h-40 d-flex align-items-center rounded-8 justify-content-center">Cancel</button>
				<a href="../controller/logout.php" class="btn bg-primary min-w-100 m-0 size-15 color-white h-40 d-flex align-items-center rounded-8 justify-content-center">
					Logout
				</a>
			</div>
		</div>
	</div>
</div>

<!-- Modal Delete -->
<div class="modal bttom_show defaultModal mdll_removeStand fade" id="hazard-del" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-body">
				<div class="content__remove">
					<div class="media">
						<div class="icon">
							<img src="../assets/icon/outline/trash.svg" >
						</div>
						<div class="media-body">
							<div class="txt">
								<h2>Hapus ?</h2>
								<p>Yakin ingin menghapus laporan ini ?</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<form action="" id="delete-hazard">
				<div class="modal-footer">
					<input type="text" name="id_user" value="<?=$_id?>" hidden>
					<input type="text" name="id_hazard" value="<?=base64_decode($_GET['id'])?>" hidden>
					<textarea type="text" class="form-control" name="reason" id="reason" placeholder="Alasan menghapus laporan..." required=""></textarea>
					<p id="demod">
						<button type="button" data-dismiss="modal"class="btn btn__cancel mr-1 size-15 color-text min-w-100 h-40 d-flex align-items-center rounded-8 justify-content-center">Cancel</button>
						<button  type="submit" id="hazard-delete" class="btn bg-primary min-w-100 m-0 size-15 color-white h-40 d-flex align-items-center rounded-8 justify-content-center">Hapus</button>
					</p>
				</div>
			</form>
		</div>
	</div>
</div>
