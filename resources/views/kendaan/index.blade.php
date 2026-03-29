<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">Input Data Kendaraan</div>
        <div class="card-body">
            <form action="{{ route('kendaraan.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label>Plat Nomor</label>
                    <input type="text" name="plat_nomor" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Jenis Kendaraan</label>
                    <select name="jenis_kendaraan" class="form-select">
                        <option value="Mobil">Mobil</option>
                        <option value="Motor">Motor</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="/dashboard" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>