<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Detail Jamaah</h4>
                        <a href="<?= base_url('tambah_pendaftaran/' . $id_kloter . '/' . $id); ?>" class="btn btn-warning">Kembali</a>
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
                    <div class="modal-body">
                    <ul class="list-group">
                        <div class="row">
                            <div class="col-md-6">
                                <li class="list-group-item">Title : <?= $main['title'];  ?></li>
                                <li class="list-group-item">Nama : <?= $main['nama'];  ?></li>
                                <li class="list-group-item">Nama Paspor: <?= $main['nama_paspor'];  ?></li>
                                <li class="list-group-item">Nama Ayah: <?= $main['ayah'];  ?></li>
                                <li class="list-group-item">Jenis Identitas : <?= $main['jenis_identitas'];  ?></li>
                                <li class="list-group-item">Tempat Tanggal Lahir:
                                    <?= $main['tempat_lahir'] . ' , ' . date("d F Y", strtotime($main['tgl_lahir'])) ?></li>
                                <li class="list-group-item">Provinsi : <?= $main['provinsi'];  ?></li>
                                <li class="list-group-item">Kabupaten : <?= $main['kabupaten'];  ?></li>
                                <li class="list-group-item">Kecamatan : <?= $main['kecamatan'];  ?></li>
                                <li class="list-group-item">Kelurahan : <?= $main['kelurahan'];  ?></li>
                                <li class="list-group-item">Alamat : <?= $main['alamat'];  ?></li>
                                <li class="list-group-item">No Telephone : <?= $main['no_telp'];  ?></li>
                                <li class="list-group-item">No Hp : <?= $main['no_hp'];  ?></li>
                                <li class="list-group-item">Kewarganegaraan : <?= $main['kewargannegaraan'];  ?></li>
                                <li class="list-group-item">Status Pernikahan: <?= $main['status_pernikahan'];  ?></li>
                                <li class="list-group-item">Jenis Pendidikan: <?= $main['jenis_pendidikan'];  ?></li>
                                <li class="list-group-item">Jenis Pekerjaan : <?= $main['jenis_pekerjaan'];  ?></li>
                                <li class="list-group-item">Provider : <?= $main['provider'];  ?></li>
                                <li class="list-group-item">Asuransi : <?= $main['asuransi'];  ?></li>
                                <li class="list-group-item">No Paspor : <?= $main['no_paspor'];  ?></li>
                                <li class="list-group-item">No Identitas : <?= $main['no_identitas'];  ?></li>
                            </div>
                            <div class="col-md-6">
                                <li class="list-group-item">NPU : <?= $main['no_pasti_umrah'];  ?></li>
                                <li class="list-group-item">Rekening Penampung : <?= $main['rekening_penampung'];  ?></li>
                                <li class="list-group-item">Status Bayar : <span class="badge badge-pill badge-primary"><?= $main['status_bayar'];  ?></span></li>
                                <li class="list-group-item">Nomor Polis : <?= $main['nomor_polis'];  ?></li>
                                <li class="list-group-item">Tanggal Input Polis : <?= $main['tgl_input'];  ?></li>
                                <li class="list-group-item">Tanggal Awal Polis : <?= $main['tgl_awal'];  ?></li>
                                <li class="list-group-item">Tanggal Akhir Polis : <?= $main['tgl_akhir'];  ?></li>
                                <li class="list-group-item">Nomor Visa : <?= $main['nomor_visa'];  ?></li>
                                <li class="list-group-item">Tanggal Awal Visa : <?= $main['tgl_awal_visa'];  ?></li>
                                <li class="list-group-item">Tanggal Akhir Visa : <?= $main['tgl_akhir_visa'];  ?></li>
                                <li class="list-group-item">Muassasah : <?= $main['muassasah'];  ?></li>
                                <li class="list-group-item">Status Vaksin : <?= $main['status_vaksin'];  ?></li>
                                <li class="list-group-item">Tanggal Vaksin : <?= $main['tgl_vaksin'];  ?></li>
                                <li class="list-group-item">Jenis Vaksin : <?= $main['jenis_vaksin'];  ?></li>
                                <li class="list-group-item">No Registrasi : <?= $main['no_registrasi'];  ?></li>
                                <?php
                                $biodata = new App\Models\BioDataModel();

                                $result_bio = $biodata->where("user_id", $main['user_id'])->first();
                                // dd($result_bio);
                                if ($result_bio) :
                                ?>
                                    <li class="list-group-item">Dokumen KTP :
                                        <?php if ($result_bio['file_ktp']) : ?>
                                            <a href="<?= base_url("assets/upload/" . $result_bio['file_ktp']); ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
                                        <?php endif; ?>
                                    </li>
                                    <li class="list-group-item">Dokumen Kartu Keluarga :
                                        <?php if ($result_bio['file_kk']) : ?>
                                            <a download="" href="<?= base_url("assets/upload/" . $result_bio['file_kk']); ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
                                        <?php endif; ?>
                                    </li>
                                    <li class="list-group-item">Dokumen Paspor :
                                        <?php if ($result_bio['file_paspor']) : ?>
                                            <a download="" href="<?= base_url("assets/upload/" . $result_bio['file_paspor']); ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
                                        <?php endif; ?>
                                    </li>
                                    <li class="list-group-item">Dokumen Visa :
                                        <?php if ($result_bio['file_visa']) : ?>
                                            <a download="" href="<?= base_url("assets/upload/" . $result_bio['file_visa']); ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
                                        <?php endif; ?>
                                    </li>
                                    <li class="list-group-item">Sertifikat Vaksin :
                                        <?php if ($result_bio['file_sertifikat_vaksin']) : ?>
                                            <a download="" href="<?= base_url("assets/upload/" . $result_bio['file_sertifikat_vaksin']); ?>" class="btn btn-success"><i class="fas fa-download"></i></a>
                                    </li>
                                <?php endif; ?>
                            <?php endif; ?>
                            <li class="list-group-item">
                                Foto
                                <div class="wrapper" style="width: 100px;height:100px">
                                    <img src="<?= base_url("assets/upload/" . $main['foto']);  ?>" alt="" style="width: 100%;height:100%;object-fit: cover">
                                </div>
                            </li>
                            </div>
                        </div>

                    </ul>
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