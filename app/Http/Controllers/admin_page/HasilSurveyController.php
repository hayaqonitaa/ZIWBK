<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use App\Models\Admin\HasilSurvey;
use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Kuesioner;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\HasilSurveyImport;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class HasilSurveyController extends Controller
{
    public function index()
    {
        // Ambil semua hasil survey dan relasi dengan mahasiswa dan kuesioner
        $hasil_survey = HasilSurvey::with(['kuesioner'])->get();

        // Kirim data hasil survey ke view
        return view('admin-page.hasil_survey.hasil_survey', compact('hasil_survey'));
    }

    public function getHasilSurvey()
    {
        $hasil_survey = HasilSurvey::with('kuesioner')->get();
        return response()->json(['data' => $hasil_survey]);
    }
    
    
      public function getMahasiswa() // New method for jurusan data
      {
          $mahasiswa = Mahasiswa::all(); // Fetch all jurusan data
          return response()->json($mahasiswa);
    
      }

      public function destroy($id)
    {
        $hasil_survey = HasilSurvey::findOrFail($id);
        $hasil_survey->delete();

        // Response JSON sukses
        return response()->json([
            'message' => 'Hasil Survey berhasil dihapus!'
        ]);
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        $import = new HasilSurveyImport();
        Excel::import($import, $request->file('file'));

        return back()->with('success', 'Data Hasil Survey berhasil diimport.');
    }

    
    
}