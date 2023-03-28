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
                        <h4>Users</h4>
                        <a href="<?=  base_url("users");  ?>" class="btn btn-warning mr-4">Kembali</a>
                        <a href="#" data-toggle="modal" data-target="#tambah" class="btn btn-primary">Tambah</a>
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
                                        <th>Foto</th>
                                        <th>Nama</th>
                                        
                                        <th>Email</th>
                                        <th>No Hp</th>
                                        <th>Dibuat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($user as $row) :?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td>
                                            <div style="width: 50px;height: 50px">
                                        <img src="<?=  base_url("assets/upload/" . $row['img']);  ?>" alt="" style="width: 100%;height: 100%;border-radius: 50%;">
                                            </div>
                                        </td>
                                        <td>
                                            <?= $row['nama'] ?>
                                        </td>
                                        
                                        <td><?=  $row['email'];  ?></td>
                                        <td><?=  $row['no_hp'];  ?></td>
                                        <td><?=  date("d F Y",strtotime($row['created_at']));  ?></td>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#edit<?= $row['id'] ?>"
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
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("add_users");  ?>"
            class="modal-content">
            <input type="hidden" name="id" value="<?=  $id;  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah User</h5>
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
                    <label for="">Password</label>
                    <input type="password" class="form-control" required placeholder="Password" name="password">
                </div>
                <div class="mb-3">
                    <label for="">Level Akses</label>
                    <select name="level" class="form-control" required id="">
                        <option value="">Pilih</option>
                        <option value="jamaah">Travel</option>
                        <!-- <option value="admin">Admin</option> -->
                    </select>
                </div>
                <div class="row">
                    <div class="col-md-6">
                    <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" required placeholder="Email" name="email">
                </div>
                    </div>
                    <div class="col-md-6">
                    <div class="mb-3">
                    <label for="">No Hp</label>
                    <input type="number" class="form-control" required placeholder="No Hp" name="no_hp">
                </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="">Foto</label>
                    <input type="file" class="form-control" required placeholder="file" name="file">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php foreach($user as $users) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="hapus_user<?= $users['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_users_baru");  ?>"
            class="modal-content">
            <input type="text" class="d-none" value="<?=  $users['id'];  ?>" name="id">
            <input type="text" class="d-none" value="<?=  $id;  ?>" name="id_travel">
            <div class="modal-header">
                <h5 class="modal-title">Hapus User</h5>
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_users");  ?>"
            class="modal-content">
            <input type="text" class="d-none" value="<?=  $users['id'];  ?>" name="id">
            <div class="modal-header">
                <h5 class="modal-title">Edit Users</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" required placeholder="Nama" name="nama" value="<?=  $users['nama'];  ?>">
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                    <div class="mb-3">
                    <label for="">Email</label>
                    <input type="email" class="form-control" required placeholder="Email" name="email" value="<?=  $users['email'];  ?>">
                </div>
                    </div>
                    <div class="col-md-6">
                    <div class="mb-3">
                    <label for="">No Hp</label>
                    <input type="number" class="form-control" required placeholder="No Hp" name="no_hp" value="<?=  $users['no_hp'];  ?>">
                </div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="mb-4" style="width: 150px;height: 150px;">
                            <img src="<?= base_url("assets/upload/" . $users['img']); ?>" alt="" class="img-thumbnail img-fluid w-100 h-100">
                    </div>  
                    <label for="">Foto</label>  
                    <input type="hidden" name="travel_id" value="<?=  $id;  ?>">
                    <input type="hidden" name="file_lama" value="<?=  $users['img'];  ?>">
                    <input type="file" class="form-control"  placeholder="file" name="file">
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