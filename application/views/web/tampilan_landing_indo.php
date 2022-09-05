<style>
  .select2-selection__rendered {
    line-height: 70px !important;
  }

  .select2-container .select2-selection--single {
    height: 70px !important;
  }

  .select2-selection__arrow {
    height: 70px !important;
  }

  .select2-container--default .select2-selection--single .select2-selection__rendered {
    color: #777777;
    font-size: 18px;
    height: 70px;
    width: 100%;
    color: #777777;
    font-size: 18px;
    font-weight: 400;
    border: 0px solid black !important;
    border-radius: 0px;
    position: relative;
    font-family: inherit;
    outline: none;
  }

  .btn-lg {
    height: 70px;
  }

  .select2-container--default .select2-selection--single {
    background-color: #fff;
    border: 0px solid #aaa;
    border-radius: 4px;
  }
</style>
<main>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <!-- slider Area Start-->
  <div class="slider-area">
    <!-- Mobile Menu -->
    <div class="slider-active">
      <div class="single-slider slider-height d-flex align-items-center" <?php if (count($slider_main) > 0) { ?> <?php foreach ($slider_main as $key) : ?> data-background="<?php echo $key->slider_gambar ?>" <?php endforeach ?> <?php  } else { ?> data-background="assets/img/hero/jobless.jpg" <?php } ?>>
        <div class="container">
          <div class="row">
            <div class="col-xl-6 col-lg-9 col-md-10">
              <div class="hero__caption">
                <h1>Temukan Pekerjaan Anda</h1>
              </div>
            </div>
          </div>
          <!-- Search Box -->
          <div class="row">
            <div class="col-xl-8">
              <!-- form -->
              <form action="javascript:;" id="form_cari" class="search-box">
                <div class="input-form">
                  <input type="text" name="nama_lowongan" id="nama_lowongan" placeholder="Cari Lowongan Pekerjaan" />
                </div>
                <div class="select-form">
                  <div class="select-itms" style="height: 70px;">
                    <select name="id_kota_cari" id="id_kota_cari" class="form-control form-control-lg">
                      <option value="">Pilih Kota</option>
                      <?php foreach ($kota as $key) { ?>
                        <option value="<?= $key->kabkota_id; ?>"><?= $key->kabkota_nama; ?></option>
                      <?php }; ?>
                    </select>
                  </div>
                </div>
                <div class="search-form">
                  <button type="button" id="btnSave" onclick="cari()" class="btn btn-danger btn-lg">Cari</button>
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
            <span>Kategori Pekerjaan</span>
            <h2>Kategori Teratas</h2>
          </div>
        </div>
      </div>
      <div class="row d-flex justify-content-center">
        <?php if (count($kategori_job) > 0) : ?>
          <?php foreach ($kategori_job as $kj) : ?>
            <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
              <a href="<?= base_url('landing/get_kategori/') . $kj->kategori_id; ?>">

                <div class="single-services text-center mb-30">
                  <div class="services-ion mb-2">
                    <span class="mb-2"><img src="<?php echo $kj->kategori_icon ?>" style="height: 100px"></span>
                  </div>
                  <div class="services-cap">
                    <h5><?php echo ucwords($kj->kategori_nama); ?>
                    </h5>
                    <span>(<?= $kj->jml; ?>)</span>
                  </div>
                </div>
              </a>

            </div>
          <?php endforeach ?>
        <?php endif ?>

      </div>
      <!-- More Btn -->
      <!-- Section Button -->
      <div class="row">
        <div class="col-lg-12">
          <div class="browse-btn2 text-center mt-50 mb-1">
            <a href="<?= base_url('job/job_listing'); ?>" class="border-btn2">Tampilkan Semua Kategori</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Our Services End -->
  <!-- Online CV Area Start -->
  <div class="online-cv cv-bg section-overly pt-90 pb-120" <?php if (count($slider_cv) > 0) { ?> <?php foreach ($slider_cv as $cv) : ?> data-background="<?php echo $cv->slider_gambar ?>" <?php endforeach ?> <?php  } else { ?> data-background="assets/img/gallery/cv_bg.jpg" <?php } ?>>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-10">
          <div class="cv-caption text-center">
            <p class="pera1">CV</p>
            <p class="pera2">
              Pengalaman Mengubah Hidup & Buat perbedaan!
            </p>
            <?php if ($this->session->login) { ?>
              <?php if ($this->session->user_level == "2") : ?>
                <a href="<?= base_url('cv'); ?>" class="border-btn2" style="border:1px solid white;color: #ffffff">Unggah CV Anda</a>

              <?php endif ?>

            <?php  } else { ?>
              <a href="<?= base_url('landing/login'); ?>" class="border-btn2" style="border:1px solid white;color: #ffffff">Unggah CV Anda</a>
            <?php  } ?>

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
            <span>Lowongan Pekerjaan</span>
            <h2>Lowongan Pekerjaan Terbaru</h2>
          </div>
        </div>
      </div>
      <div class="row justify-content-center w-100">
        <?php if (count($featured_job) > 0) { ?>

          <?php foreach ($featured_job as $fj) : ?>

            <div class="col-xl-12">
              <!-- single-job-content -->
              <div class="single-job-items mb-30">
                <div class="job-items">
                  <div class="company-img">
                    <a href="<?php echo base_url() ?>job/detail/<?php echo $fj->lowongan_id ?>"><img src="<?php echo $fj->perusahaan_logo ?>" alt="" /></a>
                  </div>
                  <div class="job-tittle">
                    <a href="<?php echo base_url() ?>job/detail/<?php echo $fj->lowongan_id ?>">
                      <h4><?php echo $fj->lowongan_judul; ?></h4>
                    </a>
                    <ul>
                      <li><?php echo $fj->kategori_nama; ?></li>
                      <li><i class="fas fa-map-marker-alt"></i><?php echo $fj->kabkota_nama . " - " . $fj->prov_nama; ?></li>
                      <li>
                        <?php if ($fj->lowongan_gaji_secret == null || $fj->lowongan_gaji_secret == '') {
                          if (floatval($fj->lowongan_gaji_max) > 0) {
                            echo "Rp " . number_format($fj->lowongan_gaji_min, 0, ",", ".") . " - " . number_format($fj->lowongan_gaji_max, 0, ",", ".");
                          } else {
                            echo "Rp " . number_format($fj->lowongan_gaji_min, 0, ",", ".");
                          }
                        } ?>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="items-link f-right">

                  <a class="mt-3" href="<?php echo base_url() ?>job/detail/<?php echo $fj->lowongan_id ?>"> Rincian</a>
                  <span style="text-align: right;">Diunggah pada : <?= date('d-m-Y', strtotime($fj->lowongan_created_date)); ?></span>

                </div>
              </div>


            </div>
          <?php endforeach ?>
        <?php  } else { ?>
          <center><img src="<?php echo base_url() ?>assets/img/oops.png" style="width: 100%;margin-bottom: 55px"></center>
          <br>
          <center>
            <h2 style="font-weight: bold;">Mohon Maaf, Lowongan Pekerjaan Belum Tersedia..!!</h2>
          </center>
        <?php } ?>
      </div>
    </div>
  </section>

  <!-- Featured_job_end -->
  <!-- How  Apply Process Start-->
  <div class="apply-process-area section-overly apply-bg pt-150 pb-150" <?php if (count($slider_how) > 0) {
                                                                        ?> <?php foreach ($slider_how as $how) : ?> data-background="<?php echo $how->slider_gambar ?>" <?php endforeach ?> <?php  } else { ?> data-background="assets/img/gallery/how-applybg.png" <?php } ?>>
    <div class="container">
      <!-- Section Tittle -->
      <div class="row">
        <div class="col-lg-12">
          <div class="section-tittle-works white-text text-center">
            <span>Proses Lamaran</span>
            <h2>Bagaimana itu Bekerja</h2>
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
              <h5>1. Cari Pekerjaan</h5>
              <p class="justify-content">
                Sesederhana mengklik, memfilter berdasarkan Tempat dan Minat!
                dan Anda juga dapat menelusuri berdasarkan Kategori!</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="single-process text-center mb-30">
            <div class="process-ion">
              <span class="flaticon-curriculum-vitae"></span>
            </div>
            <div class="process-cap">
              <h5>2. Melamar Pekerjaan</h5>
              <p class="justify-content">
                Lengkapi profil Anda, unggah resume Anda, jadikan menjadi
                mertarik karena bisa mempermudah perekrut</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="single-process text-center mb-30">
            <div class="process-ion">
              <span class="flaticon-tour"></span>
            </div>
            <div class="process-cap">
              <h5>3. Dapatkan pekerjaan Anda</h5>
              <p class="justify-content">
                Di dasbor Profil Anda atau Email untuk pembaruan dari
                perekrut.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- How  Apply Process End-->
  <!-- Support Company Start-->
  <div class="support-company-area support-padding fix mt-4">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-xl-6 col-lg-6">
          <div class="right-caption">
            <!-- Section Tittle -->
            <div class="section-tittle section-tittle2">
              <span>Apa yang kita lakukan?</span>
              <h2>24k orang Berbakat mendapatkan Pekerjaan</h2>
            </div>
            <div class="support-caption">
              <p class="pera-top">
                Tantangannya adalah mengidentifikasi dan memenangkan bakat bagi perusahaan.
                Ketika perusahaan mengetahui siapa karyawan mereka saat ini dan apa
                memotivasi mereka, mereka juga mengerti siapa yang Anda butuhkan hari ini dan
                di masa depan. Siapapun yang tahu persis apa yang terjadi di
                perusahaan dapat dengan mudah merencanakan dengan lebih baik dan itu juga berlaku untuk
                perencanaan personel.
              </p>
              <p>
                Kandidat dan karyawan sama-sama perlu diperlakukan dengan
                menghormati dan sebagai individu sepanjang hubungan,
                dimulai dengan proses rekrutmen melalui dan seterusnya
                orientasi.
              </p>
              <a href="<?= base_url('landing/login'); ?>" class="btn post-btn">Posting pekerjaan</a>
            </div>
          </div>
        </div>
        <div class="col-xl-6 col-lg-6 mb-4">
          <div class="support-location-img">
            <img src="assets/img/hero/chairs.jpg" alt="" />
            <div class="support-img-cap text-center">
              <p>Sejak</p>
              <span>2022</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Support Company End-->
  <!-- Blog Area Start -->
  <!-- <div class="home-blog-area blog-h-padding"> -->
  <!-- <div class="container"> -->
  <!-- Section Tittle -->
  <!-- <div class="row">
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
                <img src="assets/img/blog/home-blog1.jpg" alt="" /> -->
  <!-- Blog date -->
  <!-- <div class="blog-date text-center">
                  <span>24</span>
                  <p>Now</p>
                </div>
              </div>
              <div class="blog-cap">
                <p>| Properties</p>
                <h3>
                  <a href="#">Finding the right Co-Working Spaces.</a>
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
                <img src="assets/img/blog/home-blog2.jpg" alt="" /> -->
  <!-- Blog date -->
  <!-- <div class="blog-date text-center">
                  <span>24</span>
                  <p>Now</p>
                </div>
              </div>
              <div class="blog-cap">
                <p>| Properties</p>
                <h3>
                  <a href="#">How "Work from Anywhere" affect F&B Business
                  </a>
                </h3>
                <a href="#" class="more-btn">Read more »</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> -->
  <!-- Blog Area End -->
</main>
<script>
  function cari() {
    $('#btnSave').text('finding...'); //change button text
    $('#btnSave').attr('disabled', true); //set button disable 
    var url;

    url = "<?php echo site_url('job/cari_job') ?>";

    // ajax adding data to database
    $.ajax({
      url: url,
      type: "POST",
      data: $('#form_cari').serialize(),
      dataType: "JSON",
      success: function(data) {

        if (data.status) //if success close modal and reload ajax table
        {
          window.location.replace("<?= base_url('job/job_listing') ?>");
        }

        $('#btnSave').text('Finding Job'); //change button text
        $('#btnSave').attr('disabled', false); //set button enable 


      },
      error: function(jqXHR, textStatus, errorThrown) {
        alert('Error adding / update data');
        $('#btnSave').text('Finding Job'); //change button text
        $('#btnSave').attr('disabled', false); //set button enable 

      }
    });
  }
</script>