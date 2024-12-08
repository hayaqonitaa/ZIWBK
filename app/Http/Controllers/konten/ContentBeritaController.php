<?php

namespace App\Http\Controllers\konten;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\ContentCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ContentBeritaController extends Controller
{
    public function index()
    {
        return view('konten.berita.berita');
    }

    public function getBerita()
    {
        $data = Content::whereHas('content_categories', function ($query) {
            $query->where('nama', 'Berita');
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
            'deskripsi' => 'required|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // 'link' => 'nullable|url', // Validasi untuk URL link
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $category = ContentCategories::where('nama', 'Berita')->first();

        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $filePath = $request->file('file')->store('uploads', 'public');

        $content = new Content();
        $content->judul = $request->judul;
        $content->deskripsi = $request->deskripsi;
        $content->file = $filePath;
        // $content->link = $request->link; // Simpan link jika ada
        $content->id_kategori = $category->id;
        $content->id_admin = Auth::user()->id;
        $content->status = $request->status;
        $content->save();

        return response()->json([
            'success' => true,
            'message' => 'Berita created successfully.',
            'data' => $content
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|url', // Validasi untuk URL link
            'status' => 'required|in:Aktif,Tidak Aktif',
        ]);

        $content = Content::find($id);

        if (!$content) {
            return response()->json(['message' => 'Berita not found'], 404);
        }

        $category = ContentCategories::where('nama', 'Berita')->first();
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }

        $content->judul = $request->judul;
        $content->deskripsi = $request->deskripsi;
        // $content->link = $request->link; // Perbarui link jika ada

        if ($request->hasFile('file')) {
            if ($content->file && Storage::disk('public')->exists($content->file)) {
                Storage::disk('public')->delete($content->file);
            }

            $filePath = $request->file('file')->store('uploads', 'public');
            $content->file = $filePath;
        }

        $content->id_kategori = $category->id;
        $content->id_admin = Auth::user()->id;
        $content->status = $request->status;
        $content->save();

        return response()->json([
            'success' => true,
            'message' => 'Berita updated successfully.',
            'data' => $content
        ]);
    }

    public function destroy($id)
    {
        $content = Content::find($id);

        if (!$content) {
            return response()->json(['message' => 'Berita not found'], 404);
        }

        if ($content->file && Storage::disk('public')->exists($content->file)) {
            Storage::disk('public')->delete($content->file);
        }

        $content->delete();

        return response()->json([
            'success' => true,
            'message' => 'Berita deleted successfully.'
        ]);
    }
}
