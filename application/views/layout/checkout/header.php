<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/fontawesome-free/css/all.min.css" />

    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" />

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/dist/css/adminlte.min.css" />

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <!-- MyCss -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/pos/css/style.css" />

    <!-- DataTables -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />

    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/pos/css/page/style.css">

    <title><?= $title . SITE_NAME; ?></title>
</head>

<body style="background-image: url('<?= base_url(); ?>assets/pos/img/background.png');">
    <nav class="navbar navbar-expand-lg navbar fixed-top navbar-light bg-light shadows">
        <div class="container">

            <a class="navbar-brand" href="<?= site_url(); ?>"><b>Sayur</b>Mayur</a>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if(isset($keranjangs)){echo 'active'; } ?>" href="<?= base_url().'page/cart'; ?>"><i class="fa fa-shopping-cart btn-sm"></i> Keranjang <span class="badge bg-dark" id="badge_cart"><?php if(isset($keranjang)){echo $keranjang->num_rows(); }elseif(isset($keranjangs)){echo $keranjangs->num_rows(); } ?></span></a>
                </li>
            </ul>
            <?php
                if(isset($_SESSION["user_id"])) {
            ?>
            <div class="dropdown">
                <button class="btn btn-primary btn-sm ml-3 dropdown-toggle" data-toggle="dropdown" type="button">Halo, <?= $this->session->userdata("user_nama"); ?></button>
                <div class="dropdown-menu">
                    <a href="#" class="dropdown-item"><i class="fas fa-user"></i> Profil</a>
                    <a href="javascript:void(0)" class="dropdown-item" id="btn-logout"><i class="fas fa-sign-out-alt"></i> Keluar Akun</a>
                </div>
            </div>
            <?php
                }
                else {
            ?>
            <button class="btn btn-primary btn-sm ml-3" id="btn-login">Masuk</button>
            <?php } ?>
        </div>
    </nav>