<div class="page-header">
    <h3>Edit Profil</h3>
</div>
<?php foreach($admin as $a){ ?>
<form action="<?php echo base_url().'admin/edit_profil'; ?>" method="post">
    <div class="form-group">
        <label>Nama</label>
        <input type="hidden" name="id" value="<?php echo $a->admin_id; ?>">
        <input type="text" name="nama" class="form-control" value="<?php echo $a->nama; ?>">
        <?php echo form_error("nama"); ?>
    </div>
    <div class="form-group">
        <label>Username</label>
        <input type="text" name="username" class="form-control" value="<?php echo $a->username; ?>">
        <?php echo form_error("username"); ?>
    </div>
    <div class="form-group">
        <input type="submit" value="Simpan" class="btn btn-primary">
    </div>
</form>
<?php } ?>