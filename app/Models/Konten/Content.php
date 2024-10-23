<?php

namespace App\Models\Konten;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Content extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'content';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = ['id', 'id_kategori', 'id_admin', 'judul', 'deskripsi', 'file', 'link', 'status'];

    public function content_categories (){// kan id prodi teh ngambil dari model prodi
        return $this->belongsTo(Prodi::class, 'id_prodi'); //belongto artinya id_prodi di tabel mahasiswa = id di tabel prodi

    }

}
