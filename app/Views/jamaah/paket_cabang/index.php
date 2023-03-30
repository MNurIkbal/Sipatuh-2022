<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Request Paket</h4>
                    </div>
                    <?php

use App\Models\JamaahModel;

 if(session()->get("success")) : ?>
                    <div class="m-3 alert alert-success">
                        <span><?=  session()->get("success");  ?></span>
                    </div>
                    <?php elseif(session()->get("error")): ?>
                    <div class="m-3 alert alert-danger">
                        <span><?=  session()->get("error");  ?></span>
                    </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Nama Paket</th>
                                        <th>Periode</th>
                                        <th>Biaya</th>
                                        <th>Info Jamaah</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($result as $row) :
                                        ?>
                                    <?php 
                                        $db      = \Config\Database::connect();
                                        $paket_id = $row['id'];
                                        $pendaftaran = $db->query("SELECT * FROM jamaah WHERE paket_id = '$paket_id' AND kloter_id IS NOT NULL")->getResult();
                                        $setor_awal = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'cicil' AND paket_id = '$paket_id'  AND kloter_id IS NOT NULL")->getResult();
                                        $lunas = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'lunas' AND paket_id = '$paket_id'  AND kloter_id IS NOT NULL")->getResult();
                                        ?>
                                    <tr>
                                        <td><?=  $no++;  ?></td>
                                        <td><?=  $row['nama'];  ?></td>
                                        <td>
                                            <?=  date("D, d F Y",strtotime($row["tgl_berangkat"])) . " - " . date("D, d F Y",strtotime($row["tgl_pulang"]))  ;  ?>
                                        </td>
                                        <td>
                                            <?=  "Rp." . number_format($row['biaya']);  ?>
                                        </td>
                                        <td>
                                            <span>
                                                PENDAFTARAN : <?=  count($pendaftaran);  ?> ORANG
                                            </span>
                                            <br>
                                            <span>
                                                SETOR AWAL : <?=  count($setor_awal);  ?> ORANG
                                            </span>
                                            <br>
                                            <span>
                                                LUNAS : <?=  count($lunas);  ?> ORANG
                                            </span>
                                        </td>
                                        <td>
                                            <?php if($row['status_paket_cabang'] == NULL && $row['status_approve'] == NULL) : ?>
                                                <a title="Detail" href="#" data-toggle="modal" data-target="#hapus<?= $row['id'] ?>"
                                                    class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                <?php elseif($row['status_approve'] == "tolak"): ?>
                                                    <span class="badge badge-pill badge-warning">Tolak</span>
                                                    <?php else: ?>
                                                        <span class="badge badge-pill badge-warning">Belum Dikonfirmasi</span>
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
<?php foreach($result as $main) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("konfirmasi_paket/" . $main['id']);  ?>"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Apakah Anda Yakin Ingin Menyetujui Paket Tersebut?</h5>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <a href="<?=  base_url("tolak_paket/$main[id]");  ?>" class="btn btn-danger">Tolak</a>
                <button type="submit" class="btn btn-primary">Setuju</button>
            </div>
        </form>
    </div>
</div>
<?php endforeach; ?>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#table-2').DataTable();
        $('#table-1').DataTable();
        $('#table-3').DataTable();
    });
</script>
<?= $this->endSection(); ?>