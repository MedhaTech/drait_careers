<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title><?php echo isset($pageTitle) ? $pageTitle : 'DrAIT :: Recruitment Portal'; ?></title>



  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url(); ?>admin_assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url(); ?>admin_assets/css/sb-admin-3.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?php echo base_url(); ?>admin_assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>admin_assets/vendor/jquery/jquery.js"></script>
  <script src="<?php echo base_url(); ?>admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>admin_assets/vendor/jquery-easing/jquery.easing.min.js"></script>


  <style>
    .header {
      background: #fff none repeat scroll 0 0;
      border-bottom: 2px solid rgba(0, 0, 0, .15)
    }

    .header__main {
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-justify-content: space-between;
      -moz-justify-content: space-between;
      -ms-justify-content: space-between;
      justify-content: space-between;
      -ms-flex-pack: space-between;
      -webkit-align-items: center;
      -moz-align-items: center;
      -ms-align-items: center;
      align-items: center
    }

    @media screen and (max-width: 575px) {
      .header__main {
        -webkit-flex-direction: column;
        -moz-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-orient: vertical;
        -moz-box-orient: vertical;
        -ms-box-orient: vertical;
        box-orient: vertical
      }
    }

    .header__main--logo {
      width: 320px
    }

    @media screen and (min-width : 200px)and (max-width :480px) {
      .header__main--logo {
        width: 290px
      }
    }

    .header__main--logo img {
      display: block
    }

    .header__main--sub-logo {
      width: 260px
    }

    .header__main--sub-logo img {
      display: block
    }

    @media screen and (max-width : 991px) {
      .header__main--sub-logo {
        display: none
      }
    }

    @media screen and (max-width: 575px) {
      .header__main__rs {
        display: -webkit-box;
        display: -moz-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        min-height: inherit;
        -webkit-justify-content: space-between;
        -moz-justify-content: space-between;
        -ms-justify-content: space-between;
        justify-content: space-between;
        -ms-flex-pack: space-between;
        -webkit-align-items: center;
        -moz-align-items: center;
        -ms-align-items: center;
        align-items: center;
        width: 100%;
        margin-top: .75rem
      }
    }

    @media screen and (max-width: 575px) {
      .header__main__rs__info {
        display: none
      }
    }

    .header__main__rs__info li {
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-align-items: center;
      -moz-align-items: center;
      -ms-align-items: center;
      align-items: center;
      font-size: .8125rem;
      line-height: .975rem;
      line-height: 1;
      margin-top: .75rem
    }

    .header__main__rs__info li span.icon {
      -webkit-border-radius: 50%;
      border-radius: 50%;
      background: #023e86 none repeat scroll 0 0;
      width: 25px;
      height: 25px;
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-align-items: center;
      -moz-align-items: center;
      -ms-align-items: center;
      align-items: center;
      -webkit-justify-content: center;
      -moz-justify-content: center;
      -ms-justify-content: center;
      justify-content: center;
      -ms-flex-pack: center;
      margin-right: 10px
    }

    .header__main__rs__info li span.icon i {
      font-size: .75rem;
      line-height: .9rem;
      line-height: 1
    }

    .header__main__rs__info li a {
      font-size: .8125rem;
      line-height: .975rem;
      line-height: 1
    }

    @media screen and (max-width: 575px) {
      .header__main__rs__info li {
        margin-top: 0
      }

      .header__main__rs__info li span.icon,
      .header__main__rs__info li span.resHide {
        display: none
      }
    }

    .header__main__rs__login {
      background: #023e86 none repeat scroll 0 0;
      margin-top: .9375rem;
      width: 100%;
      max-width: 400px;
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex
    }

    @media screen and (max-width: 575px) {
      .header__main__rs__login {
        margin: 0 auto
      }
    }

    .header__main__rs__login a+a {
      border-left: 1px solid #fff
    }

    .header__main__rs__login .user-info {
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      text-decoration: none;
      -webkit-align-items: center;
      -moz-align-items: center;
      -ms-align-items: center;
      align-items: center;
      -webkit-justify-content: center;
      -moz-justify-content: center;
      -ms-justify-content: center;
      justify-content: center;
      -ms-flex-pack: center;
      color: #fff;
      cursor: pointer;
      padding: .625rem .9375rem
    }

    .header__main__rs__login .user-info .icon {
      margin-right: 12px
    }

    .header__main__rs__login .user-info .title {
      font-size: .8125rem;
      line-height: .975rem;
      line-height: 1
    }

    .header__main__rs__login .user-info .user-image {
      width: 25px;
      height: 25px;
      -webkit-border-radius: 50px;
      border-radius: 50px;
      margin-right: .625rem
    }

    .header__main__rs__login .user-info--loggedIn {
      -webkit-justify-content: flex-start;
      -moz-justify-content: flex-start;
      -ms-justify-content: flex-start;
      justify-content: flex-start;
      -ms-flex-pack: flex-start
    }

    .header__main__rs__login .user-info--loggedIn .title {
      text-overflow: ellipsis;
      overflow: hidden;
      white-space: nowrap;
      width: calc(100% - 46px)
    }

    .header__main__rs__login .dropdown-menu {
      -webkit-border-radius: 0;
      border-radius: 0;
      padding: 0
    }

    .header__main__rs__login .dropdown-menu a {
      width: 100%;
      display: block;
      padding: .9375rem;
      border-bottom: 1px solid #efefef;
      min-width: 184px
    }

    .footer {
      background: #023e86 none repeat scroll 0 0;
      padding: 0 !important;
    }

    .footer__top {
      padding: .9375rem 0;
      text-align: center;
      color: #fff;
      font-size: .8125rem;
      line-height: .975rem;
      line-height: 1.5
    }

    .footer__bottom {
      background: #0355b8 none repeat scroll 0 0;
      padding: .625rem 0
    }

    .footer__bottom__main {
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      -webkit-justify-content: space-between;
      -moz-justify-content: space-between;
      -ms-justify-content: space-between;
      justify-content: space-between;
      -ms-flex-pack: space-between;
      -webkit-align-items: center;
      -moz-align-items: center;
      -ms-align-items: center;
      align-items: center
    }

    @media screen and (max-width : 991px) {
      .footer__bottom__main {
        -webkit-flex-direction: column;
        -moz-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-orient: vertical;
        -moz-box-orient: vertical;
        -ms-box-orient: vertical;
        box-orient: vertical;
        -webkit-justify-content: center;
        -moz-justify-content: center;
        -ms-justify-content: center;
        justify-content: center;
        -ms-flex-pack: center
      }
    }

    .footer__bottom__main--ls {
      color: #fff;
      font-size: .8125rem;
      line-height: .975rem;
      line-height: 1.5
    }

    @media screen and (max-width : 991px) {
      .footer__bottom__main--ls {
        margin-bottom: .625rem;
        text-align: center
      }
    }

    @media screen and (max-width: 320px) {
      .footer__bottom__main--rs {
        text-align: center
      }
    }

    .footer__bottom__main--rs a {
      color: #fff;
      font-size: .8125rem;
      line-height: .975rem;
      line-height: 1;
      transition: all .3s ease;
      -moz-transition: all .3s ease;
      -o-transition: all .3s ease;
      -webkit-transition: all .3s ease;
      -ms-transition: all .3s ease
    }

    .footer__bottom__main--rs a+a {
      border-left: 1px solid #fff;
      margin-left: .625rem;
      padding-left: .625rem
    }

    @media screen and (max-width: 320px) {
      .footer__bottom__main--rs a+a {
        border-left: 0;
        margin-left: 0;
        padding-left: 0
      }
    }

    .footer__bottom__main--rs a:focus,
    .footer__bottom__main--rs a:hover {
      color: #56bdea
    }

    .footer__bottom__main--rs a:focus+a,
    .footer__bottom__main--rs a:hover+a {
      border-color: #fff
    }

    @media screen and (max-width: 320px) {
      .footer__bottom__main--rs a {
        width: 100%;
        text-align: center;
        display: block;
        margin-bottom: .3125rem
      }
    }

    section.career-current-opening {
      background: #fff;
      padding: 50px 0;
    }

    section.career-current-opening h2 {
      text-align: center;
      font-size: 2rem;
      margin-bottom: 50px;
      font-family: 'Roboto Slab', serif;
      color: #023e86;
      /* Bright color for the main heading */
    }

    /* Card styling */
    .carer_wrappper {
      background: #023e8617;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      margin-bottom: 30px;
    }

    .career-opening {
      padding: 20px;
    }

    .career-opening h3 {
      font-size: 1.4rem;
      margin-bottom: 15px;
      color: #023e86;
      font-family: 'Roboto Slab', serif;
      text-decoration: none;
    }

    .career-opening a {
      text-decoration: none;
      color: #023e86;
    }

    .career-opening .years-current,
    .career-opening .place-current {
      font-size: .9rem;
      color: #555;
    }

    .career-opening .years-current {
      margin-bottom: 10px;
      /* Increased gap between years-current and place-current */
    }

    .career-opening .place-current {
      margin-top: 10px;
      /* Increased gap between years-current and place-current */
    }

    .career-apply {
      background: #fdebe7;
      padding: 20px;
      text-align: center;
      position: relative;
      display: flex;
      justify-content: space-between;
      /* Align Apply Now and Read More on the same line */
      align-items: center;
      /* Center the items vertically */
    }

    .apply-now a ,.apply-now button{
      background: #febe10;
      padding: 10px 24px;
      color: #000;
      text-transform: uppercase;
      font-weight: 600;
      font-size: .9rem;
      border-radius: 5px;
      text-decoration: none;
    }

    .career-apply .read-more {
      position: relative;
    }

    .career-apply .read-more a {
      border: 1px solid #333;
      color: #333;
      padding: 10px;
      display: inline-block;
      width: 40px;
      height: 40px;
      text-align: center;
      line-height: 20px;
      font-size: 1.4rem;
    }

    .career-opening h3:after {
      content: "";
      width: 50px;
      height: 2px;
      background: #febe10;
      position: absolute;
      bottom: 0;
      left: 0;
    }

    .apply-now a:hover {
      background: #fff;
    }

    .career-apply .read-more a:hover {
      background: #fff;
      color: #333;
    }

    @media (max-width: 768px) {
      section.career-current-opening h2 {
        font-size: 1.5rem;
      }

      .career-opening h3 {
        font-size: 1.2rem;
      }

      .apply-now a {
        font-size: 0.8rem;
        padding: 8px 20px;
      }

      .read-more a {
        font-size: 1rem;
        width: 30px;
        height: 30px;
      }
    }
  </style>
