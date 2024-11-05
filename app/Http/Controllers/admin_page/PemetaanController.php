<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Prodi;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;
use Illuminate\Support\Facades\Validator; // Add this line to import Validator


class PemetaanController extends Controller
{
  public function index()
  {
      $mahasiswas = Mahasiswa::with('prodi')->get();
      return view('admin-page.pembagian.pemetaan', compact('mahasiswas'));
  }
  public function shareQuestionnaire(Request $request)
  {
      $validatedData = $request->validate([
          'mahasiswa_id' => 'required|array',
          'kuesioner_id' => 'required|uuid',
      ]);

      foreach ($validatedData['mahasiswa_id'] as $mahasiswaId) {
          // Buat pembagian kuesioner untuk setiap mahasiswa yang dipilih
          Pembagian::create([
              'id_mahasiswa' => $mahasiswaId,
              'id_kuesioner' => $validatedData['kuesioner_id'],
              'status' => 'belum dibagikan',
          ]);
      }

      return response()->json([
          'message' => 'Kuesioner berhasil dipetakan!'
      ]);
  }
  
}