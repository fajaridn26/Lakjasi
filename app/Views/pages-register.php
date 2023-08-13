<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Daftar Akun - Lakjasi</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('assets/img/favicon.png') ?>" rel="icon">
  <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="<?= base_url('assets/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/quill/quill.snow.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/quill/quill.bubble.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/simple-datatables/style.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
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
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  <img src="<?= base_url('assets/img/logo.png') ?>" alt="">
                  <span class="d-none d-lg-block">Lakjasi</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Daftar Akun</h5>
                    <p class="text-center small">Masukkan detail pribadi untuk akun anda</p>
                  </div>

                  <!-- Alert -->
                  <?php if (session()->get('register')) : ?>
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                      <strong>Berhasil !</strong>
                      <?= session()->getFlashdata('register') ?>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php endif; ?>

                  <form method="post" action="<?= base_url('AuthenticationController/Register'); ?>" class="row g-3 needs-validation" novalidate>
                    <!-- nama -->
                    <div class="col-12">
                      <label for="nama" class="form-label">Nama</label>
                      <input type="text" name="nama" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">Silahkan masukkan nama anda!</div>
                    </div>
                    <!-- email -->
                    <div class="col-12">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="yourEmail" required>
                      <div class="invalid-feedback">Silahkan isi alamat email anda!</div>
                    </div>
                    <!-- tanggallahir -->
                    <div class="col-12">
                      <label for="inputDate" class="col-form-label">Tanggal Lahir</label>
                      <input type="date" name="tanggallahir" class="form-control" required>
                      <div class="invalid-feedback">Silahkan isi tanggal lahir anda!</div>
                    </div>
                    <!-- whatsapp -->
                    <div class="col-12">
                      <label for="yourNumber" class="form-label">No Whatsapp</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="kodeNegara">+62</span>
                        <input type="tel" name="whatsapp" class="form-control" id="whatsapp" placeholder="81912345678" required>
                        <div class="invalid-feedback">Silahkan isi nomer whatsapp anda!</div>
                      </div>
                    </div>
                    <!-- password -->
                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <div class="input-group has-validation">
                        <input type="password" name="password" class="form-control" id="yourPassword" required>
                        <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-eye" style="color: #5A5A5A;" aria-hidden="true" id="eye" onclick="toogle()"></i></span>
                        <div class="invalid-feedback">Masukkan password anda!</div>
                      </div>
                    </div>
                    <!-- button buat akun -->
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit">Buat Akun</button>
                    </div>
                    <!-- link redirect ke login -->
                    <div class="col-12">
                      <p class="small mb-0">Sudah mempunyai akun? <a href="<?= base_url('PagesController/Login') ?>">Masuk</a></p>
                    </div>
                  </form>
                </div>
              </div>

              <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
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
  <script src="<?= base_url('assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/chart.js/chart.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/echarts/echarts.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/quill/quill.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/simple-datatables/simple-datatables.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/php-email-form/validate.js') ?>"></script>
  <script src="<?= base_url('assets/js/main.js') ?>"></script>

</body>

</html>