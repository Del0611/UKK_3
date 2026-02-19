<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Akun - Admin Panel</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">

    <style>
        body { background-color: #0b1120; font-family: 'Inter', sans-serif; }
        
        /* Navbar (Sama dengan Dashboard) */
        .navbar { background-color: #0f172a !important; border-bottom: 1px solid #1e293b; height: 80px; z-index: 1050; }
        .nav-link-custom { color: #94a3b8; font-size: 14px; font-weight: 600; padding: 8px 16px !important; border-radius: 8px; transition: 0.2s; display: flex; align-items: center; gap: 8px; text-decoration: none; }
        .nav-link-custom:hover { color: #3b82f6; background: rgba(59, 130, 246, 0.1); }
        .nav-link-custom.active { color: #fff !important; background: #2563eb; }

        @media (max-width: 991.98px) {
            .navbar-collapse { background-color: #1e293b; margin-top: 10px; padding: 15px; border-radius: 12px; border: 1px solid #334155; }
        }

        /* Table & Cards */
        .table-container { background-color: #0f172a; border: 1px solid #1e293b; border-radius: 1.25rem; padding: 25px; }
        .btn-action { width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; }
        
        .dataTables_wrapper .dataTables_filter input {
            background-color: #1e293b !important;
            border: 1px solid #334155 !important;
            color: white !important;
            border-radius: 8px;
            padding: 6px 12px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-primary text-white p-2 rounded-3 fw-bold" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">A</div>
                <a class="navbar-brand fw-bold text-uppercase m-0 d-none d-sm-block" href="#">Admin<span class="text-primary">Panel</span></a>
            </div>

            <button class="navbar-toggler border-0 text-white p-0 order-3" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <i class="bi bi-list fs-1"></i>
            </button>

            <div class="collapse navbar-collapse justify-content-center order-4 order-lg-2" id="navContent">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="/admin/dashboard">
                            <i class="bi bi-grid-1x2-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom active" href="/admin/management-akun">
                            <i class="bi bi-people-fill"></i> Management Akun
                        </a>
                    </li>
                </ul>
            </div>

            <div class="d-flex align-items-center gap-2 gap-md-4 order-2 order-lg-3 ms-auto ms-lg-0 me-3 me-lg-0">
                <div class="d-none d-md-flex flex-column align-items-end text-end">
                    <span class="text-primary fw-bold text-uppercase" style="font-size: 10px;">Administrator</span>
                    <span class="fw-bold text-light small">{{ $data['username'] }}</span>
                </div>
                <a href="/admin" class="btn btn-danger btn-sm px-3 rounded-3 fw-bold">Logout</a>
            </div>
        </div>
    </nav>

    <main class="container" style="margin-top: 120px; padding-bottom: 50px;">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h1 class="fw-bold text-white display-6 mb-1">Management Siswa</h1>
                <p class="text-secondary small m-0">Tambah, ubah, atau hapus data akun siswa.</p>
            </div>
            <button class="btn btn-primary px-4 py-2 rounded-3 fw-bold" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="bi bi-plus-lg me-2"></i> Tambah Siswa
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success bg-success bg-opacity-10 border-success text-success">{{ session('success') }}</div>
        @endif

        <section class="table-container shadow-lg">
            <div class="table-responsive">
                <table id="siswaTable" class="table table-hover align-middle mb-0">
                    <thead class="text-secondary">
                        <tr style="font-size: 11px; letter-spacing: 1px; text-transform: uppercase;">
                            <th width="20%">NIS</th>
                            <th width="40%">Nama Lengkap</th>
                            <th width="25%">Kelas</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-light">
                        @foreach($siswa as $s)
                        <tr>
                            <td class="fw-bold text-primary">{{ $s->nis }}</td>
                            <td>{{ $s->nama }}</td>
                            <td>
                                <span class="badge bg-dark border border-secondary px-3 py-2">{{ $s->kelas }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-outline-warning btn-action" data-bs-toggle="modal" data-bs-target="#editSiswaModal" onclick="editSiswa({{ json_encode($s) }})">
                                        <i class="bi bi-pencil-fill"></i>
                                    </button>
                                    <a href="/admin/siswa-hapus/{{ $s->nis }}" class="btn btn-outline-danger btn-action" onclick="return confirm('Hapus siswa {{ $s->nama }}?')">
                                        <i class="bi bi-trash3-fill"></i>
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

    <div class="modal fade" id="tambahModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border-secondary">
                <form action="/admin/siswa-simpan" method="POST">
                    @csrf
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title fw-bold text-white">Tambah Siswa Baru</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small text-secondary fw-bold text-uppercase">NIS</label>
                            <input type="number" name="nis" class="form-control bg-dark text-white border-secondary" required placeholder="Masukkan NIS">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary fw-bold text-uppercase">Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control bg-dark text-white border-secondary" required placeholder="Nama Siswa">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary fw-bold text-uppercase">Kelas</label>
                            <input type="text" name="kelas" class="form-control bg-dark text-white border-secondary" required placeholder="Contoh: XII PPLG 1">
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editSiswaModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border-secondary">
                <form action="/admin/siswa-update" method="POST">
                    @csrf
                    <input type="hidden" name="nis_lama" id="siswa_nis_lama">
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title fw-bold text-white">Edit Data Siswa</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small text-secondary fw-bold text-uppercase">NIS</label>
                            <input type="number" name="nis" id="siswa_nis" class="form-control bg-dark text-white border-secondary" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary fw-bold text-uppercase">Nama Lengkap</label>
                            <input type="text" name="nama" id="siswa_nama" class="form-control bg-dark text-white border-secondary" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary fw-bold text-uppercase">Kelas</label>
                            <input type="text" name="kelas" id="siswa_kelas" class="form-control bg-dark text-white border-secondary" required>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-warning px-4">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.bootstrap5.js"></script>

    <script>
        $(document).ready(function() {
            $('#siswaTable').DataTable({
                "language": { "search": "Cari Siswa:", "lengthMenu": "_MENU_" },
                "columnDefs": [{ "orderable": false, "targets": 3 }]
            });
        });

        function editSiswa(data) {
            document.getElementById('siswa_nis_lama').value = data.nis;
            document.getElementById('siswa_nis').value = data.nis;
            document.getElementById('siswa_nama').value = data.nama;
            document.getElementById('siswa_kelas').value = data.kelas;
        }
    </script>
</body>
</html>