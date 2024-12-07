<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimKerjaTable extends Migration
{
    public function up(): void
    {
        Schema::create('tim_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('cabang');
            $table->string('bidang');
            $table->unsignedBigInteger('id_sk'); // Foreign key jika diperlukan
            $table->string('file');
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Aktif');
            $table->unsignedBigInteger('created_by'); // ID admin pembuat data
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tim_kerja');
    }
}
;
