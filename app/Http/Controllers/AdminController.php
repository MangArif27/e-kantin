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
      'kategori' => $request->NamaKategori,
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
      'nama_stn' => $request->NamaSatuanBarang,
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
      'nama_spl' => $request->NamaSuplier,
      'alamat_spl' => $request->AlamatSuplier,
      'no_telp_spl' => $request->NoTelpSuplier,
    ]);
    Session::flash('sukses','Anda Berhasil Input Data!');
    return redirect('/Master-Suplier');
  }
  public function InsertBarang(Request $request)
  {
    date_default_timezone_set('Asia/Jakarta');
    $Created_At=date('Y-m-d H:m:s');
    $Updated_At=date('Y-m-d H:m:s');
    $data=DB::table('kode')->where('kode',$request->KodeBarang)->first();
      if($data)
      {
        DB::table('barang')->insert([
          'kode_brg'=>$request->KodeBarang,
          'nama_brg' => $request->NamaBarang,
          'kode_ktg' => $request->KategoriBarang,
          'kode_spl' => $request->SuplierBarang,
          'jumlah' => $request->JumlahBarang,
          'kode_stn' => $request->SatuanBarang,
          'hrg_beli' => $request->HargaBeliBarang,
          'hrg_jual' => $request->HargaJualBarang,
          'created_at' => $Created_At,
          'updated_at' => $Updated_At,
        ]);
        Session::flash('sukses','Anda Berhasil Input Data!');
        return redirect('/Master-Barang');
      }
    else {
      DB::table('kode')->insert([
        'kode'=>$request->KodeBarang,
        ]);
      DB::table('barang')->insert([
        'kode_brg'=>$request->KodeBarang,
          'nama_brg' => $request->NamaBarang,
          'kode_ktg' => $request->KategoriBarang,
          'kode_spl' => $request->SuplierBarang,
          'jumlah' => $request->JumlahBarang,
          'kode_stn' => $request->SatuanBarang,
          'hrg_beli' => $request->HargaBeliBarang,
          'hrg_jual' => $request->HargaJualBarang,
          'created_at' => $Created_At,
          'updated_at' => $Updated_At,
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
