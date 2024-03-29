<?php

// use CodeIgniter\Router\RouteCollection;

// /**
//  * @var RouteCollection $routes
//  */
// $routes->get('/', 'Main::index');


namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->post('/login/processLogin', 'Login::processLogin');
$routes->get('/dashboard', 'Main::dashboard');
$routes->get('/logout', 'Login::logout');

$routes->get('/data_pt/hapus/(:any)', 'Data_pt::index');
$routes->delete('/data_pt/hapus/(:any)', 'Data_pt::hapus/$1');

$routes->get('/user', 'User::index');
$routes->get('/user/tambah', 'User::tambah');
$routes->get('/user/hapus/(:any)', 'User::hapus/$1');
$routes->get('/user/edit/(:any)', 'User::edit/$1');
$routes->get('/user/updatedata', 'User::updatedata');

$routes->get('/supplier/hapus/(:any)', 'Supplier::index');
$routes->delete('/suppplier/hapus/(:any)', 'Supplier::hapus/$1');

$routes->get('/produk/hapus/(:any)', 'Produk::index');
$routes->delete('/produk/hapus/(:any)', 'Produk::hapus/$1');

$routes->get('/pembelian', 'Pembelian::index');
$routes->get('/pembelian/tambah', 'Pembelian::tambah');
$routes->get('/pembelian/laporan', 'Pembelian::laporan');
$routes->get('/pembelian/detaillaporan', 'Pembelian::detaillaporan');
$routes->get('/pembelian/detailpembelian', 'Pembelian::detailpembelian');
$routes->get('/pembelian/editpembelian', 'Pembelian::editpembelian');
$routes->get('/pembelian/updatedata', 'Pembelian::updatedata');
$routes->get('/pembelian/hapus/(:any)', 'Pembelian::hapus/$1');
$routes->get('/pembelian/detail/(:any)', 'Pembelian::detail/$1');
$routes->get('/pembelian/edit/(:any)', 'Pembelian::edit/$1');

$routes->get('/penjualan', 'Penjualan::index');
$routes->get('/penjualan/tambah', 'Penjualan::tambah');
$routes->get('/penjualan/laporan', 'Penjualan::laporan');
$routes->get('/penjualan/detaillaporan', 'Penjualan::detaillaporan');
$routes->get('/penjualan/detailpenjualan', 'Penjualan::detailpenjualan');
$routes->get('/penjualan/editpenjualan', 'Penjualan::editpenjualan');
$routes->get('/penjualan/hapus/(:any)', 'Penjualan::hapus/$1');
$routes->get('/Penjualan/detail/(:any)', 'Penjualan::detail/$1');
$routes->get('/penjualan/edit/(:any)', 'Penjualan::edit/$1');
$routes->get('/penjualan/cetaknota', 'Penjualan::nota');

// $routes->get('/kategori/hapus/(:any)', 'Kategori::index');
// $routes->delete('/kategori/hapus/(:any)', 'Kategori::hapus/$1');
// $routes->get('/satuan/hapus/(:any)', 'Satuan::index');
// $routes->delete('/satuan/hapus/(:any)', 'Satuan::hapus/$1');

// $routes->get('/barang/hapus/(:any)', 'Barang::index');
// $routes->delete('/barang/hapus/(:any)', 'Barang::hapus/$1');
// $routes->get('/barang/detailbarang/','Barang::detail');
/*
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
