<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSurvey extends Model
{
    use HasFactory;
    
    protected $table = 'hasil_survey'; 

    // Kolom
    protected $fillable = ['id', 'nim', 'nama_kuesioner', 'pertanyaan', 'jawaban', 'semester'];
    
    public function mahasiswa(){
        return $this->belongsTo(Mahasiswa::class,'nim');
    }
}
