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
            <div class="card">
              <div class="card-header bg-success text-white">
                <h4>Informasi Diri</h4>
              </div>
              <div class="card-bodys">
                <?php if($jamaah) : ?>
                  <ul class="list-group">
                    <li class="list-group-item">Title : <?=  $jamaah['title'];  ?></li>
                    <li class="list-group-item">Nama : <?=  $jamaah['nama'];  ?></li>
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
                      <div style="width: 150px !important;height: 120px !important;">
                        <img src="<?=  base_url("assets/upload/" . $jamaah['foto']);  ?>" alt="" style="width: 100% !important;height: 100% !important;">
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
            <div class="card">
              <div class="card-header bg-success text-white">
                <h4>Informasi Lainnya</h4>
              </div>
              <div class="card-bodys  ">
                <?php if($jamaah) : ?>
                  <ul class="list-group">
                    <li class="list-group-item">No Hp : <?=  $jamaah['no_hp'];  ?></li>
                    <li class="list-group-item">No Telephone : <?=  $jamaah['no_telp'];  ?></li>
                    <li class="list-group-item">Kewarganegaraan : <?=  $jamaah['kewargannegaraan'];  ?></li>
                    <li class="list-group-item">Status Pernikahan : <?=  $jamaah['status_pernikahan'];  ?></li>
                    <li class="list-group-item">Jenis Pendidikan : <?=  $jamaah['jenis_pendidikan'];  ?></li>
                    <li class="list-group-item">Jenis Pekerjaan : <?=  $jamaah['jenis_pekerjaan'];  ?></li>
                    <li class="list-group-item">Provider : <?=  $jamaah['provider'];  ?></li>
                    <li class="list-group-item">Asuransi : <?=  $jamaah['asuransi'];  ?></li>
                    <li class="list-group-item">No Paspor : <?=  $jamaah['no_paspor'];  ?></li>
                    <li class="list-group-item">No Identitas : <?=  $jamaah['no_identitas'];  ?></li>
                    <li class="list-group-item">No Pasti Umrah : <?=  $jamaah['no_pasti_umrah'];  ?></li>
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
          <div class="col-md-6">
            <div class="cards">
              <div class="card-header bg-success text-white">
                <h4>Informasi Paket</h4>
              </div>
              <div class="card-bodys  ">
                <?php if($pakets) : ?>
                  <ul class="list-group">
                    <li class="list-group-item">Kode Paket : <?=  $pakets['kode_paket'];  ?></li>
                    <li class="list-group-item">Nama Paket : <?=  $pakets['nama'];  ?></li>
                    <?php if(isset($kloter['nama'])) : ?>
                      <li class="list-group-item">Kloter : <?=  $kloter['nama'];  ?></li>
                      <?php else: ?>
                        <li class="list-group-item">Kloter : </li>
                      <?php endif; ?>
                    <li class="list-group-item">Status Keberangkatan : <span class="badge badge-pill badge-primary">
                      <?php if(isset($kloter['keberangkatan'])) : ?>
                        <?=  $kloter['keberangkatan'];  ?>
                        <?php else: ?>
                          Belum
                        <?php endif; ?>
                    </span></li>
                    <li class="list-group-item">Biaya : Rp.<?=  number_format($pakets['biaya'],0);  ?></li>
                    <li class="list-group-item">Status : <span class="badge badge-pill badge-primary"><?=  $pakets['status'];  ?></span></li>
                    <li class="list-group-item">Periode : <?=  date("d, F Y",strtotime($pakets['tgl_berangkat']));  ?> - <?=  date("d,F Y",strtotime($pakets['tgl_pulang']));  ?></li>
                    <li class="list-group-item">Provider : <?=  $pakets['provider'];  ?></li>
                    <li class="list-group-item">Asuransi : <?=  $pakets['asuransi'];  ?></li>
                    <li class="list-group-item">Ket Berangkat : <?=  $pakets['ket_berangkat'];  ?></li>
                    <li class="list-group-item">Ket Pulang : <?=  $pakets['ket_pulang'];  ?></li>
                    <li class="list-group-item">Poster : 
                      <div style="width: 150px !important;height: 120px !important;">
                        <img src="<?=  base_url("assets/upload/" . $pakets['poster']);  ?>" alt="" style="width: 100% !important;height: 100% !important;">
                      </div>
                  </li>
                  </ul>
                  <?php else: ?>
                    <ul class="list-group">
                    <li class="list-group-item">Kode Paket : -</li>
                    <li class="list-group-item">Nama Paket :-</li>
                    <?php if(isset($kloter['nama'])) : ?>
                      <li class="list-group-item">Kloter : <?=  $kloter['nama'];  ?></li>
                      <?php else: ?>
                        <li class="list-group-item">Kloter : </li>
                      <?php endif; ?>
                    <li class="list-group-item">Status Keberangkatan : <span class="badge badge-pill badge-primary">
                     -
                    </span></li>
                    <li class="list-group-item">Biaya : -</li>
                    <li class="list-group-item">Status : <span class="badge badge-pill badge-primary">-</span></li>
                    <li class="list-group-item">Periode : -</li>
                    <li class="list-group-item">Provider : -</li>
                    <li class="list-group-item">Asuransi : -</li>
                    <li class="list-group-item">Ket Berangkat : -</li>
                    <li class="list-group-item">Ket Pulang : -</li>
                    <li class="list-group-item">Poster : 
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
                <h4>Informasi Perusahaan</h4>
              </div>
              <div class="card-bodys  ">
                <?php if($profile) : ?>
                  <ul class="list-group">
                    <li class="list-group-item">Nama Perusahaan : <?=  $profile['nama_perusahaan'];  ?></li>
                    <li class="list-group-item">No Hp : <?=  $profile['no_hp'];  ?></li>
                    <li class="list-group-item">No Telephone : <?=  $profile['no_telp'];  ?></li>
                    <li class="list-group-item">Email : <?=  $profile['email'];  ?></li>
                    <li class="list-group-item">Website : <?=  $profile['website'];  ?></li>
                    <li class="list-group-item">Provinsi : <?=  $profile['provinsi'];  ?></li>
                    <li class="list-group-item">Kabupaten : <?=  $profile['kabupaten'];  ?></li>
                    <li class="list-group-item">Kecamatan : <?=  $profile['kecamatan'];  ?></li>
                    <li class="list-group-item">Alamat : <?=  $profile['alamat'];  ?></li>
                    <li class="list-group-item">Foto Kantor : 
                      <div style="width: 150px !important;height: 120px !important;">
                        <img src="<?=  base_url("assets/upload/" . $profile['foto_kantor']);  ?>" alt="" style="width: 100% !important;height: 100% !important;">
                      </div>
                  </li>
                  </ul>
                  <?php else: ?>
                    <ul class="list-group">
                      <li class="list-group-item">Nama Perusahaan : -</li>
                      <li class="list-group-item">No Hp : -</li>
                      <li class="list-group-item">No Telephone : -</li>
                      <li class="list-group-item">Email : -</li>
                      <li class="list-group-item">Website : -</li>
                      <li class="list-group-item">Provinsi : -</li>
                      <li class="list-group-item">Kabupaten : -</li>
                      <li class="list-group-item">Kecamatan : -</li>
                      <li class="list-group-item">Alamat : -</li>
                      <li class="list-group-item">Foto Kantor : 
                        -
                    </li>
                    </ul>
                    <?php endif; ?>
                <br>
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
          <div class="col-md-6 col-12">
            <div class="card">
            <div class="card-header bg-success text-white">
                <h4>Informasi Pembayaran</h4>
              </div>
              <div class="card-bodys">
                <?php if($jamaah) : ?>
                  <ul class="list-group">
                    <li class="list-group-item">
                    Status Bayar : 
                    <?php 
                    if($jamaah['status_bayar']) :
                    ?>
                    <span class="badge badge-pill badge-primary"><?=  $jamaah['status_bayar'];  ?></span>
                    <?php else: ?>
                      <span class="badge badge-pill badge-primary">Belum</span>
                    <?php endif; ?>
                    </li>
                    <li class="list-group-item">
                    Status Approve Bayar : 
                    <?php 
                    if($jamaah['status_approve_bayar']) :
                    ?>
                    <span class="badge badge-pill badge-primary"><?=  $jamaah['status_approve_bayar'];  ?></span>
                    <?php else: ?>
                      <span class="badge badge-pill badge-primary">Belum</span>
                    <?php endif; ?>
                    </li>
                    <li class="list-group-item">
                    Total Pembayaran : Rp. <?=  number_format($pakets['biaya'],0);  ?>
                    </li>
                    <li class="list-group-item">
                    Sisa Pembayaran :
                    <?php if($jamaah['sisa_pembayaran'] == NULL)  : ?>
                      <span class="badge badge-pill badge-primary">Belum Bayar</span>
                      <?php else: ?>
                        Rp  <?=  number_format($jamaah['sisa_pembayaran'],0);  ?>
                      <?php endif; ?>
                    </li>
                  </ul>
                  <?php else: ?>
                    <ul class="list-group">
                      <li class="list-group-item">
                      Status Bayar : 
                        <span class="badge badge-pill badge-primary">Belum</span>
                      </li>
                      <li class="list-group-item">
                      Status Approve Bayar : 
                        <span class="badge badge-pill badge-primary">Belum</span>
                      </li>
                      <li class="list-group-item">
                      Total Pembayaran : -
                      </li>
                      <li class="list-group-item">
                      Sisa Pembayaran :
                      <span class="badge badge-pill badge-primary">Belum Bayar</span>
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