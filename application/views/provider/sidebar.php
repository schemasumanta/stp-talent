 <main>
  <div class="job-listing-area pt-50 pb-120">
    <div class="">
      <div class="row">
        <!-- Left content -->
        <div class="col-xl-2 col-lg-2 col-md-4">
          
    <!-- Job Category Listing start -->
    <div class="job-category-listing mb-50">
      <div class="menu-wrapper">
        <!-- Main-menu -->
        <div class="main-menu">
          <nav class="d-none d-lg-block">
            <ul id="navigation">
              <?php $active = $this->uri->segment(1);  $sub_active = $this->uri->segment(2); ?>

              <li class="mb-10 "><a href="<?php echo base_url('provider/job_posting') ?>" class="genric-btn large 
                 <?php if($active=="provider" && $sub_active=="job_posting"){
                echo "primary"; }else{ echo "danger"; } ?>
               w-100">Job Posting</a></li>
              <li class="mb-10 "><a href="<?php echo base_url('provider/pelamar') ?>" class="genric-btn large 
                 <?php if($active=="provider" && $sub_active=="pelamar"){
                echo "primary"; }else{ echo "danger"; } ?>
                w-100">Data Pelamar</a></li>

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
            <a class="btn btn-primary" href="<?php echo base_url('provider/logout') ?>">Logout</a>
        </div>
    </div>
</div>
</div>