<script>
    $(function() {
        $('.tampil-modal-tambah').on('click', function() {
            $('#staticBackdropLabel').html('Tambah Ongkir');

            $('#type').val('add').attr('disabled', false);
            $('#ongkir_id').val('');
            $('#ongkir_lokasi').val('').attr('disabled', false);
            $('#ongkir_harga').val('').attr('disabled', false);
            $('#barang_button').html('Tambah Ongkir');
        });

        $('#bubbling').on('click', '.tampil-modal-ubah', function() {
            $('#staticBackdropLabel').html('Tambah Ongkir');

            const ongkir_id = $(this).data('ongkir_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/ongkir/show',
                data: {
                    ongkir_id: ongkir_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('edit');
                    $('#ongkir_id').val(data.ongkir_id);
                    $('#ongkir_lokasi').val(data.ongkir_lokasi).attr('disabled', false);
                    $('#ongkir_harga').val(data.ongkir_harga).attr('disabled', false);
                    $('#barang_button').html('Edit Ongkir');
                }
            });
        });

        $('#bubbling').on('click', '.tampil-modal-hapus', function() {
            $('#staticBackdropLabel').html('Hapus Ongkir (<small>rincian ongkir</small>)');

            const ongkir_id = $(this).data('ongkir_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/ongkir/show',
                data: {
                    ongkir_id: ongkir_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('delete');
                    $('#ongkir_id').val(data.ongkir_id);
                    $('#ongkir_lokasi').val(data.ongkir_lokasi).attr('disabled', true);
                    $('#ongkir_harga').val(data.ongkir_harga).attr('disabled', true);
                    $('#barang_button').html('Hapus Ongkir');
                }
            });
        });
    });
</script>