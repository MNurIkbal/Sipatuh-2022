<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Jamaah</h4>
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
                    <form method="POST" enctype="multipart/form-data" action="<?=  base_url("edit_jamaah/" . $main['id']);  ?>">
            <input type="hidden" name="id_paket" value="<?=  $ids;  ?>">
            <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
            <div class="modal-bodys">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Title</label>
                            <!-- <input type="text" class="form-control" required placeholder="Title" name="title" value="<?=  $main['title'];  ?>"> -->
                            <select name="title" class="form-control select2" required id="">
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
                            <label for="">Nama Ayah</label>
                            <input type="text" class="form-control" required placeholder="Nama Ayah" name="ayah"
                                value="<?=  $main['ayah'];  ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Jenis Identitas</label>
                            <select name="jenis_identitas" id="" class="form-control select2" required>
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
                            <label for="">Kewarganegaraan</label>
                            <select name="warganegara" class="form-control select2" required id="">
                                <option value="">Pilih</option>
                                <option value="wni" <?=  ($main['kewargannegaraan'] == "wni") ? "selected" : "";  ?>>WNI
                                </option>
                                <option value="wna" <?=  ($main['kewargannegaraan'] == "wna") ? "selected" : "";  ?>>WNA
                                </option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Pendidikan</label>
                            <select name="jenis_pendidikan" class="form-control select2" required id="">
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
                    </div>
                    <div class="col-md-6">
                    <div class="mb-3">
                            <label for="">Nama Paspor</label>
                            <input type="text" class="form-control" required placeholder="Nama Paspor"
                                name="nama_paspor" value="<?=  $main['nama_paspor'];  ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="">Alamat </label>
                            <textarea name="alamat" id="" class="form-control" required cols="30" rows="10"
                                placeholder="Alamat"><?=  $main['alamat'];  ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Status Pernikahan</label>
                            <select name="nikah" class="form-control select2" required id="">
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
                            <label for="">Jenis Pekerjaan</label>
                            <select name="jenis_pekerjaan" class="form-control select2" required id="">
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
                            <select name="provider" class="form-control select2" required id="">
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
                            <select name="asuransi" class="form-control select2" required id="">
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
            <div class="modal-footers sbg-whitesmoke br">
                <a href="<?= base_url("tambah_pendaftaran/" . $id_kloter . '/' . $ids); ?>" class="btn btn-secondary" >Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>

<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script> -->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    function provinsi_satu()
    {
     
         let val = $("#provinsi").val()
         console.log(val)
         $.ajax({
           url : "<?= base_url("ambil_provinsi") ?>/" + val,
           success : function(data) {
             $("#kabupaten").html(data)
           }
         });
         
     }
   $(".select2").select2();

    function kabupaten_dua()
    {
        
        let kab = $("#kabupaten").val()
        $.ajax({
          url : "<?= base_url('ambil_kabupaten') ?>/" + kab,
          success:function(data_dua) {
            $("#kecamatan").html(data_dua)
            $("#kabupaten").val("<?= "KABUPATEN PEKALONGAN" ?>").trigger("change")

          }
        })

    }

    function kecamatan_tiga()
    {
        let kec = $("#kecamatan").val()
      $.ajax({
        url : "<?= base_url("ambil_kecamatan") ?>/" + kec,
        success : function(data_tiga) {
          $("#kelurahan").html(data_tiga)
        }
      })   
    }
</script>
<?= $this->endSection(); ?>