<div class="container" style="margin-top: 100px;">
    <h1 class="pb-3 border-bottom">Data<small>Customer (Terdaftar)</small></h1>

    <div class="row">
        <div class="col-md-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="p-3">
                <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-sm btn-primary float-right tampil-modal-tambah">Tambah Diskon</button>
                <table id="datable" class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Diskon tiap pembelian</th>
                            <th>Diskon</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bubbling">
                        <?php foreach ($diskons->result() as $index => $diskon) : ?>
                            <tr>
                                <td><?= ++$index; ?></td>
                                <td><?= 'Rp. ' . number_format($diskon->diskon_harga); ?></td>
                                <td><?= $diskon->diskon_persen; ?>%</td>
                                <td style="text-align:center;">
                                    <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-xs btn-warning text-white tampil-modal-ubah" data-diskon_id="<?= $diskon->diskon_id; ?>"><i class="fa fa-edit"></i> Edit</button>
                                    <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-xs btn-danger text-white tampil-modal-hapus" data-diskon_id="<?= $diskon->diskon_id; ?>"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Diskon tiap pembelian</th>
                            <th>Diskon</th>
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
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Diskon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="type" id="type">
                <input type="hidden" name="diskon_id" id="diskon_id">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Diskon per</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input name="diskon_harga" id="diskon_harga" class="harpok form-control" type="text" placeholder="Diskon tiap pembelian...">
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Diskon</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <input name="diskon_persen" id="diskon_persen" class="form-control" type="number" placeholder="Diskon...">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="barang_button">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>