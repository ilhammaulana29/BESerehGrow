<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AnalisisLahan;

class AnalisisLahanController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'luas_lahan' => 'required|numeric',
            'jumlah_blok' => 'required|integer',
            'luas_blok' => 'required|numeric',
            'jumlah_rumpun' => 'required|integer',
            'produksi_daun' => 'required|numeric',
            'sesi_panen' => 'required|integer',
            'kapasitas_penyulingan' => 'required|numeric',
            'sesi_penyulingan' => 'required|integer',
            'hasil_minyak' => 'required|numeric',
        ]);

        // Simpan data ke database
        AnalisisLahan::create($validatedData);

        return response()->json(['message' => 'Data berhasil disimpan'], 201);
    }
}
