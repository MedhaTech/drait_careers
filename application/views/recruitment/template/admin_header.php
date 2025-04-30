<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo isset($pageTitle) ? $pageTitle : 'DrAIT'; ?></title>



  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>admin_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>admin_assets/css/sb-admin-2.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url(); ?>admin_assets/css/bootstrap-datetimepicker.min.css" type="text/css" media="all" />

  <!-- Custom styles for this page -->
  <link href="<?php echo base_url(); ?>admin_assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>admin_assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>admin_assets/vendor/jquery-easing/jquery.easing.min.js"></script>

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gray sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3"> Dr.AIT </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <?php
      if ($username == 'recruitment-admin') {
      ?>
        <!-- Nav Item - Dashboard -->
        <!-- <li class="nav-item <?php echo ($activeMenu == "dashboard") ? 'active' : ''; ?>">
          <?php echo anchor('main/admin_dashboard', '<i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span>', 'class="nav-link"'); ?>
        </li> -->

        <li class="nav-item <?php echo ($activeMenu == "jobposts") ? 'active' : ''; ?>">
          <?php echo anchor('main/jobposts', '<i class="fas fa-fw fa-users"></i> <span>Job Posts </span>', 'class="nav-link"'); ?>
        </li>

      <?php } ?>
      <li class="nav-item <?php echo ($activeMenu == "changePassword") ? 'active' : ''; ?>">
        <?php echo anchor('main/changePassword', '<i class="fas fa-fw fa-key"></i> <span>Change Password</span>', 'class="nav-link"'); ?>
      </li>
      <li class="nav-item <?php echo ($activeMenu == "logout") ? 'active' : ''; ?>">
        <?php echo anchor('main/logout', '<i class="fas fa-sign-out-alt fa-sm fa-fw"></i> <span>Logout</span>', 'class="nav-link"'); ?>
      </li>


      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome to <?= strtoupper($username); ?></span>
                <div class="sidebar-brand-icon rotate-n-15">
                  <i class="fas fa-laugh-wink"></i>
                </div>
              </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->