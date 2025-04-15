<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin Kantin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #e8f5e9, #c8e6c9);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            width: 100%;
            max-width: 420px;
            border-radius: 20px;
            background-color: #ffffff;
        }
        .login-title {
            font-weight: 700;
            color: #388e3c;
        }
        .form-label {
            font-weight: 500;
        }
        .btn-primary {
            background-color: #388e3c;
            border-color: #388e3c;
        }
        .btn-primary:hover {
            background-color: #2e7d32;
            border-color: #2e7d32;
        }
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
            border-color: #4caf50;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">

    <div class="card login-card shadow-lg p-4">
        <div class="text-center mb-4">
            <i class="bi bi-shop-window" style="font-size: 2.5rem; color: #4caf50;"></i>
            <h3 class="login-title mt-2">Login Admin Kantin</h3>
        </div>
        
        <!-- Session Status -->
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label">Email Admin</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label">Kata Sandi</label>
                <input type="password" id="password" name="password" class="form-control" required>
                @error('password')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                <label class="form-check-label" for="remember_me">Ingat saya</label>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none text-success">Lupa password?</a>
                @endif
            </div>

            <div class="d-flex justify-content-between">
                <a href="javascript:history.back()" class="btn btn-outline-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Masuk</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
