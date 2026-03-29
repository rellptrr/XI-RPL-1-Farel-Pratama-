@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<style>
    /* Custom Minimalist Styling */
    .stat-label { font-size: 0.75rem; letter-spacing: 1px; color: #6c757d; }
    .card-minimal { border: 1px solid #e9ecef !important; border-radius: 12px; transition: all 0.2s ease; }
    .card-minimal:hover { border-color: #0d6efd !important; }
    
    .form-control-clean { background-color: #f8f9fa; border: 1px solid #f1f3f5; border-radius: 8px; padding: 0.6rem 1rem; font-size: 0.9rem; }
    .form-control-clean:focus { background-color: #fff; border-color: #0d6efd; box-shadow: none; }
    
    .table-clean thead th { border-top: none; border-bottom: 1px solid #f1f3f5; background: #fff; color: #adb5bd; font-weight: 500; text-transform: uppercase; font-size: 0.7rem; letter-spacing: 0.5px; }
    .table-clean tbody td { border-bottom: 1px solid #f8f9fa; padding: 1.2rem 0.5rem; }
    
    .role-dot { height: 6px; width: 6px; border-radius: 50%; display: inline-block; margin-right: 8px; }
</style>

<div class="container-fluid px-4">
    <div class="row align-items-end mb-5">
        <div class="col">
            <h6 class="text-primary fw-bold mb-1" style="font-size: 0.8rem;">ADMINISTRATION</h6>
            <h2 class="fw-bold m-0">Manajemen Pengguna</h2>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card card-minimal bg-white p-4">
                <span class="stat-label text-uppercase fw-bold mb-4 d-block">Tambah Akun Baru</span>
                
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="stat-label text-uppercase mb-2 d-block">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" class="form-control form-control-clean" placeholder="Asep Surasep" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="stat-label text-uppercase mb-2 d-block">Username</label>
                        <input type="text" name="username" class="form-control form-control-clean" placeholder="asep_123" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="stat-label text-uppercase mb-2 d-block">Password</label>
                        <input type="password" name="password" class="form-control form-control-clean" placeholder="••••••••" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="stat-label text-uppercase mb-2 d-block">Role / Jabatan</label>
                        <select name="role" class="form-select form-control-clean" required>
                            <option value="" selected disabled>Pilih Hak Akses</option>
                            <option value="admin">Administrator</option>
                            <option value="petugas">Petugas Lapangan</option>
                            <option value="owner">Owner / Pemilik</option>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-dark w-100 rounded-3 py-2 fw-bold shadow-sm" style="font-size: 0.9rem;">
                        SIMPAN PENGGUNA
                    </button>
                </form>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card card-minimal bg-white p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <span class="stat-label text-uppercase fw-bold">Daftar Pengguna Aktif</span>
                    <span class="badge bg-light text-dark border py-2 px-3 rounded-pill" style="font-size: 0.7rem;">
                        {{ $users->count() }} TOTAL USER
                    </span>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-clean align-middle">
                        <thead>
                            <tr>
                                <th class="ps-0">Nama & ID</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th class="text-end">Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $u)
                            <tr>
                                <td class="ps-0">
                                    <div class="fw-bold text-dark @if(isset($u->is_active) && !$u->is_active) text-decoration-line-through text-muted @endif">
                                        {{ $u->nama_lengkap }}
                                    </div>
                                    <div class="text-muted small" style="font-size: 0.7rem;">UID: #00{{ $u->id }}</div>
                                </td>
                                <td><span class="text-dark font-monospace">{{ $u->username }}</span></td>
                                <td>
                                    @if($u->role == 'admin')
                                        <span class="text-danger small fw-bold text-uppercase"><span class="role-dot bg-danger"></span>Admin</span>
                                    @elseif($u->role == 'petugas')
                                        <span class="text-primary small fw-bold text-uppercase"><span class="role-dot bg-primary"></span>Petugas</span>
                                    @else
                                        <span class="text-dark small fw-bold text-uppercase"><span class="role-dot bg-dark"></span>Owner</span>
                                    @endif
                                </td>
                                <td class="text-end">
                                    <div class="d-flex justify-content-end gap-2">
                                        <form action="{{ route('user.toggle', $u->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-sm {{ (isset($u->is_active) && $u->is_active) ? 'btn-light' : 'btn-outline-danger' }} rounded-pill px-3" style="font-size: 0.7rem;">
                                                {{ (isset($u->is_active) && $u->is_active) ? 'Nonaktifkan' : 'Aktifkan' }}
                                            </button>
                                        </form>

                                        <button class="btn btn-sm btn-dark rounded-pill px-3" 
                                                style="font-size: 0.7rem;"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editModal{{ $u->id }}">
                                            Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal{{ $u->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 shadow rounded-4">
                                        <div class="modal-header border-0 pt-4 px-4">
                                            <h5 class="fw-bold m-0">Edit Pengguna</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('user.update', $u->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body p-4">
                                                <div class="mb-3">
                                                    <label class="stat-label text-uppercase mb-2 d-block">Nama Lengkap</label>
                                                    <input type="text" name="nama_lengkap" class="form-control form-control-clean" value="{{ $u->nama_lengkap }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="stat-label text-uppercase mb-2 d-block">Username</label>
                                                    <input type="text" name="username" class="form-control form-control-clean" value="{{ $u->username }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="stat-label text-uppercase mb-2 d-block">Password Baru (Kosongkan jika tidak ganti)</label>
                                                    <input type="password" name="password" class="form-control form-control-clean" placeholder="••••••••">
                                                </div>
                                                <div class="mb-0">
                                                    <label class="stat-label text-uppercase mb-2 d-block">Role</label>
                                                    <select name="role" class="form-select form-control-clean" required>
                                                        <option value="admin" {{ $u->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                                                        <option value="petugas" {{ $u->role == 'petugas' ? 'selected' : '' }}>Petugas Lapangan</option>
                                                        <option value="owner" {{ $u->role == 'owner' ? 'selected' : '' }}>Owner</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 pb-4 px-4">
                                                <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-primary rounded-3 px-4 shadow-sm">Simpan Perubahan</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-5 text-muted small">Belum ada akun terdaftar.</td>
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