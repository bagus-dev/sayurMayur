<div class="overlay-wrapper" id="loading2">
    <div class="overlay" style="display:none" id="loading-section2">
        <i class="fas fa-3x fa-sync-alt fa-spin"></i>
        <div class="text-bold pt-2">&nbsp; Loading...</div>
    </div>
<div class="container" style="margin-top: 100px;">
    <h1 class="pb-1 border-bottom title-page">Sayur</h1>
    <div class="row">
        <div class="col-12">
            <div class="row">
                <div class="col-2 col-md-3">
                    <h3 class="pb-3 title-kategori">Kategori Barang:</h3>
                </div>
                <div class="col-5 col-md-2">
                    <button class="btn btn-warning text-white py-2 px-5 btn-kategori-active" id="kat_1" type="button">
                        <span class="select-kategori bg-info p-1 rounded" id="select-kategori-1">
                            <i class="fas fa-check"></i> Dipilih
                        </span>
                        Sayur
                    </button>
                </div>
                <div class="col-5 col-md-2">
                    <button class="btn btn-default py-2 px-5" id="kat_2" type="button">
                        <span class="select-kategori bg-info p-1 rounded" id="select-kategori-2" style="display:none;">
                            <i class="fas fa-check"></i> Dipilih
                        </span>
                        Bumbu
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-8" id="col-left">
            <div class="row" id="row-data">
                <?php $no = 1; foreach ($barangs_sayur->result() as $barang) : ?>
                    <div class="col-md-4" id="col-data">
                        <div class="card" style="margin-bottom: 30px;">
                            <img class="card-img-top" src="<?= base_url(); ?>assets/source/images/barang/<?= $barang->barang_gambar ?>" alt="<?= $barang->barang_id; ?>" style="width:100%; height:200px; object-fit:cover">
                            <div class="card-body text-center">
                                <div class="row">
                                    <div class="col-6 border-right">
                                        <h6><b class="nama_barang"><?= (strlen($barang->barang_nama) > 14) ? substr($barang->barang_nama, 0, 15) . '...' : $barang->barang_nama; ?></b></h6>
                                        <div style="margin-top:22px;"><input type="number" onkeyup="qtyInput(event);" onchange="qtyInput2(event);" data-no="<?= $no; ?>" data-barang_id="<?= $barang->barang_id; ?>" id="<?= 'qty_input_'.$barang->barang_id; ?>" placeholder="0" min="0" style="width:45px"> <?= $barang->satuan_nama; ?></div>
                                    </div>
                                    <div class="col-6">
                                        <p><?= 'Rp. ' . number_format($barang->barang_harjul); ?></p>
                                        <button class="btn btn-sm btn-primary" id="<?= 'btn-simpan-'.$barang->barang_id; ?>" onclick="simpan_barang(event);" data-barang_id="<?= $barang->barang_id; ?>" data-barang_nama="<?= $barang->barang_nama; ?>" data-barang_harjul="<?= $barang->barang_harjul; ?>" type="button" disabled><i class="fa fa-plus-circle"></i> Simpan</button>
                                    </div>
                                    <div class="col-12 text-center mt-3 mb-0">
                                        <p class="text-muted small">
                                            Stok Sisa: <?= '<b><span id="stok-'.$no++.'">'.$barang->barang_stok.'</span> '.$barang->satuan_nama.'</b>'; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <nav>
                <ul class="pagination justify-content-center"></ul>
            </nav>
        </div>
        <div class="col-md-4" id="parent-cart">
            <div class="overlay-wrapper">
                <div class="overlay" style="display:none" id="loading-section">
                    <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                    <div class="text-bold pt-2">&nbsp; Loading...</div>
                </div>
                <div id="cart-right">
                    <h2 class="text-left title-page"><i class="fa fa-shopping-cart"></i> Keranjang</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Barang</th>
                                <th scope="col">Jumlah</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Opsi</th>
                            </tr>
                        </thead>
                        <tbody id="barang_cart_right">
                            <?php
                                if($keranjang->num_rows() >= 1){
                                    foreach($keranjang->result() as $k) {
                            ?>
                            <tr class="text-left" id="<?= 'cart_row_'.$k->id; ?>">
                                <td id="<?= 'nama-'.$k->id; ?>"><?= $k->barang_nama; ?></td>
                                <td><input type="number" onkeyup="changeQtyCart(event);" class="qty_input" onchange="changeQtyCart2(event);" id="<?= 'input_kuantitas_cart_'.$k->id; ?>" data-cart_id="<?= $k->id; ?>" style="width:50px" value="<?= $k->total_kuantitas; ?>"></td>
                                <td><?= "<span id='subtotal-".$k->id."'>".number_format($k->total_harga)."</span>"; ?></td>
                                <td><button class="btn btn-xs btn-danger text-white" data-id="<?= $k->id; ?>" onclick="hapusCart(event);"><i class="fa fa-trash"></i> Hapus</button></td>
                            </tr>
                            <?php }}else { ?>
                            <tr class="text-center">
                                <td colspan="4"><b>Keranjang Kosong...</b></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <?php
                                foreach($total_harga_keranjang->result() as $t) {
                            ?>
                            <tr>
                                <th colspan="2">Total</th>
                                <th><?= '<span id="total_harga_cart_right">'.number_format($t->total_harga).'</span>'; ?></th>
                                <th></th>
                            </tr>
                            <?php } ?>
                        </tfoot>
                    </table>
                    <button class="btn btn-primary btn-block" id="btn-cekout" <?php if($keranjang->num_rows() == 0){echo "disabled"; } ?>>Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>