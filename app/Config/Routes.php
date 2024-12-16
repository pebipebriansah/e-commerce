<?php
namespace Config;
// Create a new instance of our RouteCollection class.
$routes = Services::routes();
/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);
/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */
// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// routes for admin
$routes->get('/', 'Home::index');
$routes->get('/login', 'Admin\AuthController::index');
$routes->post('/auth', 'Admin\AuthController::auth');
$routes->get('/logout', 'Admin\AuthController::logout');
// routes for supplier
$routes->get('/login/customer', 'Admin\AuthSupplierController::index');
$routes->post('/login/customer/auth', 'Admin\AuthSupplierController::auth');
$routes->get('/logout/customer', 'Admin\AuthSupplierController::logout');
$routes->get('/profile/customer','Admin\AuthSupplierController::profile');
$routes->get('/register/customer','Admin\AuthSupplierController::register');
$routes->post('/register/save','Admin\AuthSupplierController::save');
$routes->get('payment/(:any)','Customer\PaymentController::pay/$1');
$routes->post('webhook/midtrans', 'WebhookController::handle');
$routes->get('customer/check-status/(:segment)', 'Customer\PaymentController::checkStatus/$1');
//routes for penjualan
$routes->get('/login/penjualan', 'Penjualan\AuthController::index');
$routes->post('/login/penjualan/auth', 'Penjualan\AuthController::auth');
$routes->get('/logout/penjualan', 'Penjualan\AuthController::logout');
$routes->get('getDataId','Pegawai\PesanBarangController::getDataBarangById');
$routes->get('getDataProdukId','Pegawai\BarangTerjualController::getDataProdukId');
$routes->get('getDataProductionId','Pegawai\BarangTerjualController::getDataProductionId');
$routes->get('getDataBarangBySupplier','Pegawai\PesanBarangController::getDataBarangBySupplier');
// Routes Pegawai
$routes->group('pegawai', ['filter' => 'AuthFilter'], static function ($routes){
    $routes->get('home', 'Pegawai\DashboardController::index');
    $routes->get('home/get_data', 'Pegawai\DashboardController::get_data');
    $routes->get('home/get_data_week','Pegawai\DashboardController::get_data_week');
    $routes->get('home/get_data_hari','Pegawai\DashboardController::get_data_hari');
    //Chart Keluar
    $routes->get('home/get_data_keluar', 'Pegawai\DashboardController::get_data_keluar');
    $routes->get('home/get_data_week_keluar','Pegawai\DashboardController::get_data_week_keluar');
    $routes->get('home/get_data_hari_keluar','Pegawai\DashboardController::get_data_hari_keluar');
    //users
    $routes->get('users', 'Pegawai\UsersController::index');
    $routes->get('users/create', 'Pegawai\UsersController::create');
    $routes->post('users/save', 'Pegawai\UsersController::save');
    $routes->get('users/edit/(:num)', 'Pegawai\UsersController::edit/$1');
    $routes->post('users/update/(:num)', 'Pegawai\UsersController::update/$1');
    $routes->post('users/delete/(:num)', 'Pegawai\UsersController::delete/$1');

    //customer
    $routes->get('customer', 'Pegawai\CustomerController::index');
    $routes->get('customer/create', 'Pegawai\CustomerController::create');
    $routes->post('customer/save', 'Pegawai\CustomerController::save');
    $routes->get('customer/edit/(:num)', 'Pegawai\CustomerController::edit/$1');
    $routes->post('customer/update/(:num)', 'Pegawai\CustomerController::update/$1');
    $routes->post('customer/delete/(:num)', 'Pegawai\CustomerController::delete/$1');

    //supplier
    $routes->get('supplier', 'Pegawai\SupplierController::index');
    $routes->get('supplier/create', 'Pegawai\SupplierController::create');
    $routes->post('supplier/save', 'Pegawai\SupplierController::save');
    $routes->get('supplier/edit/(:any)', 'Pegawai\SupplierController::edit/$1');
    $routes->post('supplier/delete/(:any)', 'Pegawai\SupplierController::delete/$1');
    $routes->post('supplier/update/(:any)', 'Pegawai\SupplierController::update/$1');
    //production
    $routes->get('production', 'Pegawai\ProductionController::index');
    $routes->get('production/create', 'Pegawai\ProductionController::create');
    $routes->post('production/save','Pegawai\ProductionController::save');
    $routes->post('production/delete/(:any)','Pegawai\ProductionController::delete/$1');
    $routes->get('production/rincian/(:any)','Pegawai\ProductionController::rincian/$1');
    //produk
    $routes->get('produk','Pegawai\ProdukController::index');
    
    //aprrove pembayaran
    $routes->post('proses_approve/(:any)','Pegawai\PembayaranController::proses_approve/$1');
    $routes->post('proses_kirim/(:any)','Pegawai\PembayaranController::proses_kirim/$1');

    //barang
    $routes->get('barang', 'Pegawai\BarangController::index');
    $routes->get('barang/create', 'Pegawai\BarangController::create');
    $routes->post('barang/save', 'Pegawai\BarangController::save');
    $routes->get('barang/edit/(:any)', 'Pegawai\BarangController::edit/$1');
    $routes->post('barang/delete/(:any)', 'Pegawai\BarangController::delete/$1');
    $routes->post('barang/update/(:any)', 'Pegawai\BarangController::update/$1');
    $routes->get('barang/detail/(:any)', 'Pegawai\BarangController::detail/$1');
    //pesanan
    $routes->get('pesan-barang', 'Pegawai\PesanBarangController::index');
    $routes->get('pesan-barang/create', 'Pegawai\PesanBarangController::create');
    $routes->post('pesan-barang/save', 'Pegawai\PesanBarangController::save');
    $routes->post('pesan-barang/update/(:any)', 'Pegawai\PesanBarangController::update/$1');
    $routes->post('pesan-barang/konfirmasi/(:any)','Pegawai\PesanBarangController::konfirmasi/$1');
    $routes->post('pesanan/konfirmasi/(:any)','Pegawai\PesananController::konfirmasi/$1');
    //barang masuk
    $routes->get('barang-masuk', 'Pegawai\BarangMasukController::index');
    $routes->post('barang-masuk/save', 'Pegawai\BarangMasukController::save');
    $routes->post('barang-masuk/update/(:any)', 'Pegawai\BarangMasukController::update/$1');
    //barang terjual
    $routes->get('barang-terjual','Pegawai\BarangTerjualController::index');
    $routes->post('barang-terjual/save', 'Pegawai\BarangTerjualController::save');
    //barang keluar
    $routes->get('barang-keluar', 'Pegawai\BarangKeluarController::index');
    $routes->post('barang-keluar/save', 'Pegawai\BarangKeluarController::save');

    //laporan masuk
    $routes->get('laporan-masuk', 'Pegawai\LaporanMasukController::index');
    $routes->post('laporan-masuk/create', 'Pegawai\LaporanMasukController::create');
    $routes->post('laporan-masuk/unduh','Pegawai\LaporanMasukController::unduh');

    //laporan keluar
    $routes->get('laporan-keluar', 'Pegawai\LaporanKeluarController::index');
    $routes->post('laporan-keluar/create', 'Pegawai\LaporanKeluarController::create');
    $routes->post('laporan-keluar/unduh','Pegawai\LaporankeluarController::unduh');

    $routes->get('pesanan', 'Pegawai\PesananController::index');
    $routes->get('invoices/(:any)','Pegawai\PesananController::download/$1');

    //laporan transaksi
    $routes->get('laporan-transaksi', 'Pegawai\LaporanTransaksiController::index');
    $routes->post('laporan-transaksi/create', 'Pegawai\LaporanTransaksiController::create');
    $routes->post('laporan-transaksi/unduh','Pegawai\LaporanTransaksiController::unduh');
});
// Routes Supplier
$routes->group('customer', ['filter' => 'AuthSupplierFilter'], static function ($routes){
    $routes->get('dashboard', 'Customer\DashboardController::index');
    $routes->get('profile','Customre\ProfileController::index');
    $routes->get('profile/edit/(:any)','Customr\ProfileController::edit/$1');
    $routes->post('profile/update/(:any)','Customer\ProfileController::update/$1');
    $routes->get('customer','Customer\SupplierController::index');
    $routes->get('pesanan', 'Customer\PesananController::index');
    $routes->get('kirim/(:any)', 'Customer\PesananController::kirim/$1');
    $routes->get('barang', 'Customer\BarangController::index');
    $routes->get('barang/create', 'Customer\BarangController::create');
    $routes->post('barang/save', 'Customer\BarangController::save');
    $routes->get('barang/edit/(:any)', 'Customer\BarangController::edit/$1');
    $routes->post('barang/delete/(:any)', 'Customer\BarangController::delete/$1');
    $routes->post('barang/update/(:any)', 'Customer\BarangController::update/$1');
    $routes->get('detail/(:any)', 'Customer\ShopController::detail/$1'); 
    $routes->get('shop', 'Customer\ShopController::index');
    $routes->get('shop/pesan-barang/(:any)', 'Customer\ShopController::pesan/$1');
    $routes->post('shop/save', 'Customer\ShopController::save');
    $routes->get('order','Customer\OrderController::index');
    $routes->post('proses_pembayaran/(:any)','Customer\OrderController::proses_pembayaran/$1');
    $routes->post('proses_terima/(:any)','Customer\OrderController::proses_terima/$1');
    $routes->get('payment','Customer\PembayaranController::index');
    $routes->get('invoices/(:any)','Customer\PembayaranController::download/$1');
    $routes->get('cart','Customer\CartController::index');
    $routes->get('cart/add_to_cart/(:any)','Customer\CartController::add_to_cart/$1');
    $routes->post('checkout','Customer\ShopController::checkout');
    $routes->post('tukarPoin/(:any)','Customer\OrderController::tukar_point/$1');
    $routes->get('remove_cart/(:any)','Customer\CartController::remove_cart/$1');
});
$routes->group('penjualan',['filter' => 'AuthPenjualanFilter'], static function($routes){
    $routes->get('dashboard', 'Penjualan\DashboardController::index');
    $routes->get('data-penjualan', 'Penjualan\PenjualanController::penjualan');
});
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}