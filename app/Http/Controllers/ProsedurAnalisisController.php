<?php

namespace App\Http\Controllers;

use App\Models\ProsedurAnalisis;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\storage;

class ProsedurAnalisisController extends Controller
{
    public function index()
    {
        $data = ProsedurAnalisis::all(); // Ambil semua data dari model
        return response()->json($data); // Kembalikan data sebagai JSON
    }
    public function getByJenisKonten($jenis_konten)
    {
        $data = ProsedurAnalisis::where('jenis_konten', $jenis_konten)->get();
        return response()->json($data);
    }
    // Contoh pada ProsedurController.php
    public function show($id)
    {
        try {
            // Temukan prosedur berdasarkan ID
            $prosedur = ProsedurAnalisis::findOrFail($id);

            // Kirim data ke frontend dalam format JSON
            return response()->json([
                'success' => true,
                'data' => $prosedur
            ]);
        } catch (\Exception $e) {
            // Penanganan jika data tidak ditemukan
            return response()->json([
                'success' => false,
                'message' => 'Prosedur tidak ditemukan.'
            ], 404);
        }
    }


    public function store(Request $request)
    {
        // Validasi data yang masuk
        $request->validate([
            'jenis_konten' => 'required|string',
            'judul' => 'required|string',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif|max:2048|nullable', // Validasi file gambar
            'deskripsi' => 'required|string',
        ]);

        try {
            // Upload gambar dan simpan di storage
            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                
                // Menggunakan nama asli file dengan menambahkan timestamp untuk mencegah duplikasi
                $gambarName = time() . '_' . $file->getClientOriginalName(); // Contoh: 1698246145_image.jpg

                // Simpan file di disk public
                $path = $file->storeAs('image-procedure', $gambarName, 'public'); // Simpan di storage/app/public/gambar
            }
            

            // Simpan data ke database
            $prosedur = ProsedurAnalisis::create([
                'jenis_konten' => $request->jenis_konten,
                'judul' => $request->judul,
                'gambar' => $gambarName, // Simpan nama file gambar ke database
                'deskripsi' => $request->deskripsi,
            ]);

            return response()->json([
                'message' => 'Prosedur berhasil disimpan',
                'data' => $prosedur
            ], 201); // Status HTTP 201 Created

        } catch (\Exception $e) {
            // Jika ada kesalahan, kembalikan respons dengan status 500
            return response()->json([
                'message' => 'Terjadi kesalahan saat menyimpan prosedur',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function update(Request $request, $id)
    {
        $prosedur = ProsedurAnalisis::findOrFail($id);

        // Validasi dan update
        $validatedData = $request->validate([
            'judul' => 'required|string',
            'deskripsi' => 'string|nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' // Sesuaikan jika perlu
        ]);

        // Update fields
        $prosedur->judul = $validatedData['judul'];
        $prosedur->deskripsi = $validatedData['deskripsi'];

        // Handle image upload if present
        if ($request->hasFile('gambar')) {
            // Menghapus gambar lama jika perlu
            Storage::disk('public')->delete($prosedur->gambar); // Hapus gambar lama dari storage

            // Upload gambar baru
            $gambarName = time() . '_' . $request->file('gambar')->getClientOriginalName();
            $path = $request->file('gambar')->storeAs('image-procedure', $gambarName, 'public');
            $prosedur->gambar = $gambarName; // Simpan nama gambar baru ke database
        }

        $prosedur->save();

        return response()->json(['message' => 'Data updated successfully.']);
    }
}
