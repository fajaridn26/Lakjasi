<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Dashboard</h1>
    <h5 class="card-title">Selamat Datang di Website Pelaporan Kerusakan Jalan Kabupaten Sidoarjo</h5>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <!-- Total Pelaporan Card -->
          <div class="col-xxl-4 col-md-6 <?php echo (session()->get("role") == 2) ? "d-none" : "" ?>">
            <div class="card info-card revenue-card">

              <div class="card-body">
                <h5 class="card-title">Total Pelaporan</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bx bx-line-chart"></i>
                  </div>
                  <div class="ps-3">
                    <h6> <?= esc($totalpelaporan) ?> </h6>
                  </div>
                </div>
              </div>

            </div>
          </div><!-- Total Pelaporan Card -->

          <!-- Total Users Card -->
          <div class="col-xxl-4 col-md-6 <?php echo (session()->get("role") == 2) ? "d-none" : "" ?>">

            <div class="card info-card customers-card">

              <div class="card-body">
                <h5 class="card-title">Total Users</h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6> <?= esc($totalakun) ?> </h6>
                  </div>
                </div>

              </div>
            </div>

          </div><!-- Total Users Card -->

          <!-- Jalan Rusak Card -->
          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card customers-card">
              <div class="card-body">
                <h5 class="card-title">Lokasi Jalan Rusak Di Sekitar</h5>

                <div class="d-flex align-items-center"></div>
                <div class="ps-3">
                  <!-- View Map -->
                  <div id="map" style="width: 95%;"></div>
                  <br>
                  <div class="tingkat-rusak">
                    <label for="tingkat-rusak-label">
                      <td>
                        <img src="<?= base_url('assets/img/marker-blue.png') ?>" style="width: 5%" alt="">
                      </td>
                      Rusak Ringan
                      <td>
                        <img src="<?= base_url('assets/img/marker-green.png') ?>" style="width: 5%" alt="">
                      </td>
                      Rusak Sedang
                      <td>
                        <img src="<?= base_url('assets/img/marker-red.png') ?>" style="width: 5%" alt="">
                      </td>
                      Rusak Berat
                    </label>
                  </div>
                  <!-- End View Map -->
                </div>
              </div>

            </div>
          </div>

        </div><!-- End Customers Card -->

      </div>
    </div><!-- End Left side columns -->

  </section>

</main><!-- End #main -->

<script>
  var map = L.map('map').setView([-7.4552268, 112.6574263], 11);
  L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);
  L.control.locate().addTo(map);

  const LeafIcon = L.Icon.extend({
    options: {
      iconSize: [18, 25],
      iconAnchor: [12, 24],
      popupAnchor: [-3, -76]
    }
  });
  const greenIcon = new LeafIcon({
    iconUrl: '<?= base_url('assets/img/marker-green.png') ?>'
  });
  const blueIcon = new LeafIcon({
    iconUrl: '<?= base_url('assets/img/marker-blue.png') ?>'
  });
  const redIcon = new LeafIcon({
    iconUrl: '<?= base_url('assets/img/marker-red.png') ?>'
  });
  <?php foreach ($lokasi as $key => $value) : ?>
    L.marker([<?= $value['lat'] ?>, <?= $value['long'] ?>], {
        icon: <?php if ($value['tingkat_rusak'] == "Rusak Sedang") {
                echo "greenIcon";
              } elseif ($value['tingkat_rusak'] == "Rusak Berat") {
                echo "redIcon";
              } else {
                echo "blueIcon";
              } {
              } ?>
      }).addTo(map)
      .bindPopup('<img id="img" src="<?= base_url(); ?>/assets/imagePelaporan/<?= $value['foto'] ?>" alt="" width="100%" height="100%">')
      .closePopup();
  <?php endforeach; ?>
</script>

<?= $this->endSection(); ?>