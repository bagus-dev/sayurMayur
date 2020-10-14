<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan Penjualan Online - SayurMayur</title>
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
                <h3>Laporan Penjualan Online Radja<small style="color:#dc3545">Sayur</small></h3>
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
                <table border="0" style="float:right">
                    <tbody>
                        <tr>
                            <td>Total Invoice Dibuat</td>
                            <td>&emsp;:&emsp;</td>
                            <td><?= $invoice->num_rows(); ?></td>
                        </tr>
                        <tr>
                            <td>Total Invoice Selesai</td>
                            <td>&emsp;:&emsp;</td>
                            <td><span style="color:#007bff"><?= $invoice_selesai->num_rows(); ?></span></td>
                        </tr>
                        <tr>
                            <td>Total Invoice Tervalidasi</td>
                            <td>&emsp;:&emsp;</td>
                            <td><span style="color:#28a745"><?= $invoice_valid->num_rows(); ?></span></td>
                        </tr>
                        <tr>
                            <td>Total Invoice Belum Divalidasi</td>
                            <td>&emsp;:&emsp;</td>
                            <td><span style="color:#ffc107"><?= $invoice_invalid->num_rows(); ?></span></td>
                        </tr>
                        <tr>
                            <td>Total Invoice Dibatalkan</td>
                            <td>&emsp;:&emsp;</td>
                            <td><span style="color:#dc3545"><?= $invoice_batal->num_rows(); ?></span></td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-bordered" style="font-size:10pt;margin-top:150px;">
                    <thead>
                        <tr style="background-color:#f8f9fa">
                            <th>No.</th>
                            <th>No. Invoice</th>
                            <th>Tanggal Invoice</th>
                            <th>Nama Pemesan</th>
                            <th>Cara Bayar</th>
                            <th>Jenis Pembayaran</th>
                            <th>Total Tagihan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        $profit = 0;
                        foreach ($detail_invoice->result() as $i) {
                            if ($i->status == 3) {
                                $checkout = $this->db->get_where("tbl_checkout", array("no_invoice" => $i->no_invoice));

                                foreach ($checkout->result() as $c) {
                                    $barang = $this->db->get_where("tbl_barang", array("barang_id" => $c->barang_id))->row();

                                    $harpok = $barang->barang_harpok;
                                    $harjul = $barang->barang_harjul;
                                    $profit += ($harjul - $harpok) * $c->kuantitas;
                                }
                            }
                        ?>
                            <tr>
                                <td><?= $no++ . "."; ?></td>
                                <td><?= $i->no_invoice; ?></td>
                                <td><?= date("d/m/Y", strtotime($i->waktu_ditambahkan)); ?></td>
                                <td><?= $i->user_nama; ?></td>
                                <td>
                                    <?php
                                    if ($i->cara_bayar == 1) {
                                        echo "Di Toko";
                                    } else {
                                        echo "Di Tempat";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($i->jenis_bayar == 1) {
                                        echo "Transfer";
                                    } else {
                                        echo "Tunai";
                                    }
                                    ?>
                                </td>
                                <td><?= "Rp. " . number_format($i->total_bayar); ?></td>
                                <td>
                                    <?php
                                    if ($i->status == 0) {
                                        echo "Belum Divalidasi";
                                    } elseif ($i->status == 1) {
                                        echo "Tervalidasi";
                                    } elseif ($i->status == 2) {
                                        echo "Dibatalkan";
                                    } elseif ($i->status == 3) {
                                        echo "Selesai";
                                    }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

                <br>

                <h3 style="float:right">Total Keuntungan: Rp. <?= number_format($profit); ?></h3>
            </div>
        </div>
    </div>
</body>

</html>