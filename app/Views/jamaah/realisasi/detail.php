<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <ul>
                            <b>

                                <li style="list-style: none">
                                    <h4>Detail Realisasi Paket</h6>
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
                                <li style="list-style: none">
    
                                    <span>Kloter : <span class="badge badge-pill badge-primary"><?=  $kloter['nama'];  ?></span></span>
                                </li>
                            </b>
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
                                <a href="<?=  base_url("/detail_realisasi_kloter/" . $id_paket);  ?>" class="btn btn-warning">Kembali</a>
                                <a href="#"  data-toggle="modal"
                                            data-target="#selesai" class="btn btn-success ml-3">Selesai</a>
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
                                        <a class="nav-link" id="contact-tab4" data-toggle="tab" href="#contact5"
                                            role="tab" aria-controls="contact" aria-selected="false">Pelaporan Kasus</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="petugas">
                                    <div class="tab-pane fade show active" id="home3" role="tabpanel"
                                        aria-labelledby="home-tab3">
                                        <?php if($result['selesai'] == null) : ?>
                                        <button class="btn btn-primary mb-3" data-toggle="modal"
                                            data-target="#exampleModal">Tambah</button>
                                            <?php endif; ?>
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Petugas</th>
                                                        <th>Type</th>
                                                        <th>Urutan</th>
                                                        <?php if($result['selesai'] == null) : ?>
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
                                                        <td><?=  $nomor++;  ?></td>
                                                        <?php if($result['selesai'] == null) : ?>
                                                        <td>
                                                            <a href="#" class="btn btn-success" data-toggle="modal"
                                                                data-target="#edits<?= $rows['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal"
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
                                        <?php if($result['selesai'] == null) : ?>
                                            <button class="btn btn-primary mb-3" data-toggle="modal"
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
                                                        <?php if($result['selesai'] == null) : ?>
                                                        <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($keberangkatan as $keberangkatans) : ?>
                                                    <tr>
                                                        <td><?=  $nomor++;  ?></td>
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
                                                        <?php if($result['selesai'] == null) : ?>
                                                        <td>
                                                            <a href="#" class="btn btn-success" data-toggle="modal"
                                                                data-target="#mangkat<?= $keberangkatans['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal"
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
                                        <?php if($result['selesai'] == null) : ?>
                                        <button class="btn btn-primary mb-3" data-toggle="modal"
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
                                                        <?php if($result['selesai'] == null) : ?>
                                                        <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($hotel as $hotels) : ?>
                                                    <tr>
                                                        <td><?=  $nomor++;  ?></td>
                                                        <td><?=  $hotels['hotel'];  ?></td>
                                                        <td><?=  $hotels['lokasi'];  ?></td>
                                                        <td><?=  date("d, F Y",strtotime($hotels['tgl_masuk']));  ?>
                                                        </td>
                                                        <td><?=  date("d, F Y",strtotime($hotels['tgl_keluar']));  ?>
                                                        </td>
                                                        <td><?=  $hotels['orang_perkamar'];  ?></td>
                                                        <?php if($result['selesai'] == null) : ?>
                                                        <td>
                                                            <a href="#" class="btn btn-success" data-toggle="modal"
                                                                data-target="#edit_hotel<?= $hotels['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal"
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
                                        <?php if($result['selesai'] == null) : ?>
                                        <button class="btn btn-primary mb-3" data-toggle="modal"
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
                                                        <?php if($result['selesai'] == null) : ?>
                                                        <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($kepulangan as $kepulangans) : ?>
                                                    <tr>
                                                        <td><?=  $nomor++;  ?></td>
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
                                                        <?php if($result['selesai'] == null) : ?>
                                                        <td>
                                                            <a href="#" class="btn btn-success" data-toggle="modal"
                                                                data-target="#edit_kepulangan<?= $kepulangans['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal"
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
                                        <?php if($result['selesai'] == null) : ?>
                                        <button class="btn btn-primary mb-3" data-toggle="modal"
                                            data-target="#add_kasus">Tambah</button>
                                        <?php endif; ?>
                                        <div class="table-responsive">
                                            <table class="table table-border table-hover table-striped" id="table-5">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Kasus</th>
                                                        <th>Keterangan</th>
                                                        <?php if($result['selesai'] == null) : ?>
                                                        <th>Action</th>
                                                        <?php endif; ?>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $nomor = 1; foreach($kasus as $kasuss) : ?>
                                                    <tr>
                                                        <td><?=  $nomor++;  ?></td>
                                                        <td><?=  $kasuss['kasus'];  ?></td>
                                                        <td><?=  $kasuss['keterangan'];  ?></td>
                                                        <?php if($result['selesai'] == null) : ?>
                                                        <td>
                                                            <a href="<?=  base_url("laporan_harian/" . $kasuss['id'] . '/' . $id_paket . '/' . $id_kloter);  ?>" class="btn btn-primary"><i
                                                                    class="fa fa-newspaper"></i></a>
                                                            <a href="#" class="btn btn-success" data-toggle="modal"
                                                                data-target="#edit_kasus<?= $kasuss['id'] ?>"><i
                                                                    class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal"
                                                                data-target="#hapus_kasus<?= $kasuss['id'] ?>"><i
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
                <p>Jika Anda Menyelesaikan Paket, Maka Data  Yang Behubungan Dengan Paket Tersebut Tidak Bisa Lagi Di Tambah, Di Ubah Atau Di Hapus</p>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                <a href="<?=  base_url("/selesai_paket/$id_paket/$id_kloter");  ?>" class="btn btn-primary">Iya</a>
            </div>
        </div>
    </div>
