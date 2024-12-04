<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parameterkalkulasi;

class AturParameterKalkulasiController extends Controller
{
    public function index()
    {
        $data = Parameterkalkulasi::orderBy('created_at', 'desc')->first(); // Mengambil 1 data terbaru

        if (!$data) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $data,
        ]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'jumlah_blok' => 'required|integer',
            'jarak_tanam' => 'required|numeric',
            'sesi_panen_per_minggu' => 'required|numeric',
            'harga_minyak_bawah_30' => 'required|numeric',
            'harga_minyak_atas_30' => 'required|numeric',
        ]);

        $parameter = Parameterkalkulasi::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan.',
            'data' => $parameter,
        ]);
    }
    public function update(Request $request, $id_parameter)
    {
        $validated = $request->validate([
            'jumlah_blok' => 'required|integer',
            'jarak_tanam' => 'required|numeric',
            'sesi_panen_per_minggu' => 'required|numeric',
            'harga_minyak_bawah_30' => 'required|numeric',
            'harga_minyak_atas_30' => 'required|numeric',
        ]);

        $parameter = Parameterkalkulasi::findOrFail($id_parameter);
        $parameter->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui.',
            'data' => $parameter,
        ]);
    }
    public function delete($id_parameter)
    {
        $parameter = Parameterkalkulasi::findOrFail($id_parameter);
        $parameter->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus.',
        ]);
    }
}
