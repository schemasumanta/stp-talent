<main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <!-- slider Area Start-->
  <div class="slider-area">
    <!-- Mobile Menu -->
    <div class="slider-active">
      <div
      class="single-slider slider-height d-flex align-items-center"

      <?php if (count($slider_main) > 0) { ?>
        <?php foreach ($slider_main as $key): ?>

          data-background="<?php echo $key->slider_gambar ?>"

        <?php endforeach ?>
      <?php  }else{ ?>
        data-background="assets/img/hero/jobless.jpg"
      <?php } ?>
      >
      <div class="container">
        <div class="row">
          <div class="col-xl-6 col-lg-9 col-md-10">
            <div class="hero__caption">
              <h1>Find your most Exciting Jobs</h1>
            </div>
          </div>
        </div>
        <!-- Search Box -->
        <div class="row">
          <div class="col-xl-8">
            <!-- form -->
            <form action="#" class="search-box">
              <div class="input-form">
                <input type="text" placeholder="Job Title or Keyword" />
              </div>
              <div class="select-form">
                <div class="select-itms">
                  <select name="select" id="search_lokasi_pekerjaan">
                    <option value="">Location DKI Jakarta</option>
                    <option value="">Location Jawa Tengah</option>
                    <option value="">Location Jawa Timur</option>

                  </select>
                </div>
              </div>
              <div class="search-form">
                <a href="#">Find job</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- slider Area End-->
<!-- Our Services Start -->
<div class="our-services section-pad-t30">
  <div class="container">
    <!-- Section Tittle -->
    <div class="row">
      <div class="col-lg-12">
        <div class="section-tittle text-center">
          <span>FEATURED TOURS Packages</span>
          <h2>Browse Top Categories</h2>
        </div>
      </div>
    </div>
    <div class="row d-flex justify-content-center">
      <?php if (count($kategori_job) > 0): ?>
        <?php foreach ($kategori_job as $kj): ?>
          <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
            <div class="single-services text-center mb-30">
              <div class="services-ion mb-2">
                <span class="mb-2"><img src="<?php echo $kj->kategori_icon ?>" style="height: 100px"></span>
              </div>
              <div class="services-cap">
                <h5><a href="job_listing.html"><?php echo ucwords($kj->kategori_nama); ?></a></h5>
                <span>(653)</span>
              </div>
            </div>
          </div>
        <?php endforeach ?>
      <?php endif ?>

    </div>
    <!-- More Btn -->
    <!-- Section Button -->
    <div class="row">
      <div class="col-lg-12">
        <div class="browse-btn2 text-center mt-50 mb-1">
          <a href="job_listing.html" class="border-btn2"
          >Browse All Sectors</a
          >
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Our Services End -->
<!-- Online CV Area Start -->
<div
class="online-cv cv-bg section-overly pt-90 pb-120"

<?php if (count($slider_cv) > 0) { ?>
  <?php foreach ($slider_cv as $cv): ?>

    data-background="<?php echo $cv->slider_gambar ?>"

  <?php endforeach ?>
<?php  }else{ ?>
  data-background="assets/img/gallery/cv_bg.jpg"
<?php } ?>
>
<div class="container">
  <div class="row justify-content-center">
    <div class="col-xl-10">
      <div class="cv-caption text-center">
        <p class="pera1">FEATURED TOURS Packages</p>
        <p class="pera2">
          Life's Changing Experience & Make a difference!
        </p>
        <a href="#" class="border-btn2" style="border:1px solid white;color: #ffffff">Upload your cv</a>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Online CV Area End-->
