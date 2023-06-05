<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Layanan</h4>
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
                                        <th>Icon</th>
                                        <th>Judul</th>
                                        <th>Pesan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($layanan as $row) : ?>
                                        <tr>
                                            <td>
                                                <?= $no++; ?>
                                            </td>
                                            <td>
                                                <i class="<?= $row->icon ?>"></i>
                                            </td>
                                            <td>
                                                <?= $row->title; ?>
                                            </td>
                                            <td>
                                                <?= $row->text; ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edit<?= $row->id ?>"><i class="fas fa-pen"></i></a>
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
                        <h4>Artikel</h4>
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
                                    <?php $nos = 1; foreach($artikel as $rows) : ?>
                                        <tr>
                                            <td>
                                                <?= $nos++; ?>
                                            </td>
                                            <td>
                                                <div style="width: 60px;height: 50px;">
                                                    <img src="<?= base_url('company/img/' . $rows->img); ?>" alt="" style="width: 100%;height: 100%;object-fit: contain;">
                                                </div>
                                            </td>
                                            <td>
                                                <?= $rows->title; ?>
                                            </td>
                                            <td>
                                                <?= $rows->lihat; ?>
                                            </td>
                                            <td>
                                                <?= $rows->lokasi; ?>
                                            </td>
                                            <td>
                                                <?= date("d, F Y",strtotime($rows->created_at)); ?>
                                            </td>
                                            <td>
                                                <a href="#" class="btn btn-sm btn-success" data-toggle="modal" data-target="#edits<?= $rows->id ?>"><i class="fas fa-pen"></i></a>
                                                <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapuss<?= $rows->id ?>"><i class="fas fa-trash"></i></a>
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
<div class="modal fade" tabindex="-1" role="dialog" id="tambahs">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="<?=  base_url("tambah_artikel");  ?>" enctype="multipart/form-data"
            class="modal-content">
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
<?php foreach($artikel as $dua) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="edits<?= $dua->id ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="<?=  base_url("edit_artikel");  ?>" enctype="multipart/form-data"
            class="modal-content">
            <input type="hidden" name="id" value="<?= $dua->id; ?>">
            <input type="hidden" name="img_lama" value="<?= $dua->img; ?>">
            <div class="modal-header">
                <h5 class="modal-title">Edit Artikel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Gambar</label>
                    <input type="file" class="form-control" name="file"  placeholder="">
                </div>
                <div class="mb-3">
                    <label for="">Judul</label>
                    <input type="text" class="form-control" name="judul" value="<?= $dua->title; ?>" required placeholder="Judul">
                </div>
                <div class="mb-3">
                    <label for="">Lokasi</label>
                    <input type="text" class="form-control" value="<?= $dua->lokasi; ?>" name="lokasi" required placeholder="Lokasi">
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
<div class="modal fade" tabindex="-1" role="dialog" id="hapuss<?= $dua->id ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="<?=  base_url("hapus_artikel");  ?>" enctype="multipart/form-data"
            class="modal-content">
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
<?php foreach($layanan as $r) : ?>
    
    <div class="modal fade" tabindex="-1" role="dialog" id="edit<?= $r->id ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="<?=  base_url("edit_layanan");  ?>" enctype="multipart/form-data"
            class="modal-content">
            <input type="hidden" name="id" value="<?= $r->id; ?>">
            <div class="modal-header">
                <h5 class="modal-title">Edit Layanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama Icon</label>
                    <input type="text" class="form-control" name="icon" required placeholder="Nama Icon" value="<?= $r->icon; ?>">
                    <small>Contoh : fas fa-pen (Font mengambil dari fontawesome)</small>
                </div>
                <div class="mb-3">
                    <label for="">Judul</label>
                    <input type="text" class="form-control" name="judul" required placeholder="Judul" value="<?= $r->title; ?>">
                </div>
                <div class="mb-3">
                    <label for="">Pesan</label>
                    <textarea name="pesan" class="form-control" required id="" cols="30" rows="10"><?= $r->text; ?></textarea>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
    <div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $r->id ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="<?=  base_url("hapus_layanan");  ?>" enctype="multipart/form-data"
            class="modal-content">
            <input type="hidden" name="id" value="<?= $r->id; ?>">
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