<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KuesionerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kuesioner')->insert([
            [
                'id' => Str::uuid(),
                'judul' => 'kuesionner ZIWBKWBBM 2023',
                'link_kuesioner' => 'inilinkkuesioner.com',
                'created_at' => now(),
                'updated_at' => now(),
                'tahun' => '2023',
            ],
            [
                'id' => Str::uuid(),
                'judul' => 'kuesionner ZIWBKWBBM 2024',
                'link_kuesioner' => 'inilinkkuesioner2.com',
                'created_at' => now(),
                'updated_at' => now(),
                'tahun' => '2024',
            ],
        ]);
    }
}
