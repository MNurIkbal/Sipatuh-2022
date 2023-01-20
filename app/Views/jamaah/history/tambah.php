<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pelaporan Jamaah</h4>
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
                            <span>Kode Paket : <?=  $paket['kode_paket'];  ?></span>
                            <br>
                            <span>Kloter : <span class="badge badge-pill badge-success"><?=  $kloter['nama'];  ?></span>
                            </span>
                        </b>
                        <br>
                        <br>
                        <a title="Kembali" href="<?=  base_url("detail_history_kloter/" . $id . '/' . $judul);  ?>" class="btn btn-warning"><i
                                class="fas fa-arrow-left"></i></a>
                        <?php if($count) : ?>
                        <a title="Export Exel" href="<?=  base_url("download_jamaah/$id/$id_kloter");  ?>"
                            class="btn btn-success"><i class="fas fa-download"></i></a>
                        <a target="_blank" title="Download PDF" href="<?=  base_url("download_pdf/$id/$id_kloter");  ?>"
                            class="btn btn-warning"><i class="fas fa-download" title="Download PDF"></i></a>
                        <?php if($finish >= $count) : ?>
                        <a target="_blank" title="Print Kartu" href="<?=  base_url("print_kartu/$id");  ?>" class="btn btn-dark"><i
                                class="fas fa-print"></i></a>
                        <?php endif; ?>
                        <?php endif; ?>
                        <div class="table-responsive mt-5">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Identitas</th>
                                        <th>No Pasti Umrah</th>
                                        <th>Status Pembayaran</th>
                                        <th>Status Vaksin</th>
                                        <th>Info</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($result as $row) : ?>
                                    <tr>
                                        <td>
                                            <?=  $row['nama'];  ?>
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
                                                <span>
                                                    <?php if($row['status_vaksin'] == "sudah") : ?>
                                                        STATUS VAKSIN : <span class="badge badge-success">Sudah</span>
                                                        <?php else: ?>
                                                            STATUS VAKSIN : <span class="badge badge-danger">Belum</span>
                                                        <?php endif; ?>
                                                </span>
                                                <br>
                                                <span>
                                                    TANGGAL VAKSIN : <?=  date("d-m-Y",strtotime($row['tgl_vaksin']));  ?>
                                                </span>
                                                <br>
                                                <span>
                                                    JENIS VAKSIN : <?=  $row['jenis_vaksin'];  ?>
                                                </span>
                                            </td>
                                        <td>
                                            <span>POLIS : <?=  $row['nomor_polis'];  ?></span>
                                            <br>
                                            <span>VISA : <?=  $row['nomor_visa'];  ?></span>
                                            <br>
                                            <span>PASPOR : <?=  $row['no_paspor'];  ?></span>
                                            <br>
                                            <span>STATUS APPROVE BAYAR :   
                                                <?php if($row['selesai_pembayaran']) : ?>
                                            <span class="badge badge-primary badge-pill "><?=  $row['selesai_pembayaran'];  ?></span>
                                            <?php else: ?>
                                                <span class="badge badge-danger badge-pill "><?=  "Belum Dikonfirmasi";  ?></span>
                                                <?php endif; ?>
                                        </span>
                                        </td>
                                        <td>

                                            <a href="#" class="btn btn-primary" title="Detail" data-toggle="modal"
                                                data-target="#view<?= $row['id']  ?>"><i class="fa fa-eye"></i></a>

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


