<!DOCTYPE html>
<html lang="en" moznomarginboxes mozdisallowselectionprint>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Nota</title>
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

<body onload="window.print()">
    <div class="content">
        <div class="title">
            <strong>SayurMayur</strong>
            <br>
            Jl. bla bla bla
        </div>

        <div class="head">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <td style="width:200px">
                        <?= Date("d/m/y", strtotime($penjualan->jual_tanggal)); ?>
                    </td>
                    <td>Kasir</td>
                    <td style="text-align:center; width:10px"></td>
                    <td style="text-align:right;">
                        <?= ucfirst($penjualan->user_nama); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= $penjualan->jual_nofak; ?>
                    </td>
                    <td>Customer</td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:right;">
                        <?= $penjualan->jual_customer_nama; ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpadding="0">
                <?php $arr_diskons = []; ?>
                <?php foreach ($penjualanDetails as $penjualanDetail) : ?>
                    <tr>
                        <td style="width:165px;"><?= $penjualanDetail->d_jual_barang_nama; ?></td>
                        <td><?= $penjualanDetail->d_jual_qty; ?></td>
                        <td style="text-align:right; width:60px"><?= 'Rp. ' . number_format($penjualanDetail->d_jual_barang_harjul); ?></td>
                        <td style="text-align:right; width:60px">
                            <?= 'Rp. ' . number_format($penjualanDetail->d_jual_barang_harjul - $penjualanDetail->d_jual_diskon * $penjualanDetail->d_jual_qty); ?>
                        </td>
                    </tr>

                    <?php if ($penjualanDetail->d_jual_diskon > 0) : ?>
                        <?= $arr_diskons[] = $penjualanDetail->d_jual_diskon; ?>
                    <?php endif; ?>
                <?php endforeach; ?>

                <?php foreach ($arr_diskons as $key => $arr_diskon) : ?>
                    <tr>
                        <td></td>
                        <td colspan="2" style="text-align:right;">Disc. <?= $key + 1; ?></td>
                        <td style="text-align:right;"><?= $arr_diskon; ?></td>
                    </tr>
                <?php endforeach; ?>


                <tr>
                    <td colspan="4" style="border-bottom:1px dashed; padding-top:5px;"></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="text-align: right; padding-bottom:5px">Sub Total</td>
                    <td style="text-align: right; padding-bottom:5px">
                        <?= 'Rp. ' . number_format($penjualan->jual_total + $penjualan->jual_diskon); ?>
                    </td>
                </tr>

                <?php if ($penjualan->jual_diskon > 0) : ?>
                    <tr>
                        <td colspan="2"></td>
                        <td style="text-align: right; padding-bottom:5px">Disc. Sale</td>
                        <td style="text-align: right; padding-bottom:5px">
                            <?= 'Rp. ' . number_format($penjualan->jual_diskon); ?>
                        </td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="2"></td>
                    <td style="border-top:1px dashed; text-align:right; padding-top:5px 0;">Grand Total</td>
                    <td style="border-top:1px dashed; text-align:right; padding-top:5px 0;">
                        <?= $penjualan->jual_total; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="border-top:1px dashed; text-align:right; padding-top:5px;">Cash</td>
                    <td style="border-top:1px dashed; text-align:right; padding-top:5px;">
                        <?= $penjualan->jual_jml_uang; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="border-top:1px dashed; text-align:right; padding-top:5px;">Change</td>
                    <td style="border-top:1px dashed; text-align:right; padding-top:5px;">
                        <?= $penjualan->jual_kembalian; ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="thanks">
            --- Thank You ---
            <br>
            SayurMayur
        </div>
    </div>

</body>

</html>