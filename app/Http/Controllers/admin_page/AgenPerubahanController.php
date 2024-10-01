<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use App\Models\Admin\AgenPerubahan; // Pastikan Anda sudah membuat model AgenPerubahan
use Illuminate\Http\Request;

class AgenPerubahanController extends Controller
{
    public function index()
    {
        return view('admin-page.agenPerubahan.AgenPerubahan'); // Pastikan ada view yang sesuai
    }

    public function getAgenPerubahan() 
    {
        // Mengambil semua data dari model AgenPerubahan
        $agenPerubahan = AgenPerubahan::all();
        
        return response()->json(['data' => $agenPerubahan]); // Mengirim data ke admin/agen-perubahan.js
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|string|max:255', // Jika foto diperlukan, sesuaikan validasinya
            'status' => 'required|string|max:255',
            'masa_jabatan' => 'required|date', // Sesuaikan dengan format yang Anda inginkan
        ]);

        // Simpan data ke tabel agen_perubahan
        $agenPerubahan = new AgenPerubahan();
        $agenPerubahan->nama = $validatedData['nama'];
        $agenPerubahan->jabatan = $validatedData['jabatan'];
        $agenPerubahan->foto = $validatedData['foto'];
        $agenPerubahan->status = $validatedData['status'];
        $agenPerubahan->masa_jabatan = $validatedData['masa_jabatan'];
        $agenPerubahan->save();

        // Response JSON sukses
        return response()->json([
            'message' => 'Agen Perubahan berhasil ditambahkan!',
            'data' => $agenPerubahan
        ]);
    }

    public function update(Request $request) 
    {
        $request->validate([
            'id' => 'required|exists:agen_perubahan,id', // Pastikan nama tabel sesuai dengan database
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|string|max:255',
            'status' => 'required|string|max:255',
            'masa_jabatan' => 'required|date',
        ]);

        $agenPerubahan = AgenPerubahan::find($request->id);
        $agenPerubahan->nama = $request->nama;
        $agenPerubahan->jabatan = $request->jabatan;
        $agenPerubahan->foto = $request->foto;
        $agenPerubahan->status = $request->status;
        $agenPerubahan->masa_jabatan = $request->masa_jabatan;
        $agenPerubahan->save();

        return response()->json(['message' => 'Agen Perubahan updated successfully!']);
    }

    public function destroy($id)
    {
        // Cari agen perubahan yang ingin dihapus
        $agenPerubahan = AgenPerubahan::findOrFail($id);
        $agenPerubahan->delete();

        // Response JSON sukses
        return response()->json([
            'message' => 'Agen Perubahan berhasil dihapus!'
        ]);
    }
}
