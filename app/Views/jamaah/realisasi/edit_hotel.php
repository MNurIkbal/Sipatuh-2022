<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<div class="main-content">
    <section class="section">
        <div class="card">
            <?php if (session()->get("success")) : ?>
                <div class="m-3 alert alert-success">
                    <span><?= session()->get("success");  ?></span>
                </div>
            <?php elseif (session()->get("error")) : ?>
                <div class="m-3 alert alert-danger">
                    <span><?= session()->get("error");  ?></span>
                </div>
            <?php endif; ?>
            <div class="card-header">
                <h4>Edit Hotel</h4>
                
            </div>
            <div class="card-body">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url("edit_hotel_satu");  ?>" >
                    <input type="text" class="d-none" name="id_paket" value="<?= $result['id'];  ?>">
                    <input type="text" class="d-none" name="id" value="<?= $hotel_satu['id'];  ?>">
                    <input type="text" class="d-dnone" name="id_kloter" value="<?= $id_klo  ?>">
                    <div >
                        <div class="mb-3">
                            <label for="">Hotel*</label>
                            <br>
                            <select name="nama_hotel" style="width: 100% !important;" class="form-control select24" required id="">
                                <option value="">Pilih</option>
                                <?php foreach ($data_hotel as $data_hotels) : ?>
                                    <option value="<?= $data_hotels['nama'];  ?>" <?= ($data_hotels['nama'] == $hotel_satu['hotel']) ? "selected" : ""; ?>><?= $data_hotels['nama'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="">Orang Perkamar*</label>
                            <input type="text" class="form-control" required placeholder="Orang Perkamar" name="orang" value="<?= $hotel_satu['orang_perkamar'];  ?>">
                        </div>
                        <div class="mb-3">
                                    <label for="">Tanggal Masuk & Keluar*</label>
                                    <input type="text" class="form-control" required placeholder="" id="keberangkatan_id" name="masuk" readonly value="<?= date("m/d/Y",strtotime($hotel_satu['tgl_masuk'])) . ' - ' . date("m/d/Y",strtotime($hotel_satu['tgl_keluar'])) ?>">
                                </div>
                    </div>
                        <a href="<?= base_url('detail_realisasi/' . $id_klo .'/' . $result['id']); ?>" class="btn btn-dark" >Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script>
    $(".select24").select2();
    var mulai = <?= date("Y-m-d",strtotime($hotel_satu['tgl_masuk'])) ?>;
    var selesai = <?= date("Y-m-d",strtotime($hotel_satu['tgl_keluar'])) ?>;
    
    $('#keberangkatan_id').daterangepicker({
    opens: 'left',
  });
</script>
<?= $this->endSection(); ?>