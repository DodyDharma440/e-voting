<html style="overflow-x: hidden !important;">
<!--Header Breadcrumb-->
<div class="row m-0">
    <div class="col-md-4 p-0">
        <h4>Detail Kandidat</h4>
    </div>
    <div class="col-md-6 offset-md-2 d-flex justify-content-md-end p-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb admin-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/kandidat') ?>">Kandidat</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Kandidat</li>
            </ol>
        </nav>
    </div>
</div>
<hr class="mt-0">

<?php foreach ($kandidat as $id) {
    $kandidat_id = $id->kandidat_id;
    $pasangan = $id->pasangan;
} ?>
<div class="btn-wrap d-flex">
    <a href="<?= base_url('admin/kandidat') ?>" class="btn btn-secondary mr-2"><i class="fas fa-arrow-left"></i> <span class="d-none d-sm-inline-block"> Kembali</span></a>
    <a href="<?= base_url('admin/kandidat/detail/' . $kandidat_id) ?>" class="btn btn-primary mr-2"><i class="fas fa-sync-alt"></i> <span class="d-none d-sm-inline-block"> Refresh</span></a>

    <a href="<?= base_url('admin/kandidat/edit/' . $kandidat_id) ?>" class="btn btn-success mr-2 ml-auto"><i class="far fa-edit"></i> <span class="d-none d-sm-inline-block"> Edit</span></a>
    <button type="button" class="btn btn-danger btn-delete-kandidat" data-id="<?= $kandidat_id ?>" data-pasangan="<?= $pasangan ?>"><i class="far fa-trash-alt"></i> <span class="d-none d-sm-inline-block"> Hapus</span></button>
</div>

<!--Modal Hapus Kandidat-->
<div class="modal fade" id="modalHapusKandidat" tabindex="-1" role="dialog" aria-labelledby="HapusKandidat" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="HapusKandidat">Hapus Kandidat</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <p>Apakah Anda yakin untuk menghapus kandidat dengan nama pasangan <b><span class="nama-pasangan"></span></b> ?</p>
            </div>
            <div class="modal-footer">
                <?= form_open(base_url('admin/kandidat/hapus')) ?>
                <input type="hidden" class="kandidat-id" name="kandidat_id">
                <input type="hidden" class="pasangan" name="pasangan">
                <input type="hidden" class="foto-calon" name="foto_calon">
                <input type="hidden" class="foto-calon-wakil" name="foto_calon_wakil">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary btn-submit">Hapus</button>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</div>

<!--Detail Kandidat-->
<?php foreach ($kandidat as $rows) : ?>
    <div class="row mt-3">
        <div class="col-md-5 col-lg-4 mb-4">
            <div class="card card-form-kandidat border-warning" style="min-height: auto !important">
                <div class="card-header text-center">
                    <p class="mb-0"><b>Informasi Umum</b></p>
                </div>
                <div class="card-body text-center">
                    <label><b>Nomor Urut:</b></label>
                    <h3><?= $rows->no_urut ?></h3>
                    <hr>
                    <label><b>Nama Pasangan:</b></label>
                    <p><?= $rows->pasangan ?></p>
                    <hr>
                    <label><b>Jabatan:</b></label>
                    <p><?= $rows->jabatan ?></p>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-lg-8 mb-4">
            <div class="card card-form-kandidat border-success" style="min-height: auto !important">
                <div class="card-header text-center">
                    <p class="mb-0"><b>Detail</b></p>
                </div>
                <div class="card-body">
                    <nav>
                        <div class="nav nav-tabs" id="navDetailKandidat" role="tablist">
                            <a class="nav-item nav-link active" id="navPaslonTab" data-toggle="tab" href="#navPaslon" role="tab" aria-controls="navPaslon" aria-selected="true">Pasangan Calon</a>
                            <a class="nav-item nav-link" id="navVisiMisiTab" data-toggle="tab" href="#navVisiMisi" role="tab" aria-controls="navVisiMisi" aria-selected="false">Visi & Misi</a>
                        </div>
                    </nav>
                    <div class="tab-content" id="navKandidatContent">
                        <div class="tab-pane fade show active" id="navPaslon" role="tabpanel" aria-labelledby="navPaslonTab">
                            <div class="container pt-2 p-lg-4 text-center text-lg-left">
                                <div class="row m-0">
                                    <div class="col-lg-6 col-xs-6 mb-3 mb-lg-0">
                                        <div class="card">
                                            <div class="card-header">
                                                <p class="mb-0"><b>Calon</b></p>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <?php
                                                    $foto = $rows->foto_calon ? $rows->foto_calon : 'noimage.png';
                                                    ?>
                                                    <img src="<?= base_url('assets/images/kandidat/' . $foto) ?>" class="img-fluid img-detail-kandidat">
                                                </div>
                                                <div class="kandidat-detail-wrap pt-4">
                                                    <label><b>Nama Lengkap : </b></label>
                                                    <p class="mb-0"><?= $rows->nm_calon ?></p>
                                                    <hr>

                                                    <label><b>Kelas : </b></label>
                                                    <p class="mb-0">
                                                        <?php
                                                        foreach ($kelas as $kls) {
                                                            echo $rows->kls_calon == $kls->kelas_id ? $kls->tingkat . ' ' . $kls->nama_kelas : false;
                                                        }
                                                        ?>
                                                    </p>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xs-6 mb-3 mb-lg-0">
                                        <div class="card">
                                            <div class="card-header">
                                                <p class="mb-0"><b>Calon Wakil</b></p>
                                            </div>
                                            <div class="card-body">
                                                <div class="text-center">
                                                    <?php
                                                    $foto = $rows->foto_calon_wakil ? $rows->foto_calon_wakil : 'noimage.png';
                                                    ?>
                                                    <img src="<?= base_url('assets/images/kandidat/' . $foto) ?>" class="img-fluid img-detail-kandidat">
                                                </div>
                                                <div class="kandidat-detail-wrap pt-4">
                                                    <label><b>Nama Lengkap : </b></label>
                                                    <p class="mb-0"><?= $rows->nm_calon_wakil ?></p>
                                                    <hr>

                                                    <label><b>Kelas : </b></label>
                                                    <p class="mb-0">
                                                        <?php
                                                        foreach ($kelas as $kls) {
                                                            echo $rows->kls_calon_wakil == $kls->kelas_id ? $kls->tingkat . ' ' . $kls->nama_kelas : false;
                                                        }
                                                        ?>
                                                    </p>
                                                    <hr>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="navVisiMisi" role="tabpanel" aria-labelledby="navVisiMisiTab">
                            <div class="container p-lg-4">
                                <h5>Visi : </h5>
                                <div class="card mb-3">
                                    <div class="card-body pt-0 pb-0">
                                        <p><?= $rows->visi ?></p>
                                    </div>
                                </div>
                                <h5>Misi : </h5>
                                <div class="card mb-3">
                                    <div class="card-body pt-0 pb-0">
                                        <p><?= $rows->misi ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

</html>