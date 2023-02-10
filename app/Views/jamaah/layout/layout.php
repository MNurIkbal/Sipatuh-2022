<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title><?=  "Travel-Q";  ?></title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url("assets/modules/bootstrap/css/bootstrap.min.css") ?>">
  <link rel="stylesheet" href="<?=  base_url("assets/modules/fontawesome/css/all.min.css");  ?>">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?=  base_url("assets/modules/jqvmap/dist/jqvmap.min.css");  ?>">
  <link rel="stylesheet" href="<?=  base_url("assets/modules/summernote/summernote-bs4.css");  ?>">
  <link rel="stylesheet" href="<?=  base_url("assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css");  ?>">
  <link rel="stylesheet" href="<?=  base_url("assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css");  ?>">
  <link rel="stylesheet" href="<?=  base_url("assets/modules/datatables/datatables.min.css");  ?>">
  <link rel="stylesheet" href="<?=  base_url("assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css");  ?>">
  <link rel="stylesheet" href="<?=  base_url("assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css");  ?>">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?=  base_url("assets/css/style.css");  ?>">
  <link rel="stylesheet" href="<?=  base_url("assets/css/components.css");  ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto Slab', serif;

    }
  </style>
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
      <div class="navbar-bg"></div>
      <nav class="navbar navbar-expand-lg main-navbar">
        <form class="form-inline mr-auto">
          <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li>
              <a href="<?= base_url("/"); ?>" target="_blank" class="nav nav-link">Beranda</a>
            </li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
          </ul>

        </form>
        <ul class="navbar-nav navbar-right">
          <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <img alt="image" src="<?=  base_url("assets/img/avatar/avatar-1.png") ;  ?>" class="rounded-circle mr-1">
            <div class="d-sm-none d-lg-inline-block"><?=  session()->get("nama");  ?></div></a>
            <div class="dropdown-menu dropdown-menu-right">
              <!-- <div class="dropdown-title">Logged in 5 min ago</div> -->
              <!-- <div class="dropdown-divider"></div> -->
              <a href="#" class="dropdown-item has-icon text-success" data-toggle="modal"
                                            data-target="#ganti">
                <i class="fas fa-key"></i> Ganti Password
              </a>
              <a href="<?=  base_url("keluar");  ?>" class="dropdown-item has-icon text-danger">
                <i class="fas fa-sign-out-alt"></i> Logout
              </a>
            </div>
          </li>
        </ul>
      </nav>
      <div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#">Travel-Q</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">Travel</a>
          </div>
          <?php

                        use App\Models\BioDataModel;
                        use App\Models\JamaahModel;

 if(session()->get("level_id") == "jamaah") : ?>
            
          <ul class="sidebar-menu">
          <li><a class="nav-link" href="<?=  base_url("dashboard");  ?>"><i class="fas fa-fire"></i><span>Dashboard</span></a></li>
          
          <li class="dropdown ">
              <a href="#" class="nav-link has-dropdown"><i class="fa  fa-book"></i> <span>Paket</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?=  base_url("/paket");  ?>">Aktif</a></li>
                <li><a class="nav-link" href="<?=  base_url("/paket_selesai");  ?>">History</a></li>
              </ul>
            </li>
            <li class="dropdown ">
              <a href="#" class="nav-link has-dropdown"><i class="fa  fa-newspaper"></i> <span>Master Data</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?=  base_url("/petugas");  ?>">Petugas</a></li>
                <li><a class="nav-link" href="<?=  base_url("/rekening_penampung");  ?>">Rekening Penampung</a></li>
              </ul>
            </li>
            <li class="dropdown ">
              <a href="#" class="nav-link has-dropdown"><i class="fa  fa-book"></i> <span>Pendaftaran</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?=  base_url("/request_paket");  ?>">Request Paket</a></li>
                <li><a class="nav-link" href="<?=  base_url("/pendaftaran");  ?>">Pendaftaran Paket</a></li>
                <li><a class="nav-link" href="<?=  base_url("/request_jamaah");  ?>">Request Jamaah</a></li>
                <li><a class="nav-link" href="<?=  base_url("/cabang");  ?>">Cabang</a></li>
              </ul>
            </li>
            <li class="dropdown ">
              <a href="#" class="nav-link has-dropdown"><i class="fa  fa-book"></i> <span>Profile Travel</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?=  base_url("/profile_perusaahaan");  ?>">Profile</a></li>
                <li><a class="nav-link" href="<?=  base_url("/profil");  ?>">Update Profile</a></li>
              </ul>
            </li>
            <li><a class="nav-link" href="<?=  base_url("/tiket");  ?>"><i class="fas fa-tag"></i><span>Tiket</span></a></li>
            <li><a class="nav-link" href="<?=  base_url("/realisasi");  ?>"><i class="fas fa-book-open"></i><span>Realisasi</span></a></li>
            <li><a class="nav-link" href="<?=  base_url("/pembayaran_user");  ?>"><i class="fas fa-address-card"></i><span>Pembayaran</span></a></li>
            <li><a class="nav-link" href="<?=  base_url("/keluar");  ?>"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
          </ul>
          <?php elseif(session()->get("level_id") == "admin"): ?>
            <ul class="sidebar-menu">
            <li><a class="nav-link" href="<?=  base_url("/dash_admin");  ?>"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
            <li><a class="nav-link" href="<?=  base_url("/users");  ?>"><i class="fas fa-clipboard"></i><span>Travel</span></a></li>
            <li class="dropdown ">
              <a href="#" class="nav-link has-dropdown"><i class="fa  fa-book"></i> <span>Master Data</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?=  base_url("/level_users");  ?>">Level Petugas</a></li>
                <li><a class="nav-link" href="<?=  base_url("/data_provider");  ?>">Provider</a></li>
                <li><a class="nav-link" href="<?=  base_url("/data_asuransi");  ?>">Asuransi</a></li>
                <li><a class="nav-link" href="<?=  base_url("/data_mussahah");  ?>">Muassasah</a></li>
              </ul>
            </li>
            <li><a class="nav-link" href="<?=  base_url("/data_hotel");  ?>"><i class="fas fa-hotel"></i><span>Hotel </span></a></li>
            <li><a class="nav-link" href="<?=  base_url("/data_bank");  ?>"><i class="fas fa-building"></i><span>Bank </span></a></li>
            <li><a class="nav-link" href="<?=  base_url("/data_travel");  ?>"><i class="fas fa-city"></i><span>Perusahaan</span></a></li>
            <li><a class="nav-link" href="<?=  base_url("/banner");  ?>"><i class="fas fa-newspaper"></i><span>Banner</span></a></li>
            <li><a class="nav-link" href="<?=  base_url("/keluar");  ?>"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
            </ul>
            <?php elseif(session()->get("level_id") == "cabang") : ?>
              <ul class="sidebar-menu">
                <li class="dropdown ">
                <a href="#" class="nav-link has-dropdown"><i class="fa  fa-book"></i> <span>Paket</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="<?=  base_url("/paket");  ?>">Aktif</a></li>
                  <li><a class="nav-link" href="<?=  base_url("/paket_selesai");  ?>">History</a></li>
                </ul>
              </li>
              <li><a class="nav-link" href="<?=  base_url("/pendaftaran");  ?>"><i class="fas fa-edit"></i><span>Pendaftaran</span></a></li>
              <li><a class="nav-link" href="<?=  base_url("/tiket");  ?>"><i class="fas fa-tag"></i><span>Tiket</span></a></li>
              <li><a class="nav-link" href="<?=  base_url("/realisasi");  ?>"><i class="fas fa-book-open"></i><span>Realisasi</span></a></li>
              <li><a class="nav-link" href="<?=  base_url("/keluar");  ?>"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
              </ul>
            <?php elseif(session()->get("level_id") == "user"): ?>
              <ul class="sidebar-menu">
                <li><a class="nav-link" href="<?=  base_url("/dashboard_user");  ?>"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
                <?php
                    // $db      = \Config\Database::connect();
                    // $id_jamaah = session()->get("jamaah_id");
                    // $jamaah = $db->query("SELECT * FROM jamaah WHERE id = '$id_jamaah'")->getRowArray();
                    // $kloter_id = $jamaah['kloter_id'];
                    // $kloter = $db->query("SELECT * FROM kloter WHERE id = '$kloter_id'")->getRowArray();
                    $id = session()->get('id');
                  $profile = new BioDataModel();
                  $check = $profile->where("user_id",$id)->first();

                if(session()->get("level_id") == "user" ) : ?>
                <?php if(!$check) : ?>
                  <li class=""><a class="nav-link" href="<?=  base_url("/profile_jamaah");  ?>"><i class="fas fa-user-tie"></i><span>Profile </span></a></li>
                  <?php else: ?>
                    <li class=""><a class="nav-link" href="<?=  base_url("/view_profile");  ?>"><i class="fas fa-id-card"></i><span>Profile </span></a></li>
                    <li class="dropdown ">
              <a href="#" class="nav-link has-dropdown"><i class="fa  fa-book"></i> <span>Paket</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="<?=  base_url("/paket_user");  ?>">Aktif</a></li>
                <li><a class="nav-link" href="<?=  base_url("/paket_selesai_user");  ?>">History</a></li>
              </ul>
            </li>
                    <!-- <li class=""><a class="nav-link" href="<?=  base_url("/pindah_paket_jamaah");  ?>"><i class="fas fa-edit"></i><span>Pindah Paket</span></a></li>
                    <li><a class="nav-link" href="<?=  base_url("/pembayaran_jamaah");  ?>"><i class="fas fa-address-card"></i><span>Pembayaran</span></a></li>
                    <li><a class="nav-link" href="<?=  base_url("/asuransi_jamaah");  ?>"><i class="fas fa-newspaper"></i><span>Asuransi</span></a></li>
                    <li><a class="nav-link" href="<?=  base_url("/visa_jamaah");  ?>"><i class="fas fa-book"></i><span>Visa</span></a></li> -->
                    <?php endif; ?>
                    <li><a class="nav-link" href="<?=  base_url("/keluar");  ?>"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
                  <?php endif; ?>
              </ul>
          <?php endif; ?>
       </aside> 
      </div>

      <!-- Main Content -->
      
      <?=  $this->renderSection("content");  ?>
      <footer class="main-footer">
        <div class="footer-left">
          Copyright &copy; 2022 <div class="bullet"></div> 
        </div>
        <div class="footer-right">
          
        </div>
      </footer>
    </div>
  </div>
  <div class="modal fade" tabindex="-1" role="dialog" id="ganti">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("ganti_password");  ?>"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ganti Password</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Password Baru</label>
                    <input type="password" class="form-control" required placeholder="Password" name="password">
                </div>
                <div class="mb-3">
                    <label for="">Ulangi Password</label>
                    <input type="password" class="form-control" required placeholder="Ulangi Password" name="password_satu">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
  <!-- General JS Scripts -->
  <script src="<?=  base_url("assets/modules/jquery.min.js");  ?>"></script>
  <script src="<?=  base_url("assets/modules/popper.js");  ?>"></script>
  <script src="<?=  base_url("assets/modules/tooltip.js");  ?>"></script>
  <script src="<?=  base_url("assets/modules/bootstrap/js/bootstrap.min.js");  ?>"></script>
  <script src="<?=  base_url("assets/modules/nicescroll/jquery.nicescroll.min.js");  ?>"></script>
  <script src="<?=  base_url("assets/modules/moment.min.js");  ?>"></script>
  <script src="<?=  base_url("assets/js/stisla.js");  ?>"></script>
  
  <!-- JS Libraies -->
  <script src="<?=  base_url("assets/modules/jquery.sparkline.min.js");  ?>"></script>
  <script src="<?=  base_url("assets/modules/chart.min.js");  ?>"></script>
  <script src="<?=  base_url("assets/modules/owlcarousel2/dist/owl.carousel.min.js");  ?>"></script>
  <script src="<?=  base_url("assets/modules/summernote/summernote-bs4.js");  ?>"></script>
  <script src="<?=  base_url("assets/modules/chocolat/dist/js/jquery.chocolat.min.js");  ?>"></script>
  <script src="<?=  base_url("assets/modules/datatables/datatables.min.js");  ?>"></script>
  <script src="<?=  base_url("assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js");  ?>"></script>
  <script src="<?=  base_url("assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js");  ?>"></script>
  <script src="<?=  base_url("assets/modules/jquery-ui/jquery-ui.min.js");  ?>"></script>
  <script src="<?=  base_url("assets/js/page/modules-datatables.js");  ?>"></script>

  <!-- Page Specific JS File -->
  <script src="<?=  base_url("assets/js/page/index.js");  ?>"></script>
  
  <!-- Template JS File -->
  <script src="<?=  base_url("assets/js/scripts.js");  ?>"></script>
  <script src="<?=  base_url("assets/js/custom.js");  ?>"></script>


  
</body>
</html>