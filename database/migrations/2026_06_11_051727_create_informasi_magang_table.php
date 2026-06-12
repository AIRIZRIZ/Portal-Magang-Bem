<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informasi_magang', function (Blueprint $table) {
            $table->id();
            $table->string('logo')->nullable(); // Opsional
            $table->string('nama_perusahaan');
            $table->string('posisi_magang');
            $table->string('lokasi');
            $table->unsignedTinyInteger('durasi_magang');
            $table->text('deskripsi');
            $table->text('kualifikasi'); // Alur/syarat
            $table->enum('status_mitra', ['mitra', 'non-mitra']);
            $table->string('link_pendaftaran')->nullable(); // Opsional
            $table->date('tenggat_pendaftaran')->nullable(); // Opsional
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_magang');
    }
};