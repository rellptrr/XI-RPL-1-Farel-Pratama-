@extends('layouts.app')

@section('title', 'Transaksi Parkir')

@section('content')
<style>
    .stat-label { font-size: 0.75rem; letter-spacing: 1px; color: #6c757d; }
    .card-minimal { border: 1px solid #e9ecef !important; border-radius: 12px; }
    .form-control-clean { background-color: #f8f9fa; border: 1px solid #f1f3f5; border-radius: 8px; padding: 0.6rem 1rem; }
    .plat-input { text-transform: uppercase; font-size: 1.5rem; letter-spacing: 2px; font-weight: bold; text-align: center; }
</style>

<div class="container-fluid px-4">
    <div class="row align-items-end mb-4">
        <div class="col">
            <h6 class="text-primary fw-bold mb-1">TRANSACTIONS</h6>
            <h2 class="fw-bold m-0">Parkir Masuk & Keluar</h2>
        </div>
    </div>

    {{-- Perbaikan: Alert manual mengganti layouts.alerts --}}
    <div class="row mb-3">
        <div class="col-12">
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger border-0 shadow-sm">{{ session('error') }}</div>
            @endif
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            @if(Auth::user()->role == 'petugas')
            <div class="card card-minimal bg-white p-4 shadow-sm border-0">
                <span class="stat-label text-uppercase fw-bold mb-4 d-block">Input Masuk</span>
                <form action="{{ route('transaksi.masuk') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="stat-label text-uppercase mb-2 d-block">Jenis</label>
                        <select name="tarif_id" class="form-select form-control-clean" required>
                            <option value="" selected disabled>Pilih Jenis</option>
                            @foreach($tarifs as $tarif)
                                <option value="{{ $tarif->id_tarif }}">{{ $tarif->jenis_kendaraan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="stat-label text-uppercase mb-2 d-block">Plat Nomor</label>
                        <input type="text" name="plat_nomor" class="form-control form-control-clean plat-input" required>
                    </div>
                    <select name="jenis_kendaraan">
    <option value="motor">Motor</option>
    <option value="mobil">Mobil</option>
    <option value="mobil_besar">Mobil Besar</option>
</select>
                    <button type="submit" class="btn btn-primary w-100 fw-bold">CATAT MASUK</button>
                </form>
            </div>
            @endif
        </div>

        <div class="col-md-8">
            <div class="card card-minimal bg-white p-4 shadow-sm border-0">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead>
                            <tr class="small text-uppercase text-muted">
                                <th>Plat Nomor</th>
                                <th>Jenis</th>
                                <th>Waktu</th>
                                <th class="text-end">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($transaksis as $t)
                            <tr style="{{ $t->status == 'Selesai' ? 'opacity: 0.6;' : '' }}">
                                <td><span class="fw-bold fs-5">{{ $t->plat_nomor }}</span></td>
                                <td><span class="badge bg-light text-dark border">{{ $t->tarif?->jenis_kendaraan }}</span></td>
                                <td>
                                    <small>In: {{ $t->jam_masuk->format('H:i') }}</small>
                                    @if($t->status == 'Selesai')
                                        <br><small class="text-success">Out: {{ $t->jam_keluar->format('H:i') }}</small>
                                    @endif
                                </td>
                                <td class="text-end">
                                    @if($t->status == 'Masuk')
                                        <form action="{{ route('transaksi.keluar', $t->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-outline-danger px-3">Selesai</button>
                                        </form>
                                    @endif
                                    <a href="{{ route('transaksi.print', $t->id) }}" target="_blank" class="btn btn-sm btn-dark ms-1">
                                        <i class="fas fa-print text">Cetak struk</i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="text-center py-4 text-muted">Belum ada data.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection