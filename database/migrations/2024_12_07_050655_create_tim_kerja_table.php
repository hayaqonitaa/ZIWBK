<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimKerjaTable extends Migration
{
    public function up(): void
    {
        Schema::create('tim_kerja', function (Blueprint $table) {
            $table->uuid('id'); // Primary key
            $table->string('nama'); // Nama anggota tim kerja
            $table->string('nip'); // NIP anggota tim kerja
            $table->string('jabatan'); // Jabatan anggota tim kerja
            $table->uuid('id_sk'); // Foreign key ke tabel 'content'
            $table->foreign('id_sk')->references('id')->on('content')->onDelete('cascade'); // Definisi foreign key
            $table->timestamps(); // Timestamps for created_at and updated_at
        });
        
    }

    public function down(): void
    {
        Schema::dropIfExists('tim_kerja');
    }
}
     ;
