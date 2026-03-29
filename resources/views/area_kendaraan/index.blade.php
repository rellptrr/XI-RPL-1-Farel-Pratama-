@extends('layouts.app')

@section('title', 'Data Area & Kendaraan')

@section('content')
<div class="container-fluid px-4">

    <div class="mb-4">
        <h2 class="fw-bold">Data Area & Kendaraan</h2>
        <p class="text-muted small">Manajemen area parkir</p>
    </div>

    <div class="row g-4">

        <!-- FORM TAMBAH -->
        <div class="col-md-4">
            <div class="card p-4">
                <h6 class="mb-3">Tambah Area</h6>

                <form action="{{ route('area_kendaraan.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label>Nama Area</label>
                        <input type="text" name="nama_area" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label>Jenis Kendaraan</label>
                        <select name="jenis_kendaraan" class="form-control" required>
                            <option value="">Pilih</option>
                            <option value="motor">Motor</option>
                            <option value="mobil">Mobil</option>
                            <option value="mobil_besar">Mobil Besar</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Kapasitas</label>
                        <input type="number" name="kapasitas" class="form-control" required>
                    </div>

                    <button class="btn btn-dark w-100">Simpan</button>
                </form>
            </div>
        </div>

        <!-- DATA AREA -->
        <div class="col-md-8">
            <div class="card p-4">
                <h6 class="mb-3">Daftar Area Parkir</h6>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Area</th>
                            <th>Jenis</th>
                            <th>Kapasitas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($areas as $a)
                        <tr>
                            <td>{{ $a->nama_area }}</td>
                            <td>
                                @if($a->jenis_kendaraan == 'motor')
                                    Motor
                                @elseif($a->jenis_kendaraan == 'mobil')
                                    Mobil
                                @else
                                    Mobil Besar
                                @endif
                            </td>
                            <td>{{ $a->kapasitas }}</td>
                            <td>
                                <button class="btn btn-sm btn-dark"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $a->id }}">
                                    Edit
                                </button>
                            </td>
                        </tr>

                        <!-- MODAL EDIT -->
                        <div class="modal fade" id="editModal{{ $a->id }}">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <form action="{{ route('area_kendaraan.update', $a->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="modal-header">
                                            <h5>Edit Area</h5>
                                        </div>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label>Nama Area</label>
                                                <input type="text" name="nama_area" value="{{ $a->nama_area }}" class="form-control" required>
                                            </div>

                                            <div class="mb-3">
                                                <label>Jenis Kendaraan</label>
                                                <select name="jenis_kendaraan" class="form-control" required>
                                                    <option value="motor" {{ $a->jenis_kendaraan == 'motor' ? 'selected' : '' }}>Motor</option>
                                                    <option value="mobil" {{ $a->jenis_kendaraan == 'mobil' ? 'selected' : '' }}>Mobil</option>
                                                    <option value="mobil_besar" {{ $a->jenis_kendaraan == 'mobil_besar' ? 'selected' : '' }}>Mobil Besar</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label>Kapasitas</label>
                                                <input type="number" name="kapasitas" value="{{ $a->kapasitas }}" class="form-control" required>
                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button class="btn btn-primary">Simpan</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted">
                                Belum ada data
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>

    </div>
</div>
@endsection