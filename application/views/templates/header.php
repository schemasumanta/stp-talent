<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>STP Talent Hub</title>

    <!-- Custom fonts for this template-->
    <link href="<?php echo base_url() ?>assets_admin/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">


    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_admin/modules/datatables/datatables.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_admin/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets_admin/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">

    <link rel="stylesheet" href="<?php echo base_url() ?>assets_admin/css/select2.min.css">
    <script src="<?php echo base_url() ?>assets_admin/js/jquery.min.js"></script>
    <!-- Custom styles for this template-->
    <link href="<?php echo base_url() ?>assets_admin/css/sb-admin-2-user.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url()?>assets/css/owl.css">
    <style type="text/css">
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
             !important;
        }

        .popover-body {
            text-align: center !important;
        }

        .popover {
            padding: 15px !important;
        }
    </style>

    <script type="text/javascript">
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

    <div class="modal fade" data-backdrop="static" id="modalubahpassworduser" tabindex="-1" role="dialog" aria-labelledby="modalubahpassworduserLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header bg-danger text-light">
                    <h5 id="modalubahpassworduserLabel">UBAH PASSWORD</h5>
                </div>
                <div class="modal-body">
                    <form method="post" id="form_ubah_password_user" action="<?php echo base_url('dashboard/ubah_password') ?>">
                        <div class="form-group row" class="collapse" id="customer_collapse">

                            <div class="col-md-12 mb-3">
                                <label for="pwd1">Password Baru</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password_baru_user" name="password_baru_user" placeholder="Masukkan Password" required>
                                    <div class="input-group-addon password_baru_user mr-2 ml-2 pt-2" style="cursor: pointer;" onclick="show_password_user('password_baru_user')"><i class="fa fa-eye"></i></div>
                                </div>
                                <small class="mt-1 error-password_baru_user text-danger"></small>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label for="pwd1">Ulangi Password</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="confirm_password_baru_user" name="confirm_password_baru_user" placeholder="Ulangi Password" required>
                                    <div class="input-group-addon confirm_password_baru_user mr-2 ml-2 pt-2" style="cursor: pointer;" onclick="show_password_user('confirm_password_baru_user')"><i class="fa fa-eye"></i></div>

                                </div>
                                <small class="mt-1 error-confirm_password_baru_user text-danger"></small>

                            </div>
                        </div>
                    </form>
                    <div class="modal-footer">
                        <div class="form-group row" class="collapse" id="customer_collapse">
                            <div class="col-sm-12 btn-group">
                                <button type="button" class="btn btn-danger mr-2" data-dismiss="modal"><b>BATAL</b></button>

                                <button type="button" class="btn btn-success" id="btn_ubah_password_user"><b>UBAH</b></button>

                            </div>

                        </div>



                    </div>




                </div>
            </div>
        </div>


        <!-- /.card-body -->
    </div>


</head>

<body id="page-top">

    <!-- Topbar -->
    <nav class="navbar navbar-expand navbar-light bg-white topbar">

        <!-- Sidebar Toggle (Topbar) -->
        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
        </button>
        <a href="<?php echo base_url() ?>">
            <img src="<?php echo base_url() . $this->session->stp_brand_icon ?>" style="max-height:  40px;margin-left: 5rem"></a>
        <!-- Topbar Navbar -->
        <ul class="navbar-nav ml-md-5" style="width: 100%">
            <form class="d-none d-sm-inline-block form-inline mr-auto  my-2 my-md-0 navbar-search" style="width: 85%;margin-left: 3rem">
                <div class="input-group ">
                    <div class="input-group-prepend">
                        <button class="btn btn-danger" type="button">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search " aria-label="Search" aria-describedby="basic-addon2">

                </div>
            </form>
        </ul>
        <ul class="navbar-nav ml-auto">
            <!-- Nav Item - Search Dropdown (Visible Only XS) -->
            <li class="nav-item dropdown no-arrow d-sm-none">
                <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-search fa-fw"></i>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                    <form class="form-inline mr-auto w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </li>

            <!-- Nav Item - Alerts -->
            <li class="nav-item dropdown no-arrow mx-1">
                <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-bell fa-fw"></i>
                    <!-- Counter - Alerts -->
                    <span class="badge badge-danger badge-counter-user"></span>
                </a>
                <!-- Dropdown - Alerts -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" id="list_notifikasi_user">

                </div>
            </li>



            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->nama; ?></span>
                    <img class="img-profile rounded-circle" src="<?php echo $this->session->user_foto ?>">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                    <?php
                    if ($this->session->user_level == 2) { ?>
                        <a class="dropdown-item" href="<?= base_url('cv'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            View Profile
                        </a>
                    <?php } elseif ($this->session->user_level == 3) { ?>
                        <a class="dropdown-item" href="<?= base_url('provider/company'); ?>">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            View Profile
                        </a>
                    <?php }; ?>

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Logout
                    </a>
                </div>
            </li>

        </ul>

    </nav>
    <!-- Page Wrapper -->
    <div id="wrapper">