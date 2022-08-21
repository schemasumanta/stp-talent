    <main>
      <!-- Hero Area Start-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

      <div class="slider-area">
        <div
        class="single-slider section-overly2 slider-height2 d-flex align-items-center"
        data-background="<?php echo base_url() ?>assets/img/hero/about.jpg"
        >
        <div class="container flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
          <form method="post" action="<?php echo base_url('seeker/simpan_pendaftaran') ?>" id="form-daftar">
            <div class="row mt-5 mb-5 p-0 w-100 justify-content-center ">

              <div class="col-lg-5 p-5" style="border-radius: 15px;background: rgba(22,22,26,0.7);">
                <div class="hero-cap align-items-center mb-3 text-center">
                  <a href="javascript:;" class="genric-btn danger medium btn-kandidat btn-pilihan" style="border-top-left-radius: 15px;border-bottom-left-radius: 15px;border-top-right-radius: 0px;border-bottom-right-radius: 0px">Job Seeker</a>
                  <a href="javascript:;" class="genric-btn danger medium btn-provider btn-pilihan" >Job Provider</a>
                </div>
                <div class="hero-cap text-center">
                  <h2 class="user_role">Register</h2>
                  <!-- <p class="text-light taglinetalent"> -->
                  </p>
                </div>
                <div class="row justify-content-center mt-4">
                  <div class="col-lg-12">
                    <input type="text" class="form-control w-100" name="seeker_nama"  id="seeker_nama" placeholder="Nama Lengkap" autofocus>
                    <input type="hidden" class="form-control w-100" name="seeker_level"  id="seeker_level" value="2">
                  </div>
                  <div class="col-lg-12 mt-4">
                    <input type="text" class="form-control w-100" name="seeker_telepon"  id="seeker_telepon" placeholder="Nomor Telepon" autofocus>
                  </div>
                  <div class="col-lg-12 mt-4 perusahaan d-none">
                    <input type="text" class="form-control w-100" name="perusahaan_id"  id="perusahaan_id" placeholder="Nama Perusahaan sesuai NPWP" autofocus>
                  </div>
                  <div class="col-lg-12 mt-4">
                    <input type="text" class="form-control w-100" name="seeker_email"  id="seeker_email" placeholder="Masukkan Email" autofocus>
                  </div>
                  <div class="col-lg-12 mt-4">
                    <input type="password" class="form-control w-100" name="seeker_password"  id="seeker_password" placeholder="Masukkan Password Min 6 Digit">
                  </div>
                  <div class="col-lg-12 mt-4 items-link btn-group">
                    <a href="<?php echo base_url() ?>" style="width: 50%;margin-right:15px;display: inline-block!important;background: transparent;color: white;border:1px solid white">Batal</a>
                    <a href="javascript:;" class="item_daftar" style="width: 50%;display: inline-block!important;background:#DD2727;color: white;border: 1px solid #DD2727">Daftar</a>
                  </div>

                  <div class="col-lg-12 text-center">
                    <span class="text-light">Sudah Punya Akun ? Silahkan <span class="text-light "><span style="font-weight: bold;"><a href="<?php echo base_url('landing/login') ?>">Login</a></span>
                  </div>
                </div>
              </div>
              <div class="col-lg-2"></div>
              <div class="col-lg-5 d-flex flex-wrap flex-fill justify-content-center mx-auto text-center">
                <img src="<?php echo base_url() ?>assets/img/login.svg" style="width: 80%;">
                <h3 class="text-white fw-bold">Welcome to <strong>SoloTechnoPark</strong></h3>
                <p class="text-white">Join us to develop your company with expert talent, and expand your network
                with great people around you</p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
  <script type="text/javascript">
    $(document).on('click','.item_daftar',function () {
      let cek = 0;
      let seeker_nama = $('#seeker_nama').val();

      if (seeker_nama=='') {
        $('#seeker_nama').attr('placeholder','Silahkan Masukkan Nama');
        $('#seeker_nama').addClass('ph-merah');
        cek++;
      }else{
        $('#seeker_nama').removeClass('ph-merah');
      }

      let level = $('#seeker_level').val();
      if (level==3) {
        let perusahaan_id = $('#perusahaan_id').val();
        
        if (perusahaan_id=='') {
          $('#perusahaan_id').attr('placeholder','Silahkan Masukkan Perusahaan');
          $('#perusahaan_id').addClass('ph-merah');
          cek++;
        }else{
          $('#perusahaan_id').removeClass('ph-merah');
        }
      }else{
        $('#perusahaan_id').removeClass('ph-merah');

      }
      let seeker_email = $('#seeker_email').val();
      if (seeker_email=='') {
       $('#seeker_email').attr('placeholder','Silahkan Masukkan Email');
       $('#seeker_email').addClass('ph-merah');
       cek++;
     }else{
       let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
       if (!testEmail.test(seeker_email))
       {
         $('#seeker_email').attr('placeholder','Format Email Tidak Valid');
         $('#seeker_email').addClass('ph-merah');
         cek++;
       }else{
         $('#seeker_email').removeClass('ph-merah');

       }
     }

     let seeker_password = $('#seeker_password').val();
     var validasi_password = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    if (validasi_password.test(seeker_password)==false){
     $('#seeker_password').attr('placeholder','Gunakan Kombinasi Alfanumerik & Huruf Kapital');
     $('#seeker_password').addClass('ph-merah');
   }else{
    $('#seeker_password').removeClass('ph-merah');

  }

    if (cek > 0) {
      return false
    }else{
      $.ajax({
        type : "GET",
        url  : "<?php echo base_url('seeker/cek_email')?>",
        dataType : "JSON",
        data : {'seeker_email':seeker_email},
        success: function(data){
          console.log(data);
          if (data > 0) {
            $('#seeker_email').attr('placeholder','Email Sudah Digunakan!');
            $('#seeker_email').addClass('ph-merah');
            $('#seeker_email').val('');
            $('#seeker_email').focus();


            return false;
          }else{
            $('#form-daftar').submit();
          }
        },

      });

    }

  });
    $(document).ready(function(){
     const notif = $('.flashdatart').data('title');
     if (notif) {
      Swal.fire({
        title:notif,
        text:$('.flashdatart').data('text'),
        icon:$('.flashdatart').data('icon'),
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.close(); 
        }
      });
    }
  });

    $(document).on('click','.btn-kandidat',function(){
      $('.user_role').html('Job Seeker');
      $('.taglinetalent').html('Bergabung bersama kami dan dapatkan pekerjaan dengan mudah');
      $('.btn-pilihan').addClass('danger');
      $(this).removeClass('danger');
      $(this).addClass('primary');
      $('.perusahaan').addClass('d-none');
      $('#form-daftar').attr('action','<?php echo base_url('seeker/simpan_pendaftaran') ?>');
      $('#seeker_level').val(2);
    });
    $(document).on('click','.btn-provider',function(){
      $('.user_role').html('Job Provider');
      $('.taglinetalent').html('Bergabung bersama kami dan temukan calon karyawan dengan mudah');
      $('.btn-pilihan').addClass('danger');
      $(this).removeClass('danger');
      $(this).addClass('primary');
      $('.perusahaan').removeClass('d-none');
      $('#form-daftar').attr('action','<?php echo base_url('provider/simpan_pendaftaran') ?>');
      $('#seeker_level').val(3);
    });


  </script>
