<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="main-content">
    <section class="section">
        <div class="card">
            <?php if (session()->get("success")) : ?>
                <div class="m-3 alert alert-success">
                    <span><?= session()->get("success");  ?></span>
                </div>
            <?php elseif (session()->get("error")) : ?>
                <div class="m-3 alert alert-danger">
                    <span><?= session()->get("error");  ?></span>
                </div>
            <?php endif; ?>
            <div class="card-header">
                <h4>Edit Keberangkatan</h4>
            </div>
            <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url("edit_keberangkatan");  ?>" >
                    <input type="text" class="d-none" name="id_paket" value="<?= $result['id'];  ?>">
                    <input type="text" class="d-none" name="id" value="<?= $main_dua['id'];  ?>">
                    <div >
                        <div class="row">
                            <div class="col-md-6">
                            <div class="mb-3">
                            <label for="">Nomor Penerbangan</label>
                            <input type="text" class="form-control" required placeholder="Nomor Penerbangan" name="nomor" value="<?= $main_dua['nomor'];  ?>">
                        </div>
                                <div class="mb-3">
                                    <label for="">Bandara Berangkat</label>
                                    <br>
                                    <select style="width: 100% !important;" name="bandara_berangkat" class="form-control select24" required id="">
                                        <option value="">Pilih</option>
                                        <?php foreach ($bandara as $main_duat) : ?>
                                            <option <?= ($main_duat['nama'] == $main_dua['nama_bandara']) ? "selected" : "";  ?> value="<?= $main_duat['nama'];  ?>"><?= $main_duat['nama'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Tanggal Keberangkatan & Kepulangan</label>
                                    <input type="text" readonly id="tgl_waktu" class="form-control" required placeholder="" name="tgl_berangkat" >
                                </div>
                            </div>
                            <div class="col-md-6">
                            <div class="mb-3">
                            <label for="">Maskapai</label>
                            <br>
                            <select style="width: 100% !important;" name="maskapai" class="form-control select24" required id="">
                                <option value="">Pilih</option>
                                <?php foreach ($maskapai as $main_satu_empat) : ?>
                                    <option <?= ($main_satu_empat['nama_maskapai'] == $main_dua['maskapai']) ? "selected" : "";  ?> value="<?= $main_satu_empat['nama_maskapai'];  ?>">
                                        <?= $main_satu_empat['nama_maskapai'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                                <div class="mb-3">
                                    <label for="">Bandara Tiba</label>
                                    <br>
                                    <select style="width: 100% !important;" name="bandara_tiba" class="form-control select24" required id="">
                                        <option value="">Pilih</option>
                                        <?php foreach ($bandara as $main_duat_satu) : ?>
                                            <option <?= ($main_duat_satu['nama'] == $main_dua['bandara_tiba']) ? "selected" : "";  ?> value="<?= $main_duat_satu['nama'];  ?>"><?= $main_duat_satu['nama'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                        <a href="<?= base_url('detail_paket/' . $result['id']); ?>"  class="btn btn-dark" >Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </section>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
    $(".select24").select2()
    $('#tgl_waktu').daterangepicker({
    timePicker: true,
    startDate: moment().startOf('hour'),
    endDate: moment().startOf('hour').add(32, 'hour'),
    locale: {
        format: 'D/MM/YYYY HH:mm'
    }
  });
</script>
<?= $this->endSection(); ?>