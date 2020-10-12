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
        Transaksi Selesai
    </li>
</ol>
<?php
    if(isset($_GET["pesan"])){
        if($_GET["pesan"] == "gagal"){
            echo "<div class='alert alert-danger'>Tanggal Dikembalikan Oleh Customer Kurang Dari Tanggal Harus Kembali.</div>";
        }
    }
?>
<?php foreach($transaksi as $t){ ?>
<div class="panel panel-red">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-file-invoice"></i>
            Transaksi Selesai
        </h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url().'admin/transaksi_selesai_act'; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $t->transaksi_id; ?>">
            <input type="hidden" name="mobil" value="<?php echo $t->id_mobil; ?>">
            <input type="hidden" name="tgl_kembali" value="<?php echo $t->tgl_kembali; ?>">
            <input type="hidden" name="denda" value="<?php echo $t->denda; ?>">
            <input type="hidden" name="total_bayar" value="<?php echo $t->total_bayar; ?>">
            <div class="form-group">
                <label>Customer</label>
                <select name="customer" class="form-control" disabled>
                    <option value="">-Pilih Customer-</option>
                    <?php foreach($customer as $c){ ?>
                    <option <?php if($t->id_customer == $c->customer_id){echo "selected='selected'";} ?> value="<?php echo $c->customer_id; ?>"><?php echo $c->nama; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Mobil</label>
                <select name="mobil" class="form-control" disabled>
                    <option value="">-Pilih Mobil-</option>
                    <?php foreach($mobil as $m){ ?>
                    <option <?php if($t->id_mobil == $m->mobil_id){echo "selected='selected'";} ?> value="<?php echo $m->mobil_id; ?>"><?php echo $m->merk; ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label>Tanggal Pinjam</label>
                <input type="text" name="tgl_pinjam" class="form-control" value="<?php echo date("m/d/Y H:i:s",strtotime($t->tgl_pinjam)); ?>" disabled>
            </div>
            <div class="form-group">
                <label>Tanggal Harus Kembali</label>
                <input type="text" name="tgl_kembali" class="form-control" value="<?php echo date("m/d/Y H:i:s",strtotime($t->tgl_kembali)); ?>" disabled>
            </div>
            <div class="form-group">
                <label>Harga</label>
                <input type="number" name="harga" class="form-control" value="<?php echo $t->harga; ?>" disabled>
            </div>
            <div class="form-group">
                <label>Harga Denda / Hari</label>
                <input type="text" name="denda" class="form-control" value="<?php echo $t->denda; ?>" disabled>
            </div>
            <div class="form-group">
                <label>Total Bayar</label>
                <input type="text" name="total_bayar" class="form-control" value="<?php echo $t->total_bayar; ?>" disabled>
            </div>
            <div class="form-group">
                <label>Tanggal Dikembalikan Oleh Customer</label>
                <input type="text" name="tgl_dikembalikan" class="form-control" id="datepicker3" style="<?php if(form_error('tgl_dikembalikan') != ''){echo'border:2px solid red'; }elseif(isset($_GET["pesan"])){if($_GET["pesan"] == 'gagal'){echo'border:2px solid red'; }} ?>">
                <?php echo form_error("tgl_dikembalikan"); ?>
            </div>
            <div class="form-group">
                <input type="submit" value="Selesaikan Transaksi" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<?php } ?>
</div></div>