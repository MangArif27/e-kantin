<?php

namespace App\Http\Controllers;

use File;

use App\Models\kode;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class DeleteController extends Controller
{
    /* -------- Proses Delete -------*/
    public function DeleteKategori($kode)
    {
        DB::table('kategori')->where('kode_ktg', $kode)->delete();
        Session::flash('sukses', 'Anda Berhasil Delete Kategori');
        return redirect('/Master-Kategori');
    }
    public function DeleteSuplier($kode)
    {
        DB::table('suplier')->where('kode_spl', $kode)->delete();
        Session::flash('sukses', 'Anda Berhasil Delete Suplier');
        return redirect('/Master-Suplier');
    }
    public function DeletePegawai($nip)
    {
        $delete = DB::table('pegawai')->where('nip', $nip)->first();
        File::delete('img/Photo' . $delete->foto);

        DB::table('pegawai')->where('nip', $nip)->delete();
        Session::flash('sukses', 'Anda Berhasil Delete Pegawai');
        return redirect('/Master-Pegawai');
    }
    public function DeleteKonsumen($nip)
    {
        $delete = DB::table('konsumen')->where('no_identitas', $nip)->first();
        File::delete('img/Photo' . $delete->foto);

        DB::table('konsumen')->where('no_identitas', $nip)->delete();
        Session::flash('sukses', 'Anda Berhasil Delete Konsumen');
        return redirect('/Master-Konsumen');
    }
    public function DeleteBarang($kode)
    {
        $delete = DB::table('barang')->where('kode_brg', $kode)->first();

        DB::table('barang')->where('kode_brg', $kode)->delete();
        Session::flash('sukses', 'Anda Berhasil Delete Barang');
        return redirect('/Master-Barang');
    }
    /* -------- End Proses Delete -------*/
}
