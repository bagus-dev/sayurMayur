<div class="container" style="margin-top: 100px;">
    <h1 class="pb-3 border-bottom">Laporan<small>Pembelian</small></h1>

    <div class="row">
        <div class="col-md-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="p-3">
                <table id="datable" class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Faktur</th>
                            <th>Tanggal</th>
                            <th>Karyawan</th>
                            <th>Suplier</th>
                            <th>Total Harga</th>
                            <th>Total Pembayaran</th>
                            <th>Total Kembalian</th>
                            <th>Keterangan</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bubbling">
                        <?php foreach ($pembelians->result() as $index => $pembelian) : ?>
                            <?php $suplier = $this->db->get_where('tbl_suplier', ['suplier_id' => $pembelian->beli_suplier_id])->row(); ?>

                            <tr>
                                <td><?= ++$index; ?></td>
                                <td><?= $pembelian->beli_nofak; ?></td>
                                <td><?= $pembelian->beli_tanggal; ?></td>
                                <td><?= $pembelian->user_nama; ?></td>
                                <td><?= $suplier->suplier_nama; ?></td>
                                <td><?= 'Rp. ' . number_format($pembelian->beli_total); ?></td>
                                <td><?= 'Rp. ' . number_format($pembelian->beli_jml_uang); ?></td>
                                <td><?= 'Rp. ' . number_format($pembelian->beli_kembalian); ?></td>
                                <td><?= $pembelian->beli_keterangan; ?></td>
                                <td style="text-align:center;">
                                    <a href="<?= site_url(); ?>pembelian/laporan_detail/<?= $pembelian->beli_nofak; ?>" class="btn btn-xs btn-info text-white"><i class="fa fa-edit"></i> Detail</a>
                                    <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-xs btn-danger text-white tampil-modal-hapus" data-beli_id="<?= $pembelian->beli_nofak; ?>"><i class="fa fa-trash"></i> Hapus</button>
                                    <a href="<?= site_url(); ?>pembelian/struk_print/<?= $pembelian->beli_nofak; ?>" target="_blank" class="btn btn-xs btn-success text-white"><i class="fa fa-print"></i> Cetak Struk</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>No Faktur</th>
                            <th>Tanggal</th>
                            <th>Karyawan</th>
                            <th>Suplier</th>
                            <th>Total Harga</th>
                            <th>Total Pembayaran</th>
                            <th>Total Kembalian</th>
                            <th>Keterangan</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </tfoot>
                </table>
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
                <h5 class="modal-title" id="staticBackdropLabel">Hapus Laporan Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <p id="alert-delete" class="text-danger text-center mt-3 d-none">Jika mengahpus pembelian ini maka <b>detail pembelian</b> dari nomor faktur ini pun akan terhapus!</p>

            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <input type="text" name="beli_id" id="beli_id">

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="barang_button">Hapus</button>
                </div>
            </form>
        </div>
    </div>
</div>