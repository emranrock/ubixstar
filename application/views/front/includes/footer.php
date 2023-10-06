  <?php
    if ($general_setting->num_rows() > 0) {
        foreach ($general_setting->result() as $key => $value) {
            $tel = $value->number;
            $address = $value->address;
            $email = $value->email;
            $name = $value->name;
            $social_links = json_decode($value->social_links, true);
        }
    }
    ?>
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

      <div class="container">
          <div class="row gy-3">
              <div class="col-lg-3 col-md-6 d-flex">
                  <i class="bi bi-geo-alt icon"></i>
                  <div>
                      <h4>Address</h4>
                      <p>
                          <?= $address ?>
                      </p>
                  </div>

              </div>

              <div class="col-lg-3 col-md-6 footer-links d-flex">
                  <i class="bi bi-telephone icon"></i>
                  <div>
                      <h4>Reservations</h4>
                      <p>
                          <strong>Phone:</strong> <?= $tel ?><br>
                          <strong>Email:</strong> <?= $email ?><br>
                      </p>
                  </div>
              </div>

              <div class="col-lg-3 col-md-6 footer-links d-flex">
                  <i class="bi bi-clock icon"></i>
                  <div>
                      <h4>Opening Hours</h4>
                      <p>
                          <strong>Mon-Sat: 11AM</strong> - 23PM<br>
                          Sunday: Closed
                      </p>
                  </div>
              </div>

              <div class="col-lg-3 col-md-6 footer-links">
                  <h4>Follow Us</h4>
                  <div class="social-links d-flex">
                      <?php
                        foreach ($social_links as $key => $val) { ?>
                          <a href="<?= $val ?>" class="twitter"><i class="bi bi-<?= $key ?>"></i></a>

                      <?php } ?>

                  </div>
              </div>

          </div>
      </div>

      <div class="container">
          <div class="copyright">
              &copy; Copyright <strong><span>Yummy</span></strong>. All Rights Reserved
          </div>
          <div class="credits">
              <!-- All the links in the footer should remain intact. -->
              <!-- You can delete the links only if you purchased the pro version. -->
              <!-- Licensing information: https://bootstrapmade.com/license/ -->
              <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
              Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
          </div>
      </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- <div id="preloader"></div> -->

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/front/vendor/aos/aos.js') ?>"></script>
  <script src="<?= base_url('assets/front/vendor/glightbox/js/glightbox.min.js') ?>"></script>
  <script src="<?= base_url('assets/front/vendor/purecounter/purecounter_vanilla.js') ?>"></script>
  <script src="<?= base_url('assets/front/vendor/swiper/swiper-bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/front/vendor/php-email-form/validate.js') ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/front/js/main.js') ?>"></script>
  <script>
      $(document).ready(function() {
          $("#searchFrm").submit(function(e) {
              e.preventDefault();
              var frm = $(this).serialize();
              console.log(frm);
              load_list(frm, 'form');
          })
          load_list("", null);

          $("#category_filter").on("change", function(e) {
              var cat = $(this).val();
              load_list(cat, 'filter_cat');
          });
          $("#tag_filter").on("change", function(e) {
              var tags = $(this).val();
              load_list(tags, 'filter_tag');
          });
      });

      function load_list(data, type) {
          if (type == 'form') {
              data == ' ' ? data : ''
          } else if (type == 'filter_cat') {
              data = 'filter_cat=' + data
          } else if (type == 'filter_tag') {
              data = 'filter_tag=' + data
          } else {
              data = '';
          }
          console.log(data);
          $.ajax({
              url: baseUrl + 'home/list',
              type: "post",
              data: data,
              beforeSend: function(data) {
                  console.log('here');
              },
              success: function(data) {
                  $("#recipe_list").html(data);
              },
              error: function(err) {
                  console.log(err);
              },
              complete: function(data) {
                  console.log('done ');
              }
          });
      }
  </script>
  </body>

  </html>