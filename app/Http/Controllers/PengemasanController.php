<?php

namespace App\Http\Controllers;
use App\Models\Pengemasan;

use Illuminate\Http\Request;

class PengemasanController extends Controller
{
    public function index()
    {
        $data = Pengemasan::all(); // Ambil semua data tanpa pengurutan
        return response()->json($data); // Kembalikan data sebagai JSON
    }
    public function store(Request $request)
    {
        try {
            // Validasi input
            $validatedData = $request->validate([
                'id_pengujian' => 'required|exists:pm_pengujian,id_pengujian', // Validasi foreign key
                'jenis_kemasan' => 'required|string|max:255',
                'kode_kemasan' => 'required|string|max:255|unique:pm_pengemasan,kode_kemasan',
                'kapasitas_kemasan' => 'required|numeric|min:0',
                'jumlah_kemasan' => 'required|integer|min:0',
                'tgl_pengemasan' => 'required|date',
                'status_pengemasan' => 'required|string|max:255',
            ]);

            // Simpan data ke tabel `pm_pengemasan`
            $pengemasan = Pengemasan::create([
                'id_pengujian' => $validatedData['id_pengujian'],
                'jenis_kemasan' => $validatedData['jenis_kemasan'],
                'kode_kemasan' => $validatedData['kode_kemasan'],
                'kapasitas_kemasan' => $validatedData['kapasitas_kemasan'],
                'jumlah_kemasan' => $validatedData['jumlah_kemasan'],
                'tgl_pengemasan' => $validatedData['tgl_pengemasan'],
                'status_pengemasan' => $validatedData['status_pengemasan'],
            ]);

            // Kembalikan response sukses
            return response()->json([
                'message' => 'Data pengemasan berhasil disimpan.',
                'data' => $pengemasan,
            ], 201);

        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data pengemasan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id_pengemasan)
    {
        try {
            // Cari data pengemasan berdasarkan ID
            $pengemasan = Pengemasan::findOrFail($id_pengemasan);

            // Validasi input
            $validatedData = $request->validate([
                'id_pengujian' => 'nullable|exists:pm_pengujian,id_pengujian', // Opsional, validasi foreign key
                'jenis_kemasan' => 'nullable|string|max:255',
                'kode_kemasan' => 'nullable|string|max:255|unique:pm_pengemasan,kode_kemasan,' . $id_pengemasan . ',id_pengemasan',
                'kapasitas_kemasan' => 'nullable|numeric|min:0',
                'jumlah_kemasan' => 'nullable|integer|min:0',
                'tgl_pengemasan' => 'nullable|date',
                'status_pengemasan' => 'nullable|string|max:255',
            ]);

            // Update data yang valid
            $pengemasan->update($validatedData);

            // Kembalikan response sukses
            return response()->json([
                'message' => 'Data pengemasan berhasil diperbarui.',
                'data' => $pengemasan,
            ], 200);

        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui data pengemasan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function destroy($id_pengemasan)
    {
        try {
            // Cari data pengemasan berdasarkan ID
            $pengemasan = Pengemasan::findOrFail($id_pengemasan);

            // Hapus data
            $pengemasan->delete();

            // Kembalikan response sukses
            return response()->json([
                'message' => 'Data pengemasan berhasil dihapus.',
            ], 200);

        } catch (\Exception $e) {
            // Tangani kesalahan
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data pengemasan.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    public function getAllKodeKemasan()
    {
        try {
            // Mengambil semua data dari tabel `Pengujian`
            $data = Pengemasan::all(['id_pengemasan', 'kode_kemasan']);
            
            // Tambahkan data tambahan jika diperlukan
            $additionalData = [
                // Masukkan data tambahan jika ada
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
    public function tableFilter(Request $request)
    {
        // Ambil filter status_pengemasan dari query string
        $status = $request->query('status_pengemasan');

        // Buat query
        $query = Pengemasan::query();

        // Jika filter status ada, tambahkan kondisi
        if ($status) {
            $query->where('status_pengemasan', $status);
        }

        // Ambil data
        $data = $query->get();

        // Return response
        return response()->json($data);
    }
    public function getSetorkan($id_pengemasan)
    {
        try {
            // Temukan data pengemasan berdasarkan ID
            $pengemasan = Pengemasan::findOrFail($id_pengemasan);
            
            $pengemasan->status_pengemasan = 'Tersedia';
            $pengemasan->save();
            
            // Kembalikan respons berhasil
            return response()->json([
                'message' => 'Status pengemasan berhasil diperbarui menjadi "Tersedia"',
                'data' => $pengemasan
            ], 200);
            
        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan respons dengan status 500
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui status pengemasan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getJualkan($id_pengemasan)
    {
        try {
            // Temukan data pengemasan berdasarkan ID
            $pengemasan = Pengemasan::findOrFail($id_pengemasan);
            
            $pengemasan->status_pengemasan = 'Terjual';
            $pengemasan->save();
            
            // Kembalikan respons berhasil
            return response()->json([
                'message' => 'Status pengemasan berhasil diperbarui menjadi "Tersedia"',
                'data' => $pengemasan
            ], 200);
            
        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan respons dengan status 500
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui status pengemasan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function countPengemasan()
    {
        try {
            // Hitung jumlah data Pengemasan yang ada
            $countPengemasan = Pengemasan::count();

            return response()->json([
                'success' => true,
                'count' => $countPengemasan,
                'message' => 'Jumlah data Pengemasan berhasil dihitung'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan dalam menghitung jumlah data Pengemasan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function countByStatusDalamProses()
    {
        try {
            // Menghitung jumlah data dengan status "Siap Setor"
            $jumlah = Pengemasan::where('status_pengemasan', 'Dalam Proses')  // Memfilter berdasarkan status "Masuk Gudang"
                ->count();  // Menghitung jumlah data yang sesuai

            // Mengembalikan respons dalam format JSON
            return response()->json([
                'message' => 'Jumlah data pengemasan dengan status Dalam Proses berhasil diambil',
                'data' => [
                    'Dalam Proses' => $jumlah  // Mengirim jumlah data dalam format key-value
                ]
            ], 200);
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            return response()->json([
                'message' => 'Gagal mengambil data pengemasan dengan status Dalam Proses',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function countByStatusTersedia()
    {
        try {
            // Menghitung jumlah data dengan status "Siap Setor"
            $jumlah = Pengemasan::where('status_pengemasan', 'Tersedia')  // Memfilter berdasarkan status "Masuk Gudang"
                ->count();  // Menghitung jumlah data yang sesuai

            // Mengembalikan respons dalam format JSON
            return response()->json([
                'message' => 'Jumlah data pengemasan dengan status Tersedia berhasil diambil',
                'data' => [
                    'Tersedia' => $jumlah  // Mengirim jumlah data dalam format key-value
                ]
            ], 200);
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            return response()->json([
                'message' => 'Gagal mengambil data pengemasan dengan status Tersedia',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function countByStatusTerjual()
    {
        try {
            // Menghitung jumlah data dengan status "Siap Setor"
            $jumlah = Pengemasan::where('status_pengemasan', 'Terjual')  // Memfilter berdasarkan status "Masuk Gudang"
                ->count();  // Menghitung jumlah data yang sesuai

            // Mengembalikan respons dalam format JSON
            return response()->json([
                'message' => 'Jumlah data pengemasan dengan status Terjual berhasil diambil',
                'data' => [
                    'Terjual' => $jumlah  // Mengirim jumlah data dalam format key-value
                ]
            ], 200);
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            return response()->json([
                'message' => 'Gagal mengambil data pengemasan dengan status Terjual',
                'error' => $e->getMessage()
            ], 500);
        }
    }



}