</head>

<body>
  <!-- Begin page -->
  <div id="layout-wrapper">

    <div class="main-content">
      <div class="header d-print-none">
        <div class="container">
          <div class="row">
            <div class="col-12">
              <div class="header__main">
                <a href="<?= base_url(); ?>" class="header__main--logo">
                  <img src="<?= base_url(); ?>assets/images/full_logo-wide.png" alt="Dr.AIT logo" class="img-fluid">
                </a>

                <span></span>
                <div class="header__main__rs">



                  <?php if ($this->session->userdata('logged_in')) { ?>
                    <div class="header__main__rs__info">
                      <ul>
                        <li>

                          <span class="resHide">Welcome &nbsp; </span> <span><?= $candidate_name; ?>,</span>
                        </li>
                      </ul>
                    </div>
                    <div class="header__main__rs__login ">

                      <a href="<?= base_url('recruitment'); ?>/dashboard" class="user-info">
                        <span class="icon fa fa-home"></span>
                        <div class="title">Dashboard</div>
                      </a>
                      <a href="<?= base_url('recruitment'); ?>/profile" class="user-info">
                        <!-- <span class="icon fa fa-user"></span> -->
                        <div class="title">Profile</div>
                      </a>
                      <a href="<?= base_url('recruitment'); ?>/applied" class="user-info">
                        <!-- <span class="icon fa fa-user"></span> -->
                        <div class="title">Applied Jobs</div>
                      </a>
                      <a href="<?= base_url('recruitment'); ?>/logout" class="user-info">
                        <!-- <span class="icon fa fa-lock"></span> -->
                        <div class="title">Logout</div>
                      </a>
                    </div>
                  <?php } else { ?>
                    <div class="header__main__rs__info">
                      <ul>
                        <li>
                          <span class="icon"><i class="fa fa-phone"></i></span>
                          <span class="resHide">Call : </span> <span>9886096821</span>
                        </li>
                      </ul>
                    </div>
                    <div class="header__main__rs__login ">

                      <a href="<?= base_url('recruitment'); ?>/" class="user-info">
                        <span class="icon fa fa-user-circle"></span>
                        <div class="title">Login</div>
                      </a>
                      <a href="<?= base_url('recruitment'); ?>/register" class="user-info">
                        <span class="icon fa fa-user"></span>
                        <div class="title">Register</div>
                      </a>
                    </div>
                  <?php } ?>

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>