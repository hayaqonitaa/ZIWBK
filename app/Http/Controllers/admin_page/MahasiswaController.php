<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Mahasiswa;
use App\Models\Admin\Prodi;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\MahasiswaImport;
use Illuminate\Support\Facades\Validator; // Add this line to import Validator
use Illuminate\Support\Facades\Log;



class MahasiswaController extends Controller
{
  public function index()
  {
      $mahasiswas = Mahasiswa::with('prodi')->get();
      return view('admin-page.mahasiswa.mahasiswa', compact('mahasiswas'));
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

//   public function store(Request $request)
//   {
//     // validasi data yang dikirim
//     $validatedData = $request->validate([
//       'nim' => 'required|string|max:255',
//       'nama' => 'required|string|max:255',
//       'id_prodi' => 'required|uuid',
//       'email' => 'required|string|max:255',
//   ]);

//   // Simpan data ke tabel jurusan
//   // Simpan data ke tabel mahasiswa
//   $mahasiswa = new Mahasiswa();
//   $mahasiswa->nim = $validatedData['nim'];
//   $mahasiswa->nama = $validatedData['nama'];
//   $mahasiswa->id_prodi = $validatedData['id_prodi'];
//   $mahasiswa->email = $validatedData['email'];
//   $mahasiswa->save();
 
//   // Response JSON sukses
//   return response()->json([
//       'message' => 'Mahasiswa berhasil ditambahkan!',
//       'data' => $mahasiswa
//   ]);  
//   }

public function store(Request $request)
{
    $validated = $request->validate([
        'nim' => 'required|unique:mahasiswa,nim',
        'email' => 'required|email|unique:mahasiswa,email',
        'nama' => 'required|string',
        'id_prodi' => 'required|exists:prodi,id',
    ], [
        'nim.unique' => 'Mahasiswa dengan NIM ini sudah terdaftar.',
        'email.unique' => 'Email ini sudah digunakan dengan NIM ' . $request->nim,
    ]);
    
    // Jika tidak ada error, simpan data mahasiswa baru
    Mahasiswa::create([
        'nim' => $request->nim,
        'nama' => $request->nama,
        'id_prodi' => $request->id_prodi,
        'email' => $request->email,
    ]);

    return response()->json([
        'message' => 'Data mahasiswa berhasil disimpan.',
    ]);
}

  
  public function update(Request $request) {
    $request->validate([
      'nim' => 'required|string|max:255',
      'nama' => 'required|string|max:255',
      'id_prodi' => 'required|uuid',
      'email' => 'required|string|max:255',
    ]);

    $mahasiswa = Mahasiswa::find($request->id);
    $mahasiswa->nim = $request -> nim;
    $mahasiswa->nama = $request -> nama;
    $mahasiswa->id_prodi = $request -> id_prodi;
    $mahasiswa->email = $request -> email;
    $mahasiswa->save();
  

    return response()->json([
      'message' => 'Mahasiswa updated successfully!']);
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
          'message' => 'Kuesioner berhasil dibagikan!'
      ]);
  }

  public function import(Request $request)
{
    // Validasi file harus berupa Excel
    $request->validate([
        'file' => 'required|mimes:xlsx,xls'
    ]);

    // Ambil file yang diunggah
    $file = $request->file('file');

    // Baca data dari file Excel menggunakan Excel::toCollection
    $data = Excel::toCollection(null, $file);


    // Looping data untuk memasukkan ke database
    foreach ($data[0] as $row) {
        Mahasiswa::create([
            'nim'   => $row[1], // Kolom kedua (nim)
            'nama'  => $row[2], // Kolom ketiga (nama)
            'prodi' => $row[3], // Kolom keempat (prodi)
            'email' => $row[4], // Kolom kelima (email)
        ]);
    
    }
    

    // Redirect atau berikan pesan sukses
    return back()->with('success', 'Data Mahasiswa berhasil diimport.');
}

  public function importMahasiswa(Request $request)
  {
      // Validate the uploaded file
      $request->validate([
          'file' => 'required|mimes:xls,xlsx'
      ]);

      // Import the Excel file
      Excel::import(new MahasiswaImport, $request->file('file'));

      // Return success message
      return response()->json(['message' => 'Data mahasiswa berhasil diimport'], 200);
  }
  public function uploadExcel(Request $request)
{
    $validator = Validator::make($request->all(), [
        'file' => 'required|mimes:xlsx,xls',
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => 'File tidak valid'], 400);
    }

    try {
        // Impor data dan mendapatkan instance dari MahasiswaImport
        $import = new MahasiswaImport();
        Excel::import($import, $request->file('file'));

        // Cek apakah ada error yang terkumpul
        $prodiErrors = $import->getProdiErrors();
        $emailErrors = $import->getEmailErrors();

        // Cek apakah ada nilai di salah satu array error
        if (!empty($prodiErrors) || !empty($emailErrors)) {
            return response()->json([
                'message' => 'Data berhasil diimpor dengan beberapa kesalahan.',
                'email_errors' => $emailErrors,
                'prodi_errors' => $prodiErrors,
            ], 422); // Kirimkan respons error dengan status 422
        }

        return response()->json(['message' => 'Data berhasil diimpor'], 200);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
        ], 500);
    }
}

  
} 