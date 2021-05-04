<?php
if (session()->getFlashdata('sukses')) { ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= session()->getFlashdata('sukses') ?>',
        });
    </script>
<?php
}

if (session()->getFlashdata('gagal')) { ?>
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: '<?= session()->getFlashdata('gagal') ?>',
        });
    </script>
<?php
}
?>

<div class="row m-0">
    <div class="col-md-4 p-0">
        <h4>Bilik Suara</h4>
    </div>
    <div class="col-md-6 offset-md-2 d-flex justify-content-md-end p-0">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb admin-breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="#">Pemilih</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bilik Suara</li>
            </ol>
        </nav>
    </div>
</div>
<hr class="mt-0">

<div class="col-12 col-lg-8 mx-auto p-0 mb-4" id="waktu">
    <div class="card">
        <div class="card-header text-center text-light" id="headerWaktu">
            <p class="mb-0" id="judulWaktu"></p>
        </div>
        <div class="row m-0">
            <div class="col-12 col-md-3 p-0">
                <div class="card mb-0 rounded-0">
                    <div class="card-body text-center">
                        <h2 class="mb-0" id="hari">0</h2>
                        <small>hari</small>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 p-0">
                <div class="card mb-0 rounded-0">
                    <div class="card-body text-center">
                        <h2 class="mb-0" id="jam">0</h2>
                        <small>jam</small>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 p-0">
                <div class="card mb-0 rounded-0">
                    <div class="card-body text-center">
                        <h2 class="mb-0" id="menit">0</h2>
                        <small>menit</small>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-3 p-0">
                <div class="card mb-0 rounded-0">
                    <div class="card-body text-center">
                        <h2 class="mb-0" id="detik">0</h2>
                        <small>detik</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
