<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Mitracontroller extends Controller
{
    // GET All Mitras
    public function index()
    {
        $mitras = Mitra::all();
        return response()->json($mitras);
    }

    // CREATE New Mitra
    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama' => 'required|string|max:255',
            'deskripsi_gambar' => 'required|string'
        ]);

        try {
            $data = $request->all();

            // Handle gambar upload
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = time() . '_' . $file->getClientOriginalName();
                // Simpan file ke storage/app/public/mitra
                $path = $file->storeAs('mitra', $filename, 'public');
                $data['gambar'] = $filename;
            }

            $mitra = Mitra::create($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Mitra berhasil ditambahkan',
                'data' => $mitra
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menambahkan mitra',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // GET a Single Mitra
    public function show($id)
    {
        $mitra = Mitra::find($id);

        if (!$mitra) {
            return response()->json(['message' => 'Mitra not found'], 404);
        }

        return response()->json($mitra);
    }

    // UPDATE a Mitra
    public function update(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'nama' => 'required|string|max:255',
            'deskripsi_gambar' => 'required|string'
        ]);

        try {
            $mitra = Mitra::find($id);

            if (!$mitra) {
                return response()->json(['message' => 'Mitra not found'], 404);
            }

            $data = $request->all();

            // Handle gambar upload if new image is provided
            if ($request->hasFile('gambar')) {
                // Delete old image
                if ($mitra->gambar) {
                    Storage::disk('public')->delete($mitra->gambar);
                }

                $file = $request->file('gambar');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('mitra', $filename, 'public');
                $data['gambar'] = $filename;
            }

            $mitra->update($data);
            
            return response()->json([
                'success' => true,
                'message' => 'Mitra berhasil diupdate',
                'data' => $mitra
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate mitra',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    // DELETE a Mitra
    public function destroy($id)
    {
        try {
            $mitra = Mitra::find($id);

            if (!$mitra) {
                return response()->json(['message' => 'Mitra not found'], 404);
            }

            // Delete image file if exists
            if ($mitra->gambar) {
                Storage::disk('public')->delete($mitra->gambar);
            }

            $mitra->delete();
            
            return response()->json([
                'success' => true,
                'message' => 'Mitra berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus mitra',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}