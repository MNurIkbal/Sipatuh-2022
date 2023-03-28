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
        <?php if(!$first_biodata) : ?>
          <div class="alert alert-warning  p-3">
            <p>Biodata anda belum lengkap.Silahkan lengkapi terlebih dahulu di menu profile isi semua data yang tercamtum di dalamnya.</p>
          </div>
          <?php endif; ?>
        <div class="row">
          <div class="col-md-3">
            <div class="card">
              <div class="card-header bg-primary text-white">
                <h4 class="card-title">Paket Terdaftar</h4>
              </div>
              <div class="card-body">
                <h3><?= $paket_terdaftar; ?> Paket</h3>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header bg-success text-white">
                <h4 class="card-title">Total Pembayaran</h4>
              </div>
              <div class="card-body">
                <h3>Rp <?= (!empty($pembayaran)) ? number_format($pembayaran, 0) : 0; ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header bg-danger  text-white">
                <h4 class="card-title">Paket Selesai</h4>
              </div>
              <div class="card-body">
                <h3><?= $selesai; ?> Paket</h3>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header bg-warning   text-white">
                <h4 class="card-title">Total Hutang</h4>
              </div>
              <div class="card-body">
                <h3>Rp. <?= (!empty($hutang)) ? number_format($hutang, 0) : 0; ?></h3>
              </div>
            </div>
          </div>
        </div>
        <div id="chart"></div>
      </div>
    </div>

  </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  $(document).ready(function() {

    var options = {
      series: [{
        name: "Jamaah",
        data: [
          <?php foreach ($daftar as $rt) : ?>
            <?= $rt['jamaah'] . ',' ?>
          <?php endforeach; ?>
        ]
      }],

      chart: {
        height: 350,
        type: 'bar',
      },
      plotOptions: {
        bar: {
          borderRadius: 1,
          columnWidth: '50%',
        }
      },
      dataLabels: {
        enabled: false
      },
      stroke: {
        width: 2
      },

      grid: {
        row: {
          colors: ['#fff', '#f2f2f2']
        }
      },
      xaxis: {
        labels: {
          rotate: -45
        },
        categories: [
          <?php foreach ($daftar as $rt) : ?> "<?= $rt['bulan']  ?>",
          <?php endforeach; ?>
        ],
        tickPlacement: 'on'
      },
      yaxis: {
        title: {
          text: 'Pendaftaran',
        },
      },
      fill: {
        type: 'gradient',
        gradient: {
          shade: 'light',
          type: "horizontal",
          shadeIntensity: 0.25,
          gradientToColors: undefined,
          inverseColors: true,
          opacityFrom: 0.85,
          opacityTo: 0.85,
          stops: [50, 0, 100]
        },
      }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();

  })
</script>
<?= $this->endSection(); ?>