<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Solo Technopark - Admin Panel</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>assets_admin/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-danger" style="background-image: url('<?php echo  base_url(); ?>assets/img/background.svg');background-size: stretch;background-position: center;background-repeat: no-repeat;">

  <div class="container mt-5" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">
    <!-- Outer Row -->
    <div class="row justify-content-center mt-5 align-items-center">
      <div class="col-xl-12 col-lg-12 col-md-12 mt-5">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-7" style="background-image: url('<?php echo  base_url(); ?>assets_admin/img/solo.jpeg');background-size: cover;background-position: center;background-repeat: no-repeat;"></div>
              <?php foreach ($stp as $key) : ?>
                <div class="col-lg-5">
                  <div class="p-4">
                    <div class="text-center mt-2">
                      <img src="<?php echo base_url() . $key->stp_logo ?>" style="max-height: 100px">
                      <br>
                      <br>
                      <br>
                      <h4 class=" text-gray-900 mb-4"><?php echo $key->stp_pemilik . " - " . $key->stp_nama; ?></h4>
                    </div>
                    <form class="user" method="post" action="<?php echo base_url('admin/cek_login') ?>" id="form_login">
                      <div class="form-group">
                        <input type="email" class="form-control form-control-user" name="user_email" id="user_email" aria-describedby="emailHelp" placeholder="Enter Email Address..." autocomplete="off">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control form-control-user" name="user_password" name="user_password" placeholder="Password">
                      </div>
                      <hr>
                      <div class="btn-group w-100 mb-2">
                        <a href="<?php echo base_url() ?>" class="btn btn-danger rounded mr-2">
                          Kembali
                        </a>

                        <button type="submit" class="btn btn-primary">
                          Login
                        </button>
                      </div>
                      <br>


                    </form>
                  </div>
                </div>

              <?php endforeach ?>

            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url() ?>assets_admin/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url() ?>assets_admin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url() ?>assets_admin/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url() ?>assets_admin/js/sb-admin-2.min.js"></script>
  <script src="<?php echo base_url() ?>assets/js/sweetalert2.all.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      const notif = $('.container').data('title');
      if (notif) {
        Swal.fire({
          title: notif,
          html: $('.container').data('text'),
          icon: $('.container').data('icon'),
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.close();
          }
        });
      }
    });
  </script>

</body>

</html>