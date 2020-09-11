<script>
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    (function() {
        window.onresize = displayWindowSize;
        window.onload = displayWindowSize;

        function displayWindowSize() {
            let myWidth = window.innerWidth;

            if(myWidth > 767) {
                $(".btn-default").removeClass("btn-xs");
                $(".no-mt-xs").addClass("mt-2");
                $(".mt-xs").removeClass("mt-2");
                $(".no-mt-xs-2").addClass("mt-3");
                $("#col-waktu-kirim-1").removeClass("mt-3");
                $("#col-waktu-kirim-2").removeClass("no-mt-xs-2");
            }
            else {
                $("#container-checkout").prepend(
                    $("<br>")
                );
                $(".btn-default").addClass("btn-xs");
                $(".no-mt-xs").removeClass("mt-2");
                $(".mt-xs").addClass("mt-2");
                $(".no-mt-xs-2").removeClass("mt-3");
                $("#col-waktu-kirim-1").addClass("mt-3");
                $("#col-waktu-kirim-2").addClass("no-mt-xs-2");
            }
        }
    })();

    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();

        if(fileName == "") {
            fileName = "Unggah File";
        }
        
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });

    $("#cara_bayar_1").click(function(e) {
        var ini = this;

        $.ajax({
            beforeSend: function() {
                $("#loading-section").removeAttr("style");

                var length = $(".btn-ongkir").length;
                
                $(".btn-ongkir").addClass("btn-default");
                $(".btn-ongkir").removeClass("btn-warning");
                $(".btn-ongkir").removeClass("text-white");
                $(".btn-ongkir").removeClass("btn-pilih-active");

                for(var i = 0; i <= length; i++) {
                    $("#span_ongkir_" + i).attr("style","display:none");
                }

                var waktu_kirim = $('input[name="waktu_kirim"]:checked', '#form').val();
                var jenis_bayar = $('input[name="jenis_pembayaran"]:checked', '#form').val();
                var bukti_trf = $('input[name="bukti_trf"]:checked', '#form').val();
                var btn_proses = document.getElementById("btn-proses");

                if(waktu_kirim) {
                    if(jenis_bayar) {
                        if(jenis_bayar == "1") {
                            if(bukti_trf !== "") {
                                var fileInput = document.getElementById("bukti_trf");
                                var filePath = fileInput.value;
                                var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                                
                                if (allowedExtensions.exec(filePath)) {
                                    var file = fileInput.files[0];

                                    if(file.size <= 512000) {
                                        $("#btn-proses").removeAttr("disabled");
                                    }
                                }
                            }
                            else {
                                if(!btn_proses.hasAttribute("disabled")) {
                                    $("#btn-proses").attr("disabled","disabled");
                                }
                            }
                        }
                        else if(jenis_bayar == "2") {
                            $("#btn-proses").removeAttr("disabled");
                        }
                    }
                    else {
                        if(!btn_proses.hasAttribute("disabled")) {
                            $("#btn-proses").attr("disabled","disabled");
                        }
                    }
                }
                else {
                    if(!btn_proses.hasAttribute("disabled")) {
                        $("#btn-proses").attr("disabled","disabled");
                    }
                }
            },
            success: function() {
                let myWidth = window.innerWidth;

                if(myWidth > 767) {
                    $(".col-waktu-kirim").removeClass("mt-3","no-mt-xs-2");
                }

                $(".col-cod").attr("style","display:none");

                $(ini).removeClass("btn-default");
                $("#cara_bayar_2").addClass("btn-default");
                $("#cara_bayar_2").removeClass("btn-warning");
                $("#cara_bayar_2").removeClass("text-white");
                $("#cara_bayar_2").removeClass("btn-pilih-active");
                $("#span_bayar_2").attr("style","display:none");

                $(ini).addClass("btn-warning");
                $(ini).addClass("text-white");
                $(ini).addClass("btn-pilih-active");
                $("#span_bayar_1").removeAttr("style");

                var total_bayar = <?php foreach($total_harga_keranjang->result() as $t){echo $t->total_harga; } ?>;
                $("#ongkir").text(0);
                $("#total_ongkir").text(0);
                $("#total_bayar").text(numberWithCommas(total_bayar));


            },
            complete: function() {
                $("#loading-section").attr("style","display:none");
            }
        });
    });

    $("#cara_bayar_2").click(function(e) {
        var ini = this;

        $.ajax({
            beforeSend: function() {
                $("#loading-section").removeAttr("style");

                var btn_ongkir = $(".btn-ongkir").length;
                var waktu_kirim = $('input[name="waktu_kirim"]:checked', '#form').val();
                var detail_kirim = $("#detail_kirim").val();
                var jenis_bayar = $('input[name="jenis_pembayaran"]:checked', '#form').val();
                var bukti_trf = $('input[name="bukti_trf"]:checked', '#form').val();
                var btn_proses = document.getElementById("btn-proses");

                for(var i = 1; i <= btn_ongkir; i++) {
                    var ongkir = document.getElementById("ongkir_" + i);

                    if(ongkir.classList.contains("btn-pilih-active")) {
                        if(waktu_kirim) {
                            if(detail_kirim !== "") {
                                if(jenis_bayar) {
                                    if(jenis_bayar == "1") {
                                        if(bukti_trf !== "") {
                                            var fileInput = document.getElementById("bukti_trf");
                                            var filePath = fileInput.value;
                                            var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                                            
                                            if (allowedExtensions.exec(filePath)) {
                                                var file = fileInput.files[0];

                                                if(file.size <= 512000) {
                                                    $("#btn-proses").removeAttr("disabled");
                                                }
                                            }
                                        }
                                        else {
                                            if(!btn_proses.hasAttribute("disabled")) {
                                                $("#btn-proses").attr("disabled","disabled");
                                            }
                                        }
                                    }
                                    else if(jenis_bayar == "2") {
                                        $("#btn-proses").removeAttr("disabled");
                                    }
                                }
                                else {
                                    if(!btn_proses.hasAttribute("disabled")) {
                                        $("#btn-proses").attr("disabled","disabled");
                                    }
                                }
                            }
                            else {
                                if(!btn_proses.hasAttribute("disabled")) {
                                    $("#btn-proses").attr("disabled","disabled");
                                }
                            }
                        }
                        else {
                            if(!btn_proses.hasAttribute("disabled")) {
                                $("#btn-proses").attr("disabled","disabled");
                            }
                        }
                    }
                    else {
                        if(!btn_proses.hasAttribute("disabled")) {
                            $("#btn-proses").attr("disabled","disabled");
                        }
                    }
                }
            },
            success: function() {
                let myWidth = window.innerWidth;

                if(myWidth > 767) {
                    $(".col-waktu-kirim").addClass("mt-3","no-mt-xs-2");
                }

                $(".col-cod").removeAttr("style");

                $(ini).removeClass("btn-default");
                $("#cara_bayar_1").addClass("btn-default");
                $("#cara_bayar_1").removeClass("btn-warning");
                $("#cara_bayar_1").removeClass("text-white");
                $("#cara_bayar_1").removeClass("btn-pilih-active");
                $("#span_bayar_1").attr("style","display:none");

                $(ini).addClass("btn-warning");
                $(ini).addClass("text-white");
                $(ini).addClass("btn-pilih-active");
                $("#span_bayar_2").removeAttr("style");
            },
            complete: function() {
                $("#loading-section").attr("style","display:none");
            }
        });
    });

    $(".btn-ongkir").click(function(e) {
        if(e.target.classList.contains("btn-default")) {
            var id = e.target.id;
            var ongkir_harga = parseInt(e.target.dataset.ongkir_harga);
            var total_bayar = <?php foreach($total_harga_keranjang->result() as $t){echo $t->total_harga; } ?>;
            var ini = this;

            $.ajax({
                beforeSend: function() {
                    $("#loading-section").removeAttr("style");

                    var length = $(".btn-ongkir").length;
                    
                    $(".btn-ongkir").addClass("btn-default");
                    $(".btn-ongkir").removeClass("btn-warning");
                    $(".btn-ongkir").removeClass("text-white");
                    $(".btn-ongkir").removeClass("btn-pilih-active");

                    for(var i = 0; i <= length; i++) {
                        $("#span_ongkir_" + i).attr("style","display:none");
                    }

                    var waktu_kirim = $('input[name="waktu_kirim"]:checked', '#form').val();
                    var detail_kirim = $("#detail_kirim").val();
                    var jenis_bayar = $('input[name="jenis_pembayaran"]:checked', '#form').val();
                    var bukti_trf = $('input[name="bukti_trf"]:checked', '#form').val();

                    if(waktu_kirim) {
                        if(detail_kirim !== "") {
                            if(jenis_bayar) {
                                if(jenis_bayar == "1") {
                                    if(bukti_trf !== "") {
                                        var fileInput = document.getElementById("bukti_trf");
                                        var filePath = fileInput.value;
                                        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                                        
                                        if (allowedExtensions.exec(filePath)) {
                                            var file = fileInput.files[0];

                                            if(file.size <= 512000) {
                                                $("#btn-proses").removeAttr("disabled");
                                            }
                                        }
                                    }
                                }
                                else if(jenis_bayar == "2") {
                                    $("#btn-proses").removeAttr("disabled");
                                }
                            }
                        }
                    }
                },
                success: function() {
                    $(ini).removeClass("btn-default");
                    $(ini).addClass("btn-warning");
                    $(ini).addClass("text-white");
                    $(ini).addClass("btn-pilih-active");
                    $("#span_" + id).removeAttr("style");

                    var total = total_bayar + ongkir_harga;
                    $("#ongkir").text(numberWithCommas(ongkir_harga));
                    $("#total_ongkir").text(numberWithCommas(ongkir_harga));
                    $("#total_bayar").text(numberWithCommas(total));
                },
                complete: function() {
                    $("#loading-section").attr("style","display:none");
                }
            });
        }
    });

    $(".radio-waktu-kirim").click(function() {
        var di_toko = document.getElementById("cara_bayar_1");
        var di_tempat = document.getElementById("cara_bayar_2");

        if(di_toko.classList.contains("btn-pilih-active")) {
            var jenis_bayar = $('input[name="jenis_pembayaran"]:checked', '#form').val();
            var bukti_trf = $('input[name="bukti_trf"]:checked', '#form').val();

            if(jenis_bayar) {
                if(jenis_bayar == "1") {
                    if(bukti_trf !== "") {
                        var fileInput = document.getElementById("bukti_trf");
                        var filePath = fileInput.value;
                        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                        
                        if (allowedExtensions.exec(filePath)) {
                            var file = fileInput.files[0];

                            if(file.size <= 512000) {
                                $("#btn-proses").removeAttr("disabled");
                            }
                        }
                    }
                }
                else if(jenis_bayar == "2") {
                    $("#btn-proses").removeAttr("disabled");
                }
            }
        }
        else if(di_tempat.classList.contains("btn-pilih-active")) {
            var btn_ongkir = $(".btn-ongkir").length;
            var detail_kirim = $("#detail_kirim").val();
            var jenis_bayar = $('input[name="jenis_pembayaran"]:checked', '#form').val();
            var bukti_trf = $('input[name="bukti_trf"]:checked', '#form').val();

            for(var i = 1; i <= btn_ongkir; i++) {
                var ongkir = document.getElementById("ongkir_" + i);

                if(ongkir.classList.contains("btn-pilih-active")) {
                    if(detail_kirim !== "") {
                        if(jenis_bayar) {
                            if(jenis_bayar == "1") {
                                if(bukti_trf !== "") {
                                    var fileInput = document.getElementById("bukti_trf");
                                    var filePath = fileInput.value;
                                    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                                    
                                    if (allowedExtensions.exec(filePath)) {
                                        var file = fileInput.files[0];

                                        if(file.size <= 512000) {
                                            $("#btn-proses").removeAttr("disabled");
                                        }
                                    }
                                }
                            }
                            else if(jenis_bayar == "2") {
                                $("#btn-proses").removeAttr("disabled");
                            }
                        }
                    }
                }
            }
        }
    });

    function checkForm(e) {
        var value = e.target.value;
        
        if(value.trim() !== "") {
            var btn_ongkir = $(".btn-ongkir").length;
            var waktu_kirim = $('input[name="waktu_kirim"]:checked', '#form').val();
            var jenis_bayar = $('input[name="jenis_pembayaran"]:checked', '#form').val();
            var bukti_trf = $('input[name="bukti_trf"]:checked', '#form').val();

            for(var i = 1; i <= btn_ongkir; i++) {
                var ongkir = document.getElementById("ongkir_" + i);

                if(ongkir.classList.contains("btn-pilih-active")) {
                    if(waktu_kirim) {
                        if(jenis_bayar) {
                            if(jenis_bayar == "1") {
                                if(bukti_trf !== "") {
                                    var fileInput = document.getElementById("bukti_trf");
                                    var filePath = fileInput.value;
                                    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
                                    
                                    if (allowedExtensions.exec(filePath)) {
                                        var file = fileInput.files[0];

                                        if(file.size <= 512000) {
                                            $("#btn-proses").removeAttr("disabled");
                                        }
                                    }
                                }
                            }
                            else if(jenis_bayar == "2") {
                                $("#btn-proses").removeAttr("disabled");
                            }
                        }
                    }
                }
            }
        }
    }

    $("#pembayaran_1").click(function() {
        $.ajax({
            beforeSend: function() {
                $("#loading-section").removeAttr("style");

                var btn_proses = document.getElementById("btn-proses");

                if(!btn_proses.hasAttribute("disabled")) {
                    $("#btn-proses").attr("disabled","disabled");
                }
            },
            success: function() {
                $("#col_transfer").removeAttr("style");
            },
            complete: function() {
                $("#loading-section").attr("style","display:none");
            }
        });
    });

    $("#pembayaran_2").click(function() {
        var bukti_trf = $("#bukti_trf").val();

        if(bukti_trf == "") {
            $.ajax({
                beforeSend: function() {
                    $("#loading-section").removeAttr("style");

                    var di_toko = document.getElementById("cara_bayar_1");
                    var di_tempat = document.getElementById("cara_bayar_2");

                    if(di_toko.classList.contains("btn-pilih-active")) {
                        var waktu_kirim = $('input[name="waktu_kirim"]:checked', '#form').val();

                        if(waktu_kirim) {
                            $("#btn-proses").removeAttr("disabled");
                        }
                    }
                    else if(di_tempat.classList.contains("btn-pilih-active")) {
                        var btn_ongkir = $(".btn-ongkir").length;
                        var waktu_kirim = $('input[name="waktu_kirim"]:checked', '#form').val();
                        var detail_kirim = $("#detail_kirim").val();

                        for(var i = 1; i <= btn_ongkir; i++) {
                            var ongkir = document.getElementById("ongkir_" + i);

                            if(ongkir.classList.contains("btn-pilih-active")) {
                                if(waktu_kirim) {
                                    if(detail_kirim !== "") {
                                        $("#btn-proses").removeAttr("disabled");
                                    }
                                }
                            }
                        }
                    }
                },
                success: function() {
                    $("#col_transfer").attr("style","display:none");
                },
                complete: function() {
                    $("#loading-section").attr("style","display:none");
                }
            });
        }
        else {
            var gambar_trf = $("#gambar_trf").val();

            Swal.fire({
                icon: "question",
                title: "Yakin Mengubah Jenis Pembayaran?",
                text: "Bukti Transfer Sudah Dipilih dan Siap Diunggah.",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Ya, Ubah Jenis Pembayaran",
                cancelButtonText: "Batal",
                cancelButtonColor: "#d33",
                allowOutsideClick: () => !Swal.isLoading(),
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch (`<?= base_url().'checkout/delete_trf?gambar_trf='; ?>` + gambar_trf)
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
                var $pembayaran_1 = $("#pembayaran_1");
                var $pembayaran_2 = $("#pembayaran_2");

                if(result.value) {
                    $("#bukti_trf").val("");
                    $(".custom-file-label").html("Unggah File");
                    $("#gambar_trf").val("");

                    $("#col_transfer").attr("style","display:none");

                    if($pembayaran_1.is(':checked')) {
                        $("#pembayaran_1").prop('checked', false);
                        $("#pembayaran_2").prop('checked', true);
                    }
                }
                else if(result.dismiss === Swal.DismissReason.cancel) {
                    if($pembayaran_2.is(':checked')) {
                        $("#pembayaran_2").prop('checked', false);
                        $("#pembayaran_1").prop('checked', true);
                    }
                }
            });
        }
    });

    function checkTrf(e) {
        var gambar_trf = $("#gambar_trf").val();

        if(gambar_trf !== "") {
            $.ajax({
                type: "GET",
                url: "<?= base_url().'checkout/delete_trf'; ?>",
                data: "gambar_trf="+gambar_trf,
                dataType: "json",
                beforeSend: function() {
                    $("#loading-section").removeAttr("style");
                },
                success: function(response) {
                    if(response.ok) {
                        if(e.target.value !== "") {
                            $.ajax({
                                type: "POST",
                                url: "<?= base_url().'checkout/cek_trf'; ?>",
                                data: new FormData(document.getElementById("form")),
                                dataType: "json",
                                contentType: false,
                                cache: false,
                                processData: false,
                                beforeSend: function() {
                                    $("#loading-section").removeAttr("style");
                                },
                                success: function(response) {

                                    if(response.status == 0) {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal',
                                            html: response.pesan
                                        });

                                        var btn_proses = document.getElementById("btn-proses");

                                        if(!btn_proses.hasAttribute("disabled")) {
                                            $("#btn-proses").attr("disabled","disabled");
                                        }
                                    }
                                    else {
                                        var di_toko = document.getElementById("cara_bayar_1");
                                        var di_tempat = document.getElementById("cara_bayar_2");

                                        if(di_toko.classList.contains("btn-pilih-active")) {
                                            var waktu_kirim = $('input[name="waktu_kirim"]:checked', '#form').val();

                                            if(waktu_kirim) {
                                                $("#btn-proses").removeAttr("disabled");
                                            }
                                        }
                                        else if(di_tempat.classList.contains("btn-pilih-active")) {
                                            var btn_ongkir = $(".btn-ongkir").length;
                                            var waktu_kirim = $('input[name="waktu_kirim"]:checked', '#form').val();
                                            var detail_kirim = $("#detail_kirim").val();

                                            for(var i = 1; i <= btn_ongkir; i++) {
                                                var ongkir = document.getElementById("ongkir_" + i);

                                                if(ongkir.classList.contains("btn-pilih-active")) {
                                                    if(waktu_kirim) {
                                                        if(detail_kirim !== "") {
                                                            $("#btn-proses").removeAttr("disabled");
                                                        }
                                                    }
                                                }
                                            }
                                        }

                                        $("#gambar_trf").val(response.foto);
                                        
                                        const Toast = Swal.mixin({
                                            toast: true,
                                            position: "top-end",
                                            showConfirmButton: false,
                                            timer: 2000,
                                            timerProgressBar: true
                                        });

                                        Toast.fire({
                                            icon: "success",
                                            title: "Bukti Transfer Dapat Diunggah."
                                        });
                                    }
                                },
                                complete: function() {
                                    $("#loading-section").attr("style","display:none");
                                }
                            });
                        }
                        else {
                            $("#btn-proses").attr("disabled","disabled");
                        }
                    }
                },
                complete: function() {
                    $("#loading-section").attr("style","display:none");
                }
            })
        }
        else {
            if(e.target.value !== "") {
                $.ajax({
                    type: "POST",
                    url: "<?= base_url().'checkout/cek_trf'; ?>",
                    data: new FormData(document.getElementById("form")),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $("#loading-section").removeAttr("style");
                    },
                    success: function(response) {

                        if(response.status == 0) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Gagal',
                                html: response.pesan
                            });

                            var btn_proses = document.getElementById("btn-proses");

                            if(!btn_proses.hasAttribute("disabled")) {
                                $("#btn-proses").attr("disabled","disabled");
                            }
                        }
                        else {
                            var di_toko = document.getElementById("cara_bayar_1");
                            var di_tempat = document.getElementById("cara_bayar_2");

                            if(di_toko.classList.contains("btn-pilih-active")) {
                                var waktu_kirim = $('input[name="waktu_kirim"]:checked', '#form').val();

                                if(waktu_kirim) {
                                    $("#btn-proses").removeAttr("disabled");
                                }
                            }
                            else if(di_tempat.classList.contains("btn-pilih-active")) {
                                var btn_ongkir = $(".btn-ongkir").length;
                                var waktu_kirim = $('input[name="waktu_kirim"]:checked', '#form').val();
                                var detail_kirim = $("#detail_kirim").val();

                                for(var i = 1; i <= btn_ongkir; i++) {
                                    var ongkir = document.getElementById("ongkir_" + i);

                                    if(ongkir.classList.contains("btn-pilih-active")) {
                                        if(waktu_kirim) {
                                            if(detail_kirim !== "") {
                                                $("#btn-proses").removeAttr("disabled");
                                            }
                                        }
                                    }
                                }
                            }

                            $("#gambar_trf").val(response.foto);
                            
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            });

                            Toast.fire({
                                icon: "success",
                                title: "Bukti Transfer Dapat Diunggah."
                            });
                        }
                    },
                    complete: function() {
                        $("#loading-section").attr("style","display:none");
                    }
                });
            }
            else {
                $("#btn-proses").attr("disabled","disabled");
            }
        }
    }
    
    $("#btn-proses").click(function() {
        var waktu_kirim = $('input[name="waktu_kirim"]:checked', '#form').val();
        var jenis_bayar = $('input[name="jenis_pembayaran"]:checked', '#form').val();
        var cara_bayar;

        if(jenis_bayar == "1") {
            var bukti_trf = $("#gambar_trf").val();
        }

        var di_toko = document.getElementById("cara_bayar_1");
        var di_tempat = document.getElementById("cara_bayar_2");

        if(di_tempat.classList.contains("btn-pilih-active")) {
            cara_bayar = 2;
            var length = $(".btn-ongkir").length;

            for(var i = 1; i <= length; i++) {
                var btn_ongkir = document.getElementById("ongkir_" + i);

                if(btn_ongkir.classList.contains("btn-pilih-active")) {
                    var tempat_kirim = btn_ongkir.dataset.ongkir_id;
                }
            }

            var detail_kirim = $("#detail_kirim").val();
        }
        else if(di_toko.classList.contains("btn-pilih-active")) {
            cara_bayar = 1;
        }

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
                if(di_toko.classList.contains("btn-pilih-active")) {
                    if(jenis_bayar == "1") {
                        return fetch (`<?= base_url().'checkout/insert_invoice?cara_bayar='; ?>` + cara_bayar + `&waktu_kirim=` + waktu_kirim + `&jenis_bayar=` + jenis_bayar + `&bukti_trf=` + bukti_trf)
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
                    else {
                        return fetch (`<?= base_url().'checkout/insert_invoice?cara_bayar='; ?>` + cara_bayar + `&waktu_kirim=` + waktu_kirim + `&jenis_bayar=` + jenis_bayar)
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
                }
                else if(di_tempat.classList.contains("btn-pilih-active")) {
                    if(jenis_bayar == "1") {
                        return fetch (`<?= base_url().'checkout/insert_invoice?cara_bayar='; ?>` + cara_bayar + `&tempat_kirim=` + tempat_kirim + `&waktu_kirim=` + waktu_kirim + `&detail_kirim=` + detail_kirim + `&jenis_bayar=` + jenis_bayar + `&bukti_trf=` + bukti_trf)
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
                    else {
                        return fetch (`<?= base_url().'checkout/insert_invoice?cara_bayar='; ?>` + cara_bayar + `&tempat_kirim=` + tempat_kirim + `&waktu_kirim=` + waktu_kirim + `&detail_kirim=` + detail_kirim + `&jenis_bayar=` + jenis_bayar)
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
                }
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