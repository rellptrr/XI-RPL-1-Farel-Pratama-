<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'transaksis';

    // Kolom yang boleh diisi secara massal
  protected $fillable = [
    'kode_transaksi',
    'plat_nomor',
    'tarif_id',
    'jenis_kendaraan',
    'area_id',
    'jam_masuk',
    'jam_keluar',
    'total_bayar',
    'durasi',
    'status',
    'user_id'
];

    public function tarif()
{
    // Ini memberitahu Laravel bahwa transaksi ini memiliki/milik satu tarif
    return $this->belongsTo(Tarif::class, 'tarif_id');
}

// Tambahkan relasi ini agar kita bisa panggil "idod12" nanti
public function user()
{
    return $this->belongsTo(\App\Models\User::class, 'user_id');
}

public function area()
{
    return $this->belongsTo(AreaParkir::class);
}

    /**
     * Otomatis mengubah string jam menjadi objek Carbon 
     * supaya bisa dihitung selisih waktunya dengan mudah.
     */
    protected $casts = [
        'jam_masuk' => 'datetime',
        'jam_keluar' => 'datetime',
    ];
}