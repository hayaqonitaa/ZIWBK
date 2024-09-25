<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Prodi extends Model
{
    use HasFactory, HasUuids;
    
    // Tabel Jurusan
    protected $table = 'prodi'; 
    
    public $incrementing = false; // Uuid tidak increment
    protected $keyType = 'string'; // Uuid tipe string

    // Kolom
    protected $fillable = ['id', 'nama', 'id_jurusan'];
    
    public function jurusan(){
        return $this->belongsTo(Jurusan::class,'id_jurusan');
    }
}
