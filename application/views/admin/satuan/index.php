<div class="container" style="margin-top: 100px;">
    <h1 class="pb-3 border-bottom">Data<small>Satuan</small></h1>

    <div class="row">
        <div class="col-md-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="p-3">
                <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-sm btn-primary float-right tampil-modal-tambah">Tambah Satuan</button>
                <table id="datable" class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Satuan</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bubbling">
                        <?php foreach ($satuans->result() as $index => $satuan) : ?>
                            <tr>
                                <td><?= ++$index; ?></td>
                                <td><?= $satuan->satuan_nama; ?></td>
                                <td style="text-align:center;">
                                    <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-xs btn-warning text-white tampil-modal-ubah" data-satuan_id="<?= $satuan->satuan_id; ?>"><i class="fa fa-edit"></i> Edit</button>
                                    <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-xs btn-danger text-white tampil-modal-hapus" data-satuan_id="<?= $satuan->satuan_id; ?>"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Satuan</th>
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
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Satuan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <p id="alert-delete" class="text-danger text-center mt-3 d-none">Jika mengahpus satuan ini maka <b>barang</b> dengan satuan ini pun akan terhapus!</p>

            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="type" id="type">
                <input type="hidden" name="satuan_id" id="satuan_id">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Nama Satuan</label>
                        <div class="col-sm-9">
                            <input name="satuan_nama" id="satuan_nama" class="form-control" type="text" placeholder="Nama Satuan..." required>
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