<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title><?= $pageTitle; ?></title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
  <!-- Bootstrap 3.3.4 -->
  <link href="<?= base_url('assets/admin/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
  <!-- FontAwesome 4.3.0 -->
  <link href="<?= base_url('assets/admin/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css" />
  <!-- Theme style -->

  <link href="<?= base_url('assets/admin/plugins/iCheck/minimal/blue.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/admin/plugins/datatables/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" />
  <!-- <link href="<?= base_url('assets/admin/plugins/datatables//jquery.dataTables.min.css'); ?>" rel="stylesheet" type="text/css" /> -->
  <link href="<?= base_url('assets/admin/plugins/select2/select2.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/admin/plugins/pace/pace.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/admin/dist/css/AdminLTE.min.css'); ?>" rel="stylesheet" type="text/css" />
  <link href="<?= base_url('assets/admin/dist/css/skins/_all-skins.min.css'); ?>" rel="stylesheet" type="text/css" />


  <!-- <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery-ui.css" rel="stylesheet" type="text/css">  -->

  <style>
    .error {
      color: red;
      font-weight: normal;
    }

    .bar {
      position: absolute;
      z-index: 10001;
      background-color: rgba(255, 255, 255, .15);
      width: 100%;
      text-align: center;
      font-size: 16px;

    }

    div#codeigniter_profiler {
      margin-left: 233px;
    }
  </style>
  <script src="<?= base_url('assets/admin/plugins/JQuery/jQuery-2.1.4.min.js'); ?>" type="text/javascript"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script type="text/javascript">
    var baseURL = "<?= base_url('admin/'); ?>";
  </script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- <body class="sidebar-mini skin-black-light"> -->

<body class="skin-blue-light sidebar-mini ">

  <div class="wrapper">
    <div id="statusBar"></div>
    <header class="main-header">
      <!-- Logo -->
      <a href="<?= base_url('/admin/'); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Y</b>L</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Ubix</b>star</span>
      </a>

      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li><a href="<?= base_url(); ?>" target="_blank">Visit Site</a></li>
            <!-- notifications -->
            <li class="dropdown notifications-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i>
                <span class="label label-warning"><span id="notification_number">10</span></span>
              </a>
              <ul class="dropdown-menu">
                <li class="header">You have <span id="notification_number">10</span> notifications</li>
                <li>
                  <ul class="menu" id="notification_center">
                    <li>
                      <a href="#">
                        <i class="fa fa-users text-aqua"></i> 5 new members joined today
                      </a>
                    </li>
                  </ul>
                </li>
                <!-- <li class="footer"><a href="#">View all</a></li> -->
              </ul>
            </li>
            <!-- end notifications -->
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= base_url('assets/admin/dist/img/avatar.png'); ?>" class="user-image" alt="User Image" />
                <span class="hidden-xs"></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo base_url('assets/admin/dist/img/avatar.png'); ?>" class="img-circle" alt="User Image" />
                  <p>
                    <?php echo $this->session->userdata('name'); ?>
                    <small><?php echo $this->session->userdata('roleText'); ?></small>
                  </p>
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?php echo base_url('admin/loadChangePass'); ?>" class="btn btn-default btn-flat"><i class="fa fa-key"></i> Change Password</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?php echo base_url('logout'); ?>" class="btn btn-default btn-flat"><i class="fa fa-sign-out"></i> Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
    <?php $this->load->view('admin/includes/sidebar'); ?>