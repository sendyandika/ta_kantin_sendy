<!-- Tambahkan Bootstrap CSS & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <style>
        body {
            background-color: #f1f8e9;
            font-family: 'Segoe UI', sans-serif;
        }
        .card-custom {
            border-radius: 1.5rem;
            background-color: #ffffff;
        }
        .form-label {
            font-weight: 600;
        }
        .btn-primary {
            background-color: #388e3c;
            border-color: #388e3c;
        }
        .btn-primary:hover {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }
        .btn-secondary {
            background-color: #9e9e9e;
            border-color: #9e9e9e;
        }
        .btn-secondary:hover {
            background-color: #757575;
            border-color: #757575;
        }
    </style>

    <div class="container py-5">
        <div class="card card-custom shadow-lg p-4 mx-auto" style="max-width: 600px;">
            <div class="text-center mb-4">
                <i class="bi bi-pencil-square fs-1 text-success"></i>
                <h2 class="text-success fw-bold mt-2">Edit Menu Kantin</h2>
                <p class="text-muted">Perbarui informasi menu makanan atau minuman di sini</p>
            </div>

            <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Menu -->
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Menu</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                        <input type="text" name="name" id="name" class="form-control" value="{{ $menu->name }}" required>
                    </div>
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label for="price" class="form-label">Harga</label>
                    <div class="input-group">
                        <span class="input-group-text">Rp</span>
                        <input type="number" name="price" id="price" class="form-control" value="{{ $menu->price }}" required>
                    </div>
                </div>

                <!-- Gambar -->
                <div class="mb-3">
                    <label for="image" class="form-label">Gambar Menu</label>
                    <input type="file" name="image" id="image" class="form-control">
                    <small class="text-muted">Kosongkan jika tidak ingin mengubah gambar.</small>

                    @if ($menu->image)
                        <div class="mt-3 text-center">
                            <img src="{{ asset('storage/' . $menu->image) }}" class="img-thumbnail" width="180" alt="Gambar Menu">
                            <p class="text-muted mt-1">Gambar saat ini</p>
                        </div>
                    @endif
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ route('menu') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left"></i> Batal
                    </a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-check-circle-fill"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
