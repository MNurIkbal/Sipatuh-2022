<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>User cabang</h4>
                        <a href="<?=  base_url("cabang");  ?>" class="btn btn-warning mr-2">Kembali</a>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah</a>
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
                            <table class="table table-border table-hover table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Foto</th>
                                        <th>Nama Cabang</th>
                                        <th>No Hp</th>
                                        <th>Email</th>
                                        
                                        <th>Dibuat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $nomor = 1; foreach($user as $kloters) : ?>
                                    <tr>
                                        <td><?=  $nomor++;  ?></td>
                                        <td>
                                            <div style="width: 90px !important;height: 80px">
                                                <img src="<?=  base_url("assets/upload/" . $kloters['img']);  ?>"
                                                    alt="" style="width: 100%;height: 100%" class="img-thumbnail">
                                            </div>
                                        </td>
                                        <td><?=  $kloters['nama'];  ?></td>
                                        <td><?=  $kloters['no_hp'];  ?></td>
                                        <td><?=  $kloters['username'];  ?></td>
                                        <td><?=  date("d-m-Y",strtotime($kloters['created_at']));  ?></td>
                                        <td>
                                            <a href="#" class="btn btn-success" title="Edit" data-toggle="modal"
                                                data-target="#edit<?= $kloters['id'] ?>"><i class="fa fa-pen"></i></a>
                                            <a href="#" class="btn btn-danger" data-toggle="modal"
                                                data-target="#hapus<?= $kloters['id'] ?>" title="Hapus"><i
                                                    class="fa fa-trash"></i></a>
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
        <form method="POST" action="<?=  base_url("tambah_user_cabang");  ?>" enctype="multipart/form-data"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <input type="hidden" name="id_cabang"   value="<?=  $id_cabang;  ?>">
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" name="nama" required placeholder="Nama">
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="username" required placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="">Password</label>
                    <input type="password" class="form-control" name="password" required placeholder="Password">
                </div>
                <div class="mb-3">
                    <label for="">Foto</label>
                    <input type="file" class="form-control" name="file" required placeholder="file">
                </div>
                <div class="mb-3">
                    <label for="">No Hp</label>
                    <input type="number" class="form-control" name="no_hp" required placeholder="No Hp">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<?php foreach($user as $rows) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="edit<?=  $rows['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="<?=  base_url("edit_user_cabang");  ?>" enctype="multipart/form-data"
            class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id" value="<?=  $rows['id'];  ?>">
                <input type="hidden" name="id_cabang" value="<?=  $id_cabang;  ?>">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" name="nama" required placeholder="Nama" value="<?=  $rows['nama'];  ?>">
                </div>
                <div class="mb-3">
                    <label for="">Email</label>
                    <input type="text" class="form-control" name="username" required placeholder="Email" value="<?=  $rows['username'];  ?>">
                </div>
                <div class="mb-3">
                <div class="mb-4" style="width: 150px;height: 150px;">
                            <img src="<?= base_url("assets/upload/" . $rows['img']); ?>" alt="" class="img-thumbnail img-fluid w-100 h-100">
                    </div>  
                    <label for="">Foto</label>
                    <input type="hidden" name="file_lama" value="<?=  $rows['img'];  ?>">
                    <input type="file" class="form-control" name="file"  placeholder="file">
                </div>
                <div class="mb-3">
                    <label for="">No Hp</label>
                    <input type="number" class="form-control" name="no_hp" required placeholder="No Hp" value="<?=  $rows['no_hp'];  ?>">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="hapus<?=  $rows['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="<?=  base_url("hapus_user_cabang");  ?>" enctype="multipart/form-data"
            class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id" value="<?=  $rows['id'];  ?>">
                <h5 class="modal-title">Hapus User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <h5 class="text-center">Apakah Anda Yakin Ingin Menghapus?</h5>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Hapus</button>
            </div>
        </form>
    </div>
</div>
<?php endforeach; ?>

<?= $this->endSection(); ?>