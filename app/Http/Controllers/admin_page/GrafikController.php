<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GrafikController extends Controller
{
    public function index()
    {
        return view('admin-page.grafik.grafik');
    }

    public function getSurveyData()
    {
        $data = DB::table('hasil_survey')
            ->where('semester', 3)
            ->select('pertanyaan', 'jawaban')
            ->get();

        return response()->json($data);
    }
}
