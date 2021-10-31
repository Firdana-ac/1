@extends('template_backend.home')
@section('heading', 'Edit Jadwal')
@section('page')
  <li class="breadcrumb-item active"><a href="{{ route('jadwal.index') }}">Jadwal</a></li>
  <li class="breadcrumb-item active">Edit Jadwal</li>
@endsection
@section('content')
<div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Edit Data Jadwal</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <form action="{{ route('jadwal.update', Crypt::encrypt($jadwal->id)) }}" method="post">
          @csrf
          @method('patch')
          <div class="row">
              <div class="col-md-6">
  
              <div class="form-group">
                  <label for="jam_mulai">Judul</label>
                  <input type='text' id="judul" name='judul' class="form-control @error('judul') is-invalid @enderror judul" placeholder="judul" value="{{ $jadwal->judul ?? old('judul') }}">
                </div>
                <div class="form-group">
                  <label for="hari_id">Hari</label>
                  <select id="hari_id" name="hari_id" class="form-control @error('hari_id') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Hari --</option>
                      @foreach ($hari as $data)
                          <option @if($data->id == $jadwal->hari_id) selected @endif value="{{ $data->id }}">{{ $data->nama_hari }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="kelas_id">Kelas</label>
                  <select id="kelas_id" name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Kelas --</option>
                      @foreach ($kelas as $data)
                          <option @if($data->id == $jadwal->kelas_id) selected @endif value="{{ $data->id }}">{{ $data->nama_kelas }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="promotor">Promotor</label>
                  <select id="promotor" name="promotor" class="form-control @error('promotor') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Promotor --</option>
                      @foreach ($dosen as $data)
                          <option @if($data->id_card == $jadwal->promotor) selected @endif value="{{ $data->id_card }}">{{ $data->nama_dosen }}</option>
                      @endforeach
                  </select>
                </div>
                
                <div class="form-group">
                  <label for="kopromotor2">Ko Promotor 2</label>
                  <select id="kopromotor2" name="kopromotor2" class="form-control @error('kopromotor2') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Ko Promotor 2 --</option>
                      @foreach ($dosen as $data)
                          <option  @if($data->id_card == $jadwal->kopromotor_2) selected @endif value="{{ $data->id_card }}">{{ $data->nama_dosen }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="penguji2">Penguji 2</label>
                  <select id="penguji2" name="penguji2" class="form-control @error('penguji2') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Penguji 2 --</option>
                      @foreach ($dosen as $data)
                          <option @if($data->id_card == $jadwal->penguji_2) selected @endif value="{{ $data->id_card }}">{{ $data->nama_dosen }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="penguji4">Penguji 4</label>
                  <select id="penguji4" name="penguji4" class="form-control @error('penguji4') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Penguji 4 --</option>
                      @foreach ($dosen as $data)
                          <option @if($data->id_card == $jadwal->penguji_4) selected @endif value="{{ $data->id_card }}">{{ $data->nama_dosen }}</option>
                      @endforeach
                  </select>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="jam_mulai">Jam Mulai</label>
                  <input type='text' id="jam_mulai" name='jam_mulai' class="form-control @error('jam_mulai') is-invalid @enderror jam_mulai" placeholder="{{ Date('H:i') }}" value="{{ $jadwal->jam_mulai }}">
                </div>
                <div class="form-group">
                  <label for="jam_selesai">Jam Selesai</label>
                  <input type='text' id="jam_selesai" name='jam_selesai' class="form-control @error('jam_selesai') is-invalid @enderror" placeholder="{{ Date('H:i') }}" value={{ $jadwal->jam_selesai }}>
                </div>
                <div class="form-group">
                  <label for="ruang_id">Ruang Kelas</label>
                  <select id="ruang_id" name="ruang_id" class="form-control @error('ruang_id') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Ruang Kelas --</option>
                      @foreach ($ruang as $data)
                          <option @if($data->id == $jadwal->ruang_id) selected @endif value="{{ $data->id }}">{{ $data->nama_ruang }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="tanggal">Tanggal</label>
                  <input type="date" class="form-control" name="tanggal" value="{{ $jadwal->tanggal }}">
                </div>
                <div class="form-group">
                  <label for="kopromotor1">Ko Promotor 1</label>
                  <select id="kopromotor1" name="kopromotor1" class="form-control @error('kopromotor1') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Ko Promotor 1 --</option>
                      @foreach ($dosen as $data)
                          <option @if($data->id_card == $jadwal->kopromotor_1) selected @endif value="{{ $data->id_card }}">{{ $data->nama_dosen }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="penguji1">Penguji 1</label>
                  <select id="penguji1" name="penguji1" class="form-control @error('penguji1') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Penguji 1 --</option>
                      @foreach ($dosen as $data)
                          <option @if($data->id_card == $jadwal->penguji_1) selected @endif value="{{ $data->id_card }}">{{ $data->nama_penguji }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="penguji3">Penguji 3</label>
                  <select id="penguji3" name="penguji3" class="form-control @error('penguji2') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Penguji 3 --</option>
                      @foreach ($dosen as $data)
                          <option @if($data->id_card == $jadwal->penguji_3) selected @endif value="{{ $data->id_card }}">{{ $data->nama_penguji }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <label for="penguji5">Penguji 5</label>
                  <select id="penguji5" name="penguji5" class="form-control @error('penguji2') is-invalid @enderror select2bs4">
                      <option value="">-- Pilih Penguji 5 --</option>
                      @foreach ($dosen as $data)
                          <option @if($data->id_card == $jadwal->penguji_5) selected @endif value="{{ $data->id_card }}">{{ $data->nama_dosen }}</option>
                      @endforeach
                  </select>
                </div>
                <div class="form-group">
                  <button class="btn btn-info">Update</button>
                </div>
              </div>
          </div>
        </form>
      </div>
      <!-- form start -->
      <!--<form action="{{ route('jadwal.store') }}" method="post">
        @csrf
        <div class="card-body">
          <div class="row">
            <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
            <div class="col-md-6">
              <div class="form-group">
                <label for="hari_id">Hari</label>
                <select id="hari_id" name="hari_id" class="form-control @error('hari_id') is-invalid @enderror select2bs4">
                  <option value="">-- Pilih Hari --</option>
                  @foreach ($hari as $data)
                    <option value="{{ $data->id }}"
                      @if ($jadwal->hari_id == $data->id)
                        selected
                      @endif
                    >{{ $data->nama_hari }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="kelas_id">Kelas</label>
                <select id="kelas_id" name="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror select2bs4">
                  <option value="">-- Pilih Kelas --</option>
                  @foreach ($kelas as $data)
                  <option value="{{ $data->id }}"
                      @if ($jadwal->kelas_id == $data->id)
                        selected
                      @endif
                    >{{ $data->nama_kelas }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="dosen_id">Kode team</label>
                <select id="dosen_id" name="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror select2bs4">
                  <option value="" @if ($jadwal->dosen_id)
                    selected
                  @endif>-- Pilih Kode team --</option>
                  @foreach ($dosen as $data)
                    <option value="{{ $data->id }}"
                      @if ($jadwal->dosen_id == $data->id)
                        selected
                      @endif
                    >{{ $data->kode }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="jam_mulai">Jam Mulai</label>
                <input type='time' value="{{ $jadwal->jam_mulai }}" id="jam_mulai" name='jam_mulai' class="form-control @error('jam_mulai') is-invalid @enderror" placeholder='JJ:mm:dd'>
              </div>
              <div class="form-group">
                <label for="jam_selesai">Jam Selesai</label>
                <input type='time' value="{{ $jadwal->jam_selesai }}" name='jam_selesai' class="form-control @error('jam_selesai') is-invalid @enderror" placeholder='JJ:mm:dd'>
              </div>
              <div class="form-group">
                <label for="ruang_id">Ruang Kelas</label>
                <select id="ruang_id" name="ruang_id" class="form-control @error('ruang_id') is-invalid @enderror select2bs4">
                    <option value="">-- Pilih Ruang Kelas --</option>
                    @foreach ($ruang as $data)
                        <option value="{{ $data->id }}"
                          @if ($jadwal->ruang_id == $data->id)
                            selected
                          @endif
                        >{{ $data->nama_ruang }}</option>
                    @endforeach
                </select>
              </div>
            </div>
          </div>
        </div> -->
        <!-- /.card-body -->

        <div class="card-footer">
          <a href="#" name="kembali" class="btn btn-default" id="back"><i class='nav-icon fas fa-arrow-left'></i> &nbsp; Kembali</a> &nbsp;
          <button name="submit" class="btn btn-primary"><i class="nav-icon fas fa-save"></i> &nbsp; Update</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
</div>
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
        $('#back').click(function() {
        window.location="{{ route('jadwal.show', Crypt::encrypt($jadwal->kelas_id)) }}";
        });
    });
    $("#MasterData").addClass("active");
    $("#liMasterData").addClass("menu-open");
    $("#DataJadwal").addClass("active");
</script>
@endsection