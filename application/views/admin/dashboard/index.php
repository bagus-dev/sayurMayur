<div class="container" style="margin-top: 100px;">
    <h1 class="pb-3 border-bottom">Selamat Datang <small>Point of Sale</small></h1>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Barang Hampir Habis
                        <br><small>Silahkan tambah stok di data master <a href="<?= site_url('barang') ?>">Barang</a> atau di transaksi <a href="<?= site_url('pembelian'); ?>">Pembelian</a></small>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 300px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Gambar Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Satuan</th>
                                <th>Harga Pokok</th>
                                <th>Harga (Eceran)</th>
                                <th>Harga (Grosir)</th>
                                <th>Stok</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($barangs->result() as $index => $barang) : ?>
                                <tr>
                                    <td><?= ++$index; ?></td>
                                    <td><?= $barang->barang_id; ?></td>
                                    <td style="text-align:center;"><img src="<?= base_url(); ?>assets/source/images/barang/<?= $barang->barang_gambar ?>" alt="<?= $barang->barang_id; ?>" style="width: 80px; height:80px; object-fit:cover;"></td>
                                    <td><?= $barang->barang_nama; ?></td>
                                    <td><?= $barang->kategori_nama; ?></td>
                                    <td><?= $barang->satuan_nama; ?></td>
                                    <td><?= 'Rp. ' . number_format($barang->barang_harpok); ?></td>
                                    <td><?= 'Rp. ' . number_format($barang->barang_harjul); ?></td>
                                    <td><?= 'Rp. ' . number_format($barang->barang_harjul_grosir); ?></td>
                                    <td><?= $barang->barang_stok; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
    <div class="row mt-3">
        <div class="col-md-12">
            <h2><small class="text-secondary">Data Master</small></h2>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <a href="<?= site_url(); ?>barang">
                <div class="card p-4 light-blue shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Barang</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= site_url(); ?>kategori">
                <div class="card p-4 orange shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-sitemap" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Kategori</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= site_url(); ?>satuan">
                <div class="card p-4 light-color shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-balance-scale" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Satuan</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= base_url(); ?>pengguna">
                <div class="card p-4 light-red shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-users" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Pengguna</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= site_url(); ?>suplier">
                <div class="card p-4 red shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-truck" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Suplier</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= site_url(); ?>customer">
                <div class="card p-4 color shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-users" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Customer</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= site_url(); ?>diskon">
                <div class="card p-4 blue shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-credit-card" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Diskon</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= site_url(); ?>ongkir">
                <div class="card p-4 light-orange shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-motorcycle" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Ongkir</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= site_url(); ?>waktu">
                <div class="card p-4 blue shadows-box text-white">
                    <div class="text-center">
                        <i class="fas fa-clock" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Waktu</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h2><small class="text-secondary">Transaksi</small></h2>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <a href="<?= site_url(); ?>pembelian">
                <div class="card p-4 light-blue shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Pembelian</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= site_url(); ?>penjualan">
                <div class="card p-4 orange shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Penjualan Offline (Kasir)</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= site_url(); ?>penjualan-online">
                <div class="card p-4 light-color shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-cart-plus" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Penjualan Online</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <h2><small class="text-secondary">Laporan</small></h2>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-3">
            <a href="<?= site_url(); ?>pembelian/laporan">
                <div class="card p-4 light-blue shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Pembelian</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= site_url(); ?>penjualan/laporan">
                <div class="card p-4 orange shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Penjualan Offline (Kasir)</h5>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="<?= site_url("penjualan_online/laporan"); ?>">
                <div class="card p-4 light-color shadows-box text-white">
                    <div class="text-center">
                        <i class="fa fa-cart-plus" aria-hidden="true" style="font-size:4em"></i>
                        <h5 class="mt-3">Penjualan Online</h5>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>