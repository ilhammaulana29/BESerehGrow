<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Statuskeanggotaan;

class StatuskeanggotaanController extends Controller
{
    public function index()
    {
        $statusKeanggotaan = Statuskeanggotaan::all();
        return response()->json([
            'success' => true,
            'data' => $statusKeanggotaan,
        ], 200);
    }
    public function store(Request $request)
    {
        // Validasi data yang diterima dari request
        $request->validate([
            'minimal_keanggotaan' => 'required|integer|min:1', // Contoh validasi angka
            'status' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        // Buat dan simpan data baru ke tabel pc_status_keanggotaan
        $statusKeanggotaan = Statuskeanggotaan::create([
            'minimal_keanggotaan' => $request->minimal_keanggotaan,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
        ]);

        // Mengembalikan respons sukses atau data yang telah disimpan
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil ditambahkan',
            'data' => $statusKeanggotaan,
        ], 201);
    }
    public function update(Request $request, $id_statusanggota)
    {
        $request->validate([
            'minimal_keanggotaan' => 'required|integer|min:1',
            'status' => 'required|string|max:255',
            'deskripsi' => 'nullable|string|max:500',
        ]);

        $statusKeanggotaan = Statuskeanggotaan::find($id_statusanggota);

        if (!$statusKeanggotaan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $statusKeanggotaan->update([
            'minimal_keanggotaan' => $request->minimal_keanggotaan,
            'status' => $request->status,
            'deskripsi' => $request->deskripsi,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $statusKeanggotaan,
        ], 200);
    }
    public function destroy($id_statusanggota)
    {
        $statusKeanggotaan = Statuskeanggotaan::find($id_statusanggota);

        if (!$statusKeanggotaan) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $statusKeanggotaan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus',
        ], 200);
    }
    public function getStatusAnggota()
    {
        try {
            $statusAnggota = Statuskeanggotaan::select('id_statusanggota', 'status')->get();
            return response()->json($statusAnggota, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch data', 'error' => $e->getMessage()], 500);
        }
    }
}
