<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Angsuran;
use Illuminate\Support\Facades\DB; 


class AngsuranAnggotaController extends Controller
{
    public function getAngsuranByIdPinjaman($id_pinjaman)
    {
        // Mengambil data berdasarkan id_pinjaman
        $angsuran = Angsuran::where('id_pinjaman', $id_pinjaman)
        ->orderBy('bulan_angsur', 'asc') // Urutkan berdasarkan kolom bulan_angsur secara ascending
        ->get();

        // Periksa apakah data ditemukan
        if ($angsuran->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data angsuran tidak ditemukan untuk id_pinjaman: ' . $id_pinjaman
            ], 404);
        }

        // Mengembalikan data dalam bentuk JSON
        return response()->json([
            'success' => true,
            'message' => 'Data angsuran ditemukan',
            'data' => $angsuran
        ], 200);
    }
    public function bayarAngsuran(Request $request, $id_angsuran)
    {
        // Validasi data yang diterima
        $validatedData = $request->validate([
            'tgl_angsur' => 'required|date',
            'besar_angsuran' => 'required|numeric',
            'keterangan' => 'required|string',
            'status_angsuran' => 'required|string',
        ]);

        // Cari angsuran berdasarkan id_angsuran
        $angsuran = Angsuran::find($id_angsuran);

        // Periksa apakah data ditemukan
        if (!$angsuran) {
            return response()->json([
                'success' => false,
                'message' => 'Data angsuran tidak ditemukan untuk id_angsuran: ' . $id_angsuran,
            ], 404);
        }

        // Update data angsuran
        $angsuran->update([
            'tgl_angsur' => $validatedData['tgl_angsur'],
            'besar_angsuran' => $validatedData['besar_angsuran'],
            'keterangan' => $validatedData['keterangan'],
            'status_angsuran' => $validatedData['status_angsuran'],
        ]);

        // Kembalikan respons sukses
        return response()->json([
            'success' => true,
            'message' => 'Angsuran berhasil diperbarui',
            'data' => $angsuran,
        ], 200);
    }
    public function getTotalAngsuranByIdPinjaman($id_pinjaman)
    {
        $totalAngsuran = DB::table('pc_angsuran')
            ->where('id_pinjaman', $id_pinjaman)
            ->sum('besar_angsuran');
        return response()->json([
            'success' => true,
            'message' => 'Total angsuran berhasil dihitung',
            'data' => [
                'id_pinjaman' => $id_pinjaman,
                'total_angsuran' => $totalAngsuran
            ]
        ], 200);
    }


}
