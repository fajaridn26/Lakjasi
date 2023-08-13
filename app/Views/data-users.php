<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Users</h1>
    <div class="users" data-users="<?= session()->getFlashData('DataUsers'); ?>"></div>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('PagesController/dashboard') ?>">Beranda</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Data Users</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <?php if (session()->getFlashdata('Formgagal')) : ?>
    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
      <strong><?= esc(session()->getFlashdata('Formgagal')) ?></strong>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif ?>

  <section class="section">
    <div class="row">
      <div class="col-lg-12">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Data Akun</h5>

            <!-- Bordered Table -->
            <div class="table-responsive">
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Email</th>
                    <th scope="col">Nama</th>
                    <th scope="col">No Whatsapp</th>
                    <th scope="col">Tanggal Lahir</th>
                    <th scope="col">Role</th>
                    <th scope="col">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1 ?>
                  <?php foreach ($pelaporan as $key => $value) : ?>
                    <tr>
                      <th scope="row"><?= $i++ ?></th>
                      <td><?= $value['email_pengguna'] ?></td>
                      <td><?= $value['nama'] ?></td>
                      <td><a href="https://wa.me/<?= $value['no_whatsapp'] ?>" target="_blank"><?= $value['no_whatsapp'] ?></a></td>
                      <td><?= date('d-M-Y', strtotime($value['tanggal_lahir'])); ?></td>
                      <td><?php
                          if ($value['role'] == 1) {
                            echo '<span class="badge bg-primary">Admin</span>';
                          } else if ($value['role'] == 2) {
                            echo '<span class="badge bg-success">User</span>';
                          }
                          ?></td>
                      <td class="d-flex">
                        <!-- Basic Modal -->
                        <button type="button" class="btn btn-primary mx-2" data-bs-toggle="modal" data-bs-target="#basicModal<?= $value['id'] ?>">
                          <i class="bi bi-pencil-square"></i>
                        </button>
                        <div style="z-index:99999;" class="modal fade" id="basicModal<?= $value['id'] ?>" tabindex="-1">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Update User</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <form action="<?= base_url(); ?>/AuthenticationController/UpdateDataUser/<?= $value['id'] ?>" method="post">
                                <div class="modal-body">
                                  <div class="row mb-3">
                                    <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                    <div class="col-md-8 col-lg-9">
                                      <input name="nama" type="text" class="form-control" id="nama" value="<?= $value['nama'] ?>">
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                    <div class="col-md-8 col-lg-9">
                                      <input name="email" type="text" class="form-control" id="email" value="<?= $value['email_pengguna'] ?>">
                                    </div>
                                  </div>

                                  <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label">Role</label>
                                    <div class="col-md-8 col-lg-9">
                                      <select name="role" class="form-select" aria-label="Default select example">
                                        <option value="<?= ($value['role'] == '1' ? '1' : '2') ?>" selected>
                                          <?= ($value['role'] == '1' ? 'Admin' : 'User') ?>
                                        </option>
                                        <?php if ($value['role'] == '1') : ?>
                                          <option value="2">
                                            User
                                          </option>
                                        <?php else : ?>
                                          <option value="1">
                                            Admin
                                          </option>
                                        <?php endif ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                  <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div><!-- End Basic Modal-->
                        <button id="<?= $value['id']; ?>" type="submit" class="btn btn-danger delete"><i class="bi bi-trash"></i></button>
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
  $(document).on('click', '.delete', function(e) {
    var id = $(this).attr('id');
    var link = "<?= base_url() ?>/AuthenticationController/hapusdataUsers/" + id;
    Swal.fire({
      title: 'Apakah Anda Yakin?',
      text: "Data User Akan Dihapus!",
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