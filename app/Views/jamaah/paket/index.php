<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>

<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Paket Umrah</h4>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" title="Tambah">Tambah</button>
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
                        <div class="table-responsive">
                            <table class="table table-striped" id="table-1">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            #
                                        </th>
                                        <th>Nama Paket</th>
                                        <th>Periode</th>
                                        <th>Biaya</th>
                                        <th>Info Jamaah</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1;
                                    foreach ($result as $row) :
                                    ?>
                                        <?php
                                        $db      = \Config\Database::connect();
                                        $paket_id = $row['id'];
                                        $pendaftaran = $db->query("SELECT * FROM jamaah WHERE paket_id = '$paket_id'")->getResult();
                                        $setor_awal = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'cicil' AND paket_id = '$paket_id'")->getResult();
                                        $lunas = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'lunas' AND paket_id = '$paket_id'")->getResult();
                                        ?>
                                        <tr>
                                            <td><?= $no++;  ?></td>
                                            <td><?= $row['nama'];  ?></td>
                                            <td>
                                                <?= date("D, d F Y", strtotime($row["tgl_berangkat"])) . " - " . date("D, d F Y", strtotime($row["tgl_pulang"]));  ?>
                                            </td>
                                            <td>
                                                <?= "Rp." . number_format($row['biaya']);  ?>
                                            </td>
                                            <td>
                                                <span>
                                                    PENDAFTARAN : <?= count($pendaftaran);  ?> ORANG
                                                </span>
                                                <br>
                                                <span>
                                                    SETOR AWAL : <?= count($setor_awal);  ?> ORANG
                                                </span>
                                                <br>
                                                <span>
                                                    LUNAS : <?= count($lunas);  ?> ORANG
                                                </span>
                                                <br>
                                                <span style="text-transform: uppercase">
                                                    Status : <?php if ($row['status'] != null) : ?>
                                                        <span class="badge badge-pill badge-primary"><?= $row['status'];  ?></span>
                                                    <?php else : ?>
                                                        <span class="badge badge-pill badge-primary">tidak aktif</span>
                                                    <?php endif; ?>
                                                </span>
                                            </td>
                                            <td>
                                                <a title="Detail" href="<?= base_url("detail_paket/$row[id]");  ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                                <?php if ($row['pemberangkatan'] != "sudah") : ?>
                                                    <a href="#" data-toggle="modal" data-target="#hapus<?= $row['id'] ?>" title="Hapus" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                    <a href="#" class="btn btn-success" data-toggle="modal" title="Edit" data-target="#edit<?= $row['id'] ?>"><i class="fa fa-pen"></i></a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" enctype="multipart/form-data" action="<?= base_url("tambah_paket");  ?>" class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Paket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Nama Paket</label>
                    <input type="text" class="form-control" required placeholder="Nama Paket" name="nama_paket">
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Biaya</label>
                            <input type="text" id="uang" class="form-control" required placeholder="Biaya   " name="biaya">
                        </div>

                        <div class="mb-3">
                            <label for="">Waktu Berangkat</label>
                            <input type="date" class="form-control" required placeholder="Biaya   " name="waktu_berangkat" id="berangkat">
                        </div>
                        <div class="mb-3">
                            <label for="">Keterangan Berangkat</label>
                            <textarea name="ket_berangkat" class="form-control" id="" cols="30" rows="10" placeholder="Keterangan Berangkat"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Provider</label>
                            <br>
                            <select name="provider" class="form-control select21 " style="width: 100% !important;" required id="">
                                <option value="">Pilih</option>
                                <?php foreach ($provider as $mains) : ?>
                                    <option value="<?= $mains['nama_provider'];  ?>"><?= $mains['nama_provider'];  ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Poster</label>
                            <input type="file" class="form-control" required name="file">
                        </div>
                        <div class="mb-3">
                            <label for="">Rekening Penampung</label>
                            <br>
                            <select style="width: 100% !important;" name="rekening_penampung" id="rekening" class="form-control rekening" required>
                                <option value="">Pilih</option>
                                <?php foreach ($rekening_penampung as $ttr) : ?>
                                    <option value="<?= $ttr['id']; ?>"><?= $ttr['bank'] .  ' / ' . $ttr['no_rekening'] . ' / ' . $ttr['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="">Tahun</label>
                            <input type="number" class="form-control" required placeholder="Tahun" name="tahun">
                        </div>
                        <div class="mb-3">
                            <label for="">Waktu Pulang</label>
                            <input id="pulang" type="date" class="form-control" required placeholder="" name="waktu_pulang" onclick="pulang()">
                        </div>
                        <div class="mb-3">
                            <label for="">Status</label>
                            <div class="col d-flex">
                                <label class="colorinput">
                                    <input id="aktif" name="status" value="aktif" type="checkbox" value="danger" class="colorinput-input" />
                                    <span class="colorinput-color bg-primary"></span>
                                </label>
                                <label for="aktif" style="transform: translateY(0px) !important;transform: translateX(10px) !important;">Aktif</span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="">Keterangan Pulang</label>
                            <textarea name="ket_pulang" class="form-control" id="" cols="30" rows="10" placeholder="Keterangan Pulang"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="">Asuransi</label>

                            <select name="asuransi" required class="form-control select22" style="width: 100% !important;" id="">
                                <option value="">Pilih</option>
                                <?php foreach ($asuransi as $main_asurasi) : ?>
                                    <option value="<?= $main_asurasi['nama'];  ?>"><?= $main_asurasi['nama'];  ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="">Tour Leader</label>

                            <select name="leader" class="form-control select23" style="width: 100% !important;" required id="">
                                <option value="">Pilih</option>
                                <?php foreach ($petugas as $petugass) : ?>
                                    <option value="<?= $petugass['nama']; ?>"><?= $petugass['nama']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<?php foreach ($result as $main) : ?>
    <div class="modal fade" tabindex="-1" role="dialog" id="hapus<?= $main['id'] ?>">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url("hapus_paket/" . $main['id']);  ?>" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Hapus Paket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Apakah Anda Yakin Ingin Menghapus?</h5>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Hapus</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" role="dialog" id="edit<?= $main['id'] ?>">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" enctype="multipart/form-data" action="<?= base_url("edit_paket/" . $main['id']);  ?>" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Paket</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Nama Paket</label>
                        <input type="text" class="form-control" required placeholder="Nama Paket" name="nama_paket" value="<?= $main['nama'];  ?>">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="">Biaya</label>
                                <input type="text" id="uang_baru" class="form-control" required placeholder="Biaya   " name="biaya" value="<?= $main['biaya'];  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Waktu Berangkat</label>
                                <input type="date" class="form-control" required placeholder="Biaya   " name="waktu_berangkat" value="<?= $main['tgl_berangkat'];  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Keterangan Berangkat</label>
                                <textarea name="ket_berangkat" class="form-control" id="" cols="30" rows="10" placeholder="Keterangan Berangkat"><?= $main['ket_berangkat'];  ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Provider</label>
                                <br>
                                <!-- <input type="text" class="form-control" required placeholder="Provider" name="provider" value="<?= $main['provider'] ?>"> -->
                                <select name="provider" class="form-control select1" style="width: 100% !important;" required id="">
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
                                <label for="">Tahun</label>
                                <input type="number" class="form-control" required placeholder="Tahun" name="tahun" value="<?= $main['tahun'];  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Waktu Pulang</label>
                                <input type="date" class="form-control" required placeholder="" name="waktu_pulang" value="<?= $main['tgl_pulang'];  ?>">
                            </div>
                            <div class="mb-3">
                                <label for="">Status</label>
                                <div class="col d-flex">
                                    <label class="colorinput">
                                        <input id="aktif" name="status" value="aktif" type="checkbox" <?= ($main['status'] == "aktif") ? "checked" : "";  ?> value="danger" class="colorinput-input" />
                                        <span class="colorinput-color bg-primary"></span>
                                    </label>
                                    <label for="aktif" style="transform: translateY(0px) !important;transform: translateX(10px) !important;">Aktif</span>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="">Keterangan Pulang</label>
                                <textarea name="ket_pulang" class="form-control" id="" cols="30" rows="10" placeholder="Keterangan Pulang"><?= $main['ket_pulang'];  ?></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="">Asuransi</label>
                                <br>
                                <!-- <input type="text" class="form-control" required placeholder="Asuransi" name="asuransi" value="<?= $main['asuransi'];  ?>"> -->
                                <select name="asuransi" required class="form-control asuransia" style="width: 100% !important;" id="">
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
                    $(".select1").select2({
                        dropdownParent: $('#edit<?= $main['id'] ?>')
                    });
                    $(".asuransia").select2({
                        dropdownParent: $('#edit<?= $main['id'] ?>')
                    });
                </script>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
<?php endforeach; ?>
<script>
    const pulang = document.getElementById("pulang")
    pulang.addEventListener("keydown", function(e) {
        // alert("ok")
    })
    var uang = document.getElementById("uang");
    uang.addEventListener("keyup", function(e) {
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        uang.value = formatRupiah(this.value, "Rp. ");
    });


    var uang_baru = document.getElementById("uang_baru");
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
    $(".select21").select2({
        dropdownParent: $('#exampleModal')
    })
    $(".select22").select2({
        dropdownParent: $('#exampleModal')
    })
    $(".select23").select2({
        dropdownParent: $('#exampleModal')
    })
    $(".rekening").select2({
        dropdownParent: $('#exampleModal')
    })
    $(document).ready(function() {

        $('#table-1').DataTable();

    });
</script>


<?= $this->endSection(); ?>