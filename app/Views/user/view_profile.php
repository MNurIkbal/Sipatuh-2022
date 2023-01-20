<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
  <section class="section">
    <div class="card">
    <?php if (session()->get("success")) : ?>
        <div class="m-3 alert alert-success">
          <span><?= session()->get("success");  ?></span>
        </div>
      <?php elseif (session()->get("error")) : ?>
        <div class="m-3 alert alert-danger">
          <span><?= session()->get("error");  ?></span>
        </div>
      <?php endif; ?>
      <div class="card-header">
        <h4 style="text-transform: uppercase">SELAMAT DATANG <?=  session()->get('nama');  ?></h4>
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-md-6">
            <div class="cards">
              <div class="card-header bg-success text-white">
                <h4>Informasi Diri</h4>
              </div>
              <div class="card-bodys">
                <?php if($jamaah) : ?>
                  <ul class="list-group">
                    <li class="list-group-item">Title : <?=  $jamaah['title'];  ?></li>
                    <li class="list-group-item">Nama : <?= session()->get('nama'); ?></li>
                    <li class="list-group-item">Nama Ayah : <?=  $jamaah['ayah'];  ?></li>
                    <li class="list-group-item">Jenis Identitas : <?=  $jamaah['jenis_identitas'];  ?></li>
                    <li class="list-group-item">Nama Paspor : <?=  $jamaah['nama_paspor'];  ?></li>
                    <li class="list-group-item">Tempat Tanggal Lahir : <?=  $jamaah['tempat_lahir'];  ?>,<?=  date("d, F Y",strtotime($jamaah['tgl_lahir']));  ?></li>
                    <li class="list-group-item">Provinsi : <?=  $jamaah['provinsi'];  ?></li>
                    <li class="list-group-item">Kabupaten : <?=  $jamaah['kabupaten'];  ?></li>
                    <li class="list-group-item">Kecamatan : <?=  $jamaah['kecamatan'];  ?></li>
                    <li class="list-group-item">Kelurahan : <?=  $jamaah['kelurahan'];  ?></li>
                    <li class="list-group-item">Alamat : <?=  $jamaah['alamat'];  ?></li>
                    <li class="list-group-item">Foto : 
                      <div style="width: 150px !important;height: 140px !important;">
                        <img src="<?=  base_url("assets/upload/" . session()->get('img'));  ?>" alt="" style="width: 100% !important;height: 100% !important;">
                      </div>
                  </li>
                  </ul>
                  <?php else: ?>
                    <ul class="list-group">
                      <li class="list-group-item">Title : -</li>
                      <li class="list-group-item">Nama : -</li>
                      <li class="list-group-item">Nama Ayah : -</li>
                      <li class="list-group-item">Jenis Identitas : -</li>
                      <li class="list-group-item">Nama Paspor : -</li>
                      <li class="list-group-item">Tempat Tanggal Lahir : -</li>
                      <li class="list-group-item">Provinsi : -</li>
                      <li class="list-group-item">Kabupaten : -</li>
                      <li class="list-group-item">Kecamatan : -</li>
                      <li class="list-group-item">Kelurahan : -</li>
                      <li class="list-group-item">Alamat : -</li>
                      <li class="list-group-item">Foto : 
                        -
                    </li>
                    </ul>
                    <?php endif; ?>
                <br>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="cards">
              <div class="card-header bg-success text-white">
                <h4>Informasi Lainnya</h4>
              </div>
              <div class="card-bodys  ">
                <?php if($jamaah) : ?>
                  <ul class="list-group">
                    <li class="list-group-item">No Hp : <?= session()->get('no_hp')  ?></li>
                    <li class="list-group-item">No Telephone : <?=  $jamaah['no_telp'];  ?></li>
                    <li class="list-group-item">Kewarganegaraan : <?=  $jamaah['kewargannegaraan'];  ?></li>
                    <li class="list-group-item">Status Pernikahan : <?=  $jamaah['status_pernikahan'];  ?></li>
                    <li class="list-group-item">Jenis Pendidikan : <?=  $jamaah['jenis_pendidikan'];  ?></li>
                    <li class="list-group-item">Jenis Pekerjaan : <?=  $jamaah['jenis_pekerjaan'];  ?></li>
                    <li class="list-group-item">Provider : <?=  $jamaah['provider'];  ?></li>
                    <li class="list-group-item">Asuransi : <?=  $jamaah['asuransi'];  ?></li>
                    <li class="list-group-item">No Paspor : <?=  $jamaah['no_paspor'];  ?></li>
                    <li class="list-group-item">No Identitas : <?=  $jamaah['no_identitas'];  ?></li>
                  </ul>
                  <?php else: ?>
                    <ul class="list-group">
                      <li class="list-group-item">No Hp : -</li>
                      <li class="list-group-item">No Telephone : -</li>
                      <li class="list-group-item">Kewarganegaraan : -</li>
                      <li class="list-group-item">Status Pernikahan : -</li>
                      <li class="list-group-item">Jenis Pendidikan : -</li>
                      <li class="list-group-item">Jenis Pekerjaan : -</li>
                      <li class="list-group-item">Provider : -</li>
                      <li class="list-group-item">Asuransi : -</li>
                      <li class="list-group-item">No Paspor : -</li>
                      <li class="list-group-item">No Identitas : -</li>
                      <li class="list-group-item">No Pasti Umrah : -</li>
                    </ul>
                    <?php endif; ?>
                <br>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4">
            <div class="cards">
              <div class="card-header bg-success text-white">
                <h4>Informasi Dokumen</h4>
              </div>
              <div>
                <ul class="list-group">
                  <li class="list-group-item">
                      Dokumen Kartu Tanda Penduduk : <a download="" href="<?= base_url("assets/upload/" . $jamaah['file_ktp']); ?>" class="btn btn-success   "><i class="fas fa-download"></i></a>
                  </li>
                  <li class="list-group-item">
                      Dokumen Kartu Keluarga : <a href="<?= base_url("assets/upload/" . $jamaah['file_kk']); ?>" download="" class="btn btn-success   "><i class="fas fa-download"></i></a>
                  </li>
                  <li class="list-group-item">
                      Dokumen Paspor : <a href="<?= base_url("assets/upload/" . $jamaah['file_paspor']); ?>" download="" class="btn btn-success   "><i class="fas fa-download"></i></a>
                  </li>
                  <li class="list-group-item">
                      Dokumen Visa : <a href="<?= base_url("assets/upload/" . $jamaah['file_visa']); ?>" download="" class="btn btn-success   "><i class="fas fa-download"></i></a>
                  </li>
                  <li class="list-group-item">
                      Dokumen Asuransi : <a href="<?= base_url("assets/upload/" . $jamaah['file_asuransi']); ?>" download="" class="btn btn-success   "><i class="fas fa-download"></i></a>
                  </li>
                  <li class="list-group-item">
                      Dokumen Provider : <a href="<?= base_url("assets/upload/" . $jamaah['file_provider']); ?>" download="" class="btn btn-success   "><i class="fas fa-download"></i></a>
                  </li>
                  <li class="list-group-item">
                      Dokumen Sertifikat Vaksin : <a download="" href="<?= base_url("assets/upload/" . $jamaah['file_sertifikat_vaksin']); ?>" class="btn btn-success   "><i class="fas fa-download"></i></a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="card">
            <div class="card-header bg-success text-white">
                <h4>Informasi Asuransi</h4>
              </div>
              <div class="card-bodys">
                <?php if($jamaah) : ?>
                  <ul class="list-group">
                    <li class="list-group-item">
                    Asuransi : <?=  $jamaah['asuransi'];  ?>
                    </li>
                    <li class="list-group-item">
                    No Polis : <?=  $jamaah['nomor_polis'];  ?>
                    </li>
                    <li class="list-group-item">
                      <?php if($jamaah['tgl_input']) : ?>
                        Tanggal Input : <?=  date("d, F Y",strtotime($jamaah['tgl_input']));  ?>
                        <?php else: ?>
                          Tanggal Input : 
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item">
                    <?php if($jamaah['tgl_awal']) : ?>
                      Tanggal Awal Polis : <?=  date("d, F Y",strtotime($jamaah['tgl_awal']));  ?>
                        <?php else: ?>
                          Tanggal Awal Polis : 
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item">
                    <?php if($jamaah['tgl_akhir']) : ?>
                      Tanggal Akhir Polis : <?=  date("d, F Y",strtotime($jamaah['tgl_akhir']));  ?>
                        <?php else: ?>
                          Tanggal Akhir Polis : 
                        <?php endif; ?>
                    </li>
                  </ul>
                  <?php else: ?>
                    <ul class="list-group">
                      <li class="list-group-item">
                      Asuransi :-
                      </li>
                      <li class="list-group-item">
                      No Polis : -
                      </li>
                      <li class="list-group-item">
                            Tanggal Input : -
                      </li>
                      <li class="list-group-item">
                            Tanggal Awal Polis : - 
                      </li>
                      <li class="list-group-item">
                            Tanggal Akhir Polis :  -
                      </li>
                    </ul>
                  <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="card">
            <div class="card-header bg-success text-white">
                <h4>Informasi Visa</h4>
              </div>
              <div class="card-bodys">
                <?php if($jamaah) : ?>
                  <ul class="list-group">
                    <li class="list-group-item">
                    Provider : <?=  $jamaah['asuransi'];  ?>
                    </li>
                    <li class="list-group-item">
                    No Visa : <?=  $jamaah['nomor_visa'];  ?>
                    </li>
                    <li class="list-group-item">
                    <?php if($jamaah['tgl_awal_visa']) : ?>
                        Tanggal Awal Visa : <?=  date("d, F Y",strtotime($jamaah['tgl_awal_visa']));  ?>
                        <?php else: ?>
                          Tanggal Awal Visa : 
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item">
                    <?php if($jamaah['tgl_akhir_visa']) : ?>
                        Tanggal Akhir Visa : <?=  date("d, F Y",strtotime($jamaah['tgl_akhir_visa']));  ?>
                        <?php else: ?>
                          Tanggal Akhir Visa : 
                        <?php endif; ?>
                    </li>
                    <li class="list-group-item">
                    Muassahah : <?=  $jamaah['muassasah'];  ?>
                    </li>
                  </ul>
                  <?php else: ?>
                    <ul class="list-group">
                      <li class="list-group-item">
                      Provider : -
                      </li>
                      <li class="list-group-item">
                      No Visa : -
                      </li>
                      <li class="list-group-item">
                            Tanggal Awal Visa : -
                      </li>
                      <li class="list-group-item">
                            Tanggal Akhir Visa : -
                      </li>
                      <li class="list-group-item">
                      Muassahah : -
                      </li>
                    </ul>
                    <?php endif; ?>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-12">
            <div class="card">
            <div class="card-header bg-success text-white">
                <h4>Informasi Vaksin</h4>
              </div>
              <div class="card-bodys">
                <?php if($jamaah) : ?>
                  <ul class="list-group">
                    <li class="list-group-item">
                    Status Vaksin : 
                    <?php 
                    if($jamaah['status_vaksin']) :
                    ?>
                    <span class="badge badge-pill badge-primary"><?=  $jamaah['status_vaksin'];  ?></span>
                    <?php else: ?>
                      <span class="badge badge-pill badge-primary">Belum</span>
                    <?php endif; ?>
                    </li>
                    <li class="list-group-item">
                    Jenis Vaksin : <?=  $jamaah['jenis_vaksin'];  ?>
                    </li>
                    <li class="list-group-item">
                    <?php if($jamaah['tgl_vaksin']) : ?>
                        Tanggal Vaksin : <?=  date("d, F Y",strtotime($jamaah['tgl_vaksin']));  ?>
                        <?php else: ?>
                          Tanggal Vaksin : 
                        <?php endif; ?>
                    </li>
                  </ul>
                  <?php else: ?>
                    <ul class="list-group">
                      <li class="list-group-item">
                      Status Vaksin : 
                        <span class="badge badge-pill badge-primary">Belum</span>
                      </li>
                      <li class="list-group-item">
                      Jenis Vaksin : -
                      </li>
                      <li class="list-group-item">
                            Tanggal Vaksin : - 
                      </li>
                    </ul>
                    <?php endif; ?>
              </div>
            </div>
          </div>
         
        </div>
      </div>
    </div>

  </section>
</div>
<?= $this->endSection(); ?>