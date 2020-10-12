<div class="page-header">
    <h3>Tambah Customer Baru</h3>
</div>
<ol class="breadcrumb">
    <li class="active">
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li class="active">
        Tambah Customer Baru
    </li>
</ol>
<?php
    if(isset($_GET["pesan"])){
        if($_GET["pesan"] == "gagal"){
            echo "<div class='alert alert-danger'>No.HP sudah terdaftar.</div><br>";
        }
        elseif($_GET["pesan"] == "ktp_gagal"){
            echo "<div class='alert alert-danger'>No.KTP sudah terdaftar.</div><br>";
        }
    }
?>
<div class="progress">
  <div class="progress-bar progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="color:#000">0%</div>
</div>
<div class="panel panel-green">
    <div class="panel-heading">
        <h3 class="panel-title">
            <span class="glyphicon glyphicon-user"></span>
            Tambah Data Customer
        </h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url().'admin/customer_add_act'; ?>" method="post">
            <div class="form-group">
                <label>Nama Customer</label>
                <input type="text" name="nama" class="form-control" value="<?php if(isset($customer)){if($customer["nama"] != ''){echo $customer["nama"]; }} ?>" style="<?php if(form_error('nama') != ''){echo'border:2px solid red;'; } ?>">
                <?php echo form_error("nama"); ?>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="pass" class="form-control" id="password" value="<?php if(isset($customer)){if($customer["pass"] != ''){echo $customer["pass"]; }} ?>" style="<?php if(form_error('pass') != ''){echo'border:2px solid red;'; } ?>">
                <i class="fas fa-eye" id="tombolPass"></i>
                <?php echo form_error("pass"); ?>
            </div>
            <div class="form-group">
                <label>Ulangi Password</label>
                <input type="password" name="pass_ulang" class="form-control" id="ulang_pass" value="<?php if(isset($customer)){if($customer["pass_ulang"] != ''){echo $customer["pass_ulang"]; }} ?>" style="<?php if(form_error('pass_ulang') != ''){echo'border:2px solid red;'; } ?>">
                <i class="fas fa-eye" id="ulangPass"></i>
                <?php echo form_error("pass_ulang"); ?>
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" style="<?php if(form_error('alamat') != ''){echo'border:2px solid red;'; } ?>"><?php if(isset($customer)){if($customer["alamat"] != ''){echo $customer["alamat"]; }} ?></textarea>
                <?php echo form_error("alamat"); ?>
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jk" class="form-control">
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
                <?php echo form_error("jk"); ?>
            </div>
            <div class="form-group">
                <label>No.HP</label>
                <input type="number" name="hp" class="form-control" value="<?php if(isset($customer)){if($customer["hp"] != ''){echo $customer["hp"]; }} ?>" style="<?php if(isset($_GET['pesan'])){if($_GET['pesan'] == 'gagal'){echo 'border:2px solid red;'; }}if(form_error('hp') != ''){echo'border:2px solid red;'; } ?>">
                <?php echo form_error("hp"); ?>
            </div>
            <div class="form-group">
                <label>No.KTP</label>
                <input type="number" name="ktp" class="form-control" value="<?php if(isset($customer)){if($customer["ktp"] != ''){echo $customer["ktp"]; }} ?>" style="<?php if(isset($_GET['pesan'])){if($_GET['pesan'] == 'ktp_gagal'){echo 'border:2px solid red;'; }}if(form_error('ktp') != ''){echo'border:2px solid red;'; } ?>">
                <?php echo form_error("ktp"); ?>
            </div>
            <div class="form-group">
                <input type="submit" value="Simpan" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
</div>
</div>
<script>
    var passwordNode = document.getElementById("password");
    var tombolPassNode = document.getElementById("tombolPass");
    var passwordUlangNode = document.getElementById("ulang_pass");
    var passUlangNode = document.getElementById("ulangPass");

    function proses(){
        if(tombolPassNode.className == "fas fa-eye"){
            passwordNode.type="text";
            tombolPassNode.className=tombolPassNode.className.replace(/\bfas fa-eye\b/g, "");
            var name = "fas fa-eye-slash";
            var arr = tombolPassNode.className.split("");
            if(arr.indexOf(name) == -1){
                tombolPassNode.className += "" + name;
            }
        }
        else{
            passwordNode.type="password";
            tombolPassNode.className=tombolPassNode.className.replace(/\bfas fa-eye-slash\b/g, "");
            var name = "fas fa-eye";
            var arr = tombolPassNode.className.split("");
            if(arr.indexOf(name) == -1){
                tombolPassNode.className += "" + name;
            }
        }
    }

        function prosesUlang(){
            if(passUlangNode.className == "fas fa-eye"){
                passwordUlangNode.type="text";
                passUlangNode.className=passUlangNode.className.replace(/\bfas fa-eye\b/g, "");
                var name = "fas fa-eye-slash";
                var arr = passUlangNode.className.split("");
                if(arr.indexOf(name) == -1){
                    passUlangNode.className += "" + name;
                }
            }
            else{
                passwordUlangNode.type="password";
                passUlangNode.className=passUlangNode.className.replace(/\bfas fa-eye-slash\b/g, "");
                var name = "fas fa-eye";
                var arr = passUlangNode.className.split("");
                if(arr.indexOf(name) == -1){
                    passUlangNode.className += "" + name;
                }
            }
        }

    tombolPassNode.addEventListener("click",proses);
    passUlangNode.addEventListener("click",prosesUlang);
</script>