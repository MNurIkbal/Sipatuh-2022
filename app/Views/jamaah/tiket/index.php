<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tiket</h4>
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
                                        $pendaftaran = $db->query("SELECT * FROM jamaah WHERE paket_id = '$paket_id'")->getResult();
                                        $setor_awal = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'cicil' AND paket_id = '$paket_id'")->getResult();
                                        $lunas = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'lunas' AND paket_id = '$paket_id'")->getResult();
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
                                                <a title="Detail" href="<?=  base_url("kloter_detail_tiket/$row[id]");  ?>"   class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                <!-- <a title="Detail" href="<?=  base_url("detail_tiket/$row[id]");  ?>"   class="btn btn-primary"><i class="fa fa-eye"></i></a> -->
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