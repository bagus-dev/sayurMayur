<div class="container" style="margin-top: 100px;">
    <h1 class="pb-3 border-bottom">Laporan<small>Penjualan</small></h1>

    <div class="row">
        <div class="col-md-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3>Cetak Laporan</h3>
                    <hr class="mt-0 pb-3">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="text" name="tgl_mulai" id="tgl_mulai" placeholder="dd/mm/yyyy" onchange="btnCheck(event);" class="form-control datetimepicker-input datetimepicker" data-toggle="datetimepicker" data-target="#tgl_mulai">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Akhir</label>
                                <input type="text" name="tgl_akhir" id="tgl_akhir" placeholder="dd/mm/yyyy" onchange="btnCheck(event);" class="form-control datetimepicker-input datetimepicker" data-toggle="datetimepicker" data-target="#tgl_akhir">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <br>
                            <button class="btn btn-primary mt-2 w-100" id="btn-laporan" onclick="cetakLaporan();" disabled>Cetak Laporan</button>
                        </div>
                    </div>
                    <h3 class="mt-4">Transaksi</h3>
                    <hr class="mt-0">
                    <table id="datable" class="table table-striped projects">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Faktur</th>
                                <th>Tanggal</th>
                                <th>Kasir</th>
                                <th>Customer</th>
                                <th>Total Harga</th>
                                <th>Total Pembayaran</th>
                                <th>Total Kembalian</th>
                                <th>Keterangan</th>
                                <th style="width:100px;text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="bubbling">
                            <?php foreach ($penjualans->result() as $index => $penjualan) : ?>
                                <?php $customer = $this->db->get_where('tbl_customer', ['customer_id' => $penjualan->jual_customer_id])->row(); ?>

                                <tr>
                                    <td><?= ++$index; ?></td>
                                    <td><?= $penjualan->jual_nofak; ?></td>
                                    <td><?= $penjualan->jual_tanggal; ?></td>
                                    <td><?= $penjualan->user_nama; ?></td>
                                    <td><?= $customer->customer_nama; ?></td>
                                    <td><?= 'Rp. ' . number_format($penjualan->jual_total); ?></td>
                                    <td><?= 'Rp. ' . number_format($penjualan->jual_jml_uang); ?></td>
                                    <td><?= 'Rp. ' . number_format($penjualan->jual_kembalian); ?></td>
                                    <td><?= $penjualan->jual_keterangan; ?></td>
                                    <td style="text-align:center;">
                                        <a href="<?= site_url(); ?>penjualan/laporan_detail/<?= $penjualan->jual_nofak; ?>" class="btn btn-xs btn-info text-white"><i class="fa fa-edit"></i> Detail</a>
                                        <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-xs btn-danger text-white tampil-modal-hapus" data-jual_id="<?= $penjualan->jual_nofak; ?>"><i class="fa fa-trash"></i> Hapus</button>
                                        <a href="<?= site_url(); ?>penjualan/struk_print/<?= $penjualan->jual_nofak; ?>" target="_blank" class="btn btn-xs btn-success text-white"><i class="fa fa-print"></i> Cetak Struk</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>No Faktur</th>
                                <th>Tanggal</th>
                                <th>Kasir</th>
                                <th>Customer</th>
                                <th>Total Harga</th>
                                <th>Total Pembayaran</th>
                                <th>Total Kembalian</th>
                                <th>Keterangan</th>
                                <th style="width:100px;text-align:center;">Aksi</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- End-Card-Body -->
    </div>
</div>
</div>

<!-- ============ MODAL UNIVERSAL =============== -->
<div class="modal fade" id="modalUniversal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Hapus Laporan Penjualan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <p id="alert-delete" class="text-danger text-center mt-3 d-none">Jika mengahpus penjualan ini maka <b>detail penjualan</b> dari nomor faktur ini pun akan terhapus!</p>

            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="jual_id" id="jual_id">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="barang_button">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>