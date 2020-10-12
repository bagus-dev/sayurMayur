<div class="page-header">
    <h3>Lihat Transaksi Dibatalkan</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li>
        <a href="<?php echo base_url().'admin/lihat_transaksi_batal'; ?>"> Transaksi Dibatalkan</a>
    </li>
    <li class="active">
        Lihat Transaksi Dibatalkan
    </li>
</ol>
<?php foreach($transaksi as $t){ ?>
<div class="panel panel-red">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-file-invoice"></i>
            Transaksi Dibatalkan
        </h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url().'admin/transaksi_selesai_act'; ?>" method="post">
            <input type="hidden" name="id" value="<?php echo $t->transaksi_id; ?>">
            <div class="form-group">
                <label>Karyawan yang Membatalkan Transaksi:</label>
                <input type="text" name="karyawan" class="form-control" value="<?php echo $t->nama_awal.' '.$t->nama_akhir; ?>" disabled>
            </div>
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
                <input type="date" name="tgl_pinjam" class="form-control" value="<?php echo $t->tgl_pinjam; ?>" disabled>
            </div>
            <div class="form-group">
                <label>Tanggal Harus Kembali</label>
                <input type="date" name="tgl_kembali" class="form-control" value="<?php echo $t->tgl_kembali; ?>" disabled>
            </div>
            <div class="form-group">
                <label>Tanggal Dibatalkan</label>
                <input type="text" name="tgl_batal" class="form-control" value="<?php echo date("m/d/Y",strtotime($t->tgl_batal)); ?>" disabled>
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
                <label>Alasan Dibatalkan</label>
                <textarea name="alasan" class="form-control" disabled><?php echo $t->alasan; ?></textarea>
            </div>
        </form>
    </div>
</div>
<?php } ?>
</div></div>