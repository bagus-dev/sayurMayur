<script>
    $(function() {
        $('.tampil-modal-tambah').on('click', function() {
            $('#staticBackdropLabel').html('Tambah Waktu');
            $('#alert-delete').addClass('d-none');

            $('#type').val('add').attr('disabled', false);
            $('#waktu_id').val('');
            $('#waktu_nama').val('').attr('disabled', false);
            $('#waktu_awal').val('').attr('disabled', false);
            $('#waktu_akhir').val('').attr('disabled', false);
            $('#barang_button').html('Tambah Waktu');
        });

        $('#bubbling').on('click', '.tampil-modal-ubah', function() {
            $('#staticBackdropLabel').html('Edit Waktu');
            $('#alert-delete').addClass('d-none');

            const waktu_id = $(this).data('waktu_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/waktu/show',
                data: {
                    waktu_id: waktu_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('edit');
                    $('#waktu_id').val(data.waktu_id);
                    $('#waktu_nama').val(data.waktu_nama).attr('disabled', false);
                    $('#waktu_awal').val(data.waktu_awal).attr('disabled', false);
                    $('#waktu_akhir').val(data.waktu_akhir).attr('disabled', false);
                    $('#barang_button').html('Edit Waktu');
                }
            });
        });

        $('#bubbling').on('click', '.tampil-modal-hapus', function() {
            $('#staticBackdropLabel').html('Hapus Waktu (<small>rincian waktu</small>)');
            $('#alert-delete').removeClass('d-none');

            const waktu_id = $(this).data('waktu_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/waktu/show',
                data: {
                    waktu_id: waktu_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('delete');
                    $('#waktu_id').val(data.waktu_id);
                    $('#waktu_nama').val(data.waktu_nama).attr('disabled', true);
                    $('#waktu_awal').val(data.waktu_awal).attr('disabled', true);
                    $('#waktu_akhir').val(data.waktu_akhir).attr('disabled', true);
                    $('#barang_button').html('Hapus Waktu');
                }
            });
        });
    });
</script>