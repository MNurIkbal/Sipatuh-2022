<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="main-content">
    <div class="card">
        <div class="card-body">
            <h4>Detail Perencanaan Paket</h6>
            <div class="row">
                <div class="col-md-6">
                    <ul>
                            <li style="list-style: none;line-height: 40px !important;"><span>Nama Paket : <?= $result['nama'];  ?></span></li>
                            <li style="list-style: none;line-height: 40px !important;">
                                <span>Periode :
                                    <?= date("d F Y", strtotime($result['tgl_berangkat'])) . " - " . date("d F Y", strtotime($result['tgl_pulang']));  ?></span>
                            </li>
                            <li style="list-style: none;line-height: 40px !important;">
                                Status :
                                <span style="text-transform: uppercase">
                                    <?php if ($result['status'] != null) : ?>
                                        <span class="badge badge-pill badge-primary"><?= $result['status'];  ?></span>
                                    <?php else : ?>
                                        <span class="badge badge-pill badge-primary">tidak aktif</span>
                                    <?php endif; ?>
                                </span>
                            </li>
                            <li style="list-style: none;line-height: 40px !important;">Provider : <?= $result['provider']; ?></li>  
                            <li style="list-style: none;line-height: 40px !important;">Travel : <?= $nama_travel['nama_travel_umrah']; ?></li>  
                            
                        </ul>
                </div>
                <div class="col-md-6">
                    <ul>
                        <li style="list-style: none;line-height: 40px !important;">Perusahaan : <?= $nama_travel['nama_perusahaan']; ?></li>
                        <li style="list-style: none;line-height: 40px !important;">Provinsi : <?= $nama_travel['provinsi']; ?></li>
                        <li style="list-style: none;line-height: 40px !important;">Tahun : <?= date("Y",strtotime($result['tahun'])); ?></li>
                            <li style="list-style: none;line-height: 40px !important;">Asuransi : <?= $result['asuransi']; ?></li>
                        <li style="list-style: none;line-height: 40px !important;">Biaya : Rp. <?= number_format($result['biaya'],0); ?></li>
                    </ul>
                </div>
            </div>
    
        </div>
    </div>
    <section class="sections">
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
                    <div class="mb-4">
                        <a href="<?= base_url("/paket");  ?>" class="btn btn-warning">Kembali</a>
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
                                <a class="nav-link" id="contact-tab5" data-toggle="tab" href="#contact5" role="tab" aria-controls="kloter" aria-selected="false">Kloter</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="petugas">
                            <div class="tab-pane fade show active" id="home3" role="tabpanel" aria-labelledby="home-tab3">
                                <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                    <a href="<?= base_url('tambah_petugas_rencana/' . $result['id']); ?>" class="btn btn-primary mb-4">Tambah</a>
                                <?php endif; ?>
                                <div class="table-responsive">
                                    <table class="table table-border table-hover table-striped" id="main-satu">
                                        <thead>
                                            <tr>
                                                <th>Urutan</th>
                                                <th>Nama Petugas</th>
                                                <th>Type</th>
                                                <?php if ($result['pemberangkatan'] != "sudah") : ?>
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
                                                    <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                                        <td>
                                                            <a href="<?= base_url('edit_petugas_paket/' . $rows['id'] . '/' . $result['id']); ?>" title="Edit" class="btn btn-success" ><i class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal" title="Hapus" data-target="#delete<?= $rows['id'] ?>"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="profile3" role="tabpanel" aria-labelledby="profile-tab3">
                                <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                    <a href="<?= base_url('tambah_keberangkatan_paket/' . $result['id']); ?>" class="btn btn-primary mb-4" >Tambah</a>
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
                                                <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                                    <th>Action</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1;
                                            foreach ($keberangkatan as $keberangkatans) : ?>
                                                <tr>
                                                    <td><?= $nomor++; ?></td>
                                                    <td><?= $keberangkatans['maskapai'];  ?></td>
                                                    <td><?= $keberangkatans['nomor'];  ?></td>
                                                    <td><?= $keberangkatans['nama_bandara'];  ?></td>
                                                    <td><?= date("d, F Y", strtotime($keberangkatans['tgl_berangkat']));  ?>
                                                    </td>
                                                    <td><?= $keberangkatans['jam_berangkat'];  ?></td>
                                                    <td><?= $keberangkatans['bandara_tiba'];  ?></td>
                                                    <td><?= date("d, F Y", strtotime($keberangkatans['tgl_bandara_tiba']));  ?>
                                                    </td>
                                                    <td><?= $keberangkatans['jam_tiba'];  ?></td>
                                                    <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                                        <td>
                                                            <a href="<?= base_url('edit_keberangakatan_paket/' . $keberangkatans['id'] . '/' . $result['id']); ?>" class="btn btn-success" title="Edit" ><i class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal" title="Hapus" data-target="#hapus_mangkat<?= $keberangkatans['id'] ?>"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact-tab3">
                                <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                    <a href="<?= base_url('tambah_hotel_paket/' . $result['id']); ?>" class="btn btn-primary mb-4" >Tambah</a>
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
                                                <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                                    <th>Action</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1;
                                            foreach ($hotel as $hotels) : ?>
                                                <tr>
                                                    <td><?= $nomor++; ?></td>
                                                    <td><?= $hotels['hotel'];  ?></td>
                                                    <td><?= $hotels['lokasi'];  ?></td>
                                                    <td><?= date("d, F Y", strtotime($hotels['tgl_masuk']));  ?>
                                                    </td>
                                                    <td><?= date("d, F Y", strtotime($hotels['tgl_keluar']));  ?>
                                                    </td>
                                                    <td><?= $hotels['orang_perkamar'];  ?></td>
                                                    <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                                        <td>
                                                            <a href="<?= base_url('edit_hotel_paket/' . $hotels['id'] . '/'. $result['id']); ?>" class="btn btn-success"  title="Edit" ><i class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal" title="Hapus" data-target="#hapus_hotel<?= $hotels['id'] ?>"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact4" role="tabpanel" aria-labelledby="contact-tab4">
                                <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                    <a href="<?= base_url('tambah_pulang/'.$result['id']) ?>" class="btn btn-primary mb-4" >Tambah</a>
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
                                                <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                                    <th>Action</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1;
                                            foreach ($kepulangan as $kepulangans) : ?>
                                                <tr>
                                                    <td><?= $nomor++; ?></td>
                                                    <td><?= $kepulangans['maskapai'];  ?></td>
                                                    <td><?= $kepulangans['nomor'];  ?></td>
                                                    <td><?= $kepulangans['bandara_berangkat'];  ?></td>
                                                    <td><?= date("d, F Y", strtotime($kepulangans['tgl_berangkat']));  ?>
                                                    </td>
                                                    <td><?= $kepulangans['jam_berangkat'];  ?></td>
                                                    <td><?= $kepulangans['bandara_tiba'];  ?></td>
                                                    <td><?= date("d, F Y", strtotime($kepulangans['tgl_penerbangan_tiba']));  ?>
                                                    </td>
                                                    <td><?= $kepulangans['jam_tiba'];  ?></td>
                                                    <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                                        <td>
                                                            <a href="<?= base_url('edit_kepulangan_pakets/' . $kepulangans['id'] . '/' . $result['id']); ?>" class="btn btn-success"  title="Edit" ><i class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal" title="Hapus" data-target="#hapus_kepulangan<?= $kepulangans['id'] ?>"><i class="fa fa-trash"></i></a>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>

                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="contact5" role="tabpanel" aria-labelledby="contact-tab4">
                                <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                    <a href="<?= base_url('tambah_kloter_baru/' . $result['id']); ?>" class="btn btn-primary mb-4" >Tambah</a>
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
                                                <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                                    <th>Action</th>
                                                <?php endif; ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $nomor = 1;
                                            foreach ($kloter as $kloters) : ?>
                                                <tr>
                                                    <td><?= $nomor++; ?></td>
                                                    <td><?= $kloters['nama'];  ?></td>
                                                    <td><?= $kloters['batas_jamaah'];  ?> Orang</td>
                                                    <td><span class="badge badge-pill badge-primary"><?= $kloters['status'];  ?></span></td>
                                                    <td><?= $kloters['created_at'];  ?></td>
                                                    <?php if ($result['pemberangkatan'] != "sudah") : ?>
                                                        <td>
                                                            <a href="<?= base_url('edit_kloter_baru/' . $kloters['id'] . '/' . $result['id']); ?>" class="btn btn-success"  title="Edit" ><i class="fa fa-pen"></i></a>
                                                            <a href="#" class="btn btn-danger" data-toggle="modal" title="Hapus" data-target="#hapus_kloter<?= $kloters['id'] ?>"><i class="fa fa-trash"></i></a>
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
    </section>
