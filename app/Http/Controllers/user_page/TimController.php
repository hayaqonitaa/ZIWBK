<?php

namespace App\Http\Controllers\user_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TimKerja; // Model TimKerja
use App\Models\Content; // Model Content (SK)

class TimController extends Controller
{
    public function index()
    {
        // Retrieve "Agen Perubahan" content
        $agenPerubahanContents = Content::where('status', 'Aktif')
            ->whereHas('content_categories', function ($query) {
                $query->where('nama', 'Agen Perubahan');
            })->get();

        // Retrieve "Tim Kerja" content
        $timKerjaContents = TimKerja::with('content') // Memuat data SK terkait
            ->get();

        // Retrieve Surat Keputusan (SK) content
        $suratKeputusanContents = Content::where('status', 'Aktif')
        ->whereHas('content_categories', function ($query) {
            $query->where('nama', 'Tim Kerja');
        })->get();


        $pageConfigs = ['myLayout' => 'front'];

        // Pass all contents to the view
        return view('user_page.tim', compact('agenPerubahanContents', 'timKerjaContents', 'suratKeputusanContents'), ['pageConfigs' => $pageConfigs]);
    }
}
