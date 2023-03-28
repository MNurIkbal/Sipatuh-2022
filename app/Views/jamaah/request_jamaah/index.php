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
                                                <a href="#" data-toggle="modal" data-target="#detail<?= $row['id'] ?>" class=" btn btn-success"><i class="fa fa-eye"></i></a>
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
    
    <div class="modal fade" tabindex="-1" role="dialog" id="detail<?= $main['id'] ?>">
        <div class="modal-dialog modal-lg" role="document">
            <div  class="modal-content">
                <div class="modal-header">
                    <input type="hidden" name="id_jamaah" value="<?= $main['id']; ?>" class="d-none">
                    <h5 class="modal-title">Detail Jamaaah</h5>
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
                            <li class="list-group-item">Provider : <?=  $main['provider'];  ?></li>
                            <li class="list-group-item">Asuransi : <?=  $main['asuransi'];  ?></li>
                            <li class="list-group-item">No Paspor : <?=  $main['no_paspor'];  ?></li>
                            <li class="list-group-item">No Identitas : <?=  $main['no_identitas'];  ?></li>
                        </div>
                        <div class="col-md-6">
                            <li class="list-group-item">NPU : <?=  $main['no_pasti_umrah'];  ?></li>
                            <?php 
                            $data_bank = $bank->where("id",$main['rekening_penampung_id'])->first();
                            ?>
                            <li class="list-group-item">Rekening Penampung : <?=  $data_bank['bank'];  ?> - <?= $data_bank['no_rekening']; ?></li>
                            <li class="list-group-item">Status Bayar : <span class="badge badge-pill badge-primary"><?=  $main['status_bayar'];  ?></span></li>
                            <!-- <?php if($main['status_bayar'] == "lunas" || $main['status_bayar'] == "cicil") : ?>
                                <li class="list-group-item">Keterangan Bayar : <?=  $main['keterangan_bayar'];  ?></li>
                                <?php if($main['nominal_pembayaran']) : ?>
                                    <li class="list-group-item">Nominal Pembayaran : Rp. <?=  number_format($main['nominal_pembayaran'],0);  ?></li>
                                    <?php else: ?>
                                    <li class="list-group-item">Nominal Pembayaran : Rp. <?=  0;  ?></li>
                                    <?php endif; ?>
                                    <?php if($main['sisa_pembayaran']) : ?>
                                        <li class="list-group-item">Sisa Pembayaran : Rp. <?= number_format( $main['sisa_pembayaran'],0);  ?></li>
                                        <?php else: ?>
                                            <li class="list-group-item">Sisa Pembayaran : Rp. <?= 0;  ?></li>
                                        <?php endif; ?>
                                <li class="list-group-item">Bukti Pembayaran : 
                                    <div style="width: 120px;height: 80px">
                                        <img src="<?=  base_url("assets/upload/" . $main['bukti_pembayaran']);  ?>" alt="" style="width: 100%;height: 100%">
                                    </div>
                                </li>
                                <?php endif; ?> -->
                            <li class="list-group-item">Nomor Polis : <?=  $main['nomor_polis'];  ?></li>
                            <li class="list-group-item">Tanggal Input Polis : <?=  $main['tgl_input'];  ?></li>
                            <li class="list-group-item">Tanggal Awal Polis : <?=  $main['tgl_awal'];  ?></li>
                            <li class="list-group-item">Tanggal Akhir Polis : <?=  $main['tgl_akhir'];  ?></li>
                            <li class="list-group-item">Nomor Visa : <?=  $main['nomor_visa'];  ?></li>
                            <li class="list-group-item">Tanggal Awal Visa : <?=  $main['tgl_awal_visa'];  ?></li>
                            <li class="list-group-item">Tanggal Akhir Visa : <?=  $main['tgl_akhir_visa'];  ?></li>
                            <li class="list-group-item">Muassasah : <?=  $main['muassasah'];  ?></li>
                            <li class="list-group-item">Status Vaksin : <?=  $main['status_vaksin'];  ?></li>
                            <li class="list-group-item">Tanggal Vaksin : <?=  $main['tgl_vaksin'];  ?></li>
                            <li class="list-group-item">Jenis Vaksin : <?=  $main['jenis_vaksin'];  ?></li>
                            <?php 
                            $biodata = new App\Models\BioDataModel();
                            $result_bio = $biodata->where("user_id",$main['user_id'])->first();
                            
                            ?>
                            <li class="list-group-item">No Registrasi : <?=  $main['no_registrasi'];  ?></li>
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
                            <?php endif; ?>
                        </li>
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
                        <select style="width: 100% !important;" name="kloter" class="form-control sele32" required id="">
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
         $('.sele32').select2({
        dropdownParent: $("#hapus<?= $main['id'] ?>")
    });
    </script>
<?php endforeach; ?>
<?= $this->endSection(); ?>