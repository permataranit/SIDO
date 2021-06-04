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
$routes->setAutoRoute(false);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/tryme', function () {
	echo 'Hello World!';
});

$routes->get('/coba/index', 'Coba::index');
$routes->get('/coba/about', 'Coba::about');
$routes->get('/coba/(:any)/(:num)', 'Coba::about/$1/$2');

// $routes->get('/users', 'Admin\Users::index'); ini kalo controllernya di masukin ke folder (folder admin controller user)

// $routes->get('/dosen', 'Dosen::index', ['filter' => 'auth']);
// $routes->get('/dosen/create', 'Dosen::create');
// $routes->get('/dosen/edit/(:segment)', 'Dosen::edit/$1');
// $routes->patch('/dosen/(:num)', 'Dosen::update/$1');
// $routes->post('/dosen/add', 'Dosen::save');
// $routes->delete('/dosen/(:num)', 'Dosen::delete/$1');
// $routes->get('/dosen/(:any)', 'Dosen::detail/$1');

$routes->post('/auth/login', 'Auth::auth');
$routes->get('/auth/logout', 'Auth::logout');
$routes->get('/auth/blocked', 'Auth::blocked');
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
	$routes->group('dosen', function ($routes) {
		$routes->get('/', 'Dosen::index');
		$routes->get('create', 'Dosen::create');
		$routes->get('edit/(:segment)', 'Dosen::edit/$1');
		$routes->patch('(:num)', 'Dosen::update/$1');
		$routes->post('add', 'Dosen::save');
		$routes->delete('(:num)', 'Dosen::delete/$1');
		$routes->get('(:any)', 'Dosen::detail/$1');
	});
	$routes->group('mahasiswa', function ($routes) {
		$routes->get('/', 'Mahasiswa::index');
		$routes->get('(:num)', 'Mahasiswa::detail/$1');
		$routes->get('sinkron', 'Mahasiswa::syncMhs');
	});
	$routes->get('password', 'Admin::indexPass');
	$routes->patch('password', 'Admin::gantiPass');
});

// $routes->get('/kadep', 'Dosen::show_list', ['filter' => 'auth']); //ini nanti diganti sama route buat ganti kadep
$routes->group('kadep', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Dosen::show_list');
	$routes->get('password', 'Kadep::indexPass');
	$routes->patch('password', 'Kadep::gantiPass');
});
// $routes->get('/mahasiswa', 'Dosen::show_list', ['filter' => 'auth']);
$routes->group('mahasiswa', ['filter' => 'auth'], function ($routes) {
	$routes->get('/', 'Dosen::show_list');
	$routes->get('password', 'Mahasiswa::indexPass');
	$routes->patch('password', 'Mahasiswa::gantiPass');
});

$routes->get('/bulan(:any)', 'Jadwal::index_month$1$2'); //ini belum dihapus krn buat test dulu
$routes->get('/hari', 'Jadwal::index'); //ini belum dihapus krn buat test dulu


// $routes->group('kadep', ['filter' => 'auth'], function ($routes) {
// 	$routes->get('/', 'Kadep::index');
// });

$routes->group('dosen', ['filter' => 'auth'], function ($routes) {
	$routes->group('penelitian', function ($routes) {
		$routes->get('/', 'Penelitian::index');
		$routes->get('create', 'Penelitian::create');
		$routes->get('edit/(:alphanum)', 'Penelitian::edit/$1');
		$routes->patch('(:alphanum)', 'Penelitian::update/$1');
		$routes->post('add', 'Penelitian::save');
		$routes->delete('(:alphanum)', 'Penelitian::delete/$1');
		$routes->get('(:alphanum)', 'Penelitian::detail/$1');
		$routes->get('agenda/(:alphanum)', 'Jadwal::agenda/$1');
	});
	$routes->group('pengabdian', function ($routes) {
		$routes->get('/', 'Pengabdian::index');
		$routes->get('create', 'Pengabdian::create');
		$routes->get('edit/(:alphanum)', 'Pengabdian::edit/$1');
		$routes->patch('(:alphanum)', 'Pengabdian::update/$1');
		$routes->post('add', 'Pengabdian::save');
		$routes->delete('(:alphanum)', 'Pengabdian::delete/$1');
		$routes->get('(:alphanum)', 'Pengabdian::detail/$1');
		$routes->get('agenda/(:alphanum)', 'Jadwal::agenda/$1');
	});
	$routes->group('list', function ($routes) {
		$routes->get('/', 'Dosen::show_list');
		$routes->get('/detailDosen/(:segment)', 'ProfilDosen::index/$1');
	});
	$routes->group('profile', function ($routes) {
		$routes->get('(:num)', 'Dosen::detail/$1');
		$routes->get('edit/(:num)', 'Dosen::edit/$1');
		$routes->patch('(:num)', 'Dosen::update/$1');
	});
	$routes->group('jadwal', function ($routes) {
		$routes->get('create', 'Jadwal::create');
		$routes->get('edit/(:alphanum)', 'Jadwal::edit/$1');
		$routes->patch('(:alphanum)', 'Jadwal::update/$1');
		$routes->post('add', 'Jadwal::save');
		$routes->addPlaceholder('tgl', '([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))'); //to validate dd/mm/yyyy
		$routes->delete('(:alphanum)/(:tgl)', 'Jadwal::delete/$1/$2');
		$routes->get('(:alphanum)', 'Jadwal::detail/$1');
	});
	$routes->get('password', 'Dosen::indexPass');
	$routes->patch('password', 'Dosen::gantiPass');
	$routes->get('bulan(:any)', 'Jadwal::index_month$1$2');
	$routes->get('hari', 'Jadwal::index');
});
$routes->get('/profildetail/(:segment)', 'ProfilDosen::index/$1');
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
