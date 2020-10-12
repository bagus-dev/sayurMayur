<script>
    $(function() {
        $('#bubbling').on('click', '.tampil-modal-hapus', function() {
            $('#alert-delete').removeClass('d-none');

            const beli_id = $(this).data('beli_id');

            $.ajax({
                url: '<?= base_url(); ?>/pembelian/show2',
                data: {
                    beli_id: beli_id
                },
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#beli_id').val(data.beli_nofak);
                }
            });
        });
    });
</script>