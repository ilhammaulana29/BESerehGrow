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
        DB::beginTransaction(); // Memulai transaksi database
        try {
            // Validasi input
            $validated = $request->validate([
                'id_anggota' => 'required|exists:pc_anggota_koperasi,id_anggota',
                'tgl_pinjam' => 'required|date',
                'besar_pinjam' => 'required|numeric',
                'bunga_berjalan' => 'required|numeric',
                'sesi_angsuran' => 'required|numeric',
                'keterangan_pinjaman' => 'nullable|string',
                'status_pinjam' => 'required|string',
            ]);

            // Membuat data pinjaman
            $pinjaman = Pinjaman::create($validated);

            // Mengisi data angsuran berdasarkan sesi_angsuran
            $angsuranData = [];
            for ($i = 1; $i <= $validated['sesi_angsuran']; $i++) {
                $angsuranData[] = [
                    'id_pinjaman' => $pinjaman->id_pinjaman,
                    'bulan_angsur' => $i,
                    'tgl_angsur' => null, // Diisi null
                    'besar_angsuran' => null, // Diisi null
                    'status_angsuran' => "belum bayar", // Diisi null
                    'keterangan' => null, // Diisi null
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            // Masukkan data angsuran ke tabel pc_angsuran
            DB::table('pc_angsuran')->insert($angsuranData);

            DB::commit(); // Commit transaksi jika berhasil

            return response()->json([
                'message' => 'Pinjaman dan angsuran berhasil dibuat',
                'data' => $pinjaman,
            ]);
        } catch (\Throwable $e) {
            DB::rollBack(); // Rollback transaksi jika terjadi error
            return response()->json([
                'message' => 'Terjadi kesalahan saat membuat pinjaman',
                'error' => $e->getMessage(),
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
                    'pc_pinjaman.id_pinjaman',
                    'pc_anggota_koperasi.id_anggota',
                    'pc_anggota_koperasi.nama_anggota',
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
    public function getAllPinjaman()
    {
        try {
            // Melakukan join antara tabel pc_anggota_koperasi dan pc_pinjaman
            $result = DB::table('pc_anggota_koperasi')
                ->join('pc_pinjaman', 'pc_anggota_koperasi.id_anggota', '=', 'pc_pinjaman.id_anggota')
                ->join('pc_status_keanggotaan', 'pc_anggota_koperasi.id_statusanggota', '=', 'pc_status_keanggotaan.id_statusanggota')
                ->select(
                    'pc_pinjaman.id_pinjaman',
                    'pc_anggota_koperasi.nama_anggota',
                    'pc_anggota_koperasi.id_anggota',
                    'pc_status_keanggotaan.status',
                    'pc_pinjaman.tgl_pinjam',
                    'pc_pinjaman.besar_pinjam',
                    'pc_pinjaman.bunga_berjalan',
                    'pc_pinjaman.sesi_angsuran',
                    'pc_pinjaman.keterangan_pinjaman',
                    'pc_pinjaman.status_pinjam'
                )
                ->get();

            // Memastikan data ditemukan
            if ($result->isEmpty()) {
                return response()->json([
                    'message' => 'Tidak ada data pinjaman'
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
    public function update(Request $request, $id_pinjaman)
    {
        try {
            $validated = $request->validate([
                'id_anggota' => 'sometimes|exists:pc_anggota_koperasi,id_anggota',
                'tgl_pinjam' => 'sometimes|date',
                'besar_pinjam' => 'sometimes|numeric',
                'bunga_berjalan' => 'sometimes|numeric',
                'sesi_angsuran' => 'sometimes|numeric',
                'keterangan_pinjaman' => 'nullable|string',
                'status_pinjam' => 'sometimes|string',
            ]);

            $pinjaman = Pinjaman::findOrFail($id_pinjaman); // Cari data pinjaman berdasarkan ID
            $pinjaman->update($validated); // Perbarui data

            return response()->json([
                'message' => 'Pinjaman berhasil diperbarui',
                'data' => $pinjaman
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui pinjaman',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id_pinjaman)
    {
        try {
            $pinjaman = Pinjaman::findOrFail($id_pinjaman); // Cari data pinjaman berdasarkan ID
            $pinjaman->delete(); // Hapus data

            return response()->json([
                'message' => 'Pinjaman berhasil dihapus'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus pinjaman',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}
