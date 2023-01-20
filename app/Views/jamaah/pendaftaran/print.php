<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Data Jamaah</title>
    <link rel="stylesheet" href="<?= base_url("assets/modules/bootstrap/css/bootstrap.min.css") ?>">
  <link rel="stylesheet" href="<?=  base_url("assets/modules/fontawesome/css/all.min.css");  ?>">
    <style>
        header {
            display: grid;
            grid-template-columns: repeat(1,350px) repeat(1,1fr) repeat(1,350px);
            gap: 20px;
            margin-top: 30px;
        }

        .wrapper {
            width: 100px;
            height: 80px;
        }

        .logo {
            display: flex !important;
            justify-content: center !important;
            align-content: center !important;
        }

        .wrapper img  {
            width: 100%;
            height: 100%;
            /* object-fit: cover; */
        }

        .text-center {
            text-align: center !important;
        }

        section {
            margin-left: 30px;
            margin-right: 30px;
            margin-top: 50px;
            display: grid;
            grid-template-columns: repeat(3,1fr);
            gap: 30px;
        }

        .containers {
            margin-left: 30px;
            margin-top: 30px;
            margin-right: 30px;
        }
    </style>
</head>
<body>
    <header>
        <div class="row_1 logo">
            <div class="wrapper">
                <img src="<?=  base_url("assets/upload/logo.png");  ?>" alt="">
            </div>
        </div>
        <div class="row_1 text-center">
        <p><?=  $profile['nama_perusahaan'];  ?></p>
        <span>PPIU : <?=  $profile['no_sk'];  ?></span>
        <p>
            <small><i class="fas fa-phone"></i> <?=  $profile['no_hp'];  ?>   </small>
            <small style="margin-left: 10px;"><i class="fas fa-envelope"></i> <?=  $profile['email'];  ?>   </small>
        </p>
        </div>
        <div class="row_1 logo">
            <div class="wrapper">
                <img src="<?=  base_url("assets/upload/logo_2.jpeg");  ?>" alt="">
            </div>
        </div>
    </header>
    <hr>
    <section>
        <div class="row_1">
            <small>Nama Paket : <?=  $paket['nama'];  ?></small>
            <br>
            <small>Periode : <?=  date("d, F Y",strtotime($paket['tgl_berangkat']));  ?> - <?=  date("d, F Y",strtotime($paket['tgl_pulang']));  ?></small>
        </div>
        <div class="row_1">
            <small>Akun</small>
            <br>
            <small><?=  $profile['no_telp'];  ?></small>
            <br>
            <small><?=  $profile['no_hp'];  ?>/<?=  $profile['email'];  ?></small>
        </div>
        <div class="row_1">
            <small>Kode Paket : <?=  $paket['kode_paket'];  ?></small>
        </div>
    </section>
    <div class="containers">
        <table class="table table-hover table-border">
            <thead>
                <tr>
                    <th><small>Nama</small></th>
                    <th><small>Identitas</small></th>
                    <th><small>Registrasi</small></th>
                    <th><small>Pembayaran</small></th>
                    <th><small>Info</small></th>
                </tr>
            </thead>
            <tbody>
                <?php  foreach($jamaah as $row) : ?>
                    <tr>
                        <td>
                            <small>
                            <?=  $row['nama'];  ?>
                            </small>
                            </td>
                        <td>
                            <small>Nik : <?=  $row['no_identitas'];  ?></small>
                            <br>
                            <small>No Telp : <?=  $row['no_telp'];  ?></small>
                            <br>
                            <small>No Hp : <?=  $row['no_hp'];  ?></small>
                            </td>
                        <td>
                            <small>No Reg : 298</small>
                            <br>
                            <small>No NPU : <?=  $row['no_pasti_umrah'];  ?></small>
                            </td>
                        <td>
                            <small>Total :</small>
                            <br>
                            <small>Bank : </small>
                            <br>
                            <small>Asuransi : <?=  $row['asuransi'];  ?></small>
                            </td>
                        <td>
                            <small>Polis : <?=  $row['nomor_polis'];  ?></small>
                            <br>
                            <small>Visa : <?=  $row['nomor_visa'];  ?></small>
                            <br>
                            <small>Paspor : <?=  $row['no_paspor'];  ?></small>
                            </td>
                        </tr>
                        <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>