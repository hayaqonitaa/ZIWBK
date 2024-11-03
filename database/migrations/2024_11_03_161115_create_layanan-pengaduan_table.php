<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLayananPengaduanTable extends Migration
{
    public function up()
    {
        Schema::create('layanan-pengaduan', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('judul');
            $table->string('link');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('layanan-pengaduan');
    }
}