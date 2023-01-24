<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />


<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<style>
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
    content: "\274B";
  }

  #progressbar #personal:before {
    font-family: FontAwesome;
    content: "\f0e0";
  }

  #progressbar #payment:before {
    font-family: FontAwesome;
    content: "\f09d";
  }

  #progressbar #confirm:before {
    font-family: FontAwesome;
    content: "\f00c";
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
          <div class="card-header">
            <div>
              <a href="<?= base_url("detail_jamaah_aktif/" . $id_paket . '/' . $id_kloter); ?>" class="btn btn-warning">Kembali</a>
              <br>
              <br>
              <h6>
                Pembayaran Paket
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
                            <input type="text" name="rekening" value="<?= $bank['bank'] . ' / '. $bank['no_rekening'] . ' / '.  $bank['nama']; ?>" class="form-control" required readonly>
                            <input type="hidden" name="rek" value="<?= $bank['no_rekening']; ?>" required>
                          </div>
                          <div class="form-group">
                            <label for="">Metode Pembayaran</label>
                            <select name="metode" class="form-control" required id="metode" onchange="pilihan()">
                              <option value="">Pilih</option>
                              <option value="DP">DP</option>
                              <option value="cicil">Cicil</option>
                              <option value="lunas">Lunas</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Sisa  </label>
                            <?php if(empty($main['sisa_pembayaran'])) : ?>
                              <input type="text" name="awal" class="form-control "  placeholder="0" readonly >
                              <?php else: ?>
                                <input type="text" name="awal" class="form-control "  placeholder="sisa" readonly value="<?= number_format($main['sisa_pembayaran']); ?>">
                                <?php endif; ?>
                          </div>
                          <div id="container_bayar">
                          <div class="form-group">
                            <label for="">Bayar</label>
                            <input type="text" name="bayar"  class="form-control" id="nominal"  placeholder="Bayar" >
                          </div>
                          <div class="form-group">
                            <label for="">Bukti Pembayaran </label>
                            <input type="file" name="file" class="form-control "  placeholder="bukti">
                            <small class="text-danger">Upload File PNG,JPEG,JPG 3 MB</small>
                          </div>
                          <div class="form-group">
                            <label for="">Catatan  </label>
                            <textarea name="catatan" id="" class="form-control"  placeholder="Catatan" cols="30" rows="10"></textarea>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    <!-- <input type="button" name="next" class="next action-button" value="Next Step" /> -->
                    <button type="submit" class="action-button">Simpan</button>
                  </fieldset>
                  <fieldset>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="card">
                          <div class="card-header bg-primary text-white">
                            <h5 class="card-title">Pembayaran 1</h5>
                          </div>
                          <div class="card-body">
                            <ul class="list-group">
                              <li class="list-group-item" style="text-align: left !important;">
                                pembayaran
                              </li>
                              <li class="list-group-item" style="text-align: left !important;">
                                pembayaran
                              </li>
                              <li class="list-group-item" style="text-align: left !important;">
                                pembayaran
                              </li>
                              <li class="list-group-item" style="text-align: left !important;">
                                pembayaran
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card">
                          <div class="card-header bg-primary text-white">
                            <h5 class="card-title">Pembayaran 1</h5>
                          </div>
                          <div class="card-body">
                            <ul class="list-group">
                              <li class="list-group-item" style="text-align: left !important;">
                                pembayaran
                              </li>
                              <li class="list-group-item" style="text-align: left !important;">
                                pembayaran
                              </li>
                              <li class="list-group-item" style="text-align: left !important;">
                                pembayaran
                              </li>
                              <li class="list-group-item" style="text-align: left !important;">
                                pembayaran
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="card">
                          <div class="card-header bg-primary text-white">
                            <h5 class="card-title">Pembayaran 1</h5>
                          </div>
                          <div class="card-body">
                            <ul class="list-group">
                              <li class="list-group-item" style="text-align: left !important;">
                                pembayaran
                              </li>
                              <li class="list-group-item" style="text-align: left !important;">
                                pembayaran
                              </li>
                              <li class="list-group-item" style="text-align: left !important;">
                                pembayaran
                              </li>
                              <li class="list-group-item" style="text-align: left !important;">
                                pembayaran
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                    </div>
                    <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                    <input type="button" name="next" class="next action-button" value="Next Step" />
                  </fieldset>
                  <fieldset>
                    <div class="card">
                      <div class="card-header bg-primary text-white">
                        <h4>Finish</h4>
                      </div>
                      <div class="card-body">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo voluptate vero possimus alias eius ad blanditiis, labore, ex illo autem, laboriosam molestiae. Mollitia illo fugit sint impedit quidem, optio labore?
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

    $("#container_bayar").hide();
    
    function pilihan() 
    {
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