foreach ($pelaksanaan as $waktu) {
    $tanggal = $waktu->tanggal;
    $jam_mulai = $waktu->jam_mulai;
    $jam_selesai = $waktu->jam_selesai;

    $tgl_sekarang = date('Y-m-d');
    $jam_sekarang = date('H:i:s');
?>
    <script>
        $('document').ready(function() {
            function mulai() {
                var countDownMulai = new Date("<?php echo $tanggal . " " . $jam_mulai ?>").getTime();

                var jamMulai = setInterval(() => {
                    var sekarang = new Date().getTime();
                    var selisih = countDownMulai - sekarang;

                    var hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
                    var jam = Math.floor((selisih % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var menit = Math.floor((selisih % (1000 * 60 * 60)) / (1000 * 60));
                    var detik = Math.floor((selisih % (1000 * 60)) / 1000);

                    if (selisih < 0) {
                        $('#formPemilih').show();
                        $('#alertTimeout').hide();
                        clearInterval(jamMulai);
                        //$('#waktu').html('');
                        selesai();
                    } else {
                        $('#formPemilih').remove();
                        $('#judulWaktu').html('Pemilihan akan dimulai dalam : ');
                        $('#headerWaktu').addClass('bg-primary-gra');
                        $('#hari').html(hari);
                        $('#jam').html(jam);
                        $('#menit').html(menit);
                        $('#detik').html(detik);
                    }
                }, 1);
            }

            function selesai() {
                var countDownSelesai = new Date("<?= $tanggal . " " . $jam_selesai ?>").getTime();

                var jamSelesai = setInterval(() => {
                    var sekarang = new Date().getTime();
                    var selisih = countDownSelesai - sekarang;

                    var hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
                    var jam = Math.floor((selisih % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var menit = Math.floor((selisih % (1000 * 60 * 60)) / (1000 * 60));
                    var detik = Math.floor((selisih % (1000 * 60)) / 1000);

                    if (selisih < 0) {
                        $('#formPemilih').remove();
                        $('#alertTimeout').show();
                        $('#beforeAfterWaktuPemilihan').html('sudah selesai');
                        $('#waktu').html('');
                    } else {
                        $('#formPemilih').show();
                        $('#judulWaktu').html('Pemilihan akan berakhir dalam : ');
                        $('#headerWaktu').removeClass('bg-primary-gra');
                        $('#headerWaktu').addClass('bg-danger-gra');
                        $('#hari').html(hari);
                        $('#jam').html(jam);
                        $('#menit').html(menit);
                        $('#detik').html(detik);
                    }


                }, 1);
            }

            mulai();
        })
    </script>
<?php
}
?>

<div id="formPemilihWrap">
    <div id="formPemilih">
        <?php
        if (session()->logged_in && session()->level == "pemilih") {
        ?>
            <?php if (session()->status == "Belum Memilih") { ?>
                <form action="<?= base_url('pemilih/bilik_suara/pilih') ?>" name="form_pilih" id="formPilih" method="POST">
                    <div class="card card-form-kandidat border-dark">
                        <div class="card-body">

                            <!--Form osis-->
                            <div id="formOsis" class="form-pilih">
                                <fieldset>
                                    <div class="text-center">
                                        <h4>Pilih Kandidat OSIS</h4>
                                        <hr>
                                    </div>
                                    <div class="row justify-content-center mt-5">
                                        <?php
                                        if (!$osis) { ?>
                                            <p class="text-danger">Belum ada kandidat OSIS yang ditambahkan.</p>
                                            <?php
                                        } else {
                                            foreach ($osis as $o) { ?>
                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-10 mb-5 mb-lg-2">
                                                    <label class="w-100">
                                                        <input type="radio" name="osis" class="btn-input-radio-osis d-none" value="<?= $o->kandidat_id ?>">
                                                        <div class="card">
                                                            <div class="box-nomor-urut text-center bg-primary-gra">
                                                                <div class="circle-nomor-urut rounded-circle">
                                                                    <h2 class="text-dark mb-0"><?= $o->no_urut ?></h2>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="text-center">
                                                                    <div class="row mb-3">
                                                                        <div class="col-6 pr-0">
                                                                            <?php $img_c = $o->foto_calon ? $o->foto_calon : 'noimage.png' ?>
                                                                            <img src="<?= base_url('assets/images/kandidat/' . $img_c) ?>" class="img-fluid img-qc">
                                                                        </div>
                                                                        <div class="col-6 pl-0">
                                                                            <?php $img_cw = $o->foto_calon_wakil ? $o->foto_calon_wakil : 'noimage.png' ?>
                                                                            <img src="<?= base_url('assets/images/kandidat/' . $img_cw) ?>" class="img-fluid img-qc">
                                                                        </div>
                                                                    </div>
                                                                    <p><?= $o->pasangan ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer text-center">
                                                                <?php
                                                                $id = "data-id='" . $o->kandidat_id . "' ";
                                                                $no = "data-no='" . $o->no_urut . "' ";
                                                                $pasangan = "data-pasangan='" . $o->pasangan . "' ";
                                                                $jabatan = "data-jabatan='" . $o->jabatan . "' ";
                                                                $nm_ketua = "data-ketua='" . $o->nm_calon . "' ";
                                                                $nm_wakil = "data-wakil='" . $o->nm_calon_wakil . "' ";

                                                                foreach ($kelas as $kls) {
                                                                    if ($o->kls_calon == $kls->kelas_id) {
                                                                        $ketua = $kls->tingkat . ' ' . $kls->nama_kelas;
                                                                    }

                                                                    if ($o->kls_calon_wakil == $kls->kelas_id) {
                                                                        $wakil = $kls->tingkat . ' ' . $kls->nama_kelas;
                                                                    }
                                                                }

                                                                $kls_ketua = "data-kls-ketua='" . $ketua . "' ";
                                                                $kls_wakil = "data-kls-wakil='" . $wakil . "' ";
                                                                $img_ketua = "data-img-ketua='" . $img_c . "' ";
                                                                $img_wakil = "data-img-wakil='" . $img_cw . "' ";
                                                                $visi = "data-visi='" . $o->visi . "' ";
                                                                $misi = "data-misi='" . $o->misi . "' ";
                                                                ?>
                                                                <button type="button" class="btn btn-primary btn-detail" <?=
                                                                                                                            $id,
                                                                                                                            $no,
                                                                                                                            $pasangan,
                                                                                                                            $jabatan,
                                                                                                                            $nm_ketua,
                                                                                                                            $nm_wakil,
                                                                                                                            $kls_ketua,
                                                                                                                            $kls_wakil,
                                                                                                                            $img_ketua,
                                                                                                                            $img_wakil,
                                                                                                                            $visi,
                                                                                                                            $misi
                                                                                                                            ?>>
                                                                    <i class="fas fa-info-circle"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                        <div class="col-12">
                                            <div class="text-center">
                                                <button type="button" class="btn btn-warning text-light step-1"><span class="d-none d-sm-inline-block"> Selanjutnya</span> <i class="fas fa-angle-double-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <!--Form mpk-->
                            <div id="formMpk" class="form-pilih" style="display: none">
                                <fieldset>
                                    <div class="text-center">
                                        <h4>Pilih Kandidat MPK</h4>
                                        <hr>
                                    </div>
                                    <div class="row justify-content-center mt-5">
                                        <?php
                                        if (!$mpk) { ?>
                                            <p class="text-danger">Belum ada kandidat MPK yang ditambahkan.</p>
                                            <?php
                                        } else {
                                            foreach ($mpk as $m) { ?>
                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-10 mb-5 mb-lg-2">
                                                    <label class="w-100">
                                                        <input type="radio" name="mpk" class="btn-input-radio-osis d-none" value="<?= $m->kandidat_id ?>">
                                                        <div class="card">
                                                            <div class="box-nomor-urut text-center bg-primary-gra">
                                                                <div class="circle-nomor-urut rounded-circle">
                                                                    <h2 class="text-dark mb-0"><?= $m->no_urut ?></h2>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="text-center">
                                                                    <div class="row mb-3">
                                                                        <div class="col-6 pr-0">
                                                                            <?php $img_c = $m->foto_calon ? $m->foto_calon : 'noimage.png' ?>
                                                                            <img src="<?= base_url('assets/images/kandidat/' . $img_c) ?>" class="img-fluid img-qc">
                                                                        </div>
                                                                        <div class="col-6 pl-0">
                                                                            <?php $img_cw = $m->foto_calon_wakil ? $m->foto_calon_wakil : 'noimage.png' ?>
                                                                            <img src="<?= base_url('assets/images/kandidat/' . $img_cw) ?>" class="img-fluid img-qc">
                                                                        </div>
                                                                    </div>
                                                                    <p><?= $m->pasangan ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer text-center">
                                                                <?php
                                                                $id = "data-id='" . $m->kandidat_id . "' ";
                                                                $no = "data-no='" . $m->no_urut . "' ";
                                                                $pasangan = "data-pasangan='" . $m->pasangan . "' ";
                                                                $jabatan = "data-jabatan='" . $m->jabatan . "' ";
                                                                $nm_ketua = "data-ketua='" . $m->nm_calon . "' ";
                                                                $nm_wakil = "data-wakil='" . $m->nm_calon_wakil . "' ";

                                                                foreach ($kelas as $kls) {
                                                                    if ($m->kls_calon == $kls->kelas_id) {
                                                                        $ketua = $kls->tingkat . ' ' . $kls->nama_kelas;
                                                                    }

                                                                    if ($m->kls_calon_wakil == $kls->kelas_id) {
                                                                        $wakil = $kls->tingkat . ' ' . $kls->nama_kelas;
                                                                    }
                                                                }

                                                                $kls_ketua = "data-kls-ketua='" . $ketua . "' ";
                                                                $kls_wakil = "data-kls-wakil='" . $wakil . "' ";
                                                                $img_ketua = "data-img-ketua='" . $img_c . "' ";
                                                                $img_wakil = "data-img-wakil='" . $img_cw . "' ";
                                                                $visi = "data-visi='" . $m->visi . "' ";
                                                                $misi = "data-misi='" . $m->misi . "' ";
                                                                ?>
                                                                <button type="button" class="btn btn-primary btn-detail" <?=
                                                                                                                            $id,
                                                                                                                            $no,
                                                                                                                            $pasangan,
                                                                                                                            $jabatan,
                                                                                                                            $nm_ketua,
                                                                                                                            $nm_wakil,
                                                                                                                            $kls_ketua,
                                                                                                                            $kls_wakil,
                                                                                                                            $img_ketua,
                                                                                                                            $img_wakil,
                                                                                                                            $visi,
                                                                                                                            $misi
                                                                                                                            ?>>
                                                                    <i class="fas fa-info-circle"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 col-6 text-left">
                                            <button type="button" class="btn btn-danger text-light back-2"><i class="fas fa-angle-double-left"></i> <span class="d-none d-sm-inline-block"> Sebelumnya</span></button>
                                        </div>
                                        <div class="col-lg-3 col-6 text-right">
                                            <button type="button" class="btn btn-warning text-light step-2"><span class="d-none d-sm-inline-block">Selanjutnya </span> <i class="fas fa-angle-double-right"></i></button>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>

                            <!--Form pks-->
                            <div id="formPks" class="form-pilih" style="display: none">
                                <fieldset>
                                    <div class="text-center">
                                        <h4>Pilih Kandidat PKS</h4>
                                        <hr>
                                    </div>
                                    <div class="row justify-content-center mt-5">
                                        <?php
                                        if (!$pks) { ?>
                                            <p class="text-danger">Belum ada kandidat PKS yang ditambahkan.</p>
                                            <?php
                                            $disable = 'd-none';
                                        } else {
                                            foreach ($pks as $p) { ?>
                                                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-10 mb-5 mb-lg-2">
                                                    <label class="w-100">
                                                        <input type="radio" name="pks" class="btn-input-radio-osis d-none" value="<?= $p->kandidat_id ?>">
                                                        <div class="card">
                                                            <div class="box-nomor-urut text-center bg-primary-gra">
                                                                <div class="circle-nomor-urut rounded-circle">
                                                                    <h2 class="text-dark mb-0"><?= $p->no_urut ?></h2>
                                                                </div>
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="text-center">
                                                                    <div class="row mb-3">
                                                                        <div class="col-6 pr-0">
                                                                            <?php $img_c = $p->foto_calon ? $p->foto_calon : 'noimage.png' ?>
                                                                            <img src="<?= base_url('assets/images/kandidat/' . $img_c) ?>" class="img-fluid img-qc">
                                                                        </div>
                                                                        <div class="col-6 pl-0">
                                                                            <?php $img_cw = $p->foto_calon_wakil ? $p->foto_calon_wakil : 'noimage.png' ?>
                                                                            <img src="<?= base_url('assets/images/kandidat/' . $img_cw) ?>" class="img-fluid img-qc">
                                                                        </div>
                                                                    </div>
                                                                    <p><?= $p->pasangan ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer text-center">
                                                                <?php
                                                                $id = "data-id='" . $p->kandidat_id . "' ";
                                                                $no = "data-no='" . $p->no_urut . "' ";
                                                                $pasangan = "data-pasangan='" . $p->pasangan . "' ";
                                                                $jabatan = "data-jabatan='" . $p->jabatan . "' ";
                                                                $nm_ketua = "data-ketua='" . $p->nm_calon . "' ";
                                                                $nm_wakil = "data-wakil='" . $p->nm_calon_wakil . "' ";

                                                                foreach ($kelas as $kls) {
                                                                    if ($p->kls_calon == $kls->kelas_id) {
                                                                        $ketua = $kls->tingkat . ' ' . $kls->nama_kelas;
                                                                    }

                                                                    if ($p->kls_calon_wakil == $kls->kelas_id) {
                                                                        $wakil = $kls->tingkat . ' ' . $kls->nama_kelas;
                                                                    }
                                                                }

                                                                $kls_ketua = "data-kls-ketua='" . $ketua . "' ";
                                                                $kls_wakil = "data-kls-wakil='" . $wakil . "' ";
                                                                $img_ketua = "data-img-ketua='" . $img_c . "' ";
                                                                $img_wakil = "data-img-wakil='" . $img_cw . "' ";
                                                                $visi = "data-visi='" . $p->visi . "' ";
                                                                $misi = "data-misi='" . $p->misi . "' ";
                                                                ?>
                                                                <button type="button" class="btn btn-primary btn-detail" <?=
                                                                                                                            $id,
                                                                                                                            $no,
                                                                                                                            $pasangan,
                                                                                                                            $jabatan,
                                                                                                                            $nm_ketua,
                                                                                                                            $nm_wakil,
                                                                                                                            $kls_ketua,
                                                                                                                            $kls_wakil,
                                                                                                                            $img_ketua,
                                                                                                                            $img_wakil,
                                                                                                                            $visi,
                                                                                                                            $misi
                                                                                                                            ?>>
                                                                    <i class="fas fa-info-circle"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                        <?php
                                                $disable = "";
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-3 col-6 text-left">
                                            <button type="button" class="btn btn-danger text-light back-3"><i class="fas fa-angle-double-left"></i> <span class="d-none d-sm-inline-block"> Sebelumnya</span></button>
                                        </div>
                                        <div class="col-lg-3 col-6 text-right">
                                            <button type="button" class="btn btn-success text-light btn-pilih <?= $disable ?>"><span class="d-none d-sm-inline-block"> Konfirmasi Pilihan</span> <i class="fas fa-check-circle"></i></button>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modalPilih" tabindex="-1" role="dialog" aria-labelledby="modalPilihTitle" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalPilihTitle">Konfirmasi Pilihan Anda</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="<?= base_url('assets/images/cartoon/pilih.png') ?>" class="img-fluid">
                                    <p class="mb-0">Apakah sudah yakin dengan pilihan Anda?</p>
                                </div>
                                <div class="modal-footer">
                                    <input type="hidden" name="kandidat_id" class="kandidat-id">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary btn-submit">Ya, Saya Yakin</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            <?php
            } else {
            ?>
                <div class="row justify-content-center">
                    <div class="col-md-10 col-lg-8">
                        <div class="card">
                            <div class="box-nomor-urut bg-success-gra ml-5 mr-5 text-center text-light d-flex align-items-center justify-content-center">
                                <h5 class="mb-0">Pemberitahuan</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="col-sm-6 m-auto mb-3">
                                    <img src="<?= base_url('assets/images/cartoon/done.jpg') ?>" class="img-fluid">
                                </div>
                                <p class="mb-0">Anda sudah memilih.</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>
        <?php
        } else {
        ?>
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-8">
                    <div class="card">
                        <div class="box-nomor-urut bg-danger-gra ml-5 mr-5 text-center text-light d-flex align-items-center justify-content-center">
                            <h5 class="mb-0">Pemberitahuan</h5>
                        </div>
                        <div class="card-body text-center">
                            <div class="col-sm-6 m-auto mb-3">
                                <img src="<?= base_url('assets/images/cartoon/alert.jpg') ?>" class="img-fluid">
                            </div>
                            <p>Anda harus login terlebih dahulu atau login sebagai pemilih untuk melakukan pemilihan. Untuk login klik tombol di bawah ini. </p>
                            <a href="<?= base_url('login') ?>" class="btn btn-dark">Login</a>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>

    <div class="row justify-content-center" id="alertTimeout" style="display: none;">
        <div class="col-md-10 col-lg-8">
            <div class="card">
                <div class="box-nomor-urut bg-warning-gra ml-5 mr-5 text-center text-light d-flex align-items-center justify-content-center">
                    <h5 class="mb-0">Pemberitahuan</h5>
                </div>
                <div class="card-body text-center">
                    <div class="col-sm-6 m-auto mb-3">
                        <img src="<?= base_url('assets/images/cartoon/done.jpg') ?>" class="img-fluid">
                    </div>
                    <p class="mb-0">Waktu pemilihan <span id="beforeAfterWaktuPemilihan"></span></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $('document').ready(function() {
        const base_url = '<?= base_url() ?>';

        //form step
        $('.step-1').click(function() {
            $('.form-pilih').hide('fade');
            $('#formMpk').show('fade');
        });

        $('.back-2').click(function() {
            $('.form-pilih').hide('fade');
            $('#formOsis').show('fade');
        });

        $('.step-2').click(function() {
            $('.form-pilih').hide('fade');
            $('#formPks').show('fade');
        });

        $('.back-3').click(function() {
            $('.form-pilih').hide('fade');
            $('#formMpk').show('fade');
        });

        //detail kandidat
        $('.btn-detail').click(function() {
            const id = $(this).data('id');
            const no_urut = $(this).data('no');
            const pasangan = $(this).data('pasangan');
            const jabatan = $(this).data('jabatan');
            const nama_ketua = $(this).data('ketua');
            const nama_wakil = $(this).data('wakil');
            const kls_ketua = $(this).data('kls-ketua');
            const kls_wakil = $(this).data('kls-wakil');
            const img_ketua = $(this).data('img-ketua');
            const img_wakil = $(this).data('img-wakil');
            const visi = $(this).data('visi');
            const misi = $(this).data('misi');

            $('.detail-img-calon').attr('src', base_url + '/assets/images/kandidat/' + img_ketua);
            $('.detail-nama-calon').html(nama_ketua);
            $('.detail-kls-calon').html(kls_ketua);

            $('.detail-img-calon.wakil').attr('src', base_url + '/assets/images/kandidat/' + img_wakil);
            $('.detail-nama-calon-wakil').html(nama_wakil);
            $('.detail-kls-calon-wakil').html(kls_wakil);

            $('.detail-no-urut').html(no_urut);
            $('.detail-nama-pasangan').html(pasangan);
            $('.detail-jabatan').html(jabatan);
            $('.detail-visi').html(visi);
            $('.detail-misi').html(misi);

            $('#modalDetail').modal('show');
        })
    });
</script>