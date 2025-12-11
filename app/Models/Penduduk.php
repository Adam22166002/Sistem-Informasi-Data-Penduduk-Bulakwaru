<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;
    protected $table = 'penduduk';

    protected $fillable = [
        'no_kk',
        'rumah_id',
        'nik',
        'nama',
        'jenis_kelamin',
        'tgl_lahir',
        'pekerjaan',
        'status_keluarga',
        'foto'
    ];

    public function rumah()
{
    return $this->belongsTo(Rumah::class, 'rumah_id');
}
}

