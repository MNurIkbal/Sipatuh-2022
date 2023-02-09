<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<?php
$validation = \Config\Services::validation();
?>
<div class="main-content">
    <section class="section">

        <div class="card">
            <div class="card-header">
                <h5>Dashboard</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h6>Total Jamaah</h6>
                            </div>
                            <div class="card-body">
                                <h4><?= $total_jamaah; ?> Jamaah</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header text-white bg-success">
                                <h6>Jamaah Aktif</h6>
                            </div>
                            <div class="card-body">
                                <h4><?= $aktif_jamaah; ?> Jamaah</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header text-white bg-success">
                                <h6>Jamaah Sudah Berangkat</h6>
                            </div>
                            <div class="card-body">
                                <h4><?= $sudah_berangkat; ?> Jamaah</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header text-white bg-success">
                                <h6>Paket Travel</h6>
                            </div>
                            <div class="card-body">
                                <h4><?= $paket; ?> Paket</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header text-white bg-success">
                                <h6>Travel</h6>
                            </div>
                            <div class="card-body">
                                <h4><?= $profile; ?> User</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header text-white bg-success">
                                <h6>Banner</h6>
                            </div>
                            <div class="card-body">
                                <h4><?= $banners; ?> Banner</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header text-white bg-success">
                                <h6>Kasus</h6>
                            </div>
                            <div class="card-body">
                                <h4><?= $kasus; ?> Kasus</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header text-white bg-success">
                                <h6>Cabang</h6>
                            </div>
                            <div class="card-body">
                                <h4><?= $cabang_travel; ?> Cabang</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card-header">
                            <h5>Banner</h5>
                        </div>
                        <div class="card-body">
                            <?php if(!empty($banner)) : ?>
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
                                                <div style="width: 100% !important;height: 400px !important">
                                                    <img src="<?= base_url("assets/upload/" . $satu['foto']);  ?>" class=" w-100 h-100" alt="...">
                                                </div>
                                            </div>
                                            <?php $first_active_element = false;  ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>

                            </div>
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Grafik Pendaftaran Jamaah</h5>
                        <div class="mt-5" id="chart"></div>
                    </div>
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