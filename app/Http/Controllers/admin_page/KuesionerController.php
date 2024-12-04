<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use App\Models\Admin\Kuesioner;
use Illuminate\Http\Request;

class KuesionerController extends Controller
{
    public function index()
    {
        return view('admin-page.kuesioner.kuesioner');
    }

    public function getKuesioner() 
    {
        // Mengambil semua data dari model Jurusan
        $kuesioner = Kuesioner::all();
        
        return response()->json(['data' => $kuesioner]); // Mengirim data ke admin/jurusan.js
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $validatedData = $request->validate([
            'judul' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
            'link_kuesioner' => 'required|string|max:255',
        ]);

        // Simpan data ke tabel jurusan
        $kuesioner = new Kuesioner();
        $kuesioner->judul = $validatedData['judul'];
        $kuesioner->tahun = $validatedData['tahun'];
        $kuesioner->link_kuesioner = $validatedData['link_kuesioner'];
        $kuesioner->save();

        // Response JSON sukses
        return response()->json([
            'message' => 'Kuesioner berhasil ditambahkan!',
            'data' => $kuesioner
        ]);
    }

    public function update(Request $request) {
        // Validasi input
        $request->validate([
            'id' => 'required|exists:kuesioner,id', // Pastikan ID valid
            'judul' => 'required|string|max:255', // Validasi judul
            'tahun' => 'required|string|max:255',
            'link_kuesioner' => 'required|string|max:255', // Validasi link_kuesioner
        ]);
    
        // Cari kuesioner berdasarkan ID
        $kuesioner = Kuesioner::find($request->id);
        
        // Update field yang sesuai
        $kuesioner->judul = $request->judul; // Update judul
        $kuesioner->link_kuesioner = $request->link_kuesioner; // Update link kuesioner
    
        // Simpan perubahan
        $kuesioner->save();
    
        // Kembalikan response sukses
        return response()->json(['message' => 'Kuesioner updated successfully!']);
    }    

    public function destroy($id)
    {
        // Cari jurusan yang ingin dihapus
        $kuesioner = Kuesioner::findOrFail($id);
        $kuesioner->delete();

        // Response JSON sukses
        return response()->json([
            'message' => 'Kuesioner berhasil dihapus!'
        ]);
    }

    public function share(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'id_mahasiswa' => 'required|array', // Mengharuskan ini menjadi array jika Anda memilih banyak mahasiswa
            'id_kuesioner' => 'required|string', // Pastikan ini string atau UUID
            'status' => 'required|string',
        ]);
    
        // Looping untuk setiap mahasiswa yang dipilih
        foreach ($validatedData['id_mahasiswa'] as $id_mahasiswa) {
            Pembagian::create([
                'id' => (string) \Illuminate\Support\Str::uuid(), // Menghasilkan UUID
                'status' => $validatedData['status'],
                'id_mahasiswa' => $id_mahasiswa,
                'id_kuesioner' => $validatedData['id_kuesioner'],
            ]);
        }
    
        return response()->json(['message' => 'Pembagian berhasil!'], 201);
    }
}
