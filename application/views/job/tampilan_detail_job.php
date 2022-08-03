 <main>
  <style type="text/css">
    .btn-perusahaan:hover{
      color:  #f44a40 !important;
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

  <?php foreach ($lowongan as $job): ?>
    <!-- Hero Area End -->
    <!-- job post company Start -->
    <div class="job-post-company pt-120 pb-120">
      <div class="container">
        <div class="row ">
          <!-- Left Content -->
          <div class="col-xl-7 col-lg-8">
            <!-- job single -->
            <div class="single-job-items mb-50">
              <div class="job-items">

                <div class="job-tittle">
                  <?php if (!$this->session->login) { ?>
                   <a
                   href="<?php echo base_url() ?>landing/login/<?php echo $job->lowongan_id ?>" class="bookmark_lowongan" data="<?php echo $job->lowongan_id ?>" style="color: #F82C2C;
                   display: block;
                   padding: 4px 33px;
                   text-align: center;
                   background: transparent!important;
                   border: 0px!important;
                   position: absolute;
                   top:-3px;
                   right: 0;
                   margin-bottom: 25px;"><i class="fas fa-bookmark fa-3x"></i></a>

                 <?php  }else{ ?>
                  <?php if ($this->session->user_level==2) { 
                    $this->db->where('lowongan_id',$job->lowongan_id);
                    $this->db->where('user_id' ,$this->session->user_id);
                    $cek_bookmark  = $this->db->get('tbl_lowongan_tersimpan')->num_rows();
                    if ($cek_bookmark > 0) { ?>
                      <a 
                      href="javascript:;" class="bookmark_lowongan item_bookmark" data-job="<?php echo $job->lowongan_id ?>" data-status="0" style="color: #F82C2C;
                      display: block;
                      padding: 4px 33px;
                      text-align: center;
                      background: transparent!important;
                      border: 0px!important;
                      position: absolute;
                      top:-3px;
                      right: 0;
                      margin-bottom: 25px;"><i class="fas fa-bookmark fa-3x"></i></a>
                      
                    <?php }else{ ?>
                      <a 
                      href="javascript:;" class="bookmark_lowongan item_bookmark" data-job="<?php echo $job->lowongan_id ?>" data-status="1" style="color: #b2b2b2;
                      display: block;
                      padding: 4px 33px;
                      text-align: center;
                      background: transparent!important;
                      border: 1px!important;
                      position: absolute;
                      top:-3px;
                      right: 0;
                      margin-bottom: 25px;"><i class="fas fa-bookmark fa-3x"></i></a>

                    <?php }} ?>

                  <?php } ?>
                  <a href="#">
                    <h4><?php echo $job->lowongan_judul ?></h4>
                  </a>
                  <ul>
                    <li><?php echo $job->kategori_nama; ?></li>
                    <li><i class="fas fa-map-marker-alt"></i><?php echo $job->prov_nama; ?></li>
                    <li>
                     <?php if ($job->lowongan_gaji_secret ==null || $job->lowongan_gaji_secret =='' ) {
                      if (floatval($job->lowongan_gaji_max) > 0) {
                        echo "Rp ".number_format($job->lowongan_gaji_min,0,",",".")." - ".number_format($job->lowongan_gaji_max,0,",",".");
                      }else{
                        echo "Rp ".number_format($job->lowongan_gaji_min,0,",",".");
                      } 
                    } ?>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="job-post-details">
            <div class="post-details1 mb-50">
              <!-- Small Section Tittle -->
              <div class="small-section-tittle">
                <h4>Job Description</h4>
              </div>
              <p class="mb-3"  style="font-family: Inter!important;line-height: 15px">  <?php echo $job->lowongan_deskripsi; ?></p>
            </div>

          </div>
          <?php if (count($skill) > 0) { ?>

            <div class="job-post-details">
              <div class="post-details1 mb-50">
                <!-- Small Section Tittle -->
                <div class="small-section-tittle">
                  <h4>Skills</h4>
                </div>
                <ul>
                  <?php foreach ($skill as $sk): ?>

                    <li class="mb-3"  style="font-family: Inter!important;line-height: 15px">  <?php echo $sk->skill_nama; ?></li>
                  <?php endforeach ?>
                </ul>

              </div>

            </div>

          <?php  } ?>


        </div>
        <!-- Right Content -->
        <div class="col-xl-4 col-lg-4">
          <div class="post-details3 mb-50">
            <!-- Small Section Tittle -->
            <div class="small-section-tittle">
              <h4>Job Overview</h4>
            </div>
            <ul>
              <li>Posted date : <span><?php $tgl_posting = explode(' ', $job->lowongan_created_date);$tgl_tampil = explode('-', $tgl_posting[0]);echo $tgl_tampil[2]." ".$bulan[$tgl_tampil[1]]." ".$tgl_tampil[0]; ?></span></li>
              <li>Location : <span><?php echo $job->kabkota_nama; ?></span></li>
              <li>Applicants : <span><?php echo number_format($applicants,0,",","."); ?></span></li>
              <li>Application date : <span><?php $tgl_end = explode('-', $job->lowongan_end_date);echo $tgl_end[2]." ".$bulan[$tgl_end[1]]." ".$tgl_end[0]; ?></span></li>
            </ul>
            <?php if ($this->session->user_id !=$job->user_id): ?>

              <div class="apply-btn2 btn-group w-100">
                <?php if ($this->session->login) { ?>
                  <a href="javascript:;" class="genric-btn2 danger large w-50 btn_apply" data-lowongan="<?php echo $job->lowongan_id ?>" data-perusahaan="<?php echo $job->perusahaan_nama ?>">Apply Now</a>
                  <a href="<?php echo base_url() ?>chat/index/<?php echo $job->user_id ?>" class="genric-btn  primary  w-50 "><i class="fas fa-comments mr-3"></i>Chat</a>
                <?php  }else{ ?>
                  <a href="<?php echo base_url() ?>landing/login/<?php echo $job->lowongan_id ?>" class="genric-btn2 danger large w-50">Apply Now</a>
                  <a href="<?php echo base_url() ?>landing/login/<?php echo $job->lowongan_id ?>" class="genric-btn  primary  w-50 "><i class="fas fa-comments mr-3"></i>Chat</a>
                <?php } ?>

              </div>
              <?php else: ?>
             <!--  <div class="apply-btn2 btn-group w-100">
                <?php if ($this->session->login) { ?>
                  <a href="#" class="genric-btn2 danger large w-50">Apply Now</a>
                  <a href="<?php echo base_url() ?>chat/index/<?php echo $job->user_id ?>" class="genric-btn  primary  w-50 "><i class="fas fa-comments mr-3"></i>Chat</a>
                <?php  }else{ ?>
                  <a href="<?php echo base_url('landing/login') ?>" class="genric-btn2 danger large w-50">Apply Now</a>
                  <a href="<?php echo base_url('landing/login') ?>" class="genric-btn  primary  w-50 "><i class="fas fa-comments mr-3"></i>Chat</a>
                <?php } ?>

              </div>
            -->
          <?php endif ?>


        </div>
        <div class="post-details4 mb-50">
          <!-- Small Section Tittle -->
          <div class="small-section-tittle">
            <h4>Company Information</h4>
          </div>
          <a  class="btn-perusahaan" style="font-weight: bold;font-size: 1.4em;color: #5b5c6e" href="<?php echo base_url() ?>landing/profil_perusahaan/<?php echo md5($job->perusahaan_id) ?>"><?php echo $job->perusahaan_nama; ?></a>
          <?php if ($job->perusahaan_sambutan!=''): ?>

            <p class="text-justify">
              <?php echo $job->perusahaan_sambutan ?>
            </p>
          <?php endif ?>
          <ul>
            <?php if ($job->perusahaan_website!=''): ?>

              <li>Web : <span> <?php echo $job->perusahaan_website; ?></span></li>
            <?php endif ?>
            <?php if ($job->perusahaan_email!=''): ?>

              <li>Email: <span><?php echo $job->perusahaan_email; ?></span></li>
            <?php endif ?>
            <?php if ($job->perusahaan_telepon!=''): ?>

              <li>Phone: <span><?php echo $job->perusahaan_telepon; ?></span></li>
            <?php endif ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endforeach ?>



<div class="modal fade" data-backdrop="static" id="ModalLamaran" tabindex="-1" role="dialog" aria-labelledby="ModalLamaranLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" >
     <form id="form_lamaran" method="post" enctype="multipart/form-data" action="<?php echo base_url('job/simpan_lamaran') ?>">

      <div class="modal-header"> 
        <h6 class="modal-title judul_lamaran">Melamar Ke</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">x</span></button>
      </div>
      <div class="modal-body">
       <div class="row "> 
        
       <div class="col-md-12"> 
         <label style="color:#343a40;" for="lamaran_deskripsi">Tentang Anda</label>
         <input type="hidden" name="lowongan_id" id="lowongan_id">
         <textarea type="text" class="form-control" id="lamaran_deskripsi"  name="lamaran_deskripsi" required rows="5" placeholder="Berikan informasi terkait keahlian anda untuk pekerjaan ini"></textarea>
         <small class="error-lamaran_deskripsi text-danger"></small>
       </div>
     </div>
   </div>
   <div class="modal-footer">
    <div class=" row"class="collapse" id="customer_collapse">
      <div class="col-sm-12 float-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal" style="border-radius: 0px;" >Tutup</button>
        <button type="button" class="btn btn-success" style="border-radius: 0px" id="btn_simpan_biodata">Simpan</button>
      </div>
    </div>
  </div>
</form>
</div>
</div>
</div> 
</main>
<script type="text/javascript">
  $('.item_bookmark').on('click',function(e){
    e.preventDefault();
    let job = $(this).data('job');
    let status = $(this).data('status');
    $.ajax({
      type : "POST",
      url  : "<?php echo base_url('job/bookmark')?>",
      dataType : "JSON",
      data : {'job':job,'status':status,},
      success: function(data){
        if (data!="Gagal") {
          if (data==0) {
            $('.item_bookmark').css('color','#b2b2b2');
            $('.item_bookmark').data('status','1');

          }else{
            $('.item_bookmark').css('color','#F82C2C');
            $('.item_bookmark').data('status','0');

          }
        }
      }
    });
  });
  $('.btn_apply').on('click',function(){
    let lowongan_id = $(this).data('lowongan');
    let perusahaan = $(this).data('perusahaan');
    $('#ModalLamaran').modal('show');
    $('.judul_lamaran').html('Melamar ke '+perusahaan);
    $('#lowongan_id').val(lowongan_id);
  });
</script>