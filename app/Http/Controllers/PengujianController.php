<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengujian;
use Illuminate\Support\Facades\Validator;

class PengujianController extends Controller
{
    public function index()
    {
        $data = Pengujian::all(); // Ambil semua data dari model
        return response()->json($data); // Kembalikan data sebagai JSON
    }
    public function store(Request $request)
    {
        // Validasi input
        
        $validator = Validator::make($request->all(), [
            'id_penyulingan' => 'required|numeric',
            'no_batch_pengujian' => 'required|string|max:255',
            'tgl_pengujian' => 'required|date',
            'rendemen_atsiri' => 'required|numeric',
            'kadar_sitronelal' => 'required|numeric',
            'kadar_geraniol' => 'required|numeric',
            'status'=>'required|string',
        ]);

        // Kembalikan respons error jika validasi gagal
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Buat instance baru dari model Pengujian
            $pengujian = new Pengujian();
            $pengujian->id_penyulingan = $request->id_penyulingan;
            $pengujian->no_batch_pengujian = $request->no_batch_pengujian;
            $pengujian->tgl_pengujian = $request->tgl_pengujian;
            $pengujian->rendemen_atsiri = $request->rendemen_atsiri;
            $pengujian->kadar_sitronelal = $request->kadar_sitronelal;
            $pengujian->kadar_geraniol = $request->kadar_geraniol;
            $pengujian->status= $request->status;
            $pengujian->save();

            return response()->json([
                'success' => true,
                'message' => 'Data pengujian berhasil disimpan',
                'data' => $pengujian
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
    public function update(Request $request, $id_pengujian)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'id_penyulingan' => 'required|numeric',
            'no_batch_pengujian' => 'required|string|max:255',
            'tgl_pengujian' => 'required|date',
            'rendemen_atsiri' => 'required|numeric',
            'kadar_sitronelal' => 'required|numeric',
            'kadar_geraniol' => 'required|numeric',
            'status' => 'required|string',
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
            $pengujian = Pengujian::findOrFail($id_pengujian);
            
            // Update data
            $pengujian->id_penyulingan = $request->id_penyulingan;
            $pengujian->no_batch_pengujian = $request->no_batch_pengujian;
            $pengujian->tgl_pengujian = $request->tgl_pengujian;
            $pengujian->rendemen_atsiri = $request->rendemen_atsiri;
            $pengujian->kadar_sitronelal = $request->kadar_sitronelal;
            $pengujian->kadar_geraniol = $request->kadar_geraniol;
            $pengujian->status = $request->status;
            $pengujian->save();

            return response()->json([
                'success' => true,
                'message' => 'Data pengujian berhasil diperbarui',
                'data' => $pengujian
            ], 200);
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan pada proses penyimpanan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memperbarui data pengujian',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id_pengujian)
    {
        try {
            // Cari data pengujian berdasarkan id_pengujian
            $pengujian = Pengujian::findOrFail($id_pengujian);
            
            // Hapus data
            $pengujian->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data pengujian berhasil dihapus'
            ], 200);
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan pada proses penghapusan
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghapus data pengujian',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function getByPenyulinganId($id_penyulingan)
    {
        try {
            $data = Pengujian::where('id_penyulingan', $id_penyulingan)->get();
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function getSiapFraksinasi($status)
    {
        // Mengambil data Pengujian yang statusnya 'Masuk Gudang'
        $pengujian = Pengujian::where('status', $status)
        ->get(['id_pengujian', 'no_batch_pengujian']); // Kolom yang diperlukan saja

    return response()->json($pengujian);
    }
    public function updateStatus($id_pengujian)
    {
        try {
            // Temukan data pengujian berdasarkan ID
            $pengujian = Pengujian::findOrFail($id_pengujian);
            
            // Ubah kolom status menjadi 'Masuk Gudang'
            $pengujian->status = 'Siap Fraksinasi';
            $pengujian->save();
            
            // Kembalikan respons berhasil
            return response()->json([
                'message' => 'Status pengujian berhasil diperbarui menjadi "Masuk Gudang"',
                'data' => $pengujian
            ], 200);
            
        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan respons dengan status 500
            return response()->json([
                'message' => 'Terjadi kesalahan saat memperbarui status pengujian',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
