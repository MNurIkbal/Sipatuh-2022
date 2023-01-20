<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<?php
$validation = \Config\Services::validation();
?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Travel</h4>
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
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url("edit_travel");  ?>" >
                            <input type="text" class="d-none" value="<?= $users['id'];  ?>" name="id">
                            <div class="modal-bodys">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-success text-white">
                                                <h5>Informasi Travel</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="">Nama Perushaan</label>
                                                    <!-- <input type="text" name="nama_perusahaan"
                                        value="<?= $users['nama_perusahaan'];  ?>" required class="form-control"
                                        placeholder="Nama Perusahaan"> -->
                                                    <select name="nama_perusahaan" class="form-control" required id="">
                                                        <option value="">Pilih</option>
                                                        <?php foreach ($perusahaan as $main_duat) : ?>
                                                            <option <?= ($main_duat['nama_travel'] == $users['nama_perusahaan']) ? "selected" : "";  ?> value="<?= $main_duat['nama_travel'];  ?>"><?= $main_duat['nama_travel'];  ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Nama Travel Umrah</label>
                                                    <input type="text" name="nama_travel" value="<?= $users['nama_travel_umrah'];  ?>" required class="form-control" placeholder="Nama Travel Umrah">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">NPWP</label>
                                                    <input type="text" name="npwp" value="<?= $users['npwp'];  ?>" required class="form-control" placeholder="NPWP">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">No Sk</label>
                                                    <input type="text" name="no_sk" value="<?= $users['no_sk'];  ?>" required class="form-control" placeholder="No Sk">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Tanggal Sk</label>
                                                    <input type="date" name="tgl_sk" value="<?= $users['tgl_sk'];  ?>" required class="form-control" placeholder="Tanggal Sk">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-success text-white">
                                                <h5>Kontak Travel</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="">No Telp</label>
                                                    <input type="number" name="no_telp" value="<?= $users['no_telp'];  ?>" required class="form-control" placeholder="No Telp">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">No Hp</label>
                                                    <input type="number" name="no_hp" value="<?= $users['no_hp'];  ?>" required class="form-control" placeholder="No Hp">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Email</label>
                                                    <input type="email" name="email" value="<?= $users['email'];  ?>" required class="form-control" placeholder="Email">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Website</label>
                                                    <input type="text" name="website" value="<?= $users['website'];  ?>" required class="form-control" placeholder="Website">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Provinsi</label>
                                                    <!-- <input type="text" name="provinsi" 
                                            required class="form-control" placeholder="Provinsi"> -->
                                                    <select name="provinsi" id="provinsi" class="form-control" required>
                                                        <option value="">Pilih</option>
                                                        <?php foreach ($provinsi as $main_dua) :  ?>
                                                            <option value="<?= $main_dua['id'] . '-' . $main_dua['name']; ?>" <?= ($main_dua['name'] == $users['provinsi']) ? "selected" : ""; ?>><?= $main_dua['name']; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Kabupaten</label>
                                                    <select name="kabupaten" id="kabupaten" class="form-control" required>
                                                        <!-- <option value=""></option> -->
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Kecamatan</label>
                                                    <select name="kecamatan" id="kecamatan" class="form-control" required>

                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Alamat</label>
                                                    <textarea name="alamat" class="form-control" required placeholder="Alamat" id="" cols="30" rows="10"><?= $users['alamat']; ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header text-white bg-success">
                                                <h5>Kontak Travel Di Arab</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="">Alamat Mekkah</label>
                                                    <textarea name="alamat_mekkah" class="form-control" placeholder="Alamat Mekkah" id="" cols="30" rows="10"><?= $users['alamat_mekkah'];  ?></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">No Telp Mekkah</label>
                                                    <input type="number" class="form-control" value="<?= $users['no_telp_mekkah'];  ?>" placeholder="No Telp Mekkah" name="no_telp_mekkah">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">Alamat Madinah</label>
                                                    <textarea name="alamat_madinah" class="form-control" placeholder="Alamat Madinah" id="" cols="30" rows="10"><?= $users['alamat_madinah'];  ?></textarea>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="">No Telp Madinah</label>
                                                    <input type="number" class="form-control" placeholder="No Telp Madinah" name="no_telp_madinah" value="<?= $users['no_telp_madinah'];  ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-success text-white">
                                                <h5>Foto Kantor</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <input type="hidden" name="file_kantor_lama" value="<?= $users['foto_kantor'];  ?>">
                                                    <input type="hidden" name="file_logo_lama" value="<?= $users['logo_travel'];  ?>">
                                                    <label for="">Foto Kantor</label>
                                                    <input type="file" name="file" class="form-control">
                                                    <?php if (isset($validation)) : ?>
                                                    <?php endif; ?>
                                                    <div class="invalid-feedback">
                                                        <?= $validation->hasError("file");  ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card">
                                            <div class="card-header bg-success text-white">
                                                <h5>Logo Travel</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="mb-3">
                                                    <label for="">Logo Travel</label>
                                                    <input type="file" name="file_logo" class="form-control">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footers bg-whitesmokes br">
                                <a href="<?= base_url("users"); ?>" class="btn btn-secondary" >Kembali</a>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $("#provinsi").change(function() {
        let val = $(this).val()
        $.ajax({
            url: "<?= base_url("ambil_provinsi") ?>/" + val,
            success: function(data) {
                $("#kabupaten").html(data)
            }
        });

        $("#kabupaten").change(function() {
            let kab = $(this).val()
            $.ajax({
                url: "<?= base_url('ambil_kabupaten') ?>/" + kab,
                success: function(data_dua) {
                    $("#kecamatan").html(data_dua)
                }
            })
        });


        $("#kecamatan").change(function() {
            let kec = $(this).val()
            $.ajax({
                url: "<?= base_url("ambil_kecamatan") ?>/" + kec,
                success: function(data_tiga) {
                    $("#kelurahan").html(data_tiga)
                }
            })
        })
    });
</script>
<?= $this->endSection(); ?>