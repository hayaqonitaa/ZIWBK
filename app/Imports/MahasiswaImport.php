<?php
namespace App\Imports;

use App\Models\Admin\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class MahasiswaImport implements ToModel
{
    // Menyimpan baris saat ini
    private $currentRow = 0;    

    // Array untuk menampung error prodi dan email
    protected $prodiErrors = [];
    protected $emailErrors = [];

    public function model(array $row)
    {
        // Abaikan jika kolom NIM tidak numerik (kemungkinan header)
        if (!is_numeric($row[1])) {
            return null;
        }
        
        
        // Tangkap baris yang sedang diproses
        $this->currentRow++; // Melacak baris yang sedang diproses
        
        // Cek apakah data mahasiswa dengan NIM tersketika sebut sudah ada
        $existingMahasiswa = Mahasiswa::where('nim', $row[1])->first();
        // Cek jika Prodi tidak valid
        $prodiId = $this->getProdiId($row[3]);

        // Cek jika Email sudah terdaftar dengan nim yang belum terdaftar
        if (!empty(trim($row[4])) && Mahasiswa::where('email', trim($row[4]))->exists() && is_null($existingMahasiswa)) {
            $this->emailErrors[] = $this->currentRow;  // Menyimpan baris dengan email duplikat
            return null;  // Lanjutkan ke baris berikutnya
        }


        
        elseif (is_null($prodiId)) {
            $this->prodiErrors[] = $this->currentRow;  // Menyimpan baris dengan prodi error
            return null;  // Lanjutkan ke baris berikutnya
        }

        // Jika NIM sudah ada, update data yang ada
        elseif ($existingMahasiswa) {
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

    // Fungsi untuk mengambil error setelah proses selesai
    public function getProdiErrors()
    {
        return $this->prodiErrors;
    }

    public function getEmailErrors()
    {
        return $this->emailErrors;
    }
}

