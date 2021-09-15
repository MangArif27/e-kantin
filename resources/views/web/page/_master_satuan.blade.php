@extends('web._index')
@section('konten')
  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox ">
          <div class="ibox-title">
            <h5>Master Satuan Barang ~ E-Kantin Lapas Kelas IIB Ciamis</h5>
            <div class="ibox-tools">
              <a>
              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Satuan"><i class="fa fa-plus"></i> Tambah Satuan</button>
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
                    <th>Kode Satuan</th>
                    <th>Nama Satuan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;?>
                  @foreach($satuan as $stn)
                  <?php $no++ ;?>
                  <tr class="gradeX">
                    <td>{{ $no }}</td>
                    <td>{{$stn->kode_stn}}</td>
                    <td>{{$stn->nama_stn}}</td>
                    <td><a href="Delete-Satuan/{{ $stn->kode_stn }}"><button class="btn btn-danger btn-rounded btn-xs" type="button"><i class="fa fa-trash"></i> Hapus</button></a></td>
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
  <div id="Satuan" class="modal fade" role="dialog">
    <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
					<h4 class="modal-title">Form Input Kategori Barang</h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
        <form method="POST" action="{{ route('Insert.Satuan') }}"  method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
  			  <div class="modal-body">
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Kode Kategori</label>
  					  <div class="col-sm-8"><input type="text" name="kategori" id="kategori" placeholder="Akan Di Generate Automatis" class="form-control" disabled></div>
            </div>
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Nama Kategori Barang</label>
  					  <div class="col-sm-8"><input type="text" name="nama_satuan" id="nama_satuan" placeholder="Nama Kategori Barang" class="form-control"></div>
            </div>
    			  <div class="modal-footer">
    				  <button type="submit" class="btn btn-primary"><i class="fa fa-save"> Simpan</i></button>
    			  </div>
  			  </div>
        </form>
		  </div>
		</div>
  </div>
@endsection
