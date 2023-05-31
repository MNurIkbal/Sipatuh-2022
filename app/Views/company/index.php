<?= $this->extend("company/layout/index"); ?>

<?= $this->section("isi"); ?>

<!-- Carousel Start -->
<?php if ($slider) : ?>
    <div class="container-fluid p-0 mb-5">
        <div id="header-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($slider as $slid) : ?>
                    <div class="carousel-item  <?= ($slid->status == 1) ? 'active' : ''; ?>">
                        <img class="w-100" src="<?= base_url("assets/upload/$slid->img"); ?>" alt="Image">
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
<?php endif; ?>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <h6 class="section-title text-start text-primary text-uppercase">About Us</h6>
                <p class="mb-4"><?= $check['deskripsi_about']; ?></p>
                <div class="row g-3 pb-4">
                    <div class="col-sm-4 wow fadeIn" data-wow-delay="0.1s">
                        <div class="border rounded p-1">
                            <div class="border rounded text-center p-4">
                                <i class="fa fa-book fa-2x text-primary mb-2"></i>
                                <h2 class="mb-1" data-toggle="counter-up"><?= $count_paket; ?></h2>
                                <p class="mb-0">Paket</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 wow fadeIn" data-wow-delay="0.3s">
                        <div class="border rounded p-1">
                            <div class="border rounded text-center p-4">
                                <i class="fas fa-home  fa-2x text-primary mb-2"></i>
                                <h2 class="mb-1" data-toggle="counter-up"><?= $count_cabang; ?></h2>
                                <p class="mb-0">Cabang</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 wow fadeIn" data-wow-delay="0.5s">
                        <div class="border rounded p-1">
                            <div class="border rounded text-center p-4">
                                <i class="fa fa-users fa-2x text-primary mb-2"></i>
                                <h2 class="mb-1" data-toggle="counter-up"><?= $count_jamaah; ?></h2>
                                <p class="mb-0">Jamaah</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.1s" src="<?= base_url("company/img/" . $check['img_about_1']); ?>" style="margin-top: 25%;">
                    </div>
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-100 wow zoomIn" data-wow-delay="0.3s" src="<?= base_url("company/img/" . $check['img_about_2']); ?>">
                    </div>
                    <div class="col-6 text-end">
                        <img class="img-fluid rounded w-50 wow zoomIn" data-wow-delay="0.5s" src="<?= base_url("company/img/" . $check['img_about_3']); ?>">
                    </div>
                    <div class="col-6 text-start">
                        <img class="img-fluid rounded w-75 wow zoomIn" data-wow-delay="0.7s" src="<?= base_url("company/img/" . $check['img_about_4']); ?>">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- About End -->


<!-- Room Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5">Layanan <span class="text-primary text-uppercase">Paket</span></h1>
        </div>
        <div class="row g-4">
            <?php $hari = date("Y-m-d");
            foreach ($paket as $rows) : ?>
                <?php if ($hari <= $rows->tgl_pulang) : ?>
                    <?php
                    $counts = $jamaah->where("paket_id", $rows->id)->where('kloter_id IS NOT NULL')->findAll();
                    $mains = count($counts);
                    $id_profile = $rows->travel_id;
                    $profile = $db->query("SELECT * FROM profile WHERE id = '$id_profile'")->getRowArray();
                    ?>
                    <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="room-item shadow rounded overflow-hidden">
                            <div class="position-relative">
                                <img class="img-fluid" src="<?= base_url("assets/upload/" . $rows->poster) ?>" alt="">
                            </div>
                            <div class="p-4 mt-2">
                                <div class="d-flex flex-column position-static">
                                    <strong class="d-inline-block mb-2 "><?= $rows->nama;  ?></strong>
                                    <small class="mb-2"><i class="fa-solid fa-calendar " style="padding-right: 5px"></i> <?= date("d, F Y", strtotime($rows->tgl_berangkat)) . ' - ' . date("d, F Y", strtotime($rows->tgl_pulang));  ?></small>
                                    <small class="mb-2"><i class="fa-solid fa-location-dot" style="padding-right: 8px"></i> <?= $profile['provinsi'] ?>, <?= $profile['kabupaten'] ?></small>
                                    <small class="mb-2"><i class="fa-solid fa-building" style="padding-right: 8px"></i> <?= $profile['nama_perusahaan'] ?></small>
                                    <small class="mb-2"><i class="fa-solid fa-home" style="padding-right: 5px"></i> <?= $profile['nama_travel_umrah'] ?></small>
                                    <small class="mb-2"><i class="fa-solid fa-money-bill" style="padding-right: 5px"></i> Rp. <?= number_format($rows->biaya, 0);  ?></small>
                                    <small class="mb-2"><i class="fas fa-users" style="padding-right: 5px"></i> <?= $mains;  ?> Orang</small>
                                    
                                    
                            </div>
                            <div class="d-flex justify-content-between" style="align-items: center;">
                                <a class="btn btn-sm btn-dark rounded py-2 px-4" target="_blank" href="<?= base_url("detail_paket_users/" . $rows->id) ?>">Daftar</a>
                                <small>Tahun <?= $rows->tahun; ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Room End -->


