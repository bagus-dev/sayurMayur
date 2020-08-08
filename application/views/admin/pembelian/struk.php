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
            <strong><?= $pembelian->beli_suplier_nama; ?></strong>
            <br>
            Jl. bla bla bla
        </div>

        <div class="head">
            <table cellspacing="0" cellpadding="0">
                <tr>
                    <td style="width:200px">
                        <?= Date("d/m/y", strtotime($pembelian->beli_tanggal)); ?>
                    </td>
                    <td>Kasir</td>
                    <td style="text-align:center; width:10px"></td>
                    <td style="text-align:right;">
                        <?= ucfirst($pembelian->user_nama); ?>
                    </td>
                </tr>
                <tr>
                    <td>
                        <?= $pembelian->beli_nofak; ?>
                    </td>
                    <td>Suplier</td>
                    <td style="text-align:center;"></td>
                    <td style="text-align:right;">
                        <?= $pembelian->beli_suplier_nama; ?>
                    </td>
                </tr>
            </table>
        </div>

        <div class="transaction">
            <table class="transaction-table" cellspacing="0" cellpadding="0">
                <?php $arr_diskons = []; ?>
                <?php foreach ($pembelianDetails as $pembelianDetail) : ?>
                    <tr>
                        <td style="width:165px;"><?= $pembelianDetail->d_beli_barang_nama; ?></td>
                        <td><?= $pembelianDetail->d_beli_qty; ?></td>
                        <td style="text-align:right; width:60px"><?= 'Rp. ' . number_format($pembelianDetail->d_beli_barang_harjul); ?></td>
                        <td style="text-align:right; width:60px">
                            <?= 'Rp. ' . number_format(($pembelianDetail->d_beli_barang_harjul - $pembelianDetail->d_beli_diskon) * $pembelianDetail->d_beli_qty); ?>
                        </td>
                    </tr>

                    <?php if ($pembelianDetail->d_beli_diskon > 0) : ?>
                        <?= $arr_diskons[] = $pembelianDetail->d_beli_diskon; ?>
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
                        <?= 'Rp. ' . number_format($pembelian->beli_total + $pembelian->beli_diskon); ?>
                    </td>
                </tr>

                <?php if ($pembelian->beli_diskon > 0) : ?>
                    <tr>
                        <td colspan="2"></td>
                        <td style="text-align: right; padding-bottom:5px">Disc. Sale</td>
                        <td style="text-align: right; padding-bottom:5px">
                            <?= 'Rp. ' . number_format($pembelian->beli_diskon); ?>
                        </td>
                    </tr>
                <?php endif; ?>
                <tr>
                    <td colspan="2"></td>
                    <td style="border-top:1px dashed; text-align:right; padding-top:5px 0;">Grand Total</td>
                    <td style="border-top:1px dashed; text-align:right; padding-top:5px 0;">
                        <?= $pembelian->beli_total; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="border-top:1px dashed; text-align:right; padding-top:5px;">Cash</td>
                    <td style="border-top:1px dashed; text-align:right; padding-top:5px;">
                        <?= $pembelian->beli_jml_uang; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td style="border-top:1px dashed; text-align:right; padding-top:5px;">Change</td>
                    <td style="border-top:1px dashed; text-align:right; padding-top:5px;">
                        <?= $pembelian->beli_kembalian; ?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="thanks">
            --- Thank You ---
            <br>
            <?= $pembelian->beli_suplier_nama; ?>
        </div>
    </div>

</body>

</html>