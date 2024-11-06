<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePiagamTable extends Migration
{
    public function up()
    {
        Schema::create('piagam', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('file')->nullable(); // File bersifat opsional
            $table->string('tahun', 4); // Tahun dalam format teks 4 karakter
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('piagam');
    }
}
