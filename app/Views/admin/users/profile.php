<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<?php 
$validation = \Config\Services::validation();
?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Tambah Travel</h4>
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
                        <form action="<?=  base_url("update_profile_users");  ?>" enctype="multipart/form-data" method="POST">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h5>Informasi Travel</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="">Nama Perushaan</label>
                                                <!-- <input type="text" name="nama_perusahaan"
                                                    value="" required
                                                    class="form-control" placeholder="Nama Perusahaan"> -->
                                                    <select name="nama_perusahaan" class="form-control" required id="">
                                                        <option value="">Pilih</option>
                                                        <?php foreach($travel as $travels) : ?>
                                                            <option value="<?=  $travels['nama_travel'];  ?>"><?=  $travels['nama_travel'];  ?></option>
                                                            <?php endforeach; ?>
                                                    </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Nama Travel Umrah</label>
                                                <input type="text" name="nama_travel"
                                                    required
                                                    class="form-control" placeholder="Nama Travel Umrah">
                                            </div>
                                            <div class="mb-3">
                                                <label for="">NPWP</label>
                                                <input type="text" name="npwp" 
                                                    required class="form-control" placeholder="NPWP">
                                            </div>
                                            <div class="mb-3">
                                                <label for="">No Sk</label>
                                                <input type="text" name="no_sk"
                                                    required class="form-control" placeholder="No Sk">
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Tanggal Sk</label>
                                                <input type="date" name="tgl_sk" 
                                                    required class="form-control" placeholder="Tanggal Sk">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h5>Kontak Travel</h5>
                                        </div>
                                        <div class="card-body">
                                        <div class="mb-3">
                                        <label for="">No Telp</label>
                                        <input type="number" name="no_telp" 
                                            required class="form-control" placeholder="No Telp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">No Hp</label>
                                        <input type="number" name="no_hp"  required
                                            class="form-control" placeholder="No Hp">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Email</label>
                                        <input type="email" name="email"  required
                                            class="form-control" placeholder="Email">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Website</label>
                                        <input type="text" name="website" required
                                            class="form-control" placeholder="Website">
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Provinsi</label>
                                        <!-- <input type="text" name="provinsi" 
                                            required class="form-control" placeholder="Provinsi"> -->
                                            <select name="provinsi" id="provinsi" class="form-control" required>
                                                <option value="">Pilih</option>
                                                <?php foreach($provinsi as $main_dua) :  ?>
                                                    <option value="<?= $main_dua['id'] . '-' . $main_dua['name']; ?>"><?= $main_dua['name']; ?></option>
                                                    <?php endforeach; ?>
                                            </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Kabupaten</label>
                                        <select name="kabupaten" id="kabupaten" class="form-control" required>
                                            <!-- <option value=""></option> -->
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Kecamatan</label>
                                        <select name="kecamatan" id="kecamatan" class="form-control" required>

                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" class="form-control" required placeholder="Alamat" id=""
                                            cols="30" rows="10"></textarea>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header text-white bg-success">
                                            <h5>Kontak Travel Di Arab</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="">Alamat Mekkah</label>
                                                <textarea name="alamat_mekkah" class="form-control"  placeholder="Alamat Mekkah" id="" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">No Telp Mekkah</label>
                                                <input type="number" class="form-control" placeholder="No Telp Mekkah" name="no_telp_mekkah" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="">Alamat Madinah</label>
                                                <textarea name="alamat_madinah" class="form-control"  placeholder="Alamat Madinah" id="" cols="30" rows="10"></textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="">No Telp Madinah</label>
                                                <input type="number" class="form-control" placeholder="No Telp Madinah" name="no_telp_madinah" >
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h5>Foto Kantor</h5>
                                        </div>
                                        <div class="card-body">
                                                    <div class="mb-3">
                                                        <label for="">Foto Kantor</label>
                                                        <input type="file" name="file" class="form-control" >
                                                    </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h5>Logo Travel</h5>
                                        </div>
                                        <div class="card-body">
                                                    <div class="mb-3">
                                                        <label for="">Logo Travel</label>
                                                        <input type="file" name="file_logo" class="form-control" >
                                                    </div>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            <a href="<?=  base_url("users");  ?>" class="btn btn-warning">Kembali</a>
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
      $("#provinsi").change(function() {
    let val = $(this).val()
    $.ajax({
      url : "<?= base_url("ambil_provinsi") ?>/" + val,
      success : function(data) {
        $("#kabupaten").html(data)
      }
    });

    $("#kabupaten").change(function() {
      let kab = $(this).val()
      $.ajax({
        url : "<?= base_url('ambil_kabupaten') ?>/" + kab,
        success:function(data_dua) {
          $("#kecamatan").html(data_dua)
        }
      })
    });

    
    $("#kecamatan").change(function() {
      let kec = $(this).val()
      $.ajax({
        url : "<?= base_url("ambil_kecamatan") ?>/" + kec,
        success : function(data_tiga) {
          $("#kelurahan").html(data_tiga)
        }
      })
    })
  });
</script>
<?= $this->endSection(); ?>