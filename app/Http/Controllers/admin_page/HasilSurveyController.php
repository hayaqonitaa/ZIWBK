<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use App\Models\Admin\HasilSurvey;
use App\Models\Admin\Mahasiswa;
use Illuminate\Http\Request;

class HasilSurveyController extends Controller
{
    public function index()
    {
        return view('admin-page.hasil_survey.hasil_survey');
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
}