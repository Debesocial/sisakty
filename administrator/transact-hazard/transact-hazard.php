<?php 
if ($_POST['today'] != NULL) {
  $header = tanggal_indonesia(date('Y-m-d'));
  $date2  = date("Y-m-d");
  $date1  = date("Y-m-d");
} elseif ($_POST['month'] != NULL) {
  $header = tanggal_indonesia(date('Y-m'));
  $date2  = date("Y-m-31");
  $date1  = date("Y-m-01");
} elseif ($_POST['year'] != NULL) {
  $header = 'Tahun'.tanggal_indonesia(date("Y"));
  $date2  = date("Y-12-31");
  $date1  = date("Y-01-01");
} else {
  $header = 'Hazard Report 30 Hari Terakhir';
  $date2  = date("Y-m-d");
  $date1  = date('Y-m-d', strtotime('-30 days'));
}

@$open=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard where hazard_approve = 'Y' and hazard_status = 'Open' and DATE_FORMAT(hazard_date, '%Y-%m-%d') >= '$date1' and DATE_FORMAT(hazard_date, '%Y-%m-%d') <= '$date2'"));
@$progress=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard where hazard_approve = 'Y' and hazard_status = 'Progress' and DATE_FORMAT(hazard_date, '%Y-%m-%d') >= '$date1' and DATE_FORMAT(hazard_date, '%Y-%m-%d') <= '$date2'"));

