<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-bem.png') }}">
    <title>Portal Magang BEM-FT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;700;800;900&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    @vite(['resources/js/app.js'])

    <style>
        @media (max-width: 576px) {
            .custom-brand {
                max-width: 220px;
                padding: 3px 10px;
            }

            .custom-brand strong {
                font-size: 0.6rem;
            }

            .custom-brand span {
                font-size: 0.4rem !important;
            }
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

    <nav class="navbar navbar-expand-lg navbar-dark custom-navbar py-3 sticky-top">
        <div class="container">
            <a class="navbar-brand custom-brand d-flex align-items-center mb-0 ps-2 ps-lg-2">
                <div class="me-2 d-flex align-items-center shrink-0">
                    <img src="{{ asset('assets/images/logo-bem.png') }}" 
                        alt="Logo" 
                        style="height: 40px;" 
                        onerror="this.style.display='none'; document.getElementById('fallback-icon').classList.remove('d-none');">
                    
                    <i id="fallback-icon" class="bi bi-cpu-fill text-dark d-none" style="font-size: 1.5rem;"></i>
                </div>
                
                <div class="d-flex flex-column lh-sm">
                    <strong class="mb-0 small text-uppercase ">Dept. Relasi Dan Kemitraan</strong>
                    <span class="text-primary" style="font-size: 0.75rem; font-weight: 800;">Badan Eksekutif Mahasiswa Fakultas Teknik UTM</span>
                </div>
            </a>
            {{-- <div class="d-flex justify-content-center align-items-center ms-lg-3 mt-3 mt-lg-0">
                <button
                    id="theme-toggle"
                    class="btn btn-warning border-2 border-dark rounded-circle d-flex align-items-center justify-content-center"
                    style="width:45px;height:45px;">
                    <i id="theme-icon" class="bi bi-moon-fill"></i>
                </button>

            </div> --}}
            <button class="navbar-toggler border-2 border-dark bg-dark rounded-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto mt-3 mt-lg-0 gap-1 text-center text-lg-start">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('portal') }}">Portal Informasi</a>
                    </li>
                </ul>
                <div class="d-flex justify-content-center align-items-center ms-lg-3 mt-3 mt-lg-0">
                    <button
                        id="theme-toggle"
                        class="btn btn-warning border-2 border-dark rounded-circle d-flex align-items-center justify-content-center"
                        style="width:45px;height:45px;">

                        <i id="theme-icon" class="bi bi-moon-fill"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <main class=flex-grow-1>
        @yield('content')
    </main>

    <footer class="custom-footer pt-5 pb-3 mt-5">
        <div class="container">
            <div class="row g-4 text-center text-md-start">
                <div class="col-md-5">
                    <h5 class="fw-bold text-uppercase border-bottom border-2 d-inline-block pb-1 mb-3 text-warning" style="border-color: var(--brutal-white) !important;">BEM FT UNIVERSITAS TRUNODJOYO MADURA</h5>
                    <p class="small" style="text-color: var(--brutal-white) !important;"">
                        Wadah resmi penyebaran informasi lowongan magang industri, startup, dan kemitraan khusus untuk mahasiswa Fakultas Teknik.
                    </p>
                </div>
                <div class="col-md-3 ms-auto">
                    <h5 class="fw-bold text-uppercase border-bottom border-2 d-inline-block pb-1 mb-3 text-warning" style="border-color: var(--brutal-white) !important;">Tautan</h5>
                    <ul class="list-unstyled small">
                        <li class="mb-2"><a href="{{ route('home') }}">› Home</a></li>
                        <li class="mb-2"><a href="{{ route('portal') }}">› Portal Informasi</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5 class="fw-bold text-uppercase border-bottom border-2 d-inline-block pb-1 mb-3 text-warning" style="border-color: var(--brutal-white) !important;">Sosial Media</h5>
                    <div class="d-flex gap-3 ">
                        <a href="https://www.instagram.com/bemftutm/" class="btn btn-outline-light rounded-0 border-2 p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; border-color: var(--brutal-white);">
                            <i class="bi bi-instagram fs-4"></i>
                        </a>
                        <a href="#" class="btn btn-outline-light rounded-0 border-2 p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; border-color: var(--brutal-white);">
                            <i class="bi bi-globe fs-4"></i>
                        </a>
                        <a href="https://www.tiktok.com/@bemft.trunojoyo" class="btn btn-outline-light rounded-0 border-2 p-2 d-flex align-items-center justify-content-center" style="width: 45px; height: 45px; border-color: var(--brutal-white);">
                            <i class="bi bi-tiktok fs-4"></i>
                        </a>
                    </div>
                </div>
            </div>
            <hr class="border opacity-50 my-6" style="border-color: var(--brutal-white) !important;"">
            <div class="row">
                <div class="col text-center">
                    <p class="small mb-0 text-uppercase tracking-wide opacity-50">
                        &copy; 2026 BEM FAKULTAS TEKNIK.
                    </p>
                </div>
            </div>
        </div>
    </footer>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const toggleBtn = document.getElementById('theme-toggle');
    const icon = document.getElementById('theme-icon');

    const savedTheme =
        localStorage.getItem('theme') || 'light';

    document.documentElement.setAttribute(
        'data-theme',
        savedTheme
    );

    updateIcon(savedTheme);

    toggleBtn.addEventListener('click', () => {

        const current =
            document.documentElement.getAttribute('data-theme');

        const next =
            current === 'dark'
                ? 'light'
                : 'dark';

        document.documentElement.setAttribute(
            'data-theme',
            next
        );

        localStorage.setItem('theme', next);

        updateIcon(next);
    });

    function updateIcon(theme) {

        if(theme === 'dark') {
            icon.className = 'bi bi-sun-fill';
        } else {
            icon.className = 'bi bi-moon-fill';
        }
    }
});
</script>

</body>
</html>