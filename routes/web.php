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
Route::get('/', 'AdminController@index');
Route::get('Master-Kode', 'AdminController@MasterKode');
Route::get('Master-Kategori', 'AdminController@MasterKategori');
Route::get('Master-Satuan', 'AdminController@MasterSatuan');
Route::get('Master-Suplier', 'AdminController@MasterSuplier');
Route::get('Master-Barang', 'AdminController@MasterBarang');
Route::get('Master-Pegawai', 'AdminController@MasterPegawai');
Route::get('Master-Konsumen', 'AdminController@MasterKonsumen');
Route::get('Penjualan', 'AdminController@Penjualan');
Route::get('Top-Up-Brizzi', 'AdminController@TopUpBrizzi');
/* -------- End Bagian Menu -------*/
/* -------- Proses Insert -------*/
Route::post('Master-Kategori', 'AdminController@InsertKategori')->name('Insert.Kategori');
Route::post('Master-Satuan', 'AdminController@InsertSatuan')->name('Insert.Satuan');
Route::post('Master-Suplier', 'AdminController@InsertSuplier')->name('Insert.Suplier');
Route::post('Master-Barang', 'AdminController@InsertBarang')->name('Insert.Barang');
Route::post('Master-Pegawai', 'AdminController@InsertPegawai')->name('Insert.Pegawai');
Route::post('Master-Konsumen', 'AdminController@InsertKonsumen')->name('Insert.Konsumen');
/* -------- End Proses Insert -------*/
/* -------- Proses Delete -------*/
Route::get('Delete-Kategori/{kode}', 'AdminController@DeleteKategori');
Route::get('Delete-Suplier/{kode}', 'AdminController@DeleteSuplier');
Route::get('Delete-Pegawai/{nip}', 'AdminController@DeletePegawai');
Route::get('Delete-Konsumen/{nip}', 'AdminController@DeleteKonsumen');
Route::get('Delete-Barang/{kode}', 'AdminController@DeleteBarang');
/* -------- End Delete -------*/
/* -------- Proses Search -------*/
Route::get('autocomplete/search', 'AdminController@autocomplete');
/* -------- End Proses Search -------*/
