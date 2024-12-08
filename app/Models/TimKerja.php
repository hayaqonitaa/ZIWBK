<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimKerja extends Model
{
    use HasFactory;

    protected $table = 'tim_kerja'; // Nama tabel di database

    protected $keyType = 'string'; // UUID sebagai primary key
    public $incrementing = false; // Non-incrementing primary key
    
    protected $fillable = [
        'id', 'nama', 'nip', 'jabatan', 'id_sk',
    ];

    // Relasi dengan tabel content
    public function content()
    {
        return $this->belongsTo(Content::class, 'id_sk');
    }
}
