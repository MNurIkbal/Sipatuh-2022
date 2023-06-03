<?= $this->extend("company/layout/index"); ?>

<?= $this->section("isi"); ?>
<style>
    

    /* .rows:after {
        content: "";
        display: table;
        clear: both;
    } */

    /* Create four equal columns that floats next to eachother */
    /* .column {
        float: left;
        width: 25%;
    } */

    /* The Modal (background) */
    .modals {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: black;
    }

    /* Modal Content */
    .modals-content {
        position: relative;
        background-color: #fefefe;
        margin: auto;
        padding: 0;
        width: 90%;
        max-width: 1200px;
    }

    /* The Close Button */
    .close {
        color: white;
        position: absolute;
        top: 10px;
        right: 25px;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #999;
        text-decoration: none;
        cursor: pointer;
    }

    /* Hide the slides by default */
    .mySlides {
        display: none;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        background-color: rgba(0, 0, 0, 0.8);
        font-weight: bold;
        font-size: 20px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: rgba(0, 0, 0, 0.8);
        color: white;
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #f2f2f2;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* Caption text */
    .caption-container {
        text-align: center;
        background-color: black;
        padding: 2px 16px;
        color: white;
    }

    img.demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }

    img.hover-shadow {
        transition: 0.3s;
    }

    .hover-shadow:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>
<div class="container mt-5 mb-5">
    <div class="row">
        <?php foreach ($foto as $rt) :  ?>
            <div class="col-md-3">
                <div class="s" style="width: 310px;height: 200px;cursor: pointer;">
                    <img src="<?= base_url('company/img/' . $rt->img); ?>" onclick="openModal();currentSlide(<?= $rt->id ?>)" class="hover-shadow img-fluid" style="width: 100%;height: 100%;object-fit: contain;">
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- The Modal/Lightbox -->
    <div id="myModal" class="modals">
        <span class="close cursor" onclick="closeModal()">&times;</span>
        <div class="modals-content">
            <?php foreach ($foto as $row) : ?>
                <div class="mySlides">
                    <div style="width: 100%;height: 600px;margin-top: -50px !important;">
                        <img src="<?= base_url('company/img/' . $row->img); ?>" style="width:100%;height: 100%;" class=" img-fluid">
                    </div>
                </div>
            <?php endforeach; ?>
            <!-- Next/previous controls -->
            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
          

            <!-- Thumbnail image controls -->
            <div style="margin-bottom: 50px;">
                <?php foreach ($foto as $main) : ?>
                    <div class="column d-none">
                        <div style="width: 280px;height: 200px;">
                            <img class="demo  img-fluid" src="<?= base_url('company/img/' . $main->img); ?>" onclick="currentSlide(<?= $main->id ?>)" alt="Nature" style="width: 100%;height: 100%;">
                        </div>
                    </div>
                <?php endforeach; ?>
                <script>
                    // Open the Modal
                    function openModal() {
                        document.getElementById("myModal").style.display = "block";
                    }

                    // Close the Modal
                    function closeModal() {
                        document.getElementById("myModal").style.display = "none";
                    }

                    var slideIndex = 1;
                    showSlides(slideIndex);

                    // Next/previous controls
                    function plusSlides(n) {
                        showSlides(slideIndex += n);
                    }

                    // Thumbnail image controls
                    function currentSlide(n) {
                        showSlides(slideIndex = n);
                    }
                    function showSlides(n) {
                        var i;
                        var slides = document.getElementsByClassName("mySlides");
                        var dots = document.getElementsByClassName("demo");
                        if (n > slides.length) {
                            slideIndex = 1
                        }
                        if (n < 1) {
                            slideIndex = slides.length;
                        }
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";
                        }
                        for (i = 0; i < dots.length; i++) {
                            dots[i].className = dots[i].className.replace(" active", "");
                        }
                        slides[slideIndex - 1].style.display = "block";
                        dots[slideIndex - 1].className += " active";
                    }
                </script>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>