<!-- Featured_job_start -->
<section class="featured-job-area feature-padding">
  <div class="container">
    <!-- Section Tittle -->
    <div class="row">
      <div class="col-lg-12">
        <div class="section-tittle text-center">
          <span>Recent Job</span>
          <h2>Featured Jobs</h2>
        </div>
      </div>
    </div>
    <div class="row justify-content-center w-100">

      <?php foreach ($featured_job as $fj): ?>

        <div class="col-xl-12">
          <!-- single-job-content -->
          <div class="single-job-items mb-30">
            <div class="job-items">
              <div class="company-img">
                <a href="<?php echo base_url() ?>job/detail/<?php echo $fj->lowongan_id ?>"
                ><img src="<?php echo $fj->perusahaan_logo ?>" alt=""
                /></a>
              </div>
              <div class="job-tittle">
                <a href="<?php echo base_url() ?>job/detail/<?php echo $fj->lowongan_id ?>"><h4><?php echo $fj->lowongan_judul; ?></h4></a>
                <ul>
                  <li><?php echo $fj->kategori_nama; ?></li>
                  <li><i class="fas fa-map-marker-alt"></i><?php echo $fj->kabkota_nama." - ".$fj->prov_nama; ?></li>
                  <li>
                    <?php if ($fj->lowongan_gaji_secret ==null || $fj->lowongan_gaji_secret =='' ) {
                     if (floatval($fj->lowongan_gaji_max) > 0) {
                      echo "Rp ".number_format($fj->lowongan_gaji_min,0,",",".")." - ".number_format($fj->lowongan_gaji_max,0,",",".");
                    }else{
                      echo "Rp ".number_format($fj->lowongan_gaji_min,0,",",".");
                    } 
                  } ?>
                </li>
              </ul>
            </div>
          </div>
          <div class="items-link f-right">
           <!--  <php if ($this->session->user_level==2): ?>
              <a href="javascript:;" class="bookmark_lowongan" data="<?php echo $fj->lowongan_id ?>" style="color: #F82C2C;
              display: block;
              padding: 4px 33px;
              text-align: center;
              background: transparent!important;
              border: 0px!important;
              position: absolute;
              top:-3px;
              right: 0;
              margin-bottom: 25px;"><i class="fas fa-bookmark fa-2x"></i></a>
            <php endif ?> -->
            <a class="mt-3" href="<?php echo base_url() ?>job/detail/<?php echo $fj->lowongan_id ?>"> Detail</a>
            <span style="text-align: right;">7 hours ago</span>

          </div>
        </div>


      </div>
    <?php endforeach ?>

  </div>
</div>
</section>
<!-- Featured_job_end -->
<!-- How  Apply Process Start-->
<div
class="apply-process-area section-overly apply-bg pt-150 pb-150"

<?php if (count($slider_how) > 0) { 
  ?>
  <?php foreach ($slider_how as $how): ?>

    data-background="<?php echo $how->slider_gambar ?>"

  <?php endforeach ?>
<?php  }else{ ?>
  data-background="assets/img/gallery/how-applybg.png"
<?php } ?>


>
<div class="container">
  <!-- Section Tittle -->
  <div class="row">
    <div class="col-lg-12">
      <div class="section-tittle-works white-text text-center">
        <span>Apply process</span>
        <h2>How it works</h2>
      </div>
    </div>
  </div>
  <!-- Apply Process Caption -->
  <div class="row">
    <div class="col-lg-4 col-md-6">
      <div class="single-process text-center mb-30">
        <div class="process-ion">
          <span class="flaticon-search"></span>
        </div>
        <div class="process-cap">
          <h5>1. Search a job</h5>
          <p class="justify-content">
            As simple as clicking, filtering by Place and Interests !
            and you could also browse by Categories !
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="single-process text-center mb-30">
        <div class="process-ion">
          <span class="flaticon-curriculum-vitae"></span>
        </div>
        <div class="process-cap">
          <h5>2. Apply for job</h5>
          <p class="justify-content">
            Complete your profile, upload you resume, make it as
            Interested as it can be for Recruiters
          </p>
        </div>
      </div>
    </div>
    <div class="col-lg-4 col-md-6">
      <div class="single-process text-center mb-30">
        <div class="process-ion">
          <span class="flaticon-tour"></span>
        </div>
        <div class="process-cap">
          <h5>3. Get your job</h5>
          <p class="justify-content">
            In your Profile dashboard or Email for an update from
            recruiters, do a remote interview, with our built-in
            features.
          </p>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- How  Apply Process End-->
