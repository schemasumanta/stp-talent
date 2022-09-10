    <style>
      @media (min-width: 992px) {
        .modal-lg {
          width: 900px;
        }
      }

      .image-upload>input {
        display: none;
      }
    </style>
    <main>
      <!-- Hero Area Start-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

      <div class="slider-area">
        <div class="single-slider section-overly2 slider-height2 d-flex align-items-center" data-background="<?php echo base_url() ?>assets/img/hero/about.jpg">
          <div class="container flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
            <form method="post" action="<?php echo base_url('seeker/simpan_pendaftaran') ?>" id="form-daftar" enctype="multipart/form-data">
              <div class="row mt-5 mb-5 p-0 w-100 justify-content-center ">

                <div class="col-lg-5 p-5" style="border-radius: 15px;background: rgba(22,22,26,0.7);">
                  <div class="hero-cap align-items-center mb-3 text-center">
                    <a href="javascript:;" class="genric-btn danger medium btn-kandidat btn-pilihan" style="border-top-left-radius: 15px;border-bottom-left-radius: 15px;border-top-right-radius: 0px;border-bottom-right-radius: 0px">Job Seeker</a>
                    <a href="javascript:;" class="genric-btn danger medium btn-provider btn-pilihan">Job Provider</a>
                  </div>
                  <div class="hero-cap text-center">
                    <h3 class="user_role text-white">Register</h3>
                    <!-- <p class="text-light taglinetalent"> -->
                    </p>
                  </div>
                  <div class="row justify-content-center mt-4">
                    <div class="col-lg-12">
                      <input type="text" class="form-control w-100" name="seeker_nama" id="seeker_nama" placeholder="Full name" autofocus>
                      <input type="hidden" class="form-control w-100" name="seeker_level" id="seeker_level" value="2">
                    </div>
                    <div class="col-lg-12 mt-4">
                      <input type="text" class="form-control w-100" name="seeker_telepon" id="seeker_telepon" placeholder="Your Phone Number" autofocus>
                    </div>
                    <div class="col-lg-12 mt-4 perusahaan d-none">
                      <input type="text" class="form-control w-100" name="perusahaan_nama" id="perusahaan_nama" placeholder="Company name according to NPWP" autofocus>
                    </div>
                    <div class="col-lg-12 mt-4 perusahaan d-none">
                      <label class="text-white">Upload File NPWP</label>
                      <div class="image-upload">
                        <label for="file_npwp">
                          <img src="<?= base_url('assets/img/icon/file-upload.png'); ?>" />
                        </label>

                        <input id="file_npwp" type="file" name="file_npwp" accept="application/pdf" />
                      </div>
                      <label id="nama_file_npwp" class="text-white"></label><br />
                      <small class="text-white">*Format PDF Max 2MB</small>
                    </div>
                    <div class="col-lg-12 mt-4 perusahaan d-none">
                      <label class="text-white">Upload File NIB</label>
                      <div class="image-upload">
                        <label for="file_nib">
                          <img src="<?= base_url('assets/img/icon/file-upload.png'); ?>" />
                        </label>

                        <input id="file_nib" type="file" name="file_nib" accept="application/pdf" />
                      </div>
                      <label id="nama_file_nib" class="text-white"></label><br />
                      <small class="text-white">*Format PDF Max 2MB</small>
                    </div>
                    <div class="col-lg-12 mt-4 perusahaan d-none">
                      <input type="text" class="form-control w-100" name="perusahaan_website" id="perusahaan_website" placeholder="Company Website" autofocus>
                    </div>
                    <div class="col-lg-12 mt-4">
                      <input type="text" class="form-control w-100" name="seeker_email" id="seeker_email" placeholder="Your Email" autofocus>
                    </div>
                    <div class="col-lg-12 mt-4">
                      <input type="password" class="form-control w-100" name="seeker_password" id="seeker_password" placeholder="Your Password Min 6 Digit">
                      <a href="javascript:;" onclick="show_password()" id="text_pw" class="text-light">Show Password</a>
                      <br />
                      <small class="text-white">*Password Uses a Combination of Upper and Lowercase Letters and Numbers.</small>

                    </div>
                    <div class="col-lg-12 mt-4">

                      <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="check_persetujuan" value="1">
                        <input type="hidden" value="1" id="sebagai">
                        <label class="form-check-label text-white" for="check_persetujuan">Agree to <a href="javascript:void(0)" class="text-danger" onclick="tnc()">the terms and conditions of the application.</a></label>
                        <br />
                      </div>

                    </div>
                    <div class="col-lg-12 mt-4 items-link btn-group">
                      <a href="<?php echo base_url() ?>" style="width: 50%;margin-right:15px;display: inline-block!important;background: transparent;color: white;border:1px solid white">Cancel</a>
                      <a href="javascript:;" class="item_daftar" style="width: 50%;display: inline-block!important;background:#DD2727;color: white;border: 1px solid #DD2727">Register</a>
                    </div>

                    <div class="col-lg-12 text-center">
                      <span class="text-light">Already Have an Account? Please <span class="text-light "><span style="font-weight: bold;"><a href="<?php echo base_url('landing/login') ?>">Login</a></span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-5 d-flex flex-wrap flex-fill justify-content-center mx-auto text-center">
                  <img src="<?php echo base_url() ?>assets/img/login.svg" style="width: 80%;">
                  <h3 class="text-white fw-bold" style="height: 82px;">Welcome to <strong>SoloTechnoPark</strong></h3>
                  <p class="text-white" style="margin-top: -35px;">Join us to grow your company with expert talent, and expand your network
                    with great people around you</p>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_tnc" role="dialog">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">the terms and conditions of the application.</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
          <div class="modal-body text-center">
            <div id="tnc_text"></div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->
    <script type="text/javascript">
      $('[name="file_npwp"]').change(function() {
        var filename = $(this).val().replace(/C:\\fakepath\\/i, '')
        $('#nama_file_npwp').text(filename);
      });

      $('[name="file_nib"]').change(function() {
        var filename = $(this).val().replace(/C:\\fakepath\\/i, '')
        $('#nama_file_nib').text(filename);
        console.log(filename)
      });

      $(document).on('click', '.item_daftar', function(e) {
        e.preventDefault();
        let cek = 0;
        let seeker_nama = $('#seeker_nama').val();

        if (document.getElementById("file_npwp").files.length == 0) {
          console.log("no files selected");
          Swal.fire(
            'Oops...',
            'File NPWP Required!',
            'warning'
          )
          cek++;
        }

        if (seeker_nama == '') {
          $('#seeker_nama').attr('placeholder', 'Please Enter Name');
          $('#seeker_nama').addClass('is-invalid');
          Swal.fire(
            'Oops...',
            'Some have not been filled in or in the checklist!',
            'warning'
          )
          cek++;
        } else {
          $('#seeker_nama').removeClass('is-invalid');
        }

        var seeker_check = $('#check_persetujuan:checkbox:checked').length > 0;
        if (seeker_check == '') {
          $('#check_persetujuan').addClass('is-invalid');
          Swal.fire(
            'Oops...',
            'Some have not been filled in or in the checklist!',
            'warning'
          )
          cek++;
        }


        let level = $('#seeker_level').val();
        if (level == 3) {
          let perusahaan_nama = $('#perusahaan_nama').val();

          if (perusahaan_nama == '') {
            $('#perusahaan_nama').attr('placeholder', 'Please Enter Company');
            $('#perusahaan_nama').addClass('is-invalid');
            $('#seeker_email').val('');
            Swal.fire(
              'Oops...',
              'Some have not been filled in or in the checklist!',
              'warning'
            )
            cek++;
          } else {
            $('#perusahaan_nama').removeClass('is-invalid');
          }

        } else {
          $('#perusahaan_nama').removeClass('is-invalid');

        }
        let seeker_email = $('#seeker_email').val();
        if (seeker_email == '') {
          $('#seeker_email').attr('placeholder', 'Please enter Email');
          $('#seeker_email').addClass('is-invalid');
          $('#seeker_email').val('');
          Swal.fire(
            'Oops...',
            'Some have not been filled in or in the checklist!',
            'warning'
          )
          cek++;
        } else {
          let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
          if (!testEmail.test(seeker_email)) {
            $('#seeker_email').attr('placeholder', 'Invalid Email Format');
            $('#seeker_email').addClass('is-invalid');
            $('#seeker_email').val('');

            cek++;
          } else {
            $('#seeker_email').removeClass('is-invalid');

          }
        }

        let seeker_password = $('#seeker_password').val();
        var validasi_password = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
        if (validasi_password.test(seeker_password) == false) {
          $('#seeker_password').attr('placeholder', 'Use a Combination of Alphanumeric and Capital Letters');
          $('#seeker_password').addClass('is-invalid');
          $('#seeker_password').val('');
          Swal.fire(
            'Oops...',
            'Some have not been filled in or in the checklist!',
            'warning'
          )
          cek++;
        } else {
          $('#seeker_password').removeClass('is-invalid');

        }

        if (cek > 0) {
          return false
        } else {
          $.ajax({
            type: "GET",
            url: "<?php echo base_url('seeker/cek_email') ?>",
            dataType: "JSON",
            data: {
              'seeker_email': seeker_email
            },
            success: function(data) {
              console.log(data);
              if (data > 0) {
                $('#seeker_email').attr('placeholder', 'Email Already Used!');
                $('#seeker_email').addClass('is-invalid');
                $('#seeker_email').val('');
                $('#seeker_email').focus();
                Swal.fire(
                  'Oops...',
                  'Email Already Used!',
                  'warning'
                )

                return false;
              } else {
                $('.item_daftar').attr('disabled', 'disabled');
                $('#form-daftar').submit();
              }
            },

          });

        }

      });
      $(document).ready(function() {
        var ini = "seeker";
        const notif = $('.flashdatart').data('title');
        if (notif) {
          Swal.fire({
            title: notif,
            text: $('.flashdatart').data('text'),
            icon: $('.flashdatart').data('icon'),
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.close();
            }
          });
        }
      });

      $(document).on('click', '.btn-kandidat', function() {
        $('.user_role').html('Job Seeker');
        $('.taglinetalent').html('Bergabung bersama kami dan dapatkan pekerjaan dengan mudah');
        $('.btn-pilihan').addClass('danger');
        $(this).removeClass('danger');
        $(this).addClass('primary');
        $('.perusahaan').addClass('d-none');
        $('#form-daftar').attr('action', '<?php echo base_url('seeker/simpan_pendaftaran') ?>');
        $('#seeker_level').val(2);
        $('#sebagai').val("1");
      });
      $(document).on('click', '.btn-provider', function() {
        $('.user_role').html('Job Provider');
        $('.taglinetalent').html('Bergabung bersama kami dan temukan calon karyawan dengan mudah');
        $('.btn-pilihan').addClass('danger');
        $(this).removeClass('danger');
        $(this).addClass('primary');
        $('.perusahaan').removeClass('d-none');
        $('#form-daftar').attr('action', '<?php echo base_url('provider/simpan_pendaftaran') ?>');
        $('#seeker_level').val(3);
        $('#sebagai').val("2");
      });

      function show_password() {
        if ($('#seeker_password').attr('type') == "password") {
          $('#seeker_password').attr('type', 'text');
          $('#show_pw').html('<i class="fa fa-eye-slash"></i>');
          $('#text_pw').text('Hide Password');
        } else {
          $('#text_pw').text('Show Password');
          $('#seeker_password').attr('type', 'password');
          $('#show_pw').html('<i class="fa fa-eye"></i>');
        }
      }

      function tnc() {
        var sebagai = $('#sebagai').val();
        //Ajax Load data from ajax
        $.ajax({
          url: "<?php echo site_url('landing/get_tnc') ?>",
          type: "POST",
          dataType: "JSON",
          data: {
            sebagai: sebagai
          },
          success: function(data) {
            $('#modal_tnc').modal('show');
            $('#tnc_text').html(data.tnc_text);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
          }
        });
      }
    </script>