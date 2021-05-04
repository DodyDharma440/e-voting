<html style="height: auto; overflow-x: hidden;">
<?= view("template/home/header"); ?>

<body class="main-page" data-spy="scroll" data-target="#navbarMainPage" data-offset="50">
    <div class="container-fluid pr-0 pl-0 container-main-page">
        <nav class="navbar navbar-expand-lg fixed-top p-lg-3 navbar-dark nav-main-page" id="navbarMainPage">
            <div class="container d-flex">
                <a class="navbar-brand" href="<?= base_url() ?>">
                    <img src="<?= base_url('assets/images/logo/logo.png') ?>" style="max-height: 35px;" />
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="border: 0px;">
                    <h2 class="text-light"><i class="fas fa-bars"></i></h2>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="<?= base_url() ?>">Home</a>
                        </li>
                        <?php
                        if ($title != "Ganti Password") {
                            if ($title != "Pemilih") {
                        ?>
                                <li class="nav-item">
                                    <a class="nav-link link-scroll" href="#qc">Quick Count</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link-scroll" href="#about">About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link-scroll" href="#kontak">Kontak</a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="nav-item">
                                    <a class="nav-link link-scroll" href="#cara">Cara Memilih</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link-scroll" href="#pilih">Pilih Kandidat</a>
                                </li>
                                <?php if (session()->get('level') == "pemilih") { ?>
                                    <li class="nav-item">
                                        <a class="nav-link link-scroll" data-toggle="modal" href="#modalPassword">Ganti Password</a>
                                    </li>
                                <?php
                                }
                                ?>
                        <?php
                            }
                        }
                        ?>

                        <li class="nav-item d-block d-lg-none">
                            <?php if (!session()->get('logged_in')) { ?>
                                <a href="<?= base_url('/login') ?>" class="btn btn-login-main btn-outline-light btn-block">Login</a>
                            <?php
                            } else { ?>
                                <a href="<?= base_url('/logout') ?>" class="btn btn-login-main btn-outline-light btn-block">Logout</a>
                            <?php
                            } ?>
                        </li>
                    </ul>
                </div>
                <div class="d-none d-lg-block">
                    <?php if (!session()->get('logged_in')) { ?>
                        <a href="<?= base_url("/login") ?>" class="btn btn-login-main btn-outline-light pr-4 pl-4">Login</a>
                    <?php
                    } else { ?>
                        <a href="<?= base_url("/logout") ?>" class="btn btn-login-main btn-outline-light pr-4 pl-4">Logout</a>
                    <?php
                    } ?>
                </div>
            </div>
        </nav>

        <div id="content">
            <?= view($content) ?>
        </div>
        <section class="section-footer bg-dark mt-5 text-light">
            <div class="text-right">
                <small><em>E-Voting SMK N 1 Manggis Copyright 2020</em></small>
            </div>
        </section>
    </div>

    <script>
        $('document').ready(function() {
            const base_url = "http://localhost/projects/evoting/";

            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 100) {
                    $('.nav-main-page').addClass('navbar-active');
                } else {
                    $('.nav-main-page').removeClass('navbar-active');
                }
            });

            $('.cek-password').click(function() {
                $('.cek-password').html('<div class="loader rounded-circle m-auto loader loader-btn">');
                var id = $('.user-id').val();
                var password = $('.password-default').val();
                $.ajax({
                    url: base_url + 'pemilih/cek_password',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        'user_id': id,
                        'password_default': password,
                    },
                    success: function(data) {
                        if (data) {
                            var html =
                                '<form action="' + base_url + 'pemilih/ganti_password" method="POST">' +
                                '<div class="form-group">' +
                                '<label>Password Baru</label>' +
                                '<div class="input-group mb-3">' +
                                '<div class="input-group-prepend">' +
                                '<span class="input-group-text"><i class="fas fa-lock"></i></span>' +
                                '</div>' +
                                '<input type="password" name="new_password" class="form-control"/>' +
                                '</div>' +
                                '</div>' +
                                '<div class="form-group">' +
                                '<label>Konfirmasi Password</label>' +
                                '<div class="input-group mb-3">' +
                                '<div class="input-group-prepend">' +
                                '<span class="input-group-text"><i class="fas fa-check-circle"></i></span>' +
                                '</div>' +
                                '<input type="password" name="re_password" class="form-control"/>' +
                                '</div>' +
                                '</div>' +
                                '<input type="hidden" name="user_id" value="' + id + '">' +
                                '<button type="submit" class="btn btn-success btn-submit">Ganti Password</button>' +
                                '</form>'
                            $('#checkPassword').html('');
                            $('#formPassword').html(html);
                        }
                    }
                }).fail(function() {
                    var html = '<p class="text-danger">Password salah! Silahkan coba lagi.</p>'
                    $('#textErrorPassword').html(html);
                    $('.cek-password').html('Cek Password');
                });
            });

            $('body').scrollspy({
                target: '#navbarMainPage',
                offset: 50
            });

            $('.link-scroll').click(function(e) {
                e.preventDefault;
                var hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 1000, function() {
                    window.location.hash = hash;
                });
            });

            $('.btn-ganti-pw').click(function() {
                $('#modalAlertPassword').modal('hide');
                $('#modalPassword').modal('show');
            });

            $('.btn-submit').click(function() {
                $('.btn-submit').html('<div class="loader rounded-circle m-auto loader loader-btn">');
            });
        });

        AOS.init();

        setInterval('jumlahSuara()', 1000);

        function jumlahSuara() {
            $('#cardQcContainer').load(location.href + ' #cardQcGroup');
        }
    </script>

    <?= view("template/home/footer"); ?>