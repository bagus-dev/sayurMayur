<script>
    $(function() {
        $('.tampil-modal-tambah').on('click', function() {
            $('#staticBackdropLabel').html('Tambah Satuan');
            $('#alert-delete').addClass('d-none');

            $('#type').val('add').attr('disabled', false);
            $('#satuan_id').val('');
            $('#satuan_nama').val('').attr('disabled', false);
            $('#barang_button').html('Tambah Satuan');
        });

        $('#bubbling').on('click', '.tampil-modal-ubah', function() {
            $('#staticBackdropLabel').html('Edit Satuan');
            $('#alert-delete').addClass('d-none');

            const satuan_id = $(this).data('satuan_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/satuan/show',
                data: {
                    satuan_id: satuan_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('edit');
                    $('#satuan_id').val(data.satuan_id);
                    $('#satuan_nama').val(data.satuan_nama).attr('disabled', false);
                    $('#barang_button').html('Edit Satuan');
                }
            });
        });

        $('#bubbling').on('click', '.tampil-modal-hapus', function() {
            $('#staticBackdropLabel').html('Hapus Satuan (<small>rincian satuan</small>)');
            $('#alert-delete').removeClass('d-none');

            const satuan_id = $(this).data('satuan_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/satuan/show',
                data: {
                    satuan_id: satuan_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('delete');
                    $('#satuan_id').val(data.satuan_id);
                    $('#satuan_nama').val(data.satuan_nama).attr('disabled', true);
                    $('#barang_button').html('Hapus Satuan');
                }
            });
        });
    });
</script>