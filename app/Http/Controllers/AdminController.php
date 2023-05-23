<?php

namespace App\Http\Controllers;

use File;

use App\Models\kode;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{

  /* -------- Proses Search -------*/
  public function autocomplete($kode)
  {
    $term = $request->get('term');
    $datas = DB::table('barang')->where('kode_brg', 'like', '%' . $term . '%')->get();
    $names = array();
    foreach ($datas as $data) {
      array_push($names, $data['kode_brg']);
    }
    echo json_encode($names);
  }
  public function GetBarang($id)
  {
    $course = DB::table('barang')->where('kode_brg', $id)->get();
    return response()->json($course);
  }
  /* -------- End Proses Search -------*/
}
