<div class="page-header">
    <h3>Transaksi Selesai</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li>
        <a href="<?php echo base_url().'admin/transaksi'; ?>">Lihat Data Transaksi</a>
    </li>
    <li class="active">
        Hapus Transaksi
    </li>
</ol>
<?php foreach($transaksi as $t){ ?>
<div class="panel panel-red">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-file-invoice"></i>
            Transaksi Selesai
        </h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url().'admin/transaksi_batal_act'; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $t->transaksi_id; ?>">
            <div class="form-group">
                <label>Alasan Membatalkan Transaksi</label>
                <textarea name="alasan" class="form-control" placeholder="Alasan" style="<?php if(form_error('alasan') != ''){echo'border:2px solid red;'; } ?>"><?php if(isset($alasan["alasan"])){echo $alasan["alasan"] ; } ?></textarea>
                <?php echo form_error("alasan"); ?>
            </div>
            <div class="form-group">
                <input type="submit" value="Hapus Transaksi" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<?php } ?>
</div></div>