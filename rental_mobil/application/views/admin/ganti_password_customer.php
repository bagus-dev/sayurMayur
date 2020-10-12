<div class="page-header">
    <h3>Ganti Password Customer</h3>
</div>
<?php foreach($customer as $c){ ?>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li>
        <a href="<?php echo base_url().'admin/customer'; ?>">Lihat Data Customer</a>
    </li>
    <li>
        <a href="<?php echo base_url().'admin/customer_edit/'.$c->customer_id; ?>">Edit Customer</a>
    </li>
    <li class="active">
        Ganti Password Customer
    </li>
</ol>
<?php
    }
    if(isset($_GET["pesan"])){
        if($_GET["pesan"] == "gagal"){
            echo "<div class='alert alert-danger'>Password Sekarang tidak cocok.</div>";
        }
    }
?>
<?php foreach($customer as $c){ ?>
<div class="panel panel-green">
    <div class="panel-heading">
        <h3 class="panel-title">
            <span class="glyphicon glyphicon-lock"></span>
            Ganti Password Customer
        </h3>
    </div>
    <div class="panel-body">
        <form action="<?php echo base_url().'admin/password_customer_update'; ?>" method="post">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a href="<?php echo base_url().'admin/customer_edit/'.$c->customer_id; ?>">Edit Data</a>
                </li>
                <li class="nav-item active">
                    <a href="#" class="nav-link">Ganti Password</a>
                </li>
            </ul>
            <br>
            <div class="form-group">
                <label>Password Sekarang</label>
                <input type="password" name="pass" class="form-control" id="password" style="<?php if(form_error('pass') != ''){echo'border:2px solid red'; } ?>" value="<?php if(isset($password)){echo $password["pass_sekarang"]; } ?>">
                <input type="hidden" name="id" value="<?php echo $c->customer_id; ?>">
                <input type="hidden" name="nama" value="<?php echo $c->nama; ?>">
                <i class="fas fa-eye" id="tombolPass"></i>
                <?php echo form_error("pass"); ?>
            </div>
            <div class="form-group">
                <label>Password Baru</label>
                <input type="password" name="pass_baru" class="form-control" id="pass_baru" style="<?php if(form_error('pass_baru') != ''){echo'border:2px solid red'; } ?>" value="<?php if(isset($password)){echo $password["pass_baru"]; } ?>">
                <i class="fas fa-eye" id="passBaru"></i>
                <?php echo form_error("pass_baru"); ?>
            </div>
            <div class="form-group">
                <label>Ulangi Password Baru</label>
                <input type="password" name="ulang_pass" class="form-control" id="ulang_pass" style="<?php if(form_error('ulang_pass') != ''){echo'border:2px solid red'; } ?>" value="<?php if(isset($password)){echo $password["ulang_pass"]; } ?>">
                <i class="fas fa-eye" id="ulangPass"></i>
                <?php echo form_error("ulang_pass"); ?>
            </div>
            <div class="form-group">
                <input type="submit" value="Simpan Password Baru" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>
<?php } ?>
</div></div>
<script>
    var passwordNode = document.getElementById("password");
    var tombolPassNode = document.getElementById("tombolPass");
    var passwordBaruNode = document.getElementById("pass_baru");
    var passBaruNode = document.getElementById("passBaru");
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

    function prosesBaru(){
        if(passBaruNode.className == "fas fa-eye"){
            passwordBaruNode.type="text";
            passBaruNode.className=passBaruNode.className.replace(/\bfas fa-eye\b/g, "");
            var name = "fas fa-eye-slash";
            var arr = passBaruNode.className.split("");
            if(arr.indexOf(name) == -1){
                passBaruNode.className += "" + name;
            }
        }
        else{
            passwordBaruNode.type="password";
            passBaruNode.className=passBaruNode.className.replace(/\bfas fa-eye-slash\b/g, "");
            var name = "fas fa-eye";
            var arr = passBaruNode.className.split("");
            if(arr.indexOf(name) == -1){
                passBaruNode.className += "" + name;
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
    passBaruNode.addEventListener("click",prosesBaru);
    passUlangNode.addEventListener("click",prosesUlang);
</script>