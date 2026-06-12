@extends('layouts.user')

@section('content')
<div class="container my-5">

    <div class="mb-4">
        <a href="{{ route('portal') }}" class="btn rounded-0 px-3 py-2 btn-light border-2 border-dark text-uppercase fw-bold shadow-none" style="box-shadow: 3px 3px 0px  var(--brutal-black) !important;">
            <i class="bi bi-arrow-left me-2"></i> Kembali ke Portal
        </a>
    </div>

    <div class="row g-4">
        
        <div class="col-lg-8">
            <div class="card brutal-card p-4 p-md-5 bg-white mb-4">
                
                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-building-fill text-danger fs-5"></i>
                    <h5 class="fw-black text-danger text-uppercase mb-0 tracking-wider">
                        {{ $magang->nama_perusahaan }}
                    </h5>
                </div>
                
                <h1 class="fw-black text-uppercase text-dark tracking-tight mb-4" style="font-size: calc(1.4rem + 1.5vw); line-height: 1.1;">
                    <strong>{{ $magang->posisi_magang }}</strong>
                </h1>

                <div class="d-flex flex-wrap gap-2 mb-4">
                    @if($magang->status_mitra == 'mitra')
                        <span class="badge bg-success border-2 border-dark text-dark text-uppercase fw-bold rounded-3 px-3 py-2">
                            <i class="bi bi-patch-check-fill me-1"></i> Mitra Resmi BEM-FT
                        </span>
                    @else
                        <span class="badge bg-secondary  border-2 border-dark text-dark text-uppercase fw-bold rounded-3 px-3 py-2">
                            <i class="bi bi-globe me-1"></i> Lowongan Umum
                        </span>
                    @endif

                    @forelse($magang->prodis as $prodi)
                        <span class="badge bg-warning text-dark border-2 border-dark text-uppercase fw-bold rounded-3 px-3 py-2">
                            <i class="bi bi-mortarboard-fill me-1"></i> {{ $prodi->nama_prodi }}
                        </span>
                    @empty
                        <span class="badge bg-warning text-dark border-2 border-dark text-uppercase fw-bold rounded-3 px-3 py-2">
                            <i class="bi bi-mortarboard-fill me-1"></i> Semua Prodi Teknik
                        </span>
                    @endforelse
                </div>

                <hr class="border-dark opacity-25 my-4">

                <div class="mb-5">
                    <h4 class="fw-black text-uppercase mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-file-earmark-text-fill text-dark"></i> Deskripsi Pekerjaan
                    </h4>
                    <div class="fw-semibold text-muted bg-light p-3 border-2 rounded-3" style="font-size: 0.95rem; line-height: 1.6; border: 2px solid var(--brutal-black) !important;">
                        {{ $magang->deskripsi }}
                    </div>
                </div>

                <div>
                    <h4 class="fw-black text-uppercase mb-3 d-flex align-items-center gap-2">
                        <i class="bi bi-check-circle-fill text-success"></i> Persyaratan Pelamar
                    </h4>
                    <div class="fw-semibold text-muted bg-light p-3 border-2 rounded-3" style="font-size: 0.95rem; line-height: 1.6; border: 2px solid var(--brutal-black) !important;">
                        {{ $magang->kualifikasi }}
                    </div>
                </div>

            </div>
        </div>

        <div class="col-lg-4">
            <div class="position-sticky" style="top: 100px;">
                <div class="card brutal-card overflow-hidden">
                    
                    <div class="border-bottom border-3 text-center overflow-hidden d-flex align-items-center justify-content-center" style="height: 150px; border-bottom: 2px solid var(--brutal-black) !important;">
                        @if($magang->logo)
                            <img src="{{ asset('storage/' . $magang->logo) }}" alt="Logo {{ $magang->nama_perusahaan }}" class="w-100 h-100" style="object-fit: contain; padding: 1rem; background:--brutal-white;">
                        @else
                            <div class=" opacity-50">
                                <i class="bi bi-building display-3"></i>
                            </div>
                        @endif
                    </div>

                    <div class="p-4">
                        <h5 class="fw-black text-uppercase mb-3">Ringkasan Program</h5>
                        
                        <div class="d-flex flex-column gap-3 small fw-bold text-dark mb-4">
                            <div class="p-2 border-2 rounded-3 bg-light d-flex align-items-center gap-3" style="border: 2px solid var(--brutal-black) !important;">
                                <i class="bi bi-geo-alt-fill fs-5 text-primary"></i>
                                <div>
                                    <span class="text-muted d-block uppercase extra-small" style="font-size: 0.75rem;">Lokasi Kerja</span>
                                    <span>{{ $magang->lokasi }}</span>
                                </div>
                            </div>

                            <div class="p-2  border-2  rounded-3 bg-light d-flex align-items-center gap-3" style="border: 2px solid var(--brutal-black) !important;">
                                <i class="bi bi-hourglass-split fs-5 text-warning"></i>
                                <div>
                                    <span class="text-muted d-block uppercase extra-small" style="font-size: 0.75rem;">Durasi Kontrak</span>
                                    <span>{{ $magang->durasi_magang }} Bulan</span>
                                </div>
                            </div>

                            <div class="p-2  border-2 rounded-3 bg-light d-flex align-items-center gap-3" style="border: 2px solid var(--brutal-black) !important;">
                                <i class="bi bi-calendar-event-fill fs-5 text-danger"></i>
                                <div>
                                    <span class="text-muted d-block uppercase extra-small" style="font-size: 0.75rem;">Batas Pendaftaran</span>
                                    @if($magang->tenggat_pendaftaran)
                                        <span>{{ $magang->tenggat_pendaftaran->translatedFormat('d F Y') }}</span>
                                    @else
                                        <span class="text-muted">Tidak ditentukan</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if($magang->link_pendaftaran)
                            <a href="{{ $magang->link_pendaftaran }}" target="_blank" rel="noopener noreferrer" class="btn w-100 rounded-0 py-3 text-uppercase shadow-none brutal-btn-yellow d-flex align-items-center justify-content-center gap-2 fs-6">
                                <strong>Daftar Magang Sekarang</strong> <i class="bi bi-box-arrow-up-right fs-5"></i>
                            </a>
                            <span class="d-block text-center text-muted extra-small fw-semibold mt-2" style="font-size: 0.75rem;">
                                *Tautan ini akan mengarah ke halaman eksternal mitra.
                            </span>
                        @else
                            <button type="button" class="btn w-100 rounded-0 py-3 text-uppercase shadow-none btn-secondary d-flex align-items-center justify-content-center gap-2 fs-6" disabled>
                                <strong>Link Belum Tersedia</strong>
                            </button>
                        @endif
                    </div>

                </div>
            </div>
        </div>

    </div>

</div>

@endsection
