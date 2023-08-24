<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Request Jamaah</h4>
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
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Foto</th>
                                        <th>Identitas</th>
                                        <th>No Hanphone</th>
                                        <th>Nama Jamaah</th>
                                        <th>Paket</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($jamaah as $row) : ?>
                                        <tr>
                                            <td><?= $no++;  ?></td>
                                            <td>
                                                <div style="width: 80px;height: 80px">
                                                    <img src="<?= base_url("assets/upload/" . $row['foto']); ?>" style="width: 100%;height: 100%" alt="">
                                                </div>
                                            </td>
                                            <td><small>Nik : <?= $row['no_identitas'];  ?>
                                        </small>
                                                    <br>
                                                    <small>TTL : <?= $row['tempat_lahir'] . ',' .  date("d, F Y", strtotime($row['tgl_lahir']));  ?>
                                                    </small>
                                                    <br>
                                                    <small>No Pasti Umrah : <?= $row['no_pasti_umrah']; ?></small>
                                            <td>
                                                <?= $row['no_hp']; ?>
                                            </td>
                                            <td>
                                                <?= $row['nama_jamaah']; ?>
                                            </td>
                                            <td>
                                                <?= $row['nama_paket']; ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('detail_jamaah_lokasi/' . $row['id']); ?>" class=" btn btn-success"><i class="fa fa-eye"></i></a>
                                                <a href="#" data-toggle="modal" data-target="#hapus<?= $row['id'] ?>" class=" btn btn-warning"><i class="fa fa-edit"></i></a>
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
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?php foreach ($jamaah as $main) : ?>
    

    <div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $main['id'] ?>">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url("pilih_kloter");  ?>" class="modal-content">
                <div class="modal-header">
                    <input type="hidden" name="id_jamaah" value="<?= $main['id']; ?>" class="d-none">
                    <h5 class="modal-title">Pilih Kloter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Kloter</label>
                        <br>
                        <select style="width: 100% !important;" name="kloter" class="form-control sele32<?= $main['id'] ?>" required id="">
                            <?php 
                            $klotes = $kloter->where('paket_id',$main['id_paket'])->where("status","aktif")->where("keberangkatan",NULL)->where("selesai",NULL)->where("status_realisasi",NULL)->where("done",NULL)->findAll();
                            ?>
                            <option value="">Pilih</option>
                            <?php foreach($klotes as $main_tigas) : ?>
                                <option value="<?= $main_tigas['id']; ?>"><?= $main_tigas['nama']; ?></option>
                                <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <script>
         $(".sele32<?= $main['id'] ?>").select2({
        dropdownParent: $("#hapus<?= $main['id'] ?>")
    });
    </script>
<?php endforeach; ?>
<?= $this->endSection(); ?>