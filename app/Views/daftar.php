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
  <div class="card mb-5">
    <div class="card-header">
      <h5 class="card-title">Form Pendaftaran Jamaah</h5>
    </div>
    <div class="card-body">
    <a href="<?=  base_url("/detail_banner/$id");  ?>" class="btn btn-warning mb-4">Kembali</a>
  <div class="mb-4">
  <?php if(session()->get("success")) : ?>
                        <div class="m-3 alert alert-success">
                            <span><?=  session()->get("success");  ?></span>
                        </div>
                        <?php elseif(session()->get("error")): ?>
                            <div class="m-3 alert alert-danger">
                            <span><?=  session()->get("error");  ?></span>
                        </div>
                        <?php endif; ?>
  </div>
  <form action="<?=  base_url("daftar_jamaah_baru");  ?>" method="POST" enctype="multipart/form-data">
  <div class="row">
    <input type="text" class="d-none" value="<?=  $id;  ?>" name="id" >
    <input type="text" class="d-none" value="<?=  $id_paket;  ?>" name="id_paket" >
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Title</label>
                            <!-- <input type="text" class="form-control" required placeholder="Title" name="title"> -->
                            <select name="title" class="form-control select2" required id="">
                                <option value="">Pilih</option>
                                <option value="Tuan">Tuan</option>
                                <option value="Nyonya">Nyoya</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6    ">
                    <div class="mb-3">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" required placeholder="Nama" name="nama">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Nama Ayah</label>
                            <input type="text" class="form-control" required placeholder="Nama Ayah" name="ayah">
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Identitas</label>
                            <select name="jenis_identitas" id="" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="nik">Nik</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">No Identitas</label>
                            <input type="text" class="form-control " name="no_identitas" required placeholder="No Identitas">
                        </div>
                        <div class="mb-3">
                            <label for="">Tempat Lahir</label>
                            <input type="text" class="form-control " required placeholder="Tempat Lahir" name="tempat_lahir">
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_lahir">
                        </div>
                        <div class="mb-3">
                            <label for="">No Telepon</label>
                            <input type="number" class="form-control" required placeholder="No Telepon" name="no_telpon">
                        </div>
                        <div class="mb-3">
                            <label for="">No Hp</label>
                            <input type="number" class="form-control" required placeholder="No Hp" name="no_hp">
                        </div>
                        <div class="mb-3">
                            <label for="">Kewarganegaraan</label>
                            <select name="warganegara" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="wni">WNI</option>
                                <option value="wna">WNA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Nama Paspor</label>
                            <input type="text" class="form-control" required placeholder="Nama Paspor" name="nama_paspor">
                        </div>
                        <div class="mb-3">
                            <label for="">Foto</label>
                            <input type="file" class="form-control" required placeholder="Foto" name="foto">
                        </div>
                        <div class="mb-3">
                            <label for="">Alamat    </label>
                            <textarea name="alamat" id="" class="form-control" required cols="30" rows="10" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Provinsi</label>
                            <input type="text" class="form-control" required placeholder="Provinsi" name="provinsi">
                        </div>
                        <div class="mb-3">
                            <label for="">Kabupaten</label>
                            <input type="text" class="form-control" required placeholder="Kabupaten" name="kabupaten">
                        </div>
                        <div class="mb-3">
                            <label for="">Kecamatan</label>
                            <input type="text" class="form-control" required placeholder="Kecamatan" name="kecamatan">
                        </div>
                        <div class="mb-3">
                            <label for="">Kelurahan</label>
                            <input type="text" class="form-control" required placeholder="Kelurahan" name="kelurahan">
                        </div>
                        <div class="mb-3">
                            <label for="">Status Pernikahan</label>
                            <select name="nikah" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="sudah nikah">sudah nikah</option>
                                <option value="belum nikah">belum nikah</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Pendidikan</label>
                            <select name="jenis_pendidikan" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="tidak sekolah">Tidak Sekolah</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA/SMK">SMA/SMK</option>
                                <option value="PERGURUAN TINGGI">PERGURUAN TINGGI</option>
                                <option value="lainnya">lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Pekerjaan</label>
                            <select name="jenis_pekerjaan" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="tidak bekerja">Tidak Bekerja</option>
                                <option value="guru">Guru</option>
                                <option value="nelayan">Nelayan</option>
                                <option value="petani">Petani</option>
                                <option value="buruh">Buruh</option>
                                <option value="polisi">Polisi</option>
                                <option value="pns">PNS</option>
                                <option value="pengusaha">Pengusahan</option>
                                <option value="lainnya">lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Provider</label>
                            <input type="text" class="form-control" required placeholder="Provider" name="provider">
                        </div>
                        <div class="mb-3">
                            <label for="">Asuransi</label>
                            <input type="text" class="form-control" required placeholder="Asuransi" name="asuransi">
                        </div>
                        <div class="mb-3">
                            <label for="">No Paspor</label>
                            <input type="text" class="form-control" required placeholder="No Paspor" name="no_paspor">
                        </div>
                      </div>
                    </div>
                    <button class="btn btn-primary mb-5">Simpan</button>
</form>
    </div>
  </div>
 
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>

</body>
</html>