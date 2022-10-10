@extends('web._index')
@section('konten')
  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox ">
          <div class="ibox-title">
            <h5>Master Kode Barang  ~  E-Kantin</h5>
            <div class="ibox-tools">
              <a>
              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Kode"><i class="fa fa-plus"></i> Tambah Kode</button>
              </a>

            </div>
          </div>
          <div class="ibox-content">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Kategori</th>
                    <th>Nama Barang</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;?>
                  @foreach($kode as $kode_brg)
                  @foreach($barang as $brg)
                    @if($kode_brg->kode==$brg->kode_brg)
                      @foreach($kategori as $kategori_brg)
                        @if($brg->kode_ktg==$kategori_brg->kode_ktg)
                        <?php $no++ ;?>
                        <tr class="gradeX">
                          <td>{{ $no }}</td>
                          <td>{{ $kode_brg->kode }}</td>
                          <td class="center">{{ $kategori_brg->kategori }}</td>
                          <td class="center">{{ $brg->nama_brg }}</td>
                          <td><button class="btn btn-danger btn-rounded btn-xs" type="button"><i class="fa fa-trash"></i> Hapus</button> <button class="btn btn-primary btn-rounded btn-xs" type="button"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</button></td>
                        </tr>
                        @endif
                      @endforeach
                    @endif
                  @endforeach
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="Kode" class="modal fade" role="dialog">
    <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
					<h4 class="modal-title">Form Input Kode Barang</h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
			  <div class="modal-body">
				  <div class="form-group row"><label class="col-sm-4 col-form-label">Kode Barang</label>
					  <div class="col-sm-8"><input type="number" name="KodeBarang" id="KodeBarang" placeholder="Kode Barang" class="form-control"></div>
          </div>
				  <div class="form-group row"><label class="col-sm-4 col-form-label">Nama Barang</label>
					  <div class="col-sm-8"><input type="text" name="NamaBarang" id="NamaBarang" placeholder="Nama Barang" class="form-control"></div>
          </div>
  				<div class="form-group row">
  					<label class="col-sm-4 col-form-label">Kategori</label>
  					<div class="col-sm-8">
            @foreach($kategori = DB::table('kategori')->get() as $ktg) @endforeach
  					<select data-placeholder="~ Pilih Kategori ~" class="chosen-select form-control"  tabindex="2" name="Kategori">
              <option disabled selected></option>
                @foreach($kategori as $ktg)
                  <option value="{{$ktg->kode_ktg}}">{{$ktg->kategori}}</option>
                @endforeach
  					</select>
  					</div>
  				</div>
  			  <div class="modal-footer">
  				  <button type="submit" class="btn btn-primary"><i class="fa fa-save"> Simpan</i></button>
  			  </div>
			  </div>
		  </div>
		</div>
  </div>
@endsection
