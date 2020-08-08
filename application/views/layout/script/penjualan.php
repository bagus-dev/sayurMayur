<script>
    $('#keterangan').on('change', function() {
        $('#keterangan_hidden').val(this.value);
    });

    $('#bubbling').on('click', '#add', function() {
        $('#c_jual_barang_id').val($(this).data('c_jual_barang_id'));
        $('#c_jual_barang_nama').val($(this).data('c_jual_barang_nama'));
        $('#c_jual_barang_satuan').val($(this).data('c_jual_barang_satuan'));
        $('#c_jual_barang_harpok').val($(this).data('c_jual_barang_harpok'));
        $('#c_jual_barang_harjul').val($(this).data('c_jual_barang_harjul'));
        $('#c_jual_barang_harjul_grosir').val($(this).data('c_jual_barang_harjul_grosir'));
        $('#stok').val($(this).data('stok'));
        $('#staticBackdrop').modal('hide');

        get_cart_qty($(this).data('c_jual_barang_id'));
    });

    // 2 menit 29
    function get_cart_qty(c_jual_barang_id) {
        $('#cart_table tr').each(function() {
            qty_cart = $("#cart_table td.c_jual_barang_id:contains('" + c_jual_barang_id + "')").parent().find("td").eq(4).html();
            if (qty_cart != null) {
                $('#stok_cart').val(qty_cart);
            } else {
                $('#stok_cart').val(0);
            }
        });
    };

    $(document).on('click', '#add_cart', function() {
        let c_jual_barang_id = $('#c_jual_barang_id').val();
        let c_jual_barang_nama = $('#c_jual_barang_nama').val();
        let c_jual_barang_satuan = $('#c_jual_barang_satuan').val();
        let c_jual_barang_harpok = $('#c_jual_barang_harpok').val();
        let _harga = 0;

        if ($('#keterangan_hidden').val() == 'eceran') {
            let c_jual_barang_harjul = $('#c_jual_barang_harjul').val();
            _harga = c_jual_barang_harjul;
        } else if ($('#keterangan_hidden').val() == 'grosir') {
            let c_jual_barang_harjul_grosir = $('#c_jual_barang_harjul_grosir').val();
            _harga = c_jual_barang_harjul_grosir;
        }

        let c_jual_qty = parseInt($('#c_jual_qty').val());
        let stok = parseInt($('#stok').val());
        let stok_cart = parseInt($('#stok_cart').val());

        if (c_jual_barang_id === '') {
            $('#alert').removeClass('d-none');
            $('#message').text('Barang belum dipilih, silakan pilih!');
            $('#c_jual_barang_id').focus();
        } else if (c_beli_qty < 1 || c_beli_qty == '') {
            $('#alert').removeClass('d-none');
            $('#message').text('Qty tidak boleh kosong!');
            $('#c_jual_qty').val(1);
            $('#c_jual_qty').focus();
        } else if (stok < 1 || stok < c_jual_qty + stok_cart || stok < c_beli_qty) {
            $('#alert').removeClass('d-none');
            $('#message').text('Stok Barang tidak mencukupi!');
            $('#c_jual_barang_id').focus();
        } else {
            $('#alert').addClass('d-none');
            $.ajax({
                type: 'post',
                url: '<?= site_url('penjualan/proses'); ?>',
                data: {
                    'add_cart': true,
                    'c_jual_barang_id': c_jual_barang_id,
                    'c_jual_barang_nama': c_jual_barang_nama,
                    'c_jual_barang_satuan': c_jual_barang_satuan,
                    'c_jual_barang_harpok': c_jual_barang_harpok,
                    'c_jual_barang_harjul': _harga,
                    'c_jual_qty': c_jual_qty,
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_table').load('<?= site_url('penjualan/cart_data'); ?>', function() {
                            calculate();
                        })

                        $('#c_jual_barang_id').val('');
                        $('#c_jual_barang_nama').val('');
                        $('#c_jual_barang_harpok').val('');
                        $('#c_jual_barang_harjul').val('');
                        $('#c_jual_barang_harjul_grosir').val('');
                        $('#c_jual_qty').val(1);
                    } else {
                        $('#alert').removeClass('d-none');
                        $('#message').text('Barang gagal ditambahkan ke cart');
                        $('#c_jual_qty').focus();
                    }
                }
            })
        }
    })

    $(document).on('click', '#del_cart', function() {
        if (confirm('Yakin ingin menghapus barang ini?')) {
            let c_jual_id = $(this).data('c_jual_id');
            $.ajax({
                type: 'post',
                url: '<?= site_url('penjualan/destroy'); ?>',
                data: {
                    'c_jual_id': c_jual_id
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_table').load('<?= site_url('penjualan/cart_data'); ?>', function() {
                            calculate();
                        })
                    } else {
                        $('#alert').removeClass('d-none');
                        $('#message').text('Barang gagal dihapus dari cart');
                    }
                }
            })
        }
    });

    $(document).on('click', '.tampil-modal-ubah', function() {
        $('#c_jual_barang_id2').val($(this).data('c_jual_barang_id'));
        $('#c_jual_barang_nama2').val($(this).data('c_jual_barang_nama'));
        $('#c_jual_barang_harjul2').val($(this).data('c_jual_barang_harjul'));
        $('#c_jual_qty2').val($(this).data('c_jual_qty'));
        $('#c_jual_diskon').val($(this).data('c_jual_diskon'));
        $('#c_jual_total').val($(this).data('c_jual_total'));
        $('#c_jual_total_before').val($(this).data('c_jual_total_before'));
        $('#barang_stok').val($(this).data('barang_stok'));
    });

    function count_edit_modal() {
        let c_jual_barang_harjul = $('#c_jual_barang_harjul2').val();
        let c_jual_qty = $('#c_jual_qty2').val();
        let c_jual_diskon = $('#c_jual_diskon').val();
        let c_jual_total_before = $('#c_jual_total_before').val();
        let total = 0;

        total = (c_jual_barang_harjul - c_jual_diskon) * c_jual_qty;
        $('#c_jual_total').val(total);

        if (c_jual_diskon == '') {
            $('#c_jual_diskon').val(0);
        }
    }

    $(document).on('keyup mouseup', '#c_jual_barang_harjul2, #c_jual_qty2, #c_jual_diskon', function() {
        count_edit_modal();
    });

    $(document).on('click', '#edt_cart', function() {
        var c_jual_barang_id = $('#c_jual_barang_id2').val();
        var c_jual_barang_nama = $('#c_jual_barang_nama2').val();
        var c_jual_barang_harjul = $('#c_jual_barang_harjul2').val();
        var c_jual_qty = $('#c_jual_qty2').val();
        var c_jual_diskon = $('#c_jual_diskon').val();
        var c_jual_total = $('#c_jual_total').val();
        let barang_stok = $('#barang_stok').val();

        if (c_jual_barang_harjul == '' || c_jual_barang_harjul < 1) {
            $('#alert2').removeClass('d-none');
            $('#message2').text('Harga tidak boleh kosong!');
            $('#c_jual_barang_harjul2').focus();
        } else if (c_jual_qty == '' || c_jual_qty < 1) {
            $('#alert2').removeClass('d-none');
            $('#message2').text('Jumlah Barang tidak boleh kosong!');
            $('#c_jual_barang_id').focus();
        } else if (c_jual_qty > barang_stok) {
            $('#alert2').removeClass('d-none');
            $('#message2').text('Stok tidak mencukupi!');
            $('#c_jual_barang_id').focus();
        } else {
            $('#alert2').addClass('d-none');
            $.ajax({
                type: 'post',
                url: '<?= site_url('penjualan/proses'); ?>',
                data: {
                    'edit_cart': true,
                    'c_jual_barang_id': c_jual_barang_id,
                    'c_jual_barang_nama': c_jual_barang_nama,
                    'c_jual_barang_harjul': c_jual_barang_harjul,
                    'c_jual_qty': c_jual_qty,
                    'c_jual_diskon': c_jual_diskon,
                    'c_jual_total': c_jual_total
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_table').load('<?= site_url('penjualan/cart_data'); ?>', function() {
                            calculate();
                        })

                        $('#modalUniversal').modal('hide');
                    } else {
                        $('#modalUniversal').modal('hide');
                    };
                }
            });
        };
    });

    function calculate() {
        let subtotal = 0;
        $('#cart_table tr').each(function() {
            subtotal += parseInt($(this).find('#total').text())
        })
        isNaN(subtotal) ? $('#subtotal').val(0) : $('#subtotal').val(subtotal);

        let diskon = $('#diskon').val();
        let grandtotal = subtotal - diskon;
        if (isNaN(grandtotal)) {
            $('#grandtotal').val(0);
            $('#grandtotal2').text(0);
        } else {
            $('#grandtotal').val(grandtotal);
            $('#grandtotal2').text(grandtotal);
        }

        let pembayaran = $('#pembayaran').val();
        pembayaran != 0 ? $('#kembalian').val(pembayaran - grandtotal) : $('#kembalian').val(0);

        if (diskon == '') {
            $('#diskon').val(0);
        }
    };

    $(document).on('keyup mouseup', '#diskon, #pembayaran', function() {
        calculate();
    });

    $(document).ready(function() {
        calculate();
    });

    $(document).on('click', '#payment_proses', function() {
        var jual_nofak = $('#jual_nofak').val();
        var jual_tanggal = $('#jual_tanggal').val();
        var jual_diskon = $('#diskon').val();
        var jual_total = $('#grandtotal').val();
        var jual_jml_uang = $('#pembayaran').val();
        var jual_kembalian = $('#kembalian').val();
        var jual_cutomer_id = $('#jual_cutomer_id').val();
        var jual_keterangan = $('#keterangan_hidden').val();

        var jual_subtotal = $('#subtotal').val();

        if (jual_subtotal < 1) {
            $('#alert').removeClass('d-none');
            $('#message').text('Tidak ada barang yang dipilih masuk kedalam cart!');
        } else if (jual_jml_uang < 1) {
            $('#alert').removeClass('d-none');
            $('#message').text('Belum input pembayaran!');
            $('#pembayaran').focus();
        } else {
            $('#alert').addClass('d-none');
            if (confirm('Yakin proses transaksi ini?')) {
                $.ajax({
                    type: 'post',
                    url: '<?= site_url('penjualan/proses'); ?>',
                    data: {
                        'proses_payment': true,
                        'jual_nofak': jual_nofak,
                        'jual_tanggal': jual_tanggal,
                        'jual_diskon': jual_diskon,
                        'jual_total': jual_total,
                        'jual_jml_uang': jual_jml_uang,
                        'jual_kembalian': jual_kembalian,
                        'jual_customer_id': jual_cutomer_id,
                        'jual_keterangan': jual_keterangan
                    },
                    dataType: 'json',
                    success: function(result) {
                        console.log(result);
                        if (result.success == true) {
                            if (confirm('Ingin cetak struk?')) {
                                window.open('<?= site_url('penjualan/struk_print') ?>' + '/' + result.jual_nofak, '_blank');
                            }
                        } else {
                            $('#alert').removeClass('d-none');
                            $('#message').text('Barang gagal dihapus dari cart');
                        };
                        location.href = '<?= site_url('penjualan'); ?>'
                    }
                });
            }
        };
    });
</script>