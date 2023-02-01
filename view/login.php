<?php
session_unset();
session_destroy();
?>

<!-- Start main_haeder -->
<header class="main_haeder bg-transparent justify-content-start">
  <div class="em_side_right">
    <a class="btn btn__back rounded-circle bg-snow" onclick="history.go(-1)">
      <i class="tio-chevron_left"></i>
    </a>
  </div>
</header>
<!-- End.main_haeder -->

<section class="em__signTypeOne">
  <div class="em_titleSign">
    <span class="page_name"><img src="../assets/img/favicon/logos.png" width="200px"></span>
  </div>
  <form id="form" method="post" >
    <div class="em__body">
      <div class="form-group with_icon">
        <label>User ID</label>
        <div class="input_group">
          <input type="number" class="form-control" placeholder="enter your user id" name="user"  id="user" required>
          <div class="icon">
            <img src="../assets/icon/outline/user.svg" width="15" style="opacity: 0.5;">
          </div>
        </div>
      </div>
      <div class="form-group with_icon mb-2" id="show_hide_password">
        <label>Password</label>
        <div class="input_group">
          <input type="password" class="form-control" placeholder="enter your password" name="password"  id="password" required>
          <div class="icon">
            <img src="../assets/icon/outline/key.svg" width="15" style="opacity: 0.5;">
          </div>
          <button type="button" class="btn hide_show icon_password">
            <i class="tio-hidden_outlined"></i>
          </button>
        </div>
      </div>
      <a href="home.php?v=forgot-password" class="link__forgot">Forgot Password?</a>
    </div>
    <div class="em__footer">
      <button type="submit" id="submit" name="submit" class="btn bg-primary color-white justify-content-center"><i class="fas fa-sign-in-alt"></i>Sign in</button><br>
      <a href="home.php?v=dashboard" class="btn color-secondary hover:color-secondary border-snow border-solid justify-content-center">Continue without login &nbsp;
        <div class="icon">
          <img src="../assets/icon/outline/arrow-right-1.svg" width="15">
        </div>
      </a>
    </div>
  </form>
</section>

<!-- Modal -->
<!-- <div class="modal defaultModal modalCentered change__address fade" id="mdllAdd_Address" tabindex="-1"
aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered">
  <div class="modal-content">
    <img src="img.jpg" width="100%"> <br>
    <center><p style="margin-bottom: 0rem;">UPDATE VERSION</p><br><h4>Sisakty v1.1</h4><br>
      <p> Hi! There, We improves performance, <br>features, and better user experience </center>
        <div class="modal-body">
        </div>
        <div class="modal-footer"><br><br><br><br><br>
          <a href="../Sisakty v1.1.apk" type="button" class="btn btn_default_lg" target="_blank">
            Download
          </a>
          <button type="button" class="btn btn_default_lg" data-dismiss="modal" style="background-color: #c7c7c7;">Already updated ? Skip</button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    $(window).on('load', function() {
      $('#mdllAdd_Address').modal('show');
    });
  </script> -->

  <script type="text/javascript">
    $('#submit').click(function(){
      if($('#user').val() == '' ){
        Swal.fire({ icon: 'error', text: 'User ID tidak boleh kosong !' })
        return false;
      }if($('#password').val() == '' ){
        Swal.fire({ icon: 'error', text: 'Password tidak boleh kosong !' })
        return false;
      }
    })
  </script>

  <script>
    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>

  <!-- LOGIN -->
  <script type="text/javascript">
    $(document).ready(function(){
      $("#submit").click(function(e){
        var valid = this.form.checkValidity();
        if (valid) {
          event.preventDefault();

          var data = $('#form').serialize();
          $.ajax({
            type    : 'POST',
            url     : 'action.php?action=login',
            data    : data,  
            success:function(response){
              if(response == 0){
                Swal.fire({
                  title: 'Gagal!',
                  icon:  'error',
                  html:  '<small>Masukan User ID dan Password<br> yang sesuai</small>',
                  confirmButtonText:
                  '<i class="fa fa-thumbs-up"></i> Oke'
                });
              }else{ 
                window.location = "home.php?v=dashboard";
              }
            }
          });
        }
      });
    });
  </script>