<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WareHouse Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/adminlte.min.css">
  
  <!-- Lato Font Starts -->
  <!-- <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/lato-font.css"> -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

  <!-- Custom Css Starts -->
  <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/admin-login.css">
   <script>
    
    var base_url="<?php echo base_url();?>";

    </script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"><img height="150" src="<?php echo base_url(); ?>assets/dist/img/sidebar-logo/001.jpg"></p>

      <!-- <form action="" method="post"> -->
        <div class="w-100 text-center" id="login-error"></div>
        <div class="input-group mb-3">
         <!--  <div class="input-group-append">
            <div class="input-group-text">
              <span class="fa-login">@</span>
            </div>
          </div> -->
          <input type="email" id="email" class="form-control login-input" placeholder="Email">
        </div>
        <div class="text-danger error-msg" id="login-email-error"></div>
        <div class="input-group">
         <!--  <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock fa-login"></span>
            </div>
          </div> -->
          <input type="password" id="password" class="form-control login-input" placeholder="Password">
        </div>
        <div class="text-danger error-msg" id="login-password-error"></div>
        <p class="mb-1">
          <a href="#" class="forgot-password-link d-none">Forgot Password ?</a>
        </p>
        <div class="row">
          <div class="col-12 text-center">
            <button id="submit" onclick="adminLogin()" name="submit" class="btn btn-login text-white">Login</button>
          </div>
        </div>
      <!-- </form> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="<?php echo base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Custome JS -->
<script src="<?php echo base_url()?>assets/customeJS/warehouse/adminLogin.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/dist/js/adminlte.min.js"></script>

</body>
</html>


