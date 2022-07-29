<!-- Footer -->
</div>

<!-- <footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; <?php echo  $this->session->nama_website ?> <?php echo  date('Y'); ?></span>
        </div>
    </div>
</footer> -->
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

<!-- TODO: Add SDKs for Firebase products that you want to use -->
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-database.js"></script>

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
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
</script>

</body>

</html>