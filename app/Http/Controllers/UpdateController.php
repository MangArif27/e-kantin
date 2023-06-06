<?php

namespace App\Http\Controllers;

use File;

use App\Models\kode;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UpdateController extends Controller
{
    public function UpdatePenjualanNota(Request $request)
    {
        $IdData = $request->IdData;
        $jml = "jml_brg" . $IdData;
        $ttl_hrg = "jml_harga" . $IdData;
        $jumlah = $request->$jml;
        $total_harga = $request->$ttl_hrg;
        DB::table('penjualan')->where('id', $request->IdData)->update([
            'jumlah' => $jumlah,
            'total_harga' => $total_harga,
        ]);
        Session::flash('sukses', 'Anda Berhasil Input Data!');
        return redirect('/Penjualan');
    }
}
