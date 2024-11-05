<?php

namespace App\Http\Controllers\user_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;

class AgenPerubahanController extends Controller
{
    public function index()
    {
        // Retrieve "Agen Perubahan" content
        $agenPerubahanContents = Content::where('status', 'Aktif')
            ->whereHas('content_categories', function ($query) {
                $query->where('nama', 'Agen Perubahan');
            })->get();

        // Retrieve "Tim Kerja" content
        $timKerjaContents = Content::where('status', 'Aktif')
            ->whereHas('content_categories', function ($query) {
                $query->where('nama', 'Tim Kerja');
            })->get();

        $pageConfigs = ['myLayout' => 'front'];

        // Pass both contents to the view
        return view('user_page.agen-perubahan', compact('agenPerubahanContents', 'timKerjaContents'), ['pageConfigs' => $pageConfigs]);
    }
}
