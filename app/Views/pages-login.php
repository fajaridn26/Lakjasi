<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Masuk - Lakjasi</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('assets/img/favicon.png'); ?>" rel="icon">
  <link href="<?= base_url('assets/img/apple-touch-icon.png'); ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/quill/quill.snow.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/quill/quill.bubble.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/remixicon/remixicon.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/simple-datatables/style.css'); ?>" rel="stylesheet">
  <link href="<?= base_url('assets/css/style.css'); ?>" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet">
</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="" class="logo d-flex align-items-center w-auto">
                  <img src="<?= base_url('assets/img/logo.png') ?>" alt="">
                  <span class="d-none d-lg-block">Lakjasi</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Masuk ke akun anda</h5>
                    <p class="text-center small">Masukkan email dan password anda</p>
                  </div>

                  <!-- Alert -->
                  <?php if (session()->get('login')) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                      <?= session()->getFlashdata('login') ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <?php endif; ?>

                  <?php if (session()->get('loginsave')) : ?>
                    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                      <strong>Gagal !</strong>
                      <?= session()->getFlashdata('loginsave') ?>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php endif; ?>
                  <!-- Alert -->

                  <form method="post" action="<?= base_url('AuthenticationController/Login'); ?>" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourEmail" class="form-label">Email</label>
                      <div class="input-group has-validation">
                        <input type="text" name="email" class="form-control" id="yourEmail" required>
                        <div class="invalid-feedback">Masukkan email anda!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <div class="input-group has-validation">
                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                        <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-eye" style="color: #5A5A5A;" aria-hidden="true" id="eye" onclick="toogle()"></i></span>
                        <div class="invalid-feedback">Masukkan password anda!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <div class="d-flex justify-content-between">
                        <div class="form-group">
                        </div>
                        <div class="form-group">
                          <a href="<?= base_url('PagesController/lupa_password'); ?>">Lupa Password?</a>
                        </div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">Belum mempunyai akun? <a href="<?= base_url('PagesController/register'); ?>">Buat Akun</a></p>
                    </div>
                  </form>
                </div>
              </div>

              <div class="credits">
                Designed by <a href="#">Lakjasi</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <script>
    var state = false;

    function toogle() {
      if (state) {
        document.getElementById("yourPassword").setAttribute("type", "password");
        document.getElementById("eye").style.color = '#5A5A5A';
        state = false;
      } else {
        document.getElementById("yourPassword").setAttribute("type", "text");
        document.getElementById("eye").style.color = '#5887ef';
        state = true;
      }
    }
  </script>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="<?= base_url('assets/vendor/apexcharts/apexcharts.min.js'); ?>"></script>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
  <script src="<?= base_url('assets/vendor/chart.js/chart.min.js'); ?>"></script>
  <script src="<?= base_url('assets/vendor/echarts/echarts.min.js'); ?>"></script>
  <script src="<?= base_url('assets/vendor/quill/quill.min.js'); ?>"></script>
  <script src="<?= base_url('assets/vendor/simple-datatables/simple-datatables.js'); ?>"></script>
  <script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js'); ?>"></script>
  <script src="<?= base_url('assets/vendor/php-email-form/validate.js'); ?>"></script>

  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/js/main.js'); ?>"></script>

</body>

</html>