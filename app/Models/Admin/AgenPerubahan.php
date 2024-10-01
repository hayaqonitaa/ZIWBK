<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AgenPerubahan extends Model
{
    use HasFactory, HasUuids;

    // Tabel Agen Perubahan
    protected $table = 'agen_perubahan'; 
    
    public $incrementing = false; // Uuid tidak increment
    protected $keyType = 'string'; // Uuid tipe string
    public function index(){
        $pageConfigs = ['myLayout' => 'front'];
        return view('admin-page.agenPerubahan.AgenPerubahan', ['pageConfigs' => $pageConfigs]);
    }

    // Kolom yang bisa diisi
    protected $fillable = ['id', 'nama', 'jabatan', 'foto', 'status', 'masa_jabatan']; 
}

