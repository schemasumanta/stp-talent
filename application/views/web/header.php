<!DOCTYPE html>
<?php foreach ($stp as $s): ?>

  <html class="no-js" lang="zxx">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Talent Hub</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- <link rel="manifest" href="site.webmanifest" /> -->
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

      .popover-header{
        font-weight: bold!important;
        padding: 15px!important;
        background: #3f00ff!important;
        color: white!important;
        text-align: center;!important;
      }
      .popover-body{
        text-align: center!important;
      }
      .popover{
        padding: 15px!important;
      }

      .note-btn{
        color: #dc3545 !important
        background: transparent!important;
        height: 25px!important;
      }

      

      html,
      body{
        height: 100%;
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
              <img src="<?php echo base_url().$s->stp_brand_icon ?>" alt="" />
            </div>
          </div>
        </div>
      </div>
    <?php  } ?>
    <header>
      <div class="header-area header-transparrent">
        <div class="headder-top header-sticky">
          <div class="container">
            <div class="row align-items-center">
              <div class="col-lg-2 col-md-2">
                <!-- Logo -->
                <div class="logo">
                  <a href="<?php echo base_url() ?>"
                    ><img src="<?php echo base_url().$s->stp_brand_icon ?>"  style="max-height: 300px" alt=""
                    /></a>
                  </div>
                </div>
                <div class="col-lg-10 col-md-10">
                  <div class="menu-wrapper">
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
                        <div class="nav">
                          <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle align-items-center" href="#" id="userDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="img-profile rounded-circle"
                            src="<?php echo base_url().$this->session->user_foto ?>" style="width: 50px">
                            <span class="ml-2 text-danger"><?php echo $this->session->user_nama; ?><i class="fa fa-chevron-down ml-5" aria-hidden="true"></i></span>
                          </a>
                          <div class="dropdown-menu text-danger dropdown-menu-right shadow animated--grow-in"
                          aria-labelledby="userDropdown">
                          <a class="dropdown-item" href="<?php echo base_url('dashboard') ?>">
                            <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                            My Dashboard
                          </a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                            Logout
                          </a>
                        </div>
                      </li>

                    </div>
                  <?php endif ?>
                  <?php if ($this->session->user_level==3): ?>
                    <div class="nav">
                  <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle align-items-center" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="img-profile rounded-circle"
                    src="<?php echo base_url().$this->session->user_foto ?>" style="width: 50px">
                    <span class="ml-2 text-danger"><?php echo $this->session->user_nama; ?><i class="fa fa-chevron-down ml-5" aria-hidden="true"></i></span>
                  </a>
                  <div class="dropdown-menu text-danger dropdown-menu-right shadow animated--grow-in"
                  aria-labelledby="userDropdown">
                  <a class="dropdown-item" href="<?php echo base_url('dashboard') ?>">
                    <i class="fas fa-home fa-sm fa-fw mr-2 text-gray-400"></i>
                    My Dashboard
                  </a>
                 <!--  <a class="dropdown-item item_ubah_perusahaan" href="#">
                    <i class="fas fa-building fa-sm fa-fw mr-2 text-gray-400"></i>
                    Ubah Profile Perusahaan
                  </a> -->
                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                  </a>
                </div>
              </li>

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
