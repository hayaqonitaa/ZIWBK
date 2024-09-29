<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Kuisioner extends Controller
{
    public function index()
    {
        return view('admin-page.kuisoner.kuisioner');
    }

    public function getJurusan() 
    {
        // Mengambil semua data dari model Jurusan
        $kuisioner = Kuisioner::all();
        
        return response()->json(['data' => $kuisioner]); // Mengirim data ke admin/jurusan.js
    }
}
