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
  /* -------- Start Bagian Menu -------*/
  public function index()
  {
    return view('web.page._index');
  }
  public function MasterKode()
  {
    return view('web.page._master_kode');
  }
  public function MasterKategori()
  {
    $kategori = DB::table('kategori')->get();
    return view('web.page._master_kategori',['kategori' => $kategori]);
  }
  public function MasterSatuan()
  {
    $satuan = DB::table('satuan')->get();
    return view('web.page._master_satuan',['satuan' => $satuan]);
  }
  public function MasterSuplier()
  {
    $suplier = DB::table('suplier')->get();
    return view('web.page._master_suplier',['suplier' => $suplier]);
  }
  public function MasterBarang()
  {
    $satuan = DB::table('satuan')->get();
    $kategori = DB::table('kategori')->get();
    $suplier = DB::table('suplier')->get();
    $barang = DB::table('barang')->get();
    return view('web.page._master_barang',['barang' => $barang,'kategori' => $kategori,'suplier' => $suplier,'satuan' => $satuan]);
  }
  public function MasterKonsumen()
  {
    $konsumen = DB::table('konsumen')->get();
    return view('web.page._master_konsumen',['konsumen' => $konsumen]);
  }
  public function MasterPegawai()
  {
    $pegawai = DB::table('pegawai')->get();
    return view('web.page._master_pegawai',['pegawai' => $pegawai]);
  }
  public function Penjualan()
  {
    return view('web.page._penjualan');
  }
  public function TopUpBrizzi()
  {
    return view('web.page._top_up');
  }
  /* -------- End Bagian Menu -------*/
  /* -------- Proses Insert -------*/
  public function InsertKategori(Request $request)
  {
    $q=DB::table('kategori')->select(DB::raw('MAX(RIGHT(kode_ktg,5)) as kd_max'));
    $prx="KTG-";
    if($q->count()>0)
    {
      foreach($q->get() as $k)
      {
        $tmp = ((int)$k->kd_max)+1;
        $kd = $prx.sprintf("%06s", $tmp);
      }
    }
    else
    {
      $kd = $prx."000001";
    }
    DB::table('kategori')->insert([
      'kode_ktg'=>$kd,
      'kategori' => $request->nama_kategori,
    ]);
    Session::flash('sukses','Anda Berhasil Input Data!');
    return redirect('/Master-Kategori');
  }
  public function InsertSatuan(Request $request)
  {
    $q=DB::table('satuan')->select(DB::raw('MAX(RIGHT(kode_ktg,5)) as kd_max'));
    $prx="STN-";
    if($q->count()>0)
    {
      foreach($q->get() as $k)
      {
        $tmp = ((int)$k->kd_max)+1;
        $kd = $prx.sprintf("%06s", $tmp);
      }
    }
    else
    {
      $kd = $prx."000001";
    }
    DB::table('satuan')->insert([
      'kode_stn'=>$kd,
      'nama_stn' => $request->nama_satuan,
    ]);
    Session::flash('sukses','Anda Berhasil Input Data!');
    return redirect('/Master-Satuan');
  }
  public function InsertSuplier(Request $request)
  {
    $q=DB::table('suplier')->select(DB::raw('MAX(RIGHT(kode_spl,5)) as kd_max'));
    $prx="SPL-";
    if($q->count()>0)
    {
      foreach($q->get() as $k)
      {
        $tmp = ((int)$k->kd_max)+1;
        $kd = $prx.sprintf("%06s", $tmp);
      }
    }
    else
    {
      $kd = $prx."000001";
    }
    DB::table('suplier')->insert([
      'kode_spl'=>$kd,
      'nama_spl' => $request->nama_spl,
      'alamat_spl' => $request->alamat_spl,
      'no_telp_spl' => $request->no_telp,
    ]);
    Session::flash('sukses','Anda Berhasil Input Data!');
    return redirect('/Master-Suplier');
  }
  public function InsertBarang(Request $request)
  {
    date_default_timezone_set('Asia/Jakarta');
    $tanggal=date('Y-m-d H:m:s');
    $data=DB::table('kode')->where('kode',$request->kode_brg)->first();
      if($data)
      {
        DB::table('barang')->insert([
          'kode_brg'=>$request->kode_brg,
          'nama_brg' => $request->nama_barang,
          'kode_ktg' => $request->kategori_brg,
          'kode_spl' => $request->suplier_barang,
          'jumlah' => $request->jumlah_barang,
          'kode_stn' => $request->satuan_barang,
          'hrg_beli' => $request->nama_beli_barang,
          'hrg_jual' => $request->nama_jual_barang,
          'tanggal' => $tanggal,
        ]);
        Session::flash('sukses','Anda Berhasil Input Data!');
        return redirect('/Master-Barang');
      }
    else {
      DB::table('kode')->insert([
        'kode'=>$request->kode_brg,
        ]);
      DB::table('barang')->insert([
        'kode_brg'=>$request->kode_brg,
        'nama_brg' => $request->nama_barang,
        'kode_ktg' => $request->kategori_brg,
        'kode_spl' => $request->suplier_barang,
        'jumlah' => $request->jumlah_barang,
        'kode_stn' => $request->satuan_barang,
        'hrg_beli' => $request->nama_beli_barang,
        'hrg_jual' => $request->nama_jual_barang,
        'tanggal' => $tanggal,
      ]);
      Session::flash('sukses','Anda Berhasil Input Data!');
      return redirect('/Master-Barang');
    }
  }
  public function  InsertPegawai(Request $request)
  {
    $data=DB::table('pegawai')->where('nip',$request->nip)->first();
    if($data)
    {
      Session::flash('gagal','Maaf No Induk Pegawai Yang Anda Masukan Sudah Ada !');
      return redirect('/Master-Pegawai');
    }
    else{
      if($request->jabatan=="Kepala Kantin")
      {
        $button="success";
      }
      elseif ($request->jabatan=="Sekretaris") {
        $button="warning";
      }
      elseif ($request->jabatan=="Bendahara") {
        $button="primary";
      }
      else {
        $button="info";
      }
      $photo = $request->file('photo_pgw');
      $nama_photo= $photo->getClientOriginalName();
      $uplode_photo = 'img/Photo';
      $photo->move($uplode_photo,$nama_photo);
      DB::table('pegawai')->insert([
        'nip'=>$request->nip,
        'nama_pgw' => $request->nama_pgw,
        'alamat_pgw' => $request->alamat_pgw,
        'no_telp_pgw' => $request->no_telp_pgw,
        'email_pgw' => $request->email_pgw,
        'jabatan' => $request->jabatan_pgw,
        'foto' => $nama_photo,
        'button' => $button,
        'password' => bcrypt($request->password_pgw),
        'remember_token'=> csrf_token(),
      ]);
      Session::flash('sukses','Anda Berhasil Input Data!');
      return redirect('/Master-Pegawai');
    }
  }
  public function InsertKonsumen(Request $request)
  {
    $data=DB::table('konsumen')->where('no_identitas',$request->nip)->first();
    if($data)
    {
      Session::flash('gagal','Maaf No Induk Pegawai Yang Anda Masukan Sudah Ada !');
      return redirect('/Master-Konsumen');
    }
    else{
      $photo = $request->file('foto');
      $nama_photo= $photo->getClientOriginalName();
      $uplode_photo = 'img/Photo';
      $photo->move($uplode_photo,$nama_photo);
      DB::table('konsumen')->insert([
        'no_identitas'=>$request->nip,
        'nama_ksm' => $request->nama_konsumen,
        'no_brizzi' => $request->no_brizzi,
        'saldo' => $request->saldo,
        'foto' => $nama_photo,
      ]);
      Session::flash('sukses','Anda Berhasil Input Data!');
      return redirect('/Master-Konsumen');
    }
  }
  /* -------- End Proses Insert -------*/
  /* -------- Proses Delete -------*/
  public function DeleteKategori($kode)
  {
    DB::table('kategori')->where('kode_ktg',$kode)->delete();
    Session::flash('sukses','Anda Berhasil Delete Kategori');
    return redirect('/Master-Kategori');
  }
  public function DeleteSuplier($kode)
  {
    DB::table('suplier')->where('kode_spl',$kode)->delete();
    Session::flash('sukses','Anda Berhasil Delete Suplier');
    return redirect('/Master-Suplier');
  }
  public function DeletePegawai($nip)
  {
    $delete = DB::table('pegawai')->where('nip',$nip)->first();
    File::delete('img/Photo'.$delete->foto);

    DB::table('pegawai')->where('nip',$nip)->delete();
    Session::flash('sukses','Anda Berhasil Delete Pegawai');
    return redirect('/Master-Pegawai');
  }
  public function DeleteKonsumen($nip)
  {
    $delete = DB::table('konsumen')->where('no_identitas',$nip)->first();
    File::delete('img/Photo'.$delete->foto);

    DB::table('konsumen')->where('no_identitas',$nip)->delete();
    Session::flash('sukses','Anda Berhasil Delete Konsumen');
    return redirect('/Master-Konsumen');
  }
  public function DeleteBarang($kode)
  {
    $delete = DB::table('barang')->where('kode_brg',$kode)->first();

    DB::table('barang')->where('kode_brg',$kode)->delete();
    Session::flash('sukses','Anda Berhasil Delete Barang');
    return redirect('/Master-Barang');
  }
  /* -------- End Proses Delete -------*/
  /* -------- Proses Search -------*/
  public function autocomplete($kode)
   {
     $term=$request->get('term');
     $datas=DB::table('barang')->where('kode_brg','like','%' .$term. '%')->get();
     $names=array();
     foreach ($datas as $data) {
       array_push($names, $data['kode_brg']);
     }
     echo json_encode($names);

   }
  /* -------- End Proses Search -------*/
}
