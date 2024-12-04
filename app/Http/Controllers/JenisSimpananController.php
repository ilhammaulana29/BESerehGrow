<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Validation\ValidatesRequests;

use Illuminate\Http\Request;
use App\Models\Jenissimpanan;

class JenisSimpananController extends Controller
{
    use ValidatesRequests;
    public function index()
    {
        $statusKeanggotaan = Jenissimpanan::all();
        return response()->json([
            'success' => true,
            'data' => $statusKeanggotaan,
        ], 200);
    }

    public function getJenisSimpanan()
    {
        try {
            $jenisSimpanan = Jenissimpanan::select('id_jenissimpanan', 'nama_simpanan')->get();
            return response()->json($jenisSimpanan, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch data', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_simpanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        try {
            $jenisSimpanan = Jenissimpanan::create([
                'nama_simpanan' => $request->nama_simpanan,
                'deskripsi' => $request->deskripsi,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil disimpan',
                'data' => $jenisSimpanan,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama_simpanan' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
        ]);

        try {
            $jenisSimpanan = Jenissimpanan::findOrFail($id);

            $jenisSimpanan->update([
                'nama_simpanan' => $request->nama_simpanan,
                'deskripsi' => $request->deskripsi,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil diperbarui',
                'data' => $jenisSimpanan,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $jenisSimpanan = Jenissimpanan::findOrFail($id);

            $jenisSimpanan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
