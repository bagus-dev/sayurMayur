<script>
    $(function() {
        $('.tampil-modal-tambah').on('click', function() {
            $('#staticBackdropLabel').html('Tambah Diskon');

            $('#type').val('add').attr('disabled', false);
            $('#diskon_id').val('');
            $('#diskon_harga').val('').attr('disabled', false);
            $('#barang_button').html('Tambah Diskon');
        });

        $('#bubbling').on('click', '.tampil-modal-ubah', function() {
            $('#staticBackdropLabel').html('Tambah Diskon');

            const diskon_id = $(this).data('diskon_id');

            $.ajax({
                url: '<?= base_url(); ?>/diskon/show',
                data: {
                    diskon_id: diskon_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('edit');
                    $('#diskon_id').val(data.diskon_id);
                    $('#diskon_harga').val(data.diskon_harga).attr('disabled', false);
                    $('#diskon_persen').val(data.diskon_persen).attr('disabled', false);
                    $('#barang_button').html('Edit Diskon');
                }
            });
        });

        $('#bubbling').on('click', '.tampil-modal-hapus', function() {
            $('#staticBackdropLabel').html('Hapus Diskon (<small>rincian diskon</small>)');

            const diskon_id = $(this).data('diskon_id');

            $.ajax({
                url: '<?= base_url(); ?>/diskon/show',
                data: {
                    diskon_id: diskon_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('delete');
                    $('#diskon_id').val(data.diskon_id);
                    $('#diskon_harga').val(data.diskon_harga).attr('disabled', true);
                    $('#diskon_persen').val(data.diskon_persen).attr('disabled', true);
                    $('#barang_button').html('Hapus Diskon');
                }
            });
        });
    });
</script>