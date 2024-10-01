<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Pembagian extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'pembagian';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['id', 'status', 'id_mahasiswa', 'id_kuesioner'];

    public function mahasiswa (){// kan id prodi teh ngambil dari model prodi
        return $this->belongsTo(Mahasiswa::class, 'id_mahasiswa'); //belongto artinya id_prodi di tabel mahasiswa = id di tabel prodi

    }

    public function kuesioner (){// kan id prodi teh ngambil dari model prodi
        return $this->belongsTo(Kuesioner::class, 'id_kuesioner'); //belongto artinya id_prodi di tabel mahasiswa = id di tabel prodi

    }

}
