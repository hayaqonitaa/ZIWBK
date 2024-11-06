<?php

namespace App\Http\Controllers\user_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;

class PiagamController extends Controller
{
    public function index()
    {
        // Mengambil konten dengan status 'Aktif' dan kategori 'Piagam'
        $contents = Content::where('status', 'Aktif')
            ->whereHas('content_categories', function ($query) {
                $query->where('nama', 'Piagam');
            })->get();

        // Mengatur konfigurasi halaman
        $pageConfigs = ['myLayout' => 'front'];

        // Mengembalikan tampilan dengan data konten
        return view('user_page.piagam', compact('contents'), ['pageConfigs' => $pageConfigs]);
    }
}