@extends('web._index')
@section('konten')
  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox ">
          <div class="ibox-title">
            <h5>Master Konsumen ~ E-Kantin</h5>
            <div class="ibox-tools">
              <a>
              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Konsumen"><i class="fa fa-plus"></i> Tambah konsumen</button>
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
            @elseif($gagal = Session::get('gagal'))
            <div class="alert alert-danger alert-dismissable">
              <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
              {{ $gagal }}
            </div>
            @endif
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Identitas</th>
                    <th>Nama Konsumen</th>
                    <th>No Brizzi</th>
                    <th>Saldo</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;?>
                  @foreach($konsumen as $ksm)
                  <?php $no++ ;?>
                  <tr class="gradeX">
                    <td>{{ $no }}</td>
                    <td>{{$ksm->no_identitas}}</td>
                    <td>{{$ksm->nama_ksm}}</td>
                    <td>{{$ksm->no_brizzi}}</td>
                    <td>{{$ksm->saldo}}</td>
                    <td><a href="Delete-Konsumen/{{ $ksm->no_identitas }}"><button class="btn btn-danger btn-rounded btn-xs" type="button"><i class="fa fa-trash"></i> Hapus</button></a> <button class="btn btn-primary btn-rounded btn-xs" type="button"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</button></td>
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
  <div id="Konsumen" class="modal fade" role="dialog">
    <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
					<h4 class="modal-title">Form Input Konsumen</h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
        <form method="POST" action="{{ route('Insert.Konsumen') }}"  method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
  			  <div class="modal-body">
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">No Identitas</label>
  					  <div class="col-sm-8"><input type="text" name="NoIdentitasKonsumen" id="NoIdentitasKonsumen" placeholder="No Identitas"  class="form-control" ></div>
            </div>
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Nama Konsumen</label>
  					  <div class="col-sm-8"><input type="text" name="NamaKonsumen" id="NamaKonsumen" placeholder="Nama Konsumen" class="form-control"></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">E-Money</label>
  					  <div class="col-sm-8"><input type="number" name="NoEMoney" id="NoEMoney" placeholder="NO Brizzi" class="form-control"></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Saldo</label>
  					  <div class="col-sm-8"><input type="number" name="Saldo" id="Saldo" placeholder="Saldo" class="form-control"></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Foto</label>
  					  <div class="col-sm-8"><input type="file" name="Foto" id="Foto" placeholder="Foto" class="form-control"></div>
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
