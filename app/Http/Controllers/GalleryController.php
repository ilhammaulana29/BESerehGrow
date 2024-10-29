<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    // Fungsi untuk menampilkan semua galeri
    public function index(Request $request)
    {
        // Ambil parameter id_kategori dari request query
        $id_kategori = $request->query('id_kategori');
    
        // Jika id_kategori diberikan, filter data berdasarkan id_kategori
        if ($id_kategori) {
            $galleries = Gallery::where('id_kategori', $id_kategori)->get();
        } else {
            // Jika tidak ada filter, ambil semua data
            $galleries = Gallery::all();
        }
    
        return response()->json($galleries);
    }
    

    public function getCategories()
    {
        $categories = Category::all();

        return response()->json($categories);
    }


    public function uploadGallery(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'kategori' => 'required|string',
            'deskripsi_gambar' => 'required|max:50'
        ]);


        // Menyimpan file gambar
        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-gallery', $filename, 'public'); // Simpan gambar ke storage public/image-gallery
        } else {
            return response()->json(['error' => 'Gambar tidak ditemukan'], 400);
        }


        // Menyimpan ke database
        $gallery = new Gallery();
        $gallery->gambar = $filename;
        $gallery->id_kategori = $request->kategori;
        $gallery->deskripsi_gambar = $request->deskripsi_gambar;
        $gallery->save();

        return response()->json([
            'message' => 'Galeri berhasil diupload',
            'gallery' => $gallery,
        ], 201);
    }

    public function updateGallery(Request $request, $id_galeri)
{
    $gallery = Gallery::find($id_galeri);

    if (!$gallery) {
        return response()->json(['message' => 'Gallery not found'], 404);
    }

    // Validasi hanya jika inputnya tidak kosong
    $validatedData = $request->validate([
        'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'id_kategori' => 'nullable',
        'deskripsi_gambar' => 'nullable',
    ]);

    // Cek jika gambar diupload
    if ($request->hasFile('gambar')) {
        Storage::delete('public/image-gallery/' . $gallery->gambar);
        $file = $request->file('gambar');
        $filePath = $file->store('public/image-gallery');
        $gallery->gambar = $file;
    }

    // Cek jika id_kategori tidak kosong, jika kosong gunakan data lama
    if ($request->filled('id_kategori')) {
        $gallery->id_kategori = $validatedData['id_kategori'];
    }

    // Cek jika deskripsi_gambar tidak kosong, jika kosong gunakan data lama
    if ($request->filled('deskripsi_gambar')) {
        $gallery->deskripsi_gambar = $validatedData['deskripsi_gambar'];
    }

    $gallery->save();

    return response()->json($gallery, 200);
}

        
    
}

