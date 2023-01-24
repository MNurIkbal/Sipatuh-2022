<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
  <section class="section">
    <div class="card">
    <?php if (session()->get("success")) : ?>
        <div class="m-3 alert alert-success">
          <span><?= session()->get("success");  ?></span>
        </div>
      <?php elseif (session()->get("error")) : ?>
        <div class="m-3 alert alert-danger">
          <span><?= session()->get("error");  ?></span>
        </div>
      <?php endif; ?>
      <div class="card-header">
        <h4 style="text-transform: uppercase">Dashboard</h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <div class="card">
              <div class="card-header bg-primary text-white">
                <h4 class="card-title">Paket Terdaftar</h4>
              </div>
              <div class="card-body">
                <h3>20 Paket</h3>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header bg-success text-white">
                <h4 class="card-title">Total Pembayaran</h4>
              </div>
              <div class="card-body">
                <h3>Rp 1.000.000</h3>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header bg-danger  text-white">
                <h4 class="card-title">Paket Aktif</h4>
              </div>
              <div class="card-body">
                <h3>Umrah Bersama</h3>
                <h6>Kloter : Satu</h6>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header bg-warning   text-white">
                <h4 class="card-title">Paket Terdaftar</h4>
              </div>
              <div class="card-body">
                <h3>20 Paket</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>
<?= $this->endSection(); ?>