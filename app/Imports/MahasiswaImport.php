<?php
namespace App\Imports;

use App\Models\Admin\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class HasilSurveyImport implements ToModel
{
    // Menyimpan baris saat ini
    private $currentRow = 0;

    // Array untuk menampung error
    protected $errorRows = [];
    protected $hasilSurveyAdded = 0;

    public function model(array $row)
    {
        // Abaikan jika kolom NIM tidak numerik (kemungkinan header)
        if (!is_numeric($row[0])) {
            return null;
        }

        // Tangkap baris yang sedang diproses
        $this->currentRow++; // Melacak baris yang sedang diproses

        // Mencari mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $row[0])->first();
        
        // Cek jika kolom kedua adalah UUID yang valid untuk ID kuesioner
        $kuesioner = null;
        if (is_string($row[1]) && preg_match('/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/', $row[1])) {
            $kuesioner = Kuesioner::where('id', $row[1])->first();
        }

        // Jika mahasiswa atau kuesioner tidak ditemukan, abaikan baris tersebut
        if (!$mahasiswa || !$kuesioner) {
            $this->errorRows[] = $this->currentRow; // Menyimpan baris dengan error
            return null;
        }

        // Cek jika data HasilSurvey dengan kombinasi NIM dan Kuesioner ID sudah ada
        $existingSurvey = HasilSurvey::where('nim', $mahasiswa->nim)
                                      ->where('kuisioner_id', $kuesioner->id)
                                      ->first();

        if ($existingSurvey) {
            // Jika sudah ada, update data yang ada atau abaikan
            $existingSurvey->update([
                'pertanyaan' => $row[2],
                'jawaban' => $row[3],
                'semester' => $row[4],
            ]);
            // Kembalikan null agar tidak membuat instance baru
            return null;
        }

        // Jika NIM dan Kuesioner ID belum ada, buat entri baru
        $this->hasilSurveyAdded++;

        return new HasilSurvey([
            'nim' => $mahasiswa->nim,
            'kuisioner_id' => $kuesioner->id,
            'pertanyaan' => $row[2],
            'jawaban' => $row[3],
            'semester' => $row[4],
        ]);
    }

    // Fungsi untuk mengambil error setelah proses selesai
    public function getErrorRows()
    {
        return $this->errorRows;
    }

    // Fungsi untuk mendapatkan jumlah HasilSurvey yang berhasil ditambahkan
    public function getHasilSurveyAdded()
    {
        return $this->hasilSurveyAdded;
    }
}