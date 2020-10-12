<div class="page-header">
    <h3>Edit Mobil</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li>
        <a href="<?php echo base_url().'admin/mobil'; ?>">Lihat Data Mobil</a>
    </li>
    <li class="active">
        Edit Mobil
    </li>
</ol>
<?php foreach($mobil as $m){ ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <span class="glyphicon glyphicon-plus"></span>
            Edit Data Mobil
        </h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url().'admin/mobil_update'; ?>" method="post">
            <div class="form-group">
                <label>Merk Mobil</label>
                <input type="hidden" name="id" value = "<?php echo $m->mobil_id; ?>">
                <input type="text" name="merk" class="form-control" value = "<?php echo $m->merk; ?>" style="<?php if(form_error('merk') != ''){echo'border:2px solid red'; } ?>">
                <?php echo form_error("merk"); ?>
            </div>
            <div class="form-group">
                <label>No.Plat Kendaraan</label>
                <input type="text" name="plat" class="form-control" value = "<?php echo $m->plat; ?>" style="<?php if(form_error('plat') != ''){echo'border:2px solid red'; } ?>">
                <?php echo form_error("plat"); ?>
            </div>
            <div class="form-group">
                <label>Warna</label>
                <input type="text" name="warna" class="form-control" value = "<?php echo $m->warna; ?>" style="<?php if(form_error('warna') != ''){echo'border:2px solid red'; } ?>">
                <?php echo form_error("warna"); ?>
            </div>
            <div class="form-group">
                <label>Tahun Kendaraan</label>
                <input type="text" name="tahun" class="form-control" value = "<?php echo $m->tahun; ?>" style="<?php if(form_error('tahun') != ''){echo'border:2px solid red'; } ?>">
                <?php echo form_error("tahun"); ?>
            </div>
            <div class="form-group">
                <label>Status Mobil</label>
                <select name="status" class="form-control">
                    <option <?php if($m->status == "1"){echo "selected='selected'";} echo $m->tahun; ?> value="1">Tersedia</option>
                    <option <?php if($m->status == "2"){echo "selected='selected'";} echo $m->tahun; ?> value="2">Sedang di Rental</option>
                </select>
                <?php echo form_error("status"); ?>
            </div>
            <div class="form-group">
                <input type="submit" value="Simpan" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<?php } ?>
</div>
</div>