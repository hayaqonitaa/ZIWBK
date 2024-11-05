<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class StandarPelayanan extends Model
{
    use HasFactory, HasUuids;

    // Tabel Standar Pelayanan
    protected $table = 'standar_pelayanan'; 
    
    public $incrementing = false; // UUID tidak increment
    protected $keyType = 'string'; // UUID tipe string

    // Kolom yang bisa diisi
    protected $fillable = ['id', 'judul', 'pdf', 'gambar', 'status'];

    public function index()
    {
        $pageConfigs = ['myLayout' => 'front'];
        return view('admin-page.standarPelayanan.StandarPelayanan', ['pageConfigs' => $pageConfigs]);
    }
}
