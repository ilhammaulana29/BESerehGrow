<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alamatanggota;
use Illuminate\Support\Facades\DB;

class PendaftaranAlamatAnggotaKoperasiController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input (jika belum dilakukan di controller utama)
        $validated = $request->validate([
            'id_anggota' => 'required|exists:pc_anggota_koperasi,id_anggota',
            'jalan' => 'required|string|max:255',
            'desa' => 'required|string|max:255',
            'kecamatan' => 'required|string|max:255',
            'kabupaten' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'kode_pos' => 'required|string|max:10',
            'no_rumah' => 'nullable|string|max:10',
            'rt' => 'nullable|string|max:5',
            'rw' => 'nullable|string|max:5',
        ]);

        // Simpan data ke tabel pc_alamat_anggota
        $alamat = DB::table('pc_alamat_anggota')->insert([
            'id_anggota' => $validated['id_anggota'],
            'jalan' => $validated['jalan'],
            'desa' => $validated['desa'],
            'kecamatan' => $validated['kecamatan'],
            'kabupaten' => $validated['kabupaten'],
            'provinsi' => $validated['provinsi'],
            'kode_pos' => $validated['kode_pos'],
            'no_rumah' => $validated['no_rumah'],
            'rt' => $validated['rt'],
            'rw' => $validated['rw'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return response()->json(['message' => 'Alamat berhasil disimpan'], 201);
    }
}
