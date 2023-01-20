<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                        <h4>Pembayaran Jamaah</h4>
                        <a href="<?= base_url("detail_pembayaran_kloter/$id"); ?>" class="btn btn-warning">Kembali</a>
                        </div>
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
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Identitas</th>
                                        <th>No Pasti Umrah</th>
                                        <th>Status Pembayaran</th>
                                        <!-- <th>Status Vaksin</th> -->
                                        <th>Info</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($jamaah as $row) :?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td>
                                            <?=  $row['nama_jamaah'];  ?>
                                        </td>
                                        <td>
                                            <span>NIK : <?=  $row['no_identitas'];  ?></span>
                                            <br>
                                            <span>No Telpon : <?=  $row['no_telp'];  ?></span>
                                            <br>
                                            <span>No Hp : <?=  $row['no_hp'];  ?></span>
                                        </td>
                                        <td><?=  $row['no_pasti_umrah'];  ?></td>
                                        <td>
                                            <?php if($row['status_bayar'] == "lunas") : ?>
                                            <span>STATUS BAYAR : <span class="badge badge-success">SUDAH
                                                    BAYAR</span></span>
                                            <?php else: ?>
                                            <span>STATUS BAYAR : <span class="badge badge-danger">BELUM
                                                    BAYAR</span></span>
                                            <?php endif; ?>
                                            <br>
                                            <span>PROVIDER : <?=  $row['provider'];  ?></span>
                                            <br>
                                            <span>ASURANSI : <?=  $row['asuransi'];  ?></span>
                                        </td>
                                        <td>
                                            <span>POLIS : <?=  $row['nomor_polis'];  ?></span>
                                            <br>
                                            <span>VISA : <?=  $row['nomor_visa'];  ?></span>
                                            <br>
                                            <span>PASPOR : <?=  $row['no_paspor'];  ?></span>
                                            <br>
                                            <span>STATUS APPROVE BAYAR :   
                                                <span class="badge badge-primary badge-pill "><?=  $row['selesai_pembayaran'];  ?></span>
                                                <!-- <?php if($row['selesai_pembayaran']) : ?>
                                            <?php else: ?>
                                                <span class="badge badge-danger badge-pill "><?=  "Belum Dikonfirmasi";  ?></span>
                                                <?php endif; ?> -->
                                        </span>
                                        </td>
                                        <td>

                                            <?php  if($row['status_approve_bayar'] == NULL || $row['status_approve_bayar'] == "tolak") : ?>
                                                <a href="#" data-toggle="modal" data-target="#edit<?= $row['id_jamaah'] ?>"
                                                        class=" btn btn-success"><i class="fa fa-eye"></i></a>
                                                <?php elseif($row['status_approve_bayar'] == "sudah"): ?>
                                                    <a href="#" data-toggle="modal" data-target="#approve<?= $row['id_jamaah'] ?>"
                                                        class=" btn btn-primary">Approve</a>
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
<?php foreach($jamaah as $main) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="edit<?= $main['id_jamaah'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if($main['status_bayar'] == "cicil" || $main['status_bayar'] == "lunas") : ?>
                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header bg-success text-white">
                                                    <h4>Pembayaran 1</h4>
                                                </div>
                                                <div class="card-body">
                                                    <span>Rekening Penampung : <?=  $main['rekening_penampung'];  ?></span>
                                                    <br>
                                                    <!-- <span>Status : <?=  $main['status_bayar'];  ?></span> -->
                                                    <br>
                                                    <?php if($main['nominal_pembayaran']) : ?>
                                                        <span>Nominal : Rp. <?=  number_format($main['nominal_pembayaran'],0);  ?></span>
                                                        <?php else: ?>
                                                            <span>Nominal : Rp. 0</span>
                                                        <?php endif; ?>
                                                    <br>
                                                    <span>Bukti : <a href="<?=  base_url("assets/upload/" . $main['bukti_pembayaran']);  ?>" download="" class="btn btn-success">Download</a></span>
                                                    <br>
                                                    <span>Keterangan : <?=  $main['keterangan_bayar'];  ?></span>
                                                    <!-- <ul class="list-group">
                                                        <li class="list-group-item">rhdsk</li>
                                                    </ul> -->
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $data_jamaah_bukti = $bukti->where("jamaah_id",$main['id_jamaah'])->where("paket_id",$main['paket_id'])->where("kloter_id",$main['kloter_id'])->findAll();
                            $no = 2;
                            foreach($data_jamaah_bukti as $rows) :
                                        ?>
                            <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h4>Pembayaran <?=  $no++;  ?></h4>
                                        </div>
                                        <div class="card-body">
                                            <span>Rekening Penampung : <?=  $rows['rekening_penampung'];  ?></span>
                                            <br>
                                            <?php if($rows['nominal']) : ?>
                                                <span>Nominal : Rp. <?=  number_format($rows['nominal'],0);  ?></span>
                                                <?php else: ?>
                                                    <span>Nominal : Rp. 0</span>
                                                <?php endif; ?>
                                                <br>
                                            <span>Bukti : <a href="<?=  base_url("assets/upload/" . $rows['bukti']);  ?>" download="" class="btn btn-success">Download</a></span>
                                            <br>
                                            <span>Keterangan : <?=  $rows['keterangan'];  ?></span>
                                            <br>
                                            <span>Dibuat : <?=  $rows['created'];  ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                                    </div>
                    <?php endif; ?>
            </div>
                <?php if($main['status_bayar'] == "cicil" || $main['status_bayar'] == "lunas" ) : ?>
                    <div class="modal-footer bg-whitesmoke br">
                        <a href="<?=  base_url("tolak/" . $main['id_jamaah']);  ?>" class="btn btn-danger">Tolak</a>
                        <a href="<?=  base_url("approve/" . $main['id_jamaah']);  ?>" class="btn btn-success">Approve</a>
                    </div>
                    <?php endif; ?>
