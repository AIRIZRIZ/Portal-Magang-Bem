<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Prodi extends Model
{
    // Mengarahkan model ke nama tabel yang benar di MySQL
    protected $table = 'prodi';

    // Kolom yang boleh diisi secara massal
    protected $fillable = ['nama_prodi'];

    /**
     * Relasi Many-to-Many ke InformasiMagang
     */
    public function informasiMagang(): BelongsToMany
    {
        return $this->belongsToMany(
            InformasiMagang::class, 
            'informasi_magang_prodi', // Nama tabel pivot
            'prodi_id',               // Foreign key di tabel pivot untuk prodi
            'informasi_magang_id'     // Foreign key di tabel pivot untuk magang
        );
    }
}