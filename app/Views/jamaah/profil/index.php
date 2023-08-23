<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>

<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Profil PPIU</h4>
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
                        <form action="<?= base_url("update_profile");  ?>" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="id_user" value="<?= session()->get("travel_id");  ?>">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h5>Informasi Travel</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="">Nama Perusahaan*</label>
                                                <br>
                                                <select name="nama_perusahaan" class="form-control select223" id="perusahaan" required>
                                                    <option value="">Pilih</option>
                                                    <?php foreach ($perusahaan as $pr) : ?>
                                                        <option value="<?= $pr['nama_travel']; ?>" <?= ($pr['nama_travel'] == $profil['nama_perusahaan']) ? "selected" : ""; ?>><?= $pr['nama_travel']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Nama Travel Umrah*</label>
                                                <input type="text" name="nama_travel" value="<?= $profil['nama_travel_umrah'];  ?>" required class="form-control" placeholder="Nama Travel Umrah">
                                            </div>
                                            <div class="mb-3">
                                                <label for="">NPWP</label>
                                                <input type="text" name="npwp" value="<?= $profil['npwp'];  ?>"  class="form-control" placeholder="NPWP">
                                            </div>
                                            <div class="mb-3">
                                                <label for="">No Sk</label>
                                                <input type="text" name="no_sk" value="<?= $profil['no_sk'];  ?>"  class="form-control" placeholder="No Sk">
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Tanggal Sk</label>
                                                <input type="date" name="tgl_sk" value="<?= $profil['tgl_sk'];  ?>"  class="form-control" placeholder="Tanggal Sk">
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
                                                <label for="">No Telp*</label>
                                                <input type="number" name="no_telp" value="<?= $profil['no_telp'];  ?>" required class="form-control" placeholder="No Telp">
                                            </div>
                                            <div class="mb-3">
                                                <label for="">No Hp*</label>
                                                <input type="number" name="no_hp" value="<?= $profil['no_hp'];  ?>" required class="form-control" placeholder="No Hp">
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Email*</label>
                                                <input type="email" name="email" value="<?= $profil['email'];  ?>" required class="form-control" placeholder="Email">
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
                                                <label for="">Alamat Mekkah*</label>
                                                <textarea name="alamat_mekkah" class="form-control" placeholder="Alamat Mekkah" id="" cols="30" rows="10"><?= $profil['alamat_mekkah'];  ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">No Telp Mekkah*</label>
                                                <input type="number" class="form-control" placeholder="No Telp Mekkah" name="no_telp_mekkah" value="<?= $profil['no_telp_mekkah'];  ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Alamat Madinah*</label>
                                                <textarea name="alamat_madinah" class="form-control" placeholder="Alamat Madinah" id="" cols="30" rows="10"><?= $profil['alamat_madinah'];  ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">No Telp Madinah*</label>
                                                <input type="number" class="form-control" placeholder="No Telp Madinah" name="no_telp_madinah" value="<?= $profil['no_telp_madinah'];  ?>">
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
                                            <?php if ($profil) : ?>
                                                <div class="wrapper mb-3" style="width: 100%;height:100%">
                                                    <img src="<?= base_url("assets/upload/" . $profil['foto_kantor']);  ?>" alt="" style="width: 100%;height:100%;object-fit: cover">
                                                </div>
                                                <input type="hidden" name="foto_lama" value="<?= $profil['foto_kantor'];  ?>">
                                                <div class="mb-3">
                                                    <label for="">Foto Kantor</label>
                                                    <input type="file" name="file" class="form-control">
                                                </div>
                                            <?php else : ?>
                                                <div class="mb-3">
                                                    <label for="">Foto Kantor*</label>
                                                    <input type="file" name="file" class="form-control" required>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h5>Logo Travel</h5>
                                        </div>
                                        <div class="card-body">
                                            <?php if ($profil && $profil['logo_travel'] != null) : ?>
                                                <div class="wrapper mb-3" style="width: 60%;height:60%">
                                                    <img src="<?= base_url("assets/upload/" . $profil['logo_travel']);  ?>" alt="" style="width: 100%;height:100%;object-fit: cover">
                                                </div>
                                                <input type="hidden" name="foto_lama_logo" value="<?= $profil['logo_travel'];  ?>">
                                                <div class="mb-3">
                                                    <label for="">Logo Travel</label>
                                                    <input type="file" name="file_logo" class="form-control">
                                                </div>
                                            <?php else : ?>
                                                <div class="mb-3">
                                                    <label for="">Logo Travel*</label>
                                                    <input type="file" name="file_logo" class="form-control" required>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </form>
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
    $('.select223').select2();
</script>
<?= $this->endSection(); ?>