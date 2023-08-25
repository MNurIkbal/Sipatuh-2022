<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <h4>Detail Realisasi Paket</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <ul>
                                        <li style="list-style: none;line-height: 40px !important;"><span>Nama Paket : <?= $check_paket['nama'];  ?></span></li>
                                        <li style="list-style: none;line-height: 40px !important;">
                                            <span>Periode :
                                                <?= date("d F Y", strtotime($check_paket['tgl_berangkat'])) . " - " . date("d F Y", strtotime($check_paket['tgl_pulang']));  ?></span>
                                        </li>
                                        <li style="list-style: none;line-height: 40px !important;">
                                            Status :
                                            <span style="text-transform: uppercase">
                                                <?php if ($check_paket['status'] != null) : ?>
                                                    <span class="badge badge-pill badge-primary"><?= $check_paket['status'];  ?></span>
                                                <?php else : ?>
                                                    <span class="badge badge-pill badge-primary">tidak aktif</span>
                                                <?php endif; ?>
                                            </span>
                                        </li>
                                        <li style="list-style: none;line-height: 40px !important;">Provider : <?= $check_paket['provider']; ?></li>
                                        <li style="list-style: none;line-height: 40px !important;">Travel : <?= $nama_travel['nama_travel_umrah']; ?></li>

                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <ul>
                                        <li style="list-style: none;line-height: 40px !important;">Perusahaan : <?= $nama_travel['nama_perusahaan']; ?></li>
                                        <li style="list-style: none;line-height: 40px !important;">Provinsi : <?= $nama_travel['provinsi']; ?></li>
                                        <li style="list-style: none;line-height: 40px !important;">Tahun : <?= date("Y", strtotime($check_paket['tahun'])); ?></li>
                                        <li style="list-style: none;line-height: 40px !important;">Asuransi : <?= $check_paket['asuransi']; ?></li>
                                        <li style="list-style: none;line-height: 40px !important;">Biaya : Rp. <?= number_format($check_paket['biaya'], 0); ?></li>
                                    </ul>
                                </div>
                            </div>

                    </div>

                </div>
                <div class="card">
                    <!-- <div class="card-header">
                        
                    </div> -->
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
                        <div >
                            <div class="card-header">
                                <a href="<?= base_url("detail_realisasi_kloter/" . $id_paket);  ?>" class="btn btn-warning">Kembali</a>
                                <a href="#" data-toggle="modal" data-target="#selesai" class="btn btn-success ml-3">Selesai</a>
                            </div>
                            <div >
                                <ul class="nav nav-pills d-flex justify-content-center" id="myTab3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3" role="tab" aria-controls="home" aria-selected="true">Petugas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3" role="tab" aria-controls="profile" aria-selected="false">Keberangkatan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3" role="tab" aria-controls="contact" aria-selected="false">Hotel</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4" role="tab" aria-controls="contact" aria-selected="false">Kepulangan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact5" role="tab" aria-controls="contact" aria-selected="false">Pelaporan Kasus</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="petugas">
                                    <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                                        <?php if ($result['selesai'] == null) : ?>
                                            <a href="<?= base_url('tambah_petugas_realisasis/' . $id_kloter . '/' . $check_paket['id']); ?>" class="btn btn-primary mb-3" >Tambah</a>
                                        <?php endif; ?>
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Petugas</th>
                                                        <th>Type</th>
                                                        <th>Urutan</th>
                                                        <?php if ($result['selesai'] == null) : ?>
                                                            <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1;
                                                    foreach ($petugas as $rows) : ?>
                                                        <tr>
                                                            <td><?= $nomor++;  ?></td>
                                                            <td><?= $rows['nama'];  ?></td>
                                                            <td><?= $rows['type'];  ?></td>
                                                            <td><?= $nomor++;  ?></td>
                                                            <?php if ($result['selesai'] == null) : ?>
                                                                <td>
                                                                    <a href="<?= base_url('edit_petugas_real/' . $id_kloter . '/'. $result['id'] . '/' . $rows['id']); ?>" class="btn btn-success"><i class="fa fa-pen"></i></a>
                                                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#delete<?= $rows['id'] ?>"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                        <?php if ($result['selesai'] == null) : ?>
                                            <a href="<?= base_url('add_berangkat/' .$id_kloter . '/' . $id_paket); ?>" class="btn btn-primary mb-3" >Tambah</a>
                                        <?php endif; ?>
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-2">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Maskapai</th>
                                                        <th>Nomor Penerbangan</th>
                                                        <th>Bandara Asal</th>
                                                        <th>Tanggal Berangkat</th>
                                                        <th>Jam Berangkat</th>
                                                        <th>Bandara Tiba</th>
                                                        <th>Tanggal Tiba</th>
                                                        <th>Jam Tiba</th>
                                                        <?php if ($result['selesai'] == null) : ?>
                                                            <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1;
                                                    foreach ($keberangkatan as $keberangkatans) : ?>
                                                        <tr>
                                                            <td><?= $nomor++;  ?></td>
                                                            <td><?= $keberangkatans['maskapai'];  ?></td>
                                                            <td><?= $keberangkatans['nomor'];  ?></td>
                                                            <td><?= $keberangkatans['nama_bandara'];  ?></td>
                                                            <td><?= date("d, F Y", strtotime($keberangkatans['tgl_berangkat']));  ?>
                                                            </td>
                                                            <td><?= $keberangkatans['jam_berangkat'];  ?></td>
                                                            <td><?= $keberangkatans['bandara_tiba'];  ?></td>
                                                            <td><?= date("d, F Y", strtotime($keberangkatans['tgl_bandara_tiba']));  ?>
                                                            </td>
                                                            <td><?= $keberangkatans['jam_berangkat'];  ?></td>
                                                            <?php if ($result['selesai'] == null) : ?>
                                                                <td>
                                                                    <a href="<?= base_url('edit_berangkat/' . $keberangkatans['id'] . '/' . $result['id'] . '/' . $id_kloter); ?>" class="btn btn-success"><i class="fa fa-pen"></i></a>
                                                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#hapus_mangkat<?= $keberangkatans['id'] ?>"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                                        <?php if ($result['selesai'] == null) : ?>
                                            <a href="<?= base_url('add_hotel/' . $id_kloter . '/' . $result['id']); ?>" class="btn btn-primary mb-3" >Tambah</a>
                                        <?php endif; ?>
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-3">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Hotel</th>
                                                        <th>Lokasi</th>
                                                        <th>Tanggal Mulai</th>
                                                        <th>Tanggal Selesai</th>
                                                        <th>Orang Perkamar</th>
                                                        <?php if ($result['selesai'] == null) : ?>
                                                            <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1;
                                                    foreach ($hotel as $hotels) : ?>
                                                        <tr>
                                                            <td><?= $nomor++;  ?></td>
                                                            <td><?= $hotels['hotel'];  ?></td>
                                                            <td><?= $hotels['lokasi'];  ?></td>
                                                            <td><?= date("d, F Y", strtotime($hotels['tgl_masuk']));  ?>
                                                            </td>
                                                            <td><?= date("d, F Y", strtotime($hotels['tgl_keluar']));  ?>
                                                            </td>
                                                            <td><?= $hotels['orang_perkamar'];  ?></td>
                                                            <?php if ($result['selesai'] == null) : ?>
                                                                <td>
                                                                    <a href="<?= base_url('edit_hotels/' . $hotels['id'] . '/' . $result['id'] . '/' .  $id_kloter) ?>" class="btn btn-success"><i class="fa fa-pen"></i></a>
                                                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#hapus_hotel<?= $hotels['id'] ?>"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                                        <?php if ($result['selesai'] == null) : ?>
                                            <a href="<?= base_url('add_pulang/' . $id_kloter . '/' . $result['id'] ); ?>" class="btn btn-primary mb-3" >Tambah</a>
                                        <?php endif; ?>
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-4">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Maskapai</th>
                                                        <th>Nomor Penerbangan</th>
                                                        <th>Bandara Asal</th>
                                                        <th>Tanggal Berangkat</th>
                                                        <th>Jam Berangkat</th>
                                                        <th>Bandara Tiba</th>
                                                        <th>Tanggal Tiba</th>
                                                        <th>Jam Tiba</th>
                                                        <?php if ($result['selesai'] == null) : ?>
                                                            <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1;
                                                    foreach ($kepulangan as $kepulangans) : ?>
                                                        <tr>
                                                            <td><?= $nomor++;  ?></td>
                                                            <td><?= $kepulangans['maskapai'];  ?></td>
                                                            <td><?= $kepulangans['nomor'];  ?></td>
                                                            <td><?= $kepulangans['bandara_berangkat'];  ?></td>
                                                            <td><?= date("d, F Y", strtotime($kepulangans['tgl_berangkat']));  ?>
                                                            </td>
                                                            <td><?= $kepulangans['jam_berangkat'];  ?></td>
                                                            <td><?= $kepulangans['bandara_tiba'];  ?></td>
                                                            <td><?= date("d, F Y", strtotime($kepulangans['tgl_penerbangan_tiba']));  ?>
                                                            </td>
                                                            <td><?= $kepulangans['jam_berangkat'];  ?></td>
                                                            <?php if ($result['selesai'] == null) : ?>
                                                                <td>
                                                                    <a href="<?= base_url('edit_pulang_satu/' . $kepulangans['id'] . '/' . $result['id'] . '/' . $id_kloter); ?>" class="btn btn-success" ><i class="fa fa-pen"></i></a>
                                                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#hapus_kepulangan<?= $kepulangans['id'] ?>"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact5" role="tabpanel" aria-labelledby="contact-tab4">
                                        <?php if ($result['selesai'] == null) : ?>
                                            <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#add_kasus">Tambah</button>
                                        <?php endif; ?>
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-5">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kasus</th>
                                                        <th>Keterangan</th>
                                                        <?php if ($result['selesai'] == null) : ?>
                                                            <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1;
                                                    foreach ($kasus as $kasuss) : ?>
                                                        <tr>
                                                            <td><?= $nomor++;  ?></td>
                                                            <td><?= $kasuss['kasus'];  ?></td>
                                                            <td><?= $kasuss['keterangan'];  ?></td>
                                                            <?php if ($result['selesai'] == null) : ?>
                                                                <td>
                                                                    <a href="<?= base_url("laporan_harian/" . $kasuss['id'] . '/' . $id_paket . '/' . $id_kloter);  ?>" class="btn btn-primary"><i class="fa fa-newspaper"></i></a>
                                                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#edit_kasus<?= $kasuss['id'] ?>"><i class="fa fa-pen"></i></a>
                                                                    <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#hapus_kasus<?= $kasuss['id'] ?>"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            <?php endif; ?>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="selesai">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Status Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h5 class="text-center">Apakah Anda Yakin Ingin Menyelesaikan Paket Ini?</h5>
                <p>Jika Anda Menyelesaikan Paket, Maka Data Yang Behubungan Dengan Paket Tersebut Tidak Bisa Lagi Di Tambah, Di Ubah Atau Di Hapus</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <a href="<?= base_url("/selesai_paket/$id_paket/$id_kloter");  ?>" class="btn btn-primary">Iya</a>
            </div>
        </div>
    </div>
