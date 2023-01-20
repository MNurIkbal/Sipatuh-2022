<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Registrasi Sipatuh</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="<?= base_url("assets/modules/bootstrap/css/bootstrap.min.css");  ?>">
  <link rel="stylesheet" href="<?= base_url("assets/modules/fontawesome/css/all.min.css");  ?>">

  <!-- CSS Libraries -->
  <link rel="stylesheet" href="<?= base_url("assets/modules/bootstrap-social/bootstrap-social.css");  ?>">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url("assets/css/style.css");  ?>">
  <link rel="stylesheet" href="<?= base_url("assets/css/components.css");  ?>">
  <!-- Start GA -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'UA-94034622-3');
  </script>
  <style>
    @media screen and (max-width:590px) {
      body {
        margin: 20px !important;
      }
    }
  </style>
  <!-- /END GA -->
</head>

<body style="background-color: #007bff;">
  <div id="app">
    <section class="section">
      <form class="container card mt-5"  method="POST" action="<?= base_url("daftar");  ?>" enctype="multipart/form-data">
      
      <div class="   card-primary">
              <div class="card-header">
                <h4>Registrasi</h4>
              </div>
              <?php if (session()->get('error')) : ?>
                <div class="alert m-3 alert-danger"><?= session()->get("error") ?></div>
              <?php endif; ?>
        <div class="row">
          <div class="col-md-6">
          <div class="card-body">
                <div class="needs-validation" novalidate="" >
                  <div class="form-group">
                    <label for="email">Nama</label>
                    <input id="email" type="text" class="form-control" name="nama" tabindex="1" required autofocus placeholder="Nama">
                    <div class="invalid-feedback">
                      Required Nama
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="no_hp">No Hp</label>
                    <input id="no_hp" type="number" class="form-control" name="no_hp" tabindex="1" required autofocus placeholder="No Hp">
                    <div class="invalid-feedback" >
                      Required No HP
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="Photo">Photo</label>
                    <input id="Photo" type="file" class="form-control" name="file" tabindex="1" required autofocus>
                    <small class="text-danger">File Upload JPG,JPEG,PNG size 3 MB</small>
                  </div>
                


                </div>

              </div>  
          </div>
          <div class="col-md-6">
            
              <div class="card-body">
                <div class="needs-validation" novalidate="" >
                  
                  <div class="form-group">
                    <label for="username">Email</label>
                    <input id="username" type="text" class="form-control" name="username" tabindex="1" required placeholder="Email" autofocus>
                    <div class="invalid-feedback">
                      Required Username
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="">Password</label>
                    <div class="input-group mb-3">
                <input name="password" type="password" value="" class="input form-control" id="password" placeholder="Password" required="true" aria-label="password" aria-describedby="basic-addon1" >
                <div class="input-group-append" style="cursor: pointer;">
                  <span class="input-group-text" onclick="password_show_hide();">
                    <i class="fas fa-eye" id="show_eye"></i>
                    <i class="fas fa-eye-slash d-none" id="hide_eye"></i>
                  </span>
                </div>
              </div>
                  </div>
                  <div class="form-group">
                    <label for="">Repeat Password</label>
                    <div class="input-group mb-3">
                <input name="password_satu" type="password" value="" class="input form-control" id="passwords" placeholder="Repeat Password" required="true" aria-label="password" aria-describedby="basic-addon1" >
                <div class="input-group-append" style="cursor: pointer;">
                  <span class="input-group-text" onclick="password_show_hide_satu();">
                    <i class="fas fa-eye" id="show_eye_satu"></i>
                    <i class="fas fa-eye-slash d-none" id="hide_eye_satu"></i>
                  </span>
                </div>
              </div>
                  </div>


                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" >
                      Registrasi
                    </button>
                    <a href="<?= base_url("masuk"); ?>" class="btn btn-success mt-2  ">Login</a>
                  </div>
                </div>  

              </div>
            </div>
          </div>
        </div>
      </form>
    </section>
  </div>
  <!-- General JS Scripts -->
  <script src="<?= base_url("assets/modules/jquery.min.js");  ?>"></script>
  <script src="<?= base_url("assets/modules/popper.js");  ?>"></script>
  <script src="<?= base_url("assets/modules/tooltip.js");  ?>"></script>
  <script src="<?= base_url("assets/modules/bootstrap/js/bootstrap.min.js");  ?>"></script>
  <script src="<?= base_url("assets/modules/nicescroll/jquery.nicescroll.min.js");  ?>"></script>
  <script src="<?= base_url("assets/modules/moment.min.js");  ?>"></script>
  <script src="<?= base_url("assets/js/stisla.js");  ?>"></script>

  <script src="<?= base_url("assets/js/scripts.js");  ?>"></script>
  <script src="<?= base_url("assets/js/custom.js");  ?>"></script>
  <script>
    function password_show_hide() {
  var x = document.getElementById("password");
  var show_eye = document.getElementById("show_eye");
  var hide_eye = document.getElementById("hide_eye");
  hide_eye.classList.remove("d-none");
  if (x.type === "password") {
    x.type = "text";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
  } else {
    x.type = "password";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";
  }
}
    function password_show_hide_satu() {
  var x = document.getElementById("passwords");
  var show_eye = document.getElementById("show_eye_satu");
  var hide_eye = document.getElementById("hide_eye_satu");
  hide_eye.classList.remove("d-none");
  if (x.type === "password") {
    x.type = "text";
    show_eye.style.display = "none";
    hide_eye.style.display = "block";
  } else {
    x.type = "password";
    show_eye.style.display = "block";
    hide_eye.style.display = "none";
  }
}
  </script>
</body>

</html>