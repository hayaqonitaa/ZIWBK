<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
        // Cari ID Prodi untuk D-3 Teknik Informatika
        $prodi = DB::table('prodi')->where('nama', 'D-3 Teknik Informatika')->first();

        if ($prodi) {
            // Data mahasiswa
            $mahasiswaData = [
                [
                    'id' => Str::uuid(),
                    'nim' => '231511008',
                    'nama' => 'Dafni Lanahtadya',
                    'email' => 'dafni@example.com',
                    'id_prodi' => $prodi->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'nim' => '231511001',
                    'nama' => 'Aisya Naomi',
                    'email' => 'aisyah@example.com',
                    'id_prodi' => $prodi->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'nim' => '231511013',
                    'nama' => 'Haya Qonita Amani',
                    'email' => 'haya@example.com',
                    'id_prodi' => $prodi->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'nim' => '231511011',
                    'nama' => 'Geraldin Gysrawa',
                    'email' => 'geraldin@example.com',
                    'id_prodi' => $prodi->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'id' => Str::uuid(),
                    'nim' => '231511017',
                    'nama' => 'Jagad Aqsal',
                    'email' => 'jagad@example.com',
                    'id_prodi' => $prodi->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ];

            // Masukkan data ke tabel mahasiswa
            DB::table('mahasiswa')->insert($mahasiswaData);
        } else {
            $this->command->info('Prodi D-3 Teknik Informatika tidak ditemukan!');
        }
    }
}
