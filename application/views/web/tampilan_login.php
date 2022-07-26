    <main>
      <!-- Hero Area Start-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

      <div class="slider-area">
        <div
        class="single-slider section-overly2 slider-height2 d-flex align-items-center"
        data-background="<?php echo base_url() ?>assets/img/hero/about.jpg"
        >
        <div class="container flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">

          <form method="post" action="<?php echo base_url('seeker/cek_login') ?>" id="form-login">
            <div class="row mt-5 mb-5 p-0 w-100 justify-content-center">
            
              <div class="col-lg-5 mb-5 mt-5  p-5" style="border-radius: 15px;background: rgba(22,22,26,0.7);">
               <div class="hero-cap align-items-center mb-3 text-center">
                <a href="javascript:;" class="genric-btn danger medium btn-kandidat btn-pilihan" style="border-top-left-radius: 15px;border-bottom-left-radius: 15px;border-top-right-radius: 0px;border-bottom-right-radius: 0px">Job Seeker</a>
                <a href="javascript:;" class="genric-btn danger medium btn-provider btn-pilihan" >Job Provider</a>

              </div>
              <div class="hero-cap text-center">
                <h2 class="user_role">Login</h2>
                <!-- <p class="text-light taglinetalent"> -->
                </div>
                <div class="row justify-content-center mt-4">
                  <div class="col-lg-12">
                    <input type="hidden" class="form-control" name="seeker_level"  id="seeker_level" value="0">
                    <input type="text" class="form-control" name="seeker_email"  id="seeker_email" placeholder="Masukkan Email" autofocus>
                  </div>
                  <div class="col-lg-12 mt-3">
                    <input type="password" class="form-control" name="seeker_password"  id="seeker_password" placeholder="Masukkan Password">
                  </div>
                  <div class="col-lg-12 mt-4 items-link btn-group">
                    <a href="<?php echo base_url() ?>" style="width: 50%;margin-right:15px;display: inline-block!important;background: transparent;color: white;border:1px solid white">Batal</a>
                    <a href="javascript:;" class="item_login" style="width: 50%;display: inline-block!important;background:#DD2727;color: white;border: 1px solid #DD2727">Login</a>
                  </div>

                  <div class="col-lg-12 text-center">
                    <span class="text-light">Belum Punya Akun ? Silahkan <span class="text-light "><span style="font-weight: bold;"><a href="<?php echo base_url('landing/register') ?>">Daftar</a></span>
                  </div>
                </div>
              </div>
                <div class="col-lg-2">
                </div>
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
    <!-- Hero Area End -->
    <!-- Support Company Start-->
  </main>
  <script type="text/javascript">
    $(document).on('click','.item_login',function () {
      $('#form-login').submit();
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
      $('#seeker_level').val(2);
      $('#form-login').attr('action','<?php echo  base_url('seeker/cek_login'); ?>');
    });

    $(document).on('click','.btn-provider',function(){
      $('.user_role').html('Job Provider');
      $('.taglinetalent').html('Bergabung bersama kami dan temukan calon karyawan dengan mudah');
      $('.btn-pilihan').addClass('danger');
      $(this).removeClass('danger');
      $(this).addClass('primary');
      $('.perusahaan').removeClass('d-none');
      $('#seeker_level').val(3);
      $('#form-login').attr('action','<?php echo  base_url('provider/cek_login'); ?>');

    });

    $(document).ready(function() {

      $('#seeker_password').keydown(function(event) {
        if (event.keyCode == 13) {
          $('#form-login').submit();
          return false;
        }
      });

    });
  </script>
