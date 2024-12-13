<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HasilSurveySeeder extends Seeder
{
    public function run()
    {
        $kuesioner2023Id = DB::table('kuesioner')
            ->where('judul', 'kuesionner ZIWBKWBBM 2023')
            ->value('id');
        $kuesioner2024Id = DB::table('kuesioner')
            ->where('judul', 'kuesionner ZIWBKWBBM 2024')
            ->value('id');

        $nimMahasiswa = [
            '231511000',
            '231511001',
        ];

        $pertanyaanList = [
            'Apakah tujuan dan manfaat perkuliahan disampaikan di awal semester?',
            'Apakah buku acuan dan literatur yang digunakan mutakhir (≤ 5 tahun terakhir)?',
            'Apakah perkuliahan dilengkapi dengan bahan ajar/diktat/handout?',
            'Apakah dosen siap memberikan kuliah dan/atau praktik/praktikum?',
            'Apakah perkuliahan dimulai dan diakhiri tepat waktu?',
        ];

        $kuesionerIds = [
            $kuesioner2023Id,
            $kuesioner2024Id,
        ];

        foreach ($kuesionerIds as $kuesionerId) {
            foreach ($nimMahasiswa as $nim) {
                foreach ($pertanyaanList as $index => $pertanyaan) {
                    DB::table('hasil_survey')->insert([
                        'nim' => $nim,
                        'kuisioner_id' => $kuesionerId,
                        'pertanyaan' => $pertanyaan,
                        'jawaban' => rand(1, 5),
                        'semester' => 3,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
