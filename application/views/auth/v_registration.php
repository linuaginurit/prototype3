<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?= base_url('auth/registration') ?>" class="h1"><b><?= $title ?></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Register a new membership</p>

                <form class="user" action="<?= base_url('auth/registration') ?>" method="post">
                    <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="kode_satker" name="kode_satker" value="<?= set_value('kode_satker') ?>" placeholder="Kode Satker">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('password1', '<small class="text-danger">', '</small>') ?>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password1" name="password1" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <?= form_error('password2', '<small class="text-danger">', '</small>') ?>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="password2" name="password2" placeholder="Retype password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="<?= base_url('auth') ?>" class="text-center">I already have a membership</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->