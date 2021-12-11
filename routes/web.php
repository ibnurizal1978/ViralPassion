<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

/* FRONT END */
// Home
Route::get('/', 'Home@index');
Route::get('home', 'Home@index');
Route::get('kontak', 'Home@kontak');
// Login
Route::get('login', 'Login@index');
Route::post('login/cek', 'Login@cek');
Route::get('login/lupa', 'Login@lupa');
Route::get('login/logout', 'Login@logout');
// Berita 
 
// Pages
Route::get('page/{par1}', 'Page@index');
Route::get('service/{par1}', 'Service@index');
// Route::get('contact/add', 'Home@addContact');
Route::post('contact/add', 'Home@addContact');

Route::get('order/{par1}', 'Order@index');
Route::post('checkout', 'Order@checkout');
Route::post('select-media', 'Order@selectMedia');
Route::post('payment', 'Order@payment');
Route::post('media-load-more', 'Order@ig_load_more');
Route::post('payment/create', 'Order@paymentCreate');
Route::post('payment/capture', 'Order@paymentCapture');
Route::get('payment/success', 'Order@paymentSuccess');


/* END FRONT END */
/* BACK END */
Route::group(['namespace' => 'Admin','middleware' => 'checkSession'], 
// Route::group(['middleware' => 'checkSession'], function () {
function()
{
	// dasbor
    Route::get('admin/dasbor', 'Dasbor@index');
    Route::get('admin/dasbor/konfigurasi', 'Dasbor@konfigurasi');

    // user
    Route::get('admin/user', 'User@index');
    Route::post('admin/user/tambah', 'User@tambah');
    Route::get('admin/user/edit/{par1}', 'User@edit');
    Route::post('admin/user/proses_edit', 'User@proses_edit');
    Route::get('admin/user/delete/{par1}', 'User@delete');
    Route::post('admin/user/proses', 'User@proses');
    // konfigurasi
    Route::get('admin/konfigurasi', 'Konfigurasi@index');
    Route::get('admin/konfigurasi/logo', 'Konfigurasi@logo');
    Route::get('admin/konfigurasi/icon', 'Konfigurasi@icon');
    Route::get('admin/konfigurasi/email', 'Konfigurasi@email');
    Route::get('admin/konfigurasi/gambar', 'Konfigurasi@gambar');
    Route::get('admin/konfigurasi/pembayaran', 'Konfigurasi@pembayaran');
    Route::post('admin/konfigurasi/proses', 'Konfigurasi@proses');
    Route::post('admin/konfigurasi/proses_logo', 'Konfigurasi@proses_logo');
    Route::post('admin/konfigurasi/proses_icon', 'Konfigurasi@proses_icon');
    Route::post('admin/konfigurasi/proses_email', 'Konfigurasi@proses_email');
    Route::post('admin/konfigurasi/proses_gambar', 'Konfigurasi@proses_gambar');
    Route::post('admin/konfigurasi/proses_pembayaran', 'Konfigurasi@proses_pembayaran');

    // berita
    Route::get('admin/pages', 'Pages@index');
    Route::get('admin/pages/cari', 'Pages@cari');
    Route::get('admin/pages/tambah', 'Pages@tambah');
    Route::get('admin/pages/edit/{par1}', 'Pages@edit');
    Route::post('admin/pages/tambah_proses', 'Pages@tambah_proses');
    Route::post('admin/pages/edit_proses', 'Pages@edit_proses');
    Route::post('admin/pages/proses', 'Pages@proses');  

    
    
     // services
    Route::get('admin/services', 'Services@index');
    Route::get('admin/services/cari', 'Services@cari');
    Route::get('admin/services/status_produk/{par1}', 'Services@status_produk');
    Route::get('admin/services/tambah', 'Services@tambah');
    Route::get('admin/services/edit/{par1}', 'Services@edit');
    Route::get('admin/services/delete/{par1}', 'Services@delete');
    Route::post('admin/services/tambah_proses', 'Services@tambah_proses');
    Route::post('admin/services/edit_proses', 'Services@edit_proses');
    Route::post('admin/services/proses', 'Services@proses');

    // products
    Route::get('admin/product', 'Product@index');
    Route::get('admin/product/cari', 'Product@cari');
    Route::get('admin/product/status_produk/{par1}', 'Product@status_produk');
    Route::get('admin/product/tambah', 'Product@tambah');
    Route::get('admin/product/edit/{par1}', 'Product@edit');
    Route::get('admin/product/delete/{par1}', 'Product@delete');
    Route::post('admin/product/tambah_proses', 'Product@tambah_proses');
    Route::post('admin/product/edit_proses', 'Product@edit_proses');
    Route::post('admin/product/proses', 'Product@proses');

     // pemesanan
    Route::get('admin/order', 'Order@index');
    Route::get('admin/order/tambah', 'Order@tambah');
    Route::get('admin/order/detail/{par1}', 'Order@detail');
    Route::get('admin/order/filter/', 'Order@filter');
    Route::get('admin/order/cari', 'Order@cari');

    // faq
    Route::get('admin/faq', 'Faq@index');
    Route::get('admin/faq/tambah', 'Faq@tambah');
    Route::get('admin/faq/edit/{par1}', 'Faq@edit');
    Route::post('admin/faq/tambah_proses', 'Faq@tambah_proses');
    Route::post('admin/faq/edit_proses', 'Faq@edit_proses');
    Route::get('admin/contacts', 'Contacts@index');
    Route::get('admin/contact/reply/{par1}', 'Contacts@reply');
    Route::post('admin/contact/reply_proses', 'Contacts@reply_process');
});
/* END BACK END*/



