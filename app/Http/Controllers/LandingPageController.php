<?php

namespace App\Http\Controllers;

use App\Models\InfoSerehGrow;
use App\Models\InfoSerehWangi;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LandingPageController extends Controller
{
    public function getDataInfoSerehWangi()
    {
        $datas = InfoSerehWangi::all();
        return response()->json($datas);
    }


    public function showDataInfoSerehWangi($id)
    {
        $data = InfoSerehWangi::findOrFail($id);
        return response()->json($data);
    }


    public function updateDataInfoSerehWangi(Request $request, $id)
    {
        $data = InfoSerehWangi::findOrFail($id);

        // Validasi hanya jika inputnya tidak kosong
        $validatedData = $request->validate([
            'deskripsi_sereh_wangi' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ],
        [
            'gambar.image' => 'File harus berupa gambar ',
            'gambar.mimes' => 'Gambar harus berformat jpeg, jpg, atau png',
            'gambar.max' => 'Gambar maksimal 5MB',
        ]
    );

        // Cek jika gambar diupload
        if ($request->hasFile('gambar')) {
            Storage::delete('public/image-landing-page/' . $data->gambar);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-landing-page', $filename, 'public');
            $data->gambar = $filename;
        }

        $data->deskripsi_sereh_wangi = $validatedData['deskripsi_sereh_wangi'];


        $data->save();

        return response()->json($data, 200);
    }


    public function getDataInfoSerehGrow()
    {
        $datas = InfoSerehGrow::all();
        return response()->json($datas);
    }


    public function showDataInfoSerehGrow($id)
    {
        $data = InfoSerehGrow::findOrFail($id);
        return response()->json($data);
    }


    public function updateDataInfoSerehGrow(Request $request, $id)
    {
        $data = InfoSerehGrow::findOrFail($id);

        // Validasi hanya jika inputnya tidak kosong
        $validatedData = $request->validate([
            'deskripsi_sereh_grow' => 'nullable',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ],
        [
            'gambar.image' => 'File harus berupa gambar ',
            'gambar.mimes' => 'Gambar harus berformat jpeg, jpg, atau png',
            'gambar.max' => 'Gambar maksimal 5MB',
        ]
    );

        // Cek jika gambar diupload
        if ($request->hasFile('gambar')) {
            Storage::delete('public/image-landing-page/' . $data->gambar);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-landing-page', $filename, 'public');
            $data->gambar = $filename;
        }

        $data->deskripsi_sereh_grow = $validatedData['deskripsi_sereh_grow'];


        $data->save();

        return response()->json($data, 200);
    }


    public function index()
    {
        $datas = Testimoni::all();

        return response()->json($datas, 200);
    }


    public function showDataTestimoni($id)
    {
        $datas = Testimoni::findOrFail($id);
        return response()->json($datas);
    }


    public function addDataTestimoni(Request $request)
    {
        // Validasi inputan
        $request->validate([
            'nama' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            'profesi' => 'required|string',
            'pesan_testimoni' => 'required|string'
        ],
        [
            'nama.required' => 'Nama harus dipilih',
            'gambar.required' => 'Gambar wajib dunggah',
            'gambar.image' => 'File harus berupa gambar ',
            'gambar.mimes' => 'Gambar harus berformat jpeg, jpg, atau png',
            'gambar.max' => 'Gambar maksimal 2MB',
            'profesi.required' => 'Profesi harus diisi',
            'pesan_testimoni.required' => 'Pesan testimoni harus diisi'
        ]
        );


        // Menyimpan file gambar
        if($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-landing-page', $filename, 'public'); // Simpan gambar ke storage public/image-gallery
        } else {
            return response()->json(['error' => 'Gambar tidak ditemukan'], 400);
        }


        // Menyimpan ke database
        $datas = new Testimoni();
        $datas->gambar = $filename;
        $datas->nama = $request->nama;
        $datas->profesi = $request->profesi;
        $datas->pesan_testimoni = $request->pesan_testimoni;
        $datas->save();

        return response()->json([
            'message' => 'Data berhasil ditambah',
            'testimoni' => $datas,
        ], 201);
    }


    public function updateDataTestimoni(Request $request, $id)
    {
        $datas = Testimoni::findOrFail($id);

        // Validasi hanya jika inputnya tidak kosong
        $validatedData = $request->validate([
                'nama' => 'required|string',
                'gambar' => 'required|image|mimes:jpeg,jpg,png|max:2048',
                'profesi' => 'required|string',
                'pesan_testimoni' => 'required|string'
            ],
            [
                'nama.required' => 'Nama harus dipilih',
                'gambar.required' => 'Gambar wajib dunggah',
                'gambar.image' => 'File harus berupa gambar ',
                'gambar.mimes' => 'Gambar harus berformat jpeg, jpg, atau png',
                'gambar.max' => 'Gambar maksimal 2MB',
                'profesi.required' => 'Profesi harus diisi',
                'pesan_testimoni.required' => 'Pesan testimoni harus diisi'
            ]
        );

        // Cek jika gambar diupload
        if ($request->hasFile('gambar')) {
            Storage::delete('public/image-landing-page/' . $datas->gambar);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-landing-page', $filename, 'public'); // Simpan gambar ke storage public/image-gallery
            $datas->gambar = $filename;
        }

        $datas->nama = $validatedData['nama'];
        $datas->profesi = $validatedData['profesi'];
        $datas->pesan_testimoni = $validatedData['pesan_testimoni'];


        $datas->save();

        return response()->json($datas, 200);
    }


    public function deleteDataTestimoni($id)
    {
        // Cari data galeri berdasarkan id
        $datas = Testimoni::findOrFail($id);

        // Hapus file gambar dari storage jika ada
        if ($datas->gambar) {
            Storage::delete('public/image-landing-page/' . $datas->gambar);
        }

        // Hapus data galeri dari database
        $datas->delete();

        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
