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
                <h4>Edit Kepulangan</h4>
            </div>
            <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url("edit_kepulangan_satu");  ?>" >
                    <input type="text" class="d-none" name="id_paket" value="<?= $result['id'];  ?>">
                    <input type="text" class="d-none" name="id" value="<?= $kepulangan_row['id'];  ?>">
                    <input type="text" class="d-none" name="id_kloter" value="<?= $p;  ?>">
                    <div >
                        <div class="mb-3">
                            <label for="">Maskapai*</label>
                            <br>
                            <select name="maskapai" class="form-control select24" required id="" style="width: 100% !important;">
                                <option value="">Pilih</option>
                                <?php foreach ($maskapai as $main_satu_tiga) : ?>
                                    <option <?= ($main_satu_tiga['nama_maskapai'] == $kepulangan_row['maskapai']) ? "selected" : "";  ?> value="<?= $main_satu_tiga['nama_maskapai'];  ?>">
                                        <?= $main_satu_tiga['nama_maskapai'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Nomor Penerbangan*</label>
                            <input type="text" class="form-control" required placeholder="Nomor Penerbangan" name="nomor" value="<?= $kepulangan_row['nomor'];  ?>">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Bandara Berangkat*</label>
                                    <br>
                                    <select name="bandara_berangkat" class="form-control select24" required id="" style="width: 100% !important;">
                                        <option value="">Pilih</option>
                                        <?php foreach ($bandara as $main_duat_satu_empat_lima) : ?>
                                            <option <?= ($main_duat_satu_empat_lima['nama'] == $kepulangan_row['bandara_berangkat']) ? "selected" : "";  ?> value="<?= $main_duat_satu_empat_lima['nama'];  ?>">
                                                <?= $main_duat_satu_empat_lima['nama'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="">Bandara Tiba*</label>
                                    <br>
                                    <select name="bandara_tiba" class="form-control select24" required id="" style="width: 100% !important;">
                                        <option value="">Pilih</option>
                                        <?php foreach ($bandara as $main_duat_satu_empat) : ?>
                                            <option <?= ($main_duat_satu_empat['nama'] == $kepulangan_row['bandara_tiba']) ? "selected" : "";  ?> value="<?= $main_duat_satu_empat['nama'];  ?>">
                                                <?= $main_duat_satu_empat['nama'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                                    <label for="">Tanggal*</label>
                                    <input type="text" class="form-control" id="keberangkatan_id" readonly required placeholder="" name="tgl_berangkat" >
                                </div>
                    </div>
                        <a href="<?= base_url('detail_paket/' . $result['id']); ?>" class="btn btn-secondary" >Kembali</a>
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
    var tgl_berangkat = "<?php echo date('Y/m/d', strtotime($kepulangan_row['tgl_berangkat'])); ?>";
    var jam_berangkat = "<?php echo $kepulangan_row['jam_berangkat']; ?>";
    var tgl_bandara_tiba = "<?php echo date('Y/m/d', strtotime($kepulangan_row['tgl_penerbangan_tiba'])); ?>";
    var jam_tiba = "<?php echo $kepulangan_row['jam_tiba']; ?>";

    var combinedValue = tgl_berangkat + ' ' + jam_berangkat ;
    var dua = tgl_bandara_tiba + ' ' + jam_tiba;
    $('#keberangkatan_id').daterangepicker({
    timePicker: true,
    startDate: moment(combinedValue),
    endDate: moment(dua),
    locale: {
        format: 'D/MM/YYYY HH:mm'
    }
  });
</script>
<?= $this->endSection(); ?>