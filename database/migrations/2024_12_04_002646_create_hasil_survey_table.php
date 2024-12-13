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
            $table->id();
            $table->string('nim');
            $table->foreign('nim')->references('nim')->on('mahasiswa')->onDelete('cascade');
            $table->uuid('kuisioner_id');
            $table->foreign('kuisioner_id')->references('id')->on('kuesioner')->onDelete('cascade'); // Relasi ke tabel kuesioner
            $table->text('pertanyaan');
            $table->char('jawaban', 2);
            $table->char('semester', 2);
            $table->timestamps();
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
