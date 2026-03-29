@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Custom Minimalist Styling */
    .stat-label { font-size: 0.75rem; letter-spacing: 1px; color: #6c757d; }
    .stat-value { font-size: 2.25rem; font-weight: 700; color: #1a1a1a; line-height: 1.2; }
    .card-minimal { border: 1px solid #e9ecef !important; border-radius: 12px; transition: all 0.2s ease; }
    .card-minimal:hover { border-color: #0d6efd !important; }
    .dot-indicator { height: 8px; width: 8px; border-radius: 50%; display: inline-block; margin-right: 8px; }
    .progress-thin { height: 4px; border-radius: 10px; background-color: #f1f3f5; }
    .table-clean thead th { border-top: none; border-bottom: 1px solid #f1f3f5; background: #fff; color: #adb5bd; font-weight: 500; text-transform: uppercase; font-size: 0.7rem; }
    .table-clean tbody td { border-bottom: 1px solid #f8f9fa; padding: 1rem 0.5rem; }
</style>

<div class="container-fluid px-4">
    <div class="row align-items-end mb-5">
        <div class="col">
            <h6 class="text-primary fw-bold mb-1" style="font-size: 0.8rem;">OVERVIEW</h6>
            <h2 class="fw-bold m-0">Dashboard Utama</h2>
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-dark btn-sm rounded-3 px-3" onclick="location.reload()">
                <i class="fas fa-redo-alt me-2 small"></i>Update Data
            </button>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card card-minimal bg-white p-4 h-100">
                <span class="stat-label text-uppercase fw-bold mb-2">Kendaraan Aktif</span>
                <div class="d-flex align-items-baseline">
                    <span class="stat-value">{{ $kendaraan_parkir }}</span>
                    <span class="ms-2 text-muted small">Unit</span>
                </div>
                <div class="mt-3 small text-muted">
                    <span class="dot-indicator bg-primary"></span>Monitoring Live
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-minimal bg-white p-4 h-100">
                <span class="stat-label text-uppercase fw-bold mb-2">Pendapatan Hari Ini</span>
                <div class="d-flex align-items-baseline">
                    <span class="stat-value">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</span>
                </div>
                <div class="mt-3 small text-muted">
                    Berdasarkan jam keluar kendaraan
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-minimal bg-white p-4 h-100">
                <span class="stat-label text-uppercase fw-bold mb-2">Kapasitas Tersedia</span>
                <div class="row g-4 mb-5">
    @foreach($areas as $area)
    <div class="col-md-4">
        <div class="card card-minimal bg-white p-4 h-100">

            <span class="stat-label text-uppercase fw-bold mb-2">
                Area {{ ucfirst(str_replace('_', ' ', $area->jenis_kendaraan)) }}
            </span>

            <div class="d-flex align-items-baseline">
                <span class="stat-value">{{ $area->terisi }}</span>
                <span class="ms-2 text-muted small">/ {{ $area->kapasitas }}</span>
            </div>

            <div class="progress progress-thin mt-4">
                <div class="progress-bar bg-dark"
                    style="width: {{ ($area->terisi / $area->kapasitas) * 100 }}%">
                </div>
            </div>

        </div>
    </div>
    @endforeach
</div>
                <div class="progress progress-thin mt-4">
                    <div class="progress-bar bg-dark" role="progressbar" style="width: {{ ($kendaraan_parkir / 50) * 100 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="fw-bold m-0">Aktivitas Terakhir</h5>
                <a href="{{ route('transaksi.index') }}" class="btn btn-link btn-sm text-dark text-decoration-none fw-bold">SEMUA DATA →</a>
            </div>
            
            <div class="table-responsive">
                <table class="table table-clean align-middle">
                    <thead>
                        <tr>
                            <th>Identitas Kendaraan</th>
                            <th>Waktu Masuk</th>
                            <th>Status Durasi</th>
                            <th class="text-end">Navigasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($riwayat as $row)
                        <tr>
                            <td>
                                <div class="fw-bold text-dark">{{ $row->plat_nomor }}</div>
                                <div class="text-muted small" style="font-size: 0.7rem;">ID: {{ $row->kode_transaksi }}</div>
                            </td>
                            <td>{{ $row->jam_masuk->format('H:i') }} <span class="text-muted small">WIB</span></td>
                            <td>
                                @if($row->status == 'Masuk')
                                    <span class="text-primary small fw-bold">● SEDANG PARKIR</span>
                                @else
                                    <span class="text-muted small fw-bold">○ SELESAI</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-light rounded-pill px-3" style="font-size: 0.75rem;">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted small">Data transaksi tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection