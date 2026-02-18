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
        <h1 class="fw-black text-white display-6 mb-1">Admin Control</h1>
        <p class="text-secondary fst-italic small">Manajemen data aspirasi siswa UKK 2026.</p>
    </header>

    <div class="row g-4 mb-5">
        <div class="col-12 col-md-4">
            <div class="card-stat p-4 h-100">
                <p class="text-secondary fw-black text-uppercase mb-2" style="font-size: 10px; letter-spacing: 1.5px;">Total Siswa</p>
                <div class="display-6 fw-black text-white">{{ $total_siswa }}</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card-stat p-4 h-100 border-primary border-opacity-25">
                <p class="text-secondary fw-black text-uppercase mb-2" style="font-size: 10px; letter-spacing: 1.5px;">Total Aspirasi</p>
                <div class="display-6 fw-black text-primary">{{ $total_aspirasi }}</div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card-stat p-4 h-100">
                <p class="text-secondary fw-black text-uppercase mb-2" style="font-size: 10px; letter-spacing: 1.5px;">Status Server</p>
                <div class="h3 fw-black text-success text-uppercase m-0">Online</div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success bg-success bg-opacity-10 border-success text-success mb-4">{{ session('success') }}</div>
    @endif

    <section class="table-container shadow-lg">
        <div class="p-4 border-bottom border-secondary border-opacity-25 bg-secondary bg-opacity-10">
            <h6 class="m-0 fw-black text-uppercase small text-white" style="letter-spacing: 1px;">Semua Data Aspirasi</h6>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-dark text-secondary">
                    <tr style="font-size: 10px; letter-spacing: 1px;">
                        <th class="px-4 py-3 border-0">NAMA SISWA</th>
                        <th class="px-4 py-3 border-0">LOKASI</th>
                        <th class="px-4 py-3 border-0">ASPIRASI</th>
                        <th class="px-4 py-3 border-0 text-center">AKSI</th>
                    </tr>
                </thead>
                <tbody class="text-light border-top-0">
                    @foreach($aspirasi as $a)
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.05);">
                        <td class="px-4 py-4">
                            <div class="fw-bold">{{ $a->nama_siswa }}</div>
                            <div class="small text-secondary font-monospace">{{ $a->nis }}</div>
                        </td>
                        <td class="px-4 py-4 small">{{ $a->lokasi }}</td>
                        <td class="px-4 py-4 small text-secondary">{{ Str::limit($a->ket, 50) }}</td>
                        <td class="px-4 py-4 text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-primary btn-sm px-3" 
                                    onclick="editAspirasi('{{ $a->id_pelaporan }}', '{{ $a->lokasi }}', '{{ $a->ket }}', '{{ $a->kategori }}')"
                                    data-bs-toggle="modal" data-bs-target="#editModal">
                                    Edit
                                </button>
                                <a href="/admin/aspirasi-hapus/{{ $a->id_pelaporan }}" 
                                   class="btn btn-danger btn-sm px-3" 
                                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                                    Hapus
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</main>

<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark border-secondary">
            <form action="/admin/aspirasi-update" method="POST">
                @csrf
                <input type="hidden" name="id_pelaporan" id="edit_id">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title text-white">Edit Aspirasi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small text-secondary">LOKASI</label>
                        <input type="text" name="lokasi" id="edit_lokasi" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary">KATEGORI</label>
                        <select name="kategori" id="edit_kategori" class="form-select form-control">
                            <option value="1">Fasilitas</option>
                            <option value="2">Kebersihan</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label small text-secondary">PESAN</label>
                        <textarea name="pesan" id="edit_pesan" class="form-control" rows="4"></textarea>
                    </div>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function editAspirasi(id, lokasi, ket, kategori) {
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_lokasi').value = lokasi;
        document.getElementById('edit_pesan').value = ket;
        document.getElementById('edit_kategori').value = kategori;
    }
</script>

</body>
</html>