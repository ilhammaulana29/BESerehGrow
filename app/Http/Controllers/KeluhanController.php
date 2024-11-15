<?php

namespace App\Http\Controllers;

use App\Models\Keluhan;
use Illuminate\Http\Request;

class KeluhanController extends Controller
{
    public function index()
    {
        $data = Keluhan::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'tgl_pengaduan' => 'required|date',
            'keluhan' => 'required|string',
            'jumlah_kasus' => 'required|numeric',
            'nama_pengadu' => 'required|string',
            'alamat_pengadu' => 'required|string',
            'bukti_aduan' => 'required|string',
            'tindak_lanjut' => 'required|string',
        ]);

        // Menyimpan data keluhan ke dalam database
        $keluhan = Keluhan::create([
            'tgl_pengaduan' => $validatedData['tgl_pengaduan'],
            'keluhan' => $validatedData['keluhan'],
            'jumlah_kasus' => $validatedData['jumlah_kasus'],
            'nama_pengadu' => $validatedData['nama_pengadu'],
            'alamat_pengadu' => $validatedData['alamat_pengadu'],
            'bukti_aduan' => $validatedData['bukti_aduan'],
            'tindak_lanjut' => $validatedData['tindak_lanjut'],
        ]);

        return response()->json([
            'message' => 'Data keluhan berhasil disimpan',
            'data' => $keluhan,
        ], 201);
    }

    public function update(Request $request, $id_keluhan)
    {
        // Validasi input
        $validatedData = $request->validate([
            'tgl_pengaduan' => 'required|date',
            'keluhan' => 'required|string',
            'jumlah_kasus' => 'required|numeric',
            'nama_pengadu' => 'required|string',
            'alamat_pengadu' => 'required|string',
            'bukti_aduan' => 'required|string',
            'tindak_lanjut' => 'required|string',
        ]);

        // Mencari keluhan berdasarkan ID
        $keluhan = Keluhan::find($id_keluhan);

        if (!$keluhan) {
            return response()->json([
                'message' => 'Data keluhan tidak ditemukan'
            ], 404);
        }

        // Mengupdate data keluhan
        $keluhan->update([
            'tgl_pengaduan' => $validatedData['tgl_pengaduan'],
            'keluhan' => $validatedData['keluhan'],
            'jumlah_kasus' => $validatedData['jumlah_kasus'],
            'nama_pengadu' => $validatedData['nama_pengadu'],
            'alamat_pengadu' => $validatedData['alamat_pengadu'],
            'bukti_aduan' => $validatedData['bukti_aduan'],
            'tindak_lanjut' => $validatedData['tindak_lanjut'],
        ]);

        return response()->json([
            'message' => 'Data keluhan berhasil diupdate',
            'data' => $keluhan,
        ], 200);
    }
    public function destroy($id_keluhan)
    {
        $keluhan = Keluhan::find($id_keluhan);

        if (!$keluhan) {
            return response()->json(['message' => 'Data keluhan tidak ditemukan'], 404);
        }

        $keluhan->delete();

        return response()->json(['message' => 'Data keluhan berhasil dihapus'], 200);
    }


}
