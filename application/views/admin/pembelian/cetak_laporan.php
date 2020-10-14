<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Pembelian - RadjaSayur</title>
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
                <h3>Laporan Pembelian Radja<small style="color:#dc3545">Sayur</small></h3>
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
                            <th>Suplier</th>
                            <th>Total Harga</th>
                            <th>Total Pembayaran</th>
                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total_tot = 0; ?>
                        <?php foreach ($detail_invoice->result() as $index => $beli) : ?>
                            <tr>
                                <td><?= ++$index; ?></td>
                                <td><?= $beli->beli_nofak; ?></td>
                                <td><?= $beli->beli_tanggal; ?></td>
                                <td><?= $beli->beli_suplier_nama; ?></td>
                                <td><?= 'Rp. ' . number_format($beli->beli_total); ?></td>
                                <td><?= 'Rp. ' . number_format($beli->beli_jml_uang); ?></td>
                                <td><?= $beli->beli_keterangan; ?></td>
                            </tr>
                            <?php $total_tot += $beli->beli_total; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <br>

                <h3 style="float:right">Total Pengeluaran: Rp. <?= number_format($total_tot); ?></h3>
            </div>
        </div>
    </div>
</body>

</html>