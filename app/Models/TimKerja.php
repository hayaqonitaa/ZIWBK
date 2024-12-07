<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TimKerja extends Model
{
    use HasFactory;

    protected $table = 'tim_kerja'; // Nama tabel di database

    protected $fillable = [
        'judul',
        'cabang',
        'bidang',
        'id_sk',
        'file',
        'status',
        'created_by',
    ];

    // Relasi dengan model User (untuk created_by)
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
