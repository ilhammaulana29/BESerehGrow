<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggotakoperasi;
class PendaftaranAnggotaKoperasiController extends Controller
{
    public function index()
    {
        $anggota = Anggotakoperasi::all();
        return response()->json([
            'success' => true,
            'data' => $anggota,
        ], 200);
    }
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
    public function update(Request $request, $id_anggota)
    {
        try {
            $anggota = Anggotakoperasi::findOrFail($id_anggota);

            $anggota->update([
                'nama_anggota' => $request->nama_anggota,
                'tgl_bergabung' => $request->tgl_bergabung,
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'no_hp' => $request->no_hp,
                'tgl_lahir' => $request->tgl_lahir,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data anggota berhasil diperbarui',
                'data' => $anggota,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy($id_anggota)
    {
        try {
            $anggota = Anggotakoperasi::findOrFail($id_anggota);

            $anggota->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data anggota berhasil dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function getByMemberId($id_anggota)
    {
        try {
            // Query ke tabel `pm` berdasarkan `id_anggota`
            $data = Anggotakoperasi::where('id_anggota', $id_anggota)->get();
    
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
    public function getNamaAnggota()
    {
        try {
            $anggotaKoperasi = Anggotakoperasi::select('id_anggota', 'nama_anggota')->get();
            return response()->json($anggotaKoperasi, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch data', 'error' => $e->getMessage()], 500);
        }
    }
}
