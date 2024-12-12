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
        $galleries = Gallery::with('category')->get();
    
        return response()->json($galleries);
    }

    public function countGalleryData()
    {
        $galleriesCount = Gallery::count();
    
        return response()->json([
            'data' => [
                'count' => $galleriesCount
            ]
        ]);
    }  
    

    public function getCategories()
    {
        $categories = Category::all();

        return response()->json($categories);
    }

    public function showDataGallery($id_galeri)
    {
        $gallery = Gallery::findOrFail($id_galeri);
        return response()->json($gallery);
    }


    public function uploadGallery(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'kategori' => 'required|string',
            'deskripsi_gambar' => 'required|max:50'
        ],
        [
            'gambar.required' => 'Gambar wajib dunggah',
            'gambar.image' => 'File harus berupa gambar ',
            'gambar.mimes' => 'Gambar harus berformat jpeg, jpg, atau png',
            'gambar.max' => 'Gambar maksimal 2MB',
            'kategori.required' => 'Kategori harus dipilih',
            'deskripsi_gambar.required' => 'Deskripsi Gambar harus diisi',
            'deskripsi_gambar.max' => 'Maksimal 50 huruf'
        ]
    );


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
        $gallery = Gallery::findOrFail($id_galeri);

        // Validasi hanya jika inputnya tidak kosong
        $validatedData = $request->validate([
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'id_kategori' => 'nullable',
            'deskripsi_gambar' => 'nullable',
        ]);

        // Cek jika gambar diupload
        if ($request->hasFile('gambar')) {
            Storage::delete('public/image-gallery/' . $gallery->gambar);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-gallery', $filename, 'public'); // Simpan gambar ke storage public/image-gallery
            $gallery->gambar = $filename;
        }

        $gallery->id_kategori = $validatedData['id_kategori'];
        $gallery->deskripsi_gambar = $validatedData['deskripsi_gambar'];


        $gallery->save();

        return response()->json($gallery, 200);
    }


    public function deleteGallery($id_galeri)
    {
        // Cari data galeri berdasarkan id
        $gallery = Gallery::findOrFail($id_galeri);

        // Hapus file gambar dari storage jika ada
        if ($gallery->gambar) {
            Storage::delete('public/image-gallery/' . $gallery->gambar);
        }

        // Hapus data galeri dari database
        $gallery->delete();

        return response()->json(['message' => 'Galeri berhasil dihapus'], 200);
    }


        
    
}

