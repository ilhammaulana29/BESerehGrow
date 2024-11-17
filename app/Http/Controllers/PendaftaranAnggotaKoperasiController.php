<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggotakoperasi;
class PendaftaranAnggotaKoperasiController extends Controller
{
    public function store(Request $request)
    {
        try {
            $anggota = Anggotakoperasi::create([
                'nama_anggota' => $request->nama_anggota,
                'tgl_bergabung' => $request->tgl_bergabung,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'no_hp' => $request->no_hp,
                'tgl_lahir' => $request->tgl_lahir,
            ]);
    
            return response()->json(['id_anggota' => $anggota->id_anggota], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menyimpan data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
