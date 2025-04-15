<!-- Tambahkan Bootstrap CSS & Bootstrap Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(to right, #e8f5e9, #c8e6c9);
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
        background-color: #8d8d8d;
        border: none;
    }
    .btn-secondary:hover {
        background-color: #6c6c6c;
    }
    .input-group-text {
        background-color: #e0f2f1;
        border: none;
    }
</style>

<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg card-custom p-4" style="width: 32rem;">
        <div class="text-center mb-4">
            <i class="bi bi-egg-fried fs-1 text-success"></i>
            <h2 class="text-success fw-bold mt-2">Tambah Menu Baru</h2>
            <p class="text-muted mb-0">Form untuk menambahkan makanan/minuman ke daftar menu kantin</p>
        </div>

        <!-- Form untuk menyimpan menu baru -->
        <form action="{{ route('menu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <!-- Nama Menu -->
            <div class="mb-3">
                <label for="menu-name" class="form-label">Nama Menu</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                    <input type="text" id="menu-name" name="name" class="form-control" required placeholder="Contoh: Nasi Goreng">
                </div>
            </div>

            <!-- Harga -->
            <div class="mb-3">
                <label for="menu-price" class="form-label">Harga</label>
                <div class="input-group">
                    <span class="input-group-text">Rp</span>
                    <input type="number" id="menu-price" name="price" class="form-control" required placeholder="Contoh: 10000">
                </div>
            </div>

            <!-- Gambar -->
            <div class="mb-3">
                <label for="menu-image" class="form-label">Gambar Menu</label>
                <input type="file" id="menu-image" name="image" class="form-control">
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

<!-- Tambahkan Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
