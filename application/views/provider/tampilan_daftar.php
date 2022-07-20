    <main>
      <!-- Hero Area Start-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

      <div class="slider-area">
        <div
        class="single-slider section-overly slider-height2 d-flex align-items-center"
        data-background="<?php echo base_url() ?>assets/img/hero/about.jpg"
        >
        <div class="container flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
          <form method="post" action="<?php echo base_url('provider/simpan_pendaftaran') ?>" id="form-daftar">
            <div class="row mt-5 mb-5 align-items-center">
              <div class="col-lg-6">
                <div class="hero-cap text-center">
                  <h2>Job Provider</h2>
                  <p class="text-light">Bergabung bersama kami dan temukan calon karyawan dengan mudah</p>
                </div>
                <div class="row justify-content-center mt-4">
                  <div class="col-lg-8">
                    <input type="text" class="form-control" name="provider_nama"  id="provider_nama" placeholder="Nama Lengkap" autofocus>
                  </div>
                  <div class="col-lg-8 mt-3">
                    <input type="text" class="form-control" name="provider_telepon"  id="provider_telepon" placeholder="Nomor Telepon" autofocus>
                  </div>
                  <div class="col-lg-8 mt-3">
                    <input type="text" class="form-control" name="provider_email"  id="provider_email" placeholder="Masukkan Email" autofocus>
                  </div>
                  <div class="col-lg-8 mt-3">
                    <input type="password" class="form-control" name="provider_password"  id="provider_password" placeholder="Masukkan Password">
                  </div>
                  <div class="col-lg-8 mt-4 items-link btn-group">
                    <a href="<?php echo base_url() ?>" style="width: 50%;margin-right:15px;display: inline-block!important;background: transparent;color: white;border:1px solid white">Batal</a>
                    <a href="javascript:;" class="item_daftar" style="width: 50%;display: inline-block!important;background:#DD2727;color: white;border: 1px solid #DD2727">Daftar</a>
                  </div>
                  <div class="col-lg-8 text-center">
                    <span class="text-light">Sudah Punya Akun ? Silahkan <span class="text-light "><span style="font-weight: bold;"><a href="<?php echo base_url('provider') ?>">Login</a></span>
                  </div>
                </div>
              </div>
              <div class="col-lg-6" style=";padding: 10px;border:1px solid white;border-bottom-left-radius: 35px;border-top-right-radius: 35px">
                <img src="<?php echo base_url() ?>assets/img/provider.jpg" style="width: 100%;border-bottom-left-radius: 35px;border-top-right-radius: 35px">
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
      $('#form-daftar').submit();
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
