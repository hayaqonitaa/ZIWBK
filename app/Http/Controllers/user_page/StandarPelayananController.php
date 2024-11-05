<?php

namespace App\Http\Controllers\user_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;

class StandarPelayananController extends Controller
{
    public function index()
    {
        // Mengambil konten dengan status 'Aktif' dan kategori 'Standar Pelayanan'
        $contents = Content::where('status', 'Aktif')
            ->whereHas('content_categories', function ($query) {
                $query->where('nama', 'Standar Pelayanan');
            })->get();

        // Mengatur konfigurasi halaman
        $pageConfigs = ['myLayout' => 'front'];

        // Mengembalikan tampilan dengan data konten
        return view('user_page.standar-pelayanan', compact('contents'), ['pageConfigs' => $pageConfigs]);
    }
}