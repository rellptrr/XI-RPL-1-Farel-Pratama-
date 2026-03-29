<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AreaParkir extends Model
{
    use HasFactory;

    protected $fillable = [
    'nama_area',
    'jenis_kendaraan',
    'kapasitas'
];

public function transaksis()
{
    return $this->hasMany(Transaksi::class, 'area_id');
}

public function parkirMasuk(Request $request)
{
    $request->validate([
        'plat_nomor' => 'required|string|max:15',
        'tarif_id'   => 'required|exists:tb_tarif,id_tarif',
        'jenis_kendaraan' => 'required|in:motor,mobil,mobil_besar'
    ]);

    // 🔥 CARI AREA SESUAI JENIS
    $area = AreaParkir::where('jenis_kendaraan', $request->jenis_kendaraan)
        ->withCount(['transaksis' => function ($q) {
            $q->where('status', 'Masuk');
        }])
        ->get()
        ->first(function ($a) {
            return $a->transaksis_count < $a->kapasitas;
        });

    // ❌ kalau penuh
    if (!$area) {
        return back()->with('error', 'Area parkir penuh!');
    }

    // ✅ SIMPAN
    Transaksi::create([
        'kode_transaksi' => 'TRX-' . strtoupper(uniqid()),
        'plat_nomor' => strtoupper($request->plat_nomor),
        'tarif_id' => $request->tarif_id,
        'jenis_kendaraan' => $request->jenis_kendaraan,
        'area_id' => $area->id, // 🔥 INI YANG PENTING
        'jam_masuk' => now(),
        'status' => 'Masuk',
        'user_id' => auth()->id(),
    ]);

    return back()->with('success', 'Kendaraan berhasil masuk!');
}
    // Baris ini sangat penting untuk memberitahu Laravel 
    // bahwa nama tabel di database adalah 'area_parkirs'
    protected $table = 'area_parkirs'; 

    // Ini adalah kolom-kolom yang boleh diisi (mass assignment
}