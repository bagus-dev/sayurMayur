<?php
if (isset($_GET["add_invoice"])) {
    $no_invoice = $this->input->get("no_invoice");
?>
    <script>
        var no_invoice = "<?= $no_invoice; ?>";

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4000,
            onClose: () => {
                window.history.replaceState({}, document.title, "/" + "sayurMayur/page/check_invoice?no_invoice=" + no_invoice)
            }
        });

        Toast.fire({
            icon: 'success',
            title: 'Berhasil Membuat Invoice.'
        });
    </script>
<?php } ?>

<script>
    $("#btn-logout").click(function() {
        Swal.fire({
            icon: 'question',
            title: 'Keluar Akun',
            text: 'Yakin untuk Keluar Akun ?',
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: "Ya, Keluar Akun",
            cancelButtonText: "Batal",
            cancelButtonColor: "#d33",
        }).then((result) => {
            if (result.value) {
                window.open('<?= base_url() . "auth/logout"; ?>', '_self')
            }
        })
    });
</script>