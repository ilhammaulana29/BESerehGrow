<?php

namespace App\Http\Controllers;

use App\Models\ProsedurAnalisis;
use Illuminate\Http\Request;

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

    public function store(Request $request)
{
    // Validasi data yang masuk
    $request->validate([
        'jenis_konten' => 'required|string',
        'judul' => 'required|string',
        'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi file gambar
        'deskripsi' => 'required|string',
    ]);

    try {
        // Upload gambar dan simpan di storage
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            
            // Menggunakan nama asli file dengan menambahkan timestamp untuk mencegah duplikasi
            $gambarName = time() . '_' . $file->getClientOriginalName(); // Contoh: 1698246145_image.jpg

            // Simpan file di disk public
            $path = $file->storeAs('', $gambarName, 'public'); // Simpan di storage/app/public/gambar
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
}
