<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSurvey extends Model
{
    use HasFactory;

    protected $table = 'hasil_survey'; 

    // Kolom yang dapat diisi
    protected $fillable = ['nim', 'kuisioner_id', 'pertanyaan', 'jawaban', 'semester'];

    public $timestamps = true;

    // Relasi dengan Mahasiswa
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nim', 'nim');
    }

    // Relasi dengan Kuesioner
    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'kuisioner_id');
    }
}