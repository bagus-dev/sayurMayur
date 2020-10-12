<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Aplikasi Rental Mobil Berbasis Web</title>
    <script src="<?php echo base_url().'assets/js/jquery.js'; ?>"></script>
    <script src="<?php echo base_url().'assets/js/bootstrap.min.js'; ?>"></script>
    <style type="text/css">
        #loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background-color: #fff;
            background-size: cover;
        }
        #loader {
            display: block;
            position: relative;
            left: 50%;
            top: 50%;
            width: 150px;
            height: 150px;
            margin: -75px 0 0 -75px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #3498db;
            -webkit-animation: spin 2s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
            animation: spin 2s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
        }
        
        #loader:before {
            content: "";
            position: absolute;
            top: 5px;
            left: 5px;
            right: 5px;
            bottom: 5px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #e74c3c;
            -webkit-animation: spin 3s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
            animation: spin 3s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
        }
        
        #loader:after {
            content: "";
            position: absolute;
            top: 15px;
            left: 15px;
            right: 15px;
            bottom: 15px;
            border-radius: 50%;
            border: 3px solid transparent;
            border-top-color: #f9c922;
            -webkit-animation: spin 1.5s linear infinite; /* Chrome, Opera 15+, Safari 5+ */
            animation: spin 1.5s linear infinite; /* Chrome, Firefox 16+, IE 10+, Opera */
        }
        
        @-webkit-keyframes spin {
            0%   {
                -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(0deg);  /* IE 9 */
                transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
            }
            100% {
                -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(360deg);  /* IE 9 */
                transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
            }
        }
        @keyframes spin {
            0%   {
                -webkit-transform: rotate(0deg);  /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(0deg);  /* IE 9 */
                transform: rotate(0deg);  /* Firefox 16+, IE 10+, Opera */
            }
            100% {
                -webkit-transform: rotate(360deg);  /* Chrome, Opera 15+, Safari 3.1+ */
                -ms-transform: rotate(360deg);  /* IE 9 */
                transform: rotate(360deg);  /* Firefox 16+, IE 10+, Opera */
            }
        }
        .alert-danger{
            color:#a94442;
            background-color:#f2dede;
            border-color:#ebccd1;
            width: 400px;
            margin-top: 60px;
            margin-left: 40px;
        }
        .alert-success{
            color:#3c763d;
            background-color:#dff0d8;
            border-color:#d6e9c6;
            width: 400px;
            margin-top: 60px;
            margin-left: 40px;
        }
        .alert{padding:15px;margin-bottom:20px;border:1px solid transparent;border-radius:4px}
        body{
            background: url(<?php echo base_url()."assets/images/form-bg.jpg"; ?>) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            font-family:'HelveticaNeue','Arial', sans-serif;

        }
        a{color:#58bff6;text-decoration: none;}
        a:hover{color:#aaa; }
        .pull-right{float: right;}
        .pull-left{float: left;}
        .clear-fix{clear:both;}
        div.logo{
            text-align: center;
            margin: 20px 20px 30px 20px;
            color: #999999;
            fill: #566375;
            font-size: 30px;
            font-weight: bold;
        }
        div.logo svg{
            width:180px;
            height:100px;
        }
        .logo-active{
            color: skyblue !important;
        }
        #formWrapper{
            background: rgba(0,0,0,.2); 
            width:100%; 
            height:100%; 
            position: absolute; 
            top:0; 
            left:0;
            transition:all .3s ease;}
        .darken-bg{background: rgba(0,0,0,.5) !important; transition:all .3s ease;}

        div#form{
            position: absolute;
            width:360px;
            height:320px;
            height:auto;
            background-color: #fff;
            margin:auto;
            border-radius: 5px;
            padding:20px;
            left:50%;
            top:50%;
            margin-left:-180px;
            margin-top:-200px;
        }
        div.form-item{position: relative; display: block; margin-bottom: 20px;}
        input{transition: all .2s ease;}
        input.form-style{
            color:#8a8a8a;
            display: block;
            width: 90%;
            height: 44px;
            padding: 5px 5%;
            border:1px solid #ccc;
            -moz-border-radius: 27px;
            -webkit-border-radius: 27px;
            border-radius: 27px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            background-color: #fff;
            font-family:'HelveticaNeue','Arial', sans-serif;
            font-size: 105%;
            letter-spacing: .8px;
        }
        div.form-item .form-style:focus{outline: none; border:1px solid #58bff6; color:#58bff6; }
        div.form-item p.formLabel {
            position: absolute;
            left:26px;
            top:2px;
            transition:all .4s ease;
            color:#bbb;}
        .formTop{top:-22px !important; left:26px; background-color: #fff; padding:0 5px; font-size: 14px; color:#58bff6 !important;}
        .formStatus{color:#8a8a8a !important;}
        input[type="submit"].login{
            float:right;
            width: 112px;
            height: 37px;
            -moz-border-radius: 19px;
            -webkit-border-radius: 19px;
            border-radius: 19px;
            -moz-background-clip: padding;
            -webkit-background-clip: padding-box;
            background-clip: padding-box;
            background-color: #55b1df;
            border:1px solid #55b1df;
            border:none;
            color: #fff;
            font-weight: bold;
        }
        input[type="submit"].login:hover{background-color: #fff; border:1px solid #55b1df; color:#55b1df; cursor:pointer;}
        input[type="submit"].login:focus{outline: none;}
    </style>
</head>
<body>
    <div id="loader-wrapper">
        <div id="loader"></div>
    </div>
        <?php
            if(isset($_GET["pesan"])){
                if($_GET["pesan"] == "gagal"){
                    echo "<center><div class = 'alert alert-danger'>Login Gagal! Username dan/atau Password salah.</div></center>";
                }
                elseif($_GET["pesan"] == "logout"){
                    echo "<center><div class ='alert alert-danger'>Anda telah Logout.</div></center>";
                }
                elseif($_GET["pesan"] == "belumlogin"){
                    echo "<center><div class ='alert alert-success'>Silakan Login dulu.</div></center>";
                }
                elseif($_GET["pesan"] == "berhasil"){
                    echo "<center><div class='alert alert-success'>Profil berhasil diganti, silakan Login kembali.</div></center>";
                }
                elseif($_GET["pesan"] == "berhasil_pass"){
                    echo "<center><div class='alert alert-success'>Password Profil berhasil diganti, silakan Login kembali.</div></center>";
                }
            }
        ?>
    <div id="formWrapper">
        <div id="form">
            <div class="logo">
                RENTAL MOBIL
            </div>
            <form action="<?php echo base_url().'welcome/login'; ?>" method="post">
                <div class="form-item">
                    <p class="formLabel">Username</p>
                    <input type="text" name="username" id="username" class="form-style" autocomplete="off">
                    <?php echo form_error("username"); ?>
                </div>
                <div class="form-item">
                    <p class="formLabel">Password</p>
                    <input type="password" name="password" id="password" class="form-style">
                    <?php echo form_error("password"); ?>
                </div>
                <div class="form-item">
                    <input type="submit" value="Login" class="login pull-right">
                    <div class="clear-fix"></div>
                </div>
            </form>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $("#loader-wrapper").fadeOut();
        })
    </script>
    <script src="<?php echo base_url().'assets/js/index.js'; ?>"></script>
</body>
</html>