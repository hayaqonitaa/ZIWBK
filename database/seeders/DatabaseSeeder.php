<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Panggil seeder yang diinginkan
        $this->call([
            UserSeeder::class,
            ContentCategoriesSeeder::class,
        ]);
    }
}
