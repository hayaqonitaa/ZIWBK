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
    
    

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // File is optional in update
        ]);
    
        // Find the content by ID
        $content = Content::find($id);
        
        // Check if content exists
        if (!$content) {
            return response()->json(['message' => 'Content not found'], 404);
        }
    
        // Check if category exists for 'Agen Perubahan'
        $category = ContentCategories::where('nama', 'Agen Perubahan')->first();
        if (!$category) {
            return response()->json(['message' => 'Category not found'], 404);
        }
    
        // Update fields with new data
        $content->judul = $request->judul;
        $content->deskripsi = $request->deskripsi;
    
        // Check if a new file has been uploaded
        if ($request->hasFile('file')) {
            // Delete the old file from storage if it exists
            if ($content->file && Storage::disk('public')->exists($content->file)) {
                Storage::disk('public')->delete($content->file);
            }
            
            // Upload the new file and update the file path
            $filePath = $request->file('file')->store('uploads', 'public');
            $content->file = $filePath;
        }
    
        $content->id_kategori = $category->id; // Ensure the category ID is set
        $content->id_admin = Auth::user()->id; // Set admin ID to the authenticated user
        $content->save(); // Save the changes
    
        return response()->json([
            'success' => true,
            'message' => 'Content updated successfully.',
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