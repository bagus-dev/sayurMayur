<?php foreach ($carts->result() as $index => $cart) : ?>
    <tr>
        <td><?= ++$index; ?></td>
        <td class="c_jual_barang_id"><?= $cart->c_jual_barang_id; ?></td>
        <td><?= $cart->c_jual_barang_nama; ?></td>
        <td class="text-right"><?= $cart->c_jual_barang_harjul; ?></td>
        <td><?= $cart->c_jual_qty; ?></td>
        <td class="text-right"><?= $cart->c_jual_diskon; ?></td>
        <td class="text-right" id="total"><?= $cart->c_jual_total; ?></td>
        <td style="text-align:center;">
            <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-xs btn-warning text-white tampil-modal-ubah" data-c_jual_barang_id="<?= $cart->c_jual_barang_id; ?>" data-c_jual_barang_nama="<?= $cart->c_jual_barang_nama; ?>" data-c_jual_barang_harjul="<?= $cart->c_jual_barang_harjul; ?>" data-c_jual_qty="<?= $cart->c_jual_qty; ?>" data-c_jual_diskon="<?= $cart->c_jual_diskon; ?>" data-c_jual_total="<?= $cart->c_jual_total; ?>" data-c_jual_total_before="<?= $cart->c_jual_total; ?>" data-barang_stok="<?= $cart->barang_stok; ?>"><i class="fa fa-edit"></i> Edit</button>
            <button class="btn btn-xs btn-danger text-white tampil-modal-hapus" id="del_cart" data-c_jual_id="<?= $cart->c_jual_id; ?>"><i class="fa fa-trash"></i> Hapus</button>
        </td>
    </tr>
<?php endforeach; ?>
<div class="modal fade" id="modalUniversal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="row mx-1 mt-1">
                <div class="col-md-12">
                    <div class="alert alert-danger d-none" id="alert2" role="alert">
                        <span id="message2">Produk Belum dipilih</span>
                    </div>
                </div>
            </div>

            <input type="hidden" name="type" id="type">
            <input type="hidden" name="satuan_id" id="satuan_id">
            <div class="modal-body">
                <div class="form-group row">
                    <label class="control-label col-sm-3 text-right my-auto">Kode Barang</label>
                    <div class="col-sm-9">
                        <input name="c_jual_barang_id" id="c_jual_barang_id2" class="form-control" type="text" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-3 text-right my-auto">Nama Barang</label>
                    <div class="col-sm-9">
                        <input name="c_jual_barang_nama" id="c_jual_barang_nama2" class="form-control" type="text" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-3 text-right my-auto">Harga Barang</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input name="c_jual_barang_harjul" id="c_jual_barang_harjul2" class="harpok form-control" type="number">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-3 text-right my-auto">Stok</label>
                    <div class="col-sm-9">
                        <input name="barang_stok" id="barang_stok" class="form-control" type="number" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-3 text-right my-auto">Jumlah Barang</label>
                    <div class="col-sm-9">
                        <input name="c_jual_qty" id="c_jual_qty2" class="form-control" type="number">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-3 text-right my-auto">Diskon Barang</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input name="c_jual_diskon" id="c_jual_diskon" class="harpok form-control" type="number">
                        </div>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="control-label col-sm-3 text-right my-auto">Total</label>
                    <div class="col-sm-9">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input name="c_jual_total" id="c_jual_total" class="harpok form-control" type="number" readonly>
                            <input name="c_jual_total_before" id="c_jual_total_before" class="harpok form-control" type="hidden" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="edt_cart">Simpan</button>
            </div>
        </div>
    </div>
</div>