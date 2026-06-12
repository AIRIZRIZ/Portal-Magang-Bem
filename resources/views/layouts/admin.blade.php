<!DOCTYPE html>
<html data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - BEM FT</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo-bem.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    @vite(['resources/js/app.js'])
    
    <style>

        [data-theme="dark"] .card,


        :root {
            --admin-dark: #101820;
            --admin-red: #DC3545;
            --sidebar-expanded: 260px;
            --sidebar-collapsed: 75px;
        

            --admin-bg:#F8F9FA;
            --card-bg: #FFFFFF;
            --text-color: #101820;
            --navbar-bg: #FFFFFF;
            --sidebar-bg: #101820;
            --sidebar-footer: #0b1016;
            --shadow-color: #101820;

        }

        [data-theme="dark"] {
            --admin-bg:#0f172a;
            --card-bg: #1e293b;
            --text-color: #f8fafc;
            --navbar-bg: #1e293b;
            --sidebar-bg: #020617;
            --sidebar-footer: #111827;
            --shadow-color: #ffffff;
        }

        [data-theme="dark"] .admin-card {
            background: #1e293b !important;
            color: white !important;
        }

        [data-theme="dark"] .table {
            color: white !important;
        }

        [data-theme="dark"] .table td,
        [data-theme="dark"] .table th {
            border-color: #475569 !important;
        }

        [data-theme="dark"] .table-light {
            background: #334155 !important;
            color: white !important;
        }

        [data-theme="dark"] .bg-white,
        [data-theme="dark"] .bg-light {
            background-color: #1e293b !important;
            color: #f8fafc !important;
        }

        [data-theme="dark"] .text-dark {
            color: white !important;
        }

        [data-theme="dark"] .modal-content {
            background: #1e293b !important;
            color: white !important;
        }

        [data-theme="dark"] .form-control,
        [data-theme="dark"] .form-select {
            background: #334155 !important;
            color: white !important;
            border-color: #475569 !important;
        }

        [data-theme="dark"] .form-control::placeholder {
            color: #cbd5e1 !important;
        }

        
        body, html {
            background-color: var(--admin-bg);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            height: 100%;
            overflow-x: hidden;
        }

        .admin-card {
            background: var(--card-bg);
            color: var(--text-color);
            border: 3px solid var(--admin-dark) !important;
            border-radius: 12px !important;
            box-shadow: 5px 5px 0px var(--admin-dark) !important;
        }

        /* --- LAYOUT WRAPPER UTAMA --- */
        #wrapper {
            display: flex;
            width: 100%;
            min-height: 100vh;
            position: relative;
        }

        /* --- SIDEBAR WORKSPACE --- */
        #sidebar-wrapper {
            width: var(--sidebar-expanded);
            background-color: var(--sidebar-bg);
            border-right: 4px solid var(--admin-dark);
            display: flex;
            flex-direction: column;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            transition: width 0.25s ease-in-out, transform 0.25s ease-in-out;
            z-index: 1050;
        }

        /* Header Brand pemicu toggle khusus Desktop */
        #sidebar-wrapper .sidebar-heading {
            padding: 1.25rem;
            border-bottom: 4px solid var(--admin-red);
            background-color: var(--admin-dark);
            white-space: nowrap;
            overflow: hidden;
            cursor: pointer;
            user-select: none;
        }

        #sidebar-wrapper .list-group-item {
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.75);
            background-color: transparent;
            border: none;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.85rem;
            transition: all 0.2s;
            text-decoration: none;
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        #sidebar-wrapper .list-group-item i {
            font-size: 1.25rem;
            min-width: 30px;
        }

        #sidebar-wrapper .list-group-item span {
            transition: opacity 0.2s ease-in-out;
            opacity: 1;
            margin-left: 5px;
        }

        #sidebar-wrapper .list-group-item:hover,
        #sidebar-wrapper .list-group-item.active-menu {
            color: #fff !important;
            background-color: var(--admin-red) !important;
            border-left: 6px solid var(--bs-warning) !important;
        }

        .sidebar-footer-wrapper {
            background-color: var(--sidebar-footer);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-footer-profile {
            padding: 1rem 1.25rem;
            white-space: nowrap;
            overflow: hidden;
        }

        .btn-sidebar-logout {
            width: 100%;
            background-color: transparent;
            border: none;
            color: rgba(255, 255, 255, 0.6);
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.8rem;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            text-align: left;
            transition: all 0.2s;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }
        .btn-sidebar-logout:hover {
            color: #ffc107;
            background-color: rgba(220, 53, 69, 0.2);
        }

        /* --- WORKSPACE KANAN --- */
        #page-content-wrapper {
            flex: 1;
            margin-left: var(--sidebar-expanded);
            min-width: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.25s ease-in-out;
        }

        /* Top Bar Layout Tinggi & Longgar */
        .admin-top-nav {
            background-color: var(--navbar-bg) !important;
            border-bottom: 4px solid var(--admin-dark);
            height: 75px;
            padding: 0 !important;
            display: flex;
            align-items: center;
        }

        /* Styling Kotak Search Bar Tengah */
        .topbar-search-form {
            max-width: 550px;
            width: 100%;
        }
        
        .search-group-brutal {
            border: 3px solid var(--admin-dark) !important;
            border-radius: 8px !important;
            overflow: hidden;
            background-color: #fff !important;
            box-shadow: 3px 3px 0px var(--admin-dark) !important;
            transition: transform 0.1s ease, box-shadow 0.1s ease;
        }

        [data-theme="dark"] .search-group-brutal {
            background: #334155 !important;
        }

        [data-theme="dark"] .search-group-brutal input {
            color: white !important;
        }

        [data-theme="dark"] .search-group-brutal i {
            color: white !important;
        }

        /* ======================================================= */
        /* --- MODE DESKTOP LAPTOP (SIDEBAR COLLAPSED) --- */
        /* ======================================================= */
        @media (min-width: 992px) {
            #wrapper.toggled #sidebar-wrapper {
                width: var(--sidebar-collapsed);
            }
            #wrapper.toggled #sidebar-wrapper .list-group-item {
                padding: 1rem 0rem;
                justify-content: center;
            }
            #wrapper.toggled #sidebar-wrapper .list-group-item i {
                min-width: unset;
                font-size: 1.4rem;
            }
            #wrapper.toggled #sidebar-wrapper .list-group-item span,
            #wrapper.toggled #sidebar-wrapper .sidebar-heading .brand-text,
            #wrapper.toggled #sidebar-wrapper .sidebar-footer-profile .profile-text,
            #wrapper.toggled #sidebar-wrapper .btn-sidebar-logout span {
                display: none;
            }
            #wrapper.toggled #sidebar-wrapper .btn-sidebar-logout {
                justify-content: center;
                padding: 1rem 0;
            }
            #wrapper.toggled #sidebar-wrapper .btn-sidebar-logout i {
                font-size: 1.3rem;
            }
            #wrapper.toggled #sidebar-wrapper .sidebar-footer-profile {
                justify-content: center;
                padding: 1rem 0;
            }
            #wrapper.toggled #page-content-wrapper {
                margin-left: var(--sidebar-collapsed);
            }

            body,
            .admin-card,
            .admin-top-nav,
            #sidebar-wrapper,
            .sidebar-footer-wrapper,
            .search-group-brutal {
                transition: all .3s ease;
            }

            [data-theme="dark"] .admin-card,
            [data-theme="dark"] .search-group-brutal,
            [data-theme="dark"] .btn,
            [data-theme="dark"] .badge,
            [data-theme="dark"] .modal-content {
                box-shadow: 4px 4px 0px #ffffff !important;
            }

        }

        /* ======================================================= */
        /* --- AKSI RESPONSIVE SCREEN MOBILE / HP --- */
        /* ======================================================= */
        @media (max-width: 991.98px) {
            #sidebar-wrapper {
                transform: translateX(calc(-1 * var(--sidebar-expanded)));
                width: var(--sidebar-expanded);
            }
            #page-content-wrapper {
                margin-left: 0;
            }
            #wrapper.toggled #sidebar-wrapper {
                transform: translateX(0);
            }
            #wrapper.toggled .overlay-sidebar {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: rgba(0, 0, 0, 0.5);
                z-index: 1040;
            }

            /* Penyesuaian search bar di HP */
            .topbar-search-form {
                max-width: 100%;
                margin: 0 5px;
            }
        }
    </style>
