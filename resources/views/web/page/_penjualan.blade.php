@extends('web._index')
@section('konten')
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-md-9">
      <?php $Date = date('dmY');
      $Datenow = date('Y-m-d'); ?>
      <form method="POST" action="{{ route('Insert.Nota.Penjualan') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="ibox ">
          <div class="ibox-title">
            <h5>Input Data Barang ~ E-Kantin</h5>
            <div class="ibox-tools">
              <?php $CountNota = DB::table('penjualan')->where('toko', 'AB')->where('tanggal', $Datenow)->count(); ?>
              @if($CountNota==0)
              <label class="col-form-label">No Nota : AB-00{{$CountNota+1}}-{{$Date}}</label>
              <input type="text" value="AB-00{{$CountNota+1}}-{{$Date}}" class="form-control" name="Nota" hidden>
              <input type="text" value="Insert" class="form-control" name="Status" hidden>
              @else
              @foreach(DB::table('penjualan')->where('toko', 'AB')->where('tanggal', $Datenow)->get() as $GetNota)
              <label class="col-form-label">No Nota : {{$GetNota->kode_nota}}</label>
              <input type="text" value="{{$GetNota->kode_nota}}" class="form-control" name="Nota" hidden>
              <input type="text" value="Update" class="form-control" name="Status" hidden>
              @endforeach
              @endif
            </div>
          </div>
          <div class="ibox-content">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Pilih Barang</label>
              <div class="col-sm-3">
                <select class="chosen-select form-control" name="NamaBarang" id="NamaBarang" tabindex="2">
                  <option disabled selected>~ Pilih Barang~</option>
                  @foreach($barang as $brg)
                  <option value="{{$brg->kode_brg}}">{{$brg->nama_brg}}</option>
                  @endforeach
                </select>
              </div>
              <label class="col-sm-2 col-form-label">Kode Barang</label>
              <div class="col-sm-3">
                <select class="chosen-select form-control" name="KodeBarang" id="KodeBarang" tabindex="2">
                  <option disabled selected>~ Kode Barang~</option>
                  @foreach($barang as $brg)
                  <option value="{{$brg->kode_brg}}">{{$brg->kode_brg}} - {{$brg->nama_brg}}</option>
                  @endforeach
                </select>
              </div>
              <div id="KodeBarang" hidden>
                <!--Isian Automatis Status WBP -->
              </div>
              <button class="btn btn-primary btn-rounded btn-l col-sm-2" type="submit"><i class="fa fa-save"> Tambah</i></button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <div class="col-md-3">
      <div class="ibox">
        <div class="ibox-title">
          <h5>Harga Barang</h5>
        </div>
        <div class="ibox-content" id="Harga">
          <!--Isian Automatis Status WBP -->
        </div>
      </div>

    </div>
    <div class="col-md-9">
      <div class="ibox ">
        <div class="ibox-title">
          <h5>Daftar Pembelian ~ E-Kantin</h5>
        </div>
        <div class="ibox-content">
          <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover dataTables-example">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Kode</th>
                  <th>Nama Barang</th>
                  <th>Harga</th>
                  <th>Jumlah</th>
                  <th>Total</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <form name="DaftarBelanja" method="GET" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <tr class="gradeX">
                    <td>1</td>
                    <td>8992745560449</td>
                    <td>Teh Botol Sosron </td>
                    <td><input type="number" class="col-sm-9 form-control" name="harga_brg" id="harga_brg" onkeyup="sum();"></td>
                    <td><input type="number" class="col-sm-6 form-control" name="jml-brg" id="jml-brg" onkeyup="sum();"></td>
                    <td><input type="number" class="col-sm-9 form-control" name="jml_harga" id="jml_harga" onkeyup="copytextbox();" readonly> </td>
                    <td><button class="btn btn-danger btn-rounded btn-xs" type="button"><i class="fa fa-trash"></i> Hapus</button></td>
                  </tr>
                </form>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="ibox">
        <div class="ibox-title">
          <h5>Pembayaran </h5>
        </div>
        <div class="ibox-content">
          <span>Total</span>
          <h2 class="font-bold"><input type="number" class="col-sm-9 form-control" name="jml_harga_all" id="jml_harga_all" readonly></h2>
          <hr />
          <div class="form-group row"><label class="col-sm-6 col-form-label">No Referensi </label>
            <input type="text" name="kode" id="kode" placeholder="Nomor Referensi EDC" class="form-control">
          </div>
        </div>
        <div class="m-t-sm">
          <div class="btn-group">
            <a href="#" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Checkout</a>
            <a href="#" class="btn btn-white btn-sm"> Cancel</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="Pembelian" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Barang</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="form-group row"><label class="col-sm-4 col-form-label">Kode Barang</label>
          <div class="col-sm-8"><input type="text" name="kode" id="keyword" class="form-control"></div>
        </div>
        <div class="form-group row"><label class="col-sm-4 col-form-label">Nama Barang</label>
          <div class="col-sm-8"><input type="text" name="nama_barang" id="nama_barang" placeholder="Nama Barang" class="form-control"></div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary"><i class="fa fa-plus"> Tambah</i></button>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function sum() {
    var txtFirstNumberValue = document.getElementById('harga_brg').value;
    var txtSecondNumberValue = document.getElementById('jml-brg').value;
    var result = parseInt(txtFirstNumberValue) * parseInt(txtSecondNumberValue);
    if (!isNaN(result)) {
      document.getElementById('jml_harga').value = result;
    }
  }

  function copytextbox() {
    document.getElementById('jml_harga_all').value = document.getElementById('jml_harga').value;
  }
</script>
@endsection