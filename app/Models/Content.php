<?php

namespace App\Models;

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

    public function content_categories (){
        return $this->belongsTo(ContentCategories::class, 'id_kategori'); 
    }

    public function users (){
        return $this->belongsTo(User::class, 'id_admin'); 
    }

}
