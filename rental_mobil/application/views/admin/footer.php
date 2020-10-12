</div>
<script src="<?php echo base_url().'assets/js/bootbox.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/lightbox-plus-jquery.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/datatable/jquery.dataTables.js'; ?>"></script>
<script src="<?php echo base_url().'assets/datatable/datatables.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/bootstrap-datepicker.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/bootstrap-datetimepicker.min.js'; ?>"></script>
<script src="<?php echo base_url().'assets/js/id.js'; ?>"></script>
<script>
    var gambar = "<?php echo $this->session->userdata('gambar_admin'); ?>";
    $(document).on("click", ".confirm", function(e){
        e.preventDefault();
        bootbox.confirm({
            title: "<i class='fas fa-sign-out-alt'></i>Logout",
            message: "<center><img src='http://localhost/rental_mobil/assets/images/admin/"+gambar+"' class='img-fluid rounded-circle w-50'><br><h3><strong>Lakukan Logout?</strong></h3></center>",
            buttons: {
                cancel: {
                    label: '<i class="fa fa-times"></i> Batal'
                },
                confirm: {
                    label: '<i class="fa fa-check"></i> Ya'
                }
            },
            callback: function (result) {
                if(result == true){
                    window.location.href = "http://localhost/rental_mobil/admin/logout";
                }
            }
        });
    });
</script>
<script>
    $(function () {
        $("#datetimepicker1").datetimepicker({
            format: "HH:mm:ss",
            locale: "id",
            showClear: true,
            showTodayButton: true,
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $("#datepicker").datetimepicker({
            format: "MM/DD/YYYY",
            locale: "id",
            showClear: true,
            showTodayButton: true,
            daysOfWeekDisabled: [0]
        });
    });
    $(function () {
        $("#datepicker2").datetimepicker({
            format: "MM/DD/YYYY",
            locale: "id",
            showClear: true,
            showTodayButton: true,
            daysOfWeekDisabled: [0]
        });
    });
    $(function () {
        $("#datepicker3").datetimepicker({
            format: "MM/DD/YYYY",
            locale: "id",
            showClear: true,
            showTodayButton: true,
            daysOfWeekDisabled: [0]
        });
    });
    $(function () {
        $("#datepicker4").datetimepicker({
            format: "MM/DD/YYYY",
            locale: "id",
            showClear: true,
            showTodayButton: true,
            daysOfWeekDisabled: [0]
        });
    });
    $(function () {
        $("#datepicker5").datetimepicker({
            format: "MM/DD/YYYY",
            locale: "id",
            showClear: true,
            showTodayButton: true,
            daysOfWeekDisabled: [0]
        });
    });
</script>
<script>
    $(document).ready( function() {
        $("#table-datatable").DataTable();
    } );
    $(document).ready( function() {
        $("table.multiple").DataTable();
    } );
</script>
<script>
    $(document).ready(function(){
        $("#loader-wrapper").fadeOut();
    })
</script>
</body>
</html>