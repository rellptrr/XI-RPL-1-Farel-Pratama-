<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="referrer" content="no-referrer">
    <title>Login Sistem Parkir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #e9ecef; height: 100vh; }
        .card { border-radius: 12px; border: none; }
        .btn-primary { background-color: #0d6efd; border: none; }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center">

    <div class="card shadow-lg p-4" style="width: 100%; max-width: 400px;">
        <div class="text-center mb-4">
            <h3 class="fw-bold text-primary">SISTEM PARKIR</h3>
            <p class="text-muted">Silakan masuk untuk melanjutkan</p>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger py-2 shadow-sm">
                <ul class="mb-0 small">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

       {{-- Tembak langsung ke /login-proses sesuai yang ada di web.php --}}
<form action="/login-aksi" method="POST">
    @csrf
    <div class="mb-3">
        <label>Username</label>
        <input type="text" name="username" class="form-control" required autofocus>
    </div>
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Masuk</button>
</form>
    </div>

</body>
</html>