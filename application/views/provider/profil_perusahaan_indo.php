 <main>
  <style type="text/css">
    .btn-perusahaan:hover{
      color:  #f44a40 !important;
    }
    .header_perusahaan{
      height: 250px;
      border-radius: 55px;
      overflow: hidden;
    }
    .logo_perusahaan{
      width: 9rem;
      height: 9rem;
      position: absolute;
      left: 10% ;
      padding: 5px;
      bottom: -70px ;
      border-radius: 10px;
      background: #fff;
      box-shadow: 1px 4px 15px -4px rgba(0,0,0,0.65);
      -webkit-box-shadow: 1px 4px 15px -4px rgba(0,0,0,0.65);
      -moz-box-shadow: 1px 4px 15px -4px rgba(0,0,0,0.65);
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

  <?php 
  $bulan = array(
    '01' => 'Januari',
    '02' => 'Februari',
    '03' => 'Maret',
    '04' => 'April',
    '05' => 'Mei',
    '06' => 'Juni',
    '07' => 'Juli',
    '08' => 'Agustus',
    '09' => 'September',
    '10' => 'Oktober',
    '11' => 'November',
    '12' => 'Desember'
  );
  ?>

  <?php foreach ($perusahaan as $pr): ?>
    <div class="job-post-company pt-50 pb-120">
      <div class="container flashdatart" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
        <div class="row">
          <!-- Left Content -->
          <div class="col-md-12 col-md-12">
            <div class="row p-3">
             <div class="col-xl-12 col-lg-12">
              <!-- job single -->
              <div class="header_perusahaan rounded"  <?php if ($pr->perusahaan_sampul!='') { ?>

                style="background-image: url(<?php echo $pr->perusahaan_sampul?>)"

              <?php  }else{ ?>

                style="background-image: url(<?php echo base_url() ?>assets/img/noimagesampul.jpg)"

              <?php } ?>
              >
              <div class="logo_perusahaan d-flex flex-row justify-content-center align-items-center">
                <a href="#"
                ><img src="<?php echo $pr->perusahaan_logo ?>" style="width: 100%;" alt=""
                /></a>
                <!--          <a href="javascript:;" class="genric-btn large primary rounded" style="position: absolute;bottom: 0px;">Ganti Logo</a></a> -->

              </div>
            </div>
          </div>


          <div class="col-md-12 col-xl-12 p-0 mt-5">
            <div class="row">
              <div class="col-md-5 col-xl-6 p-5">
                <h4  style="font-weight: bolder;">About Us</h4>
                <p style="text-align: justify;"><?php echo $pr->perusahaan_sambutan; ?></p>
              </div> 
              <div class="col-md-6 col-xl-6 p-5">
                <h4  style="font-weight: bolder;"><?php echo $pr->perusahaan_nama; ?></h4>
                <br>
                <?php if ($pr->perusahaan_alamat!='') { ?>
                  <p style="text-align: justify;"><i class="fas fa-building mr-3"></i><?php echo $pr->perusahaan_alamat; ?></p>
                <?php  } ?>

                <?php if ($pr->perusahaan_prov!=0) { ?>
                  <p><i class="fas fa-map-marker-alt mr-3"></i><?php echo $pr->kabkota_nama." - ".$pr->prov_nama; ?></p>
                <?php  } ?>

                <?php if ($pr->perusahaan_email!='') { ?>
                  <p><i class="fas fa-envelope mr-3"></i><?php echo $pr->perusahaan_email; ?></p>
                <?php  } ?>
                <?php if ($pr->perusahaan_telepon!='') { ?>
                  <p><i class="fas fa-phone mr-3"></i><?php echo $pr->perusahaan_telepon; ?></p>
                <?php  } ?>

                <?php if ($pr->perusahaan_website!='') { ?>
                  <p><i class="fas fa-globe mr-3"></i><?php echo $pr->perusahaan_website; ?></p>
                <?php  } ?>

                <?php if ($this->session->login) { ?>
                  <?php if ($this->session->user_level!=3): ?>
                    <a href="javascript:;" class="genric-btn2 danger medium item_report_perusahaan" data-perusahaan_id="<?php echo $pr->perusahaan_id ?>" data-user_id="<?php echo $pr->user_id ?>"><i class="fas fa-flag mr-3 text-white"></i>Report</a>
                    <a href="<?php echo base_url() ?>chat/index/<?php echo md5($pr->user_id) ?>" class="genric-btn medium primary"><i class="fas fa-comments mr-3"></i>Chat</a>
                  <?php endif ?>
                <?php  }else{ ?>
                  <a href="<?php echo base_url('landing/login') ?>" class="genric-btn2 danger medium" ><i class="fas fa-flag mr-3 text-white"></i>Report</a>
                  <a href="<?php echo base_url('landing/login') ?>" class="genric-btn medium primary"><i class="fas fa-comments mr-3"></i>Chat</a>
                <?php  } ?>
              </div> 

            </div>
          </div>

        </div>

      </div>
    </div>
  </div>
</div>
</div>
</div>
<?php endforeach ?>

</main>

<script type="text/javascript">
  $('.item_report_perusahaan').on('click',function(e){
    e.preventDefault();
    let user_id = $(this).data('user_id');
    let perusahaan_id = $(this).data('perusahaan_id');

    $('#modal_report').modal('show');
    $('#user_id_report').val(user_id);
    $('#perusahaan_id_report').val(perusahaan_id);
  });
  $(document).on('click','#btn_report_perusahaan',function(e){
    e.preventDefault();
    let report_deskripsi = $('#report_deskripsi').val();
    if (report_deskripsi=='') {
      $('.error-report_deskripsi').html('Silahkan Masukkan Detail Pelanggaran');
      return false;
    }

    $('#form_report').submit();
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

<div class="modal fade" data-backdrop="static" id="modal_report" tabindex="-1" role="dialog" aria-labelledby="modal_reportLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
     <form id="form_report" method="post" action="<?php echo base_url('landing/laporkan') ?>">
      <div class="modal-header bg-danger text-light"> 
        <h6 class="modal-title judul_lamaran text-white"><i class="fas fa-flag mr-2"></i>Laporkan Perusahaan</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
      </div>
      <div class="modal-body">
       <div class="row "> 
       <div class="col-md-12"> 
         <label style="color:#343a40;" for="report_deskripsi">Detail Pelanggaran</label>
         <input type="hidden" name="user_id_report" id="user_id_report">
         <input type="hidden" name="perusahaan_id_report" id="perusahaan_id_report">

         <textarea type="text" class="form-control" id="report_deskripsi"  name="report_deskripsi" rows="5" placeholder="Berikan informasi terkait Pelanggaran"></textarea>
         <small class="error-report_deskripsi text-danger"></small>
       </div>
     </div>
   </div>
   <div class="modal-footer">
    <div class=" row"class="collapse" id="customer_collapse">
      <div class="col-sm-12 float-right">
        <button type="button" class="genric-btn rounded large danger" data-dismiss="modal" style="border-radius: 0px;" >Tutup</button>
        <button type="button" class="genric-btn rounded large primary" style="border-radius: 0px" id="btn_report_perusahaan">Proses Report</button>
      </div>
    </div>
  </div>
</form>
</div>
</div>
</div> 

