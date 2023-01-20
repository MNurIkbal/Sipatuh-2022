<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Nama Paspor</th>
                <th>Ayah</th>
                <th>Jenis Identitas</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Provinsi</th>
                <th>Kabupaten</th>
                <th>Kecamatan</th>
                <th>Kelurahan</th>
                <th>No Telphone</th>
                <th>No Hanphone</th>
                <th>Kewarganegaraan</th>
                <th>Status Pernikahan</th>
                <th>Jenis Pendidikan</th>
                <th>Jenis Pekerjaan</th>
                <th>Provider</th>
                <th>Asuransi</th>
                <th>No Paspor</th>
                <th>No Identitas</th>
                <th>No Pasti Umrah</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach($jamaah as $row) : ?>
                <tr>
                    <td><?=  $no++;  ?></td>
                    <td><?=  $row['nama'];  ?></td>
                    <td><?=  $row['nama_paspor'];  ?></td>
                    <td><?=  $row['ayah'];  ?></td>
                    <td><?=  $row['jenis_identitas'];  ?></td>
                    <td><?=  $row['tempat_lahir'];  ?></td>
                    <td><?=  $row['tgl_lahir'];  ?></td>
                    <td><?=  $row['alamat'];  ?></td>
                    <td><?=  $row['provinsi'];  ?></td>
                    <td><?=  $row['kabupaten'];  ?></td>
                    <td><?=  $row['kecamatan'];  ?></td>
                    <td><?=  $row['kelurahan'];  ?></td>
                    <td><?=  $row['no_telp'];  ?></td>
                    <td><?=  $row['no_hp'];  ?></td>
                    <td><?=  $row['kewargannegaraan'];  ?></td>
                    <td><?=  $row['status_pernikahan'];  ?></td>
                    <td><?=  $row['jenis_pendidikan'];  ?></td>
                    <td><?=  $row['jenis_pekerjaan'];  ?></td>
                    <td><?=  $row['provider'];  ?></td>
                    <td><?=  $row['asuransi'];  ?></td>
                    <td><?=  $row['no_paspor'];  ?></td>
                    <td><?=  $row['no_identitas'];  ?></td>
                    <td><?=  $row['no_pasti_umrah'];  ?></td>
                </tr>
                <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
<?php header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=hasil.xls"); 


?>
<script>
    function main()
    {
        var id = "<?= $id ?>";
        window.location.href = "tambah_pendaftaran/" + id;
    }

    setTimeout(main,3000);
</script> 