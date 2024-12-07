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
        Schema::create('hasil_survey', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_mahasiswa'); // Foreign key ke tabel mahasiswa
            $table->uuid('id_kuesioner'); // Foreign key ke tabel kuesioner
            $table->string('semester'); // Semester mahasiswa
            $table->text('pertanyaan'); // Data hasil survey
            $table->text('jawaban');
            $table->timestamps();

            // Relasi ke tabel mahasiswa
            $table->foreign('id_mahasiswa')->references('id')->on('mahasiswa')->onDelete('cascade');

            // Relasi ke tabel kuesioner
            $table->foreign('id_kuesioner')->references('id')->on('kuesioner')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hasil_survey');
    }
};
