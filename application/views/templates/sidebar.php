<?php $active = $this->uri->segment(1);
$sub_active = $this->uri->segment(2);
?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-danger sidebar sidebar-dark accordion" id="accordionSidebar">
    <li class="nav-item mt-3">
        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex " href="javascript:;">
            <div class="sidebar-brand-icon justify-content-center">
                <img class="img-profile rounded-circle" src="<?php echo  $this->session->user_foto ?>" style="width: 50px">
                <br>
            </div>

            <div class="sidebar-brand-text mx-3 text-left">
                <span style="font-size: 1rem"><?php echo $this->session->user_nama; ?></span>
                <br>
                <span style="font-size: 0.5rem;font-weight: normal;"><?php echo $this->session->user_level == 2 ? "Job Seeker" : "Job Provider"; ?></span>
            </div>
        </a>
    </li>

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active mt-5">
        <a class="nav-link" href="<?php echo base_url('dashboard') ?>">
            <i class="fas fa-fw fa-home"></i>
            <span>Halaman Utama</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php if ($this->session->user_level == 2) { ?>


        <!-- Nav Item - Pages Collapse Menu -->

        <li class="nav-item 

            <?php if ($active == "cv" && $sub_active == "") {
                echo "active";
            } ?> ">
            <a class="nav-link" href="<?php echo base_url('cv') ?>">
                <i class="fas fa-fw fa-receipt mr-2"></i><span>CV</span>
            </a>
        </li>
        <li class="nav-item 
        <?php if ($active == "seeker" && $sub_active == "application") {
            echo "active";
        } ?> ">
            <a class="nav-link" href="<?php echo base_url('seeker/application') ?>">
                <i class="fas fa-fw fa-calendar-check mr-2"></i><span>Lamaran Saya</span>
            </a>

        </li>

        <li class="nav-item 
    <?php if ($active == "seeker" && $sub_active == "saved_job") {
            echo "active";
        } ?> ">
            <a class="nav-link" href="<?php echo base_url('seeker/saved_job') ?>">
                <i class="fas fa-fw fa-bookmark mr-2"></i><span>Pekerjaan disimpan</span>
            </a>

        </li>

        <li class="nav-item 

<?php if ($active == "chat" && $sub_active == "") {
            echo "active";
        } ?> ">
            <a class="nav-link" href="<?php echo base_url('chat') ?>">
                <i class="fas fa-fw fa-comment mr-2"></i><span>Pesan</span>
            </a>

        </li>

        <li class="nav-item">
            <a class="nav-link " href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog mr-2"></i><span>Pengaturan</span>
            </a>
            <div id="collapseTwo" class="collapse <?php if ($active == "seeker") {
                                                        echo "show";
                                                    } ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item 
        <?php if ($active == "seeker" && $sub_active == "edit_profile") {
            echo "bg-danger text-light";
        } ?>
        " href="<?php echo base_url('seeker/edit_profile') ?>">Edit Data Diri</a>

                    <a class="collapse-item 
        <?php if ($active == "bahasa" && $sub_active == "") {
            echo "bg-danger text-light";
        } ?>
        " href="javascript:;" data-toggle="modal" data-target="#modalubahpassworduser">Ubah Kata Sandi</a>

                    <a class="collapse-item 
        <?php if ($active == "bahasa" && $sub_active == "") {
            echo "bg-danger text-light";
        } ?>
        " href="javascript:void(0)" onclick="tnc_sp()">Syarat dan Ketentuan</a>

                    <a class="collapse-item 
        <?php if ($active == "kebijakan_privasi" && $sub_active == "") {
            echo "bg-danger text-light";
        } ?>
        " href="<?= base_url('seeker/kebijakan_privasi'); ?>">Kebijakan Privasi</a>

                </div>
            </div>
        </li>

    <?php } ?>

    <?php if ($this->session->user_level == 3) { ?>


        <!-- Nav Item - Pages Collapse Menu -->

        <li class="nav-item 

    <?php if ($active == "provider" && $sub_active == "company") {
            echo "active";
        } ?> ">
            <a class="nav-link" href="<?php echo base_url('provider/company') ?>">
                <i class="fas fa-fw fa-building mr-2"></i><span>Profile Perusahaan</span>
            </a>

        </li>

        <li class="nav-item 

<?php if ($active == "provider" && $sub_active == "job_posting") {
            echo "active";
        } ?> ">
            <a class="nav-link" href="<?php echo base_url('provider/job_posting') ?>">
                <i class="fas fa-fw fa-calendar-check mr-2"></i><span>Lowongan Pekerjaan</span>
            </a>

        </li>

        <li class="nav-item 

<?php if ($active == "provider" && $sub_active == "application") {
            echo "active";
        } ?> ">
            <a class="nav-link" href="<?php echo base_url('provider/application'); ?>">
                <i class="fas fa-fw fa-users mr-2"></i><span>Pelamar Pekerjaan</span>
            </a>

        </li>

        <li class="nav-item 
<?php if ($active == "provider" && $sub_active == "premium") {
            echo "active";
        } ?> ">
            <a class="nav-link" href="<?php echo base_url('provider/premium'); ?>">
                <i class="fas fa-star mr-2"></i><span>Premium</span>
            </a>

        </li>

        <li class="nav-item 

<?php if ($active == "chat" && $sub_active == "" || $active == "chat" && $sub_active == "index") {
            echo "active";
        } ?> ">
            <a class="nav-link" href="<?php echo base_url('chat') ?>">
                <i class="fas fa-fw fa-comment mr-2"></i><span>Pesan</span>
            </a>

        </li>


        <li class="nav-item">
            <a class="nav-link " href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog mr-2"></i><span>Pengaturan</span>
            </a>

            <div id="collapseTwo" class="collapse <?php if ($active == "provider") {
                                                        echo "show";
                                                    } ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item 
        <?php if ($active == "provider" && $sub_active == "edit_profile") {
            echo "bg-danger text-light";
        } ?>
        " href="<?php echo base_url('provider/edit_profile') ?>">Edit Data Diri</a>

                    <a class="collapse-item 
        <?php if ($active == "provider" && $sub_active == "") {
            echo "bg-danger text-light";
        } ?>
        " href="javascript:;" data-toggle="modal" data-target="#modalubahpassworduser">Edit Kata Sandi</a>
                    <a class="collapse-item 
        <?php if ($active == "bahasa" && $sub_active == "") {
            echo "bg-danger text-light";
        } ?>
        " href="javascript:void(0)" onclick="tnc_sp()">Syarat dan Ketentuan</a>

                    <a class="collapse-item 
        <?php if ($active == "kebijakan_privasi" && $sub_active == "") {
            echo "bg-danger text-light";
        } ?>
        " href="<?= base_url('provider/kebijakan_privasi'); ?>">Kebijakan Privasi</a>
                </div>
            </div>
        </li>


    <?php } ?>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->

<!-- Content Wrapper -->

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
                <a class="btn btn-primary" href="<?php echo base_url('dashboard/logout') ?>">Keluar</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_tnc_sp">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Syarat dan Ketentuan Aplikasi</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div id="tnc_text_sp"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-danger" type="button" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<div id="content-wrapper" class="d-flex flex-column py-5">
    <div id="content">

        <!-- End of Topbar -->