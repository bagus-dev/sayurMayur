<script>
    $('#keterangan').on('change', function() {
        $('#keterangan_hidden').val(this.value);
    });

    $('#bubbling').on('click', '#add', function() {
        $('#c_beli_barang_id').val($(this).data('c_beli_barang_id'));
        $('#c_beli_barang_nama').val($(this).data('c_beli_barang_nama'));
        $('#c_beli_barang_satuan').val($(this).data('c_beli_barang_satuan'));
        $('#c_beli_barang_harpok').val($(this).data('c_beli_barang_harpok'));
        $('#c_beli_barang_harjul').val($(this).data('c_beli_barang_harjul'));
        $('#c_beli_barang_harjul_grosir').val($(this).data('c_beli_barang_harjul_grosir'));
        $('#stok').val($(this).data('stok'));
        $('#staticBackdrop').modal('hide');

        get_cart_qty($(this).data('c_beli_barang_id'));
    });

    // 2 menit 29
    function get_cart_qty(c_beli_barang_id) {
        $('#cart_table tr').each(function() {
            qty_cart = $("#cart_table td.c_beli_barang_id:contains('" + c_beli_barang_id + "')").parent().find("td").eq(4).html();
            if (qty_cart != null) {
                $('#stok_cart').val(qty_cart);
            } else {
                $('#stok_cart').val(0);
            }
        });
    };

    $(document).on('click', '#add_cart', function() {
        let c_beli_barang_id = $('#c_beli_barang_id').val();
        let c_beli_barang_nama = $('#c_beli_barang_nama').val();
        let c_beli_barang_satuan = $('#c_beli_barang_satuan').val();
        let c_beli_barang_harpok = $('#c_beli_barang_harpok').val();
        let _harga = 0;

        if ($('#keterangan_hidden').val() == 'eceran') {
            let c_beli_barang_harjul = $('#c_beli_barang_harjul').val();
            _harga = c_beli_barang_harjul;
        } else if ($('#keterangan_hidden').val() == 'grosir') {
            let c_beli_barang_harjul_grosir = $('#c_beli_barang_harjul_grosir').val();
            _harga = c_beli_barang_harjul_grosir;
        }

        let c_beli_qty = parseInt($('#c_beli_qty').val());
        let stok = parseInt($('#stok').val());
        let stok_cart = parseInt($('#stok_cart').val());

        if (c_beli_barang_id === '') {
            $('#alert').removeClass('d-none');
            $('#message').text('Barang belum dipilih, silakan pilih!');
            $('#c_beli_barang_id').focus();
        } else if (c_beli_qty < 1 || c_beli_qty == '') {
            $('#alert').removeClass('d-none');
            $('#message').text('Qty tidak boleh kosong!');
            $('#c_beli_qty').val(1);
            $('#c_beli_qty').focus();
        } else {
            console.log(stok < c_beli_qty + stok_cart);
            $('#alert').addClass('d-none');
            $.ajax({
                type: 'post',
                url: '<?= site_url('pembelian/proses'); ?>',
                data: {
                    'add_cart': true,
                    'c_beli_barang_id': c_beli_barang_id,
                    'c_beli_barang_nama': c_beli_barang_nama,
                    'c_beli_barang_satuan': c_beli_barang_satuan,
                    'c_beli_barang_harpok': c_beli_barang_harpok,
                    'c_beli_barang_harjul': _harga,
                    'c_beli_qty': c_beli_qty,
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_table').load('<?= site_url('pembelian/cart_data'); ?>', function() {
                            calculate();
                        })

                        $('#c_beli_barang_id').val('');
                        $('#c_beli_barang_nama').val('');
                        $('#c_beli_barang_harpok').val('');
                        $('#c_beli_barang_harjul').val('');
                        $('#c_beli_barang_harjul_grosir').val('');
                        $('#c_beli_qty').val(1);
                    } else {
                        $('#alert').removeClass('d-none');
                        $('#message').text('Barang gagal ditambahkan ke cart');
                        $('#c_beli_qty').focus();
                    }
                }
            })
        }
    })

    $(document).on('click', '#del_cart', function() {
        if (confirm('Yakin ingin menghapus barang ini?')) {
            let c_beli_id = $(this).data('c_beli_id');
            $.ajax({
                type: 'post',
                url: '<?= site_url('pembelian/destroy'); ?>',
                data: {
                    'c_beli_id': c_beli_id
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_table').load('<?= site_url('pembelian/cart_data'); ?>', function() {
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
        $('#c_beli_barang_id2').val($(this).data('c_beli_barang_id'));
        $('#c_beli_barang_nama2').val($(this).data('c_beli_barang_nama'));
        $('#c_beli_barang_harjul2').val($(this).data('c_beli_barang_harjul'));
        $('#c_beli_qty2').val($(this).data('c_beli_qty'));
        $('#c_beli_diskon').val($(this).data('c_beli_diskon'));
        $('#c_beli_total').val($(this).data('c_beli_total'));
        $('#c_beli_total_before').val($(this).data('c_beli_total_before'));
        $('#barang_stok').val($(this).data('barang_stok'));
    });

    function count_edit_modal() {
        let c_beli_barang_harjul = $('#c_beli_barang_harjul2').val();
        let c_beli_qty = $('#c_beli_qty2').val();
        let c_beli_diskon = $('#c_beli_diskon').val();
        let c_beli_total_before = $('#c_beli_total_before').val();
        let total = 0;

        total = (c_beli_barang_harjul - c_beli_diskon) * c_beli_qty;
        $('#c_beli_total').val(total);

        if (c_beli_diskon == '') {
            $('#c_beli_diskon').val(0);
        }
    }

    $(document).on('keyup mouseup', '#c_beli_barang_harjul2, #c_beli_qty2, #c_beli_diskon', function() {
        count_edit_modal();
    });

    $(document).on('click', '#edt_cart', function() {
        var c_beli_barang_id = $('#c_beli_barang_id2').val();
        var c_beli_barang_nama = $('#c_beli_barang_nama2').val();
        var c_beli_barang_harjul = $('#c_beli_barang_harjul2').val();
        var c_beli_qty = $('#c_beli_qty2').val();
        var c_beli_diskon = $('#c_beli_diskon').val();
        var c_beli_total = $('#c_beli_total').val();
        let barang_stok = $('#barang_stok').val();

        if (c_beli_barang_harjul == '' || c_beli_barang_harjul < 1) {
            $('#alert2').removeClass('d-none');
            $('#message2').text('Harga tidak boleh kosong!');
            $('#c_beli_barang_harjul2').focus();
        } else if (c_beli_qty == '' || c_beli_qty < 1) {
            $('#alert2').removeClass('d-none');
            $('#message2').text('Jumlah Barang tidak boleh kosong!');
            $('#c_beli_barang_id').focus();
        } else {
            $('#alert2').addClass('d-none');
            $.ajax({
                type: 'post',
                url: '<?= site_url('pembelian/proses'); ?>',
                data: {
                    'edit_cart': true,
                    'c_beli_barang_id': c_beli_barang_id,
                    'c_beli_barang_nama': c_beli_barang_nama,
                    'c_beli_barang_harjul': c_beli_barang_harjul,
                    'c_beli_qty': c_beli_qty,
                    'c_beli_diskon': c_beli_diskon,
                    'c_beli_total': c_beli_total
                },
                dataType: 'json',
                success: function(result) {
                    if (result.success == true) {
                        $('#cart_table').load('<?= site_url('pembelian/cart_data'); ?>', function() {
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
        var beli_nofak = $('#beli_nofak').val();
        var beli_tanggal = $('#beli_tanggal').val();
        var beli_diskon = $('#diskon').val();
        var beli_total = $('#grandtotal').val();
        var beli_jml_uang = $('#pembayaran').val();
        var beli_kembalian = $('#kembalian').val();
        var beli_suplier_id = $('#beli_suplier_id').val();
        var beli_keterangan = $('#keterangan_hidden').val();

        var beli_subtotal = $('#subtotal').val();

        if (beli_subtotal < 1) {
            $('#alert').removeClass('d-none');
            $('#message').text('Tidak ada barang yang dipilih masuk kedalam cart!');
        } else if (beli_jml_uang < 1) {
            $('#alert').removeClass('d-none');
            $('#message').text('Belum input pembayaran!');
            $('#pembayaran').focus();
        } else {
            $('#alert').addClass('d-none');
            if (confirm('Yakin proses transaksi ini?')) {
                $.ajax({
                    type: 'post',
                    url: '<?= site_url('pembelian/proses'); ?>',
                    data: {
                        'proses_payment': true,
                        'beli_nofak': beli_nofak,
                        'beli_tanggal': beli_tanggal,
                        'beli_diskon': beli_diskon,
                        'beli_total': beli_total,
                        'beli_jml_uang': beli_jml_uang,
                        'beli_kembalian': beli_kembalian,
                        'beli_suplier_id': beli_suplier_id,
                        'beli_keterangan': beli_keterangan
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result.success == true) {
                            if (confirm('Ingin cetak struk?')) {
                                window.open('<?= site_url('pembelian/struk_print') ?>' + '/' + result.beli_nofak, '_blank');
                            }
                        } else {
                            $('#alert').removeClass('d-none');
                            $('#message').text('Barang gagal dihapus dari cart');
                        };
                        location.href = '<?= site_url('pembelian'); ?>'
                    }
                });
            }
        };
    });
</script>