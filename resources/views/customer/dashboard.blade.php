<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantin Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>
<body class="bg-yellow-100">
    <div class="container mx-auto p-4 sm:p-6">
        
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center bg-green-600 p-4 rounded-lg shadow-md text-white gap-4 sm:gap-0">
            <h2 class="text-2xl font-bold text-center sm:text-left">Kantin Sekolah</h2>

            <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 gap-2 sm:gap-0 w-full sm:w-auto">

                <!-- Tombol Keranjang & Pesanan -->
                <div class="flex flex-col sm:flex-row sm:items-center gap-2 w-full sm:w-auto">
                    <a href="{{ route('customer.viewCart') }}" class="w-full sm:w-auto bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-2">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        <span>Keranjang</span>
                    </a>
                    <a href="{{ route('customer.orders') }}" class="w-full sm:w-auto bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg flex items-center justify-center space-x-2">
                        <i class="fas fa-receipt text-lg"></i>
                        <span>Pesanan Saya</span>
                    </a>
                </div>

                <!-- Dropdown Profil -->
                <div class="relative w-full sm:w-auto">
                    <button onclick="toggleDropdown()" class="w-full sm:w-auto bg-white text-green-700 px-4 py-2 rounded-lg flex items-center justify-between sm:justify-center gap-2 font-semibold shadow hover:bg-gray-100">
                        <i class="fas fa-user-circle"></i>
                        <span>Profil</span>
                        <i class="fas fa-caret-down"></i>
                    </button>
                    <div id="dropdown" class="absolute right-0 mt-2 w-full sm:w-40 bg-white text-green-700 rounded-lg shadow-lg hidden z-50">
                        <div class="px-4 py-2 border-b border-gray-200">
                            {{ Auth::user()->name ?? 'Pengguna' }}
                        </div>
                        <form method="POST" action="{{ route('customer.logout') }}" class="w-full">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-100 text-red-600">Logout</button>
                        </form>
                    </div>
                </div>

            </div>
        </div>

        <!-- Flash Message -->
        @if (session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mt-4">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-800 p-4 rounded mt-4">
                {{ session('error') }}
            </div>
        @endif

        <!-- Menu Kantin -->
        <div class="mt-6 bg-white p-6 rounded-lg shadow-md">
            <h3 class="text-lg font-bold text-green-700">Menu Kantin</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-4">
                @foreach ($menus ?? [] as $menu)
                    <div class="bg-white border rounded-lg shadow p-4 hover:shadow-lg transition-all">
                        <img src="{{ asset('storage/' . $menu->image) }}" class="w-full h-40 object-cover rounded" alt="{{ $menu->name ?? 'Menu' }}">
                        <h4 class="text-lg font-semibold mt-2 text-green-800">{{ $menu->name ?? 'Nama Tidak Tersedia' }}</h4>
                        <p class="text-gray-700">Rp {{ number_format($menu->price ?? 0, 0, ',', '.') }}</p>
                        <form action="{{ route('customer.cart', ['id' => $menu->id]) }}" method="POST" class="mt-2" onsubmit="showPopup(event)">
                            @csrf
                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg w-full">Tambah ke Keranjang</button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Pop-up Notifikasi -->
        <div id="popup" class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-2 rounded-lg shadow-lg hidden z-50">
            <i class="fas fa-check-circle"></i> Menu berhasil ditambahkan ke keranjang!
        </div>

    </div>

    <script>
        function showPopup(event) {
            event.preventDefault();
            const popup = document.getElementById("popup");
            popup.classList.remove("hidden");
            setTimeout(() => {
                popup.classList.add("hidden");
                event.target.submit();
            }, 2000);
        }

        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.classList.toggle('hidden');
        }

        // Close dropdown on outside click
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('dropdown');
            const button = dropdown.previousElementSibling;
            if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>
</body>
</html>
