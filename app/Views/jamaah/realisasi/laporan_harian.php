<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan Harian</h4>
                        <a href="<?=  base_url("detail_realisasi/$id_kloter/$id_paket");  ?>" class="btn btn-warning mr-2"><i class="fas fa-arrow-left"></i></a>
                        <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#add">Tambah</button>
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
                                        <th>Nama File</th>
                                        <th>Foto</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no =1;  foreach($result as $row) :
                                        ?>
                                        <tr>
                                            <td><?=  $no++;  ?></td>
                                            <td><?=  $row['file_name'];  ?></td>
                                            <td>
                                                <div class="wrapper" style="width: 150px;height: 100px;">
                                                    <img src="<?=  base_url("assets/upload/" . $row['file']);  ?>" alt="" style="width: 100%;height: 100%;object-fit: cover;">
                                                </div>
                                            </td>
                                            <td>
                                                <a href="#"   class="btn btn-danger" data-toggle="modal"
                                            data-target="#hapus<?= $row['id'] ?>"><i class="fa fa-trash"></i></a>
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
<div class="modal fade" tabindex="-1" role="dialog" id="add">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_laporan_harian");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket;  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter;  ?>">
            <input type="text" class="d-none" name="id_kasus" value="<?=  $id_kasus;  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Laporan Harian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Foto</label>
                    <input type="file" class="form-control" required placeholder="Foto" name="file" required>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php foreach($result as $main) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_laporan_harian");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket;  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter;  ?>">
            <input type="text" class="d-none" name="id_kasus" value="<?=  $id_kasus;  ?>">
            <input type="text" class="d-none" name="id_laporan_harian" value="<?=  $main['id'];  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Laporan Harian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <h5 class="text-center">Apakah Anda Yakin Ingin Menghapus?</h5>
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