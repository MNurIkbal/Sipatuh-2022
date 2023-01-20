<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
  <section class="section">
    <div class="card">
      <div class="card-header">
        <h4 style="text-transform: uppercase">Visa</h4>
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
          <form action="<?=  base_url("visa/$id");  ?>" class="col-lg" method="POST" enctype="multipart/form-data">
            <div class="card">
              <input type="hidden" name="id_paket" value="<?=  $id_paket;  ?>">
              <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
              <div class="card-header bg-success text-white">
                <h4>Detail Visa</h4>
              </div>
              <div class="card-bodys">
                <ul class="list-group">
                  
                  <li class="list-group-item">
                  <label for="">Provider : </label>
                        <select name="provider" class="form-control" required id="">
                            <option value="">Pilih</option>
                            <?php foreach($provider as $main_tiga) : ?>
                                <option <?=  ($main_tiga['nama_provider'] == $main['provider']) ? "selected" : "";  ?> value="<?=  $main_tiga['nama_provider'];  ?>"><?=  $main_tiga['nama_provider'];  ?></option>
                                <?php endforeach; ?>
                        </select>
                </li>
                  <li class="list-group-item">
                  <label for="">Nomor Visa: </label>
                    <input type="text" name="nomor" class="form-control " required placeholder="Nomor Visa"
                        value="<?=  $main['nomor_visa'];  ?>">
                  </li>
                  <li class="list-group-item">
                  <label for="">Tanggal Awal Visa: </label>
                    <input type="date" name="awal" class="form-control " required placeholder="Tanggal"
                        value="<?=  $main['tgl_awal_visa'];  ?>">
                  </li>
                  <li class="list-group-item">
                  <label for="">Tanggal Akhir Visa: </label>
                    <input type="date" name="akhir" class="form-control " required placeholder="Tanggal"
                        value="<?=  $main['tgl_akhir_visa'];  ?>">
                  </li>
                  <li class="list-group-item">
                  <label for="">Muassasah: </label>
                    <select name="muassasah" required class="form-control" id="">
                        <option value="">Pilih</option>
                        <?php foreach($muasah as $row_dua) : ?>
                        <option <?=  ($row_dua['nama_muassasah'] == $main['muassasah']) ? "selected" : "";  ?>
                            value="<?=  $row_dua['nama_muassasah'];  ?>"><?=  $row_dua['nama_muassasah'];  ?></option>
                        <?php endforeach; ?>
                    </select>
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