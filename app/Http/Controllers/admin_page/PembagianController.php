<?php

namespace App\Http\Controllers\admin_page;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\Pembagian;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;
use App\Models\Admin\Mahasiswa;

class PembagianController extends Controller
{
    public function index()
    {
        return view('admin-page.pembagian.pembagian');
    }

    public function getPembagian() 
    {
        // Mengambil semua data dari model Pembagian beserta relasi mahasiswa dan kuesioner
        $pembagian = Pembagian::with(['mahasiswa', 'kuesioner'])->get();
        
        return response()->json(['data' => $pembagian]); // Mengirim data ke admin/jurusan.js
    }
    

    public function getMahasiswa() // New method for jurusan data
    {
        $mahasiswa = Mahasiswa::all(); // Fetch all jurusan data
        return response()->json([$mahasiswa]);
    }

    public function getKuesioner() // New method for jurusan data
    {
        $kuesioner = Kuesioner::all(); // Fetch all jurusan data
        return response()->json([$kuesioner]);
    }

    public function share(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'mahasiswa_ids' => 'required|array', // Pastikan ini array
            'mahasiswa_ids.*' => 'string', // Setiap elemen di dalam array harus string
            'questionnaire_id' => 'required|string', // Pastikan ini string atau UUID
        ]);
    
        // Looping untuk setiap mahasiswa yang dipilih
        foreach ($validatedData['mahasiswa_ids'] as $id_mahasiswa) {
            Pembagian::create([
                'id' => (string) \Illuminate\Support\Str::uuid(), // Menghasilkan UUID
                'status' => 'Belum Dikirim',
                'id_mahasiswa' => $id_mahasiswa,
                'id_kuesioner' => $validatedData['questionnaire_id'],
            ]);
        }
    
        return response()->json(['message' => 'Pembagian berhasil!'], 201);
    }

    public function kirimEmail(Request $request)
    {
        $ids = explode(',', $request->input('ids')); // Mengambil ID dari permintaan
        $pembagianItems = Pembagian::with('mahasiswa')->whereIn('id', $ids)->get();
    
        foreach ($pembagianItems as $item) {
            // Kirim email ke mahasiswa
            Mail::to($item->mahasiswa->email)->send(new \App\Mail\KuesionerKirimMail($item));
    
            // Perbarui status menjadi "Sudah Terkirim"
            $item->status = 'Sudah Terkirim';
            $item->save(); // Simpan perubahan di database
        }
    
        return response()->json(['success' => true]);
    }

    public function destroy($id)
    {
        // Cari jurusan yang ingin dihapus
        $pembagian = Pembagian::findOrFail($id);
        $pembagian->delete();

        // Response JSON sukses
        return response()->json([
            'message' => 'Data Pembagian Kuesioner berhasil dihapus!'
        ]);
    }
}
