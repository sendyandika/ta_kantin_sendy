<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Kantin Sekolah</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-green-100 flex justify-center items-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="text-center mb-6">
            <img src="/img/kantin.webp" alt="Kantin Sekolah" class="mx-auto rounded-full w-20 h-20">
            <h2 class="text-2xl font-bold text-green-700 mt-3">Kantin Sekolah</h2>
            <p class="text-gray-600">Silakan masuk untuk melanjutkan</p>
        </div>

        <form method="POST" action="{{ route('customer.login') }}">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 font-medium">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-400">
            </div>

            <button type="submit" class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition">
                Masuk
            </button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-gray-600">Belum punya akun? 
                <a href="{{ route('customer.register') }}" class="text-green-500 font-semibold hover:underline">Daftar di sini</a>
            </p>
        </div>
    </div>
</body>
</html>
