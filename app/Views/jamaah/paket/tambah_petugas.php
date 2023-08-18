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
                <h4>Tambah Petugas</h4>
            </div>
            <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="<?= base_url("tambah_petugas");  ?>" >
                <input type="text" class="d-none" name="id" value="<?= $result['id'];  ?>">
                <div>
                    <div class="mb-3">
                        <label for="">Nama Petugas</label>
                        <br>
                        <select name="petugas" class="form-control select24" style="width: 100% !important;" required id="">
                            <option value="">Pilih</option>
                            <?php foreach ($petugas_umrah as $petugasumrah) : ?>
                                <option value="<?= $petugasumrah['id'];  ?>"><?= $petugasumrah['nama'];  ?> -
                                    <?= $petugasumrah['tipe_petugas'];  ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <a href="<?= base_url("detail_paket/" . $result['id']);  ?>" class="btn btn-warning">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
                    </div>
        </div>
    </section>
</div>



<script>
    $(".select24").select2()
</script>
<?= $this->endSection(); ?>