<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

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
}

