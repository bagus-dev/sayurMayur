<script>
    function lihatDetail(e) {
        var no_invoice = e.target.dataset.no_invoice;

        window.open('<?= base_url()."penjualan-online/"; ?>' + no_invoice + '','_self');
    }

    function cetakStruk(e) {
        var no_invoice = e.target.dataset.no_invoice;

        window.open('<?= base_url()."penjualan_online/print_struk/"; ?>' + no_invoice + '','_blank');
    }
</script>