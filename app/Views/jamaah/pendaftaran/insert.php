<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Jamaah</h4>
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
                    <form method="POST" enctype="multipart/form-data" action="<?=  base_url("tambah_jamaah");  ?>"
            >
            <input type="hidden" name="id_paket" value="<?=  $id;  ?>">
            <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
            
            <div class="modal-bodys">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Title</label>
                            <!-- <input type="text" class="form-control" required placeholder="Title" name="title"> -->
                            <select name="title" class="form-control select2" required id="">
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
                            <select name="jenis_identitas" id="" class="form-control select2" required>
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
                            $mains =  $db->query("SELECT * FROM provinces ORDER BY name ASC")->getResultArray();
                            ?>
                            <select name="provinsi" id="provinsi"  class="form-control select2" required onchange="provinsi_satu()">
                                <option value="">Pilih</option>
                                <?php foreach($mains as $rt) :  ?>
                                    <option value="<?= $rt['id']  . '-' . $rt['name']; ?>"><?= $rt['name']; ?></option>
                                    <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Kabupaten</label>
                            <select name="kabupaten" id="kabupaten" class="form-control select2 " onchange="kabupaten_dua()" required>
                                <option value="">Pilih</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Kecamatan</label>
                            <select name="kecamatan" id="kecamatan" class="form-control select2" onchange="kecamatan_tiga()" required>
                                <option value="">Pilih</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Kelurahan</label>
                            <select name="kelurahan" id="kelurahan" class="form-control select2"  required>
                                <option value="">Pilih</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Status Pernikahan</label>
                            <select name="nikah" class="form-control select2" required id="">
                                <option value="">Pilih</option>
                                <option value="sudah nikah">sudah nikah</option>
                                <option value="belum nikah">belum nikah</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Jenis Pendidikan</label>
                            <select name="jenis_pendidikan" class="form-control select2" required id="">
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
                            <select name="jenis_pekerjaan" class="form-control select2" required id="">
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
                            <select name="provider" class="form-control select2" required id="">
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
                            <select name="asuransi" required class="form-control select2" id="">
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
            <div class="modal-footser bg-wshitesmoke br">
                <a href="<?= base_url("tambah_pendaftaran/$id_kloter/$id"); ?>" class="btn btn-danger">Kembali</a>
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