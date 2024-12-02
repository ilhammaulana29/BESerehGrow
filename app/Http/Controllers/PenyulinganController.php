<?php

namespace App\Http\Controllers;

use App\Models\Penyulingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PenyulinganController extends Controller
{
    public function index()
    {
        $data = Penyulingan::all(); // Ambil semua data dari model
        return response()->json($data); // Kembalikan data sebagai JSON
    }
    public function getByStatus($status)
    {
        try {
            // Ambil data penyulingan berdasarkan kolom status
            $data = Penyulingan::where('status', $status)->get();

            // Kembalikan respons data yang ditemukan
            return response()->json([
                'message' => 'Data penyulingan berdasarkan status berhasil diambil',
                'data' => $data
            ], 200);

        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan respons dengan status 500
            return response()->json([
                'message' => 'Terjadi kesalahan saat mengambil data penyulingan berdasarkan status',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'no_batch_penyulingan' => 'required|string',
            'tgl_penyulingan' => 'required|date',
            'berat_daun' => 'required|numeric',
            'waktu_penyulingan' => 'required|numeric',
            'banyak_minyak' => 'required|numeric',
            'bahan_bakar' => 'required|string',
            'suhu_pembakaran' => 'required|numeric',
            'air_rebusan' => 'required|numeric',
            'penyebaran_asap' => 'required|string',
            'status'=>'required|string'
        ]);

        try {
            // Buat instance model dan simpan data
            $penyulingan = new Penyulingan();
            $penyulingan->no_batch_penyulingan = $request->no_batch_penyulingan;
            $penyulingan->tgl_penyulingan = $request->tgl_penyulingan;
            $penyulingan->berat_daun = $request->berat_daun;
            $penyulingan->waktu_penyulingan = $request->waktu_penyulingan;
            $penyulingan->banyak_minyak = $request->banyak_minyak;
            $penyulingan->bahan_bakar = $request->bahan_bakar;
            $penyulingan->suhu_pembakaran = $request->suhu_pembakaran;
            $penyulingan->air_rebusan = $request->air_rebusan;
            $penyulingan->penyebaran_asap = $request->penyebaran_asap;
            $penyulingan->status = $request->status;
            $penyulingan->save();

            // Kembalikan respons berhasil
            return response()->json([
                'message' => 'Data penyulingan berhasil disimpan',
                'data' => $penyulingan
            ], 201);

        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan respons dengan status 500
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan data penyulingan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request, $id_penyulingan)
    {
        // Validasi data yang masuk
        $request->validate([
            'no_batch_penyulingan' => 'required|string',
            'tgl_penyulingan' => 'required|date',
            'berat_daun' => 'required|numeric',
            'waktu_penyulingan' => 'required|numeric',
            'banyak_minyak' => 'required|numeric',
            'bahan_bakar' => 'required|string',
            'suhu_pembakaran' => 'required|numeric',
            'air_rebusan' => 'required|numeric',
            'penyebaran_asap' => 'required|string',
            'status'=>'required|string'
        ]);

        try {
            // Temukan data penyulingan berdasarkan ID
            $penyulingan = Penyulingan::findOrFail($id_penyulingan);

            // Perbarui data penyulingan
            $penyulingan->no_batch_penyulingan = $request->no_batch_penyulingan;
            $penyulingan->tgl_penyulingan = $request->tgl_penyulingan;
            $penyulingan->berat_daun = $request->berat_daun;
            $penyulingan->waktu_penyulingan = $request->waktu_penyulingan;
            $penyulingan->banyak_minyak = $request->banyak_minyak;
            $penyulingan->bahan_bakar = $request->bahan_bakar;
            $penyulingan->suhu_pembakaran = $request->suhu_pembakaran;
            $penyulingan->air_rebusan = $request->air_rebusan;
            $penyulingan->penyebaran_asap = $request->penyebaran_asap;
            $penyulingan->status = $request->status;
            $penyulingan->save();

            // Kembalikan respons berhasil
            return response()->json([
                'message' => 'Data penyulingan berhasil diperbarui',
                'data' => $penyulingan
            ], 200);

        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan respons dengan status 500
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui data penyulingan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function destroy($id_penyulingan)
    {
        try {
            // Temukan data penyulingan berdasarkan ID
            $penyulingan = Penyulingan::findOrFail($id_penyulingan);
            
            // Hapus data penyulingan
            $penyulingan->delete();
            
            // Kembalikan respons berhasil
            return response()->json([
                'message' => 'Data penyulingan berhasil dihapus'
            ], 200);

        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan respons dengan status 500
            return response()->json([
                'message' => 'Terjadi kesalahan saat menghapus data penyulingan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function updateStatus($id_penyulingan)
    {
        try {
            // Temukan data penyulingan berdasarkan ID
            $penyulingan = Penyulingan::findOrFail($id_penyulingan);
            
            // Ubah kolom status menjadi 'Masuk Gudang'
            $penyulingan->status = 'Masuk Gudang';
            $penyulingan->save();
            
            // Kembalikan respons berhasil
            return response()->json([
                'message' => 'Status penyulingan berhasil diperbarui menjadi "Masuk Gudang"',
                'data' => $penyulingan
            ], 200);
            
        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan respons dengan status 500
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui status penyulingan',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getMasukGudang($status)
    {
        // Mengambil data penyulingan yang statusnya 'Masuk Gudang'
        $penyulingan = Penyulingan::where('status', $status)
        ->get(['id_penyulingan', 'no_batch_penyulingan']); // Kolom yang diperlukan saja

    return response()->json($penyulingan);
    }
    public function getByPenyulinganId($id_penyulingan)
    {
        try {
            // Query ke tabel `pm` berdasarkan `id_penyulingan`
            $data = Penyulingan::where('id_penyulingan', $id_penyulingan)->get();
    
            // Jika ada data tambahan terkait, tambahkan di sini
            $additionalData = [
                // Masukkan data tambahan yang dibutuhkan, misalnya metadata penyulingan
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
    public function getByPenyulinganBatchId($id_penyulingan)
    {
        try {
            // Ambil data penyulingan berdasarkan id_penyulingan
            $data = Penyulingan::where('id_penyulingan', $id_penyulingan)->first();

            // Periksa apakah data ditemukan
            if (!$data) {
                return response()->json([
                    'message' => 'Penyulingan tidak ditemukan.',
                    'data' => null
                ], 404);
            }

            // Kembalikan respons dengan data
            return response()->json([
                'message' => 'Data penyulingan berhasil diambil.',
                'data' => $data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Terjadi kesalahan dalam mengambil data.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getCountPenyulingan()
    {
        try {
            // Hitung jumlah data Pengemasan yang ada
            $countPenyulingan = Penyulingan::count();

            return response()->json([
                'success' => true,
                'count' => $countPenyulingan,
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
    public function countByStatusSiapSetor()
    {
        try {
            // Menghitung jumlah data dengan status "Siap Setor"
            $jumlah = Penyulingan::where('status', 'Siap Setor')  // Memfilter berdasarkan status "Siap Setor"
                ->count();  // Menghitung jumlah data yang sesuai

            // Mengembalikan respons dalam format JSON
            return response()->json([
                'message' => 'Jumlah data penyulingan dengan status Siap Setor berhasil diambil',
                'data' => [
                    'Siap Setor' => $jumlah  // Mengirim jumlah data dalam format key-value
                ]
            ], 200);
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            return response()->json([
                'message' => 'Gagal mengambil data penyulingan dengan status Siap Setor',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function countByStatusMasukGudang()
    {
        try {
            // Menghitung jumlah data dengan status "Siap Setor"
            $jumlah = Penyulingan::where('status', 'Masuk Gudang')  // Memfilter berdasarkan status "Masuk Gudang"
                ->count();  // Menghitung jumlah data yang sesuai

            // Mengembalikan respons dalam format JSON
            return response()->json([
                'message' => 'Jumlah data penyulingan dengan status Masuk Gudang berhasil diambil',
                'data' => [
                    'Masuk Gudang' => $jumlah  // Mengirim jumlah data dalam format key-value
                ]
            ], 200);
        } catch (\Exception $e) {
            // Tangani jika terjadi error
            return response()->json([
                'message' => 'Gagal mengambil data penyulingan dengan status Masuk Gudang',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    

}
