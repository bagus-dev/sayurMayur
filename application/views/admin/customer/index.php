<div class="container" style="margin-top: 100px;">
    <h1 class="pb-3 border-bottom">Data<small>Customer</small></h1>

    <div class="row">
        <div class="col-md-12">
            <?= $this->session->flashdata('message2'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="p-3">
                <button data-toggle="modal" data-target="#modalUniversal2" class="btn btn-sm btn-primary float-right tampil-modal-tambah2">Tambah Customer</button>
                <table id="datable2" class="table table-striped projects">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>No Telp</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bubbling2">
                        <?php foreach ($customerOfflines->result() as $index => $customerOffline) : ?>
                            <tr>
                                <td><?= ++$index; ?></td>
                                <td><?= $customerOffline->customer_nama; ?></td>
                                <td><?= $customerOffline->customer_alamat; ?></td>
                                <td><?= $customerOffline->customer_notelp; ?></td>
                                <td style="text-align:center;">
                                    <button data-toggle="modal" data-target="#modalUniversal2" class="btn btn-xs btn-warning text-white tampil-modal-ubah2" data-customer_id="<?= $customerOffline->customer_id; ?>"><i class="fa fa-edit"></i> Edit</button>
                                    <button data-toggle="modal" data-target="#modalUniversal2" class="btn btn-xs btn-danger text-white tampil-modal-hapus2" data-customer_id="<?= $customerOffline->customer_id; ?>"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
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

    <!--  -->
    <h1 class="mt-5 pb-3 border-bottom">Data<small>Customer (Pengguna)</small></h1>

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
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th style="width:100px;text-align:center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="bubbling">
                        <?php foreach ($customers->result() as $index => $customer) : ?>
                            <tr>
                                <td><?= ++$index; ?></td>
                                <td><?= $customer->user_nama; ?></td>
                                <td><?= $customer->user_alamat; ?></td>
                                <td><?= $customer->user_username; ?></td>
                                <td><?= $customer->role_nama; ?></td>
                                <td style="text-align:center;">
                                    <button data-toggle="modal" data-target="#modalUniversal" class="btn btn-xs btn-danger text-white tampil-modal-hapus" data-user_id="<?= $customer->user_id; ?>"><i class="fa fa-trash"></i> Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Username</th>
                            <th>Role</th>
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
                <h5 class="modal-title" id="staticBackdropLabel">Tambah Pengguna</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="type" id="type">
                <input type="hidden" name="user_id" id="user_id">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Nama Pengguna</label>
                        <div class="col-sm-9">
                            <input name="user_nama" id="user_nama" class="form-control" type="text" placeholder="Nama Pengguna..." required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Alamat Pengguna</label>
                        <div class="col-sm-9">
                            <textarea name="user_alamat" id="user_alamat" class="form-control" placeholder="Alamat Pengguna..." required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Username</label>
                        <div class="col-sm-9">
                            <input name="user_username" id="user_username" class="form-control" type="text" placeholder="Username Pengguna..." required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Role</label>
                        <div class="col-sm-9">
                            <select name="user_role_id" id="user_role_id" class="form-control" disabled>
                                <option value="">Customer</option>
                            </select>
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

<!-- ============ MODAL UNIVERSAL =============== -->
<div class="modal fade" id="modalUniversal2" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel2">Tambah Customer</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-horizontal" method="post" action="" enctype="multipart/form-data">
                <input type="hidden" name="type" id="type2">
                <input type="hidden" name="customer_id" id="customer_id">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Nama Customer</label>
                        <div class="col-sm-9">
                            <input name="customer_nama" id="customer_nama" class="form-control" type="text" placeholder="Nama Customer..." required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">Alamat Customer</label>
                        <div class="col-sm-9">
                            <textarea name="customer_alamat" id="customer_alamat" class="form-control" placeholder="Alamat Customer..." required></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-3 text-right my-auto">No Telp</label>
                        <div class="col-sm-9">
                            <input name="customer_notelp" id="customer_notelp" class="form-control" type="text" placeholder="No Telp..." required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary" id="barang_button2">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>