<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kuesioner', function (Blueprint $table) {
            $table->uuid('id')->primary; //untuk id supaya generate string id 
            $table->string('judul');
            $table->string('link_kuesioner');
            $table->timestamps(); //jangan dihapuss untuk membuat created_at dan updated_at

            //sekarang buat model setelah membuat migration tabel kuesioner , model
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuesioner');
    }
};
