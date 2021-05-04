<!--Header Breadcrumb-->
<html style="overflow-x: hidden !important;">
<div class="row m-0">
    <div class="col-md-4 p-0">
        <h4>Tambah Kandidat</h4>
    </div>
    <div class="col-md-6 offset-md-2 d-flex justify-content-md-end p-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb admin-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item"><a href="<?= base_url('admin/kandidat') ?>">Kandidat</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tambah Kandidat</li>
            </ol>
        </nav>
    </div>
</div>
<hr class="mt-0">

<!--Button-->
<div class="btn-wrap d-flex">
    <a href="<?= base_url('admin/kandidat') ?>" class="btn btn-secondary mr-2"><i class="fas fa-arrow-left"></i> <span class="d-none d-sm-inline-block"> Kembali</span></a>
    <a href="<?= base_url('admin/kandidat/tambah') ?>" class="btn btn-primary mr-2"><i class="fas fa-sync-alt"></i> <span class="d-none d-sm-inline-block"> Refresh</span></a>
</div>

<?php
//Alert untuk error
if ($message) { ?>
    <div class="alert alert-danger mt-3 mb-2">
        <?= $message ?>
        <button type="button" class="close close-alert" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
} elseif ($validation) { ?>
    <div class="alert alert-danger mt-3 mb-2">
        <?= $validation->listErrors() ?>
        <button type="button" class="close close-alert" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php
}
?>

<!--Form Kandidat-->
<?= form_open(base_url('admin/kandidat/tambah/simpan'), 'enctype="multipart/form-data"') ?>
<div class="row mt-3">
    <div class="col-lg-4 col-sm-12 mb-3">
        <div class="card card-form-kandidat border-danger">
            <div class="card-header text-center">
                <p class="mb-0"><b>Umum</b></p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nomor Urut</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-list-ol"></i></span>
                        </div>
                        <select name="no_urut" class="form-control">
                            <option selected disabled>Pilih Nomor Urut</option>
                            <?php
                            for ($i = 1; $i <= 5; $i++) {
                                echo "<option value='$i' " . set_select('no_urut', $i) . ">$i</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Nama Pasangan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-friends"></i></span>
                        </div>
                        <input type="text" name="pasangan" class="form-control" placeholder="Contoh : Wayan - Made" value="<?= set_value('pasangan') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Jabatan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user-tie"></i></span>
                        </div>
                        <select name="jabatan" class="form-control">
                            <option selected disabled>Pilih Jabatan</option>
                            <option value="Calon Ketua OSIS - Calon Wakil Ketua OSIS" <?= set_select('jabatan', 'Calon Ketua OSIS - Calon Wakil Ketua OSIS') ?>>Calon Ketua OSIS - Calon Wakil Ketua OSIS</option>
                            <option value="Calon Ketua MPK - Calon Wakil Ketua MPK" <?= set_select('jabatan', 'Calon Ketua MPK - Calon Wakil Ketua MPK') ?>>Calon Ketua MPK - Calon Wakil Ketua MPK</option>
                            <option value="Calon Ketua PKS - Calon Wakil Ketua PKS" <?= set_select('jabatan', 'Calon Ketua PKS - Calon Wakil Ketua PKS') ?>>Calon Ketua PKS - Calon Wakil Ketua PKS</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 mb-3">
        <div class="card card-form-kandidat border-warning">
            <div class="card-header text-center">
                <p class="mb-0"><b>Formulir Calon</b></p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Calon</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="nm_calon" class="form-control" placeholder="Nama Lengkap" value="<?= set_value('nm_calon') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-book"></i></span>
                        </div>
                        <select name="kls_calon" class="form-control">
                            <option selected disabled>Pilih Kelas</option>
                            <?php
                            foreach ($kelas as $kls) {
                                $value = $kls->kelas_id;
                                $nama = $kls->tingkat . " " . $kls->nama_kelas;
                                echo "<option value='$value' " . set_select('kls_calon', $value) . ">$nama</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="preview-foto-kandidat text-center mb-3">
                        <img class="img-fluid img-kandidat" id="imgCalon" src="<?= base_url('assets/images/kandidat/noimage.png') ?>">
                    </div>
                    <label for="fotoCalon" class="btn btn-outline-dark">Pilih Foto</label>
                    <br>
                    <small>Masukkan foto dengan aspect ratio 3:4</small>
                    <input type="file" name="foto_calon" id="fotoCalon" style="display:none;">
                </div>
                <script>
                    var file = document.getElementById('fotoCalon');
                    file.addEventListener('change', function() {
                        fotoCalon(this);
                    });

                    function fotoCalon(a) {
                        if (a.files && a.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('imgCalon').src = e.target.result;
                            }
                            reader.readAsDataURL(a.files[0]);
                        }
                    }
                </script>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-sm-6 mb-3">
        <div class="card card-form-kandidat border-success">
            <div class="card-header text-center">
                <p class="mb-0"><b>Formulir Calon Wakil</b></p>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nama Calon Wakil</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="nm_calon_wakil" class="form-control" placeholder="Nama Lengkap" value="<?= set_value('nm_calon_wakil') ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label>Kelas</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><i class="fas fa-address-book"></i></span>
                        </div>
                        <select name="kls_calon_wakil" class="form-control">
                            <option selected="true" disabled>Pilih Kelas</option>
                            <?php
                            foreach ($kelas as $kls) {
                                $value = $kls->kelas_id;
                                $nama = $kls->tingkat . " " . $kls->nama_kelas;
                                echo "<option value='$value' " . set_select('kls_calon_wakil', $value) . ">$nama</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="preview-foto-kandidat text-center mb-3">
                        <img class="img-fluid img-kandidat" id="imgCalonWakil" src="<?= base_url('assets/images/kandidat/noimage.png') ?>">
                    </div>
                    <label for="fotoCalonWakil" class="btn btn-outline-dark">Pilih Foto</label>
                    <br>
                    <small>Masukkan foto dengan aspect ratio 3:4</small>
                    <input type="file" name="foto_calon_wakil" id="fotoCalonWakil" style="display:none;">
                </div>
                <script>
                    var file = document.getElementById('fotoCalonWakil');
                    file.addEventListener('change', function() {
                        fotoCalonWakil(this);
                    });

                    function fotoCalonWakil(a) {
                        if (a.files && a.files[0]) {
                            var reader = new FileReader();
                            reader.onload = function(e) {
                                document.getElementById('imgCalonWakil').src = e.target.result;
                            }
                            reader.readAsDataURL(a.files[0]);
                        }
                    }
                </script>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-sm-12">
        <div class="card card-form-kandidat border-info" style="min-height: auto !important;">
            <div class="card-header text-center">
                <p class="mb-0"><b>Visi & Misi</b></p>
            </div>
            <div class="card-body">
                <div class="row m-0">
                    <div class="col-md-6 text-center">
                        <label>Visi Pasangan Calon</label>
                        <textarea name="visi" class="form-control form-textarea" id="formVisi"><?= set_value('visi') ?></textarea>
                    </div>
                    <div class="col-md-6 text-center">
                        <label>Misi Pasangan Calon</label>
                        <textarea name="misi" class="form-control form-textarea" id="formMisi"><?= set_value('misi') ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<hr>

<div class="text-center">
    <small>Semua field form harus diisi.</small>
    <br>
    <button type="submit" class="btn btn-primary mt-2 btn-submit">Simpan Data</button>
</div>

</html>
<?= form_close(); ?>