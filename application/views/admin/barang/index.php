<div class="container" style="margin-top: 100px;">
    <h1 class="pb-3 border-bottom">Data<small>Barang</small></h1>

    <div class="row">
        <div class="col-md-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="p-3">
                <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-sm btn-primary float-right tampil-modal-tambah">Tambah Barang</button>
                <table id="datable" class="table table-striped projects">
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
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bubbling">
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
                                <td style="text-align:center;">
                                    <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-xs btn-warning text-white tampil-modal-ubah" data-barang_id="<?= $barang->barang_id; ?>"><i class="fa fa-edit"></i> Edit</button>
                                    <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-xs btn-danger text-white tampil-modal-hapus" data-barang_id="<?= $barang->barang_id; ?>"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
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
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="type" id="type">
                <input type="hidden" name="barang_id" id="barang_id">
                <input type="hidden" name="barang_gambar_hidden" id="barang_gambar_hidden">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Nama Barang</label>
                        <div class="col-sm-9">
                            <input name="barang_nama" id="barang_nama" class="form-control" type="text" placeholder="Nama Barang..." required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto" id="barang_gambar_label">Upload Gambar</label>
                        <div class="col-sm-9">
                            <input name="barang_gambar" id="barang_gambar" class="form-control" type="file">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Kategori</label>
                        <div class="col-sm-9">
                            <select name="barang_kategori_id" id="barang_kategori_id" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($kategoris->result() as $kategori) : ?>
                                    <option value="<?= $kategori->kategori_id; ?>"><?= $kategori->kategori_nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Satuan</label>
                        <div class="col-sm-9">
                            <select name="barang_satuan_id" id="barang_satuan_id" class="form-control" required>
                                <option value="">Pilih Satuan</option>
                                <?php foreach ($satuans->result() as $satuan) : ?>
                                    <option value="<?= $satuan->satuan_id; ?>"><?= $satuan->satuan_nama; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Harga Pokok</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input name="barang_harpok" id="barang_harpok" class="harpok form-control" type="text" placeholder="Harga Pokok...">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Harga (Eceran)</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input name="barang_harjul" id="barang_harjul" class="harjul form-control" type="text" placeholder="Harga Jual Eceran...">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Harga (Grosir)</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">Rp.</div>
                                </div>
                                <input name="barang_harjul_grosir" id="barang_harjul_grosir" class="harjul form-control" type="text" placeholder="Harga Jual Grosir...">
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Stok</label>
                        <div class="col-sm-9">
                            <input name="barang_stok" id="barang_stok" class="form-control" type="number" placeholder="Stok...">
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