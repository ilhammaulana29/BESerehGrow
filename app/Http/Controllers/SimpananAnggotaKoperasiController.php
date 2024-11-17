<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Simpanan;
use Illuminate\Support\Facades\DB;

class SimpananAnggotaKoperasiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input (jika belum dilakukan di controller utama)
        $validated = $request->validate([
            'id_anggota' => 'required|exists:pc_anggota_koperasi,id_anggota',
            'id_jenissimpanan' => 'required|exists:pc_jenis_simpanan,id_jenissimpanan',
            'tgl_simpan' => 'required|date',
            'jml_simpanan' => 'required|numeric',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Simpan data ke tabel pc_simpanan
        $simpanan = DB::table('pc_simpanan')->insert([
            'id_anggota' => $validated['id_anggota'],
            'id_jenissimpanan' => $validated['id_jenissimpanan'],
            'tgl_simpan' => $validated['tgl_simpan'],
            'jml_simpanan' => $validated['jml_simpanan'],
            'keterangan' => $validated['keterangan'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    return response()->json(['message' => 'Simpanan berhasil disimpan'], 201);
}

}
