<?php

namespace App\Http\Controllers\konten;

use App\Http\Controllers\Controller;
use App\Models\TimKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContentTimKerjaController extends Controller
{
    public function index()
    {
        return view('konten.tim_kerja.tim_kerja'); // Pastikan view ini ada
    }

    public function getTimKerja()
    {
        $data = TimKerja::with('createdBy')->get();

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'cabang' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'id_sk' => 'required|integer',
            'file' => 'required|mimes:pdf|max:2048',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $filePath = $request->file('file')->store('tim_kerja', 'public');

        $timKerja = TimKerja::create([
            'judul' => $request->judul,
            'cabang' => $request->cabang,
            'bidang' => $request->bidang,
            'id_sk' => $request->id_sk,
            'file' => $filePath,
            'status' => $request->status,
            'created_by' => Auth::user()->id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Tim Kerja created successfully.',
            'data' => $timKerja
        ]);
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'cabang' => 'required|string|max:255',
            'bidang' => 'required|string|max:255',
            'id_sk' => 'required|integer',
            'file' => 'nullable|mimes:pdf|max:2048',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $timKerja = TimKerja::find($id);

        if (!$timKerja) {
            return response()->json(['message' => 'Tim Kerja not found'], 404);
        }

        $timKerja->judul = $request->judul;
        $timKerja->cabang = $request->cabang;
        $timKerja->bidang = $request->bidang;
        $timKerja->id_sk = $request->id_sk;
        $timKerja->status = $request->status;

        if ($request->hasFile('file')) {
            if ($timKerja->file && Storage::disk('public')->exists($timKerja->file)) {
                Storage::disk('public')->delete($timKerja->file);
            }

            $filePath = $request->file('file')->store('tim_kerja', 'public');
            $timKerja->file = $filePath;
        }

        $timKerja->save();

        return response()->json([
            'success' => true,
            'message' => 'Tim Kerja updated successfully.',
            'data' => $timKerja
        ]);
    }
    
    public function destroy($id)
    {
        $timKerja = TimKerja::find($id);

        if (!$timKerja) {
            return response()->json(['message' => 'Tim Kerja not found'], 404);
        }

        if ($timKerja->file && Storage::disk('public')->exists($timKerja->file)) {
            Storage::disk('public')->delete($timKerja->file);
        }

        $timKerja->delete();

        return response()->json([
            'success' => true,
            'message' => 'Tim Kerja deleted successfully.'
        ]);
    }
}
