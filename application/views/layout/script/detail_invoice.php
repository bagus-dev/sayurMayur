<script>
    function changeStatus() {
        var dibayar = document.getElementById("dibayar");

        if(dibayar) {
            var dibayarVal = dibayar.value;

            if(dibayarVal.trim() !== "" && !/\D/.test(dibayarVal)) {
                var no_invoice = "<?= $this->uri->segment(2); ?>";
                var status = document.getElementById("status").value;

                $.ajax({
                    type: "POST",
                    url: "<?= base_url().'penjualan-online/status/check'; ?>",
                    data: {"no_invoice": no_invoice,"status": status},
                    success: function(response) {
                        if(response == "OK") {
                            $.ajax({
                                type: "POST",
                                url: "<?= base_url().'penjualan-online/status/change'; ?>",
                                data: {"no_invoice": no_invoice,"status": status,"dibayar": dibayarVal},
                                success: function(response) {
                                    if(response == "OK") {
                                        window.open('<?= base_url()."penjualan-online?change_status"; ?>','_self')
                                    }
                                }
                            });
                        }
                    }
                });
            }
        }
        else {
            var no_invoice = "<?= $this->uri->segment(2); ?>";
            var status = document.getElementById("status").value;

            $.ajax({
                type: "POST",
                url: "<?= base_url().'penjualan-online/status/check'; ?>",
                data: {"no_invoice": no_invoice,"status": status},
                success: function(response) {
                    if(response == "OK") {
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url().'penjualan-online/status/change'; ?>",
                            data: {"no_invoice": no_invoice,"status": status},
                            success: function(response) {
                                if(response == "OK") {
                                    window.open('<?= base_url()."penjualan-online?change_status"; ?>','_self')
                                }
                            }
                        });
                    }
                }
            });
        }
    }
</script>