<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Tiket</h4>
                    </div>
                    <?php if (session()->get("success")) : ?>
                        <div class="m-3 alert alert-success">
                            <span><?= session()->get("success");  ?></span>
                        </div>
                    <?php elseif (session()->get("error")) : ?>
                        <div class="m-3 alert alert-danger">
                            <span><?= session()->get("error");  ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <b>

                            <span>Nama Paket : <?= $paket['nama'] ?></span>
                            <br>
                            <span>Periode :
                                <?= date("d F Y", strtotime($paket['tgl_berangkat'])) . ' - ' . date("d, F Y", strtotime($paket['tgl_pulang']));  ?></span>
                            <br>
                            <span>Kode Paket : <?= $paket['kode_paket'];  ?></span>
                        </b>
                        <br>
                        <br>
                        <div >
                            <div>
                                <form method="POST" enctype="multipart/form-data" action="<?= base_url("update_tiket/$main[id]");  ?>" class="mt-3">
                                    <input type="hidden" name="id_paket" value="<?= $id;  ?>">
                                    <input type="hidden" name="id_kloter" value="<?= $id_kloter;  ?>">
                                    <div class="modal-bodsy">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="">Nama Jamaah</label>
                                                    <input type="text" class="form-control" required placeholder="Nama Jamaah" name="nama" value="<?= $main['nama'];  ?>" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Nama Paspor</label>
                                                    <input type="text" class="form-control" required placeholder="Nama Paspor" name="nama_paspor" value="<?= $main['nama_paspor'];  ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Nomor Paspor</label>
                                                    <input type="text" class="form-control" required placeholder="Nomor Paspor" name="nomor_paspor" value="<?= $main['no_paspor'];  ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Tanggal Dikeluarkan Paspor</label>
                                                    <input type="date" class="form-control" required placeholder="" name="tgl_keluar_paspor" value="<?= $main['tgl_keluar_paspor'];  ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Kota Paspor</label>
                                                    <input type="text" class="form-control" required placeholder="Kota Paspor" name="kota_paspor" value="<?= $main['kota_paspor'];  ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Provider</label>
                                                    <select name="provider" class="form-control" required id="provider">
                                                        <option value="">Pilih</option>
                                                        <?php foreach ($provider as $lr) : ?>
                                                            <option <?= ($lr['nama_provider'] == $main['provider']) ? "selected" : "";  ?> value="<?= $lr['nama_provider'];  ?>"><?= $lr['nama_provider'];  ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="">Nomor Visa</label>
                                                    <input type="text" class="form-control" required placeholder="Nomor Visa" name="nomor_visa" value="<?= $main['nomor_visa'];  ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">No Tiket Berangkat</label>
                                                    <input type="text" class="form-control" required placeholder="No Tiket Berangkat" name="tiket_berangkat" value="<?= $main['tiket_cgk_med'];  ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">No Tiket Pulang</label>
                                                    <input type="text" class="form-control" required placeholder="No Tiket Pulang" name="tiket_pulang" value="<?= $main['tiket_med_gk'];  ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Tanggal Berlaku Visa</label>
                                                    <input type="date" class="form-control" required placeholder="" name="tgl_berlaku_visa" value="<?= $main['tgl_awal_visa'];  ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Tanggal Habis Visa</label>
                                                    <input type="date" class="form-control" required placeholder="" name="tgl_habis_visa" value="<?= $main['tgl_akhir_visa'];  ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">No Kursi</label>
                                                    <input type="text" class="form-control" required placeholder="" name="no_kursi" value="<?= $main['no_kursi'];  ?>">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Muassasah</label>
                                                    <select name="muassasah" required class="form-control" id="muas">
                                                        <option value="">Pilih</option>
                                                        <?php foreach ($muasah as $row_dua) : ?>
                                                            <option <?= ($row_dua['nama_muassasah'] == $main['muassasah']) ? "selected" : "";  ?> value="<?= $row_dua['nama_muassasah'];  ?>"><?= $row_dua['nama_muassasah'];  ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footesr bg-whitesmokes br">
                                        <a href="<?= base_url("detail_kloter_tiket/$id_kloter/$id"); ?>" class="btn btn-danger">Kembali</a>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $("#muas").select2()
    $("#provider").select2()
</script>
<?= $this->endSection(); ?>