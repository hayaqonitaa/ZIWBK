<?php

namespace App\Imports;

use App\Models\Admin\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Mahasiswa([
            'nim' => $row['nim'],
            'nama' => $row['nama'],
            'email' => $row['email'],
            'id_prodi' => $this->getProdiId($row['prodi']),
        ]);
    }

    private function getProdiId($namaProdi)
    {
        $prodi = \App\Models\Admin\Prodi::where('nama', $namaProdi)->first();
        return $prodi ? $prodi->id : null;
    }
}
