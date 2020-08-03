<script>
    $(function() {
        $('.tampil-modal-tambah').on('click', function() {
            $('#staticBackdropLabel').html('Tambah Suplier');

            $('#type').val('add').attr('disabled', false);
            $('#suplier_id').val('');
            $('#suplier_nama').val('').attr('disabled', false);
            $('#suplier_alamat').val('').attr('disabled', false);
            $('#suplier_notelp').val('').attr('disabled', false);
            $('#barang_button').html('Tambah Suplier');
        });

        $('#bubbling').on('click', '.tampil-modal-ubah', function() {
            $('#staticBackdropLabel').html('Edit Suplier');

            const suplier_id = $(this).data('suplier_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/suplier/show',
                data: {
                    suplier_id: suplier_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('edit');
                    $('#suplier_id').val(data.suplier_id);
                    $('#suplier_nama').val(data.suplier_nama).attr('disabled', false);
                    $('#suplier_alamat').val(data.suplier_alamat).attr('disabled', false);
                    $('#suplier_notelp').val(data.suplier_notelp).attr('disabled', false);
                    $('#barang_button').html('Edit Suplier');
                }
            });
        });

        $('#bubbling').on('click', '.tampil-modal-hapus', function() {
            $('#staticBackdropLabel').html('Hapus Suplier (<small>rincian suplier</small>)');

            const suplier_id = $(this).data('suplier_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/suplier/show',
                data: {
                    suplier_id: suplier_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('delete');
                    $('#suplier_id').val(data.suplier_id);
                    $('#suplier_nama').val(data.suplier_nama).attr('disabled', true);
                    $('#suplier_alamat').val(data.suplier_alamat).attr('disabled', true);
                    $('#suplier_notelp').val(data.suplier_notelp).attr('disabled', true);
                    $('#barang_button').html('Hapus Suplier');
                }
            });
        });
    });
</script>