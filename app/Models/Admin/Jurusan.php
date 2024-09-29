<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Jurusan extends Model
{
    use HasFactory,HasUuids;

    // Tabel Jurusan
    protected $table = 'jurusan'; 
    
    public $incrementing = false; // Uuid tidak increment
    protected $keyType = 'string'; // Uuid tipe string

    // Kolom
    protected $fillable = ['id', 'nama']; 

}

