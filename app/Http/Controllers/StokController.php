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
    public function tableStokFilter(Request $request)
    {
        // Ambil filter status_stok dari query string
        $statusstok = $request->query('status_stok');

        // Buat query
        $query = Stok::query();

        // Jika filter status ada, tambahkan kondisi
        if ($statusstok) {
            $query->where('status_stok', $statusstok);
        }

        // Ambil data
        $data = $query->get();

        // Return response
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
    public function getStokWithPengemasan(Request $request)
    {
        try {
            // Ambil parameter filter dari request
            $statusStok = $request->query('status_stok');

            // Join tabel Stok dan Pengemasan
            $query = Stok::join('pm_pengemasan', 'pm_stok.id_pengemasan', '=', 'pm_pengemasan.id_pengemasan')
                ->select(
                    'pm_stok.id_stok',
                    'pm_stok.jumlah_tersedia',
                    'pm_stok.lokasi_gudang',
                    'pm_stok.status_stok',
                    'pm_pengemasan.jenis_kemasan',
                    'pm_pengemasan.kode_kemasan',
                    'pm_pengemasan.kapasitas_kemasan',
                    'pm_pengemasan.jumlah_kemasan',
                    'pm_pengemasan.tgl_pengemasan',
                    'pm_pengemasan.status_pengemasan'
                );

            // Terapkan filter jika parameter tersedia
            if ($statusStok) {
                $query->where('pm_stok.status_stok', $statusStok);
            }
            // Ambil hasil query
            $data = $query->get();

            // Return hasil dalam bentuk JSON
            return response()->json([
                'status' => 'success',
                'data' => $data,
            ], 200);
        } catch (\Exception $e) {
            // Handle jika ada error
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
    public function getKeluarkan($id_stok)
    {
        try {
            // Temukan data stok berdasarkan ID
            $stok = Stok::findOrFail($id_stok);
            
            $stok->status_stok = 'Keluar';
            $stok->save();
            
            // Kembalikan respons berhasil
            return response()->json([
                'message' => 'Status stok berhasil diperbarui menjadi "Keluar"',
                'data' => $stok
            ], 200);
            
        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan respons dengan status 500
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui status stok',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