<!-- Testimonial Start -->
<div class="testimonial-area testimonial-padding">
  <div class="container">
    <!-- Testimonial contents -->
    <div class="row d-flex justify-content-center">
      <div class="col-xl-8 col-lg-8 col-md-10">
        <div class="h1-testimonial-active dot-style">
          <!-- Single Testimonial -->
          <div class="single-testimonial text-center">
            <!-- Testimonial Content -->
            <div class="testimonial-caption">
              <!-- founder -->
              <div class="testimonial-founder">
                <div class="founder-img mb-30">
                  <img
                  src="assets/img/testmonial/testimonial-founder.png"
                  alt=""
                  />
                  <span>Zaqi Akbar</span>
                  <p>Full Stack Devs</p>
                </div>
              </div>
              <div class="testimonial-top-cap">
                <p>"This platform connected me to my Dreams, Salute"</p>
              </div>
            </div>
          </div>
          <!-- Single Testimonial -->
          <div class="single-testimonial text-center">
            <!-- Testimonial Content -->
            <div class="testimonial-caption">
              <!-- founder -->
              <div class="testimonial-founder">
                <div class="founder-img mb-30">
                  <img src="assets/img/testmonial/1.png" alt="" />
                  <span>Margaret Lawson</span>
                  <p>Personal Assistant to General Mgr. at BGC</p>
                </div>
              </div>
              <div class="testimonial-top-cap">
                <p>“I love "EASY-APPLY" Features”</p>
              </div>
            </div>
          </div>
          <!-- Single Testimonial -->
          <div class="single-testimonial text-center">
            <!-- Testimonial Content -->
            <div class="testimonial-caption">
              <!-- founder -->
              <div class="testimonial-founder">
                <div class="founder-img mb-30">
                  <img
                  src="assets/img/testmonial/testimonial-founder.png"
                  alt=""
                  />
                  <span>Margaret Lawson</span>
                  <p>Creative Director</p>
                </div>
              </div>
              <div class="testimonial-top-cap">
                <p>
                  “I am at an age where I just want to be fit and healthy
                  our bodies are our responsibility! So start caring for
                  your body and it will care for you. Eat clean it will
                  care for you and workout hard.”
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Testimonial End -->
<!-- Support Company Start-->
<div class="support-company-area support-padding fix">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-xl-6 col-lg-6">
        <div class="right-caption">
          <!-- Section Tittle -->
          <div class="section-tittle section-tittle2">
            <span>What we are doing</span>
            <h2>24k Talented people are getting Jobs</h2>
          </div>
          <div class="support-caption">
            <p class="pera-top">
              The challenge is to identify and win talent for the company.
              When companies know who their current employees are and what
              motivates them, they also understand who you need today and
              in the future. Anyone who knows exactly what's going on in
              the company can simply plan better and that also applies to
              personnel planning.
            </p>
            <p>
              Candidates and employees alike need to be treated with
              respect and as individuals throughout the relationship,
              starting with the recruitment process through and beyond
              onboarding.
            </p>
            <a href="about.html" class="btn post-btn">Post a job</a>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6">
        <div class="support-location-img">
          <img src="assets/img/hero/chairs.jpg" alt="" />
          <div class="support-img-cap text-center">
            <p>Since</p>
            <span>2022</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Support Company End-->
<!-- Blog Area Start -->
<div class="home-blog-area blog-h-padding">
  <div class="container">
    <!-- Section Tittle -->
    <div class="row">
      <div class="col-lg-12">
        <div class="section-tittle text-center">
          <span>Our latest blog</span>
          <h2>Our recent news</h2>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-6">
        <div class="home-blog-single mb-30">
          <div class="blog-img-cap">
            <div class="blog-img">
              <img src="assets/img/blog/home-blog1.jpg" alt="" />
              <!-- Blog date -->
              <div class="blog-date text-center">
                <span>24</span>
                <p>Now</p>
              </div>
            </div>
            <div class="blog-cap">
              <p>| Properties</p>
              <h3>
                <a href="single-blog.html"
                >Finding the right Co-Working Spaces.</a
                >
              </h3>
              <a href="#" class="more-btn">Read more »</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-6 col-lg-6 col-md-6">
        <div class="home-blog-single mb-30">
          <div class="blog-img-cap">
            <div class="blog-img">
              <img src="assets/img/blog/home-blog2.jpg" alt="" />
              <!-- Blog date -->
              <div class="blog-date text-center">
                <span>24</span>
                <p>Now</p>
              </div>
            </div>
            <div class="blog-cap">
              <p>| Properties</p>
              <h3>
                <a href="single-blog.html"
                >How "Work from Anywhere" affect F&B Business
              </a>
            </h3>
            <a href="#" class="more-btn">Read more »</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- Blog Area End -->
</main>
