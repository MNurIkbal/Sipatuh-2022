<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul>
                            <li style="list-style: none">
                                <h4>Detail Perencanaan Paket</h6>
                            </li>
                            <li style="list-style: none">

                                <span>Nama Paket : <?=  $result['nama'];  ?></span>
                            </li>
                            <li style="list-style: none">
                                <span>Periode :
                                    <?=  date("d F Y",strtotime($result['tgl_berangkat'])) . " - " . date("d F Y",strtotime($result['tgl_pulang']));  ?></span>
                            </li>
                            <li style="list-style: none">

                                <span>Kode : <?=  $result['kode_paket'];  ?></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card">
                    <!-- <div class="card-header">
                        
                    </div> -->
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
                        <div class="card">
                            <div class="card-header">
                                <a href="<?=  base_url("/paket");  ?>" class="btn btn-warning">Kembali</a>
                            </div>
                            <div class="card-body">
                                <ul class="nav nav-pills d-flex justify-content-center" id="myTab3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab3" data-toggle="tab" href="#home3"
                                            role="tab" aria-controls="home" aria-selected="true">Petugas</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab3" data-toggle="tab" href="#profile3"
                                            role="tab" aria-controls="profile" aria-selected="false">Keberangkatan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab3" data-toggle="tab" href="#contact3"
                                            role="tab" aria-controls="contact" aria-selected="false">Hotel</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact4"
                                            role="tab" aria-controls="contact" aria-selected="false">Kepulangan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#contact5"
                                            role="tab" aria-controls="kloter" aria-selected="false">Kloter</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="petugas">
                                    <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                        aria-labelledby="home-tab3">
                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                        <button class="btn btn-primary mb-4" data-toggle="modal"
                                            data-target="#exampleModal">Tambah</button>
                                        <?php endif; ?>
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="main-satu">
                                                <thead>
                                                    <tr>
                                                        <th>Urutan</th>
                                                        <th>Nama Petugas</th>
                                                        <th>Type</th>
                                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                                        <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($petugas as $rows) : ?>
                                                    <tr>
                                                        <td><?=  $nomor++;  ?></td>
                                                        <td><?=  $rows['nama'];  ?></td>
                                                        <td><?=  $rows['type'];  ?></td>
                                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                                        <td>
                                                            <a href="#" title="Edit" class="btn btn-success" data-toggle="modal"
                                                                data-target="#edits<?= $rows['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal" title="Hapus"
                                                                data-target="#delete<?= $rows['id'] ?>"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                        <?php endif; ?>
                                                    </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile3" role="tabpanel"
                                        aria-labelledby="profile-tab3">
                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                        <button class="btn btn-primary mb-4" data-toggle="modal"
                                            data-target="#add_keberangkatan">Tambah</button>
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
                                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                                        <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($keberangkatan as $keberangkatans) : ?>
                                                    <tr>
                                                        <td><?= $nomor++; ?></td>
                                                        <td><?=  $keberangkatans['maskapai'];  ?></td>
                                                        <td><?=  $keberangkatans['nomor'];  ?></td>
                                                        <td><?=  $keberangkatans['nama_bandara'];  ?></td>
                                                        <td><?=  date("d, F Y",strtotime($keberangkatans['tgl_berangkat']));  ?>
                                                        </td>
                                                        <td><?=  $keberangkatans['jam_berangkat'];  ?></td>
                                                        <td><?=  $keberangkatans['bandara_tiba'];  ?></td>
                                                        <td><?=  date("d, F Y",strtotime($keberangkatans['tgl_bandara_tiba']));  ?>
                                                        </td>
                                                        <td><?=  $keberangkatans['jam_berangkat'];  ?></td>
                                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                                        <td>
                                                            <a href="#" class="btn btn-success" data-toggle="modal" title="Edit"
                                                                data-target="#mangkat<?= $keberangkatans['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal" title="Hapus"
                                                                data-target="#hapus_mangkat<?= $keberangkatans['id'] ?>"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                        <?php endif; ?>
                                                    </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact3" role="tabpanel"
                                        aria-labelledby="contact-tab3">
                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                        <button class="btn btn-primary mb-4" data-toggle="modal"
                                            data-target="#add_hotel">Tambah</button>
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
                                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                                        <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($hotel as $hotels) : ?>
                                                    <tr>
                                                        <td><?= $nomor++; ?></td>
                                                        <td><?=  $hotels['hotel'];  ?></td>
                                                        <td><?=  $hotels['lokasi'];  ?></td>
                                                        <td><?=  date("d, F Y",strtotime($hotels['tgl_masuk']));  ?>
                                                        </td>
                                                        <td><?=  date("d, F Y",strtotime($hotels['tgl_keluar']));  ?>
                                                        </td>
                                                        <td><?=  $hotels['orang_perkamar'];  ?></td>
                                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                                        <td>
                                                            <a href="#" class="btn btn-success" data-toggle="modal" title="Edit"
                                                                data-target="#edit_hotel<?= $hotels['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal" title="Hapus"
                                                                data-target="#hapus_hotel<?= $hotels['id'] ?>"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                        <?php endif; ?>
                                                    </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact4" role="tabpanel"
                                        aria-labelledby="contact-tab4">
                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                        <button class="btn btn-primary mb-4" data-toggle="modal"
                                            data-target="#add_kepulangan">Tambah</button>
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
                                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                                        <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($kepulangan as $kepulangans) : ?>
                                                    <tr>
                                                        <td><?= $nomor++; ?></td>
                                                        <td><?=  $kepulangans['maskapai'];  ?></td>
                                                        <td><?=  $kepulangans['nomor'];  ?></td>
                                                        <td><?=  $kepulangans['bandara_berangkat'];  ?></td>
                                                        <td><?=  date("d, F Y",strtotime($kepulangans['tgl_berangkat']));  ?>
                                                        </td>
                                                        <td><?=  $kepulangans['jam_berangkat'];  ?></td>
                                                        <td><?=  $kepulangans['bandara_tiba'];  ?></td>
                                                        <td><?=  date("d, F Y",strtotime($kepulangans['tgl_penerbangan_tiba']));  ?>
                                                        </td>
                                                        <td><?=  $kepulangans['jam_berangkat'];  ?></td>
                                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                                        <td>
                                                            <a href="#" class="btn btn-success" data-toggle="modal" title="Edit"
                                                                data-target="#edit_kepulangan<?= $kepulangans['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal" title="Hapus"
                                                                data-target="#hapus_kepulangan<?= $kepulangans['id'] ?>"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                        <?php endif; ?>
                                                    </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact5" role="tabpanel"
                                        aria-labelledby="contact-tab4">
                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                        <button class="btn btn-primary mb-4" data-toggle="modal"
                                            data-target="#add_kloter">Tambah</button>
                                        <?php endif; ?>
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-5">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Kloter</th>
                                                        <th>Batas Jamaah</th>
                                                        <th>Status</th>
                                                        <th>Dibuat</th>
                                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                                            <th>Action</th>
                                                            <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($kloter as $kloters) : ?>
                                                    <tr>
                                                        <td><?= $nomor++; ?></td>
                                                        <td><?=  $kloters['nama'];  ?></td>
                                                        <td><?=  $kloters['batas_jamaah'];  ?> Orang</td>
                                                        <td><span class="badge badge-pill badge-primary"><?=  $kloters['status'];  ?></span></td>
                                                        <td><?=  $kloters['created_at'];  ?></td>
                                                        <?php if($result['pemberangkatan'] != "sudah") : ?>
                                                        <td>
                                                            <a href="#" class="btn btn-success" data-toggle="modal" title="Edit"
                                                                data-target="#edit_kloter<?= $kloters['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal" title="Hapus"
                                                                data-target="#hapus_kloter<?= $kloters['id'] ?>"><i
                                                                    class="fa fa-trash"></i></a>
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
<div class="modal fade" tabindex="-1" role="dialog" id="add_kloter">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("add_kloter");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id_paket" value="<?=  $result['id'];  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kloter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama Kloter</label>
                    <input type="text" name="kloter" class="form-control" required placeholder="Nama Kloter">
                </div>
                <div class="mb-3">
                    <label for="">Batas Jamaah</label>
                    <input type="number" name="batas" class="form-control" required placeholder="Batas Jamaah">
                </div>
                <div class="mb-3">
                    <label for="">Status</label>
                    <select name="status" class="form-control" required id="">
                        <option value="">Pilih</option>
                        <option value="Aktif">Aktif</option>
                        <option value="Tidak Aktif">Tidak Aktif</option>
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
<?php if($result['pemberangkatan'] != "sudah") : ?>
    <?php foreach($kloter as $kloter_satu) : ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="edit_kloter<?=  $kloter_satu['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_kloter");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id_paket" value="<?=  $result['id'];  ?>">
            <input type="text" class="d-none" name="id" value="<?=  $kloter_satu['id'];  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kloter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama Kloter</label>
                    <input type="text" name="kloter" class="form-control" required placeholder="Nama Kloter" value="<?=  $kloter_satu['nama'];  ?>">
                </div>
                <div class="mb-3">
                    <label for="">Batas Jamaah</label>
                    <input value="<?= $kloter_satu['batas_jamaah']; ?>" type="number" name="batas" class="form-control" required placeholder="Batas Jamaah">
                </div>
                <div class="mb-3">
                    <label for="">Status</label>
                    <select name="status" class="form-control" required id="">
                        <option value="">Pilih</option>
                        <option value="Aktif" <?=  ($kloter_satu['status'] == "Aktif") ? "selected" : "";  ?>>Aktif</option>
                        <option <?=  ($kloter_satu['status'] == "Tidak Aktif") ? "selected" : "";  ?> value="Tidak Aktif">Tidak Aktif</option>
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
<div class="modal fade" tabindex="-1" role="dialog" id="hapus_kloter<?= $kloter_satu['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_kloter");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $kloter_satu['id'];  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $result['id'];  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Hapus Kloter</h5>
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
<?php foreach($kepulangan as $kepulangan_row) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="hapus_kepulangan<?= $kepulangan_row['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_kepulangan");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $kepulangan_row['id'];  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $result['id'];  ?>">
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
<div class="modal fade" tabindex="-1" role="dialog" id="edit_kepulangan<?= $kepulangan_row['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_kepulangan");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id_paket" value="<?=  $result['id'];  ?>">
            <input type="text" class="d-none" name="id" value="<?=  $kepulangan_row['id'];  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kepulangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Maskapai</label>
                    <br>
                    <select name="maskapai" class="form-control select37" required id="" style="width: 100% !important;">
                        <option value="">Pilih</option>
                        <?php foreach($maskapai as $main_satu_tiga) : ?>
                        <option
                            <?=  ($main_satu_tiga['nama_maskapai'] == $kepulangan_row['maskapai']) ? "selected" : "";  ?>
                            value="<?=  $main_satu_tiga['nama_maskapai'];  ?>">
                            <?=  $main_satu_tiga['nama_maskapai'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Nomor Penerbangan</label>
                    <input type="text" class="form-control" required placeholder="Nomor Penerbangan" name="nomor"
                        value="<?=  $kepulangan_row['nomor'];  ?>">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Bandara Berangkat</label>
                            <br>
                            <select name="bandara_berangkat" class="form-control select38" required id="" style="width: 100% !important;">
                                <option value="">Pilih</option>
                                <?php foreach($bandara as $main_duat_satu_empat_lima) : ?>
                                <option
                                    <?=  ($main_duat_satu_empat_lima['nama'] == $kepulangan_row['bandara_berangkat']) ? "selected" : "";  ?>
                                    value="<?=  $main_duat_satu_empat_lima['nama'];  ?>">
                                    <?=  $main_duat_satu_empat_lima['nama'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_berangkat"
                                value="<?=  $kepulangan_row['tgl_berangkat'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Jam</label>
                            <input type="time" class="form-control" required placeholder="" name="jam_berangkat"
                                value="<?=  $kepulangan_row['jam_berangkat'];  ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Bandara Tiba</label>
                            <br>
                            <select name="bandara_tiba" class="form-control select39" required id="" style="width: 100% !important;">
                                <option value="">Pilih</option>
                                <?php foreach($bandara as $main_duat_satu_empat) : ?>
                                <option
                                    <?=  ($main_duat_satu_empat['nama'] == $kepulangan_row['bandara_tiba']) ? "selected" : "";  ?>
                                    value="<?=  $main_duat_satu_empat['nama'];  ?>">
                                    <?=  $main_duat_satu_empat['nama'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_tiba"
                                value="<?=  $kepulangan_row['tgl_penerbangan_tiba'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Jam</label>
                            <input type="time" class="form-control" required placeholder="" name="jam_tiba"
                                value="<?=  $kepulangan_row['jam_tiba'];  ?>">
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
<script>
    $(".select37").select2({
        dropdownParent: $('#edit_kepulangan<?= $kepulangan_row['id'] ?>')
    })
    $(".select38").select2({
        dropdownParent: $('#edit_kepulangan<?= $kepulangan_row['id'] ?>')
    })
    $(".select39").select2({
        dropdownParent: $('#edit_kepulangan<?= $kepulangan_row['id'] ?>')
    })
</script>
<?php endforeach; ?>
<div class="modal fade" tabindex="-1" role="dialog" id="add_kepulangan">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_kepulangan");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $result['id'];  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kepulangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Maskapai</label>
                    <br>
                    <select style="width: 100% !important;" name="maskapai" class="form-control select34" required id="">
                        <option value="">Pilih</option>
                        <?php foreach($maskapai as $main_satu) : ?>
                        <option value="<?=  $main_satu['nama_maskapai'];  ?>"><?=  $main_satu['nama_maskapai'];  ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Nomor Penerbangan</label>
                    <input type="text" class="form-control" required placeholder="Nomor Penerbangan" name="nomor">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Bandara Berangkat</label>
                            <br>
                            <select style="width: 100% !important;" name="bandara_berangkat" class="form-control select35" required id="">
                                <option value="">Pilih</option>
                                <?php foreach($bandara as $main_dua) : ?>
                                <option value="<?=  $main_dua['nama'];  ?>"><?=  $main_dua['nama'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_berangkat">
                        </div>
                        <div class="mb-3">
                            <label for="">Jam</label>
                            <input type="time" class="form-control" required placeholder="" name="jam_berangkat">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Bandara Tiba</label>
                            <br>
                            <select name="bandara_tiba" class="form-control select36" required id="" style="width: 100% !important;">
                                <option value="">Pilih</option>
                                <?php foreach($bandara as $mainenam) : ?>
                                <option value="<?=  $mainenam['nama'];  ?>"><?=  $mainenam['nama'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_tiba">
                        </div>
                        <div class="mb-3">
                            <label for="">Jam</label>
                            <input type="time" class="form-control" required placeholder="" name="jam_tiba">
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
<script>
    $(".select34").select2({
        dropdownParent: $('#add_kepulangan')
    })
    $(".select35").select2({
        dropdownParent: $('#add_kepulangan')
    })
    $(".select36").select2({
        dropdownParent: $('#add_kepulangan')
    })
</script>
<div class="modal fade" tabindex="-1" role="dialog" id="add_hotel">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_hotel");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $result['id'];  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Hotel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama Hotel</label>
                    <br>
                    <select style="width: 100% !important;" name="nama_hotel" class="form-control select32" required  id="">
                        <option value="">Pilih</option>
                        <?php foreach($data_hotel as $data_hotels) : ?>
                            <option value="<?=  $data_hotels['nama'];  ?>"><?=  $data_hotels['nama'];  ?></option>
                            <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="">Orang Perkamar</label>
                    <input type="text" class="form-control" required placeholder="Orang Perkamar" name="orang">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Tanggal Masuk</label>
                            <input type="date" class="form-control" required placeholder="" name="masuk">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Tanggal Keluar</label>
                            <input type="date" class="form-control" required placeholder="" name="keluar">
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
<script>
    $(".select32").select2({
        dropdownParent: $('#add_hotel')
    })
</script>
<?php foreach($hotel as $hotel_satu) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="hapus_hotel<?= $hotel_satu['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_hotel");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $hotel_satu['id'];  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $result['id'];  ?>">
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
<div class="modal fade" tabindex="-1" role="dialog" id="edit_hotel<?= $hotel_satu['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_hotel");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id_paket" value="<?=  $result['id'];  ?>">
            <input type="text" class="d-none" name="id" value="<?=  $hotel_satu['id'];  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Edit Hotel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="mb-3">
            <label for="">Hotel</label>
            <br>
            <select name="nama_hotel" style="width: 100% !important;" class="form-control select33" required  id="">
                        <option value="">Pilih</option>
                        <?php foreach($data_hotel as $data_hotels) : ?>
                            <option value="<?=  $data_hotels['nama'];  ?>" <?= ($data_hotels['nama'] == $hotel_satu['hotel']) ? "selected" : ""; ?>><?=  $data_hotels['nama'];  ?></option>
                            <?php endforeach; ?>
                    </select>
            </div>
                
                <div class="mb-3">
                    <label for="">Orang Perkamar</label>
                    <input type="text" class="form-control" required placeholder="Orang Perkamar" name="orang"
                        value="<?=  $hotel_satu['orang_perkamar'];  ?>">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Tanggal Masuk</label>
                            <input type="date" class="form-control" required placeholder="" name="masuk"
                                value="<?=  $hotel_satu["tgl_masuk"];  ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Tanggal Keluar</label>
                            <input type="date" class="form-control" required placeholder="" name="keluar"
                                value="<?=  $hotel_satu["tgl_keluar"];  ?>">
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
<script>
    $(".select33").select2({
        dropdownParent: $('#edit_hotel<?= $hotel_satu['id'] ?>')
    })
</script>
<?php endforeach; ?>
<div class="modal fade" tabindex="-1" role="dialog" id="add_keberangkatan">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_keberangkatan");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $result['id'];  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Keberangkatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Maskapai</label>
                    <br>
                    <select name="maskapai" class="form-control select26" style="width: 100% !important;" required id="">
                        <option value="">Pilih</option>
                        <?php foreach($maskapai as $main_satu) : ?>
                        <option value="<?=  $main_satu['nama_maskapai'];  ?>"><?=  $main_satu['nama_maskapai'];  ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Nomor Penerbangan</label>
                    <input type="text" class="form-control" required placeholder="Nomor Penerbangan" name="nomor">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Bandara Berangkat</label>
                            <br>
                            <select name="bandara_berangkat" class="form-control select28" style="width: 100% !important;" required id="">
                                <option value="">Pilih</option>
                                <?php foreach($bandara as $main_dua) : ?>
                                <option value="<?=  $main_dua['nama'];  ?>"><?=  $main_dua['nama'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" required placeholder="" id="keberangkatan_id" name="tgl_berangkat">
                        </div>
                        <div class="mb-3">
                            <label for="">Jam</label>
                            <input type="time" class="form-control" required placeholder="" name="jam_berangkat">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Bandara Tiba</label>
                            <br>
                            <select name="bandara_tiba" class="form-control select27" style="width: 100% !important;" required id="">
                                <option value="">Pilih</option>
                                <?php foreach($bandara as $main_dua) : ?>
                                <option value="<?=  $main_dua['nama'];  ?>"><?=  $main_dua['nama'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_tiba" id="kepulangan_id">
                        </div>
                        <div class="mb-3">
                            <label for="">Jam</label>
                            <input type="time" class="form-control" required placeholder="" name="jam_tiba">
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
<script>
    $(".select26").select2({
        dropdownParent: $('#add_keberangkatan')
    })
    $(".select27").select2({
        dropdownParent: $('#add_keberangkatan')
    })
    $(".select28").select2({
        dropdownParent: $('#add_keberangkatan')
    })
</script>
<?php foreach($keberangkatan as $main_dua) :  ?>
<div class="modal fade" tabindex="-1" role="dialog" id="hapus_mangkat<?= $main_dua['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_keberangkatan");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $main_dua['id'];  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $result['id'];  ?>">
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
<div class="modal fade" tabindex="-1" role="dialog" id="mangkat<?= $main_dua['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_keberangkatan");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id_paket" value="<?=  $result['id'];  ?>">
            <input type="text" class="d-none" name="id" value="<?=  $main_dua['id'];  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Edit Keberangkatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Maskapai</label>
                    <br>
                    <select style="width: 100% !important;" name="maskapai" class="form-control select29" required id="">
                        <option value="">Pilih</option>
                        <?php foreach($maskapai as $main_satu_empat) : ?>
                        <option <?=  ($main_satu_empat['nama_maskapai'] == $main_dua['maskapai']) ? "selected" : "";  ?>
                            value="<?=  $main_satu_empat['nama_maskapai'];  ?>">
                            <?=  $main_satu_empat['nama_maskapai'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="">Nomor Penerbangan</label>
                    <input type="text" class="form-control" required placeholder="Nomor Penerbangan" name="nomor"
                        value="<?=  $main_dua['nomor'];  ?>">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Bandara Berangkat</label>
                            <br>
                            <select style="width: 100% !important;" name="bandara_berangkat" class="form-control select30" required id="">
                                <option value="">Pilih</option>
                                <?php foreach($bandara as $main_duat) : ?>
                                <option <?=  ($main_duat['nama'] == $main_dua['nama_bandara']) ? "selected" : "";  ?>
                                    value="<?=  $main_duat['nama'];  ?>"><?=  $main_duat['nama'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_berangkat"
                                value="<?=  $main_dua['tgl_berangkat'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Jam</label>
                            <input type="time" class="form-control" required placeholder="" name="jam_berangkat"
                                value="<?=  $main_dua['jam_berangkat'];  ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Bandara Tiba</label>
                            <br>
                            <select style="width: 100% !important;" name="bandara_tiba" class="form-control select31" required id="">
                                <option value="">Pilih</option>
                                <?php foreach($bandara as $main_duat_satu) : ?>
                                <option
                                    <?=  ($main_duat_satu['nama'] == $main_dua['bandara_tiba']) ? "selected" : "";  ?>
                                    value="<?=  $main_duat_satu['nama'];  ?>"><?=  $main_duat_satu['nama'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_tiba"
                                value="<?=  $main_dua['tgl_bandara_tiba'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Jam</label>
                            <input type="time" class="form-control" required placeholder="" name="jam_tiba"
                                value="<?=  $main_dua['jam_tiba'];  ?>">
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
<script>
    $(".select29").select2({
        dropdownParent: $('#mangkat<?= $main_dua['id'] ?>')
    })
    $(".select30").select2({
        dropdownParent: $('#mangkat<?= $main_dua['id'] ?>')
    })
    $(".select31").select2({
        dropdownParent: $('#mangkat<?= $main_dua['id'] ?>')
    })
</script>
<?php endforeach; ?>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_petugas");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $result['id'];  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama Petugas</label>
                    <br>
                    <select name="petugas" class="form-control select24" style="width: 100% !important;" required id="">
                        <option value="">Pilih</option>
                        <?php foreach($petugas_umrah as $petugasumrah) : ?>
                        <option value="<?=  $petugasumrah['id'];  ?>"><?=  $petugasumrah['nama'];  ?> -
                            <?=  $petugasumrah['tipe_petugas'];  ?></option>
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
    
    $(".select24").select2({
        dropdownParent: $('#exampleModal')
    });
    
</script>
<?php foreach($petugas as $main_satu) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="delete<?= $main_satu['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_petugas");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $main_satu['id'];  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $result['id'];  ?>">
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
<div class="modal fade" tabindex="-1" role="dialog" id="edits<?= $main_satu['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_petugas");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $main_satu['id'];  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $result['id'];  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Edit Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama Petugas</label>
                    <br>
                    <select name="petugas" class="form-control select25" style="width: 100% !important;" required id="">
                        <option value="">Pilih</option>
                        <?php foreach($petugas_umrah as $petugasumrah) : ?>
                        <option value="<?=  $petugasumrah['id'];  ?>"
                            <?=  ($petugasumrah['nama'] == $main_satu['nama']) ? "selected" : "";  ?>>
                            <?=  $petugasumrah['nama'];  ?> - <?=  $petugasumrah['tipe_petugas'];  ?></option>
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
      $(".select25").select2({
            dropdownParent: $('#edits<?= $main_satu['id'] ?>')
        })
</script>
<?php endforeach; ?>
<?php endif; ?>
<!-- <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
      
        $('#main-satu').DataTable();
        $('#table-2').DataTable();
        $('#table-3').DataTable();
        $('#table-4').DataTable();
        $('#table-5').DataTable();


    });
</script>
<?= $this->endSection(); ?>