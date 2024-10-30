<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class ContentCategories extends Model
{
    use HasFactory,  HasUuids;

    protected $table = 'content_categories'; // Nama tabel yang digunakan

    public $incrementing = false; // Karena id nya bukan auto-increment number

    protected $keyType = 'string'; // UUID disimpan sebagai string

    protected $fillable = ['id', 'nama']; // Kolom yang bisa diisi
}
