<?php
if (session()->getFlashdata('sukses')) { ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: '<?= session()->getFlashdata('sukses') ?>',
        })
    </script>
<?php
}
?>

<section class="section-header" id="home">
    <div class="container pb-5 pb-lg-0">
        <div class="row justify-content-end">
            <div class="col-md-5">
                <h2 class="title-header"><strong>Pilih kandidat pilihanmu untuk menjadi ketua organisasi kesiswaan</strong></h2>
                <p class="subtitle-header">
                    Selamat datang di aplikasi pemilihan online berbasis web Evoting Sekolah SMK. Aplikasi ini
                    dibuat untuk memudahkan para siswa untuk melakukan pemilihan.
                </p>
                <div class="d-flex">
                    <a href="#qc" class="btn btn-header-main btn-light btn-lg m-1 link-scroll">Quick Count</a>
                    <a href="<?= base_url('/login') ?>" class="btn btn-header-main btn-outline-light btn-lg m-1 link-scroll">Login</a>
                </div>
            </div>
            <div class="col-md-6 d-none d-md-block">
                <img src="<?= base_url('assets/images/cartoon/vote.png') ?>" class="img-fluid" />
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ffffff" fill-opacity="1" d="M0,0L80,37.3C160,75,320,149,480,192C640,235,800,245,960,245.3C1120,245,1280,235,1360,229.3L1440,224L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
    </svg>
</section>

