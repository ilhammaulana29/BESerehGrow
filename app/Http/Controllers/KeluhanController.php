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
    // Validasi input
    $validatedData = $request->validate([
        'tgl_pengaduan' => 'required|date',
        'keluhan' => 'required|string',
        'jumlah_kasus' => 'required|numeric',
        'nama_pengadu' => 'required|string',
        'alamat_pengadu' => 'required|string',
        'bukti_aduan' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable', // Validasi file gambar
        'tindak_lanjut' => 'required|string',
    ]);

    try {
        $buktiName = null;

        // Proses upload file jika ada
        if ($request->hasFile('bukti_aduan')) {
            $file = $request->file('bukti_aduan');
            $buktiName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image_keluhan', $buktiName, 'public');
        }

        // Menyimpan data keluhan ke dalam database
        $keluhan = Keluhan::create([
            'tgl_pengaduan' => $validatedData['tgl_pengaduan'],
            'keluhan' => $validatedData['keluhan'],
            'jumlah_kasus' => $validatedData['jumlah_kasus'],
            'nama_pengadu' => $validatedData['nama_pengadu'],
            'alamat_pengadu' => $validatedData['alamat_pengadu'],
            'bukti_aduan' => $buktiName, // Menyimpan nama file atau null jika tidak ada file
            'tindak_lanjut' => $validatedData['tindak_lanjut'],
        ]);

        return response()->json([
            'message' => 'Data keluhan berhasil disimpan',
            'data' => $keluhan,
        ], 201);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Terjadi kesalahan saat menyimpan data keluhan',
            'error' => $e->getMessage(),
        ], 500);
    }
}

    public function update(Request $request, $id_keluhan)
    {
        $data = Keluhan::findOrFail($id_keluhan);

        // Validasi hanya jika inputnya tidak kosong
        $validatedData = $request->validate([
            'bukti_aduan' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'tgl_pengaduan' => 'nullable',
            'keluhan' => 'nullable',
            'jumlah_kasus' => 'nullable',
            'nama_pengadu' => 'nullable',
            'alamat_pengadu' => 'nullable',
            'tindak_lanjut' => 'nullable',
        ]);

        // Cek jika gambar diupload
        if ($request->hasFile('bukti_aduan')) {
            $file = $request->file('bukti_aduan');
            $buktiName = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image_keluhan', $buktiName, 'public');
            $data->bukti_aduan = $buktiName;

        }

        $data->tgl_pengaduan = $validatedData['tgl_pengaduan'];
        $data->keluhan = $validatedData['keluhan'];
        $data->jumlah_kasus = $validatedData['jumlah_kasus'];
        $data->nama_pengadu = $validatedData['nama_pengadu'];
        $data->alamat_pengadu = $validatedData['alamat_pengadu'];
        $data->tindak_lanjut = $validatedData['tindak_lanjut'];


        $data->save();

        return response()->json($data, 200);

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
    public function countKeluhan()
    {
        try {
            // Hitung jumlah data Keluhan yang ada
            $count = Keluhan::count();

            return response()->json([
                'success' => true,
                'count' => $count,
                'message' => 'Jumlah data Keluhan berhasil dihitung'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan dalam menghitung jumlah data Keluhan',
                'error' => $e->getMessage()
            ], 500);
        }
    }


}