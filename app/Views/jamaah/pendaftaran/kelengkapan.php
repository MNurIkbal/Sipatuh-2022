<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />


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
    content: "\f007";
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
    <div class="card">
      <div class="card-header">
        <div>
            <h4 style="text-transform: uppercase">Kelengkapan Jamaah</h4>
            <a href="<?= base_url("tambah_pendaftaran/$id_kloter/$id"); ?>" class="btn btn-warning mt-3">Kembali</a>
        </div>
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
        <div class="row">
          <div class="col-md-12 mx-0">
            <form id="msform" action="<?= base_url("kelengkapan_jamaah_insert/$id_jamaah/$id/$id_kloter"); ?>" method="POST" enctype="multipart/form-data">
              <!-- progressbar -->
              <ul id="progressbar">
                <li class="active" id="account">
                  <strong>Dokumen</strong>
                </li>
                <li id="personal"><strong>Informasi Asuransi</strong></li>
                <li id="payment"><strong>Informasi Visa</strong></li>
                <li id="confirm"><strong>Informasi Vaksin</strong></li>
              </ul>
              <fieldset>
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="">Dokumen KTP</label>
                      <input type="file" class="form-control" required placeholder="No Paspor" name="file_ktp">
                      <small class="text-danger">File PDF Size 3 MB</small>
                    </div>
                      <div class="mb-3">
                        <label for="">Dokumen Kartu Keluarga</label>
                        <input type="file" class="form-control" required placeholder="No Paspor" name="file_kk">
                        <small class="text-danger">File PDF Size 3 MB</small>
                      </div>
                  </div>
                  <div class="col-md-6">     
                    <div class="mb-3">
                      <label for="">Dokumen Paspor</label>
                      <input type="file" class="form-control" required placeholder="No Paspor" name="file_paspor">
                      <small class="text-danger">File PDF Size 3 MB</small>
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
                        <label for="">No Polis</label>
                        <input type="text" name="nomor" class="form-control " required placeholder="Nomor Polis">
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal Input</label>
                        <input type="date" name="tgl_input" class="form-control " required placeholder="Tanggal">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Tanggal Awal Polis: </label>
                        <input type="date" name="awal" class="form-control " required placeholder="Tanggal">
                      </div>
                      <div class="form-group">
                        <label for="">Tanggal Akhir Polis: </label>
                        <input type="date" name="akhir" class="form-control " required placeholder="Tanggal">
                      </div>
                      <div class="mb-3">
                      <label for="">Dokumen Asuransi</label>
                      <input type="file" class="form-control" required placeholder="No Paspor" name="file_asuransi">
                      <small class="text-danger">File PDF Size 3 MB</small>
                    </div>
                    </div>
                  </div>
                </div>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next Step" />
              </fieldset>
              <fieldset>
              <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                        <label for="">Nomor Visa: </label>
                    <input type="text" name="nomor_visa" class="form-control " required placeholder="Nomor Visa"
                        >
                        </div>
                        <div class="form-group">
                        <label for="">Tanggal Akhir Visa: </label>
                    <input type="date" name="tgl_akhir_visa" class="form-control " required placeholder="Tanggal"
                        >
                        </div>
                        <div class="mb-3">
                      <label for="">Dokumen Provider</label>
                      <input type="file" class="form-control" required placeholder="No Paspor" name="file_provider">
                      <small class="text-danger">File PDF Size 3 MB</small>
                    </div>
                      </div>
                      <div class="col-md-6">
                        
                        <div class="form-group">
                        <label for="">Tanggal Awal Visa: </label>
                    <input type="date" name="tgl_awal_visa" class="form-control " required placeholder="Tanggal"
                       >
                        </div>
                        <div class="form-group" >
                        <label for="">Muassasah: </label>
                        <div style="width: 100% !important;">
                            <select name="muassasah" required class="form-control select2" style="width: 100% !important;" id="">
                                <option value="">Pilih</option>
                                <?php foreach($muasah as $row_dua) : ?>
                                <option 
                                    value="<?=  $row_dua['nama_muassasah'];  ?>"><?=  $row_dua['nama_muassasah'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        </div>
                        <div class="mb-3">
                      <label for="">Dokumen Visa</label>
                      <input type="file" class="form-control" required placeholder="No Paspor" name="file_visa">
                      <small class="text-danger">File PDF Size 3 MB</small>
                    </div>
                      </div>
                    </div>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                <input type="button" name="next" class="next action-button" value="Next Step" />
              </fieldset>
              <fieldset>
                <div class="form-group">
                <label for="">Jenis Vaksin</label>
                    <input type="text" name="jenis" class="form-control" required placeholder="Jenis Vaksin" >
                </div>
                <div class="form-group">
                <label for="">Tanggal Vaksin</label>
                    <input type="date" name="tgl" value="" class="form-control" required placeholder="">
                </div>
                <div class="mb-3">
                      <label for="">Sertifikat Vaksin</label>
                      <input type="file" class="form-control" required placeholder="No Paspor" name="sertifikat_vaksin">
                      <small class="text-danger">File PDF Size 3 MB</small>
                    </div>
                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                <!-- <input type="submit" name="make_payment" class="next action-button" value="Confirm" /> -->
                <button type="submit" class="action-button">Simpan</button>
              </fieldset>
            </form>
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
</script>

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
$(".select2").select2()
</script>

<?= $this->endSection(); ?>