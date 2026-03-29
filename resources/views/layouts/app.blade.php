<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Parkir - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; overflow-x: hidden; background: #f8f9fa; }
        .sidebar { width: 250px; background: #343a40; color: white; padding: 20px; position: fixed; height: 100vh; z-index: 1000; }
        .content { flex-grow: 1; padding: 25px; margin-left: 250px; width: calc(100% - 250px); }
        .nav-link { color: rgba(255,255,255,.8); margin-bottom: 10px; display: block; text-decoration: none; padding: 12px; border-radius: 8px; }
        .nav-link:hover { background: #495057; color: white; transition: 0.3s; }
        .nav-link.active { background: #0d6efd; color: white; font-weight: bold; }
        hr { border-color: rgba(255,255,255,.1); }
    </style>
</head>
<body>

    <div class="sidebar shadow">
        <h4 class="text-center fw-bold">PARKIR PRO</h4>
        <hr>
        <p class="small text-uppercase text-secondary fw-bold mb-3">Menu {{ auth()->user()->role }}</p>
        
        <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">Dashboard</a>
        
        @if(auth()->user()->role == 'admin')
            <a href="{{ route('user.index') }}" class="nav-link {{ request()->is('user*') ? 'active' : '' }}">Data User</a>
            <a href="{{ route('tarif.index') }}" class="nav-link {{ request()->is('tarif*') ? 'active' : '' }}">Data Tarif</a>
        @endif

        @if(auth()->user()->role == 'petugas')
            <a href="{{ route('transaksi.index') }}" class="nav-link {{ request()->is('transaksi*') ? 'active' : '' }}">Transaksi Parkir</a>
        @endif

        @if(in_array(auth()->user()->role, ['admin', 'owner']))
        <a href="{{ route('area.index') }}" class="nav-link {{ request()->is('area*') ? 'active' : '' }}">Data Area & Kendaraan</a>
        @endif

        @if(auth()->user()->role == 'owner')
            <a href="{{ route('laporan.index') }}" class="nav-link">Laporan Pendapatan</a>
        @endif

        <div style="position: absolute; bottom: 20px; width: 210px;">
            <hr>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 fw-bold">Logout</button>
            </form>
        </div>
    </div>

    <div class="content">
        <nav class="navbar navbar-light bg-white shadow-sm mb-4 p-3 rounded-4">
            <div class="container-fluid">
                <span class="navbar-brand mb-0 h1">Halo, {{ auth()->user()->nama_lengkap }}</span>
                <span class="badge bg-primary px-3 py-2 text-uppercase">{{ auth()->user()->role }}</span>
            </div>
        </nav>
        
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>