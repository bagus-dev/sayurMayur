<div class="container" style="margin-top:100px">
    <div class="card">
        <div class="card-body">
            <?php
                foreach($detail_invoice->result() as $i) {
                    $tomorrow = new DateTime($i->waktu_ditambahkan);
                    $tomorrow->modify('+1 day');
                    $tgl_invoice = $tomorrow->format('d');
                    $bln_invoice = $tomorrow->format('m');
                    $thn_invoice = $tomorrow->format('Y');
                    $waktu_invoice = $tomorrow->format('H:i:s');

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

                    if($i->jenis_bayar == 1 AND $i->bukti_transfer == "" AND $i->status == 0) {
            ?>
            <div class="row">
                <div class="col-12 text-danger">
                    <center>
                        <h3>Batas Akhir Transfer Sebelum</h3>
                        <br>
                        <b><?= $tgl_invoice." ".$bln_invoice." ".$thn_invoice." - ".$waktu_invoice." WIB"; ?></b>
                        <br>
                        Lihat <a href="#">Cara Transfer</a> SayurMayur.
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
                if($i->jenis_kirim == 2) {
                    if($i->jenis_bayar == 2 AND $i->status == 1) {
            ?>
            <div class="row">
                <div class="col-12 text-danger">
                    <center>
                        <h3>Batas Akhir Pengambilan Pesanan Sebelum</h3>
                        <br>
                        <b><?= $tgl_invoice." ".$bln_invoice." ".$thn_invoice." - ".$waktu_invoice." WIB"; ?></b>
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
                }
            ?>
            <div class="row">
                <div class="col-6">
                    <h1 class="text-dark">Sayur<small class="text-danger">Mayur</small></h1>
                    <h5>Kota Serang, Banten</h5>
                </div>
                <div class="col-6">
                    <h1 class="text-dark float-right">INVOICE</h1>
                    <br><br><br>
                    <span class="float-right"><b>Jatuh Tempo: </b><?= $tgl_invoice." ".$bln_invoice." ".$thn_invoice." - ".$waktu_invoice." WIB"; ?></span>
                    <br>
                    <span class="float-right"><b>No. Invoice: </b><?= $i->no_invoice; ?></span>
                    <br>
                    <?php
                        if($i->jenis_bayar == 1) {
                            if($i->status == 0 AND $i->bukti_transfer == "") {
                                echo "<h2 class='text-warning float-right'>Belum Dibayar</h2>";
                            }
                            else if($i->status == 0 AND $i->bukti_transfer <> "") {
                                echo "<h2 class='text-warning float-right'>Belum Divalidasi</h2>";
                            }
                            else if($i->status == 1 AND $i->bukti_transfer <> "") {
                                echo "<h2 class='text-success float-right'>Sudah Tervalidasi</h2>";
                            }
                            elseif($i->status == 2) {
                                echo "<h2 class='text-danger float-right'>Dibatalkan</h2>";
                            }
                            elseif($i->status == 3) {
                                echo "<h2 class='text-primary float-right'>Selesai</h2>";
                            }
                        }
                        else {
                            if($i->status == 0) {
                                echo "<h2 class='text-warning float-right'>Belum Divalidasi</h2>";
                            }
                            else if($i->status == 1) {
                                echo "<h2 class='text-success float-right'>Sudah Tervalidasi</h2>";
                            }
                            elseif($i->status == 2) {
                                echo "<h2 class='text-danger float-right'>Dibatalkan</h2>";
                            }
                            elseif($i->status == 3) {
                                echo "<h2 class='text-primary float-right'>Selesai</h2>";
                            }
                        }
                    ?>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-6 border-right mt-3">
                    <b>Tagihan Kepada:</b>
                    <br>
                    <?php
                        foreach($user->result() as $u) {
                            echo $u->user_nama."<br>".$u->user_alamat;
                        }
                    ?>
                    <br><br>
                    <b>Metode Pembayaran:</b>
                    <br>
                    <?php
                        if($i->jenis_bayar == 1) {
                            echo "Transfer";
                        }
                        else {
                            echo "Tunai";
                        }
                    ?>
                    <br><br>
                    <b>Tanggal Pembuatan Invoice:</b>
                    <br>
                    <?php
                        $invoice_date = new DateTime($i->waktu_ditambahkan);
                        $tgl_invoice = $invoice_date->format('d');

                        echo $tgl_invoice." ".$bln_invoice." ".$thn_invoice;
                    ?>
                </div>
                <div class="col-6 mt-3">
                    <b class="float-right">Pembayaran Kepada:</b>
                    <br>
                    <span class="float-right">SayurMayur</span>
                    <br>
                    <span class="float-right">Kota Serang, Banten</span>
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
                            <?php } ?>
                            <tr>
                                <td>
                                    <?php
                                        if($i->jenis_kirim == 1) {
                                            echo "Ongkos Kirim Kec. ".$u->ongkir_lokasi." (Antar ke rumah)";
                                        }
                                        else {
                                            echo "Ongkos Kirim (Ambil di tempat)";
                                        }
                                    ?>
                                </td>
                                <td class="text-center">1</td>
                                <td class="text-center">
                                    <?php
                                        if($i->jenis_kirim == 1) {
                                            echo "Rp. ".number_format($u->ongkir_harga); 
                                        }
                                        else {
                                            echo "Rp. 0";
                                        }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php
                                        if($i->jenis_kirim == 1) {
                                            echo "Rp. ".number_format($u->ongkir_harga); 
                                        }
                                        else {
                                            echo "Rp. 0";
                                        }
                                    ?>
                                </td>
                            </tr>
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
            <?php
                if($i->status <> 3 OR $i->status <> 2) {
                    if($i->jenis_bayar == 1 AND $i->bukti_transfer <> "" AND $i->status == 0) {
            ?>
            <hr>
            <div class="row">
                <?php if($i->jenis_bayar == 1) { ?>
                <div class="col-md-6">
                    <h3>Bukti Transfer</h3>
                    <br>
                    <img src="<?= base_url().'assets/source/images/bukti_transfer/'.$i->bukti_transfer; ?>" alt="Foto Bukti Transfer" class="img-fluid img-thumbnail">
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Status Pesanan</label>
                        <select name="status" id="status" class="custom-select">
                            <option value="0">Belum Divalidasi</option>
                            <option value="1">Tervalidasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Total Dibayar</label>
                        <input type="number" name="dibayar" id="dibayar" class="form-control" placeholder="Total Dibayar">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" onclick="changeStatus();" type="button">Ubah Status Pesanan</button>
                    </div>
                </div>
                <?php }}elseif($i->jenis_bayar == 2 AND $i->status == 0) { ?>
                <div class="col-12">
                    <div class="form-group">
                        <label>Status Pesanan</label>
                        <select name="status" id="status" class="custom-select">
                            <option value="0">Belum Divalidasi</option>
                            <option value="1">Tervalidasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary" onclick="changeStatus();" type="button">Ubah Status Pesanan</button>
                    </div>
                </div>
                <?php }elseif($i->status == 1) { ?>
                <div class="col-12">
                    <div class="form-group">
                        <label>Status Pesanan</label>
                        <select name="status" id="status" class="custom-select">
                            <option value="1">Tervalidasi</option>
                            <option value="3">Selesai</option>
                        </select>
                    </div>
                    <?php if($i->jenis_bayar == 2) { ?>
                    <div class="form-group">
                        <label>Total Dibayar</label>
                        <input type="number" name="dibayar" id="dibayar" class="form-control" placeholder="Total Dibayar">
                    </div>
                    <?php } ?>
                    <div class="form-group">
                        <button class="btn btn-primary" onclick="changeStatus();" type="button">Ubah Status Pesanan</button>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php } ?>
            <?php } ?>
        </div>
    </div>
</div>