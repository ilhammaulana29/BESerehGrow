<?php

namespace App\Http\Controllers;

use App\Models\Distribusi;
use Illuminate\Http\Request;

class DistribusiController extends Controller
{
    // Fungsi Index: Mengambil semua data distribusi
    public function index()
    {
        $data = Distribusi::all(); // Ambil semua data tanpa pengurutan
        return response()->json($data);
    }

    // Fungsi Store: Menyimpan data distribusi baru
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'id_pengemasan' => 'required|exists:pm_pengemasan,id_pengemasan', // Validasi foreign key
                'tujuan_distribusi' => 'required|string|max:255',
                'jumlah_dikirim' => 'required|integer|min:0',
                'tgl_pengiriman' => 'required|date',
                'status_pengiriman' => 'required|string', // Contoh status
            ]);

            // Simpan data ke tabel `pm_distribusi`
            $distribusi = Distribusi::create($validatedData);

            return response()->json([
                'message' => 'Data distribusi berhasil disimpan.',
                'data' => $distribusi,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menyimpan data distribusi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Fungsi Update: Memperbarui data distribusi berdasarkan ID
    public function update(Request $request, $id_distribusi)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'id_pengemasan' => 'nullable|exists:pm_pengemasan,id_pengemasan', // Opsional
                'tujuan_distribusi' => 'nullable|string|max:255',
                'jumlah_dikirim' => 'nullable|integer|min:0',
                'tgl_pengiriman' => 'nullable|date',
                'status_pengiriman' => 'nullable|string', // Contoh status
            ]);

            // Cari data distribusi berdasarkan ID
            $distribusi = Distribusi::findOrFail($id_distribusi);

            // Update data distribusi
            $distribusi->update($validatedData);

            return response()->json([
                'message' => 'Data distribusi berhasil diperbarui.',
                'data' => $distribusi,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui data distribusi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Fungsi Delete: Menghapus data distribusi berdasarkan ID
    public function destroy($id_distribusi)
    {
        try {
            // Cari data distribusi berdasarkan ID
            $distribusi = Distribusi::findOrFail($id_distribusi);

            // Hapus data distribusi
            $distribusi->delete();

            return response()->json([
                'message' => 'Data distribusi berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus data distribusi.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
