<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilSurvey extends Model
{
    use HasFactory;
    
    protected $table = 'hasil_survey'; 

    // Kolom
    protected $fillable = ['id', 'nim', 'kuisioner_id', 'pertanyaan', 'jawaban', 'semester'];

    public $timestamps = true;

    public function kuesioner()
    {
        return $this->belongsTo(Kuesioner::class, 'kuisioner_id');
    }
    
}
