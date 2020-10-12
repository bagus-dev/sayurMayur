<?php if (isset($_GET["change_status"])) { ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            onClose: () => {
                window.history.replaceState({}, document.title, "/" + "sayurMayur/penjualan-online")
            }
        });

        Toast.fire({
            icon: 'success',
            title: 'Berhasil Mengubah Status Pesanan.'
        });
    </script>
<?php } ?>

<script>
    $("#modalWarning").on("show.bs.modal", function(e) {
        var button = $(e.relatedTarget);
        var no_invoice = button.data("no_invoice");

        $.ajax({
            type: "POST",
            url: "<?= base_url() . 'page/get_bukti_trf'; ?>",
            data: "no_invoice=" + no_invoice,
            success: function(response) {
                $("html").css("overflow-y", "hidden");

                $("#warningModal").html(response);
            }
        })
    });

    $("#modalWarning").on("hide.bs.modal", function(e) {
        $("html").css("overflow-y", "auto");
    });

    function lihatDetail(e) {
        var no_invoice = e.target.dataset.no_invoice;

        window.open('<?= base_url() . "penjualan-online/"; ?>' + no_invoice + '', '_self');
    }
</script>