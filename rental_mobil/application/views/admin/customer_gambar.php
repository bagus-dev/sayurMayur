<div class="page-header">
    <h3>Tambah Gambar Customer</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin/mobil'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li class="active">
        Tambah Gambar Customer
    </li>
</ol>
<div class="progress">
  <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">50%</div>
</div>
<div class="panel panel-green">
    <div class="panel-heading">
        <h3 class="panel-title">
            <span class="glyphicon glyphicon-user"></span>
            Tambah Gambar Customer
        </h3>
    </div>
    <div class="panel-body">
        <h3 class="title-text">Gambar <?php echo $customer["nama"]; ?> Sekarang:</h3>
        <?php
            if($customer["jk"] == "L"){
                $gambar_customer = "unknown.jpg";
            }
            elseif($customer["jk"] == "P"){
                $gambar_customer = "unknown_p.png";
            }
        ?>
        <img src="<?php echo base_url().'assets/images/customer/'.$gambar_customer; ?>" alt="<?php echo $customer["nama"]; ?>" class="gambar_mobil mt-3 img-responsive w-50">
        <br><br><br>
        <?php
            if($error != ""){
                echo "<div class='alert alert-danger'>$error</div>";
            }
        ?>
        <form action="<?php echo base_url().'admin/tambah_gambar_customer'; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label><strong>Pilih Gambar Baru</strong></label>
                <input type="file" name="gambar_customer" class="form-control" accept="image/*" required>
                <input type="hidden" name="nama" value="<?php echo $customer["nama"]; ?>">
                <input type="hidden" name="jk" value="<?php echo $customer["jk"]; ?>">
                <input type="hidden" name="hp" value="<?php echo $customer["hp"]; ?>">
                <small class="form-text text-muted"><i class="fas fa-exclamation-triangle"></i> Gambar tidak boleh lebih besar dari 1266x1280 pixel, juga tidak boleh lebih kecil dari 500x500 pixel. Format yang didukung: JPG,PNG,GIF,JPEG. File tidak lebih dari 500KB.</small>
            </div>
            <div class="form-group">
                <input type="submit" value="Upload" class="btn btn-md btn-primary">&nbsp;
                <a href="<?php echo base_url().'admin/customer?pesan=berhasil&nama='.$customer["nama"]; ?>" class="btn btn-md btn-warning">Lewati</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>