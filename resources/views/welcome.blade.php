<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kantin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="text-center">
        <h1 class="fw-bold mb-3">Selamat Datang di Admin Kantin</h1>
        <p class="text-muted mb-4">Kelola menu dan pesanan dengan mudah</p>
        
        <div class="d-flex justify-content-center gap-3">
            <a href="/login" class="btn btn-primary">Login</a>
            <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Logout sebagai User</button>
        </form>
        </div>
        
        
        
    </div>
    
</body>
</html>
