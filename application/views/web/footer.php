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
                <h4>About Us</h4>
                <div class="footer-pera">
                  <p>
                    As an integrated group, our strategies are designed to
                    meet the challenges of today and tomorrow. Combining
                    values in order to build competitive solutions tailored
                    to meet each customer needs.
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
          <div class="single-footer-caption mb-50">
            <div class="footer-tittle">
              <h4>Contact Info</h4>
              <ul>
                <li>
                  <p></p>
                </li>
                <li><a href="#">Phone : +62 21 39717888 </a></li>
                <li>
                  <a href="#">Email : marketing.communication@infracom-tech.com</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
          <div class="single-footer-caption mb-50">
            <div class="footer-tittle">
              <h4>Important Link</h4>
              <ul>
                <li><a href="#"> View Project</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Testimonial</a></li>
                <li><a href="#">Properties</a></li>
                <li><a href="#">Supports</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
          <div class="single-footer-caption mb-50">
            <div class="footer-tittle">
              <h4>Newsletter</h4>
              <div class="footer-pera footer-pera2">
                <p>Subscribe to our newsletters and updates.</p>
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
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
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
            <p>Talented Hunter</p>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
          <div class="footer-tittle-bottom">
            <span>451</span>
            <p>Talented Hunter</p>
          </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5">
          <!-- Footer Bottom Tittle -->
          <div class="footer-tittle-bottom">
            <span>568</span>
            <p>Talented Hunter</p>
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
          <div class="col-xl-10 col-lg-10">
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
          <div class="col-xl-2 col-lg-2">
            <div class="footer-social f-right">
              <a href="<?php echo $s->stp_facebook ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
              <a href="<?php echo $s->stp_instagram ?>" target="_blank"><i class="fab fa-instagram"></i></a>
              <a href="<?php echo $s->stp_website ?>" target="_blank"><i class="fas fa-globe"></i></a>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- Footer End-->
</footer>