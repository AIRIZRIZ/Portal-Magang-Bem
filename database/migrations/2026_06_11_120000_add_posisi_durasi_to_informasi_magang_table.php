<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('informasi_magang', function (Blueprint $table) {
            if (! Schema::hasColumn('informasi_magang', 'posisi_magang')) {
                $table->string('posisi_magang')->after('nama_perusahaan');
            }

            if (! Schema::hasColumn('informasi_magang', 'durasi_magang')) {
                $table->unsignedTinyInteger('durasi_magang')->after('lokasi');
            }
        });
    }

    public function down(): void
    {
        Schema::table('informasi_magang', function (Blueprint $table) {
            if (Schema::hasColumn('informasi_magang', 'posisi_magang')) {
                $table->dropColumn('posisi_magang');
            }

            if (Schema::hasColumn('informasi_magang', 'durasi_magang')) {
                $table->dropColumn('durasi_magang');
            }
        });
    }
};
