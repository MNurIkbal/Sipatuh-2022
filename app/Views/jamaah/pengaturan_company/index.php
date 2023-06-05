<?= $this->extend("jamaah/layout/layout"); ?>

<?= $this->section("content"); ?>
<style>
    .play {
        width: 60px;
        height: 60px;
        background-color: #FEA116;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
    }

    .play span i {
        font-size: 25px;
        color: white;
    }
</style>
<div class="main-content">
    <section class="section">

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Pengaturan</h4>
                    </div>
                    <?php if (session()->get("success")) : ?>
                        <div class="m-3 alert alert-success">
                            <span><?= session()->get("success");  ?></span>
                        </div>
                    <?php elseif (session()->get("error")) : ?>
                        <div class="m-3 alert alert-danger">
                            <span><?= session()->get("error");  ?></span>
                        </div>
                    <?php endif; ?>
                    <style>
                        .bold {
                            font-weight: bold !important;
                        }
                    </style>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group">
                                    <li class="active list-group-item">Pengaturan Website</li>
                                    <li class="list-group-item"><span class="bold  ">Nama Website</span> : <a href="<?= base_url('company/' . $webapp['website']); ?>" target="_blank"><?= $webapp['website']; ?></a></li>
                                    <li class="list-group-item d-flex h-100" style="align-items: center;">
                                        <span class="bold ">Logo</span>
                                        <div style="width: 100px;height: 100px;">
                                            <img src="<?= base_url('assets/upload/' . $profile['logo']); ?>" alt="" style="width: 100%;height: 100%;object-fit: contain;">
                                        </div>
                                    </li>
                                    <li class="list-group-item"><span class="bold ">Visi</span> : <?= $profile['visi']; ?></li>
                                    <li class="list-group-item"><span class="bold ">Misi</span> : <?= $profile['misi']; ?></li>
                                    <li class="list-group-item"><span class="bold">Deskripsi About </span> : <?= $profile['deskripsi_about']; ?> </li>
                                    <li class="list-group-item"><span class="bold">Deskripsi Footer</span> : <?= $profile['deskripsi_footer']; ?></li>
                                    <li class="list-group-item"><span class="bold">Deskripsi Profil</span> : <?= $profile['text_profile']; ?></li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group">
                                    <li class="active list-group-item">Sosial Media </li>
                                    <li class="list-group-item">WhatsApp : <?= $webapp['no_hp']; ?></li>
                                    <li class="list-group-item">Facebook : <?= $profile['facebook']; ?></li>
                                    <li class="list-group-item">Instagram : <?= $profile['instagram']; ?></li>
                                    <li class="list-group-item">Youtube : <?= $profile['youtube']; ?></li>
                                    <li class="list-group-item">Twitter : <?= $profile['twitter']; ?></li>
                                    <li class="list-group-item">
                                        Gambar About
                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <div style="width: 250px;height: 200px;">
                                                    <img src="<?= base_url('company/img/' . $profile['img_about_1']); ?>" alt="" style="width: 100%;height: 100%;object-fit: contain;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div style="width: 250px;height: 200px;">
                                                    <img src="<?= base_url('company/img/' . $profile['img_about_2']); ?>" alt="" style="width: 100%;height: 100%;object-fit: contain;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div style="width: 250px;height: 200px;">
                                                    <img src="<?= base_url('company/img/' . $profile['img_about_3']); ?>" alt="" style="width: 100%;height: 100%;object-fit: contain;">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div style="width: 250px;height: 200px;">
                                                    <img src="<?= base_url('company/img/' . $profile['img_about_4']); ?>" alt="" style="width: 100%;height: 100%;object-fit: contain;">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        Gambar Profile
                                        <div class="row mt-4">
                                            <div style="width: 250px;height: 200px;">
                                                <img src="<?= base_url('company/img/' . $profile['img_profile']); ?>" alt="" style="width: 100%;height: 100%;object-fit: contain;">
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                <a href="" class="btn btn-primary mt-3" data-toggle="modal" data-target="#tambah">Update Pengaturan</a>
                            </div>
                        </div>
                        <br>
                        <br>
                        <br>
                        <h5>Pengaturan Video</h5>
                        <div class="row mt-4">
                            <div>
                            </div>
                            <div class="col-md-6">
                                <div>
                                    <div style="width: 100%;height: 100%;">
                                        <img src="<?= base_url('company/img/' . $video['img']); ?>" alt="" class="img-thumbnail img-fluid">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h5><?= $video['title']; ?></h5>
                                <span><?= $video['sub_title']; ?></span>
                                <br>
                                <a href="<?= $video['yt']; ?>">Link Youtube</a>
                                <p>
                                    <?= $video['text']; ?>
                                </p>
                                <a href="" class="btn btn-primary mt-3" data-toggle="modal" data-target="#video">Update Video</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="video">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="<?= base_url("update_video");  ?>" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id" value="<?= $video['id']; ?>">
                <h5 class="modal-title">Update Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="">Judul</label>
                    <input type="text" class="form-control" name="judul" required placeholder="Judul" value="<?= $video['title']; ?>">
                </div>
                <div class="mb-3">
                    <label for="">Sub Title</label>
                    <input type="text" class="form-control" name="sub" required placeholder="Sub Title" value="<?= $video['sub_title']; ?>">
                </div>
                <div class="mb-3">
                    <label for="">Gambar</label>
                    <input type="file" class="form-control" name="file" >
                    <input type="hidden" name="img_lama" value="<?= $video['img']; ?>">
                </div>
                <div class="mb-3">
                    <label for="">Link Youtube</label>
                    <input type="text" class="form-control" name="link" required placeholder="Link Youtube" value="<?= $video['yt']; ?>">
                </div>
                <div class="mb-3">
                    <label for="">Pesan</label>
                    <textarea name="pesan" class="form-control" required placeholder="Pesan" id="" style="height: 300px !important;" cols="30" rows="10"><?= $video['text']; ?></textarea>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="tambah">
    <div class="modal-dialog modal-lg" role="document">
        <form method="POST" action="<?= base_url("update_pengaturan");  ?>" enctype="multipart/form-data" class="modal-content">
            <div class="modal-header">
                <input type="hidden" name="id" value="<?= $profile['id']; ?>">
                <h5 class="modal-title">Update Pengaturan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="img_about_1_lama" value="<?= $profile['img_about_1']; ?>">
                <input type="hidden" name="img_about_2_lama" value="<?= $profile['img_about_2']; ?>">
                <input type="hidden" name="img_about_3_lama" value="<?= $profile['img_about_3']; ?>">
                <input type="hidden" name="img_about_4_lama" value="<?= $profile['img_about_4']; ?>">
                <input type="hidden" name="img_profile_lama" value="<?= $profile['img_profile']; ?>">
                <input type="hidden" name="logo_lama" value="<?= $profile['logo']; ?>">
                <div class="mb-3">
                    <label for="">Logo</label>
                    <input type="file" class="form-control" name="logo" placeholder="Nama Website">
                </div>
                <div class="mb-3">
                    <label for="">Facebook</label>
                    <input type="text" class="form-control" name="facebook" required placeholder="Facebook" value="<?= $profile['facebook']; ?>">
                </div>
                <div class="mb-3">
                    <label for="">Youtube</label>
                    <input type="text" class="form-control" name="youtube" required placeholder="Youtube" value="<?= $profile['youtube']; ?>">
                </div>
                <div class="mb-3">
                    <label for="">Twitter</label>
                    <input type="text" class="form-control" name="twitter" required placeholder="Twitter" value="<?= $profile['twitter']; ?>">
                </div>
                <div class="mb-3">
                    <label for="">Instagram</label>
                    <input type="text" class="form-control" name="instagram" required placeholder="Instagram" value="<?= $profile['instagram']; ?>">
                </div>
                <div class="mb-3">
                    <label for="">Maps</label>
                    <textarea name="maps" class="form-control" id="" cols="30" style="height: 200px !important;" rows="20"><?= $profile['maps']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="">Gambar About 1</label>
                    <input type="file" class="form-control" name="img_about_1">
                </div>
                <div class="mb-3">
                    <label for="">Gambar About 2</label>
                    <input type="file" class="form-control" name="img_about_2">
                </div>
                <div class="mb-3">
                    <label for="">Gambar About 3</label>
                    <input type="file" class="form-control" name="img_about_3">
                </div>
                <div class="mb-3">
                    <label for="">Gambar About 4</label>
                    <input type="file" class="form-control" name="img_about_4">
                </div>
                <div class="mb-3">
                    <label for="">Gambar Profile Company</label>
                    <input type="file" class="form-control" name="img_profile">
                </div>
                <div class="mb-3">
                    <label for="">Visi</label>
                    <textarea name="visi" class="form-control" required id="" style="height: 150px !important;" cols="50" rows="50" placeholder="Visi">
                        <?= $profile['visi']; ?>
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="">Misi</label>
                    <textarea name="misi" class="form-control" required id="" style="height: 150px !important;" cols="30" rows="10" placeholder="Misi">
                        <?= $profile['misi']; ?>
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="">Deskripsi About</label>
                    <textarea name="about" class="form-control" required id="" style="height: 150px !important;" cols="30" rows="10" placeholder="Deskripsi About">
                        <?= $profile['deskripsi_about']; ?>
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="">Deskripsi Footer</label>
                    <textarea name="footer" class="form-control" required id="" style="height: 150px !important;" cols="30" rows="10" placeholder="Deskripsi Footer">
                        <?= $profile['deskripsi_footer']; ?>
                    </textarea>
                </div>
                <div class="mb-3">
                    <label for="">Deskripsi Profil</label>
                    <textarea name="deskripsi_profile" class="form-control" required id="" style="height: 150px !important;" cols="30" rows="10" placeholder="Deskripsi Profile">
                        <?= $profile['text_profile']; ?>
                    </textarea>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>


<?= $this->endSection(); ?>