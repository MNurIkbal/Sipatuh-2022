<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manasikita</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
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
          <strong>Manasikita</strong>
        </a>
        <?php
        $session = session()->get('nama');
        if (isset($session)) :
        ?>
          <a href="<?= base_url("masuk"); ?>" style="font-size: 18px;font-weight: 200;" class="navbar-brand d-flex align-items-center">
            <strong><?= session()->get('nama'); ?></strong>
          </a>
        <?php else : ?>
          <a href="<?= base_url("masuk"); ?>" style="font-size: 18px;font-weight: 200;" class="navbar-brand d-flex align-items-center">
            <strong>Masuk</strong>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <?php if ($simpan) : ?>
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <?php
        $first_active_element = true;
        foreach ($banner as $satu) :
          $waktu_mulai  = date("Y-m-d", strtotime($satu['star']));
          $waktu_akhir  = date("Y-m-d", strtotime($satu['expired']));
          $sekarang = date("Y-m-d");
          if ($sekarang < $waktu_mulai) :
        ?>
          <?php elseif ($sekarang > $waktu_akhir) : ?>
          <?php else : ?>
            <div class="carousel-item <?= ($first_active_element) ? "active" : ""; ?>">
              <div style="width: 100% !important;height: 600px !important">
                <img src="<?= base_url("assets/upload/" . $satu['foto']);  ?>" class=" w-100 h-100" alt="...">
              </div>
            </div>
            <?php $first_active_element = false;  ?>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  <?php endif; ?>
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
          </div>
          <div class="row ">
            <?php $hari = date("Y-m-d");
            foreach ($paket_dua as $tiga) : ?>
                <?php
                $counts = $jamaah->where("paket_id", $tiga['id'])->where('kloter_id IS NOT NULL')->findAll();
                $mains = count($counts);
                $id_profile = $tiga['travel_id'];
                $profile = $db->query("SELECT * FROM profile WHERE id = '$id_profile'")->getRowArray();
                ?>
                <div class="col-md-6 col-12">
                  <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col-md-7 p-4 d-flex flex-column position-static">
                      <strong class="d-inline-block mb-2 "><?= $tiga['nama'];  ?></strong>
                      <small class="mb-2"><i class="fa-solid fa-calendar " style="padding-right: 5px"></i> <?= date("d, F Y", strtotime($tiga['tgl_berangkat'])) . ' - ' . date("d, F Y", strtotime($tiga['tgl_pulang']));  ?></small>
                      <small class="mb-2"><i class="fa-solid fa-location-dot" style="padding-right: 8px"></i> <?= $profile['provinsi'] ?>, <?= $profile['kabupaten'] ?></small>
                      <small class="mb-2"><i class="fa-solid fa-building" style="padding-right: 8px"></i> <?= $profile['nama_perusahaan'] ?></small>
                      <small class="mb-2"><i class="fa-solid fa-home" style="padding-right: 5px"></i> <?= $profile['nama_travel_umrah'] ?></small>
                      <small class="mb-2"><i class="fa-solid fa-money-bill" style="padding-right: 5px"></i> Rp. <?= number_format($tiga['biaya'], 0);  ?></small>
                      <small class="mb-2"><i class="fas fa-users" style="padding-right: 5px"></i> <?= $mains;  ?> Orang</small>
                      <small class="mb-2"><i class="fas fa-globe" style="padding-right: 5px;color:blue"></i> <a href="<?= base_url("company/" . $profile['website']); ?>" target="_blank" style="color: blue;text-decoration: none;"><?= $profile['website']; ?></a></small>
                      <div class="d-flex" style="justify-content: space-between !important;align-content: center !important;">
                        <a href="<?= base_url("detail_paket_users/" . $tiga['id']) ?>" class="btn btn-sm btn-outline-success">Daftar</a>
                        <small>Tahun <?= $tiga['tahun']; ?></small>
                      </div>
                    </div>
                    <div class="col-md-5 d-none d-lg-block">
                      <div style="width: 100%;height: 300px;">
                        <img src="<?= base_url("assets/upload/" . $tiga['poster']) ?>" style="width: 100% !important;height: 100% !important;object-position: center; " alt="">
                      </div>
                    </div>
                  </div>
                </div>
            <?php endforeach; ?>
          </div>
        </div>
        <?= $pager->links('paket', 'pager_baru') ?>
      </div>
    </main>
  </div>
  <div class="bg-light p-4">
    <footer class="container pt-4 text-center">
      <p> Copyright <?= date("Y"); ?> Manasikita</p>
    </footer>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>