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
                                <a href="javascript:void(0)" class="btn btn-sm btn-primary" id="add-cart" data-barang_id="<?= $barang->barang_id; ?>" data-barang_nama="<?= $barang->barang_nama; ?>" data-barang_harjul="<?= $barang->barang_harjul; ?>" data-barang_gambar="<?= $barang->barang_gambar; ?>"><i class="fa fa-plus-circle"></i> Tambah ke Keranjang</a>
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
            <div class="" id="cart-right">
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
                    <tbody>
                        <tr class="text-left">
                            <td>Mark</td>
                            <td><input type="number" style="width: 50px;"></td>
                            <td>Rp. 20,000</td>
                            <td>
                                <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-xs btn-danger text-white tampil-modal-hapus" data-barang_id="<?= $barang->barang_id; ?>"><i class="fa fa-trash"></i> Hapus(belum selesai)</button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2">Total</th>
                            <th>Rp. 20,000</th>
                        </tr>
                    </tfoot>
                </table>
                <button class="btn btn-primary btn-block">Checkout(belum selesai)</button>
            </div>
        </div>
    </div>
</div>