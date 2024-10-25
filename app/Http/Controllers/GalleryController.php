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
    public function index()
    {
        $galleries = Gallery::all();
        return response()->json($galleries);
    }

    // Fungsi untuk menampilkan galeri berdasarkan kategori
    public function filterByCategory($category)
    {
        if ($category == "Semua") {
            // Jika kategori "Semua", kembalikan semua data galeri
            $galleries = Gallery::all();
        } else {
            // Ambil galeri berdasarkan kategori
            $galleries = Gallery::where('kategori', $category)->get();
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
            $filename = Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/image-gallery', $filename); // Simpan gambar ke storage public/image-gallery
            $fileUrl = Storage::url($path); //Mengambil URL file gambar yang tersimpan
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
}

