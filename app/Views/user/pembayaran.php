<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<div class="main-content">
  <section class="section">
    <div class="card">
      <div class="card-header">
        <h4 style="text-transform: uppercase">Pembayaran</h4>
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
                        <?php if($main['status_bayar'] == "cicil" && $main['sisa_pembayaran'] > 0 && $main['status_bayar']) : ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h4>Pembayaran 1</h4>
                                        </div>
                                        <div class="card-body">
                                            <span>Rekening Penampung : <?=  $main['rekening_penampung'];  ?></span>
                                            <br>
                                            <span>Nominal : Rp. <?=  number_format($main['nominal_pembayaran'],0);  ?></span>
                                            <br>
                                            <span>Bukti : <a href="<?=  base_url("assets/upload/" . $main['bukti_pembayaran']);  ?>" download="" class="btn btn-success">Download</a></span>
                                            <br>
                                            <span>Keterangan : <?=  $main['keterangan_bayar'];  ?></span>
                                        </div>
                                    </div>
                                </div>
                                <?php 

                                $data_jamaah_bukti = $bukti->where("jamaah_id",$id)->where("paket_id",$id_paket)->where("kloter_id",$id_kloter)->findAll();
                            $no = 2;
                            
                            foreach($data_jamaah_bukti as $rows) :
                                ?>
                            <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h4>Pembayaran <?=  $no++;  ?></h4>
                                        </div>
                                        <div class="card-body">
                                            <span>Rekening Penampung : <?=  $rows['rekening_penampung'];  ?></span>
                                            <br>
                                            <span>Nominal : Rp. <?=  number_format($rows['nominal'],0);  ?></span>
                                            <br>
                                            <!-- <span>Sisa : Rp. <?=  number_format($rows['sisa'],0);  ?></span> -->
                                            <!-- <br> -->
                                            <span>Bukti : <a href="<?=  base_url("assets/upload/" . $rows['bukti']);  ?>" download="" class="btn btn-success">Download</a></span>
                                            <br>
                                            <span>Keterangan : <?=  $rows['keterangan'];  ?></span>
                                            <br>
                                            <span>Dibuat : <?=  $rows['created'];  ?></span>
                                            <!-- <ul class="list-group">
                                                <li class="list-group-item">rhdsk</li>
                                            </ul> -->
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </div>
                            <h4>Form Pembayaran Cicil</h4>
                            <form method="POST" enctype="multipart/form-data" action="<?=  base_url("bayar_cicil/" . session()->get("jamaah_id"));  ?>"
                            >
                            <input type="hidden" name="id_paket" value="<?=  $id_paket;  ?>">
                            <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
                            <div>
                                <div class="mb-1">
                                    <label for="">Rekening Penampung : </label>
                                    <input type="text" required readonly value="<?=  $main['rekening_penampung'];  ?>" class="form-control" name="rekening">
                                    <!-- <select name="rekening" class="form-control" required autocomplete="off" id="">
                                        <option value="">Pilih</option>
                                        <?php foreach($bank as $banks) : ?>
                                        <option value="<?=  $banks['no_rekening']  ?>"
                                            <?=  ($banks['no_rekening'] == $main['rekening_penampung']) ? "selected" : "";  ?>>
                                            <?=  $banks['bank'] . ' - '.  $banks['nama'] . ' - '. $banks['no_rekening'];  ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select> -->
                                </div>
                                <div class="mb-1">
                                    <label for="">Status Pembayaran : </label>
                                    <input type="text" required readonly value="<?=  $main['status_bayar'];  ?>" class="form-control" name="status">
                                </div>
                                    <div id="container_pembayaran">
                                        <div class="mb-1">
                                            <label for="">Nominal</label>
                                            <input type="text" id="nominal" name="nominal" class="form-control" >
                                        </div>
                                        <div class="mb-1">
                                            <label for="">Biaya Pembayaran</label>
                                            <input type="text" readonly
                                                value="Rp. <?=  number_format($paket['biaya'],0);  ?>"
                                                class="form-control">
                                        </div>
                                        <div class="mb-1">
                                            <label for="">Sisa Pembayaran</label>
                                            <input type="text" readonly
                                                value="Rp. <?=  number_format($main['sisa_pembayaran'],0);  ?>"
                                                class="form-control">
                                        </div>
                                        <div class="mb-1">
                                            <input type="hidden" name="file_lama"
                                                value="<?=  $main['bukti_pembayaran'];  ?>">
                                            <label for="">Bukti Pembayaran</label>
                                            <input type="file" name="file" class="form-control">
                                        </div>
                                    </div>

                                <div class="mb-1">
                                    <label for="">Keterangan : </label>
                                    <textarea name="keterangan" class="form-control" required id="" cols="30" rows="10"
                                        placeholder="Keterangan"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                        <?php elseif($main['status_bayar'] == "lunas") : ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h4>Pembayaran 1</h4>
                                        </div>
                                        <div class="card-body">
                                            <span>Rekening Penampung : <?=  $main['rekening_penampung'];  ?></span>
                                            <br>
                                            <!-- <span>Status : <?=  $main['status_bayar'];  ?></span>
                                            <br> -->
                                            <span>Nominal : Rp. <?=  number_format($main['nominal_pembayaran'],0);  ?></span>
                                            <br>
                                            <!-- <span>Sisa : Rp. <?=  number_format($main['sisa_pembayaran'],0);  ?></span> -->
                                            <!-- <br> -->
                                            <span>Bukti : <a href="<?=  base_url("assets/upload/" . $main['bukti_pembayaran']);  ?>" download="" class="btn btn-success">Download</a></span>
                                            <br>
                                            <span>Keterangan : <?=  $main['keterangan_bayar'];  ?></span>
                                            <!-- <ul class="list-group">
                                                <li class="list-group-item">rhdsk</li>
                                            </ul> -->
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                
                            $data_jamaah_bukti = $bukti->where("jamaah_id",$id)->where("paket_id",$id_paket)->where("kloter_id",$id_kloter)->findAll();
                            $no = 2;
                            
                            foreach($data_jamaah_bukti as $rows) :
                            ?>
                            <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header bg-success text-white">
                                            <h4>Pembayaran <?=  $no++;  ?></h4>
                                        </div>
                                        <div class="card-body">
                                            <span>Rekening Penampung : <?=  $rows['rekening_penampung'];  ?></span>
                                            <br>
                                            <span>Nominal : Rp. <?=  number_format($rows['nominal'],0);  ?></span>
                                            <br>
                                            <!-- <span>Sisa : Rp. <?=  number_format($rows['sisa'],0);  ?></span> -->
                                            <!-- <br> -->
                                            <span>Bukti : <a href="<?=  base_url("assets/upload/" . $rows['bukti']);  ?>" download="" class="btn btn-success">Download</a></span>
                                            <br>
                                            <span>Keterangan : <?=  $rows['keterangan'];  ?></span>
                                            <br>
                                            <span>Dibuat : <?=  $rows['created'];  ?></span>
                                            <!-- <ul class="list-group">
                                                <li class="list-group-item">rhdsk</li>
                                            </ul> -->
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </div>
                            <?php else: ?>
                                <form method="POST" enctype="multipart/form-data" action="<?=  base_url("bayar/" . $id);  ?>"
                            >
                            <input type="hidden" name="id_paket" value="<?=  $id_paket;  ?>">
                            <input type="hidden" name="id_kloter" value="<?=  $id_kloter;  ?>">
                            <div>
                                <div class="mb-1">
                                    <label for="">Rekening Penampung : </label>
                                    <select name="rekening" class="form-control" required autocomplete="off" id="">
                                        <option value="">Pilih</option>
                                        <?php foreach($bank as $banks) : ?>
                                        <option value="<?=  $banks['no_rekening']  ?>"
                                            <?=  ($banks['no_rekening'] == $main['rekening_penampung']) ? "selected" : "";  ?>>
                                            <?=  $banks['bank'] . ' - '.  $banks['nama'] . ' - '. $banks['no_rekening'];  ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="">Status Pembayaran : </label>
                                    <select name="status" class="form-control" required
                                        id="pembayaran_baru" onchange="pembayaran()">
                                        <option value="">Pilih</option>
                                        <option value="belum"
                                            <?=  ($main['status_bayar'] == "belum") ? "selected" : "";  ?>>Belum Bayar
                                        </option>
                                        <option value="cicil"
                                            <?=  ($main['status_bayar'] == "cicil") ? "selected" : "";  ?>>Cicil
                                        </option>
                                        <option value="lunas"
                                            <?=  ($main['status_bayar'] == "lunas") ? "selected" : "";  ?>>Lunas
                                        </option>
                                    </select>
                                </div>
                                    <div id="container_pembayaran">
                                        <div class="mb-1">
                                            <label for="">Nominal</label>
                                            <input type="text" id="nominal" name="nominal" class="form-control" value="<?=  $main['nominal_pembayaran'];  ?>">
                                        </div>
                                        <div class="mb-1">
                                            <label for="">Biaya Pembayaran</label>
                                            <input type="text" readonly
                                                value="Rp. <?=  number_format($paket['biaya'],0);  ?>"
                                                class="form-control">
                                        </div>
                                        <div class="mb-1">
                                            <label for="">Sisa Pembayaran</label>
                                            <input type="text" readonly
                                                class="form-control">
                                        </div>
                                        <div class="mb-1">
                                            <input type="hidden" name="file_lama"
                                                value="<?=  $main['bukti_pembayaran'];  ?>">
                                            <label for="">Bukti Pembayaran</label>
                                            <input type="file" name="file" class="form-control">
                                        </div>
                                    </div>

                                <div class="mb-1">
                                    <label for="">Keterangan : </label>
                                    <textarea name="keterangan" class="form-control" required id="" cols="30" rows="10"
                                        placeholder="Keterangan"><?=  $main['keterangan_bayar'];  ?></textarea>
                                </div>
                            </div>
                            <div class="modal-footer bg-whitesmoke br">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                            <?php endif; ?>
                    </div>
      </div>
    </div>

  </section>
</div>
<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
<script>
    <?php if($main['status_bayar'] == "lunas" || $main['status_bayar'] == "cicil") : ?>
        $("#container_pembayaran").show();
        <?php else: ?>
            $("#container_pembayaran").hide();
        <?php endif; ?>
            function pembayaran()
            {
                let variablea   = $("#pembayaran_baru").val()
                if(variablea == "lunas" || variablea == "cicil") {
                    $("#container_pembayaran").show();
                } else {
                    $("#container_pembayaran").hide();
                }
            }
            
    var uang_baru = document.getElementById("nominal");
    uang_baru.addEventListener("keyup", function (e) {
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


<?= $this->endSection(); ?>