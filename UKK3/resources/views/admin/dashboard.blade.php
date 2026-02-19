<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - UKK 2026</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css">

    <style>
        body { background-color: #0b1120; font-family: 'Inter', sans-serif; }
        
        /* Navbar Styling */
        .navbar {
            background-color: #0f172a !important;
            border-bottom: 1px solid #1e293b;
            height: 80px;
            z-index: 1050;
        }

        .nav-link-custom {
            color: #94a3b8;
            font-size: 14px;
            font-weight: 600;
            padding: 8px 16px !important;
            border-radius: 8px;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
        }

        .nav-link-custom:hover {
            color: #3b82f6;
            background: rgba(59, 130, 246, 0.1);
        }

        .nav-link-custom.active {
            color: #fff !important;
            background: #2563eb;
        }

        /* Mobile Menu Background */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: #1e293b; 
                margin-top: 10px;
                padding: 15px;
                border-radius: 12px;
                border: 1px solid #334155;
                box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.5);
                transition: all 0.3s ease-in-out; 
            }
            .nav-link-custom {
                padding: 12px 16px !important;
                margin-bottom: 5px;
            }
        }

        /* Dashboard Components */
        .card-stat { background-color: #0f172a; border: 1px solid #1e293b; border-radius: 1.25rem; transition: all 0.3s ease; }
        .table-container { background-color: #0f172a; border: 1px solid #1e293b; border-radius: 1.25rem; padding: 25px; }
        
        .status-badge { font-size: 9px; font-weight: 900; padding: 4px 10px; border-radius: 6px; text-transform: uppercase; }
        .badge-selesai { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); }
        .badge-proses { background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.2); }
        .badge-pending { background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2); }

        .btn-action { width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; }

        /* Custom DataTables Style */
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
                <a class="navbar-brand fw-bold text-uppercase m-0 d-none d-sm-block" href="#" style="letter-spacing: -1px;">
                    Admin<span class="text-primary">Panel</span>
                </a>
            </div>

            <button class="navbar-toggler border-0 text-white p-0 order-3" type="button" data-bs-toggle="collapse" data-bs-target="#navContent">
                <i class="bi bi-list fs-1"></i>
            </button>

            <div class="collapse navbar-collapse justify-content-center order-4 order-lg-2" id="navContent">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom active" href="/admin/dashboard">
                            <i class="bi bi-grid-1x2-fill"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-custom" href="/admin/management-akun">
                            <i class="bi bi-people-fill"></i> Management Akun
                        </a>
                    </li>
                </ul>
            </div>

            <div class="d-flex align-items-center gap-2 gap-md-4 order-2 order-lg-3 ms-auto ms-lg-0 me-3 me-lg-0">
                <div class="d-none d-md-flex flex-column align-items-end text-end">
                    <span class="text-primary fw-bold text-uppercase" style="font-size: 10px; letter-spacing: 1px;">Administrator</span>
                    <span class="fw-bold text-light small">{{ $data['username'] }}</span>
                </div>
                <a href="/admin" class="btn btn-danger btn-sm px-3 px-md-4 rounded-3 fw-bold shadow-sm">Logout</a>
            </div>
        </div>
    </nav>

    <main class="container" style="margin-top: 120px; padding-bottom: 50px;">
        <header class="py-4">
            <h1 class="fw-bold text-white display-6 mb-1">Admin Control</h1>
            <p class="text-secondary small">Monitoring data aspirasi dan manajemen pengguna.</p>
        </header>

        <div class="row g-4 mb-5">
            <div class="col-12 col-md-4">
                <div class="card-stat p-4 h-100">
                    <p class="text-secondary fw-bold text-uppercase mb-2" style="font-size: 10px;">Total Siswa</p>
                    <div class="display-6 fw-bold text-white">{{ $total_siswa }}</div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-stat p-4 h-100 border-primary border-opacity-25">
                    <p class="text-secondary fw-bold text-uppercase mb-2" style="font-size: 10px;">Aspirasi Masuk</p>
                    <div class="display-6 fw-bold text-primary">{{ $total_aspirasi }}</div>
                </div>
            </div>
            <div class="col-12 col-md-4">
                <div class="card-stat p-4 h-100">
                    <p class="text-secondary fw-bold text-uppercase mb-2" style="font-size: 10px;">Server Status</p>
                    <div class="h3 fw-bold text-success text-uppercase m-0">Online</div>
                </div>
            </div>
        </div>

        <section class="table-container shadow-lg">
            <div class="table-responsive">
                <table id="mainTable" class="table table-hover align-middle mb-0">
                    <thead class="text-secondary">
                        <tr style="font-size: 10px; letter-spacing: 1px; text-transform: uppercase;">
                            <th>Siswa</th>
                            <th>Tanggal</th>
                            <th>Kategori</th>
                            <th>Lokasi</th>
                            <th>Aspirasi</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-light">
                        @foreach($aspirasi as $a)
                        <tr>
                            <td class="px-3">
                                <div class="fw-bold">{{ $a->nama }}</div>
                                <div class="small text-secondary">{{ $a->nis }}</div>
                            </td>
                            <td class="small text-white-50">{{ date('d M Y', strtotime($a->created_at)) }}</td>
                            <td><span class="badge bg-secondary opacity-50">{{ $a->ket_kategori }}</span></td>
                            <td class="small">{{ $a->lokasi }}</td>
                            <td class="small text-secondary">{{ Str::limit($a->ket, 40) }}</td>
                            <td class="text-center">
                                <span class="status-badge badge-{{ $a->status }}">{{ $a->status }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-outline-primary btn-action" data-bs-toggle="modal" data-bs-target="#editModal" onclick="openEditModal({{ json_encode($a) }})">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <a href="/admin/hapus/{{ $a->id_pelaporan }}" class="btn btn-outline-danger btn-action" onclick="return confirm('Hapus data?')">
                                        <i class="bi bi-trash3"></i>
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
                        <h5 class="modal-title fw-bold text-white">Update Data Aspirasi</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small text-secondary fw-bold text-uppercase">Kategori</label>
                            <select name="id_kategori" id="edit_kategori" class="form-select bg-dark text-white border-secondary">
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary fw-bold text-uppercase">Lokasi</label>
                            <input type="text" name="lokasi" id="edit_lokasi" class="form-control bg-dark text-white border-secondary">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary fw-bold text-uppercase">Status</label>
                            <select name="status" id="edit_status" class="form-select bg-dark text-white border-secondary">
                                <option value="pending">Pending</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary fw-bold text-uppercase">Pesan Aspirasi</label>
                            <textarea name="pesan" id="edit_pesan" class="form-control bg-dark text-white border-secondary" rows="4"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary px-4">Simpan Perubahan</button>
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
            // Inisialisasi DataTables
            $('#mainTable').DataTable({
                "language": {
                    "search": "Cari:",
                    "lengthMenu": "Tampilkan _MENU_",
                    "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
                    "paginate": { "next": "Next", "previous": "Prev" }
                },
                "columnDefs": [{ "orderable": false, "targets": 6 }],
                "order": [[1, "desc"]]
            });
        });

        function openEditModal(data) {
            document.getElementById('edit_id').value = data.id_pelaporan;
            document.getElementById('edit_kategori').value = data.id_kategori;
            document.getElementById('edit_lokasi').value = data.lokasi;
            document.getElementById('edit_pesan').value = data.ket;
            document.getElementById('edit_status').value = data.status || 'pending';
        }
    </script>
</body>
</html>