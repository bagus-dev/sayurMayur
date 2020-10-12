<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi Rental Mobil</title>
    <style>
        .table-data{
            width: 100%;
            border-collapse: collapse;
        }
        .table-data tr th, .table-data tr td{
            border: 1px solid black;
            font-size: 10pt;
        }
    </style>
    <link rel="stylesheet" href="<?php echo base_url().'assets/css/bootstrap.min.css'; ?>">
</head>
<body>
    <div class="page-header">
        <h3>Laporan Transaksi Rental Mobil</h3>
    </div>
    <table>
        <tr>
            <td>Dari Tgl</td>
            <td>&nbsp;:</td>
            <td>&nbsp;<?php echo date("d/m/Y",strtotime($_GET["dari"])); ?></td>
        </tr>
        <tr>
            <td>Sampai Tgl</td>
            <td>&nbsp;:</td>
            <td>&nbsp;<?php echo date("d/m/Y",strtotime($_GET["sampai"])); ?></td>
        </tr>
        <tr>
            <td>Karyawan</td>
            <td>&nbsp;:</td>
            <td>&nbsp;<?php echo $this->session->userdata("nama"); ?></td>
        </tr>
    </table>
    <br>
    <table class="table-data table-striped">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal Transaksi</th>
                <th>Customer</th>
                <th>Mobil</th>
                <th>Tgl. Mulai Rental</th>
                <th>Tgl. Selesai Rental</th>
                <th>Harga</th>
                <th>Denda / Hari</th>
                <th>Tgl. Dikembalikan</th>
                <th>Total Denda</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $no = 1;
                foreach($laporan as $l){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo date("d/m/Y",strtotime($l->tgl)); ?></td>
                <td><?php echo $l->nama; ?></td>
                <td><?php echo $l->merk; ?></td>
                <td><?php echo date("d/m/Y",strtotime($l->tgl_pinjam)); ?></td>
                <td><?php echo date("d/m/Y",strtotime($l->tgl_kembali)); ?></td>
                <td><?php echo "Rp. ".number_format($l->harga); ?></td>
                <td><?php echo "Rp. ".number_format($l->denda); ?></td>
                <td>
                    <?php
                        if($l->tgl_dikembalikan == "0000-00-00"){
                            echo "-";
                        }
                        else{
                            echo date("d/m/Y",strtotime($l->tgl_dikembalikan));
                        }
                    ?>
                </td>
                <td>
                    <?php
                        echo "Rp. ".number_format($l->total_denda)." ,-";
                    ?>
                </td>
                <td>
                    <?php
                        if($l->transaksi_status == "1"){
                            echo "Selesai";
                        }
                        else{
                            echo "-";
                        }
                    ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <script>
        window.print();
    </script>
</body>
</html>