<!DOCTYPE html>
<?php foreach ($stp as $s) : ?>

  <html class="no-js" lang="zxx">

  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Talent Hub</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- <link rel="manifest" href="site.webmanifest" /> -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url() ?>assets/img/favicon.ico" />
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
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <style type="text/css">
      .ph-merah::-webkit-input-placeholder {
        color: #DD2727
      }

      .select2-selection__rendered {
        line-height: 31px !important;
      }

      .select2-container .select2-selection--single {
        height: 40px !important;
      }

      .select2-selection__arrow {
        height: 34px !important;
      }

      .popover-header {
        font-weight: bold !important;
        padding: 15px !important;
        background: #3f00ff !important;
        color: white !important;
        text-align: center;
        /* !important; */
      }

      .popover-body {
        text-align: center !important;
      }

      .popover {
        padding: 15px !important;
      }

      .note-btn {
        color: #dc3545 !important;
        background: transparent !important;
        height: 25px !important;
      }

      .btn-xs {
        padding: .25rem .4rem;
        font-size: .875rem;
        line-height: .5;
        border-radius: .2rem;
      }

      html,
      body {
        height: 100%;
      }


      .goog-te-banner-frame.skiptranslate {
        display: none !important;
      }

      body {
        top: 0px !important;
      }
    </style>

  </head>

  <body>

    <!-- Preloader Start -->
    <?php if ($this->uri->segment(1) == null) { ?>

      <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
          <div class="preloader-inner position-relative">
            <div class="preloader-circle"></div>
            <div class="preloader-img pere-text">
              <img src="<?php echo base_url() . $s->stp_brand_icon ?>" alt="" />
            </div>
          </div>
        </div>
      </div>
    <?php  } ?>
    <header>
      <div class="header-area header-transparrent">
        <div class="headder-top header-sticky">
          <div style="background-color: #DD2727;">
            <div class="container">
              <div class="row">
                <div class="col-md-8 text-left">
                  <?php if ($s->stp_facebook != '') : ?>
                    <a href="<?php echo $s->stp_facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i> STP </a>
                  <?php endif ?>
                  <?php if ($s->stp_instagram != '') : ?>

                    <a href="<?php echo $s->stp_instagram ?>" target="_blank"><i class="fab fa-instagram"></i> STP</a>
                  <?php endif ?>
                  <?php if ($s->stp_website != '') : ?>
                    <a href="<?php echo $s->stp_website ?>" target="_blank"><i class="fas fa-globe"></i> STP </a>
                  <?php endif ?>

                </div>
                <div class="col-md-4 text-right ">
                  <label class="text-white">Pilih Bahasa :</label>
                  <a href="#googtrans(id|id)" class="lang-select badge bg-white text-danger" data-lang="id">ID</a>
                  <label class="text-white"> | </label>
                  <a href="#googtrans(id|en)" class="lang-select badge bg-white text-danger" data-lang="en">EN</a>
                </div>
              </div>
            </div>
          </div>


          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-3 col-md-3">
                <!-- Logo -->
                <a href="<?php echo base_url() ?>"><img src="<?php echo base_url() . $s->stp_logo; ?>" style="height: 60px; width:240px;" alt="" /></a>
              </div>
              <div class="col-lg-9 col-md-9">
                <div class="menu-wrapper">
                  <div class="main-menu">
                    <nav class="d-none d-lg-block">
                      <ul id="navigation">
                        <li><a href="<?php echo base_url() ?>">Beranda</a></li>
                        <li><a href="<?php echo base_url('job/job_listing') ?>">Cari Pekerjaan </a></li>
                        <li><a href="<?= base_url(); ?>#about">Tentang</a></li>
                        <li><a href="<?= base_url(); ?>#about">Kontak</a></li>
                      </ul>
                    </nav>
                  </div>
                  <div class="header-btn d-none d-lg-block">
                    <?php if ($this->session->login == FALSE) { ?>
                      <a href="<?php echo base_url('landing/login') ?>" class="btn head-btn1">Login</a>
                      <a href="<?php echo base_url('landing/register') ?>" class="btn head-btn2">Registrasi</a>
                    <?php } else { ?>
                      <?php if ($this->session->user_level == 1) { ?>
                        <div class="row">
                          <div class="col-12">
                            <li class="nav-item dropdown no-arrow">
                              <a class="nav-link align-items-center" href="<?php echo base_url('admin') ?>" id="userDropdown" role="button">
                                <img class="img-profile rounded-circle" src="<?php echo $this->session->user_foto ?>" style="width: 50px">
                                <span class="ml-2 text-danger"><?php echo $this->session->user_nama; ?></span>
                              </a>
                            </li>
                          </div>
                        </div>

                      <?php }; ?>

                      <?php if ($this->session->user_level == 2) { ?>
                        <div class="nav">
                          <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <img class="img-profile rounded-circle" src="<?php echo $this->session->user_foto ?>" style="width: 50px">
                              <span class="ml-2 text-danger"><?php echo $this->session->user_nama; ?><i class="fa fa-chevron-down ml-5" aria-hidden="true"></i></span>
                            </a>
                            <div class="dropdown-menu text-danger dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                              <a class="dropdown-item" href="<?php echo base_url('dashboard') ?>">
                                <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                Beranda Saya
                              </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Keluar
                              </a>
                            </div>
                          </li>

                        </div>
                      <?php }; ?>

                      <?php if ($this->session->user_level == 3) { ?>
                        <div class="nav">
                          <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle align-items-center" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <img class="img-profile rounded-circle" src="<?php echo $this->session->user_foto ?>" style="width: 50px">
                              <span class="ml-2 text-danger"><?php echo $this->session->user_nama; ?><i class="fa fa-chevron-down ml-5" aria-hidden="true"></i></span>
                            </a>
                            <div class="dropdown-menu text-danger dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                              <a class="dropdown-item" href="<?php echo base_url('dashboard') ?>">
                                <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                                Beranda Saya
                              </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Keluar
                              </a>
                            </div>
                          </li>

                        </div>


                      <?php }; ?>
                    <?php }; ?>

                  </div>
                </div>
              </div>
              <!-- Mobile Menu -->
              <!-- Bottom Navbar -->
              <nav class="navbar navbar-dark bg-danger navbar-expand d-md-none d-lg-none d-xl-none fixed-bottom">
                <ul class="navbar-nav nav-justified w-100">
                  <li class="nav-item">
                    <a href="<?php echo base_url() ?>" class="nav-link"><i class='fas fa-home' style='font-size:24px'></i></a>
                  </li>
                  <li class="nav-item">
                    <a href="<?php echo base_url('job/job_listing') ?>" class="nav-link"><i class='fas fa-search' style='font-size:24px'></i></a>
                  </li>
                  <li class="nav-item">
                    <a href="<?= base_url(); ?>#about" class="nav-link"><i class='fas fa-info' style='font-size:24px'></i></a>
                  </li>
                  <?php if ($this->session->login == FALSE) { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('landing/login'); ?>" class="nav-link"><i class='fas fa-sign-in-alt' style='font-size:24px'></i></a>
                    </li>
                    <li class="nav-item">
                      <a href="<?php echo base_url('landing/register'); ?>" class="nav-link"><i class='fas fa-user-plus' style='font-size:24px'></i></a>
                    </li>
                  <?php } else { ?>
                    <li class="nav-item">
                      <a href="<?php echo base_url('dashboard') ?>" class="nav-link"><i class='fas fa-id-card' style='font-size:24px'></i></a>
                    </li>
                    <li class="nav-item">
                      <a href="#" data-toggle="modal" data-target="#logoutModal" class="nav-link"><i class='fas fa-sign-out-alt' style='font-size:24px'></i></a>
                    </li>

                  <?php }; ?>
                </ul>
              </nav>

            </div>
          </div>
        </div>
      </div>
      <!-- Header End -->
    </header>

  <?php endforeach ?>