</div>
<?php if($result['selesai'] == null) : ?>
<?php foreach($kepulangan as $kepulangan_row) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="hapus_kepulangan<?= $kepulangan_row['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_kepulangan_realisasi");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $kepulangan_row['id'];  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter  ?>">
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_kepulangan_realisasi");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter  ?>">
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
                    <!-- <input type="text" class="form-control" required placeholder="Maskapai" name="maskapai"
                        value="<?=  $kepulangan_row['maskapai'];  ?>"> -->
                        <select name="maskapai" class="form-control" required id="">
                            <option value="">Pilih</option>
                            <?php foreach($maskapai as $row_one) : ?>
                                <option <?=  ($row_one['nama_maskapai'] == $kepulangan_row['maskapai']) ? "selected" : "";  ?> value="<?=  $row_one['nama_maskapai'];  ?>"><?=  $row_one['nama_maskapai'];  ?></option>
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
                            <input type="text" class="form-control" required placeholder="Bandara Berangkat"
                                name="bandara_berangkat" value="<?=  $kepulangan_row['bandara_berangkat'];  ?>">
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
                            <input type="text" class="form-control" required placeholder="Bandara Tiba"
                                name="bandara_tiba" value="<?=  $kepulangan_row['bandara_tiba'];  ?>">
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
<?php endforeach; ?>
<div class="modal fade" tabindex="-1" role="dialog" id="add_kasus">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_kasus");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $result['id'];  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter  ?>">
            
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kasus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Kasus</label>
                    <input type="text" class="form-control" required placeholder="Kasus" name="kasus">
                </div>
                <div class="mb-3">
                    <label for="">Keterangan</label>
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
<?php foreach($kasus as $kasus_dua) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="hapus_kasus<?= $kasus_dua['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_kasus");  ?>"
            class="modal-content">
            <input type="text" class="d-none" value="<?=  $kasus_dua['id'];  ?>" name="id_kasus">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter  ?>">
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_kasus");  ?>"
            class="modal-content">
            <input type="text" class="d-none" value="<?=  $kasus_dua['id'];  ?>" name="id_kasus">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kasus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Kasus</label>
                    <input type="text" class="form-control" required placeholder="Kasus" name="kasus" value="<?=  $kasus_dua['kasus'];  ?>">
                </div>
                <div class="mb-3">
                    <label for="">Keterangan</label>
                    <textarea name="keterangan" class="form-control" required placeholder="Keterangan" id="" cols="30" rows="10"><?=  $kasus_dua['keterangan'];  ?></textarea>
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_kepulangan_realisasi");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $result['id'];  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter  ?>">

            <div class="modal-header">
                <h5 class="modal-title">Tambah Kepulangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Maskapai</label>
                    <!-- <input type="text" class="form-control" required placeholder="Maskapai" name="maskapai"> -->
                    <select name="maskapai" class="form-control" required id="">
                            <option value="">Pilih</option>
                            <?php foreach($maskapai as $row_one) : ?>
                                <option value="<?=  $row_one['nama_maskapai'];  ?>"><?=  $row_one['nama_maskapai'];  ?></option>
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
                            <!-- <input type="text" class="form-control" required placeholder="Bandara Berangkat"
                                name="bandara_berangkat"> -->
                                <select name="bandara_berangkat" class="form-control" required id="">
                                    <option value="">Pilih</option>
                                    <?php foreach($bandara as $bandara_satu_tuju) :  ?>
                                        <option value="<?=  $bandara_satu_tuju['nama'];  ?>"><?=  $bandara_satu_tuju['nama'];  ?></option>
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
                            <!-- <input type="text" class="form-control" required placeholder="Bandara Tiba"
                                name="bandara_tiba"> -->
                                <select name="bandara_tiba" class="form-control" required id="">
                                    <option value="">Pilih</option>
                                    <?php foreach($bandara as $bandara_satu_enam) :  ?>
                                        <option value="<?=  $bandara_satu_enam['nama'];  ?>"><?=  $bandara_satu_enam['nama'];  ?></option>
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
<div class="modal fade" tabindex="-1" role="dialog" id="add_hotel">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_hotel_realisasi");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $result['id'];  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket;  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter;  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Hotel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama Hotel</label>
                    <!-- <input type="text" class="form-control" required placeholder="Nama Hotel" name="nama_hotel"> -->
                    <select name="nama_hotel" class="form-control" required id="">
                        <option value="">Pilih</option>
                        <?php foreach($data_hotel as $main_hotel ):  ?>
                            <option value="<?=  $main_hotel['nama'];  ?>"><?=  $main_hotel['nama'];  ?></option>
                            <?php endforeach; ?>
                    </select>
                </div>
                <!-- <div class="mb-3">
                    <label for="">Lokasi</label>
                    <input type="text" class="form-control" required placeholder="Lokasi" name="lokasi">
                </div> -->
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_hotel_realisasi");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $hotel_satu['id'];  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket;  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter;  ?>">
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_hotel_realisasi");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket;  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter;  ?>">
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
                    <!-- <input type="text" class="form-control" required placeholder="Nama Hotel" name="nama_hotel"> -->
                    <select name="nama_hotel" class="form-control" required id="">
                        <option value="">Pilih</option>
                        <?php foreach($data_hotel as $main_hotel ):  ?>
                            <option value="<?=  $main_hotel['nama'];  ?>" <?= ($main_hotel['nama'] == $hotel_satu['hotel']) ? "selected" : ""; ?>><?=  $main_hotel['nama'];  ?></option>
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
<?php endforeach; ?>
<div class="modal fade" tabindex="-1" role="dialog" id="add_keberangkatan">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_keberangkatan_realisasi");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $result['id'];  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter;  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket;  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Keberangkatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Maskapai</label>
                    <!-- <input type="text" class="form-control" required placeholder="Maskapai" name="maskapai"> -->
                    <select name="maskapai" class="form-control" required id="">
                            <option value="">Pilih</option>
                            <?php foreach($maskapai as $row_one) : ?>
                                <option value="<?=  $row_one['nama_maskapai'];  ?>"><?=  $row_one['nama_maskapai'];  ?></option>
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
                            <!-- <input type="text" class="form-control" required placeholder="Bandara Berangkat"
                                name="bandara_berangkat"> -->
                                <select name="bandara_berangkat" class="form-control" required id="">
                                    <option value="">Pilih</option>
                                    <?php foreach($bandara as $bandara_satu_lima) :  ?>
                                        <option value="<?=  $bandara_satu_lima['nama'];  ?>"><?=  $bandara_satu_lima['nama'];  ?></option>
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
                            <!-- <input type="text" class="form-control" required placeholder="Bandara Tiba"
                                name="bandara_tiba"> -->
                                <select name="bandara_tiba" class="form-control" required id="">
                                    <option value="">Pilih</option>
                                    <?php foreach($bandara as $bandara_satu_tiga) :  ?>
                                        <option value="<?=  $bandara_satu_tiga['nama'];  ?>"><?=  $bandara_satu_tiga['nama'];  ?></option>
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
<?php foreach($keberangkatan as $main_dua) :  ?>
<div class="modal fade" tabindex="-1" role="dialog" id="hapus_mangkat<?= $main_dua['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_keberangkatan_realisasi");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $main_dua['id'];  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter;  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket;  ?>">
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_keberangkatan_realisasi");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter;  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket;  ?>">
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
                    <!-- <input type="text" class="form-control" required placeholder="Maskapai" name="maskapai"
                        value="<?=  $main_dua['maskapai'];  ?>"> -->
                        <select name="maskapai" class="form-control" required id="">
                            <option value="">Pilih</option>
                            <?php foreach($maskapai as $row_one_dua) : ?>
                                <option <?=  ($row_one_dua['nama_maskapai'] == $main_dua['maskapai']) ? "selected" : "";  ?> value="<?=  $row_one_dua['nama_maskapai'];  ?>"><?=  $row_one_dua['nama_maskapai'];  ?></option>
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
                            <!-- <input type="text" class="form-control" required placeholder="Bandara Berangkat"
                                name="bandara_berangkat" value="<?=  $main_dua['nama_bandara'];  ?>"> -->
                                <select name="bandara_berangkat" class="form-control" required id="">
                                    <option value="">Pilih</option>
                                    <?php foreach($bandara as $bandara_satu_dua) :  ?>
                                        <option <?=  ($bandara_satu_dua['nama'] == $main_dua['nama_bandara']) ? "selected" : "";  ?> value="<?=  $bandara_satu_dua['nama'];  ?>"><?=  $bandara_satu_dua['nama'];  ?></option>
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
                            <!-- <input type="text" class="form-control" required placeholder="Bandara Tiba"
                                name="bandara_tiba" value="<?=  $main_dua['bandara_tiba'];  ?>"> -->
                                <select name="bandara_tiba" class="form-control" required id="">
                                    <option value="">Pilih</option>
                                    <?php foreach($bandara as $bandara_satu) :  ?>
                                        <option <?=  ($bandara_satu['nama'] == $main_dua['bandara_tiba']) ? "selected" : "";  ?> value="<?=  $bandara_satu['nama'];  ?>"><?=  $bandara_satu['nama'];  ?></option>
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
<?php endforeach; ?>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_petugas_realisasi");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $result['id'];  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter;  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket;  ?>">
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
                    <select name="petugas" class="form-control select50" required   id="" style="width: 100% !important;">
                        <option value="">Pilih</option>
                        <?php foreach($petugas_umrah as $petugasumrah) : ?>
                        <option value="<?=  $petugasumrah['id'];  ?>"><?=  $petugasumrah['nama'];  ?> - <?=  $petugasumrah['tipe_petugas'];  ?></option>
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
<?php foreach($petugas as $main_satu) : ?>
<div class="modal fade" tabindex="-1" role="dialog" id="delete<?= $main_satu['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_petugas_realisasi");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $main_satu['id'];  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter;  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket;  ?>">
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_petugas_realisasi");  ?>"
            class="modal-content">
            <input type="text" class="d-none" name="id" value="<?=  $main_satu['id'];  ?>">
            <input type="text" class="d-none" name="id_kloter" value="<?=  $id_kloter;  ?>">
            <input type="text" class="d-none" name="id_paket" value="<?=  $id_paket;  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Edit Petugas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <label for="">Nama Petugas</label>
                    <br>
                <select name="petugas" class="form-control selectt<?= $main_satu['id'] ?>" style="width: 100% !important;" required   id="">
                        <option value="">Pilih</option>
                        <?php foreach($petugas_umrah as $petugasumrah) : ?>
                        <option <?=  ($petugasumrah['nama'] == $main_satu['nama']) ? "selected" : "";  ?> value="<?=  $petugasumrah['nama'];  ?>"><?=  $petugasumrah['nama'];  ?> - <?=  $petugasumrah['tipe_petugas'];  ?></option>
                        <?php endforeach; ?>
                    </select>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
     $(".selectt<?= $main_satu['id'] ?>").select2({
        dropdownParent: $('#edits<?= $main_satu['id'] ?>')
    });
</script>
<?php endforeach; ?>
<?php endif; ?>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".select50").select2({
        dropdownParent: $('#exampleModal')
    });
    $(document).ready(function () {
        $('#table-2').DataTable();
        $('#table-3').DataTable();
        $('#table-4').DataTable();
        $('#table-5').DataTable();
    });
</script>
<?= $this->endSection(); ?>