<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
  <section class="section">
    <div class="card">
      <div class="card-header">
        <h4 style="text-transform: uppercase">SELAMAT DATANG <?= $profile['nama_perusahaan'];  ?></h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-success text-white">
                <h5 class="card-title">Informasi Travel</h5>
              </div>
              <div class="card-body">
                <ul class="list-group">
                  <li class="list-group-item">Nama Perusahaan : <?= $profile['nama_perusahaan'];  ?></li>
                  <li class="list-group-item">Nama Travel : <?= $profile['nama_travel_umrah'];  ?></li>
                  <li class="list-group-item">NPWP : <?= $profile['npwp'];  ?></li>
                  <li class="list-group-item">Nomor SK: <?= $profile['no_sk'];  ?></li>
                  <li class="list-group-item">Tanggal SK: <?= date("d, F Y", strtotime($profile['tgl_sk']));  ?> </li>
                  <li class="list-group-item">No Telephone : <?= $profile['no_telp'];  ?></li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-success text-white">
                <h5 class="card-title">Informasi Travel</h5>
              </div>
              <div class="card-body">
                <ul class="list-group">
                  <li class="list-group-item">No Hp : <?= $profile['no_hp'];  ?></li>
                  <li class="list-group-item">Email : <?= $profile['email'];  ?></li>
                  <li class="list-group-item">Website : <?= $profile['website'];  ?></li>
                  <li class="list-group-item">Provinsi : <?= $profile['provinsi'];  ?></li>
                  <li class="list-group-item">Kabupaten : <?= $profile['kabupaten'];  ?></li>
                  <li class="list-group-item">Kecamatan : <?= $profile['kecamatan'];  ?></li>
                  <li class="list-group-item">Alamat : <?= $profile['alamat'];  ?></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-success text-white">
                <h5 class="card-title">Logo Travel</h5>
              </div>
              <div class="card-body">
                <?php if ($profile['logo_travel']) : ?>
                  <div class="wrapper" style="width: 100%;height: 400px">
                    <img src="<?= base_url("assets/upload/" . $profile['logo_travel']);  ?>" alt="" style="width:100%;height: 100%;">
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="card">
              <div class="card-header bg-success text-white">
                <h5 class="card-title">Foto Kantor</h5>
              </div>
              <div class="card-body">
                <div style="display:flex;justify-content: center">
                  <?php if ($profile['foto_kantor']) : ?>
                    <div class="wrapper" style="width: 100%;height: 400px">
                      <img src="<?= base_url("assets/upload/" . $profile['foto_kantor']);  ?>" alt="" style="width:100%;height: 100%;">
                    </div>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </section>
</div>
<?= $this->endSection(); ?>