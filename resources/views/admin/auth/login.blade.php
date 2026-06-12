<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Internal - BEM FT</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/js/app.js'])
</head>
<body style="background-color: #0B2F9F; font-family: 'Plus Jakarta Sans', sans-serif; min-height: 100vh;" class="d-flex align-items-center justify-content-center">

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-10 col-md-6 col-lg-4">
                
                <div class="card bg-white border-4 border-dark p-4 p-md-5" style="border-radius: 16px !important; box-shadow: 8px 8px 0px #000000 !important;">
                    
                    <div class="text-center mb-4">
                        <div class="d-inline-block bg-warning text-dark p-3 border-3 border-dark mb-3" style="border-radius: 12px !important; box-shadow: 3px 3px 0px #000;">
                            <i class="bi bi-shield-lock-fill display-5"></i>
                        </div>
                        <h4 class="fw-black text-uppercase text-dark mb-1"><strong>Internal Admin</strong></h4>
                        <span class="small text-muted fw-bold text-uppercase tracking-wider">BEM-FT Internship Portal</span>
                    </div>

                    <hr class="border-dark opacity-25 mb-4">

                    @if($errors->any())
                        <div class="alert alert-danger bg-danger text-white border-2 border-dark rounded-3 small fw-bold mb-4">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ $errors->first() }}
                        </div>
                    @endif

                    <form action="{{ route('login.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="username" class="form-label text-dark fw-black text-uppercase small">Username</label>
                            <div class="input-group border-3 border-dark rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-0 text-dark"><i class="bi bi-person-fill"></i></span>
                                <input type="text" name="username" id="username" class="form-control border-0 bg-white py-2.5 fw-semibold shadow-none" value="{{ old('username') }}" placeholder="Masukkan username admin" required autocomplete="off">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label text-dark fw-black text-uppercase small">Password</label>
                            <div class="input-group border-3 border-dark rounded-3 overflow-hidden">
                                <span class="input-group-text bg-light border-0 text-dark"><i class="bi bi-key-fill"></i></span>
                                <input type="password" name="password" id="password" class="form-control border-0 bg-white py-2.5 fw-semibold shadow-none" placeholder="••••••••" required>
                                <button class="btn bg-light border-0 text-dark px-3 shadow-none" type="button" id="togglePassword">
                                    <i class="bi bi-eye-fill" id="eyeIcon"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark w-100 py-3 text-uppercase fw-black tracking-wide border-3 border-dark rounded-3 position-relative shadow-none label-btn" style="box-shadow: 4px 4px 0px #000 !important; font-weight: 800; transition: none;">
                            Masuk Ke Dashboard <i class="bi bi-box-arrow-in-right ms-1"></i>
                        </button>
                    </form>

                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('home') }}" class="text-white small fw-bold text-decoration-none opacity-75 text-uppercase tracking-wider">
                        <i class="bi bi-arrow-left-short"></i> Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>

    <style>
        .label-btn:hover {
            background-color: var(--bs-warning) !important;
            color: #000 !important;
            transform: translate(-1px, -1px);
            box-shadow: 5px 5px 0px #000 !important;
        }
        .label-btn:active {
            transform: translate(2px, 2px);
            box-shadow: 2px 2px 0px #000 !important;
        }
        /* Tambahan style dikit biar pas tombol matanya disorot gak ngerusak tema */
        #togglePassword:hover {
            background-color: #e9ecef !important;
            color: #000 !important;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const togglePassword = document.getElementById("togglePassword");
            const passwordInput = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");

            togglePassword.addEventListener("click", function () {
                // Cek tipe input saat ini
                const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
                passwordInput.setAttribute("type", type);
                
                // Ubah icon mata coret (slash) atau mata biasa
                if (type === "text") {
                    eyeIcon.classList.remove("bi-eye-fill");
                    eyeIcon.classList.add("bi-eye-slash-fill");
                } else {
                    eyeIcon.classList.remove("bi-eye-slash-fill");
                    eyeIcon.classList.add("bi-eye-fill");
                }
            });
        });
    </script>
</body>
</html>