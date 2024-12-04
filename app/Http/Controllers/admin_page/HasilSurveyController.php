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

    public function getHasilSurvey () {
        $hasil_survey = HasilSurvey::with('mahasiswa')->get();
        return response()->json(['data' => $hasil_survey]); // ini ke admin/mahasiswa.js
      }
    
      public function getMahasiswa() // New method for jurusan data
      {
          $mahasiswa = Mahasiswa::all(); // Fetch all jurusan data
          return response()->json($mahasiswa);
    
      }
}