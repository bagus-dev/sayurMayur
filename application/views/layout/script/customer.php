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
    });
</script>