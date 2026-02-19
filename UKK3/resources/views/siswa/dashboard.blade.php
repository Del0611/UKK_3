<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - UKK 2026</title>
    
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
        .card-custom {
            background-color: #0f172a;
            border: 1px solid #1e293b;
            border-radius: 1.25rem;
            transition: all 0.3s ease;
        }
        .form-control {
            background-color: #0b1120;
            border: 1px solid #1e293b;
            border-radius: 0.75rem;
            color: white;
        }
        .form-control:focus {
            background-color: #0b1120;
            border-color: #0dcaf0;
            box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.1);
            color: white;
        }
        .status-badge {
            font-size: 9px;
            font-weight: 900;
            padding: 4px 10px;
            border-radius: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-pending { background: rgba(255, 193, 7, 0.1); color: #ffc107; border: 1px solid rgba(255, 193, 7, 0.2); }
        .badge-success { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); }

        .nav-logo-box {
            width: 40px; height: 40px;
            background-color: #0dcaf0;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-weight: bold; color: #0b1120;
            box-shadow: 0 10px 15px -3px rgba(13, 202, 240, 0.2);
        }

        .badge-pending { background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2); }
        .badge-proses { background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.2); }
        .badge-success { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); }
   
   </style>
</head>
<body class="antialiased">

    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container">
            <div class="d-flex align-items-center gap-3">
                <div class="nav-logo-box">S</div>
                <a class="navbar-brand fw-black text-uppercase m-0" href="#" style="letter-spacing: -1px;">
                    Student<span class="text-info">Hub</span>
                </a>
            </div>

            <div class="d-flex align-items-center gap-4">
                <div class="d-none d-md-flex flex-column align-items-end">
                    <span class="text-info fw-black text-uppercase" style="font-size: 10px; letter-spacing: 1px;">Siswa Aktif</span>
                    <span class="fw-bold text-light small">{{ $data['username'] }}</span>
                </div>
                
                <a href="/logout-siswa" class="btn btn-outline-danger btn-sm fw-black text-uppercase px-4 py-2 rounded-3" style="font-size: 11px; letter-spacing: 1px;">
                    Keluar
                </a>
            </div>
        </div>
    </nav>

    <main class="container" style="margin-top: 110px; padding-bottom: 50px;">
        
        <header class="py-4">
            <h1 class="fw-black text-white display-6 mb-1">Halo, {{ $data['username'] }}!</h1>
            <p class="text-secondary fst-italic small">Sampaikan aspirasimu untuk sekolah yang lebih baik.</p>
        </header>

 <div class="row g-4">
    <div class="col-12 col-lg-5">
        <div class="card-custom p-4 shadow-sm h-100">
            <h5 class="fw-black text-white text-uppercase mb-4" style="font-size: 14px; letter-spacing: 1px;">Kirim Aspirasi Baru</h5>
            
            <form action="/aspirasi-simpan" method="POST">
                @csrf
                @if(session('success'))
                    <div class="alert alert-success border-0 small py-2 mb-3">{{ session('success') }}</div>
                @endif



                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase">Kategori</label>
                    <select class="form-select form-control" name="kategori">
                        <option value="1">Fasilitas Sekolah</option>
                        <option value="2">Kebersihan</option>
                        <option value="3">Kegiatan Belajar</option>
                        <option value="4">Lainnya</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-secondary text-uppercase">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" placeholder="Contoh: Lab Komputer" required>
                </div>
                
                <div class="mb-4">
                    <label class="form-label small fw-bold text-secondary text-uppercase">Pesan Aspirasi</label>
                    <textarea class="form-control" name="pesan" rows="4" placeholder="Tuliskan keluhan atau saranmu..." required></textarea>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-info fw-black text-uppercase py-2" style="color: #0b1120;">Kirim Sekarang</button>
                </div>
            </form>
        </div>
    </div>

    <div class="col-12 col-lg-7">
        <div class="card-custom shadow-sm h-100 overflow-hidden">
            <div class="p-4 border-bottom border-secondary border-opacity-10 bg-info bg-opacity-10">
                <h6 class="m-0 fw-black text-uppercase small text-info" style="letter-spacing: 1px;">Riwayat Aspirasimu</h6>
            </div>
            
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-dark text-secondary">
                        <tr style="font-size: 10px; letter-spacing: 1px;">
                            <th class="px-4 py-3 border-0">TANGGAL</th>
                            <th class="px-4 py-3 border-0">LOKASI</th>
                            <th class="px-4 py-3 border-0">PESAN</th>
                            <th class="px-4 py-3 border-0">STATUS</th>
                        </tr>
                    </thead>
                    <tbody class="text-light border-top-0">
                        @forelse($riwayat as $r)
                        <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                            <td class="px-4 py-4 small text-nowrap">{{ date('d M Y', strtotime($r->created_at)) }}</td>
                            <td class="px-4 py-4 small fw-bold text-info text-uppercase">{{ $r->lokasi }}</td>
                            <td class="px-4 py-4 small text-secondary">{{ Str::limit($r->ket, 30) }}</td>
                            <td class="px-4 py-4">
                            @if($r->status == 'selesai')
                                <span class="status-badge badge-success">Selesai</span>
                            @elseif($r->status == 'proses')
                                <span class="status-badge badge-proses">Proses</span>
                            @else
                                <span class="status-badge badge-pending">Pending</span>
                            @endif
                        </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-secondary small fst-italic">Belum ada riwayat aspirasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


    </main>

</body>
</html>