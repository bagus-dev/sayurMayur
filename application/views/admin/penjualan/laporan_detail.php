<div class="container" style="margin-top: 100px;">
    <h1 class="pb-3 border-bottom">Laporan<small>Penjualan</small></h1>
    <small><?= $penjualan->jual_nofak; ?></small>

    <div class="row">
        <div class="col-md-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="p-3">
                <a href="<?= site_url('penjualan/laporan'); ?>" class="btn btn-sm btn-primary float-right tampil-modal-tambah">Kembali</a>
                <table id="datable" class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Pokok</th>
                            <th>Harga Jual</th>
                            <th>Julmah</th>
                            <th>Diskon</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody id="bubbling">
                        <?php foreach ($details->result() as $index => $detail) : ?>
                            <tr>
                                <td><?= ++$index; ?></td>
                                <td><?= $detail->d_jual_barang_id; ?></td>
                                <td><?= $detail->d_jual_barang_nama; ?></td>
                                <td><?= $detail->d_jual_barang_harpok; ?></td>
                                <td><?= $detail->d_jual_barang_harjul; ?></td>
                                <td><?= $detail->d_jual_qty; ?></td>
                                <td><?= $detail->d_jual_diskon; ?></td>
                                <td><?= $detail->d_jual_total; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Kode Barang</th>
                            <th>Nama Barang</th>
                            <th>Harga Pokok</th>
                            <th>Harga Jual</th>
                            <th>Julmah</th>
                            <th>Diskon</th>
                            <th>Total</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- End-Card-Body -->
        </div>
    </div>
</div>