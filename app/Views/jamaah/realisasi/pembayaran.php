<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<!-- <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" /> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

<style>
  .text-secondary-d1 {
    color: #728299 !important;
  }

  .page-header {
    margin: 0 0 1rem;
    padding-bottom: 1rem;
    padding-top: .5rem;
    border-bottom: 1px dotted #e2e2e2;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-pack: justify;
    justify-content: space-between;
    -ms-flex-align: center;
    align-items: center;
  }

  .page-title {
    padding: 0;
    margin: 0;
    font-size: 1.75rem;
    font-weight: 300;
  }

  .brc-default-l1 {
    border-color: #dce9f0 !important;
  }

  .ml-n1,
  .mx-n1 {
    margin-left: -.25rem !important;
  }

  .mr-n1,
  .mx-n1 {
    margin-right: -.25rem !important;
  }

  .mb-4,
  .my-4 {
    margin-bottom: 1.5rem !important;
  }

  hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, .1);
  }

  .text-grey-m2 {
    color: #888a8d !important;
  }

  .text-success-m2 {
    color: #86bd68 !important;
  }

  .font-bolder,
  .text-600 {
    font-weight: 600 !important;
  }

  .text-110 {
    font-size: 110% !important;
  }

  .text-blue {
    color: #478fcc !important;
  }

  .pb-25,
  .py-25 {
    padding-bottom: .75rem !important;
  }

  .pt-25,
  .py-25 {
    padding-top: .75rem !important;
  }

  .bgc-default-tp1 {
    background-color: rgba(121, 169, 197, .92) !important;
  }

  .bgc-default-l4,
  .bgc-h-default-l4:hover {
    background-color: #f3f8fa !important;
  }

  .page-header .page-tools {
    -ms-flex-item-align: end;
    align-self: flex-end;
  }

  .btn-light {
    color: #757984;
    background-color: #f5f6f9;
    border-color: #dddfe4;
  }

  .w-2 {
    width: 1rem;
  }

  .text-120 {
    font-size: 120% !important;
  }

  .text-primary-m1 {
    color: #4087d4 !important;
  }

  .text-danger-m1 {
    color: #dd4949 !important;
  }

  .text-blue-m2 {
    color: #68a3d5 !important;
  }

  .text-150 {
    font-size: 150% !important;
  }

  .text-60 {
    font-size: 60% !important;
  }

  .text-grey-m1 {
    color: #7b7d81 !important;
  }

  .align-bottom {
    vertical-align: bottom !important;
  }

  /*form styles*/
  #msform ul li {
    text-align: center;
    position: relative;
    margin-top: 20px;
  }

  label {
    text-align: left !important;
  }

  #msform fieldset {
    background: white;
    border: 0 none;
    border-radius: 0.5rem;
    box-sizing: border-box;
    width: 100%;
    margin: 0;
    padding-bottom: 20px;

    /*stacking fieldsets above each other*/
    position: relative;
  }

  /*Hide all except first fieldset*/
  #msform fieldset:not(:first-of-type) {
    display: none;
  }

  #msform fieldset .form-card {
    text-align: left;
    color: #9E9E9E;
  }





  /*Blue Buttons*/
  #msform .action-button {
    width: 100px;
    background: skyblue;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
  }

  #msform .action-button:hover,
  #msform .action-button:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue;
  }

  /*Previous Buttons*/
  #msform .action-button-previous {
    width: 100px;
    background: #616161;
    font-weight: bold;
    color: white;
    border: 0 none;
    border-radius: 0px;
    cursor: pointer;
    padding: 10px 5px;
    margin: 10px 5px;
  }

  #msform .action-button-previous:hover,
  #msform .action-button-previous:focus {
    box-shadow: 0 0 0 2px white, 0 0 0 3px #616161;
  }

  /*Dropdown List Exp Date*/
  select.list-dt {
    border: none;
    outline: 0;
    border-bottom: 1px solid #ccc;
    padding: 2px 5px 3px 5px;
    margin: 2px;
  }

  select.list-dt:focus {
    border-bottom: 2px solid skyblue;
  }

  /*The background card*/
  .card {
    z-index: 0;
    border: none;
    border-radius: 0.5rem;
    position: relative;
  }

  /*FieldSet headings*/
  .fs-title {
    font-size: 25px;
    color: #2C3E50;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left;
  }

  /*progressbar*/
  #progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: lightgrey;
  }

  #progressbar .active {
    color: #000000;
  }

  #progressbar li {
    list-style-type: none;
    font-size: 12px;
    width: 25%;
    float: left;
    position: relative;
  }

  /*Icons in the ProgressBar*/
  #progressbar #account:before {
    font-family: FontAwesome;
    content: "\f02d";
  }

  #progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f328";
  }

  #progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f53c";
  }

  #progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f560";
  }

  /*ProgressBar before any progress*/
  #progressbar li:before {
    width: 50px;
    height: 50px;
    line-height: 45px;
    display: block;
    font-size: 18px;
    color: #ffffff;
    background: lightgray;
    border-radius: 50%;
    margin: 0 auto 10px auto;
    padding: 2px;
  }

  /*ProgressBar connectors*/
  #progressbar li:after {
    content: '';
    width: 100%;
    height: 2px;
    background: lightgray;
    position: absolute;
    left: 0;
    top: 25px;
    z-index: -1;
  }

  /*Color number of the step and the connector before it*/
  #progressbar li.active:before,
  #progressbar li.active:after {
    background: skyblue;
  }

  /*Imaged Radio Buttons*/
  .radio-group {
    position: relative;
    margin-bottom: 25px;
  }

  .radio {
    display: inline-block;
    width: 204;
    height: 104;
    border-radius: 0;
    background: lightblue;
    box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
    box-sizing: border-box;
    cursor: pointer;
    margin: 8px 2px;
  }

  .radio:hover {
    box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3);
  }

  .radio.selected {
    box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1);
  }

  /*Fit image in bootstrap div*/
  .fit-image {
    width: 100%;
    object-fit: cover;
  }
