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
        section {
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 10px;
            display: grid;
            grid-template-columns: repeat(4,1fr);
            gap: 30px;
            font-family: Arial, Helvetica, sans-serif;
            text-transform: uppercase;
            color: white;
        }

        .head {
            text-align: center;
            font-weight: bold;
            
        }

        .wrapper {
            width: 80px;
            height: 80px;
        }

        
        .wrapper img {
            border-radius: 50%;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
</head>
<body>
   <section>
    <?php foreach($jamaah as  $row) : ?>
        <div class="row_1">
            <div class="card">
                <div class="card-body bg-success">
                    <div class="head ">
                        <p><small>Kartu Jamaah Umrah</small></p>
                        <center>
                        <div class="wrapper">
                            <img src="<?=  base_url("assets/upload/" . $row['foto']);  ?>" alt="">
                        </div>
                        <br>
                        <small><?=  $row['nama'];  ?></small>
                        <br>
                        <small>Kab. <?=  $row['kabupaten'];  ?></small>
                        <br>
                        <small><?=  $row['no_identitas'];  ?></small>
                    </center>
                </div>
            </div>
            </div>
        </div>
        <?php endforeach; ?>
   </section>
    <script>
        window.print();
    </script>
</body>
</html>