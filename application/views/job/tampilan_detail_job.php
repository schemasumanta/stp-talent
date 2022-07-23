 <main>
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
                  <a href="#">
                    <h4><?php echo $job->lowongan_judul ?></h4>
                  </a>
                  <ul>
                    <li>News & Media</li>
                    <li><i class="fas fa-map-marker-alt"></i>DKI Jakarta</li>
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
              <li>Posted date : <span>1 June 2022</span></li>
              <li>Location : <span>DKI Jakarta</span></li>
              <li>Vacancy : <span>01</span></li>
              <li>Application date : <span>10 June 2022</span></li>
            </ul>
            <div class="apply-btn2">
              <a href="#" class="btn">Apply Now</a>
            </div>
          </div>
          <div class="post-details4 mb-50">
            <!-- Small Section Tittle -->
            <div class="small-section-tittle">
              <h4>Company Information</h4>
            </div>
            <span>Metro TV</span>
            <p>
              Metro TV is an Indonesian free-to-air television news network
              based in West Jakarta. It was established on 25 November 2000
              and now has over 52 relay stations all over the country.
            </p>
            <ul>
              <li>Name: <span>Metro TV </span></li>
              <li>Web : <span> www.metrotvnews.com</span></li>
              <li>Email: <span>career@metrotvnews.com</span></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php endforeach ?>

</main>