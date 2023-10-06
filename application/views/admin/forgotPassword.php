<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Team-focus | Admin System Log in</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- favicon
		============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
  <!-- Google Fonts
		============================================ -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/bootstrap.min.css'); ?>">
  <!-- Bootstrap CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/font-awesome.min.css'); ?>">
  <!-- owl.carousel CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/owl.carousel.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/owl.theme.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/owl.transitions.css'); ?>">
  <!-- meanmenu CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/meanmenu/meanmenu.min.css'); ?>">
  <!-- animate CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/animate.css'); ?>">
  <!-- normalize CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/normalize.css'); ?>">
  <!-- mCustomScrollbar CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/scrollbar/jquery.mCustomScrollbar.min.css'); ?>">
  <!-- jvectormap CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/jvectormap/jquery-jvectormap-2.0.3.css'); ?>">
  <!-- notika icon CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/notika-custom-icon.css'); ?>">
  <!-- wave CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/wave/waves.min.css'); ?>">
  <!-- main CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/main.css'); ?>">
  <!-- style CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/style.css'); ?>">
  <!-- responsive CSS
		============================================ -->
  <link rel="stylesheet" href="<?php echo base_url('admin_assets/css/responsive.css'); ?>">
  <!-- modernizr JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/vendor/modernizr-2.8.3.min.js'); ?>"></script>
</head>

<body>

  <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
  <!-- Login Register area Start-->
  <div class="login-content">
    <div class="nk-block toggled" id="l-forget-password">
      <div class="nk-form">
        <p class="text-left">Please Enter your registered Email.<br />if you want to rest your password an reset password link send to your email address with that you can reset your password .</p>
        <form action="<?php echo base_url('admin/resetPasswordUser'); ?>" method="post">
          <div class="input-group">
            <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-mail"></i></span>
            <div class="nk-int-st">
              <input type="text" class="form-control" placeholder="Email Address" name="login_email" required>
            </div>
          </div>

          <button type="submit" data-ma-action="nk-login-switch" data-ma-block="#l-login" class="btn btn-login btn-success btn-float waves-effect waves-circle waves-float"><i class="notika-icon notika-right-arrow"></i></button>
        </form>
      </div>

      <div class="nk-navigation nk-lg-ic rg-ic-stl">
        <a href="<?php echo base_url('admin/login'); ?>" data-ma-action="nk-login-switch" data-ma-block="#l-login"><i class="notika-icon notika-right-arrow"></i> <span>Sign in</span></a>
      </div>
    </div>
  </div>
  <!-- Login Register area End-->
  <script src="<?php echo base_url('admin_assets/js/vendor/jquery-1.12.4.min.js'); ?>"></script>
  <!-- bootstrap JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/bootstrap.min.js'); ?>"></script>
  <!-- wow JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/wow.min.js'); ?>"></script>
  <!-- price-slider JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/jquery-price-slider.js'); ?>"></script>
  <!-- owl.carousel JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/owl.carousel.min.js'); ?>"></script>
  <!-- scrollUp JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/jquery.scrollUp.min.js'); ?>"></script>
  <!-- meanmenu JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/meanmenu/jquery.meanmenu.js'); ?>"></script>
  <!-- counterup JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/counterup/jquery.counterup.min.js'); ?>"></script>
  <script src="<?php echo base_url('admin_assets/js/counterup/waypoints.min.js'); ?>"></script>
  <script src="<?php echo base_url('admin_assets/js/counterup/counterup-active.js'); ?>"></script>
  <!-- mCustomScrollbar JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>

  <!-- sparkline JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/sparkline/jquery.sparkline.min.js'); ?>"></script>
  <script src="<?php echo base_url('admin_assets/js/sparkline/sparkline-active.js'); ?>"></script>
  <!-- sparkline JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/flot/jquery.flot.js'); ?>"></script>
  <script src="<?php echo base_url('admin_assets/js/flot/jquery.flot.resize.js'); ?>"></script>
  <script src="<?php echo base_url('admin_assets/js/flot/curvedLines.js'); ?>"></script>
  <script src="<?php echo base_url('admin_assets/js/flot/flot-active.js'); ?>"></script>
  <!-- knob JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/knob/jquery.knob.js'); ?>"></script>
  <script src="<?php echo base_url('admin_assets/js/knob/jquery.appear.js'); ?>"></script>
  <script src="<?php echo base_url('admin_assets/js/knob/knob-active.js'); ?>"></script>
  <!--  wave JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/wave/waves.min.js'); ?>"></script>
  <script src="<?php echo base_url('admin_assets/js/wave/wave-active.js'); ?>"></script>
  <!--  todo JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/todo/jquery.todo.js'); ?>"></script>
  <!-- plugins JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/plugins.js'); ?>"></script>
  <!--  Chat JS
		============================================ -->
  <script src="<?php echo base_url('admin_assets/js/chat/moment.min.js'); ?>"></script>
  <script src="<?php echo base_url('admin_assets/js/chat/jquery.chat.js'); ?>"></script>

</body>

</html>