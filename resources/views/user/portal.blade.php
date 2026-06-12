@extends('layouts.user')

@section('content')
<div class="container my-5">

    <div class="text-center text-md-start mb-5">
        <div class="d-inline-flex align-items-center px-3 py-2 border-3 border-dark gap-2 mb-3" style="border-radius: 8px !important; background-color: var(--brutal-black)!important; color: var(--brutal-white)!important;">
            <i class="bi bi-collection-fill text-warning"></i>
            <h2 class="fw-black text-uppercase mb-0 fs-5">
                Portal Lowongan Magang
            </h2>
        </div>
        <h1 class="fw-black text-uppercase text-dark tracking-tight mb-2">
            <strong>Eksplorasi Kesempatan Magang</strong>
        </h1>
        <p class="fw-bold text-muted">Temukan program magang yang sesuai dengan program studi dan minat karirmu di Fakultas Teknik.</p>
    </div>
        <div class="mb-5 d-flex flex-nowrap overflow-x-auto gap-2 pb-2 justify-content-md-center">
            
            <button class="btn rounded-pill px-4 py-2 fw-bold text-uppercase filter-btn active text-nowrap" data-filter="all" style="background: var(--brutal-black); color: var(--brutal-white)!important;">
                Semua
            </button>

            @foreach($list_prodi as $prodi)
                <button class="btn rounded-pill px-3 py-1 fw-bold text-uppercase filter-btn text-nowrap" style="border: 2px solid var(--brutal-black) !important; color: var(--brutal-black)!important;"
                        data-filter="prodi-{{ $prodi->id }}"> {{ $prodi->nama_prodi }}
                </button>
            @endforeach
        </div>

    <div class="row g-4" id="magang-container">
        @forelse($daftarMagang as $magang)
            <div class="col-md-6 col-lg-4 magang-item 
                @foreach($magang->prodis as $p) prodi-{{ $p->id }} @endforeach">

                <div class="card h-100 brutal-card d-flex flex-column justify-content-between">
                    
                    <div>
                        <div class="position-relative border-bottom border-3 border-dark bg-light text-center overflow-hidden d-flex align-items-center justify-content-center"
                            style="height: 160px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            
                            <div class="position-absolute top-0 start-0 m-3 z-1">
                                @if($magang->status_mitra == 'mitra')
                                    <span class="badge bg-success border-2 border-dark text-uppercase fw-bold rounded-3 px-2 py-1 small">
                                        Mitra BEM
                                    </span>
                                @else
                                    <span class="badge bg-secondary border-2 border-dark text-uppercase fw-bold rounded-3 px-2 py-1 small">
                                        Non-Mitra
                                    </span>
                                @endif
                            </div>

                            @if($magang->logo)
                                <img src="{{ asset('storage/' . $magang->logo) }}"
                                    class="w-100 h-100"
                                    style="object-fit: contain; padding: 1rem;">
                            @else
                                <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                    <i class="bi bi-building display-3"></i>
                                </div>
                            @endif
                        </div>

                        <div class="p-4">
                            <h4 class="fw-black text-dark text-uppercase mb-3">
                                {{ $magang->posisi_magang }}
                            </h4>

                            <div class="small text-muted">
                                <div>{{ $magang->lokasi }}</div>
                                <div>Durasi: {{ $magang->durasi_magang }} Bulan</div>
                            </div>
                        </div>
                    </div>

                    <div class="p-4 pt-0">
                        <a href="{{ route('portal.detail', $magang->id) }}"
                        class="btn w-100 brutal-btn-dark">
                            Lihat Detail
                        </a>
                    </div>

                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="p-5 border-4 border-dark brutal-card d-inline-block">
                    <i class="bi bi-folder-x display-1 text-muted mb-3"></i>
                    <h3 class="fw-black text-uppercase">Belum Ada Lowongan</h3>
                    <p class="text-muted">Data magang masih kosong</p>
                </div>
            </div>
        @endforelse
        <div id="empty-state" class="col-12 text-center py-5 d-none">
            <div class="p-5 border-3 border-dark brutal-card bg-white d-inline-block">
                <i class="bi bi-search display-1 text-muted mb-3"></i>
                <h4 class="fw-black text-uppercase mb-2">
                    Belum ada informasi
                </h4>
                <p class="text-muted fw-semibold mb-0">
                    belum ada infomasi terkait magang di prodi ini.
                </p>
            </div>
        </div>
    </div>

</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }

    .filter-btn { border-width: 2px !important; transition: 0.3s; }
    .filter-btn:hover { transform: translateY(-3px); }
    /* Tambahkan efek shadow pada button */
    .filter-btn.active { box-shadow: 4px 4px 0px #101820; }

</style>

<script>
document.addEventListener("click", function(e) {
    const btn = e.target.closest('.filter-btn');
    if (!btn) return;

    const filter = btn.getAttribute('data-filter');

    // update button UI
    document.querySelectorAll('.filter-btn').forEach(b => {
        b.classList.remove('active', 'btn-dark');
        b.classList.add('btn-outline-dark');
    });

    btn.classList.add('active', 'btn-dark');
    btn.classList.remove('btn-outline-dark');

    let visibleCount = 0;

    document.querySelectorAll('.magang-item').forEach(item => {
        if (filter === 'all' || item.classList.contains(filter)) {
            item.style.display = '';
            visibleCount++;
        } else {
            item.style.display = 'none';
        }
    });

    // EMPTY STATE LOGIC
    const emptyState = document.getElementById('empty-state');

    if (visibleCount === 0) {
        emptyState.classList.remove('d-none');
    } else {
        emptyState.classList.add('d-none');
    }
});
</script>

@endsection
