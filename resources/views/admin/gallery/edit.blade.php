<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Edit {{ $gallery->title }}</title>
    
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

        /* Styling Form agar tidak ada warna putih */
        .form-label {
            color: var(--accent-pink);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-control, .form-select {
            background-color: var(--input-bg) !important;
            border: 1px solid var(--border-color) !important;
            color: #ffffff !important;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-pink) !important;
            box-shadow: 0 0 0 0.25rem rgba(239, 158, 239, 0.1) !important;
            outline: none;
        }

        .img-current {
            border-radius: 8px;
            border: 1px solid var(--border-color);
            max-height: 200px;
            margin-bottom: 15px;
        }

        /* Button Styling */
        .btn-update {
            background-color: var(--accent-pink);
            color: #000;
            font-weight: bold;
            border: none;
            padding: 12px;
            transition: 0.3s;
        }

        .btn-update:hover {
            background-color: #d88bd8;
            color: #000;
            transform: translateY(-2px);
        }

        .btn-back {
            background-color: transparent;
            border: 1px solid var(--border-color);
            color: var(--text-main);
        }

        .btn-back:hover {
            border-color: var(--accent-pink);
            color: var(--accent-pink);
        }

        /* Menghilangkan silau pada placeholder */
        ::placeholder { color: #333 !important; }
    </style>
</head>
<body>

    <nav class="navbar mb-5">
        <div class="container">
            <span class="navbar-brand fw-bold" style="color: var(--accent-pink);">ADMIN <span style="color: #666;">EDIT</span></span>
            <a href="{{ route('admin.gallery.index') }}" class="btn btn-sm btn-back">
                <i class="bi bi-arrow-left"></i> Kembali ke List
            </a>
        </div>
    </nav>

    <div class="container pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                
                <div class="mb-4">
                    <h4 class="text-white mb-1">Edit Detail Foto</h4>
                    <p class="small text-secondary">Perbarui informasi foto pada gallery kamu.</p>
                </div>

                <div class="card shadow-lg">
                    <div class="card-body p-4">
                        <form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label class="form-label">Judul Foto</label>
                                <input type="text" name="title" value="{{ $gallery->title }}" class="form-control" placeholder="Masukkan judul..." required>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Kategori</label>
                                <select name="category" class="form-select" required>
                                    @foreach(['Sendiri', 'Berdua'] as $cat)
                                        <option value="{{ $cat }}" {{ $gallery->category == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label class="form-label d-block text-start">Foto Saat Ini</label>
                                <div class="text-center bg-black py-3 rounded border border-dark mb-2">
                                    <img src="{{ asset('storage/' . $gallery->image) }}" class="img-current" alt="Preview">
                                </div>
                                <input type="file" name="image" class="form-control">
                                <div class="mt-2" style="font-size: 0.75rem; color: #555;">
                                    *Biarkan kosong jika tidak ingin mengganti gambar.
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label">Deskripsi</label>
                                <textarea name="description" rows="4" class="form-control" placeholder="Tuliskan deskripsi foto...">{{ $gallery->description }}</textarea>
                            </div>

                            <div class="d-grid mt-5">
                                <button type="submit" class="btn btn-update">
                                    <i class="bi bi-save2 me-2"></i> SIMPAN PERUBAHAN
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>