<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rumah;
use App\Models\Penduduk;
use App\Models\User;

class DummySeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin SIGP',
            'email' => 'admin@sigp.test',
            'password' => bcrypt('password')
        ]);
        $admin->assignRole('admin');

        // Buat 5 rumah
        for ($i=1; $i<=5; $i++) {
            $rumah = Rumah::create([
                'kode_rumah' => 'RUM' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'alamat' => 'Jl. Contoh No. '.$i,
                'rt' => '01',
                'rw' => '02',
                'latitude' => -6.981 + ($i * 0.002),
                'longitude' => 109.140 + ($i * 0.002),
                'created_by' => $admin->id
            ]);

            // Tiap rumah 2 penduduk
            for ($j=1; $j<=2; $j++) {
                Penduduk::create([
                    'rumah_id' => $rumah->id,
                    'nik' => '3304' . rand(10000000, 99999999),
                    'nama' => "Penduduk {$i}{$j}",
                    'jenis_kelamin' => $j % 2 == 0 ? 'P' : 'L',
                    'tgl_lahir' => '1995-01-01',
                    'pekerjaan' => 'Karyawan',
                    'status_pemilih' => true,
                ]);
            }
        }
    }
}

