
@extends('template_backend.home')
@section('heading', 'Tanda Tangan dosen')
@section('page')
<li class="breadcrumb-item active">Entry Nilai</li>
@endsection
@section('content')
<head>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jautocalc@1.3.1/dist/jautocalc.js"></script>
	<script type="text/javascript">
		<!--
		$(function() {

			function autoCalcSetup() {
				$('form#cart').jAutoCalc('destroy');
				$('form#cart tr.line_items').jAutoCalc({keyEventsFire: true, decimalPlaces: 2, emptyAsZero: true});
				$('form#cart').jAutoCalc({decimalPlaces: 2});
			}
			autoCalcSetup();


			$('button.row-remove').on("click", function(e) {
				e.preventDefault();

				var form = $(this).parents('form')
				$(this).parents('tr').remove();
				autoCalcSetup();

			});

			$('button.row-add').on("click", function(e) {
				e.preventDefault();

				var $table = $(this).parents('table');
				var $top = $table.find('tr.line_items').first();
				var $new = $top.clone(true);

				$new.jAutoCalc('destroy');
				$new.insertBefore($top);
				$new.find('input[type=text]').val('');
				autoCalcSetup();

			});

		});
		//-->
	</script>
    <div class="col-md-12">
    <!-- general form elements -->
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Entry Nilai</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
<div class="col-md-12">
                    <table class="table" style="margin-top: -10px;">
                        <tr>
                            <td>NIP</td>
                            <td>:</td>
                            <td>{{ $dosen->nip }}</td>
                        </tr>

                        <tr>
                            <td>dosen</td>
                            <td>:</td>
                            <td>{{ $dosen->nama_dosen }}</td>
                        </tr>
                        <tr>
                            <td>Kategori</td>
                            <td>:</td>
                            <td>{{ $dosen->team->nama_team }}</td>
                        </tr>
                        <tr>
                            <td>NIM Mhs</td>
                            <td>:</td>
                            <td>{{ $mhs->count() }}</td>
                        </tr>
                        <tr>
                            <td>Nama Mhs</td>
                            <td>:</td>
                            <td>{{ $dosen->team->nama_team }}</td>
                        </tr>
                        <tr>
                            <td>Program Studi</td>
                            <td>:</td>
                            <td>{{ $dosen->nama_dosen }}</td>
                        </tr>
                        <tr>
                            <td>Judul Disertasi</td>
                            <td>:</td>
                            <td>{{ $dosen->nama_dosen }}</td>
                        </tr>
                        @php
                        $bulan = date('m');
                        $tahun = date('Y');
                        @endphp
                    </table>
                    <hr>
                </div>

<body>
<form id="cart">
<div class="col-md-12">
                    <table class="table table-bordered table-striped table-hover">
                    <h3>Nilai</h3>
                    <br>
                        <thead>
                            <tr>
                                <th class="ctr">BAB</th>
                                <th class="ctr">BOBOT</th>
                                <th class="ctr">NILAI<br>(O-100)</th>
                                <th class="ctr">BOBOT x NILAI</th>
                            </tr>
                        </thead>
                        <tr class="line_items">
			<td>PENGUASAAN PENULISAN</td>
			<td class="ctr"><input type="text" class="text-center" name="qty" value="1" disabled></td>
			<td class="ctr"><input type="text" class="text-center"  maxlength="2" name="price" value=""></td>
			<td class="ctr"><input type="text" class="text-center" name="item_total" value="" jAutoCalc="{qty} * {price}" disabled></td>
		</tr>
		<tr class="line_items">
			<td>SEGI ILMIAH TULISAN</td>
			<td class="ctr"><input type="text" class="text-center" name="qty" value="2" disabled></td>
			<td class="ctr"><input type="text" class="text-center" name="price" value=""></td>
			<td class="ctr"><input type="text" class="text-center" name="item_total" value="" jAutoCalc="{qty} * {price}" disabled></td>
		</tr>
		<tr class="line_items">
			<td>ISI</td>
			<td class="ctr"><input type="text" class="text-center" name="qty" value="1" disabled></td>
			<td class="ctr"><input type="text" class="text-center" name="price" value=""></td>
			<td class="ctr"><input type="text" class="text-center" name="item_total" value="" jAutoCalc="{qty} * {price}" disabled></td>
		</tr>
        <tr class="line_items">
			<td>KEMAMPUAN BERDISKUSI</td>
			<td class="ctr"><input type="text" class="text-center" name="qty" value="2" disabled></td>
			<td class="ctr"><input type="text" class="text-center" name="price" value=""></td>
			<td class="ctr"><input type="text" class="text-center" name="item_total" value="" jAutoCalc="{qty} * {price}" disabled></td>
		</tr>
		<tr>
			<td colspan="3" class="ctr">NILAI AKHIR</td>
			<td class="ctr"><input type="text" class="text-center" name="sub_total" value="" jAutoCalc="SUM({item_total})/6" disabled></td>
		</tr>
		
	</table>
