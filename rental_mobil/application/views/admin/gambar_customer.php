<div class="page-header">
    <h3>Edit Gambar Customer</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li>
        <a href="<?php echo base_url().'admin/customer'; ?>"> Lihat Data Customer </a>
    </li>
    <li class="active">
        Edit Gambar Customer
    </li>
</ol>
<?php foreach($customer as $c){ ?>
<div class="panel panel-green">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-car"></i>
            Gambar Customer
        </h3>
    </div>
    <div class="panel-body">
        <h3 class="title-text">Gambar <?php echo $c->nama; ?> Sekarang:</h3>
        <?php
            $valid_ext = array("jpg","jpeg","png","gif");
            $ext = strtolower($c->gambar_customer);
            $ext_explode = explode(".",$ext);
            $ext_end = end($ext_explode);

            if(in_array($ext_end, $valid_ext)){
                $c->gambar_customer;
            }
            elseif(!in_array($ext_end, $valid_ext) AND $c->jk == "L"){
                $c->gambar_customer = "unknown.jpg";
            }
            elseif(!in_array($ext_end, $valid_ext) AND $c->jk == "P"){
                $c->gambar_customer = "unknown_p.png";
            }
        ?>
        <img src="<?php echo base_url().'assets/images/customer/'.$c->gambar_customer; ?>" alt="<?php echo $c->nama; ?>" class="gambar_mobil mt-3 img-responsive w-50">
        <br><br><br>
        <?php
            if($error != ""){
                echo "<div class='alert alert-danger'>$error</div>";
            }
        ?>
        <form action="<?php echo base_url().'admin/gambar_customer_edit'; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label><strong>Pilih Gambar Baru</strong></label>
                <input type="file" name="gambar_customer" class="form-control" accept="image/*" required>
                <input type="hidden" name="customer_id" value="<?php echo $c->customer_id; ?>">
                <input type="hidden" name="nama" value="<?php echo $c->nama; ?>">
                <small class="form-text text-muted"><i class="fas fa-exclamation-triangle"></i> Gambar tidak boleh lebih besar dari 1266x1280 pixel, juga tidak boleh lebih kecil dari 500x500 pixel. Format yang didukung: JPG,PNG,GIF,JPEG. File tidak lebih dari 500KB.</small>
            </div>
            <div class="form-group">
                <input type="submit" value="Upload" class="btn btn-md btn-primary">&nbsp;
                <a href="<?php echo base_url().'admin/customer'; ?>" class="btn btn-md btn-warning">Batal</a>
            </div>
        </form>
    </div>
</div>
<?php } ?>
</div>
</div>