<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class JurusanSeeder extends Seeder
{
    public function run()
    {
        $jurusanList = [
            'Jurusan Teknik Sipil',
            'Jurusan Teknik Mesin',
            'Jurusan Teknik Refrigerasi dan Tata Udara',
            'Jurusan Teknik Konversi Energi',
            'Jurusan Teknik Elektro',
            'Jurusan Teknik Kimia',
            'Jurusan Teknik Komputer dan Informatika',
        ];

        foreach ($jurusanList as $jurusan) {
            DB::table('jurusan')->insert([
                'id' => Str::uuid(),
                'nama' => $jurusan,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
