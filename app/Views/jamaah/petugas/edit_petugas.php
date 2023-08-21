<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Petugas</h4>
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
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url("edit_petugas_baru/$main[id]");  ?>">
                            <div >
                                <div class="mb-3">
                                    <label for="">Nama*</label>
                                    <input type="text" class="form-control" required placeholder="Nama" name="nama" value="<?= $main['nama'];  ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="">No KTP*</label>
                                    <input type="number" class="form-control" required placeholder="No KTP" name="no_ktp" value="<?= $main['no_ktp'];  ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="">No Paspor*</label>
                                    <input type="text" class="form-control" required placeholder="No Paspor" name="no_paspor" value="<?= $main['no_paspor'];  ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="">Type Petugas*</label>
                                    <br>
                                    <select name="type" class="form-control select_edit<?= $main['id'] ?>" required id="" style="width: 100% !important;">
                                        <option value="">Pilih</option>
                                        <?php foreach ($level as $levels) : ?>
                                            <option <?= ($main['tipe_petugas'] == $levels['nama']) ? "selected" : "";  ?> value="<?= $levels['nama'];  ?>"><?= $levels['nama'];  ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">No Handphone Satu*</label>
                                            <input type="number" class="form-control" required placeholder="No Handphone Satu" name="hp_satu" value="<?= $main['no_hp_satu'];  ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">No Handphone Dua</label>
                                            <input type="number" class="form-control" required placeholder="No Handphone Dua" name="hp_dua" value="<?= $main['no_hp_dua'];  ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="">Foto</label>
                                    <input type="hidden" name="file_lama" value="<?= $main['foto'];  ?>">
                                    <input type="file" class="form-control" placeholder="" name="file">
                                </div>
                                <div class="mb-3">
                                    <label for="">Tanggal Lahir*</label>
                                    <input type="date" class="form-control" required placeholder="" name="tgl_lahir" value="<?= $main['tgl_lahir'];  ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="">Email*</label>
                                    <input type="email" class="form-control" required placeholder="Email" name="email" value="<?= $main['email'];  ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="">Alamat*</label>
                                    <textarea name="alamat" class="form-control" required placeholder="Alamat" id="" cols="30" rows="10"><?= $main['alamat'];  ?></textarea>
                                </div>
                                <div class="col d-flex">
                                    <label class="colorinput">
                                        <input id="aktif" <?= ($main['aktif'] == "aktif") ? "checked" : "";  ?> name="aktif" value="aktif" type="checkbox" value="danger" class="colorinput-input" />
                                        <span class="colorinput-color bg-primary"></span>
                                    </label>
                                    <label for="aktif" style="transform: translateY(0px) !important;transform: translateX(10px) !important;">Aktif</span>
                                </div>
                            </div>
                            <a href="<?= base_url('petugas'); ?>" class="btn btn-dark" >Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $('.select_petugas').select2();
</script>

<?= $this->endSection(); ?>