 <main>
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
  $colspan = 6;
  ?>

  <?php foreach ($lowongan as $job): ?>

    <!-- Hero Area End -->
    <!-- job post company Start -->
    <div class="job-post-company pt-120 pb-120">
      <div class="container">
        <div class="row justify-content-between">
          <!-- Left Content -->
          <div class="col-xl-7 col-lg-8">
            <!-- job single -->
            <div class="single-job-items mb-50">
              <div class="job-items">
                <div class="company-img company-img-details">
                  <a href="#"
                  ><img src="" alt=""
                  /></a>
                </div>
                <div class="job-tittle">
                  <a href="javascript:;" class="bookmark_lowongan" data="<?php echo $job->lowongan_id ?>" style="color: #F82C2C;
                  display: block;
                  padding: 4px 33px;
                  text-align: center;
                  background: transparent!important;
                  border: 0px!important;
                  position: absolute;
                  top:-3px;
                  right: 0;
                  margin-bottom: 25px;"><i class="fas fa-bookmark fa-3x"></i></a>
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
          <!-- job single End -->

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
            <div class="apply-btn2 btn-group w-100">
              <a href="#" class="genric-btn2 danger large w-50">Apply Now</a>
              <a href="#" class="genric-btn  primary  w-50 "><i class="fas fa-comments mr-3"></i>Chat</a>
            </div>
          </div>
          <div class="post-details4 mb-50">
            <!-- Small Section Tittle -->
            <div class="small-section-tittle">
              <h4>Company Information</h4>
            </div>
            <span><?php echo $job->perusahaan_nama; ?></span>
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

</main>