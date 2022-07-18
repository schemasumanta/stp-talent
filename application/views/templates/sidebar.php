 <main>
  <div class="job-listing-area pt-50 pb-120">
    <div class="">
      <div class="row">
        <!-- Left content -->
        <div class="col-xl-2 col-lg-2 col-md-4">
          <div class="row">
            <div class="col-12">
             <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle align-items-center" href="#" id="userDropdown" role="button"
              data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img class="img-profile rounded-circle"
              src="<?php echo base_url().$this->session->user_foto ?>">
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
              Ganti Password
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
    <!-- Job Category Listing start -->
    <div class="job-category-listing mb-50">
      <div class="menu-wrapper">
        <!-- Main-menu -->
        <div class="main-menu">
          <nav class="d-none d-lg-block">
            <ul id="navigation">
              <li class="mb-10 "><a href="job_listing.html" class="genric-btn large danger w-100">CV</a></li>


              <li class="mb-10 "><a href="job_listing.html" class="genric-btn large danger w-100">Lamaran Saya</a></li>


              <li class="mb-10 "><a href="job_listing.html" class="genric-btn large danger w-100">Lowongan Tersimpan</a></li>
               <li class="mb-10 "><a href="job_listing.html" class="genric-btn large danger w-100">Chat</a></li>
            </ul>
          </nav>
        </div>

      </div>

    </div>
    <!-- Job Category Listing End -->
  </div>
<!-- Right content -->
     <!-- End of Topbar -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
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
            <a class="btn btn-primary" href="<?php echo base_url('seeker/logout') ?>">Logout</a>
        </div>
    </div>
</div>
</div>