</form>
</body>
<div class="col-md-12">
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th class="ctr">No.</th>
                <th>Nama mhs</th>
                <th class="ctr">ULHA 1</th>
                <th class="ctr">ULHA 2</th>
                <th class="ctr">UTS</th>
                <th class="ctr">ULHA 3</th>
                <th class="ctr">UAS</th>
                <th class="ctr">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <form action="" method="post">
                @csrf
                <input type="hidden" name="dosen_id" value="{{$dosen->id}}">
                <input type="hidden" name="kelas_id" value="{{$kelas->id}}">
                @foreach ($mhs as $data)
                    <input type="hidden" name="mhs_id" value="{{$data->id}}">
                    <tr>
                        <td class="ctr">{{ $loop->iteration }}</td>
                        <td>
                            {{ $data->nama_mhs }}
                            @if ($data->ulangan($data->id) && $data->ulangan($data->id)['id'])
                                <input type="hidden" name="ulangan_id" class="ulangan_id_{{$data->id}}" value="{{ $data->ulangan($data->id)->id }}">
                            @else
                                <input type="hidden" name="ulangan_id" class="ulangan_id_{{$data->id}}" value="">
                            @endif
                        </td>
                        <td class="ctr">
                            @if ($data->ulangan($data->id) && $data->ulangan($data->id)['ulha_1'])
                                <div class="text-center">{{ $data->ulangan($data->id)['ulha_1'] }}</div>
                                <input type="hidden" name="ulha_1" class="ulha_1_{{$data->id}}" value="{{ $data->ulangan($data->id)['ulha_1'] }}">
                            @else
                                <input type="text" name="ulha_1" maxlength="2" onkeypress="return inputAngka(event)" style="margin: auto;" class="form-control text-center ulha_1_{{$data->id}}" autocomplete="off">
                            @endif
                        </td>
                        <td class="ctr">
                            @if ($data->ulangan($data->id) && $data->ulangan($data->id)['ulha_2'])
                                <div class="text-center">{{ $data->ulangan($data->id)['ulha_2'] }}</div>
                                <input type="hidden" name="ulha_2" class="ulha_2_{{$data->id}}" value="{{ $data->ulangan($data->id)['ulha_2'] }}">
                            @else
                                <input type="text" name="ulha_2" maxlength="2" onkeypress="return inputAngka(event)" style="margin: auto;" class="form-control text-center ulha_2_{{$data->id}}" autocomplete="off">
                            @endif
                        </td>
                        <td class="ctr">
                            @if ($data->ulangan($data->id) && $data->ulangan($data->id)['uts'])
                                <div class="text-center">{{ $data->ulangan($data->id)['uts'] }}</div>
                                <input type="hidden" name="uts" class="uts_{{$data->id}}" value="{{ $data->ulangan($data->id)['uts'] }}">
                            @else
                                <input type="text" name="uts" maxlength="2" onkeypress="return inputAngka(event)" style="margin: auto;" class="form-control text-center uts_{{$data->id}}" autocomplete="off">
                            @endif
                        </td>
                        <td class="ctr">
                            @if ($data->ulangan($data->id) && $data->ulangan($data->id)['ulha_3'])
                                <div class="text-center">{{ $data->ulangan($data->id)['ulha_3'] }}</div>
                                <input type="hidden" name="ulha_3" class="ulha_3_{{$data->id}}" value="{{ $data->ulangan($data->id)['ulha_3'] }}">
                            @else
                                <input type="text" name="ulha_3" maxlength="2" onkeypress="return inputAngka(event)" style="margin: auto;" class="form-control text-center ulha_3_{{$data->id}}" autocomplete="off">
                            @endif
                        </td>
                        <td class="ctr">
                            @if ($data->ulangan($data->id) && $data->ulangan($data->id)['uas'])
                                <div class="text-center">{{ $data->ulangan($data->id)['uas'] }}</div>
                                <input type="hidden" name="uas" class="uas_{{$data->id}}" value="{{ $data->ulangan($data->id)['uas'] }}">
                            @else
                                <input type="text" name="uas" maxlength="2" onkeypress="return inputAngka(event)" style="margin: auto;" class="form-control text-center uas_{{$data->id}}" autocomplete="off">
                            @endif
                        </td>
                        <td class="ctr sub_{{$data->id}}">
                            @if ($data->nilai($data->id))
                                <i class="fas fa-check" style="font-weight:bold;"></i>
                            @else
                                <button type="button" id="submit-{{$data->id}}" class="btn btn-default btn_click" data-id="{{$data->id}}"><i class="nav-icon fas fa-save"></i></button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </form>
        </tbody>
    </table>
</div>
<!-- /.card-body -->
</div>
<!-- /.card -->
</div>
<div class="col-md-12">
    <div class="card card-outline card-info">
        <form class="form-group" action="" method="post">
            @csrf
            <div class="card-header">
                <button type="submit" name="submit" class="btn btn-outline-primary">
                    Simpan &nbsp; <i class="nav-icon fas fa-save"></i>
                </button>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool btn-sm" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body pad">
                <div class="mb-3">
                    <input type="hidden" name="id" value="">
                    <textarea class="textarea @error('isi') is-invalid @enderror" name="isi" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('script')
<script>
$(".btn_click").click(function(){
var id = $(this).attr('data-id');
var ulha_1 = $(".ulha_1_"+id).val();
var ulha_2 = $(".ulha_2_"+id).val();
var uts = $(".uts_"+id).val();
var ulha_3 = $(".ulha_3_"+id).val();
var uas = $(".uas_"+id).val();
var ulangan_id = $(".ulangan_id_"+id).val();
var dosen_id = $("input[name=dosen_id]").val();
var kelas_id = $("input[name=kelas_id]").val();

$.ajax({
    url: "{{ route('ulangan.store') }}",
    type: "POST",
    dataType: 'json',
    data 	: {
        _token: '{{ csrf_token() }}',
        id : ulangan_id,
        mhs_id : id,
        kelas_id : kelas_id,
        dosen_id : dosen_id,
        ulha_1 : ulha_1,
        ulha_2 : ulha_2,
        uts : uts,
        ulha_3 : ulha_3,
        uas : uas,
    },
    success: function(data){
        toastr.success("Nilai ulangan mhs berhasil ditambahkan!");
        location.reload();
    },
    error: function (data) {
        toastr.warning("Errors 404!");
    }
});
});

$("#NilaiDosen").addClass("active");
$("#liNilaiDosen").addClass("menu-open");
$("#UlanganDosen").addClass("active");
</script>
@endsection


