<div class="page-header">
    <h3>Lihat Transaksi</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li>
        <a href="<?php echo base_url().'admin/transaksi'; ?>">Lihat Data Transaksi</a>
    </li>
    <li class="active">
        Lihat Transaksi
    </li>
</ol>
<?php foreach($transaksi as $t){ ?>
<div class="panel panel-red">
    <div class="panel-heading">
        <h3 class="panel-title">
            <i class="fas fa-file-invoice"></i>
            Lihat Transaksi
        </h3>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <label>Customer</label>
            <select name="customer" class="form-control" disabled>
                <option value="">-Pilih Customer-</option>
                <?php foreach($customer as $c){ ?>
                <option <?php if($t->id_customer == $c->customer_id){echo "selected='selected'";} ?> value="<?php echo $c->customer_id; ?>"><?php echo $c->nama; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Mobil</label>
            <select name="mobil" class="form-control" disabled>
                <option value="">-Pilih Mobil-</option>
                <?php foreach($mobil as $m){ ?>
                <option <?php if($t->id_mobil == $m->mobil_id){echo "selected='selected'";} ?> value="<?php echo $m->mobil_id; ?>"><?php echo $m->merk; ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Tanggal Pinjam</label>
            <input type="text" name="tgl_pinjam" class="form-control" value="<?php echo $t->tgl_pinjam; ?>" disabled>
        </div>
        <div class="form-group">
            <label>Tanggal Harus Kembali</label>
            <input type="text" name="tgl_kembali" class="form-control" value="<?php echo $t->tgl_kembali; ?>" disabled>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" class="form-control" value="<?php echo $t->harga; ?>" disabled>
        </div>
        <div class="form-group">
            <label>Harga Denda / Hari</label>
            <input type="text" name="denda" class="form-control" value="<?php echo $t->denda; ?>" disabled>
        </div>
        <div class="form-group">
            <label>Tanggal Dikembalikan Oleh Customer</label>
            <input type="text" name="tgl_dikembalikan" class="form-control" value="<?php echo date("m/d/Y H:i:s",strtotime($t->tgl_dikembalikan)); ?>" disabled>
        </div>
        <div class="form-group">
            <label>Total Denda</label>
            <input type="text" name="total_denda" class="form-control" value="<?php echo $t->total_denda; ?>" disabled>
        </div>
        <div class="form-group">
            <label>Total Bayar</label>
            <input type="text" name="total_bayar" class="form-control" value="<?php echo $t->total_bayar; ?>" disabled>
        </div>
        <div class="container ng-scope form-group" ng-controller="app.invoice as ctrl">
            <button class="btn btn-primary" ng-click="ctrl.openInvoice()"><i class="fa fa-print"></i> Print Transaksi</button>
        </div>
    </div>
</div>
<?php } ?>
<?php date_default_timezone_set("Asia/Jakarta"); ?>
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
            <h1>Rental Mobil</h1>
        </div>
        <div class="modal-body">
                <div class="row" ng-repeat="item in ctrl.items">
                    <div class="col-lg-6">
                        <h4>Rental Mobil</h4>
                    </div>
                    <div class="col-lg-6"><h6 class="text-right">{{item.tanggal}}</h6></div>
                </div>
                <hr class="custom-hr">
                    <table width="100%" ng-repeat="item in ctrl.items">
                        <tr>
                            <td>Kasir:</td>
                            <td width="170"></td>
                            <td class="pull-right">{{item.kasir}}</td>
                        </tr>
                        <tr style="border-bottom:1px dashed grey;">
                            <td>Customer:</td>
                            <td></td>
                            <td class="text-right">{{item.customer}}</td>
                        </tr>
                        <tr height="10"></tr>
                        <tr>
                            <td>Mobil</td>
                            <td class="text-right">Merk Mobil:</td>
                            <td class="text-right">{{item.merk}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right">Tanggal Pinjam:</td>
                            <td class="text-right">{{item.tgl_pinjam}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right">Tanggal Harus Kembali:</td>
                            <td class="text-right">{{item.tgl_kembali}}</td>
                        </tr>
                        <tr style="border-bottom:1px dashed grey;">
                            <td></td>
                            <td class="text-right">Tanggal Dikembalikan:</td>
                            <td class="text-right">{{item.tgl_dikembalikan}}</td>
                        </tr>
                        <tr height="10"></tr>
                        <tr>
                            <td>Pembayaran</td>
                            <td class="text-right">Harga Sewa/hari:</td>
                            <td class="text-right">{{item.harga}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right">Harga Denda/hari:</td>
                            <td class="text-right">{{item.denda}}</td>
                        </tr>
                        <tr style="border-bottom:1px dashed grey;">
                            <td></td>
                            <td class="text-right">Total Denda:</td>
                            <td class="text-right">{{item.total_denda}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-right"><strong>Total Bayar</strong></td>
                            <td class="text-right">{{item.total_bayar}}</td>
                        </tr>
                        <tr height="25">
                            <td colspan="3" class="text-center"><br>Terima kasih. Silakan berkunjung kembali.</td>
                        </tr>
                    </table>
                    <hr class="custom-hr2">
                    <div class="pull-left">&copy;2019.</div>
                    <div class="pull-right">Created By: <strong>Bagus Puji Rahardjo</strong></div>
                    <br>
        </div>
        <div class="modal-footer hidden-print">
            <div class="pull-right hidden-print">
                <button class="btn btn-primary" ng-click="ctrl.print()"><i class="fa fa-print"></i>Print</button>
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
                    templateUrl: "invoice", size: "md",
                    controller: "app.print",
                    controllerAs: "ctrl"
                });
            }
        }
        function printCtrl() {
            var ctrl = this;
            var cashier = "<?php echo $this->session->userdata('nama_awal').' '.$this->session->userdata('nama_akhir'); ?>";
            var pelanggan = "<?php $data_customer = array('customer_id'=>$t->id_customer); $cari_customer = $this->m_rental->edit_data($data_customer,'customer')->row(); echo $cari_customer->nama; ?>";
            var merk_mobil = "<?php $data_mobil = array('mobil_id'=>$t->id_mobil); $cari_mobil = $this->m_rental->edit_data($data_mobil,'mobil')->row(); echo $cari_mobil->merk; ?>";
            var pinjam = "<?php echo date('d-m-Y H:i:s',strtotime($t->tgl_pinjam)); ?>";
            var kembali = "<?php echo date('d-m-Y H:i:s',strtotime($t->tgl_kembali)); ?>";
            var dikembalikan = "<?php echo date('d-m-Y H:i:s',strtotime($t->tgl_dikembalikan)); ?>";
            var sewa = "<?php echo number_format($t->harga); ?>";
            var dendaa = "<?php echo number_format($t->denda); ?>";
            var total_dendaa = "<?php echo number_format($t->total_denda); ?>";
            var total_bayarr = "<?php echo number_format($t->total_bayar); ?>";
            var tanggall = "<?php echo date('d-m-Y H:i:s'); ?>";

            ctrl.items = [{kasir:cashier,customer:pelanggan,merk:merk_mobil,tgl_pinjam:pinjam,tgl_kembali:kembali,tgl_dikembalikan:dikembalikan,harga:sewa,denda:dendaa,total_denda:total_dendaa,total_bayar:total_bayarr,tanggal:tanggall}];
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
</div></div>