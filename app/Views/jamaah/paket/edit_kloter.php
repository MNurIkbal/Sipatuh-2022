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
                <h4>Edit Kloter</h4>
            </div>
            <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url("edit_kloter");  ?>" >
                    <input type="text" class="d-none" name="id_paket" value="<?= $result['id'];  ?>">
                    <input type="text" class="d-none" name="id" value="<?= $kloter_satu['id'];  ?>">
                    <div >
                        <div class="mb-3">
                            <label for="">Nama Kloter*</label>
                            <input type="text" name="kloter" class="form-control" required placeholder="Nama Kloter" value="<?= $kloter_satu['nama'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Batas Jamaah*</label>
                            <input value="<?= $kloter_satu['batas_jamaah']; ?>" type="number" name="batas" class="form-control" required placeholder="Batas Jamaah">
                        </div>
                        <div class="mb-3">
                            <label for="">Status*</label>
                            <select name="status" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="Aktif" <?= ($kloter_satu['status'] == "Aktif") ? "selected" : "";  ?>>Aktif</option>
                                <option <?= ($kloter_satu['status'] == "Tidak Aktif") ? "selected" : "";  ?> value="Tidak Aktif">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                        <a href="<?= base_url('detail_paket/'.$result['id']); ?>" class="btn btn-dark">Kembali</a>
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
    $('#keberangkatan_id').daterangepicker({
        opens: 'left',
        locale: {
            format: 'D/MM/YYYY' // Format tanggal dengan bulan angka (contoh: 18 08 2023)

        }
    });
</script>
<?= $this->endSection(); ?>