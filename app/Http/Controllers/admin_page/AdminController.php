<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Pembagian;
use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Kuesioner;

class AdminController extends Controller
{
  public function index()
  {
    $tahunKuisioner = Kuesioner::distinct()->pluck('tahun');
    $totalMahasiswa = Mahasiswa::all()->count();
    $totalTerkirim = Pembagian::where('status', 'Sudah Terkirim')->count();
    return view('admin-page.index', compact('totalTerkirim', 'totalMahasiswa', 'tahunKuisioner'));
  }
}
