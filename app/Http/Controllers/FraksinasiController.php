<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Fraksinasi;

class FraksinasiController extends Controller
{
    public function index()
    {
        $data = Fraksinasi::orderBy('created_at', 'desc')->get(); // Ambil data terbaru berdasarkan created_at
        return response()->json($data); // Kembalikan data sebagai JSON
    }
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'no_batch_fraksinasi'  => 'required|string|max:255',
            'id_pengujian' => 'required|numeric', // Foreign key ke tabel pm_pengujian
            'tgl_fraksinasi' => 'required|date',
            'volume_minyak_awal' => 'required|numeric',
            'volume_minyak_akhir' => 'required|numeric',
            'waktu_fraksinasi' => 'required|numeric',
            'kadar_sitronelal' => 'required|numeric',
            'kadar_geraniol' => 'required|numeric',
            'suhu_pemisah' => 'required|numeric',
            'tekanan_vakum' => 'required|numeric',
        ]);

        // Kembalikan respons error jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Simpan data fraksinasi ke database
            $fraksinasi = Fraksinasi::create([
                'no_batch_fraksinasi' => $request->no_batch_fraksinasi,
                'id_pengujian' => $request->id_pengujian,
                'tgl_fraksinasi' => $request->tgl_fraksinasi,
                'volume_minyak_awal' => $request->volume_minyak_awal,
                'volume_minyak_akhir' => $request->volume_minyak_akhir,
                'waktu_fraksinasi' => $request->waktu_fraksinasi,
                'kadar_sitronelal' => $request->kadar_sitronelal,
                'kadar_geraniol' => $request->kadar_geraniol,
                'suhu_pemisah' => $request->suhu_pemisah,
                'tekanan_vakum' => $request->tekanan_vakum,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data Fraksinasi berhasil disimpan',
                'data' => $fraksinasi
            ], 201);
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan pada proses penyimpanan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data fraksinasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request, $id_fraksinasi)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'no_batch_fraksinasi'  => 'required|string|max:255',
            'id_pengujian' => 'required|numeric', // Foreign key ke tabel pm_pengujian
            'tgl_fraksinasi' => 'required|date',
            'volume_minyak_awal' => 'required|numeric',
            'volume_minyak_akhir' => 'required|numeric',
            'waktu_fraksinasi' => 'required|numeric',
            'kadar_sitronelal' => 'required|numeric',
            'kadar_geraniol' => 'required|numeric',
            'suhu_pemisah' => 'required|numeric',
            'tekanan_vakum' => 'required|numeric',
        ]);

        // Kembalikan respons error jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Cari data pengujian berdasarkan ID
            $fraksinasi = Fraksinasi::findOrFail($id_fraksinasi);
            
            // Update data
            $fraksinasi->id_pengujian = $request->id_pengujian;
            $fraksinasi->no_batch_fraksinasi = $request->no_batch_fraksinasi;
            $fraksinasi->tgl_fraksinasi = $request->tgl_fraksinasi;
            $fraksinasi->volume_minyak_awal = $request->volume_minyak_awal;
            $fraksinasi->volume_minyak_akhir = $request->volume_minyak_akhir;
            $fraksinasi->waktu_fraksinasi = $request->waktu_fraksinasi;
            $fraksinasi->kadar_sitronelal = $request->kadar_sitronelal;
            $fraksinasi->kadar_geraniol = $request->kadar_geraniol;
            $fraksinasi->suhu_pemisah = $request->suhu_pemisah;
            $fraksinasi->tekanan_vakum = $request->tekanan_vakum;
            $fraksinasi->save();

            return response()->json([
                'success' => true,
                'message' => 'Data fraksinasi berhasil diperbarui',
                'data' => $fraksinasi
            ], 200);
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan pada proses penyimpanan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data fraksinasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id_fraksinasi)
    {
        try {
            // Cari data fraksinasi berdasarkan id_fraksinasi
            $fraksinasi = Fraksinasi::findOrFail($id_fraksinasi);
            
            // Hapus data
            $fraksinasi->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data fraksinasi berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan pada proses penghapusan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data fraksinasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function countFraksinasi()
    {
        try {
            // Hitung jumlah data Fraksinasi yang ada
            $count = Fraksinasi::count();

            return response()->json([
                'success' => true,
                'count' => $count,
                'message' => 'Jumlah data Fraksinasi berhasil dihitung'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan dalam menghitung jumlah data Fraksinasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function searchFraksinasi(Request $request)
    {
        $query = $request->input('query');
        
        if (!$query) {
            return response()->json([], 200); // Jika kosong, kembalikan array kosong
        }

        // Sesuaikan pencarian dengan kebutuhan Anda
        $results = Fraksinasi::where('no_batch_fraksinasi', 'LIKE', "%$query%")
                            ->orWhere('tgl_fraksinasi', 'LIKE', "%$query%")
                            ->orWhere('volume_minyak_awal', 'LIKE', "%$query%")
                            ->orWhere('volume_minyak_akhir', 'LIKE', "%$query%")
                            ->orWhere('waktu_fraksinasi', 'LIKE', "%$query%")
                            ->orWhere('kadar_sitronelal', 'LIKE', "%$query%")
                            ->orWhere('kadar_geraniol', 'LIKE', "%$query%")
                            ->orWhere('suhu_pemisah', 'LIKE', "%$query%")
                            ->orWhere('tekanan_vakum', 'LIKE', "%$query%")
                            ->get();

        return response()->json($results, 200);
    }
}
