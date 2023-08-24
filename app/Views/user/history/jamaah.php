<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div>
                            <a href="<?= base_url("detail_paket_user/" . $id_paket); ?>" class="btn btn-warning">Kembali</a>
                            <div class="row">
                                <div class="col-md-6">
                                    <br>
                                    <br>
                                    <h6>
                                        Paket : <?= $paket['nama']; ?>
                                        <br>
                                        <br>
                                        Periode : <?= date("d, F Y", strtotime($paket['tgl_berangkat'])) . ' - ' . date("d, F Y", strtotime($paket['tgl_pulang'])); ?>
                                        <br>
                                        <br>
                                        Kloter : <?= $kloter['nama']; ?>
                                        <br>
                                        <br>
                                    </h6>
                                </div>
                                <div class="col-md-6">
                                <br>
                                    <br>
                                    <h6>
                                        Biaya : Rp. <?= number_format($paket['biaya'],0) ?>
                                        <br>
                                        <br>
                                        Provider : <?= $paket['provider']; ?>
                                        <br>
                                        <br>
                                        Asuransi : <?= $paket['asuransi']; ?>
                                        <br>
                                        <br>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php

                    if (session()->get("success")) : ?>
                        <div class="m-3 alert alert-success">
                            <span><?= session()->get("success");  ?></span>
                        </div>
                    <?php elseif (session()->get("error")) : ?>
                        <div class="m-3 alert alert-danger">
                            <span><?= session()->get("error");  ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>TTL</th>
                                        <th>Status Bayar</th>
                                        <th>Status Approve Bayar</th>
                                        <th>No Registrasi</th>
                                        <th>NPU</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($jamaah as $row) : ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $row['nama']; ?></td>
                                            <td><?= $row['no_identitas']; ?></td>
                                            <td><?= $row['tempat_lahir']; ?>, <?= date("d, F Y", strtotime($row['tgl_lahir'])); ?></td>
                                            <td>
                                                <?php if (!empty($row['status_bayar'])) : ?>
                                                    <span class="badge badge-pill badge-success bg-success"><?= $row['status_bayar']; ?></span>
                                                <?php else : ?>
                                                    <span class="badge badge-pill badge-success bg-warning">Belum Dikonfirmasi</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if ($row['status_approve_bayar'] == "tolak") : ?>
                                                    <span class="badge badge-pill badge-success bg-danger"><?= $row['status_approve_bayar']; ?></span>
                                                <?php else : ?>
                                                    <span class="badge badge-pill badge-success bg-success"><?= $row['status_approve_bayar']; ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $row['no_registrasi']; ?></td>
                                            <td><?= $row['no_pasti_umrah']; ?></td>
                                            <td>
                                                <?php if ($row['status_bayar'] == null) : ?>
                                                    <a href="<?= base_url("pindah_paket_jamaah/" . $row['id'] . '/' . $id_paket . '/' . $id_kloter); ?>" class="btn btn-warning" title="Pindah Paket"><i class="fas fa-edit"></i></a>
                                                <?php endif ?>
                                                <a href="<?= base_url("detail_jamaah_diri/$row[id]/$id_paket/$id_kloter"); ?>" class="btn btn-primary" title="Detail"><i class="fas fa-eye"></i></a>
                                                <!-- <a href="<?= base_url("checkout/$row[id]/$id_paket/$id_kloter"); ?>" class="btn btn-danger" title="Detail"><i class="fas fa-money-bill"></i></a> -->
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


<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#table-1').DataTable();
    });
</script>
<?= $this->endSection(); ?>