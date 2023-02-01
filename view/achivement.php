<?php
$year = date('Y');
@$user = $_SESSION['user_id'];
@$jan = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
    where MONTH( hazard_date ) = '01' and YEAR( hazard_date ) = '$year' and hazard_user = '$user'")); 
@$feb = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
    where MONTH( hazard_date ) = '02' and YEAR( hazard_date ) = '$year' and hazard_user = '$user'")); 
@$mar = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
    where MONTH( hazard_date ) = '03' and YEAR( hazard_date ) = '$year' and hazard_user = '$user'")); 
@$apr = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
    where MONTH( hazard_date ) = '04' and YEAR( hazard_date ) = '$year' and hazard_user = '$user'"));  
@$mei = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
    where MONTH( hazard_date ) = '05' and YEAR( hazard_date ) = '$year' and hazard_user = '$user'"));   
@$jun = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
    where MONTH( hazard_date ) = '06' and YEAR( hazard_date ) = '$year' and hazard_user = '$user'"));  
@$jul = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
    where MONTH( hazard_date ) = '07' and YEAR( hazard_date ) = '$year' and hazard_user = '$user'"));  
@$agu = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
    where MONTH( hazard_date ) = '08' and YEAR( hazard_date ) = '$year' and hazard_user = '$user'"));  
@$sep = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
    where MONTH( hazard_date ) = '09' and YEAR( hazard_date ) = '$year' and hazard_user = '$user'"));  
@$okt = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
    where MONTH( hazard_date ) = '10' and YEAR( hazard_date ) = '$year' and hazard_user = '$user'"));   
@$nov = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
    where MONTH( hazard_date ) = '11' and YEAR( hazard_date ) = '$year' and hazard_user = '$user'"));  
@$des = mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard 
    where MONTH( hazard_date ) = '12' and YEAR( hazard_date ) = '$year' and hazard_user = '$user'")); 
    ?>

    <header class="main_haeder header-sticky multi_item">
        <div class="em_side_right">
            <a class="btn btn__back rounded-circle bg-snow" onclick="history.go(-1)">
                <i class="tio-chevron_left"></i>
            </a>
        </div>
        <div class="title_page">
            <h1 class="page_name">
                Achivement
            </h1>
        </div>
    </header>
    <!-- End.main_haeder -->

    <!-- Start emPageAbout -->
    <section class="emPageAbout padding-t-60 padding-b-50 emPage__faq">
        <div class="em__pkLink accordion bg-white" id="accordionExample5">
            <center><img src="../assets/img/achive1.jpg" width="300"></center>
            <div class="content_text pb-0">
                <h2 class="size-25 weight-700 color-secondary mb-2">Achivement</h2>
                <p>Pencapaian Hazard Report tahun <?= date('Y');?></p><br>
                <table class="table table-striped">
                  <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">BULAN</th>
                        <th scope="col">TARGET</th>
                        <th scope="col">%</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">
                            <?php if ($jan['total'] <= '0') {?>
                             <img src="../assets/icon/outline/star2.png" width="15">
                             <img src="../assets/icon/outline/star2.png" width="15"> 
                         <?php } elseif ($jan['total'] == '1') {?>
                            <img src="../assets/icon/outline/star1.png" width="15">
                            <img src="../assets/icon/outline/star2.png" width="15"> 
                        <?php } elseif ($jan['total'] > '1') {?>
                            <img src="../assets/icon/outline/star1.png" width="15">
                            <img src="../assets/icon/outline/star1.png" width="15"> 
                        <?php } ?>
                    </th>
                    <td><b>JANUARI</b></td>
                    <td><?php echo $jan['total'].'/2'?></td>
                    <td><?php echo ($jan['total'] / 2 * 100).'%'; ?></td>
                </tr>
                <tr>
                  <th scope="row">
                    <?php if ($feb['total'] <= '0') {?>
                     <img src="../assets/icon/outline/star2.png" width="15">
                     <img src="../assets/icon/outline/star2.png" width="15"> 
                 <?php } elseif ($feb['total'] == '1') {?>
                    <img src="../assets/icon/outline/star1.png" width="15">
                    <img src="../assets/icon/outline/star2.png" width="15"> 
                <?php } elseif ($feb['total'] > '1') {?>
                    <img src="../assets/icon/outline/star1.png" width="15">
                    <img src="../assets/icon/outline/star1.png" width="15"> 
                <?php } ?>
            </th>
            <td><b>FEBRUARI</b></td>
            <td><?php echo $feb['total'].'/2'?></td>
            <td><?php echo ($feb['total'] / 2 * 100).'%'; ?></td>
        </tr>
        <tr>
          <th scope="row">
            <?php if ($mar['total'] <= '0') {?>
             <img src="../assets/icon/outline/star2.png" width="15">
             <img src="../assets/icon/outline/star2.png" width="15"> 
         <?php } elseif ($mar['total'] == '1') {?>
            <img src="../assets/icon/outline/star1.png" width="15">
            <img src="../assets/icon/outline/star2.png" width="15"> 
        <?php } elseif ($mar['total'] > '1') {?>
            <img src="../assets/icon/outline/star1.png" width="15">
            <img src="../assets/icon/outline/star1.png" width="15"> 
        <?php } ?>
    </th>
    <td><b>MARET</b></td>
    <td><?php echo $mar['total'].'/2'?></td>
    <td><?php echo ($mar['total'] / 2 * 100).'%'; ?></td>
