<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Prodi;

class ProdiController extends Controller
{
  public function index()
  {
    return view('admin-page.prodi.prodi');
  }
  public function getProdi () {
    // Mengambil semua data di model mahasiswa beserta function prodi
    $prodi = Prodi::with('jurusan')->get();
    return response()->json(['data' => $prodi]); // ini ke admin/mahasiswa.js
  }
}
