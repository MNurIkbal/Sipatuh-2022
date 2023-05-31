<?= $this->extend("company/layout/index"); ?>

<?= $this->section("isi"); ?>


<div class="container mt-5 mb-5">
    <?php foreach ($berita as $rom) : ?>
        <div href="" style="color: black;">
            <div class="row p-4">
                <div class="col-md-6">
                    <img src="<?= base_url('company/img/' . $rom['img']); ?>" alt="" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h4>Judul</h4>
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

                    <a href="" class="btn btn-primary">Read More</a>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- Tampilkan tautan navigasi pagination menggunakan renderer kustom -->
<div class="pagination">
    <?= $pager->links('group', new \App\Pager\CustomRenderer()) ?>
</div>

</div>
<?= $this->endSection(); ?>