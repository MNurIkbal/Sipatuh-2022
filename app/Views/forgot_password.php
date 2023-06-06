<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Manasikita</title>

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
      <div class="container card mt-5">
        <div class="row">
          <div class="col-md-6">
            <div style="width: 100%;height: 100%;">
              <img src="<?= base_url("assets/img/umrah.jpg");  ?>" alt="logo" class="w-100 h-100">
            </div>
          </div>
          <div class="col-md-6">
            <div class="   card-primary">
              <div class="card-header">
                <h4>Reset Password</h4>
              </div>
              <?php if (session()->get('error')) : ?>
                <div class="alert m-3 alert-danger"><?= session()->get("error") ?></div>
              <?php endif; ?>
              <?php if (session()->get('success')) : ?>
                <div class="alert m-3 alert-success"><?= session()->get("success") ?></div>
              <?php endif; ?>
              <div class="card-body">
                <form method="POST" action="<?= base_url("forgot");  ?>" class="needs-validation" novalidate="" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="">Password Baru</label>
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
                <input name="password" type="password" value="" class="input form-control" id="password_dua" placeholder="Password" required="true" aria-label="password" aria-describedby="basic-addon1" >
                <div class="input-group-append" style="cursor: pointer;">
                  <span class="input-group-text" onclick="password_show_hide_dua();">
                    <i class="fas fa-eye" id="show_eye_dua"></i>
                    <i class="fas fa-eye-slash d-none" id="hide_eye_dua"></i>
                  </span>
                </div>
              </div>
                  </div>



                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Reset Password
                    </button>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Copyright <?= date("Y");  ?></div>
                </div>

              </div>
            </div>
          </div>
        </div>
        
      </div>
    </section>
  </div>
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
    function password_show_hide_dua() {
  var x = document.getElementById("password_dua");
  var show_eye = document.getElementById("show_eye_dua");
  var hide_eye = document.getElementById("hide_eye_dua");
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