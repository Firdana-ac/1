<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Dosen extends Model
{
    use SoftDeletes;

    protected $fillable = ['id_card', 'nip', 'nama_dosen', 'team_id', 'kode', 'jk', 'telp', 'tmp_lahir', 'tgl_lahir', 'foto'];

    public function team()
    {
        return $this->belongsTo('App\Team')->withDefault();
    }

    public function dsk($id)
    {
        $dsk = Nilai::where('dosen_id', $id)->first();
        return $dsk;
    }

    protected $table = 'dosen';
}
