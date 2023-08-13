<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Pelaporan</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('PagesController/dashboard') ?>">Beranda</a></li>
        <li class="breadcrumb-item">Pelaporan</li>
        <li class="breadcrumb-item active">Riwayat Pelaporan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">


      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Riwayat Pelaporan Kerusakan Jalan</h5>

          <!-- Bordered Table -->
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Lokasi Jalan</th>
                  <th scope="col">Foto</th>
                  <th scope="col">Tingkat Kerusakan</th>
                  <th scope="col">Tanggal Laporan</th>
                  <th scope="col">Keterangan</th>
                  <th scope="col">Status</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($pelaporan as $key => $value) : ?>
                  <tr>
                    <th scope="row"><?= $key + 1 ?></th>
                    <td><a href="https://www.google.com/maps/place/<?= $value['lat'] ?> , <?= $value['long'] ?>" target="_blank"><?= $value['lat'] ?>
                        , <?= $value['long'] ?></a></td>
                    <td><a href="#" id="<?= base_url(); ?>/assets/imagePelaporan/<?= $value['foto'] ?>" data-bs-toggle="modal" class="btnfoto">Lihat
                        Foto
                      </a>
                      <!-- Large Modal -->
                      <div style="z-index:99999;" class="modal fade" id="largeModal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title">Foto Kerusakan Jalan</h5>
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <img id="img" src="" alt="" width="100%" height="100%">
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                            </div>
                          </div>
                        </div>
                      </div><!-- End Large Modal-->
                    </td>
                    <td><?= $value['tingkat_rusak'] ?></td>
                    <td><?= date('d-M-Y h:i A', strtotime($value['tanggal_pelaporan'])); ?></td>
                    <td><?= $value['keterangan'] ?></td>
                    <td>
                      <span class="badge bg-primary"><?= esc($value['status_pelaporan']) ?></span>
                    </td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
          <!-- End Bordered Table -->

  </section>

</main><!-- End #main -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<script>
  $(".btnfoto").on("click", function() {
    var id = $(this).attr("id");
    document.getElementById('img').src = id;
    $('#largeModal').modal("show");
  });
</script>
<?= $this->endSection(); ?>