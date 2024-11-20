<?php
namespace App\Imports;

use App\Models\Admin\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class MahasiswaImport implements ToModel
{
    public function model(array $row)
    {
        // Abaikan jika kolom NIM tidak numerik (kemungkinan header)
        if (!is_numeric($row[1])) {
            return null;
        }

        // Cek apakah data mahasiswa dengan NIM tersketika sebut sudah ada
        $existingMahasiswa = Mahasiswa::where('nim', $row[1])->first();

        // Jika NIM sudah ada, update data yang ada
        if ($existingMahasiswa) {
            $existingMahasiswa->update([
                'nama' => $row[2],
                'id_prodi' => $this->getProdiId($row[3]),
                'email' => $row[4],
            ]);

            // Kembalikan null agar tidak membuat instance baru
            return null;
        }

        // Jika NIM belum ada, buat entri baru
        return new Mahasiswa([
            'nim' => $row[1],    // Kolom kedua adalah NIM
            'nama' => $row[2],   // Kolom ketiga adalah Nama
            'id_prodi' => $this->getProdiId($row[3]), // Kolom keempat adalah Prodi
            'email' => $row[4],  // Kolom kelima adalah Email
        ]);
    }

    private function getProdiId($namaProdi)
    {
        $prodi = \App\Models\Admin\Prodi::where('nama', $namaProdi)->first();
        return $prodi ? $prodi->id : null;
    }
}

