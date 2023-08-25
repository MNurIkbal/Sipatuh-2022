<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Paket Umrah</h4>
                        <a href="<?= base_url('tambah_pakets') ?>" class="btn btn-primary"  title="Tambah">Tambah</a>

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
                                        <th>Status</th>
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
                                        $pendaftaran = $db->query("SELECT * FROM jamaah WHERE paket_id = '$paket_id' AND kloter_id IS NOT NULL")->getResult();
                                        $setor_awal = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'cicil' AND paket_id = '$paket_id' AND kloter_id IS NOT NULL")->getResult();
                                        $lunas = $db->query("SELECT * FROM jamaah WHERE status_bayar = 'lunas' AND paket_id = '$paket_id' AND kloter_id IS NOT NULL")->getResult();
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
                                                <span style="text-transform: uppercase">
                                                     <?php if ($row['status'] != null) : ?>
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
                                                    <a href="<?= base_url('show_update/' . $row['id']); ?>" class="btn btn-success" ><i class="fa fa-pen"></i></a>
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
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script type="text/javascript">


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