@extends('template_backend.home')
@section('heading', 'Data Kelas')
@section('page')
  <li class="breadcrumb-item active">Data Kelas</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
          <h3 class="card-title">
              <button type="button" class="btn btn-primary btn-sm" onclick="getCreateKelas()" data-toggle="modal" data-target="#form-kelas">
                  <i class="nav-icon fas fa-folder-plus"></i> &nbsp; Tambah Data Kelas
              </button>
          </h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="example1" class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Kelas</th>
                    <th>Ruang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kelas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama_kelas }}</td>
                    <td>{{$data->paket_id}}</td>
                    <td>{{ $data->dosen->nama_dosen }}</td>
                    <td>
                        <form action="{{ route('kelas.destroy', $data->id) }}" method="post">
                            @csrf
                            @method('delete')
                            {{--<button type="button" class="btn btn-info btn-sm" onclick="getSubsMhs({{$data->id}})" data-toggle="modal" data-target=".view-mhs">
                              <i class="nav-icon fas fa-users"></i> &nbsp; View mhs
                            </button>
                            <button type="button" class="btn btn-info btn-sm" onclick="getSubsJadwal({{$data->id}})" data-toggle="modal" data-target=".view-jadwal">
                              <i class="nav-icon fas fa-calendar-alt"></i> &nbsp; View Jadwal
                            </button>--}}
                            <button type="button" class="btn btn-success btn-sm" onclick="getEditKelas({{$data->id}})" data-toggle="modal" data-target="edit-kelas">
                              <i class="nav-icon fas fa-edit"></i> &nbsp; Edit
                            </button>
                            <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->

<!-- Extra large modal -->
<div class="modal fade bd-example-modal-md" id="form-kelas" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="judul"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('kelas.store') }}" method="post">
          @csrf
          <div class="row">
            <div class="col-md-12">
              {{--<input type="hidden" id="id" name="id">--}}
              <div class="form-group" id="form_nama"></div>
              <div class="form-group" id="form_paket">
                <label for="penguji_id">Ruang</label>
                <select id="paket_id" name="paket_id" class="select2bs4 form-control @error('paket_id') is-invalid @enderror">
                <option value="">-- Pilih Ruangan --</option>
                 @foreach ($ruang as $data)
                  <option value="{{ $data->id }}">{{ $data->nama_ruang }}</option>
                 @endforeach
               </select>
              </div>
              <div class="form-group">
                <label for="dosen_id">Pemimpin Sidang</label>
                <select id="dosen_id" name="dosen_id" class="select2bs4 form-control @error('dosen_id') is-invalid @enderror">
                  <option value="">-- Pilih Pemimpin Sidang --</option>
                  @foreach ($dosen as $data)
                    <option value="{{ $data->id }}">{{ $data->nama_dosen }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Tambahkan</button>
      </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade bd-example-modal-md" id="edit-kelas" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title" id="judul_edit">Edit Kelas</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
          </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('kelas.store') }}" method="post">
          @csrf
          <div class="row">
            <div class="col-md-12">
              <input type="hidden" id="id_edit" name="id">
              <div class="form-group" id="edit_nama">
                <label for="nama_kelas">Nama Kelas</label>
                <input type='text' id="edit_nama_kelas" onkeyup="this.value = this.value.toUpperCase()" name='nama_kelas' class="form-control @error('nama_kelas') is-invalid @enderror" placeholder="{{ __('Nama Kelas') }}">
              </div>
              <div class="form-group" id="edit_paket">
                <label for="penguji_id">Ruang</label>
                <select id="edit_paket_id" name="paket_id" class="select2bs4 form-control @error('paket_id') is-invalid @enderror">
                <option value="">-- Pilih Ruangan --</option>
                 @foreach ($ruang as $data)
                  <option value="{{ $data->nama_ruang }}">{{ $data->nama_ruang }}</option>
                 @endforeach
               </select>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</button>
            <button type="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Update</button>
      </form>
      </div>
    </div>
  </div>
</div>

<!-- Extra large modal -->
<div class="modal fade bd-example-modal-lg view-mhs" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="judul-mhs">View mhs</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <div class="card-body">
              <table class="table table-bordered table-striped table-hover" width="100%">
                <thead>
                  <tr>
                    <th>No Induk mhs</th>
                    <th>Nama mhs</th>
                    <th>L/P</th>
                    <th>Foto mhs</th>
                  </tr>
                </thead>
                <tbody id="data-mhs">
                </tbody>
                <tfoot>
                  <tr>
                    <th>No Induk mhs</th>
                    <th>Nama mhs</th>
                    <th>L/P</th>
                    <th>Foto mhs</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.col -->
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</button>
          <a id="link-mhs" href="#" class="btn btn-primary"><i class="nav-icon fas fa-download"></i> &nbsp; Download PDF</a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Extra large modal -->
