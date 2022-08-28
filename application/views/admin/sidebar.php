<?php $active = $this->uri->segment(1);
$sub_active = $this->uri->segment(2);
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-danger sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?php echo base_url() ?>">
        <?php if ($this->session->stp_brand_icon != '') { ?>
            <div class="sidebar-brand-icon" style="filter: brightness(0) invert(1);">
                <img src="<?php echo base_url() . $this->session->stp_brand_icon ?>" style="max-height:40px">
            </div>
        <?php } else { ?>

            <div class="sidebar-brand-text mx-3"><?php echo $this->session->stp_nama != '' ? $this->session->stp_nama : 'TALENT HUB'; ?></div>
        <?php } ?>
    </a>
    <hr class="sidebar-divider my-0">
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('dashboard') ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>

    </li>
    <hr class="sidebar-divider" id="list_menu">
    <?php
    $userid = $this->session->user_id;
    $menu_user = $this->db->query("SELECT mr.* FROM tbl_admin_role as ar JOIN tbl_master_role as mr ON ar.role_id = mr.role_id WHERE ar.user_id = $userid ORDER BY role_id")->result();
    foreach ($menu_user as $key) { ?>
        <?php if ($key->role_menu == "Settings") : ?>

            <li class="nav-item">
                <a class="nav-link " href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span style="font-size: 18px;"><b>Settings</b></span>
                </a>

                <div id="collapseTwo" class="collapse <?php if ($active == "agama" || $active == "bahasa" || $active == "level"  || $active == "pendidikan" || $active == "jabatan" || $active == "skill" || $active == "job" || $active == "stp" || $active == "slider") {
                                                            echo "show";
                                                        } ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item 
                <?php if ($active == "agama" && $sub_active == "") {
                    echo "bg-danger text-light";
                } ?>
                " href="<?php echo base_url('agama') ?>">Agama</a>

                        <a class="collapse-item 
                <?php if ($active == "bahasa" && $sub_active == "") {
                    echo "bg-danger text-light";
                } ?>
                " href="<?php echo base_url('bahasa') ?>">Bahasa</a>

                        <a class="collapse-item
                <?php if ($active == "jabatan" && $sub_active == "") {
                    echo "bg-danger text-light";
                } ?>
                " href="<?php echo base_url('jabatan') ?>">Jabatan</a>
                        <a class="collapse-item
                <?php if ($active == "level" && $sub_active == "") {
                    echo "bg-danger text-light";
                } ?>

                " href="<?php echo base_url('level') ?>">Level</a>
                        <a class="collapse-item
                <?php if ($active == "pendidikan" && $sub_active == "") {
                    echo "bg-danger text-light";
                } ?>

                " href="<?php echo base_url('pendidikan') ?>">Pendidikan</a>
                        <a class="collapse-item
                <?php if ($active == "skill" && $sub_active == "") {
                    echo "bg-danger text-light";
                } ?>

                " href="<?php echo base_url('skill') ?>">Skill</a>

                        <a class="collapse-item
                <?php if ($active == "skill" && $sub_active == "skill_level") {
                    echo "bg-danger text-light";
                } ?>
                " href="<?php echo base_url('skill/skill_level') ?>">Level Skill</a>
                        <a class="collapse-item
                <?php if ($active == "job" && $sub_active == "kategori") {
                    echo "bg-danger text-light";
                } ?>
                " href="<?php echo base_url('job/kategori') ?>">Kategori Pekerjaan</a>
                        <a class="collapse-item
                <?php if ($active == "job" && $sub_active == "level") {
                    echo "bg-danger text-light";
                } ?>
                " href="<?php echo base_url('job/level') ?>">Level Pekerjaan</a>

                        <a class="collapse-item

                <?php if ($active == "stp" && $sub_active == "") {
                    echo "bg-danger text-light";
                } ?>

                " href="<?php echo base_url('stp') ?>">Profil STP</a>
                        <a class="collapse-item 

                <?php if ($active == "slider" && $sub_active == "") {
                    echo "bg-danger text-light";
                } ?>" href="<?php echo base_url('slider') ?>">Slider</a>


                    </div>
                </div>
            </li>

        <?php else : ?>


            <li class="nav-item 
        <?php if ($active == $key->role_active && $sub_active == $key->role_subactive) {
                echo "active";
            } ?> ">
                <a class="nav-link" href="<?php echo base_url() . $key->role_active . "/" . $key->role_subactive; ?>" style="font-size: 18px;"><b><?= $key->role_icon; ?>
                        <?= $key->role_menu; ?></b>
                </a>
            </li>
        <?php endif ?>

    <?php }

    ?>



    <!-- Divider -->



    <!-- Divider -->
    <hr class="sidebar-divider">


    <!-- Heading -->
    <!--    <div class="sidebar-heading">
                Seeker Panel
            </div> -->
    <!--   <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>Pengajuan Online</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="charts.html">
                    <i class="fa fa-fw fa-map-marker"></i>
                    <span>Potensi Wilayah</span></a>
            </li>
            Nav Item - Pages Collapse Menu -->
    <!-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
                    aria-expanded="true" aria-controls="collapseLaporan">
                    <i class="fas fa-fw fa-folder"></i>
                    <span>Laporan</span>
                </a>
                <div id="collapseLaporan" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="login.html">Per Marketing</a>
                        <a class="collapse-item" href="login.html">Per Cabang</a>
                        <a class="collapse-item" href="login.html">Per Periode</a>
                    </div>
                </div>
            </li>
        -->

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

            <img src="<?php echo base_url() . $this->session->stp_logo ?>" style="max-height:  40px;margin-left: 15px">

            <!-- Topbar Navbar -->
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
                        <span class="badge badge-danger badge-counter"></span>
                    </a>
                    <!-- Dropdown - Alerts -->
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown" id="list_notifikasi">
                    </div>
                </li>
                <div class="topbar-divider d-none d-sm-block"></div>
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mr-2 d-none d-lg-inline text-gray-600 medium">Hello, <?php echo $this->session->user_nama; ?></span>
                        <img class="img-profile rounded-circle" src="<?php if (strpos($this->session->user_foto, 'firebase') != false) {
                                                                            echo $this->session->user_foto;
                                                                        } else {
                                                                            echo base_url() . $this->session->user_foto;
                                                                        } ?>">
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">

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
            </ul>
        </nav>
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Sudah Selesai?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Anda yakin ingin keluar dari sistem ini?</div>
                    <div class="modal-footer">
                        <button class="btn btn-danger" type="button" data-dismiss="modal">Batal</button>
                        <a class="btn btn-primary" href="<?php echo base_url('admin/logout') ?>">Logout</a>
                    </div>
                </div>
            </div>
        </div>