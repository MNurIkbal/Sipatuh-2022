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

    .sosmed_inline img {
        display: inline;
        margin: 2px;
        border-radius: 4px;
        width: 44px;
        opacity: 1;
        cursor: pointer;
    }

    .sosmed_inline img:hover {
        opacity: 0.8;
        transform: scale(1);
    }

    @media screen and (max-width:770px) {
        .os {
            margin-top: 30px;
        }
    }
</style>

<div class="container mt-5 mb-5">
    <div class="jumbotron">
        <div class="row">
            <div class="col-md-8">
                <div class="wrapper">
                    <img src="<?= base_url("company/img/" . $berita['img']); ?>" alt="" class="img-fluid">
                </div>
                <div class="mt-5">
                    <h4><?= $berita['title']; ?></h4>
                    <div class="d-flex mb-3 mt-3">
                        <span>
                            <i class="fa-solid fa-location-dot"></i>
                            <?= $berita['lokasi']; ?>
                        </span>
                        <span style="margin-left: 20px;">
                            <i class="fa-solid fa-calendar"></i>
                            <?= date("d, F Y", strtotime($berita['created_at'])); ?>
                        </span>
                        <span style="margin-left: 20px;">
                            <i class="fa-solid fa-calendar"></i>
                            <?= number_format($berita['lihat']); ?> Views
                        </span>
                    </div>
                    <p>
                        <?= $berita['pesan']; ?>
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="kotak bg-primary p-3">
                    <h4>Artikel Terpopuler</h4>
                </div>
                <?php foreach ($artikel as $ty) : ?>
                    <a href="<?= base_url('detail_artikel/' . $ty->id . '/' . $company); ?>" style="color: black;">
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <img src="<?= base_url('company/img/' . $ty->img); ?>" class="img-fluid img-thumbnail" alt="">
                            </div>
                            <div class="col-md-6">
                                <p>
                                    <?= substr($ty->pesan,0,80); ?>
                                </p>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <img src="https://www.facebook.com/images/fb_icon_325x325.png" onclick="_fb();" alt="facebook" style="width: 40px;height: 40px;">
    <img src="https://img.freepik.com/free-icon/twitter_318-187597.jpg" onclick="_twitter();" alt="twitter" style="width: 40px;height: 40px;margin-left: 20px;">
    <img src="https://www.freeiconspng.com/thumbs/logo-whatsapp-png/logo-whatsapp-png-pic-0.png" onclick="_whatapps();" alt="whatapps" style="width: 40px;height: 40px;margin-left: 20px;">
    <img src="https://cdn0-production-images-kly.akamaized.net/JPiZD1bY-VGfe0uviJCIKBXrYXo=/1200x1200/smart/filters:quality(75):strip_icc():format(jpeg)/kly-media-production/medias/1060616/original/077298200_1447924136-logo_telegram.png" onclick="_telegram();" alt="telegram" style="width: 50px;height: 50px;margin-left: 10px;margin-top: 5px;">
</div>

<script>
    var title = "<?= $berita['title'] ?>";
    var deskripsi = "<?= substr($berita['pesan'], 0, 100) . '...' ?>";
    var link = "<?= current_url() ?>";
    var currentLocation = window.location;
    var top = (screen.height - 570) / 2;
    var left = (screen.width - 570) / 2;
    var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;

    function _fb() {
        var url = "https://web.facebook.com/sharer.php?u=" + encodeURI(currentLocation);
        window.open(url, 'NewWindow', params);
    }

    function _twitter() {
        var url = "https://twitter.com/intent/tweet?url=" + encodeURI(currentLocation) + "&text=" + encodeURI(deskripsi);
        window.open(url, 'NewWindow', params);
    }

    function _whatapps() {
        var url = "https://api.whatsapp.com/send?phone=&text=" + encodeURI(title + "  " + deskripsi + " " + link);
        window.open(url, 'NewWindow', params);
    }


    function _telegram() {
        var url = "https://telegram.me/share/url?url=" + encodeURI(currentLocation) + "&text=" + encodeURI(title + deskripsi);
        window.open(url, 'NewWindow', params);
    }
</script>
<?= $this->endSection(); ?>