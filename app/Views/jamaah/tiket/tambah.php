<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pelaporan Jamaah</h4>
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
                                <b>

                                    <span>Nama Paket : <?= $paket['nama'] ?></span>
                                    <br>
                                    <span>Periode : <?=  date("d F Y",strtotime($paket['tgl_berangkat'])) . ' - ' . date("d, F Y",strtotime($paket['tgl_pulang']));  ?></span>
                                    <br>
                                    <span>Kode Paket : <?=  $paket['kode_paket'];  ?></span>
                                </b>
                        <br>
                        <br>
                        <a href="<?=  base_url("pendaftaran");  ?>" class="btn btn-warning"><i class="fas fa-arrow-left"></i></a>
                        <a href="<?=  base_url("download_jamaah/$id");  ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
                        <a href="#" class="btn btn-primary " data-toggle="modal" data-target="#tambah"><i class="fas fa-plus"></i></a>
                        <a href="<?=  base_url("download_template");  ?>" class="btn btn-info " ><i class="fas fa-arrow-up"></i></a>
                        <div class="table-responsive mt-5">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>Nama</th>
                                        <th>Identitas</th>
                                        <th>No Pasti Umrah</th>
                                        <th>Status Pembayaran</th>
                                        <th>Status Vaksin</th>
                                        <th>Info</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach($result as $row) : ?>
                                        <tr>
                                            <td>
                                                <?=  $row['nama'];  ?>
                                    </td>
                                            <td>
                                                <span>NIK : <?=  $row['no_identitas'];  ?></span>
                                                <br>
                                                <span>No Telpon : <?=  $row['no_telp'];  ?></span>
                                                <br>
                                                <span>No Hp : <?=  $row['no_hp'];  ?></span>
                                            </td>
                                            <td><?=  $row['no_pasti_umrah'];  ?></td>
                                            <td>
                                                <?php if($row['status_bayar'] == "lunas") : ?>
                                                    <span>STATUS BAYAR : <span class="badge badge-success">SUDAH BAYAR</span></span>
                                                    <?php else: ?>
                                                    <span>STATUS BAYAR : <span class="badge badge-danger">BELUM BAYAR</span></span>
                                                    <?php endif; ?>
                                                <br>
                                                <span>PROVIDER : <?=  $row['provider'];  ?></span>
                                                <br>
                                                <span>ASURANSI : <?=  $row['asuransi'];  ?></span>
                                            </td>
                                            <td>
                                                <span>
                                                STATUS VAKSIN : <span class="badge badge-danger">BELUM BAYAR</span>
                                                </span>
                                                <br>
                                                <span>
                                                    TANGGAL VAKSIN :
                                                </span>
                                                <br>
                                                <span>
                                                    JENIS VAKSIN : 
                                                </span>
                                            </td>
                                            <td>
                                                <span>POLIS : <?=  $row['nomor_polis'];  ?></span>
                                                <br>
                                                <span>VISA : <?=  $row['nomor_visa'];  ?></span>
                                                <br>
                                                <span>PASPOR : <?=  $row['no_paspor'];  ?></span>
                                            </td>
                                            <td>
                                                
                                                <a href="#" class="btn btn-primary"><i class="fa fa-print"></i></a>
                                                <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?= $row['id'] ?>"><i class="fa fa-trash"></i></a>
                                                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#edit<?= $row['id'] ?>"><i class="fa fa-pen"></i></a>
                                                <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#pindah<?= $row['id'] ?>"><i class="fa fa-edit"></i></a>
                                                <a href="#" class="btn btn-info" data-toggle="modal" data-target="#bayar<?= $row['id'] ?>"><i class="fa fa-clipboard"></i></a>
                                                <a href="#" class="btn btn-dark" data-toggle="modal" data-target="#asuransi<?= $row['id'] ?>"><i class="fa fa-book"></i></a>
                                                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#visa<?= $row['id'] ?>"><i class="fa fa-address-card"></i></a>
                                                <!-- <i class="fa-brands "></i> -->
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
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_jamaah");  ?>"
            class="modal-content">
            <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jamaah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Title</label>
                            <input type="text" class="form-control" required placeholder="Title" name="title">
                        </div>
                    </div>
                    <div class="col-md-6    ">
                    <div class="mb-3">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" required placeholder="Nama" name="nama">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Nama Ayah</label>
                            <input type="text" class="form-control" required placeholder="Nama Ayah" name="ayah">
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Identitas</label>
                            <select name="jenis_identitas" id="" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="nik">Nik</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">No Identitas</label>
                            <input type="text" class="form-control " name="no_identitas" required placeholder="No Identitas">
                        </div>
                        <div class="mb-3">
                            <label for="">Tempat Lahir</label>
                            <input type="text" class="form-control " required placeholder="Tempat Lahir" name="tempat_lahir">
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_lahir">
                        </div>
                        <div class="mb-3">
                            <label for="">No Telepon</label>
                            <input type="number" class="form-control" required placeholder="No Telepon" name="no_telpon">
                        </div>
                        <div class="mb-3">
                            <label for="">No Hp</label>
                            <input type="number" class="form-control" required placeholder="No Hp" name="no_hp">
                        </div>
                        <div class="mb-3">
                            <label for="">Kewarganegaraan</label>
                            <select name="warganegara" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="wni">WNI</option>
                                <option value="wna">WNA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Nama Paspor</label>
                            <input type="text" class="form-control" required placeholder="Nama Paspor" name="nama_paspor">
                        </div>
                        <div class="mb-3">
                            <label for="">Foto</label>
                            <input type="file" class="form-control" required placeholder="Foto" name="foto">
                        </div>
                        <div class="mb-3">
                            <label for="">Alamat    </label>
                            <textarea name="alamat" id="" class="form-control" required cols="30" rows="10" placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Provinsi</label>
                            <input type="text" class="form-control" required placeholder="Provinsi" name="provinsi">
                        </div>
                        <div class="mb-3">
                            <label for="">Kabupaten</label>
                            <input type="text" class="form-control" required placeholder="Kabupaten" name="kabupaten">
                        </div>
                        <div class="mb-3">
                            <label for="">Kecamatan</label>
                            <input type="text" class="form-control" required placeholder="Kecamatan" name="kecamatan">
                        </div>
                        <div class="mb-3">
                            <label for="">Kelurahan</label>
                            <input type="text" class="form-control" required placeholder="Kelurahan" name="kelurahan">
                        </div>
                        <div class="mb-3">
                            <label for="">Status Pernikahan</label>
                            <select name="nikah" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="sudah nikah">sudah nikah</option>
                                <option value="belum nikah">belum nikah</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Pendidikan</label>
                            <select name="jenis_pendidikan" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="tidak sekolah">Tidak Sekolah</option>
                                <option value="SD">SD</option>
                                <option value="SMP">SMP</option>
                                <option value="SMA/SMK">SMA/SMK</option>
                                <option value="PERGURUAN TINGGI">PERGURUAN TINGGI</option>
                                <option value="lainnya">lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Pekerjaan</label>
                            <select name="jenis_pekerjaan" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="tidak bekerja">Tidak Bekerja</option>
                                <option value="guru">Guru</option>
                                <option value="nelayan">Nelayan</option>
                                <option value="petani">Petani</option>
                                <option value="buruh">Buruh</option>
                                <option value="polisi">Polisi</option>
                                <option value="pns">PNS</option>
                                <option value="pengusaha">Pengusahan</option>
                                <option value="lainnya">lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Provider</label>
                            <input type="text" class="form-control" required placeholder="Provider" name="provider">
                        </div>
                        <div class="mb-3">
                            <label for="">Asuransi</label>
                            <input type="text" class="form-control" required placeholder="Asuransi" name="asuransi">
                        </div>
                        <div class="mb-3">
                            <label for="">No Paspor</label>
                            <input type="text" class="form-control" required placeholder="No Paspor" name="no_paspor">
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
<?php foreach($result as $main) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_jamaah/" . $main['id']);  ?>" class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
                <h5 class="modal-title">Hapus Jamaah</h5>
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

