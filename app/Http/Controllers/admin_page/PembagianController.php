<?php

namespace App\Http\Controllers\admin_page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PembagianController extends Controller
{
    public function index()
    {
      return view('admin-page.pembagian.pembagian');
    }

    public function share(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'mahasiswa_ids' => 'required|array', // Pastikan ini adalah array
            'questionnaire_id' => 'required|string', // Pastikan ini string atau UUID
            'status' => 'required|string',
        ]);
    
        // Looping untuk setiap mahasiswa yang dipilih
        foreach ($validatedData['mahasiswa_ids'] as $id_mahasiswa) {
            Pembagian::create([
                'id' => (string) \Illuminate\Support\Str::uuid(), // Menghasilkan UUID
                'status' => $validatedData['status'],
                'id_mahasiswa' => $id_mahasiswa,
                'id_kuesioner' => $validatedData['questionnaire_id'],
            ]);
        }
    
        return response()->json(['message' => 'Pembagian berhasil!'], 201);
    }
    
}
