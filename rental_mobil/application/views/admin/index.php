<div class="row">
    <div class="page-header">
        <h3>Dasbor</h3>
    </div>
</div>
<ol class="breadcrumb">
    <li class="active">
        <i class="fas fa-tachometer-alt"></i> Dasbor
    </li>
    <div class="pull-right bg-green jam" style="color:#fff">

    </div>
    <div class="pull-right bg-green" style="color:#fff">
        /
    </div>
    <div class="pull-right bg-green" id="tanggal" style="color:#fff">
        
    </div>
</ol>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6">
        <br>
        <div class="info-title">
            <div class="info-inner">
                <div class="panel panel-primary">
                    <div class="panel-heading text-center">
                        <a href="<?php echo base_url().'admin/mobil'; ?>">
                            <div class="info-type bg-primary">
                                <i class="fas fa-car fa-3x"></i>
                            </div>
                        </a>
                        <div class="row">
                            <div class="mt-3">
                                <font color="white">MOBIL</font>
                                <div class="huge">
                                    <strong><?php echo $this->m_rental->get_data("mobil")->num_rows(); ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url().'admin/mobil'; ?>">
                        <div class="panel-footer">
                            <span class="pull-left">
                                Info Selebihnya
                            </span>
                            <span class="pull-right">
                                <i class="glyphicon glyphicon-arrow-right"></i>
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
        <br>
        <div class="info-title">
            <div class="info-inner">
                <div class="panel panel-green">
                    <div class="panel-heading text-center">
                        <a href="<?php echo base_url().'admin/customer'; ?>">
                            <div class="info-type-user bg-user">
                                <i class="fas fa-user fa-3x" style="color:#ffffff;"></i>
                            </div>
                        </a>
                        <div class="row">
                            <div class="mt-3">
                                <font color="white">CUSTOMERS</font>
                                <div class="huge">
                                    <strong><?php echo $this->m_rental->get_data("customer")->num_rows(); ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url().'admin/customer'; ?>">
                        <div class="panel-footer">
                            <span class="pull-left">
                                Info Selebihnya
                            </span>
                            <span class="pull-right">
                                <i class="glyphicon glyphicon-arrow-right"></i>
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
        <br>
        <div class="info-title">
            <div class="info-inner">
                <div class="panel panel-orange">
                    <div class="panel-heading text-center">
                        <a href="<?php echo base_url().'admin/transaksi'; ?>">
                            <div class="info-type-invoice bg-invoice">
                                <i class="fas fa-file-invoice fa-3x" style="color:#ffffff;"></i>
                            </div>
                        </a>
                        <div class="row">
                            <div class="mt-3">
                                <font color="white">TRANSAKSI</font>
                                <div class="huge">
                                    <strong><?php echo $this->m_rental->get_data("transaksi")->num_rows(); ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url().'admin/transaksi'; ?>">
                        <div class="panel-footer">
                            <span class="pull-left">
                                Info Selebihnya
                            </span>
                            <span class="pull-right">
                                <i class="glyphicon glyphicon-arrow-right"></i>
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
        <br>
        <div class="info-title">
            <div class="info-inner">
                <div class="panel panel-red">
                    <div class="panel-heading text-center">
                        <a href="<?php echo base_url().'admin/transaksi'; ?>">
                            <div class="info-type-check bg-check">
                                <i class="fas fa-check fa-3x" style="color:#ffffff;"></i>
                            </div>
                        </a>
                        <div class="row">
                            <div class="mt-3">
                                <font color="white">RENTAL SELESAI</font>
                                <div class="huge">
                                    <strong><?php echo $this->m_rental->edit_data(array("transaksi_status"=>1),"transaksi")->num_rows(); ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url().'admin/transaksi'; ?>">
                        <div class="panel-footer">
                            <span class="pull-left">
                                Info Selebihnya
                            </span>
                            <span class="pull-right">
                                <i class="glyphicon glyphicon-arrow-right"></i>
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6">
        <br>
        <div class="info-title">
            <div class="info-inner">
                <div class="panel panel-red">
                    <div class="panel-heading text-center">
                        <a href="<?php echo base_url().'admin/lihat_transaksi_batal'; ?>">
                            <div class="info-type-check bg-check">
                                <i class="fas fa-trash-alt fa-3x" style="color:#ffffff;"></i>
                            </div>
                        </a>
                        <div class="row">
                            <div class="mt-3">
                                <font color="white">TRANSAKSI DIBATALKAN</font>
                                <div class="huge">
                                    <strong><?php echo $this->m_rental->get_data("transaksi_batal")->num_rows(); ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="<?php echo base_url().'admin/lihat_transaksi_batal'; ?>">
                        <div class="panel-footer">
                            <span class="pull-left">
                                Info Selebihnya
                            </span>
                            <span class="pull-right">
                                <i class="glyphicon glyphicon-arrow-right"></i>
                            </span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-orange">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="glyphicon glyphicon-sort"></i> Peminjaman Terakhir</h3>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th>Tgl.Transaksi</th>
                                <th>Tgl.Pinjam</th>
                                <th>Tgl.Kembali</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($transaksi as $t){ ?>
                            <tr>
                                <td><?php echo date("d/m/Y",strtotime($t->tgl)); ?></td>
                                <td><?php echo date("d/m/Y",strtotime($t->tgl_pinjam)); ?></td>
                                <td><?php echo date("d/m/Y",strtotime($t->tgl_kembali)); ?></td>
                                <td><?php echo "Rp.".number_format($t->total_bayar)." ,-"; ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="text-right">
                    <a href="<?php echo base_url().'admin/transaksi'; ?>">Lihat Semua Transaksi <i class="glyphicon glyphicon-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel">
            <div class="panel-body">
                <div class="thumb-info-admin">
                    <a href="<?php echo base_url().'assets/images/admin/'.$this->session->userdata('gambar_admin'); ?>" class="example-image-link" data-lightbox="example-set" data-title="<?php echo $this->session->userdata('nama_awal').' '.$this->session->userdata('nama_akhir'); ?>"><img src="<?php echo base_url().'assets/images/admin/'.$this->session->userdata('gambar_admin'); ?>" alt="<?php echo $this->session->userdata('nama_awal').' '.$this->session->userdata('nama_akhir'); ?>" class="rounded img-respon"></a>
                    <div class="thumb-info-title-admin">
                        <span class="thumb-info-inner-admin"><?php echo $this->session->userdata("nama_awal")." ".$this->session->userdata("nama_akhir"); ?></span>
                        <span class="thumb-info-type-admin"><?php echo $this->session->userdata("pekerjaan"); ?></span>
                    </div>
                </div>
                <div>
                    <div class="widget-content-expanded">
                        <i class="fa fa-user"></i><span>Email:</span> <?php echo $this->session->userdata("email"); ?><br>
                        <i class="fa fa-envelope"></i><span>Nomor HP:</span> <?php echo $this->session->userdata("hp"); ?><br>
                        <a href="<?php echo base_url().'admin/profil/'.$this->session->userdata('id'); ?>" class="btn btn-primary mt-3">Lihat Profil</a>
                    </div>
                    <hr class="dotted short">
                    <h5 class="text-muted"> Tentang Saya</h5>
                    <p>
                        <?php echo $this->session->userdata("tentang"); ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="glyphicon glyphicon-random arrow-right"></i> Mobil</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <?php foreach($mobil as $m){ ?>
                    <a href="#" class="list-group-item">
                        <span class="badge"><?php if($m->status == 1){echo "Tersedia";}else{echo "Dirental";} ?></span>
                        <i class="glyphicon glyphicon-user"></i><?php echo $m->merk; ?>
                    </a>
                    <?php } ?>
                </div>
                <div class="text-right">
                        <a href="<?php echo base_url().'admin/mobil'; ?>">Lihat Semua Mobil <i class="glyphicon glyphicon-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="panel panel-green">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="glyphicon glyphicon-user o"></i>Customer Terbaru</h3>
            </div>
            <div class="panel-body">
                <div class="list-group">
                    <?php foreach($customer as $c){ ?>
                    <a href="#" class="list-group-item">
                        <span class="badge">
                            <?php echo $c->jk; ?>
                        </span>
                        <i class="glyphicon glyphicon-user"></i><?php echo $c->nama; ?>
                    </a>
                    <?php } ?>
                </div>
                <div class="text-right">
                        <a href="<?php echo base_url().'admin/customer'; ?>">Lihat Semua Customer <i class="glyphicon glyphicon-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>