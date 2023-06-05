<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Testimoni</h4>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah</a>
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
                                                <a href="#" class="btn btn-sm btn-success"><i class="fas fa-pen"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
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
                                        <th>Judul</th>
                                        <th>Dilihat</th>
                                        <th>Lokasi</th>
                                        <th>Dibuat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="tambahs">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="<?= base_url("tambah_artikel");  ?>" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Artikel</h5>
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
                    <label for="">Judul</label>
                    <input type="text" class="form-control" name="judul" required placeholder="Judul">
                </div>
                <div class="mb-3">
                    <label for="">Lokasi</label>
                    <input type="text" class="form-control" name="lokasi" required placeholder="Lokasi">
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
<?php foreach ($result as $dua) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="edits<?= $dua->id ?>">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="<?= base_url("edit_artikel");  ?>" enctype="multipart/form-data" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Artikel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Gambar</label>
                        <input type="file" class="form-control" name="file" placeholder="">
                    </div>
                    <div class="mb-3">
                        <label for="">Judul</label>
                        <input type="text" class="form-control" name="judul" required placeholder="Judul">
                    </div>
                    <div class="mb-3">
                        <label for="">Lokasi</label>
                        <input type="text" class="form-control" name="lokasi" required placeholder="Lokasi">
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
    <div class="modal fade" tabindex="-1" role="dialog" id="hapuss<?= $dua->id ?>">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="<?= base_url("hapus_artikel");  ?>" enctype="multipart/form-data" class="modal-content">
                <input type="hidden" name="id" value="<?= $dua->id; ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Layanan</h5>
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