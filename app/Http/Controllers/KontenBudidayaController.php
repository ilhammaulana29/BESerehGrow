<?php

namespace App\Http\Controllers;

use App\Models\KontenBibit;
use App\Models\KontenLahan;
use App\Models\KontenPanen;
use App\Models\KontenPenyulingan;
use App\Models\KontenPerawatan;
use App\Models\KontenSdmBudidaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KontenBudidayaController extends Controller
{
    // Bibit
    public function getDataKontenBibit()
    {
        $datas = KontenBibit::all();
        return response()->json($datas);
    }
    
    public function showDataKontenBibit($id)
    {
        $datas = KontenBibit::findOrFail($id);
        return response()->json($datas);
    }

    public function updateDataKontenBibit(Request $request, $id)
    {
        $datas = KontenBibit::findOrFail($id);
    
        // Validasi hanya jika inputnya tidak kosong
        $validatedData = $request->validate([
            'judul' => 'nullable',
            'isi_konten' => 'nullable',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
        ]);
    
        // Cek jika gambar diupload
        if ($request->hasFile('gambar')) {
            Storage::delete('public/image-konten-budidaya/' . $datas->gambar);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-konten-budidaya', $filename, 'public'); // Simpan gambar ke storage public/image-gallery
            $datas->gambar = $filename;
        }
    
        $datas->judul = $validatedData['judul'];
        $datas->isi_konten = $validatedData['isi_konten'];
        
    
    
        $datas->save();
    
        return response()->json($datas, 200);
    }
    // Lahan
    public function getDataKontenLahan()
    {
        $datas = KontenLahan::all();
        return response()->json($datas);
    }
    
    public function showDataKontenLahan($id)
    {
        $datas = KontenLahan::findOrFail($id);
        return response()->json($datas);
    }

    public function updateDataKontenLahan(Request $request, $id)
    {
        $datas = KontenLahan::findOrFail($id);
    
        // Validasi hanya jika inputnya tidak kosong
        $validatedData = $request->validate([
            'judul' => 'nullable',
            'isi_konten' => 'nullable',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
        ]);
    
        // Cek jika gambar diupload
        if ($request->hasFile('gambar')) {
            Storage::delete('public/image-konten-budidaya/' . $datas->gambar);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-konten-budidaya', $filename, 'public'); // Simpan gambar ke storage public/image-gallery
            $datas->gambar = $filename;
        }
    
        $datas->judul = $validatedData['judul'];
        $datas->isi_konten = $validatedData['isi_konten'];
        
    
    
        $datas->save();
    
        return response()->json($datas, 200);
    }
    // Perawatan
    public function getDataKontenPerawatan()
    {
        $datas = KontenPerawatan::all();
        return response()->json($datas);
    }
    
    public function showDataKontenPerawatan($id)
    {
        $datas = KontenPerawatan::findOrFail($id);
        return response()->json($datas);
    }

    public function updateDataKontenPerawatan(Request $request, $id)
    {
        $datas = KontenPerawatan::findOrFail($id);
    
        // Validasi hanya jika inputnya tidak kosong
        $validatedData = $request->validate([
            'judul' => 'nullable',
            'isi_konten' => 'nullable',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
        ]);
    
        // Cek jika gambar diupload
        if ($request->hasFile('gambar')) {
            Storage::delete('public/image-konten-budidaya/' . $datas->gambar);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-konten-budidaya', $filename, 'public'); // Simpan gambar ke storage public/image-gallery
            $datas->gambar = $filename;
        }
    
        $datas->judul = $validatedData['judul'];
        $datas->isi_konten = $validatedData['isi_konten'];
        
    
    
        $datas->save();
    
        return response()->json($datas, 200);
    }
    // Penyulingan
    public function getDataKontenPenyulingan()
    {
        $datas = KontenPenyulingan::all();
        return response()->json($datas);
    }
    
    public function showDataKontenPenyulingan($id)
    {
        $datas = KontenPenyulingan::findOrFail($id);
        return response()->json($datas);
    }

    public function updateDataKontenPenyulingan(Request $request, $id)
    {
        $datas = KontenPenyulingan::findOrFail($id);
    
        // Validasi hanya jika inputnya tidak kosong
        $validatedData = $request->validate([
            'judul' => 'nullable',
            'isi_konten' => 'nullable',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
        ]);
    
        // Cek jika gambar diupload
        if ($request->hasFile('gambar')) {
            Storage::delete('public/image-konten-budidaya/' . $datas->gambar);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-konten-budidaya', $filename, 'public'); // Simpan gambar ke storage public/image-gallery
            $datas->gambar = $filename;
        }
    
        $datas->judul = $validatedData['judul'];
        $datas->isi_konten = $validatedData['isi_konten'];
        
    
    
        $datas->save();
    
        return response()->json($datas, 200);
    }
    // Panen
    public function getDataKontenPanen()
    {
        $datas = KontenPanen::all();
        return response()->json($datas);
    }
    
    public function showDataKontenPanen($id)
    {
        $datas = KontenPanen::findOrFail($id);
        return response()->json($datas);
    }

    public function updateDataKontenPanen(Request $request, $id)
    {
        $datas = KontenPanen::findOrFail($id);
    
        // Validasi hanya jika inputnya tidak kosong
        $validatedData = $request->validate([
            'judul' => 'nullable',
            'isi_konten' => 'nullable',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
        ]);
    
        // Cek jika gambar diupload
        if ($request->hasFile('gambar')) {
            Storage::delete('public/image-konten-budidaya/' . $datas->gambar);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-konten-budidaya', $filename, 'public'); // Simpan gambar ke storage public/image-gallery
            $datas->gambar = $filename;
        }
    
        $datas->judul = $validatedData['judul'];
        $datas->isi_konten = $validatedData['isi_konten'];
        
    
    
        $datas->save();
    
        return response()->json($datas, 200);
    }


    // SDM budidaya
    public function getDataKontenSdmBudidaya()
    {
        $datas = KontenSdmBudidaya::all();
        return response()->json($datas);
    }
    
    public function showDataKontenSdmBudidaya($id)
    {
        $datas = KontenSdmBudidaya::findOrFail($id);
        return response()->json($datas);
    }

    public function updateDataKontenSdmBudidaya(Request $request, $id)
    {
        $datas = KontenSdmBudidaya::findOrFail($id);
    
        // Validasi hanya jika inputnya tidak kosong
        $validatedData = $request->validate([
            'judul' => 'nullable',
            'isi_konten' => 'nullable',
            'gambar' => 'nullable|file|mimes:jpeg,png,jpg|max:5120',
        ]);
    
        // Cek jika gambar diupload
        if ($request->hasFile('gambar')) {
            Storage::delete('public/image-konten-budidaya/' . $datas->gambar);
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('image-konten-budidaya', $filename, 'public'); // Simpan gambar ke storage public/image-gallery
            $datas->gambar = $filename;
        }
    
        $datas->judul = $validatedData['judul'];
        $datas->isi_konten = $validatedData['isi_konten'];
        
    
    
        $datas->save();
    
        return response()->json($datas, 200);
    }
}