<?php
    date_default_timezone_set("Asia/Jakarta");
    $hitung = $this->m_rental->get_data("transaksi_batal")->num_rows();

    if($hitung > 0){
        $data = $this->m_rental->get_data("transaksi_batal")->row();
        $where = array(
            "tgl_batal" => $data->tgl_batal
        );
        $tgl_sekarang = date_create(date("Y-m-d"));
        $tgl_batal = date_create(date("Y-m-d",strtotime($data->tgl_batal)));

        $diff = date_diff($tgl_batal,$tgl_sekarang);

        if((int)$diff->format("%R%a") >= 30){
            $this->m_rental->delete_data($where,"transaksi_batal");
        }
    }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dasbor - Aplikasi Rental Mobil</title>
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/datatable/datatables.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/font-awesome/css/all.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/lightbox.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/style.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap-datepicker3.min.css'; ?>">
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap-datetimepicker.min.css'; ?>">
    <script src="<?php echo base_url().'assets/js/jquery.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/angular.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/ui-bootstrap-tpls.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/moment.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/tanggal.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/jam.js'; ?>"></script>
    <style type="text/css">
        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
            background-size: cover;
        }
        #loader {
            display: block;
            position: relative;
            left: 50%;
            top: 50%;
            width: 150px;
            height: 150px;
            margin: -75px 0 0 -75px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #3498db;
            -webkit-animation: spin 2s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
            animation: spin 2s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
        }
        
        #loader:before {
            content: "";
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #e74c3c;
            -webkit-animation: spin 3s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
            animation: spin 3s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
        }
        
        #loader:after {
            content: "";
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #f9c922;
            -webkit-animation: spin 1.5s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
            animation: spin 1.5s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
        }
        
        @-webkit-keyframes spin {
            0%   {
                -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(0deg);  /* IE 9 */
                transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
            }
            100% {
                -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(360deg);  /* IE 9 */
                transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
            }
        }
        @keyframes spin {
            0%   {
                -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(0deg);  /* IE 9 */
                transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
            }
            100% {
                -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(360deg);  /* IE 9 */
                transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
            }
        }
    </style>
</head>
<body ng-app="app" class="ng-scope">
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>
    <div id="wrapper">
        <?php include("sidebar.php"); ?>
        <div id="page-wrapper">
            <div class="container-fluid">