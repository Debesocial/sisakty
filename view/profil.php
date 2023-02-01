<!-- Start main_haeder -->
<header class="main_haeder bg-transparent header-sticky">
    <div class="em_side_right">
        <a class="btn btn__back rounded-circle bg-snow" onclick="history.go(-1)">
            <i class="tio-chevron_left"></i>
        </a>
    </div>
    <div class="title_page">
        <span class="page_name" style="color: #fff;">Profile</span>
    </div>
    <div class="em_side_right">
    </div>
</header>
<!-- End.main_haeder -->

<!-- Start emPage___profile with__background -->
<section class=" emPage___profile with__background">
    <div class="emPersonal__data">
        <div class="name">
            <h2>Hi, <?= $_name ?></h2>
            <p><?= $_email ?></p>
        </div>
        <div class="photo_persona">
            <img src="../assets/img/person.jpg" alt="">
        </div>
    </div>
    <div class="emBody__navLink padding-t-0 padding-b-20">
    </div>
</section>

<!-- Start emPage___profile -->
<div class="tab__line two_item">
    <ul class="nav nav-pills" id="pills-tab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="pills-ex-tab" data-toggle="pill" href="#pills-ex" role="tab" aria-controls="pills-ex" aria-selected="true">Personal</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="pills-ex2-tab" data-toggle="pill" href="#pills-ex2" role="tab" aria-controls="pills-ex2" aria-selected="false">Password</a>
        </li>
    </ul>

    <div class="tab-content padding-20 bg-white" id="pills-tabContent">
        <div class="tab-pane fade active show" id="pills-ex" role="tabpanel" aria-labelledby="pills-ex-tab">
            <div class="bg-white padding-10">
                <table class="table">
                    <tbody>
                        <tr>
                            <th scope="row">User ID</th>            
                            <td><?=$_nik?></td>
                        </tr>
                        <tr>
                            <th scope="row">Name</th>               
                            <td><?=$_name?></td>
                        </tr>
                        <tr>
                            <th scope="row"> Departement</th>       
                            <td><?=$_dept?></td>
                        </tr>
                        <tr>
                            <th scope="row">Divisi</th>             
                            <td><?=$_divisi?></td>
                        </tr>
                        <tr>
                            <th scope="row">Company</th>
                            <td><?=$_comp?></td>
                        </tr>
                    </tbody>
                </table>
                <form id="form" method="post" >
                    <div class="form-group with_icon">
                        <div class="input_group">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required value="<?=$_email?>">
                            <div class="icon">
                                <img src="../assets/icon/outline/email.svg" width="20">
                            </div>
                        </div><br>
                        <div class="input_group">
                            <input type="number" id="phone" name="phone" class="form-control" placeholder="Enter your phone number" required value="<?=$_phone?>">
                            <div class="icon">
                                <img src="../assets/icon/outline/phone.svg" width="20">
                            </div>
                        </div>
                    </div><br>
                    <button type="submit" name="submit" id="submit" class="btn btn__icon btn_default_lg bg-primary color-white text-left justify-content-center">Save Changes</button>
                    <br><br><br><br>
                </form>
            </div>
        </div>

        <div class="tab-pane fade" id="pills-ex2" role="tabpanel" aria-labelledby="pills-ex2-tab">
            <div class="bg-white padding-10">
                <form id="formpass" method="post" >
                    <div class="form-group with_icon">
                        <label>Current Password</label>
                        <div class="input_group">
                            <input type="hidden" id="password1" name="passwordold" class="form-control" placeholder="enter your new password" required value="<?= base64_decode($_password) ?>">
                            <input type="password" id="password2"  name="passwordold" class="form-control" placeholder="enter your Confirm New Password" required>
                            <div class="icon">
                                <img src="../assets/icon/outline/key.svg" width="15" style="opacity: 0.5;">
                            </div>
                        </div>
                    </div>
                    <div class="form-group with_icon" id="show_hide_password">
                        <label>New Password</label>
                        <div class="input_group">
                            <input minlength="6" type="password" id="password_new1" name="password" class="form-control" placeholder="enter your new password" required>
                            <div class="icon">
                                <img src="../assets/icon/outline/key.svg" width="15" style="opacity: 0.5;">
                            </div>
                            <button type="button" class="btn hide_show icon_password">
                                <i class="tio-hidden_outlined"></i>
                            </button>
                        </div>
                    </div>
                    <div class="form-group with_icon">
                        <label>Confirm New Password</label>
                        <div class="input_group">
                            <input minlength="6" type="password" id="password_new2"  name="password" class="form-control" placeholder="enter your Confirm New Password" required>
                            <div class="icon">
                                <img src="../assets/icon/outline/key.svg" width="15" style="opacity: 0.5;">
                            </div>
                        </div>
                    </div><br>
                    <button type="submit" name="submitpass" id="submitpass" class="btn btn__icon btn_default_lg bg-primary color-white text-left justify-content-center">Save Changes</button>
                </form><br><br><br><br><br><br><br><br>
            </div>
        </div>
    </div>
