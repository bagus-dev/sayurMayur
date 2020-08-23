<div class="modal fade" id="modalWarning">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" id="warningModal"></div>
    </div>
</div>

<?php
    if(isset($_GET["upload_trf"])) {
?>
<script>
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000,
        onClose: () => {
            window.history.replaceState({}, document.title, "/" + "sayurMayur/page/profile")
        }
    });

    Toast.fire({
        icon: 'success',
        title: 'Berhasil Mengunggah Bukti Transfer.'
    });
</script>
<?php } ?>

<script>
    $("#table-datatable").DataTable({
        "bDestroy": true
    });

    function lihatDetail(e) {
        var no_invoice = e.target.dataset.no_invoice;

        window.open('<?= base_url()."page/check_invoice?no_invoice="; ?>' + no_invoice + '','_self');
    }

    function uploadTrf(e) {
        var no_invoice = e.target.dataset.no_invoice;

        window.open('<?= base_url()."page/upload_trf?no_invoice="; ?>' + no_invoice + '','_self');
    }

    $("#modalWarning").on("show.bs.modal", function(e) {
        var button = $(e.relatedTarget);
        var no_invoice = button.data("no_invoice");

        $.ajax({
            type: "POST",
            url: "<?= base_url().'page/get_bukti_trf'; ?>",
            data: "no_invoice="+no_invoice,
            success: function(response) {
                $("html").css("overflow-y","hidden");

                $("#warningModal").html(response);
            }
        })
    });

    $("#modalWarning").on("hide.bs.modal", function(e) {
        $("html").css("overflow-y","auto");
    });

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
            if(result.value) {
                window.open('<?= base_url()."auth/logout"; ?>','_self')
            }
        })
    });
</script>