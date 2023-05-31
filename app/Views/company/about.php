<?= $this->extend("company/layout/index"); ?>

<?= $this->section("isi"); ?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-6 ">
            <?= $check['text_profile']; ?>
        </div>
        
        <div class="col-md-6 ">
            <div class="wrapper" >
                <img src="<?= base_url('company/img/' . $check['img_profile']); ?>" alt="" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="mt-5">
        <div class="row">
            <h3>Visi</h3>
            <p>
                <?= $check['visi']; ?>
            </p>
        </div>
        <div class="row">
            <h3>Misi</h3>
            <p>
                <?= $check['misi']; ?>
            </p>
        </div>
    </div>
</div>


     
        
        <?= $this->endSection(); ?>