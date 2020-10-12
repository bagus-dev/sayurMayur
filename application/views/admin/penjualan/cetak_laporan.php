<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Penjualan Offline - RadjaSayur</title>
    <link rel="stylesheet" href="<?= base_url() . 'assets/pos/css/penjualan_online/print.css'; ?>">
    <script>
        window.onload = function() {
            window.print();
            setTimeout(function() {
                window.close()
            }, 1);
        }
    </script>
</head>

<body>
    <div class="book">
        <div class="page">
            <div class="subpage">
                <h3>Laporan Penjualan Offline Radja<small style="color:#dc3545">Sayur</small></h3>
                <br>
                <b>Kota Serang, Banten</b>
                <br><br>
                <table border="0" style="float:left">
                    <tbody>
                        <tr>
                            <td>Tanggal Mulai Laporan</td>
                            <td>&emsp;:&emsp;</td>
                            <td><?= $this->input->get('tgl_mulai', true); ?></td>
                        </tr>
                        <tr>
                            <td>Tanggal Akhir Laporan</td>
                            <td>&emsp;:&emsp;</td>
                            <td><?= $this->input->get('tgl_akhir', true); ?></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered" style="font-size:10pt;margin-top:150px;">
                    <thead>
                        <tr style="background-color:#f8f9fa">
                            <th>No.</th>
                            <th>No. Invoice</th>
                            <th>Tanggal Invoice</th>
                            <th>Customer</th>
                            <th>Total Harga</th>
                            <th>Total Pembayaran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_tot = 0; ?>
                        <?php $total_pem = 0; ?>
                        <?php $total = 0; ?>
                        <?php foreach ($detail_invoice->result() as $index => $jual) : ?>
                            <tr>
                                <td><?= ++$index; ?></td>
                                <td><?= $jual->jual_nofak; ?></td>
                                <td><?= $jual->jual_tanggal; ?></td>
                                <td><?= $jual->jual_customer_nama; ?></td>
                                <td><?= 'Rp. ' . number_format($jual->jual_total); ?></td>
                                <td><?= 'Rp. ' . number_format($jual->jual_jml_uang); ?></td>
                                <td><?= $jual->jual_keterangan; ?></td>
                            </tr>
                            <?php $total_tot += $jual->jual_total; ?>
                            <?php $total_pem += $jual->jual_jml_uang; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <br>

                <h3 style="float:right">Total Keuntungan: Rp. <?= number_format($total); ?></h3>
            </div>
        </div>
    </div>
</body>

</html>