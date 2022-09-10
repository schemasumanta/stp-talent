<!-- JS here -->

<!-- All JS Custom Plugins Link Here here -->

<style type="text/css">
  #lampiran_logo_perusahaan {
    opacity: 0 !important;
    padding: 0 !important;
    width: 100% !important;

  }

  .imagecheck-figure>img {
    width: 100% !important;
  }
</style>
<style type="text/css">
  .main-chat {
    position: fixed;
    bottom: 50px;
    right: 10px;
    margin-bottom: 30px;
    margin-right: 30px;
    cursor: pointer;
  }
</style>
<?php if ($this->session->login) { ?>
  <?php if ($this->session->user_level != 1) : ?>
    <a href="<?php echo base_url() ?>chat/index/<?php echo md5('admin') ?>"><img class="main-chat" src="<?php echo base_url() ?>assets/img/chatbubble.png" onclick="openchat()" style="cursor: pointer;height: 70px!important;width: 70px!important"></a>

  <?php endif ?>

<?php } else { ?>
  <a href="<?php echo base_url('landing/login') ?>"><img class="main-chat" src="<?php echo base_url() ?>assets/img/chatbubble.png" style="cursor: pointer;height: 70px!important;width: 70px!important"></a>
<?php } ?>


<script src="<?php echo base_url() ?>assets/js/vendor/modernizr-3.5.0.min.js"></script>
<!-- Jquery, Popper, Bootstrap -->
<script src="<?php echo base_url() ?>assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/popper.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/bootstrap.min.js"></script>
<!-- Jquery Mobile Menu -->
<script src="<?php echo base_url() ?>assets/js/jquery.slicknav.min.js"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="<?php echo base_url() ?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/slick.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/price_rangs.js"></script>

<!-- One Page, Animated-HeadLin -->
<script src="<?php echo base_url() ?>assets/js/wow.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/animated.headline.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.magnific-popup.js"></script>

<!-- Scrollup, nice-select, sticky -->
<!-- <script src="<?php echo base_url() ?>assets/js/jquery.scrollUp.min.js"></script> -->
<script src="<?php echo base_url() ?>assets/js/jquery.nice-select.min.js"></script>

<script type="text/javascript">
  $('#search_lokasi_pekerjaan').niceSelect();
</script>

<script src="<?php echo base_url() ?>assets/js/jquery.sticky.js"></script>

<!-- contact js -->
<script src="<?php echo base_url() ?>assets/js/contact.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.form.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url() ?>assets/js/mail-script.js"></script>
<script src="<?php echo base_url() ?>assets/js/jquery.ajaxchimp.min.js"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="<?php echo base_url() ?>assets/js/plugins.js"></script>
<script src="<?php echo base_url() ?>assets/js/main.js"></script>


<!-- Core plugin JavaScript-->
<script src="<?php echo base_url() ?>assets_admin/vendor/jquery-easing/jquery.easing.min.js"></script>
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
<script src="<?php echo base_url() ?>assets/js/jquery.cookie.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-app.js"></script>

