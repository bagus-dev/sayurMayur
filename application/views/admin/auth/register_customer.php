<br><br><br><br>
<!-- Login-Box -->
<a href="<?= base_url(); ?>">
    <h1 class="text-dark mt-5" align="center">Sayur<small class="text-danger">Mayur</small></h1>
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
            <p class="login-box-msg">Isi form untuk mendaftar</p>

            <form action="" method="post">
                <!-- Nama Lengkap -->
                <div class="input-group">
                    <input type="text" class="form-control b-left" placeholder="Nama Lengkap" name="nama" autofocus/>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-users"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('nama', '<small class="text-danger">', '</small>'); ?>

                <!-- Alamat Lengkap -->
                <div class="input-group mt-3">
                    <textarea name="alamat" rows="3" class="form-control b-left" placeholder="Alamat Lengkap"></textarea>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-map-marked-alt"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>

                <!-- Kecamatan Tempat Tinggal -->
                <div class="input-group mt-3">
                    <select name="kecamatan" class="custom-select b-left">
                        <option value="0">Kecamatan Tempat Tinggal</option>
                        <?php
                            foreach($ongkir->result() as $o) {
                        ?>
                        <option value="<?= $o->ongkir_id; ?>"><?= $o->ongkir_lokasi; ?></option>
                        <?php } ?>
                    </select>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-home"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('kecamatan', '<small class="text-danger">', '</small>'); ?>

                <!-- No HP -->
                <div class="input-group mt-3">
                    <input type="number" class="form-control b-left" placeholder="Nomor HP" name="nohp" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-mobile-alt"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('nohp', '<small class="text-danger">', '</small>'); ?>

                <!-- Alamat Email -->
                <div class="input-group mt-3">
                    <input type="email" class="form-control b-left" placeholder="Alamat Email" name="email" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('email', '<small class="text-danger">', '</small>'); ?>

                <!-- Username -->
                <div class="input-group mt-3">
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

                <!-- Re-Password -->
                <div class="input-group mt-3">
                    <input type="password" class="form-control b-left" placeholder="Ulangi Password" name="repassword" />
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('repassword', '<small class="text-danger">', '</small>'); ?>

                <!-- Button -->
                <div class="row mt-3">
                    <div class="offset-7 col-5">
                        <button type="submit" class="btn btn-default btn-block">
                            Daftar Akun
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <!-- End-Card-Body -->
    </div>
</div>
<!-- End-Login-Box -->