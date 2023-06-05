<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Testimoni</h4>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#add">Tambah</a>
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


                        <div class="table-responsive">
                            <table class="table table-border table-hover table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Nama</th>
                                        <th>Profesi</th>
                                        <th>Pesan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $r = 1;
                                    foreach ($result as $satu) : ?>
                                        <tr>
                                            <td><?= $r++; ?></td>
                                            <td>
                                                <div style="width: 70px;height:70px">
                                                    <img src="<?= base_url('company/img/' . $satu->img); ?>" style="width: 100%;height:100%" class="img-fluid" alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <?= $satu->nama; ?>
                                            </td>
                                            <td>
                                                <?= $satu->profesi; ?>
                                            </td>
                                            <td>
                                                <?= $satu->pesan; ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#update<?= $satu->id ?>"><i class="fas fa-pen"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#delete<?= $satu->id ?>"><i class="fas fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4>Galeri</h4>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambahs">Tambah</a>
                    </div>

                    <div class="card-body">


                        <div class="table-responsive">
                            <table class="table table-border table-hover table-striped" id="table-2">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Gambar</th>
                                        <th>Dibuat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $t = 1;
                                    foreach ($galeri as $tiga) : ?>
                                        <tr>
                                            <td><?= $t++; ?></td>
                                            <td>
                                                <div style="width: 90px;height: 90px;">
                                                    <img src="<?= base_url('company/img/' . $tiga->img); ?>" style="width: 100%;height: 100%;object-fit: contain;" alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <?= date("d, F Y", strtotime($tiga->created_at)); ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hilang<?= $tiga->id ?>"><i class="fas fa-trash"></i></a>
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
        <form method="POST" action="<?= base_url("tambah_testimoni");  ?>" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Testimoni</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Gambar</label>
                    <input type="file" class="form-control" name="file" required placeholder="">
                </div>
                <div class="mb-3">
                    <label for="">Nama</label>
                    <input type="text" class="form-control" name="nama" required placeholder="Nama">
                </div>
                <div class="mb-3">
                    <label for="">Profesi</label>
                    <input type="text" class="form-control" name="profesi" required placeholder="Profesi">
                </div>
                <div class="mb-3">
                    <label for="">Pesan</label>
                    <textarea name="pesan" class="form-control" required id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="tambahs">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="<?= base_url("tambah_galeri");  ?>" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Galeri</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Gambar</label>
                    <input type="file" class="form-control" name="file" required placeholder="">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php foreach ($result as $dua) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="update<?= $dua->id ?>">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="<?= base_url("edit_testimoni");  ?>" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <input type="hidden" name="id" value="<?= $dua->id; ?>">
                    <h5 class="modal-title">Edit Testimoni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Gambar</label>
                        <input type="hidden" name="img_lama" value="<?= $dua->img; ?>">
                        <input type="file" class="form-control" name="file" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="nama" required value="<?= $dua->nama; ?>" placeholder="Nama">
                    </div>
                    <div class="mb-3">
                        <label for="">Profesi</label>
                        <input type="text" class="form-control" name="profesi" required placeholder="Profesi" value="<?= $dua->profesi; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Pesan</label>
                        <textarea name="pesan" class="form-control" required id="" cols="30" rows="10"><?= $dua->pesan; ?></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="delete<?= $dua->id ?>">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="<?= base_url("hapus_testimoni");  ?>" enctype="multipart/form-data" class="modal-content">
                <input type="hidden" name="id" value="<?= $dua->id; ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Testimoni</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Apakah Anda Ingin Menghapus Data Ini!</h5>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Iya</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>
<?php foreach ($galeri as $empat) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="hilang<?= $empat->id ?>">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="<?= base_url("hapus_galeri");  ?>" enctype="multipart/form-data" class="modal-content">
                <input type="hidden" name="id" value="<?= $empat->id; ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Galeri</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5>Apakah Anda Ingin Menghapus Data Ini!</h5>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Iya</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>

<?= $this->endSection(); ?>