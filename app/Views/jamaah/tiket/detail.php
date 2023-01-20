<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Data Detail Tiket</h4>
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
                        </b>
                        <br>
                        <br>
                        <a title="Kembali" href="<?=  base_url("kloter_detail_tiket/" . $id);  ?>" class="btn btn-warning"><i
                                class="fas fa-arrow-left"></i></a>
                        <div class="table-responsive mt-5">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>No Tiket Berangkat</th>
                                        <th>No Tiket Pulang </th>
                                        <th>No Kursi</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($jamaah as $row) : ?>
                                    <tr>
                                        <td><?=  $no++;  ?></td>
                                        <td><?=  $row['nama'];  ?></td>
                                        <td><?=  $row['tiket_cgk_med'];  ?></td>
                                        <td><?=  $row['tiket_med_gk'];  ?></td>
                                        <td><?=  $row['no_kursi'];  ?></td>
                                        <td>
                                            <a title="Edit" href="<?= base_url("edit_tikets/$row[id]/$id/$id_kloter"); ?>" class="btn btn-success" ><i class="fas fa-pen"></i></a>
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
<div class="modal fade" tabindex="-1" role="dialog" id="eye<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("update_tiket/$main[id]");  ?>"
            class="modal-content">
            <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
            <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Data Tiket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                    <div class="mb-3">
                            <label for="">Nama Jamaah</label>
                            <input type="text" class="form-control" required placeholder="Nama Jamaah" name="nama"
                                value="<?=  $main['nama'];  ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="">Nama Paspor</label>
                            <input type="text" class="form-control" required placeholder="Nama Paspor"
                                name="nama_paspor" value="<?=  $row['nama_paspor'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Nomor Paspor</label>
                            <input type="text" class="form-control" required placeholder="Nomor Paspor"
                                name="nomor_paspor" value="<?=  $main['no_paspor'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal Dikeluarkan Paspor</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_keluar_paspor"
                                value="<?=  $main['tgl_keluar_paspor'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Kota Paspor</label>
                            <input type="text" class="form-control" required placeholder="Kota Paspor"
                                name="kota_paspor" value="<?=  $main['kota_paspor'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Provider</label>
                            <select name="provider" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <?php foreach($provider as $lr) : ?>
                                <option <?=  ($lr['nama_provider'] == $main['provider']) ? "selected" : "";  ?>
                                    value="<?=  $lr['nama_provider'];  ?>"><?=  $lr['nama_provider'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Nomor Visa</label>
                            <input type="text" class="form-control" required placeholder="Nomor Visa" name="nomor_visa"
                                value="<?=  $main['nomor_visa'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">No Tiket Berangkat</label>
                            <input type="text" class="form-control" required placeholder="No Tiket Berangkat" name="tiket_berangkat"
                                value="<?=  $main['tiket_cgk_med'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">No Tiket Pulang</label>
                            <input type="text" class="form-control" required placeholder="No Tiket Pulang" name="tiket_pulang"
                                value="<?=  $main['tiket_med_gk'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal Berlaku Visa</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_berlaku_visa"
                                value="<?=  $main['tgl_awal_visa'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal Habis Visa</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_habis_visa"
                                value="<?=  $main['tgl_akhir_visa'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Muassasah</label>
                            <select name="muassasah" required class="form-control" id="">
                                <option value="">Pilih</option>
                                <?php foreach($muasah as $row_dua) : ?>
                                <option <?=  ($row_dua['nama_muassasah'] == $main['muassasah']) ? "selected" : "";  ?>
                                    value="<?=  $row_dua['nama_muassasah'];  ?>"><?=  $row_dua['nama_muassasah'];  ?>
                                </option>
                                <?php endforeach; ?>
                                </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="modal-body">
            <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Nama Jamaah</label>
                            <input type="text" class="form-control" required placeholder="Nama Jamaah" name="nama"
                                value="<?=  $main['nama'];  ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="">Nama Paspor</label>
                            <input type="text" class="form-control" required placeholder="Nama Paspor"
                                name="nama_paspor" value="<?=  $row['nama_paspor'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Nomor Paspor</label>
                            <input type="text" class="form-control" required placeholder="Nomor Paspor"
                                name="nomor_paspor" value="<?=  $main['no_paspor'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal Dikeluarkan Paspor</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_keluar_paspor"
                                value="<?=  $main['tgl_keluar_paspor'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Kota Paspor</label>
                            <input type="text" class="form-control" required placeholder="Kota Paspor"
                                name="kota_paspor" value="<?=  $main['kota_paspor'];  ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Provider</label>
                            <select name="provider" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <?php foreach($provider as $lr) : ?>
                                <option <?=  ($lr['nama_provider'] == $main['provider']) ? "selected" : "";  ?>
                                    value="<?=  $lr['nama_provider'];  ?>"><?=  $lr['nama_provider'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Nomor Visa</label>
                            <input type="text" class="form-control" required placeholder="Nomor Visa" name="nomor_visa"
                                value="<?=  $main['nomor_visa'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal Berlaku Visa</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_berlaku_visa"
                                value="<?=  $main['tgl_awal_visa'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal Habis Visa</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_habis_visa"
                                value="<?=  $main['tgl_akhir_visa'];  ?>">
                        </div>
                        <div class="mb-5">
                            <label for="">Muassasah</label>
                            <select name="muassasah" required class="form-control" id="">
                                <option value="">Pilih</option>
                                <?php foreach($muasah as $row_dua) : ?>
                                <option <?=  ($row_dua['nama_muassasah'] == $main['muassasah']) ? "selected" : "";  ?>
                                    value="<?=  $row_dua['nama_muassasah'];  ?>"><?=  $row_dua['nama_muassasah'];  ?>
                                </option>
                                <?php endforeach; ?>
                        </div>
                        
                        <div class="mb-3 " style="display: none !important">
                            <label for="">No Tiket</label>
                            <input type="text" class="form-control" required placeholder="No Tiket" name="no_tiket"
                                value="<?=  $main['no_tiket'];  ?>">
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php endforeach; ?>
<?= $this->endSection(); ?>