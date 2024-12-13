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
        Schema::table('hasil_survey', function (Blueprint $table) {
            // Menghapus kolom 'nama_kuesioner'
            $table->dropColumn('nama_kuesioner');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('hasil_survey', function (Blueprint $table) {
            // Menambahkan kembali kolom 'nama_kuesioner'
            $table->string('nama_kuesioner');
        });
    }
};
