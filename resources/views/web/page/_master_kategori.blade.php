@extends('web._index')
@section('konten')
  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox ">
          <div class="ibox-title">
            <h5>Master Kategori Barang ~ E-Kantin </h5>
            <div class="ibox-tools">
              <a>
              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Kategori"><i class="fa fa-plus"></i> Tambah Kategori</button>
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
                    <th>Kode Kategori</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;?>
                  @foreach($kategori as $ktg)
                  <?php $no++ ;?>
                  <tr class="gradeX">
                    <td>{{ $no }}</td>
                    <td>{{$ktg->kode_ktg}}</td>
                    <td>{{$ktg->kategori}}</td>
                    <td><a href="Delete-Kategori/{{ $ktg->kode_ktg }}"><button class="btn btn-danger btn-rounded btn-xs" type="button"><i class="fa fa-trash"></i> Hapus</button></a></td>
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
  <div id="Kategori" class="modal fade" role="dialog">
    <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
					<h4 class="modal-title">Form Input Kategori Barang</h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
        <form method="POST" action="{{ route('Insert.Kategori') }}"  method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
  			  <div class="modal-body">
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Kode Kategori</label>
  					  <div class="col-sm-8"><input type="text" name="KodeKategori" id="KodeKategori" placeholder="Akan Di Generate Automatis" class="form-control" disabled></div>
            </div>
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Nama Kategori Barang</label>
  					  <div class="col-sm-8"><input type="text" name="NamaKategori" id="NamaKategori" placeholder="Nama Kategori Barang" class="form-control"></div>
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
