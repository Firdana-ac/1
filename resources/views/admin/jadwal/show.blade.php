@extends('template_backend.home')
@section('heading')
  Data Jadwal {{ $kelas->nama_kelas }}
@endsection
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('jadwal.index') }}">Jadwal</a></li>
  <li class="breadcrumb-item active">{{ $kelas->nama_kelas }}</li>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <a href="{{ route('jadwal.index') }}" class="btn btn-default btn-sm"><i class="nav-icon fas fa-arrow-left"></i> &nbsp; Kembali</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped table-hover">
              <thead>
                  <tr>
                      <th>Hari</th>
                      <th>Judul Disertasi</th>
                      <th>NIM</th>
                      <th>Promotor</th>
                      <th>KoPromotor 1</th>
                      <th>KoPromotor 2</th>
                      <th>Penguji 1</th>
                      <th>Penguji 2</th>
                      <th>Penguji 3</th>
                      <th>Penguji 4</th>
                      <th>Penguji 5</th>
                      <th>Jam Pelajaran</th>
                      <th>Ruang Kelas</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
  
                  <tr>
                      <td>{{ $data->hari->nama_hari  ?? ' - '}}</td>
                      <td>
                          <h5 class="card-title">{{ $data->judul }}</h5>
                          <p class="card-text"><small class="text-muted">{{ $data->mhs->nama_mhs}}</small></p>
                      </td>
                      <td>{{ $data->mhs->nis }}</td>
                      <td>{{ $data->dosen_item($data->promotor)->nama_dosen }}</td>
                      <td>{{ $data->dosen_item($data->kopromotor_1)->nama_dosen  }}</td>
                      <td>{{ $data->dosen_item($data->kopromotor_2)->nama_dosen }}</td>
                      <td>{{ $data->dosen_item($data->penguji_1)->nama_dosen }}</td>
                      <td>{{ $data->dosen_item($data->penguji_2)->nama_dosen }}</td>
                      <td>{{ $data->dosen_item($data->penguji_3)->nama_dosen }}</td>
                      <td>{{ $data->dosen_item($data->penguji_4)->nama_dosen }}</td>
                      <td>{{ $data->dosen_item($data->penguji_5)->nama_dosen }}</td>
                      <td>{{ $data->jam_mulai }} - {{ $data->jam_selesai }}</td>
                      <td>{{ $data->ruang->nama_ruang }}</td>
                      <td>
                        <form action="{{ route('jadwal.destroy', $data->id) }}" method="post">
                          @csrf
                          @method('delete')
                          <a href="{{ route('jadwal.edit',Crypt::encrypt($data->id)) }}" class="btn btn-success btn-sm"><i class="nav-icon fas fa-edit"></i> &nbsp; Edit</a>
                          <button class="btn btn-danger btn-sm"><i class="nav-icon fas fa-trash-alt"></i> &nbsp; Hapus</button>
                        </form>
                      </td>
                  </tr>

              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.col -->
@endsection
@section('script')
    <script>
        $("#MasterData").addClass("active");
        $("#liMasterData").addClass("menu-open");
        $("#DataJadwal").addClass("active");
    </script>
@endsection