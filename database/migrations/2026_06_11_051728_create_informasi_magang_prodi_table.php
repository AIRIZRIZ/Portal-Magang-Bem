<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('informasi_magang_prodi', function (Blueprint $table) {
            $table->id();
            // Jika data magang dihapus, relasi di tabel ini otomatis ikut terhapus (onDelete cascade)
            $table->foreignId('informasi_magang_id')->constrained('informasi_magang')->onDelete('cascade');
            $table->foreignId('prodi_id')->constrained('prodi')->onDelete('cascade');
            $table->unique(['informasi_magang_id', 'prodi_id'], 'informasi_magang_prodi_unique');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('informasi_magang_prodi');
    }
};