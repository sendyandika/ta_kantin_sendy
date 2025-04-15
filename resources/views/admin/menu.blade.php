<!-- Tambahkan Bootstrap CSS & Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<x-app-layout>
    <x-slot name="header"></x-slot>

    <style>
        body {
            background: linear-gradient(to bottom right, #f1f8e9, #ffffff);
        }

        .container {
            background: rgba(255, 255, 255, 0.96); 
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            border-radius: 1rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.15);
        }

        .btn-danger {
            background-color: #e53935;
            border: none;
        }

        .btn-warning {
            background-color: #f9a825;
            border: none;
        }

        .btn-danger:hover {
            background-color: #d32f2f;
        }

        .btn-warning:hover {
            background-color: #f57f17;
        }

        .btn-primary {
            background-color: #43a047;
            border: none;
        }

        .btn-primary:hover {
            background-color: #2e7d32;
        }
    </style>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-success"><i class="bi bi-list-ul me-2"></i>Daftar Menu Kantin</h2>
            <a href="{{ route('menu.new') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i> Tambah Menu
            </a>
        </div>

        <div class="row">
            @foreach ($menus as $menu)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="{{ asset('storage/' . $menu->image) }}" class="card-img-top" alt="Gambar Menu" style="height: 200px; object-fit: cover; border-top-left-radius: 1rem; border-top-right-radius: 1rem;">

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title text-success">{{ $menu->name }}</h5>
                            <p class="card-text text-muted">Rp {{ number_format($menu->price, 0, ',', '.') }}</p>

                            <div class="mt-auto d-flex justify-content-between">
                                <a href="{{ route('menu.edit', $menu->id) }}" class="btn btn-warning">
                                    <i class="bi bi-pencil-square me-1"></i> Edit
                                </a>
                                <button class="btn btn-danger delete-btn"
                                        data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        data-id="{{ $menu->id }}">
                                    <i class="bi bi-trash me-1"></i> Hapus
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="deleteModalLabel"><i class="bi bi-exclamation-triangle-fill me-2"></i>Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus menu ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS & Script Modal -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var menuId = button.getAttribute('data-id');
                var deleteForm = document.getElementById('deleteForm');
                var deleteUrl = "{{ route('menu.delete', ':id') }}";
                deleteForm.action = deleteUrl.replace(':id', menuId);
            });
        });
    </script>
</x-app-layout>
