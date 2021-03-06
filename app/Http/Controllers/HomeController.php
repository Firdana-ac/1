<?php

namespace App\Http\Controllers;

use App\Jadwal;
use App\Dosen;
use App\Kehadiran;
use App\Kelas;
use App\Mhs;
use App\Team;
use App\User;
use App\Paket;
use App\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hari = date('w');
        $jam = date('H:i');
        $jadwal = Jadwal::OrderBy('jam_mulai')->OrderBy('jam_selesai')->OrderBy('kelas_id')->where('hari_id', $hari)->where('jam_mulai', '<=', $jam)->where('jam_selesai', '>=', $jam)->get();
        $pengumuman = Pengumuman::first();
        $kehadiran = Kehadiran::all();
        return view('home', compact('jadwal', 'pengumuman', 'kehadiran'));
    }

    public function admin()
    {
        $jadwal = Jadwal::count();
        $dosen = Dosen::count();
        $dosenlk = Dosen::where('jk', 'L')->count();
        $dosenpr = Dosen::where('jk', 'P')->count();
        $mhs = Mhs::count();
        $mhslk = Mhs::where('jk', 'L')->count();
        $mhspr = Mhs::where('jk', 'P')->count();
        $kelas = Kelas::count();
        $bkp = Kelas::where('paket_id', '1')->count();
        $dpib = Kelas::where('paket_id', '2')->count();
        $ei = Kelas::where('paket_id', '3')->count();
        $oi = Kelas::where('paket_id', '4')->count();
        $tbsm = Kelas::where('paket_id', '6')->count();
        $rpl = Kelas::where('paket_id', '7')->count();
        $tpm = Kelas::where('paket_id', '5')->count();
        $las = Kelas::where('paket_id', '8')->count();
        $team = Team::count();
        $user = User::count();
        $paket = Paket::all();
        return view('admin.index', compact(
            'jadwal',
            'dosen',
            'dosenlk',
            'dosenpr',
            'mhslk',
            'mhspr',
            'mhs',
            'kelas',
            'bkp',
            'dpib',
            'ei',
            'oi',
            'tbsm',
            'rpl',
            'tpm',
            'las',
            'team',
            'user',
            'paket'
        ));
    }
}
