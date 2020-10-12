<nav class="navbar navbar-inverse navbar-fixed-top bg-primary">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex-1-collapse">
            <span class="sr-only">Toggle Navigation</span>

            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="<?php echo base_url().'admin'; ?>" class="navbar-brand" style="color:#ffffff;">Rental Mobil</a>
    </div>
    <ul class="nav navbar-right top-nav">
        <li class="dropdown">
            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"><b class="caret"></b></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="<?php echo base_url().'admin/profil'; ?>">
                        <span class="glyphicon glyphicon-user"></span>
                        Profil
                    </a>
                </li>
                <li>
                    <a href="<?php echo base_url().'admin/ganti_password'; ?>">
                        <span class="glyphicon glyphicon-lock"></span>
                        Ganti Password
                    </a>
                </li>
                <li class="divider"></li>
                <li>
                    <a href="javascript:;" class="confirm">
                        <span class="glyphicon glyphicon-log-out"></span>
                        Logout <strong><?php echo $this->session->userdata("nama_awal"); ?>&nbsp;<?php echo $this->session->userdata("nama_akhir"); ?></strong>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
    <div class="collapse navbar-collapse navbar-ex-1-collapse bg-primary">
        <ul class="nav navbar-nav side-nav" id="side">
            <li class="hidden-xs">
                <center>
                    <a href="<?php echo base_url().'assets/images/admin/'.$this->session->userdata("gambar_admin"); ?>" class="example-image-link" data-lightbox="example-set" data-title="<?php echo $this->session->userdata("nama_awal")." ".$this->session->userdata("nama_akhir"); ?>"><img src="<?php echo base_url().'assets/images/admin/'.$this->session->userdata("gambar_admin"); ?>" alt="Profile Picture" class="img-fluid rounded-circle w-75 mt-4 mb-3"></a><br>
                    <i class="fas fa-key" style="color:#ffffff;"></i><i style="color:#ffffff;">Login sebagai</i>
                    <h4 style="margin-top:2px;color:#ffffff;"><?php echo $this->session->userdata("nama_awal"); ?>&nbsp;<strong><?php echo $this->session->userdata("nama_akhir"); ?></strong></h4>
                </center>
            </li>
            <li>
                <hr class="custom">
            </li>
            <li>
                <a href="<?php echo base_url().'admin'; ?>" class="side-text">
                    <span class="glyphicon glyphicon-home"></span>
                    Dasbor
                </a>
            </li>
            <li>
                <hr class="custom">
            </li>
            <li>
                <a href="javascript:;" data-parent="#side" data-toggle="collapse" data-target="#mobil" class="side-text accordion-toggle-collapsed">
                    <span class="glyphicon glyphicon-folder-open"></span>
                    Data Mobil
                    <span class="badge"><?php echo $this->m_rental->get_data("mobil")->num_rows(); ?></span>
                    <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="mobil" class="<?php
                    if($active == "mobil" OR $active == "mobil_add"){
                        echo "";
                    }
                    else{
                        echo "collapse";
                    }
                ?>">
                    <li>
                        <a href="<?php echo base_url().'admin/mobil_add'; ?>" class="<?php if($active == "mobil_add"){echo "active-side"; } ?>">- Tambah Data Mobil</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'admin/mobil'; ?>" class="<?php if($active == "mobil"){echo "active-side"; } ?>">- Lihat Data Mobil</a>
                    </li>
                </ul>
            </li>
            <li>
                <hr class="custom">
            </li>
            <li>
                <a href="javascript:;" data-parent="#side" data-toggle="collapse" data-target="#customer" class="side-text accordion-toggle-collapsed">
                    <span class="glyphicon glyphicon-user"></span>
                    Data Customer
                    <span class="badge"><?php echo $this->m_rental->get_data("customer")->num_rows(); ?></span>
                    <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="customer" class="<?php
                    if($active == "customer" OR $active == "customer_add"){
                        echo "";
                    }
                    else{
                        echo "collapse";
                    }
                ?>">
                    <li>
                        <a href="<?php echo base_url().'admin/customer_add'; ?>" class="<?php if($active =='customer_add'){echo'active-side'; } ?>">- Tambah Data Customer</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'admin/customer'; ?>" class="<?php if($active == 'customer'){echo 'active-side'; } ?>">- Lihat Data Customer</a>
                    </li>
                </ul>
            </li>
            <li>
                <hr class="custom">
            </li>
            <li>
                <a href="javascript:;" data-toggle="collapse" data-target="#transaksi" class="side-text">
                    <span class="glyphicon glyphicon-sort"></span>
                    Transaksi Rental
                    <?php
                        $transaksi = $this->m_rental->get_data("transaksi")->num_rows();
                        $transaksi_batal = $this->m_rental->get_data("transaksi_batal")->num_rows();

                        $jumlah = $transaksi + $transaksi_batal;
                    ?>
                    <span class="badge"><?php echo $jumlah; ?></span>
                    <i class="fa fa-fw fa-caret-down"></i>
                </a>
                <ul id="transaksi" class="<?php
                    if($active == "transaksi" OR $active == "transaksi_add" OR $active == "transaksi_batal"){
                        echo "";
                    }
                    else{
                        echo "collapse";
                    }
                ?>">
                    <li>
                        <a href="<?php echo base_url().'admin/transaksi_add'; ?>" class="<?php if($active == 'transaksi_add'){echo'active-side'; } ?>">- Lakukan Transaksi</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'admin/transaksi'; ?>" class="<?php if($active == 'transaksi'){echo'active-side'; } ?>">- Lihat Data Transaksi <span class="badge"><?php echo $this->m_rental->get_data("transaksi")->num_rows(); ?></span></a>
                    </li>
                    <li>
                        <a href="<?php echo base_url().'admin/lihat_transaksi_batal'; ?>" class="<?php if($active =='transaksi_batal'){echo'active-side'; } ?>">- Transaksi Dibatalkan <span class="badge"><?php echo $this->m_rental->get_data("transaksi_batal")->num_rows(); ?></span></a>
                    </li>
                </ul>
            </li>
            <li>
                <hr class="custom">
            </li>
            <li>
                <a href="<?php echo base_url().'admin/laporan'; ?>" class="side-text">
                    <span class="glyphicon glyphicon-list-alt"></span>
                    Laporan
                </a>
            </li>
            <li>
                <hr class="custom">
            </li>
            <li>
                <a href="javascript:;" class="side-text confirm">
                    <span class="glyphicon glyphicon-log-out"></span>
                    Logout
                </a>
            </li>
            <li>
                <hr class="custom">
            </li>
        </ul>
    </div>
</nav>