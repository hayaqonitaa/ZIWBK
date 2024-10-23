<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::create('content_categories', function (Blueprint $table) {
        $table->uuid('id')->primary();  // Kolom ID dengan UUID sebagai primary key
        $table->string('nama', 255);    // Kolom Nama Kategori
        $table->timestamps();           // Kolom created_at dan updated_at
    });
}

public function down()
{
    Schema::dropIfExists('content_categories');
}

};