</div>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="approve<?= $main['id_jamaah'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php if($main['status_bayar'] == "cicil" || $main['status_bayar'] == "lunas") : ?>
                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card">
                                                <div class="card-header bg-success text-white">
                                                    <h4>Pembayaran 1</h4>
                                                </div>
                                                <div class="card-body">
                                                    <span>Rekening Penampung : <?=  $main['rekening_penampung'];  ?></span>
                                                    <br>
                                                    <!-- <span>Status : <?=  $main['status_bayar'];  ?></span> -->
                                                    <br>
                                                    <?php if($main['nominal_pembayaran']) : ?>
                                                        <span>Nominal : Rp. <?=  number_format($main['nominal_pembayaran'],0);  ?></span>
                                                        <?php else: ?>
                                                            <span>Nominal : Rp. 0</span>
                                                        <?php endif; ?>
                                                    <br>
                                                    <span>Bukti : <a href="<?=  base_url("assets/upload/" . $main['bukti_pembayaran']);  ?>" download="" class="btn btn-success">Download</a></span>
                                                    <br>
                                                    <span>Keterangan : <?=  $main['keterangan_bayar'];  ?></span>
                                                    <!-- <ul class="list-group">
                                                        <li class="list-group-item">rhdsk</li>
                                                    </ul> -->
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $data_jamaah_bukti = $bukti->where("jamaah_id",$main['id_jamaah'])->where("paket_id",$main['paket_id'])->where("kloter_id",$main['kloter_id'])->findAll();
                            $no = 2;
                            foreach($data_jamaah_bukti as $rows) :
                                        ?>
                            <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h4>Pembayaran <?=  $no++;  ?></h4>
                                        </div>
                                        <div class="card-body">
                                            <span>Rekening Penampung : <?=  $rows['rekening_penampung'];  ?></span>
                                            <br>
                                            <?php if($rows['nominal']) : ?>
                                                <span>Nominal : Rp. <?=  number_format($rows['nominal'],0);  ?></span>
                                                <?php else: ?>
                                                    <span>Nominal : Rp. 0</span>
                                                <?php endif; ?>
                                                <br>
                                            <span>Bukti : <a href="<?=  base_url("assets/upload/" . $rows['bukti']);  ?>" download="" class="btn btn-success">Download</a></span>
                                            <br>
                                            <span>Keterangan : <?=  $rows['keterangan'];  ?></span>
                                            <br>
                                            <span>Dibuat : <?=  $rows['created'];  ?></span>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                                    </div>
                    <?php endif; ?>
            </div>
</div>
    </div>
</div>
<?php endforeach; ?>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
<?= $this->endSection(); ?>