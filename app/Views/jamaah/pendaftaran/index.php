<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pendaftaran (Pelaporan Jamaah)</h4>

                    </div>
                    <?php

                    use App\Models\KloterModel;

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
                                        <th class="text-center">#</th>
                                        <th>Paket</th>
                                        <th>Tour Leader</th>
                                        <th>Status Pembayaran</th>
                                        <th>Kelengkapan</th>
                                        <th>Status Berangkat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($result as $row) : ?>
                                        <?php
                                        $db      = \Config\Database::connect();
                                        $paket_id = $row['id'];

                                        $kloter = new KloterModel();
                                        $check_kloter = $kloter->where('paket_id', $row['id'])->where('keberangkatan', 'sudah')->where('status_realisasi', 'sudah')->where('status', 'Aktif')->first();
                                        if ($check_kloter) {
                                            $id_kloters = $check_kloter['id'];
                                            $belum_bayar = $db->query("SELECT * FROM jamaah WHERE paket_id = '$paket_id' AND status_bayar = NULL AND kloter_id = '$id_kloters'")->getResult();
                                            $pendaftaran = $db->query("SELECT * FROM jamaah WHERE paket_id = '$paket_id' AND kloter_id = '$id_kloters'")->getResult();
                                            $setor_awal = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'cicil' AND paket_id = '$paket_id' AND kloter_id = '$id_kloters'")->getResult();
                                            $lunas = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'lunas' AND paket_id = '$paket_id' AND kloter_id = '$id_kloters'")->getResult();

                                            //data
                                            $kk = $db->query("SELECT * FROM jamaah WHERE paket_id = '$paket_id' AND  kloter_id = '$id_kloters'")->getResult();
                                            $ktp = $db->query("SELECT * FROM jamaah WHERE paket_id = '$paket_id' AND kloter_id = '$id_kloters'")->getResult();
                                        } else {
                                            $belum_bayar = $db->query("SELECT * FROM jamaah WHERE paket_id = '$paket_id'  AND status_bayar = NULL AND kloter_id IS NOT NULL")->getResult();
                                            $pendaftaran = $db->query("SELECT * FROM jamaah WHERE paket_id = '$paket_id' AND kloter_id IS NOT NULL")->getResult();
                                            $setor_awal = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'cicil' AND paket_id = '$paket_id' AND kloter_id IS NOT NULL")->getResult();
                                            $lunas = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'lunas' AND paket_id = '$paket_id' AND kloter_id IS NOT NULL")->getResult();

                                            //data
                                            $kk = $db->query("SELECT * FROM jamaah WHERE paket_id = '$paket_id' AND  kloter_id IS NOT NULL")->getResult();
                                            $ktp = $db->query("SELECT * FROM jamaah WHERE paket_id = '$paket_id' AND kloter_id IS NOT NULL")->getResult();
                                        }

                                        ?>
                                        <tr>
                                            <td><?= $no++;  ?></td>
                                            <td>
                                                <a href="">
                                                    <?= $row['nama'];  ?>
                                                </a>
                                                <br>
                                                <?= date("D, d F Y", strtotime($row["tgl_berangkat"])) . " - " . date("D, d F Y", strtotime($row["tgl_pulang"]));  ?>
                                            </td>
                                            <td>
                                                <?= $row['tour_leader']  ?>
                                            </td>
                                            <td>
                                                <span>BELUM BAYAR : <?= count($belum_bayar);  ?> JAMAAH</span>
                                                <br>
                                                <span>BELUM LUNAS : <?= count($setor_awal);  ?> JAMAAH</span>
                                                <br>
                                                <span>LUNAS : <?= count($lunas);  ?> JAMAAH</span>
                                            </td>
                                            <td>
                                                <span>
                                                    KTP : <?= count($ktp);  ?> JAMAAH
                                                </span>
                                                <br>
                                                <span>
                                                    KK : <?= count($kk);  ?> JAMAAH
                                                </span>
                                                <br>
                                            </td>
                                            <td>
                                                <?php if (count($pendaftaran)) : ?>
                                                    <?php if ($row['pemberangkatan'] == "sudah") :  ?>
                                                        <span class="badge badge-pill badge-success">Siap Berangkat</span>
                                                    <?php else : ?>
                                                        <span class="badge badge-pill badge-warning">Masih Pendaftaran</span>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <span class="badge badge-pill badge-danger">Belum Ada Jamaah</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a title="Detail" href="<?= base_url("detail_pendaftaran_kloter/$row[id]");  ?>" class="btn btn-success"><i class="fa fa-user-plus"></i></a>
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
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url("tambah_paket");  ?>" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama Paket</label>
                    <input type="text" class="form-control" required placeholder="Nama Paket" name="nama_paket">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Biaya</label>
                            <input type="number" class="form-control" required placeholder="Biaya   " name="biaya">
                        </div>
                        <div class="mb-3">
                            <label for="">Waktu Berangkat</label>
                            <input type="date" class="form-control" required placeholder="Biaya   " name="waktu_berangkat">
                        </div>
                        <div class="mb-3">
                            <label for="">Keterangan Berangkat</label>
                            <textarea name="ket_berangkat" class="form-control" id="" cols="30" rows="10" placeholder="Keterangan Berangkat"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Provider</label>
                            <input type="text" class="form-control" required placeholder="Provider" name="provider">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Tahun</label>
                            <input type="number" class="form-control" required placeholder="Tahun" name="tahun">
                        </div>
                        <div class="mb-3">
                            <label for="">Waktu Pulang</label>
                            <input type="date" class="form-control" required placeholder="" name="waktu_pulang">
                        </div>
                        <div class="mb-3">
                            <label for="">Status</label>
                            <div class="col d-flex">
                                <label class="colorinput">
                                    <input id="aktif" name="status" value="aktif" type="checkbox" value="danger" class="colorinput-input" />
                                    <span class="colorinput-color bg-primary"></span>
                                </label>
                                <label for="aktif" style="transform: translateY(0px) !important;transform: translateX(10px) !important;">Aktif</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Keterangan Pulang</label>
                            <textarea name="ket_pulang" class="form-control" id="" cols="30" rows="10" placeholder="Keterangan Pulang"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Asuransi</label>
                            <input type="text" class="form-control" required placeholder="Asuransi" name="asuransi">
                        </div>
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
<?php foreach ($result as $main) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $main['id'] ?>">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url("hapus_paket/" . $main['id']);  ?>" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Paket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Apakah Anda Yakin Ingin Menghapus?</h5>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="edit<?= $main['id'] ?>">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url("edit_paket/" . $main['id']);  ?>" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Paket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Nama Paket</label>
                        <input type="text" class="form-control" required placeholder="Nama Paket" name="nama_paket" value="<?= $main['nama'];  ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Biaya</label>
                                <input type="number" class="form-control" required placeholder="Biaya   " name="biaya" value="<?= $main['biaya'];  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Waktu Berangkat</label>
                                <input type="date" class="form-control" required placeholder="Biaya   " name="waktu_berangkat" value="<?= $main['tgl_berangkat'];  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Keterangan Berangkat</label>
                                <textarea name="ket_berangkat" class="form-control" id="" cols="30" rows="10" placeholder="Keterangan Berangkat"><?= $main['ket_berangkat'];  ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Provider</label>
                                <input type="text" class="form-control" required placeholder="Provider" name="provider" value="<?= $main['provider'] ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Tahun</label>
                                <input type="number" class="form-control" required placeholder="Tahun" name="tahun" value="<?= $main['tahun'];  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Waktu Pulang</label>
                                <input type="date" class="form-control" required placeholder="" name="waktu_pulang" value="<?= $main['tgl_pulang'];  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Status</label>
                                <div class="col d-flex">
                                    <label class="colorinput">
                                        <input id="aktif" name="status" value="aktif" type="checkbox" <?= ($main['status'] == "aktif") ? "checked" : "";  ?> value="danger" class="colorinput-input" />
                                        <span class="colorinput-color bg-primary"></span>
                                    </label>
                                    <label for="aktif" style="transform: translateY(0px) !important;transform: translateX(10px) !important;">Aktif</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="">Keterangan Pulang</label>
                                <textarea name="ket_pulang" class="form-control" id="" cols="30" rows="10" placeholder="Keterangan Pulang"><?= $main['ket_pulang'];  ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Asuransi</label>
                                <input type="text" class="form-control" required placeholder="Asuransi" name="asuransi" value="<?= $main['asuransi'];  ?>">
                            </div>
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
<?= $this->endSection(); ?>