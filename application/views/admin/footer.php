<!-- Footer -->
<footer class="sticky-footer bg-white">
  <div class="container my-auto">
    <div class="copyright text-center my-auto">
      <span>Copyright &copy; <?php echo  $this->session->nama_website ?> <?php echo  date('Y'); ?></span>
    </div>
  </div>
</footer>
<!-- End of Footer -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>


<!-- Bootstrap core JavaScript-->

<script src="<?php echo base_url() ?>assets_admin/vendor/jquery/jquery.min.js"></script>
<script src="<?php echo base_url() ?>assets_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url() ?>assets_admin/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url() ?>assets_admin/js/sb-admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="<?php echo base_url() ?>assets_admin/vendor/chart.js/Chart.min.js"></script>
<script src="<?php echo base_url() ?>assets_admin/js/select2.min.js"></script>

<!-- Sweet Alert -->
<script src="<?php echo base_url() ?>assets_admin/js/sweetalert2.all.js"></script>
<!-- Page level custom scripts -->
<!-- <script src="<?php echo base_url() ?>assets_admin/js/demo/chart-area-demo.js"></script> -->
<!-- <script src="<?php echo base_url() ?>assets_admin/js/demo/chart-pie-demo.js"></script> -->
<script src="<?php echo base_url(); ?>assets_admin/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets_admin/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets_admin/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>assets_admin/js/modules-datatables.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-database.js"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.cookie.js"></script>

<script>
    // Your web app's Firebase configuration
    const firebaseConfig = {
      apiKey: "AIzaSyAbDiylzDJ_ukXTyTYeq85-Usnkp85fW6o",
      authDomain: "solo-digital-tech.firebaseapp.com",
      databaseURL: "https://solo-digital-tech-default-rtdb.firebaseio.com",
      projectId: "solo-digital-tech",
      storageBucket: "solo-digital-tech.appspot.com",
      messagingSenderId: "608688468148",
      appId: "1:608688468148:web:e503938ea2f4ea0eaa27e1",
      measurementId: "G-6GFS5NPL12"
    };

    firebase.initializeApp(firebaseConfig);
    // $(document).ready(function(){
    //   $.ajax({
    //     type : "GET",
    //     url  : "<php echo base_url('admin/get_histo')?>",
    //     dataType : "JSON",
    //     success: function(result){
    //       let judul_notif = `<h6 class="dropdown-header" style="background-color: #dd2727;border-color:#dd2727">
    //       Notification
    //       </h6>`;
    //       let isi_notif ='';
    //       let show_notif ;

    //       if(result.length > 0)
    //       {
    //        show_notif =`<a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>`;
    //        $('.badge-counter').removeClass('d-none');

    //      }else{
    //        show_notif =`<a class="dropdown-item text-center small text-danger-500" href="#">Nothing Notifications</a>`;
    //        $('.badge-counter').addClass('d-none');

    //      }
    //      for (let i = 0; i < result.length; i++) {

    //       isi_notif+=`
    //       <a class="dropdown-item d-flex align-items-center" href="`+result[i].notifikasi_link+`" onclick="readnotif(`+result[i].penerima_notifikasi_id+`)" >
    //       <div class="mr-3">
    //       <div class="icon-circle" style="overflow:hidden">
    //       <img class"rounded" src="`+result[i].notifikasi_link+`" width="50px">
    //       </div>
    //       </div>
    //       <div>
    //       <div class="small text-gray-500">`+result[i].notifikasi_tanggal+`</div>
    //       <span class="font-weight-bold">`+result[i].notifikasi_isi+`</span>
    //       </div>
    //       </a>`;
    //     }
    //     let notifikasi =judul_notif+isi_notif+show_notif;
    //     $('#list_notifikasi').html(notifikasi);
    //     $('.badge-counter').html(result.length);
    //   }
    // });

    // });

    function randomkey() {
      var text = "";
      var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
      for (var i = 0; i < 16; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

      return text;
    }


  </script>

</body>

</html>