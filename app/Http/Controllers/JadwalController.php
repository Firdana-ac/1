<?php

namespace App\Http\Controllers;

use Auth;
use App\Jadwal;
use App\Hari;
use App\Kelas;
use App\Penguji;
use App\Mhs;
use App\Ruang;
use App\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PDF;
use App\Exports\JadwalExport;
use App\Imports\JadwalImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hari = Hari::all();
        $kelas = Kelas::OrderBy('nama_kelas', 'asc')->get();
        $ruang = Ruang::all();
        $mhs = Mhs::all();

        $jadwal=Jadwal::all();
       
        $penguji = Penguji::OrderBy('kode', 'asc')->get();
        $promotor = Penguji::where('mapel_id', 4)->get();
        $koprom1 = Penguji::where('mapel_id', 5)->get();
        $koprom2 = Penguji::where('mapel_id', 6)->get();
        $penguji1 = Penguji::where('mapel_id', 7)->get();
        $penguji2 = Penguji::where('mapel_id', 8)->get();
        $penguji3 = Penguji::where('mapel_id', 9)->get();
        $penguji4 = Penguji::where('mapel_id', 10)->get();
        $penguji5 = Penguji::where('mapel_id', 14)->get();
        return view('admin.jadwal.index', compact('hari', 'kelas', 'penguji', 'ruang', 'mhs', 'jadwal', 'promotor', 'koprom1', 'koprom2', 'penguji1', 'penguji2','penguji3','penguji4','penguji5'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'hari_id' => 'required',
            'kelas_id' => 'required',
            'mhs_id' => 'required',
            // 'penguji_id' => 'required',
            // 'promotor' => 'required',
            // 'kopromotor1' => 'required',
            // 'kopromotor2' => 'required',
            // 'penguji1' => 'required',
            // 'penguji2' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'ruang_id' => 'required',
        ]);

        // $penguji = Penguji::findorfail($request->penguji_id);
        Jadwal::updateOrCreate(
            [
                'id' => $request->jadwal_id
            ],
            [
                'hari_id' => $request->hari_id,
                'kelas_id' => $request->kelas_id,
                'mhs_id' => $request->mhs_id,
                'judul' => $request->judul,
                'penguji_id' => $request->penguji_id,
                'promotor' => $request->promotor,
                'kopromotor_1' => $request->kopromotor1,
                'kopromotor_2' => $request->kopromotor2,
                'penguji_1' => $request->penguji1,
                'penguji_2' => $request->penguji2,
                'penguji_3' => $request->penguji3,
                'penguji_4' => $request->penguji4,
                'penguji_5' => $request->penguji5,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'ruang_id' => $request->ruang_id,
                'tanggal' => $request->tanggal,
            ]
        );

        return redirect()->back()->with('success', 'Data jadwal berhasil diperbarui!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = Crypt::decrypt($id);
        
        $data = Jadwal::orderBy('hari_id', 'asc')->OrderBy('jam_mulai', 'asc')->where('id', $id)->first();
        $jadwal=Jadwal::with('mhs')->find($id);
        //$kelas = Kelas::findorfail($data->kelas_id);//
        return $jadwal;
        return view('admin.jadwal.show', compact('data', 'kelas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        $jadwal = Jadwal::findorfail($id);
        $hari = Hari::all();
        $kelas = Kelas::all();
        $ruang = Ruang::all();
        $penguji = Penguji::OrderBy('kode', 'asc')->get();
        return view('admin.jadwal.edit', compact('jadwal', 'hari', 'kelas', 'penguji', 'ruang'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $this->validate($request, [
        //     'hari_id' => 'required',
        //     'kelas_id' => 'required',
        //     'mhs_id' => 'required',
        //     'penguji_id' => 'required',
        //     'promotor' => 'required',
        //     'kopromotor1' => 'required',
        //     'kopromotor2' => 'required',
        //     'penguji1' => 'required',
        //     'penguji2' => 'required',
        //     'penguji3' => 'required',
        //     'penguji4' => 'required',
        //     'penguji5' => 'required',
        //     'jam_mulai' => 'required',
        //     'jam_selesai' => 'required',
        //     'ruang_id' => 'required',
        // ]);

        // $penguji = Penguji::findorfail($request->penguji_id);
        $id = Crypt::decrypt($id);
        $jadwal = Jadwal::findOrFail($id);
        $jadwal->update([
                'hari_id' => $request->hari_id,
                'kelas_id' => $request->kelas_id,
                'judul' => $request->judul,
                'penguji_id' => $request->penguji_id,
                'promotor' => $request->promotor,
                'kopromotor_1' => $request->kopromotor1,
                'kopromotor_2' => $request->kopromotor2,
                'penguji_1' => $request->penguji1,
                'penguji_2' => $request->penguji2,
                'penguji_3' => $request->penguji3,
                'penguji_4' => $request->penguji4,
                'penguji_5' => $request->penguji5,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai,
                'ruang_id' => $request->ruang_id,
                'tanggal' => $request->tanggal,
            ]);
        return redirect()->route('jadwal.show', Crypt::encrypt($jadwal->id))->with('success', 'Data jadwal berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jadwal = Jadwal::findorfail($id);
        $jadwal->delete();

        return redirect()->back()->with('warning', 'Data jadwal berhasil dihapus! (Silahkan cek trash data jadwal)');
    }

    public function trash()
    {
        $jadwal = Jadwal::onlyTrashed()->get();
        return view('admin.jadwal.trash', compact('jadwal'));
    }

    public function restore($id)
    {
        $id = Crypt::decrypt($id);
        $jadwal = Jadwal::withTrashed()->findorfail($id);
        $jadwal->restore();
        return redirect()->back()->with('info', 'Data jadwal berhasil direstore! (Silahkan cek data jadwal)');
    }

    public function kill($id)
    {
        $jadwal = Jadwal::withTrashed()->findorfail($id);
        $jadwal->forceDelete();
        return redirect()->back()->with('success', 'Data jadwal berhasil dihapus secara permanent');
    }

    public function view(Request $request)
    {
        $jadwal = Jadwal::OrderBy('hari_id', 'asc')->OrderBy('jam_mulai', 'asc')->where('kelas_id', $request->id)->get();
        foreach ($jadwal as $val) {
            $newForm[] = array(
                'hari' => $val->hari->nama_hari,
                'mapel' => $val->mapel->nama_mapel,
                'kelas' => $val->kelas->nama_kelas,
                'penguji' => $val->penguji->nama_penguji,
                'jam_mulai' => $val->jam_mulai,
                'jam_selesai' => $val->jam_selesai,
                'ruang' => $val->ruang->nama_ruang,
            );
        }
        return response()->json($newForm);
    }

    public function jadwalSekarang(Request $request)
    {
        $jadwal = Jadwal::OrderBy('jam_mulai')->OrderBy('jam_selesai')->OrderBy('kelas_id')->where('hari_id', $request->hari)->where('jam_mulai', '<=', $request->jam)->where('jam_selesai', '>=', $request->jam)->get();
        foreach ($jadwal as $val) {
            $newForm[] = array(
                'mapel' => $val->mapel->nama_mapel,
                'kelas' => $val->kelas->nama_kelas,
                'penguji' => $val->penguji->nama_penguji,
                'jam_mulai' => $val->jam_mulai,
                'jam_selesai' => $val->jam_selesai,
                'ruang' => $val->ruang->nama_ruang,
                'ket' => $val->absen($val->penguji_id),
            );
        }
        return response()->json($newForm);
    }

    public function cetak_pdf(Request $request)
    {
        $jadwal = Jadwal::OrderBy('hari_id', 'asc')->OrderBy('jam_mulai', 'asc')->where('kelas_id', $request->id)->get();
        $kelas = Kelas::findorfail($request->id);
        $pdf = PDF::loadView('jadwal-pdf', ['jadwal' => $jadwal, 'kelas' => $kelas]);
        return $pdf->stream();
        // return $pdf->stream('jadwal-pdf.pdf');
    }

    public function penguji()
    {
        $penguji = Penguji::where('id_card', Auth::user()->id_card)->first();
        $jadwal = Jadwal::orderBy('hari_id')->OrderBy('jam_mulai')->where('penguji_id', $penguji->id)->get();
        return view('penguji.jadwal', compact('jadwal', 'penguji'));
    }

    public function mhs()
    {
        $mhs = Mhs::where('no_induk', Auth::user()->no_induk)->first();
        $kelas = Kelas::findorfail($mhs->kelas_id);
        $jadwal = Jadwal::orderBy('hari_id')->OrderBy('jam_mulai')->where('kelas_id', $kelas->id)->get();
        return view('mhs.jadwal', compact('jadwal', 'kelas', 'mhs'));
    }

    public function export_excel()
    {
        return Excel::download(new JadwalExport, 'jadwal.xlsx');
    }

    public function import_excel(Request $request)
    {
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);
        $file = $request->file('file');
        $nama_file = rand() . $file->getClientOriginalName();
        $file->move('file_jadwal', $nama_file);
        Excel::import(new JadwalImport, public_path('/file_jadwal/' . $nama_file));
        return redirect()->back()->with('success', 'Data mhs Berhasil Diimport!');
    }

    public function deleteAll()
    {
        $jadwal = Jadwal::all();
        if ($jadwal->count() >= 1) {
            Jadwal::whereNotNull('id')->delete();
            Jadwal::withTrashed()->whereNotNull('id')->forceDelete();
            return redirect()->back()->with('success', 'Data table jadwal berhasil dihapus!');
        } else {
            return redirect()->back()->with('warning', 'Data table jadwal kosong!');
        }
    }
}
