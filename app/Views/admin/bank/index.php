<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Bank</h4>
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
                                        <th>Nama Bank</th>
                                        <th>Kode Bank</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($bank as $row) :?>
                                        <tr>
                                            <td><?=  $no++;  ?></td>
                                    <td>
                                        <?=  $row['kode_bank'];  ?>
                                    </td>
                                    <td>
                                        <?=  $row['nama_bank'];  ?>
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("add_data_bank");  ?>"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="mb-3">
                    <label for="">Kode Bank*</label>
                    <input type="text" class="form-control" required placeholder="Kode Bank" name="kode">
                </div>
            <div class="mb-3">
                    <label for="">Nama Bank*</label>
                    <input type="text" class="form-control" required placeholder="Nama Bank" name="nama">
                </div>
                
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php foreach($bank as $main) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_data_bank/$main[id]");  ?>"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Bank</h5>
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_data_bank/$main[id]");  ?>"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Bank</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="mb-3">
                    <label for="">Kode Bank*</label>
                    <input type="text" class="form-control" required placeholder="Kode Bank" name="kode" value="<?=  $main['kode_bank'];  ?>">
                </div>
            <div class="mb-3">
                    <label for="">Nama Bank*</label>
                    <input type="text" class="form-control" required placeholder="Nama Bank" name="nama" value="<?=  $main['nama_bank'];  ?>">
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