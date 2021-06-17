<?php 
if ($_SESSION['ipt_level'] == "superadmin") { ?>
<ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon">
      <img src="img/logo/logo1.png">
    </div>
    <div class="sidebar-brand-text mx-3">InputNilai</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    DATA MASTER
  </div>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("data_admin")); ?>">
      <i class="fas fa-fw fa-folder"></i>
      <span>Data Admin</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    DATA NILAI
  </div>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("input_nilai")); ?>">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Input Nilai</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("input_nilai2")); ?>">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Input Nilai 2</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("edit_nilai")); ?>">
      <i class="fas fa-fw fa-edit"></i>
      <span>Edit Nilai</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("cek_nilai")); ?>">
      <i class="fas fa-fw fa-check-square"></i>
      <span>Cek Nilai</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("input_nilai_akhir")); ?>">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Input Nilai Akhir</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("edit_nilai_akhir")); ?>">
      <i class="fas fa-fw fa-edit"></i>
      <span>Edit Nilai Akhir</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("nilai_akhir")); ?>">
      <i class="fas fa-fw fa-file"></i>
      <span>Nilai Akhir</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("export_nilai")); ?>">
      <i class="fas fa-fw fa-file-excel"></i>
      <span>Export Nilai</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    LOGOUT
  </div>
  <li class="nav-item">
    <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </li>
</ul>
<?php
}elseif ($_SESSION['ipt_level'] == "admin") { ?>
  <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon">
      <img src="img/logo/logo1.png">
    </div>
    <div class="sidebar-brand-text mx-3">InputNilai</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    DATA NILAI
  </div>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("input_nilai")); ?>">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Input Nilai</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("input_nilai2")); ?>">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Input Nilai 2</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("edit_nilai")); ?>">
      <i class="fas fa-fw fa-edit"></i>
      <span>Edit Nilai</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("cek_nilai")); ?>">
      <i class="fas fa-fw fa-check-square"></i>
      <span>Cek Nilai</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("input_nilai_akhir")); ?>">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Input Nilai Akhir</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("edit_nilai_akhir")); ?>">
      <i class="fas fa-fw fa-edit"></i>
      <span>Edit Nilai Akhir</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("nilai_akhir")); ?>">
      <i class="fas fa-fw fa-file"></i>
      <span>Nilai Akhir</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("export_nilai")); ?>">
      <i class="fas fa-fw fa-file"></i>
      <span>Export Nilai</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    LOGOUT
  </div>
  <li class="nav-item">
    <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </li>
</ul>
<?php
}elseif ($_SESSION['ipt_level'] == "adminprofesi") { ?>
  <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon">
      <img src="img/logo/logo1.png">
    </div>
    <div class="sidebar-brand-text mx-3">InputNilai</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    DATA NILAI
  </div>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("input_nilai")); ?>">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Input Nilai</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("edit_nilai")); ?>">
      <i class="fas fa-fw fa-edit"></i>
      <span>Edit Nilai</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("cek_nilai")); ?>">
      <i class="fas fa-fw fa-check-square"></i>
      <span>Cek Nilai</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("nilai_akhir")); ?>">
      <i class="fas fa-fw fa-file"></i>
      <span>Nilai Akhir</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("export_nilai")); ?>">
      <i class="fas fa-fw fa-file-excel"></i>
      <span>Export Nilai</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    LOGOUT
  </div>
  <li class="nav-item">
    <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </li>
</ul>
<?php
}elseif ($_SESSION['ipt_level'] == "adminrs") { ?>
  <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon">
      <img src="img/logo/logo1.png">
    </div>
    <div class="sidebar-brand-text mx-3">InputNilai</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    DATA NILAI
  </div>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("input_nilai")); ?>">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Input Nilai</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("input_nilai2")); ?>">
      <i class="fab fa-fw fa-wpforms"></i>
      <span>Input Nilai 2</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("edit_nilai")); ?>">
      <i class="fas fa-fw fa-edit"></i>
      <span>Edit Nilai</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("cek_nilai")); ?>">
      <i class="fas fa-fw fa-check-square"></i>
      <span>Cek Nilai</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("nilai_akhir")); ?>">
      <i class="fas fa-fw fa-file"></i>
      <span>Nilai Akhir</span>
    </a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="index.php?pages=<?php echo sha1(md5("rekap_nilai")); ?>">
      <i class="fas fa-fw fa-file"></i>
      <span>Rekap Nilai</span>
    </a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    LOGOUT
  </div>
  <li class="nav-item">
    <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </li>
</ul>
<?php
}elseif ($_SESSION['ipt_level'] == "koas") { ?>
  <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
    <div class="sidebar-brand-icon">
      <img src="img/logo/logo1.png">
    </div>
    <div class="sidebar-brand-text mx-3">InputNilai</div>
  </a>
  <hr class="sidebar-divider my-0">
  <li class="nav-item active">
    <a class="nav-link" href="index.php">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  <hr class="sidebar-divider">
  <div class="sidebar-heading">
    LOGOUT
  </div>
  <li class="nav-item">
    <a class="nav-link" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span>
    </a>
  </li>
</ul>
<?php } ?>