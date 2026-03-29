<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Tarif;
use App\Models\AreaParkir;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TransaksiController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::all();

        $transaksis = Transaksi::with(['tarif', 'area'])
            ->where('status', 'Masuk')
            ->orWhere(function($query) {
                $query->where('status', 'Selesai')
                      ->whereDate('updated_at', Carbon::today());
            })
            ->latest()
            ->get();

        return view('transaksi.index', compact('transaksis', 'tarifs'));
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

        if (!$area) {
            return back()->with('error', 'Area parkir penuh!');
        }

        Transaksi::create([
            'kode_transaksi' => 'TRX-' . strtoupper(uniqid()),
            'plat_nomor' => strtoupper($request->plat_nomor),
            'tarif_id' => $request->tarif_id,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'area_id' => $area->id, // 🔥 penting
            'jam_masuk' => now(),
            'status' => 'Masuk',
            'user_id' => auth()->id(),
        ]);

        return back()->with('success', 'Kendaraan berhasil masuk!');
    }

    public function parkirKeluar($id)
    {
        $trx = Transaksi::with('tarif')->findOrFail($id);

        $jamMasuk = Carbon::parse($trx->jam_masuk);
        $jamKeluar = Carbon::now();

        $durasi = $jamMasuk->diffInHours($jamKeluar);
        if ($durasi < 1) { $durasi = 1; }

        $tarifPerJam = $trx->tarif->biaya ?? 0;
        $totalBayar = $durasi * $tarifPerJam;

        $trx->update([
            'jam_keluar'  => $jamKeluar,
            'total_bayar' => $totalBayar,
            'durasi'      => $durasi,
            'status'      => 'Selesai'
        ]);

        return back()->with('success', 'Berhasil! Silakan cetak struk.');
    }

    public function print($id)
    {
        $transaksi = Transaksi::with(['tarif', 'area'])->findOrFail($id);
        return view('transaksi.print', compact('transaksi'));
    }
}