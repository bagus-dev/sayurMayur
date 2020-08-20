
<div class="container" id="container-checkout" style="margin-top: 100px;">
    <h1 class="text-dark" align="center">Sayur<small class="text-danger">Mayur</small></h1>
    <div class="card">
        <div class="card-body">
            <h1 class="pb-3 border-bottom">Checkout<small>Barang</small></h1>
            <div class="overlay-wrapper" style="height:100%">
                <div class="overlay" style="display:none;height:100%;" id="loading-section">
                    <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                    <div class="text-bold pt-2">&nbsp; Loading...</div>
                </div>
                <div class="row">
                    <div class="col">
                        <h4 class="pb-2">Detail Barang</h4>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah</th>
                                    <th class="text-right">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $no = 1;
                                    foreach($keranjang->result() as $k) {
                                ?>
                                <tr>
                                    <td><?= $no++."."; ?></td>
                                    <td><?= $k->barang_nama; ?></td>
                                    <td><?= $k->total_kuantitas; ?></td>
                                    <td class="text-right"><?= "Rp. ".number_format($k->total_harga); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <?php
                                    foreach($total_harga_keranjang->result() as $t) {
                                ?>
                                <tr>
                                    <th colspan="3" class="text-right">Total Harga Belanja:</th>
                                    <th class="text-right"><?= 'Rp. '.number_format($t->total_harga); ?></th>
                                </tr>
                                <?php } ?>
                            </tfoot>
                        </table>
                        <hr>
                        <h4 class="pb-2">Detail Pengiriman</h4>
                        <div class="row">
                            <div class="col-md-2 col-6">
                                <b>Nama Penerima:</b>
                            </div>
                            <div class="col-md-4 col-6">
                                <?php
                                    foreach($user->result() as $u) {
                                        echo $u->user_nama;
                                    }
                                ?>
                            </div>
                            <div class="col-md-2 col-6 col-alamat2">
                                <b>Alamat Lengkap:</b>
                            </div>
                            <div class="col-md-4 col-6 mt-3 col-alamat"><?= $u->user_alamat; ?></div>
                            <div class="col-md-2 mt-3 col-6">
                                <b>Nomor HP Penerima:</b>
                            </div>
                            <div class="col-md-4 col-6 mt-3 col-hp"><?= $u->user_nohp; ?></div>
                            <div class="col-md-2 col-6 mt-3">
                                <b>Alamat Email Penerima:</b>
                            </div>
                            <div class="col-md-4 col-6 mt-3"><?= $u->user_email; ?></div>
                            <div class="col-md-2 col-6 mt-3">
                                <b>Jenis Pengiriman:</b>
                            </div>
                            <div class="col-md-4 col-6 mt-3">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="jenis_pengiriman" id="pengiriman_1" class="custom-control-input" value="1" checked>
                                    <label for="pengiriman_1" class="custom-control-label" style="font-weight:normal">Antar ke rumah</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="jenis_pengiriman" id="pengiriman_2" class="custom-control-input" value="2">
                                    <label for="pengiriman_2" class="custom-control-label" style="font-weight:normal">Ambil di tempat</label>
                                </div>
                            </div>
                            <div class="col-md-2 col-6 mt-3 column-kecamatan">
                                <b>Kecamatan Pengantaran:</b>
                            </div>
                            <div class="col-md-4 col-6 mt-3 column-kecamatan">
                                <?php
                                    foreach($ongkir->result() as $o) {
                                        echo "Kecamatan ".$o->ongkir_lokasi;
                                    }
                                ?>
                            </div>
                            <div class="col-md-9 col-8 text-right border-top pt-3 mt-3">
                                <b>Total Ongkos Kirim:</b>
                            </div>
                            <div class="col-md-3 col-4 text-right border-top pt-3 mt-3 pr-4">
                                <b>Rp. <span class="ongkir_span"><?= number_format($o->ongkir_harga); ?></span></b>
                            </div>
                        </div>
                        <hr>
                        <h4 class="pb-2">Detail Pembayaran</h4>
                        <div class="row">
                            <div class="col-md-2 col-6">
                                <b>Jenis Pembayaran:</b>
                            </div>
                            <div class="col-md-10 col-6">
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="jenis_pembayaran" id="pembayaran_1" class="custom-control-input" value="1" checked>
                                    <label for="pembayaran_1" class="custom-control-label" style="font-weight:normal">Transfer</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" name="jenis_pembayaran" id="pembayaran_2" class="custom-control-input" value="2">
                                    <label for="pembayaran_2" class="custom-control-label" style="font-weight:normal">Tunai</label>
                                </div>
                            </div>
                            <div class="col-md-9 col-8 text-right border-top pt-3 mt-3">
                                <b>Total Harga Belanja:</b>
                            </div>
                            <div class="col-md-3 col-4 text-right border-top pt-3 mt-3 pr-4">
                                <b><?= 'Rp. '.number_format($t->total_harga); ?></b>
                            </div>
                            <div class="col-md-3 offset-md-6 offset-3 col-5 text-right border-top pt-3 mt-3">
                                <b>Total Ongkos Kirim:</b>
                            </div>
                            <div class="col-md-3 col-4 text-right border-top pt-3 mt-3 pr-4">
                                <b>Rp. <span class="ongkir_span"><?= number_format($o->ongkir_harga); ?></span></b>
                            </div>
                            <div class="col-md-3 offset-md-6 offset-2 col-6 text-right border-top pt-3 mt-3 pb-3 border-bottom">
                                <h5 class="font-weight-bold text-danger">Total Pembayaran:</h5>
                            </div>
                            <div class="col-md-3 col-4 text-right border-top pt-3 mt-3 pr-4 pb-3 border-bottom">
                                <h5 class="font-weight-bold text-danger">
                                    <?php
                                        $total_bayar = $t->total_harga + $o->ongkir_harga;
                                        echo 'Rp. <span id="total_bayar">'.number_format($total_bayar).'</span>';
                                    ?>
                                </h5>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-3 col-6 offset-md-9 offset-6">
                                <button class="btn btn-primary btn-lg float-right" id="btn-proses">Proses Transaksi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>