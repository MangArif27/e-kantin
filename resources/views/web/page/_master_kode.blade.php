@extends('web._index')
@section('konten')
  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox ">
          <div class="ibox-title">
            <h5>Master Kode Barang  ~  E-Kantin Lapas Kelas IIB Ciamis</h5>
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
                  <tr class="gradeX">
                    <td>1</td>
                    <td>899272700516</td>
                    <td class="center">Pembersih Wajah</td>
                    <td class="center">Biore Men Strip Black</td>
                    <td><button class="btn btn-danger btn-rounded btn-xs" type="button"><i class="fa fa-trash"></i> Hapus</button> <button class="btn btn-primary btn-rounded btn-xs" type="button"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</button></td>
                  </tr>
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
					<h4 class="modal-title">Form Input Data Anggota</h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
			  <div class="modal-body">
				  <div class="form-group row"><label class="col-sm-4 col-form-label">No Induk Siswa</label>
					  <div class="col-sm-8"><input type="number" name="nis" id="nis" placeholder=" No Induk Siswa" class="form-control"></div>
          </div>
				  <div class="form-group row"><label class="col-sm-4 col-form-label">Nama Lengkap</label>
					  <div class="col-sm-8"><input type="text" name="nama" id="nama" placeholder="Nama Lengkap Siswa" class="form-control"></div>
          </div>
  				<div class="form-group row">
  					<label class="col-sm-4 col-form-label">Kelas</label>
  					<div class="col-sm-8">
  					<select data-placeholder="~ Pilih Kelas ~" class="chosen-select form-control"  tabindex="2">
  						<option disabled selected>~ Pilih Kelas ~</option>
  						<option value="X TMP">X TMP</option>
  						<option value="X TKJ">X TKJ</option>
  						<option value="X TKR">X TKR</option>
  						<option value="XI TMP">XI TMP</option>
  						<option value="XI TKJ">XI TKJ</option>
  						<option value="XI TKR">XI TKR</option>
  						<option value="XII TMP">XII TMP</option>
  						<option value="XII TKJ">XII TKJ</option>
  						<option value="XII TKR">XII TKR</option>
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