<div class="modal fade" tabindex="-1" role="dialog" id="view<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Detail Jamaah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <div class="row">
                        <div class="col-md-6">
                            <li class="list-group-item">Title : <?=  $main['title'];  ?></li>
                            <li class="list-group-item">Nama : <?=  $main['nama'];  ?></li>
                            <li class="list-group-item">Nama Paspor: <?=  $main['nama_paspor'];  ?></li>
                            <li class="list-group-item">Nama Ayah: <?=  $main['ayah'];  ?></li>
                            <li class="list-group-item">Jenis Identitas : <?=  $main['jenis_identitas'];  ?></li>
                            <li class="list-group-item">Tempat Tanggal Lahir:
                                <?=  $main['tempat_lahir'] . ' , ' . date("d F Y",strtotime($main['tgl_lahir'])) ?></li>
                            <li class="list-group-item">Provinsi : <?=  $main['provinsi'];  ?></li>
                            <li class="list-group-item">Kabupaten : <?=  $main['kabupaten'];  ?></li>
                            <li class="list-group-item">Kecamatan : <?=  $main['kecamatan'];  ?></li>
                            <li class="list-group-item">Kelurahan : <?=  $main['kelurahan'];  ?></li>
                            <li class="list-group-item">Alamat : <?=  $main['alamat'];  ?></li>
                            <li class="list-group-item">No Telephone : <?=  $main['no_telp'];  ?></li>
                            <li class="list-group-item">No Hp : <?=  $main['no_hp'];  ?></li>
                            <li class="list-group-item">Kewarganegaraan : <?=  $main['kewargannegaraan'];  ?></li>
                            <li class="list-group-item">Status Pernikahan: <?=  $main['status_pernikahan'];  ?></li>
                            <li class="list-group-item">Jenis Pendidikan: <?=  $main['jenis_pendidikan'];  ?></li>
                            <li class="list-group-item">Jenis Pekerjaan : <?=  $main['jenis_pekerjaan'];  ?></li>
                            <li class="list-group-item">Provider : <?=  $main['provider'];  ?></li>
                            <li class="list-group-item">Asuransi : <?=  $main['asuransi'];  ?></li>
                            <li class="list-group-item">No Paspor : <?=  $main['no_paspor'];  ?></li>
                            <li class="list-group-item">No Identitas : <?=  $main['no_identitas'];  ?></li>
                        </div>
                        <div class="col-md-6">
                            <li class="list-group-item">NPU : <?=  $main['no_pasti_umrah'];  ?></li>
                            <li class="list-group-item">Tanggal Bayar : <?=  $main['tgl_bayar'];  ?></li>
                            <li class="list-group-item">Rekening Penampung : <?=  $main['rekening_penampung'];  ?></li>
                            <li class="list-group-item">Status Bayar : <span class="badge badge-pill badge-primary"><?=  $main['status_bayar'];  ?></span></li>
                            <?php if($main['status_bayar'] == "lunas" || $main['status_bayar'] == "cicil") : ?>
                                <li class="list-group-item">Keterangan Bayar : <?=  $main['keterangan_bayar'];  ?></li>
                                <li class="list-group-item">Nominal Pembayaran : Rp. <?=  number_format($main['nominal_pembayaran'],0);  ?></li>
                                <li class="list-group-item">Sisa Pembayaran : Rp. <?= number_format( $main['sisa_pembayaran'],0);  ?></li>
                                <li class="list-group-item">Bukti Pembayaran : 
                                    <div style="width: 120px;height: 80px">
                                        <img src="<?=  base_url("assets/upload/" . $main['bukti_pembayaran']);  ?>" alt="" style="width: 100%;height: 100%">
                                    </div>
                                </li>
                                <?php endif; ?>
                            <li class="list-group-item">Nomor Polis : <?=  $main['nomor_polis'];  ?></li>
                            <li class="list-group-item">Tanggal Input : <?=  $main['tgl_input'];  ?></li>
                            <li class="list-group-item">Tanggal Awal Polis : <?=  $main['tgl_awal'];  ?></li>
                            <li class="list-group-item">Tanggal Akhir Polis : <?=  $main['tgl_akhir'];  ?></li>
                            <li class="list-group-item">Nomor Visa : <?=  $main['nomor_visa'];  ?></li>
                            <li class="list-group-item">Tanggal Awal Visa : <?=  $main['tgl_awal_visa'];  ?></li>
                            <li class="list-group-item">Tanggal Akhir Visa : <?=  $main['tgl_akhir_visa'];  ?></li>
                            <li class="list-group-item">Muassasah : <?=  $main['muassasah'];  ?></li>
                            <li class="list-group-item">No Registrasi : <?=  $main['no_registrasi'];  ?></li>
                            <li class="list-group-item">
                                Foto
                                <div class="wrapper" style="width: 100px;height:100px">
                                    <img src="<?=  base_url("assets/upload/" . $main['foto']);  ?>" alt=""
                                        style="width: 100%;height:100%;object-fit: cover">
                                </div>
                            </li>
                        </div>
                    </div>

                </ul>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php endforeach; ?>

<?= $this->endSection(); ?>