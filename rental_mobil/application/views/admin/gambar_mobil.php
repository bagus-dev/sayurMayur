<div class="page-header">
    <h3>Edit Gambar Mobil</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li>
        <a href="<?php echo base_url().'admin/mobil'; ?>"> Lihat Data Mobil </a>
    </li>
    <li class="active">
        Edit Gambar Mobil
    </li>
</ol>
<?php foreach($mobil as $m){ ?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-car"></i>
            Gambar Mobil
        </h3>
    </div>
    <div class="panel-body">
        <h3 class="title-text">Gambar <?php echo $m->merk; ?> Sekarang:</h3>
        <?php
            $valid_ext = array("jpg","jpeg","png","gif");
            $ext = strtolower($m->gambar_mobil);
            $ext_explode = explode(".",$ext);
            $ext_end = end($ext_explode);

            if(in_array($ext_end, $valid_ext)){
                $m->gambar_mobil;
            }
            else{
                $m->gambar_mobil = "unknown.png";
            }
        ?>
        <img src="<?php echo base_url().'assets/images/mobil/'.$m->gambar_mobil; ?>" alt="<?php echo $m->merk; ?>" class="gambar_mobil mt-3 img-responsive w-75">
        <br><br><br>
        <?php
            if($error != ""){
                echo "<div class='alert alert-danger'>$error</div>";
            }
        ?>
        <form action="<?php echo base_url().'admin/gambar_mobil_edit'; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label><strong>Pilih Gambar Baru</strong></label>
                <input type="file" name="gambar_mobil" class="form-control" accept="image/*" required>
                <input type="hidden" name="mobil_id" value="<?php echo $m->mobil_id; ?>">
                <input type="hidden" name="merk" value="<?php echo $m->merk; ?>">
                <small class="form-text text-muted"><i class="fas fa-exclamation-triangle"></i> Gambar tidak boleh lebih besar dari 1266x1280 pixel, juga tidak boleh lebih kecil dari 500x500 pixel. Format yang didukung: JPG,PNG,GIF,JPEG. File tidak lebih dari 500KB.</small>
            </div>
            <div class="form-group">
                <input type="submit" value="Upload" class="btn btn-md btn-primary">&nbsp;
                <a href="<?php echo base_url().'admin/mobil'; ?>" class="btn btn-md btn-warning">Batal</a>
            </div>
        </form>
    </div>
</div>
<?php } ?>
</div>
</div>