</div>

<?php if ($result['pemberangkatan'] != "sudah") : ?>
    <?php foreach ($kloter as $kloter_satu) : ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="hapus_kloter<?= $kloter_satu['id'] ?>">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url("hapus_kloter");  ?>" class="modal-content">
                    <input type="text" class="d-none" name="id" value="<?= $kloter_satu['id'];  ?>">
                    <input type="text" class="d-none" name="id_paket" value="<?= $result['id'];  ?>">
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
    <?php foreach ($kepulangan as $kepulangan_row) : ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="hapus_kepulangan<?= $kepulangan_row['id'] ?>">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url("hapus_kepulangan");  ?>" class="modal-content">
                    <input type="text" class="d-none" name="id" value="<?= $kepulangan_row['id'];  ?>">
                    <input type="text" class="d-none" name="id_paket" value="<?= $result['id'];  ?>">
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
    <?php foreach ($hotel as $hotel_satu) : ?>
        <div class="modal fade" tabindex="-1" role="dialog" id="hapus_hotel<?= $hotel_satu['id'] ?>">
            <div class="modal-dialog modal-lg" role="document">
                <form method="POST" enctype="multipart/form-data" action="<?= base_url("hapus_hotel");  ?>" class="modal-content">
                    <input type="text" class="d-none" name="id" value="<?= $hotel_satu['id'];  ?>">
                    <input type="text" class="d-none" name="id_paket" value="<?= $result['id'];  ?>">
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
                <form method="POST" enctype="multipart/form-data" action="<?= base_url("hapus_keberangkatan");  ?>" class="modal-content">
                    <input type="text" class="d-none" name="id" value="<?= $main_dua['id'];  ?>">
                    <input type="text" class="d-none" name="id_paket" value="<?= $result['id'];  ?>">
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
                <form method="POST" enctype="multipart/form-data" action="<?= base_url("hapus_petugas");  ?>" class="modal-content">
                    <input type="text" class="d-none" name="id" value="<?= $main_satu['id'];  ?>">
                    <input type="text" class="d-none" name="id_paket" value="<?= $result['id'];  ?>">
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

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {

        $('#main-satu').DataTable();
        $('#table-2').DataTable();
        $('#table-3').DataTable();
        $('#table-4').DataTable();
        $('#table-5').DataTable();


    });
</script>
<?= $this->endSection(); ?>