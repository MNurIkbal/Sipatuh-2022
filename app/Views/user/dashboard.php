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
        <?php if(!isset($first_biodata)) : ?>
          <div class="alert alert-warning  p-3">
            <p>Biodata anda belum lengkap.Silahkan lengkapi terlebih dahulu di menu profile isi semua data yang tercamtum di dalamnya.</p>
          </div>
          <?php endif; ?>
        <div class="row">
          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-primary text-white">
                <h4 class="card-title">Paket Terdaftar</h4>
              </div>
              <div class="card-body">
                <h3><?= (isset($paket_terdaftar)) ? $paket_terdaftar : 0; ?> Paket</h3>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-success text-white">
                <h4 class="card-title">Pembayaran Paket</h4>
              </div>
              <div class="card-body">
                <h3>Rp <?= (!empty($pembayaran)) ? number_format($pembayaran, 0) : 0; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header bg-danger  text-white">
                <h4 class="card-title">Paket Selesai</h4>
              </div>
              <div class="card-body">
                <h3><?= (isset($selesai)) ? $selesai : 0; ?> Paket</h3>
              </div>
            </div>
          </div>
        </div>
        <?php if(!$check_biodata)  : ?>
          <div class="alert-warning alert">
            <h4>Pemberitahuan </h4>
            <p>Anda belum melengkapi biodata harap di lengkapi terlebih dahulu di menu profile</p>
          </div>
          <?php endif; ?>
      </div>
    </div>

  </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<?= $this->endSection(); ?>