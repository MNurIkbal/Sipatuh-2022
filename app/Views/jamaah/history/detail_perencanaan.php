<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul>
                            <li style="list-style: none">
                                <h4>Detail Perencanaan Paket</h6>
                            </li>
                            <li style="list-style: none">

                                <span>Nama Paket : <?=  $result['nama'];  ?></span>
                            </li>
                            <li style="list-style: none">
                                <span>Periode :
                                    <?=  date("d F Y",strtotime($result['tgl_berangkat'])) . " - " . date("d F Y",strtotime($result['tgl_pulang']));  ?></span>
                            </li>
                            <li style="list-style: none">

                                <span>Kode : <?=  $result['kode_paket'];  ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <!-- <div class="card-header">
                        
                    </div> -->
                    <?php if(session()->get("success")) : ?>
                    <div class="m-3 alert alert-success">
                        <span><?=  session()->get("success");  ?></span>
                    </div>
                    <?php elseif(session()->get("error")): ?>
                    <div class="m-3 alert alert-danger">
                        <span><?=  session()->get("error");  ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="card">
                            <div class="card-header">
                                <a href="<?=  base_url("/detail_history_kloter/" . $id_paket . '/' . $judul);  ?>" class="btn btn-warning">Kembali</a>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills d-flex justify-content-center" id="myTab3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3"
                                            role="tab" aria-controls="home" aria-selected="true">Petugas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3"
                                            role="tab" aria-controls="profile" aria-selected="false">Keberangkatan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3"
                                            role="tab" aria-controls="contact" aria-selected="false">Hotel</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4"
                                            role="tab" aria-controls="contact" aria-selected="false">Kepulangan</a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#contact5"
                                            role="tab" aria-controls="kloter" aria-selected="false">Kloter</a>
                                    </li> -->
                                </ul>
                                <div class="tab-content" id="petugas">
                                    <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                        aria-labelledby="home-tab3">
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-6">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Petugas</th>
                                                        <th>Type</th>
                                                        <th>Urutan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($petugas as $rows) : ?>
                                                    <tr>
                                                        <td><?=  $nomor++;  ?></td>
                                                        <td><?=  $rows['nama'];  ?></td>
                                                        <td><?=  $rows['type'];  ?></td>
                                                        <td><?=  $nomor++;  ?></td>
                                                    </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile3" role="tabpanel"
                                        aria-labelledby="profile-tab3">
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-2">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Maskapai</th>
                                                        <th>Nomor Penerbangan</th>
                                                        <th>Bandara Asal</th>
                                                        <th>Tanggal Berangkat</th>
                                                        <th>Jam Berangkat</th>
                                                        <th>Bandara Tiba</th>
                                                        <th>Tanggal Tiba</th>
                                                        <th>Jam Tiba</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($keberangkatan as $keberangkatans) : ?>
                                                    <tr>
                                                        <td><?=  $nomor++;  ?></td>
                                                        <td><?=  $keberangkatans['maskapai'];  ?></td>
                                                        <td><?=  $keberangkatans['nomor'];  ?></td>
                                                        <td><?=  $keberangkatans['nama_bandara'];  ?></td>
                                                        <td><?=  date("d, F Y",strtotime($keberangkatans['tgl_berangkat']));  ?>
                                                        </td>
                                                        <td><?=  $keberangkatans['jam_berangkat'];  ?></td>
                                                        <td><?=  $keberangkatans['bandara_tiba'];  ?></td>
                                                        <td><?=  date("d, F Y",strtotime($keberangkatans['tgl_bandara_tiba']));  ?>
                                                        </td>
                                                        <td><?=  $keberangkatans['jam_berangkat'];  ?></td>
                                                    </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact3" role="tabpanel"
                                        aria-labelledby="contact-tab3">
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-3">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Hotel</th>
                                                        <th>Lokasi</th>
                                                        <th>Tanggal Mulai</th>
                                                        <th>Tanggal Selesai</th>
                                                        <th>Orang Perkamar</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($hotel as $hotels) : ?>
                                                    <tr>
                                                        <td><?=  $nomor++  ?></td>
                                                        <td><?=  $hotels['hotel'];  ?></td>
                                                        <td><?=  $hotels['lokasi'];  ?></td>
                                                        <td><?=  date("d, F Y",strtotime($hotels['tgl_masuk']));  ?>
                                                        </td>
                                                        <td><?=  date("d, F Y",strtotime($hotels['tgl_keluar']));  ?>
                                                        </td>
                                                        <td><?=  $hotels['orang_perkamar'];  ?></td>
                                                    </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact4" role="tabpanel"
                                        aria-labelledby="contact-tab4">
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-4">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Maskapai</th>
                                                        <th>Nomor Penerbangan</th>
                                                        <th>Bandara Asal</th>
                                                        <th>Tanggal Berangkat</th>
                                                        <th>Jam Berangkat</th>
                                                        <th>Bandara Tiba</th>
                                                        <th>Tanggal Tiba</th>
                                                        <th>Jam Tiba</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($kepulangan as $kepulangans) : ?>
                                                    <tr>
                                                        <td><?=  $nomor++;  ?></td>
                                                        <td><?=  $kepulangans['maskapai'];  ?></td>
                                                        <td><?=  $kepulangans['nomor'];  ?></td>
                                                        <td><?=  $kepulangans['bandara_berangkat'];  ?></td>
                                                        <td><?=  date("d, F Y",strtotime($kepulangans['tgl_berangkat']));  ?>
                                                        </td>
                                                        <td><?=  $kepulangans['jam_berangkat'];  ?></td>
                                                        <td><?=  $kepulangans['bandara_tiba'];  ?></td>
                                                        <td><?=  date("d, F Y",strtotime($kepulangans['tgl_penerbangan_tiba']));  ?>
                                                        </td>
                                                        <td><?=  $kepulangans['jam_berangkat'];  ?></td>
                                                    </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact5" role="tabpanel"
                                        aria-labelledby="contact-tab4">
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-5">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Kloter</th>
                                                        <th>Status</th>
                                                        <th>Dibuat</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($kloter as $kloters) : ?>
                                                    <tr>
                                                        <td><?=  $nomor++;  ?></td>
                                                        <td><?=  $kloters['nama'];  ?></td>
                                                        <td><span class="badge badge-pill badge-primary"><?=  $kloters['status'];  ?></span></td>
                                                        <td><?=  $kloters['created_at'];  ?></td>
                                                    </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#table-2').DataTable();
        $('#table-3').DataTable();
        $('#table-4').DataTable();
        $('#table-5').DataTable();
        $('#table-6').DataTable();
    });
</script>
<?= $this->endSection(); ?>