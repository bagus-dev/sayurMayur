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
    <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css" />

    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="<?= base_url(); ?>assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css" />

    <!-- Tempus Dominus -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/css/tempusdominus-bootstrap-4.min.css" />

    <title><?= $title . SITE_NAME; ?></title>
</head>

<body style="background-image: url('<?= base_url(); ?>assets/pos/img/background.png');">
    <nav class="navbar navbar-expand-lg navbar fixed-top navbar-light bg-light shadows">
        <div class="container">

            <a class="navbar-brand" href="<?= site_url(); ?>dashboard"><b>Radja</b>Sayur</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="<?= site_url(); ?>dashboard">Menu</span></a>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link disabled"><i class="fa fa-user btn-sm" aria-hidden="true"></i><?= $this->session->userdata('user_nama'); ?> </a>
                    </li>
                    <a class="nav-link disabled"> | </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url(); ?>auth/logout"><i class="fas fa-sign-out-alt btn-sm"></i> Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>