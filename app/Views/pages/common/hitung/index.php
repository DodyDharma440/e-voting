<!--Header Breadcrumb-->
<div class="row m-0">
    <div class="col-md-4 p-0">
        <h4>Quick Count</h4>
    </div>
    <div class="col-md-6 offset-md-2 d-flex justify-content-md-end p-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb admin-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#"><?= session()->level == "admin" ? "Admin" : "Pemilih" ?></a></li>
                <li class="breadcrumb-item active" aria-current="page">Quick Count</li>
            </ol>
        </nav>
    </div>
</div>
<hr class="mt-0">

<!--<div id="waktuPemilihan">
    <div class="row m-0 justify-content-center mb-3">
        <div class="col-md-4 col-sm-6 col-xs-9">
            <div class="card">
                <div class="card-header text-center">
                    Waktu Pemilihan Berakhir
                </div>
                <div class="card-body text-center">
                    <h4></h4>
                </div>
            </div>
        </div>
    </div>
</div>-->

<div id="quickCount" class="mt-4">
    <div class="card card-hitung border-success mb-5">
        <div class="box-qc-head bg-success-gra text-light">
            <h3 class="mb-0"><strong>OSIS</strong></h3>
        </div>
        <div class="card-body">
            <div class="row m-0 justify-content-center">
                <?php
                if (!$osis) { ?>
                    <p>Belum ada kandidat OSIS yang ditambahkan. <a href="<?= base_url('admin/kandidat/tambah') ?>" class="btn btn-success pt-0 pb-0">Tambah Kandidat</a></p>
                    <?php
                } else {
                    foreach ($osis as $o) : ?>
                        <div class="col-lg-4 col-md-6 col-sm-7 col-xs-7 mb-3">
                            <div class="card">
                                <div class="card-header text-center text-light">
                                    <div class="text-center">
                                        <div class="rounded-circle bg-dark no-urut-wrap text-light">
                                            <h1 class="mb-0"><?= $o->no_urut ?></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row m-0">
                                        <div class="col-6 text-right">
                                            <?php $img = $o->foto_calon ? $o->foto_calon : 'noimage.png' ?>
                                            <img src="<?= base_url('assets/images/kandidat/' . $img) ?>" class="img-fluid img-kandidat-qc">
                                        </div>
                                        <div class="col-6 text-left">
                                            <?php $img = $o->foto_calon_wakil ? $o->foto_calon_wakil : 'noimage.png' ?>
                                            <img src="<?= base_url('assets/images/kandidat/' . $img) ?>" class="img-fluid img-kandidat-qc">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <h5 class="mt-3"><?= $o->pasangan ?></h5>
                                        <hr>
                                        <h4 class="text-primary"><b><?= $o->suara ?> Suara</b></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                }
                ?>
            </div>
        </div>
    </div>

    <div class="card card-hitung border-warning mb-5">
        <div class="box-qc-head bg-warning-gra text-light">
            <h3 class="mb-0"><strong>MPK</strong></h3>
        </div>
        <div class="card-body">
            <div class="row m-0 justify-content-center">
                <?php
                if (!$mpk) { ?>
                    <p>Belum ada kandidat MPK yang ditambahkan. <a href="<?= base_url('admin/kandidat/tambah') ?>" class="btn btn-warning pt-0 pb-0">Tambah Kandidat</a></p>
                    <?php
                } else {
                    foreach ($mpk as $m) : ?>
                        <div class="col-lg-4 col-md-6 col-sm-7 col-xs-10 mb-3">
                            <div class="card">
                                <div class="card-header text-center text-light">
                                    <div class="text-center">
                                        <div class="rounded-circle bg-dark no-urut-wrap text-light">
                                            <h1 class="mb-0"><?= $m->no_urut ?></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row m-0">
                                        <div class="col-6 text-right">
                                            <?php $img = $m->foto_calon ? $m->foto_calon : 'noimage.png' ?>
                                            <img src="<?= base_url('assets/images/kandidat/' . $img) ?>" class="img-fluid img-kandidat-qc">
                                        </div>
                                        <div class="col-6 text-left">
                                            <?php $img = $m->foto_calon_wakil ? $m->foto_calon_wakil : 'noimage.png' ?>
                                            <img src="<?= base_url('assets/images/kandidat/' . $img) ?>" class="img-fluid img-kandidat-qc">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <h5 class="mt-3"><?= $m->pasangan ?></h5>
                                        <hr>
                                        <h4 class="text-primary"><b><?= $m->suara ?> Suara</b></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                } ?>
            </div>
        </div>
    </div>

    <div class="card card-hitung border-danger mb-5">
        <div class="box-qc-head bg-danger-gra text-light">
            <h3 class="mb-0"><strong>PKS</strong></h3>
        </div>
        <div class="card-body">
            <div class="row m-0 justify-content-center">
                <?php
                if (!$pks) { ?>
                    <p>Belum ada kandidat PKS yang ditambahkan. <a href="<?= base_url('admin/kandidat/tambah') ?>" class="btn btn-danger pt-0 pb-0">Tambah Kandidat</a></p>
                    <?php
                } else {
                    foreach ($pks as $p) : ?>
                        <div class="col-lg-4 col-md-6 col-sm-7 col-xs-7 mb-3">
                            <div class="card">
                                <div class="card-header text-center text-light">
                                    <div class="text-center">
                                        <div class="rounded-circle bg-dark no-urut-wrap text-light">
                                            <h1 class="mb-0"><?= $p->no_urut ?></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row m-0">
                                        <div class="col-6 text-right">
                                            <?php $img = $p->foto_calon ? $p->foto_calon : 'noimage.png' ?>
                                            <img src="<?= base_url('assets/images/kandidat/' . $img) ?>" class="img-fluid img-kandidat-qc">
                                        </div>
                                        <div class="col-6 text-left">
                                            <?php $img = $p->foto_calon_wakil ? $p->foto_calon_wakil : 'noimage.png' ?>
                                            <img src="<?= base_url('assets/images/kandidat/' . $img) ?>" class="img-fluid img-kandidat-qc">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <h5 class="mt-3"><?= $p->pasangan ?></h5>
                                        <hr>
                                        <h4 class="text-primary"><b><?= $p->suara ?> Suara</b></h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    endforeach;
                } ?>
            </div>
        </div>
    </div>
</div>

<script>
    setInterval('quickCount()', 1000);

    function quickCount() {
        $('#quickCount').load(location.href + ' #quickCount');
    }

    /*    setInterval('waktuPemilihan()', 1000);
        function waktuPemilihan() {
            $('#waktuPemilihan').load(location.href + ' #waktuPemilihan');
        }*/
</script>