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

                        <a href="<?php echo base_url('seeker') ?>" class="btn head-btn1">Kandidat</a>
                        <a href="<?php echo base_url('provider') ?>" class="btn head-btn2">Perusahaan</a>
                        <?php else: ?>
                          <?php if ($this->session->user_level==1): ?>
                            <a href="<?php echo base_url('dashboard') ?>" class="btn head-btn1"><i class="fas fa-user mr-2"></i>Admin Panel</a>
                          <?php endif ?>

                          <?php if ($this->session->user_level==2): ?>
                            <a href="<?php echo base_url('seeker/dashboard') ?>" class="btn head-btn1"><i class="fas fa-user mr-2"></i>Job Seeker Area</a>
                          <?php endif ?>

                          <?php if ($this->session->user_level==3): ?>
                            <a href="<?php echo base_url('provider/dashboard') ?>" class="btn head-btn1"><i class="fas fa-user mr-2"></i>Job Provider Area</a>
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
