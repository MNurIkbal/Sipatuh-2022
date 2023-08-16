<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>

<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Paket Umrah</h4>
                    </div>
                    <?php

                    if (session()->get("success")) : ?>
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
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Nama Paket</th>
                                        <th>Periode</th>
                                        <th>Biaya</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($paket as $row) : ?>
                                        <?php if ($row) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td><?= $row['nama']; ?></td>
                                                <td><?= date("d, F Y", strtotime($row['tgl_berangkat'])); ?> - <?= date("d, F Y", strtotime($row['tgl_pulang'])); ?></td>
                                                <td>Rp. <?= number_format($row['biaya'], 0); ?></td>
                                                <td><a href="<?= base_url("detail_paket_user/" . $row['id']); ?>" class="btn btn-success"><i class="fas fa-eye"></i></a></td>
                                            </tr>
                                        <?php endif; ?>
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


<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#table-2').DataTable();
        $('#table-1').DataTable();
        $('#table-3').DataTable();
    });
</script>
<?= $this->endSection(); ?>