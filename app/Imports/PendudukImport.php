<?php
namespace App\Imports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PendudukImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Penduduk([
            'no_kk' => $row['no_kk'],
            'nik' => $row['nik'],
            'nama' => $row['nama'],
            'jenis_kelamin' => $row['jenis_kelamin'],
            'tgl_lahir' => $row['tgl_lahir'],
            'pekerjaan' => $row['pekerjaan'],
            'status_keluarga' => $row['status_keluarga'],
        ]);
    }
}

