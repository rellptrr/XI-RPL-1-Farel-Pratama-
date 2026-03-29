<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaksi;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // 🔐 (opsional) hanya owner
        if (auth()->user()->role !== 'owner') {
            abort(403);
        }

        $query = Transaksi::where('status', 'Selesai');

        // filter tanggal
        if ($request->dari && $request->sampai) {
            $query->whereBetween('created_at', [$request->dari, $request->sampai]);
        }

        $transaksis = $query->latest()->get();
        $total = $transaksis->sum('total_bayar');

        return view('laporan.index', compact('transaksis', 'total'));
    }
}