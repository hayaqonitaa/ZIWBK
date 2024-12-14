<?php
namespace App\Models\Admin;

use App\Models\Admin\HasilSurvey;
use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Kuesioner;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class HasilSurveyImport implements ToModel, WithHeadingRow
{
    private $successCount = 0;
    private $errorCount = 0;
    private $detailedErrors = [];

    public function model(array $row)
    {
        return DB::transaction(function () use ($row) {
            try {
                Log::info('Processing row:', $row);
    
                // Validasi kolom yang diperlukan
                $missingColumns = $this->validateRowColumns($row);
                if (!empty($missingColumns)) {
                    $this->addError('Kolom hilang: ' . implode(', ', $missingColumns));
                    return null;
                }
    
                // Cari mahasiswa berdasarkan NIM
                $mahasiswa = Mahasiswa::where('nim', (string)$row['nim'])->first();
    
                // Cari kuesioner berdasarkan nama kuesioner
                $kuesioner = Kuesioner::where('judul', $row['nama_kuesioner'])->first();
    
                // Validasi mahasiswa dan kuesioner
                if (!$mahasiswa || !$kuesioner) {
                    $errorDetails = $this->generateValidationErrorMessage($mahasiswa, $kuesioner, $row);
                    $this->addError($errorDetails);
                    return null;
                }
    
                // Cek duplikasi
                $existingSurvey = HasilSurvey::where('nim', (string)$row['nim'])
                                             ->where('kuisioner_id', $kuesioner->id)
                                             ->where('pertanyaan', $row['pertanyaan'])
                                             ->first();
    
                // Jika tidak ada duplikasi, buat entri baru
                if (!$existingSurvey) {
                    $hasilSurvey = new HasilSurvey([
                        'nim' => (string)$row['nim'],
                        'kuisioner_id' => $kuesioner->id,
                        'pertanyaan' => $row['pertanyaan'],
                        'jawaban' => $row['jawaban'],
                        'semester' => $row['semester']
                    ]);
    
                    // Simpan entri
                    $hasilSurvey->save();
    
                    // Increment success count
                    $this->successCount++;
    
                    return $hasilSurvey;
                } else {
                    $this->addError("Duplikasi data untuk NIM {$row['nim']}, Pertanyaan: {$row['pertanyaan']}");
                    return null;
                }
    
            } catch (\Exception $e) {
                // Log error lengkap untuk debugging
                Log::error('Error processing row: ' . $e->getMessage());
                Log::error('Full error trace: ', ['exception' => $e]);
                
                $this->addError('Kesalahan umum: ' . $e->getMessage());
                return null;
            }
        });
    }

    // Ganti recordError dengan addError
    private function addError(string $error)
    {
        $this->errorCount++;
        $this->detailedErrors[] = $error;
    }

    private function validateRowColumns(array $row): array
    {
        $requiredColumns = ['nim', 'nama_kuesioner', 'pertanyaan', 'jawaban', 'semester'];
        $missingColumns = [];

        foreach ($requiredColumns as $column) {
            if (!isset($row[$column]) || $row[$column] === null) {
                $missingColumns[] = $column;
            }
        }

        return $missingColumns;
    }

    private function generateValidationErrorMessage($mahasiswa, $kuesioner, $row): string
    {
        $errorDetails = [];
        if (!$mahasiswa) $errorDetails[] = "Mahasiswa dengan NIM {$row['nim']} tidak ditemukan";
        if (!$kuesioner) $errorDetails[] = "Kuesioner dengan nama '{$row['nama_kuesioner']}' tidak ditemukan";
        
        return implode('. ', $errorDetails);
    }

    public function getSuccessCount()
    {
        return $this->successCount;
    }

    public function getErrorCount()
    {
        return $this->errorCount;
    }

    public function getDetailedErrors()
    {
        return $this->detailedErrors;
    }
}