</style>

<div class="main-content">
  <section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <a href="<?= base_url("detail_selesai_jamaah/"  . $id_kloter . '/' . $id_paket . '/' . $judul); ?>" class="btn btn-warning">Kembali</a>
            <div class="row">
          <div class="col-md-6">
            <div>
              <br>
              <p style="margin-bottom: 10px;">
                Nama : <?= $jamaah['title'] . ' ' .  $jamaah['nama']; ?>
              </p>
              <p style="margin-bottom: 10px;">
                Paket : <?= $paket['nama']; ?>
              </p>
              <p style="margin-bottom: 10px;">
                Kloter : <?= $kloter['nama']; ?>
              </p>
              <p style="margin-bottom: 10px;">
                Perioder : <?= date("d, F Y", strtotime($paket['tgl_berangkat'])) . ' - ' . date("d, F Y", strtotime($paket['tgl_pulang']))  ?>
              </p>
              <p>
                Tahun : <?= $paket['tahun'] ?>
              </p>
            </div>
          </div>
          <div class="col-md-6">
            <div>
              <br>
              <p style="margin-bottom: 10px;">
                Rekening Penampung : <?= $rekening_penampung['no_rekening'] . '/' .  $rekening_penampung['nama']; ?>
              </p>
              <p style="margin-bottom: 10px;">
                Alamat : <?= $jamaah['kelurahan'] . ',' . $jamaah['kecamatan'] . ',' . $jamaah['kabupaten'] . ',' . $jamaah['provinsi']; ?>
              </p>
              <p style="margin-bottom: 10px;">
                No Hp : <?= $jamaah['no_hp']; ?>
              </p>
              <p style="margin-bottom: 10px;">
                No Pasti Umrah : <?= $jamaah['no_pasti_umrah']; ?>
              </p>
              <p>
                TTL : <?= $jamaah['tempat_lahir'] . ',' . date("d, F Y", strtotime($jamaah['tgl_lahir'])) ?>
              </p>
            </div>
          </div>
        </div>
          </div>
        </div>
        <div class="card">
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
            <div class="row">
              <div class="col-md-12 mx-0">
                <form id="msform" action="<?= base_url("insert_checkout"); ?>" method="POST" enctype="multipart/form-data">
                  <!-- progressbar -->
                  <input type="hidden" name="id_paket" value="<?= $id_paket; ?>">
                  <input type="hidden" name="id_kloter" value="<?= $id_kloter; ?>">
                  <input type="hidden" name="id_jamaah" value="<?= $id_jamaah; ?>">
                  <ul id="progressbar">
                    <li class="active" id="account">
                      <strong>Informasi Paket</strong>
                    </li>
                    <li id="personal"><strong>Metode Pembayaran</strong></li>
                    <li id="payment"><strong>Riwayat Pembayaran</strong></li>
                    <li id="confirm"><strong>Invoice</strong></li>
                  </ul>
                  <fieldset>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="">Nama Paket</label>
                          <br>
                          <input type="text" class="form-control " required readonly value="<?= $paket['nama']; ?>">
                        </div>
                      </div>
                      <div class="col-md-6    ">
                        <div class="mb-3">
                          <label for="">Periode</label>
                          <input type="text" class="form-control" required placeholder="" name="periode" value="<?= date('d, F Y', strtotime($paket['tgl_berangkat'])) . ' - ' . date("d, F Y", strtotime($paket['tgl_pulang'])); ?>" readonly>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="">Biaya</label>
                          <input type="text" class="form-control" required placeholder="biaya" name="biaya" value="Rp. <?= number_format($paket['biaya']); ?>" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="">Provider</label>
                          <br>
                          <input type="text" class="form-control" required value="<?= $paket['provider']; ?>" readonly>
                        </div>
                        <div class="mb-3">
                          <label for="">Keterangan Berangkat</label>
                          <textarea name="berangkat" class="form-control" required readonly id="" cols="30" rows="10"><?= $paket['ket_berangkat']; ?></textarea>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                          <label for="">Asuransi</label>
                          <br>
                          <input type="text" class="form-control" value="<?= $paket['asuransi']; ?>" required readonly>
                        </div>

                        <div class="mb-3">
                          <label for="">Tahun</label>
                          <br>
                          <input type="text" value="<?= $paket['tahun']; ?>" required readonly class="form-control">
                        </div>
                        <div class="mb-3">
                          <label for="">Keterangan Pulang</label>
                          <br>
                          <textarea name="pulang" class="form-control" required readonly id="" cols="30" rows="10"><?= $paket['ket_pulang']; ?></textarea>
                        </div>
                      </div>
                    </div>
                    <br>
                    <input type="button" name="next" class="next action-button " value="Next Step" />
                  </fieldset>
                  <fieldset>
                    <div class="card-bodys">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Biaya</label>
                            <input type="text" name="biaya" class="form-control " required placeholder="" readonly value="Rp. <?= number_format($paket['biaya']); ?>">
                          </div>
                          <div class="form-group">
                            <label for="">Rekening Penampung</label>
                            <input type="text" name="rekening" value="<?= $bank['bank'] . ' / ' . $bank['no_rekening'] . ' / ' .  $bank['nama']; ?>" class="form-control" required readonly>
                            <input type="hidden" name="rek" value="<?= $bank['no_rekening']; ?>" required>
                          </div>
                          <?php if (empty($main['status_bayar'])) : ?>
                            <div class="form-group">
                              <label for="">Metode Pembayaran</label>
                              <select name="metode" class="form-control" required id="metode" onchange="pilihan()">
                                <option value="">Pilih</option>
                                <option value="DP">DP</option>
                                <option value="cicil">Cicil</option>
                                <option value="lunas">Lunas</option>
                              </select>
                            </div>
                          <?php else : ?>
                            <div class="form-group">
                              <label for="">Metode Pembayaran</label>
                              <input type="text" class="form-control" required name="metode" readonly placeholder="Metode" value="<?= $main['status_bayar']; ?>">
                            </div>
                          <?php endif; ?>
                        </div>
                        <div class="col-md-6">

                          <div id="check">
                            <div class="form-group">
                              <label for="">Sisa </label>
                              <?php if (empty($main['sisa_pembayaran'])) : ?>
                                <input type="text" name="awal" class="form-control " placeholder="0" readonly>
                              <?php else : ?>
                                <input type="text" name="awal" class="form-control " placeholder="sisa" readonly value="Rp. <?= number_format($main['sisa_pembayaran']); ?>">
                              <?php endif; ?>
                            </div>
                            <?php if ($main['status_bayar'] == null) : ?>
                              <div id="container_bayar">
                                <div class="form-group">
                                  <label for="">Bayar</label>
                                  <input type="text" name="bayar" class="form-control" id="nominal" placeholder="Bayar">
                                </div>
                                <div class="form-group">
                                  <label for="">Bukti Pembayaran </label>
                                  <input type="file" name="file" class="form-control " placeholder="bukti">
                                  <small class="text-danger">Upload File PNG,JPEG,JPG 3 MB</small>
                                </div>
                                <div class="form-group">
                                  <label for="">Catatan </label>
                                  <textarea name="catatan" id="" class="form-control" placeholder="Catatan" cols="30" rows="10"></textarea>
                                </div>
                              </div>
                            <?php elseif ($main['status_bayar'] == "cicil" || $main['status_bayar'] == "DP") : ?>
                              <div id="container_bayar">
                                <div class="form-group">
                                  <label for="">Bayar</label>
                                  <input type="text" name="bayar" class="form-control" id="nominal" placeholder="Bayar">
                                </div>
                                <div class="form-group">
                                  <label for="">Bukti Pembayaran </label>
                                  <input type="file" name="file" class="form-control " placeholder="bukti">
                                  <small class="text-danger">Upload File PNG,JPEG,JPG 3 MB</small>
                                </div>
                                <div class="form-group">
                                  <label for="">Catatan </label>
                                  <textarea name="catatan" id="" class="form-control" placeholder="Catatan" cols="30" rows="10"></textarea>
                                </div>
                              </div>
                            <?php endif; ?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    <?php if (!empty($main['bukti_pembayaran'])) : ?>
                      <input type="button" name="next" class="next action-button" value="Next Step" />
                    <?php endif; ?>
                    <?php if ($main['status_bayar'] == null) : ?>
                      <button type="submit" class="action-button">Simpan</button>
                    <?php elseif ($main['status_bayar'] == "cicil" || $main['status_bayar'] == "DP") : ?>
                      <button type="submit" class="action-button">Simpan</button>
                    <?php endif; ?>
                  </fieldset>
                  <fieldset>
                    <div class="row">
                      <?php if (!empty($main['bukti_pembayaran'])) : ?>
                        <div class="col-md-4">
                          <div class="card">
                            <div class="card-header bg-primary text-white">
                              <h5 class="card-title">Pembayaran 1</h5>
                            </div>
                            <div class="card-body">
                              <ul class="list-group">
                                <li class="list-group-item" style="text-align: left !important;">
                                  Rekening Penampung : <?= $bank['no_rekening']; ?>
                                </li>
                                <?php if (!empty($main['nominal_pembayaran'])) : ?>
                                  <li class="list-group-item" style="text-align: left !important;">
                                    Nominal : Rp. <?= number_format($main['nominal_pembayaran']); ?>
                                  </li>
                                <?php else : ?>
                                  <li class="list-group-item" style="text-align: left !important;">
                                    Nominal : Rp. 0
                                  </li>
                                <?php endif; ?>
                                <li class="list-group-item" style="text-align: left !important;">
                                  Bukti Pembayaran : <a download="" href="<?= base_url("assets/upload/$main[bukti_pembayaran]"); ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
                                </li>
                                <li class="list-group-item" style="text-align: left !important;">
                                  Catatan : <?= $main['keterangan_bayar']; ?>
                                </li>
                                <li class="list-group-item" style="text-align: left !important;">
                                  Dibuat :
                                  <?php if (!empty($main['tgl_bayar'])) : ?>
                                    <?= date("d, F Y", strtotime($main['tgl_bayar'])); ?>
                                  <?php endif; ?>
                                </li>
                                <li class="list-group-item" style="text-align: left !important;">
                                  Download Invoice : <a target="_blank" href="<?= base_url('cetak_invoice/' . $main['id'] . '/' . $id_paket . '/' . $id_kloter); ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      <?php endif; ?>
                      <?php $no = 2;
                      foreach ($bukti as $rows) : ?>
                        <div class="col-md-4">
                          <div class="card">
                            <div class="card-header bg-primary text-white">
                              <h5 class="card-title">Pembayaran <?= $no++; ?></h5>
                            </div>
                            <div class="card-body">
                              <ul class="list-group">
                                <li class="list-group-item" style="text-align: left !important;">
                                  Rekening Penampung : <?= $rows['rekening_penampung']; ?>
                                </li>
                                <?php if (!empty($rows['nominal'])) : ?>
                                  <li class="list-group-item" style="text-align: left !important;">
                                    Nominal : Rp. <?= number_format($rows['nominal']); ?>
                                  </li>
                                <?php else : ?>
                                  <li class="list-group-item" style="text-align: left !important;">
                                    Nominal : Rp. 0
                                  </li>
                                <?php endif; ?>
                                <li class="list-group-item" style="text-align: left !important;">
                                  Bukti Pembayaran : <a href="<?= base_url("assets/upload/$rows[bukti]"); ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
                                </li>
                                <li class="list-group-item" style="text-align: left !important;">
                                  Catatan : <?= $rows['keterangan']; ?>
                                </li>
                                <li class="list-group-item" style="text-align: left !important;">
                                  Dibuat : <?= date("d, F Y", strtotime($rows['created'])); ?>
                                </li>
                                <li class="list-group-item" style="text-align: left !important;">
                                  Download Invoice : <a target="_blank" href="<?= base_url('cetak_invoice/' . $main['id'] . '/' . $id_paket . '/' . $id_kloter); ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    </div>
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    <?php if ($main['status_bayar'] == "lunas") : ?>
                      <input type="button" name="next" class="next action-button" value="Next Step" />
                    <?php endif; ?>
                  </fieldset>
                  <fieldset>
                    <div class="card">
                      <div class="card-body">

                        <?php if ($main) : ?>
                          <div class="page-content container">
                            <div class="page-header text-blue-d2">
                              <h1 class="page-title text-secondary-d1">
                                Invoice
                                <small class="page-info">
                                  <i class="fa fa-angle-double-right text-80"></i>
                                  ID: #<?= rand(1, 9999) . $main['id']; ?>
                                </small>
                              </h1>

                              <div class="page-tools">
                                <div class="action-buttons">

                                  <a target="_blank" class="btn bg-white btn-light mx-1px text-95" href="<?= base_url("export_invoice/$id_jamaah/$id_paket/$id_kloter"); ?>" data-title="PDF">
                                    <i class="mr-1 fa fa-file-pdf-o text-danger-m1 text-120 w-2"></i>
                                    Export
                                  </a>
                                </div>
                              </div>
                            </div>

                            <div class="container px-0">
                              <div class="row mt-4">
                                <div class="col-12 col-lg-12">

                                  <div class="row">
                                    <div class="col-sm-6">
                                      <div>
                                        <span class="text-sm text-grey-m2 align-middle">Nama:</span>
                                        <span class="text-600 text-110 text-blue align-middle"><?= $main['nama']; ?></span>
                                      </div>
                                      <div>
                                        <span class="text-sm text-grey-m2 align-middle">Paket :</span>
                                        <span class="text-600 text-110 text-blue align-middle"><?= $paket['nama']; ?></span>
                                      </div>
                                      <div>
                                        <span class="text-sm text-grey-m2 align-middle">Kloter :</span>
                                        <span class="text-600 text-110 text-blue align-middle"><?= $kloter['nama']; ?></span>
                                      </div>
                                      <div class="text-grey-m2">
                                        <div class="my-1">
                                          <?= $main['alamat']; ?>
                                        </div>
                                        <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600"><?= $main['no_hp']; ?></b></div>
                                      </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
                                      <hr class="d-sm-none" />
                                      <div class="text-grey-m2">
                                        <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                                          Invoice
                                        </div>
                                        <div>
                                          <span class="text-sm text-grey-m2 align-middle">No Registrasi :</span>
                                          <span class="text-600 text-110 text-blue align-middle"><?= $main['no_registrasi']; ?></span>
                                        </div>
                                        <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span>
                                          <?php if (!empty($main['tgl_lunas'])) : ?>
                                            <?= date("d, F Y", strtotime($main['tgl_lunas'])); ?>
                                          <?php endif; ?>
                                        </div>
                                        <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class="badge badge-success badge-pill px-25">Lunas</span></div>
                                      </div>
                                    </div>
                                    <!-- /.col -->
                                  </div>
                                  <div class="mt-4">

                                    <div class="row text-600 text-white bgc-default-tp1 py-25">
                                      <div class="d-none d-sm-block col-1">#</div>
                                      <div class="col-9 col-sm-5">Keterangan</div>
                                      <div class="d-none d-sm-block col-sm-2">Dibuat</div>
                                      <div class="d-none d-sm-block col-4 col-sm-2">Nominal</div>
                                    </div>


                                    <div class="text-95 text-secondary-d3">

                                      <div class="row mb-2 mb-sm-0 py-25">
                                        <div class="d-none d-sm-block col-1">1</div>
                                        <div class="col-9 col-sm-5"><?= $main['keterangan_bayar']; ?></div>
                                        <div class="d-none d-sm-block col-2">
                                          <?php if (!empty($main['tgl_bayar'])) : ?>
                                            <?= date("d, F Y", strtotime($main['tgl_bayar'])); ?>
                                          <?php endif; ?>
                                        </div>
                                        <div class="d-none d-sm-block col-2 text-95">Rp.
                                          <?php if (!empty($main['nominal_pembayaran'])) : ?>
                                            <?= number_format($main['nominal_pembayaran']); ?>
                                          <?php endif; ?>
                                        </div>
                                      </div>
                                      <?php $no = 2;
                                      foreach ($bukti as $row) : ?>
                                        <div class="row mb-2 mb-sm-0 py-25">
                                          <div class="d-none d-sm-block col-1"><?= $no++; ?></div>
                                          <div class="col-9 col-sm-5"><?= $row['keterangan']; ?></div>
                                          <div class="d-none d-sm-block col-2"><?= date("d, F Y", strtotime($row['created'])); ?></div>
                                          <div class="d-none d-sm-block col-2 text-95">Rp. <?= number_format($row['nominal']); ?></div>
                                        </div>
                                      <?php endforeach; ?>

                                    </div>


                                    <div class="row border-b-2 brc-default-l2"></div>


                                    <div class="row mt-3">
                                      <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                                        Pembayaran Anda Sudah Lunas
                                      </div>

                                      <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">




                                        <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                                          <div class="col-7 text-right">
                                            Total :
                                          </div>
                                          <div class="col-5">
                                            <span class="text-150 text-success-d3 opacity-2">Rp. <?= number_format($paket['biaya']); ?></span>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <hr />

                                    <div>
                                      <span class="text-secondary-d1 text-105">Terima Kasih </span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        <?php else : ?>
                          <div class="page-content container"></div>
                        <?php endif; ?>
                      </div>
                    </div>
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />


                  </fieldset>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<script>
  $(document).ready(function() {

    var current_fs, next_fs, previous_fs; //fieldsets
    var opacity;

    $(".next").click(function() {

      current_fs = $(this).parent();
      next_fs = $(this).parent().next();

      //Add Class Active
      $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

      //show the next fieldset
      next_fs.show();
      //hide the current fieldset with style
      current_fs.animate({
        opacity: 0
      }, {
        step: function(now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            'display': 'none',
            'position': 'relative'
          });
          next_fs.css({
            'opacity': opacity
          });
        },
        duration: 600
      });
    });

    $(".previous").click(function() {

      current_fs = $(this).parent();
      previous_fs = $(this).parent().prev();

      //Remove class active
      $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

      //show the previous fieldset
      previous_fs.show();

      //hide the current fieldset with style
      current_fs.animate({
        opacity: 0
      }, {
        step: function(now) {
          // for making fielset appear animation
          opacity = 1 - now;

          current_fs.css({
            'display': 'none',
            'position': 'relative'
          });
          previous_fs.css({
            'opacity': opacity
          });
        },
        duration: 600
      });
    });

    $('.radio-group .radio').click(function() {
      $(this).parent().find('.radio').removeClass('selected');
      $(this).addClass('selected');
    });

    $(".submit").click(function() {
      return false;
    })

  });


  var uang_baru = document.getElementById("nominal");
  uang_baru.addEventListener("keyup", function(e) {
    // tambahkan 'Rp.' pada saat form di ketik
    // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
    uang_baru.value = formatRupiah(this.value, "Rp. ");
  });
  /* Fungsi formatRupiah */
  function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, "").toString(),
      split = number_string.split(","),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
      separator = sisa ? "." : "";
      rupiah += separator + ribuan.join(".");
    }

    rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
    return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
  }

  <?php if (empty($main['status_bayar'])) : ?>
    $("#container_bayar").hide();
  <?php else : ?>
    $("#container_bayar").show();
  <?php endif; ?>

  function pilihan() {
    let vals = $("#metode").val()
    switch (vals) {
      case "DP":
        $("#container_bayar").hide();
        break;

      case "cicil":
        $("#container_bayar").show();

        break;

      case "lunas":
        $("#container_bayar").show();

        break;

      default:
        $("#container_bayar").hide();

        break;
    }
  }
</script>
<?= $this->endSection(); ?>