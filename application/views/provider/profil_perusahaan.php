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
    <div class="job-post-company pt-120 pb-120">
      <div class="container">
        <div class="row">
          <!-- Left Content -->
          <div class="col-xl-12 col-lg-12">
            <!-- job single -->
            <div class="header_perusahaan rounded"  <?php if ($pr->perusahaan_sampul!='') { ?>

              style="background-image: url(<?php echo $pr->perusahaan_sampul?>)"

            <?php  }else{ ?>

              style="background-image: url(<?php echo base_url() ?>assets/img/sampul.jpg)"

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
        <div class="col-xl-8 col-lg-8 mt-5">
          <!-- job single -->
          <div class="single-job-items mb-50">
            <div class="job-items">
             
                <div class="job-tittle">

                 
                    <a href="#">
                      <h4><?php echo $pr->perusahaan_nama ?></h4>
                    </a>
                    <ul>
                      <li><?php echo $pr->kategori_nama; ?></li>
                      <li><i class="fas fa-map-marker-alt"></i><?php echo $pr->prov_nama; ?></li>
                      <li>
                       <?php if ($pr->lowongan_gaji_secret ==null || $pr->lowongan_gaji_secret =='' ) {
                        if (floatval($pr->lowongan_gaji_max) > 0) {
                          echo "Rp ".number_format($pr->lowongan_gaji_min,0,",",".")." - ".number_format($pr->lowongan_gaji_max,0,",",".");
                        }else{
                          echo "Rp ".number_format($pr->lowongan_gaji_min,0,",",".");
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
                <p class="mb-3"  style="font-family: Inter!important;line-height: 15px">  <?php echo $pr->lowongan_deskripsi; ?></p>
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
          <div class="col-xl-4 col-lg-4 mt-5">
            <div class="post-details3 mb-50">
              <!-- Small Section Tittle -->
              <div class="small-section-tittle">
                <h4>Job Overview</h4>
              </div>
              <ul>
                <li>Posted date : <span><?php $tgl_posting = explode(' ', $pr->lowongan_created_date);$tgl_tampil = explode('-', $tgl_posting[0]);echo $tgl_tampil[2]." ".$bulan[$tgl_tampil[1]]." ".$tgl_tampil[0]; ?></span></li>
                <li>Location : <span><?php echo $pr->kabkota_nama; ?></span></li>
                <li>Applicants : <span><?php echo number_format($applicants,0,",","."); ?></span></li>
                <li>Application date : <span><?php $tgl_end = explode('-', $pr->lowongan_end_date);echo $tgl_end[2]." ".$bulan[$tgl_end[1]]." ".$tgl_end[0]; ?></span></li>
              </ul>
              <?php if ($this->session->user_id !=$pr->user_id): ?>

                <div class="apply-btn2 btn-group w-100">
                  <a href="#" class="genric-btn2 danger large w-50">Apply Now</a>
                  <a href="<?php echo base_url() ?>chat/index/<?php echo $pr->user_id ?>" class="genric-btn  primary  w-50 "><i class="fas fa-comments mr-3"></i>Chat</a>
                </div>
              <?php endif ?>

            </div>
            <div class="post-details4 mb-50">
              <!-- Small Section Tittle -->
              <div class="small-section-tittle">
                <h4>Company Information</h4>
              </div>
              <a  class="btn-perusahaan" style="font-weight: bold;font-size: 1.4em;color: #5b5c6e" href="<?php echo base_url() ?>landing/profil_perusahaan/<?php echo md5($pr->perusahaan_id) ?>"><?php echo $pr->perusahaan_nama; ?></a>
              <?php if ($pr->perusahaan_sambutan!=''): ?>

                <p class="text-justify">
                  <?php echo $pr->perusahaan_sambutan ?>
                </p>
              <?php endif ?>
              <ul>
                <?php if ($pr->perusahaan_website!=''): ?>

                  <li>Web : <span> <?php echo $pr->perusahaan_website; ?></span></li>
                <?php endif ?>
                <?php if ($pr->perusahaan_email!=''): ?>

                  <li>Email: <span><?php echo $pr->perusahaan_email; ?></span></li>
                <?php endif ?>
                <?php if ($pr->perusahaan_telepon!=''): ?>

                  <li>Phone: <span><?php echo $pr->perusahaan_telepon; ?></span></li>
                <?php endif ?>
              </ul>
            </div>
          </div>


        </div>

      </div>
    </div>
  </div>
<?php endforeach ?>

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
</script>