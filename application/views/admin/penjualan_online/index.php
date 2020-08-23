<div class="container" style="margin-top:100px">
    <h1 class="pb-3 border-bottom">Penjualan<small>Online</small></h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="pb-3 mb-3 border-bottom">Status <small class="text-primary">Selesai</small></h3>
                    <table class="table table-bordered table-striped datable dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Invoice</th>
                                <th>Nama Pemesan</th>
                                <th>Jenis Pengiriman</th>
                                <th>Jenis Pembayaran</th>
                                <th>Total Pembayaran</th>
                                <th>Tanggal Pembuatan Invoice</th>
                                <th>Tombol Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach($detail_invoice_selesai->result() as $ds) {
                            ?>
                            <tr>
                                <td><?= $no++."."; ?></td>
                                <td><?= $ds->no_invoice; ?></td>
                                <td><?= $ds->user_nama; ?></td>
                                <td>
                                    <?php
                                        if($ds->jenis_kirim == 1) {
                                            echo "Antar ke rumah";
                                        }
                                        else {
                                            echo "Ambil di tempat";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($ds->jenis_bayar == 1) {
                                            echo "Transfer";
                                        }
                                        else {
                                            echo "Tunai";
                                        }
                                    ?>    
                                </td>
                                <td><?= "Rp. ".number_format($ds->total_bayar); ?></td>
                                <td>
                                    <?php
                                        $tgl_invoice = date("d",strtotime($ds->waktu_ditambahkan));
                                        $bln_invoice = date("m",strtotime($ds->waktu_ditambahkan));
                                        $thn_invoice = date("Y",strtotime($ds->waktu_ditambahkan));
                                        $waktu_invoice = date("H:i:s",strtotime($ds->waktu_ditambahkan));

                                        if($bln_invoice == "01") {
                                            $bln_invoice = "Januari";
                                        }
                                        else if($bln_invoice == "02") {
                                            $bln_invoice = "Februari";
                                        }
                                        else if($bln_invoice == "03") {
                                            $bln_invoice = "Maret";
                                        }
                                        else if($bln_invoice == "04") {
                                            $bln_invoice = "April";
                                        }
                                        else if($bln_invoice == "05") {
                                            $bln_invoice = "Mei";
                                        }
                                        else if($bln_invoice == "06") {
                                            $bln_invoice = "Juni";
                                        }
                                        else if($bln_invoice == "07") {
                                            $bln_invoice = "Juli";
                                        }
                                        else if($bln_invoice == "08") {
                                            $bln_invoice = "Agustus";
                                        }
                                        else if($bln_invoice == "09") {
                                            $bln_invoice = "September";
                                        }
                                        else if($bln_invoice == "10") {
                                            $bln_invoice = "Oktober";
                                        }
                                        else if($bln_invoice == "11") {
                                            $bln_invoice = "November";
                                        }
                                        else if($bln_invoice == "12") {
                                            $bln_invoice = "Desember";
                                        }

                                        echo $tgl_invoice." ".$bln_invoice." ".$thn_invoice." - ".$waktu_invoice;
                                    ?>
                                </td>
                                <td><button class="btn btn-primary" type="button" onclick="lihatDetail(event);" data-no_invoice="<?= $ds->no_invoice; ?>"><i class="fas fa-list"></i> Lihat Detail</button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="pb-3 mb-3 border-bottom">Status <small class="text-success">Tervalidasi</small></h3>
                    <table class="table table-bordered table-striped datable dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Invoice</th>
                                <th>Nama Pemesan</th>
                                <th>Jenis Pengiriman</th>
                                <th>Jenis Pembayaran</th>
                                <th>Total Pembayaran</th>
                                <th>Tanggal Pembuatan Invoice</th>
                                <th>Tombol Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach($detail_invoice_valid->result() as $dv) {
                            ?>
                            <tr>
                                <td><?= $no++."."; ?></td>
                                <td><?= $dv->no_invoice; ?></td>
                                <td><?= $dv->user_nama; ?></td>
                                <td>
                                    <?php
                                        if($dv->jenis_kirim == 1) {
                                            echo "Antar ke rumah";
                                        }
                                        else {
                                            echo "Ambil di tempat";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($dv->jenis_bayar == 1) {
                                            echo "Transfer";
                                        }
                                        else {
                                            echo "Tunai";
                                        }
                                    ?>    
                                </td>
                                <td><?= "Rp. ".number_format($dv->total_bayar); ?></td>
                                <td>
                                    <?php
                                        $tgl_invoice = date("d",strtotime($dv->waktu_ditambahkan));
                                        $bln_invoice = date("m",strtotime($dv->waktu_ditambahkan));
                                        $thn_invoice = date("Y",strtotime($dv->waktu_ditambahkan));
                                        $waktu_invoice = date("H:i:s",strtotime($dv->waktu_ditambahkan));

                                        if($bln_invoice == "01") {
                                            $bln_invoice = "Januari";
                                        }
                                        else if($bln_invoice == "02") {
                                            $bln_invoice = "Februari";
                                        }
                                        else if($bln_invoice == "03") {
                                            $bln_invoice = "Maret";
                                        }
                                        else if($bln_invoice == "04") {
                                            $bln_invoice = "April";
                                        }
                                        else if($bln_invoice == "05") {
                                            $bln_invoice = "Mei";
                                        }
                                        else if($bln_invoice == "06") {
                                            $bln_invoice = "Juni";
                                        }
                                        else if($bln_invoice == "07") {
                                            $bln_invoice = "Juli";
                                        }
                                        else if($bln_invoice == "08") {
                                            $bln_invoice = "Agustus";
                                        }
                                        else if($bln_invoice == "09") {
                                            $bln_invoice = "September";
                                        }
                                        else if($bln_invoice == "10") {
                                            $bln_invoice = "Oktober";
                                        }
                                        else if($bln_invoice == "11") {
                                            $bln_invoice = "November";
                                        }
                                        else if($bln_invoice == "12") {
                                            $bln_invoice = "Desember";
                                        }

                                        echo $tgl_invoice." ".$bln_invoice." ".$thn_invoice." - ".$waktu_invoice;
                                    ?>
                                </td>
                                <td><button class="btn btn-primary" type="button" onclick="lihatDetail(event);" data-no_invoice="<?= $dv->no_invoice; ?>"><i class="fas fa-list"></i> Lihat Detail</button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="pb-3 mb-3 border-bottom">Status <span class="text-warning">Belum<small>Divalidasi</small></h3>
                    <table class="table table-bordered table-striped datable dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Invoice</th>
                                <th>Nama Pemesan</th>
                                <th>Jenis Pengiriman</th>
                                <th>Jenis Pembayaran</th>
                                <th>Total Pembayaran</th>
                                <th>Tanggal Pembuatan Invoice</th>
                                <th>Tombol Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach($detail_invoice_invalid->result() as $di) {
                                    if($di->jenis_bayar == 2 OR $di->jenis_bayar == 1 AND $di->bukti_transfer <> "") {
                            ?>
                            <tr>
                                <td><?= $no++."."; ?></td>
                                <td><?= $di->no_invoice; ?></td>
                                <td><?= $di->user_nama; ?></td>
                                <td>
                                    <?php
                                        if($di->jenis_kirim == 1) {
                                            echo "Antar ke rumah";
                                        }
                                        else {
                                            echo "Ambil di tempat";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($di->jenis_bayar == 1) {
                                            echo "Transfer";
                                        }
                                        else {
                                            echo "Tunai";
                                        }
                                    ?>    
                                </td>
                                <td><?= "Rp. ".number_format($di->total_bayar); ?></td>
                                <td>
                                    <?php
                                        $tgl_invoice = date("d",strtotime($di->waktu_ditambahkan));
                                        $bln_invoice = date("m",strtotime($di->waktu_ditambahkan));
                                        $thn_invoice = date("Y",strtotime($di->waktu_ditambahkan));
                                        $waktu_invoice = date("H:i:s",strtotime($di->waktu_ditambahkan));

                                        if($bln_invoice == "01") {
                                            $bln_invoice = "Januari";
                                        }
                                        else if($bln_invoice == "02") {
                                            $bln_invoice = "Februari";
                                        }
                                        else if($bln_invoice == "03") {
                                            $bln_invoice = "Maret";
                                        }
                                        else if($bln_invoice == "04") {
                                            $bln_invoice = "April";
                                        }
                                        else if($bln_invoice == "05") {
                                            $bln_invoice = "Mei";
                                        }
                                        else if($bln_invoice == "06") {
                                            $bln_invoice = "Juni";
                                        }
                                        else if($bln_invoice == "07") {
                                            $bln_invoice = "Juli";
                                        }
                                        else if($bln_invoice == "08") {
                                            $bln_invoice = "Agustus";
                                        }
                                        else if($bln_invoice == "09") {
                                            $bln_invoice = "September";
                                        }
                                        else if($bln_invoice == "10") {
                                            $bln_invoice = "Oktober";
                                        }
                                        else if($bln_invoice == "11") {
                                            $bln_invoice = "November";
                                        }
                                        else if($bln_invoice == "12") {
                                            $bln_invoice = "Desember";
                                        }

                                        echo $tgl_invoice." ".$bln_invoice." ".$thn_invoice." - ".$waktu_invoice;
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-primary" type="button" onclick="lihatDetail(event);" data-no_invoice="<?= $di->no_invoice; ?>"><i class="fas fa-list"></i> Lihat Detail</button>
                                        <?php if($di->jenis_bayar == 1) { ?>
                                            <button class="btn btn-warning text-white" type="button" data-toggle="modal" data-target="#modalWarning" data-no_invoice="<?= $i->no_invoice; ?>">Lihat Bukti Transfer</button>
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                            <?php }} ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="pb-3 mb-3 border-bottom">Status <span class="text-warning">Belum<small>Bayar</small></h3>
                    <table class="table table-bordered table-striped datable dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Invoice</th>
                                <th>Nama Pemesan</th>
                                <th>Jenis Pengiriman</th>
                                <th>Jenis Pembayaran</th>
                                <th>Total Pembayaran</th>
                                <th>Tanggal Pembuatan Invoice</th>
                                <th>Tombol Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach($detail_invoice_belum_bayar->result() as $du) {
                            ?>
                            <tr>
                                <td><?= $no++."."; ?></td>
                                <td><?= $du->no_invoice; ?></td>
                                <td><?= $du->user_nama; ?></td>
                                <td>
                                    <?php
                                        if($du->jenis_kirim == 1) {
                                            echo "Antar ke rumah";
                                        }
                                        else {
                                            echo "Ambil di tempat";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($du->jenis_bayar == 1) {
                                            echo "Transfer";
                                        }
                                        else {
                                            echo "Tunai";
                                        }
                                    ?>    
                                </td>
                                <td><?= "Rp. ".number_format($du->total_bayar); ?></td>
                                <td>
                                    <?php
                                        $tgl_invoice = date("d",strtotime($du->waktu_ditambahkan));
                                        $bln_invoice = date("m",strtotime($du->waktu_ditambahkan));
                                        $thn_invoice = date("Y",strtotime($du->waktu_ditambahkan));
                                        $waktu_invoice = date("H:i:s",strtotime($du->waktu_ditambahkan));

                                        if($bln_invoice == "01") {
                                            $bln_invoice = "Januari";
                                        }
                                        else if($bln_invoice == "02") {
                                            $bln_invoice = "Februari";
                                        }
                                        else if($bln_invoice == "03") {
                                            $bln_invoice = "Maret";
                                        }
                                        else if($bln_invoice == "04") {
                                            $bln_invoice = "April";
                                        }
                                        else if($bln_invoice == "05") {
                                            $bln_invoice = "Mei";
                                        }
                                        else if($bln_invoice == "06") {
                                            $bln_invoice = "Juni";
                                        }
                                        else if($bln_invoice == "07") {
                                            $bln_invoice = "Juli";
                                        }
                                        else if($bln_invoice == "08") {
                                            $bln_invoice = "Agustus";
                                        }
                                        else if($bln_invoice == "09") {
                                            $bln_invoice = "September";
                                        }
                                        else if($bln_invoice == "10") {
                                            $bln_invoice = "Oktober";
                                        }
                                        else if($bln_invoice == "11") {
                                            $bln_invoice = "November";
                                        }
                                        else if($bln_invoice == "12") {
                                            $bln_invoice = "Desember";
                                        }

                                        echo $tgl_invoice." ".$bln_invoice." ".$thn_invoice." - ".$waktu_invoice;
                                    ?>
                                </td>
                                <td><button class="btn btn-primary" type="button" onclick="lihatDetail(event);" data-no_invoice="<?= $du->no_invoice; ?>"><i class="fas fa-list"></i> Lihat Detail</button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <h3 class="pb-3 mb-3 border-bottom">Status <small class="text-danger">Dibatalkan</small></h3>
                    <table class="table table-bordered table-striped datable dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Invoice</th>
                                <th>Nama Pemesan</th>
                                <th>Jenis Pengiriman</th>
                                <th>Jenis Pembayaran</th>
                                <th>Total Pembayaran</th>
                                <th>Tanggal Pembuatan Invoice</th>
                                <th>Tombol Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach($detail_invoice_batal->result() as $db) {
                            ?>
                            <tr>
                                <td><?= $no++."."; ?></td>
                                <td><?= $db->no_invoice; ?></td>
                                <td><?= $db->user_nama; ?></td>
                                <td>
                                    <?php
                                        if($db->jenis_kirim == 1) {
                                            echo "Antar ke rumah";
                                        }
                                        else {
                                            echo "Ambil di tempat";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($db->jenis_bayar == 1) {
                                            echo "Transfer";
                                        }
                                        else {
                                            echo "Tunai";
                                        }
                                    ?>    
                                </td>
                                <td><?= "Rp. ".number_format($db->total_bayar); ?></td>
                                <td>
                                    <?php
                                        $tgl_invoice = date("d",strtotime($db->waktu_ditambahkan));
                                        $bln_invoice = date("m",strtotime($db->waktu_ditambahkan));
                                        $thn_invoice = date("Y",strtotime($db->waktu_ditambahkan));
                                        $waktu_invoice = date("H:i:s",strtotime($db->waktu_ditambahkan));

                                        if($bln_invoice == "01") {
                                            $bln_invoice = "Januari";
                                        }
                                        else if($bln_invoice == "02") {
                                            $bln_invoice = "Februari";
                                        }
                                        else if($bln_invoice == "03") {
                                            $bln_invoice = "Maret";
                                        }
                                        else if($bln_invoice == "04") {
                                            $bln_invoice = "April";
                                        }
                                        else if($bln_invoice == "05") {
                                            $bln_invoice = "Mei";
                                        }
                                        else if($bln_invoice == "06") {
                                            $bln_invoice = "Juni";
                                        }
                                        else if($bln_invoice == "07") {
                                            $bln_invoice = "Juli";
                                        }
                                        else if($bln_invoice == "08") {
                                            $bln_invoice = "Agustus";
                                        }
                                        else if($bln_invoice == "09") {
                                            $bln_invoice = "September";
                                        }
                                        else if($bln_invoice == "10") {
                                            $bln_invoice = "Oktober";
                                        }
                                        else if($bln_invoice == "11") {
                                            $bln_invoice = "November";
                                        }
                                        else if($bln_invoice == "12") {
                                            $bln_invoice = "Desember";
                                        }

                                        echo $tgl_invoice." ".$bln_invoice." ".$thn_invoice." - ".$waktu_invoice;
                                    ?>
                                </td>
                                <td><button class="btn btn-primary" type="button" onclick="lihatDetail(event);" data-no_invoice="<?= $db->no_invoice; ?>"><i class="fas fa-list"></i> Lihat Detail</button></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>