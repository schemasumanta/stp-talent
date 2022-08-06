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
                     <?php $active = $this->uri->segment(1);
                      $sub_active = $this->uri->segment(2); ?>

                     <li class="mb-10 "><a href="<?php echo base_url('cv') ?>" class="genric-btn large 
                <?php if ($active == "cv" && $sub_active == "") {
                  echo "primary";
                } else {
                  echo "danger";
                } ?>
                 w-100">CV</a></li>

                     <li class="mb-10 "><a href="<?php echo base_url('seeker/lamaran_saya') ?>" class="genric-btn large 
                 <?php if ($active == "seeker" && $sub_active == "lamaran_saya") {
                    echo "primary";
                  } else {
                    echo "danger";
                  } ?>

               w-100">Lamaran Saya</a></li>


                     <li class="mb-10 "><a href="<?php echo base_url('seeker/lowongan_tersimpan') ?>" class="genric-btn large 

                 <?php if ($active == "seeker" && $sub_active == "lowongan_tersimpan") {
                    echo "primary";
                  } else {
                    echo "danger";
                  } ?>
                w-100">Lowongan Tersimpan</a></li>
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
                 <a class="btn btn-primary" href="<?php echo base_url('seeker/logout') ?>">Logout</a>
               </div>
             </div>
           </div>
         </div>