<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
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
        <h4 style="text-transform: uppercase">Profile</h4>
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
            <form id="msform" action="<?= base_url("profile_insert"); ?>" method="POST" enctype="multipart/form-data">
              <!-- progressbar -->
              <ul id="progressbar">
                <li class="active" id="account">
                  <strong>Informasi Diri</strong>
                </li>
                <li id="personal"><strong>Informasi Asuransi</strong></li>
                <li id="payment"><strong>Informasi Visa</strong></li>
                <li id="confirm"><strong>Informasi Vaksin</strong></li>
              </ul>
              <fieldset>
                <div class="row">
                  <div class="col-md-6">
                    <div class="mb-3">
                      <label for="">Title</label>
                      <br>
                      <select name="title" class="form-control select2" required id="" style="width: 100% !important;">
                        <option value="">Pilih</option>
                        <option value="Tuan">Tuan</option>
                        <option value="Nyonya">Nyoya</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6    ">
                  <div class="mb-3">
                      <label for="">Nama Paspor</label>
                      <input type="text" class="form-control" required placeholder="Nama Paspor" name="nama_paspor">
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
                      <br>
                      <select name="jenis_identitas" id="" class="form-control select2" style="width: 100% !important;" required>
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
                      <label for="">Kewarganegaraan</label>
                      <br>
                      <select name="warganegara" class="form-control select2" style="width: 100% !important;" required id="">
                        <option value="">Pilih</option>
                        <option value="wni">WNI</option>
                        <option value="wna">WNA</option>
                      </select>
                    </div>
                   
                    <div class="mb-3">
                      <label for="">Alamat </label>
                      <textarea name="alamat" id="" class="form-control" required cols="30" rows="10" placeholder="Alamat"></textarea>
                    </div>
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
                      <label for="">Jenis Pendidikan</label>
                      <br>
                      <select name="jenis_pendidikan" class="form-control select2" style="width: 100% !important;" required id="">
                        <option value="">Pilih</option>
                        <option value="tidak sekolah">Tidak Sekolah</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA/SMK">SMA/SMK</option>
                        <option value="PERGURUAN TINGGI">PERGURUAN TINGGI</option>
                        <option value="lainnya">lainnya</option>
                      </select>
                    </div>
                    <div class="mb-3 ">
                      <label for="">Provinsi</label>
                      <br>
                      <select name="provinsi" name="provinsi" required class="form-control provinsi select2" onchange="prov_satu()" id="provinsi" style="width: 100% !important;">
                        <option value="">Pilih</option>
                        <?php foreach ($provinsi as $main_provinsi) : ?>
                          <option value="<?= $main_provinsi['id'] . '-' . $main_provinsi['name']; ?>"><?= $main_provinsi['name']; ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="">Kabupaten</label>
                      <br>
                      <select name="kabupaten" class="form-control select2" required id="kabupaten" style="width: 100% !important;">
                        <option value="">Pilih</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="">Kecamatan</label>
                      <br>
                      <select name="kecamatan" class="form-control select2" required id="kecamatan" style="width: 100% !important;">
                        <option value="">Pilih</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="">Kelurahan</label>
                      <br>
                      <select name="kelurahan" class="form-control select2" required id="kelurahan" style="width: 100% !important;">
                        <option value="">Pilih</option>
                      </select>
                    </div>
                    <div class="mb-3">
                      <label for="">Status Pernikahan</label>
                      <br>
                      <select name="nikah" class="form-control select2" required id="" style="width: 100% !important;">
                        <option value="">Pilih</option>
                        <option value="sudah nikah">sudah nikah</option>
                        <option value="belum nikah">belum nikah</option>
                      </select>
                    </div>
                    
                    <div class="mb-3">
                      <label for="">Jenis Pekerjaan</label>
                      <br>
                      <select name="jenis_pekerjaan" class="form-control select2" required id="" style="width: 100% !important;">
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
                      <label for="">Dokumen Paspor</label>
                      <input type="file" class="form-control" required placeholder="No Paspor" name="file_paspor">
                      <small class="text-danger">File PDF Size 3 MB</small>
                    </div>
                                       
                    
                                       
                    <div class="mb-3">
                      <label for="">No Paspor</label>
                      <input type="text" class="form-control" required placeholder="No Paspor" name="no_paspor">
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
                        <label for="">Asuransi</label>
                        <br>
                        <select name="asuransi" class="form-control select2" required id="" style="width: 100% !important;">
                          <option value="">Pilih</option>
                          <?php foreach ($asuransi as $main_empat) : ?>
                            <option value="<?= $main_empat['nama'];  ?>"><?= $main_empat['nama'];  ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
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
                        <label for="">Provider : </label>
                        <br>
                        <select name="provider" class="form-control select2" required id="" style="width: 100% !important;">
                            <option value="">Pilih</option>
                            <?php foreach($provider as $main_tiga) : ?>
                                <option value="<?=  $main_tiga['nama_provider'];  ?>"><?=  $main_tiga['nama_provider'];  ?></option>
                                <?php endforeach; ?>
                        </select>
                        </div>
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
                        <div class="form-group">
                        <label for="">Muassasah: </label>
                        <br>
                    <select name="muassasah" required class="form-control select2" id="" style="width: 100% !important;">
                        <option value="">Pilih</option>
                        <?php foreach($muasah as $row_dua) : ?>
                        <option 
                            value="<?=  $row_dua['nama_muassasah'];  ?>"><?=  $row_dua['nama_muassasah'];  ?></option>
                        <?php endforeach; ?>
                    </select>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
  function prov_satu()
  {
    let val = $("#provinsi").val()
    $.ajax({
      url: "<?= base_url("ambil_provinsi") ?>/" + val,
      success: function(data) {
        $("#kabupaten").html(data)
      }
    });
  }
 

    $("#kabupaten").change(function() {
      let kab = $(this).val()
      $.ajax({
        url: "<?= base_url('ambil_kabupaten') ?>/" + kab,
        success: function(data_dua) {
          $("#kecamatan").html(data_dua)
        }
      })
    });

    $("#kecamatan").change(function() {
      let kec = $(this).val()
      $.ajax({
        url: "<?= base_url("ambil_kecamatan") ?>/" + kec,
        success: function(data_tiga) {
          $("#kelurahan").html(data_tiga)
        }
      })
    })
  

  $(".select2").select2()
</script>

<?= $this->endSection(); ?>