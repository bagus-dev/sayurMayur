<!DOCTYPE html>
<html lang="id" moznomarginboxes mozdisallowselectionprint>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Struk Penjualan Online</title>
    <style>
        .content {
            width: 80mm;
            font-size: 12px;
            padding: 5px;
        }

        .title {
            text-align: center;
            font-size: 13px;
            padding-bottom: 5px;
            border-bottom: 1px dashed;
        }

        .head {
            margin-top: 5px;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid;
        }

        table {
            width: 100%;
            font-size: 12px;
        }

        .thanks {
            margin-top: 10px;
            padding-top: 10px;
            text-align: center;
            border-bottom: 1px dashed;
        }

        @media print {
            @page {
                width: 80mm;
                margin: 0mm;
            }
        }
    </style>

</head>

<body>
    <div class="content">
        <div class="title">
            <strong>RadjaSayur</strong>
            <br>
            Kota Serang, Banten
        </div>

        <div class="head">
            <?php foreach ($detail_invoice->result() as $i) { ?>
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="width:140px"><?= date("d/m/Y H:i:s", strtotime($i->waktu_ditambahkan)) . " WIB"; ?></td>
                        <td>Kasir</td>
                        <td style="text-align:center; width:10px"></td>
                        <td style="text-align:right;"><?= ucfirst($this->session->userdata('user_nama')); ?></td>
                    </tr>
                    <tr>
                        <td><?= $i->no_invoice; ?></td>
                        <td>Customer</td>
                        <td style="text-align:center;"></td>
                        <td style="text-align:right;">
                            <?php
                            foreach ($user->result() as $u) {
                                echo $u->user_nama;
                            }
                            ?>
                        </td>
                    </tr>
                </table>
            <?php } ?>
        </div>

        <div class="transaction">
            <table class="transaction-table" cellspacing="0">
                <tr>
                    <th style="width:125px;text-align:left;">Item</th>
                    <th>Qty</th>
                    <th style="text-align:center; width:90px">Price per Item</th>
                    <th style="text-align:right; width:70px">Subtotal</th>
                </tr>
                <?php
                $no = 1;
                foreach ($checkout->result() as $c) { ?>
                    <tr>
                        <td><?= $c->barang_nama; ?></td>
                        <td style="text-align:center;">
                            <?php
                            if ($c->kuantitas >= 1) {
                                echo $c->kuantitas;
                            } else if ($c->kuantitas == 0.25) {
                                echo "1/4";
                            } else if ($c->kuantitas == 0.5) {
                                echo "1/2";
                            } else if ($c->kuantitas == 0.75) {
                                echo "3/4";
                            }
                            ?>
                        </td>
                        <td style="text-align:center;"><?= "Rp. " . number_format($c->barang_harjul); ?></td>
                        <td style="text-align:right;"><?= "Rp. " . number_format($c->subtotal); ?></td>
                    </tr>
                <?php $no++;
                } ?>
                <?php if ($i->cara_bayar == 2) { ?>
                    <tr>
                        <td>
                            <?php
                            foreach ($ongkir->result() as $o) {
                                echo "Ongkos Kirim " . $o->ongkir_lokasi;
                            }
                            ?>
                        </td>
                        <td style="text-align:center">1</td>
                        <td style="text-align:center">
                            <?php
                            echo "Rp. " . number_format($o->ongkir_harga);
                            ?>
                        </td>
                        <td style="text-align:right">
                            <?php
                            echo "Rp. " . number_format($o->ongkir_harga);
                            ?>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                    <td colspan="4" style="border-bottom:1px dashed; padding-top:5px;"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <th style="text-align: center; padding-bottom:5px;">Grand Total</th>
                    <td style="text-align: right; padding-bottom:5px;">
                        <?= 'Rp. ' . number_format($i->total_bayar); ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <th style="border-top:1px dashed; text-align: center;">Paid</th>
                    <td style="border-top:1px dashed; text-align: right; padding-top:5px;"><?= "Rp. " . number_format($i->dibayar); ?></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <th style="border-top:1px dashed; text-align: center;">Change</th>
                    <td style="border-top:1px dashed; text-align: right; padding-top:5px;">
                        <?php
                        $kembalian = $i->dibayar - $i->total_bayar;
                        echo "Rp. " . number_format($kembalian);
                        ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="thanks">
            --- Thank You ---
            <br>
            RadjaSayur
        </div>
    </div>

    <script>
        window.onload = function() {
            window.print();
            setTimeout(function() {
                window.close();
            }, 1);
        }
    </script>
</body>

</html>