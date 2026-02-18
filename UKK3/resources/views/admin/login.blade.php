<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - UKK 2026</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #0f172a; 
        }
        .login-card {
            max-width: 400px;
            width: 100%;
            border-radius: 1rem;
            border: 1px solid #1e293b;
            background-color: #1e293b;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }
        .form-control {
            border-radius: 0.75rem;
            padding: 0.75rem 1rem;
            background-color: #0f172a;
            border-color: #334155;
        }
        .form-control:focus {
            background-color: #0f172a;
            border-color: #3b82f6;
            box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
        }
        .btn-primary {
            border-radius: 0.75rem;
            padding: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            background-color: #2563eb;
            border: none;
        }
        /* Tombol Siswa disesuaikan agar konsisten dengan Info/Success */
        .btn-outline-info {
            border-radius: 0.75rem;
            padding: 0.75rem;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            color: #64748b;
            margin: 1.5rem 0;
        }
        .divider::before, .divider::after {
            content: '';
            flex: 1;
            border-bottom: 1px solid #334155;
        }
        .divider:not(:empty)::before { margin-right: .75em; }
        .divider:not(:empty)::after { margin-left: .75em; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-screen p-4">

    <nav class="navbar fixed-top bg-dark border-bottom border-secondary px-4">
        <div class="container-fluid d-flex justify-content-between">
            <a class="navbar-brand fw-bold text-uppercase text-white" href="#">
                Admin<span class="text-primary">Panel</span>
            </a>
            <span class="badge font-monospace text-secondary text-uppercase" style="font-size: 10px;">
                System v1.0
            </span>
        </div>
    </nav>

    <div class="login-card p-4 p-md-5 mt-5">
        <div class="text-center mb-4">
            <h2 class="fw-black text-white text-uppercase tracking-tight h4">Sign In</h2>
            <p class="small text-secondary">Otentikasi Administrator</p>
        </div>

        @if(session('error'))
            <div class="alert alert-danger border-0 small py-2" role="alert" style="background-color: rgba(220, 38, 38, 0.1); color: #f87171;">
                {{ session('error') }}
            </div>
        @endif

        <form action="/login-proses" method="POST">
            @csrf
            
            <div class="mb-3">
                <label class="form-label small fw-bold text-secondary text-uppercase tracking-wider">Username</label>
                <input type="text" name="username" class="form-control text-white" placeholder="Masukkan Username" required autocomplete="off">
            </div>

            <div class="mb-4">
                <label class="form-label small fw-bold text-secondary text-uppercase tracking-wider">Password</label>
                <input type="password" name="password" class="form-control text-white" placeholder="••••••••" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">
                    Masuk ke Sistem
                </button>

                <div class="divider small text-uppercase fw-bold" style="font-size: 11px;">Atau</div>

                <a href="/siswa" class="btn btn-outline-info">
                    Masuk sebagai Siswa
                </a>
            </div>
        </form>

        <p class="text-center text-secondary mt-5 mb-0 text-uppercase" style="font-size: 10px; letter-spacing: 2px;">
            &copy; 2026 UKK Project
        </p>
    </div>

</body>
</html>