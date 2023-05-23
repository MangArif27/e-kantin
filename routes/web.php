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
/* -------- Start Bagian Menu -------*/

Route::get('/', 'PageController@index');
Route::get('Master-Kode', 'PageController@MasterKode');
Route::get('Master-Kategori', 'PageController@MasterKategori');
Route::get('Master-Satuan', 'PageController@MasterSatuan');
Route::get('Master-Suplier', 'PageController@MasterSuplier');
Route::get('Master-Barang', 'PageController@MasterBarang');
Route::get('Master-Pegawai', 'PageController@MasterPegawai');
Route::get('Master-Konsumen', 'PageController@MasterKonsumen');
Route::get('Penjualan', 'PageController@Penjualan');
Route::get('Top-Up-Brizzi', 'PageController@TopUpBrizzi');
/* -------- End Bagian Menu -------*/
/* -------- Proses Insert -------*/
Route::post('Master-Kategori', 'InsertController@InsertKategori')->name('Insert.Kategori');
Route::post('Master-Satuan', 'InsertController@InsertSatuan')->name('Insert.Satuan');
Route::post('Master-Suplier', 'InsertController@InsertSuplier')->name('Insert.Suplier');
Route::post('Master-Barang', 'InsertController@InsertBarang')->name('Insert.Barang');
Route::post('Master-Pegawai', 'InsertController@InsertPegawai')->name('Insert.Pegawai');
Route::post('Master-Konsumen', 'InsertController@InsertKonsumen')->name('Insert.Konsumen');
Route::post('Penjualan', 'InsertController@InsertNotaPenjualan')->name('Insert.Nota.Penjualan');
/* -------- End Proses Insert -------*/
/* -------- Proses Delete -------*/
Route::get('Delete-Kategori/{kode}', 'DeleteController@DeleteKategori');
Route::get('Delete-Suplier/{kode}', 'DeleteController@DeleteSuplier');
Route::get('Delete-Pegawai/{nip}', 'DeleteController@DeletePegawai');
Route::get('Delete-Konsumen/{nip}', 'DeleteController@DeleteKonsumen');
Route::get('Delete-Barang/{kode}', 'DeleteController@DeleteBarang');
/* -------- End Delete -------*/
/* -------- Proses Search -------*/
Route::get('autocomplete/search', 'AdminController@autocomplete');
Route::get('GetBarang/{id}', 'AdminController@GetBarang');
/* -------- End Proses Search -------*/