<!-- TODO: Add SDKs for Firebase products that you want to use -->
<script src="https://www.gstatic.com/firebasejs/7.13.1/firebase-storage.js"></script>
<script type="text/javascript">
  $('#id_kota_cari').select2();

  function open_chat() {
    let login = '<?php echo $this->session->login; ?>';
    alert(login);

  }
  $(document).on('change', '#perusahaan_prov_edit', function() {

    let prov_id = $(this).val();
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('job/get_kabkota') ?>",
      dataType: "JSON",
      data: {
        'prov_id': prov_id
      },
      success: function(data) {

        let kab = '<option value ="0" selected disabled>Pilih Kabupaten / Kota</option>';
        for (var i = 0; i < data.length; i++) {
          kab += '<option value="' + data[i].kabkota_id + '">' + data[i].kabkota_nama + '</option>';
        }
        $('#perusahaan_kabkota_edit').html(kab);

        $('#perusahaan_kabkota_edit').select2({
          allowClear: true,
          placeholder: "Pilih Kabupaten / Kota",
          dropdownParent: $('#modalprofilperusahaan'),
        });

      }
    });
  });

  function previewFile(id) {
    let file = $('#' + id)[0].files[0];
    let reader = new FileReader();
    reader.addEventListener("load", function() {
      $('#preview_' + id).attr('src', reader.result);
    }, false);
    if (file) {
      reader.readAsDataURL(file);
    }
  }

  $(document).on('click', '.item_ubah_perusahaan', function() {
    let perusahaan_id = '<?php echo $this->session->perusahaan_id ?>';
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('job/get_perusahaan') ?>",
      dataType: "JSON",
      data: {
        'perusahaan_id': perusahaan_id
      },
      success: function(data) {
        $('#modalprofilperusahaan').modal('show');
        $('#perusahaan_nama_edit').val(data.perusahaan[0].perusahaan_nama);

        $('#perusahaan_email_edit').val(data.perusahaan[0].perusahaan_email);
        $('#perusahaan_telepon_edit').val(data.perusahaan[0].perusahaan_telepon);
        $('#perusahaan_jml_karyawan_edit').val(data.perusahaan[0].perusahaan_jml_karyawan);
        $('#perusahaan_website_edit').val(data.perusahaan[0].perusahaan_website);

        $('#perusahaan_alamat_edit').val(data.perusahaan[0].perusahaan_alamat);
        $('#lampiran_logo_perusahaan_lama').val(data.perusahaan[0].perusahaan_logo);

        let prov = '<option value ="0" selected disabled>Pilih Provinsi</option>';
        for (var i = 0; i < data.provinsi.length; i++) {
          if (data.perusahaan[0].perusahaan_prov == data.provinsi[i].prov_id) {
            prov += '<option value="' + data.provinsi[i].prov_id + '" selected>' + data.provinsi[i].prov_nama + '</option>';
          } else {
            prov += '<option value="' + data.provinsi[i].prov_id + '">' + data.provinsi[i].prov_nama + '</option>';
          }
        }

        $('#perusahaan_prov_edit').html(prov);
        $('#perusahaan_prov_edit').select2({
          allowClear: true,
          placeholder: "Pilih Provinsi",
          dropdownParent: $('#modalprofilperusahaan'),
        });


        let kab = '<option value ="0" selected disabled>Pilih Kabupaten / Kota</option>';
        for (var i = 0; i < data.kabkota.length; i++) {
          if (data.kabkota[i].prov_id == data.perusahaan[0].perusahaan_prov) {
            if (data.kabkota[i].kabkota_id == data.perusahaan[0].perusahaan_kabkota) {
              kab += '<option value="' + data.kabkota[i].kabkota_id + '" selected>' + data.kabkota[i].kabkota_nama + '</option>';
            } else {
              kab += '<option value="' + data.kabkota[i].kabkota_id + '">' + data.kabkota[i].kabkota_nama + '</option>';

            }

          }
        }
        $('#perusahaan_kabkota_edit').html(kab);

        $('#perusahaan_kabkota_edit').select2({
          allowClear: true,
          placeholder: "Pilih Kabupaten / Kota",
          dropdownParent: $('#modalprofilperusahaan'),
        });

        if (data.perusahaan[0].perusahaan_logo != '' && data.perusahaan[0].perusahaan_logo != null) {
          $('#preview_lampiran_logo_perusahaan').attr('src', data.perusahaan[0].perusahaan_logo);
        }
      }
    });
  });

  $(document).on('click', '#btn_update_profil_perusahaan', function() {

    let cek = 0;

    let perusahaan_nama = $('#perusahaan_nama_edit').val();
    if (perusahaan_nama == '') {
      cek++;
      $('.error-perusahaan_nama_edit').html('Nama Perusahaan Tidak Boleh Kosong');
    } else {
      $('.error-perusahaan_nama_edit').html('');
    }

    let perusahaan_prov = $('#perusahaan_prov_edit').val();
    if (perusahaan_prov == null) {
      cek++;
      $('.error-perusahaan_prov_edit').html('Silahkan Pilih Provinsi');
    } else {
      $('.error-perusahaan_prov_edit').html('');
    }

    let perusahaan_kabkota = $('#perusahaan_kabkota_edit').val();
    if (perusahaan_kabkota == null) {
      cek++;
      $('.error-perusahaan_kabkota_edit').html('Silahkan Pilih Kabupaten Kota');
    } else {
      $('.error-perusahaan_kabkota_edit').html('');
    }

    let perusahaan_email = $('#perusahaan_email_edit').val();
    if (perusahaan_email != '') {

      let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

      if (!testEmail.test(perusahaan_email)) {
        cek++;
        $('.error-perusahaan_email_edit').html('Format Email Tidak Valid');

      } else {
        $('.error-perusahaan_email_edit').html('');

      }
    } else {
      $('.error-perusahaan_email_edit').html('');
    }

    let perusahaan_alamat = $('#perusahaan_alamat_edit').val();
    if (perusahaan_alamat == '') {
      cek++;
      $('.error-perusahaan_alamat_edit').html('Alamat Perusahaan Tidak Boleh Kosong');
    } else {
      $('.error-perusahaan_alamat_edit').html('');
    }

    let lampiran_logo_perusahaan_lama = $('#lampiran_logo_perusahaan_lama').val();


    let lampiran_logo_perusahaan = $('#lampiran_logo_perusahaan').val();
    if (lampiran_logo_perusahaan == '' && lampiran_logo_perusahaan_lama == '') {
      cek++;
      $('.error-lampiran_logo_perusahaan').html('Silahkan Upload Logo Perusahaan');
    } else {


      $('.error-lampiran_logo_perusahaan').html('');
    }

    if (cek > 0) {
      return false;
    } else {

      if (file_logo.length > 0) {

        for (let i = 0; i < file_logo.length; i++) {
          var storage = firebase.storage().ref('talent_hub/provider/perusahaan/' + Date.now() + file_logo[i].name);
          var upload = storage.put(file_logo[i]);
          upload.on(
            "state_changed",
            function progress(snapshot) {},

            function error() {
              $('.error-file-cv').html("Upload File Error");
            },
            function complete() {
              storage
                .getDownloadURL()
                .then(function(url) {
                  $('#lampiran_logo_perusahaan_lama').val(url);
                  $('#btn_update_profil_perusahaan').attr('disabled', 'disabled');
                  $('#btn_update_profil_perusahaan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif" style="height:25px;width:25px;">');
                  $('#form_perusahaan').submit();
                })
                .catch(function(error) {
                  console.log("error encountered");
                });
            },
          );


        }

      } else {
        $('#btn_update_profil_perusahaan').attr('disabled', 'disabled');
        $('#btn_update_profil_perusahaan').html('<img src="<?php echo base_url() ?>assets/img/spinner.gif" style="height:25px;width:25px;">');
        $('#form_perusahaan').submit();
      }
    }
  });
