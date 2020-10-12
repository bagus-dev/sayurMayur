<div class="page-header">
    <h3>Tambah Gambar Mobil</h3>
</div>
<ol class="breadcrumb">
    <li class="active">
        <a href="<?php echo base_url().'admin/mobil'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li class="active">
        Tambah Gambar Mobil
    </li>
</ol>
<div class="progress">
  <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">50%</div>
</div>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-car"></i>
            Tambah Gambar Mobil
        </h3>
    </div>
    <div class="panel-body">
        <h3 class="title-text">Gambar <?php echo $mobil["merk"]; ?> Sekarang:</h3>
        <?php
            $gambar_mobil = "unknown.png";
        ?>
        <img src="<?php echo base_url().'assets/images/mobil/'.$gambar_mobil; ?>" alt="<?php echo $mobil["merk"]; ?>" class="gambar_mobil mt-3 img-responsive w-75">
        <br><br><br>
        <?php
            if($error != ""){
                echo "<div class='alert alert-danger'>$error</div>";
            }
        ?>
        <form action="<?php echo base_url().'admin/tambah_gambar_mobil'; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label><strong>Pilih Gambar Baru</strong></label>
                <input type="file" name="gambar_mobil" class="form-control" accept="image/*" required>
                <input type="hidden" name="merk" value="<?php echo $mobil["merk"]; ?>">
                <small class="form-text text-muted"><i class="fas fa-exclamation-triangle"></i> Gambar tidak boleh lebih besar dari 1266x1280 pixel, juga tidak boleh lebih kecil dari 500x500 pixel. Format yang didukung: JPG,PNG,GIF,JPEG. File tidak lebih dari 500KB.</small>
            </div>
            <div class="form-group">
                <input type="submit" value="Upload" class="btn btn-md btn-primary">&nbsp;
                <a href="<?php echo base_url().'admin/mobil?pesan=berhasil&nama='.$mobil["merk"]; ?>" class="btn btn-md btn-warning">Lewati</a>
            </div>
        </form>
    </div>
</div>
</div>
</div>