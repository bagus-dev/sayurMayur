<div class="container" id="container-checkout" style="margin-top: 100px;">
    <h1 class="text-dark" align="center">Radja<small class="text-danger">Sayur</small></h1>
    <div class="card">
        <div class="card-body">
            <h1 class="pb-1 border-bottom title-page">Checkout<small>Barang</small></h1>
            <div class="overlay-wrapper" style="height:100%">
                <div class="overlay" style="display:none;height:100%;" id="loading-section">
                    <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                    <div class="text-bold pt-2">&nbsp; Loading...</div>
                </div>
                <div class="row">
                    <div class="col mt-4">
                        <h4 class="pb-2 text-center text-md-left border-bottom border-primary">Detail Barang</h4>
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
                                foreach ($keranjang->result() as $k) {
                                ?>
                                    <tr>
                                        <td style="vertical-align:middle"><?= $no++ . "."; ?></td>
                                        <td style="vertical-align:middle">
                                            <?= $k->barang_nama . ' <img src="' . base_url() . 'assets/source/images/barang/' . $k->barang_gambar . '" width="50" height="50">'; ?>
                                        </td>
                                        <td style="vertical-align:middle">
                                            <?php
                                            if ($k->total_kuantitas >= 1) {
                                                echo $k->total_kuantitas . " " . $k->satuan_nama;
                                            } else if ($k->total_kuantitas == 0.25) {
                                                echo "1/4" . " " . $k->satuan_nama;
                                            } else if ($k->total_kuantitas == 0.5) {
                                                echo "1/2" . " " . $k->satuan_nama;
                                            } else if ($k->total_kuantitas == 0.75) {
                                                echo "3/4" . " " . $k->satuan_nama;
                                            }
                                            ?>
                                        </td>
                                        <td class="text-right" style="vertical-align:middle"><?= "Rp. " . number_format($k->total_harga); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                            <tfoot>
                                <?php
                                foreach ($total_harga_keranjang->result() as $t) {
                                ?>
                                    <tr>
                                        <th colspan="3" class="text-right">Total Harga Belanja:</th>
                                        <th class="text-right"><?= 'Rp. ' . number_format($t->total_harga); ?></th>
                                    </tr>
                                <?php } ?>
                            </tfoot>
                        </table>
                        <hr>
                        <h4 class="pb-2 mt-5 mb-3 border-bottom border-primary text-center text-md-left">Cara Bayar</h4>
                        <form name="form" id="form" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-2 col-12">
                                    <b>Pilih Cara Bayar:</b>
                                </div>
                                <div class="col-5 col-md-2">
                                    <button class="btn btn-default py-2 px-5" id="cara_bayar_1" type="button">
                                        <span class="select-pilih bg-info p-1 rounded" style="display:none;" id="span_bayar_1">
                                            <i class="fas fa-check"></i> Dipilih
                                        </span>
                                        Di Toko
                                    </button>
                                </div>
                                <div class="col-6 col-md-3">
                                    <button class="btn btn-default py-2 px-5" id="cara_bayar_2" type="button">
                                        <span class="select-pilih-2 bg-info p-1 rounded" style="display:none;" id="span_bayar_2">
                                            <i class="fas fa-check"></i> Dipilih
                                        </span>
                                        Di Tempat
                                    </button>
                                </div>
                            </div>
                            <hr>
                            <h4 class="pb-2 text-center text-md-left mt-4 mb-3 border-bottom border-primary">Detail Pengiriman</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <b>Nama Penerima:</b>
                                        </div>
                                        <div class="col-md-7">
                                            <?php
                                            foreach ($user->result() as $u) {
                                                echo $u->user_nama;
                                            }
                                            ?>
                                        </div>
                                        <div class="col-md-5 mt-2">
                                            <b>Nomor HP Penerima:</b>
                                        </div>
                                        <div class="col-md-7 no-mt-xs">
                                            <?= $u->user_nohp; ?>
                                        </div>
                                        <div class="col-md-5 mt-2">
                                            <b>Alamat Email Penerima:</b>
                                        </div>
                                        <div class="col-md-7 no-mt-xs">
                                            <?= $u->user_email; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row" id="row-btn-ongkir">
                                        <div class="col-md-4 mt-xs col-cod" style="display:none">
                                            <b>Tempat Pengiriman:</b>
                                        </div>
                                        <div class="col-md-8 col-cod" style="display:none">
                                            <?php foreach ($ongkir_1->result() as $o1) { ?>
                                                <button class="btn btn-default py-2 px-5 btn-ongkir" id="ongkir_1" data-ongkir_id="<?= $o1->ongkir_id; ?>" data-ongkir_harga="<?= $o1->ongkir_harga; ?>" type="button">
                                                    <span class="select-pilih bg-info p-1 rounded" style="display:none;" id="span_ongkir_1">
                                                        <i class="fas fa-check"></i> Dipilih
                                                    </span>
                                                    <?= $o1->ongkir_lokasi . " - Rp. " . number_format($o1->ongkir_harga); ?>
                                                </button>
                                        </div>
                                    <?php
                                            }
                                            $no_ongkir = 2;
                                            foreach ($ongkir_2->result() as $o2) { ?>
                                        <div class="col-md-4 col-cod" style="display:none"></div>
                                        <div class="col-md-8 col-cod" style="display:none">
                                            <button class="btn btn-default py-2 px-5 mt-1 btn-ongkir" id="<?= 'ongkir_' . $no_ongkir; ?>" data-ongkir_id="<?= $o2->ongkir_id; ?>" data-ongkir_harga="<?= $o2->ongkir_harga; ?>" type="button">
                                                <span class="select-pilih-3 bg-info p-1 rounded" style="display:none;" id="<?= 'span_ongkir_' . $no_ongkir; ?>">
                                                    <i class="fas fa-check"></i> Dipilih
                                                </span>
                                                <?= $o2->ongkir_lokasi . " - Rp. " . number_format($o2->ongkir_harga); ?>
                                            </button>
                                        </div>
                                    <?php $no_ongkir++;
                                            } ?>
                                    <div class="col-md-4 col-waktu-kirim" id="col-waktu-kirim-1">
                                        <b>Waktu Pengiriman / Pengambilan:</b>
                                    </div>
                                    <div class="col-md-8 col-waktu-kirim" id="col-waktu-kirim-2">
                                        <?php $no_waktu = 1;
                                        foreach ($waktu->result() as $w) { ?>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="waktu_kirim" id="<?= 'waktu_kirim' . $no_waktu; ?>" class="custom-control-input radio-waktu-kirim" value="<?= $w->waktu_id; ?>">
                                                <label for="<?= 'waktu_kirim' . $no_waktu++; ?>" class="custom-control-label font-weight-normal"><?= $w->waktu_nama . '&emsp; Jam ' . $w->waktu_awal . ' s/d ' . $w->waktu_akhir; ?></label>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-4 mt-3 col-cod" style="display:none">
                                        <b>Detail Tujuan Pengiriman:</b>
                                    </div>
                                    <div class="col-md-8 no-mt-xs-2 col-cod" style="display:none">
                                        <textarea name="tujuan_kirim" rows="3" class="form-control" id="detail_kirim" placeholder="Isi Detail Tujuan Pengiriman" onkeyup="checkForm(event);"></textarea>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-9 col-8 text-right border-top pt-3 mt-3">
                                    <b>Total Ongkos Kirim:</b>
                                </div>
                                <div class="col-md-3 col-4 text-right border-top pt-3 mt-3 pr-4"><b>Rp. <span id="ongkir">0</span></b></div>
                            </div>
                            <hr>
                            <h4 class="pb-2 mt-4 mb-3 text-center text-md-left border-bottom border-primary">Detail Pembayaran</h4>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-6">
                                            <b>Jenis Pembayaran:</b>
                                        </div>
                                        <div class="col-6">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="jenis_pembayaran" id="pembayaran_1" class="custom-control-input" value="1">
                                                <label for="pembayaran_1" class="custom-control-label" style="font-weight:normal">Transfer</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" name="jenis_pembayaran" id="pembayaran_2" class="custom-control-input" value="2">
                                                <label for="pembayaran_2" class="custom-control-label" style="font-weight:normal">Tunai</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8" id="col_transfer" style="display:none">
                                    <div class="row">
                                        <div class="col-12">
                                            <b>Unggah Bukti Transfer</b>
                                            <p class="small text-muted">Silakan lakukan transaksi ke Nomor Rekening: <b>01029492 Bank BRI a/n RadjaSayur</b>, kemudian unggah bukti transaksi di bawah ini. Pastikan gambar bukti transaksi dapat dilihat dengan jelas.</p>
                                            <p class="small text-danger">File yang didukung adalah: <b>JPG</b>, <b>JPEG</b>, dan <b>PNG</b>. Maksimal ukuran file adalah <b>500 KB</b>.</p>
                                            <div class="custom-file">
                                                <input type="file" name="bukti_trf" id="bukti_trf" class="custom-file-input" accept=".jpg,.jpeg,.png" onchange="checkTrf(event);">
                                                <input type="hidden" name="gambar_trf" id="gambar_trf" value="">
                                                <label for="bukti_trf" class="custom-file-label">Unggah File</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-9 col-8 text-right border-top pt-3 mt-3">
                                    <b>Total Harga Belanja:</b>
                                </div>
                                <div class="col-md-3 col-4 text-right border-top pt-3 mt-3 pr-4">
                                    <b><?= 'Rp. ' . number_format($t->total_harga); ?></b>
                                </div>
                                <div class="col-md-3 offset-md-6 offset-3 col-5 text-right border-top pt-3 mt-3">
                                    <b>Total Ongkos Kirim:</b>
                                </div>
                                <div class="col-md-3 col-4 text-right border-top pt-3 mt-3 pr-4">
                                    <b>Rp. <span id="total_ongkir">0</span></b>
                                </div>
                                <div class="col-md-3 offset-md-6 offset-2 col-6 text-right border-top pt-3 mt-3 pb-3 border-bottom">
                                    <h5 class="font-weight-bold text-danger">Total Pembayaran:</h5>
                                </div>
                                <div class="col-md-3 col-4 text-right border-top pt-3 mt-3 pr-4 pb-3 border-bottom">
                                    <h5 class="font-weight-bold text-danger">
                                        <?php
                                        foreach ($total_harga_keranjang->result() as $t) {
                                            echo 'Rp. <span id="total_bayar">' . number_format($t->total_harga) . '</span>';
                                        }
                                        ?>
                                    </h5>
                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-md-3 col-6 offset-md-9 offset-6">
                                    <button class="btn btn-primary btn-lg float-right" type="button" id="btn-proses" disabled>Proses Transaksi</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>