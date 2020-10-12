<div class="page-header">
    <h3>Lihat Data Transaksi</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li class="active">
        Lihat Data Transaksi
    </li>
</ol>
<?php
    if(isset($_GET["pesan"])){
        if($_GET["pesan"] == "berhasil"){
            echo "<div class='alert alert-success'>Transaksi berhasil di Lakukan dengan Customer <b>$_GET[nama]</b>.</div>";
        }
        elseif($_GET["pesan"] == "transaksi_berhasil"){
            echo "<div class='alert alert-success'>Transaksi Selesai di Lakukan dengan Customer <b>$_GET[nama]</b>.</div>";
        }
        elseif($_GET["pesan"] == "batal_berhasil"){
            echo "<div class='alert alert-danger'>Transaksi berhasil di Batalkan.</div>";
        }
    }
?>
<div class="panel panel-red">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-file-invoice"></i>
            Lihat Data Transaksi
        </h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="table-datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Mobil</th>
                        <th>Tgl.Pinjam</th>
                        <th>Tgl.Kembali</th>
                        <th>Harga</th>
                        <th>Denda / Hari</th>
                        <th>Tgl.Dikembalikan</th>
                        <th>Total Denda</th>
                        <th>Status</th>
                        <th>Tombol Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach($transaksi as $t){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo date("d/m/Y",strtotime($t->tgl)); ?></td>
                        <td><?php echo $t->nama; ?></td>
                        <td><?php echo $t->merk; ?></td>
                        <td><?php echo date("d/m/Y",strtotime($t->tgl_pinjam)); ?></td>
                        <td><?php echo date("d/m/Y",strtotime($t->tgl_kembali)); ?></td>
                        <td><?php echo "Rp. ".number_format($t->harga); ?></td>
                        <td><?php echo "Rp. ".number_format($t->denda); ?></td>
                        <td>
                            <?php
                                if($t->tgl_dikembalikan == "0000-00-00 00:00:00"){
                                    echo "-";
                                }
                                else{
                                    echo date("d/m/Y",strtotime($t->tgl_dikembalikan));
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                echo "Rp. ".number_format($t->total_denda)." ,-";
                            ?>
                        </td>
                        <td>
                            <?php
                                if($t->transaksi_status == "1"){
                                    echo "Selesai";
                                }
                                else{
                                    echo "-";
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if($t->transaksi_status == "1"){
                            ?>
                            <a href="<?php echo base_url().'admin/lihat_transaksi/'.$t->transaksi_id; ?>" class="btn btn-primary btn-sm">Lihat Transaksi</a>
                            <?php
                                }
                                else{
                            ?>
                            <a href="<?php echo base_url().'admin/transaksi_selesai/'.$t->transaksi_id; ?>" class="btn btn-sm btn-success">
                                <span class="glyphicon glyphicon-remove"></span>
                                Transaksi Selesai
                            </a>
                            <a href="<?php echo base_url().'admin/transaksi_batal/'.$t->transaksi_id; ?>" class="btn btn-sm btn-danger">
                                <span class="glyphicon glyphicon-remove"></span>
                                Batalkan Transaksi
                            </a>
                            <?php
                                }
                            ?>
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