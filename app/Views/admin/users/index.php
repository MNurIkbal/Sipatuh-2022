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
                        <h4>Travel</h4>
                        <!-- <a href="" data-toggle="modal" data-target="#tambah" class="btn btn-primary">Tambah</a> -->
                        <a href="<?=  base_url("profile_user");  ?>" title="Tambah" class="btn btn-primary">Tambah</a>
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
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Perusahaan</th>
                                        <th>Travel</th>
                                        <th>No Telpon</th>
                                        <th>NPWP</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($travel as $row) :?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td>
                                            <?=  $row['nama_perusahaan'];  ?>
                                        </td>
                                        <td>
                                            <?= $row['nama_travel_umrah'] ?>
                                        </td>
                                        <td><?=  $row['no_telp'];  ?></td>
                                        <td><?=  $row['npwp'];  ?></td>
                                        <td><?=  $row['email'];  ?></td>
                                        <td><?=  $row['alamat'];  ?></td>
                                        <td>
                                            <a href="<?=  base_url("user_travel/" . $row['id']);  ?>" 
                                                class="btn btn-warning" title="Data Users">
                                                <i class="fas fa-users"></i>
                                            </a>
                                            <a href="#" data-toggle="modal" data-target="#show<?= $row['id'] ?>"
                                                class="btn btn-primary" title="Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="<?= base_url("edit_travel_baru/" . $row['id'] ); ?>"
                                                class="btn btn-success" title="Edit">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <a href="#" title="Hapus" class="btn btn-danger" data-toggle="modal"
                                                data-target="#hapus_user<?= $row['id'] ?>"><i
                                                    class="fas fa-trash"></i></a>
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
<?php foreach($travel as $users) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="hapus_user<?= $users['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_users");  ?>"
            class="modal-content">
            <input type="text" class="d-none" value="<?=  $users['id'];  ?>" name="id">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Travel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Apakah Anda Yakin Ingin Menghapus?</h5>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <button type="submit" class="btn btn-primary">Iya</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="edit<?= $users['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_travel");  ?>"
            class="modal-content">
            <input type="text" class="d-none" value="<?=  $users['id'];  ?>" name="id">
            <div class="modal-header">
                <h5 class="modal-title">Edit Travel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                                        value="<?=  $users['nama_perusahaan'];  ?>" required class="form-control"
                                        placeholder="Nama Perusahaan"> -->
                                        <select name="nama_perusahaan" class="form-control" required  id="">
                                            <option value="">Pilih</option>
                                            <?php foreach($perusahaan as $main_duat) : ?>
                                                <option <?=  ($main_duat['nama_travel'] == $users['nama_perusahaan']) ? "selected" : "";  ?> value="<?=  $main_duat['nama_travel'];  ?>"><?=  $main_duat['nama_travel'];  ?></option>
                                                <?php endforeach; ?>
                                        </select>
                                </div>
                                <div class="mb-3">
                                    <label for="">Nama Travel Umrah</label>
                                    <input type="text" name="nama_travel" value="<?=  $users['nama_travel_umrah'];  ?>"
                                        required class="form-control" placeholder="Nama Travel Umrah">
                                </div>
                                <div class="mb-3">
                                    <label for="">NPWP</label>
                                    <input type="text" name="npwp" value="<?=  $users['npwp'];  ?>" required
                                        class="form-control" placeholder="NPWP">
                                </div>
                                <div class="mb-3">
                                    <label for="">No Sk</label>
                                    <input type="text" name="no_sk" value="<?=  $users['no_sk'];  ?>" required
                                        class="form-control" placeholder="No Sk">
                                </div>
                                <div class="mb-3">
                                    <label for="">Tanggal Sk</label>
                                    <input type="date" name="tgl_sk" value="<?=  $users['tgl_sk'];  ?>" required
                                        class="form-control" placeholder="Tanggal Sk">
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
                                    <input type="number" name="no_telp" value="<?=  $users['no_telp'];  ?>" required
                                        class="form-control" placeholder="No Telp">
                                </div>
                                <div class="mb-3">
                                    <label for="">No Hp</label>
                                    <input type="number" name="no_hp" value="<?=  $users['no_hp'];  ?>" required
                                        class="form-control" placeholder="No Hp">
                                </div>
                                <div class="mb-3">
                                    <label for="">Email</label>
                                    <input type="email" name="email" value="<?=  $users['email'];  ?>" required
                                        class="form-control" placeholder="Email">
                                </div>
                                <div class="mb-3">
                                    <label for="">Website</label>
                                    <input type="text" name="website" value="<?=  $users['website'];  ?>" required
                                        class="form-control" placeholder="Website">
                                </div>
                                <div class="mb-3">
                                        <label for="">Provinsi</label>
                                        <!-- <input type="text" name="provinsi" 
                                            required class="form-control" placeholder="Provinsi"> -->
                                            <select name="provinsi" id="provinsi" class="form-control" required>
                                                <option value="">Pilih</option>
                                                <?php foreach($provinsi as $main_dua) :  ?>
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
                                                <textarea name="alamat_mekkah" class="form-control"  placeholder="Alamat Mekkah" id="" cols="30" rows="10"><?=  $users['alamat_mekkah'];  ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">No Telp Mekkah</label>
                                                <input type="number" class="form-control" value="<?=  $users['no_telp_mekkah'];  ?>" placeholder="No Telp Mekkah" name="no_telp_mekkah" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Alamat Madinah</label>
                                                <textarea name="alamat_madinah" class="form-control"  placeholder="Alamat Madinah" id="" cols="30" rows="10"><?=  $users['alamat_madinah'];  ?></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">No Telp Madinah</label>
                                                <input type="number" class="form-control" placeholder="No Telp Madinah" name="no_telp_madinah"  value="<?=  $users['no_telp_madinah'];  ?>">
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
                                                        <input type="hidden" name="file_kantor_lama" value="<?=  $users['foto_kantor'];  ?>">
                                                        <input type="hidden" name="file_logo_lama" value="<?=  $users['logo_travel'];  ?>">
                                                        <label for="">Foto Kantor</label>
                                                        <input type="file" name="file" class="form-control" >
                                                        <?php if(isset($validation)) : ?>
                                                            <?php endif; ?>
                                                            <div class="invalid-feedback">
                                                                <?=  $validation->hasError("file");  ?>
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
                                                        <input type="file" name="file_logo" class="form-control" >
                                                    </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="show<?= $users['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Travel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-group">
                            <h4>Informasi Travel</h4>
                                <li class="list-group-item">Nama Perusahaan : <?=  $users['nama_perusahaan'];  ?></li>
                                <li class="list-group-item">Nama Travel : <?=  $users['nama_travel_umrah'];  ?></li>
                                <li class="list-group-item">NPWP : <?=  $users['npwp'];  ?></li>
                                <li class="list-group-item">No SK : <?=  $users['no_sk'];  ?></li>
                                <li class="list-group-item">Tanggal SK : <?=  $users['tgl_sk'];  ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">  
                        <ul class="list-group">
                            <h4>Kontak Travel </h4>
                            <li class="list-group-item">No Telephone : <?=  $users['no_telp'];  ?></li>
                                    <li class="list-group-item">No Hp : <?=  $users['no_hp'];  ?></li>
                            <li class="list-group-item">Email : <?=  $users['email'];  ?></li>
                                    <li class="list-group-item">Website : <?=  $users['website'];  ?></li>
                                    <li class="list-group-item">Provinsi : <?=  $users['provinsi'];  ?></li>
                                    <li class="list-group-item">Kabupaten : <?=  $users['kabupaten'];  ?></li>
                                    <li class="list-group-item">Kecamatan : <?=  $users['kecamatan'];  ?></li>
                                    <li class="list-group-item">Alamat : <?=  $users['alamat'];  ?></li>
                        </ul>
                    </div>
                </div>
                <div class="row mt-5">
                    <div class="col-md-6">
                        <ul class="list-group">
                                <h4>Kontak Travel Arab</h4>
                            <li class="list-group-item">Alamat Mekkah : <?=  $users['alamat_mekkah'];  ?></li>
                                    <li class="list-group-item">No Telephone Mekkah : <?=  $users['no_telp_mekkah'];  ?></li>
                            <li class="list-group-item">Alamat Madinah : <?=  $users['alamat_madinah'];  ?></li>
                                    <li class="list-group-item">No Telephone Madinah : <?=  $users['no_telp_madinah'];  ?></li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-group">
                            <h4>Foto Kantor</h4>
                            <?php if($users['foto_kantor']) : ?>
                                <div style="width: 200px;height: 150px">
                                    <img src="<?=  base_url("assets/upload/" . $users['foto_kantor']);  ?>" alt="" style="width: 100%;height: 100%">
                                </div>
                                <?php endif; ?>
                        </ul>
                        <ul class="list-group mt-3">
                            <h4>Logo Travel</h4>
                            <?php if($users['logo_travel']) : ?>
                                <div style="width: 200px;height: 150px">
                                    <img src="<?=  base_url("assets/upload/" . $users['logo_travel']);  ?>" alt="" style="width: 100%;height: 100%">
                                </div>
                                <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php endforeach; ?>

<?= $this->endSection(); ?>