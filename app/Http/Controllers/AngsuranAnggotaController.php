<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Angsuran;

class AngsuranAnggotaController extends Controller
{
    public function getAngsuranByIdPinjaman($id_pinjaman)
    {
        // Mengambil data berdasarkan id_pinjaman
        $angsuran = Angsuran::where('id_pinjaman', $id_pinjaman)->get();

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
}
