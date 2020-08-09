<script>
    $(function() {
        $('.tampil-modal-tambah').on('click', function() {
            $('#staticBackdropLabel').html('Tambah Barang');

            $('#type').val('add').attr('disabled', false);
            $('#barang_gambar_label').html('Upload Gambar');
            $('#barang_gambar').replaceWith(`<input name="barang_gambar" id="barang_gambar" class="form-control" type="file">`);
            $('#barang_id').val('').attr('disabled', false);
            $('#barang_nama').val('').attr('disabled', false);
            $('#barang_kategori_id').val('').attr('disabled', false);
            $('#barang_satuan_id').val('').attr('disabled', false);
            $('#barang_harpok').val('').attr('disabled', false);
            $('#barang_harjul').val('').attr('disabled', false);
            $('#barang_harjul_grosir').val('').attr('disabled', false);
            $('#barang_stok').val('').attr('disabled', false);
            $('#barang_button').html('Tambah Barang');
        });

        $('#bubbling').on('click', '.tampil-modal-ubah', function() {
            $('#staticBackdropLabel').html('Edit Barang');

            const barang_id = $(this).data('barang_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/barang/show',
                data: {
                    barang_id: barang_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('edit');
                    $('#barang_gambar_hidden').val(data.barang_gambar).attr('disabled', false);
                    $('#barang_gambar_label').html('Upload Gambar');
                    $('#barang_gambar').replaceWith(`<input name="barang_gambar" id="barang_gambar" class="form-control" type="file">`);
                    $('#barang_id').val(data.barang_id).attr('disabled', false);
                    $('#barang_nama').val(data.barang_nama).attr('disabled', false);
                    $('#barang_kategori_id').val(data.barang_kategori_id).attr('disabled', false);
                    $('#barang_satuan_id').val(data.barang_satuan_id).attr('disabled', false);
                    $('#barang_harpok').val(data.barang_harpok).attr('disabled', false);
                    $('#barang_harjul').val(data.barang_harjul).attr('disabled', false);
                    $('#barang_harjul_grosir').val(data.barang_harjul_grosir).attr('disabled', false);
                    $('#barang_stok').val(data.barang_stok).attr('disabled', false);
                    $('#barang_button').html('Edit Barang');
                }
            });
        });

        $('#bubbling').on('click', '.tampil-modal-hapus', function() {
            $('#staticBackdropLabel').html('Hapus Barang (<small>rincian barang</small>)');

            const barang_id = $(this).data('barang_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/barang/show',
                data: {
                    barang_id: barang_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('delete');
                    $('#barang_gambar_hidden').val(data.barang_gambar);
                    $('#barang_gambar_label').html('Gambar');
                    $('#barang_gambar').replaceWith(`<img src="http://localhost/project/project-point-of-sale/assets/source/images/barang/${data.barang_gambar}" style="width:100px; height:100px; object-fit:cover;" id="barang_gambar">`);
                    $('#barang_id').val(data.barang_id);
                    $('#barang_nama').val(data.barang_nama).attr('disabled', true);
                    $('#barang_kategori_id').val(data.barang_kategori_id).attr('disabled', true);
                    $('#barang_satuan_id').val(data.barang_satuan_id).attr('disabled', true);
                    $('#barang_harpok').val(data.barang_harpok).attr('disabled', true);
                    $('#barang_harjul').val(data.barang_harjul).attr('disabled', true);
                    $('#barang_harjul_grosir').val(data.barang_harjul_grosir).attr('disabled', true);
                    $('#barang_stok').val(data.barang_stok).attr('disabled', true);
                    $('#barang_button').html('Hapus Barang');
                }
            });
        });
    });
</script>