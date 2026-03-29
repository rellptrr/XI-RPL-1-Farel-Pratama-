<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AreaParkirController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TransaksiController;
use App\Models\Transaksi;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\AreaKendaraanController;
use App\Models\AreaParkir;

// 1. ROUTE UNTUK TAMU (HANYA BISA DIAKSES JIKA BELUM LOGIN)
Route::middleware('guest')->group(function () {
    Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
    Route::get('/login', [AuthController::class, 'showLoginForm']); 
    
    // Pastikan URL '/login-aksi' ini sama dengan yang ada di <form action="...">
    Route::post('/login-aksi', [AuthController::class, 'login'])->name('login.post');
});

// 2. ROUTE KHUSUS YANG SUDAH LOGIN
Route::middleware('auth')->group(function () {
    
    // Halaman Utama (Dashboard)
    Route::get('/dashboard', function () {

    // kendaraan aktif
    $kendaraan_parkir = Transaksi::where('status', 'Masuk')->count();

    // pendapatan
    $total_pendapatan = Transaksi::where('status', 'Selesai')->sum('total_bayar');

    // riwayat
    $riwayat = Transaksi::latest()->take(5)->get();

    // 🔥 TAMBAHAN: data area
    $areas = AreaParkir::withCount([
        'transaksis as terisi' => function ($q) {
            $q->where('status', 'Masuk');
        }
    ])->get();

    return view('dashboard', compact(
        'kendaraan_parkir',
        'total_pendapatan',
        'riwayat',
        'areas'
    ));

    // 2. Hitung total uang dari transaksi yang sudah 'Selesai'
    $total_pendapatan = Transaksi::where('status', 'Selesai')->sum('total_bayar');

    // 3. Ambil 5 riwayat parkir terbaru
    $riwayat = Transaksi::latest()->take(5)->get();

    // Kirim semua data ke view dashboard
    return view('dashboard', compact('kendaraan_parkir', 'total_pendapatan', 'riwayat'));
})->middleware('auth')->name('dashboard');
    // Alias rute 'home' untuk menghindari error redirect otomatis Laravel
    Route::get('/home', function() {
        return redirect()->route('dashboard');
    });

    // --- MANAJEMEN USER ---
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::post('/user-simpan', [UserController::class, 'store'])->name('user.store');

    // --- MANAJEMEN AREA PARKIR ---
    Route::get('/area', [AreaParkirController::class, 'index'])->name('area.index');
    Route::post('/area-simpan', [AreaParkirController::class, 'store'])->name('area.store');

    // --- MANAJEMEN TARIF ---
    Route::get('/tarif', [TarifController::class, 'index'])->name('tarif.index');
    Route::post('/tarif-simpan', [TarifController::class, 'store'])->name('tarif.store');

    // --- MANAJEMEN TRANSAKSI PARKIR ---
    // Menampilkan halaman daftar parkir (kendaraan yang sedang parkir & riwayat)
    Route::middleware('auth')->group(function () {

    Route::put('/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::post('/user/{id}/toggle', [UserController::class, 'toggleStatus'])->name('user.toggle');
    // ... rute lainnya ...
    Route::get('/transaksi/print/{id}', [TransaksiController::class, 'print'])->name('transaksi.print');
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/area-kendaraan', [AreaKendaraanController::class, 'index'])->name('area_kendaraan.index');
Route::post('/area-kendaraan', [AreaKendaraanController::class, 'store'])->name('area_kendaraan.store');
Route::put('/area-kendaraan/{id}', [AreaKendaraanController::class, 'update'])->name('area_kendaraan.update');

    // Halaman Transaksi
    Route::get('/transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::post('/transaksi-masuk', [TransaksiController::class, 'parkirMasuk'])->name('transaksi.masuk');
    Route::post('/transaksi-keluar/{id}', [TransaksiController::class, 'parkirKeluar'])->name('transaksi.keluar');
});

    // Fitur Keluar (Logout)
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});