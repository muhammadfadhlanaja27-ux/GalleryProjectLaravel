<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Gallery Management</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --bg-body: #000000;
            --bg-card: #0a0a0a;
            --border-color: #1a1a1a;
            --text-main: #b0b0b0;
            --accent-pink: #ef9eef;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #050505;
            border-bottom: 1px solid var(--border-color);
            padding: 15px 0;
        }

        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
        }

        .table {
            color: var(--text-main);
            --bs-table-bg: transparent;
            --bs-table-border-color: var(--border-color);
        }

        .table thead th {
            color: var(--accent-pink);
            border-bottom: 2px solid var(--border-color);
        }

        .btn-pink {
            background-color: var(--accent-pink);
            color: #000;
            font-weight: bold;
            border: none;
        }

        .btn-pink:hover {
            background-color: #d88bd8;
        }

        .btn-outline-custom {
            border: 1px solid var(--border-color);
            color: var(--text-main);
        }

        .btn-outline-custom:hover {
            border-color: var(--accent-pink);
            color: var(--accent-pink);
        }

        .alert-success-custom {
            background-color: #051b11;
            border: 1px solid #198754;
            color: #75b798;
        }
    </style>
</head>
<body>

    <nav class="navbar mb-5">
        <div class="container d-flex justify-content-between align-items-center">
            <span class="navbar-brand fw-bold m-0" style="color: var(--accent-pink);">ADMIN <span style="color: #666;">PANEL</span></span>
            <a href="{{ route('home') }}" class="btn btn-sm btn-outline-custom">
                <i class="bi bi-box-arrow-left"></i> Kembali ke Web
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="d-flex justify-content-between align-items-end mb-4">
            <div>
                <h4 class="text-white mb-1">Management Galeri</h4>
                <p class="small text-secondary mb-0">Kelola konten foto tanpa gangguan visual.</p>
            </div>
            <a href="{{ route('admin.gallery.create') }}" class="btn btn-pink px-4">
                + TAMBAH FOTO
            </a>
        </div>

        @if(session('success'))
        <div class="alert alert-success-custom alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <div class="card">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4 py-3">#</th>
                            <th>IMAGE</th>
                            <th>INFO</th>
                            <th>CATEGORY</th>
                            <th class="text-center">ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($galleries as $gallery)
                        <tr>
                            <td class="ps-4 text-secondary small">{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $gallery->image) }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px; border: 1px solid #333;">
                            </td>
                            <td>
                                <div class="text-white fw-bold">{{ $gallery->title }}</div>
                                <div class="small text-secondary">{{ Str::limit($gallery->description, 40) }}</div>
                            </td>
                            <td>
                                <span class="badge border border-info text-info fw-normal">{{ $gallery->category }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('admin.gallery.edit', $gallery->id) }}" class="btn btn-outline-custom btn-sm px-3">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('admin.gallery.destroy', $gallery->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-outline-custom btn-sm px-3" onclick="return confirm('Hapus foto ini?')">
                                            <i class="bi bi-trash3 text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-secondary small">
                                <i class="bi bi-database-exclamation d-block mb-2 fs-2"></i>
                                Data gallery masih kosong.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>