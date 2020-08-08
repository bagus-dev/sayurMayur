<script>
    $(function() {
        $('#bubbling').on('click', '.tampil-modal-hapus', function() {
            $('#alert-delete').removeClass('d-none');

            const jual_id = $(this).data('jual_id');

            $.ajax({
                url: 'http://localhost/project/project-point-of-sale/penjualan/show',
                data: {
                    jual_id: jual_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#jual_id').val(data.jual_nofak);
                }
            });
        });
    });
</script>