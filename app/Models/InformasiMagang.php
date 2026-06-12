<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class InformasiMagang extends Model
{
    protected $table = 'informasi_magang';

    protected $fillable = [
        'logo',
        'nama_perusahaan',
        'posisi_magang',
        'lokasi',
        'durasi_magang',
        'deskripsi',
        'kualifikasi',
        'status_mitra',
        'link_pendaftaran',
        'tenggat_pendaftaran',
    ];

    protected function casts(): array
    {
        return [
            'durasi_magang' => 'integer',
            'tenggat_pendaftaran' => 'date',
        ];
    }

    /**
     * Relasi Many-to-Many ke Prodi
     */
    public function prodis(): BelongsToMany
    {
        return $this->belongsToMany(
            Prodi::class,
            'informasi_magang_prodi',
            'informasi_magang_id',
            'prodi_id'
        );
    }
}
