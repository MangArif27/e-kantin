<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
  /* -------- Start Bagian Menu -------*/
  public function index()
  {
    return view('web.page._index');
  }
  public function MasterKode()
  {
    $kode = DB::table('kode')->get();
    $kategori = DB::table('kategori')->get();
    $barang = DB::table('barang')->get();
    return view('web.page._master_kode', ['kode' => $kode, 'kategori' => $kategori, 'barang' => $barang]);
  }
  public function MasterKategori()
  {
    $kategori = DB::table('kategori')->get();
    return view('web.page._master_kategori', ['kategori' => $kategori]);
  }
  public function MasterSatuan()
  {
    $satuan = DB::table('satuan')->get();
    return view('web.page._master_satuan', ['satuan' => $satuan]);
  }
  public function MasterSuplier()
  {
    $suplier = DB::table('suplier')->get();
    return view('web.page._master_suplier', ['suplier' => $suplier]);
  }
  public function MasterBarang()
  {
    $satuan = DB::table('satuan')->get();
    $kategori = DB::table('kategori')->get();
    $suplier = DB::table('suplier')->get();
    $barang = DB::table('barang')->get();
    return view('web.page._master_barang', ['barang' => $barang, 'kategori' => $kategori, 'suplier' => $suplier, 'satuan' => $satuan]);
  }
  public function MasterKonsumen()
  {
    $konsumen = DB::table('konsumen')->get();
    return view('web.page._master_konsumen', ['konsumen' => $konsumen]);
  }
  public function MasterPegawai()
  {
    $pegawai = DB::table('pegawai')->get();
    return view('web.page._master_pegawai', ['pegawai' => $pegawai]);
  }
  public function Penjualan()
  {
    $date = date('Y-m-d');
    $penjualan = DB::table('penjualan')->where('tanggal', $date)->where('status', "Belum Bayar")->where('toko', "AB")->get();
    $barang = DB::table('barang')->get();
    return view('web.page._penjualan', ['barang' => $barang, 'penjualan' => $penjualan]);
  }
  public function TopUpBrizzi()
  {
    return view('web.page._top_up');
  }
  /* -------- End Bagian Menu -------*/
}
