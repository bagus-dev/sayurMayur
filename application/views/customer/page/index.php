
<div class="container" style="margin-top: 100px;">
    <h1 class="pb-3 border-bottom">Masukan<small>SayurMayur</small></h1>
    <div class="row">
        <div class="col-md-8" id="col-left">
            <div class="row" id="row-data">
                <?php foreach ($barangs->result() as $barang) : ?>
                    <div class="col-md-4 col-6" id="col-data">
                        <div class="card" style="margin-bottom: 30px;">
                            <img class="card-img-top" src="<?= base_url(); ?>assets/source/images/barang/<?= $barang->barang_gambar ?>" alt="<?= $barang->barang_id; ?>" style="width:100%; height:200px; object-fit:cover">
                            <div class="card-body text-center">
                                <h4><b><?= (strlen($barang->barang_nama) > 14) ? substr($barang->barang_nama, 0, 15) . '...' : $barang->barang_nama; ?></b></h4>
                                <small><?= $barang->kategori_nama; ?></small>
                                <p><?= 'Rp. ' . number_format($barang->barang_harjul); ?></p>
                                <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="detail_barang(event);" barang_id="<?= $barang->barang_id; ?>" barang_nama="<?= $barang->barang_nama; ?>" barang_harjul="<?= $barang->barang_harjul; ?>" barang_gambar="<?= $barang->barang_gambar; ?>"><i class="fa fa-plus-circle"></i> Tambah ke Keranjang</a>
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
                    <h2 class="text-left"><i class="fa fa-shopping-cart"></i> Keranjang</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Barang</th>
                                <th scope="col">Unit</th>
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
                                <td><input type="number" onkeyup="changeQtyCart(event);" onchange="changeQtyCart2(event);" id="<?= 'input_kuantitas_cart_'.$k->id; ?>" data-cart_id="<?= $k->id; ?>" style="width:50px" value="<?= $k->total_kuantitas; ?>"></td>
                                <td><?= "Rp. <span id='subtotal-".$k->id."'>".number_format($k->total_harga)."</span>"; ?></td>
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
                                <th><?= 'Rp. <span id="total_harga_cart_right">'.number_format($t->total_harga).'</span>'; ?></th>
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