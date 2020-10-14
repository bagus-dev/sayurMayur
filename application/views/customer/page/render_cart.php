<tr class="text-left" id="cart_row_<?= $id; ?>">
    <td id="nama-<?= $id; ?>"><?= $nama_barang; ?></td>
    <td>
        <?php if ($kuantitas >= 1) { ?>
            <input type="number" id="input_kuantitas_cart_<?= $id; ?>" class="qty_input" onkeyup="changeQtyCart(event);" onchange="changeQtyCart2(event);" data-cart_id="<?= $id; ?>" style="width:50px" value="<?= $kuantitas; ?>">
        <?php } else if ($kuantitas < 1) { ?>
            <select name="select_qty_cart" id="select_qty_cart_<?= $id; ?>" onchange="changeQtyCart(event);" style="width:50px">
                <option value="0.25" <?= ($kuantitas == 0.25) ? 'selected' : ''; ?>>1/4</option>
                <option value="0.5" <?= ($kuantitas == 0.5) ? 'selected' : ''; ?>>1/2</option>
                <option value="0.75" <?= ($kuantitas == 0.75) ? 'selected' : ''; ?>>3/4</option>
            </select>
        <?php }  ?>
    </td>
    <td><span id="subtotal-<?= $id; ?>"><?= number_format($subtotal); ?></span></td>
    <td><button class="btn btn-xs btn-danger text-white" data-id="<?= $id; ?>" onclick="hapusCart(event);"><i class="fa fa-trash"></i> Hapus</button></td>
</tr>