<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pindah Paket</h4>
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
                        <form method="POST" enctype="multipart/form-data"
                            action="<?=  base_url("pindah_paket/" . $id);  ?>" >
                            <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
                            <input type="hidden" name="id_jamaah" value="<?=  $id;  ?>">
                            <div >
                                <div class="mb-1">
                                    <label for="">Nama Jamaah : </label>
                                    <b><?=  $main['nama'];  ?></b>
                                </div>
                                <div class="mb-1">
                                    <label for="">Nomor Registrasi : </label>
                                    <b><?=  $main['no_registrasi'];  ?></b>
                                </div>
                                <div class="mb-1">
                                    <label for="">No Pasti Umrah : </label>
                                    <b><?=  $main['no_pasti_umrah'];  ?></b>
                                </div>
                                <div class="mb-1">
                                    <label for="">Nama Paket : </label>
                                    <b><?=  $main['nama'];  ?></b>
                                </div>
                                <div class="mb-1">
                                    <label for="">Periode : </label>
                                    <b><?=  date("d F Y",strtotime($paket['tgl_berangkat'])) . ' - '. date("d F Y",strtotime($paket['tgl_pulang']));  ?></b>
                                </div>
                                <div class="mb-1">
                                    <label for="">Pindah Paket</label>
                                    <input type="hidden" name="id_paket" value="<?=  $id_paket;  ?>">
                                    <select name="paket" class="form-control select77" required autofocus autocomplete="" id="paket" onchange="pindah()">
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
                                    <br>
                                    <input type="hidden" name="id_paket" value="<?=  $id_paket;  ?>">
                                    <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
                                    <select name="kloter"  class="form-control select77" required  autocomplete="" id="kloter" style="width: 100% !important;">
                                        <option value="">Pilih</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer  br">
                                <a href="<?=  base_url("tambah_pendaftaran/" . $id_kloter . '/' . $id_paket);  ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Pindah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>


<!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script> -->

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $("#none").hide()

    $(".select77").select2()

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