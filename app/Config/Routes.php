<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Main::index');
$routes->add('logout', 'Login::logout');

$routes->add('email', 'Main::sendMail');

//$routes->get('admin', ['filter' => 'auth']);
$routes->group('admin', ['filter' => 'admin-auth'], function ($routes) {
	$routes->add('/', 'Admin\Dashboard::index');
	//Dashboard
	$routes->add('dashboard', 'Admin\Dashboard::index');

	//Data Pemilih
	//Kelas
	$routes->add('pemilih', 'Admin\Pemilih::index');
	$routes->add('pemilih/tambah_kelas', 'Admin\Pemilih::tambahKelas');
	$routes->add('pemilih/edit_kelas', 'Admin\Pemilih::editKelas');
	$routes->add('pemilih/hapus_kelas', 'Admin\Pemilih::hapusKelas');
	$routes->add('pemilih/hapus_kelas_ganda', 'Admin\Pemilih::hapusKelasGanda');
	$routes->add('pemilih/import_excel', 'Admin\Pemilih::importExcel');

	//Anggota
	$routes->add('pemilih/anggota/(:num)', 'Admin\Pemilih::anggota/$1');
	$routes->add('pemilih/anggota/(:num)/tambah_anggota', 'Admin\Pemilih::tambahAnggota');
	$routes->add('pemilih/anggota/(:num)/edit_anggota', 'Admin\Pemilih::editAnggota');
	$routes->add('pemilih/anggota/(:num)/hapus_anggota', 'Admin\Pemilih::hapusAnggota');
	$routes->add('pemilih/anggota/(:num)/hapus_anggota_ganda', 'Admin\Pemilih::hapusAnggotaGanda');
	$routes->add('pemilih/anggota/(:num)/import_anggota', 'Admin\Pemilih::importAnggota');

	//Kandidat
	$routes->add('kandidat', 'Admin\Kandidat::index');
	$routes->add('kandidat/detail/(:num)', 'Admin\Kandidat::detailKandidat/$1');
	$routes->add('kandidat/tambah', 'Admin\Kandidat::tambahKandidat');
	$routes->add('kandidat/edit/(:num)', 'Admin\Kandidat::editKandidat/$1');
	$routes->add('kandidat/tambah/simpan', 'Admin\Kandidat::simpanKandidat');
	$routes->add('kandidat/edit/update', 'Admin\Kandidat::updateKandidat');
	$routes->add('kandidat/hapus', 'Admin\Kandidat::hapusKandidat');

	//Pelaksanaan
	$routes->add('pelaksanaan', 'Admin\Pelaksanaan::index');
	$routes->add('pelaksanaan/atur_waktu', 'Admin\Pelaksanaan::aturWaktu');
	$routes->add('pelaksanaan/update_waktu', 'Admin\Pelaksanaan::editWaktu');

	//Quick Count
	$routes->add('quick_count', 'Hitung::index');

	//Edit Profil
	$routes->add('edit_profil', 'Profil::index');
	$routes->add('edit_profil/update', 'Profil::updateNama');
	$routes->add('edit_profil/cek_password', 'Profil::cekPassword');
	$routes->add('edit_profil/password', 'Profil::gantiPassword');
	$routes->add('edit_profil/hapus_akun', 'Profil::hapusAkun');
});

$routes->group('pemilih', ['filter' => 'pemilih-auth'], function ($routes) {
	$routes->add('/', 'Pemilih\Dashboard::index');
	$routes->add('dashboard', 'Pemilih\Dashboard::index');
	$routes->add('bilik_suara', 'Pemilih\Pemilih::index');
	$routes->add('bilik_suara/pilih', 'Pemilih\Pemilih::pilihKandidat');
	$routes->add('quick_count', 'Hitung::index');
	$routes->add('edit_profil', 'Profil::index');
	$routes->add('edit_profil/update', 'Profil::updateNama');
	$routes->add('edit_profil/cek_password', 'Profil::cekPassword');
	$routes->add('edit_profil/password', 'Profil::gantiPassword');
	$routes->add('ganti_password', 'Pemilih\Pemilih::gantiPassword');
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
