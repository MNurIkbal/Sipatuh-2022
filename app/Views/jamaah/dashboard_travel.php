<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
  <section class="section">
    <div class="card">
      <div class="card-header">
        <h4 style="text-transform: uppercase">SELAMAT DATANG <?= $profile['nama_travel_umrah'];  ?></h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-3">
            <div class="card">
              <div class="card-header text-white bg-danger">
                <h5> Jamaah</h5>
              </div>
              <div class="card-body">
                <h5><?= $jamaah; ?> Jamaah</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header text-white bg-primary">
                <h5> Paket</h5>
              </div>
              <div class="card-body">
                <h5><?= $paket; ?> Paket</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header text-white bg-warning">
                <h5> Cabang</h5>
              </div>
              <div class="card-body">
                <h5><?= $cabang; ?> Cabang</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3">
            <div class="card">
              <div class="card-header text-white bg-success">
                <h5>Petugas</h5>
              </div>
              <div class="card-body">
                <h5><?= $petugas_umrah; ?> Jamaah</h5>
              </div>
            </div>
          </div>
        </div>
        <div id="chart">

        </div>
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
            <?php foreach($daftar as $rt) : ?>
                <?= $rt['jamaah'] . ',' ?>
                <?php endforeach; ?>
          ]
        }],
         
        chart: {
          height: 450,
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
            <?php foreach($daftar as $rt) : ?>
                "<?= $rt['bulan']  ?>",
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