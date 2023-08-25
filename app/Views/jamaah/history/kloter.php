<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kloter</h4>
                        <a href="<?=  base_url("paket_selesai/");  ?>" class="btn btn-warning">Kembali</a>
                    </div>
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
                        <b>

                            <span>Nama Paket : <?= $paket['nama'] ?></span>
                            <br>
                            <span>Periode :
                                <?=  date("d F Y",strtotime($paket['tgl_berangkat'])) . ' - ' . date("d, F Y",strtotime($paket['tgl_pulang']));  ?></span>
                            <br>
                            <span>Tour Leader : <?=  $paket['tour_leader'];  ?></span>
                            <br>
                        </b>

                        <br>
                        <div class="table-responsive">
                            <table class="table table-border table-hover table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Kloter</th>
                                        <th>Status</th>
                                        <th>Keberangkatan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1; foreach($kloter as $kloters) : ?>
                                    <tr>
                                        <td><?=  $nomor++;  ?></td>
                                        <td><?=  $kloters['nama'];  ?></td>
                                        <td><span class="badge badge-pill badge-primary">Aktif</span></td>
                                        <td>
                                        <?php if($kloters['keberangkatan']) : ?>
                                            <span class="badge badge-pill badge-success">
                                        <?=  $kloters['keberangkatan'];  ?></span>
                                                <?php else: ?>
                                                    <span class="badge badge-pill badge-success">
                                        belum</span>
                                                <?php endif; ?>
                                    </td>
                                        <td>
                                            <?php if($judul == "perencanaan" )  :?>
                                                <a href="<?=  base_url("detail_perencanaan_kloter"  . '/' . $kloters['id'] . '/' .  $id_paket . '/' . $judul);  ?>"
                                                        class="btn btn-success" title="Detail"><i class="fa fa-eye"></i></a>
                                                        <?php elseif($judul == "realisasi") : ?>
                                                            <a href="<?=  base_url("detail_perencanaan_realisasi"  . '/' . $kloters['id'] . '/' .  $id_paket . '/' . $judul);  ?>"
                                                        class="btn btn-success" title="Detail"><i class="fa fa-eye"></i></a>
                                                        <?php else: ?>
                                                            <a href="<?=  base_url("detail_selesai_jamaah"  . '/' . $kloters['id'] . '/' .  $id_paket . '/' . $judul);  ?>"
                                                        class="btn btn-success" title="Detail"><i class="fa fa-eye"></i></a>
                                                <?php endif; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>