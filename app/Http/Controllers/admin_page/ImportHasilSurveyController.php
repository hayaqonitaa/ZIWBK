<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Imports\HasilSurveyImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ImportHasilSurveyController extends Controller
{
    // Menyediakan template Excel untuk download
    public function downloadTemplate()
    {
        return response()->download(public_path('templates/template-hasil-survey.xlsx'));
    }

    // Memproses upload file Excel dan menyimpan data ke database
    public function import(Request $request)
    {
        $validatedData = $request->validate([
            'file' => 'required|mimes:xls,xlsx|max:2048', // Validasi file Excel
        ]);

        try {
            Excel::import(new HasilSurveyImport, $request->file('file'));
            return back()->with('success', 'Hasil survey berhasil diimpor.');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        }
    }
}