</tr>
<tr>
  <th scope="row">
    <?php if ($apr['total'] <= '0') {?>
     <img src="../assets/icon/outline/star2.png" width="15">
     <img src="../assets/icon/outline/star2.png" width="15"> 
 <?php } elseif ($apr['total'] == '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star2.png" width="15"> 
<?php } elseif ($apr['total'] > '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star1.png" width="15"> 
<?php } ?>
</th>
<td><b>APRIL</b></td>
<td><?php echo $apr['total'].'/2'?></td>
<td><?php echo ($apr['total'] / 2 * 100).'%'; ?></td>
</tr>
<tr>
    <th scope="row">
        <?php if ($mei['total'] <= '0') {?>
         <img src="../assets/icon/outline/star2.png" width="15">
         <img src="../assets/icon/outline/star2.png" width="15"> 
     <?php } elseif ($mei['total'] == '1') {?>
        <img src="../assets/icon/outline/star1.png" width="15">
        <img src="../assets/icon/outline/star2.png" width="15"> 
    <?php } elseif ($mei['total'] > '1') {?>
        <img src="../assets/icon/outline/star1.png" width="15">
        <img src="../assets/icon/outline/star1.png" width="15"> 
    <?php } ?>
</th>
<td><b>MEI</b></td>
<td><?php echo $mei['total'].'/2'?></td>
<td><?php echo ($mei['total'] / 2 * 100).'%'; ?></td>
</tr>
<tr>
  <th scope="row">
    <?php if ($jun['total'] <= '0') {?>
     <img src="../assets/icon/outline/star2.png" width="15">
     <img src="../assets/icon/outline/star2.png" width="15"> 
 <?php } elseif ($jun['total'] == '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star2.png" width="15"> 
<?php } elseif ($jun['total'] > '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star1.png" width="15"> 
<?php } ?>
</th>
<td><b>JUNI</b></td>
<td><?php echo $jun['total'].'/2'?></td>
<td><?php echo ($jun['total'] / 2 * 100).'%'; ?></td>
</tr>
<tr>
  <th scope="row">
    <?php if ($jul['total'] <= '0') {?>
     <img src="../assets/icon/outline/star2.png" width="15">
     <img src="../assets/icon/outline/star2.png" width="15"> 
 <?php } elseif ($jul['total'] == '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star2.png" width="15"> 
<?php } elseif ($jul['total'] > '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star1.png" width="15"> 
<?php } ?>
</th>
<td><b>JULI</b></td>
<td><?php echo $jul['total'].'/2'?></td>
<td><?php echo ($jul['total'] / 2 * 100).'%'; ?></td>
</tr>
<tr>
  <th scope="row">
    <?php if ($agu['total'] <= '0') {?>
     <img src="../assets/icon/outline/star2.png" width="15">
     <img src="../assets/icon/outline/star2.png" width="15"> 
 <?php } elseif ($agu['total'] == '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star2.png" width="15"> 
<?php } elseif ($agu['total'] > '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star1.png" width="15"> 
<?php } ?>
</th>
<td><b>AGUSTUS</b></td>
<td><?php echo $agu['total'].'/2'?></td>
<td><?php echo ($agu['total'] / 2 * 100).'%'; ?></td>
</tr>
<tr>
  <th scope="row">
    <?php if ($sep['total'] <= '0') {?>
     <img src="../assets/icon/outline/star2.png" width="15">
     <img src="../assets/icon/outline/star2.png" width="15"> 
 <?php } elseif ($sep['total'] == '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star2.png" width="15"> 
<?php } elseif ($sep['total'] > '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star1.png" width="15"> 
<?php } ?>
</th>
<td><b>SEPTEMBER</b></td>
<td><?php echo $sep['total'].'/2'?></td>
<td><?php echo ($sep['total'] / 2 * 100).'%'; ?></td>
</tr>
<tr>
  <th scope="row">
    <?php if ($okt['total'] <= '0') {?>
     <img src="../assets/icon/outline/star2.png" width="15">
     <img src="../assets/icon/outline/star2.png" width="15"> 
 <?php } elseif ($okt['total'] == '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star2.png" width="15"> 
<?php } elseif ($okt['total'] > '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star1.png" width="15"> 
<?php } ?>
</th>
<td><b>OKTOBER</b></td>
<td><?php echo $okt['total'].'/2'?></td>
<td><?php echo ($okt['total'] / 2 * 100).'%'; ?></td>
</tr>
<tr>
  <th scope="row">
    <?php if ($nov['total'] <= '0') {?>
     <img src="../assets/icon/outline/star2.png" width="15">
     <img src="../assets/icon/outline/star2.png" width="15"> 
 <?php } elseif ($nov['total'] == '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star2.png" width="15"> 
<?php } elseif ($nov['total'] > '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star1.png" width="15"> 
<?php } ?>
</th>
<td><b>NOVEMBER</b></td>
<td><?php echo $nov['total'].'/2'?></td>
<td><?php echo ($nov['total'] / 2 * 100).'%'; ?></td>
</tr>
<tr>
  <th scope="row">
    <?php if ($des['total'] <= '0') {?>
     <img src="../assets/icon/outline/star2.png" width="15">
     <img src="../assets/icon/outline/star2.png" width="15"> 
 <?php } elseif ($des['total'] == '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star2.png" width="15"> 
<?php } elseif ($des['total'] > '1') {?>
    <img src="../assets/icon/outline/star1.png" width="15">
    <img src="../assets/icon/outline/star1.png" width="15"> 
<?php } ?>
</th>
<td><b>DESEMBER</b></td>
<td><?php echo $des['total'].'/2'?></td>
<td><?php echo ($des['total'] / 2 * 100).'%'; ?></td>
</tr>
</tbody>
</table><br>
</div>
</div>
</section>