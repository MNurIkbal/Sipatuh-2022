<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Petugas</h4>
                        <a href="" data-toggle="modal" data-target="#tambah" class="btn btn-primary">Tambah</a>
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
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Petugas</th>
                                        <th>Type</th>
                                        <th>No Hanphone</th>
                                        <th>Email</th>
                                        <th>Aktif</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($petugas as $row) :?>
                                        <tr>
                                            <td><?=  $no++;  ?></td>
                                            <td><small><?=  $row['nama'];  ?></small>
                                        <br>
                                        <small>KTP : <?=  $row['no_ktp'];  ?></small>
                                        <br>
                                        <small>Paspor : <?=  $row['no_paspor'];  ?></small>
                                    </td>
                                    <td>
                                        <?=  $row['tipe_petugas'];  ?>
                                    </td>
                                    <td>
                                        <?=  $row['no_hp_satu'];  ?>
                                    </td>
                                    <td><?=  $row['email'];  ?></td>
                                    <?php if($row['aktif'] == null) : ?>
                                        <td>Tidak Aktif</td>
                                        <?php else: ?>
                                            <td><?=  $row['aktif'];  ?></td>
                                            <?php endif; ?>
                                            <td>
                                                <a href="#"  data-toggle="modal" data-target="#edit<?= $row['id'] ?>"  class=" btn btn-success"><i class="fa fa-pen"></i></a>
                                                <a href="#"  data-toggle="modal" data-target="#hapus<?= $row['id'] ?>"  class=" btn btn-danger"><i class="fa fa-trash"></i></a>
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
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("add_petugas");  ?>"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" required placeholder="Nama" name="nama">
                </div>
                <div class="mb-3">
                    <label for="">No KTP</label>
                    <input type="number" class="form-control" required placeholder="No KTP" name="no_ktp">
                </div>
                <div class="mb-3">
                    <label for="">No Paspor</label>
                    <input type="text" class="form-control" required placeholder="No Paspor" name="no_paspor">
                </div>
                <div class="mb-3">
                    <label for="">Type Petugas</label>
                    <select name="type" class="form-control" required id="">
                        <option value="">Pilih</option>
                        <?php foreach($level as $levels) : ?>
                            <option value="<?=  $levels['nama'];  ?>"><?=  $levels['nama'];  ?></option>
                            <?php endforeach; ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="mb-3">
                    <label for="">No Handphone Satu</label>
                    <input type="number" class="form-control" required placeholder="No Handphone Satu" name="hp_satu">
                </div>
                    </div>
                    <div class="col-md-6">
                    <div class="mb-3">
                    <label for="">No Handphone Dua</label>
                    <input type="number" class="form-control" required placeholder="No Handphone Dua" name="hp_dua">
                </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="">Foto</label>
                    <input type="file" class="form-control" required placeholder="" name="file">
                </div>
                <div class="mb-3">
                    <label for="">Tanggal Lahir</label>
                    <input type="date" class="form-control" required placeholder="" name="tgl_lahir">
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" required placeholder="Email" name="email">
                </div>
                <div class="mb-3">
                    <label for="">Alamat</label>
                    <textarea name="alamat" class="form-control" required placeholder="Alamat" id="" cols="30" rows="10"></textarea>
                </div>
                <div class="col d-flex">
                          <label class="colorinput">
                            <input id="aktif" name="aktif" value="aktif" type="checkbox" value="danger" class="colorinput-input" />
                            <span class="colorinput-color bg-primary"></span>
                        </label>
                        <label for="aktif" style="transform: translateY(0px) !important;transform: translateX(10px) !important;">Aktif</span>
                    </div>  
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php foreach($petugas as $main) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_petugas_baru/$main[id]");  ?>"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Petugas</h5>
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
    <div class="modal fade" tabindex="-1" role="dialog" id="edit<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_petugas_baru/$main[id]");  ?>"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" required placeholder="Nama" name="nama" value="<?=  $main['nama'];  ?>">
                </div>
                <div class="mb-3">
                    <label for="">No KTP</label>
                    <input type="number" class="form-control" required placeholder="No KTP" name="no_ktp" value="<?=  $main['no_ktp'];  ?>">
                </div>
                <div class="mb-3">
                    <label for="">No Paspor</label>
                    <input type="text" class="form-control" required placeholder="No Paspor" name="no_paspor" value="<?=  $main['no_paspor'];  ?>">
                </div>
                <div class="mb-3">
                    <label for="">Type Petugas</label>
                    <select name="type" class="form-control" required id="">
                        <option value="">Pilih</option>
                        <?php foreach($level as $levels) : ?>
                            <option <?=  ($main['tipe_petugas'] == $levels['nama']) ? "selected" : "";  ?> value="<?=  $levels['nama'];  ?>"><?=  $levels['nama'];  ?></option>
                            <?php endforeach; ?>
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="mb-3">
                    <label for="">No Handphone Satu</label>
                    <input type="number" class="form-control" required placeholder="No Handphone Satu" name="hp_satu" value="<?=  $main['no_hp_satu'];  ?>">
                </div>
                    </div>
                    <div class="col-md-6">
                    <div class="mb-3">
                    <label for="">No Handphone Dua</label>
                    <input type="number" class="form-control" required placeholder="No Handphone Dua" name="hp_dua" value="<?=  $main['no_hp_dua'];  ?>">
                </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="">Foto</label>
                    <input type="hidden" name="file_lama" value="<?=  $main['foto'];  ?>">
                    <input type="file" class="form-control"  placeholder="" name="file">
                </div>
                <div class="mb-3">
                    <label for="">Tanggal Lahir</label>
                    <input type="date" class="form-control" required placeholder="" name="tgl_lahir" value="<?=  $main['tgl_lahir'];  ?>">
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" required placeholder="Email" name="email" value="<?=  $main['email'];  ?>">
                </div>
                <div class="mb-3">
                    <label for="">Alamat</label>
                    <textarea name="alamat" class="form-control" required placeholder="Alamat" id="" cols="30" rows="10"><?=  $main['alamat'];  ?></textarea>
                </div>
                <div class="col d-flex">
                          <label class="colorinput">
                            <input id="aktif" <?=  ($main['aktif'] == "aktif") ? "checked" : "";  ?> name="aktif" value="aktif" type="checkbox" value="danger" class="colorinput-input" />
                            <span class="colorinput-color bg-primary"></span>
                        </label>
                        <label for="aktif" style="transform: translateY(0px) !important;transform: translateX(10px) !important;">Aktif</span>
                    </div>  
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
    <?php endforeach; ?>
<?= $this->endSection(); ?>