<script>
    (function() {
        window.onresize = displayWindowSize;
        window.onload = displayWindowSize;

        function displayWindowSize() {
            let myWidth = window.innerWidth;

            if (myWidth > 767) {
                $(window).scroll(function() {
                    if ($(this).scrollTop() > 150 && myWidth > 767) {
                        $("#cart-right").removeClass("cart-right");
                        $("#cart-right").addClass("fix-cart");

                        var parentCart = $("#parent-cart").width();
                        $("#cart-right").css("width", parentCart + "px");
                    } else if ($(this).scrollTop() <= 150 && myWidth > 767) {
                        $("#cart-right").removeClass("fix-cart");
                        $("#cart-right").addClass("cart-right");
                    }
                });

                $("#kat_1").removeClass("btn-xs");
                $("#kat_2").removeClass("btn-xs");
                $(".title-kategori").addClass("pb-3");
                $(".title-kategori").removeClass("pb-4");
                $("#parent-cart").removeClass("mt-3");
            } else {
                $("#kat_1").addClass("btn-xs");
                $("#kat_2").addClass("btn-xs");
                $(".title-kategori").removeClass("pb-3");
                $(".title-kategori").addClass("pb-4");
                $("#parent-cart").addClass("mt-3");
            }
        }
    })();

    $('[name="input_qty"]').change(function(e) {
        var id = e.target.dataset.barang_id;
        var value = e.target.value;

        if (value !== "0" && value !== "lainnya") {
            $("#qty_input_" + id).css("display", "none");
            $("#select_qty_" + id).css("width", "45px");
            $("#select_qty_" + id).css("margin-bottom", "");
            $("#qty_input_" + id).val("");
            $("#btn-simpan-" + id).removeAttr("disabled");
        } else if (value == "lainnya") {
            $("#qty_input_" + id).css("display", "inline");
            $("#select_qty_" + id).css("width", "70px");
            $("#select_qty_" + id).css("margin-bottom", "10px");
            $("#qty_input_" + id).val(1);
            $("#btn-simpan-" + id).removeAttr("disabled");
        } else if (value == "0") {
            $("#select_qty_" + id).css("display", "inline");
            $("#qty_input_" + id).css("display", "none");
            $("#select_qty_" + id).css("width", "45px");
            $("#select_qty_" + id).css("margin-bottom", "");
            $("#qty_input_" + id).val("");
            $("#btn-simpan-" + id).attr("disabled", "disabled");
        }
    });

    $("#kat_1").click(function() {
        window.open('<?= base_url(); ?>', '_self');
    });

    $("#kat_2").click(function() {
        window.open('<?= base_url() . "kategori/bumbu"; ?>', '_self');
    });

    function qtyInput(e) {
        const key = e.key;
        var value = e.target.value;
        var id = e.target.dataset.barang_id;
        var no = e.target.dataset.no;
        var stok = $("#stok-" + no).text();

        if (key !== "Backspace" && key !== "Delete") {
            if ((/^[0-9]+$/.test(value.trim()))) {
                if (value >= 1) {
                    if (value > parseInt(stok)) {
                        e.target.value = stok;
                    }

                    $("#btn-simpan-" + id).removeAttr("disabled");
                } else {
                    $("#btn-simpan-" + id).attr("disabled", "disabled");
                }
            }
        } else if (key == "Backspace" || key == "Delete") {
            if (value.trim() == "" || value.trim() < 1) {
                $("#btn-simpan-" + id).attr("disabled", "disabled");
            }
        }
    }

    function qtyInput2(e) {
        var value = parseInt(e.target.value);
        var id = e.target.dataset.barang_id;
        var no = e.target.dataset.no;
        var stok = $("#stok-" + no).text();

        if (value >= 1) {
            if (value > parseInt(stok)) {
                e.target.value = stok;
            }

            $("#btn-simpan-" + id).removeAttr("disabled");
        } else {
            $("#btn-simpan-" + id).attr("disabled", "disabled");
        }
    }

    function simpan_barang(e) {
        var id = e.target.dataset.barang_id;
        var barang_nama = e.target.dataset.barang_nama;
        var barang_harjul = e.target.dataset.barang_harjul;
        var select_qty = $('#select_qty_' + id).val();
        var kuantitas;

        if (select_qty !== "0" && select_qty == "lainnya") {
            kuantitas = $("#qty_input_" + id).val();
        } else if (select_qty !== "0" && select_qty !== "lainnya") {
            kuantitas = $("#select_qty_" + id).val();
        }

        var total_kuantitas = parseInt(kuantitas);
        var total_harga = parseInt(barang_harjul) * total_kuantitas;

        $.ajax({
            type: "POST",
            url: "<?= base_url() . 'page/insert_cart'; ?>",
            data: {
                barang_id: id,
                total_kuantitas: total_kuantitas,
                total_harga: total_harga
            },
            dataType: "json",
            beforeSend: function() {
                $("#loading-section2").removeAttr("style");
            },
            success: function(response) {
                if (response.status == 1) {
                    var cek = $("#barang_cart_right").find('.text-center');
                    if (cek.length > 0) {
                        $("#barang_cart_right").html(
                            $("<tr>").addClass("text-left").attr({
                                id: "cart_row_" + response.id
                            }).append(
                                $("<td>").attr({
                                    id: "nama-" + response.id
                                }).text(barang_nama),
                                $("<td>").html('<input type="number" class="qty_input" onkeyup="changeQtyCart(event);" onchange="changeQtyCart2(event);" id="input_kuantitas_cart_' + response.id + '" data-cart_id="' + response.id + '" style="width:50px" value="' + total_kuantitas + '">'),
                                $("<td>").html('<span id="subtotal-' + response.id + '">' + numberWithCommas(total_harga) + '</span>'),
                                $("<td>").html('<button class="btn btn-xs btn-danger text-white" data-id="' + response.id + '" onclick="hapusCart(event);"><i class="fa fa-trash"></i> Hapus</button>')
                            )
                        );

                        $("#btn-cekout").removeAttr("disabled");
                    } else {
                        $("#barang_cart_right").append(
                            $("<tr>").addClass("text-left").attr({
                                id: "cart_row_" + response.id
                            }).append(
                                $("<td>").attr({
                                    id: "nama-" + response.id
                                }).text(barang_nama),
                                $("<td>").html('<input type="number" class="qty_input" onkeyup="changeQtyCart(event);" onchange="changeQtyCart2(event);" id="input_kuantitas_cart_' + response.id + '" data-cart_id="' + response.id + '" style="width:50px" value="' + total_kuantitas + '">'),
                                $("<td>").html('<span id="subtotal-' + response.id + '">' + numberWithCommas(total_harga) + '</span>'),
                                $("<td>").html('<button class="btn btn-xs btn-danger text-white" data-id="' + response.id + '" onclick="hapusCart(event);"><i class="fa fa-trash"></i> Hapus</button>')
                            )
                        );
                    }

                    var harga_cur = document.getElementById("total_harga_cart_right").innerHTML;
                    var total_harga_cur = parseInt(harga_cur.replace(/,/g, ''));
                    var fix_harga_cur = total_harga_cur + total_harga;
                    $("#total_harga_cart_right").text(numberWithCommas(fix_harga_cur));
                    $("#badge_cart").text(response.num_rows);
                    $("#qty_input_" + id).val("");
                    $("#btn-simpan-" + id).attr("disabled", "disabled");

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
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Ada kesalahan pada server...'
                    });
                }
            },
            complete: function() {
                $("#loading-section2").attr("style", "display:none");
            }
        })
    }

    function getPageList(totalPages, page, maxLength) {
        if (maxLength < 5) throw "maxLength must be at least 5";

        function range(start, end) {
            return Array.from(Array(end - start + 1), (_, i) => i + start);
        }

        var sideWidth = maxLength < 9 ? 1 : 2;
        var leftWidth = (maxLength - sideWidth * 2 - 3) >> 1;
        var rightWidth = (maxLength - sideWidth * 2 - 2) >> 1;

        if (totalPages <= maxLength) {
            return range(1, totalPages);
        }

        if (totalPages <= maxLength - sideWidth - 1 - rightWidth) {
            return range(1, maxLength - sideWidth - 1)
                .concat([0])
                .concat(range(totalPages - sideWidth + 1, totalPages));
        }

        if (page >= totalPages - sideWidth - 1 - rightWidth) {
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
            if (whichPage < 1 || whichPage > totalPages) return false;
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
            $("<li>").addClass("page-item").attr({
                id: "previous-page"
            }).append(
                $("<a>")
                .addClass("page-link")
                .attr({
                    href: "javascript:void(0)"
                })
                .text("Sebelumnya")
            ),
            $("<li>").addClass("page-item").attr({
                id: "next-page"
            }).append(
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
            $("#col-left").animate({
                scrollTop: 0
            }, 50);
        });
    });

    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

    function changeQtyCart(e) {
        const key = e.key;

        if (key !== "Backspace" && key !== "Delete") {
            var value = e.target.value;

            if ((/^[0-9]+$/.test(value.trim()))) {
                var id = e.target.dataset.cart_id;
                var subtotal = document.getElementById("subtotal-" + id);

                if (value >= 1) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() . 'page/change_kuantitas'; ?>",
                        data: {
                            "total_kuantitas": value,
                            "id": id
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $("#loading-section").removeAttr("style");
                        },
                        success: function(response) {
                            if (response.status == 1) {
                                subtotal.innerHTML = numberWithCommas(response.subtotal);
                                $("#total_harga_cart_right").text(numberWithCommas(response.total_harga));
                            } else if (response.status = 2) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Jumlah Barang Melebihi Stok...'
                                });

                                e.target.value = response.stok;
                                subtotal.innerHTML = numberWithCommas(response.subtotal);
                                $("#total_harga_cart_right").text(numberWithCommas(response.total_harga));
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Gagal',
                                    text: 'Ada kesalahan pada server...'
                                });
                            }
                        },
                        complete: function() {
                            $("#loading-section").css("display", "none");
                        }
                    })
                } else {
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
                            return fetch(`<?= base_url() . 'page/delete_cart/'; ?>` + id)
                                .then(response => {
                                    if (!response.ok) {
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
                        if (result.value) {
                            $("#cart_row_" + id).remove();
                            $("#total_harga_cart_right").text(numberWithCommas(result.value.total_harga));
                            $("#badge_cart").text(result.value.num_rows);

                            if (result.value.total_harga == 0) {
                                $("#barang_cart_right").html(
                                    $("<tr>").addClass("text-center").append(
                                        $("<td>").attr({
                                            colspan: "4"
                                        }).html("<b>Keranjang Kosong...</b>")
                                    )
                                );

                                $("#btn-cekout").attr({
                                    disabled: "disabled"
                                });
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
                        } else if (result.dismiss === Swal.DismissReason.cancel) {
                            var qty = 1;

                            $.ajax({
                                type: "POST",
                                url: "<?= base_url() . 'page/change_kuantitas'; ?>",
                                data: {
                                    "total_kuantitas": qty,
                                    "id": id
                                },
                                dataType: "json",
                                beforeSend: function() {
                                    $("#loading-section").removeAttr("style");
                                },
                                success: function(response) {
                                    $("#input_kuantitas_cart_" + id).val(1);
                                    subtotal.innerHTML = numberWithCommas(response.subtotal);
                                    $("#total_harga_cart_right").text(numberWithCommas(response.total_harga));
                                },
                                complete: function() {
                                    $("#loading-section").css("display", "none");
                                }
                            });
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

        if (value >= 1) {
            $.ajax({
                type: "POST",
                url: "<?= base_url() . 'page/change_kuantitas'; ?>",
                data: {
                    "total_kuantitas": value,
                    "id": id
                },
                dataType: "json",
                beforeSend: function() {
                    $("#loading-section").removeAttr("style");
                },
                success: function(response) {
                    if (response.status == 1) {
                        subtotal.innerHTML = numberWithCommas(response.subtotal);
                        $("#total_harga_cart_right").text(numberWithCommas(response.total_harga));
                    } else if (response.status = 2) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Jumlah Barang Melebihi Stok...'
                        });

                        e.target.value = response.stok;
                        subtotal.innerHTML = numberWithCommas(response.subtotal);
                        $("#total_harga_cart_right").text(numberWithCommas(response.total_harga));
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal',
                            text: 'Ada kesalahan pada server...'
                        });
                    }
                },
                complete: function() {
                    $("#loading-section").css("display", "none");
                }
            })
        } else {
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
                    return fetch(`<?= base_url() . 'page/delete_cart/'; ?>` + id)
                        .then(response => {
                            if (!response.ok) {
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
                if (result.value) {
                    $("#cart_row_" + id).remove();
                    $("#total_harga_cart_right").text(numberWithCommas(result.value.total_harga));
                    $("#badge_cart").text(result.value.num_rows);

                    if (result.value.total_harga == 0) {
                        $("#barang_cart_right").html(
                            $("<tr>").addClass("text-center").append(
                                $("<td>").attr({
                                    colspan: "4"
                                }).html("<b>Keranjang Kosong...</b>")
                            )
                        );

                        $("#btn-cekout").attr({
                            disabled: "disabled"
                        });
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
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    var qty = 1;

                    $.ajax({
                        type: "POST",
                        url: "<?= base_url() . 'page/change_kuantitas'; ?>",
                        data: {
                            "total_kuantitas": qty,
                            "id": id
                        },
                        dataType: "json",
                        beforeSend: function() {
                            $("#loading-section").removeAttr("style");
                        },
                        success: function(response) {
                            $("#input_kuantitas_cart_" + id).val(1);
                            subtotal.innerHTML = numberWithCommas(response.subtotal);
                            $("#total_harga_cart_right").text(numberWithCommas(response.total_harga));
                        },
                        complete: function() {
                            $("#loading-section").css("display", "none");
                        }
                    });
                }
            })
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
                return fetch(`<?= base_url() . 'page/delete_cart/'; ?>` + id)
                    .then(response => {
                        if (!response.ok) {
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
            if (result.value) {
                $("#cart_row_" + id).remove();
                $("#total_harga_cart_right").text(numberWithCommas(result.value.total_harga));
                $("#badge_cart").text(result.value.num_rows);

                if (result.value.total_harga == 0) {
                    $("#barang_cart_right").html(
                        $("<tr>").addClass("text-center").append(
                            $("<td>").attr({
                                colspan: "4"
                            }).html("<b>Keranjang Kosong...</b>")
                        )
                    );

                    $("#btn-cekout").attr({
                        disabled: "disabled"
                    });
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
        })
    }

    $("#btn-login").click(function() {
        window.open('<?= base_url() . "auth"; ?>', '_self');
    });

    $("#btn-cekout").click(function() {
        window.open('<?= base_url() . "checkout"; ?>', '_self');
    });
</script>
<?php
if ($this->uri->segment(2) == "") {
?>
    <script>
        function updateStock() {
            var barang_kategori_id = 1;

            $.ajax({
                type: "POST",
                url: "<?= base_url() . 'page/update_stock'; ?>",
                data: "barang_kategori_id=" + barang_kategori_id,
                dataType: "json",
                success: function(response) {
                    var ii = 1;

                    for (var i = 0; i < response.data.length; i++) {
                        $("#stok-" + ii++).text(response.data[i].stok);
                    }
                }
            });
        }
    </script>
<?php
} elseif ($this->uri->segment(2) == "bumbu") {
?>
    <script>
        function updateStock() {
            var barang_kategori_id = 2;

            $.ajax({
                type: "POST",
                url: "<?= base_url() . 'page/update_stock'; ?>",
                data: "barang_kategori_id=" + barang_kategori_id,
                dataType: "json",
                success: function(response) {
                    var ii = 1;
                    for (var i = 0; i < response.data.length; i++) {
                        $("#stok-" + ii++).text(response.data[i].stok);
                    }
                }
            });
        }
    </script>
<?php
}
?>
<script>
    $(document).ready(function() {
        setInterval(function() {
            updateStock();
        }, 1000);
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
            if (result.value) {
                window.open('<?= base_url() . "auth/logout"; ?>', '_self')
            }
        })
    });
</script>