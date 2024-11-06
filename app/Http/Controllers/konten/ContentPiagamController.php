<?php

namespace App\Http\Controllers\konten;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\ContentCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContentPiagamController extends Controller
{
    public function index()
    {
        return view('konten.piagam.piagam'); // Pastikan view ini ada
    }

    public function getPiagam()
    {
        $data = Content::whereHas('content_categories', function ($query) {
            $query->where('nama', 'Piagam');
        })->with('content_categories', 'users')->get();
    
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);
    
        // Cari kategori "Piagam"
        $category = ContentCategories::where('nama', 'Piagam')->first();
    
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    
        // Upload file
        $filePath = $request->file('file')->store('uploads', 'public');
    
        // Buat content baru
        $content = new Content();
        $content->judul = $request->judul;
        $content->deskripsi = $request->deskripsi;
        $content->file = $filePath;
        $content->id_kategori = $category->id;
        $content->id_admin = Auth::user()->id;
        $content->status = $request->status;
        $content->save();
    
        return response()->json([
            'success' => true,
            'message' => 'Content Piagam berhasil ditambahkan.',
            'data' => $content
        ]);
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'required|string',
        'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'status' => 'required|in:Aktif,Tidak Aktif',
    ]);

    // Cari content berdasarkan ID
    $content = Content::find($id);
    
    if (!$content) {
        return response()->json(['message' => 'Content tidak ditemukan'], 404);
    }

    // Cek kategori "Piagam"
    $category = ContentCategories::where('nama', 'Piagam')->first();
    if (!$category) {
        return response()->json(['message' => 'Kategori tidak ditemukan'], 404);
    }

    $content->judul = $request->judul;
    $content->deskripsi = $request->deskripsi;  // Deskripsi sebelumnya akan tetap diupdate sesuai form

    $content->status = $request->status;
    
    // Cek apakah ada file baru
    if ($request->hasFile('file')) {
        // Hapus file lama jika ada
        if ($content->file && Storage::disk('public')->exists($content->file)) {
            Storage::disk('public')->delete($content->file);
        }

        // Upload file baru
        $filePath = $request->file('file')->store('uploads', 'public');
        $content->file = $filePath;
    }

    $content->id_kategori = $category->id;
    $content->id_admin = Auth::user()->id;
    $content->save();

    return response()->json([
        'success' => true,
        'message' => 'Content Piagam berhasil diperbarui.',
        'data' => $content
    ]);
}


public function destroy($id)
    {
        // Find the content by ID
        $content = Content::find($id);
        
        // Check if content exists
        if (!$content) {
            return response()->json(['message' => 'Content not found'], 404);
        }
    
        // Delete the file from storage if it exists
        if ($content->file && Storage::disk('public')->exists($content->file)) {
            Storage::disk('public')->delete($content->file);
        }
    
        // Delete the content from the database
        $content->delete();
    
        return response()->json([
            'success' => true,
            'message' => 'Content deleted successfully.'
        ]);
    }
    


}