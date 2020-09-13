<div class="container" style="margin-top:100px">
    <div class="card">
        <div class="card-body">
            <?php
                foreach($detail_invoice->result() as $i) {
                    foreach($waktu->result() as $w) {
                        $tgl_invoice = date("d",strtotime($i->waktu_ditambahkan));
                        $bln_invoice = date("m",strtotime($i->waktu_ditambahkan));
                        $thn_invoice = date("Y",strtotime($i->waktu_ditambahkan));
                        $waktu_invoice = date("H:i:s",strtotime($i->waktu_ditambahkan));

                        if($bln_invoice == "01") {
                            $bln_invoice = "Januari";
                        }
                        else if($bln_invoice == "02") {
                            $bln_invoice = "Februari";
                        }
                        else if($bln_invoice == "03") {
                            $bln_invoice = "Maret";
                        }
                        else if($bln_invoice == "04") {
                            $bln_invoice = "April";
                        }
                        else if($bln_invoice == "05") {
                            $bln_invoice = "Mei";
                        }
                        else if($bln_invoice == "06") {
                            $bln_invoice = "Juni";
                        }
                        else if($bln_invoice == "07") {
                            $bln_invoice = "Juli";
                        }
                        else if($bln_invoice == "08") {
                            $bln_invoice = "Agustus";
                        }
                        else if($bln_invoice == "09") {
                            $bln_invoice = "September";
                        }
                        else if($bln_invoice == "10") {
                            $bln_invoice = "Oktober";
                        }
                        else if($bln_invoice == "11") {
                            $bln_invoice = "November";
                        }
                        else if($bln_invoice == "12") {
                            $bln_invoice = "Desember";
                        }

                        if($i->status == 0) {
            ?>
            <div class="row">
                <div class="col-12 text-danger">
                    <center>
                        <h3>Transaksi Belum Divalidasi Oleh Admin</h3>
                        <br>
                        <b>Tunggu Admin memvalidasi transaksi Anda.</b>
                    </center>
                    <hr class="mt-5">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h1 align="center">DETAIL INVOICE</h1>
                    <hr>
                </div>
            </div>
            <?php
                }
                elseif($i->status == 1 AND $i->cara_bayar == 1) {
                    $tomorrow_validasi = new DateTime($i->waktu_validasi);
                    $tomorrow_validasi->modify('+1 day');

                    $tgl_validasi = $tomorrow_validasi->format('d');
                    $bln_validasi = $tomorrow_validasi->format('m');
                    $thn_validasi = $tomorrow_validasi->format('Y');

                    if($bln_validasi == "01") {
                        $bln_validasi = "Januari";
                    }
                    else if($bln_validasi == "02") {
                        $bln_validasi = "Februari";
                    }
                    else if($bln_validasi == "03") {
                        $bln_validasi = "Maret";
                    }
                    else if($bln_validasi == "04") {
                        $bln_validasi = "April";
                    }
                    else if($bln_validasi == "05") {
                        $bln_validasi = "Mei";
                    }
                    else if($bln_validasi == "06") {
                        $bln_validasi = "Juni";
                    }
                    else if($bln_validasi == "07") {
                        $bln_validasi = "Juli";
                    }
                    else if($bln_validasi == "08") {
                        $bln_validasi = "Agustus";
                    }
                    else if($bln_validasi == "09") {
                        $bln_validasi = "September";
                    }
                    else if($bln_validasi == "10") {
                        $bln_validasi = "Oktober";
                    }
                    else if($bln_validasi == "11") {
                        $bln_validasi = "November";
                    }
                    else if($bln_validasi == "12") {
                        $bln_validasi = "Desember";
                    }
            ?>
            <div class="row">
                <div class="col-12 text-danger">
                    <center>
                    <?php if($i->jenis_bayar == 2) { ?>
                        <h3>Silakan Mengambil Pesanan Anda Sebelum Waktu Di Bawah Ini.</h3>
                        <?php }else { ?>
                        <h3>Silakan Mengambil Pesanan Anda.</h3>
                        <?php } ?>
                        <?php if($i->jenis_bayar == 2) { ?>
                        <br>
                        <b><?= $tgl_validasi." ".$bln_validasi." ".$thn_validasi." - ".$w->waktu_akhir." WIB"; ?></b>
                        <?php } ?>
                        <br>
                        Waktu Pengambilan/Pengiriman Anda: <?= $w->waktu_nama." Jam ".$w->waktu_awal." s/d ".$w->waktu_akhir." WIB"; ?>
                    </center>
                    <hr class="mt-5">
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h1 align="center">DETAIL INVOICE</h1>
                    <hr>
                </div>
            </div>
            <?php } ?>
            <div class="row">
                <div class="col-6">
                    <h1 class="text-dark" id="text1">Sayur<small class="text-danger">Mayur</small></h1>
                    <h5 id="text2">Kota Serang, Banten</h5>
                </div>
                <div class="col-6">
                    <h1 class="text-dark float-right" id="text1">INVOICE</h1>
                    <br><br><br>
                    <table class="float-right table">
                        <tr>
                            <td><b>No. Invoice</b></td>
                            <td><b>:</b></td>
                            <td><span id="text3"><?= $i->no_invoice; ?></span></td>
                        </tr>
                        <tr>
                            <td><b>Tanggal Pembuatan Invoice</b></td>
                            <td><b>:</b></td>
                            <td><span id="text3"><?= $tgl_invoice." ".$bln_invoice." ".$thn_invoice." - ".$waktu_invoice." WIB"; ?></span></td>
                        </tr>
                        <?php if($i->status == 2) { ?>
                        <tr>
                            <td><b>Tanggal Dibatalkan</b></td>
                            <td><b>:</b></td>
                            <td><span id="text3">
                                    <?php
                                        $tgl_batal = date("d",strtotime($i->waktu_batal));
                                        $bln_batal = date("m",strtotime($i->waktu_batal));
                                        $thn_batal = date("Y",strtotime($i->waktu_batal));
                                        $waktu_batal = date("H:i:s",strtotime($i->waktu_batal));

                                        if($bln_batal == "01") {
                                            $bln_batal = "Januari";
                                        }
                                        else if($bln_batal == "02") {
                                            $bln_batal = "Februari";
                                        }
                                        else if($bln_batal == "03") {
                                            $bln_batal = "Maret";
                                        }
                                        else if($bln_batal == "04") {
                                            $bln_batal = "April";
                                        }
                                        else if($bln_batal == "05") {
                                            $bln_batal = "Mei";
                                        }
                                        else if($bln_batal == "06") {
                                            $bln_batal = "Juni";
                                        }
                                        else if($bln_batal == "07") {
                                            $bln_batal = "Juli";
                                        }
                                        else if($bln_batal == "08") {
                                            $bln_batal = "Agustus";
                                        }
                                        else if($bln_batal == "09") {
                                            $bln_batal = "September";
                                        }
                                        else if($bln_batal == "10") {
                                            $bln_batal = "Oktober";
                                        }
                                        else if($bln_batal == "11") {
                                            $bln_batal = "November";
                                        }
                                        else if($bln_batal == "12") {
                                            $bln_batal = "Desember";
                                        }

                                        echo $tgl_batal." ".$bln_batal." ".$thn_batal." - ".$waktu_batal." WIB";
                                    ?>
                                </span>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                    <?php
                        if($i->status == 0) {
                            echo "<h2 class='text-warning float-right' id='text4'>Belum Divalidasi</h2>";
                        }
                        else if($i->status == 1) {
                            echo "<h2 class='text-success float-right' id='text4'>Sudah Tervalidasi</h2>";
                        }
                        elseif($i->status == 2) {
                            echo "<h2 class='text-danger float-right' id='text4'>Dibatalkan</h2>";
                        }
                        elseif($i->status == 3) {
                            echo "<h2 class='text-primary float-right' id='text4'>Selesai</h2>";
                        }
                    ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6 border-right mt-3">
                    <b>Tagihan Kepada:</b>
                    <br>
                    <span class="d-none d-sm-block">
                    <?php
                        foreach($user->result() as $u) {
                            echo $u->user_nama." - ".$u->user_email." - ".$u->user_nohp;
                        }
                    ?>
                    </span>
                    <span class="d-block d-sm-none"><?= $u->user_nama."<br>".$u->user_email."<br>".$u->user_nohp; ?></span>
                    <br>
                    <b>Metode Pembayaran:</b>
                    <br>
                    <?php
                        if($i->jenis_bayar == 1) {
                            if($i->cara_bayar == 1) {
                                echo "Transfer Di Toko";
                            }
                            else {
                                echo "Transfer Di Tempat";
                            }
                        }
                        else {
                            if($i->cara_bayar == 1) {
                                echo "Tunai Di Toko";
                            }
                            else {
                                echo "Tunai Di Tempat";
                            }
                        }
                    ?>
                    <?php
                        if($i->cara_bayar == 2) {
                    ?>
                    <br><br>
                    <b>Tempat Pengiriman:</b>
                    <br>
                    <?php
                        foreach($ongkir->result() as $o) {
                            echo $o->ongkir_lokasi;
                        }
                    ?>
                    <?php } ?>
                    <br><br>
                    <b>Waktu Pengiriman / Pengambilan:</b>
                    <br>
                    <?= $w->waktu_nama. " Jam ".$w->waktu_awal." s/d ".$w->waktu_akhir. " WIB"; ?>
                    <?php if($i->cara_bayar == 2) { ?>
                    <br><br>
                    <b>Detail Pengiriman:</b>
                    <br>
                    <?= $i->detail_kirim; ?>
                    <?php } ?>
                </div>
                <div class="col-6 mt-3">
                    <b class="float-right">Pembayaran Kepada:</b>
                    <br>
                    <span class="float-right">SayurMayur</span>
                    <br>
                    <span class="float-right">Kota Serang, Banten</span>
                    <?php if($i->status == 3) { ?>
                    <br><br>
                    <b class="float-right">Total Dibayar:</b>
                    <br>
                    <span class="float-right"><?= "Rp. ".number_format($i->dibayar); ?></span>
                    <?php } ?>
                </div>
                <div class="col-12 mt-5">
                    <p class="text-center"><b>Detail Pesanan:</b></p>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr class="bg-light">
                                <th class="text-center" width="600">Item Description</th>
                                <th class="text-center">Quantity</th>
                                <th class="text-center">Unit Price</th>
                                <th class="text-center">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($checkout->result() as $c) {
                            ?>
                            <tr>
                                <td><?= $c->barang_nama; ?></td>
                                <td class="text-center"><?= $c->kuantitas; ?></td>
                                <td class="text-center"><?= "Rp. ".number_format($c->barang_harjul); ?></td>
                                <td class="text-center"><?= "Rp. ".number_format($c->subtotal); ?></td>
                            </tr>
                            <?php
                                }
                                if($i->cara_bayar == 2) {
                            ?>
                            <tr>
                                <td><?= "Ongkos Kirim ".$o->ongkir_lokasi; ?></td>
                                <td class="text-center">1</td>
                                <td class="text-center"><?= "Rp. ".number_format($o->ongkir_harga); ?></td>
                                <td class="text-center"><?= "Rp. ".number_format($o->ongkir_harga); ?></td>
                            </tr>
                            <?php } ?>
                            <tr>
                                <th class="text-right pr-5" colspan="3">TOTAL</th>
                                <th class="text-center bg-light">
                                    <?= "Rp. ".number_format($i->total_bayar); ?>
                                </th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php }} ?>
        </div>
    </div>
</div>