<div class="modal fade" tabindex="-1" role="dialog" id="asuransi<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("asuransi/" . $main['id']);  ?>" class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
                <h5 class="modal-title">Pelaporan Asuransi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="">Asuransi : </label>
                    <input type="text" name="asuransi" class="form-control " required placeholder="Asuransi" autofocus  value="<?=  $main['asuransi'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Nomor Polis : </label>
                    <input type="text" name="nomor" class="form-control " required placeholder="Nomor Polis"   value="<?=  $main['nomor_polis'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Tanggal Input: </label>
                    <input type="date" name="tgl_input" class="form-control " required placeholder="Tanggal" value="<?=  $main['tgl_input'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Tanggal Awal Polis: </label>
                    <input type="date" name="awal" class="form-control " required placeholder="Tanggal" value="<?=  $main['tgl_awal'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Tanggal Akhir Polis: </label>
                    <input type="date" name="akhir" class="form-control " required placeholder="Tanggal" value="<?=  $main['tgl_akhir'];  ?>">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="visa<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("visa/" . $main['id']);  ?>" class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
                <h5 class="modal-title">Pelaporan Visa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="">Provider : </label>
                    <input type="text" name="provider" class="form-control " required placeholder="Provider" autofocus  value="<?=  $main['provider'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Nomor Visa: </label>
                    <input type="text" name="nomor" class="form-control " required placeholder="Nomor Visa"   value="<?=  $main['nomor_visa'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Tanggal Awal Visa: </label>
                    <input type="date" name="awal" class="form-control " required placeholder="Tanggal" value="<?=  $main['tgl_awal_visa'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Tanggal Akhir Visa: </label>
                    <input type="date" name="akhir" class="form-control " required placeholder="Tanggal" value="<?=  $main['tgl_akhir_visa'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Muassasah: </label>
                    <input type="text" name="muassasah" class="form-control " required placeholder="Muassasah" value="<?=  $main['muassasah'];  ?>">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="bayar<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("bayar/" . $main['id']);  ?>" class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
                <h5 class="modal-title">Data Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="">Tanggal Pembayaran : </label>
                    <input type="date" name="tgl" class="form-control " required placeholder="Tanggal" autofocus  value="<?=  $main['tgl_bayar'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Rekening Penampung : </label>
                    <select name="rekening" class="form-control" required autocomplete="off" id="">
                        <option value="">Pilih</option>
                        <?php foreach($bank as $banks) : ?>
                            <option value="<?=  $banks['id']  ?>"  <?=  ($banks['id'] == $main['rekening_penampung']) ? "selected" : "";  ?>><?=  $banks['nama'];  ?></option>
                            <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-1">
                    <label for="">Status Pembayaran : </label>
                    <select name="status" class="form-control" required  id="">
                        <option value="">Pilih</option>
                        <option value="belum" <?=  ($main['status_bayar'] == "belum") ? "selected" : "";  ?>>Belum Bayar</option>
                        <option value="cicil" <?=  ($main['status_bayar'] == "cicil") ? "selected" : "";  ?>>Cicil</option>
                        <option value="lunas" <?=  ($main['status_bayar'] == "lunas") ? "selected" : "";  ?>>Lunas</option>
                    </select>
                </div>
                <div class="mb-1">
                    <label for="">Status Pembayaran : </label>
                    <textarea name="keterangan" class="form-control" required id="" cols="30" rows="10" placeholder="Keterangan"><?=  $main['keterangan_bayar'];  ?></textarea>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="pindah<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("pindah_paket/" . $main['id']);  ?>" class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
                <h5 class="modal-title">Pindah Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="">Nama Jamaah : </label>
                    <b><?=  $main['nama'];  ?></b>
                </div>
                <div class="mb-1">
                    <label for="">Nomor Registrasi : </label>
                    <b><?=  date("d F Y",strtotime($paket['tgl_berangkat'])) . ' - '. date("d F Y",strtotime($paket['tgl_pulang']));  ?></b>
                </div>
                <div class="mb-1">
                    <label for="">No Pasti Umrah : </label>
                    <b><?=  $main['no_pasti_umrah'];  ?></b>
                </div>
                <div class="mb-1">
                    <label for="">Nama Paket : </label>
                    <b><?=  $main['nama'];  ?></b>
                </div>
                <div class="mb-1">
                    <label for="">Periode : </label>
                    <b><?=  date("d F Y",strtotime($paket['tgl_berangkat'])) . ' - '. date("d F Y",strtotime($paket['tgl_pulang']));  ?></b>
                </div>
                <div class="mb-1">
                    <label for="">Pindah Paket</label>
                    <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
                    <select name="paket" class="form-control" required autofocus autocomplete="" id="" > 
                        <option value="">Pilih</option>
                        <?php foreach($all_paket as $rt) : ?>
                            <?php if($rt['id'] != $id) : ?>
                                <option value="<?=  $rt['id'];  ?>"><?=  $rt['nama'];  ?></option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Pindah</button>
            </div>
        </form>
    </div>
