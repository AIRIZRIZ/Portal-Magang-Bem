@extends('layouts.user')

@section('content')
<div class="py-5" style="background-color: var(--brutal-blue); border-bottom: 4px solid var(--brutal-black);">
    <div class="container">
        
        <div class="p-4 p-md-5 bg-white border-4 border-dark brutal-card text-dark">
            <div class="row align-items-center g-4">
                
                <div class="col-lg-7 text-center text-lg-start">
                    <span class="badge bg-danger text-white rounded-0 fw-bold border-2 border-dark px-3 py-2 mb-3 tracking-wider">
                        PORTAL RESMI BEM-FT
                    </span>
                    <h2 class="fw-black text-uppercase tracking-tight text-dark mb-3" style="font-size: calc(1.5rem + 2vw); line-height: 1.1;">
                        <strong>Cari Informasi Magang<br>Jauh Lebih Mudah.</strong>
                    </h2>
                    <p class="fw-semibold text-muted mb-4 small text-md-start text-center">
                        Menghubungkan mahasiswa Fakultas Teknik dengan puluhan industri mitra maupun non-mitra secara transparan dan terpusat dalam satu wadah organisasi.
                    </p>
                    <a href="{{ route('portal') }}" class="btn btn-lg rounded-0 px-4 py-3 text-uppercase shadow-none brutal-btn-dark w-100 w-sm-auto">
                        Jelajahi Lowongan Sekarang <i class="bi bi-arrow-right-short ms-1"></i>
                    </a>
                </div>
                
                <div class="col-lg-5 text-center">
                    @if(file_exists(('assets/images/hero-magang.png')))
                        <img src="{{ asset('assets/images/hero-magang.png') }}" alt="Ilustrasi Portal Magang Teknik" class="img-fluid border-3 border-dark" style="border-radius: 12px !important; max-height: 325px; width: 100%; object-fit: cover;">
                    @else
                        <div class="p-4 border-4 border-dark bg-light text-center d-flex flex-column align-items-center justify-content-center position-relative overflow-hidden" style="border-radius: 12px !important; box-shadow: 6px 6px 0px #000; min-height: 250px;">
                            <i class="bi bi-terminal-box text-dark position-absolute opacity-10" style="font-size: 10rem; left: -20px; top: -30px;"></i>
                            <i class="bi bi-rocket-takeoff-fill text-dark display-2 mb-2" style="filter: drop-shadow(3px 3px 0px var(--brutal-yellow));"></i>
                            <span class="fw-bold text-uppercase small text-muted text-center">Taruh file gambar kamu di:<br><code class="text-danger">public/images/hero-magang.png</code></span>
                        </div>
                    @endif
                </div>

            </div>
        </div>

    </div>
</div>

<div class="container my-5">
    <div class="p-4 bg-white border-4 border-dark brutal-card">
        <div class="row align-items-center g-4 text-center text-md-start">
            
            <div class="col-md-8">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start mb-2 gap-2">
                    <i class="bi bi-info-square-fill text-dark fs-4"></i>
                    <h4 class="fw-black text-uppercase mb-0">Tentang Portal Magang</h4>
                </div>
                <p class="fw-semibold text-muted mb-0 small">
                    Situs ini dikelola langsung oleh **Departemen Relasi Dan Kemitraan BEM Fakultas Teknik**. Kami mengumpulkan, memverifikasi, dan mengelompokkan data lowongan kerja praktik atau magang agar relevan dengan kompetensi kurikulum setiap program studi di Fakultas Teknik.
                </p>
            </div>
            
            <div class="col-md-4 border-start-md border-dark ps-md-4">
                <div class="p-3 bg-light border-3 border-dark d-flex align-items-center justify-content-center justify-content-md-between" style="border-radius: 8px !important;">
                    <div class="text-md-start">
                        <span class="text-muted small fw-bold text-uppercase d-block" style="line-height: 1;">Lowongan</span>
                        <strong class="text-uppercase fw-black small">Aktif Saat Ini</strong>
                    </div>
                    <div class="fw-black text-dark ms-3 ms-md-0 d-flex align-items-center" style="font-size: 3.5rem; line-height: 1;">
                        <i class="bi bi-briefcase-fill fs-3 me-2 text-muted opacity-50"></i>
                        {{ $totalMagang }}
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>

<div class="container my-5">
    
    <div class="mb-4 text-center text-md-start">
        <div class="d-inline-flex align-items-center px-3 py-2 border-3 border-dark gap-2" style="border-radius: 8px !important; background-color: var(--brutal-black)!important; color: var(--brutal-white)!important;">
            <i class="bi bi-diagram-3-fill text-warning"></i>
            <h2 class="fw-black text-uppercase mb-0 fs-5">
                Statistik Per Program Studi
            </h2>
        </div>
        <p class="fw-bold text-muted mt-2">Ketersediaan lowongan magang berdasarkan kriteria kecocokan bidang keilmuan mahasiswa.</p>
    </div>

    <div class="row g-4">
        @foreach($statistikProdi as $prodi)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 brutal-card">
                    
                    <div class="card-header rounded-0 py-3 d-flex align-items-center justify-content-between" style="border-top-left-radius: 8px !important; border-top-right-radius: 8px !important; background-color: var(--brutal-black)!important; color: var(--brutal-white)!important;">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-mortarboard-fill text-warning"></i>
                            <h6 class="card-title fw-bold text-uppercase mb-0 tracking-wide small">
                                {{ $prodi->nama_prodi }}
                            </h6>
                        </div>
                        <i class="bi bi-chevron-right small text-dark"></i>
                    </div>
                    
                    <div class="card-body d-flex flex-column justify-content-between p-4">
                        <div class="mb-4 text-center text-md-start">
                            <span class="text-muted small fw-bold text-uppercase tracking-wider">Total Lowongan Jurusan</span>
                            <h3 class="fw-black text-dark mb-0 mt-1" style="font-size: 2.5rem;">
                                <strong>{{ $prodi->total_mitra + $prodi->total_non_mitra }}</strong>
                            </h3>
                        </div>
                        
                        <div class="row g-2 text-center">
                            <div class="col-6">
                                <div class="p-2 border-2 border-dark rounded-3 fw-bold small text-uppercase bg-success text-white d-flex align-items-center justify-content-center gap-1" style="border-radius: 6px !important;">
                                    <i class="bi bi-patch-check-fill small"></i> Mitra: {{ $prodi->total_mitra }}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="p-2 border-2 border-dark rounded-3 fw-bold small text-uppercase bg-secondary text-white d-flex align-items-center justify-content-center gap-1" style="border-radius: 6px !important;">
                                    <i class="bi bi-globe small"></i> Non Mitra : {{ $prodi->total_non_mitra }}
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        @endforeach
    </div>

</div>

<style>
    @media (min-width: 768px) {
        .border-start-md {
            border-left: 3px solid var(--brutal-black) !important;
        }
    }
</style>
@endsection