<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rumah extends Model
{
    use HasFactory;
    protected $table = 'rumah';

    protected $fillable = [
        'kode_rumah',
        'alamat',
        'rt',
        'rw',
        'keterangan',
        'latitude',
        'longitude',
        'created_by'
    ];

    public function penduduk() {
        return $this->hasMany(Penduduk::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
}

