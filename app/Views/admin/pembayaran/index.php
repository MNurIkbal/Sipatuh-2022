<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>

<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                        <h4>Pembayaran Paket Umrah</h4>
                        </div>
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
                                        <th>Nama Paket</th>
                                        <th>Periode</th>
                                        <th>Biaya</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($data_paket as $row) :
                                        ?>
                                    <?php 
                                        $db      = \Config\Database::connect();
                                        $paket_id = $row['id'];
                                        $pendaftaran = $db->query("SELECT * FROM jamaah WHERE paket_id = '$paket_id' AND kloter_id IS NOT NULL")->getResult();
                                        $setor_awal = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'cicil' AND paket_id = '$paket_id' AND kloter_id IS NOT NULL")->getResult();
                                        $lunas = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'lunas' AND paket_id = '$paket_id' AND kloter_id IS NOT NULL")->getResult();
                                        ?>
                                    <tr>
                                        <td><?=  $no++;  ?></td>
                                        <td><?=  $row['nama'];  ?></td>
                                        <td>
                                            <?=  date("D, d F Y",strtotime($row["tgl_berangkat"])) . " - " . date("D, d F Y",strtotime($row["tgl_pulang"]))  ;  ?>
                                        </td>
                                        <td>
                                            <?=  "Rp." . number_format($row['biaya']);  ?>
                                        </td>
                                        <td>
                                            <a title="Detail" href="<?=  base_url("detail_pembayaran_kloter/$row[id]");  ?>"
                                                class="btn btn-primary"><i class="fa fa-eye"></i></a>
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


<!-- <script src="https://code.jquery.com/jquery-3.6.1.min.js"
    integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".select2").select2();
    $(document).ready(function () {
        
        $('#table-1').DataTable();
        
    });

    
</script>


<?= $this->endSection(); ?>