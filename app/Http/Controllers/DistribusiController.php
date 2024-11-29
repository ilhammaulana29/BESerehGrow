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
    public function getDistributWithPengemasan(Request $request)
    {
        try {
            // Ambil parameter filter dari request
            $statusPengiriman = $request->query('status_pengiriman');

            // Join tabel Distribusi dan Pengemasan
            $query = Distribusi::join('pm_pengemasan', 'pm_distribusi.id_pengemasan', '=', 'pm_pengemasan.id_pengemasan')
                ->select(
                    'pm_Distribusi.id_distribusi',
                    'pm_distribusi.tujuan_distribusi',
                    'pm_distribusi.jumlah_dikirim',
                    'pm_distribusi.tgl_pengiriman',
                    'pm_distribusi.status_pengiriman',
                    'pm_pengemasan.jenis_kemasan',
                    'pm_pengemasan.kode_kemasan',
                    'pm_pengemasan.kapasitas_kemasan',
                    'pm_pengemasan.jumlah_kemasan',
                    'pm_pengemasan.tgl_pengemasan',
                    'pm_pengemasan.status_pengemasan'
                );

            // Terapkan filter jika parameter tersedia
            if ($statusPengiriman) {
                $query->where('pm_distribusi.status_pengiriman', $statusPengiriman);
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
    public function getDelivery($id_distribusi)
    {
        try {
            // Temukan data distribusi berdasarkan ID
            $distribusi = Distribusi::findOrFail($id_distribusi);
            
            $distribusi->status_pengiriman = 'Dikirim';
            $distribusi->save();
            
            // Kembalikan respons berhasil
            return response()->json([
                'message' => 'Status Pengiriman berhasil diperbarui menjadi "Dikirim"',
                'data' => $distribusi
            ], 200);
            
        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan respons dengan status 500
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui status distribusi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getFinish($id_distribusi)
    {
        try {
            // Temukan data distribusi berdasarkan ID
            $distribusi = Distribusi::findOrFail($id_distribusi);
            
            $distribusi->status_pengiriman = 'Selesai';
            $distribusi->save();
            
            // Kembalikan respons berhasil
            return response()->json([
                'message' => 'Status Pengiriman berhasil diperbarui menjadi "Selesai"',
                'data' => $distribusi
            ], 200);
            
        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan respons dengan status 500
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui status distribusi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