</head>
<body>

    <div id="wrapper">
        <div class="overlay-sidebar" id="sidebarOverlay"></div>

        <div id="sidebar-wrapper">
            <div class="sidebar-heading" id="brand-toggle-desktop">
                <div class="d-flex align-items-center">
                    <span class="bg-danger text-white border-2 border-white rounded px-2 py-1 fw-black small shadow-sm">
                        <i class="bi bi-shield-lock-fill"></i>
                        <span class="brand-text ms-1">BEM-FT PANEL</span>
                    </span>
                </div>
            </div>
            
            <div class="list-group list-group-flush flex-1 mt-3">
                <a href="{{ route('admin.dashboard') }}" class="list-group-item {{ Route::is('admin.dashboard') ? 'active-menu' : '' }}" title="Ringkasan">
                    <i class="bi bi-speedometer2"></i>
                    <span>Ringkasan</span>
                </a>
                
                <a href="{{ route('admin.magang.index') }}" class="list-group-item {{ Route::is('admin.magang.*') ? 'active-menu' : '' }}" title="Kelola Lowongan">
                    <i class="bi bi-folder-fill"></i>
                    <span>Kelola Lowongan</span>
                </a>
                
                <a href="{{ route('home') }}" target="_blank" class="list-group-item text-info" title="Lihat Web Utama">
                    <i class="bi bi-globe"></i>
                    <span>Lihat Web Utama</span>
                </a>
            </div>

            <div class="sidebar-footer-wrapper">
                <div class="sidebar-footer-profile d-flex align-items-center gap-2">
                    <i class="bi bi-person-circle fs-4 text-white"></i>
                    <div class="text-truncate profile-text">
                        <strong class="d-block text-white text-uppercase" style="font-size: 0.75rem;">{{ Auth::user()->name }}</strong>
                        <span class="text-white-50" style="font-size: 0.7rem;">Administrator</span>
                    </div>
                </div>
                
                <form action="{{ route('logout') }}" method="POST" class="m-0">
                    @csrf
                    <button type="submit" class="btn-sidebar-logout" title="Keluar Sistem">
                        <i class="bi bi-box-arrow-right fs-5 me-2"></i>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </div>

        <div id="page-content-wrapper">
            
            <nav class="navbar navbar-expand navbar-light admin-top-nav">
                <div class="container-fluid px-3 d-flex align-items-center justify-content-between gap-3">
                    
                    <button class="btn btn-dark d-lg-none border-2 border-dark rounded-3 px-2.5 py-1.5 shadow-none" id="menu-toggle-mobile" style="box-shadow: 2px 2px 0px var(--shadow-color) !important;">
                        <i class="bi bi-list fs-4"></i>
                    </button>

                    <div class="d-flex justify-content-center flex-1 align-items-center">
                        <form action="{{ route('admin.magang.index') }}" method="GET" class="topbar-search-form m-0">
                            <div class="input-group search-group-brutal px-2 py-1 align-items-center">
                                <span class="bg-transparent border-0 text-dark px-2 d-flex align-items-center">
                                    <i class="bi bi-search fw-bold fs-6"></i>
                                </span>
                                <input type="text" name="search" class="form-control border-0 bg-transparent shadow-none py-1 fw-semibold text-dark" placeholder="Cari data lowongan atau nama perusahaan..." value="{{ request('search') }}" autocomplete="off" style="font-size: 0.9rem;">
                            </div>
                        </form>
                    </div>
                    
                    <div class="d-flex align-items-center gap-2 ms-auto">

                        <button
                            id="theme-toggle"
                            class="btn btn-dark border-2 border-dark"
                            style="box-shadow:2px 2px 0px var(--shadow-color);"
                        >
                            <i class="bi bi-moon-fill" id="theme-icon"></i>
                        </button>

                        <span
                            class="d-none d-md-inline-block badge bg-white text-dark border-2 border-dark px-3 py-2 rounded-2 fw-black small text-uppercase"
                            style="box-shadow:2px 2px 0px var(--shadow-color);"
                        >
                            <i class="bi bi-shield-check text-danger me-1"></i>
                            Internal FT
                        </span>

                    </div>
                    
                </div>
            </nav>

            <div class="container-fluid p-4">
                @yield('admin_content')
            </div>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const wrapper = document.getElementById("wrapper");
            const brandDesktop = document.getElementById("brand-toggle-desktop");
            const burgerMobile = document.getElementById("menu-toggle-mobile");
            const sidebarOverlay = document.getElementById("sidebarOverlay");

            // Mode Laptop: Klik tulisan BEM-FT PANEL buat resize slim
            brandDesktop.addEventListener("click", function () {
                wrapper.classList.toggle("toggled");
            });

            // Mode HP: Klik tombol burger hitam untuk memunculkan sidebar
            if(burgerMobile) {
                burgerMobile.addEventListener("click", function () {
                    wrapper.classList.toggle("toggled");
                });
            }

            // Klik di luar sidebar (area gelap) untuk menutup kembali di HP
            if(sidebarOverlay) {
                sidebarOverlay.addEventListener("click", function () {
                    wrapper.classList.remove("toggled");
                });
            }
        });
    </script> <script>
    document.addEventListener("DOMContentLoaded", function () {
        const toggleBtn = document.getElementById("theme-toggle");
        const icon = document.getElementById("theme-icon");

        // Ambil tema dari memori browser
        const savedTheme = localStorage.getItem("theme");

        // Jika user pernah set tema sebelumnya, pakai tema itu. Jika belum pernah, default ke dark
        if (savedTheme) {
            document.documentElement.setAttribute("data-theme", savedTheme);
            icon.className = savedTheme === "dark" ? "bi bi-sun-fill" : "bi bi-moon-fill";
        } else {
            // Default awal aplikasi jika belum ada data di browser
            document.documentElement.setAttribute("data-theme", "dark");
            icon.className = "bi bi-sun-fill";
        }

        toggleBtn?.addEventListener("click", function () {
            const currentTheme = document.documentElement.getAttribute("data-theme");
            const newTheme = currentTheme === "dark" ? "light" : "dark";

            document.documentElement.setAttribute("data-theme", newTheme);
            localStorage.setItem("theme", newTheme);

            // Ganti icon matahari (sun) saat dark, dan bulan (moon) saat light
            icon.className = newTheme === "dark" ? "bi bi-sun-fill" : "bi bi-moon-fill";
        });
    });
    </script>

</body>
</html>