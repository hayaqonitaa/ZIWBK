<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('piagam', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('file')->nullable();
            $table->string('tahun', 4);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('piagam');
    }
};
