<?php

namespace Database\Seeders;

use App\Models\Prodi;
use Illuminate\Database\Seeder;

class ProdiSeeder extends Seeder
{
    public function run(): void
    {
        $daftarProdi = [
            'Teknik Informatika',
            'Sistem Informasi',
            'Teknik Elektro',
            'Teknik Mekatronika',
            'Teknik Mesin',
            'Teknik Industri',
        ];

        foreach ($daftarProdi as $namaProdi) {
            Prodi::updateOrCreate(
                ['nama_prodi' => $namaProdi],
                ['nama_prodi' => $namaProdi]
            );
        }
    }
}
