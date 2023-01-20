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
                        <form action="<?=  base_url("update_profile_users");  ?>" enctype="multipart/form-data" method="POST">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h5>Informasi Travel</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="">Nama Perushaan</label>
                                                <input type="text" name="nama_perusahaan"
                                                    value="" required
                                                    class="form-control" placeholder="Nama Perusahaan">
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Nama Travel Umrah</label>
                                                <input type="text" name="nama_travel"
                                                    required
                                                    class="form-control" placeholder="Nama Travel Umrah">
                                            </div>
                                            <div class="mb-3">
                                                <label for="">NPWP</label>
                                                <input type="text" name="npwp" 
                                                    required class="form-control" placeholder="NPWP">
                                            </div>
                                            <div class="mb-3">
                                                <label for="">No Sk</label>
                                                <input type="text" name="no_sk"
                                                    required class="form-control" placeholder="No Sk">
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Tanggal Sk</label>
                                                <input type="date" name="tgl_sk" 
                                                    required class="form-control" placeholder="Tanggal Sk">
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
                                        <input type="number" name="no_telp" 
                                            required class="form-control" placeholder="No Telp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">No Hp</label>
                                        <input type="number" name="no_hp"  required
                                            class="form-control" placeholder="No Hp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Email</label>
                                        <input type="email" name="email"  required
                                            class="form-control" placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Website</label>
                                        <input type="text" name="website" required
                                            class="form-control" placeholder="Website">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Provinsi</label>
                                        <input type="text" name="provinsi" 
                                            required class="form-control" placeholder="Provinsi">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Kabupaten</label>
                                        <input type="text" name="kabupaten"
                                            required class="form-control" placeholder="Kabupaten">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Kecamatan</label>
                                        <input type="text" name="kecamatan"
                                            required class="form-control" placeholder="Kecamatan">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" class="form-control" required placeholder="Alamat" id=""
                                            cols="30" rows="10"></textarea>
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
                                                <textarea name="alamat_mekkah" class="form-control"  placeholder="Alamat Mekkah" id="" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">No Telp Mekkah</label>
                                                <input type="number" class="form-control" placeholder="No Telp Mekkah" name="no_telp_mekkah" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Alamat Madinah</label>
                                                <textarea name="alamat_madinah" class="form-control"  placeholder="Alamat Madinah" id="" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">No Telp Madinah</label>
                                                <input type="number" class="form-control" placeholder="No Telp Madinah" name="no_telp_madinah" >
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
                                                        <label for="">Foto Kantor</label>
                                                        <input type="file" name="file" class="form-control" >
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
                                                        <input type="file" name="file_logo" class="form-control" >
                                                    </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <a href="<?=  base_url("users");  ?>" class="btn btn-warning">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection(); ?>