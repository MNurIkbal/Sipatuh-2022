<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Banner</h4>
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
                            <table class="table table-striped table-hover" id="myTable">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Banner</th>
                                        <th>Dibuat</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Akhir</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($banner as $row) :?>
                                        <tr>
                                            <td><?=  $no++;  ?></td>
                                    <td>
                                        <div style="width: 100px;height: 100px">
                                        <img src="<?=  base_url("assets/upload/" . $row['foto']);  ?>" alt="" style="width: 100%;height: 100%;object-fit: cover;">
                                        </div>
                                    </td>
                                    <td><span class="badge badge-pill badge-success"><?=  date("d, F Y",strtotime($row['created_at']));  ?></span></td>
                                    <td><span class="badge badge-pill badge-danger"><?=  date("d, F Y",strtotime($row['star']));  ?></span></td>
                                    <td><span class="badge badge-pill badge-danger"><?=  date("d, F Y",strtotime($row['expired']));  ?></span></td>
                                    <td>
                                        <?php 
                                        $mulai = date("Y-m-d",strtotime($row['star']));
                                        $sekarang = date("Y-m-d");
                                        $waktus = date("Y-m-d",strtotime($row['expired']));
                                        if($sekarang < $mulai) :
                                        ?>
                                            <span class="badge badge-pill badge-warning">Belum Aktif</span>
                                            <?php elseif($sekarang > $waktus): ?>
                                                <span class="badge badge-pill badge-danger">Tidak Aktif</span>
                                        <?php else: ?>
                                            <span class="badge badge-pill badge-primary">Aktif</span>
                                        <?php endif; ?>
                                    </td>
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("add_banner");  ?>"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="mb-3">
                    <label for="">Foto*</label>
                    <input type="file" class="form-control" required placeholder="Nama" name="file">
                </div>
            <div class="mb-3">
                    <label for="">Waktu Mulai*</label>
                    <input type="date" class="form-control" required placeholder="" name="start">
                </div>
            <div class="mb-3">
                    <label for="">Waktu Akhir*</label>
                    <input type="date" class="form-control" required placeholder="" name="expired">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php foreach($banner as $main) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_banner/$main[id]");  ?>"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Banner</h5>
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_banner/$main[id]");  ?>"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="mb-3">
                <input type="hidden" name="file_lama" value="<?=  $main['foto'];  ?>">
                    <label for="">Foto*</label>
                    <input type="file" class="form-control"  placeholder="Nama" name="file">
                </div>
                <div class="mb-3">
                    <label for="">Waktu Mulai*</label>
                    <input type="date" class="form-control" required placeholder="" name="start" value="<?= $row['star']; ?>">
                </div>
            <div class="mb-3">
                    <label for="">Waktu Akhir*</label>
                    <input type="date" class="form-control" required placeholder="" name="expired" value="<?= $row['expired']; ?>">
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
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script>
       $(document).ready( function () {
    $('#myTable').DataTable();
} );
    </script>
<?= $this->endSection(); ?>