<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\InformasiMagang;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMagang = InformasiMagang::count();
        $totalMitra = InformasiMagang::where('status_mitra', 'mitra')->count();
        $totalUmum = InformasiMagang::where('status_mitra', 'non-mitra')->count();

        $lowonganTerbaru = InformasiMagang::orderBy('id', 'desc')->limit(5)->get();

        return view('admin.dashboard', compact('totalMagang', 'totalMitra', 'totalUmum', 'lowonganTerbaru'));
    }
}
