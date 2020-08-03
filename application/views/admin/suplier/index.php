<div class="container" style="margin-top: 100px;">
    <h1 class="pb-3 border-bottom">Data<small>Suplier</small></h1>

    <div class="row">
        <div class="col-md-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="p-3">
                <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-sm btn-primary float-right tampil-modal-tambah">Tambah Supplier</button>
                <table id="datable" class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Suplier</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bubbling">
                        <?php foreach ($supliers->result() as $index => $suplier) : ?>
                            <tr>
                                <td><?= ++$index; ?></td>
                                <td><?= $suplier->suplier_nama; ?></td>
                                <td><?= $suplier->suplier_alamat; ?></td>
                                <td><?= $suplier->suplier_notelp; ?></td>
                                <td style="text-align:center;">
                                    <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-xs btn-warning text-white tampil-modal-ubah" data-suplier_id="<?= $suplier->suplier_id; ?>"><i class="fa fa-edit"></i> Edit</button>
                                    <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-xs btn-danger text-white tampil-modal-hapus" data-suplier_id="<?= $suplier->suplier_id; ?>"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama Suplier</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
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
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Suplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="type" id="type">
                <input type="hidden" name="suplier_id" id="suplier_id">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Nama Suplier</label>
                        <div class="col-sm-9">
                            <input name="suplier_nama" id="suplier_nama" class="form-control" type="text" placeholder="Nama Suplier..." required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Alamat</label>
                        <div class="col-sm-9">
                            <textarea name="suplier_alamat" id="suplier_alamat" class="form-control" placeholder="Suplier Alamat..." required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">No Telp</label>
                        <div class="col-sm-9">
                            <input name="suplier_notelp" id="suplier_notelp" class="form-control" type="text" placeholder="No Telp Suplier..." required>
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