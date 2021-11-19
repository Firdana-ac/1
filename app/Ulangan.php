<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ulangan extends Model
{
    protected $fillable = ['mhs_id', 'kelas_id', 'dosen_id', 'team_id', 'ulha_1', 'ulha_2', 'uts', 'ulha_3', 'uas'];

    protected $table = 'ulangan';
}
