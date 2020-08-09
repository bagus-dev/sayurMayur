<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css" />

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/dist/css/adminlte.min.css" />

    <!-- MyCss -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/pos/css/style.css" />

    <!-- DataTables -->
    <link rel="stylesheet" href="assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />

    <!-- Select2 -->
    <link rel="stylesheet" href="assets/adminlte/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/pos/css/page/style.css">

    <title><?= $title . SITE_NAME; ?></title>
</head>

<body style="background-image: url('assets/pos/img/background.png');">
    <nav class="navbar navbar-expand-lg navbar fixed-top navbar-light bg-light shadows">
        <div class="container">

            <a class="navbar-brand" href="<?= site_url('dashboard'); ?>"><b>Sayur</b>Mayur</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#"><i class="fa fa-shopping-cart btn-sm"></i> Keranjang(belum selesai)</a>
                </li>
            </ul>
            <button class="btn btn-primary btn-sm ml-3">Masuk(belum selesai)</button>
        </div>
    </nav>