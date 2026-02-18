<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - UKK 2026</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #0b1120;
            font-family: 'Inter', sans-serif;
        }
        .navbar {
            background-color: #0f172a !important;
            border-bottom: 1px solid #1e293b;
            height: 80px;
        }
        .card-stat {
            background-color: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 1.25rem;
            transition: all 0.3s ease;
        }
        .card-stat:hover {
            transform: translateY(-5px);
            border-color: #3b82f6;
        }
        .table-container {
            background-color: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 1.25rem;
            overflow: hidden;
        }
        .status-badge {
            font-size: 9px;
            font-weight: 900;
            padding: 4px 10px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            background-color: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }
        .nav-logo-box {
            width: 40px;
            height: 40px;
            background-color: #2563eb;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: white;
            box-shadow: 0 10px 15px -3px rgba(37, 99, 235, 0.2);
        }
    </style>
</head>
<body class="antialiased">

    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container">
            <div class="d-flex align-items-center gap-3">
                <div class="nav-logo-box">A</div>
                <a class="navbar-brand fw-black text-uppercase m-0" href="#" style="letter-spacing: -1px;">
                    Admin<span class="text-primary">Panel</span>
                </a>
            </div>

            <div class="d-flex align-items-center gap-4">
                <div class="d-none d-md-flex flex-column align-items-end">
                    <span class="text-primary fw-black text-uppercase" style="font-size: 10px; letter-spacing: 1px;">Administrator</span>
                    <span class="fw-bold text-light small">{{ $data['username'] }}</span>
                </div>
                
                <a href="/logout" class="btn btn-danger btn-sm fw-black text-uppercase px-4 py-2 rounded-3 shadow-sm" style="font-size: 11px; letter-spacing: 1px;">
                    Logout
                </a>
            </div>
        </div>
    </nav>

    <main class="container" style="margin-top: 110px; padding-bottom: 50px;">
        
        <header class="py-4">
            <h1 class="fw-black text-white display-6 mb-1">Dashboard</h1>
            <p class="text-secondary fst-italic small">Selamat datang kembali di sistem kendali UKK 2026.</p>
        </header>

        <div class="row g-4 mb-5">
            <div class="col-12 col-md-4">
                <div class="card-stat p-4 h-100">
                    <p class="text-secondary fw-black text-uppercase mb-2" style="font-size: 10px; letter-spacing: 1.5px;">Total Siswa</p>
                    <div class="display-6 fw-black text-white">1,240</div>
                </div>
            </div>
            
            <div class="col-12 col-md-4">
                <div class="card-stat p-4 h-100 border-primary border-opacity-25">
                    <p class="text-secondary fw-black text-uppercase mb-2" style="font-size: 10px; letter-spacing: 1.5px;">Data Riwayat</p>
                    <div class="display-6 fw-black text-primary">458</div>
                </div>
            </div>

            <div class="col-12 col-md-4">
                <div class="card-stat p-4 h-100">
                    <p class="text-secondary fw-black text-uppercase mb-2" style="font-size: 10px; letter-spacing: 1.5px;">Status Sistem</p>
                    <div class="h3 fw-black text-success text-uppercase m-0">Optimized</div>
                </div>
            </div>
        </div>

        <section class="table-container shadow-lg">
            <div class="p-4 border-bottom border-secondary border-opacity-25 bg-secondary bg-opacity-10">
                <h6 class="m-0 fw-black text-uppercase small text-white" style="letter-spacing: 1px;">Daftar Aktivitas Siswa</h6>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-dark text-secondary">
                        <tr style="font-size: 10px; letter-spacing: 1px;">
                            <th class="px-4 py-3 border-0">NAMA LENGKAP</th>
                            <th class="px-4 py-3 border-0">NISN</th>
                            <th class="px-4 py-3 border-0">KELAS</th>
                            <th class="px-4 py-3 border-0 text-center">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="text-light border-top-0">
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <td class="px-4 py-4 fw-bold">Ahmad Fauzi</td>
                            <td class="px-4 py-4 font-monospace text-secondary small">0082736412</td>
                            <td class="px-4 py-4 text-secondary small fw-medium">XII RPL 1</td>
                            <td class="px-4 py-4 text-center">
                                <span class="status-badge">Aktif</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="px-4 py-4 fw-bold">Siti Aminah</td>
                            <td class="px-4 py-4 font-monospace text-secondary small">0082736415</td>
                            <td class="px-4 py-4 text-secondary small fw-medium">XII RPL 2</td>
                            <td class="px-4 py-4 text-center">
                                <span class="status-badge">Aktif</span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>

    </main>

</body>
</html>