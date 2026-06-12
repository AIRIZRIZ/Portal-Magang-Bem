@extends('layouts.admin')

@section('admin_content')
<div class="mb-4 text-center text-md-start">
    <h1 class="fw-black text-uppercase text-dark tracking-tight mb-1">
        <strong>Ringkasan Sistem</strong>
    </h1>
    <p class="fw-bold text-muted small">Selamat datang kembali, Pengurus BEM-FT. Berikut adalah statistik singkat portal magang saat ini.</p>
</div>

<div class="row g-4 mb-5">
    
    <div class="col-12 col-sm-6 col-lg-4">
        <div class="card admin-card p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-bold text-uppercase d-block mb-1">Total Lowongan</span>
                    <h2 class="fw-black text-dark mb-0" style="font-size: 2.5rem;"><strong>{{ $totalMagang }}</strong></h2>
                </div>
                <div class="bg-dark text-warning p-3 border-2 border-dark rounded-3" style="box-shadow: 2px 2px 0px #000;">
                    <i class="bi bi-briefcase-fill fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-lg-4">
        <div class="card admin-card p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-bold text-uppercase d-block mb-1">Kemitraan BEM</span>
                    <h2 class="fw-black text-success mb-0" style="font-size: 2.5rem;"><strong>{{ $totalMitra }}</strong></h2>
                </div>
                <div class="bg-success text-white p-3 border-2 border-dark rounded-3" style="box-shadow: 2px 2px 0px #000;">
                    <i class="bi bi-patch-check-fill fs-3"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-lg-4">
        <div class="card admin-card p-4">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <span class="text-muted small fw-bold text-uppercase d-block mb-1">Lowongan Umum</span>
                    <h2 class="fw-black text-secondary mb-0" style="font-size: 2.5rem;"><strong>{{ $totalUmum }}</strong></h2>
                </div>
                <div class="bg-secondary text-white p-3 border-2 border-dark rounded-3" style="box-shadow: 2px 2px 0px #000;">
                    <i class="bi bi-globe fs-3"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="card admin-card p-4">
    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between pb-3 mb-4 border-bottom border-2 border-light gap-3">
        <div class="text-center text-md-start">
            <h4 class="fw-black text-uppercase text-dark mb-1"><i class="bi bi-clock-history me-2"></i> Rilis Terbaru</h4>
            <p class="small text-muted mb-0 fw-semibold">5 data lowongan kerja magang terakhir yang ditambahkan ke sistem.</p>
        </div>
        <a href="{{ route('admin.magang.index') }}" class="btn btn-dark fw-bold text-uppercase btn-sm border-2 border-dark px-3 py-2 w-100 w-md-auto" style="box-shadow: 3px 3px 0px #000;">
            Kelola Semua <i class="bi bi-arrow-right-short ms-1"></i>
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered border-dark align-middle mb-0">
            <thead class="table-dark text-uppercase small">
                <tr>
                    <th class="py-3 text-center" style="width: 60px;">No</th>
                    <th class="py-3">Perusahaan</th>
                    <th class="py-3">Posisi Magang</th>
                    <th class="py-3 text-center" style="width: 150px;">Status</th>
                </tr>
            </thead>
            <tbody class="fw-semibold small">
                @forelse($lowonganTerbaru as $index => $item)
                    <tr>
                        <td class="text-center py-3">{{ $index + 1 }}</td>
                        <td>{{ $item->nama_perusahaan }}</td>
                        <td><span class="badge bg-light text-dark border border-dark px-2 py-1.5 fw-bold">{{ $item->posisi_magang }}</span></td>
                        <td class="text-center">
                            @if($item->status_mitra == 'mitra')
                                <span class="badge bg-success border border-dark text-uppercase p-2 rounded-2 w-100" style="font-size: 0.7rem;">Mitra BEM</span>
                            @else
                                <span class="badge bg-secondary border border-dark text-uppercase p-2 rounded-2 w-100" style="font-size: 0.7rem;">Umum</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-4 text-muted fw-bold">
                            <i class="bi bi-inbox display-6 d-block mb-2"></i> Belum ada data lowongan magang yang diinput.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    /* =========================
    DARK MODE DASHBOARD
    ========================= */

    [data-theme="dark"] .card.admin-card{
        background:#1e293b !important;
        color:#f8fafc !important;
        border-color:#475569 !important;
    }

    [data-theme="dark"] .card.admin-card h1,
    [data-theme="dark"] .card.admin-card h2,
    [data-theme="dark"] .card.admin-card h3,
    [data-theme="dark"] .card.admin-card h4,
    [data-theme="dark"] .card.admin-card h5{
        color:#fff !important;
    }

    [data-theme="dark"] .text-dark{
        color:#fff !important;
    }

    [data-theme="dark"] .text-muted{
        color:#cbd5e1 !important;
    }

    [data-theme="dark"] .bg-white{
        background:#1e293b !important;
    }

    [data-theme="dark"] .bg-light{
        background:#334155 !important;
        color:white !important;
    }

    [data-theme="dark"] .table{
        color:white !important;
    }

    [data-theme="dark"] .table-bordered{
        border-color:#475569 !important;
    }

    [data-theme="dark"] .table td,
    [data-theme="dark"] .table th{
        border-color:#475569 !important;
    }

    [data-theme="dark"] .badge.bg-light{
        background:#334155 !important;
        color:white !important;
    }

    [data-theme="dark"] .table-dark{
        background:#0f172a !important;
    }

    [data-theme="dark"] .btn-dark{
        background:#334155 !important;
        border-color:#475569 !important;
    }

    [data-theme="dark"] .btn-dark:hover{
        background:#475569 !important;
    }

    /* TABLE DARK MODE */
    [data-theme="dark"] table {
        background: #1e293b !important;
        color: #fff !important;
    }

    [data-theme="dark"] tbody,
    [data-theme="dark"] tbody tr,
    [data-theme="dark"] tbody td {
        background: #1e293b !important;
        color: #fff !important;
    }

    [data-theme="dark"] thead,
    [data-theme="dark"] thead tr,
    [data-theme="dark"] thead th {
        background: #0f172a !important;
        color: #fff !important;
    }

    [data-theme="dark"] .table > :not(caption) > * > * {
        background-color: transparent !important;
        color: #fff !important;
    }

    [data-theme="dark"] .table-hover tbody tr:hover {
        background: #334155 !important;
    }

    [data-theme="dark"] .table-bordered,
    [data-theme="dark"] .table-bordered td,
    [data-theme="dark"] .table-bordered th {
        border-color: #475569 !important;
    }

</style>

@endsection