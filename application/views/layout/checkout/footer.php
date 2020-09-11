<footer class="my-4">
    <div class="row">
        <div class="col-lg-12">
            <p style="text-align:center;">Copyright &copy; <?php echo '2020'; ?> by Mochamad Natsir</p>
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

<!-- Select2 -->
<script src="<?= base_url(); ?>assets/adminlte/plugins/select2/js/select2.full.min.js"></script>

<!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-price-format/2.2.0/jquery.priceformat.min.js"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url(); ?>assets/pos/js/page/sweetalert2.all.min.js"></script>

<!-- Custom Script -->
<?php $this->load->view("layout/script/checkout"); ?>

</body>

</html>