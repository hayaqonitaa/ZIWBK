<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgenPerubahanTable extends Migration
{
    public function up()
    {
        Schema::create('agen_perubahan', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama');
            $table->string('jabatan');
            $table->string('foto');
            $table->string('status');
            $table->timestamp('masa_jabatan');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agen_perubahan');
    }
}
