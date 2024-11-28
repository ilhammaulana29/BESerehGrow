<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    // Fungsi Index: Mengambil semua data stok
    public function index()
    {
        $data = Stok::all(); // Ambil semua data tanpa pengurutan
        return response()->json($data); 
    }

    // Fungsi Store: Menyimpan data stok baru
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'id_pengemasan' => 'required|exists:pm_pengemasan,id_pengemasan', // Validasi foreign key
                'jumlah_tersedia' => 'required|numeric|min:0',
                'lokasi_gudang' => 'required|string|max:255',
                'status_stok' => 'required|string|in:Tersedia,Keluar',
            ]);

            // Simpan data ke tabel `pm_stok`
            $stok = Stok::create($validatedData);

            return response()->json([
                'message' => 'Data stok berhasil disimpan.',
                'data' => $stok,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menyimpan data stok.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Fungsi Update: Memperbarui data stok berdasarkan ID
    public function update(Request $request, $id_stok)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'id_pengemasan' => 'nullable|exists:pm_pengemasan,id_pengemasan', // Foreign key opsional
                'jumlah_tersedia' => 'nullable|numeric|min:0',
                'lokasi_gudang' => 'nullable|string|max:255',
                'status_stok' => 'nullable|string|in:Tersedia,Keluar',
            ]);

            // Cari data stok berdasarkan ID
            $stok = Stok::findOrFail($id_stok);

            // Update data stok
            $stok->update($validatedData);

            return response()->json([
                'message' => 'Data stok berhasil diperbarui.',
                'data' => $stok,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal memperbarui data stok.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Fungsi Destroy: Menghapus data stok berdasarkan ID
    public function destroy($id_stok)
    {
        try {
            // Cari data stok berdasarkan ID
            $stok = Stok::findOrFail($id_stok);

            // Hapus data stok
            $stok->delete();

            return response()->json([
                'message' => 'Data stok berhasil dihapus.',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal menghapus data stok.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
