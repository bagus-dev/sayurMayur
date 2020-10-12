<script>
    $(function() {
        $('.tampil-modal-tambah').on('click', function() {
            $('#staticBackdropLabel').html('Tambah Kategori');
            $('#alert-delete').addClass('d-none');

            $('#type').val('add').attr('disabled', false);
            $('#kategori_id').val('');
            $('#kategori_nama').val('').attr('disabled', false);
            $('#barang_button').html('Tambah Kategori');
        });

        $('#bubbling').on('click', '.tampil-modal-ubah', function() {
            $('#staticBackdropLabel').html('Tambah Kategori');
            $('#alert-delete').addClass('d-none');

            const kategori_id = $(this).data('kategori_id');

            $.ajax({
                url: '<?= base_url(); ?>/kategori/show',
                data: {
                    kategori_id: kategori_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('edit');
                    $('#kategori_id').val(data.kategori_id);
                    $('#kategori_nama').val(data.kategori_nama).attr('disabled', false);
                    $('#barang_button').html('Edit Kategori');
                }
            });
        });

        $('#bubbling').on('click', '.tampil-modal-hapus', function() {
            $('#staticBackdropLabel').html('Hapus Kategori (<small>rincian kategori</small>)');
            $('#alert-delete').removeClass('d-none');

            const kategori_id = $(this).data('kategori_id');

            $.ajax({
                url: '<?= base_url(); ?>/kategori/show',
                data: {
                    kategori_id: kategori_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('delete');
                    $('#kategori_id').val(data.kategori_id);
                    $('#kategori_nama').val(data.kategori_nama).attr('disabled', true);
                    $('#barang_button').html('Hapus Kategori');
                }
            });
        });
    });
</script>