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
                            <span>Periode :
                                <?=  date("d F Y",strtotime($paket['tgl_berangkat'])) . ' - ' . date("d, F Y",strtotime($paket['tgl_pulang']));  ?></span>
                            <br>
                            <span>Kode Paket : <?=  $paket['kode_paket'];  ?></span>
                            <br>
                            <span>Kloter : <span class="badge badge-pill badge-success"><?=  $kloter['nama'];  ?></span>
                            </span>
                        </b>
                        <br>
                        <br>
                        <a title="Kembali" href="<?=  base_url("detail_pendaftaran_kloter/" . $id);  ?>" class="btn btn-warning"><i
                                class="fas fa-arrow-left"></i></a>
                        <?php if($count) : ?>
                        <a title="Export Exel" href="<?=  base_url("download_jamaah/$id/$id_kloter");  ?>"
                            class="btn btn-success"><i class="fas fa-download"></i></a>
                        <a target="_blank" title="Download PDF" href="<?=  base_url("download_pdf/$id/$id_kloter");  ?>"
                            class="btn btn-warning"><i class="fas fa-download" title="Download PDF"></i></a>
                        <?php if($finish >= $count) : ?>
                        <a target="_blank" title="Print Kartu" href="<?=  base_url("print_kartu/$id");  ?>" class="btn btn-dark"><i
                                class="fas fa-print"></i></a>
                        <?php if($paket['keberangkatan'] != "sudah" ) : ?>
                        <a href="#" class="btn btn-danger " title="Siap Berangkat" data-toggle="modal" data-target="#berangkat"><i
                                class="fas fa-plane"></i></a>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php endif; ?>
                        <?php if($paket['keberangkatan'] != "sudah") : ?>
                        <a href="<?= base_url("insert_jamaah/$id/$id_kloter"); ?>" class="btn btn-primary "><i
                                class="fas fa-plus"></i></a>
                        <a href="<?=  base_url("download_template");  ?>" title="Download Template Exel"
                            class="btn btn-info "><i class="fas fa-arrow-up"></i></a>
                        <?php endif; ?>
                        <div class="table-responsive mt-5">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th>No</th>
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
                                            <?= $no++; ?>
                                        </td>
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
                                            <span>STATUS BAYAR : <span class="badge badge-success">SUDAH
                                                    BAYAR</span></span>
                                            <?php else: ?>
                                            <span>STATUS BAYAR : <span class="badge badge-danger">BELUM
                                                    BAYAR</span></span>
                                            <?php endif; ?>
                                            <br>
                                            <span>PROVIDER : <?=  $row['provider'];  ?></span>
                                            <br>
                                            <span>ASURANSI : <?=  $row['asuransi'];  ?></span>
                                        </td>
                                        <td>
                                                <span>
                                                    <?php if($row['status_vaksin'] == "sudah") : ?>
                                                        STATUS VAKSIN : <span class="badge badge-success">Sudah</span>
                                                        <?php else: ?>
                                                            STATUS VAKSIN : <span class="badge badge-danger">Belum</span>
                                                        <?php endif; ?>
                                                </span>
                                                <br>
                                                <?php if($row['tgl_vaksin']) : ?>
                                                    <span>
                                                        TANGGAL VAKSIN : <?=  date("d-m-Y",strtotime($row['tgl_vaksin']));  ?>
                                                    </span>
                                                    <?php else: ?>
                                                        <span>TANGGAL VAKSIN : </span>
                                                    <?php endif; ?>
                                                <br>
                                                <span>
                                                    JENIS VAKSIN : <?=  $row['jenis_vaksin'];  ?>
                                                </span>
                                            </td>
                                        <td>
                                            <span>POLIS : <?=  $row['nomor_polis'];  ?></span>
                                            <br>
                                            <span>VISA : <?=  $row['nomor_visa'];  ?></span>
                                            <br>
                                            <span>PASPOR : <?=  $row['no_paspor'];  ?></span>
                                            <br>
                                            <span>STATUS APPROVE BAYAR :   
                                                <?php if($row['selesai_pembayaran']) : ?>
                                            <span class="badge badge-primary badge-pill "><?=  $row['selesai_pembayaran'];  ?></span>
                                            <?php else: ?>
                                                <span class="badge badge-danger badge-pill "><?=  "Belum Dikonfirmasi";  ?></span>
                                                <?php endif; ?>
                                        </span>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-primary" title="Detail" data-toggle="modal"
                                                data-target="#view<?= $row['id']  ?>"><i class="fa fa-eye"></i></a>
                                            <?php  if($paket['keberangkatan'] != "sudah") : ?>
                                                <?php  if($row['selesai_pembayaran'] != "sudah" && $row['status_bayar'] != "lunas") : ?>
                                                    <a href="#" title="Hapus" class="btn btn-danger" data-toggle="modal"
                                                        data-target="#hapus<?= $row['id'] ?>"><i class="fa fa-trash"></i></a>
                                                    <?php endif; ?>
                                                <?php if(empty($row['user_id'])) : ?>
                                                    <a href="<?= base_url("edits_jamaah/" . $id_kloter . '/' . $row['id'] . '/' . $id); ?>" title="Edit" class="btn btn-success" ><i class="fa fa-pen"></i></a>
                                                    <?php endif; ?>
                                                    <?php  if($row['selesai_pembayaran'] != "sudah" && $row['status_bayar'] != "lunas" && $row['status_bayar'] != "cicil" && $row['status_bayar'] != "DP") : ?>
                                                        <a href="<?=  base_url("pindah_paket_umrah/$row[id]/$id_kloter/$id");  ?>" title="Pindah Travel" class="btn btn-warning"><i
                                                                class="fa fa-edit"></i></a>
                                                        <?php endif; ?>
                                                    <?php if(!empty($row['user_id'])) : ?>
                                                        <?php if(empty($row['selesai_pembayaran']) && $row['status_bayar'] == "lunas") : ?>
                                                            <?php endif; ?>
                                                            <?php  if($row['selesai_pembayaran'] != "sudah" && $row['status_bayar'] != "lunas") : ?>
                                                                <a href="<?=  base_url("pembayaran" . '/' . $row['id'] . '/' . $id . '/' . $id_kloter);  ?>" class="btn btn-info" title="Pembayaran"><i
                                                                        class="fa fa-clipboard"></i></a>
                                                                <?php endif; ?>
                                                        <?php endif; ?>
                                            <?php if(empty($row['user_id'])) : ?>
                                                <a href="<?= base_url("kelengkapan_jamaah/$row[id]/$id/$id_kloter"); ?>" class="btn btn-primary " title="Kelengkapan" ><i
                                                        class="fa fa-address-card"></i></a>
                                                <?php endif; ?>
                                            <?php endif; ?>
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
<div class="modal fade" tabindex="-1" role="dialog" id="berangkat">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("mangkat");  ?>" class="modal-content">
            <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
            <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi keberangkatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php 
            $db      = \Config\Database::connect();
            $orang = $db->query("SELECT * FROM jamaah WHERE paket_id = '$id' AND kloter_id = '$id_kloter'")->getResult();
            ?>
            <div class="modal-body">
                <div class="alert alert-success">
                    <p>Apakah Anda Yakin <?=  count($orang);  ?> Orang Pada Paket Umrah Periode
                        <?=  date("d, F Y",strtotime($paket['tgl_berangkat']));  ?> -
                        <?=  date("d, F Y",strtotime($paket['tgl_pulang']));  ?> Siap Berangkat</p>
                    <p>Apabila anda yakin,silahkan klik tombol berangkat,data paket dan jamaah sudah tidak bisa diubah
                        lagi</p>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Berangkat</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_jamaah");  ?>"
            class="modal-content">
            <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
            <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
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
                            <!-- <input type="text" class="form-control" required placeholder="Title" name="title"> -->
                            <select name="title" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="Tuan">Tuan</option>
                                <option value="Nyonya">Nyoya</option>
                            </select>
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
                            <input type="text" class="form-control " name="no_identitas" required
                                placeholder="No Identitas">
                        </div>
                        <div class="mb-3">
                            <label for="">Tempat Lahir</label>
                            <input type="text" class="form-control " required placeholder="Tempat Lahir"
                                name="tempat_lahir">
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_lahir">
                        </div>
                        <div class="mb-3">
                            <label for="">No Telepon</label>
                            <input type="number" class="form-control" required placeholder="No Telepon"
                                name="no_telpon">
                        </div>
                        <div class="mb-3">
                            <label for="">No Hp</label>
                            <input type="number" class="form-control" required placeholder="No Hp" name="no_hp">
                        </div>
                        <div class="mb-3">
                            <label for="">Kewarganegaraan</label>
                            <select name="warganegara" class="form-control select2" required id="">
                                <option value="">Pilih</option>
                                <option value="wni">WNI</option>
                                <option value="wna">WNA</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Nama Paspor</label>
                            <input type="text" class="form-control" required placeholder="Nama Paspor"
                                name="nama_paspor">
                        </div>
                        <div class="mb-3">
                            <label for="">Foto</label>
                            <input type="file" class="form-control" required placeholder="Foto" name="foto">
                        </div>
                        <div class="mb-3">
                            <label for="">Alamat </label>
                            <textarea name="alamat" id="" class="form-control" required cols="30" rows="10"
                                placeholder="Alamat"></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                    <div class="mb-3">
                            <label for="">Provinsi</label>
                            <?php 
                            $mains =  $db->query("SELECT * FROM provinces ")->getResultArray();
                            ?>
                            <select name="provinsi" id="provinsi" class="form-control" required>
                                <option value="">Pilih</option>
                                <?php foreach($mains as $rt) :  ?>
                                    <option value="<?= $rt['id']  . '-' . $rt['name']; ?>"><?= $rt['name']; ?></option>
                                    <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Kabupaten</label>
                            <select name="kabupaten" id="kabupaten" class="form-control" required>
                                <option value="">Pilih</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-control" required>
                                <option value="">Pilih</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan" class="form-control" required>
                                <option value="">Pilih</option>
                            </select>
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
                            <!-- <input type="text" class="form-control" required placeholder="Provider" name="provider"> -->
                            <select name="provider" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <?php foreach($provider as $providers) : ?>
                                <option value="<?=  $providers['nama_provider'];  ?>">
                                    <?=  $providers['nama_provider'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Asuransi</label>
                            <!-- <input type="text" class="form-control" required placeholder="Asuransi" name="asuransi"> -->
                            <select name="asuransi" required class="form-control" id="">
                                <option value="">Pilih</option>
                                <?php foreach($asuransi as $asuransis) : ?>
                                <option value="<?=  $asuransis['nama'];  ?>"><?=  $asuransis['nama'];  ?></option>
                                <?php endforeach; ?>
                            </select>
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
<div class="modal fade" tabindex="-1" role="dialog" id="vaksin<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("vaksin/" . $main['id']);  ?>"
            class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
                <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">

                <h5 class="modal-title">Vaksin</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Jenis Vaksin</label>
                    <input type="text" name="jenis" class="form-control" required placeholder="Jenis Vaksin" value="<?=  $main['jenis_vaksin'];  ?>">
                </div>
                <div class="mb-3">
                    <label for="">Tanggal Vaksin</label>
                    <input type="date" name="tgl" value="<?=  $main['tgl_vaksin'];  ?>" class="form-control" required placeholder="">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("hapus_jamaah/" . $main['id']);  ?>"
            class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
                <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">

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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("asuransi/" . $main['id']);  ?>"
            class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
                <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
                <h5 class="modal-title">Pelaporan Asuransi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="">Asuransi : </label>
                        <select name="asuransi" class="form-control" required  id="">
                            <option value="">Pilih</option>
                            <?php foreach($asuransi as $main_empat) : ?>
                                <option value="<?=  $main_empat['nama'];  ?>" <?=  ($main_empat['nama'] == $main['asuransi']) ? "selected" : "";  ?>><?=  $main_empat['nama'];  ?></option>
                                <?php endforeach; ?>
                        </select>
                </div>
                <div class="mb-1">
                    <label for="">Nomor Polis : </label>
                    <input type="text" name="nomor" class="form-control " required placeholder="Nomor Polis"
                        value="<?=  $main['nomor_polis'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Tanggal Input: </label>
                    <input type="date" name="tgl_input" class="form-control " required placeholder="Tanggal"
                        value="<?=  $main['tgl_input'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Tanggal Awal Polis: </label>
                    <input type="date" name="awal" class="form-control " required placeholder="Tanggal"
                        value="<?=  $main['tgl_awal'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Tanggal Akhir Polis: </label>
                    <input type="date" name="akhir" class="form-control " required placeholder="Tanggal"
                        value="<?=  $main['tgl_akhir'];  ?>">
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="view<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
            <div class="modal-header">
                <h5 class="modal-title">Detail Jamaah</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <div class="row">
                        <div class="col-md-6">
                            <li class="list-group-item">Title : <?=  $main['title'];  ?></li>
                            <li class="list-group-item">Nama : <?=  $main['nama'];  ?></li>
                            <li class="list-group-item">Nama Paspor: <?=  $main['nama_paspor'];  ?></li>
                            <li class="list-group-item">Nama Ayah: <?=  $main['ayah'];  ?></li>
                            <li class="list-group-item">Jenis Identitas : <?=  $main['jenis_identitas'];  ?></li>
                            <li class="list-group-item">Tempat Tanggal Lahir:
                                <?=  $main['tempat_lahir'] . ' , ' . date("d F Y",strtotime($main['tgl_lahir'])) ?></li>
                            <li class="list-group-item">Provinsi : <?=  $main['provinsi'];  ?></li>
                            <li class="list-group-item">Kabupaten : <?=  $main['kabupaten'];  ?></li>
                            <li class="list-group-item">Kecamatan : <?=  $main['kecamatan'];  ?></li>
                            <li class="list-group-item">Kelurahan : <?=  $main['kelurahan'];  ?></li>
                            <li class="list-group-item">Alamat : <?=  $main['alamat'];  ?></li>
                            <li class="list-group-item">No Telephone : <?=  $main['no_telp'];  ?></li>
                            <li class="list-group-item">No Hp : <?=  $main['no_hp'];  ?></li>
                            <li class="list-group-item">Kewarganegaraan : <?=  $main['kewargannegaraan'];  ?></li>
                            <li class="list-group-item">Status Pernikahan: <?=  $main['status_pernikahan'];  ?></li>
                            <li class="list-group-item">Jenis Pendidikan: <?=  $main['jenis_pendidikan'];  ?></li>
                            <li class="list-group-item">Jenis Pekerjaan : <?=  $main['jenis_pekerjaan'];  ?></li>
                        </div>
                        <div class="col-md-6">
                            <li class="list-group-item">Provider : <?=  $main['provider'];  ?></li>
                            <li class="list-group-item">Asuransi : <?=  $main['asuransi'];  ?></li>
                            <li class="list-group-item">No Paspor : <?=  $main['no_paspor'];  ?></li>
                            <li class="list-group-item">No Identitas : <?=  $main['no_identitas'];  ?></li>
                            <li class="list-group-item">NPU : <?=  $main['no_pasti_umrah'];  ?></li>
                            <li class="list-group-item">Rekening Penampung : <?=  $main['rekening_penampung'];  ?></li>
                            <li class="list-group-item">Status Bayar : <span class="badge badge-pill badge-primary"><?=  $main['status_bayar'];  ?></span></li>
                            <li class="list-group-item">Nomor Polis : <?=  $main['nomor_polis'];  ?></li>
                            <li class="list-group-item">Tanggal Input : <?=  $main['tgl_input'];  ?></li>
                            <li class="list-group-item">Tanggal Awal Polis : <?=  $main['tgl_awal'];  ?></li>
                            <li class="list-group-item">Tanggal Akhir Polis : <?=  $main['tgl_akhir'];  ?></li>
                            <li class="list-group-item">Nomor Visa : <?=  $main['nomor_visa'];  ?></li>
                            <li class="list-group-item">Tanggal Awal Visa : <?=  $main['tgl_awal_visa'];  ?></li>
                            <li class="list-group-item">Tanggal Akhir Visa : <?=  $main['tgl_akhir_visa'];  ?></li>
                            <li class="list-group-item">Muassasah : <?=  $main['muassasah'];  ?></li>
                            <li class="list-group-item">No Registrasi : <?=  $main['no_registrasi'];  ?></li>
                            <?php 
                            $biodata = new App\Models\BioDataModel();
                            
                            $result_bio = $biodata->where("user_id",$main['user_id'])->first();
                            // dd($result_bio);
                            if($result_bio) :
                            ?>
                            <li class="list-group-item">Dokumen KTP :
                        <?php if($result_bio['file_ktp']) : ?>        
                            <a href="<?= base_url("assets/upload/" . $result_bio['file_ktp']); ?>" class="btn btn-success" ><i class="fas fa-download"></i></a>
                            <?php endif; ?>
                        </li>
                            <li class="list-group-item">Dokumen Kartu Keluarga :
                        <?php if($result_bio['file_kk']) : ?>        
                            <a download="" href="<?= base_url("assets/upload/" . $result_bio['file_kk']); ?>" class="btn btn-success" ><i class="fas fa-download"></i></a>
                            <?php endif; ?>
                        </li>
                            <li class="list-group-item">Dokumen Paspor :
                        <?php if($result_bio['file_paspor']) : ?>        
                            <a download="" href="<?= base_url("assets/upload/" . $result_bio['file_paspor']); ?>" class="btn btn-success" ><i class="fas fa-download"></i></a>
                            <?php endif; ?>
                        </li>
                            <li class="list-group-item">Dokumen Visa :
                        <?php if($result_bio['file_visa']) : ?>        
                            <a download="" href="<?= base_url("assets/upload/" . $result_bio['file_visa']); ?>" class="btn btn-success" ><i class="fas fa-download"></i></a>
                            <?php endif; ?>
                        </li>
                            <li class="list-group-item">Sertifikat Vaksin :
                        <?php if($result_bio['file_sertifikat_vaksin']) : ?>        
                            <a download="" href="<?= base_url("assets/upload/" . $result_bio['file_sertifikat_vaksin']); ?>" class="btn btn-success" ><i class="fas fa-download"></i></a>
                        </li>
                        <?php endif; ?>
                            <?php endif; ?>
                            <li class="list-group-item">
                                Foto
                                <div class="wrapper" style="width: 100px;height:100px">
                                    <img src="<?=  base_url("assets/upload/" . $main['foto']);  ?>" alt=""
                                        style="width: 100%;height:100%;object-fit: cover">
                                </div>
                            </li>
                        </div>
                    </div>

                </ul>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="visa<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("visa/" . $main['id']);  ?>"
            class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
                <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
                <h5 class="modal-title">Pelaporan Visa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label for="">Provider : </label>
                    <!-- <input type="text" name="provider" class="form-control " required placeholder="Provider" autofocus
                        value="<?=  $main['provider'];  ?>"> -->
                        <select name="provider" class="form-control" required id="">
                            <option value="">Pilih</option>
                            <?php foreach($provider as $main_tiga) : ?>
                                <option <?=  ($main_tiga['nama_provider'] == $main['provider']) ? "selected" : "";  ?> value="<?=  $main_tiga['nama_provider'];  ?>"><?=  $main_tiga['nama_provider'];  ?></option>
                                <?php endforeach; ?>
                        </select>
                </div>
                <div class="mb-1">
                    <label for="">Nomor Visa: </label>
                    <input type="text" name="nomor" class="form-control " required placeholder="Nomor Visa"
                        value="<?=  $main['nomor_visa'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Tanggal Awal Visa: </label>
                    <input type="date" name="awal" class="form-control " required placeholder="Tanggal"
                        value="<?=  $main['tgl_awal_visa'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Tanggal Akhir Visa: </label>
                    <input type="date" name="akhir" class="form-control " required placeholder="Tanggal"
                        value="<?=  $main['tgl_akhir_visa'];  ?>">
                </div>
                <div class="mb-1">
                    <label for="">Muassasah: </label>
                    <select name="muassasah" required class="form-control" id="">
                        <option value="">Pilih</option>
                        <?php foreach($muasah as $row_dua) : ?>
                        <option <?=  ($row_dua['nama_muassasah'] == $main['muassasah']) ? "selected" : "";  ?>
                            value="<?=  $row_dua['nama_muassasah'];  ?>"><?=  $row_dua['nama_muassasah'];  ?></option>
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
<div class="modal fade" tabindex="-1" role="dialog" id="bayar<?= $main['id'] ?>">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("bayar/" . $main['id']);  ?>"
            class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
                
                <h5 class="modal-title">Data Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- <div class="mb-1">
                    <label for="">Tanggal Pembayaran : </label>
                    <input type="date" name="tgl" class="form-control " required placeholder="Tanggal" autofocus  value="<?=  $main['tgl_bayar'];  ?>">
                </div> -->
                <div class="mb-1">
                    <label for="">Rekening Penampung : </label>
                    <select name="rekening" class="form-control" required autocomplete="off" id="">
                        <option value="">Pilih</option>
                        <?php foreach($bank as $banks) : ?>
                        <option value="<?=  $banks['id']  ?>"
                            <?=  ($banks['id'] == $main['rekening_penampung']) ? "selected" : "";  ?>>
                            <?=  $banks['bank'] . ' - '.  $banks['nama'] . ' - '. $banks['no_rekening'];  ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-1">
                    <label for="">Status Pembayaran : </label>
                    <select name="status" class="form-control" required id="pembayaran_baru<?= $main['id'] ?>"
                        onchange="pembayaran()">
                        <option value="">Pilih</option>
                        <option value="belum" <?=  ($main['status_bayar'] == "belum") ? "selected" : "";  ?>>Belum Bayar
                        </option>
                        <option value="cicil" <?=  ($main['status_bayar'] == "cicil") ? "selected" : "";  ?>>Cicil
                        </option>
                        <option value="lunas" <?=  ($main['status_bayar'] == "lunas") ? "selected" : "";  ?>>Lunas
                        </option>
                    </select>
                </div>
                <div id="container_pembayaran<?= $main['id'] ?>">
                        <div class="mb-1">
                            <label for="">Nominal</label>
                            <input type="text" id="nominal" name="nominal" class="form-control">
                        </div>
                        <div class="mb-1">
                            <label for="">Sisa Pembayaran</label>
                            <?php if($main['sisa_pembayaran']) : ?>
                                <input type="text" readonly value="Rp. <?=  number_format($main['sisa_pembayaran'],0);  ?>" class="form-control">
                                <?php else: ?>
                                    <input type="text" readonly value="Rp." class="form-control">
                                <?php endif; ?>
                        </div>
                        <div class="mb-1">
                            <input type="hidden" name="file_lama" value="<?=  $main['bukti_pembayaran'];  ?>">
                            <label for="">Bukti Pembayaran</label>
                            <input type="file" name="file" class="form-control">
                        </div>
                </div>
             
                <div class="mb-1">
                    <label for="">Keterangan : </label>
                    <textarea name="keterangan" class="form-control" required id="" cols="30" rows="10"
                        placeholder="Keterangan"><?=  $main['keterangan_bayar'];  ?></textarea>
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
        <form method="POST" enctype="multipart/form-data" action="<?=  base_url("pindah_paket/" . $main['id']);  ?>"
            class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
                <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
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
                    <select name="paket" class="form-control" required autofocus autocomplete="" id="">
                        <option value="">Pilih</option>
                        <?php foreach($all_paket as $rt) : ?>
                        <?php if($rt['id'] != $id) : ?>
                        <option value="<?=  $rt['id'];  ?>"><?=  $rt['nama'];  ?></option>
                        <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-1">
                    <label for="">Kloter</label>
                    <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
                    <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
                    <select name="paket" class="form-control" required autofocus autocomplete="" id="">
                        <option value="">Pilih</option>
                        <?php foreach($data_kloter as $rts) : ?>
                            <option value="<?=  $rts['id'];  ?>"><?=  $rts['nama'];  ?></option>
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
            <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
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
                            <!-- <input type="text" class="form-control" required placeholder="Title" name="title" value="<?=  $main['title'];  ?>"> -->
                            <select name="title" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="Tuan" <?=  ($main['title'] == "Tuan") ? "selected" : "";  ?>>Tuan
                                </option>
                                <option value="Nyonya" <?=  ($main['title'] == "Nyonya") ? "selected" : "";  ?>>Nyoya
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" required placeholder="Nama" name="nama"
                                value="<?=  $main['nama'];  ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Nama Ayah</label>
                            <input type="text" class="form-control" required placeholder="Nama Ayah" name="ayah"
                                value="<?=  $main['ayah'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Identitas</label>
                            <select name="jenis_identitas" id="" class="form-control" required>
                                <option value="">Pilih</option>
                                <option value="nik" <?=  ($main['jenis_identitas'] == "nik") ? "selected" : "";  ?>>Nik
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">No Identitas</label>
                            <input type="text" class="form-control " required placeholder="No Identitas"
                                value="<?=  $main['no_identitas'];  ?>" name="no_identitas">
                        </div>
                        <div class="mb-3">
                            <label for="">Tempat Lahir</label>
                            <input type="text" class="form-control " required placeholder="Tempat Lahir"
                                name="tempat_lahir" value="<?= $main['tempat_lahir'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Tanggal Lahir</label>
                            <input type="date" class="form-control" required placeholder="" name="tgl_lahir"
                                value="<?=  $main['tgl_lahir'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">No Telepon</label>
                            <input type="number" class="form-control" required placeholder="No Telepon" name="no_telpon"
                                value="<?=  $main['no_telp'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">No Hp</label>
                            <input type="number" class="form-control" required placeholder="No Hp" name="no_hp"
                                value="<?=  $main['no_hp'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Kewarganegaraan</label>
                            <select name="warganegara" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="wni" <?=  ($main['kewargannegaraan'] == "wni") ? "selected" : "";  ?>>WNI
                                </option>
                                <option value="wna" <?=  ($main['kewargannegaraan'] == "wna") ? "selected" : "";  ?>>WNA
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Nama Paspor</label>
                            <input type="text" class="form-control" required placeholder="Nama Paspor"
                                name="nama_paspor" value="<?=  $main['nama_paspor'];  ?>">
                        </div>
                        <div class="mb-3">
                            <div class="wrapper" style="width: 200px;height: 150px">
                                <img src="<?=  base_url("assets/upload/" . $main['foto']);  ?>"
                                    class="img-fluid img-thumbnail" alt="" style="width: 100%;height: 100%">
                            </div>
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="foto_lama" value="<?=  $main['foto'];  ?>">
                            <label for="">Foto</label>
                            <input type="file" class="form-control" placeholder="Foto" name="foto">
                        </div>
                        <div class="mb-3">
                            <label for="">Alamat </label>
                            <textarea name="alamat" id="" class="form-control" required cols="30" rows="10"
                                placeholder="Alamat"><?=  $main['alamat'];  ?></textarea>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Provinsi</label>
                            <?php 
                            $nama_provinsi  = $main['provinsi'];
                            $mains =  $db->query("SELECT * FROM provinces ")->getResultArray();
                            ?>
                            <select name="provinsi" id="provinsi" class="form-control" required>
                                <option value="">Pilih</option>
                                <?php foreach($mains as $rt) :  ?>
                                    <option value="<?= $rt['id']  . '-' . $rt['name']; ?>" <?= ($rt['name'] == $nama_provinsi) ? "selected" : ""; ?>><?= $rt['name']; ?></option>
                                    <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Kabupaten</label>
                            <select name="kabupaten" id="kabupaten_satu" class="form-control" required>
                                <option value="<?= $main['kabupaten']; ?>"><?= $main['kabupaten']; ?></option>
                            </select>
                            <select class="form-control" required name="kabupaten" id="kabupaten_dua">
                                
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Kecamatan</label>
                            <input type="text" class="form-control" required placeholder="Kecamatan" name="kecamatan"
                                value="<?=  $main['kecamatan'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Kelurahan</label>
                            <input type="text" class="form-control" required placeholder="Kelurahan" name="kelurahan"
                                value="<?=  $main['kelurahan'];  ?>">
                        </div>
                        <div class="mb-3">
                            <label for="">Status Pernikahan</label>
                            <select name="nikah" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="sudah nikah"
                                    <?=  ($main['status_pernikahan'] == "sudah nikah") ? "selected" : "";  ?>>sudah
                                    nikah</option>
                                <option value="belum nikah"
                                    <?=  ($main['status_pernikahan'] == "belum nikah") ? "selected" : "";  ?>>belum
                                    nikah</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Pendidikan</label>
                            <select name="jenis_pendidikan" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="tidak sekolah"
                                    <?=  ($main['jenis_pendidikan'] == "tidak sekolah") ? "selected" : "";  ?>>Tidak
                                    Sekolah</option>
                                <option value="SD" <?=  ($main['jenis_pendidikan'] == "SD") ? "selected" : "";  ?>>SD
                                </option>
                                <option value="SMP" <?=  ($main['jenis_pendidikan'] == "SMP") ? "selected" : "";  ?>>SMP
                                </option>
                                <option value="SMA/SMK"
                                    <?=  ($main['jenis_pendidikan'] == "SMA/SMK") ? "selected" : "";  ?>>SMA/SMK
                                </option>
                                <option value="PERGURUAN TINGGI"
                                    <?=  ($main['jenis_pendidikan'] == "PERGURUAN TINGGI") ? "selected" : "";  ?>>
                                    PERGURUAN TINGGI</option>
                                <option value="lainnya"
                                    <?=  ($main['jenis_pendidikan'] == "lainnya") ? "selected" : "";  ?>>lainnya
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Pekerjaan</label>
                            <select name="jenis_pekerjaan" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <option value="tidak bekerja"
                                    <?=  ($main['jenis_pekerjaan'] == "tidak bekerja") ? "selected" : "";  ?>>Tidak
                                    Bekerja</option>
                                <option value="guru" <?=  ($main['jenis_pekerjaan'] == "guru") ? "selected" : "";  ?>>
                                    Guru</option>
                                <option value="nelayan"
                                    <?=  ($main['jenis_pekerjaan'] == "nelayan") ? "selected" : "";  ?>>Nelayan</option>
                                <option value="petani"
                                    <?=  ($main['jenis_pekerjaan'] == "petani") ? "selected" : "";  ?>>Petani</option>
                                <option value="buruh" <?=  ($main['jenis_pekerjaan'] == "buruh") ? "selected" : "";  ?>>
                                    Buruh</option>
                                <option value="polisi"
                                    <?=  ($main['jenis_pekerjaan'] == "polisi") ? "selected" : "";  ?>>Polisi</option>
                                <option value="pns" <?=  ($main['jenis_pekerjaan'] == "pns") ? "selected" : "";  ?>>PNS
                                </option>
                                <option value="pengusaha"
                                    <?=  ($main['jenis_pekerjaan'] == "pengusaha") ? "selected" : "";  ?>>Pengusahan
                                </option>
                                <option value="lainnya"
                                    <?=  ($main['jenis_pekerjaan'] == "lainnya") ? "selected" : "";  ?>>lainnya</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" id="provs" onclick="mulai()">Provider</label>
                            <!-- <input type="text" class="form-control" required placeholder="Provider" name="provider" value="<?=  $main['provider'];  ?>"> -->
                            <select name="provider" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <?php foreach($provider as $providert) : ?>
                                <option <?=  ($providert['nama_provider'] == $main['provider']) ? "selected" : "";  ?>
                                    value="<?=  $providert['nama_provider'];  ?>"><?=  $providert['nama_provider'];  ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Asuransi</label>
                            <!-- <input type="text" class="form-control" required placeholder="Asuransi" name="asuransi" value="<?=  $main['asuransi'];  ?>"> -->
                            <select name="asuransi" class="form-control" required id="">
                                <option value="">Pilih</option>
                                <?php foreach($asuransi as $main_dua) : ?>
                                <option value="<?=  $main_dua['nama'];  ?>"
                                    <?=  ($main_dua['nama'] == $main['asuransi']) ? "selected" : "";  ?>>
                                    <?=  $main_dua['nama'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">No Paspor</label>
                            <input type="text" class="form-control" required placeholder="No Paspor" name="no_paspor"
                                value="<?=  $main['no_paspor'];  ?>">
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
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
   
     $("#provinsi").change(function() {
    let val = $(this).val()
    $.ajax({
      url : "<?= base_url("ambil_provinsi") ?>/" + val,
      success : function(data) {
        $("#kabupaten").html(data)
      }
    });

    $("#kabupaten").change(function() {
      let kab = $(this).val()
      $.ajax({
        url : "<?= base_url('ambil_kabupaten') ?>/" + kab,
        success:function(data_dua) {
          $("#kecamatan").html(data_dua)
        }
      })
    });

    
    $("#kecamatan").change(function() {
      let kec = $(this).val()
      $.ajax({
        url : "<?= base_url("ambil_kecamatan") ?>/" + kec,
        success : function(data_tiga) {
          $("#kelurahan").html(data_tiga)
        }
      })
    })
  });
</script>

<?= $this->endSection(); ?>