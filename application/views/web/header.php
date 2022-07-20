<!DOCTYPE html>
<?php foreach ($stp as $s): ?>

  <html class="no-js" lang="zxx">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Talent Hub</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="manifest" href="site.webmanifest" />
    <link
    rel="shortcut icon"
    type="image/x-icon"
    href="<?php echo base_url() ?>assets/img/favicon.ico"
    />
    <!-- CSS here -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/owl.carousel.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/flaticon.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/price_rangs.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/slicknav.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/animate.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/magnific-popup.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/fontawesome-all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/themify-icons.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/slick.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/nice-select.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/style.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets_admin/css/select2.min.css">

    <style type="text/css">
        .ph-merah::-webkit-input-placeholder {
            color: #DD2727
        }
    </style>
    
  </head>

  <body>

    <!-- Preloader Start -->
    <?php if ($this->uri->segment(1)==null) { ?>

      <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
          <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
              <img src="<?php echo base_url().$s->stp_logo ?>" alt="" />
            </div>
          </div>
        </div>
      </div>
    <?php  } ?>

    <!-- Preloader Start -->
    <header>
      <!-- Header Start -->
      <div class="header-area header-transparrent">
        <div class="headder-top header-sticky">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 col-md-2">
                <!-- Logo -->
                <div class="logo">
                  <a href="<?php echo base_url() ?>"
                    ><img src="<?php echo base_url().$s->stp_logo ?>" alt=""
                    /></a>
                  </div>
                </div>
                <div class="col-lg-9 col-md-9">
                  <div class="menu-wrapper">
                    <!-- Main-menu -->
                    <div class="main-menu">
                      <nav class="d-none d-lg-block">
                        <ul id="navigation">
                          <li><a href="<?php echo base_url() ?>">Home</a></li>
                          <li><a href="job_listing.html">Find a Jobs </a></li>
                          <li><a href="about.html">About</a></li>
                          <li>
                            <a href="#">Page</a>
                            <ul class="submenu">
                              <li><a href="blog.html">Blog</a></li>
                              <li><a href="single-blog.html">Blog Details</a></li>
                              <li><a href="elements.html">Elements</a></li>
                              <li><a href="job_details.html">job Details</a></li>
                            </ul>
                          </li>
                          <li><a href="contact.html">Contact</a></li>
                        </ul>
                      </nav>
                    </div>
                    <!-- Header-btn -->
                    <div class="header-btn d-none f-right d-lg-block">
                      <?php if ($this->session->login==FALSE): ?>

                        <a href="<?php echo base_url('landing/login') ?>" class="btn head-btn1">Login</a>
                        <a href="<?php echo base_url('landing/register') ?>" class="btn head-btn2">Register</a>
                        <?php else: ?>
                          <?php if ($this->session->user_level==1): ?>
                           

                              <div class="row">
                              <div class="col-12">
                               <li class="nav-item dropdown no-arrow">
                                <a class="nav-link align-items-center" href="<?php echo base_url('admin') ?>" id="userDropdown" role="button"
                               >
                                <img class="img-profile rounded-circle"
                                src="<?php echo base_url().$this->session->user_foto ?>" style="width: 50px">
                                <span class="ml-2 text-danger"><?php echo $this->session->user_nama; ?></span>
                              </a>
                          </li>
                        </div>
                      </div>




                          <?php endif ?>

                          <?php if ($this->session->user_level==2): ?>
                            <!-- <a href="<?php echo base_url('dashboard') ?>" class="btn head-btn1"><i class="fas fa-user mr-2"></i>Job Seeker Area</a> -->
                            <div class="row">
                              <div class="col-12">
                               <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle align-items-center" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle"
                                src="<?php echo base_url().$this->session->user_foto ?>" style="width: 50px">
                                <span class="ml-2 text-danger"><?php echo $this->session->user_nama; ?><i class="fa fa-chevron-down ml-5" aria-hidden="true"></i></span>
                              </a>
                              <div class="dropdown-menu text-danger dropdown-menu-right shadow animated--grow-in"
                              aria-labelledby="userDropdown">
                              <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Ubah Profile
                              </a>
                              <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Ubah Password
                              </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                              </a>
                            </div>
                          </li>
                        </div>
                      </div>
                    <?php endif ?>
                    <?php if ($this->session->user_level==3): ?>
                        <div class="row">
                              <div class="col-12">
                               <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle align-items-center" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img-profile rounded-circle"
                                src="<?php echo base_url().$this->session->user_foto ?>" style="width: 50px">
                                <span class="ml-2 text-danger"><?php echo $this->session->user_nama; ?><i class="fa fa-chevron-down ml-5" aria-hidden="true"></i></span>
                              </a>
                              <div class="dropdown-menu text-danger dropdown-menu-right shadow animated--grow-in"
                              aria-labelledby="userDropdown">
                              <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Ubah Profile
                              </a>
                              <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Ubah Password
                              </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                              </a>
                            </div>
                          </li>
                        </div>
                      </div>


                    <?php endif ?>

                  <?php endif ?>


                </div>
              </div>
            </div>
            <!-- Mobile Menu -->
            <div class="col-12">
              <div class="mobile_menu d-block d-lg-none"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Header End -->
  </header>

<?php endforeach ?>
