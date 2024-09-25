<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Mahasiswa extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'mahasiswa';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['id', 'nim', 'nama', 'email', 'id_prodi'];

    public function prodi (){// kan id prodi teh ngambil dari model prodi
        return $this->belongsTo(Prodi::class, 'id_prodi'); //belongto artinya id_prodi di tabel mahasiswa = id di tabel prodi

    }

}
