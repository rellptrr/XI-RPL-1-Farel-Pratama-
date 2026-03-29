@extends('layouts.app')

@section('title', 'Data Tarif Parkir')

@section('content')
<style>
    /* Custom Minimalist Styling - Consistent with Management User */
    .stat-label { font-size: 0.75rem; letter-spacing: 1px; color: #6c757d; }
    .card-minimal { border: 1px solid #e9ecef !important; border-radius: 12px; transition: all 0.2s ease; }
    .card-minimal:hover { border-color: #0d6efd !important; }
    
    /* Input Styling */
    .form-control-clean { background-color: #f8f9fa; border: 1px solid #f1f3f5; border-radius: 8px; padding: 0.6rem 1rem; font-size: 0.9rem; }
    .form-control-clean:focus { background-color: #fff; border-color: #0d6efd; box-shadow: none; }
    
    /* Table Styling */
    .table-clean thead th { border-top: none; border-bottom: 1px solid #f1f3f5; background: #fff; color: #adb5bd; font-weight: 500; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px; }
    .table-clean tbody td { border-bottom: 1px solid #f8f9fa; padding: 1.2rem 0.5rem; }
</style>

<div class="container-fluid px-4">
    <div class="row align-items-end mb-5">
        <div class="col">
            <h6 class="text-primary fw-bold mb-1" style="font-size: 0.8rem;">PRICING CONFIGURATION</h6>
            <h2 class="fw-bold m-0">Kelola Tarif Parkir</h2>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card card-minimal bg-white p-4">
                <span class="stat-label text-uppercase fw-bold mb-4 d-block">Tambah Tarif Baru</span>
                
                @if(session('success'))
                    <div class="alert alert-success border-0 small rounded-3 mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('tarif.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="stat-label text-uppercase mb-2 d-block">Jenis Kendaraan</label>
                        <input type="text" name="jenis_kendaraan" class="form-control form-control-clean" placeholder="Contoh: Motor / Mobil" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="stat-label text-uppercase mb-2 d-block">Biaya Per Jam (Rp)</label>
                        <input type="number" name="biaya" class="form-control form-control-clean" placeholder="Contoh: 2000" required>
                    </div>
                    
                    <button type="submit" class="btn btn-dark w-100 rounded-3 py-2 fw-bold shadow-sm" style="font-size: 0.9rem;">
                        SIMPAN DATA TARIF
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-minimal bg-white p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="stat-label text-uppercase fw-bold">Daftar Harga Parkir</span>
                    <span class="badge bg-light text-dark border py-2 px-3 rounded-pill" style="font-size: 0.7rem;">
                        {{ $tarifs->count() }} KATEGORI
                    </span>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-clean align-middle">
                        <thead>
                            <tr>
                                <th class="ps-0" width="80">No</th>
                                <th>Jenis Kendaraan</th>
                                <th>Biaya</th>
                                <th class="text-end">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tarifs as $key => $t)
                            <tr>
                                <td class="ps-0 text-muted font-monospace" style="font-size: 0.8rem;">
                                    0{{ $key + 1 }}
                                </td>
                                <td>
                                    <div class="fw-bold text-dark">{{ $t->jenis_kendaraan }}</div>
                                </td>
                                <td>
                                    <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-3" style="background-color: #e7f1ff;">
                                        Rp {{ number_format($t->biaya, 0, ',', '.') }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <span class="text-success small fw-bold text-uppercase">
                                        <i class="fas fa-check-circle me-1"></i> Aktif
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted small">
                                    Belum ada data tarif parkir yang tersedia.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection