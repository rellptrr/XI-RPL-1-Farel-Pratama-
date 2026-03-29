<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function index()
    {
        $tarifs = Tarif::all();
       return view('tarif.index', compact('tarifs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_kendaraan' => 'required',
            'biaya' => 'required|numeric',
        ]);

        Tarif::create($request->all());
        return redirect()->back()->with('success', 'Tarif berhasil ditambahkan!');
    }
}