<script>
    function lihatDetail(e) {
        var no_invoice = e.target.dataset.no_invoice;

        window.open('<?= base_url() . "penjualan-online/"; ?>' + no_invoice + '', '_self');
    }

    function cetakStruk(e) {
        var no_invoice = e.target.dataset.no_invoice;

        window.open('<?= base_url() . "penjualan_online/print_struk/"; ?>' + no_invoice + '', '_blank');
    }

    function btnCheck(e) {
        var id = e.target.id;
        var btn_laporan = document.getElementById("btn-laporan");
        var tgl_mulai = document.getElementById("tgl_mulai").value;
        var tgl_akhir = document.getElementById("tgl_akhir").value;

        if (id == "tgl_mulai") {
            if (e.target.value.trim() !== "" && tgl_akhir.trim() !== "") {
                $("#btn-laporan").removeAttr("disabled");
            } else {
                if (!btn_laporan.hasAttribute("disabled")) {
                    $("#btn-laporan").attr("disabled", "disabled");
                }
            }
        } else if (id == "tgl_akhir") {
            if (e.target.value.trim() !== "" && tgl_mulai.trim() !== "") {
                $("#btn-laporan").removeAttr("disabled");
            } else {
                if (!btn_laporan.hasAttribute("disabled")) {
                    $("#btn-laporan").attr("disabled", "disabled");
                }
            }
        }
    }

    function cetakLaporan() {
        var tgl_mulai = document.getElementById("tgl_mulai").value;
        var tgl_akhir = document.getElementById("tgl_akhir").value;

        window.open('<?= base_url() . "penjualan_online/cetak_laporan?tgl_mulai="; ?>' + tgl_mulai + '&tgl_akhir=' + tgl_akhir, '_blank');
    }
</script>
<script type="text/javascript">
    $(function() {
        $('.datetimepicker').datetimepicker({
            locale: 'id',
            format: 'L',
            icons: {
                today: 'far fa-calendar-check',
                clear: 'far fa-trash-alt'
            },
            buttons: {
                showToday: true,
                showClear: true
            }
        });
    });
</script>