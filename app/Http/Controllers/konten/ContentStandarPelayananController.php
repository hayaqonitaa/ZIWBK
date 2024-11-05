<?php

namespace App\Http\Controllers\konten;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\ContentCategories; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContentStandarPelayananController extends Controller
{
    public function index()
    {
        return view('konten.standar_pelayanan.standar_pelayanan');
    }

    public function getStandarPelayanan()
    {
        $data = Content::whereHas('content_categories', function ($query) {
            $query->where('nama', 'Standar Pelayanan');
        })->with('content_categories', 'users')->get();
    
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'pdf' => 'required|file|mimes:pdf|max:2048',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);
    
        // Mendapatkan id dari kategori "Standar Pelayanan"
        $category = ContentCategories::where('nama', 'Standar Pelayanan')->first();
    
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    
        // Proses upload file
        $pdfPath = $request->file('pdf')->store('uploads/pdf', 'public'); // Simpan path PDF di kolom 'file'
        $imagePath = $request->file('gambar')->store('uploads/images', 'public'); // Simpan path gambar di kolom 'deskripsi'
    
        // Membuat konten baru
        $content = new Content();
        $content->judul = $request->judul;
        $content->file = $pdfPath; // Menyimpan path PDF di kolom 'file'
        $content->deskripsi = $imagePath; // Menyimpan path gambar di kolom 'deskripsi'
        $content->id_kategori = $category->id;
        $content->id_admin = Auth::user()->id;
        $content->status = $request->status;
        $content->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Content created successfully.',
            'data' => $content
        ]);
    }
    
    public function update(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'judul' => 'required|string|max:255',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Mencari konten berdasarkan ID
        $content = Content::find($id);
    
        if (!$content) {
            return response()->json(['message' => 'Content not found'], 404);
        }
    
        // Perbarui data yang ada
        $content->judul = $request->judul;
    
        // Update file PDF jika ada upload baru
        if ($request->hasFile('pdf')) {
            if ($content->file && Storage::disk('public')->exists($content->file)) {
                Storage::disk('public')->delete($content->file);
            }
            $pdfPath = $request->file('pdf')->store('uploads/pdf', 'public');
            $content->file = $pdfPath;
        }
    
        // Update gambar jika ada upload baru
        if ($request->hasFile('gambar')) {
            if ($content->deskripsi && Storage::disk('public')->exists($content->deskripsi)) {
                Storage::disk('public')->delete($content->deskripsi);
            }
            $imagePath = $request->file('gambar')->store('uploads/images', 'public');
            $content->deskripsi = $imagePath;
        }
    
        $content->status = $request->status;
        $content->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Content updated successfully.',
            'data' => $content
        ]);
    }
    
    public function destroy($id)
    {
        $content = Content::find($id);
        
        if (!$content) {
            return response()->json(['message' => 'Content not found'], 404);
        }
    
        if ($content->file && Storage::disk('public')->exists($content->file)) {
            Storage::disk('public')->delete($content->file);
        }
        if ($content->deskripsi && Storage::disk('public')->exists($content->deskripsi)) {
            Storage::disk('public')->delete($content->deskripsi);
        }
        
    
        $content->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Content deleted successfully.'
        ]);
    }
}