</script>
<script>
  // Your web app's Firebase configuration
  const firebaseConfig = {
    apiKey: "AIzaSyAbDiylzDJ_ukXTyTYeq85-Usnkp85fW6o",
    authDomain: "solo-digital-tech.firebaseapp.com",
    projectId: "solo-digital-tech",
    storageBucket: "solo-digital-tech.appspot.com",
    messagingSenderId: "608688468148",
    appId: "1:608688468148:web:e503938ea2f4ea0eaa27e1",
    measurementId: "G-6GFS5NPL12"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
</script>



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


<!-- modal profil perusahaan -->

<div class="modal fade" data-backdrop="static" id="modalprofilperusahaan" tabindex="-1" role="dialog" aria-labelledby="modalprofilperusahaanLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="form_perusahaan" method="post" enctype="multipart/form-data" action="<?php echo base_url('provider/ubah_perusahaan') ?>">
        <div class="modal-header bg-danger text-light" style="color: #ffff">
          <h3 class="modal-title" id="label_header_stp" style="color: #ffffff!important"> <i class="fas fa-building mr-2"></i>PROFILE PERUSAHAAN</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
        </div>
        <div class="modal-body">
          <div class="row ">
            <div class="col-md-12 mb-3">
              <label style="color:#343a40;" for="perusahaan_nama_edit">Nama Perusahaan</label>
              <input type="hidden" name="perusahaan_id_edit" id="perusahaan_id_edit">
              <input type="text" class="form-control" id="perusahaan_nama_edit" name="perusahaan_nama_edit" required>
              <small class="mt-1 error-perusahaan_nama_edit text-danger"></small>
            </div>
            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="perusahaan_prov_edit">Provinsi</label>
              <select class="form-control" id="perusahaan_prov_edit" name="perusahaan_prov_edit" style="width: 100%!important">
              </select>
              <small class="mt-1 error-perusahaan_prov_edit text-danger"></small>

            </div>
            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="perusahaan_kabkota_edit">Kabupaten / Kota</label>
              <select class="form-control" id="perusahaan_kabkota_edit" name="perusahaan_kabkota_edit" style="width: 100%!important">
              </select>
              <small class="mt-1 error-perusahaan_kabkota_edit text-danger"></small>
            </div>

            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="perusahaan_telepon_edit">Telepon</label>
              <input type="text" class="form-control" id="perusahaan_telepon_edit" name="perusahaan_telepon_edit">
            </div>

            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="perusahaan_email_edit">Email</label>
              <input type="text" class="form-control" id="perusahaan_email_edit" name="perusahaan_email_edit">
              <small class="mt-1 error-perusahaan_email_edit text-danger"></small>

            </div>


            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="perusahaan_website_edit">Website</label>
              <input type="text" class="form-control" id="perusahaan_website_edit" name="perusahaan_website_edit">
            </div>


            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="perusahaan_jml_karyawan_edit">Jumlah Karyawan</label>
              <input type="number" class="form-control" id="perusahaan_jml_karyawan_edit" name="perusahaan_jml_karyawan_edit">
            </div>

            <div class="col-md-12 mb-3">
              <label style="color:#343a40;" for="perusahaan_sambutan_edit">Tentang Perusahaan</label>
              <textarea class="form-control" id="perusahaan_sambutan_edit" name="perusahaan_sambutan_edit" rows="6"></textarea>
              <small class="mt-1 error-perusahaan_sambutan_edit text-danger"></small>
            </div>
            <div class="col-md-6 mb-3">
              <label style="color:#343a40;" for="perusahaan_alamat_edit">Alamat</label>
              <textarea class="form-control" id="perusahaan_alamat_edit" name="perusahaan_alamat_edit" rows="6"></textarea>
              <small class="mt-1 error-perusahaan_alamat_edit text-danger"></small>
            </div>
            <div class="col-md-6 mb-3">
              <div class="row">
                <div class="col-md-6">
                  <label class="imagecheck">Logo Perusahaan
                    <input type="hidden" name="lampiran_logo_perusahaan_lama" id="lampiran_logo_perusahaan_lama">
                    <input type="file" accept="image/x-png,image/gif,image/jpeg" class="form-control" name="lampiran_logo_perusahaan" id="lampiran_logo_perusahaan" onchange="previewFile(this.id)">
                    <figure class="imagecheck-figure">
                      <img src="<?php echo base_url('assets/img/img03.jpg'); ?>" class="imagecheck-image" id="preview_lampiran_logo_perusahaan">
                    </figure>
                  </label>
                </div>
                <div class="col-md-12">
                  <small class="mt-1 error-lampiran_logo_perusahaan text-danger"></small>

                </div>
              </div>

            </div>

          </div>
        </div>
        <div class="modal-footer">
          <div class="form-group row" class="collapse" id="customer_collapse">
            <div class="col-sm-6">
              <button type="button" class="genric-btn2 large danger" data-dismiss="modal">TUTUP</button>
            </div>
            <div class="col-sm-6 float-sm-right">
              <button type="button" class="genric-btn large primary" id="btn_update_profil_perusahaan">UPDATE</button>

            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</body>

</html>
<script type="text/javascript">
  var file_logo = [];
  document.getElementById("lampiran_logo_perusahaan").addEventListener("change", function(e) {
    file_logo = e.target.files;
    console.log(file_logo);
  });
</script>
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
  }
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>