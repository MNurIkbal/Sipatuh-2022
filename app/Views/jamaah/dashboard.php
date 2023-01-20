<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
  <section class="section">
    <div class="card">
      <div class="card-header">
        <h4 style="text-transform: uppercase">SELAMAT DATANG <?=  $profile['nama_perusahaan'];  ?></h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-7">
            <div class="card">
              <div class="card-header bg-success text-white">
                <h5 class="card-title">Informasi Travel</h5>
              </div>
              <div class="card-body">
                <ul class="list-group">
                  <li class="list-group-item">Nama Travel : <?=  $profile['nama_travel_umrah'];  ?></li>
                  <li class="list-group-item">Brand Travel : <?=  $profile['nama_travel_umrah'];  ?></li>
                  <li class="list-group-item">NPWP : <?=  $profile['npwp'];  ?></li>
                  <li class="list-group-item">Nomor SK: <?=  $profile['no_sk'];  ?></li>
                  <li class="list-group-item">Tanggal SK: <?=  date("d, F Y",strtotime($profile['tgl_sk']));  ?> </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-5">
            <div class="card">
              <div class="card-header bg-success text-white">
                <h5 class="card-title">Logo Travel</h5>
              </div>
              <div class="card-body">
                <?php if($profile['logo_travel']) : ?>
                  <div class="wrapper" style="width: 200px;height: 160px">
                    <img src="<?=  base_url("assets/upload/" . $profile['logo_travel']);  ?>" alt=""
                      style="width:100%;height: 100%;">
                  </div>
                  <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-header bg-success text-white">
            <h5 class="card-title">Kontak Travel</h5>
          </div>
          <div class="card-body">
            <div style="display:flex;justify-content: center">
            <?php if($profile['foto_kantor']) : ?>
              <div class="wrapper" style="width: 350px;height: 250px">
                <img src="<?=  base_url("assets/upload/" . $profile['foto_kantor']);  ?>" alt=""
                  style="width:100%;height: 100%;">
              </div>
              <?php endif; ?>
            </div>
            <ul class="list-group mt-4">
              <li class="list-group-item">No Telephone : <?=  $profile['no_telp'];  ?></li>
              <li class="list-group-item">No Hanphone : <?=  $profile['no_hp'];  ?></li>
              <li class="list-group-item">Email : <?=  $profile['email'];  ?></li>
              <li class="list-group-item">Website : <?=  $profile['website'];  ?></li>
              <li class="list-group-item">Alamat : <?=  $profile['alamat'];  ?></li>
            </ul>
          </div>
        </div>
      </div>

  </section>
</div>
<?= $this->endSection(); ?>