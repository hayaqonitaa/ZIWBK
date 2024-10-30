<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Prodi;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;
use Illuminate\Support\Facades\Validator; // Add this line to import Validator

class MahasiswaImportController extends Controller
{
    public function uploadExcel(Request $request)
    {
        // Validasi file yang diupload
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:xlsx,xls'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'File tidak valid'], 400);
        }

        try {
            // Proses file Excel menggunakan import class
            Excel::import(new MahasiswaImport, $request->file('file'));
            return response()->json(['message' => 'Data berhasil diimpor'], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }
}