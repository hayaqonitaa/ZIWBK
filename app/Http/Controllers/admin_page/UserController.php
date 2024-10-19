<?php

namespace App\Http\Controllers\admin_page;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Menampilkan semua data user
    public function index()
    {
        return view('admin-page.user.user');
    }

    // Mengambil data user dan mengirimkan dalam bentuk JSON
    public function getUsers()
    {
        $users = User::all();
        return response()->json(['data' => $users]);
    }

    // Menyimpan user baru
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        // Hash password dan simpan data user
        $user = new User();
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->password = Hash::make($validatedData['password']); // Hash password
        $user->save();

        // Response JSON sukses
        return response()->json([
            'message' => 'User berhasil ditambahkan!',
            'data' => $user
        ]);
    }

    // Mengedit data user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi data yang dikirim
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6', // Password tidak harus diisi saat update
        ]);

        // Update data user
        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        
        if ($request->filled('password')) {
            // Jika password diisi, hash dan update password
            $user->password = Hash::make($validatedData['password']);
        }

        $user->save();

        // Response JSON sukses
        return response()->json(['message' => 'User updated successfully!', 'data' => $user]);
    }

    // Menghapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        // Response JSON sukses
        return response()->json([
            'message' => 'User berhasil dihapus!'
        ]);
    }
}
