<div class="page-header">
    <h3>Edit Customer</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li>
        <a href="<?php echo base_url().'admin/customer'; ?>">Lihat Data Customer</a>
    </li>
    <li class="active">
        Edit Customer
    </li>
</ol>
<?php foreach($customer as $c){ ?>
<div class="panel panel-green">
    <div class="panel-heading">
        <h3 class="panel-title">
            <span class="glyphicon glyphicon-user"></span>
            Edit Customer
        </h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url().'admin/customer_update'; ?>" method="post">
            <ul class="nav nav-tabs">
                <li class="nav-item active">
                    <a href="#" class="nav-link">Edit Data</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url().'admin/ganti_password_customer/'.$c->customer_id; ?>">Ganti Password</a>
                </li>
            </ul>
            <br>
            <div class="form-group">
                <label>Nama Customer</label>
                <input type="text" name="nama" class="form-control" value="<?php echo $c->nama; ?>" style="<?php if(form_error('nama') != ''){echo'border:2px solid red'; } ?>">
                <input type="hidden" name="id" value="<?php echo $c->customer_id; ?>">
                <?php echo form_error("nama"); ?>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" style="<?php if(form_error('alamat') != ''){echo'border:2px solid red'; } ?>"><?php echo $c->alamat; ?></textarea>
                <?php echo form_error("alamat"); ?>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jk" class="form-control">
                    <option <?php if($c->jk == "L"){echo "selected='selected'";} ?> value="L">Laki-laki</option>
                    <option <?php if($c->jk == "P"){echo "selected='selected'";} ?> value="P">Perempuan</option>
                </select>
                <?php echo form_error("jk"); ?>
            </div>
            <div class="form-group">
                <label>HP</label>
                <input type="number" name="hp" class="form-control" value="<?php echo $c->hp; ?>" style="<?php if(form_error('hp') != ''){echo'border:2px solid red'; } ?>">
                <?php echo form_error("hp"); ?>
            </div>
            <div class="form-group">
                <label>No.KTP</label>
                <input type="number" name="ktp" class="form-control" value="<?php echo $c->ktp; ?>" style="<?php if(form_error('ktp') != ''){echo'border:2px solid red'; } ?>">
                <?php echo form_error("ktp"); ?>
            </div>
            <div class="form-group">
                <input type="submit" value="Simpan" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<?php } ?>
</div></div>