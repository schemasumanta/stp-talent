<footer>
  <?php foreach ($stp as $s) : ?>

  <?php endforeach ?>

  <!-- Footer Start-->
  <div class="footer-area footer-bg footer-padding" id="about">
    <div class="container">
      <div class="row d-flex justify-content-between">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
          <div class="single-footer-caption mb-50">
            <div class="single-footer-caption mb-30">
              <div class="footer-tittle">
                <h4>Tentang Kami</h4>
                <div class="footer-pera">
                  <p>
                    <?php echo $s->stp_tagline; ?>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-5">
          <div class="single-footer-caption mb-50">
            <div class="footer-tittle">
              <h4>Kontak Kami</h4>
              <ul>
                <li>
                  <p></p>
                </li>
                <li><a href="#">Phone : <?php echo $s->stp_telepon; ?> </a></li>
                <?php if ($s->stp_email != '') { ?>

                  <li>
                    <a href="#">Email : <?php echo $s->stp_email; ?></a>
                  </li>
                <?php } ?>

              </ul>
            </div>
          </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-5">
          <div class="single-footer-caption mb-50">
            <div class="footer-tittle">
              <h4>Informasi</h4>
              <div class="footer-pera footer-pera2">
                <p>Berlangganan informasi dan pembaruan kami.</p>
              </div>
              <!-- Form -->
              <div class="footer-form">
                <div id="mc_embed_signup">
                  <form target="_blank" action="https://spondonit.us12.list-manage.com/subscribe/post?u=1462626880ade1ac87bd9c93a&amp;id=92a4423d01" method="get" class="subscribe_form relative mail_part">
                    <input type="email" name="email" id="newsletter-form-email" placeholder="Email Address" class="placeholder hide-on-focus" onfocus="this.placeholder = ''" onblur="this.placeholder = ' Email Address '" />
                    <div class="form-icon">
                      <!-- <button type="submit" name="submit" id="newsletter-submit"
                                             class="email_icon newsletter-submit button-contactForm"><img src="assets/img/icon/form.png" alt=""></button> -->
                    </div>
                    <div class="mt-10 info"></div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--  -->
      <div class="row footer-wejed justify-content-between">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
          <!-- logo -->
          <div class="footer-logo mb-20">
            <a href="index.html"><img src="<?php echo base_url() . $s->stp_logo ?>" style="filter: brightness(0) invert(1);" alt="" /></a>
          </div>
          <div class="footer-tittle-bottom">
            <span><?php echo $s->stp_pemilik; ?></span>
            <p>
              <?php echo $s->stp_alamat; ?>
            </p>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
          <div class="footer-tittle-bottom">
            <span>5000+</span>
            <p>Pencari Kerja</p>
          </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
          <!-- Footer Bottom Tittle -->
          <div class="footer-tittle-bottom">
            <span>568</span>
            <p>Perusahaan Terdaftar</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- footer-bottom area -->
  <div class="footer-bottom-area footer-ba">
    <div class="container">
      <div class="footer-border">
        <div class="row d-flex justify-content-between align-items-center">
          <div class="col-xl-8 col-lg-8">
            <div class="footer-copy-right">
              <p>
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                Copyright <?php echo  $s->stp_nama; ?> &copy;
                <script>
                  document.write(new Date().getFullYear());
                </script>
                All rights reserved
                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
              </p>
            </div>
          </div>
          <div class="col-xl-4 col-lg-4">
            <div class="footer-social text-white f-right">
              <a href="<?= base_url(); ?>landing/en" class="btn btn-xs btn-white">Bahasa English</a>
              <?php if ($s->stp_facebook != '') : ?>
                <a href="<?php echo $s->stp_facebook ?>" target="_blank"><i class="fab fa-facebook-f fa-3x"></i></a>
              <?php endif ?>
              <?php if ($s->stp_instagram != '') : ?>

                <a href="<?php echo $s->stp_instagram ?>" target="_blank"><i class="fab fa-instagram fa-3x"></i></a>
              <?php endif ?>
              <?php if ($s->stp_website != '') : ?>

                <a href="<?php echo $s->stp_website ?>" target="_blank"><i class="fas fa-globe fa-3x"></i></a>
              <?php endif ?>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- Footer End-->
</footer>