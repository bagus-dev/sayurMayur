<footer class="my-4">
    <div class="row">
        <div class="col-lg-12">
            <p style="text-align:center;">Copyright &copy; <?php echo '2020'; ?> by RadjaSayur</p>
        </div>
    </div>
    <!-- /.row -->
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<!-- AdminLTE App -->
<script src="<?= base_url(); ?>assets/adminlte/dist/js/adminlte.js"></script>

<!-- DataTables -->
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url(); ?>assets/adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<!-- Select2 -->
<script src="<?= base_url(); ?>assets/adminlte/plugins/select2/js/select2.full.min.js"></script>

<!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-price-format/2.2.0/jquery.priceformat.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>assets/pos/js/page/sweetalert2.all.min.js"></script>

<!-- Moment + Tempus Dominus -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment-with-locales.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.0-alpha14/js/tempusdominus-bootstrap-4.min.js"></script>

<?php if (isset($datable)) : ?>
    <?php $this->load->view('layout/script/datable'); ?>
<?php endif; ?>
<?php if (isset($select2)) : ?>
    <?php $this->load->view('layout/script/select2'); ?>
<?php endif; ?>
<?php if (isset($concurency)) : ?>
    <?php $this->load->view('layout/script/concurency'); ?>
<?php endif; ?>

<?php if (isset($barang)) : ?>
    <?php $this->load->view('layout/script/barang'); ?>
<?php endif; ?>

<?php if (isset($page)) : ?>
    <?php $this->load->view('layout/script/barangs'); ?>
<?php endif; ?>

<?php if (isset($keranjangs)) : ?>
    <?php $this->load->view('layout/script/barangs'); ?>
<?php endif; ?>

<?php if (isset($kategori)) : ?>
    <?php $this->load->view('layout/script/kategori'); ?>
<?php endif; ?>

<?php if (isset($satuan)) : ?>
    <?php $this->load->view('layout/script/satuan'); ?>
<?php endif; ?>

<?php if (isset($pengguna)) : ?>
    <?php $this->load->view('layout/script/pengguna'); ?>
<?php endif; ?>

<?php if (isset($suplier)) : ?>
    <?php $this->load->view('layout/script/suplier'); ?>
<?php endif; ?>

<?php if (isset($customer)) : ?>
    <?php $this->load->view('layout/script/customer'); ?>
<?php endif; ?>

<?php if (isset($diskon)) : ?>
    <?php $this->load->view('layout/script/diskon'); ?>
<?php endif; ?>

<?php if (isset($ongkir)) : ?>
    <?php $this->load->view('layout/script/ongkir'); ?>
<?php endif; ?>

<?php if (isset($waktu)) : ?>
    <?php $this->load->view('layout/script/waktu'); ?>
<?php endif; ?>

<?php if (isset($penjualan)) : ?>
    <?php $this->load->view('layout/script/penjualan'); ?>
<?php endif; ?>

<?php if (isset($penjualanonline)) : ?>
    <?php $this->load->view('layout/script/penjualanonline'); ?>
<?php endif; ?>

<?php if (isset($detailinvoice)) : ?>
    <?php $this->load->view('layout/script/detail_invoice'); ?>
<?php endif; ?>

<?php if (isset($pembelian)) : ?>
    <?php $this->load->view('layout/script/pembelian'); ?>
<?php endif; ?>

<?php if (isset($penjualan_laporan)) : ?>
    <?php $this->load->view('layout/script/penjualan_laporan'); ?>
<?php endif; ?>

<?php if (isset($pembelian_laporan)) : ?>
    <?php $this->load->view('layout/script/pembelian_laporan'); ?>
<?php endif; ?>

<?php if (isset($laporanpenjualanonline)) : ?>
    <?php $this->load->view('layout/script/penjualan_online_laporan'); ?>
<?php endif; ?>

<?php if (isset($howtotrf)) : ?>
    <?php $this->load->view('layout/script/howtotrf'); ?>
<?php endif; ?>

<?php if (isset($invoice)) : ?>
    <?php $this->load->view('layout/script/profile_customer'); ?>
<?php endif; ?>

<?php if (isset($detail_invoice)) : ?>
    <?php $this->load->view('layout/script/check_invoice'); ?>
<?php endif; ?>

<?php if ($title == 'Unggah Bukti Transfer') : ?>
    <?php $this->load->view('layout/script/upload_trf'); ?>
<?php endif; ?>


</body>

</html>