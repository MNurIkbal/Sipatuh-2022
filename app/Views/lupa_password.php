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
                <h4>Lupa Password</h4>
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
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>

                  </div>



                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                    <a href="<?= base_url("masuk"); ?>" class="btn btn-success mt-2  ">Login</a>
                    <a href="<?= base_url("regis"); ?>" class="btn btn-primary mt-2  ">Register</a>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Copyright <?= date("Y");  ?></div>
                </div>

              </div>
            </div>
          </div>
        </div>
        <!-- <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="login-brand">
              <img src="<?= base_url("assets/img/stisla-fill.svg");  ?>" alt="logo" width="100" class="shadow-light rounded-circle">
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Login</h4></div>
              <?php if (session()->get('error')) : ?>
                <div class="alert m-3 alert-danger"><?= session()->get("error") ?></div>
                <?php endif; ?>
              <div class="card-body">
                <form method="POST" action="<?= base_url("login");  ?>" 
                class="needs-validation" novalidate="" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="email">Username</label>
                    <input id="email" type="text" class="form-control" name="username" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                      Required Username
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="d-block">
                    	<label for="password" class="control-label">Password</label>
                    </div>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                    Required Password
                    </div>
                  </div>


                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                      Login
                    </button>
                    <a href="<?= base_url("regis"); ?>" class="btn btn-success mt-2  " >Register</a>
                  </div>
                </form>
                <div class="text-center mt-4 mb-3">
                  <div class="text-job text-muted">Copyright <?= date("Y");  ?></div>
                </div>

              </div>
            </div>
          </div>
        </div> -->
      </div>
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

  <!-- JS Libraies -->

  <!-- Page Specific JS File -->

  <!-- Template JS File -->
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
  </script>
</body>

</html>