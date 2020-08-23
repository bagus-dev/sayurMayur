<script>
    (function() {
        window.onresize = displayWindowSize;
        window.onload = displayWindowSize;

        function displayWindowSize() {
            let myWidth = window.innerWidth;

            if(myWidth > 767) {
                $(".col-alamat").removeClass("mt-3");
                $(".col-alamat2").removeClass("mt-3");
            }
            else {
                $("#container-checkout").prepend(
                    $("<br>")
                );
                $(".col-alamat").addClass("mt-3");
                $(".col-alamat2").addClass("mt-3");
            }
        }
    })();
    
    $("#pengiriman_1").click(function() {
        $("#loading-section").removeAttr("style");

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        var total_belanja = <?php foreach($total_harga_keranjang->result() as $t){echo $t->total_harga;} ?>;
        var ongkir = <?php foreach($ongkir->result() as $o){echo $o->ongkir_harga;} ?>;
        var total_bayar = total_belanja + ongkir;
        $(".column-kecamatan").css("display","block");
        $(".ongkir_span").text(numberWithCommas(ongkir));
        $("#total_bayar").text(numberWithCommas(total_bayar));

        setTimeout(stopLoading, 500);

        function stopLoading() {
            $("#loading-section").css("display","none");
        }
    });

    $("#pengiriman_2").click(function() {
        $("#loading-section").removeAttr("style");

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        var total_belanja = <?php foreach($total_harga_keranjang->result() as $t){echo $t->total_harga;} ?>;
        $(".column-kecamatan").css("display","none");
        $(".ongkir_span").text(0);
        $("#total_bayar").text(numberWithCommas(total_belanja));

        setTimeout(stopLoading, 500);

        function stopLoading() {
            $("#loading-section").css("display","none");
        }
    });
    
    $("#btn-proses").click(function() {
        var jenis_kirim = document.forms["form"]["jenis_pengiriman"].value;
        var jenis_bayar = document.forms["form"]["jenis_pembayaran"].value;
        var total_bayar = document.getElementById("total_bayar").innerHTML;
        var total_bayar_fix = parseInt(total_bayar.replace(/,/g, ''));

        Swal.fire({
            icon: "question",
            title: "Yakin Memproses Transaksi?",
            text: "Transaksi yang sudah diproses tidak dapat diubah kembali.",
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: "Ya, Proses Transaksi",
            cancelButtonText: "Batal",
            cancelButtonColor: "#d33",
            allowOutsideClick: () => !Swal.isLoading(),
            showLoaderOnConfirm: true,
            preConfirm: () => {
                return fetch (`<?= base_url().'checkout/insert_invoice?jenis_kirim='; ?>` + jenis_kirim + `&jenis_bayar=` + jenis_bayar + `&total_bayar=` + total_bayar_fix)
                    .then(response => {
                        if(!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json()
                    })
                    .catch(error => {
                        Swal.showValidationMessage(
                            `Request Failed: ${error}`
                        )
                    })
            }
        }).then((result) => {
            if(result.value) {
                window.open('<?= base_url()."page/check_invoice?no_invoice="; ?>' + result.value.no_invoice + '&add_invoice','_self');
            }
        })
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