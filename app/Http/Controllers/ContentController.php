<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\ContentType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::all();

        return response()->json($contents);
    }


    public function getContentType()
    {
        $contentsType = ContentType::all();

        return response()->json($contentsType);
    }


    public function detailContent($slug)
    {
        // Cari artikel berdasarkan slug
        $content = Content::where('slug', $slug)->first();

        // Periksa apakah artikel ditemukan
        if ($content) {
            return response()->json($content);
        } else {
            return response()->json(['message' => 'Konten tidak ditemukan'], 404);
        }
    }


    public function showDataContent($id_konten)
    {
        $content = Content::findOrFail($id_konten);
        return response()->json($content);
    }


    public function uploadContent(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'nama_penulis' => 'required|string',
            'id_jenis_konten' => 'required',
            'judul_konten' => 'required|string',
            'deskripsi_konten' => 'required',
            'gambar' => 'required|filled|image|mimes:jpeg,jpg,png|max:5120',
        ],
        [
            'nama_penulis.required' => 'Nama Penulis harus diisi',
            'nama_penulis.string' => 'Nama Penulis harus berupa huruf',
            'id_jenis_konten.required' => 'Jenis Konten harus dipilih',
            'judul_konten.required' => 'Judul Konten harus diisi',
            'judul_konten.string' => 'Judul Konten harus berupa huruf',
            'deskripsi_konten.required' => 'Deskripsi Konten harus diisi',
            'deskripsi_konten.string' => 'Deskripsi Konten harus berupa huruf',
            'gambar.required' => 'Gambar harus diunggah',
            'gambar.image' => 'File harus berupa gambar ',
            'gambar.mimes' => 'Gambar harus berformat jpeg, jpg, atau png',
            'gambar.max' => 'Gambar maksimal 5MB',
        ]
    );
    
        // Menyimpan file gambar
        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-content', $filename, 'public');
        } else {
            return response()->json(['error' => 'Gambar tidak ditemukan'], 400);
        }
    
        // Membuat slug dari judul konten
        $slug = Str::slug($request->judul_konten, '-');
    
        // Menyimpan ke database
        $content = new Content();
        $content->nama_penulis = $request->nama_penulis;
        $content->id_jenis_konten = $request->id_jenis_konten;
        $content->judul_konten = $request->judul_konten;
        $content->deskripsi_konten = $request->deskripsi_konten;
        $content->gambar = $filename;
        $content->slug = $slug; // Simpan slug di sini
        $content->save();
    
        return response()->json([
            'message' => 'Galeri berhasil diupload',
            'gallery' => $content,
        ], 201);
    }


    public function updateContent(Request $request, $id_konten)
    {
        $content = Content::findOrFail($id_konten);

        // Validasi hanya jika inputnya tidak kosong
        $validatedData = $request->validate([
            'nama_penulis' => 'required|string',
            'id_jenis_konten' => 'required|string',
            'judul_konten' => 'required|string',
            'deskripsi_konten' => 'required|string',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
            'video' => 'nullable',
        ]);

        // Cek jika gambar diupload
        if ($request->hasFile('gambar')) {
            Storage::delete('public/image-content/' . $content->gambar);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-content', $filename, 'public'); // Simpan gambar ke storage public/image-gallery
            $content->gambar = $filename;
        }

        $content->nama_penulis = $validatedData['nama_penulis'];
        $content->id_jenis_konten = $validatedData['id_jenis_konten'];
        $content->judul_konten = $validatedData['judul_konten'];
        $content->deskripsi_konten = $validatedData['deskripsi_konten'];
        $content->slug = Str::slug($validatedData['judul_konten']);


        $content->save();

        return response()->json($content, 200);
    }

    public function deleteContent($id_konten)
    {
        // Cari data galeri berdasarkan id
        $konten = Content::findOrFail($id_konten);

        // Hapus file gambar dari storage jika ada
        if ($konten->gambar) {
            Storage::delete('public/image-content/' . $konten->gambar);
        }

        // Hapus data galeri dari database
        $konten->delete();

        return response()->json(['message' => 'Galeri berhasil dihapus'], 200);
    }


    public function searchContent(Request $request)
    {
        $query = $request->input('query');
        
        if (!$query) {
            return response()->json([], 200); // Jika kosong, kembalikan array kosong
        }

        // Sesuaikan pencarian dengan kebutuhan Anda
        $results = Content::where('nama_penulis', 'LIKE', "%$query%")
                            ->orWhere('judul_konten', 'LIKE', "%$query%")
                            ->get();

        return response()->json($results, 200);
    }
    
}
