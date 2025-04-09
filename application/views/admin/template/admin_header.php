<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo isset($pageTitle) ? $pageTitle : 'Dr.AIT';?></title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?php echo base_url();?>admin_assets/img/favicon.png" type="image/x-icon" />
  <link rel="apple-touch-icon" href="<?php echo base_url();?>admin_assets/img/favicon.png">  

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url();?>admin_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url();?>admin_assets/css/sb-admin-2.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url();?>admin_assets/css/bootstrap-datetimepicker.min.css" type="text/css" media="all" />
  
  <!-- Custom styles for this page -->
  <link href="<?php echo base_url();?>admin_assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url();?>admin_assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url();?>admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url();?>admin_assets/vendor/jquery-easing/jquery.easing.min.js"></script>

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
        if($username == 'admin' || $username == 'egovernance'){
      ?>
      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?php echo ($activeMenu == "dashboard")? 'active' :''; ?>">
        <?php echo anchor('admin/dashboard','<i class="fas fa-fw fa-tachometer-alt"></i> <span>Dashboard</span>', 'class="nav-link"'); ?>
      </li>
      <!--<li class="nav-item <?php echo ($activeMenu == "faculty")? 'active' :''; ?>">-->
      <!--  <?php echo anchor('admin/faculty','<i class="fas fa-fw fa-user-graduate"></i> <span>Faculty</span>', 'class="nav-link"'); ?>-->
      <!--</li>-->
      <li class="nav-item <?php echo ($activeMenu == "staff")? 'active' :''; ?>">
        <?php echo anchor('admin/staff','<i class="fas fa-fw fa-users"></i> <span>Non Teaching Staff</span>', 'class="nav-link"'); ?>
      </li>
      <li class="nav-item <?php echo ($activeMenu == "departments")? 'active' :''; ?>">
        <?php echo anchor('admin/departments','<i class="fas fa-fw fa-graduation-cap"></i> <span>Departments</span>', 'class="nav-link"'); ?>
      </li>
      <li class="nav-item <?php echo ($activeMenu == "notifications")? 'active' :''; ?>">
        <?php echo anchor('admin/notifications','<i class="fas fa-fw fa-bell"></i> <span>Notifications</span>', 'class="nav-link"'); ?>
      </li>
      <li class="nav-item <?php echo ($activeMenu == "scrolling")? 'active' :''; ?>">
        <?php echo anchor('admin/scrolling','<i class="fas fa-scroll"></i> <span>Scrolling</span>', 'class="nav-link"'); ?>
      </li>
      <li class="nav-item <?php echo ($activeMenu == "news")? 'active' :''; ?>">
        <?php echo anchor('admin/news','<i class="far fa-newspaper"></i> <span>News & Events</span>', 'class="nav-link"'); ?>
      </li>
      <li class="nav-item <?php echo ($activeMenu == "gallery")? 'active' :''; ?>">
        <?php echo anchor('admin/gallery','<i class="fas fa-fw fa-images"></i> <span>Gallery</span>', 'class="nav-link"'); ?>
      </li>
      <!--<li class="nav-item <?php echo ($activeMenu == "connect")? 'active' :''; ?>">-->
      <!--  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConnect" aria-expanded="true" aria-controls="collapseConnect">-->
      <!--    <i class="far fa-comments"></i>-->
      <!--    <span>Connect</span>-->
      <!--  </a>-->
      <!--  <div id="collapseConnect" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">-->
      <!--    <div class="bg-white py-2 collapse-inner rounded">-->
      <!--      <?php echo anchor('admin/connectStudents','Send SMS to Students', 'class="collapse-item"'); ?>-->
      <!--      <?php echo anchor('admin/connectStaff','Send SMS to Staff', 'class="collapse-item"'); ?>-->
      <!--      <?php echo anchor('admin/connectCategories','Send SMS to Categories', 'class="collapse-item"'); ?>-->
      <!--      <?php echo anchor('admin/sentConnect','SMS Summary', 'class="collapse-item"'); ?>-->
      <!--      <?php echo anchor('admin/categories','Categories', 'class="collapse-item"'); ?>-->
      <!--      <?php echo anchor('admin/students','Students', 'class="collapse-item"'); ?>-->
      <!--      <?php echo anchor('admin/promoteStudents','Promote Students', 'class="collapse-item"'); ?>-->
      <!--      <?php echo anchor('admin/connectSummary','Dept. SMS Usage', 'class="collapse-item"'); ?>-->
      <!--    </div>-->
      <!--  </div>-->
      <!--</li>-->
      <li class="nav-item <?php echo ($activeMenu == "system")? 'active' :''; ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cog"></i>
          <span>System</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <?php echo anchor('admin/academicYears','Academic Years', 'class="collapse-item"'); ?>
            <?php echo anchor('admin/sections','Sections', 'class="collapse-item"'); ?>
            <?php echo anchor('admin/upload','Upload Data', 'class="collapse-item"'); ?>
          </div>
        </div>
      </li>
      <li class="nav-item <?php echo ($activeMenu == "analytics")? 'active' :''; ?>">
        <?php echo anchor('https://analytics.google.com/','<i class="far fa-chart-bar"></i> <span>Analytics</span>', 'class="nav-link" target="_blank"'); ?>
      </li>
      <?php } ?>
      <?php
        if($username == 'principal'){
      ?>
        <li class="nav-item <?php echo ($activeMenu == "")? 'active' :''; ?>">
          <?php echo anchor('admin/connectStudents','<i class="fas fa-fw fa-list"></i> <span>Send SMS to Students</span>', 'class="nav-link"'); ?>
        </li>
        <li class="nav-item <?php echo ($activeMenu == "")? 'active' :''; ?>">
          <?php echo anchor('admin/connectStaff','<i class="fas fa-fw fa-list"></i> <span>Send SMS to Staff</span>', 'class="nav-link"'); ?>
        </li>
        <li class="nav-item <?php echo ($activeMenu == "")? 'active' :''; ?>">
          <?php echo anchor('admin/connectCategories','<i class="fas fa-fw fa-list"></i> <span>Send SMS to Categories</span>', 'class="nav-link"'); ?>
        </li>
        <li class="nav-item <?php echo ($activeMenu == "")? 'active' :''; ?>">
          <?php echo anchor('admin/sentConnect','<i class="fas fa-fw fa-list"></i> <span>SMS Summary</span>', 'class="nav-link"'); ?>
        </li>
        <li class="nav-item <?php echo ($activeMenu == "")? 'active' :''; ?>">
          <?php echo anchor('admin/categories','<i class="fas fa-fw fa-list"></i> <span>Categories</span>', 'class="nav-link"'); ?>
        </li>
        <li class="nav-item <?php echo ($activeMenu == "")? 'active' :''; ?>">
          <?php echo anchor('admin/students','<i class="fas fa-fw fa-list"></i> <span>Students</span>', 'class="nav-link"'); ?>
        </li>
      <?php } ?>  
      <?php
        if($username == 'hostel'){
      ?>
        <li class="nav-item <?php echo ($pageTitle == "Connect")? 'active' :''; ?>">
          <?php echo anchor('admin/connectCategories','<i class="fas fa-fw fa-list"></i> <span>Send SMS to Categories</span>', 'class="nav-link"'); ?>
        </li>
        <li class="nav-item <?php echo ($pageTitle == "Sent SMS Details")? 'active' :''; ?>">
          <?php echo anchor('admin/sentConnect','<i class="fas fa-fw fa-list"></i> <span>SMS Summary</span>', 'class="nav-link"'); ?>
        </li>
        <li class="nav-item <?php echo ($pageTitle == "Categories")? 'active' :''; ?>">
          <?php echo anchor('admin/categories','<i class="fas fa-fw fa-list"></i> <span>Categories</span>', 'class="nav-link"'); ?>
        </li>
      <?php } ?>  
      <li class="nav-item <?php echo ($activeMenu == "changePassword")? 'active' :''; ?>">
        <?php echo anchor('admin/changePassword','<i class="fas fa-fw fa-key"></i> <span>Change Password</span>', 'class="nav-link"'); ?>
      </li>
      <li class="nav-item <?php echo ($activeMenu == "logout")? 'active' :''; ?>">
        <?php echo anchor('admin/logout','<i class="fas fa-sign-out-alt fa-sm fa-fw"></i> <span>Logout</span>', 'class="nav-link"'); ?>
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
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Welcome to <?=strtoupper($username);?></span>
                <div class="sidebar-brand-icon rotate-n-15">
                  <i class="fas fa-laugh-wink"></i>
                </div>
              </a>
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->

