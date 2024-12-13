<?php

namespace App\Imports;

use App\Models\Admin\HasilSurvey;
use Maatwebsite\Excel\Concerns\ToModel;

class HasilSurveyImport implements ToModel
{
    public function model(array $row)
    {
        return new HasilSurvey([
            'nama_mahasiswa' => $row[0], // Kolom pertama di Excel
            'jurusan' => $row[1],        // Kolom kedua di Excel
            'hasil' => $row[2],          // Kolom ketiga di Excel
        ]);
    }
}
