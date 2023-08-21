<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Paket Umrah</h4>
                    </div>
                    <?php
                    if (session()->get("success")) : ?>
                        <div class="m-3 alert alert-success">
                            <span><?= session()->get("success");  ?></span>
                        </div>
                    <?php elseif (session()->get("error")) : ?>
                        <div class="m-3 alert alert-danger">
                            <span><?= session()->get("error");  ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="<?= base_url("edit_paket/" . $main['id']);  ?>" >
                <div>
                    <div class="mb-3">
                        <label for="">Nama Paket*</label>
                        <input type="text" class="form-control" required placeholder="Nama Paket" name="nama_paket" value="<?= $main['nama'];  ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Biaya*</label>
                                <input type="text" id="uang_baru" class="form-control" required placeholder="Biaya   " name="biaya" value="<?= $main['biaya'];  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Waktu Berangkat & Kepulangan*</label>
                                <input type="text" class="form-control" required placeholder="" id="berangkats" name="waktu_berangkat" readonly >
                            </div>
                            
                            <div class="mb-3">
                                <label for="">Keterangan Berangkat*</label>
                                <textarea name="ket_berangkat" class="form-control" id="" cols="30" rows="10" placeholder="Keterangan Berangkat"><?= $main['ket_berangkat'];  ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Provider*</label>
                                <br>
                                <select name="provider" class="form-control select1<?= $main['id'] ?>" style="width: 100% !important;" required id="">
                                    <option value="">Pilih</option>
                                    <?php foreach ($provider as $mains) : ?>
                                        <option <?= ($mains['nama_provider'] == $main['provider']) ? "selected" : "";  ?> value="<?= $mains['nama_provider'];  ?>"><?= $mains['nama_provider'];  ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="wrapper mb-2" style="width: 150px;height: 150px;">
                                <img src="<?= base_url("assets/upload/$main[poster]"); ?>" alt="" class="img-thumbnail img-fluid w-100 h-100">
                            </div>
                            <div class="mb-3">
                                <label for="">Poster</label>
                                <input type="hidden" name="file_lama" value="<?= $main['poster'];  ?>">
                                <input type="file" class="form-control" name="file">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Tahun*</label>
                                <input type="number" class="form-control" required placeholder="Tahun" name="tahun" value="<?= $main['tahun'];  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Status*</label>
                                <div class="col d-flex">
                                    <label class="colorinput">
                                        <input id="aktif" name="status" value="aktif" type="checkbox" <?= ($main['status'] == "aktif") ? "checked" : "";  ?> value="danger" class="colorinput-input" />
                                        <span class="colorinput-color bg-primary"></span>
                                    </label>
                                    <label for="aktif" style="transform: translateY(0px) !important;transform: translateX(10px) !important;">Aktif</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="">Keterangan Pulang*</label>
                                <textarea name="ket_pulang" class="form-control" id="" cols="30" rows="10" placeholder="Keterangan Pulang"><?= $main['ket_pulang'];  ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Asuransi*</label>
                                <br>
                                <select name="asuransi" required class="form-control asuransia<?= $main['id'] ?>" style="width: 100% !important;" id="">
                                    <option value="">Pilih</option>
                                    <?php foreach ($asuransi as $main_asurasi) : ?>
                                        <?= $main_asurasi['nama'];  ?>
                                        <option <?= ($main_asurasi['nama'] == $main['asuransi']) ? "selected" : "";  ?> value="<?= $main_asurasi['nama'];  ?>"><?= $main_asurasi['nama'];  ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
                <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
                <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
                <script>
                    $(".select1<?= $main['id'] ?>").select2();
                    $(".asuransia<?= $main['id'] ?>").select2();
                </script>
                    <a href="<?= base_url('/paket'); ?>" class="btn btn-dark">Kembali</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">
    var tglBerangkat = '<?= date("m/d/Y",strtotime($main['tgl_berangkat'])); ?>';
var tglPulang = '<?= date("m/d/Y",strtotime($main['tgl_pulang'])); ?>';

// Mengatur nilai awal pada elemen input
$('#berangkats').val(tglBerangkat + ' - ' + tglPulang);
    $('#berangkats').daterangepicker({
        autoUpdateInput: false,
        locale: {
            cancelLabel: 'Clear'
        }
    });

    $('#berangkats').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    $('#berangkats').on('cancel.daterangepicker', function(ev, picker) {
        $(this).val('');
    });
</script>

<script>
   

    var uang_baru = document.getElementById("uang_baru");
    var biayaValue = uang_baru.value;

// Mengubah nilai menjadi format Rupiah saat halaman dimuat
uang_baru.value = formatRupiah(biayaValue, "Rp. ");
    uang_baru.addEventListener("keyup", function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        uang_baru.value = formatRupiah(this.value, "Rp. ");
    });
    /* Fungsi formatRupiah */
    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "" + rupiah : "";
    }
</script>

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".select21").select2()
    $(".select22").select2()
    $(".select23").select2()
    $(".rekening").select2()
    $(document).ready(function() {
        $('#table-1').DataTable();
    });
</script>


<?= $this->endSection(); ?>