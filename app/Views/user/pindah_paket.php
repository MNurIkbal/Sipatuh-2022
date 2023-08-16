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
                                    <select name="paket" class="form-control sele" required autofocus autocomplete="" id="paket" onchange="pindah()">
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
                                    <select name="kloter"  class="form-control selee" required  autocomplete="" id="kloter" style="width: 100% !important;">
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
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $("#none").hide()
    $(".sele").select2()
    $(".selee").select2()

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