<div class="modal fade bd-example-modal-xl view-jadwal" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title" id="judul-jadwal">View Jadwal</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <div class="row">
        <div class="col-md-12">
          <div class="card-body">
            <table class="table table-bordered table-striped table-hover" width="100%">
              <thead>
                <tr>
                  <th>Hari</th>
                  <th>Jadwal</th>
                  <th>Jam Pelajaran</th>
                  <th>Ruang Kelas</th>
                </tr>
              </thead>
              <tbody id="data-jadwal">
              </tbody>
              <tfoot>
                <tr>
                  <th>Hari</th>
                  <th>Jadwal</th>
                  <th>Jam Pelajaran</th>
                  <th>Ruang Kelas</th>
                </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.col -->
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</button>
        <a id="link-jadwal" href="#" class="btn btn-primary"><i class="nav-icon fas fa-download"></i> &nbsp; Download PDF</a>
      </div>
    </div>
  </div>
</div>
@endsection
@section('script')
  <script>
    function getCreateKelas(){
      $("#judul").text('Tambah Data Kelas');
      $('#id').val('');
      $('#form_nama').html(`
        <label for="nama_kelas">Nama Kelas</label>
        <input type='text' id="nama_kelas" onkeyup="this.value = this.value.toUpperCase()" name='nama_kelas' class="form-control @error('nama_kelas') is-invalid @enderror" placeholder="{{ __('Nama Kelas') }}">
      `);
      $('#nama_kelas').val('');
      /*$('#form_paket').html('');
      $('#form_paket').html(`
        <label for="paket_id">Paket Keahlian</label>
        <select id="paket_id" name="paket_id" class="select2bs4 form-control @error('paket_id') is-invalid @enderror">
          <option value="">-- Pilih Paket Keahlian --</option>
          @foreach ($paket as $data)
            <option value="{{ $data->id }}">{{ $data->ket }}</option>
          @endforeach
        </select>
      `);*/
      $('#dosen_id').val('');
    }

    function getEditKelas(id){
      var parent = id;
      /*var form_paket = (`
        <input type="hidden" id="paket_id" name="paket_id">
        <input type="hidden" id="nama_kelas" name="nama_kelas">
      `);*/
      $.ajax({
        type:"GET",
        data:"id="+parent,
        dataType:"JSON",
        url:"{{ url('/kelas/edit/json') }}",
        success:function(result){
             console.log(val.paket_id);
          if(result){
            $.each(result,function(index, val){
              $('#id_edit').val(val.id);
              $('#edit_nama_kelas').val(val.nama);
              $('#edit_paket_id').val(val.paket_id);
              /*$("#judul").text('Edit Data Kelas ' + val.nama);
              $('#id').val(val.id);
              $('#form_nama').html('');
              $('#form_paket').html('');
              $("#form_paket").append(form_paket);
              $('#nama_kelas').val(val.nama);
              $("#paket_id").val(val.paket_id);
              $('#dosen_id').val(val.dosen_id);*/
            });
          }
        },
        error:function(){
          toastr.error("Errors 404!");
        },
        complete:function(){
        }
      });
    }

    function getSubsMhs(id){
      var parent = id;
      $.ajax({
        type:"GET",
        data:"id="+parent,
        dataType:"JSON",
        url:"{{ url('/mhs/view/json') }}",
        success:function(result){
          // console.log(result);
          var mhs = "";
          if(result){
            $.each(result,function(index, val){
              $("#judul-mhs").text('View Data Mhs ' + val.kelas);
              mhs += "<tr>";
                mhs += "<td>"+val.no_induk+"</td>";
                mhs += "<td>"+val.nama_mhs+"</td>";
                mhs += "<td>"+val.jk+"</td>";
                mhs += "<td><img src='"+val.foto+"' width='100px'></td>";
              mhs+="</tr>";
            });
            $("#data-mhs").html(mhs);
          }
        },
        error:function(){
          toastr.error("Errors 404!");
        },
        complete:function(){
        }
      });
      $("#link-mhs").attr("href", "https://siakad.didev.id/listmhspdf/"+id);
    }
    
    function getSubsJadwal(id){
      var parent = id;
      $.ajax({
        type:"GET",
        data:"id="+parent,
        dataType:"JSON",
        url:"{{ url('/jadwal/view/json') }}",
        success:function(result){
          // console.log(result);
          var jadwal = "";
          if(result){
            $.each(result,function(index, val){
              $("#judul-jadwal").text('View Data Jadwal ' + val.kelas);
              jadwal += "<tr>";
                jadwal += "<td>"+val.hari+"</td>";
                jadwal += "<td><h5 class='card-title'>"+val.team+"</h5><p class='card-text'><small class='text-muted'>"+val.dosen+"</small></p></td>";
                jadwal += "<td>"+val.jam_mulai+" - "+val.jam_selesai+"</td>";
                jadwal += "<td>"+val.ruang+"</td>";
              jadwal+="</tr>";
            });
            $("#data-jadwal").html(jadwal);
          }
        },
        error:function(){
          toastr.error("Errors 404!");
        },
        complete:function(){
        }
      });
      $("#link-jadwal").attr("href", "https://siakad.didev.id/jadwalkelaspdf/"+id);
    }

    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataKelas").addClass("active");
  </script>
@endsection