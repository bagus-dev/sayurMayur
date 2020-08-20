<script>
    (function() {
        window.onresize = displayWindowSize;
        window.onload = displayWindowSize;

        function displayWindowSize() {
            let myWidth = window.innerWidth;

            if(myWidth > 767) {
                $(window).scroll(function() {
                    if($(this).scrollTop() > 150 && myWidth > 767) {
                        $("#cart-right").removeClass("cart-right");
                        $("#cart-right").addClass("fix-cart");
                        
                        var parentCart = $("#parent-cart").width();
                        $("#cart-right").css("width", parentCart + "px");
                    }
                    else if($(this).scrollTop() <= 150 && myWidth > 767) {
                        $("#cart-right").removeClass("fix-cart");
                        $("#cart-right").addClass("cart-right");
                    }
                });
            }
        }
    })();

    function getPageList(totalPages, page, maxLength) {
        if (maxLength < 5) throw "maxLength must be at least 5";

        function range(start, end) {
            return Array.from(Array(end - start + 1), (_, i) => i + start);
        }

        var sideWidth = maxLength < 9 ? 1 : 2;
        var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
        var rightWidth = (maxLength - sideWidth * 2 - 2) >> 1;

        if(totalPages <= maxLength) {
            return range(1, totalPages);
        }

        if(totalPages <= maxLength - sideWidth - 1 - rightWidth) {
            return range(1, maxLength - sideWidth - 1)
                .concat([0])
                .concat(range(totalPages - sideWidth + 1, totalPages));
        }

        if(page >= totalPages - sideWidth - 1 - rightWidth) {
            return range(1, sideWidth)
                .concat([0])
                .concat(
                    range(totalPages - sideWidth - 1 - rightWidth - leftWidth, totalPages)
                );
        }

        return range(1, sideWidth)
            .concat([0])
            .concat(range(page - leftWidth, page + rightWidth))
            .concat([0])
            .concat(range(totalPages - sideWidth + 1, totalPages));
    }

    $(function() {
        var numberOfItems = $("#row-data #col-data").length;
        var limitPerPage = 9;
        var totalPages = Math.ceil(numberOfItems / limitPerPage);

        var paginationSize = 7;
        var currentPage;

        function showPage(whichPage) {
            if(whichPage < 1 || whichPage > totalPages) return false;
            currentPage = whichPage;
            $("#row-data #col-data")
                .hide()
                .slice((currentPage - 1) * limitPerPage, currentPage * limitPerPage)
                .show();
            
            $(".pagination li").slice(1, -1).remove();
            getPageList(totalPages, currentPage, paginationSize).forEach(item => {
                $("<li>")
                    .addClass(
                        "page-item " +
                        (item ? "current-page " : "") +
                        (item === currentPage ? "active " : "")
                    )
                    .append(
                        $("<a>")
                            .addClass("page-link")
                            .attr({
                                href: "javascript:void(0)"
                            })
                            .text(item || "...")
                    )
                    .insertBefore("#next-page");
            });
            return true;
        }

        $(".pagination").append(
            $("<li>").addClass("page-item").attr({ id: "previous-page" }).append(
                $("<a>")
                    .addClass("page-link")
                    .attr({
                        href: "javascript:void(0)"
                    })
                    .text("Sebelumnya")
            ),
            $("<li>").addClass("page-item").attr({ id: "next-page" }).append(
                $("<a>")
                    .addClass("page-link")
                    .attr({
                        href: "javascript:void(0)"
                    })
                    .text("Selanjutnya")
            )
        );

        $("#row-data").show();
        showPage(1);

        $(document).on("click", ".pagination li.current-page:not(.active)", function() {
            return showPage(+$(this).text());
        });
        $("#next-page").on("click", function() {
            return showPage(currentPage + 1);
        });
        $("#previous-page").on("click", function() {
            return showPage(currentPage - 1);
        });
        $(".pagination").on("click", function() {
            $("#col-left").animate({ scrollTop: 0}, 50);
        });
    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function changeQtyCart(e) {
        const key = e.key;

        if(key !== "Backspace" && key !== "Delete") {
            var value = e.target.value;
            
            if((/^[0-9]+$/.test(value.trim()))) {
                var id = e.target.dataset.cart_id;
                var subtotal = document.getElementById("subtotal-" + id);

                if(value >= 1) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url().'page/change_kuantitas'; ?>",
                        data: {"total_kuantitas": value,"id": id},
                        dataType: "json",
                        beforeSend: function() {
                            $("#loading-section").removeAttr("style");
                        },
                        success: function(response) {
                            if(response.status == 1) {
                                subtotal.innerHTML = numberWithCommas(response.subtotal);
                                $("#total_harga_cart_right").text(numberWithCommas(response.total_harga));
                            }
                            else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Ada kesalahan pada server...'
                                });
                            }
                        },
                        complete: function() {
                            $("#loading-section").css("display","none");
                        }
                    })
                }
                else {
                    var barang_nama = document.getElementById("nama-" + id);

                    Swal.fire({
                        icon: "question",
                        title: "Hapus Barang dari Keranjang",
                        text: "Yakin menghapus " + barang_nama.innerHTML + " ?",
                        showCloseButton: true,
                        showCancelButton: true,
                        confirmButtonText: "Ya, Hapus",
                        cancelButtonText: "Batal",
                        cancelButtonColor: "#d33",
                        showLoaderOnConfirm: true,
                        allowOutsideClick: () => !Swal.isLoading(),
                        preConfirm: () => {
                            return fetch(`<?= base_url().'page/delete_cart/'; ?>` + id)
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
                            $("#cart_row_" + id).remove();
                            $("#total_harga_cart_right").text(numberWithCommas(result.value.total_harga));
                            $("#badge_cart").text(result.value.num_rows);

                            if(result.value.total_harga == 0) {
                                $("#barang_cart_right").html(
                                    $("<tr>").addClass("text-center").append(
                                        $("<td>").attr({ colspan: "4" }).html("<b>Keranjang Kosong...</b>")
                                    )
                                );

                                $("#btn-cekout").attr({ disabled: "disabled" });
                            }

                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 2000,
                                timerProgressBar: true
                            })

                            Toast.fire({
                                icon: "success",
                                title: "Barang Berhasil Dihapus"
                            })
                        }
                        else if(result.dismiss === Swal.DismissReason.cancel) {
                            $("#input_kuantitas_cart_" + id).val(1);
                        }
                    })
                }
            }
        }
    }

    function changeQtyCart2(e) {
        var value = parseInt(e.target.value);
        var id = e.target.dataset.cart_id;
        var subtotal = document.getElementById("subtotal-" + id);

        if(value >= 1) {
            $.ajax({
                type: "POST",
                url: "<?= base_url().'page/change_kuantitas'; ?>",
                data: {"total_kuantitas": value,"id": id},
                dataType: "json",
                beforeSend: function() {
                    $("#loading-section").removeAttr("style");
                },
                success: function(response) {
                    if(response.status == 1) {
                        subtotal.innerHTML = numberWithCommas(response.subtotal);
                        $("#total_harga_cart_right").text(numberWithCommas(response.total_harga));
                    }
                    else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Ada kesalahan pada server...'
                        });
                    }
                },
                complete: function() {
                    $("#loading-section").css("display","none");
                }
            })
        }
        else {
            var barang_nama = document.getElementById("nama-" + id);

            Swal.fire({
                icon: "question",
                title: "Hapus Barang dari Keranjang",
                text: "Yakin menghapus " + barang_nama.innerHTML + " ?",
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus",
                cancelButtonText: "Batal",
                cancelButtonColor: "#d33",
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm: () => {
                    return fetch(`<?= base_url().'page/delete_cart/'; ?>` + id)
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
                    $("#cart_row_" + id).remove();
                    $("#total_harga_cart_right").text(numberWithCommas(result.value.total_harga));
                    $("#badge_cart").text(result.value.num_rows);

                    if(result.value.total_harga == 0) {
                        $("#barang_cart_right").html(
                            $("<tr>").addClass("text-center").append(
                                $("<td>").attr({ colspan: "4" }).html("<b>Keranjang Kosong...</b>")
                            )
                        );

                        $("#btn-cekout").attr({ disabled: "disabled" });
                    }

                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    })

                    Toast.fire({
                        icon: "success",
                        title: "Barang Berhasil Dihapus"
                    })
                }
                else if(result.dismiss === Swal.DismissReason.cancel) {
                    $("#input_kuantitas_cart_" + id).val(1);
                }
            })
        }
    }

    function detail_barang(e) {
        var count = $("#barang_cart_right tr").length;
        
        if(count < 4) {
            var barang_id = e.target.getAttribute("barang_id");
            var barang_nama = e.target.getAttribute("barang_nama");
            var barang_harjul = e.target.getAttribute("barang_harjul");
            var barang_gambar = e.target.getAttribute("barang_gambar");

            Swal.fire({
                imageUrl: '<?php echo base_url()."assets/source/images/barang/"; ?>' + barang_gambar,
                imageWidth: 500,
                imageHeight: 250,
                imageAlt: barang_nama,
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText: '<i class="fa fa-plus"></i> Total Harga: Rp. <span id="total_harga_barang">' + numberWithCommas(barang_harjul) + '</span>',
                cancelButtonText: 'Batal',
                cancelButtonColor: '#d33',
                html:
                    '<div class="row">' +
                    '   <div class="col-6">' +
                    '       <b class="nama_barang_swal">' + barang_nama + '</b>' +
                    '   </div>' +
                    '   <div class="col-6">' +
                    '       <b class="nama_barang_swal">Rp. <span id="harga_barang_swal">' + numberWithCommas(barang_harjul) + '</span></b>' +
                    '   </div>' +
                    '   <div class="col-4 mt-5">' +
                    '       <button type="button" class="btn btn-sm border float-right" id="minus_barang"><i class="fa fa-minus"></i></button>' +
                    '   </div>' +
                    '   <div class="col-4 mt-5">' +
                    '       <b class="nama_barang_swal"><span id="total_kuantitas_barang">1</span></b>' +
                    '   </div>' +
                    '   <div class="col-4 mt-5">' +
                    '       <button type="button" class="btn btn-sm border float-left" id="plus_barang"><i class="fa fa-plus"></i></button>' +
                    '   </div>' +
                    '</div>',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm: () => {
                    var total_kuantitas = parseInt(document.getElementById("total_kuantitas_barang").innerHTML);
                    var total_harga = parseInt(barang_harjul) * total_kuantitas;

                    $.ajax({
                        type: "POST",
                        url: "<?= base_url().'page/insert_cart'; ?>",
                        data: {"barang_id": barang_id,"total_kuantitas": total_kuantitas,"total_harga": total_harga},
                        dataType: "json",
                        success: function(response) {
                            if(response.status == 1) {
                                var cek = $("#barang_cart_right").find('.text-center');
                                if(cek.length > 0) {
                                    $("#barang_cart_right").html(
                                        $("<tr>").addClass("text-left").attr({ id: "cart_row_" + response.id }).append(
                                            $("<td>").attr({ id: "nama-" + response.id }).text(barang_nama),
                                            $("<td>").html('<input type="number" onkeyup="changeQtyCart(event);" onchange="changeQtyCart2(event);" id="input_kuantitas_cart_' +response.id+ '" data-cart_id="' + response.id + '" style="width:50px" value="' + total_kuantitas + '">'),
                                            $("<td>").html('Rp. <span id="subtotal-'+ response.id + '">' + numberWithCommas(total_harga) + '</span>'),
                                            $("<td>").html('<button class="btn btn-xs btn-danger text-white" data-id="' + response.id + '" onclick="hapusCart(event);"><i class="fa fa-trash"></i> Hapus</button>')
                                        )
                                    );

                                    $("#btn-cekout").removeAttr("disabled");
                                }
                                else {
                                    $("#barang_cart_right").append(
                                        $("<tr>").addClass("text-left").attr({ id: "cart_row_" + response.id }).append(
                                            $("<td>").attr({ id: "nama-" + response.id }).text(barang_nama),
                                            $("<td>").html('<input type="number" onkeyup="changeQtyCart(event);" onchange="changeQtyCart2(event);" id="input_kuantitas_cart_' +response.id+ '" data-cart_id="' + response.id + '" style="width:50px" value="' + total_kuantitas + '">'),
                                            $("<td>").html('Rp. <span id="subtotal-'+ response.id + '">' + numberWithCommas(total_harga) + '</span>'),
                                            $("<td>").html('<button class="btn btn-xs btn-danger text-white" data-id="' + response.id + '" onclick="hapusCart(event);"><i class="fa fa-trash"></i> Hapus</button>')
                                        )
                                    );
                                }

                                var harga_cur = document.getElementById("total_harga_cart_right").innerHTML;
                                var total_harga_cur = parseInt(harga_cur.replace(/,/g, ''));
                                var fix_harga_cur = total_harga_cur + total_harga;
                                $("#total_harga_cart_right").text(numberWithCommas(fix_harga_cur));
                                $("#badge_cart").text(response.num_rows);

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: "top-end",
                                    showConfirmButton: false,
                                    timer: 2000,
                                    timerProgressBar: true
                                })

                                Toast.fire({
                                    icon: "success",
                                    title: "Barang Berhasil Ditambah ke Keranjang"
                                })
                            }
                            else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Ada kesalahan pada server...'
                                });
                            }
                        }
                    });
                }
            });

            $("#minus_barang").click(function() {
                var total_kuantitas = parseInt(document.getElementById("total_kuantitas_barang").innerHTML);
                var harga_barang = parseInt(barang_harjul);
                var cek_kuantitas = total_kuantitas - 1;
                var total_harga_barang;

                if(cek_kuantitas >= 1) {
                    total_harga_barang = harga_barang * (total_kuantitas - 1);
                    var fix_total_harga_barang = numberWithCommas(total_harga_barang);
                    var fix_total_kuantitas = total_kuantitas - 1;

                    $("#total_kuantitas_barang").text(fix_total_kuantitas);
                    $("#total_harga_barang").text(fix_total_harga_barang);
                }
            });

            $("#plus_barang").click(function() {
                var total_kuantitas = parseInt(document.getElementById("total_kuantitas_barang").innerHTML);
                var harga_barang = parseInt(barang_harjul);
                var total_harga_barang;

                if(total_kuantitas >= 1) {
                    total_harga_barang = harga_barang * (total_kuantitas + 1);
                    var fix_total_harga_barang = numberWithCommas(total_harga_barang);
                    var fix_total_kuantitas = total_kuantitas + 1;

                    $("#total_kuantitas_barang").text(fix_total_kuantitas);
                    $("#total_harga_barang").text(fix_total_harga_barang);
                }
            });
        }
        else {
            Swal.fire({
                icon: 'error',
                title: 'Keranjang Sudah Penuh',
                text: 'Maksimal barang belanja yang ada di keranjang adalah 4 (empat)'
            });
        }
    }

    function hapusCart(e) {
        var id = e.target.dataset.id;
        var barang_nama = document.getElementById("nama-" + id);

        Swal.fire({
            icon: "question",
            title: "Hapus Barang dari Keranjang",
            text: "Yakin menghapus " + barang_nama.innerHTML + " ?",
            showCloseButton: true,
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus",
            cancelButtonText: "Batal",
            cancelButtonColor: "#d33",
            showLoaderOnConfirm: true,
            allowOutsideClick: () => !Swal.isLoading(),
            preConfirm: () => {
                return fetch(`<?= base_url().'page/delete_cart/'; ?>` + id)
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
                $("#cart_row_" + id).remove();
                $("#total_harga_cart_right").text(numberWithCommas(result.value.total_harga));
                $("#badge_cart").text(result.value.num_rows);

                if(result.value.total_harga == 0) {
                    $("#barang_cart_right").html(
                        $("<tr>").addClass("text-center").append(
                            $("<td>").attr({ colspan: "4" }).html("<b>Keranjang Kosong...</b>")
                        )
                    );

                    $("#btn-cekout").attr({ disabled: "disabled" });
                }

                const Toast = Swal.mixin({
                    toast: true,
                    position: "top-end",
                    showConfirmButton: false,
                    timer: 2000,
                    timerProgressBar: true
                })

                Toast.fire({
                    icon: "success",
                    title: "Barang Berhasil Dihapus"
                })
            }
            else if(result.dismiss === Swal.DismissReason.cancel) {
                $("#input_kuantitas_cart_" + id).val(1);
            }
        })
    }

    $("#btn-login").click(function() {
        window.open('<?= base_url()."auth"; ?>', '_self');
    });

    $("#btn-cekout").click(function() {
        window.open('<?= base_url()."checkout"; ?>', '_self');
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