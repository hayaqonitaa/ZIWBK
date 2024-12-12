<?php

namespace App\Http\Controllers\admin_page;

use Illuminate\Http\Request;
use App\Models\Admin\Kuesioner;
use App\Models\Admin\HasilSurvey;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class GrafikController extends Controller
{
    public function index()
    {
        $tahunKuisioner = Kuesioner::distinct()->pluck('tahun');

        return view('admin-page.grafik.grafik', compact('tahunKuisioner'));
    }

    public function getSurveyData($tahun)
    {
        $data = HasilSurvey::select('hasil_survey.pertanyaan', 'hasil_survey.jawaban')
            ->join('kuesioner', 'hasil_survey.kuisioner_id', '=', 'kuesioner.id')
            ->where('kuesioner.tahun', '=', $tahun)
            ->get();
    
        return response()->json($data);
    }
}
