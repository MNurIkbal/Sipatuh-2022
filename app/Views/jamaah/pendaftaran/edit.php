<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Jamaah</h4>
                    </div>
                    <?php if (session()->get("success")) : ?>
                        <div class="m-3 alert alert-success">
                            <span><?= session()->get("success");  ?></span>
                        </div>
                    <?php elseif (session()->get("error")) : ?>
                        <div class="m-3 alert alert-danger">
                            <span><?= session()->get("error");  ?></span>
                        </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="<?= base_url("edit_jamaah/" . $main['id']);  ?>">
                            <input type="hidden" name="id_paket" value="<?= $id;  ?>">
                            <input type="hidden" name="id_kloter" value="<?= $id_kloter;  ?>">
                            <div class="modal-bodys">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Title*</label>
                                            <select name="title" class="form-control select2" required id="">
                                                <option value="">Pilih</option>
                                                <option value="Tuan" <?= ($main['title'] == "Tuan") ? "selected" : "";  ?>>Tuan
                                                </option>
                                                <option value="Nyonya" <?= ($main['title'] == "Nyonya") ? "selected" : "";  ?>>Nyoya
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Nama Ayah*</label>
                                            <input type="text" class="form-control" required placeholder="Nama Ayah" name="ayah" value="<?= $main['ayah'];  ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <input type="hidden" name="jenis_identitas" value="nik" required>
                                        <div class="mb-3">
                                            <label for="">Nama*</label>
                                            <input type="text" class="form-control " required placeholder="Nama" value="<?= $main['nama'];  ?>" name="nama">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Foto</label>
                                            <input type="file" class="form-control " placeholder="Nama" name="foto">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">No Identitas*</label>
                                            <input type="text" class="form-control " required placeholder="No Identitas" value="<?= $main['no_identitas'];  ?>" name="no_identitas">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Tempat Lahir*</label>
                                            <input type="text" class="form-control " required placeholder="Tempat Lahir" name="tempat_lahir" value="<?= $main['tempat_lahir'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Tanggal Lahir*</label>
                                            <input type="date" class="form-control" required placeholder="" name="tgl_lahir" value="<?= $main['tgl_lahir'];  ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">No Telepon</label>
                                            <input type="number" class="form-control" placeholder="No Telepon" name="no_telpon" value="<?= $main['no_telp'];  ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">No HP*</label>
                                            <input type="number" class="form-control" required placeholder="No Hp" name="no_hp" value="<?= $main['no_hp'];  ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Kewarganegaraan*</label>
                                            <select name="warganegara" class="form-control select2" required id="">
                                                <option value="">Pilih</option>
                                                <option value="wni" <?= ($main['kewargannegaraan'] == "wni") ? "selected" : "";  ?>>WNI
                                                </option>
                                                <option value="wna" <?= ($main['kewargannegaraan'] == "wna") ? "selected" : "";  ?>>WNA
                                                </option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Jenis Pendidikan*</label>
                                            <select name="jenis_pendidikan" class="form-control select2" required id="">
                                                <option value="">Pilih</option>
                                                <option value="tidak sekolah" <?= ($main['jenis_pendidikan'] == "tidak sekolah") ? "selected" : "";  ?>>Tidak
                                                    Sekolah</option>
                                                <option value="SD" <?= ($main['jenis_pendidikan'] == "SD") ? "selected" : "";  ?>>SD
                                                </option>
                                                <option value="SMP" <?= ($main['jenis_pendidikan'] == "SMP") ? "selected" : "";  ?>>SMP
                                                </option>
                                                <option value="SMA/SMK" <?= ($main['jenis_pendidikan'] == "SMA/SMK") ? "selected" : "";  ?>>SMA/SMK
                                                </option>
                                                <option value="PERGURUAN TINGGI" <?= ($main['jenis_pendidikan'] == "PERGURUAN TINGGI") ? "selected" : "";  ?>>
                                                    PERGURUAN TINGGI</option>
                                                <option value="lainnya" <?= ($main['jenis_pendidikan'] == "lainnya") ? "selected" : "";  ?>>lainnya
                                                </option>
                                            </select>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="">Nama Paspor</label>
                                            <input type="text" class="form-control" placeholder="Nama Paspor" name="nama_paspor" value="<?= $main['nama_paspor'];  ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Alamat* </label>
                                            <textarea name="alamat" id="" class="form-control" required cols="30" rows="10" placeholder="Alamat"><?= $main['alamat'];  ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Status Pernikahan*</label>
                                            <select name="nikah" class="form-control select2" required id="">
                                                <option value="">Pilih</option>
                                                <option value="sudah nikah" <?= ($main['status_pernikahan'] == "sudah nikah") ? "selected" : "";  ?>>sudah
                                                    nikah</option>
                                                <option value="belum nikah" <?= ($main['status_pernikahan'] == "belum nikah") ? "selected" : "";  ?>>belum
                                                    nikah</option>
                                            </select>
                                        </div>
                        <input type="hidden" name="foto_lama" value="<?= $main['foto']; ?>">
                                        <div class="mb-3">
                                            <label for="">Jenis Pekerjaan*</label>
                                            <select name="jenis_pekerjaan" class="form-control select2" required id="">
                                                <option value="">Pilih</option>
                                                <option value="tidak bekerja" <?= ($main['jenis_pekerjaan'] == "tidak bekerja") ? "selected" : "";  ?>>Tidak
                                                    Bekerja</option>
                                                <option value="guru" <?= ($main['jenis_pekerjaan'] == "guru") ? "selected" : "";  ?>>
                                                    Guru</option>
                                                <option value="nelayan" <?= ($main['jenis_pekerjaan'] == "nelayan") ? "selected" : "";  ?>>Nelayan</option>
                                                <option value="petani" <?= ($main['jenis_pekerjaan'] == "petani") ? "selected" : "";  ?>>Petani</option>
                                                <option value="buruh" <?= ($main['jenis_pekerjaan'] == "buruh") ? "selected" : "";  ?>>
                                                    Buruh</option>
                                                <option value="polisi" <?= ($main['jenis_pekerjaan'] == "polisi") ? "selected" : "";  ?>>Polisi</option>
                                                <option value="pns" <?= ($main['jenis_pekerjaan'] == "pns") ? "selected" : "";  ?>>PNS
                                                </option>
                                                <option value="pengusaha" <?= ($main['jenis_pekerjaan'] == "pengusaha") ? "selected" : "";  ?>>Pengusahan
                                                </option>
                                                <option value="lainnya" <?= ($main['jenis_pekerjaan'] == "lainnya") ? "selected" : "";  ?>>lainnya</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">No Paspor</label>
                                            <input type="text" class="form-control" placeholder="No Paspor" name="no_paspor" value="<?= $main['no_paspor'];  ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Provinsi*</label>
                                            <?php
                                            $mains =  $db->query("SELECT * FROM provinces ORDER BY name ASC")->getResultArray();
                                            ?>
                                            <select name="provinsi" id="provinsi" class="form-control select2" required onchange="provinsi_satu()">
                                                <?php foreach ($mains as $rt) :  ?>
                                                    <option data-provinsi-id="<?= $rt['id']; ?>" <?= ($rt['name'] == $main['provinsi'] ? "selected" : ""); ?> value="<?= $rt['id']  . '-' . $rt['name']; ?>"><?= $rt['name']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Kabupaten*</label>
                                            <select name="kabupaten" id="kabupaten" class="form-control select2 " onchange="kabupaten_dua()" required>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Kecamatan*</label>
                                            <select name="kecamatan" id="kecamatan" class="form-control select2" onchange="kecamatan_tiga()" required>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="">Kelurahan*</label>
                                            <select name="kelurahan" id="kelurahan" class="form-control select2" required>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footers sbg-whitesmoke br">
                                <a href="<?= base_url("tambah_pendaftaran/" . $id_kloter . '/' . $id); ?>" class="btn btn-dark">Kembali</a>
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

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".select2").select2();

    let selectedProvinsiId = $("#provinsi option:selected").data("provinsi-id");
    var kabupaten_data = "<?= $main['kabupaten']  ?>";
    var kecamatan_data = "<?= $main['kecamatan'] ?>";
    $.ajax({
        url: "<?= base_url('ambil_provinsi') ?>/" + selectedProvinsiId,
        dataType: "json",
        success: function(data_dua) {
            var options = "";
            $.each(data_dua, function(index, kabupaten) {
                options += "<option data-kabupaten-id='" + kabupaten.id + "' value='" + kabupaten.id + "-" + kabupaten.nama + "'";

                if (kabupaten.nama === kabupaten_data) {
                    options += " selected";
                }

                options += ">" + kabupaten.nama + "</option>";
            });
            $("#kabupaten").html(options);
        }
    });


    $.ajax({
        url: "<?= base_url('ambil_kabupaten_satu') ?>/" + kabupaten_data,
        dataType: "json",
        success: function(data_dua) {
            var options = "";
            $.each(data_dua, function(index, kabupaten) {
                options += "<option data-kabupaten-id='" + kabupaten.id + "' value='" + kabupaten.id + "-" + kabupaten.nama + "'>" + kabupaten.nama + "</option>";
            });
            $("#kecamatan").html(options);
        }
    });

    $.ajax({
        url: "<?= base_url('ambil_kelurahan_satu') ?>/" + kecamatan_data,
        dataType: "json",
        success: function(data_dua) {
            var options = "";
            $.each(data_dua, function(index, kabupaten) {
                options += "<option data-kabupaten-id='" + kabupaten.id + "' value='" + kabupaten.id + "-" + kabupaten.nama + "'>" + kabupaten.nama + "</option>";
            });
            $("#kelurahan").html(options);
        }
    });

    function provinsi_satu() {
        let val = $("#provinsi").val()
        $.ajax({
            url: "<?= base_url('ambil_provinsi') ?>/" + val,
            dataType: "json",
            success: function(data_dua) {
                var options = "";
                $.each(data_dua, function(index, kabupaten) {
                    options += "<option data-kabupaten-id='" + kabupaten.id + "' value='" + kabupaten.id + "-" + kabupaten.nama + "'>" + kabupaten.nama + "</option>";
                });
                $("#kabupaten").html(options);
            }
        });

    }


    function kabupaten_dua() {

        let kab = $("#kabupaten").val()
        $.ajax({
            url: "<?= base_url('ambil_kabupaten') ?>/" + kab,
            dataType: "json",
            success: function(data_dua) {
                var options = "";
                $.each(data_dua, function(index, kabupaten) {
                    options += "<option data-kabupaten-id='" + kabupaten.id + "' value='" + kabupaten.id + "-" + kabupaten.nama + "'>" + kabupaten.nama + "</option>";
                });
                $("#kecamatan").html(options);
            }
        });

    }

    function kecamatan_tiga() {
        let kec = $("#kecamatan").val()
        $.ajax({
            url: "<?= base_url("ambil_kecamatan") ?>/" + kec,
            success: function(data_tiga) {
                $("#kelurahan").html(data_tiga)
            }
        })
    }
</script>
<?= $this->endSection(); ?>