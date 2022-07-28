    <main>
      <!-- Hero Area Start-->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

      <div class="slider-area">
        <div
        class="single-slider section-overly2 slider-height2 d-flex align-items-center"
        data-background="<?php echo base_url() ?>assets/img/hero/about.jpg"
        >
        <div class="container flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">

          <form method="post" action="<?php echo base_url('landing/cek_forgot') ?>" id="form-forgot">
            <div class="row mt-5 mb-5 p-0 w-100 justify-content-center">

              <div class="col-lg-6 mb-5 mt-5  p-5" style="border-radius: 15px;background: rgba(22,22,26,0.7);">
               <div class="hero-cap align-items-center mb-3 text-center">

               </div>
               <div class="hero-cap text-center">
                <h4 class="user_role text-light">Forgot Password</h4>
                <!-- <p class="text-light taglinetalent"> -->
                </div>
                <div class="row justify-content-center mt-4">
                  <div class="col-lg-12">

                    <input type="text" class="form-control text-center" name="seeker_email"  id="seeker_email" placeholder="Masukkan Email" autofocus required>
                  </div>
                  <div class="col-lg-12 mt-4 items-link btn-group">
                    <a href="javascript:;" class="item_send" style="width: 100%;display: inline-block!important;background:#DD2727;color: white;border: 1px solid #DD2727">Reset Password</a>
                  </div>

                  <div class="col-lg-12 text-center">
                    <a href="<?php echo base_url('landing/register') ?>"><span class="text-light">Belum Punya Akun ? Silahkan <b>Daftar</b></span></a>
                  </div>
                </div>
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
    $(document).on('click','.item_send',function () {
     let cek = 0;
     let seeker_email = $('#seeker_email').val();
     if (seeker_email=='') {
       $('#seeker_email').attr('placeholder','Silahkan Masukkan Email');
       $('#seeker_email').addClass('ph-merah');
       $('#seeker_email').focus();
       cek++;
     }else{
       let testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
       if (!testEmail.test(seeker_email))
       {
         $('#seeker_email').attr('placeholder','Format Email Tidak Valid');
         $('#seeker_email').addClass('ph-merah');
         $('#seeker_email').focus();
         cek++;
       }else{
         $('#seeker_email').removeClass('ph-merah');

       }
     }

     if (cek > 0) {
      return false
    }else{
      $('#form-forgot').submit();
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
