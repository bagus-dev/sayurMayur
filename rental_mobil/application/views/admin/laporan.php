<div class="page-header">
    <h3>Laporan</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li class="active">
        Laporan Transaksi
    </li>
</ol>
<div class="panel panel-orange">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-file-alt"></i>
            Laporan Transaksi
        </h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url().'admin/laporan'; ?>" method="post">
            <div class="form-group">
                <label>Dari Tanggal</label>
                <input type="text" name="dari" class="form-control" id="datepicker4">
                <?php echo form_error("dari"); ?>
            </div>
            <div class="form-group">
                <label>Sampai Tanggal</label>
                <input type="text" name="sampai" class="form-control" id="datepicker5">
                <?php echo form_error("sampai"); ?>
            </div>
            <div class="form-group">
                <input type="submit" value="CARI" name="cari" class="btn btn-sm btn-primary">
            </div>
        </form>
    </div>
</div>
</div>
</div>