<section class="section-dashboard" style="padding-top: 0;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10 col-md-4 col-lg-3">
                <div class="text-center">
                    <div class="icon-homepage-dashboard d-flex align-items-center justify-content-center m-auto rounded-circle bg-info-gra text-light">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4 class="mt-3"><strong><?= count($jumlah_pemilih) ?></strong></h4>
                    <hr style="width: 20%; border: 0; height: 3px;" class="bg-info mt-1" />
                    <p>Jumlah semua pemilih yang terdiri dari siswa siswi serta guru dan pegawai.</p>
                </div>
            </div>
            <div class="col-10 col-md-4 col-lg-3">
                <div class="text-center">
                    <div class="icon-homepage-dashboard d-flex align-items-center justify-content-center m-auto rounded-circle bg-info-gra text-light">
                        <i class="fas fa-vote-yea"></i>
                    </div>
                    <h4 class="mt-3"><strong><?= count($sudah_memilih) ?></strong></h4>
                    <hr style="width: 20%; border: 0; height: 3px;" class="bg-info mt-1" />
                    <p>Jumlah pemilih yang sudah memilih atau sudah menggunakan hak suara.</p>
                </div>
            </div>
            <div class="col-10 col-md-4 col-lg-3">
                <div class="text-center">
                    <div class="icon-homepage-dashboard d-flex align-items-center justify-content-center m-auto rounded-circle bg-info-gra text-light">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h4 class="mt-3"><strong><?= count($kandidat) ?></strong></h4>
                    <hr style="width: 20%; border: 0; height: 3px;" class="bg-info mt-1" />
                    <p>Jumlah semua kandidat yang terdaftar untuk dapat dipilih oleh semua pemilih.</p>
                </div>
            </div>
            <div class="col-10 col-md-4 col-lg-3">
                <div class="text-center">
                    <div class="icon-homepage-dashboard d-flex align-items-center justify-content-center m-auto rounded-circle bg-info-gra text-light">
                        <i class="fas fa-school"></i>
                    </div>
                    <h4 class="mt-3"><strong><?= count($kelas) ?></strong></h4>
                    <hr style="width: 20%; border: 0; height: 3px;" class="bg-info mt-1" />
                    <p>Jumlah kelas yang ikut dalam pemilihan. Yang terdiri dari kelas X, XI, dan XII.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-page-section section-qc" id="qc">
    <div class="text-center">
        <h2><strong>Quick Count</strong></h2>
        <hr class="line-title">
    </div>
    <div class="container-slider-qc">
        <div class="slider-qc">
            <div id="cardQcContainer">
                <div id="cardQcGroup">
                    <?php foreach ($hasil_hitung as $hasil) { ?>
                        <div class="card">
                            <div class="box-nomor-urut text-center" style="background: #192428">
                                <div class="circle-nomor-urut rounded-circle">
                                    <h2 class="text-danger mb-0"><?= $hasil->no_urut ?></h2>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                    <div class="row mb-3">
                                        <div class="col-6 pr-0">
                                            <?php $img = $hasil->foto_calon ? $hasil->foto_calon : 'noimage.png' ?>
                                            <img src="<?= base_url('assets/images/kandidat/' . $img) ?>" class="img-fluid img-qc">
                                        </div>
                                        <div class="col-6 pl-0">
                                            <?php $img = $hasil->foto_calon_wakil ? $hasil->foto_calon_wakil : 'noimage.png' ?>
                                            <img src="<?= base_url('assets/images/kandidat/' . $img) ?>" class="img-fluid img-qc">
                                        </div>
                                    </div>
                                    <p class="mb-0"><strong><?= $hasil->pasangan ?></strong></p>
                                    <small><?= $hasil->jabatan ?></small>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <p class="mb-0 jumlah-suara"><strong><?= $hasil->suara ?> Suara</strong></p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#ffffff" fill-opacity="1" d="M0,0L80,37.3C160,75,320,149,480,192C640,235,800,245,960,245.3C1120,245,1280,235,1360,229.3L1440,224L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
    </svg> -->
</section>

<section class="main-page-section section-about" id="about">
    <div class="container">
        <div class="row justify-content-center pb-3">
            <div class="col-md-6 p-lg-4 mb-3 p-md-4 text-center d-none d-md-block" data-aos="fade-right" data-aos-duration="1000" data-aos-delay="500">
                <img src="<?= base_url('assets/images/cartoon/tentang.png') ?>" class="img-fluid">
            </div>
            <div class="col-md-6 p-lg-4 mb-3 p-md-4" data-aos="fade-left" data-aos-duration="1000" data-aos-delay="1000">
                <h4 class="title-item text-info"><strong>E - Voting</strong></h4>
                <p>
                    Website ini merupakan website untuk melakukan pemilihan ketua organisasi kesiswaan di Sekolah SMK.
                    Website ini dibuat oleh salah satu siswa TKJ di SMK N 1 Manggis.
                    Diharapkan web ini dapat membantu sekolah untuk melakukan pemilihan ketua osis secara
                    online atau daring.
                    <br />
                    Pemilihan ketua osis dilaksanakan dengan metode e-voting atau online karena dengan ini bisa menghemat biaya
                    properti untuk pemilihan seperti kotak suara, surat suara, tenaga, dll. Pengguna e-voting ini hanya perlu
                    menggunakan kuota internet agar dapat mengakses website. Tunggu apa lagi, ayo login lalu pilih kandidatmu sekarang juga!
                </p>
                <a href="<?= base_url('pemilih') ?>" class="btn btn-lg btn-info">Pilih Kandidat</a>
            </div>
        </div>
    </div>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
        <path fill="#192428" fill-opacity="1" d="M0,0L80,37.3C160,75,320,149,480,192C640,235,800,245,960,245.3C1120,245,1280,235,1360,229.3L1440,224L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
    </svg>
</section>

<section class="section-card-about">
    <div class="container container-card-about">
        <div class="row justify-content-center">
            <div class="col-md-6 p-lg-4 mb-3 p-md-4 text-center">
                <div class="row justify-content-center">
                    <div class="col-md-3 mb-3 mb-md-0 text-center">
                        <div class="icon-card-about rounded-circle bg-light text-info d-flex justify-content-center align-items-center m-auto">
                            <h1 class="mb-0"><i class="fas fa-users"></i></h1>
                        </div>
                    </div>
                    <div class="col-md-9 text-left">
                        <h5 class="text-info"><strong>Dibuat dari Siswa untuk Siswa</strong></h5>
                        <p class="text-light">
                            Dibuat oleh salah satu siswa di sekolah SMK. Latar belakang pembuatan website ini adalah untuk memudahkan
                            siswa beserta guru dan pegawai untuk memilih ketua Organisasi Kesiswaan di sekolah.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-lg-4 mb-3 p-md-4 text-center">
                <div class="row justify-content-center">
                    <div class="col-md-3 mb-3 mb-md-0 text-center">
                        <div class="icon-card-about rounded-circle bg-light text-info d-flex justify-content-center align-items-center m-auto">
                            <h1 class="mb-0"><i class="fas fa-bolt"></i></h1>
                        </div>
                    </div>
                    <div class="col-md-9 text-left">
                        <h5 class="text-info"><strong>Hemat dan Cepat</strong></h5>
                        <p class="text-light">
                            Dibandingkan dengan pemilihan secara langsung, metode E-Voting ini bisa dikatakan lebih unggul jika hanya melakukan
                            pemilihan di sekolah saja. Itu karena dengan metode e-voting ini bisa menghemat biaya properti untuk pemilihan seperti kotak suara, surat suara, tenaga, dll.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="main-page-section section-kontak" id="kontak">
    <div class="container">
        <div class="text-center" data-aos="fade-up" data-aos-duration="1000">
            <h2><strong>Kontak Admin</strong></h2>
            <hr class="line-title">
        </div>
        <div class="card card-wrap-kontak mt-4" data-aos="flip-up" data-aos-duration="1000" data-aos-delay="600">
            <div class="row">
                <div class="col-lg-5 col-md-6">
                    <div class="card card-kontak text-light">
                        <div class="card-body">
                            <h5>Informasi Admin</h5>
                            <div class="list-kontak">
                                <div class="row m-0 mb-3">
                                    <div class="col-1 text-center p-1">
                                        <i class="fas fa-phone-alt"></i>
                                    </div>
                                    <div class="col-11 pl-1">
                                        +6281111222333
                                    </div>
                                </div>
                                <div class="row m-0 mb-3">
                                    <div class="col-1 text-center p-1">
                                        <i class="far fa-envelope"></i>
                                    </div>
                                    <div class="col-11 pl-1">
                                        example@gmail.com
                                    </div>
                                </div>
                                <div class="row m-0 mb-3">
                                    <div class="col-1 text-center p-1">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="col-11 pl-1">
                                        Jl. XXX, No X, Desa Nama Desa, Kecamatan Nama Kecamatan, Kabupaten Example, Provinsi Bali, 80000.
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-5 position-absolute list-social-media">
                                <a class="icon-social-media" href="#"><i class="fab fa-whatsapp"></i></a>
                                <a class="icon-social-media" href="#"><i class="fab fa-telegram-plane"></i></a>
                                <a class="icon-social-media" href="#"><i class="fab fa-facebook"></i></a>
                                <a class="icon-social-media" href="#"><i class="fab fa-instagram"></i></a>
                                <a class="icon-social-media" href="#"><i class="fab fa-youtube"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 form-kontak-wrap">
                    <div class="text-right">
                        <h5 class="mb-4">Hubungi admin kami melalui Email</h5>
                    </div>
                    <?php if ($validation) { ?>
                        <div class="alert alert-danger">
                            <?= $validation->listErrors() ?>
                            <button type="button" class="close close-alert" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    <?php } ?>
                    <form action="<?= base_url('email') ?>" method="POST">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="email" name="email_user" class="form-control" placeholder="Email Anda" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="far fa-envelope"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" name="nama_user" class="form-control" placeholder="Nama Lengkap Anda" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-user"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" name="judul" class="form-control" placeholder="Judul" required>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="basic-addon2"><i class="fas fa-pencil-alt"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <textarea name="pesan_user" class="form-control" style="min-height: 160px;" placeholder="Pesan Anda" required></textarea>
                        </div>
                        <button type="submit" class="btn-softblue">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>