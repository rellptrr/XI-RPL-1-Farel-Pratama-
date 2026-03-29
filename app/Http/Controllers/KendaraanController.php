<?php
namespace App\Http\Controllers;
use App\Models\Kendaraan;
use Illuminate\Http\Request;

class KendaraanController extends Controller {
    public function index() {
    $kendaraans = \App\Models\Kendaraan::latest()->get();
    return view('kendaraan.index', compact('kendaraans')); // Pastikan pakai titik (kendaraan.index)
}
    public function store(Request $request) {
        $request->validate([
            'plat_nomor' => 'required|unique:kendaraans',
            'jenis_kendaraan' => 'required'
        ]);
        Kendaraan::create($request->all());
        return back()->with('success', 'Kendaraan berhasil didaftarkan!');
    }
}