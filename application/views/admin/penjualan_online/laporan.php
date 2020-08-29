<div class="container" style="margin-top:100px">
    <h1 class="pb-3 border-bottom">Laporan <small>PenjualanOnline</small></h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered table-striped datable dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>No. Invoice</th>
                                <th>Nama Pemesan</th>
                                <th>Jenis Pengiriman</th>
                                <th>Jenis Pembayaran</th>
                                <th>Total Tagihan</th>
                                <th>Total Dibayar</th>
                                <th>Status Pesanan</th>
                                <th>Tanggal Pembuatan Invoice</th>
                                <th>Tombol Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                foreach($invoice_laporan->result() as $i) {
                            ?>
                            <tr>
                                <td><?= $no++."."; ?></td>
                                <td><?= $i->no_invoice; ?></td>
                                <td><?= $i->user_nama; ?></td>
                                <td>
                                    <?php
                                        if($i->jenis_kirim == 1) {
                                            echo "Antar ke rumah";
                                        }
                                        else {
                                            echo "Ambil di tempat";
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
                                <td><?= "Rp. ".number_format($i->dibayar); ?></td>
                                <td>
                                    <?php
                                        if($i->status == 0) {
                                            if($i->jenis_bayar == 1 AND $i->bukti_transfer == "") {
                                                echo "<span class='bg-warning p-2 rounded'><font class='text-white'>Belum Dibayar</font></span>";
                                            }
                                            else if($i->jenis_bayar == 1 AND $i->bukti_transfer <> "") {
                                                echo "<span class='bg-warning p-2 rounded'><font class='text-white'>Belum Divalidasi</font></span>";
                                            }
                                            else if($i->jenis_bayar == 2) {
                                                echo "<span class='bg-warning p-2 rounded'><font class='text-white'>Belum Divalidasi</font></span>";
                                            }
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
                                    <?php
                                        $tgl_invoice = date("d",strtotime($i->waktu_ditambahkan));
                                        $bln_invoice = date("m",strtotime($i->waktu_ditambahkan));
                                        $thn_invoice = date("Y",strtotime($i->waktu_ditambahkan));
                                        $waktu_invoice = date("H:i:s",strtotime($i->waktu_ditambahkan));

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

                                        echo $tgl_invoice." ".$bln_invoice." ".$thn_invoice." - ".$waktu_invoice." WIB";
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button class="btn btn-primary" type="button" onclick="lihatDetail(event);" data-no_invoice="<?= $i->no_invoice; ?>"><i class="fas fa-list"></i> Lihat Detail</button>
                                        <?php if($i->status == 3) { ?>
                                        <button class="btn btn-success" type="button" onclick="cetakStruk(event);" data-no_invoice="<?= $i->no_invoice; ?>"><i class="fas fa-print"></i> Cetak Struk</button>
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