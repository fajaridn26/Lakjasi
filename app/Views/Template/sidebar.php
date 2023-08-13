<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar" style="z-index: 1500;">

  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= base_url('PagesController/dashboard') ?>">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Pelaporan</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= base_url('PagesController/input_pelaporan') ?>">
            <i class="bi bi-circle"></i><span>Input Pelaporan Kerusakan</span>
          </a>
          <a href="<?= base_url('PagesController/riwayat_pelaporan') ?>">
            <i class="bi bi-circle"></i><span>Riwayat Pelaporan</span>
          </a>
        </li>
      </ul>
    </li><!-- End Forms Nav -->

    <li class="nav-item <?php echo (session()->get("role") == 2) ? "d-none" : "" ?>">
      <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-layout-text-window-reverse"></i><span>Data Pelapor</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

        <li>
          <a href="<?= base_url('PagesController/data_pelaporan') ?>">
            <i class="bi bi-circle"></i><span>Data Pelaporan Kerusakan</span>
          </a>
        </li>
      </ul>
    </li>

    <li class="nav-item <?php echo (session()->get("role") == 2) ? "d-none" : "" ?>">
      <a class="nav-link collapsed" data-bs-target="#users-nav" data-bs-toggle="collapse" href="">
        <i class="bi bi-people"></i><span>Users</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="users-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li>
          <a href="<?= base_url('PagesController/data_users') ?>">
            <i class="bi bi-circle"></i><span>Data Users</span>
          </a>
        </li>
      </ul>
    </li><!-- End Users Nav -->

    <li class="nav-heading">Pages</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="<?= base_url('PagesController/users_profile') ?>">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li><!-- End Profile Page Nav -->

  </ul>

</aside>End Sidebar