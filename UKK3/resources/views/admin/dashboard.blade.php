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
        .navbar { background-color: #0f172a !important; border-bottom: 1px solid #1e293b; height: 80px; z-index: 1050; }
        .nav-link-custom { color: #94a3b8; font-size: 14px; font-weight: 600; padding: 8px 16px !important; border-radius: 8px; transition: 0.2s; text-decoration: none; display: flex; align-items: center; gap: 8px; }
        .nav-link-custom:hover { color: #3b82f6; background: rgba(59, 130, 246, 0.1); }
        .nav-link-custom.active { color: #fff !important; background: #2563eb; }
        
        .card-stat { background-color: #0f172a; border: 1px solid #1e293b; border-radius: 1.25rem; }
        .table-container { background-color: #0f172a; border: 1px solid #1e293b; border-radius: 1.25rem; padding: 25px; }
        
        .status-badge { font-size: 9px; font-weight: 900; padding: 4px 10px; border-radius: 6px; text-transform: uppercase; }
        .badge-selesai { background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.2); }
        .badge-proses { background: rgba(59, 130, 246, 0.1); color: #3b82f6; border: 1px solid rgba(59, 130, 246, 0.2); }
        .badge-pending { background: rgba(245, 158, 11, 0.1); color: #f59e0b; border: 1px solid rgba(245, 158, 11, 0.2); }

        .clickable-aspirasi { cursor: pointer; padding: 5px; border-radius: 5px; transition: 0.2s; }
        .clickable-aspirasi:hover { background: rgba(255,255,255,0.05); color: #3b82f6 !important; }
        .btn-action { width: 35px; height: 35px; display: inline-flex; align-items: center; justify-content: center; border-radius: 10px; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
        <div class="container">
            <div class="d-flex align-items-center gap-3">
                <div class="bg-primary text-white p-2 rounded-3 fw-bold" style="width: 35px; height: 35px; display: flex; align-items: center; justify-content: center;">A</div>
                <a class="navbar-brand fw-bold text-uppercase m-0 d-none d-sm-block" href="#">Admin<span class="text-primary">Panel</span></a>
            </div>
            <div class="collapse navbar-collapse justify-content-center" id="navContent">
                <ul class="navbar-nav gap-2">
                    <li class="nav-item"><a class="nav-link nav-link-custom active" href="/admin/dashboard"><i class="bi bi-grid-1x2-fill"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link nav-link-custom" href="/admin/management-akun"><i class="bi bi-people-fill"></i> Management Akun</a></li>
                </ul>
            </div>
            <div class="ms-auto d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <span class="text-primary fw-bold text-uppercase d-block" style="font-size: 10px;">Administrator</span>
                    <span class="fw-bold text-light small">{{ $data['username'] }}</span>
                </div>
                <a href="/admin" class="btn btn-danger btn-sm px-4 fw-bold">Logout</a>
            </div>
        </div>
    </nav>

    <main class="container" style="margin-top: 120px; padding-bottom: 50px;">
        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="card-stat p-4">
                    <p class="text-secondary fw-bold text-uppercase mb-1" style="font-size: 10px;">Total Siswa</p>
                    <div class="h2 fw-bold text-white">{{ $total_siswa }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-stat p-4 border-primary border-opacity-25">
                    <p class="text-secondary fw-bold text-uppercase mb-1" style="font-size: 10px;">Aspirasi Masuk</p>
                    <div class="h2 fw-bold text-primary">{{ $total_aspirasi }}</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card-stat p-4">
                    <p class="text-secondary fw-bold text-uppercase mb-1" style="font-size: 10px;">Server Status</p>
                    <div class="h2 fw-bold text-success text-uppercase">Online</div>
                </div>
            </div>
        </div>

        <section class="table-container shadow-lg">
            <div class="table-responsive">
                <table id="mainTable" class="table table-hover align-middle">
                    <thead>
                        <tr class="text-secondary" style="font-size: 10px; text-transform: uppercase;">
                            <th>Siswa</th>
                            <th>Tanggal & Update</th>
                            <th>Kategori</th>
                            <th>Aspirasi</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-light">
                        @foreach($aspirasi as $a)
                        <tr>
                            <td>
                                <div class="fw-bold">{{ $a->nama }}</div>
                                <div class="small text-secondary">{{ $a->nis }}</div>
                            </td>
                            <td class="small">
                                <div class="text-secondary"><i class="bi bi-calendar-event me-1"></i>{{ date('d M Y', strtotime($a->created_at)) }}</div>
                                @if($a->updated_at && $a->updated_at != $a->created_at)
                                    <div class="text-primary mt-1" style="font-size: 10px;"><i class="bi bi-clock-history me-1"></i>Up: {{ date('d M H:i', strtotime($a->updated_at)) }}</div>
                                @endif
                            </td>
                            <td><span class="badge bg-secondary opacity-50">{{ $a->ket_kategori }}</span></td>
                            <td>
                                <div class="clickable-aspirasi small text-secondary" onclick="btnShowDetail(this)" data-pesan="{{ $a->ket }}" data-nama="{{ $a->nama }}" data-lokasi="{{ $a->lokasi }}">
                                    <strong class="text-info d-block">{{ $a->lokasi }}</strong>
                                    {{ Str::limit($a->ket, 35) }}
                                </div>
                            </td>
                            <td class="text-center"><span class="status-badge badge-{{ $a->status }}">{{ $a->status }}</span></td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-outline-primary btn-action" onclick="openEditModal({{ json_encode($a) }})"><i class="bi bi-pencil-square"></i></button>
                                    <a href="/admin/hapus/{{ $a->id_pelaporan }}" class="btn btn-outline-danger btn-action" onclick="return confirm('Hapus?')"><i class="bi bi-trash3"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border-secondary">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title fw-bold text-white">Detail Aspirasi</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <small class="text-primary fw-bold text-uppercase">Pengirim & Lokasi:</small>
                    <p class="text-white mb-3"><span id="detNama"></span> — <span id="detLokasi" class="text-info"></span></p>
                    <small class="text-primary fw-bold text-uppercase">Isi Pesan:</small>
                    <div id="detPesan" class="p-3 bg-black rounded border border-secondary text-light mt-1" style="white-space: pre-wrap;"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border-secondary text-white">
                <form action="/admin/aspirasi-update" method="POST">
                    @csrf
                    <input type="hidden" name="id_pelaporan" id="edit_id">
                    <div class="modal-header border-secondary">
                        <h5 class="modal-title fw-bold">Update Aspirasi</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small text-secondary fw-bold">STATUS PROSES</label>
                            <select name="status" id="edit_status" class="form-select bg-dark text-white border-secondary">
                                <option value="pending">Pending</option>
                                <option value="proses">Proses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary fw-bold">KATEGORI</label>
                            <select name="id_kategori" id="edit_kategori" class="form-select bg-dark text-white border-secondary">
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id_kategori }}">{{ $k->ket_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label small text-secondary fw-bold">LOKASI</label>
                            <input type="text" name="lokasi" id="edit_lokasi" class="form-control bg-dark text-white border-secondary">
                        </div>
                        <div class="mb-0">
                            <label class="form-label small text-secondary fw-bold">PESAN</label>
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
            $('#mainTable').DataTable({
                "language": { "search": "Cari:", "lengthMenu": "Tampilkan _MENU_" },
                "order": [[1, "desc"]]
            });
        });

        function btnShowDetail(el) {
            $('#detNama').text($(el).data('nama'));
            $('#detLokasi').text($(el).data('lokasi'));
            $('#detPesan').text($(el).data('pesan'));
            new bootstrap.Modal(document.getElementById('detailModal')).show();
        }

        function openEditModal(data) {
            $('#edit_id').val(data.id_pelaporan);
            $('#edit_kategori').val(data.id_kategori);
            $('#edit_lokasi').val(data.lokasi);
            $('#edit_status').val(data.status);
            $('#edit_pesan').val(data.ket);
            new bootstrap.Modal(document.getElementById('editModal')).show();
        }
    </script>
</body>
</html>