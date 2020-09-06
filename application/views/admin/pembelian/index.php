<div class="container" style="margin-top: 100px;">
    <h1 class="pb-3 border-bottom">Transaksi<small>Pembelian</small></h1>

    <div class="row">
        <div class="col-md-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="alert alert-danger d-none" id="alert" role="alert">
        <span id="message">Produk Belum dipilih</span>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card text-left p-3 shadows">
                <div class="form-group row">
                    <label for="beli_tanggal" class="col-sm-4 col-form-label">Date</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="beli_tanggal" name="beli_tanggal" value="<?= date('Y-m-d'); ?>" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="beli_user_nama" class="col-sm-4 col-form-label">Kasir</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="beli_user_nama" name="beli_user_nama" value="<?= $this->session->userdata('user_nama'); ?>" readonly>

                        <input type="hidden" name="beli_user_id" value="<?= $this->session->userdata('user_id'); ?>">
                    </div>
                </div>
                <div class=" form-group row">
                    <label for="kasir" class="col-sm-4 col-form-label">Suplier</label>
                    <div class="col-sm-8">
                        <select class="form-control select2bs4" id="beli_suplier_id">
                            <?php foreach ($supliers->result() as $suplier) : ?>
                                <option value="<?= $suplier->suplier_id; ?>"><?= $suplier->suplier_nama ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-left p-3 shadows">
                <input type="hidden" name="beli_nofak" id="beli_nofak" value="<?= $nofak; ?>">
                <p class="text-black-50 text-right">Invoice <span class="text-dark"><?= $nofak; ?></span></p>
                <h2 class="text-right" style="font-size: 95px;" id="grandtotal2">0</h2>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card text-left p-3 shadows">
                <div class="form-group row">
                    <label for="keterangan" class="col-sm-4 col-form-label"><span style="color: red;">* </span>Pembelian Keterangan</label>
                    <div class="col-sm-8">
                        <select class="form-control" id="keterangan">
                            <option value="eceran">Eceran</option>
                            <option value="grosir">Grosir</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="keterangan_hidden" id="keterangan_hidden" value="eceran">

                <div class="form-group row">
                    <label for="c_beli_barang_id" class="col-sm-4 col-form-label"><span style="color: red;">* </span>Kode Barang</label>
                    <div class="col-sm-8 input-group">
                        <input type="hidden" id="c_beli_barang_nama">
                        <input type="hidden" id="c_beli_barang_satuan">
                        <input type="hidden" id="c_beli_barang_harpok">
                        <input type="hidden" id="c_beli_barang_harjul">
                        <input type="hidden" id="c_beli_barang_harjul_grosir">
                        <input type="hidden" id="stok">
                        <input type="hidden" id="stok_cart">

                        <input type="text" class="form-control" placeholder="Kode Barang" id="c_beli_barang_id" readonly>
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="button" id="button-addon2" data-toggle="modal" data-target="#staticBackdrop"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="c_beli_qty" class="col-sm-4 col-form-label"><span style="color: red;">* </span>Qty</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" id="c_beli_qty" value="1">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-8 col-md-12 offset-sm-4">
                        <button class="btn btn-primary" id="add_cart">Tambah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card p-3 shadows">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Kode Barang</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Harga Barang</th>
                            <th scope="col">Jumlah Barang</th>
                            <th scope="col">Diskon Barang</th>
                            <th scope="col">Total</th>
                            <th scope="col">Opsi</th>
                        </tr>
                    </thead>
                    <tbody id="cart_table">
                        <?php $this->view('admin/pembelian/cart_data'); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card text-left p-3 shadows">
                <div class="form-group row">
                    <label for="subtotal" class="col-sm-4 col-form-label">Sub Total</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="text" class="form-control" id="subtotal" readonly>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="diskon" class="col-sm-4 col-form-label">Diskon</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="text" class="form-control" id="diskon" value="0">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="grandtotal" class="col-sm-4 col-form-label">Grand Total</label>
                    <div class="col-sm-8">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="text" class="form-control" id="grandtotal" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-left p-3 shadows">
                <div class="form-group row">
                    <label for="pembayaran" class="col-sm-4 col-form-label"><span style="color: red;">* </span>Pembayaran</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text" style="margin-bottom:14px">Rp.</div>
                            </div>
                            <input type="text" class="form-control" style="margin-bottom:14px" id="pembayaran" value="0" required>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="kembalian" class="col-sm-4 col-form-label">Kembalian</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Rp.</div>
                            </div>
                            <input type="text" class="form-control" id="kembalian" readonly>
                        </div>
                    </div>
                    <button class="btn btn-block btn-primary mt-3" id="payment_proses">Payment Proses</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">List Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <small class="mx-3 mt-3"><span style="color: red;">*</span>Jika berwarna hijau maka perlu di tambah keranjang untuk menambahkan stok</small>
            <div class="modal-body table-responsive">
                <table id="datable" class="table table-bordered table-striped projects">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Pokok</th>
                            <th>Harga (Eceran)</th>
                            <th>Harga (Grosir)</th>
                            <th>Stok</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bubbling">
                        <?php foreach ($barangs->result() as $index => $barang) : ?>
                            <tr <?= $barang->barang_stok <= 10 ? 'style="background-color: rgba(0,255,0,.3);"' : ''; ?>>
                                <td><?= ++$index; ?></td>
                                <td><?= $barang->barang_id; ?></td>
                                <td><?= $barang->barang_nama; ?></td>
                                <td><?= 'Rp. ' . number_format($barang->barang_harpok); ?></td>
                                <td><?= 'Rp. ' . number_format($barang->barang_harjul); ?></td>
                                <td><?= 'Rp. ' . number_format($barang->barang_harjul_grosir); ?></td>
                                <td><?= $barang->barang_stok; ?></td>
                                <td style="text-align:center;">
                                    <button class="btn btn-xs btn-primary text-white" id="add" data-c_beli_barang_id="<?= $barang->barang_id; ?>" data-c_beli_barang_nama="<?= $barang->barang_nama; ?>" data-c_beli_barang_satuan="<?= $barang->satuan_nama; ?>" data-c_beli_barang_harpok="<?= $barang->barang_harpok; ?>" data-c_beli_barang_harjul="<?= $barang->barang_harjul; ?>" data-c_beli_barang_harjul_grosir="<?= $barang->barang_harjul_grosir; ?>" data-stok="<?= $barang->barang_stok; ?>"><i class="fa fa-edit"></i> Pilih</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Pokok</th>
                            <th>Harga (Eceran)</th>
                            <th>Harga (Grosir)</th>
                            <th>Stok</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>