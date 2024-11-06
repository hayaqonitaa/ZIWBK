<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Admin\Jurusan;

class ProdiSeeder extends Seeder
{
    public function run()
    {
        $prodiData = [
            'Jurusan Teknik Sipil' => [
                'D-3 Teknik Konstruksi Sipil',
                'D-3 Teknik Konstruksi Gedung',
                'D-4 Teknik Perancangan Jalan dan Jembatan',
                'D-4 Teknik Perawatan dan Perbaikan Gedung',
                'S-2 Rekayasa Infrastruktur',
            ],
            'Jurusan Teknik Mesin' => [
                'D-3 Teknik Mesin',
                'D-3 Teknik Aeronautika',
                'D-4 Teknik Perancangan dan Konstruksi Mesin',
                'D-4 Proses Manufaktur',
            ],
            'Jurusan Teknik Refrigerasi dan Tata Udara' => [
                'D-3 Teknik Pendingin dan Tata Udara',
                'D-4 Teknik Pendingin dan Tata Udara',
            ],
            'Jurusan Teknik Konversi Energi' => [
                'D-3 Teknik Konversi Energi',
                'D-4 Teknologi Pembangkit Tenaga Listrik',
                'D-4 Teknik Konservasi Energi',
            ],
            'Jurusan Teknik Elektro' => [
                'D-3 Teknik Elektro',
                'D-3 Teknik Listrik',
                'D-3 Teknik Telekomunikasi',
                'D-4 Teknik Elektronika',
                'D-4 Teknik Otomasi Industri',
                'D-4 Teknik Telekomunikasi',
            ],
            'Jurusan Teknik Kimia' => [
                'D-3 Teknik Kimia',
                'D-3 Analis Kimia',
                'D-4 Teknik Kimia Produksi Bersih',
            ],
            'Jurusan Teknik Komputer dan Informatika' => [
                'D-3 Teknik Informatika',
                'D-4 Teknik Informatika',
            ],
        ];

        foreach ($prodiData as $jurusanNama => $prodiList) {
            // Cari jurusan berdasarkan nama
            $jurusan = Jurusan::where('nama', $jurusanNama)->first();

            if ($jurusan) {
                foreach ($prodiList as $prodiNama) {
                    DB::table('prodi')->insert([
                        'id' => Str::uuid(),
                        'nama' => $prodiNama,
                        'id_jurusan' => $jurusan->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}
