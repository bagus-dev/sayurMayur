<script>
    $(function() {
        $('.tampil-modal-tambah').on('click', function() {
            $('#staticBackdropLabel').html('Tambah Pengguna');

            $('#type').val('add').attr('disabled', false);
            $('#user_id').val('');
            $('#user_nama').val('').attr('disabled', false);
            $('#user_alamat').val('').attr('disabled', false);
            $('#user_username').val('').attr('disabled', false);
            $('#user_password').val('').attr('disabled', false);
            $('#user_password_repeat').val('').attr('disabled', false);
            $('#user_role_id').val('').attr('disabled', false);
            $('#barang_button').html('Tambah Pengguna');
        });

        $('#bubbling').on('click', '.tampil-modal-ubah', function() {
            $('#staticBackdropLabel').html('Edit Pengguna');

            const user_id = $(this).data('user_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/pengguna/show',
                data: {
                    user_id: user_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('edit');
                    $('#user_id').val(data.user_id);
                    $('#user_nama').val(data.user_nama).attr('disabled', false);
                    $('#user_alamat').val(data.user_alamat).attr('disabled', false);
                    $('#user_username').val(data.user_username).attr('disabled', false);
                    $('#user_password').val('').attr('disabled', false);
                    $('#user_password_repeat').val('').attr('disabled', false);
                    if (data.user_id === '1') {
                        $('#user_role_id').val(data.user_role_id).attr('disabled', true);
                    } else {
                        $('#user_role_id').val(data.user_role_id).attr('disabled', false);
                    }
                }
            });
        });

        $('#bubbling').on('click', '.tampil-modal-hapus', function() {
            $('#staticBackdropLabel').html('Hapus Pengguna (<small>rincian pengguna</small>)');

            const user_id = $(this).data('user_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/pengguna/show',
                data: {
                    user_id: user_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type').val('delete');
                    $('#user_id').val(data.user_id);
                    $('#user_nama').val(data.user_nama).attr('disabled', true);
                    $('#user_alamat').val(data.user_alamat).attr('disabled', true);
                    $('#user_username').val(data.user_username).attr('disabled', true);
                    $('#user_password').val('').attr('disabled', true);
                    $('#user_password_repeat').val('').attr('disabled', true);
                    $('#user_role_id').val(data.user_role_id).attr('disabled', true);
                    $('#barang_button').html('Hapus Pengguna');
                }
            });
        });
    });
</script>