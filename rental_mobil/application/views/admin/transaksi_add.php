<div class="page-header">
    <h3>Transaksi Baru</h3>
</div>
<ol class="breadcrumb">
    <li class="active">
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li class="active">
        Lakukan Transaksi
    </li>
</ol>
<?php
    if(isset($_GET["pesan"])){
        if($_GET["pesan"] == "gagal"){
            echo "<div class='alert alert-danger'>Tanggal Pinjam dengan Tanggal Kembali tidak sesuai.</div>";
        }
        elseif($_GET["pesan"] == "gagal2"){
            echo "<div class='alert alert-danger'>Tanggal Pinjam lebih kecil dari Tanggal Hari Ini.</div>";
        }
        elseif($_GET["pesan"] == "gagal3"){
            echo "<div class='alert alert-danger'>Jam Peminjaman tidak sesuai waktu Toko Buka.</div>";
        }
    }
?>
<div class="panel panel-red">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-file-invoice"></i>
            Lakukan Transaksi
        </h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url().'admin/transaksi_add_act'; ?>" method="post">
            <div class="form-group">
                <label>Customer</label>
                <select name="customer" class="form-control" style="<?php if(form_error('customer') != ''){echo'border:2px solid red'; } ?>">
                    <option value="">-Pilih Customer-</option>
                    <?php foreach($customer as $c){ ?>
                    <option <?php if($transaksi["customer"] == $c->customer_id){echo"selected='selected'"; } ?> value="<?php echo $c->customer_id; ?>"><?php echo $c->nama; ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error("customer"); ?>
            </div>
            <div class="form-group">
                <label>Mobil</label>
                <select name="mobil" class="form-control" style="<?php if(form_error('mobil') != ''){echo'border:2px solid red'; } ?>">
                    <option value="">-Pilih Mobil-</option>
                    <?php foreach($mobil as $m){ ?>
                    <option <?php if($transaksi["mobil"] == $m->mobil_id){echo"selected='selected'"; } ?> value="<?php echo $m->mobil_id; ?>"><?php echo $m->merk; ?></option>
                    <?php } ?>
                </select>
                <?php echo form_error("mobil"); ?>
            </div>
            <div class="form-group">
                <label>Tanggal Pinjam</label>
                <input type="text" name="tgl_pinjam" class="form-control" id="datepicker" value="<?php if($transaksi["tgl_pinjam"] != ''){ echo $transaksi["tgl_pinjam"]; } ?>" style="<?php if(form_error('tgl_pinjam') != ''){echo'border:2px solid red'; } ?>">
                <?php echo form_error("tgl_pinjam"); ?>
            </div>
            <div class="form-group">
                <label>Jam Mulai Meminjam</label>
                <input type="text" name="jam_pinjam" class="form-control" id="datetimepicker1" value="<?php if($transaksi["jam_pinjam"] != ''){ echo $transaksi["jam_pinjam"]; } ?>" style="<?php if(form_error('jam_pinjam') != ''){echo'border:2px solid red'; } ?>">
                <?php echo form_error("jam_pinjam"); ?>
            </div>
            <div class="form-group">
                <label>Tanggal Kembali</label>
                <input type="text" name="tgl_kembali" id="datepicker2" class="form-control" value="<?php if($transaksi["tgl_kembali"] != ''){ echo $transaksi["tgl_kembali"]; } ?>" style="<?php if(form_error('tgl_kembali') != ''){echo'border:2px solid red'; } ?>">
                <?php echo form_error("tgl_kembali"); ?>
            </div>
            <div class="form-group">
                <input type="submit" value="Simpan Transaksi" class="btn btn-primary btn-sm">
            </div>
        </form>
    </div>
</div>
</div>
</div>