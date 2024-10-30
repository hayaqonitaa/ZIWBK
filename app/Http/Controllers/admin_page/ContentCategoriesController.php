<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use App\Models\ContentCategories; // Pastikan model sesuai dengan tabel content_categories
use Illuminate\Http\Request;

class ContentCategoriesController extends Controller
{
    public function index()
    {
        return view('admin-page.content_categories.content_categories');
    }

    public function getContentCategories() 
    {
        // Mengambil semua data dari model ContentCategories
        $categories = ContentCategories::all();
        
        return response()->json(['data' => $categories]); // Mengirim data ke JavaScript
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Simpan data ke tabel content_categories
        $category = new ContentCategories(); // Pastikan menggunakan model yang sesuai
        $category->nama = $validatedData['nama'];
        $category->save();

        // Response JSON sukses
        return response()->json([
            'message' => 'Kategori konten berhasil ditambahkan!',
            'data' => $category
        ]);
    }

    public function update(Request $request) 
    {
        // Validasi input
        $request->validate([
            'id' => 'required|exists:content_categories,id', // Pastikan ID valid
            'nama' => 'required|string|max:255', // Validasi nama
        ]);
    
        // Cari kategori berdasarkan ID
        $category = ContentCategories::find($request->id);
        
        // Update field yang sesuai
        $category->nama = $request->nama; // Update nama
    
        // Simpan perubahan
        $category->save();
    
        // Kembalikan response sukses
        return response()->json(['message' => 'Kategori konten berhasil diperbarui!']);
    }    

    public function destroy($id)
    {
        // Cari kategori yang ingin dihapus
        $category = ContentCategories::findOrFail($id);
        $category->delete();

        // Response JSON sukses
        return response()->json([
            'message' => 'Kategori konten berhasil dihapus!'
        ]);
    }
}
