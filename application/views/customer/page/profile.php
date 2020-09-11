<div class="container" style="margin-top:100px">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <h1 class="pb-3 border-bottom text-center">Profil</h1>
                </div>
                <div class="col-md-3 mt-3">
                    <img src="<?= base_url().'assets/source/images/user/unknown.jpg'; ?>" alt="Foto Profil" class="img-fluid img-thumbnail">
                </div>
                <div class="col-md-9 mt-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <?php
                                    foreach($user->result() as $u) { ?>
                                <div class="col-6">
                                    <b class="border-bottom">Nama Lengkap:</b>
                                    <br>
                                    <?= $u->user_nama; ?>
                                </div>
                                <div class="col-6">
                                    <b class="border-bottom">Nomor HP:</b>
                                    <br>
                                    <?= $u->user_nohp; ?>
                                    <br><br>
                                    <b class="border-bottom">Alamat Email:</b>
                                    <br>
                                    <?= $u->user_email; ?>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top:60px">
                <div class="col-12">
                    <h1 class="pb-3 border-bottom text-center">Pesanan / Order</h1>
                </div>
                <div class="col-12">
                    <table class="table table-bordered table-striped dt-responsive nowrap mt-3" id="table-datatable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Invoice</th>
                                <th>Tanggal Invoice</th>
                                <th>Cara Bayar</th>
                                <th>Jenis Pembayaran</th>
                                <th>Total Pembayaran</th>
                                <th>Status Pesanan</th>
                                <th>Tombol Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach($invoice->result() as $i){
                            ?>
                            <tr>
                                <td><?= $no++."."; ?></td>
                                <td><?= $i->no_invoice; ?></td>
                                <td>
                                    <?php
                                        $tgl_invoice = date("d",strtotime($i->waktu_ditambahkan));
                                        $bln_invoice = date("m",strtotime($i->waktu_ditambahkan));
                                        $thn_invoice = date("Y",strtotime($i->waktu_ditambahkan));
                    
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

                                        echo $tgl_invoice." ".$bln_invoice." ".$thn_invoice;
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($i->cara_bayar == 1) {
                                            echo "Di Toko";
                                        }
                                        else {
                                            echo "Di Tempat";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($i->jenis_bayar == 1) {
                                            echo "Transfer";
                                        }
                                        else {
                                            echo "Tunai";
                                        }
                                    ?>
                                </td>
                                <td><?= "Rp. ".number_format($i->total_bayar); ?></td>
                                <td>
                                    <?php
                                        if($i->status == 0) {
                                            echo "<span class='bg-warning p-2 rounded'><font style='color:white'>Belum Divalidasi</font></span>";
                                        }
                                        else if($i->status == 1) {
                                            echo "<span class='bg-success p-2 rounded'>Sudah Tervalidasi</span>";
                                        }
                                        else if($i->status == 2) {
                                            echo "<span class='bg-danger p-2 rounded'>Dibatalkan</span>";
                                        }
                                        else if($i->status == 3) {
                                            echo "<span class='bg-primary p-2 rounded'>Selesai</span>";
                                        }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-primary" type="button" onclick="lihatDetail(event);" data-no_invoice="<?= $i->no_invoice; ?>"><i class="fas fa-list"></i> Lihat Detail</button>
                                        <?php
                                            if($i->jenis_bayar == 1 AND $i->status <> 1 AND $i->bukti_transfer == "" AND $i->status <> 2) {
                                        ?>
                                        <button class="btn btn-warning text-white" type="button" onclick="uploadTrf(event);" data-no_invoice="<?= $i->no_invoice; ?>"><i class="fas fa-upload"></i> Unggah Bukti Transfer</button>
                                        <?php
                                            }
                                            elseif($i->jenis_bayar == 1 AND $i->bukti_transfer <> "") {
                                        ?>
                                        <button class="btn btn-warning text-white" type="button" data-toggle="modal" data-target="#modalWarning" data-no_invoice="<?= $i->no_invoice; ?>">Lihat Bukti Transfer</button>
                                        <?php } ?>
                                    </div>
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