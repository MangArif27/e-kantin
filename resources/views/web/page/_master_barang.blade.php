@extends('web._index')
@section('konten')
  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox ">
          <div class="ibox-title">
            <h5>Master Barang ~ E-Kantin </h5>
            <div class="ibox-tools">
              <a>
              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#InputBarang"><i class="fa fa-plus"></i> Tambah Barang</button>
              </a>

            </div>
          </div>
          <div class="ibox-content">
            {{-- notifikasi sukses --}}
            @if ($sukses = Session::get('sukses'))
            <div class="alert alert-success alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
              {{ $sukses }}
            </div>
            @endif
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Detail </th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    <th>Tanggal Input</th>
                    <th>Tanggal Update</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;?>
                  @foreach($barang as $brg)

                  <?php $no++ ;?>
                  <tr class="gradeX">
                    <td>{{ $no }}</td>
                    <td>{{$brg->kode_brg}}</td>
                    <td>{{$brg->nama_brg}}</td>
                    <td><button class="btn btn-primary  btn-xs">Kategori</button> : @foreach($satuan = DB::table('kategori')->where('kode_ktg',$brg->kode_ktg)->get() as $ktg) {{$ktg->kategori}} @endforeach
                    </br><button class="btn btn-warning  btn-xs">Jumlah </button> : {{$brg->jumlah}}  @foreach($satuan = DB::table('satuan')->where('kode_stn',$brg->kode_stn)->get() as $stn) {{$stn->nama_stn}} @endforeach</td>
                    <td>Rp. {{$brg->hrg_beli}}</td>
                    <td>Rp. {{$brg->hrg_jual}}</td>
                    <td>{{$brg->created_at}}</td>
                    <td>{{$brg->updated_at}}</td>
                    <td><a href="Delete-Barang/{{ $brg->kode_brg }}"><button class="btn btn-danger btn-rounded btn-xs" type="button"><i class="fa fa-trash"></i> Hapus</button></a>
                    <button class="btn btn-primary btn-rounded btn-xs" data-toggle="modal" data-target="#LihatBarang{{$brg->kode_brg}}" type="button"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</button>
                    <button class="btn btn-info btn-rounded btn-xs" type="button" data-toggle="modal" data-target="#UpdateBarang{{$brg->kode_brg}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update</button>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="InputBarang" class="modal fade" role="dialog">
    <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
					<h4 class="modal-title">Form Input Barang</h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
        <form method="POST" action="{{ route('Insert.Barang') }}"  method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
  			  <div class="modal-body">
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Kode Barang</label>
  					  <div class="col-sm-8"><input type="text" name="KodeBarang" onkeyup="isi_otomatis()" id="keyword"  class="form-control" ></div>
            </div>
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Nama Barang</label>
  					  <div class="col-sm-8"><input type="text" name="NamaBarang" id="NamaBarang" placeholder="Nama Barang" class="form-control"></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Kategori Barang</label>
  					  <div class="col-sm-8">
                <select class="chosen-select form-control" name="KategoriBarang" tabindex="2">
                  <option disabled selected>~ Pilih Kategori Barang ~</option>
                  @foreach($kategori as $ktg)
                  <option value="{{$ktg->kode_ktg}}">{{$ktg->kategori}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Suplier Barang</label>
  					  <div class="col-sm-8">
                <select class="chosen-select form-control" name="SuplierBarang">
                  <option disabled selected>~ Pilih Suplier Barang ~</option>
                  @foreach($suplier as $spl)
                  <option value="{{$spl->kode_spl}}">{{$spl->nama_spl}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Jumlah Barang</label>
  					  <div class="col-sm-3"><input type="text" name="JumlahBarang" id="JumlahBarang" placeholder="Jumlah Barang" class="form-control"></div>
              <div class="col-sm-5">
                <select class="form-control " name="SatuanBarang" placeholder="Satuan Barang">
                  <option disabled selected>~ Pilih Satuan Barang ~</option>
                  @foreach($satuan as $stn)
                  <option value="{{$stn->kode_stn}}">{{$stn->nama_stn}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Harga Beli Barang</label>
  					  <div class="col-sm-8"><input type="number" name="HargaBeliBarang" id="HargaBeliBarang" placeholder="Harga Beli Barang" class="form-control"></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Harga Jual Barang</label>
  					  <div class="col-sm-8"><input type="number" name="HargaJualBarang" id="HargaJualBarang" placeholder="Harga Jual Barang" class="form-control"></div>
            </div>
    			  <div class="modal-footer">
    				  <button type="submit" class="btn btn-primary"><i class="fa fa-save"> Simpan</i></button>
    			  </div>
  			  </div>
        </form>
		  </div>
		</div>
  </div>
  @foreach($barang as $brg)
  <div id="LihatBarang{{$brg->kode_brg}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
					<h4 class="modal-title">Detail Barang : {{$brg->nama_brg}} ({{$brg->kode_brg}})</h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
        <form method="POST" action="#"  method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
  			  <div class="modal-body">
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Kode Barang</label>
  					  <div class="col-sm-8"><input type="text" name="kode_brg" onkeyup="isi_otomatis()" id="keyword"  class="form-control" value="{{$brg->kode_brg}}" disabled></div>
            </div>
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Nama Barang</label>
  					  <div class="col-sm-8"><input type="text" name="nama_barang" id="nama_barang" placeholder="Nama Barang" class="form-control" value="{{$brg->nama_brg}}" disabled></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Kategori Barang</label>
              <div class="col-sm-8"><input type="text" name="kategori_brg" id="kategori_brg" placeholder="Nama Barang" class="form-control" value="@foreach($satuan = DB::table('kategori')->where('kode_ktg',$brg->kode_ktg)->get() as $ktg) {{$ktg->kategori}} @endforeach" disabled></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Suplier Barang</label>
              <div class="col-sm-8"><input type="text" name="suplier_barang" id="suplier_barang" placeholder="Nama Barang" class="form-control" value="@foreach($suplier = DB::table('suplier')->where('kode_spl',$brg->kode_spl)->get() as $spl) {{$spl->nama_spl}} @endforeach" disabled></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Jumlah Barang</label>
  					  <div class="col-sm-8"><input type="text" name="jumlah_barang" id="jumlah_barang" placeholder="Jumlah Barang" class="form-control" value="{{$brg->jumlah}}  @foreach($satuan = DB::table('satuan')->where('kode_stn',$brg->kode_stn)->get() as $stn) {{$stn->nama_stn}} @endforeach" disabled></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Harga Beli Barang</label>
  					  <div class="col-sm-8"><input type="text" name="nama_beli_barang" id="harga_beli_barang" placeholder="Nama Barang" class="form-control" value="Rp. {{$brg->hrg_beli}}" disabled></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Harga Jual Barang</label>
  					  <div class="col-sm-8"><input type="text" name="nama_jual_barang" id="harga_jual_barang" placeholder="Nama Barang" class="form-control" value="Rp. {{$brg->hrg_jual}}" disabled></div>
            </div>
    			  <div class="modal-footer">
    				  <button type="submit" class="btn btn-primary"><i class="fa fa-save"> Simpan</i></button>
    			  </div>
  			  </div>
        </form>
		  </div>
		</div>
  </div>
  @endforeach
  @foreach($barang as $brg)
  <div id="UpdateBarang{{$brg->kode_brg}}" class="modal fade" role="dialog">
    <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
					<h4 class="modal-title">Update Barang : {{$brg->nama_brg}} ({{$brg->kode_brg}})</h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
        <form method="POST" action="#"  method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
  			  <div class="modal-body">
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Kode Barang</label>
  					  <div class="col-sm-8"><input type="text" name="kode_brg" onkeyup="isi_otomatis()" id="keyword"  class="form-control" value="{{$brg->kode_brg}}" disabled></div>
            </div>
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Nama Barang</label>
  					  <div class="col-sm-8"><input type="text" name="nama_barang" id="nama_barang" placeholder="Nama Barang" class="form-control" value="{{$brg->nama_brg}}"></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Kategori Barang</label>
              <div class="col-sm-8">
                <select class="chosen-select form-control" name="kategori_brg" tabindex="2">
                  <option disabled selected>@foreach($satuan = DB::table('kategori')->where('kode_ktg',$brg->kode_ktg)->get() as $ktg) {{$ktg->kategori}} @endforeach</option>
                  @foreach($kategori as $ktg)
                  <option value="{{$ktg->kode_ktg}}">{{$ktg->kategori}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Suplier Barang</label>
              <div class="col-sm-8">
                <select class="chosen-select form-control" name="suplier_barang">
                  <option disabled selected>@foreach($suplier = DB::table('suplier')->where('kode_spl',$brg->kode_spl)->get() as $spl) {{$spl->nama_spl}} @endforeach</option>
                  @foreach($suplier as $spl)
                  <option value="{{$spl->kode_spl}}">{{$spl->nama_spl}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Jumlah Barang</label>
              <div class="col-sm-3"><input type="text" name="jumlah_barang" id="jumlah_barang" placeholder="Jumlah Barang" class="form-control" value="{{$brg->jumlah}}" disabled></div>
              <div class="col-sm-5">
                <select class="form-control " name="satuan_barang" placeholder="Satuan Barang">
                  <option disabled selected>@foreach($satuan = DB::table('satuan')->where('kode_stn',$brg->kode_stn)->get() as $stn) {{$stn->nama_stn}} @endforeach</option>
                  @foreach($satuan as $stn)
                  <option value="{{$stn->kode_stn}}">{{$stn->nama_stn}}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Harga Beli Barang</label>
  					  <div class="col-sm-8"><input type="text" name="nama_beli_barang" id="harga_beli_barang" placeholder="Nama Barang" class="form-control" value="Rp. {{$brg->hrg_beli}}" disabled></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Harga Jual Barang</label>
  					  <div class="col-sm-8"><input type="text" name="nama_jual_barang" id="harga_jual_barang" placeholder="Nama Barang" class="form-control" value="Rp. {{$brg->hrg_jual}}" disabled></div>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode/Nama Barang</th>
                    <th>Detail</th>
                    <th>Tanggal Update</th>
                    <th>Keterangan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;?>


                  <?php $no++ ;?>
                  <tr class="gradeX">
                    <td>{{ $no }}</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                    <td>1</td>
                  </tr>

                </tbody>
              </table>
            </div>
    			  <div class="modal-footer">
    				  <button type="submit" class="btn btn-primary"><i class="fa fa-save"> Simpan</i></button>
    			  </div>
  			  </div>
        </form>
		  </div>
		</div>
  </div>
  @endforeach
@endsection
