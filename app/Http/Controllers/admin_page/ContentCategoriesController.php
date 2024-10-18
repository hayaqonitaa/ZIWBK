<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use App\Models\Admin\ContentCategories; // Pastikan model ini sesuai dengan struktur tabel di database
use Illuminate\Http\Request;

class ContentCategoriesController extends Controller
{
    public function index()
    {
        return view('admin-page.content_categories.content_categories');
    }

    public function getContentCategories() 
    {
        // Mengambil semua data dari model ContentCategory
        $contentCategories = ContentCategories::all();
        
        return response()->json(['data' => $contentCategories]); // Mengirim data ke admin/content_categories.js
    }
    

    public function store(Request $request)
    {
        // Validasi data yang dikirimkan
        $validatedData = $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        // Simpan data ke tabel content_categories
        $contentCategory = new ContentCategory();
        $contentCategory->nama = $validatedData['nama'];
        $contentCategory->save();

        // Response JSON sukses
        return response()->json([
            'message' => 'Content Category berhasil ditambahkan!',
            'data' => $contentCategory
        ]);
    }

    public function update(Request $request) 
    {
        // Validasi input
        $request->validate([
            'id' => 'required|exists:content_categories,id', // Pastikan ID valid
            'nama' => 'required|string|max:255', // Validasi nama
        ]);
    
        // Cari content category berdasarkan ID
        $contentCategory = ContentCategory::find($request->id);
        
        // Update field yang sesuai
        $contentCategory->nama = $request->nama; // Update nama
    
        // Simpan perubahan
        $contentCategory->save();
    
        // Kembalikan response sukses
        return response()->json(['message' => 'Content Category updated successfully!']);
    }    

    public function destroy($id)
    {
        // Cari content category yang ingin dihapus
        $contentCategory = ContentCategory::findOrFail($id);
        $contentCategory->delete();

        // Response JSON sukses
        return response()->json([
            'message' => 'Content Category berhasil dihapus!'
        ]);
    }
}
