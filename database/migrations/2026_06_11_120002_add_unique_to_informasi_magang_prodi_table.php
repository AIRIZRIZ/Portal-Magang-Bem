<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasIndex('informasi_magang_prodi', 'informasi_magang_prodi_unique')) {
            return;
        }

        Schema::table('informasi_magang_prodi', function (Blueprint $table) {
            $table->unique(['informasi_magang_id', 'prodi_id'], 'informasi_magang_prodi_unique');
        });
    }

    public function down(): void
    {
        Schema::table('informasi_magang_prodi', function (Blueprint $table) {
            $table->dropUnique('informasi_magang_prodi_unique');
        });
    }
};