if(@$_GET['act'] == 'detail'){
  @$report = mysqli_fetch_array($conn->query("SELECT * FROM hazard 
    LEFT JOIN user ON user.user_id = hazard.hazard_user
    LEFT JOIN level ON level.level_id = user.user_level
    LEFT JOIN departement ON departement.dept_id = user.user_dept
    LEFT JOIN divisi ON divisi.divisi_id = user.user_divisi
    LEFT JOIN company ON company.comp_id = user.user_comp
    LEFT JOIN risk ON risk.risk_id = hazard.hazard_risk
    LEFT JOIN classification ON classification.classi_id = hazard.hazard_classi
    LEFT JOIN location ON location.loc_id = hazard.hazard_loc
    WHERE hazard.hazard_id = ".$_GET['id']."")
  );?>
  <div class="row ">
    <div class="col-4 col-md-4 col-lg-4">
      <div class="card author-box">
        <div class="card-body">
          <div class="author-box-center">
            <img alt="image" src="../../assets/super/img/users/user-1.png" class="rounded-circle author-box-picture">
            <div class="author-box-name"> <a href="#"> <?= $report['user_name']; ?> </a> </div>
            <div class="author-box-job"> <?= $report['user_status']; ?> </div> </div>
            <hr>
            <div class="row"> <div class="form-group col-md-4"> <label>NIK</label> </div>
            <div class="form-group col-md-6"> <span class="float-left text-muted"> <?= $report['user_nik']; ?> </span> </div> </div>
            <div class="row"> <div class="form-group col-md-4"> <label>Nama Lengkap</label> </div>
            <div class="form-group col-md-6"> <span class="float-left text-muted"> <?= $report['user_name']; ?> </span> </div> </div>
            <div class="row"> <div class="form-group col-md-4"> <label>Tanggal Lahir</label> </div>
            <div class="form-group col-md-6"> <span class="float-left text-muted"> <?= $report['user_birth']; ?> </span> </div> </div>
            <div class="row"> <div class="form-group col-md-4"> <label>Email</label> </div>
            <div class="form-group col-md-6"> <span class="float-left text-muted"> <?= $report['user_email']; ?> </span> </div> </div>
            <div class="row"> <div class="form-group col-md-4"> <label>Masuk Site</label> </div>
            <div class="form-group col-md-6"> <span class="float-left text-muted"> <?= $report['user_onsite']; ?> </span> </div> </div>
            <div class="row"> <div class="form-group col-md-4"> <label>Jabatan</label> </div>
            <div class="form-group col-md-6"> <span class="float-left text-muted"> <?= $report['level_name']; ?> </span> </div> </div>
            <div class="row"> <div class="form-group col-md-4"> <label>Departement</label> </div>
            <div class="form-group col-md-6"> <span class="float-left text-muted"> <?= $report['dept_name']; ?> </span> </div> </div>
            <div class="row"> <div class="form-group col-md-4"> <label>Divisi</label> </div>
            <div class="form-group col-md-6"> <span class="float-left text-muted"> <?= $report['divisi_name']; ?> </span> </div> </div>
            <div class="row"> <div class="form-group col-md-4"> <label>Perusahaan</label> </div>
            <div class="form-group col-md-6"> <span class="float-left text-muted"> <?= $report['comp_name']; ?> </span> </div> </div>
          </div>
        </div>
      </div>

      <div class="col-md-8 col-lg-8 col-xl-8">
        <div class="card">
          <div class="">
            <h5 class="card-header justify-content-between ">
              <span>Detail Laporan | <i class="fas fa-eye"></i></span>
            </h5>
          </div>
          <div class="card-body">
            <table class="table table-striped">
              <?php if($report['hazard_photo'] != '') { ?>
                <figure>
                  <center>
                    <a href="" data-toggle="modal" data-target=".bd-example-modal-lg">
                      <img class="zoom border rounded" style=" border: 1px solid #ddd;border-radius: 4px;padding: 5px;"
                      src="<?= '../assets/hazard/thumbnail/'.$report['hazard_photo'];?>" alt="image" class="imaged img-fluid" width="50%">
                    </a>
                  </center>
                </figure>
              <?php } else { ?>
                <center><img src="../assets/hazard/noimage.jpg" alt="image" class="imaged img-fluid" width="80%"></center>
              <?php } ?>
              <tbody>
                <tr><th>ID Hazard</th><td> <?= 'HZ'.str_pad($report['hazard_id'],5,"0",STR_PAD_LEFT);?></td> </tr> 
                <tr><th>Judul</th><td><?= $report['hazard_name'];?></td> </tr>
                <tr><th>Klasifikasi</th><td><?= $report['classi_name'];?></td> </tr>
                <tr><th>Lokasi</th><td> 
                  <?php if(@$report['hazard_loc_etc'] == '' ){ 
                    echo @$report['loc_name']; 
                  } else { 
                    echo 'Lain-lain ('.@$report['hazard_loc_etc'].')'; }?>
                  </td> 
                </tr>
                <tr><th>Risiko</th><td><?= $report['risk_name'];?></td> </tr>

                <tr>
                 <th>PIC</th>
                 <td>
                   <?php if($report['hazard_status'] != 'Open'){?>
                     <div class="form-row">
                       <div class="col">
                         <select class="form-control select2" id="" required name="divisi" disabled="">
                           <option value="<?php echo $report['hazard_divisi'];?>">
                             <?php $div =  $report['hazard_divisi'];
                             @$divisi = mysqli_fetch_array($conn->query("SELECT * FROM divisi where  divisi_id = '$div'"));
                             echo $divisi['divisi_name'];?>
                           </option>
                           <?php $data = mysqli_query($conn,"select * from divisi");
                           while($row  = mysqli_fetch_array($data)){ ?> 
                             <option value=<?php echo $row['divisi_id'];?>> 
                               <?php echo $row['divisi_name'];
                             }?> 
                           </option>
                         </select>
                       </div>
                       <div class="col">
                        <select class="form-control select2" id="" required name="comp" width="122"  disabled="">
                          <option value="<?php echo $report['hazard_comp'];?>">
                            <?php $com =  $report['hazard_comp'];
                            @$comp = mysqli_fetch_array($conn->query("SELECT * FROM company where comp_id = '$com'"));
                            echo $comp['comp_name'];?>
                          </option>
                          <?php $data = mysqli_query($conn,"select * from company");
                          while($row  = mysqli_fetch_array($data)){ ?> 
                            <option value=<?php echo $row['comp_id'];?>> 
                              <?php echo $row['comp_name'];
                            }?> 
                          </option>
                        </select>
                      </div>
                    </div>
                  <?php } else { ?>

                    <form id="form-pic-update">
                      <div class="form-row">
                        <div class="col">
                         <select class="form-control select2" id="comp" required name="comp" width="122">
                          <option value="<?php echo $report['hazard_comp'];?>">
                           <?php $com =  $report['hazard_comp'];
                           @$comp = mysqli_fetch_array($conn->query("SELECT * FROM company where comp_id = '$com'"));
                           echo $comp['comp_name'];?>
                         </option>
                         <?php $data = mysqli_query($conn,"select * from company order by comp_name asc");
                         while($row  = mysqli_fetch_array($data)){ ?> 
                          <option value=<?php echo $row['comp_id'];?>> 
                            <?php echo $row['comp_name'];
                          }?> 
                        </option>
                      </select>
                    </div>

                    <div class="col">
                      <select class="form-control select2" id="divisi" required name="divisi">
                        <option value="<?php echo $report['hazard_comp'].'-'.$report['hazard_divisi'];?>">
                          <?php $div =  $report['hazard_divisi'];
                          @$divisi = mysqli_fetch_array($conn->query("SELECT * FROM divisi where  divisi_id = '$div'"));
                          echo $divisi['divisi_name'];?>
                        </option>
                        <?php $data = mysqli_query($conn,"select * from divisi order by divisi_name asc");
                        while($row  = mysqli_fetch_array($data)){ ?>  
                          <option value=<?php echo $row['divisi_comp'].'-'.$row['divisi_id'];?>>
                            <?php echo $row['divisi_name'];}?> 
                          </option>
                        </select>
                      </div>

                      <script type="text/javascript">
                        $(function() {
                          var interval = $('#divisi option').clone();
                          $('#comp').on('change', function() {
                            var val = this.value;
                            $("#divisi option").show(); 

                            if(val!="")
                              $('#divisi').html( 
                                interval.filter(function() { 
                                  return this.value.indexOf( val + '-' ) === 0; 
                                })
                                );
                          })
                          .change();
                        });
                      </script>

                      <div class="col">
                       <button name="submit" id="submit" type="submit" class="form-control btn btn-primary" >Ubah PIC</button>
                     </div>
                   </div>
                 </form>
               <?php } ?>                       
             </td>


             <tr><th>Uraian</th><td><?= $report['hazard_desc'];?></td> </tr>
             <tr><th>Saran</th><td><?= $report['hazard_solution'];?></td> </tr>
           </tbody>
         </table>

         <!-- TIMELINE -->
         <small>
          <div id="tracking">
            <div class="tracking-list">
              <?php 
              $sql = mysqli_query($conn,"SELECT * FROM hazard_status where hazard_status_hazard = ".$report['hazard_id'].""); 
              while(@$row = mysqli_fetch_array($sql)) {?>
                <div class="tracking-item">
                  <div class="tracking-icon status-intransit">
                    <?php if($row['hazard_status_name'] == 'Review') {
                      echo '<i class="fas fa-circle" style="color:#343a40;"></i>';
                    } elseif($row['hazard_status_name'] == 'Open') {
                      echo '<i class="fas fa-circle" style="color:#ffc107;"></i>';
                    } elseif($row['hazard_status_name'] == 'Progress') {
                      echo '<i class="fas fa-circle" style="color:#007bff;"></i>';
                    } elseif($row['hazard_status_name'] == 'Closed') {
                      echo '<i class="fas fa-circle" style="color:#28a745;"></i>';
                    } elseif($row['hazard_status_name'] == 'Reject') {
                      echo '<i class="fas fa-circle" style="color:#dc3545;"></i>';
                    }?>
                  </div>
                  <div class="tracking-date"><?= $row['hazard_status_date']?></div>
                  <div class="tracking-content"><?= $row['hazard_status_name']?> <span> <?= $row['hazard_status_desc']?> </span>
                    <?php if ($row['hazard_status_photo'] != ''){ ?><br>
                    <img class="zoom border rounded" style=" border: 1px solid #ddd;border-radius: 4px;padding: 5px;" src="<?= '../assets/hazard/thumbnail/'.$row['hazard_status_photo']?>" width="50%"> <?php } ?> 
                  </div>
                </div>
              <?php } ?>
            </div>
          </div>
        </small><br>

        <?php if($report['hazard_status'] == 'Open' || $report['hazard_status'] == 'Progress') {?>
          <form id="form-hazard-update">
           <div class="form-group">
             <label for="exampleFormControlSelect1">Ubah Status</label>
             <select class="form-control" id="exampleFormControlSelect1" required="" name="status">
               <option value="">- Pilih - </option>
               <option value="Closed">Closed</option>
               <option value="Reject">Reject</option>
             </select>
           </div>
           <div class="form-group">
             <textarea name="desc" required="" class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Alasan mengubah status..."></textarea>
           </div>
           <div class="form-group">
             <label for="exampleFormControlSelect1">Foto (Optional)</label>
             <input name="file" type="file" class="form-control">
           </div><br>
           <input name="user" value="<?php echo $_SESSION['user_id']?>" hidden/>
           <div class="row">
             <div class="col">

              <p id="demo">
                <button type="submit" id="hazard-update" name="hazard-update" class="btn btn-sm btn-primary form-control"><i class="fas fa-save"></i> Simpan
                </button>
              </p>

            </div>
          </div>
        </form><br>
        <?php } ?><br>
      </div>
    </div>
  </div>
</div>

<?php } else { ?>
  <center>
    <div class="card-header-form">
      <form method="POST">
        <div class="col-md-12">
          <div class="form-row">
            <div class="col">
              <input name="date1" type="date" class="form-control" required >
            </div>
            <div class="col">
              <input name="date2" type="date" class="form-control" required>
            </div>
            <div class="col">
              <select class="form-control select2" id="" required name="comp">
                <option value=""> - Pilih Perusahaan -</option>
                <option value="All"> Semua Perusahaan</option>
                <?php $company = mysqli_query($conn,"select * from company ORDER BY comp_name asc");
                while($row  = mysqli_fetch_array($company)){ ?> 
                  <option value=<?= $row['comp_id'];?>> 
                    <?= $row['comp_name'];
                  }?> 
                </option>
              </select>
            </div>
            <div class="col">
              <select class="form-control select2" id="" required name="sebagai">
                <option value=""> - Pilih Sebagai -</option>
                <option value="PIC"> Sebagai PIC</option>
                <option value="Pelapor"> Sebagai Pelapor</option>
              </select>
            </div>
            <div class="col-1">
              <button class="btn btn-primary form-control" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </form>

          <div class="col-1">
            <form action="" method="post">
              <button name="today" value="today" class="btn btn-info form-control">
                TODAY
              </button>
            </form>
          </div>
          <div class="col-1">
            <form action="" method="post">
              <button name="month" value="month" class="btn btn-info form-control">
                <span style="text-transform: uppercase;"><?= date('M') ?></span>
              </button>
            </form>
          </div>
          <div class="col-1">
            <form action="" method="post">
              <button name="year" value="year" class="btn btn-info form-control">
                <?= date('Y') ?>
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </center><br>

  <div class="col-md-12">
    <ul class="nav nav-tabs justify-content-center  nav-fill" id="myTab" role="tablist">
      <li class="nav-item ">
        <a class="nav-link active" id="list-tab" data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true">
          List <i class="fas fa-list-alt" style="font-size: 15px;"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="summary-tab" data-toggle="tab" href="#summary" role="tab" aria-controls="summary" aria-selected="false">
          Summary <i class="fas fa-table" style="font-size: 15px;"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="grafik-tab" data-toggle="tab" href="#grafik" role="tab" aria-controls="grafik" aria-selected="false">
          Grafik <i class="fas fa-chart-bar" style="font-size: 15px;"></i>
        </a>
      </li>
    </ul>
  </div><br>

  <?php if (@$_POST['comp'] != '') {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    $comp  = $_POST['comp'];
    if($_POST['comp'] == 'All')  {
      if (@$_POST['sebagai'] == 'PIC') {
        include 'filter/transact-hazard-pic-all.php';
      } elseif (@$_POST['sebagai'] == 'Pelapor') {
        include 'filter/transact-hazard-pelapor-all.php';
      }
    } else {
      if (@$_POST['sebagai'] == 'PIC') {
        include 'filter/transact-hazard-pic.php';
      } elseif (@$_POST['sebagai'] == 'Pelapor') {
        include 'filter/transact-hazard-pelapor.php';
      }
    }

  } else {
#HAZARD REPORT
    @$data     = mysqli_query ($conn,"SELECT * FROM hazard 
      LEFT JOIN user on user.user_id = hazard.hazard_user
      LEFT JOIN location on location.loc_id = hazard.hazard_loc
      LEFT JOIN classification on classification.classi_id = hazard.hazard_classi
      LEFT JOIN risk on risk.risk_id = hazard.hazard_risk
      LEFT JOIN divisi on divisi.divisi_id = hazard.hazard_divisi
      LEFT JOIN company on company.comp_id = hazard.hazard_comp
      WHERE DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') >= '$date1'
      AND DATE_FORMAT(hazard.hazard_date, '%Y-%m-%d') <= '$date2'");

#BERDASARKAN KLASIFIKASI
    @$classi   = mysqli_query ($conn,"SELECT * FROM classification ORDER BY classi_name ASC ");
#BERDASARKAN RISIKO
    @$risk     = mysqli_query ($conn,"SELECT * FROM risk ORDER BY risk_name ASC ");
#BERDASARKAN LOKASI
    @$location = mysqli_query ($conn,"SELECT * FROM location ORDER BY loc_name ASC ");
#BERDASARKAN DIVISI
    @$divisi   = mysqli_query ($conn,"SELECT * FROM divisi ORDER BY divisi_name ASC ");
#BERDASARKAN USER / PELAPOR
    @$usr      = mysqli_query ($conn,"SELECT * FROM user 
      LEFT JOIN level ON level.level_id = user.user_level
      LEFT JOIN departement ON departement.dept_id = user.user_dept
      LEFT JOIN divisi ON divisi.divisi_id = user.user_divisi
      LEFT JOIN company ON company.comp_id = user.user_comp
      WHERE user.user_pic != 'X' ORDER BY user.user_name ASC ");

#BERDASARKAN STATUS
    @$status = mysqli_fetch_array($conn->query("SELECT 
      COUNT(CASE WHEN hazard_status = 'Open' THEN 1 END) AS `Open`,
      COUNT(CASE WHEN hazard_status = 'Progress' THEN 1 END) AS `Progress`,
      COUNT(CASE WHEN hazard_status = 'Closed' THEN 1 END) AS `Closed`,
      COUNT(CASE WHEN hazard_status = 'Reject' THEN 1 END) AS `Reject`
      FROM hazard
      WHERE  hazard_approve = 'Y' 
      and DATE_FORMAT(hazard_date, '%Y-%m-%d') >= '$date1' 
      and DATE_FORMAT(hazard_date, '%Y-%m-%d') <= '$date2'"));

#BERDASARKAN BULAN 
    @$month=mysqli_fetch_array($conn->query("SELECT 
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
      WHERE DATE_FORMAT(hazard_date, '%Y-%m-%d') >= '$date1' 
      AND DATE_FORMAT(hazard_date, '%Y-%m-%d') <= '$date2'"));
      ?>

      <div class="tab-content" id="myTabContent">
        <div class="alert alert-light" role="alert"> 
          <center><?= '<strong>'.$header.'</strong><small> ( Open : '.$open['total'].', Progress : '.$progress['total'].' )</small>'; ?></center>
        </div>
        <div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
          <div class="row ">               
            <div class="col-md-12 col-lg-12 col-xl-12">
              <div class="card">
                <div class="card-header">
                  <h4>Hazard Report | <i class="fas fa-list"></i></h4>   
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover" id="datatable_export" style="width:100%;">
                      <thead>
                        <tr>
                          <th>Status</th>
                          <th style="min-width: 150px;">Tanggal</th>
                          <th style="min-width: 70px;" >ID Hazard</th>
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
          <a target="_blank" href="transact-hazard/filter/export.php?d1=<?php echo $date1;?>&d2=<?php echo $date2;?>">
            <button class="btn btn-outline-success form-control">
              <i class="fas fa-download"></i> Export Summary
            </button>
          </a><br><br>
          <div id="summarys"> 
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
                              <?php @$classi_=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard WHERE hazard_classi = ".$row['classi_id']." and DATE_FORMAT(hazard_date, '%Y-%m-%d') >= '$date1' and DATE_FORMAT(hazard_date, '%Y-%m-%d') <= '$date2'"));  $classi_g_[] = $classi_['total']; echo $classi_['total'];?> 
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
                              <?php @$risk_=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard WHERE hazard_risk = ".$row['risk_id']." and DATE_FORMAT(hazard_date, '%Y-%m-%d') >= '$date1' and DATE_FORMAT(hazard_date, '%Y-%m-%d') <= '$date2'")); $risk_g_[] = $risk_['total']; echo $risk_['total'];?>
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
                      <thead class="">
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
                              <?php @$location_=mysqli_fetch_array($conn->query("SELECT COUNT(*) AS total FROM hazard WHERE hazard_loc = ".$row['loc_id']." and DATE_FORMAT(hazard_date, '%Y-%m-%d') >= '$date1' and DATE_FORMAT(hazard_date, '%Y-%m-%d') <= '$date2'")); $location_g_[]= $location_['total']; echo $location_['total'].'';?>
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
                      'rgba(76, 175, 80, 0.2)',     //green
                      'rgba(0, 140, 186, 0.2)',     //blue
                      'rgba(244, 67, 54, 0.2)',     //red
                      'rgba(108, 117, 125, 0.2)',     //grey
                      'rgba(255, 193, 7, 0.2)'    //yellow
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
                      'rgba(255, 193, 7, 0.2)',   //yellow
                      'rgba(0, 140, 186, 0.2)',     //blue
                      'rgba(76, 175, 80, 0.2)',     //green
                      'rgba(244, 67, 54, 0.2)',     //red
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
                                  </div>
                                </div>
                              </div>
                            </div>
                          <?php }} ?>

                          <script>
                            function printDiv() {
                              var divContents = document.getElementById("grafiks").innerHTML;
                              var a = window.open('', '', 'height=500, width=500');
                              a.document.write('<html>');
                              a.document.write('<body>');
                              a.document.write(divContents);
                              a.document.write('</body></html>');
                              a.document.close();
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
                            }
                          </script>

                          <script>
                            if ( window.history.replaceState ) {
                              window.history.replaceState( null, null, window.location.href );
                            }
                          </script>

                          


                          <!-- UPDATE STATUS-->
                          <script type="text/javascript">
                            $(document).ready(function(){
                              $("#form-hazard-update").on("submit", function(e){
                                e.preventDefault();
                                var formData = new FormData(this);
                                var id = <?php echo $_GET['id'];?>;
                                document.getElementById("demo").innerHTML = "<center>Please Wait...<br><img src='../assets/super/img/loading.gif' width='100'></center>";
                                $.ajax({
                                  url  : "action/action.php?action=hazard&id=" + id,
                                  type : "POST",
                                  cache:false,
                                  data :formData,
                                  contentType : false, 
                                  processData: false,
                                  success : function(data){
                                    $.ajax({
                                      url: 'transact-hazard/mail_status.php?id=<?php echo $_GET['id']?>',
                                      type: 'post',
                                      success: function (response) {
                                        Swal.fire({
                                          title: 'Berhasil!',
                                          icon:  'success',
                                          text:  'Status berhasil diubah',
                                          focusConfirm: false,
                                          confirmButtonText:
                                          '<i class="fa fa-thumbs-up"></i> Oke'
                                        }).then(function() {
                                          location.href = 'home.php?v=hazard&act=detail&id=' + id;
                                        });
                                      } 
                                    });
                                  }
                                });
                              });
                            });
                          </script>


                          <!-- UPDATE STATUS-->
                          <script type="text/javascript">
                            $(document).ready(function(){
                              $("#form-pic-update").on("submit", function(e){
                                e.preventDefault();
                                var formData = new FormData(this);
                                var id = <?php echo $_GET['id'];?>;
                                $.ajax({
                                  url  : "action/action.php?action=hazard_pic&id=" + id,
                                  type : "POST",
                                  cache:false,
                                  data :formData,
                                  contentType : false, 
                                  processData: false,
                                  success: function (response) {
                                    Swal.fire({
                                      title: 'Berhasil!',
                                      icon:  'success',
                                      text:  'Status berhasil diubah',
                                      focusConfirm: false,
                                      confirmButtonText:
                                      '<i class="fa fa-thumbs-up"></i> Oke'
                                    }).then(function() {
                                      location.href = 'home.php?v=hazard&act=detail&id=' + id;
                                    });
                                  } 
                                });
                              });
                            });
                          </script>

