<script>
    $(function() {
        $('#bubbling').on('click', '.tampil-modal-hapus', function() {
            $('#staticBackdropLabel').html('Hapus Customer (<small>rincian customer</small>)');

            const user_id = $(this).data('user_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/customer/show',
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
                    $('#barang_button').html('Hapus Customer');
                }
            });
        });

        // 
        $('.tampil-modal-tambah2').on('click', function() {
            $('#staticBackdropLabel2').html('Tambah Customer');

            $('#type2').val('add2').attr('disabled', false);
            $('#customer_id').val('');
            $('#customer_nama').val('').attr('disabled', false);
            $('#customer_alamat').val('').attr('disabled', false);
            $('#customer_notelp').val('').attr('disabled', false);
            $('#barang_button2').html('Tambah Customer');
        });

        $('#bubbling2').on('click', '.tampil-modal-ubah2', function() {
            $('#staticBackdropLabel2').html('Edit Customer');

            const customer_id = $(this).data('customer_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/customer/show2',
                data: {
                    customer_id: customer_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type2').val('edit2');
                    $('#customer_id').val(data.customer_id);
                    $('#customer_nama').val(data.customer_nama).attr('disabled', false);
                    $('#customer_alamat').val(data.customer_alamat).attr('disabled', false);
                    $('#customer_notelp').val(data.customer_notelp).attr('disabled', false);
                    $('#barang_button2').html('Edit Customer');
                }
            });
        });

        $('#bubbling2').on('click', '.tampil-modal-hapus2', function() {
            $('#staticBackdropLabel2').html('Hapus Customer (<small>rincian kategori</small>)');

            const customer_id = $(this).data('customer_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/customer/show2',
                data: {
                    customer_id: customer_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#type2').val('delete2');
                    $('#customer_id').val(data.customer_id);
                    $('#customer_nama').val(data.customer_nama).attr('disabled', true);
                    $('#customer_alamat').val(data.customer_alamat).attr('disabled', true);
                    $('#customer_notelp').val(data.customer_notelp).attr('disabled', true);
                    $('#barang_button2').html('Hapus Customer');
                }
            });
        });
    });
</script>