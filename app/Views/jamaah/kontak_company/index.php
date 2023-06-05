<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Kontak</h4>
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
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Subjek</th>
                                        <th>Pesan</th>
                                        <th>Dibuat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $rt = 1;
                                    foreach ($kontak as $row) : ?>
                                        <tr>
                                            <td><?= $rt++; ?></td>
                                            <td><?= $row->name; ?></td>
                                            <td><?= $row->email; ?></td>
                                            <td><?= $row->subjek; ?></td>
                                            <td><?= $row->pesan; ?></td>
                                            <td><?= date("d, F Y", strtotime($row->created_at)) ?></td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapus<?= $row->id ?>"><i class="fas fa-trash"></i></a>
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
                        <h4>Slider Gambar</h4>
                        <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#tambah">Tambah</a>
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
                                    <?php $re = 1;
                                    foreach ($slider as $gg) : ?>
                                        <tr>
                                            <td>
                                                <?= $re++; ?>
                                            </td>
                                            <td>
                                                <div style="width: 70px;height: 70px;">
                                                    <img src="<?= base_url('assets/upload/' . $gg->img); ?>" style="width: 100%;height: 100%;object-fit: contain;" alt="">
                                                </div>
                                            </td>
                                            <td>
                                                <?= date("d, F Y",strtotime($gg->created_at)); ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-success"><i class="fas fa-trash"></i></a>
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
        <form method="POST" action="<?= base_url("tambah_slider");  ?>" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Slider</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Gambar</label>
                    <input type="file" class="form-control" name="file" required placeholder="File">
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

<?php foreach ($kontak as $r) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $r->id ?>">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="<?= base_url("hapus_kontak");  ?>" enctype="multipart/form-data" class="modal-content">
                <input type="hidden" name="id" value="<?= $r->id; ?>">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Kontak</h5>
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