<?php

namespace App\Http\Controllers\konten;

use App\Http\Controllers\Controller;
use App\Models\Content;
use App\Models\ContentCategories; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // For getting the authenticated user
use Illuminate\Support\Facades\Storage; // For handling file uploads

class ContentAgenPerubahanController extends Controller
{
    public function index()
    {
        return view('konten.agen_perubahan.agen_perubahan');
    }

    public function getAgenPerubahan()
    {
        $data = Content::whereHas('content_categories', function ($query) {
            $query->where('nama', 'Agen Perubahan');
        })->with('content_categories', 'users')->get();
    
        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
    
    public function getJurusan() 
    {
        // Mengambil semua data dari model Jurusan
        $jurusan = Jurusan::all();
        
        return response()->json(['data' => $jurusan]); // Mengirim data ke admin/jurusan.js
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max file size 2MB
        ]);
    
        // Get the id of the "Agen Perubahan" category
        $category = ContentCategories::where('nama', 'Agen Perubahan')->first();
    
        // Check if category exists
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    
        // Handle file upload to storage
        $filePath = $request->file('file')->store('uploads', 'public');
    
        // Create new content
        $content = new Content();
        $content->judul = $request->judul;
        $content->deskripsi = $request->deskripsi;
        $content->file = $filePath; // Store the file path relative to storage/app
        $content->id_kategori = $category->id; // Set category ID
        $content->id_admin = Auth::user()->id; // Automatically get the authenticated user's ID
        $content->save(); // Save the content
    
        return response()->json([
            'success' => true,
            'message' => 'Content created successfully.',
            'data' => $content
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