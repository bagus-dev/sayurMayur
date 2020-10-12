<div class="page-header">
    <h3>Lihat Data Mobil</h3>
</div>
<ol class="breadcrumb">
    <li class="active">
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li class="active">
        Lihat Data Mobil
    </li>
</ol>
<?php
    if(isset($_GET["pesan"])){
        if($_GET["pesan"] == "berhasil"){
            echo "<div class='alert alert-success'>Mobil Baru dengan nama <b>$_GET[nama]</b> berhasil di Tambah.</div>";
        }
    }
    if(isset($_GET["edit"])){
        if($_GET["edit"] == "berhasil"){
            echo "<div class='alert alert-success'>Mobil dengan nama <b>$_GET[nama]</b> berhasil di Edit.</div>";
        }
    }
    if(isset($_GET["hapus"])){
        if($_GET["hapus"] == "berhasil"){
            echo "<div class='alert alert-danger'>Mobil berhasil di Hapus.</div>";
        }
    }
    if(isset($_GET["edit_gambar"])){
        if($_GET["edit_gambar"] == "berhasil"){
            echo "<div class='alert alert-success'>Gambar Mobil dengan nama <b>$_GET[nama]</b> berhasil di Edit.</div>";
        }
    }
?>
<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title">
            <span class="glyphicon glyphicon-folder-open"></span>
            Data Mobil
        </h3>
    </div>
    <div class="panel-body">
    <div class="table-responsive">
        <table id="table-datatable" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Merk Mobil</th>
                    <th>Plat</th>
                    <th>Warna</th>
                    <th>Tahun Pembuatan</th>
                    <th>Status</th>
                    <th>Tombol Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $no = 1;
                    foreach($mobil as $m){
                ?>
                <tr>
                    <td><?php echo $no++; ?></td>
                    <td><?php echo $m->merk; ?></td>
                    <td><?php echo $m->plat; ?></td>
                    <td><?php echo $m->warna; ?></td>
                    <td><?php echo $m->tahun; ?></td>
                    <td>
                        <?php
                            if($m->status == "1"){
                                echo "Tersedia";
                            }
                            elseif($m->status == "2"){
                                echo "Sedang di Rental";
                            }
                        ?>
                    </td>
                    <td><a href="<?php echo base_url().'admin/mobil_edit/'.$m->mobil_id; ?>" class="btn btn-primary btn-sm">
                            <span class="glyphicon glyphicon-plus"></span>
                            Edit
                        </a>
                        <a href="<?php echo base_url().'admin/gambar_mobil/'.$m->mobil_id; ?>" class="btn btn-warning btn-sm">
                            <span class="glyphicon glyphicon-wrench"></span>
                            Edit Gambar Mobil
                        </a>
                        <a href="<?php echo base_url().'admin/mobil_hapus/'.$m->mobil_id; ?>" class="btn btn-danger btn-sm" onclick="return confirm(&quot;Hapus Mobil?&quot;)">
                            <span class="glyphicon glyphicon-trash"></span>
                            Hapus
                        </a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
            <tfoot>
                <tr>
                    <th>No</th>
                    <th>Merk Mobil</th>
                    <th>Plat</th>
                    <th>Warna</th>
                    <th>Tahun Pembuatan</th>
                    <th>Status</th>
                    <th>Tombol Aksi</th>
                </tr>
            </tfoot>
        </table>
    </div>
    </div>
    </div>
</div>
</div>