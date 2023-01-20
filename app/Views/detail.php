<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipatuh</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-lg bg-primary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div  class="collapse  navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0 " >
        <li class="nav-item" > 
          <a class="nav-link text-white text-right"  href="<?=  base_url("masuk");  ?>">Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container mt-5">
  <a href="<?=  base_url("/");  ?>" class="btn btn-warning ">Kembali</a>
<div class="card mt-4 mb-5">
  <div class="card-header">
    <h5 class="card-title">Detail Paket</h5>
  </div>
  <div class="card-body">
  <div class="row mb-5">
    <?php foreach($paket as $row) : ?>
      <div class="col-md-6 mt-5 ">
      <div class="card">
    <div class="card-header">
      <h5 class="card-title ">
          <?=  $row['nama'];  ?>
      </h5>
    </div>
    <div class="card-body">
      <span>
      Periode : <?=  date("d, F Y",strtotime($row['tgl_berangkat']));  ?> - <?=  date("d, F Y",strtotime($row['tgl_pulang']));  ?>
      </span>
      <br>
      <span>Tahun : <?=  $row['tahun'];  ?></span>
      <br>
      <span>Kode Paket : <?=  $row['kode_paket'];  ?></span>
      <br>
      <span>Biaya : Rp. <?=  number_format($row['biaya']);  ?></span>
      <br>
      <a href="<?=  base_url("daftar_jamaah/$id/$row[id]");  ?>" class="btn btn-primary mt-3">Daftar</a>
    </div>
  </div>
      </div>
      <?php endforeach; ?>
  </div>
  </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</body>
</html>