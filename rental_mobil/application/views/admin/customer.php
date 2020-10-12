<div class="page-header">
    <h3>Lihat Data Customer</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li class="active">
        Lihat Data Customer
    </li>
</ol>
<?php
    if(isset($_GET["pesan"])){
        if($_GET["pesan"] == "berhasil"){
            echo "<div class='alert alert-success'>Customer Baru dengan nama <b>$_GET[nama]</b> berhasil di Tambah.</div>";
        }
        elseif($_GET["pesan"] == "berhasil_pass"){
            echo "<div class='alert alert-success'>Password Customer dengan nama <b>$_GET[nama]</b> berhasil di Ganti.</div>";
        }
    }
    if(isset($_GET["edit"])){
        if($_GET["edit"] == "berhasil"){
            echo "<div class='alert alert-success'>Customer dengan nama <b>$_GET[nama]</b> berhasil di Edit.</div>";
        }
    }
    if(isset($_GET["hapus"])){
        if($_GET["hapus"] == "berhasil"){
            echo "<div class='alert alert-danger'>Customer berhasil di Hapus.</div>";
        }
    }
    if(isset($_GET["edit_gambar"])){
        if($_GET["edit_gambar"] == "berhasil"){
            echo "<div class='alert alert-success'>Gambar Customer dengan nama <b>$_GET[nama]</b> berhasil di Edit.</div>";
        }
    }
?>
<div class="panel panel-green">
    <div class="panel-heading">
        <h3 class="panel-title">
            <span class="glyphicon glyphicon-user"></span>
            Lihat Data Customer
        </h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="table-datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>HP</th>
                        <th>No. KTP</th>
                        <th>Tombol Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach($customer as $c){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $c->nama; ?></td>
                        <td><?php if($c->jk == "L"){echo"Laki-laki"; }elseif($c->jk == "P"){echo"Perempuan"; } ?></td>
                        <td><?php echo $c->alamat; ?></td>
                        <td><?php echo $c->hp; ?></td>
                        <td><?php echo $c->ktp; ?></td>
                        <td>
                            <a href="<?php echo base_url().'admin/customer_edit/'.$c->customer_id; ?>" class="btn btn-sm btn-success">
                                <span class="glyphicon glyphicon-wrench"></span>
                                Edit
                            </a>
                            <a href="<?php echo base_url().'admin/customer_edit_gambar/'.$c->customer_id; ?>" class="btn btn-sm btn-warning">
                                <span class="glyphicon glyphicon-plus"></span>
                                Edit Gambar Customer
                            </a>
                            <a href="<?php echo base_url().'admin/customer_hapus/'.$c->customer_id; ?>" class="btn btn-sm btn-danger" onclick="return confirm(&quot;Hapus Customer?&quot;)">
                                <span class="glyphicon glyphicon-trash"></span>
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
</div>