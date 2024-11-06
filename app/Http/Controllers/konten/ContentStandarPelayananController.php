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
        $request->validate([
            'judul' => 'required|string|max:255',
            'pdf' => 'required|file|mimes:pdf|max:2048',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);
    
        $category = ContentCategories::where('nama', 'Standar Pelayanan')->first();
    
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    
        // Gunakan struktur path yang konsisten
        $pdfPath = $request->file('pdf')->store('uploads', 'public');
        $imagePath = $request->file('gambar')->store('uploads', 'public');
    
        $content = new Content();
        $content->judul = $request->judul;
        $content->file = $pdfPath;
        $content->deskripsi = $imagePath;
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
        $request->validate([
            'judul' => 'required|string|max:255',
            'pdf' => 'nullable|file|mimes:pdf|max:2048',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        $content = Content::find($id);
    
        if (!$content) {
            return response()->json(['message' => 'Content not found'], 404);
        }
    
        $content->judul = $request->judul;
    
        if ($request->hasFile('pdf')) {
            if ($content->file && Storage::disk('public')->exists($content->file)) {
                Storage::disk('public')->delete($content->file);
            }
            $pdfPath = $request->file('pdf')->store('uploads', 'public');
            $content->file = $pdfPath;
        }
    
        if ($request->hasFile('gambar')) {
            if ($content->deskripsi && Storage::disk('public')->exists($content->deskripsi)) {
                Storage::disk('public')->delete($content->deskripsi);
            }
            $imagePath = $request->file('gambar')->store('uploads', 'public');
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
