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

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use -->
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-storage.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-database.js"></script>

<script src="<?php echo base_url() ?>assets/js/jquery.cookie.js"></script>


<script src="<?= base_url(); ?>assets/js/owl-carousel.js"></script>
<script>
	$(document).ready(function() {
		$(".owl-carousel").owlCarousel({
			loop: false,
			margin: 10,
			responsiveClass: true,
			nav: true,
			navText: ["<div class='nav-btn prev-slide'><img src='<?= base_url('assets/img/icon/arrow-left.png'); ?>' height='30'></div>", "<div class='nav-btn next-slide'><img src='<?= base_url('assets/img/icon/arrow-right.png'); ?>' height='30'></div>"],
			responsive: {
				0: {
					items: 1,
					nav: true,
					loop: true
				},
				600: {
					items: 3,
					nav: false,
					loop: true,
				},
				1000: {
					items: 5,
					nav: true,
					loop: false,
				}
			}
		});
	});

	function show_password_user(id) {
		if ($('#' + id).attr('type') == "password") {
			$('#' + id).attr('type', 'text');
			$('.' + id).html('<i class="fa fa-eye-slash"></i>');
		} else {
			$('#' + id).attr('type', 'password');
			$('.' + id).html('<i class="fa fa-eye"></i>');

		}
	}


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




	$('#btn_ubah_password_user').on('click', function() {
		let cek = 0;

		let password = $('#password_baru_user').val();
		let confirm = $('#confirm_password_baru_user').val();
		if (password == "") {
			cek++;
			$('#password_baru_user').focus();
			$('.error-password_baru_user').html('Silahkan Masukkan Password Baru');
		} else {
			$('.error-password_baru_user').html('');
		}
		if (password !== confirm) {
			cek++;
			$('#confirm_password_baru_user').focus();
			$('#confirm_password_baru_user').val();
			$('.error-confirm_password_baru_user').html('Konfirmasi Password Tidak Valid');
		} else {
			$('.error-confirm_password_baru_user').html('');
		}
		if (cek > 0) {
			return false;
		} else {
			$('#form_ubah_password_user').submit();

		}

	});

	// $(document).ready(function(){
	// 	$.ajax({
	// 		type : "GET",
	// 		url  : "<php echo base_url('notifikasi/get_notifikasi')?>",
	// 		dataType : "JSON",
	// 		success: function(result){
	// 			let judul_notif = `<h6 class="dropdown-header" style="background-color: #dd2727;border-color:#dd2727">
	// 			Notification
	// 			</h6>`;
	// 			let isi_notif ='';
	// 			let show_notif ;


	// 			for (let i = 0; i < result.length; i++) {

	// 				isi_notif+=`
	// 				<a class="dropdown-item d-flex align-items-center" href="`+result[i].notifikasi_link+`" onclick="readnotif(`+result[i].penerima_notifikasi_id+`)" >
	// 				<div class="mr-3">
	// 				<div class="icon-circle" style="overflow:hidden">
	// 				<img class"rounded" src="<?php echo base_url() ?>`+result[i].user_foto+`" width="50px">
	// 				</div>
	// 				</div>
	// 				<div>
	// 				<div class="small text-gray-500">`+result[i].notifikasi_tanggal+`</div>
	// 				<span class="font-weight-bold">`+result[i].notifikasi_isi+`</span>
	// 				</div>
	// 				</a>`;
	// 			}
	// 			let notifikasi =judul_notif+isi_notif+show_notif;
	// 			$('#list_notifikasi_user').html(notifikasi);
	// 		}
	// 	});

	// });

	function randomkey() {
		var text = "";
		var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
		for (var i = 0; i < 16; i++)
			text += possible.charAt(Math.floor(Math.random() * possible.length));

		return text;
	}

	

	$(document).ready(function(){



		let notifRef = firebase.database().ref('/UserNotification/').orderByChild('notifikasi_penerima').equalTo('<?php echo $this->session->user_id; ?>'); 

		notifRef.on('value', function(snapshot) { 

			let judul_notif = `<h6 class="dropdown-header" style="background-color: #dd2727;border-color:#dd2727">
			Notification
			</h6>`;
			let isi_notif ='';
			let show_notif ;
			let counter =0;
			if(snapshot.numChildren()> 0){
				show_notif =`<a class="dropdown-item text-center small text-gray-500" href="<?php echo base_url('notifikasi') ?>">Show All Notifications</a>`;
				let level = '<?php echo $this->session->user_level ?>';

				snapshot.forEach((isi) => {
					let key = isi['ref']['path']['pieces_'][1];
					let data = isi.val();  
					if (data.notifikasi_read_status==0) {
						counter++;
						isi_notif+=`
						<a class="dropdown-item item_notifikasi" href="javaScript:;" data-link="`+data.notifikasi_link+`" data-key="`+key+`">
						<div clas="col-md-12 mb-1">
						<b>`+data.notifikasi_judul+`</b>
						</div>
						<div clas="col-md-12">
						<div class="small text-gray-500 mb-2">`+data.notifikasi_tanggal+`</div>
						`+data.notifikasi_isi+`
						</div>
						</a>`;
					}

				});

				$('.badge-counter-user').html(counter);
				
			}else{
				show_notif =`<a class="dropdown-item text-center small text-danger-500" href="#">Nothing Notifications</a>`;
				$('.badge-counter-user').html('');

			}

			let notifikasi =judul_notif+isi_notif+show_notif;
			$('#list_notifikasi_user').html(notifikasi);


		}); 

		
		$(document).on('click','.item_notifikasi',function(){
			let link = $(this).data('link');
			let key =   $(this).data('key');
			firebase.database().ref('/UserNotification/'+key+'/notifikasi_read_status/').set('1',(error)=> {
				if (error) {
					return false;
				} else {
					if (link!='') {
						window.location.href=link;
					}else{
						window.location.href='<?php echo  base_url(); ?>';

					}
				}
			})


		});

	});


</script>

</body>

</html>