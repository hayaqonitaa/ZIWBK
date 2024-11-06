<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ContentCategoriesSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            'Standar Pelayanan',
            'Agen Perubahan',
            'Tim Kerja',
            'Layanan Pengaduan',
            'Piagam',
            'Berita',
            'Header',
        ];

        foreach ($categories as $category) {
            DB::table('content_categories')->insert([
                'id' => Str::uuid(),
                'nama' => $category,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
