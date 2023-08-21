<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Petugas</h4>
                        <a href="<?= base_url('tambah_petugas_baru'); ?>" class="btn btn-primary">Tambah</a>
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
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Petugas</th>
                                        <th>Type</th>
                                        <th>No Hanphone</th>
                                        <th>Email</th>
                                        <th>Aktif</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($petugas as $row) :?>
                                        <tr>
                                            <td><?=  $no++;  ?></td>
                                            <td><small><?=  $row['nama'];  ?></small>
                                        <br>
                                        <small>KTP : <?=  $row['no_ktp'];  ?></small>
                                        <br>
                                        <small>Paspor : <?=  $row['no_paspor'];  ?></small>
                                    </td>
                                    <td>
                                        <?=  $row['tipe_petugas'];  ?>
                                    </td>
                                    <td>
                                        <?=  $row['no_hp_satu'];  ?>
                                    </td>
                                    <td><?=  $row['email'];  ?></td>
                                    <?php if($row['aktif'] == null) : ?>
                                        <td>Tidak Aktif</td>
                                        <?php else: ?>
                                            <td><?=  $row['aktif'];  ?></td>
                                            <?php endif; ?>
                                            <td>
                                                <a href="<?= base_url('edit_petugas_barus/' . $row['id']); ?>"   class=" btn btn-success"><i class="fa fa-pen"></i></a>
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

<?php foreach($petugas as $main) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_petugas_baru/$main[id]");  ?>"
            class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Petugas</h5>
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
    <?php endforeach; ?>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
  <script>
       $('.select_petugas').select2({
        dropdownParent: $('#tambah')
    });
  </script>
  <?php foreach($petugas as $rt) : ?>
    <script>
        $(".select_edit<?= $rt['id'] ?>").select2({
            dropdownParent: $('#edit<?= $rt['id'] ?>')
        })
    </script>
    <?php endforeach; ?>
<?= $this->endSection(); ?>