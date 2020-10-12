<div class="page-header">
    <h3>Ganti Password</h3>
</div>
<ol class="breadcrumb">
    <li>
        <a href="<?php echo base_url().'admin'; ?>"><i class="fas fa-tachometer-alt"></i> Dasbor </a>
    </li>
    <li>
        <a href="<?php echo base_url().'admin/profil'; ?>">Lihat Profil</a>
    </li>
    <li class="active">
        Ganti Password
    </li>
</ol>
<div class="row">
    <div class="col-md-6 col-md-offset-3">
        <?php
            if(isset($_GET["pesan"])){
                if($_GET["pesan"] == "gagal"){
                    echo "<div class='alert alert-danger'>Password Sekarang tidak cocok.</div>";
                }
            }
        ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-lock"></span>
                    Ganti Password
                </h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo base_url().'admin/ganti_password_act'; ?>" method="post">
                    <div class="form-group">
                        <label>Password Sekarang</label>
                        <input type="password" name="pass_sekarang" class="form-control" id="password" style="<?php if(form_error('pass_sekarang') != ''){echo'border:2px solid red'; }elseif(isset($_GET['pesan'])){if($_GET['pesan'] == 'gagal'){echo'border:2px solid red;'; }} ?>" value="<?php if(isset($password)){echo $password["pass_sekarang"]; } ?>">
                        <i class="fas fa-eye" id="tombolPass"></i>
                        <?php echo form_error("pass_sekarang"); ?>
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
                        <input type="submit" class="btn btn-primary btn-sm" value = "Simpan">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
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