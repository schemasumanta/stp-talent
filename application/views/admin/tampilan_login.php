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
  <link
  href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
  rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url() ?>assets_admin/css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

  <div class="container" data-title="<?php echo $this->session->flashdata('title'); ?>" data-text="<?php echo $this->session->flashdata('text'); ?>" data-icon="<?php echo $this->session->flashdata('icon'); ?>">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9 my-5">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <form method="post" action="<?php echo base_url('admin/cek_login') ?>" id="form_login">

            <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                <div class="col-lg-6">
                  <div class="p-5">
                    <div class="text-center">
                      <h1 class="h4 text-gray-900 mb-4">Solo Technopark - Talent Hub</h1>
                    </div>
                    <form class="user">
                      <div class="form-group">
                        <input type="email" class="form-control form-control-user"
                        id="user_email" name="user_email" aria-describedby="emailHelp"
                        placeholder="Enter Email Address..." autocomplete="off">
                      </div>
                      <div class="form-group">
                        <input type="password" class="form-control form-control-user"
                        id="user_password" name="user_password" placeholder="Password">
                      </div>
                      <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                      </button>
                       <a href="<?php echo base_url() ?>" class="btn btn-danger btn-user btn-block">
                        Batal
                      </a>
                    </form>
                    <hr>
                    <div class="text-center">
                      <a class="small" href="javascript:;" id="lupa_password">Forgot Password?</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>

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
   $(document).ready(function(){
    const notif = $('.container').data('title');
    if (notif) {
      Swal.fire({
        title:notif,
        html:$('.container').data('text'),
        icon:$('.container').data('icon'),
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