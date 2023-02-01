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
      <p style="text-align:center;">Untuk mengubah password, silahkan <br>masukan User ID &amp; Email</p>
      <div class="form-group with_icon">
        <label>User ID</label>
        <div class="input_group">
          <input type="text" class="form-control" id="pass" name="pass" hidden value=
          <?php $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
            echo substr(str_shuffle($permitted_chars), 0, 6);?>>
          <input type="number" class="form-control" placeholder="enter your user id" name="user"  id="user" required>
          <div class="icon">
            <img src="../assets/icon/outline/user.svg" width="15" style="opacity: 0.5;">
          </div>
        </div>
      </div>
      <div class="form-group with_icon mb-2" id="show_hide_password">
        <label>Email</label>
        <div class="input_group">
          <input type="email" class="form-control" placeholder="enter your email" name="email"  id="email" required>
          <div class="icon">
            <img src="../assets/icon/outline/email.svg" width="15" style="opacity: 0.5;">
          </div>
        </div>
      </div>
    </div>
    <p id="demol">
      <div class="em__footer">
        <button type="submit" id="submit" name="submit" class="btn bg-primary color-white justify-content-center"><i class="fas fa-sign-in-alt"></i>Submit</button>
      </div>
    </div>
  </form>
</section>

<script type="text/javascript">
  $('#submit').click(function(){
    if($('#user').val() == '' ){
      Swal.fire({ icon: 'error', text: 'User ID tidak boleh kosong !' })
      return false;
    }if($('#email').val() == '' ){
      Swal.fire({ icon: 'error', text: 'Email tidak boleh kosong !' })
      return false;
    }
  })
</script>

<!-- FORGOT -->
<script type="text/javascript">
  $(document).ready(function(){
    $("#submit").click(function(e){
      var valid = this.form.checkValidity();
      var email  = $('input[name="email"]').val();
      var pass  = $('input[name="pass"]').val();
      if (valid) {
        event.preventDefault();
        var data = $('#form').serialize();
        document.getElementById("demol").innerHTML = "<center>Please Wait...<br><img src='../assets/img/loader.gif' width='100'></center>";
        $.ajax({
          type    : 'POST',
          url     : 'action.php?action=forpass',
          data    : data,
          success : function(response){
            if(response == 1){
              $.ajax({
                url: 'mail_forpass.php',
                data    : { email:email ,pass:pass }, 
                type: 'post',
                success:function(response){
                  Swal.fire({
                    title: 'Berhasil!',
                    icon:  'success',
                    html:  '<small>Periksa email anda dan silahkan login kembali ke aplikasi Sisakty</small>',
                    confirmButtonText:
                    '<i class="fa fa-thumbs-up"></i> Oke'
                  }).then(function() {
                    location.href = 'home.php?v=login';
                  });
                }
              });
            } else {
              Swal.fire({
                title: 'gagal!',
                icon:  'error',
                html:  '<small>Periksa kembali User ID & Email anda !</small>',
                confirmButtonText:
                '<i class="fa fa-thumbs-up"></i> Oke'
              }).then(function() {
                location.href = 'home.php?v=forgot-password';
              });
            }
          }
        });
      }
    });
  });
</script>