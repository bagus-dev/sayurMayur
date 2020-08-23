<div class="container" style="margin-top:200px">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center">Unggah Bukti Transfer</h1>
                </div>
                <div class="col-12 mt-3">
                    <small class="text-danger font-weight-bold">
                        Foto Bukti Transfer harus terlihat dengan jelas.
                        <br>
                        Format yang didukung: JPG, PNG, JPEG.
                        <br>
                        Maksimal file yang diunggah: 500 KB.
                    </small>
                    <br class="mt-3">
                    <?= $this->session->flashdata('message'); ?>
                    <form action="" method="post" enctype="multipart/form-data" class="mt-3">
                        <div class="form-group">
                            <div class="custom-file">
                                <input type="file" name="bukti_trf" id="bukti_transfer" class="custom-file-input" accept=".png,.jpg,.jpeg" required>
                                <label class="custom-file-label" for="bukti_transfer">Pilih Gambar</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <button name="submit" type="submit" class="btn btn-primary">Unggah Bukti Transfer</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>