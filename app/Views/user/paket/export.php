<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoice</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <style>
    .text-secondary-d1 {
      color:black !important;
    }

    body {
      color: black;
    }

    .page-header {
      margin: 0 0 1rem;
      padding-bottom: 1rem;
      padding-top: .5rem;
      border-bottom: 1px dotted #e2e2e2;
      display: -ms-flexbox;
      display: flex;
      -ms-flex-pack: justify;
      justify-content: space-between;
      -ms-flex-align: center;
      align-items: center;
    }

    .page-title {
      padding: 0;
      margin: 0;
      font-size: 1.75rem;
      font-weight: 300;
    }

    .brc-default-l1 {
      border-color: #dce9f0 !important;
    }

    .ml-n1,
    .mx-n1 {
      margin-left: -.25rem !important;
    }

    .mr-n1,
    .mx-n1 {
      margin-right: -.25rem !important;
    }

    .mb-4,
    .my-4 {
      margin-bottom: 1.5rem !important;
    }

    hr {
      margin-top: 1rem;
      margin-bottom: 1rem;
      border: 0;
      border-top: 1px solid rgba(0, 0, 0, .1);
    }

    .text-grey-m2 {
      color: #888a8d !important;
    }

    .text-success-m2 {
      color: #86bd68 !important;
    }

    .font-bolder,
    .text-600 {
      font-weight: 600 !important;
    }

    .text-110 {
      font-size: 110% !important;
    }

    .text-blue {
      color: #478fcc !important;
    }

    .pb-25,
    .py-25 {
      padding-bottom: .75rem !important;
    }

    .pt-25,
    .py-25 {
      padding-top: .75rem !important;
    }

    .bgc-default-tp1 {
      background-color: rgba(121, 169, 197, .92) !important;
    }

    .bgc-default-l4,
    .bgc-h-default-l4:hover {
      background-color: #f3f8fa !important;
    }

    .page-header .page-tools {
      -ms-flex-item-align: end;
      align-self: flex-end;
    }

    .btn-light {
      color: #757984;
      background-color: #f5f6f9;
      border-color: #dddfe4;
    }

    .w-2 {
      width: 1rem;
    }

    .text-120 {
      font-size: 120% !important;
    }

    .text-primary-m1 {
      color: #4087d4 !important;
    }

    .text-danger-m1 {
      color: #dd4949 !important;
    }

    .text-blue-m2 {
      color: #68a3d5 !important;
    }

    .text-150 {
      font-size: 150% !important;
    }

    .text-60 {
      font-size: 60% !important;
    }

    .text-grey-m1 {
      color: #7b7d81 !important;
    }

    .align-bottom {
      vertical-align: bottom !important;
    }

    /*form styles*/
    #msform ul li {
      text-align: center;
      position: relative;
      margin-top: 20px;
    }

    label {
      text-align: left !important;
    }

    #msform fieldset {
      background: white;
      border: 0 none;
      border-radius: 0.5rem;
      box-sizing: border-box;
      width: 100%;
      margin: 0;
      padding-bottom: 20px;

      /*stacking fieldsets above each other*/
      position: relative;
    }

    /*Hide all except first fieldset*/
    #msform fieldset:not(:first-of-type) {
      display: none;
    }

    #msform fieldset .form-card {
      text-align: left;
      color: #9E9E9E;
    }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
  <div class="page-content container">
    <div class="page-header text-blue-d2">
      <h1 class="page-title text-secondary-d1">
        Invoice
        <small class="page-info">
          <i class="fa fa-angle-double-right text-80"></i>
          ID: #<?= rand(1, 9999) . $main['id']; ?>
        </small>
      </h1>

      <div class="page-tools">

      </div>
    </div>

    <div class="container px-0">
      <div class="row mt-4">
        <div class="col-12 col-lg-12">

          <div class="row">
            <div class="col-sm-6">
              <div>
                <span class="text-sm text-grey-m2 align-middle">Nama:</span>
                <span class="text-600 text-110 text-blue align-middle"><?= $main['nama']; ?></span>
              </div>
              <div class="text-grey-m2">
                <div class="my-1">
                  <?= $main['alamat']; ?>
                </div>
                <div class="my-1"><i class="fa fa-phone fa-flip-horizontal text-secondary"></i> <b class="text-600"><?= $main['no_hp']; ?></b></div>
              </div>
            </div>
            <!-- /.col -->

            <div class="text-95 col-sm-6 align-self-start d-sm-flex justify-content-end">
              <hr class="d-sm-none" />
              <div class="text-grey-m2">
                <div class="mt-1 mb-2 text-secondary-m1 text-600 text-125">
                  Invoice
                </div>


                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Issue Date:</span>
                  <?= date("d, F Y", strtotime($main['tgl_lunas'])); ?>
                </div>

                <div class="my-2"><i class="fa fa-circle text-blue-m2 text-xs mr-1"></i> <span class="text-600 text-90">Status:</span> <span class=" px-25">Lunas</span></div>
              </div>
            </div>
            <!-- /.col -->
          </div>

          <div class="mt-4">

            <div class="row text-600 text-white bgc-default-tp1 py-25">
              <div class="d-none d-sm-block col-1">#</div>
              <div class="col-9 col-sm-5">Keterangan</div>
              <div class="d-none d-sm-block col-sm-2">Dibuat</div>
              <div class="d-none d-sm-block col-4 col-sm-2">Nominal</div>
            </div>


            <div class="text-95 text-secondary-d3">

              <div class="row mb-2 mb-sm-0 py-25">
                <div class="d-none d-sm-block col-1">1</div>
                <div class="col-9 col-sm-5"><?= $main['keterangan_bayar']; ?></div>
                <div class="d-none d-sm-block col-2"><?= date("d, F Y", strtotime($main['tgl_bayar'])); ?></div>
                <div class="d-none d-sm-block col-2 text-95">Rp. <?= number_format($main['nominal_pembayaran']); ?></div>
              </div>
              <?php $no = 2;
              foreach ($bukti as $row) : ?>
                <div class="row mb-2 mb-sm-0 py-25">
                  <div class="d-none d-sm-block col-1"><?= $no++; ?></div>
                  <div class="col-9 col-sm-5"><?= $row['keterangan']; ?></div>
                  <div class="d-none d-sm-block col-2"><?= date("d, F Y", strtotime($row['created'])); ?></div>
                  <div class="d-none d-sm-block col-2 text-95">Rp. <?= number_format($row['nominal']); ?></div>
                </div>
              <?php endforeach; ?>

            </div>


            <div class="row border-b-2 brc-default-l2"></div>


            <div class="row mt-3">
              <div class="col-12 col-sm-7 text-grey-d2 text-95 mt-2 mt-lg-0">
                Pembayaran Anda Sudah Lunas
              </div>

              <div class="col-12 col-sm-5 text-grey text-90 order-first order-sm-last">




                <div class="row my-2 align-items-center bgc-primary-l3 p-2">
                  <div class="col-7 text-right">
                    Total :
                  </div>
                  <div class="col-5">
                    <span class="text-100 text-success-d3 opacity-2">Rp. <?= number_format($paket['biaya']); ?></span>
                  </div>
                </div>
              </div>
            </div>

            <hr />

            <div>
              <span class="text-secondary-d1 text-105">Terima Kasih </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<script>
  window.print();
</script>
</body>

</html>