<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Team-focus | Admin System Log in</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <link href="<?php echo base_url('assets/admin/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet"
    type="text/css" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet"
    type="text/css" />
  <link href="<?php echo base_url('assets/admin/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="login-page">
  <div class="login-box">
    <div class="login-logo">
      <a href="#">Admin Panel</a>
    </div><!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Sign In</p>
      <form action="" method="post" id="login">
        <div class="form-group has-feedback">
          <input type="email" class="form-control" placeholder="Email" name="email" required
            value="imra8233@gmail.com" />
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" placeholder="Password" name="password" required />
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-8">
            <div class="response"></div>
          </div><!-- /.col -->
          <div class="col-xs-4">
            <input type="submit" class="btn btn-primary btn-block btn-flat" value="Sign In" />
          </div><!-- /.col -->
        </div>
      </form>

      <a href="<?php echo base_url('admin/forgotPassword'); ?>">Forgot Password</a><br>

    </div><!-- /.login-box-body -->
  </div><!-- /.login-box -->

  <script src="<?php echo base_url('assets/admin/js/jQuery-2.1.4.min.js'); ?>"></script>
  <script src="<?php echo base_url('assets/admin//bootstrap/js/bootstrap.min.js') ; ?>" type="text/javascript"></script>
  <script>
    $(document).ready(function () {
      $("#login").submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
          url: '<?php echo base_url("admin/login/loginMe"); ?>',
          type: "post",
          data: formData,
          beforeSend: function () {
            $(".response").html('<p>Please Wait Processing Request</p>');
          },success: function (data) {
            var dec_data = JSON.parse(data);
            if(dec_data.status == 200){
              $(".response").html(`<p class="text-success">${dec_data.msg}</p>`);
            }else{
              $(".response").html(`<p class="text-danger">${dec_data.msg}</p>`);
            }
          },error: function (err) {
            $(".response").html(`<p class="text-danger">${err.responseText}</p>`);
          },complete: function (data) {
            if(data.status == 200){
              $(".response").html(`<p class="text-info">Please Wait You Will Redirected to Dashboard</p>`);
              setTimeout(function(){
                window.location.replace('<?= base_url("admin");?>');
              },1500)
            }
          }
        });
        return false;
      });
    });
  </script>
</body>

</html>