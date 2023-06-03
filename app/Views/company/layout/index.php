<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $profile['nama_perusahaan'] . ' | ' .  $profile['nama_travel_umrah']; ?></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
    <link rel="icon" href="<?= base_url("assets/upload/" . $check['logo']); ?>">

    <!-- Favicon -->
    <!-- <link href="img/favicon.ico" rel="icon"> -->

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet --><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="<?= base_url("company/lib/animate/animate.min.css"); ?>" rel="stylesheet">
    <link href="<?= base_url('company/lib/owlcarousel/assets/owl.carousel.min.css'); ?>" rel="stylesheet">
    <link href="<?= base_url('company/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css'); ?>" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?= base_url('company/css/bootstrap.min.css'); ?>" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="<?= base_url('company/css/style.css'); ?>" rel="stylesheet">
</head>

<body>
    <div class="bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Header Start -->
        <div class="container-fluid bg-dark px-0    " >
            <div class="row gx-0">
                <div class="col-lg-3 bg-dark d-none d-lg-block">
                    <a href="index.html" class="navbar-brand w-100 h-100 m-0 p-0 d-flex align-items-center justify-content-center">
                        <div style="width: 100px;height: 100px;">
                            <img src="<?= base_url("assets/upload/" . $check['logo']); ?>" alt="" style="width: 100%;height: 100%;object-fit: fill;">
                        </div>
                    </a>
                </div>
                <div class="col-lg-9">
                    <div class="row gx-0 bg-white d-none d-lg-flex">
                        <div class="col-lg-7 px-5 text-start">
                            <div class="h-100 d-inline-flex align-items-center py-2 me-4">
                                <i class="fa fa-envelope text-primary me-2"></i>
                                <p class="mb-0"><?= $profile['email']; ?></p>
                            </div>
                            <div class="h-100 d-inline-flex align-items-center py-2">
                                <i class="fa fa-phone-alt text-primary me-2"></i>
                                <p class="mb-0"><?= $profile['no_telp']; ?></p>
                            </div>
                        </div>
                        <div class="col-lg-5 px-5 text-end">
                            <div class="d-inline-flex align-items-center py-2">
                                <a class="me-3" href="<?= $check['facebook']; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                <a class="me-3" href="<?= $check['twitter']; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                                <a class="me-3" href="<?= $check['instagram']; ?>" target="_blank"><i class="fab fa-instagram"></i></a>
                                <a class="" href="<?= $check['youtube']; ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark p-3 p-lg-0">
                        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto py-0">
                                <a href="<?= base_url("company/" . $profile['website']); ?>" class="nav-item nav-link  <?php if($title == "Beranda") { echo "active";} else { echo ""; } ?>">Beranda</a>
                                <a href="<?= base_url("profile_company/" . $profile['website']); ?>" class="nav-item nav-link  <?php if($title == "Profile") { echo "active";} else { echo ""; } ?>">Profil</a>
                                <a href="<?= base_url("artikel_company/" . $profile['website']); ?>" class="nav-item nav-link   <?php if($title == "Artikel") { echo "active";} else { echo ""; } ?>">Artikel</a>
                                <a href="<?= base_url("paket_company/" . $profile['website']); ?>" class="nav-item nav-link <?= ($title == "Paket") ? "active" : ""; ?>">Paket</a>
                                <a href="<?= base_url("foto_company/" . $profile['website']); ?>" class="nav-item nav-link <?= ($title == "Galeri") ? "active" : ""; ?>">Galeri</a>
                                <a href="<?= base_url("kontak_company/" . $profile['website']); ?>" class="nav-item nav-link <?= ($title == "Kontak") ? "active" : ""; ?>">Kontak</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Header End -->
        <?= $this->renderSection("isi");  ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <!-- Footer Start -->
        <div class="container-fluid bg-dark text-light footer wow fadeIn" data-wow-delay="0.1s">
            <div class="container pb-5">
                <div class="row g-5">
                    <div class="col-md-6 col-lg-4">
                        <div class="bg-primary rounded p-4">
                            <div class="d-flex" style="justify-content: center;">
                            <div style="width: 150px;height: 150px;">
                                <img src="<?= base_url("assets/upload/" . $check['logo']); ?>" alt="" style="width: 100%;height: 100%;">
                            </div>
                            </div>
                            <p class="text-white mb-0">
                                <?= $check['deskripsi_footer']; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <h6 class="section-title text-start text-primary text-uppercase mb-4">Contact</h6>
                        <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i><?= $profile['alamat'] . ',' . $profile['kabupaten'] ?></p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-3"></i><?= $profile['no_telp']; ?></p>
                        <p class="mb-2"><i class="fa fa-envelope me-3"></i><?= $profile['email']; ?></p>
                        <div class="d-flex pt-2">
                            <a class="btn btn-outline-light btn-social" href="<?= $check['twitter']; ?>" target="_blank"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-outline-light btn-social" href="<?= $check['facebook']; ?>" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-outline-light btn-social" href="<?= $check['youtube']; ?>" target="_blank"><i class="fab fa-youtube"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-12">
                        <div class="row gy-5 g-4">
                            <div class="col-md-6">
                                <h6 class="section-title text-start text-primary text-uppercase mb-4">Travel</h6>
                                <a class="btn btn-link" href="#">Beranda</a>
                                <a class="btn btn-link" href="#">Profil</a>
                                <a class="btn btn-link" href="#">Artikel</a>
                                <a class="btn btn-link" href="#">Paket</a>
                                <a class="btn btn-link" href="#">Galeri Foto</a>
                                <a class="btn btn-link" href="#">Galeri Video</a>
                                <a class="btn btn-link" href="#">Kontak</a>
                            </div>
                            <div class="col-md-6">
                                <h6 class="section-title text-start text-primary text-uppercase mb-4">Layanan</h6>
                                <a class="btn btn-link" href="#">Haji</a>
                                <a class="btn btn-link" href="#">Umrah</a>
                                <a class="btn btn-link" href="#">Penerbangan</a>
                                <a class="btn btn-link" href="#">Hotel</a>
                                <a class="btn btn-link" href="#">Paspor</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="copyright">
                    <div class="row">
                        <div class="d-flex" style="justify-content: center;">
                            &copy; <?= $profile['nama_travel_umrah'] .  ' ' . date("Y"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('company/lib/wow/wow.min.js'); ?>"></script>
    <script src="<?= base_url('company/lib/easing/easing.min.js'); ?>"></script>
    <script src="<?= base_url('company/lib/waypoints/waypoints.min.js'); ?>"></script>
    <script src="<?= base_url('company/lib/counterup/counterup.min.js'); ?>"></script>
    <script src="<?= base_url('company/lib/owlcarousel/owl.carousel.min.js'); ?>"></script>
    <script src="<?= base_url('company/lib/tempusdominus/js/moment.min.js'); ?>"></script>
    <script src="<?= base_url('company/lib/tempusdominus/js/moment-timezone.min.js'); ?>"></script>
    <script src="<?= base_url('company/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js'); ?>"></script>

    <!-- Template Javascript -->
    <script src="<?= base_url('company/js/main.js'); ?>"></script>
</body>

</html>