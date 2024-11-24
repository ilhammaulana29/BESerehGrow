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
    public function update(Request $request, $id_anggota)
    {
        try {
            // Validasi input
            $validated = $request->validate([
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

            // Periksa apakah alamat dengan id_anggota tersebut ada
            $alamat = Alamatanggota::where('id_anggota', $id_anggota)->first();

            if (!$alamat) {
                return response()->json(['message' => 'Alamat tidak ditemukan'], 404);
            }

            // Update data alamat
            $alamat->update([
                'jalan' => $validated['jalan'],
                'desa' => $validated['desa'],
                'kecamatan' => $validated['kecamatan'],
                'kabupaten' => $validated['kabupaten'],
                'provinsi' => $validated['provinsi'],
                'kode_pos' => $validated['kode_pos'],
                'no_rumah' => $validated['no_rumah'],
                'rt' => $validated['rt'],
                'rw' => $validated['rw'],
                'updated_at' => now(),
            ]);

            return response()->json(['message' => 'Alamat berhasil diperbarui'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan dalam memperbarui data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getAlamatByMemberId($id_anggota)
    {
        try {
            // Query ke tabel `pm` berdasarkan `id_anggota`
            $data = Alamatanggota::where('id_anggota', $id_anggota)->get();
    
            // Jika ada data tambahan terkait, tambahkan di sini
            $additionalData = [
                // Masukkan data tambahan yang dibutuhkan, misalnya metadata Member
            ];
    
            return response()->json([
                'data' => $data,
                'additionalData' => $additionalData,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan dalam mengambil data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
