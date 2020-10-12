<div class="page-header">
    <h3>Tambah Mobil Baru</h3>
</div>
<ol class="breadcrumb">
    <li class="active">
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li class="active">
        Tambah Mobil Baru
    </li>
</ol>
<?php
    if(isset($_GET["pesan"])){
        if($_GET["pesan"] == "gagal"){
            echo "<div class='alert alert-danger'>Merk Mobil sudah ada.</div><br>";
        }
        elseif($_GET["pesan"] == "plat_gagal"){
            echo "<div class='alert alert-danger'>Plat Kendaraan sudah ada.</div><br>";
        }
    }
?>
<div class="progress">
  <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="color:#000">0%</div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <span class="glyphicon glyphicon-plus"></span>
            Tambah Data Mobil
        </h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url().'admin/mobil_add_act'; ?>" method="post">
            <div class="form-group">
                <label>Merk Mobil</label>
                <input type="text" name="merk" class="form-control" value="<?php if($mobil["merk"] != ''){echo $mobil["merk"]; } ?>" style="<?php if(isset($_GET['pesan'])){if($_GET['pesan'] == 'gagal'){echo 'border:2px solid red;'; }}if(form_error('merk') != ''){echo'border:2px solid red;'; } ?>">
                <?php echo form_error("merk"); ?>
            </div>
            <div class="form-group">
                <label>No. Plat Kendaraan</label>
                <input type="text" name="plat" class="form-control" value="<?php if($mobil["plat"] != ''){echo $mobil["plat"]; } ?>" style="<?php if(isset($_GET['pesan'])){if($_GET['pesan'] == 'plat_gagal'){echo 'border:2px solid red;'; }}if(form_error('plat') != ''){echo'border:2px solid red;'; } ?>">
                <?php echo form_error("plat"); ?>
            </div>
            <div class="form-group">
                <label>Warna</label>
                <input type="text" name="warna" class="form-control" value="<?php if($mobil["warna"] != ''){echo $mobil["warna"]; } ?>" style="<?php if(form_error('warna') != ''){echo'border:2px solid red;'; } ?>">
                <?php echo form_error("warna"); ?>
            </div>
            <div class="form-group">
                <label>Tahun Kendaraan</label>
                <input type="text" name="tahun" class="form-control" value="<?php if($mobil["tahun"] != ''){echo $mobil["tahun"]; } ?>" style="<?php if(form_error('tahun') != ''){echo'border:2px solid red;'; } ?>">
                <?php echo form_error("tahun"); ?>
            </div>
            <div class="form-group">
            <label>Status Mobil</label>
            <select name="status" class="form-control">
                <option value="1">Tersedia</option>
                <option value="2">Sedang di Rental</option>
            </select>
            <?php echo form_error("status"); ?>
            </div>
            <div class="form-group">
                <input type="submit" value="Simpan" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
</div>
</div>