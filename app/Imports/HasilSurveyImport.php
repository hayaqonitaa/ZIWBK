<?php
namespace App\Imports;

use App\Models\Admin\HasilSurvey;
use App\Models\Admin\Kuesioner;
use App\Models\Admin\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class HasilSurveyImport implements ToModel
{
    // Menyimpan baris saat ini
    private $currentRow = 0;

    // Array untuk menampung error
    protected $errors = [];

    // Jumlah hasil survey yang berhasil ditambahkan
    protected $surveyAdded = 0;

    public function model(array $row)
    {
        // Abaikan jika kolom NIM tidak numerik (kemungkinan header)
        if (!is_numeric($row[1])) {
            return null;
        }
    
        // Tangkap baris yang sedang diproses
        $this->currentRow++;
    
        // Cek apakah NIM ada di tabel mahasiswa
        $mahasiswaExists = Mahasiswa::where('nim', $row[1])->exists();
        if (!$mahasiswaExists) {
            $this->errors[] = [
                'row' => $this->currentRow,
                'error' => "NIM '{$row[1]}' tidak ditemukan di tabel Mahasiswa."
            ];
            return null;
        }
    
        // Cari ID kuisioner berdasarkan nama kuisioner
        $kuisionerId = $this->getKuisionerId($row[2]);
    
        // Jika kuisioner tidak ditemukan, catat error
        if (is_null($kuisionerId)) {
            $this->errors[] = [
                'row' => $this->currentRow,
                'error' => "Kuisioner '{$row[2]}' tidak ditemukan."
            ];
            return null;
        }
    
        // Jika data valid, tambahkan ke tabel hasil_survey
        $this->surveyAdded++;
    
        return new HasilSurvey([
            'nim' => $row[1],               // Kolom kedua adalah NIM
            'kuisioner_id' => $kuisionerId, // ID kuisioner berdasarkan nama
            'pertanyaan' => $row[3],       // Kolom keempat adalah Pertanyaan
            'jawaban' => $row[4],          // Kolom kelima adalah Jawaban
            'semester' => $row[5],         // Kolom keenam adalah Semester
        ]);
    }
    

    private function getKuisionerId($namaKuisioner)
    {
        $kuisioner = Kuesioner::where('judul', $namaKuisioner)->first();
        return $kuisioner ? $kuisioner->id : null;
    }

    // Fungsi untuk mengambil error setelah proses selesai
    public function getErrors()
    {
        return $this->errors;
    }

    // Fungsi untuk mengambil jumlah data yang berhasil ditambahkan
    public function getSurveyAdded()
    {
        return $this->surveyAdded;
    }
}