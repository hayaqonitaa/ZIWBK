<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Content;

class IndexController extends Controller
{
    public function index()
    {
        // Mengambil konten kategori "Piagam"
        $piagamContents = Content::where('status', 'Aktif')
            ->whereHas('content_categories', function ($query) {
                $query->where('nama', 'Piagam');
            })->get();

        // Mengambil konten kategori "Berita"
        $beritaContents = Content::where('status', 'Aktif')
            ->whereHas('content_categories', function ($query) {
                $query->where('nama', 'Berita');
            })->get();

        // Konfigurasi halaman
        $pageConfigs = ['myLayout' => 'front'];

        // Mengembalikan tampilan dengan data konten
        return view('index', compact('piagamContents', 'beritaContents'), ['pageConfigs' => $pageConfigs]);
    }

    public function show($id)
    {
        // Muat berita beserta data admin
        $berita = Content::with('users')->where('id', $id)
            ->where('status', 'Aktif')
            ->whereHas('content_categories', function ($query) {
                $query->where('nama', 'Berita');
            })->firstOrFail();

        // Konfigurasi halaman
        $pageConfigs = ['myLayout' => 'front'];

        // Kirim data berita ke tampilan
        return view('user_page.berita-show', compact('berita'), ['pageConfigs' => $pageConfigs]);
    }

}
