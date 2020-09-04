<div class="container" style="margin-top:100px;">
    <h1 class="pb-3 border-bottom"><i class="fa fa-shopping-cart"></i> Keranjang <small>Belanja</small></h1>
    <div class="row">
        <div class="col-12">
            <div class="overlay-wrapper">
                <div class="overlay" style="display:none" id="loading-section">
                    <i class="fas fa-3x fa-sync-alt fa-spin"></i>
                    <div class="text-bold pt-2">&nbsp; Loading...</div>
                </div>
                <div id="cart">
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
                                if($keranjangs->num_rows() >= 1){
                                    foreach($keranjangs->result() as $k) {
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
                    <button class="btn btn-primary btn-block" id="btn-cekout" <?php if($keranjangs->num_rows() == 0){echo "disabled"; } ?>>Checkout</button>
                </div>
            </div>
        </div>
    </div>
</div>