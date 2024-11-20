<?php

namespace App\Http\Controllers;

use App\Models\Pinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PinjamanAnggotaController extends Controller
{
    public function show($id_anggota)
    {
        $pinjaman = Pinjaman::where('id_anggota', $id_anggota)->first();
        return response()->json($pinjaman);
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'id_anggota' => 'required|exists:pc_anggota_koperasi,id_anggota',
            'tgl_pinjam' => 'required|date',
            'besar_pinjam' => 'required|numeric',
            'bunga_berjalan' => 'required|numeric',
            'sesi_angsuran' => 'required|numeric',
            'keterangan_pinjaman' => 'nullable|string',
            'status_pinjam' => 'required|string',
        ]);

        $pinjaman = Pinjaman::create($validated);

        return response()->json([
            'message' => 'Pinjaman berhasil dibuat',
            'data' => $pinjaman
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan saat membuat pinjaman',
            'error' => $e->getMessage()
        ], 500);
    }
}
public function getPinjamanByAnggota($id_anggota)
    {
        try {
            // Melakukan join antara tabel pc_anggota_koperasi dan pc_pinjaman
            $result = DB::table('pc_anggota_koperasi')
                ->join('pc_pinjaman', 'pc_anggota_koperasi.id_anggota', '=', 'pc_pinjaman.id_anggota')
                ->select(
                    'pc_anggota_koperasi.nama_anggota',
                    'pc_anggota_koperasi.id_statusanggota as status',
                    'pc_pinjaman.tgl_pinjam',
                    'pc_pinjaman.besar_pinjam',
                    'pc_pinjaman.bunga_berjalan',
                    'pc_pinjaman.sesi_angsuran',
                    'pc_pinjaman.keterangan_pinjaman',
                    'pc_pinjaman.status_pinjam'
                )
                ->where('pc_anggota_koperasi.id_anggota', $id_anggota)
                ->get();

            // Memastikan data ditemukan
            if ($result->isEmpty()) {
                return response()->json([
                    'message' => 'Tidak ada data pinjaman untuk anggota ini'
                ], 404);
            }

            return response()->json($result);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
