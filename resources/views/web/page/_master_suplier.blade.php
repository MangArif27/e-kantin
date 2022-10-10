@extends('web._index')
@section('konten')
  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox ">
          <div class="ibox-title">
            <h5>Master Suplier ~ E-Kantin</h5>
            <div class="ibox-tools">
              <a>
              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Suplier"><i class="fa fa-plus"></i> Tambah Suplier</button>
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
                    <th>Kode Suplier</th>
                    <th>Nama Suplier</th>
                    <th>Alamat</th>
                    <th>Telphone</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;?>
                  @foreach($suplier as $spl)
                  <?php $no++ ;?>
                  <tr class="gradeX">
                    <td>{{ $no }}</td>
                    <td>{{$spl->kode_spl}}</td>
                    <td>{{$spl->nama_spl}} </td>
                    <td>{{$spl->alamat_spl}}</td>
                    <td>{{$spl->no_telp_spl}}</td>
                    <td><a href="Delete-Suplier/{{ $spl->kode_spl }}"><button class="btn btn-danger btn-rounded btn-xs" type="button"><i class="fa fa-trash"></i> Hapus</button><button class="btn btn-primary btn-rounded btn-xs" type="button"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</button></td>
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
  <div id="Suplier" class="modal fade" role="dialog">
    <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
					<h4 class="modal-title">Form Input Suplier Barang</h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
        <form method="POST" action="{{ route('Insert.Suplier') }}"  method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
  			  <div class="modal-body">
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Kode Suplier</label>
  					  <div class="col-sm-8"><input type="text" name="KodeSuplier" id="KodeSuplier" placeholder="Akan Di Generate Automatis" class="form-control" disabled></div>
            </div>
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Nama Suplier</label>
  					  <div class="col-sm-8"><input type="text" name="NamaSuplier" id="NamaSuplier" placeholder="Nama Suplier" class="form-control"></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Alamat Suplier</label>
  					  <div class="col-sm-8"><textarea name="AlamatSuplier" id="AlamatSuplier" placeholder="Alamat Suplier" class="form-control"></textarea></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Telphone</label>
  					  <div class="col-sm-8"><input type="number" name="NoTelpSuplier" id="NoTelpSuplier" placeholder="Telphone Suplier" class="form-control"></div>
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
