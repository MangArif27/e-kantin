@extends('web._index')
@section('konten')
  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox ">
          <div class="ibox-title">
            <h5>Master Pegawai ~ E-Kantin Lapas Kelas IIB Ciamis</h5>
            <div class="ibox-tools">
              <a>
              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#Pegawai"><i class="fa fa-plus"></i> Tambah Pegawai</button>
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
                    <th>No Induk Pegawai</th>
                    <th>Nama Pegawai</th>
                    <th>Alamat</th>
                    <th>No Handphone</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 0;?>
                  @foreach($pegawai as $pgw)
                  <?php $no++ ;?>
                  <tr class="gradeX">
                    <td>{{ $no }}</td>
                    <td>{{$pgw->nip}}</td>
                    <td>{{$pgw->nama_pgw}} </td>
                    <td>{{$pgw->alamat_pgw}}</td>
                    <td>{{$pgw->no_telp_pgw}}</td>
                    <td><a href="Delete-Pegawai/{{ $pgw->nip }}"><button class="btn btn-danger btn-rounded btn-xs" type="button"><i class="fa fa-trash"></i> Hapus</button></a> <button class="btn btn-primary btn-rounded btn-xs" type="button"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</button></td>
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
  <div id="Pegawai" class="modal fade" role="dialog">
    <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
					<h4 class="modal-title">Form Input Pegawai</h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
        <form method="POST" action="{{ route('Insert.Pegawai') }}"  method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
  			  <div class="modal-body">
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">No Induk Pegawai</label>
  					  <div class="col-sm-8"><input type="text" name="nip" id="nip" placeholder="No Induk Pegawai"  class="form-control" ></div>
            </div>
  				  <div class="form-group row"><label class="col-sm-4 col-form-label">Nama Pegawai</label>
  					  <div class="col-sm-8"><input type="text" name="nama_pgw" id="nama_pgw" placeholder="Nama Pegawai" class="form-control"></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Alamat</label>
  					  <div class="col-sm-8"><textarea name="alamat_pgw" id="alamat_pgw" placeholder="Alamat Pegawai" class="form-control"></textarea></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">No Handphone</label>
  					  <div class="col-sm-8"><input type="number" name="no_telp_pgw" id="no_telp_pgw" placeholder="No Handphone" class="form-control"></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">E-mail</label>
  					  <div class="col-sm-8"><input type="email" name="email_pgw" id="email_pgw" placeholder="Nama Barang" class="form-control"></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Jabatan </label>
  					  <div class="col-sm-8">
                <select class="form-control " name="jabatan_pgw">
                  <option>Kepala Kantin</option>
                  <option>Sekretaris</option>
                  <option>Bendahara</option>
                  <option>Kasir</option>
                </select>
              </div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Photo </label>
  					  <div class="col-sm-8"><input type="file" name="photo_pgw" id="photo_pgw" placeholder="Photo" class="form-control"></div>
            </div>
            <div class="form-group row"><label class="col-sm-4 col-form-label">Password</label>
  					  <div class="col-sm-8"><input type="password" name="password_pgw" id="password_pgw" placeholder="Password" class="form-control"></div>
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
