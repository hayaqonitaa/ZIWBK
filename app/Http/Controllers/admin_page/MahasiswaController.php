<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Mahasiswa;

class MahasiswaController extends Controller
{
  public function index()
  {
    return view('admin-page.mahasiswa.mahasiswa');
  }
  public function getMahasiswa () {
    // Mengambil semua data di model mahasiswa beserta function prodi
    $mahasiswa = Mahasiswa::with('prodi')->get();
    return response()->json(['data' => $mahasiswa]); // ini ke admin/mahasiswa.js
  }
}
