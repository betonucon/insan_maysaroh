<?php

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

Route::get('/cache-clear', function() {
    $exitCode = Artisan::call('cache:clear');
    return '<h1>Cache facade value cleared</h1>';
});
Route::get('/config-cache', function() {
    $exitCode = Artisan::call('config:cache');
    return '<h1>Cache facade value cleared</h1>';
});

Auth::routes();
Route::get('/katalog', 'ProdukController@katalog');
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/produk', 'ProdukController@index');
    Route::get('/stokproduk', 'ProdukController@index_stok');
    Route::get('/stokproduk/form', 'ProdukController@form_stok');
    Route::post('/produk', 'ProdukController@simpan'); 
    Route::post('/produk/hapus', 'ProdukController@hapus'); 
    Route::get('/produk/form', 'ProdukController@form');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/konsumen', 'KonsumenController@index');
    Route::post('/konsumen', 'KonsumenController@simpan'); 
    Route::post('/konsumen/hapus', 'KonsumenController@hapus'); 
    Route::get('/konsumen/form', 'KonsumenController@form');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/supplier', 'SupplierController@index');
    Route::post('/supplier', 'SupplierController@simpan'); 
    Route::post('/supplier/hapus', 'SupplierController@hapus'); 
    Route::get('/supplier/form', 'SupplierController@form');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/persediaan', 'PersediaanController@index');
    Route::post('/persediaan', 'PersediaanController@simpan'); 
    Route::post('/persediaan/tambah_barang', 'PersediaanController@simpan_barang'); 
    Route::post('/persediaan/hapus', 'PersediaanController@hapus'); 
    Route::post('/persediaan/terima', 'PersediaanController@terima'); 
    Route::get('/persediaan/hapus_barang', 'PersediaanController@hapus_barang'); 
    Route::get('/persediaan/form', 'PersediaanController@form');
    Route::get('/persediaan/proses', 'PersediaanController@proses');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/retur', 'ReturController@index');
    Route::post('/retur', 'ReturController@simpan'); 
    Route::post('/retur/tambah_barang', 'ReturController@simpan_barang'); 
    Route::post('/retur/hapus', 'ReturController@hapus'); 
    Route::post('/retur/terima', 'ReturController@terima'); 
    Route::get('/retur/hapus_barang', 'ReturController@hapus_barang'); 
    Route::get('/retur/form', 'ReturController@form');
    Route::get('/retur/proses', 'ReturController@proses');
});
Route::group(['middleware'    => 'auth'],function(){
    Route::get('/penjualan', 'PenjualanController@index');
    Route::get('/laporanproduk', 'PenjualanController@index_laporanproduk');
    Route::get('/laporanproduk/cetak', 'PenjualanController@cetak_laporanproduk');
    Route::get('/laporanpenjualan', 'PenjualanController@index_laporanpenjualan');
    Route::get('/laporanpenjualan/cetak', 'PenjualanController@cetak_laporanpenjualan');
    Route::post('/penjualan', 'PenjualanController@simpan'); 
    Route::post('/penjualan/tambah_barang', 'PenjualanController@simpan_barang'); 
    Route::post('/penjualan/hapus', 'PenjualanController@hapus'); 
    Route::post('/penjualan/terima', 'PenjualanController@terima'); 
    Route::post('/penjualan/pelunasan', 'PenjualanController@pelunasan'); 
    Route::get('/penjualan/hapus_barang', 'PenjualanController@hapus_barang'); 
    Route::get('/penjualan/form', 'PenjualanController@form');
    Route::get('/penjualan/proses', 'PenjualanController@proses');
});

Route::group(['middleware'    => 'auth'],function(){
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
});
