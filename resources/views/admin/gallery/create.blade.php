<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Upload Foto Baru</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --bg-body: #000000;
            --bg-card: #0a0a0a;
            --border-color: #1a1a1a;
            --text-main: #b0b0b0;
            --accent-pink: #ef9eef;
            --input-bg: #050505;
        }

        body {
            background-color: var(--bg-body);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
        }

        .navbar {
            background-color: #050505;
            border-bottom: 1px solid var(--border-color);
        }

        .card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
        }

        /* Form Styling - No White */
        .form-label {
            color: var(--accent-pink);
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .form-control, .form-select {
            background-color: var(--input-bg) !important;
            border: 1px solid var(--border-color) !important;
            color: #ffffff !important;
            padding: 10px 15px;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-pink) !important;
            box-shadow: 0 0 0 0.25rem rgba(239, 158, 239, 0.1) !important;
            outline: none;
        }

        /* Khusus input file */
        .form-control::file-selector-button {
            background-color: #1a1a1a;
            color: var(--accent-pink);
            border: none;
            border-right: 1px solid var(--border-color);
            margin-right: 15px;
            padding: 5px 15px;
        }

        /* Button Styling */
        .btn-save {
            background-color: var(--accent-pink);
            color: #000;
            font-weight: bold;
            border: none;
            padding: 12px;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-save:hover {
            background-color: #d88bd8;
            color: #000;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 158, 239, 0.3);
        }

        .btn-back {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-main);
            transition: 0.2s;
        }

        .btn-back:hover {
            border-color: var(--accent-pink);
            color: var(--accent-pink);
        }

        ::placeholder {
            color: #333 !important;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <nav class="navbar mb-5">
        <div class="container">
            <span class="navbar-brand fw-bold" style="color: var(--accent-pink);">ADMIN <span style="color: #666;">UPLOAD</span></span>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-sm btn-back px-3">
                <i class="bi bi-chevron-left"></i> Batal
            </a>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                
                <div class="mb-4 text-center">
                    <h3 class="text-white mb-1">Upload Foto Baru</h3>
                    <p class="small text-secondary">Tambahkan koleksi foto terbaru ke dalam gallery.</p>
                </div>

                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-4">
                                <label class="form-label">Judul Foto</label>
                                <input type="text" name="title" class="form-control" placeholder="Contoh: Liburan di Pantai" required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Kategori</label>
                                <select name="category" class="form-select" required>
                                    <option value="" selected disabled>Pilih Kategori...</option>
                                    <option value="Sendiri">Sendiri</option>
                                    <option value="Berdua">Berdua</option>
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Pilih Gambar</label>
                                <input type="file" name="image" class="form-control" required>
                                <div class="mt-2" style="font-size: 0.7rem; color: #555;">
                                    <i class="bi bi-info-circle me-1"></i> Format: JPG, PNG, JPEG (Maks 10MB)
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Deskripsi (Opsional)</label>
                                <textarea name="description" rows="4" class="form-control" placeholder="Tuliskan cerita singkat tentang foto ini..."></textarea>
                            </div>

                            <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-save">
                                    <i class="bi bi-cloud-arrow-up-fill me-2"></i> Simpan & Publish
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <p class="small text-secondary">&copy; {{ date('Y') }} Admin Gallery Management</p>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>