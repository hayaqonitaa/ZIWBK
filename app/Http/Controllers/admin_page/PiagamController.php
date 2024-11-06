<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use App\Models\Admin\Piagam; // Sesuaikan model ke Piagam
use Illuminate\Http\Request;

class PiagamController extends Controller
{
    public function index()
    {
        return view('admin-page.piagam.Piagam'); // Pastikan view sesuai dengan struktur direktori baru
    }

    public function getPiagam() 
    {
        // Mengambil semua data dari model Piagam
        $piagam = Piagam::all();
        
        return response()->json(['data' => $piagam]); // Mengirim data ke admin/piagam.js
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|string|max:255', // Jika file diperlukan, sesuaikan validasinya
            'tahun' => 'required|string|max:4', // Tahun dalam format teks
        ]);

        // Simpan data ke tabel piagam
        $piagam = new Piagam();
        $piagam->judul = $validatedData['judul'];
        $piagam->deskripsi = $validatedData['deskripsi'];
        $piagam->file = $validatedData['file'];
        $piagam->tahun = $validatedData['tahun'];
        $piagam->save();

        // Response JSON sukses
        return response()->json([
            'message' => 'Piagam berhasil ditambahkan!',
            'data' => $piagam
        ]);
    }

    public function update(Request $request) 
    {
        $request->validate([
            'id' => 'required|exists:piagam,id', // Pastikan nama tabel sesuai dengan database
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|string|max:255',
            'tahun' => 'required|string|max:4',
        ]);

        $piagam = Piagam::find($request->id);
        $piagam->judul = $request->judul;
        $piagam->deskripsi = $request->deskripsi;
        $piagam->file = $request->file;
        $piagam->tahun = $request->tahun;
        $piagam->save();

        return response()->json(['message' => 'Piagam berhasil diperbarui!']);
    }

    public function destroy($id)
    {
        // Cari piagam yang ingin dihapus
        $piagam = Piagam::findOrFail($id);
        $piagam->delete();

        // Response JSON sukses
        return response()->json([
            'message' => 'Piagam berhasil dihapus!'
        ]);
    }
}
