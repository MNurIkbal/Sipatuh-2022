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

    @media screen and (max-width:770px) {
        .os {
            margin-top: 30px;
        }
    }
</style>

<div class="container mt-5 mb-5">
    <?php foreach ($berita as $rom) : ?>
        <div href="" style="color: black;">
            <div class="row p-4">
                <div class="col-md-6">
                    <img src="<?= base_url('company/img/' . $rom['img']); ?>" alt="" class="img-fluid">
                </div>
                <div class="col-md-6 os">
                    <h4><?= $rom['title']; ?></h4>
                    <div class="d-flex mb-3 mt-3">
                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            <?= $rom['lokasi']; ?>
                        </span>
                        <span style="margin-left: 20px;">
                            <i class="fa-solid fa-calendar"></i>
                            <?= date("d, F Y", strtotime($rom['created_at'])); ?>
                        </span>
                        <span style="margin-left: 20px;">
                            <i class="fa-solid fa-calendar"></i>
                            <?= number_format($rom['lihat']); ?> Views
                        </span>
                    </div>
                    <p>
                        <?php
                        if (strlen($rom['pesan']) > 500) {
                            $pesan = substr($rom['pesan'], 0, 500) . "...";
                        } else {
                            $pesan = $rom['pesan'];
                        }
                        ?>
                        <?= $pesan ?>
                    </p>

                    <a href="<?= base_url('detail_artikel/' . $rom['id'] . '/' . $company); ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <div class="pagination">
    <?= $pagination ?>
</div>
</div>
<?= $this->endSection(); ?>