</div>
<?php if ($result['selesai'] == null) : ?>
    <?php foreach ($kepulangan as $kepulangan_row) : ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="hapus_kepulangan<?= $kepulangan_row['id'] ?>">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url("hapus_kepulangan_realisasi");  ?>" class="modal-content">
                    <input type="text" class="d-none" name="id" value="<?= $kepulangan_row['id'];  ?>">
                    <input type="text" class="d-none" name="id_paket" value="<?= $id_paket  ?>">
                    <input type="text" class="d-none" name="id_kloter" value="<?= $id_kloter  ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Kepulangan</h5>
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
    <?php endforeach; ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="add_kasus">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url("tambah_kasus");  ?>" class="modal-content">
                <input type="text" class="d-none" name="id" value="<?= $result['id'];  ?>">
                <input type="text" class="d-none" name="id_paket" value="<?= $id_paket  ?>">
                <input type="text" class="d-none" name="id_kloter" value="<?= $id_kloter  ?>">

                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kasus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Kasus*</label>
                        <input type="text" class="form-control" required placeholder="Kasus" name="kasus">
                    </div>
                    <div class="mb-3">
                        <label for="">Keterangan*</label>
                        <textarea name="keterangan" class="form-control" required placeholder="Keterangan" id="" cols="30" rows="10"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <?php foreach ($kasus as $kasus_dua) : ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="hapus_kasus<?= $kasus_dua['id'] ?>">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url("hapus_kasus");  ?>" class="modal-content">
                    <input type="text" class="d-none" value="<?= $kasus_dua['id'];  ?>" name="id_kasus">
                    <input type="text" class="d-none" name="id_paket" value="<?= $id_paket  ?>">
                    <input type="text" class="d-none" name="id_kloter" value="<?= $id_kloter  ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Kasus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5 class="text-center">Apakah Anda Yakin Ingin Menghapus?</h5>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_kasus<?= $kasus_dua['id'] ?>">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url("edit_kasus");  ?>" class="modal-content">
                    <input type="text" class="d-none" value="<?= $kasus_dua['id'];  ?>" name="id_kasus">
                    <input type="text" class="d-none" name="id_paket" value="<?= $id_paket  ?>">
                    <input type="text" class="d-none" name="id_kloter" value="<?= $id_kloter  ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Kasus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="">Kasus*</label>
                            <input type="text" class="form-control" required placeholder="Kasus" name="kasus" value="<?= $kasus_dua['kasus'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Keterangan*</label>
                            <textarea name="keterangan" class="form-control" required placeholder="Keterangan" id="" cols="30" rows="10"><?= $kasus_dua['keterangan'];  ?></textarea>
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
    <?php foreach ($hotel as $hotel_satu) : ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="hapus_hotel<?= $hotel_satu['id'] ?>">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url("hapus_hotel_realisasi");  ?>" class="modal-content">
                    <input type="text" class="d-none" name="id" value="<?= $hotel_satu['id'];  ?>">
                    <input type="text" class="d-none" name="id_paket" value="<?= $id_paket;  ?>">
                    <input type="text" class="d-none" name="id_kloter" value="<?= $id_kloter;  ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Hotel</h5>
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
    <?php endforeach; ?>
    <?php foreach ($keberangkatan as $main_dua) :  ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="hapus_mangkat<?= $main_dua['id'] ?>">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url("hapus_keberangkatan_realisasi");  ?>" class="modal-content">
                    <input type="text" class="d-none" name="id" value="<?= $main_dua['id'];  ?>">
                    <input type="text" class="d-none" name="id_kloter" value="<?= $id_kloter;  ?>">
                    <input type="text" class="d-none" name="id_paket" value="<?= $id_paket;  ?>">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Keberangkatan</h5>
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
    <?php endforeach; ?>
    <?php foreach ($petugas as $main_satu) : ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="delete<?= $main_satu['id'] ?>">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url("hapus_petugas_realisasi");  ?>" class="modal-content">
                    <input type="text" class="d-none" name="id" value="<?= $main_satu['id'];  ?>">
                    <input type="text" class="d-none" name="id_kloter" value="<?= $id_kloter;  ?>">
                    <input type="text" class="d-none" name="id_paket" value="<?= $id_paket;  ?>">
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
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<script>
    $(".select50").select2({
        dropdownParent: $('#exampleModal')
    });
    $(document).ready(function() {
        $('#table-2').DataTable();
        $('#table-3').DataTable();
        $('#table-4').DataTable();
        $('#table-5').DataTable();
    });
</script>
<?= $this->endSection(); ?>