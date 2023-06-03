
<?= $this->extend("company/layout/index"); ?>

<?= $this->section("isi"); ?>
      <style>
            .pagination {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.pagination li {
    display: inline-block;
    padding: 8px 16px;
    background-color: #f2f2f2;
    color: #333;
    border-radius: 4px;
    margin-right: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.pagination li:hover {
    background-color: #ddd;
}

.pagination li.active {
    background-color: #007bff;
    color: white !important;
}

      </style>
<div class="container-xxl py-5">
    <div class="container">
      
        <div class="row g-4">
            <?php $hari = date("Y-m-d");
            foreach ($paket as $rows) : ?>
                <?php if ($hari <= $rows['tgl_pulang']) : ?>
                    <?php
                    $counts = $jamaah->where("paket_id", $rows['id'])->where('kloter_id IS NOT NULL')->findAll();
                    $mains = count($counts);
                    $id_profile = $rows['travel_id'];
                    $profile = $db->query("SELECT * FROM profile WHERE id = '$id_profile'")->getRowArray();
                    ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="<?= base_url("assets/upload/" . $rows['poster']) ?>" alt="">
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex flex-column position-static">
                                    <strong class="d-inline-block mb-2 "><?= $rows['nama'];  ?></strong>
                                    <small class="mb-2"><i class="fa-solid fa-calendar " style="padding-right: 5px"></i> <?= date("d, F Y", strtotime($rows['tgl_berangkat'])) . ' - ' . date("d, F Y", strtotime($rows['tgl_pulang']));  ?></small>
                                    <small class="mb-2"><i class="fa-solid fa-location-dot" style="padding-right: 8px"></i> <?= $profile['provinsi'] ?>, <?= $profile['kabupaten'] ?></small>
                                    <small class="mb-2"><i class="fa-solid fa-building" style="padding-right: 8px"></i> <?= $profile['nama_perusahaan'] ?></small>
                                    <small class="mb-2"><i class="fa-solid fa-home" style="padding-right: 5px"></i> <?= $profile['nama_travel_umrah'] ?></small>
                                    <small class="mb-2"><i class="fa-solid fa-money-bill" style="padding-right: 5px"></i> Rp. <?= number_format($rows['biaya'], 0);  ?></small>
                                    <small class="mb-2"><i class="fas fa-users" style="padding-right: 5px"></i> <?= $mains;  ?> Orang</small>
                            </div>
                            <div class="d-flex justify-content-between" style="align-items: center;">
                                <a class="btn btn-sm btn-dark rounded py-2 px-4" target="_blank" href="<?= base_url("detail_paket_users/" . $rows['id']) ?>">Daftar</a>
                                <small>Tahun <?= $rows['tahun']; ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<div class="pagination">
    <?= $pagination ?>
</div>
        <?= $this->endSection(); ?>