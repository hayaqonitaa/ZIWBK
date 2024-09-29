<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids; //untuk memanggil library agar bisa uuid

class Kuesioner extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'kuesioner';

    public $incrementing = false; //karena id nya bukan number jadi tidak akan bertambah

    protected $keyType = 'string'; //karena uuid string

    protected $fillable = ['id', 'judul', 'link_kuesioner']; //untuk memberi tahu ada kolom apa saja di tabel
    


}
