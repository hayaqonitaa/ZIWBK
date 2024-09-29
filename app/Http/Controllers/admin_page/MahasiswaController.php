<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Prodi;

class MahasiswaController extends Controller
{
  public function index()
  {
    return view('admin-page.mahasiswa.mahasiswa');
  }
  public function getMahasiswa () {
    // Mengambil semua data di model mahasiswa beserta function mahasiswa
    $mahasiswa = Mahasiswa::with('prodi')->get();
    return response()->json(['data' => $mahasiswa]); 
  }

  public function getProdi() // New method for jurusan data
  {
      $prodi = Prodi::all(); // Fetch all jurusan data
      return response()->json([$prodi]);
  }

  public function store(Request $request)
  {
    // validasi data yang dikirim
    $validatedData = $request->validate([
      'nim' => 'required|string|max:255',
      'nama' => 'required|string|max:255',
      'id_prodi' => 'required|uuid',
      'email' => 'required|string|max:255',
  ]);

  // Simpan data ke tabel jurusan
  // Simpan data ke tabel mahasiswa
  $mahasiswa = new Mahasiswa();
  $mahasiswa->nim = $validatedData['nim'];
  $mahasiswa->nama = $validatedData['nama'];
  $mahasiswa->id_prodi = $validatedData['id_prodi'];
  $mahasiswa->email = $validatedData['email'];
  $mahasiswa->save();

  // Response JSON sukses
  return response()->json([
      'message' => 'Prodi berhasil ditambahkan!',
      'data' => $mahasiswa
  ]);
  }
  
  public function update(Request $request) {
    $request->validate([
      'nim' => 'required|string|max:255',
      'nama' => 'required|string|max:255',
      'id_prodi' => 'required|uuid',
      'email' => 'required|string|max:255',
    ]);

    $mahasiswa = new Mahasiswa();
    $mahasiswa->nim = $validatedData['nim'];
    $mahasiswa->nama = $validatedData['nama'];
    $mahasiswa->id_prodi = $validatedData['id_prodi'];
    $mahasiswa->email = $validatedData['email'];
    $mahasiswa->save();
  

    return response()->json([
      'message' => 'Prodi updated successfully!']);
}

public function destroy($id)
{
    // Cari jurusan yang ingin dihapus
    $mahasiswa = Mahasiswa::findOrFail($id);
    $mahasiswa->delete();

    // Response JSON sukses
    return response()->json([
        'message' => 'Mahasiswa berhasil dihapus!'
    ]);
}
}