<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manasikita</title>
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">  -->
  <link rel="stylesheet" href="<?= base_url("assets/modules/bootstrap/css/bootstrap.min.css") ?>">
  <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
  <div class="container mb-5 box-shadow mt-5">
    <?php if (session()->get("success")) : ?>
      <div class="m-3 alert alert-success">
        <span>
          Selamat pendaftaran anda berhasil.
        </span>
      </div>
    <?php elseif (session()->get("error")) : ?>
      <div class="m-3 alert alert-danger">
        <span><?= session()->get("error");  ?></span>
      </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-md-6">
        <div class="card ">
          <div class="card-header bg-success text-white">
            <h4>Informasi Paket</h4>
          </div>
          <ul class="list-group">
            <li class="list-group-item">Kode Paket: <?= $paket['kode_paket'];  ?></li>
            <li class="list-group-item">Nama : <?= $paket['nama'];  ?></li>
            <li class="list-group-item">Biaya : Rp. <?= number_format($paket['biaya'], 0);  ?></li>
            <li class="list-group-item">Tahun : <?= $paket['tahun'];  ?></li>
            <li class="list-group-item">Tanggal Berangkat : <?= date("d, F Y ", strtotime($paket['tgl_berangkat']));  ?></li>
            <li class="list-group-item">Tanggal Pulang : <?= date("d, F Y ", strtotime($paket['tgl_pulang']));  ?></li>
            <li class="list-group-item">Provider : <?= $paket['provider'];  ?></li>
            <li class="list-group-item">Asuransi : <?= $paket['asuransi'];  ?></li>
            <li class="list-group-item">Keterangan Berangkat : <?= $paket['ket_berangkat'];  ?></li>
            <li class="list-group-item">Keterangan Pulang : <?= $paket['ket_berangkat'];  ?></li>
            <li class="list-group-item">Poster :
              <br>
              <br>
              <div style="width: 180px;height: 140px">
                <img src="<?= base_url("assets/upload/" . $paket['poster']);  ?>" alt="" style="width: 100%;height: 100%">
              </div>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card ">
          <div class="card-header bg-success text-white">
            <h4>Informasi Travel</h4>
          </div>
          <ul class="list-group">
            <li class="list-group-item">Nama Perusahaan : <?= $travel['nama_perusahaan'];  ?></li>
            <li class="list-group-item">Nama Travel : <?= $travel['nama_travel_umrah'];  ?></li>
            <li class="list-group-item">No Telephone : <?= $travel['no_telp'];  ?></li>
            <li class="list-group-item">No HP : <?= $travel['no_hp'];  ?></li>
            <li class="list-group-item">Email : <?= $travel['email'];  ?></li>
            <li class="list-group-item">Website : <a href="<?= base_url('company/' . $travel['website']); ?>"><?= $travel['website']; ?></a></li>
            <li class="list-group-item">Provinsi : <?= $travel['provinsi'];  ?></li>
            <li class="list-group-item">Kabupaten : <?= $travel['kabupaten'];  ?></li>
            <li class="list-group-item">Kecamatan : <?= $travel['kecamatan'];  ?></li>
            <li class="list-group-item">Alamat : <?= $travel['alamat'];  ?></li>
            <li class="list-group-item">Foto Kantor :
              <br>
              <br>
              <?php if($travel['foto_kantor']) : ?>
                <div style="width: 180px;height: 140px">
                  <img src="<?= base_url("assets/upload/" . $travel['foto_kantor']);  ?>" alt="" style="width: 100%;height: 100%">
                </div>
                <?php endif; ?>
            </li>
          </ul>
        </div>
      </div>
      <div class="col-lg mt-5">
        <div class="card">
          <div class="card-header bg-success text-white">
            <h4>Pendaftaran Jamaah</h4>
          </div>
          <div class="card-body">
            <form action="<?= base_url("tambah_jamaah_user");  ?>" method="POST" enctype="multipart/form-data">
              <div>
                <input type="hidden" name="id_paket" value="<?= $id;  ?>">
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="">Title</label>
                      <!-- <input type="text" class="form-control" required placeholder="Title" name="title"> -->
                      <div class="w-100 h-100 selects">
                        <select name="title" class="form-control select2" required id="">
                          <option value="">Pilih</option>
                          <option value="Tuan" <?= ($biodata['title'] == "Tuan") ? "selected" : ""; ?>>Tuan</option>
                          <option value="Nyonya" <?= ($biodata['title'] == "Nyonya") ? "selected" : ""; ?>>Nyoya</option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6    ">
                    <div class="mb-3">
                      <label for="">Nama*</label>
                      <input type="text" class="form-control" required placeholder="Nama" readonly name="nama" value="<?= session()->get('nama') ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="">Nama Ayah*</label>
                      <input type="text" class="form-control" required placeholder="Nama Ayah" name="ayah" value="<?= $biodata['ayah']; ?>">
                    </div>
                    <input type="hidden" name="jenis_identitas" value="nik">
                    <div class="mb-3">
                      <label for="">No Identitas*</label>
                      <input type="text" class="form-control " name="no_identitas" value="<?= $biodata['no_identitas']; ?>" required placeholder="No Identitas">
                    </div>
                    <div class="mb-3">
                      <label for="">Tempat Lahir*</label>
                      <input type="text" class="form-control " required placeholder="Tempat Lahir" name="tempat_lahir" value="<?= $biodata['tempat_lahir']; ?>">
                    </div>
                    <div class="mb-3">
                      <label for="">Tanggal Lahir*</label>
                      <input type="date" class="form-control" required placeholder="" name="tgl_lahir" value="<?= $biodata['tgl_lahir']; ?>">
                    </div>
                    <div class="mb-3">
                      <label for="">No Telepon</label>
                      <input type="number" class="form-control" placeholder="No Telepon" name="no_telpon" value="<?= $biodata['no_telp']; ?>">
                    </div>
                    <div class="mb-3">
                      <label for="">No Hp*</label>
                      <input type="number" class="form-control" required placeholder="No Hp" name="no_hp" value="<?= session()->get('no_hp'); ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                  <div class="mb-3">
                        <label for="">Kewarganegaraan*</label>
                        <select name="warganegara" class="form-control select2" required id="">
                          <option value="">Pilih</option>
                          <option value="wni" <?= ($biodata['kewargannegaraan'] == "wni") ? "selected" : ""; ?>>WNI</option>
                          <option value="wna" <?= ($biodata['kewargannegaraan'] == "wna") ? "selected" : ""; ?>>WNA</option>
                        </select>
                      </div>
                    <div class="mb-3">
                      <label for="">Nama Paspor</label>
                      <input type="text" class="form-control"  placeholder="Nama Paspor" name="nama_paspor" value="<?= $biodata['nama_paspor']; ?>">
                    </div>
                    <div class="mb-3">
                      <label for="">Status Pernikahan*</label>
                      <select name="nikah" class="form-control select2" required id="">
                        <option value="">Pilih</option>
                        <option value="sudah nikah" <?= ($biodata['status_pernikahan'] == "sudah nikah") ? "selected" : ""; ?>>sudah nikah</option>
                        <option value="belum nikah" <?= ($biodata['status_pernikahan'] == "belum nikah") ? "selected" : ""; ?>>belum nikah</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="">Jenis Pendidikan*</label>
                      <select name="jenis_pendidikan" class="form-control select2" required id="">
                        <option value="">Pilih</option>
                        <option value="tidak sekolah" <?= ($biodata['jenis_pendidikan'] == "tidak sekolah") ? "selected" : ""; ?>>Tidak Sekolah</option>
                        <option value="SD"  <?= ($biodata['jenis_pendidikan'] == "SD") ? "selected" : ""; ?>>SD</option>
                        <option value="SMP"  <?= ($biodata['jenis_pendidikan'] == "SMP") ? "selected" : ""; ?>>SMP</option>
                        <option value="SMA/SMK"  <?= ($biodata['jenis_pendidikan'] == "SMA/SMK") ? "selected" : ""; ?>>SMA/SMK</option>
                        <option value="PERGURUAN TINGGI"  <?= ($biodata['jenis_pendidikan'] == "PERGURUAN TINGGI") ? "selected" : ""; ?>>PERGURUAN TINGGI</option>
                        <option value="lainnya"  <?= ($biodata['jenis_pendidikan'] == "lainnya") ? "selected" : ""; ?>>lainnya</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="">Jenis Pekerjaan*</label>
                      <select name="jenis_pekerjaan" class="form-control select2" required id="">
                        <option value="">Pilih</option>
                        <option value="tidak bekerja" <?= ($biodata['jenis_pekerjaan'] == "tidak bekerja") ? "selected" : ""; ?>>Tidak Bekerja</option>
                        <option value="guru" <?= ($biodata['jenis_pekerjaan'] == "guru") ? "selected" : ""; ?>>Guru</option>
                        <option value="nelayan"  <?= ($biodata['jenis_pekerjaan'] == "nelayan") ? "selected" : ""; ?>>Nelayan</option>
                        <option value="petani"  <?= ($biodata['jenis_pekerjaan'] == "petani") ? "selected" : ""; ?>>Petani</option>
                        <option value="buruh"  <?= ($biodata['jenis_pekerjaan'] == "buruh") ? "selected" : ""; ?>>Buruh</option>
                        <option value="polisi"  <?= ($biodata['jenis_pekerjaan'] == "polisi") ? "selected" : ""; ?>>Polisi</option>
                        <option value="pns"  <?= ($biodata['jenis_pekerjaan'] == "pns") ? "selected" : ""; ?>>PNS</option>
                        <option value="pengusaha"  <?= ($biodata['jenis_pekerjaan'] == "pengusaha") ? "selected" : ""; ?>>Pengusahan</option>
                        <option value="lainnya"  <?= ($biodata['jenis_pekerjaan'] == "lainnya") ? "selected" : ""; ?>>lainnya</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="">No Paspor</label>
                      <input type="text" class="form-control" value="<?= $biodata['no_paspor']; ?>"  placeholder="No Paspor" name="no_paspor">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary ml-3">Simpan</button>
                  <a href="<?= base_url("/");  ?>" class="btn btn-warning ml-3">Kembali</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="bg-light p-4">
    <footer class="container pt-4 text-center">
      <p> Copyright <?= date("Y"); ?> Travel-Q</p>
    </footer>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  $("#provinsi").change(function() {
    let val = $(this).val()
    $.ajax({
      url : "<?= base_url("ambil_provinsi") ?>/" + val,
      success : function(data) {
        $("#kabupaten").html(data)
      }
    });

    $("#kabupaten").change(function() {
      let kab = $(this).val()
      $.ajax({
        url : "<?= base_url('ambil_kabupaten') ?>/" + kab,
        success:function(data_dua) {
          $("#kecamatan").html(data_dua)
        }
      })
    });
    
    $("#kecamatan").change(function() {
      let kec = $(this).val()
      $.ajax({
        url : "<?= base_url("ambil_kecamatan") ?>/" + kec,
        success : function(data_tiga) {
          $("#kelurahan").html(data_tiga)
        }
      })
    })
  });
</script>

<script>
    $(document).ready(function() {
    $('.select2').select2();
});
</script>
</body>
</html>