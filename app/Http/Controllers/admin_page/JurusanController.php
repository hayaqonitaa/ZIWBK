<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use App\Models\Admin\Jurusan;
use Illuminate\Http\Request;

class JurusanController extends Controller
{
    public function index()
    {
        return view('admin-page.jurusan.jurusan');
    }

    public function getJurusan() 
    {
        // Mengambil semua data dari model Jurusan
        $jurusan = Jurusan::all();
        
        return response()->json(['data' => $jurusan]); // Mengirim data ke admin/jurusan.js
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $validatedData = $request->validate([
            'nama' => 'required|unique:jurusan,nama',
        ],[
            'nama.unique' => 'Jurusan sudah terdaftar.'
        ]);

        // Simpan data ke tabel jurusan
        $jurusan = new Jurusan();
        $jurusan->nama = $validatedData['nama'];
        $jurusan->save();

        // Response JSON sukses
        return response()->json([
            'message' => 'Jurusan berhasil ditambahkan!',
            'data' => $jurusan
        ]);
    }

    public function update(Request $request) {
        $request->validate([
            'id' => 'required|exists:jurusan,id',
            'nama' => 'required|string|max:255',
        ]);
    
        $jurusan = Jurusan::find($request->id);
        $jurusan->nama = $request->nama;
        $jurusan->save();
    
        return response()->json(['message' => 'Jurusan updated successfully!']);
    }

    public function destroy($id)
    {
        // Cari jurusan yang ingin dihapus
        $jurusan = Jurusan::findOrFail($id);
        $jurusan->delete();

        // Response JSON sukses
        return response()->json([
            'message' => 'Jurusan berhasil dihapus!'
        ]);
    }


}