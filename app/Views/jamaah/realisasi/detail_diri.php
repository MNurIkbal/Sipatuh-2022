<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                      <div>
                      <a href="<?= base_url("detail_selesai_jamaah/" .  $id_kloter . '/' . $id_paket . '/' . $judul); ?>" class="btn btn-warning">Kembali</a>
                        <br>
                        <br>    
                        <h6>      
                            Detail Jamaah
                        <br>
                        <br>
                        Paket : <?= $paket['nama']; ?>
                        <br>
                        <br>
                        Kloter : <?= $kloter['nama']; ?>
                        <br>
                        <br>
                </h6>
                      </div>
                    </div>
                    <?php

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
                    <ul class="list-group">
                    <div class="row">
                        <div class="col-md-6">
                            <li class="list-group-item active">Informasi Diri</li>
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
                            <li class="list-group-item">Jenis Pekerjaan : <?=  $main['jenis_pekerjaan'];  ?></li>
                            
                        </div>
                        <div class="col-md-6">
                            <li class="list-group-item active">Informasi Lainnya</li>
                            <li class="list-group-item">Provider : <?=  $main['provider'];  ?></li>
                            <li class="list-group-item">Asuransi : <?=  $main['asuransi'];  ?></li>
                            <li class="list-group-item">No Paspor : <?=  $main['no_paspor'];  ?></li>
                            <li class="list-group-item">No Identitas : <?=  $main['no_identitas'];  ?></li>
                            <li class="list-group-item">NPU : <?=  $main['no_pasti_umrah'];  ?></li>
                            <li class="list-group-item">Rekening Penampung : <?=  $main['rekening_penampung'];  ?></li>
                            <li class="list-group-item">Kewarganegaraan : <?=  $main['kewargannegaraan'];  ?></li>
                            <li class="list-group-item">Status Pernikahan: <?=  $main['status_pernikahan'];  ?></li>
                            <li class="list-group-item">Jenis Pendidikan: <?=  $main['jenis_pendidikan'];  ?></li>
                            <li class="list-group-item">No Registrasi : <?=  $main['no_registrasi'];  ?></li>
                            <li class="list-group-item">
                                Foto
                                <div class="wrapper" style="width: 100px;height:100px">
                                    <img src="<?=  base_url("assets/upload/" . $main['foto']);  ?>" alt=""
                                        style="width: 100%;height:100%;object-fit: cover">
                                </div>
                            </li>
                        </div>
                        <div class="col-md-6 mt-5">
                        <li class="list-group-item active">Dokumen Pendukung</li>
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
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mt-5">
                            <li class="list-group-item active">Informasi Visa</li>
                            <li class="list-group-item">Nomor Visa : <?=  $main['nomor_visa'];  ?></li>
                            <li class="list-group-item">Tanggal Awal Visa : <?=  $main['tgl_awal_visa'];  ?></li>
                            <li class="list-group-item">Tanggal Akhir Visa : <?=  $main['tgl_akhir_visa'];  ?></li>
                            <li class="list-group-item">Muassasah : <?=  $main['muassasah'];  ?></li>
                            <li class="list-group-item">No Paspor : <?=  $main['no_paspor'];  ?></li>
                            <li class="list-group-item">Tanggal Keluar Paspor: <?=  $main['tgl_keluar_paspor'];  ?></li>
                            <li class="list-group-item">Tanggal Habis Paspor : <?=  $main['tgl_habis_paspor'];  ?></li>
                            <li class="list-group-item">Kota Paspor : <?=  $main['kota_paspor'];  ?></li>
                        </div>
                        <div class="col-md-6 mt-5">
                            <li class="list-group-item active">Informasi Asuransi</li>
                        <li class="list-group-item">Nomor Polis : <?=  $main['nomor_polis'];  ?></li>
                            <li class="list-group-item">Tanggal Input : <?=  $main['tgl_input'];  ?></li>
                            <li class="list-group-item">Tanggal Awal Polis : <?=  $main['tgl_awal'];  ?></li>
                            <li class="list-group-item">Tanggal Akhir Polis : <?=  $main['tgl_akhir'];  ?></li>
                        </div>
                        <div class="col-md-12 mt-5">
                            <li class="list-group-item active "> 
                                Informasi Travel
                            </li>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <li class="list-group-item">Nama Paket : <?= $paket['nama']; ?></li>
                                    <li class="list-group-item">Periode : <?= date("d, F Y",strtotime($paket['tgl_berangkat'])) . " - " . date("d, F Y",strtotime($paket['tgl_pulang'])); ?></li>
                                    <li class="list-group-item">Tahun : <?= $paket['tahun']; ?></li>
                                    <li class="list-group-item">Keterangan Berangkat : <?= $paket['ket_berangkat']; ?></li>
                                    <li class="list-group-item">Keterangan Pulang : <?= $paket['ket_pulang']; ?></li>
                                    <li class="list-group-item">Tour Leader : <?= $paket['tour_leader']; ?></li>
                                    <li class="list-group-item">Kloter : <?= $kloter['nama']; ?></li>
                                    <li class="list-group-item">No Tiket Berangkat : <?= $main['tiket_cgk_med']; ?></li>
                                    <li class="list-group-item">No Tiket Pulang : <?= $main['tiket_med_gk']; ?></li>
                                    <li class="list-group-item">No Kursi : <?= $main['no_kursi']; ?></li>
                                    <li class="list-group-item">Rekening Penampung : 
                                        <?php if(!empty($banks)) : ?>
                                            <?= $banks['bank'] . ' / ' . $banks['nama'] . ' / ' . $banks['no_rekening']; ?>
                                            <?php endif; ?>
                                    </li>
                                </div>
                                <div class="col-md-6 mt-3">
                                    <li class="list-group-item">Nama Perusahaan : <?= $perusahaan['nama_perusahaan']; ?></li>
                                    <li class="list-group-item">Nama Travel : <?= $perusahaan['nama_travel_umrah']; ?></li>
                                    <li class="list-group-item">No Telephone: <?= $perusahaan['no_telp'] ?></li>
                                    <li class="list-group-item">No Hp: <?= $perusahaan['no_hp']; ?></li>
                                    <li class="list-group-item">Email : <?= $perusahaan['email']; ?></li>
                                    <li class="list-group-item">Website : <?= $perusahaan['website']; ?></li>
                                </div>
                            </div>
                        </div>
                    </div>

                </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<?= $this->endSection(); ?>