</div>

<!-- KONFIRMASI PASSWORD -->
<script type="text/javascript">
  window.onload = function () {
    document.getElementById("password1").onchange = validatePassword;
    document.getElementById("password2").onchange = validatePassword;
    document.getElementById("password_new1").onchange = validatePassword;
    document.getElementById("password_new2").onchange = validatePassword;
}
function validatePassword(){
    var pass2=document.getElementById("password2").value;
    var pass1=document.getElementById("password1").value;
    var passn2=document.getElementById("password_new2").value;
    var passn1=document.getElementById("password_new1").value;
    if(pass1!=pass2)
        document.getElementById("password2").setCustomValidity("Password Tidak Sama");
    else
      document.getElementById("password2").setCustomValidity('');
  if(passn1!=passn2)
    document.getElementById("password_new2").setCustomValidity("Password Tidak Sama");
else
  document.getElementById("password_new2").setCustomValidity('');
}
</script>

<!-- CHANGE EMAIL -->
<script type="text/javascript">
    $(document).ready(function(){
      $("#submit").click(function(e){
        var valid = this.form.checkValidity();
        if (valid) {
          event.preventDefault();

          var data = $('#form').serialize();
          $.ajax({
            type    : 'POST',
            url     : "action.php?action=setting&id=<?=$_id?>",
            data    : data,
            cache   : false,
            success : function(data){
              Swal.fire({
                title: 'Berhasil!',
                icon:  'success',
                text:  'Data berhasil diubah, login ulang untuk perubahan.',
                focusConfirm: false,
                confirmButtonText:
                '<a href="../controller/logout.php" style="color: #fff;"><i class="fa fa-thumbs-up"></i> Oke</a>'
            }).then(function() {
                location.href = '../controller/logout.php';
            });
        }
    });
      }
  });
  });
</script>

<!-- CHANGE PASSWORD -->
<script type="text/javascript">
    $(document).ready(function(){
      $("#submitpass").click(function(e){
        var valid = this.form.checkValidity();
        if (valid) {
          event.preventDefault();

          var data = $('#formpass').serialize();
          $.ajax({
            type    : 'POST',
            url     : "action.php?action=setting_pass&id=<?=$_id?>",
            data    : data,
            cache   : false,
            success : function(data){
              Swal.fire({
                title: 'Berhasil!',
                icon:  'success',
                text:  'Data berhasil diubah, login ulang untuk perubahan.',
                focusConfirm: false,
                confirmButtonText:
                '<a href="../controller/logout.php" style="color: #fff;"><i class="fa fa-thumbs-up"></i> Oke</a>'
            }).then(function() {
                location.href = '../controller/logout.php';
            });
        }
    });
      }
  });
  });
</script>