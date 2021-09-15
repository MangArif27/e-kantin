@extends('web._index')
@section('konten')
  <div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
      <div class="col-lg-12">
        <div class="ibox ">
          <div class="ibox-title">
            <h5>History Top Up Brizzi ~ E-Kantin Lapas Kelas IIB Ciamis</h5>
            <div class="ibox-tools">
              <a>
              <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#TopUp"><i class="fa fa-plus"></i> Top Up</button>
              </a>

            </div>
          </div>
          <div class="ibox-content">
            <div class="table-responsive">
              <table class="table table-striped table-bordered table-hover dataTables-example" >
                <thead>
                  <tr>
                    <th>No</th>
                    <th>No Identitas</th>
                    <th>Nama Konsumen</th>
                    <th>No Brizzi</th>
                    <th>No Referensi</th>
                    <th>Saldo</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="gradeX">
                    <td>1</td>
                    <td>3207182524650002 </td>
                    <td>Edi Purnomo </td>
                    <td>0145200002591552</td>
                    <td>Crfdawdjwakj654686546</td>
                    <td>Rp. 70.000</td>
                    <td><button class="btn btn-primary btn-rounded btn-xs" type="button"><i class="fa fa-eye" aria-hidden="true"></i> Lihat</button></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="TopUp" class="modal fade" role="dialog">
    <div class="modal-dialog">
		  <div class="modal-content">
			  <div class="modal-header">
					<h4 class="modal-title">Top Up Brizzi</h4>
				  <button type="button" class="close" data-dismiss="modal">&times;</button>
			  </div>
			  <div class="modal-body">
          <div class="form-group row"><label class="col-sm-4 col-form-label">No Brizzi</label>
					  <div class="col-sm-8"><input type="number" name="no_brizzi" id="no_brizzi" placeholder="NO Brizzi" class="form-control"></div>
          </div>
				  <div class="form-group row"><label class="col-sm-4 col-form-label">No Identitas</label>
					  <div class="col-sm-8"><input type="text" name="nip" id="nip" placeholder="No Identitas"  class="form-control" readonly></div>
          </div>
				  <div class="form-group row"><label class="col-sm-4 col-form-label">Nama Konsumen</label>
					  <div class="col-sm-8"><input type="text" name="nama_konsumen" id="nama_konsumen" placeholder="Nama Konsumen" readonly class="form-control"></div>
          </div>
          <div class="form-group row"><label class="col-sm-4 col-form-label">Saldo</label>
					  <div class="col-sm-8"><input type="number" name="saldo" id="saldo" placeholder="Saldo" class="form-control" readonly></div>
          </div>
          <div class="form-group row"><label class="col-sm-4 col-form-label">Top Up Saldo</label>
					  <div class="col-sm-8"><input type="number" name="saldo" id="saldo" placeholder="Saldo" class="form-control" ></div>
          </div>
          <div class="form-group row"><label class="col-sm-4 col-form-label">Nomor Referensi</label>
					  <div class="col-sm-8"><input type="text" name="no_referensi" id="no_referensi" placeholder="Saldo" class="form-control"></div>
          </div>
  			  <div class="modal-footer">
  				  <button type="submit" class="btn btn-primary"><i class="fa fa-save"> Simpan</i></button>
  			  </div>
			  </div>
		  </div>
		</div>
  </div>
@endsection
