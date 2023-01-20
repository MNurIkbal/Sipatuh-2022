<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
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
                                </ul>
                                <div class="tab-content" id="petugas">
                                    <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                        aria-labelledby="home-tab3">
                                        <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#exampleModal">Tambah</button>
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Petugas</th>
                                                        <th>Type</th>
                                                        <th>Urutan</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($petugas as $rows) : ?>
                                                    <tr>
                                                        <td><?=  $rows['nama'];  ?></td>
                                                        <td><?=  $rows['type'];  ?></td>
                                                        <td><?=  $nomor++;  ?></td>
                                                        <td>
                                                            <a href="#" class="btn btn-success" data-toggle="modal"
                                                                data-target="#edits<?= $rows['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal"
                                                                data-target="#delete<?= $rows['id'] ?>"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="profile3" role="tabpanel"
                                        aria-labelledby="profile-tab3">
                                        <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#add_keberangkatan">Tambah</button>
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th>Maskapai</th>
                                                        <th>Nomor Penerbangan</th>
                                                        <th>Bandara Asal</th>
                                                        <th>Tanggal Berangkat</th>
                                                        <th>Jam Berangkat</th>
                                                        <th>Bandara Tiba</th>
                                                        <th>Tanggal Tiba</th>
                                                        <th>Jam Tiba</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($keberangkatan as $keberangkatans) : ?>
                                                    <tr>
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
                                                        <td>
                                                            <a href="#" class="btn btn-success" data-toggle="modal"
                                                                data-target="#mangkat<?= $keberangkatans['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal"
                                                                data-target="#hapus_mangkat<?= $keberangkatans['id'] ?>"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact3" role="tabpanel"
                                        aria-labelledby="contact-tab3">
                                        <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#add_hotel">Tambah</button>
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Hotel</th>
                                                        <th>Lokasi</th>
                                                        <th>Tanggal Mulai</th>
                                                        <th>Tanggal Selesai</th>
                                                        <th>Orang Perkamar</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($hotel as $hotels) : ?>
                                                    <tr>
                                                        <td><?=  $hotels['hotel'];  ?></td>
                                                        <td><?=  $hotels['lokasi'];  ?></td>
                                                        <td><?=  date("d, F Y",strtotime($hotels['tgl_masuk']));  ?>
                                                        </td>
                                                        <td><?=  date("d, F Y",strtotime($hotels['tgl_keluar']));  ?>
                                                        </td>
                                                        <td><?=  $hotels['orang_perkamar'];  ?></td>
                                                        <td>
                                                            <a href="#" class="btn btn-success" data-toggle="modal"
                                                                data-target="#edit_hotel<?= $hotels['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal"
                                                                data-target="#hapus_hotel<?= $hotels['id'] ?>"><i
                                                                    class="fa fa-trash"></i></a>
                                                        </td>
                                                    </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="contact4" role="tabpanel"
                                        aria-labelledby="contact-tab4">
                                        <button class="btn btn-primary" data-toggle="modal"
                                            data-target="#add_kepulangan">Tambah</button>
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                    <th>Maskapai</th>
                                                        <th>Nomor Penerbangan</th>
                                                        <th>Bandara Asal</th>
                                                        <th>Tanggal Berangkat</th>
                                                        <th>Jam Berangkat</th>
                                                        <th>Bandara Tiba</th>
                                                        <th>Tanggal Tiba</th>
                                                        <th>Jam Tiba</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($kepulangan as $kepulangans) : ?>
                                                    <tr>
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
                                                        <td>
                                                            <a href="#" class="btn btn-success" data-toggle="modal"
                                                                data-target="#edit_kepulangan<?= $kepulangans['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal"
                                                                data-target="#hapus_kepulangan<?= $kepulangans['id'] ?>"><i
                                                                    class="fa fa-trash"></i></a>
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
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
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
                        <input type="text" class="form-control" required placeholder="Maskapai" name="maskapai" value="<?=  $kepulangan_row['maskapai'];  ?>">
                    </div>
                    <div class="mb-3">
                        <label for="">Nomor Penerbangan</label>
                        <input type="text" class="form-control" required placeholder="Nomor Penerbangan" name="nomor" value="<?=  $kepulangan_row['nomor'];  ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Bandara Berangkat</label>
                                <input type="text" class="form-control" required placeholder="Bandara Berangkat"
                                    name="bandara_berangkat" value="<?=  $kepulangan_row['bandara_berangkat'];  ?>"> 
                            </div>
                            <div class="mb-3">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" required placeholder="" name="tgl_berangkat" value="<?=  $kepulangan_row['tgl_berangkat'];  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Jam</label>
                                <input type="time" class="form-control" required placeholder="" name="jam_berangkat"  value="<?=  $kepulangan_row['jam_berangkat'];  ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Bandara Tiba</label>
                                <input type="text" class="form-control" required placeholder="Bandara Tiba"
                                    name="bandara_tiba" value="<?=  $kepulangan_row['bandara_tiba'];  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Tanggal</label>
                                <input type="date" class="form-control" required placeholder="" name="tgl_tiba"  value="<?=  $kepulangan_row['tgl_penerbangan_tiba'];  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Jam</label>
                                <input type="time" class="form-control" required placeholder="" name="jam_tiba"  value="<?=  $kepulangan_row['jam_tiba'];  ?>">
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
                    <input type="text" class="form-control" required placeholder="Maskapai" name="maskapai">
                </div>
                <div class="mb-3">
                    <label for="">Nomor Penerbangan</label>
                    <input type="text" class="form-control" required placeholder="Nomor Penerbangan" name="nomor">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Bandara Berangkat</label>
                            <input type="text" class="form-control" required placeholder="Bandara Berangkat"
                                name="bandara_berangkat">
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
                            <input type="text" class="form-control" required placeholder="Bandara Tiba"
                                name="bandara_tiba">
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
                    <input type="text" class="form-control" required placeholder="Nama Hotel" name="nama_hotel">
                </div>
                <div class="mb-3">
                    <label for="">Lokasi</label>
                    <input type="text" class="form-control" required placeholder="Lokasi" name="lokasi">
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
                    <label for="">Nama Hotel</label>
                    <input type="text" class="form-control" required placeholder="Nama Hotel" name="nama_hotel" value="<?=  $hotel_satu['hotel'];  ?>">
                </div>
                <div class="mb-3">
                    <label for="">Lokasi</label>
                    <input type="text" class="form-control" required placeholder="Lokasi" name="lokasi" value="<?=  $hotel_satu['lokasi'];  ?>">
                </div>
                <div class="mb-3">
                    <label for="">Orang Perkamar</label>
                    <input type="text" class="form-control" required placeholder="Orang Perkamar" name="orang" value="<?=  $hotel_satu['orang_perkamar'];  ?>">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Tanggal Masuk</label>
                            <input type="date" class="form-control" required placeholder="" name="masuk" value="<?=  $hotel_satu["tgl_masuk"];  ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Tanggal Keluar</label>
                            <input type="date" class="form-control" required placeholder="" name="keluar" value="<?=  $hotel_satu["tgl_keluar"];  ?>">
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
                    <input type="text" class="form-control" required placeholder="Maskapai" name="maskapai">
                </div>
                <div class="mb-3">
                    <label for="">Nomor Penerbangan</label>
                    <input type="text" class="form-control" required placeholder="Nomor Penerbangan" name="nomor">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Bandara Berangkat</label>
                            <input type="text" class="form-control" required placeholder="Bandara Berangkat"
                                name="bandara_berangkat">
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
                            <input type="text" class="form-control" required placeholder="Bandara Tiba"
                                name="bandara_tiba">
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
                    <input type="text" class="form-control" required placeholder="Maskapai" name="maskapai"
                        value="<?=  $main_dua['maskapai'];  ?>">
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
                            <input type="text" class="form-control" required placeholder="Bandara Berangkat"
                                name="bandara_berangkat" value="<?=  $main_dua['nama_bandara'];  ?>">
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
                            <input type="text" class="form-control" required placeholder="Bandara Tiba"
                                name="bandara_tiba" value="<?=  $main_dua['bandara_tiba'];  ?>">
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
                    <input type="text" class="form-control" required placeholder="Nama Petugas" name="nama">
                </div>
                <div class="mb-3">
                    <label for="">Type</label>
                    <input type="text" class="form-control" required placeholder="Type" name="type">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
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
                    <input type="text" class="form-control" required placeholder="Nama Petugas" name="nama"
                        value="<?=  $main_satu['nama'];  ?>">
                </div>
                <div class="mb-3">
                    <label for="">Type</label>
                    <input type="text" class="form-control" required placeholder="Type" name="type"
                        value="<?=  $main_satu['type'];  ?>">
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