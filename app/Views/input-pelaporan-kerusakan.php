<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">
  <div class="pagetitle">
    <h1>Pelaporan</h1>
    <nav>
      <ol class="breadcrumb">
        <?php if (session()->get('role') == 1) : ?>
          <li class="breadcrumb-item"><a href="<?= base_url('PagesController/dashboard') ?>">Beranda</a></li>
        <?php endif ?>
        <li class="breadcrumb-item">Pelaporan</li>
        <li class="breadcrumb-item active">Input Pelaporan Kerusakan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <?php if (session()->get('sukses')) : ?>
    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
      <strong><?= session()->getFlashdata('sukses'); ?></strong>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php elseif (session()->get('fail')) : ?>
    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
      <strong><?= session()->getFlashdata('fail'); ?></strong>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php elseif (session()->get('require')) : ?>
    <div class="alert alert-info bg-info text-light border-0 alert-dismissible fade show" role="alert">
      <strong><?= session()->getFlashdata('require') ?></strong>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php elseif (session()->get('anonymous')) : ?>
    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
      <strong><?= session()->getFlashdata('anonymous') ?></strong>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php elseif (session()->get('eror')) : ?>
    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
      <strong><?= session()->getFlashdata('eror') ?></strong>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif ?>

  <section class="section">
    <div class="row">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Form Pelaporan Kerusakan Jalan</h5>
          <!-- General Form Elements -->
          <form method="post" action="<?= base_url('InputPelaporanController/save'); ?>" enctype="multipart/form-data">
            <div class="hide">
              <label for="inputDate" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="text" value="<?= session()->get('nama'); ?>" class="form-control" name="nama" required>
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputLokasi" class="col-sm-2 col-form-label">Lokasi Jalan</label>
              <div class="col-sm-10">
                <!-- View Map -->
                <div id="map"></div>
                <div class="hide">
                  <input type="text" id="lat" name="lat">
                  <input type="text" id="long" name="long">
                </div>
                <!-- End View Map -->
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputGambar" class="col-sm-2 col-form-label">Ambil Foto</label>
              <div class="col-sm-10">
                <input class="form-control" type="file" capture="camera" size="20" id="formFile" name="foto" required on>
              </div>
            </div>
            <div class="row mb-3 text-center" id="ceklokasifoto">
            </div>
            <div class="row mb-3">
              <label for="inputDate" class="col-sm-2 col-form-label">Tanggal Laporan</label>
              <div class="col-sm-10">
                <input type="datetime-local" class="form-control" name="tanggal" required accept="image/*">
              </div>
            </div>
            <div class="row mb-3">
              <label for="inputKeterangan" class="col-sm-2 col-form-label">Keterangan Jalan Rusak <span style="color:darkgrey;">(Opsional)</span></label>
              <div class="col-sm-10">
                <textarea class="form-control" style="height: 100px" name="keterangan" placeholder="Ketika hujan deras, lubang pada jalan ini penuh dengan genangan air"></textarea>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-sm-3">
                <button type="submit" class="btn btn-primary">Submit Form</button>
              </div>
            </div>
          </form><!-- End General Form Elements -->

  </section>
</main><!-- End #main -->

<script>
  var map = L.map('map').setView([-7.4552268, 112.6574263], 11);

  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

  L.control.locate().addTo(map);
</script>
<script src="https://cdn.jsdelivr.net/npm/exif-js"></script>
<script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4=" crossorigin="anonymous"></script>
<script>
  $(document).ready(function() {
    $('.leaflet-control-locate-location-arrow').trigger('click');
  });
  var lokasi = "";
  var fileInput = document.getElementById("formFile");
  fileInput.onchange = () => {
    const selectedFile = fileInput.files[0];
    EXIF.getData(selectedFile, function() {
      try {
        var lat = EXIF.getTag(this, "GPSLatitude");
        var GPSLatitudeRef = EXIF.getTag(this, "GPSLatitudeRef");
        var GPSLongitudeRef = EXIF.getTag(this, "GPSLongitudeRef");
        var long = EXIF.getTag(this, "GPSLongitude");
        lokasi = lat[0] + "°" + lat[1] + "'" + lat[2] + '&quot;' + GPSLatitudeRef + "," + long[0] + "°" + long[1] + "'" + long[2] + '&quot;' + GPSLongitudeRef;
        document.getElementById('ceklokasifoto').innerHTML =
          `<button type="button" class="btn btn-primary" onclick="cek()">Cek Lokasi Foto</button>
          <input id="lokfoto" type="hidden" name="lokasifoto" value="${lokasi}">`;
      } catch (error) {
        var $el = $('#formFile');
        $el.wrap('<form>').closest(
          'form').get(0).reset();
        $el.unwrap();
        lokasi = "";
        alert('Gambar Harus Mengandung Data Lokasi!');
        document.getElementById('ceklokasifoto').innerHTML = ``;
      }
    });
  }

  function cek() {
    var lokasifoto = document.getElementById('lokfoto').value;
    window.open('https://www.google.com/maps/place/' + lokasifoto, '_blank');
  }
</script>

<?= $this->endSection(); ?>