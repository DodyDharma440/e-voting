<body class="login-form">
    <div class="container-fluid p-0 container-login">
        <div class="row w-100 m-0">
            <div class="col-sm-6 col-md-4 p-0 bg-light">
                <div class="container-form-login px-3 px-lg-5 py-4">
                    <a href="<?= base_url('login') ?>" class="navbar-brand text-dark">
                        <h1 class="mb-0"><strong>Login</strong></h1>
                    </a>
                    <hr />
                    <br />
                    <?php
                    if ($message || $validation) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $message ?>
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php
                    }
                    echo form_open(base_url('/login/auth'));
                    ?>
                    <div class="form-group mb-0">
                        <label>
                            <strong>
                                NIS/NIP/Username
                            </strong>
                            <!-- <i class="fas fa-user"></i> -->
                        </label>
                        <?php
                        $data = [
                            'type'      => 'text',
                            'name'      => 'no_induk',
                            'class'     => 'form-evoting',
                            'value'     => set_value('no_induk'),
                        ];
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="form-group mb-0">
                        <label>
                            <strong>
                                Password
                            </strong>
                            <!-- <i class="fas fa-lock"></i> -->
                        </label>
                        <?php
                        $data = [
                            'type'  => 'password',
                            'name'  => 'password',
                            'class' => 'form-evoting form-password',
                            'style' => 'flex: 1;'
                        ];
                        echo form_input($data);
                        ?>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" class="show-hide" /> Tampilkan Password
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-about btn-block btn-softblue btn-submit">Login</button>
                    </div>
                    <?php
                    echo form_close();
                    ?>
                </div>
                <div class="text-center login-text bottom">
                    <small class="text-secondary">Aplikasi Voting Sekolah SMK 2020</small>
                    <br>
                    <a class="text-danger" href="<?= base_url() ?>"><strong>Keluar</strong></a>
                </div>
            </div>
            <div class="col-sm-6 col-md-8 d-none d-sm-block p-0">
                <div class="login-image d-flex align-items-center justify-content-center flex-column text-light">
                    <img src="<?= base_url('assets/images/logo/logo.png') ?>" class="img-fluid" />
                    <h5>Sekolah SMK</h5>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('document').ready(function() {
            $('.show-hide').click(function() {
                if ($(this).is(':checked')) {
                    $('.form-password').attr('type', 'text');
                } else {
                    $('.form-password').attr('type', 'password');
                }
            })
        })
    </script>
</body>