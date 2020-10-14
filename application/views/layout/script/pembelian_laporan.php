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

        window.open('<?= base_url() . "pembelian/cetak_laporan?tgl_mulai="; ?>' + tgl_mulai + '&tgl_akhir=' + tgl_akhir, '_blank');
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