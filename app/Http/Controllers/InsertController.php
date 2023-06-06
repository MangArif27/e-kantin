<?php

namespace App\Http\Controllers;

use File;

use App\Models\kode;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use function PHPUnit\Framework\isEmpty;

class InsertController extends Controller
{
    /* -------- Proses Insert -------*/
    public function InsertKategori(Request $request)
    {
        $q = DB::table('kategori')->select(DB::raw('MAX(RIGHT(kode_ktg,5)) as kd_max'));
        $prx = "KTG-";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = $prx . sprintf("%06s", $tmp);
            }
        } else {
            $kd = $prx . "000001";
        }
        DB::table('kategori')->insert([
            'kode_ktg' => $kd,
            'kategori' => $request->NamaKategori,
        ]);
        Session::flash('sukses', 'Anda Berhasil Input Data!');
        return redirect('/Master-Kategori');
    }
    public function InsertSatuan(Request $request)
    {
        $q = DB::table('satuan')->select(DB::raw('MAX(RIGHT(kode_ktg,5)) as kd_max'));
        $prx = "STN-";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = $prx . sprintf("%06s", $tmp);
            }
        } else {
            $kd = $prx . "000001";
        }
        DB::table('satuan')->insert([
            'kode_stn' => $kd,
            'nama_stn' => $request->NamaSatuanBarang,
        ]);
        Session::flash('sukses', 'Anda Berhasil Input Data!');
        return redirect('/Master-Satuan');
    }
    public function InsertSuplier(Request $request)
    {
        $q = DB::table('suplier')->select(DB::raw('MAX(RIGHT(kode_spl,5)) as kd_max'));
        $prx = "SPL-";
        if ($q->count() > 0) {
            foreach ($q->get() as $k) {
                $tmp = ((int)$k->kd_max) + 1;
                $kd = $prx . sprintf("%06s", $tmp);
            }
        } else {
            $kd = $prx . "000001";
        }
        DB::table('suplier')->insert([
            'kode_spl' => $kd,
            'nama_spl' => $request->NamaSuplier,
            'alamat_spl' => $request->AlamatSuplier,
            'no_telp_spl' => $request->NoTelpSuplier,
        ]);
        Session::flash('sukses', 'Anda Berhasil Input Data!');
        return redirect('/Master-Suplier');
    }
    public function InsertBarang(Request $request)
    {
        date_default_timezone_set('Asia/Jakarta');
        $Created_At = date('Y-m-d H:m:s');
        $Updated_At = date('Y-m-d H:m:s');
        $data = DB::table('kode')->where('kode', $request->KodeBarang)->first();
        if ($data) {
            DB::table('barang')->insert([
                'kode_brg' => $request->KodeBarang,
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
            Session::flash('sukses', 'Anda Berhasil Input Data!');
            return redirect('/Master-Barang');
        } else {
            DB::table('kode')->insert([
                'kode' => $request->KodeBarang,
            ]);
            DB::table('barang')->insert([
                'kode_brg' => $request->KodeBarang,
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
            Session::flash('sukses', 'Anda Berhasil Input Data!');
            return redirect('/Master-Barang');
        }
    }
    public function  InsertPegawai(Request $request)
    {
        $data = DB::table('pegawai')->where('nip', $request->nip)->first();
        if ($data) {
            Session::flash('gagal', 'Maaf No Induk Pegawai Yang Anda Masukan Sudah Ada !');
            return redirect('/Master-Pegawai');
        } else {
            if ($request->jabatan == "Kepala Kantin") {
                $button = "success";
            } elseif ($request->jabatan == "Sekretaris") {
                $button = "warning";
            } elseif ($request->jabatan == "Bendahara") {
                $button = "primary";
            } else {
                $button = "info";
            }
            $photo = $request->file('photo_pgw');
            $nama_photo = $photo->getClientOriginalName();
            $uplode_photo = 'img/Photo';
            $photo->move($uplode_photo, $nama_photo);
            DB::table('pegawai')->insert([
                'nip' => $request->nip,
                'nama_pgw' => $request->nama_pgw,
                'alamat_pgw' => $request->alamat_pgw,
                'no_telp_pgw' => $request->no_telp_pgw,
                'email_pgw' => $request->email_pgw,
                'jabatan' => $request->jabatan_pgw,
                'foto' => $nama_photo,
                'button' => $button,
                'password' => bcrypt($request->password_pgw),
                'remember_token' => csrf_token(),
            ]);
            Session::flash('sukses', 'Anda Berhasil Input Data!');
            return redirect('/Master-Pegawai');
        }
    }
    public function InsertKonsumen(Request $request)
    {
        $data = DB::table('konsumen')->where('no_identitas', $request->nip)->first();
        if ($data) {
            Session::flash('gagal', 'Maaf No Induk Pegawai Yang Anda Masukan Sudah Ada !');
            return redirect('/Master-Konsumen');
        } else {
            $photo = $request->file('Foto');
            $nama_photo = $photo->getClientOriginalName();
            $uplode_photo = 'img/Photo';
            $photo->move($uplode_photo, $nama_photo);
            DB::table('konsumen')->insert([
                'no_identitas' => $request->NoIdentitasKonsumen,
                'nama_ksm' => $request->NamaKonsumen,
                'no_brizzi' => $request->NoEMoney,
                'saldo' => $request->Saldo,
                'foto' => $nama_photo,
            ]);
            Session::flash('sukses', 'Anda Berhasil Input Data!');
            return redirect('/Master-Konsumen');
        }
    }
    public function InsertNotaPenjualan(Request $request)
    {
        $Datenow = date('Y-m-d');
        DB::table('penjualan')->insert([
            'kode_barang' => $request->KodeBarang,
            'no_urut_nota' => $request->NoUrutNota,
            'kode_nota' => $request->Nota,
            'toko' => "AB",
            'harga' => $request->harga_brg,
            'jumlah' => "1",
            'total_harga' => $request->harga_brg,
            'tipe_bayar' => "-",
            'status' => "Belum Bayar",
            'tanggal' => $Datenow,
        ]);
        Session::flash('sukses', 'Anda Berhasil Input Data!');
        return redirect('/Penjualan');
    }
    public function InsertPenjualan(Request $request)
    {
        $Datenow = date('Y-m-d');
        if ($request->TipeBayar == "Tunai") {
            $Status = "Lunas";
            $JumlahDibayar = $request->JumlahDibayar;
            $JumlahKembalian = $request->JumlahKembalian;
        } else {
            $Status = "Belum Lunas";
            $JumlahDibayar = "-";
            $JumlahKembalian = "-";
        }
        DB::table('data_penjualan')->insert([
            'kode_nota' => $request->KodeNota,
            'jumlah_barang' =>  $request->JumlahBarang,
            'total_harga' => $request->jml_harga_all,
            'jumlah_bayar' => $JumlahDibayar,
            'kembalian' => $JumlahKembalian,
            'identitas_pembeli' => "-",
            'tipe_bayar' => $request->TipeBayar,
            'status' => $Status,
            'keterangan' => "-",
        ]);
        DB::table('penjualan')->where('kode_nota', $request->KodeNota)->update([
            'status' => "Belum Lunas",
        ]);
        Session::flash('sukses', 'Anda Berhasil Input Data!');
        return redirect('/Penjualan');
    }
    /* -------- End Proses Insert -------*/
}
