<?php

namespace App\Http\Controllers\konten;

use App\Http\Controllers\Controller;
use App\Models\TimKerja;
use App\Models\Content;
use App\Models\ContentCategories; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ContentTabelTimKerjaController extends Controller
{
    public function index()
    {
        return view('konten.tabel_tim_kerja.tabel_tim_kerja');
    }

    public function getTabelTimKerja()
    {
        $data = TimKerja::with('content')->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'jabatan' => 'required|string|max:255',
            'id_sk' => 'required|uuid|exists:content,id',
        ]);

        $timKerja = new TimKerja();
        $timKerja->id = (string) \Str::uuid(); // Pastikan UUID dibuat
        $timKerja->nama = $request->nama;
        $timKerja->nip = $request->nip;
        $timKerja->jabatan = $request->jabatan;
        $timKerja->id_sk = $request->id_sk;
        $timKerja->save();

        return response()->json([
            'success' => true,
            'message' => 'Tim kerja berhasil dibuat.',
            'data' => $timKerja
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:50',
            'jabatan' => 'required|string|max:255',
            'id_sk' => 'required|uuid|exists:content,id',
        ]);

        $timKerja = TimKerja::find($id);

        if (!$timKerja) {
            return response()->json(['message' => 'Tim kerja tidak ditemukan.'], 404);
        }

        $timKerja->nama = $request->nama;
        $timKerja->nip = $request->nip;
        $timKerja->jabatan = $request->jabatan;
        $timKerja->id_sk = $request->id_sk;
        $timKerja->save();

        return response()->json([
            'success' => true,
            'message' => 'Tim kerja berhasil diperbarui.',
            'data' => $timKerja
        ]);
    }

    public function destroy($id)
    {
        $timKerja = TimKerja::find($id);

        if (!$timKerja) {
            return response()->json(['message' => 'Tim kerja tidak ditemukan.'], 404);
        }

        $timKerja->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tim kerja berhasil dihapus.'
        ]);
    }
}
