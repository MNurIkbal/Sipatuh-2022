<?= $this->extend("company/layout/index"); ?>

<?= $this->section("isi"); ?>



        <!-- Contact Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                    <h1 class="mb-5"><span class="text-primary ">Hubungi </span> Kami</h1>
                </div>
                <div class="row g-4">
                    <div class="col-12">
                        <div class="row gy-4">
                            <div class="col-md-4">
                                <h6 class="section-title text-start text-primary text-uppercase">Email</h6>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i><?= $profile['email']; ?></p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="section-title text-start text-primary text-uppercase">WhatsApp</h6>
                                <p><i class="fa fa-envelope-open text-primary me-2"></i><?= $profile['no_hp']; ?></p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="section-title text-start text-primary text-uppercase">Instagram</h6>
                                <p><i class="fas fa-envelope-open  text-primary me-2"></i><?= $check['instagram'] ?></p>
                            </div>
                        </div>
                    </div>
                    <?php  if(session()->get('success')) : ?>
                        <div class="alert alert-success">
                            <?= session()->get('success'); ?>
                        </div>
                        <?php endif; ?>
                    <div class="col-md-6 wow fadeIn" data-wow-delay="0.1s">
                        <!-- <iframe class="position-relative rounded w-100 h-100"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3001156.4288297426!2d-78.01371936852176!3d42.72876761954724!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4ccc4bf0f123a5a9%3A0xddcfc6c1de189567!2sNew%20York%2C%20USA!5e0!3m2!1sen!2sbd!4v1603794290143!5m2!1sen!2sbd"
                            frameborder="0" style="min-height: 350px; border:0;" allowfullscreen="" aria-hidden="false"
                            tabindex="0"></iframe> -->
                                <?php if(isset($check['maps'])) : ?>
                                    <?= $check['maps']; ?>
                                    <?php else: ?>
                                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15866.427970098475!2d106.807296!3d-6.1833216!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5d2e764b12d%3A0x3d2ad6e1e0e9bcc8!2sMonumen%20Nasional!5e0!3m2!1sid!2sid!4v1685947384396!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> 
                                    <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <div class="wow fadeInUp" data-wow-delay="0.2s">
                            <form method="post" enctype="multipart/form-data" action="<?= base_url('kirim_pesan'); ?>">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="hidden" name="id" value="<?= $id; ?>">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="name" name="nama" placeholder="Nama" required>
                                            <label for="name">Nama</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <input type="text" class="form-control" id="subject" name="subjek" placeholder="Subject" required>
                                            <label for="subject">Subject</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-floating">
                                            <textarea class="form-control" placeholder="Pesan..." name="pesan" required id="message" style="height: 150px"></textarea>
                                            <label for="message">Pesan</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="btn btn-primary w-100 py-3" type="submit">Kirim Pesan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contact End -->
        <?= $this->endSection(); ?>