<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?= $title ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="<?= base_url('assets/img/favicon.png') ?>" rel="icon">
  <link href="<?= base_url('assets/img/apple-touch-icon.png') ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="=<?= base_url('https://fonts.gstatic.com') ?>" rel="preconnect">
  <link href="=<?= base_url('https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i') ?>" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link href="<?= base_url('assets/vendor/bootstrap-icons/bootstrap-icons.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/boxicons/css/boxicons.min.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/quill/quill.snow.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/quill/quill.bubble.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/remixicon/remixicon.css') ?>" rel="stylesheet">
  <link href="<?= base_url('assets/vendor/simple-datatables/style.css') ?>" rel="stylesheet">
  <link rel="stylesheet" href="<?= base_url('sweetalert/sweetalert2.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('leaflet/leaflet.css') ?>" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
  <script src="<?= base_url('leaflet/leaflet.js') ?>" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
  <link rel="stylesheet" href="<?= base_url('leafletlocate/dist/L.Control.Locate.min.css') ?>" />
  <script src="<?= base_url('leafletlocate/src/L.Control.Locate.js') ?>"></script>


  <!-- Template Main CSS File -->
  <link rel="stylesheet" href="<?= base_url('assets/css/map.css') ?>">
  <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>
  <?= $this->include('Template/navheader'); ?>
  <?= $this->include('Template/sidebar'); ?>
  <?= $this->renderSection('content'); ?>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>Lakjasi</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="#">Lakjasi</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.js"></script>
  <script src="<?= base_url('assets/vendor/apexcharts/apexcharts.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/chart.js/chart.min.js') ?>">
  </script>
  <script src="<?= base_url('assets/vendor/echarts/echarts.min.js') ?>">
  </script>
  <script src="<?= base_url('assets/vendor/quill/quill.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/simple-datatables/simple-datatables.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/tinymce/tinymce.min.js') ?>"></script>
  <script src="<?= base_url('assets/vendor/php-email-form/validate.js') ?>"></script>
  <script src="<?= base_url('sweetalert/sweetalert2.all.min.js') ?>"></script>
  <script src="<?= base_url('sweetalert/myscript.js') ?>"></script>
  <!-- Template Main JS File -->
  <script src="<?= base_url('assets/js/main.js') ?>"></script>
</body>

</html>