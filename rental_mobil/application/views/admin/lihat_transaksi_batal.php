<div class="page-header">
    <h3>Transaksi Dibatalkan</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li class="active">
        Transaksi Dibatalkan
    </li>
</ol>
<div class="panel panel-red">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-trash-alt"></i>
            Transaksi Dibatalkan
        </h3>
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover" id="table-datatable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal Transaksi</th>
                        <th>Customer</th>
                        <th>Mobil</th>
                        <th>Tgl.Pinjam</th>
                        <th>Tgl.Kembali</th>
                        <th>Harga</th>
                        <th>Denda / Hari</th>
                        <th>Tanggal Dibatalkan</th>
                        <th>Alasan Dibatalkan</th>
                        <th>Tombol Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach($transaksi_batal as $t){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo date("d/m/Y",strtotime($t->tgl_transaksi)); ?></td>
                        <td><?php echo $t->nama; ?></td>
                        <td><?php echo $t->merk; ?></td>
                        <td><?php echo date("d/m/Y",strtotime($t->tgl_pinjam)); ?></td>
                        <td><?php echo date("d/m/Y",strtotime($t->tgl_kembali)); ?></td>
                        <td><?php echo "Rp. ".number_format($t->harga); ?></td>
                        <td><?php echo "Rp. ".number_format($t->denda); ?></td>
                        <td><?php echo date("d/m/Y",strtotime($t->tgl_batal)); ?></td>
                        <td>
                            <?php
                                $length = strlen($t->alasan);
                                if($length > 50){
                                    $t->alasan = substr($t->alasan,0,50)."...";

                                    echo $t->alasan;
                                }
                                else{
                                    echo $t->alasan;
                                }
                            ?>
                        </td>
                        <td>
                            <a href="<?php echo base_url().'admin/lihat_batal/'.$t->batal_id; ?>" class="btn btn-sm btn-primary">Lihat Transaksi</a>
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