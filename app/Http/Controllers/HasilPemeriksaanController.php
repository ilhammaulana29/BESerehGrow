<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Hasilpemeriksaan;

class HasilPemeriksaanController extends Controller
{
    public function getHasilPemeriksaanByIdPengujian($id_pengujian)
    {
        // Mengambil data berdasarkan id_pengujian
        $hasilpemeriksaan = Hasilpemeriksaan::where('id_pengujian', $id_pengujian)
        ->get();

        // Periksa apakah data ditemukan
        if ($hasilpemeriksaan->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Data hasil pemeriksaan tidak ditemukan untuk id_pengujian: ' . $id_pengujian
            ], 404);
        }

        // Mengembalikan data dalam bentuk JSON
        return response()->json([
            'success' => true,
            'message' => 'Data hasil pemeriksaan ditemukan',
            'data' => $hasilpemeriksaan
        ], 200);
    }
    public function store(Request $request)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_pengujian' => 'required|numeric',
            'warna' => 'required|string',
            'bau' => 'required|string',
            'kelarutan_ethanol' => 'required|string',
            'lemak' => 'required|string',
            'indeks_bias' => 'required|numeric',
            'berat_jenis' => 'required|string',
            'putaran_optik' => 'required|numeric',
            'kadar_sitronelal' => 'required|numeric',
        ]);
    
        // Kembalikan respons error jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }
    
        try {
            // Simpan data pengujian ke database
            $hasilpemeriksaan = new Hasilpemeriksaan();
            $hasilpemeriksaan->id_pengujian = $request->id_pengujian;
            $hasilpemeriksaan->warna = $request->warna;
            $hasilpemeriksaan->bau = $request->bau;
            $hasilpemeriksaan->kelarutan_ethanol = $request->kelarutan_ethanol;
            $hasilpemeriksaan->lemak = $request->lemak;
            $hasilpemeriksaan->indeks_bias = $request->indeks_bias;
            $hasilpemeriksaan->berat_jenis = $request->berat_jenis;
            $hasilpemeriksaan->putaran_optik = $request->putaran_optik;
            $hasilpemeriksaan->kadar_sitronelal = $request->kadar_sitronelal;
            $hasilpemeriksaan->save();
    
            // Kembalikan respons sukses
            return response()->json([
                'success' => true,
                'message' => 'Data pengujian berhasil disimpan',
                'data' => $hasilpemeriksaan,
            ], 201);
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan pada proses penyimpanan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data pengujian',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request, $id_hasil_pemeriksaan)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_pengujian' => 'required|numeric',
            'warna' => 'required|string',
            'bau' => 'required|string',
            'kelarutan_ethanol' => 'required|string',
            'lemak' => 'required|string',
            'indeks_bias' => 'required|numeric',
            'berat_jenis' => 'required|string',
            'putaran_optik' => 'required|numeric',
            'kadar_sitronelal' => 'required|numeric',
        ]);

        // Kembalikan respons error jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Cari data hasil pemeriksaan berdasarkan id
            $hasilpemeriksaan = Hasilpemeriksaan::find($id_hasil_pemeriksaan);

            if (!$hasilpemeriksaan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data hasil pemeriksaan tidak ditemukan'
                ], 404);
            }

            // Update data
            $hasilpemeriksaan->id_pengujian = $request->id_pengujian;
            $hasilpemeriksaan->warna = $request->warna;
            $hasilpemeriksaan->bau = $request->bau;
            $hasilpemeriksaan->kelarutan_ethanol = $request->kelarutan_ethanol;
            $hasilpemeriksaan->lemak = $request->lemak;
            $hasilpemeriksaan->indeks_bias = $request->indeks_bias;
            $hasilpemeriksaan->berat_jenis = $request->berat_jenis;
            $hasilpemeriksaan->putaran_optik = $request->putaran_optik;
            $hasilpemeriksaan->kadar_sitronelal = $request->kadar_sitronelal;
            $hasilpemeriksaan->save();

            return response()->json([
                'success' => true,
                'message' => 'Data hasil pemeriksaan berhasil diperbarui',
                'data' => $hasilpemeriksaan
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id_hasil_pemeriksaan)
    {
        try {
            // Cari data hasil pemeriksaan berdasarkan id
            $hasilpemeriksaan = Hasilpemeriksaan::find($id_hasil_pemeriksaan);

            if (!$hasilpemeriksaan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data hasil pemeriksaan tidak ditemukan'
                ], 404);
            }

            // Hapus data
            $hasilpemeriksaan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data hasil pemeriksaan berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    
}
