<?= $this->extend('Template/index'); ?>
<?= $this->section('content'); ?>

<main id="main" class="main">

  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?= base_url('PagesController/dashboard') ?>">Beranda</a></li>
        <li class="breadcrumb-item">Users</li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

            <img src="<?= base_url('assets/img/default.jpg') ?>" alt="Profile" class="rounded-circle">
            <h2><?= session()->get('nama'); ?></h2>
            <h3><?= (session()->get('role') == 1) ? "Admin" : "User" ?></h3>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                  Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change
                  Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form method="post" action="<?= base_url('AuthenticationController/updateprofile'); ?>">
                  <!-- Alert -->
                  <?php if (session()->get('UpdateProfile')) : ?>
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                      <strong>Berhasil !</strong>
                      <?= session()->getFlashdata('UpdateProfile') ?>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php endif; ?>

                  <div class="row mb-3">
                    <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="nama" type="text" class="form-control" id="nama" value="<?= htmlspecialchars(session()->get('nama')) ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="text" class="form-control" id="email" value="<?= htmlspecialchars(session()->get('email')) ?>">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                  </div>
                </form><!-- End Profile Edit Form -->

              </div>

              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form method="post" action="<?= base_url('AuthenticationController/updatepass/'); ?>">
                  <!-- Alert -->
                  <?php if (session()->get('ChangePass')) : ?>
                    <div class="alert alert-success bg-success text-light border-0 alert-dismissible fade show" role="alert">
                      <strong>Berhasil !</strong>
                      <?= session()->getFlashdata('ChangePass') ?>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  <?php elseif (session()->get('Pass')) : ?>
                    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                      <strong>Gagal !</strong>
                      <?= session()->getFlashdata('Pass') ?>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                      </button>
                    </div>
                  <?php endif; ?>

                  <?php if (session()->get('KonfirmPass')) : ?>
                    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert">
                      <strong>Gagal !</strong>
                      <?= session()->getFlashdata('KonfirmPass') ?>
                      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
                      </button>
                    </div>
                  <?php endif; ?>

                  <div class="row mb-3">
                    <label for="passwordLama" class="col-md-4 col-lg-3 col-form-label">Password Lama</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="passwordlama" type="password" class="form-control" id="passwordLama" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="passwordBaru" class="col-md-4 col-lg-3 col-form-label">Password Baru</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="passwordbaru" type="password" class="form-control" id="passwordBaru" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="konfirmasipasswordBaru" class="col-md-4 col-lg-3 col-form-label">Konfirmasi Password
                      Baru</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="konfirmasipasswordbaru" type="password" class="form-control" id="konfirmasipasswordBaru" required>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Simpan Password</button>
                  </div>
                </form><!-- End Change Password Form -->

              </div>

            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>

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

<?= $this->endSection(); ?>