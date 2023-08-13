<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Data Pelaporan</h1>
    <div class="swal" data-swal="<?= session()->getFlashData('DataPelapor'); ?>"></div>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('PagesController/dashboard') ?>">Beranda</a></li>
        <li class="breadcrumb-item">Data Pelapor</li>
        <li class="breadcrumb-item active">Data Pelaporan Kerusakan</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <?php if (session()->getFlashdata('Formsukses')) : ?>
    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
      <strong><?= esc(session()->getFlashdata('Formsukses')) ?></strong>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif ?>

  <?php if (session()->getFlashdata('Formgagal')) : ?>
    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
      <strong><?= esc(session()->getFlashdata('Formgagal')) ?></strong>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif ?>

  <!-- Modal Cetak Data Laporan  -->
  <div style="z-index:99999;" class="modal fade" id="basicModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Cetak Data Laporan</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="<?= base_url('PagesController/printpdf'); ?>" method="post">
          <div class="modal-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div class="form-group col-md-5">
                <label for="inputDate" class="col-form-label">Pilih Tanggal Awal</label>
                <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control">
              </div>

              <div class="form-group col-md-5">
                <label for="inputDate" class="col-form-label">Pilih Tanggal Akhir</label>
                <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary">Cetak Data</button>
          </div>
        </form>
      </div>
    </div>
  </div><!-- End Modal Cetak Data Laporan-->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <div class="card-header">
              <div class="d-flex justify-content-between align-items-center mb-3">

                <h5 class="card-title">Data Pelaporan Warga Terkait Kerusakan Jalan</h5>
                <div>
                  <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#basicModal">Cetak Data Laporan</button>
                </div>
              </div>

              <!-- Bordered Table -->
              <div class="table-responsive">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th scope="col">No</th>
                      <th scope="col">Nama</th>
                      <th scope="col">Lokasi Jalan</th>
                      <th scope="col">Tanggal Pelaporan</th>
                      <th scope="col">Foto</th>
                      <th scope="col">Tingkat Kerusakan</th>
                      <th scope="col">Keterangan</th>
                      <th scope="col">Status</th>
                      <th scope="col">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($pelaporan as $key => $value) : ?>
                      <tr>
                        <th scope="row"><?= $key = $key + 1 ?></th>
                        <td><?= $value['nama'] ?></td>
                        <td><a href="https://www.google.com/maps/place/<?= $value['lat'] ?> , <?= $value['long'] ?>" target="_blank"><?= $value['lat'] ?>
                            , <?= $value['long'] ?></a></td>
                        <td><?= date('d-M-Y h:i A', strtotime($value['tanggal_pelaporan'])); ?></td>
                        <td>
                          <a href="#" id="<?= base_url(); ?>/assets/imagePelaporan/<?= $value['foto'] ?>" data-bs-toggle="modal" class="btnfoto">Lihat
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
                                  <button id="<?= esc($value['lokasifoto']) ?>" type="button" class="btn btn-primary btnceklokasi">Cek Lokasi Foto</button>
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                              </div>
                            </div>
                          </div><!-- End Large Modal-->
                        </td>
                        <td>
                          <div class="dropdown">
                            <?php if (esc($value['tingkat_rusak']) === "Tidak Rusak") : ?>
                              <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Tidak Rusak
                              </button>
                            <?php elseif (esc($value['tingkat_rusak']) === "Rusak Ringan") : ?>
                              <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Rusak Ringan
                              </button>
                            <?php elseif (esc($value['tingkat_rusak']) === "Rusak Sedang") : ?>
                              <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Rusak Sedang
                              </button>
                            <?php elseif (esc($value['tingkat_rusak']) === "Rusak Berat") : ?>
                              <button class="btn btn-sm btn-danger dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Rusak Berat
                              </button>
                            <?php else : ?>
                              <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Pilih Kerusakan
                              </button>
                            <?php endif ?>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                              <li><a href="<?= base_url(); ?>/TingkatKerusakan/UpdateTidakRusak/<?= $value['id_laporan']; ?>" class="dropdown-item btn-sm" type="button">0 - Tidak Rusak</a></li>
                              <li><a href="<?= base_url(); ?>/TingkatKerusakan/UpdateRusakRingan/<?= $value['id_laporan']; ?>" class="dropdown-item btn-sm" type="button">1 - Rusak Ringan</a></li>
                              <li><a href="<?= base_url(); ?>/TingkatKerusakan/UpdateRusakSedang/<?= $value['id_laporan']; ?>" class="dropdown-item btn-sm" type="button">2 - Rusak Sedang</a></li>
                              <li><a href="<?= base_url(); ?>/TingkatKerusakan/UpdateRusakBerat/<?= $value['id_laporan']; ?>" class="dropdown-item btn-sm" type="button">3 - Rusak Berat</a></li>
                            </ul>
                        </td>
                        <td><?= $value['keterangan'] ?></td>
                        <td>
                          <div class="dropdown">
                            <?php if (esc($value['status_pelaporan']) === "Laporan Telah Dikirim") : ?>
                              <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Laporan Baru
                              </button>
                            <?php elseif (esc($value['status_pelaporan']) === "Laporan Diterima") : ?>
                              <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Laporan Diterima
                              </button>
                            <?php elseif (esc($value['status_pelaporan']) === "Laporan Ditolak") : ?>
                              <button class="btn btn-sm btn-danger dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Laporan Ditolak
                              </button>
                            <?php elseif (esc($value['status_pelaporan']) === "Menunggu Proses Perbaikan Jalan") : ?>
                              <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Menunggu Proses
                              </button>
                            <?php elseif (esc($value['status_pelaporan']) === "Jalan Dalam Proses Perbaikan") : ?>
                              <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Dalam Proses
                              </button>
                            <?php elseif (esc($value['status_pelaporan']) === "Jalan Sudah Selesai Dalam Proses Perbaikan") : ?>
                              <button class="btn btn-sm btn-success dropdown-toggle" type="button" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
                                Sudah Selesai
                              </button>
                            <?php endif ?>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
                              <li><a href="<?= base_url(); ?>/StatusPelaporan/UpdateDitolak/<?= $value['id_laporan']; ?>" class="dropdown-item btn-sm" type="button">0 - Laporan Ditolak</a></li>
                              <li><a href="<?= base_url(); ?>/StatusPelaporan/UpdateDiterima/<?= $value['id_laporan']; ?>" class="dropdown-item btn-sm" type="button">1 - Laporan Diterima</a></li>
                              <li><a href="<?= base_url(); ?>/StatusPelaporan/UpdateMenunggu/<?= $value['id_laporan']; ?>" class="dropdown-item btn-sm" type="button">2 - Menunggu Proses</a></li>
                              <li><a href="<?= base_url(); ?>/StatusPelaporan/UpdateProses/<?= $value['id_laporan']; ?>" class="dropdown-item btn-sm" type="button">3 - Dalam Proses</a></li>
                              <li><a href="<?= base_url(); ?>/StatusPelaporan/UpdateSelesai/<?= $value['id_laporan']; ?>" class="dropdown-item btn-sm" type="button">4 - Sudah Selesai</a></li>
                            </ul>
                          </div>
                        </td>
                        <td>
                          <button id="<?= $value['id_laporan']; ?>" type="submit" class="btn btn-danger delete"><i class="bi bi-trash"></i></button>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- End Bordered Table -->

            </div>
          </div>

        </div>
      </div>
  </section>

</main><!-- End #main -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
  $(".btnfoto").on("click", function() {
    var id = $(this).attr("id");
    document.getElementById('img').src = id;
    $('#largeModal').modal("show");
  });

  $(".btnceklokasi").on("click", function() {
    var lokasi = $(this).attr("id");
    window.open('https://www.google.com/maps/place/' + lokasi, '_blank');
  });

  $(document).on('click', '.delete', function(e) {
    var id = $(this).attr('id');
    var link = "<?= base_url() ?>/AuthenticationController/hapusdataPelapor/" + id;
    Swal.fire({
      title: 'Apakah Anda Yakin?',
      text: "Data Pelaporan Akan Dihapus!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus Data!'
    }).then((result) => {
      if (result.isConfirmed) {
        document.location.href = link;
      }
    })
  });
</script>

<?= $this->endSection(); ?>