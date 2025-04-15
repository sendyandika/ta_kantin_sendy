<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Kantin Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background-color: #f9f9f9;
            font-family: 'Arial', sans-serif;
        }
    </style>
</head>
<body class="bg-yellow-100">
    <div class="container mx-auto p-4 sm:p-6">

        <!-- Judul Halaman -->
        <div class="bg-green-600 text-white p-4 rounded-lg shadow text-center text-2xl font-bold mb-6">
            Keranjang Belanja
        </div>

        <!-- Keranjang -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            @if (count($cartItems ?? []) > 0)
                <div class="space-y-4">
                    @foreach ($cartItems as $item)
                        <div class="flex flex-col sm:flex-row justify-between items-center bg-gray-100 p-4 rounded-lg shadow-sm">
                            <div class="flex-1 text-center sm:text-left">
                                <p class="text-lg font-semibold text-green-700">{{ $item['name'] }}</p>
                                <p class="text-sm text-gray-600">Jumlah: <strong>{{ $item['quantity'] }}</strong></p>
                            </div>

                            <div class="text-center sm:text-right mt-2 sm:mt-0">
                                <p class="text-lg font-bold text-yellow-700">
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </p>
                            </div>

                            <div class="mt-2 sm:mt-0 sm:ml-4">
                                <form action="{{ route('customer.cart.delete', ['id' => $item['id']]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                                        Batal
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Total & Checkout -->
                <div class="border-t mt-6 pt-4 flex flex-col sm:flex-row justify-between items-center">
                    <p class="text-lg font-bold text-green-800 mb-4 sm:mb-0">
                        Total: Rp {{ number_format($totalPrice ?? 0, 0, ',', '.') }}
                    </p>
                    <form action="{{ route('customer.cart.checkout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg text-lg shadow">
                            Checkout Sekarang
                        </button>
                    </form>
                </div>
            @else
                <div class="text-center py-10 text-gray-600">
                    <i class="fas fa-shopping-cart text-4xl text-gray-400 mb-4"></i>
                    <p class="text-lg">Keranjang kamu kosong. Yuk, pilih menu dulu!</p>
                    <a href="{{ route('customer.dashboard') }}" class="mt-4 inline-block bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm">
                        Lihat Menu
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Font Awesome untuk ikon -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