</div>

    <div class="modal fade" tabindex="-1" role="dialog" id="edit<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_jamaah/" . $main['id']);  ?>"
            class="modal-content">
            <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Edit Jamaah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Title</label>
                            <input type="text" class="form-control" required placeholder="Title" name="title" value="<?=  $main['title'];  ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="mb-3">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" required placeholder="Nama" name="nama" value="<?=  $main['nama'];  ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Nama Ayah</label>
                            <input type="text" class="form-control" required placeholder="Nama Ayah" name="ayah" value="<?=  $main['ayah'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Identitas</label>
                            <select name="jenis_identitas" id="" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="nik" <?=  ($main['jenis_identitas'] == "nik") ? "selected" : "";  ?>>Nik</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">No Identitas</label>
                            <input type="text" class="form-control " required placeholder="No Identitas" value="<?=  $main['no_identitas'];  ?>" name="no_identitas">
                        </div>
                        <div class="mb-3">
                            <label for="">Tempat Lahir</label>
                            <input type="text" class="form-control " required placeholder="Tempat Lahir" name="tempat_lahir" value="<?= $main['tempat_lahir'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_lahir" value="<?=  $main['tgl_lahir'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">No Telepon</label>
                            <input type="number" class="form-control" required placeholder="No Telepon" name="no_telpon" value="<?=  $main['no_telp'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">No Hp</label>
                            <input type="number" class="form-control" required placeholder="No Hp" name="no_hp" value="<?=  $main['no_hp'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Kewarganegaraan</label>
                            <select name="warganegara" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="wni" <?=  ($main['kewargannegaraan'] == "wni") ? "selected" : "";  ?>>WNI</option>
                                <option value="wna" <?=  ($main['kewargannegaraan'] == "wna") ? "selected" : "";  ?>>WNA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Nama Paspor</label>
                            <input type="text" class="form-control" required placeholder="Nama Paspor" name="nama_paspor" value="<?=  $main['nama_paspor'];  ?>">
                        </div>
                        <div class="mb-3">
                            <div class="wrapper" style="width: 200px;height: 150px">
                                <img src="<?=  base_url("assets/upload/" . $main['foto']);  ?>" class="img-fluid img-thumbnail"  alt="" style="width: 100%;height: ;100%">
                            </div>
                            <input type="hidden" name="foto_lama" value="<?=  $main['foto'];  ?>">
                            <label for="">Foto</label>
                            <input type="file" class="form-control" placeholder="Foto" name="foto">
                        </div>
                        <div class="mb-3">
                            <label for="">Alamat    </label>
                            <textarea name="alamat" id="" class="form-control" required cols="30" rows="10" placeholder="Alamat"><?=  $main['alamat'];  ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Provinsi</label>
                            <input type="text" class="form-control" required placeholder="Provinsi" name="provinsi" value="<?=  $main['provinsi'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Kabupaten</label>
                            <input type="text" class="form-control" required placeholder="Kabupaten" name="kabupaten" value="<?=  $main['kabupaten'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Kecamatan</label>
                            <input type="text" class="form-control" required placeholder="Kecamatan" name="kecamatan" value="<?=  $main['kecamatan'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Kelurahan</label>
                            <input type="text" class="form-control" required placeholder="Kelurahan" name="kelurahan" value="<?=  $main['kelurahan'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Status Pernikahan</label>
                            <select name="nikah" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="sudah nikah" <?=  ($main['status_pernikahan'] == "sudah nikah") ? "selected" : "";  ?>>sudah nikah</option>
                                <option value="belum nikah" <?=  ($main['status_pernikahan'] == "belum nikah") ? "selected" : "";  ?>>belum nikah</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Pendidikan</label>
                            <select name="jenis_pendidikan" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="tidak sekolah" <?=  ($main['jenis_pendidikan'] == "tidak sekolah") ? "selected" : "";  ?>>Tidak Sekolah</option>
                                <option value="SD" <?=  ($main['jenis_pendidikan'] == "SD") ? "selected" : "";  ?>>SD</option>
                                <option value="SMP" <?=  ($main['jenis_pendidikan'] == "SMP") ? "selected" : "";  ?>>SMP</option>
                                <option value="SMA/SMK" <?=  ($main['jenis_pendidikan'] == "SMA/SMK") ? "selected" : "";  ?>>SMA/SMK</option>
                                <option value="PERGURUAN TINGGI" <?=  ($main['jenis_pendidikan'] == "PERGURUAN TINGGI") ? "selected" : "";  ?>>PERGURUAN TINGGI</option>
                                <option value="lainnya" <?=  ($main['jenis_pendidikan'] == "lainnya") ? "selected" : "";  ?>>lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Pekerjaan</label>
                            <select name="jenis_pekerjaan" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="tidak bekerja" <?=  ($main['jenis_pekerjaan'] == "tidka bekerja") ? "selected" : "";  ?>>Tidak Bekerja</option>
                                <option value="guru" <?=  ($main['jenis_pekerjaan'] == "guru") ? "selected" : "";  ?>>Guru</option>
                                <option value="nelayan" <?=  ($main['jenis_pekerjaan'] == "nelayan") ? "selected" : "";  ?>>Nelayan</option>
                                <option value="petani" <?=  ($main['jenis_pekerjaan'] == "petani") ? "selected" : "";  ?>>Petani</option>
                                <option value="buruh" <?=  ($main['jenis_pekerjaan'] == "buruh") ? "selected" : "";  ?>>Buruh</option>
                                <option value="polisi" <?=  ($main['jenis_pekerjaan'] == "polisi") ? "selected" : "";  ?>>Polisi</option>
                                <option value="pns" <?=  ($main['jenis_pekerjaan'] == "pns") ? "selected" : "";  ?>>PNS</option>
                                <option value="pengusaha" <?=  ($main['jenis_pekerjaan'] == "pengusaha") ? "selected" : "";  ?>>Pengusahan</option>
                                <option value="lainnya" <?=  ($main['jenis_pekerjaan'] == "lainnya") ? "selected" : "";  ?>>lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Provider</label>
                            <input type="text" class="form-control" required placeholder="Provider" name="provider" value="<?=  $main['provider'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Asuransi</label>
                            <input type="text" class="form-control" required placeholder="Asuransi" name="asuransi" value="<?=  $main['asuransi'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">No Paspor</label>
                            <input type="text" class="form-control" required placeholder="No Paspor" name="no_paspor" value="<?=  $main['no_paspor'];  ?>">
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