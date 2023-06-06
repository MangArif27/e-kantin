@extends('web._index')
@section('konten')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type='text/javascript'>
  $(window).load(function() {
    $("#TipeBayar").change(function() {
      console.log($("#TipeBayar option:selected").val());
      if ($("#TipeBayar option:selected").val() == 'Tunai') {
        $('#NamaWBP').prop('hidden', true);
        $('#Tunai').prop('hidden', false);
      } else {
        $('#NamaWBP').prop('hidden', false);
        $('#Tunai').prop('hidden', true);
      }
    });
  });
</script>
<div class="wrapper wrapper-content animated fadeInRight">
  <div class="row">
    <div class="col-md-9">
      <?php $Date = date('dmY');
      $Datenow = date('Y-m-d'); ?>
      <form method="POST" action="{{ route('Insert.Nota.Penjualan') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="ibox ">
          <div class="ibox-title">
            <h5>Input Data Barang ~ E-Kantin</h5>
            <div class="ibox-tools">
              <?php $CountNota = DB::table('penjualan')->where('toko', 'AB')->where('tanggal', $Datenow)->count(); ?>
              @if($CountNota==0)
              <label class="col-form-label">No Nota : AB-00{{$CountNota+1}}-{{$Date}}</label>
              <input type="text" value="AB-00{{$CountNota+1}}-{{$Date}}" class="form-control" name="Nota" hidden>
              <input type="text" class="form-control" value="{{$CountNota+1}}" name="NoUrutNota" hidden>
              @else
              <?php $GetNota = DB::table('penjualan')->where('toko', 'AB')->where('tanggal', $Datenow)->get(); ?>
              @if($GetNota->status=="Belum Bayar")
              <label class="col-form-label">No Nota : {{$GetNota->kode_nota}}</label>
              <input type="text" value="{{$GetNota->kode_nota}}" class="form-control" name="Nota" hidden>
              <input type="text" class="form-control" value="{{$GetNota->no_urut_nota+1}}" name="NoUrutNota" hidden>
              @else
              <label class="col-form-label">No Nota : AB-00{{$GetNota->no_urut_nota+1}}-{{$Date}}</label>
              <input type="text" value="{{$GetNota->no_urut_nota+1}}" class="form-control" name="Nota" hidden>
              <input type="text" class="form-control" value="{{$GetNota->no_urut_nota+1}}" name="NoUrutNota" hidden>
              @endif
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
                <?php $no = 1; ?>
                @foreach($penjualan as $pj)
                @foreach(DB::table('barang')->get() as $brg)
                @if($pj->kode_barang==$brg->kode_brg)
                <tr class="gradeX">
                  <td>{{$no++}}</td>
                  <td>{{$pj->kode_barang}}</td>
                  <td>{{$brg->nama_brg}}</td>
                  <form method="post" action="{{ route('Update.Nota.Penjualan') }}" id="Update{{$pj->id}}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <td><input type="text" class="col-sm-9 form-control" value="{{$pj->id}}" name="IdData" hidden>
                      <input type="text" class="col-sm-9 form-control" value="{{$pj->harga}}" name="harga_brg{{$pj->id}}" id="harga_brg{{$pj->id}}" disabled onkeyup="<?php echo "sum" . "$pj->id" . "();" ?>">
                    </td>
                    <td><input type="text" class="col-sm-6 form-control" value="{{$pj->jumlah}}" name="jml_brg{{$pj->id}}" id="jml_brg{{$pj->id}}" onkeyup="<?php echo "sum" . "$pj->id" . "();" ?>"></td>
                    <td><input type="text" class="col-sm-9 form-control" value="{{$pj->total_harga}}" name="jml_harga{{$pj->id}}" id="jml_harga{{$pj->id}}" onkeyup="copytextbox();" readonly> </td>
                  </form>
                  <td><button type="submit" form="Update{{$pj->id}}" class="btn btn-primary btn-rounded btn-xs"><i class="fa fa-save"></i> Simpan</button></td>
                </tr>
                @endif
                @endforeach
                @endforeach
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
        @foreach(DB::table('penjualan')->where('kode_nota', $GetNota->kode_nota)->get() as $TotalHarga)
        <?php $ArrayHarga[] = $TotalHarga->total_harga;
        $ArrayBarang[] = $TotalHarga->jumlah;
        $JmlhHarga = array_sum($ArrayHarga);
        $JmlhBarang = array_sum($ArrayBarang) ?>
        @endforeach
        <form method="post" action="{{ route('Insert.Penjualan') }}" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="ibox-content">
            <span>Total</span>
            <div class="form-group">
              <h2 class="font-bold"><input type="number" class="col-sm-12 form-control" value="{{$JmlhHarga}}" name="jml_harga_all" id="jml_harga_all" onkeyup="sum();" readonly></h2>
              <input type="text" class="col-sm-12 form-control" value="{{$GetNota->kode_nota}}" name="KodeNota" hidden>
              <input type="text" class="col-sm-12 form-control" value="{{$JmlhBarang}}" name="JumlahBarang" hidden>
            </div>
            <hr />
            <div class="form-group">
              <label class="col-sm-6 col-form-label">Tipe Bayar </label>
              <select class="chosen-select col-sm-9 form-control" name="TipeBayar" id="TipeBayar" tabindex="2">
                <option disabled selected>~ Tipe Bayar ~</option>
                <option value="Tunai">Tunai</option>
                <option value="Hutang">Hutang</option>
              </select>
            </div>
            <div class="form-group" id="NamaWBP" hidden>
              <label class="col-sm-6 col-form-label">Nama WBP </label>
              <input type="text" class="col-sm-12 form-control" name="NamaWBP" require>
            </div>
            <div class="form-group" id="Tunai" hidden>
              <label class="col-sm-12 col-form-label">Jumlah Dibayar </label>
              <input type="text" class="col-sm-12 form-control" name="JumlahDibayar" id="JumlahDibayar" onkeyup="sum();" require>
              <label class="col-sm-12 col-form-label">Kembalian </label>
              <input type="text" class="col-sm-12 form-control" name="JumlahKembalian" id="JumlahKembalian" readonly>
            </div>
            <div class="m-t-sm">
              <div class="btn-group">
                <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-shopping-cart"></i> Simpan</button>
                <a href="#" class="btn btn-white btn-sm"> Cancel</a>
              </div>
            </div>
          </div>
        </form>
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
@foreach($penjualan as $pj)
<script>
  function <?php echo "sum" . "$pj->id" . "()" ?> {
    var <?php echo "txtFirstNumberValue" . $pj->id ?> = document.getElementById('harga_brg{{$pj->id}}').value;
    var <?php echo "txtSecondNumberValue" . $pj->id ?> = document.getElementById('jml_brg{{$pj->id}}').value;
    var <?php echo "result" . $pj->id ?> = parseInt(<?php echo "txtFirstNumberValue" . $pj->id ?>) * parseInt(<?php echo "txtSecondNumberValue" . $pj->id ?>);
    if (!isNaN(<?php echo "result" . $pj->id ?>)) {
      document.getElementById('jml_harga{{$pj->id}}').value = <?php echo "result" . $pj->id ?>;
    }
  }
</script>
@endforeach
<script>
  function sum() {
    var JumlahAwal = document.getElementById('jml_harga_all').value;
    var JumlahBayar = document.getElementById('JumlahDibayar').value;
    var Hasil = parseInt(JumlahAwal) - parseInt(JumlahBayar);
    if (!isNaN(Hasil)) {
      document.getElementById('JumlahKembalian').value = Hasil;
    }
  }
</script>
@endsection