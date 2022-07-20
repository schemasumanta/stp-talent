    <main>
      <!-- Hero Area Start-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

      <div class="slider-area">
        <div
        class="single-slider section-overly slider-height2 d-flex align-items-center"
        data-background="<?php echo base_url() ?>assets/img/hero/about.jpg"
        >
        <div class="container flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
          <form method="post" action="<?php echo base_url('seeker/simpan_pendaftaran') ?>" id="form-daftar">
            <div class="row mt-5 mb-5 align-items-center">
              <div class="col-lg-6">
                <div class="hero-cap text-center">
                  <h2>Kandidat</h2>
                  <p class="text-light">Bergabung bersama kami dan dapatkan pekerjaan dengan mudah</p>
                </div>
                <div class="row justify-content-center mt-4">
                  <div class="col-lg-8">
                    <input type="text" class="form-control" name="seeker_nama"  id="seeker_nama" placeholder="Nama Lengkap" autofocus>
                  </div>

                  <div class="col-lg-8 mt-3">
                    <input type="text" class="form-control" name="seeker_telepon"  id="seeker_telepon" placeholder="Nomor Telepon" autofocus>
                  </div>
                  <div class="col-lg-8 mt-3">
                    <input type="text" class="form-control" name="seeker_email"  id="seeker_email" placeholder="Masukkan Email" autofocus>
                  </div>
                  <div class="col-lg-8 mt-3">
                    <input type="password" class="form-control" name="seeker_password"  id="seeker_password" placeholder="Masukkan Password">
                  </div>
                  <div class="col-lg-8 mt-4 items-link btn-group">
                    <a href="<?php echo base_url() ?>" style="width: 50%;margin-right:15px;display: inline-block!important;background: transparent;color: white;border:1px solid white">Batal</a>
                    <a href="javascript:;" class="item_daftar" style="width: 50%;display: inline-block!important;background:#DD2727;color: white;border: 1px solid #DD2727">Daftar</a>
                  </div>

                  <div class="col-lg-8 text-center">
                    <span class="text-light">Sudah Punya Akun ? Silahkan <span class="text-light "><span style="font-weight: bold;"><a href="<?php echo base_url('seeker') ?>">Login</a></span>
                  </div>
                </div>
              </div>
              <div class="col-lg-6" style=";padding: 10px;border:1px solid white;border-bottom-left-radius: 35px;border-top-right-radius: 35px">
                <img src="<?php echo base_url() ?>assets/img/seeker.jpg" style="width: 100%;border-bottom-left-radius: 35px;border-top-right-radius: 35px">
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
    $(document).on('click','.item_daftar',function () {
      let cek = 0;
      let seeker_nama = $('#seeker_nama').val()

      if (seeker_nama=='') {
        $('#seeker_nama').attr('placeholder','Silahkan Masukkan Nama');
        $('#seeker_nama').addClass('ph-merah');
        cek++;
      }else{
        $('#seeker_nama').removeClass('ph-merah');
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

     if (seeker_password=='') {

      $('#seeker_password').attr('placeholder','Silahkan Masukkan Password');
      $('#seeker_password').addClass('ph-merah');
      cek++;
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
</script>
