<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
  <section class="section">
    <div class="card">
      <div class="card-header">
        <h4 style="text-transform: uppercase">Asuransi</h4>
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
        <div class="row">
          <form action="<?=  base_url("asuransi/$id");  ?>" class="col-lg" method="POST" enctype="multipart/form-data">
            <div class="card">
              <input type="hidden" name="id_paket" value="<?=  $id_paket;  ?>">
              <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
              <div class="card-header bg-success text-white">
                <h4>Detail Asuransi</h4>
              </div>
              <div class="card-bodys">
                <ul class="list-group">
                  
                  <li class="list-group-item">
                  <label for="">Asuransi</label>
                  <select name="asuransi" class="form-control" required  id="">
                            <option value="">Pilih</option>
                            <?php foreach($asuransi as $main_empat) : ?>
                                <option value="<?=  $main_empat['nama'];  ?>" <?=  ($main_empat['nama'] == $main['asuransi']) ? "selected" : "";  ?>><?=  $main_empat['nama'];  ?></option>
                                <?php endforeach; ?>
                        </select>
                </li>
                  <li class="list-group-item">
                    <label for="">No Polis</label>
                    <input type="text" name="nomor" class="form-control " required placeholder="Nomor Polis"
                        value="<?=  $main['nomor_polis'];  ?>">
                  </li>
                  <li class="list-group-item">
                    <label for="">Tanggal Input</label>
                    <input type="date" name="tgl_input" class="form-control " required placeholder="Tanggal"
                        value="<?=  $main['tgl_input'];  ?>">
                  </li>
                  <li class="list-group-item">
                    <label for="">Tanggal Awal Polis: </label>
                    <input type="date" name="awal" class="form-control " required placeholder="Tanggal"
                        value="<?=  $main['tgl_awal'];  ?>">
                  </li>
                  <li class="list-group-item">
                  <label for="">Tanggal Akhir Polis: </label>
                    <input type="date" name="akhir" class="form-control " required placeholder="Tanggal"
                        value="<?=  $main['tgl_akhir'];  ?>">
                  </li>
                  <li class="list-group-item">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                  </li>
                </ul>
                
                
              </div>
</form>
          </div>
        </div>
      </div>
    <div class="card">
      <div class="card-body">
        <div class="row">
          <form action="<?=  base_url("vaksin/$id");  ?>" class="col-lg" method="POST" enctype="multipart/form-data">
            <div class="card">
              <input type="hidden" name="id_paket" value="<?=  $id_paket;  ?>">
              <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
              <div class="card-header bg-success text-white">
                <h4>Detail Vaksin</h4>
              </div>
              <div class="card-bodys">
                <ul class="list-group">
                  
                  <li class="list-group-item">
                  <label for="">Jenis Vaksin</label>
                    <input type="text" name="jenis" class="form-control" required placeholder="Jenis Vaksin" value="<?=  $main['jenis_vaksin'];  ?>">
                </li>
                  <li class="list-group-item">
                  <label for="">Tanggal Vaksin</label>
                    <input type="date" name="tgl" value="<?=  $main['tgl_vaksin'];  ?>" class="form-control" required placeholder="">
                  </li>
                  <li class="list-group-item">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                  </li>
                </ul>
                
                
              </div>
</form>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>

<script>
    $("#none").hide()

    function pindah()
    {
        $("#none").show()
        let val = $("#paket").val();
        console.log(val)
        $.ajax({
            url : "<?= base_url('ambil_kolter') ?>/" + val,
            success : function(res) {
                $("#kloter").html(res)
            }
        })
    }

</script>

<?= $this->endSection(); ?>