<!-- Video Start -->
<div class="container-xxl py-5 px-0 wow zoomIn" data-wow-delay="0.1s">
    <div class="row g-0">
        <div class="col-md-6 bg-dark d-flex align-items-center">
            <div class="p-5">
                <h6 class="section-title text-start text-white text-uppercase mb-3"><?= $vidio['sub_title']; ?></h6>
                <h1 class="text-white mb-4"><?= $vidio['title']; ?></h1>
                <p class="text-white mb-4"><?= $vidio['text']; ?></p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="video" style="background-image: url(<?= base_url("company/img/" . $vidio['img']) ?>);">
                <button type="button" class="btn-play" data-bs-toggle="modal" data-bs-target="#videoModal">
                    <span></span>
                </button>
            </div>
        </div>
    </div>
    
</div>

<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content rounded-0">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Youtube Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- 16:9 aspect ratio -->
                <div class="ratio ratio-16x9">
                    <iframe class="embed-responsive-item" width="560" height="315" src="https://www.youtube.com/embed/<?= $vidio['yt'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Video Start -->


<!-- Service Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="mb-5">Layanan <span class="text-primary text-uppercase">Travel</span></h1>
        </div>
        <div class="row g-4">
            <?php foreach($layanan as $duar) : ?>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item rounded">
                        <div class="service-icon bg-transparent border rounded p-1">
                            <div class="w-100 h-100 border rounded d-flex align-items-center justify-content-center">
                                <i class="<?= $duar->icon ?> fa-2x text-primary"></i>
                            </div>
                        </div>
                        <h5 class="mb-3"><?= $duar->title; ?> </h5>
                        <p class="text-body mb-0"><?= $duar->text; ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Service End -->


<!-- Testimonial Start -->
<div class="container-xxl testimonial my-5 py-5 bg-dark wow zoomIn" data-wow-delay="0.1s">
    <div class="container">
        <div class="owl-carousel testimonial-carousel py-5">
            <?php foreach($testimoni as $tiga) : ?>
                <div class="testimonial-item position-relative bg-white rounded overflow-hidden">
                    <p><?= $tiga->pesan; ?></p>
                    <div class="d-flex align-items-center">
                        <img class="img-fluid flex-shrink-0 rounded" src="<?= base_url('company/img/'. $tiga->img) ?>" style="width: 45px; height: 45px;">
                        <div class="ps-3">
                            <h6 class="fw-bold mb-1"><?= $tiga->nama; ?></h6>
                            <small><?= $tiga->profesi; ?></small>
                        </div>
                    </div>
                    <i class="fa fa-quote-right fa-3x text-primary position-absolute end-0 bottom-0 me-4 mb-n1"></i>
                </div>
                <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- Testimonial End -->

<?= $this->endSection(); ?>