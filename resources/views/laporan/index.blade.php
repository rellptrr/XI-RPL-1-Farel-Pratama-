@extends('layouts.app')

@section('title', 'Laporan Pendapatan')

@section('content')
<div class="container-fluid px-4">

    <div class="mb-4">
        <h2 class="fw-bold">Laporan Pendapatan</h2>
        <p class="text-muted small">Ringkasan pemasukan parkir</p>
    </div>

    <!-- FILTER -->
    <div class="card p-4 mb-4">
        <form method="GET">
            <div class="row">
                <div class="col-md-4">
                    <label>Dari Tanggal</label>
                    <input type="date" name="dari" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Sampai Tanggal</label>
                    <input type="date" name="sampai" class="form-control">
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button class="btn btn-dark w-100">Filter</button>
                </div>
            </div>
        </form>
    </div>

    <!-- TOTAL -->
    <div class="card p-4 mb-4">
        <h6 class="text-muted">Total Pendapatan</h6>
        <h3 class="fw-bold text-success">
            Rp {{ number_format($total, 0, ',', '.') }}
        </h3>
    </div>

    <!-- TABEL -->
    <div class="card p-4">
        <h6 class="mb-3">Detail Transaksi</h6>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Plat</th>
                        <th>Masuk</th>
                        <th>Keluar</th>
                        <th>Durasi</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $trx)
                    <tr>
                        <td>{{ $trx->kode_transaksi }}</td>
                        <td>{{ $trx->plat_nomor }}</td>
                        <td>{{ $trx->jam_masuk }}</td>
                        <td>{{ $trx->jam_keluar }}</td>
                        <td>{{ $trx->durasi }} jam</td>
                        <td class="text-success fw-bold">
                            Rp {{ number_format($trx->total_bayar, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            Tidak ada data
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection