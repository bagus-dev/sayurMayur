<!-- Login-Box -->
<a href="<?= base_url(); ?>">
    <h1 class="text-dark" align="center">Sayur<small class="text-danger">Mayur</small></h1>
</a>
<div class="login-box mx-auto">
    <div class="row">
        <div class="col-md-12">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>
    <div class="card shadows">
        <!-- Card-Body -->
        <div class="card-body login-card-body">
            <p class="login-box-msg">Masuk untuk memulai session</p>

            <form action="" method="post">
                <!-- Username -->
                <div class="input-group">
                    <input type="text" class="form-control b-left" placeholder="Username" name="username" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('username', '<small class="text-danger">', '</small>'); ?>

                <!-- Password -->
                <div class="input-group mt-3">
                    <input type="password" class="form-control b-left" placeholder="Password" name="password" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('password', '<small class="text-danger">', '</small>'); ?>

                <!-- Button -->
                <div class="row mt-3">
                    <div class="col-4">
                        <button type="button" id="btn-register" class="btn btn-primary btn-block">
                            Daftar
                        </button>
                    </div>
                    <div class="offset-4 col-4">
                        <button type="submit" class="btn btn-default btn-block">
                            Masuk
                        </button>
                    </div>
                </div>
            </form>

            <p class="mt-3 mb-1">
                <a href="auth_forgot_password.html">I forgot my password</a>
            </p>
        </div>
        <!-- End-Card-Body -->
    </div>
</div>
<!-- End-Login-Box -->