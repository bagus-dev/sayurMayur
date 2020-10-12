<div class="page-header">
    <h3>Laporan</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li class="active">
        Laporan Transaksi
    </li>
</ol>
<div class="panel panel-orange">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-file-alt"></i>
            Laporan Transaksi
        </h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url().'admin/laporan'; ?>" method="post">
            <div class="form-group">
                <label>Dari Tanggal</label>
                <input type="text" name="dari" class="form-control" id="datepicker4" value="<?php echo set_value('dari'); ?>">
                <?php echo form_error("dari"); ?>
            </div>
            <div class="form-group">
                <label>Sampai Tanggal</label>
                <input type="text" name="sampai" class="form-control" id="datepicker5" value="<?php echo set_value('sampai'); ?>">
                <?php echo form_error("sampai"); ?>
            </div>
            <div class="form-group">
                <input type="submit" value="CARI" name="cari" class="btn btn-sm btn-primary">
            </div>
        </form>
    </div>
</div>
<div class="panel panel-orange">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-file-alt"></i>
            Print Laporan Transaksi
        </h3>
    </div>
    <div class="panel-body">
        <div class="container ng-scope btn-group" ng-controller="app.invoice as ctrl">
            <a href="<?php echo base_url().'admin/laporan_pdf/?dari='.set_value('dari').'&sampai='.set_value('sampai'); ?>" class="btn btn-warning btn-sm">
                <span class="glyphicon glyphicon-print"></span>
                Unduh PDF
            </a>
            <button class="btn btn-sm btn-primary" ng-click="ctrl.openInvoice()"><i class="fa fa-print"></i> Print</button>
        </div>
        <br>
        <br>
        <h1>Laporan Transaksi Selesai</h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered multiple">
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
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach($laporan as $l){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo date("d/m/Y",strtotime($l->tgl)); ?></td>
                        <td><?php echo $l->nama; ?></td>
                        <td><?php echo $l->merk; ?></td>
                        <td><?php echo date("d/m/Y",strtotime($l->tgl_pinjam)); ?></td>
                        <td><?php echo date("d/m/Y",strtotime($l->tgl_kembali)); ?></td>
                        <td><?php echo "Rp. ".number_format($l->harga); ?></td>
                        <td><?php echo "Rp. ".number_format($l->denda); ?></td>
                        <td>
                            <?php
                                if($l->tgl_dikembalikan == "0000-00-00"){
                                    echo "-";
                                }
                                else{
                                    echo date("d/m/Y",strtotime($l->tgl_dikembalikan));
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                echo "Rp. ".number_format($l->total_denda)." ,-";
                            ?>
                        </td>
                        <td>
                            <?php
                                if($l->transaksi_status == "1"){
                                    echo "Selesai";
                                }
                                else{
                                    echo "-";
                                }
                            ?>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <br>
        <br>
        <h1>Laporan Transaksi Batal</h1>
        <hr>
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered multiple">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Customer</th>
                        <th>Mobil</th>
                        <th>Tgl.Pinjam</th>
                        <th>Tgl.Kembali</th>
                        <th>Tgl.Dibatalkan</th>
                        <th>Alasan Dibatalkan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        foreach($batal as $b){
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo date("d/m/Y",strtotime($b->tgl_transaksi)); ?></td>
                        <td><?php echo $b->nama; ?></td>
                        <td><?php echo $b->merk; ?></td>
                        <td><?php echo date("d/m/Y",strtotime($b->tgl_pinjam)); ?></td>
                        <td><?php echo date("d/m/Y",strtotime($b->tgl_kembali)); ?></td>
                        <td><?php echo $b->tgl_batal; ?></td>
                        <td><?php echo $b->alasan; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
    date_default_timezone_set("Asia/Jakarta");
?>
<script type="text/ng-template" id="invoice">
    <div id="print-content">
        <style>
            @media print{
                body * {
                    visibility: hidden;
                }
                #print-content * {
                    visibility: visible;
                }
                .modal{
                    position: absolute;
                    left: 0;
                    top: 0;
                    margin: 0;
                    padding: 0;
                    min-height:550px;
                }
            }
        </style>
        <div class="modal-header hidden-print bg-primary">
            <h1>Laporan</h1>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-6">
                    <h3>Laporan Transaksi Rental Mobil</h3>
                </div>
                <div class="col-lg-6"><h6 class="text-right">{{item.tanggal}}</h6></div>
            </div>
            <hr>
            <table ng-repeat="item in ctrl.items">
                <tr style="border-bottom: 1px dashed black">
                    <td>Dari Tgl</td>
                    <td>&nbsp;:</td>
                    <td>{{item.dari}}</td>
                </tr>
                <tr style="border-bottom: 1px dashed black">
                    <td>Sampai Tgl</td>
                    <td>&nbsp;:</td>
                    <td>{{item.sampai}}</td>
                </tr>
                <tr style="border-bottom: 1px dashed black">
                    <td>Karyawan</td>
                    <td>&nbsp;:</td>
                    <td>{{item.karyawan}}</td>
                </tr>
            </table>
            <br>
            <table class="table table-striped table-hover table-bordered" ng-repeat="item in ctrl.items">
                <thead>
                    <tr>
                        <th>Tanggal Transaksi</th>
                        <th>Customer</th>
                        <th>Mobil</th>
                        <th>Tgl. Mulai Rental</th>
                        <th>Tgl. Selesai Rental</th>
                        <th>Harga</th>
                        <th>Denda /hari</th>
                        <th>Tgl .Dikembalikan</th>
                        <th>Total Denda</th>
                        <th>Total Bayar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{item.tgl}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="modal-footer hidden-print">
            <div class="pull-right hidden-print">
                <button class="btn btn-primary" ng-click="ctrl.print()"><i class="fas fa-print"></i>Print</button>
                <button class="btn btn-warning" ng-click="$close()">OK</button>
            </div>
        </div>
    </div>
</script>
<script>
    (function (angular){
        "use strict";
        var appName = "app";
        var app = angular.module(appName, ["ui.bootstrap"]);
        app.controller("app.invoice", ["$scope", "$modal", invoiceCtrl]);
        app.controller("app.print", [printCtrl]);

        function invoiceCtrl($scope, $modal){
            var ctrl = this;

            ctrl.openInvoice = function (){
                var modalInstance = $modal.open({
                    templateUrl: "invoice", size: "lg",
                    controller: "app.print",
                    controllerAs: "ctrl"
                });
            }
        }
        
        function printCtrl() {
            var ctrl = this;
            var darii = "<?php echo date("d-m-Y",strtotime($dari)); ?>";
            var sampaii = "<?php echo date("d-m-Y",strtotime($sampai)); ?>";
            var karyawann = "<?php echo $this->session->userdata('nama_awal').' '.$this->session->userdata('nama_akhir'); ?>";
            var tgll = "<?php foreach($laporan as $l){echo $l->tgl; } ?>";

            ctrl.items = [{dari:darii,sampai:sampaii,karyawan:karyawann}];
            ctrl.print = function () {
                window.print();
            }
        }
    })(angular);
</script>
<script>
    if(window.parent && window.parent.parent){
        window.parent.parent.postMessage(["resultsFrame", {
            height: document.body.getBoundingClientRect().height,
            slug: ""
        }], "*")
    }
</script>
</div>
</div>