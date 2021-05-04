<!--Header Breadcrumb-->
<div class="row m-0">
    <div class="col-md-4 p-0">
        <h4>Edit Profil</h4>
    </div>
    <div class="col-md-6 offset-md-2 d-flex justify-content-md-end p-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb admin-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><?= session()->level == "admin" ? "Admin" : "Pemilih" ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Profil</li>
            </ol>
        </nav>
    </div>
</div>
<hr class="mt-0">

<div class="row m-0">
    <div class="col-12">
        <?php

        //Alert untuk berhasil
        if (session()->getFlashdata('sukses')) { ?>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil',
                    html: '<?= session()->getFlashdata('sukses') ?>'
                })
            </script>
        <?php
        }

        //Alert untuk error
        if ($validation) { ?>
            <div class="alert alert-danger mt-3 mb-2">
                <?= $validation->listErrors() ?>
                <button type="button" class="close close-alert" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php
        }
        ?>
    </div>
    <div class="col-3 pr-1">
        <div class="card">
            <div class="card-header bg-indigo text-light text-center">
                <p class="mb-0 d-none d-sm-block"><b>MENU</b></p>
                <span class="d-block d-sm-none"><i class="fas fa-caret-square-down"></i></span>
            </div>
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="list-group-item menu-profile text-center text-sm-left text-dark active" id="v-pills-profil-tab" data-toggle="pill" href="#v-pills-profil" role="tab" aria-controls="v-pills-profil" aria-selected="true">
                    <span class="d-none d-sm-block">Profil</span>
                    <span class="d-block d-sm-none"><i class="fas fa-user"></i></span>
                </a>
                <a class="list-group-item menu-profile text-center text-sm-left text-dark" id="v-pills-password-tab" data-toggle="pill" href="#v-pills-password" role="tab" aria-controls="v-pills-password" aria-selected="false">
                    <span class="d-none d-sm-block">Ganti Password</span>
                    <span class="d-block d-sm-none"><i class="fas fa-lock"></i></span>
                </a>
                <?php if (session()->level == "admin") { ?>
                    <a class="list-group-item menu-profile text-center text-sm-left text-dark" id="v-pills-hapus-tab" data-toggle="pill" href="#v-pills-hapus" role="tab" aria-controls="v-pills-hapus" aria-selected="false">
                        <span class="d-none d-sm-block">Hapus Akun</span>
                        <span class="d-block d-sm-none"><i class="fas fa-trash-alt"></i></span>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="col-9 pl-1">
        <div class="card card-edit-profile">
            <?php
            $session = session();
            ?>
            <div class="card-body">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-profil" role="tabpanel" aria-labelledby="v-pills-profil-tab">
                        <div class="row">
                            <div class="col-md-7">
                                <h4>Profil Anda</h4>
                                <hr>
                                <?= form_open(base_url($level . '/edit_profil/update')) ?>
                                <div class="form-group">
                                    <label>Username </label>
                                    <?php
                                    $data = [
                                        'type' => 'text',
                                        'name' => 'no_induk',
                                        'class' => 'form-control',
                                        'value' => $session->no_induk,
                                        'readonly' => session()->level == "pemilih" && true
                                    ];
                                    echo form_input($data);
                                    ?>
                                    <input type="hidden" name="no_induk_default" value="<?= $session->no_induk ?>">
                                </div>

                                <div class="form-group">
                                    <label>Nama </label>
                                    <?php
                                    $data = [
                                        'type' => 'text',
                                        'name' => 'nama',
                                        'class' => 'form-control',
                                        'value' => $session->nama
                                    ];
                                    echo form_input($data);
                                    ?>
                                </div>

                                <div class="form-group">
                                    <input type="hidden" name="user_id" value="<?= $session->user_id ?>">
                                    <button type="submit" class="btn btn-success btn-submit">Update Data</button>
                                </div>
                                <?= form_close() ?>
                            </div>
                            <div class="col-md-5 d-none d-md-block">
                                <img src="<?= base_url('assets/images/cartoon/editprofil.png') ?>" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab">
                        <div class="row">
                            <div class="col-md-7">
                                <h4>Ganti Password</h4>
                                <hr>
                                <div id="checkPassword">
                                    <form method="POST">
                                        <div class="form-group">
                                            <label>Password saat ini </label>
                                            <?php
                                            $data = [
                                                'type' => 'password',
                                                'name' => 'password_default',
                                                'class' => 'form-control password-default',
                                            ];
                                            echo form_input($data);
                                            ?>
                                            <input type="hidden" name="user_id" class="user-id" value="<?= $session->user_id ?>">
                                        </div>

                                        <div class="form-group">
                                            <button type="button" class="btn btn-success cek-password">Cek Password</button>
                                        </div>

                                        <div id="textErrorPassword"></div>
                                    </form>
                                </div>

                                <div id="formPassword"></div>
                            </div>
                            <div class="col-md-5 d-none d-md-block">
                                <img src="<?= base_url('assets/images/cartoon/editprofil.png') ?>" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <?php if (session()->level == "admin") { ?>
                        <div class="tab-pane fade" id="v-pills-hapus" role="tabpanel" aria-labelledby="v-pills-hapus-tab">
                            <div class="row">
                                <div class="col-md-7">
                                    <h4>Hapus Akun</h4>
                                    <hr>
                                    <?php
                                    if (count($user) <= 1) { ?>
                                        <p>Anda tidak bisa menghapus akun karena saat ini hanya ada 1 admin.</p>
                                    <?php
                                    } else { ?>
                                        <?= form_open(base_url('admin/edit_profil/hapus_akun')) ?>
                                        <p>Klik tombol dibawah untuk menghapus akun admin Anda. </p>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalHapusAkun">Hapus Akun</button>
                                        <div class="modal fade" id="modalHapusAkun" tabindex="-1" role="dialog" aria-labelledby="modalHapusAkunTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" idmodalHapusAkunTitle">Hapus Akun</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body text-center">
                                                        <p class="mb-0">Apakah Anda yakin untuk menghapus akun?</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="hidden" name="user_id" value="<?= $session->user_id ?>">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary btn-submit">Hapus Akun</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?= form_close() ?>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-md-5 d-none d-md-block">
                                    <img src="<?= base_url('assets/images/cartoon/editprofil.png') ?>" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('document').ready(function() {
        const base_url = "http://localhost/projects/evoting/public/";

        $('.cek-password').click(function() {
            $('.cek-password').html('<div class="loader rounded-circle m-auto loader loader-btn">');
            var id = $('.user-id').val();
            var password = $('.password-default').val();
            $.ajax({
                url: base_url + '<?= $level ?>/edit_profil/cek_password',
                method: 'POST',
                dataType: 'json',
                data: {
                    'user_id': id,
                    'password_default': password,
                },
                success: function(data) {
                    if (data) {
                        var html =
                            '<form action="' + base_url + '<?= $level ?>/edit_profil/password" method="POST">' +
                            '<div class="form-group">' +
                            '<label>Password Baru</label>' +
                            '<input type="password" name="new_password" class="form-control"/>' +
                            '</div>' +
                            '<div class="form-group">' +
                            '<label>Konfirmasi Password</label>' +
                            '<input type="password" name="re_password" class="form-control"/>' +
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
    });
</script>