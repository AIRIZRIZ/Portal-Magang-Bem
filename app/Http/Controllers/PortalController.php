<?php

namespace App\Http\Controllers;

use App\Models\InformasiMagang;
use App\Models\Prodi;

class PortalController extends Controller
{
    /**
     * Halaman Home (Tampilan User)
     * Menampilkan total statistik magang dan statistik per prodi
     */
    public function index()
    {
        $totalMagang = InformasiMagang::count();

        $statistikProdi = Prodi::withCount([
            'informasiMagang as total_mitra' => function ($query) {
                $query->where('status_mitra', 'mitra');
            },
            'informasiMagang as total_non_mitra' => function ($query) {
                $query->where('status_mitra', 'non-mitra');
            },
        ])->orderBy('nama_prodi')->get();

        return view('user.home', compact('totalMagang', 'statistikProdi'));
        
    }

    /**
     * Halaman Portal Informasi (Tampilan User)
     */
    public function portal()
    {
        $daftarMagang = InformasiMagang::orderBy('created_at', 'desc')->get();
        $list_prodi = Prodi::orderBy('nama_prodi', 'asc')->get();

        return view('user.portal', compact('daftarMagang', 'list_prodi'));
    }

    /**
     * Halaman Detail Informasi Magang
     */
    public function detail(int $id)
    {
        $magang = InformasiMagang::with('prodis')->findOrFail($id);

        return view('user.detail', compact('magang'));
    }
}
