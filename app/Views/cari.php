<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title;  ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
  <style>
    .paket {
      display: none !important;
    }
    body {
      font-family: 'Roboto Slab', serif;
    }

    .rls {
      margin-top: -20px !important;
    }

    @media screen and (max-width:775px) {
      .respons {
        margin-bottom: 30px !important;
      }

      .paket {
        display: block !important;
      }

      .rls {
        margin-top: 10px !important;
      }

      .box {
        margin-top: 30px !important;
      }
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
<header>
    <div class="navbar  navbar-dark bg-dark shadow-sm">
      <div class="container">
        <a href="#" class="navbar-brand d-flex align-items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" aria-hidden="true" class="me-2" viewBox="0 0 24 24">
            <path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z" />
            <circle cx="12" cy="13" r="4" />
          </svg>
          <strong>Manasikita</strong>
        </a>
        <?php 
        $session = session()->get('nama');
        if(isset($session)) :
        ?>
          <a href="<?= base_url("masuk"); ?>" style="font-size: 18px;font-weight: 200;" class="navbar-brand d-flex align-items-center">
            <strong><?= session()->get('nama'); ?></strong>
          </a>
        <?php else: ?>
          <a href="<?= base_url("masuk"); ?>" style="font-size: 18px;font-weight: 200;" class="navbar-brand d-flex align-items-center">
            <strong>Masuk</strong>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <div class="container  box-shadow mt-5">
    <main>

      <div class="album py-5 ">
        <div class="container">
          <h4>Daftar Paket</h4>
          <br>
          <div class="container mb-4">
          <?php if (session()->get("success")) : ?>
      <div class="m-3 alert alert-success">
        <span>
          <?= session()->get("success"); ?>
        </span>
      </div>
    <?php elseif (session()->get("error")) : ?>
      <div class="m-3 alert alert-danger">
        <span><?= session()->get("error");  ?></span>
      </div>
    <?php endif; ?>
          <form class="d-flex " action="<?= base_url("cari_paket") ?>" method="POST" enctype="multipart/form-data" style="justify-content: center">
        <input class="form-control me-2" type="search" placeholder="Search" required name="cari" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
      <a href="<?= base_url("/"); ?>" class="btn btn-sm btn-warning mt-3">Kembali</a>
          </div>
          <div class="row ">
            <?php foreach ($paket_dua as $tiga) : ?>
              <?php
              $counts = $jamaah->where("paket_id", $tiga['id'])->findAll();
              $mains = count($counts);
              $id_profile = $tiga['travel_id'];
              $profile = $db->query("SELECT * FROM profile WHERE id = '$id_profile'")->getRowArray();
              ?>
             <div class="col-md-6 col-12">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative" >
                  <div class  ="col-md-7 p-4 d-flex flex-column position-static">
                    <strong class="d-inline-block mb-2 "><?= $tiga['nama'];  ?></strong>
                    <small class="mb-2"><i class="fa-solid fa-calendar " style="padding-right: 5px"></i> <?= date("d, F Y", strtotime($tiga['tgl_berangkat'])) . ' - ' . date("d, F Y", strtotime($tiga['tgl_pulang']));  ?></small>
                    <small class="mb-2"><i class="fa-solid fa-location-dot" style="padding-right: 8px"></i> <?= $profile['provinsi'] ?>, <?= $profile['kabupaten'] ?></small>
                    <small class="mb-2"><i class="fa-solid fa-building" style="padding-right: 8px"></i> <?= $profile['nama_perusahaan'] ?></small>
                    <small class="mb-2"><i class="fa-solid fa-home" style="padding-right: 5px"></i>    <?= $profile['nama_travel_umrah'] ?></small>
                    <small class="mb-2"><i class="fa-solid fa-money-bill" style="padding-right: 5px"></i> Rp. <?= number_format($tiga['biaya'], 0);  ?></small>
                    <small class="mb-2"><i class="fas fa-users" style="padding-right: 5px"></i> <?= $mains;  ?> Orang</small>
                    <div class="d-flex" style="justify-content: space-between !important;align-content: center !important;"> 
                      <a href="<?= base_url("detail_paket_users/" . $tiga['id']) ?>" class="btn btn-sm btn-outline-success">Daftar</a>
                      <small><?= $tiga['tahun']; ?></small>
                    </div>
                  </div>
                  <div class="col-md-5 d-none d-lg-block">
                    <div style="width: 100%;height: 300px;">
                      <img src="<?= base_url("assets/upload/" . $tiga['poster']) ?>" style="width: 100% !important;height: 100% !important;object-position: center; " alt="">
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="col">
                <div class="card shadow-sm">
                  <div style="width: auto !important;height: 220px !important">
                    <img src="<?= base_url("assets/upload/" . $tiga['poster']);  ?>" class="w-100" alt="..." style="width: 100%;height: 100%">
                  </div>

                  <div class="card-body">
                    <p class="card-text">
                      <small><?= $tiga['nama'];  ?></small>
                      <br>
                      <small>Periode : <?= date("d, F Y", strtotime($tiga['tgl_berangkat'])) . ' - ' . date("d, F Y", strtotime($tiga['tgl_pulang']));  ?></small>
                      <br>
                      <small>Rp. <?= number_format($tiga['biaya'], 0);  ?></small>
                      <br>
                   
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                      <div class="btn-group">
                        <a href="<?= base_url("detail_paket_users/$tiga[id]");  ?>" class="btn btn-sm btn-outline-secondary">Daftar</a>
                      </div>
                      <small class="text-muted"><?= date("d-m-Y");  ?></small>
                    </div>
                  </div>
                </div>
              </div> -->
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </main>
    <!-- <div class="row">
      <?php foreach ($paket_dua as $tiga) : ?>
        <div class="col-md-4">
        <div class="box">
          <a href="<?= base_url("detail_paket_users/$tiga[id]");  ?>" style="color: black;text-decoration: none !important;">
          <div class="row  position-relative">
                    <div class="col-md-6 mb-md-s0 p-md-4">
                      <img src="<?= base_url("assets/upload/" . $tiga['poster']);  ?>" class="w-100"
                        alt="...">
                    </div>
                    <div class="col-md-6  ps-md-0 " style="margin-top: 20px;">
                      <small><?= $tiga['nama'];  ?></small>
                      <br>
                      <small>Periode : <?= date("d, F Y", strtotime($tiga['tgl_berangkat'])) . ' - ' . date("d, F Y", strtotime($tiga['tgl_pulang']));  ?> </small>
                      <br>
                      <small>Rp. <?= number_format($tiga['biaya'], 0);  ?></small>

                    </div>
                  </div>
          </a>
        </div>
        </div>
        <?php endforeach; ?>
    </div> -->
  </div>
  <div class="bg-light p-4">
    <footer class="container pt-4 text-center">
      <p> Copyright 2022 Travel-Q</p>
    </footer>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
</body>

</html>