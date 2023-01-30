<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Laporan Harian</h4>
                        <a href="<?=  base_url("detail_perencanaan_realisasi/$id_kloter/$id_paket/$judul");  ?>" class="btn btn-warning mr-2"><i class="fas fa-arrow-left"></i></a>
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
                            <table class="table table-striped" id="table-16">
                                <thead>
                                    <tr>
                                        <th>Nama File</th>
                                        <th>Foto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php  foreach($result as $row) :
                                        ?>
                                        <tr>
                                            <td><?=  $row['file_name'];  ?></td>
                                            <td>
                                                <div class="wrapper" style="width: 150px;height: 100px;">
                                                    <img src="<?=  base_url("assets/upload/" . $row['file']);  ?>" alt="" style="width: 100%;height: 100%;object-fit: cover;">
                                                </div>
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

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
<script>
    $('#table-16').DataTable();
</script>
<?= $this->endSection(); ?>