<?php

namespace App\Http\Controllers;

use App\Models\Penyulingan;
use Illuminate\Http\Request;

class PenyulinganController extends Controller
{
    public function index()
    {
        $data = Penyulingan::all(); // Ambil semua data dari model
        return response()->json($data); // Kembalikan data sebagai JSON
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


}
