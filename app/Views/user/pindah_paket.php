<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
  <section class="section">
    <div class="card">
      <div class="card-header">
        <h4 style="text-transform: uppercase">Pindah Paket</h4>
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
          <form action="<?=  base_url("pindah_paket_user/$id");  ?>" class="col-lg" method="POST" enctype="multipart/form-data">
            <div class="card">
              <input type="hidden" name="id_paket" value="<?=  $id_paket;  ?>">
              <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
              <div class="card-header bg-success text-white">
                <h4>Detail Paket</h4>
              </div>
              <div class="card-bodys">
                <ul class="list-group">
                  
                  <li class="list-group-item">Nama Jamaah: <?=  $jamaah['nama'];  ?></li>
                  <li class="list-group-item">No Registrasi : <?=  $jamaah['no_registrasi'];  ?></li>
                  <li class="list-group-item">No Pasti Umrah : <?=  $jamaah['no_pasti_umrah'];  ?></li>
                  <li class="list-group-item">Nama Paket : <?=  $check_paket['nama'];  ?></li>
                  <li class="list-group-item">Periode : <?=  date("d, F Y",strtotime($check_paket['tgl_berangkat'])) . ' - ' . date("d, F Y",strtotime($check_paket['tgl_pulang']));  ?></li>
                  <li class="list-group-item">
                  <div class="mb-1">
                                    <label for="">Pindah Paket</label>
                                    <input type="hidden" name="id_paket" value="<?=  $id_paket;  ?>">
                                    <select name="paket" class="form-control" required autofocus autocomplete="" id="paket" onchange="pindah()">
                                        <option value="">Pilih</option>
                                        <?php foreach($all_paket as $rt) : ?>
                                        <?php if($rt['id'] != $id_paket) : ?>
                                        <option value="<?=  $rt['id'];  ?>"><?=  $rt['nama'];  ?></option>
                                        <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-1" id="none">
                                    <label for="">Kloter</label>
                                    <input type="hidden" name="id_paket" value="<?=  $id_paket;  ?>">
                                    <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
                                    <select name="kloter"  class="form-control" required  autocomplete="" id="kloter">
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="<?= base_url('detail_jamaah_aktif/' . $id_paket . '/' . $id_kloter); ?>" class="btn btn-danger">Kembali</a>
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