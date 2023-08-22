<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Rekening Penampung</h4>
                        <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#tambah">Tambah</a>
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
                                        <th>Nama Bank</th>
                                        <th>Alamat</th>
                                        <th>Nomor Rekening</th>
                                        <th>Pemilik Rekening</th>
                                        <th>Aktif</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($rekening as $row) :
                                        ?>
                                    <tr>
                                        <td><?=  $no++;  ?></td>
                                        <td><?=  $row['bank'];  ?></td>
                                        <td><?=  $row['alamat'];  ?></td>
                                        <td><?=  $row['no_rekening'];  ?></td>
                                        <td><?=  $row['nama'];  ?></td>
                                        <?php if($row['status'] == "aktif") : ?>
                                            <td><?=  $row['status'];  ?></td>
                                            <?php else: ?>
                                                <td>Tidak Aktif</td>
                                            <?php endif; ?>
                                        <td>
                                            <a href="#" data-toggle="modal" data-target="#edit<?= $row['id'] ?>"
                                                class="btn btn-success"><i class="fa fa-pen"></i></a>
                                            <a href="#" data-toggle="modal" data-target="#hapus<?= $row['id'] ?>"
                                                class="btn btn-danger"><i class="fa fa-trash"></i></a>
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
<?php foreach($rekening as $main) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_rekening");  ?>"
            class="modal-content">
            <input type="text" class="d-none" value="<?=  $main['id'];  ?>" name="id">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Rekening Penampung</h5>
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_rekening");  ?>"
            class="modal-content">
            <input type="text" class="d-none" value="<?=  $main['id'];  ?>" name="id">
            <div class="modal-header">
                <h5 class="modal-title">Edit Rekening Penampung</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Bank*</label>
                    <br>
                    <select style="width: 100% !important;" name="bank" class="form-control selectlama<?= $main['id'] ?>" required  id="">
                        <option value="">Pilih</option>
                        <?php foreach($bank as $banks) : ?>
                                <option value="<?=  $banks['nama_bank'];  ?>" <?= ($banks['nama_bank'] == $main['bank']) ? "selected" : ""; ?>><?=  $banks['nama_bank'];  ?></option>
                                <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Alamat*</label>
                    <textarea name="alamat" class="form-control " required placeholder="Alamat"  id="" cols="30" rows="10"><?=  $main['alamat'];  ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="">Nomor Rekening*</label>
                    <input type="number" class="form-control" required placeholder="No Rekening" name="no_rekening" value="<?=  $main['no_rekening'];  ?>">
                </div>
                <div class="mb-3">
                    <label for="">Nama Pemilik Rekening*</label>
                    <input type="text" class="form-control" required name="nama_pemilik" placeholder="Nama Pemilik Rekening" value="<?=  $main['nama'];  ?>">
                </div>
                <div class="mb-3">
                    <div class="col d-flex">
                          <label class="colorinput">
                            <input id="aktif" name="status" <?=  ($main['status'] == "aktif") ? "checked" : "";  ?> value="aktif" type="checkbox" value="danger" class="colorinput-input" />
                            <span class="colorinput-color bg-primary"></span>
                        </label>
                        <label for="aktif" style="transform: translateY(0px) !important;transform: translateX(10px) !important;">Aktif</span>
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
    <?php endforeach; ?>
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_rekening");  ?>"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Rekening Penampung</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Bank*</label>
                    <br>
                    <select style="width: 100% !important;" name="bank" class="form-control selectbaru" required  id="">
                        <option value="">Pilih</option>
                        <?php foreach($bank as $banks) : ?>
                                <option value="<?=  $banks['nama_bank'];  ?>"><?=  $banks['nama_bank'];  ?></option>
                                <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Alamat*</label>
                    <textarea name="alamat" class="form-control " required placeholder="Alamat"  id="" cols="30" rows="10"></textarea>
                </div>
                <div class="mb-3">
                    <label for="">Nomor Rekening*</label>
                    <input type="number" class="form-control" required placeholder="No Rekening" name="no_rekening">
                </div>
                <div class="mb-3">
                    <label for="">Nama Pemilik Rekening*</label>
                    <input type="text" class="form-control" required name="nama_pemilik" placeholder="Nama Pemilik Rekening">
                </div>
                <div class="mb-3">
                    <div class="col d-flex">
                          <label class="colorinput">
                            <input id="aktif" name="status" value="aktif" type="checkbox" value="danger" class="colorinput-input" />
                            <span class="colorinput-color bg-primary"></span>
                        </label>
                        <label for="aktif" style="transform: translateY(0px) !important;transform: translateX(10px) !important;">Aktif</span>
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
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php foreach($rekening as $ma) : ?>
    <script>
        $('.selectlama<?= $ma['id'] ?>').select2({
        dropdownParent: $("#edit<?= $ma['id'] ?>")
    });     
    </script>
    <?php endforeach; ?>
<script>
    $('.selectbaru').select2({
        dropdownParent: $('#tambah')
    });
    
</script>
<?= $this->endSection(); ?>