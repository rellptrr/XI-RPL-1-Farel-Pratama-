<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AreaParkir;

class AreaKendaraanController extends Controller
{
    public function index()
    {
        // 🔐 hanya admin & owner
        if (!in_array(auth()->user()->role, ['admin', 'owner'])) {
            abort(403);
        }

        $areas = AreaParkir::latest()->get();

        return view('area_kendaraan.index', compact('areas'));
    }

    public function store(Request $request)
    {
        if (!in_array(auth()->user()->role, ['admin', 'owner'])) {
            abort(403);
        }

        $request->validate([
            'nama_area' => 'required',
            'jenis_kendaraan' => 'required|in:motor,mobil,mobil_besar',
            'kapasitas' => 'required|integer|min:1'
        ]);

        AreaParkir::create([
            'nama_area' => $request->nama_area,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'kapasitas' => $request->kapasitas,
        ]);

        return back()->with('success', 'Area berhasil ditambahkan');
    }


    public function update(Request $request, $id)
    {
        if (!in_array(auth()->user()->role, ['admin', 'owner'])) {
            abort(403);
        }

        $request->validate([
            'nama_area' => 'required',
            'jenis_kendaraan' => 'required|in:motor,mobil,mobil_besar',
            'kapasitas' => 'required|integer|min:1'
        ]);

        $area = AreaParkir::findOrFail($id);

        $area->update([
            'nama_area' => $request->nama_area,
            'jenis_kendaraan' => $request->jenis_kendaraan,
            'kapasitas' => $request->kapasitas,
        ]);

        return back()->with('success', 'Area berhasil diupdate');
    }
}